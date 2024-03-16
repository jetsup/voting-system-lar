<x-master-admin>
    <script>
        function populateParties() {
            let ajax = new XMLHttpRequest();
            ajax.open("GET", "/data/get-parties");
            ajax.onload = function() {
                if (this.status == 200) {
                    let parties = JSON.parse(this.responseText).parties;
                    let partiesSelector = document.getElementById("party")
                    let options = "";
                    for (let i = 0; i < parties.length; i++) {
                        if (i == 0) {
                            document.getElementById("party_img").src = "/storage/" + parties[0].party_image;
                        }
                        options += "<option value='" + parties[i].id + "'>" + parties[i].party + "</option>"
                    }
                    partiesSelector.innerHTML = options;
                    partiesSelector.value = "{{ $candidate->party_id }}";
                    populatePositions();
                }
            };
            ajax.send();
        }

        function populatePositions() {
            let ajax = new XMLHttpRequest();
            ajax.open("GET", "/data/get-positions");
            ajax.onload = function() {
                if (this.status == 200) {
                    let positions = JSON.parse(this.responseText).positions;
                    let positionsSelector = document.getElementById("position")
                    let options = "";
                    for (let i = 0; i < positions.length; i++) {
                        options += "<option value='" + positions[i].id + "'>" + positions[i].position + "</option>"
                    }
                    positionsSelector.innerHTML = options;
                    positionsSelector.value = "{{ $candidate->vie_position_id }}";
                    // enable buttons
                    document.getElementById("btn-submit").disabled = false;
                    document.getElementById("btn-delete").disabled = false;
                }
            };
            ajax.send();
        }

        function updatePartyImage(partyID) {
            let ajax = new XMLHttpRequest();
            ajax.open("GET", "data/get-party-logo/" + partyID, true);
            ajax.onload = function() {
                if (this.status == 200) {
                    let partyLogo = JSON.parse(this.responseText).logo.party_image;
                    console.log(partyLogo);
                    document.getElementById("party_img").src = "/storage/" + partyLogo;
                } else {
                    document.getElementById("party_img").src = "";
                }
            };
            ajax.send();
        }

        function populateElections() {
            let ajax = new XMLHttpRequest();
            ajax.open("GET", "/data/get-elections", true);
            ajax.onload = function() {
                if (this.status == 200) {
                    let elections = JSON.parse(this.responseText).elections;
                    let electionOptions = "";
                    for (let i = 0; i < elections.length; i++) {
                        electionOptions += "<option value='" + elections[i].id + "'>" + elections[i].election_type +
                            " [" + elections[i].start_date + " - " + elections[i].end_date + "]" + "</option>"
                    }
                    document.getElementById("election_id").innerHTML = electionOptions;
                    populateParties();
                }
            };
            ajax.send();
        }

        function deleteCandidate() {
            let idNumber = document.getElementById("id_number").value;
            let ajax = new XMLHttpRequest();
            ajax.open("GET", "/delete-candidate/" + idNumber, true);
            ajax.onload = function() {
                if (this.status == 200) {
                    // does nothing
                }
            }
            ajax.send();
        }
        // Alpine.start();
    </script>

    <body>
        <section id="main-content" style=" margin-right:120px;">
            <section class="wrapper">
                <!-- TODO: fix this -->
                <div id="custom-popup" style="width: 300px;height: 100px;position: fixed;z-index: 2;left: 75%;top: 15%;"
                    x-data="{ showMessage: true, message: 'Hello', timeout: 3000 }" x-init="setTimeout(() => showMessage = false, timeout);" x-show="showMessage">
                    <p style="color: green;font-size: 30px;" x-text="message"></p>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-file-text-o"></i>Add Candidate</h3>
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i>Home</li>
                            <li><i class="icon_document_alt"></i>Candidate</li>
                            <li><i class="fa fa-pencil"></i>Edit Candidate</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Candidate
                            </header>
                            <div class="panel-body">
                                <form id="addCandidateForm" class="form-horizontal " action="/update-candidate"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Candidate ID Number</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control round-input" name="id_number"
                                                id="id_number" required minlength="6" maxlength="8" style="width:80%;"
                                                value="{{ $candidate->id_number }}">
                                            <br>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Full Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly name="name" id="name"
                                                class="form-control round-input" style="width:80%;"
                                                value="{{ $candidate->first_name }} {{ $candidate->middle_name . ' ' ? $candidate->middle_name : ' ' }}{{ $candidate->last_name }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Gender</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly name="gender" id="gender"
                                                class="form-control round-input" style="width:80%;"
                                                value="{{ $candidate->gender_id == 1 ? 'MALE' : 'FEMALE' }}">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Candidate Image</label>
                                        <div class="col-lg-2 col-sm-2">
                                            <div class="follow-ava2" style="position: relative; left:50px;">
                                                <img id="candidate_img" src="/storage/{{ $candidate->dp }}"
                                                    style="max-height:150px; max-width: 150px; min-width: 150px; min-height: 150px;
                                     border-top-left-radius: 50% 50%;
                                         border-top-right-radius: 50% 50%;
                                         border-bottom-left-radius: 50% 50%;
                                         border-bottom-right-radius: 50% 50%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Election</label>
                                        <div class="col-sm-10">
                                            <select name="election_id" id="election_id" class="form-control round-input"
                                                oninput="this.setCustomValidity('')"
                                                oninvalid="this.setCustomValidity('Provide which election the candidate is running')"
                                                required style="width:80%;" onchange="populateParties(this.value)">
                                            </select>
                                        </div>
                                        <script>
                                            let ajax = new XMLHttpRequest();
                                            ajax.open("GET", "/data/get-elections", true);
                                            ajax.onload = function() {
                                                if (this.status == 200) {
                                                    let elections = JSON.parse(this.responseText).elections;
                                                    let electionOptions = "";
                                                    for (let i = 0; i < elections.length; i++) {
                                                        electionOptions += "<option value='" + elections[i].id + "'>" + elections[i].election_type +
                                                            " [" + elections[i].start_date + " - " + elections[i].end_date + "]" + "</option>"
                                                    }
                                                    let electionSelector = document.getElementById("election_id")
                                                    electionSelector.innerHTML = electionOptions;
                                                    electionSelector.value = "{{ $candidate->election_id }}";

                                                    populateParties();
                                                }
                                            };
                                            ajax.send();
                                        </script>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Candidate Party</label>
                                        <div class="col-sm-10">
                                            <select name="party" id="party" class="form-control round-input"
                                                oninput="this.setCustomValidity('')"
                                                oninvalid="this.setCustomValidity('Enter candidate party Name')"
                                                required style="width:80%;" onchange="updatePartyImage(this.value)">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Position</label>
                                        <div class="col-sm-10">
                                            <select name="position" id="position" class="form-control round-input"
                                                oninput="this.setCustomValidity('')"
                                                oninvalid="this.setCustomValidity('Select the position')" required
                                                style="width:80%;">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Party Image</label>
                                        <div class="col-lg-2 col-sm-2">
                                            <div class="follow-ava2" style="position: relative; left:50px;">
                                                <img id="party_img" src="{% static 'images/user.png' %}"
                                                    style="max-height:150px; max-width: 150px; min-width: 150px; min-height: 150px;
                                     border-top-left-radius: 50% 50%;
                                         border-top-right-radius: 50% 50%;
                                         border-bottom-left-radius: 50% 50%;
                                         border-bottom-right-radius: 50% 50%;">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="form-group">
                                        <label class="col-sm-2 control-label">Candidate Affidavit</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="affidavit" required accept="application/pdf"
                                                style="width:80%;">
                                        </div>
                                    </div> --}}
                                    <div class="form-group"
                                        style="display: flex;flex-direction: row;flex-wrap: nowrap;align-content: center;justify-content: center;align-items: center;">
                                        <div class="col-lg-12"
                                            style="display: flex;align-content: center;flex-direction: row;flex-wrap: nowrap;justify-content: center;align-items: center;">
                                            <button disabled id="btn-submit" class="btn btn-primary col-lg-12"
                                                type="submit">Update Candidate</button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{-- <div class="col-lg-offset-2 col-lg-10">
                                        {% for message in messages %}
                                        <h3 style="color: green;"> {{message}} </h3>
                                        {% endfor %}
                                    </div> --}}
                                    </div>
                                </form>
                                <form action="/delete-candidate" class="form-horizontal">
                                    <div class="form-group"
                                        style="display: flex;flex-direction: row;flex-wrap: nowrap;align-content: center;justify-content: center;align-items: center;">
                                        <div class="col-lg-12"
                                            style="display: flex;align-content: center;flex-direction: row;flex-wrap: nowrap;justify-content: center;align-items: center;">
                                            <input type="number" name="id_number" id="id_number"
                                                value="{{ $candidate->id_number }}" hidden>
                                            <button disabled id="btn-delete" class="btn btn-danger col-lg-12"
                                                type="submit">Delete Candidate</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </body>
</x-master-admin>
