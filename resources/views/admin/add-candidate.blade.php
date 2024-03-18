<x-master-admin>
    <script>
        function searchCandidate() {
            let candidateID = document.getElementById("id_number").value;
            console.log("candidateID: " + candidateID);
            if (!candidateID) {
                // set an error message
                document.getElementById("id_number").style.borderColor = "red";
                document.getElementById("id_number").setCustomValidity("Enter Candidate ID");
                return;
            }

            var ajax = new XMLHttpRequest();
            ajax.open("GET", "/search-voter/" + candidateID, true);
            ajax.onload = function() {
                let candidate = JSON.parse(this.responseText).voter;
                console.log("candidate1: ", candidate);
                if (candidate) {
                    let middleName = (candidate.middle_name) ? " " + candidate.middle_name.charAt(0) + ". " : " ";
                    document.getElementById("name").value = candidate.first_name + middleName + candidate.last_name;
                    document.getElementById("gender").value = (candidate.gender_id == 1) ? "MALE" : "FEMALE";
                    document.getElementById("dob").value = candidate.dob;
                    document.getElementById("phone").value = candidate.phone;
                    document.getElementById("province").value = candidate.province;
                    document.getElementById("county").value = candidate.county;
                    document.getElementById("constituency").value = candidate.constituency;
                    document.getElementById("constituency").value = candidate.ward;
                    document.getElementById("candidate_img").src = "/storage/" + candidate.dp;
                    if (candidate.candidate) {
                        document.getElementById("submit_btn").disabled = true;
                    } else {
                        document.getElementById("submit_btn").disabled = false;
                    }
                    document.getElementById("reset_btn").disabled = false;
                    populateElections();
                } else {
                    document.getElementById("addCandidateForm").reset();
                    document.getElementById("reset_btn").disabled = true;
                    document.getElementById("id_number").value = candidateID;
                    //Alpine.data['your-popup-id'].message = candidate.error;
                    // console.log("ERR", candidate.error);
                    // Alpine.data['your-popup-id'].showMessage = true;
                    // Alpine.store('err', { showMessage: true, message: candidate.error });
                    // var data = Alpine.data(document.querySelector('[x-data]'));
                    // var element = document.getElementById("custom-popup");
                    // console.log(element.getAttribute("id"));
                    // console.log(Alpine.data(element).message);
                    // Update the showMessage property
                    // data.showMessage = true;

                    // You can also set a timeout to hide the message after a certain duration
                    // setTimeout(() => {
                    //     data.showMessage = false;
                    // }, 3000);
                }
            };
            ajax.send();
        }

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
            ajax.open("GET", "/data/get-elections/1", true);
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
                            <li><i class="fa fa-file-text-o"></i>Add Candidate</li>
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
                                <form id="addCandidateForm" class="form-horizontal " action="/add-candidate"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Candidate ID Number</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control round-input" name="id_number"
                                                id="id_number" required minlength="6" maxlength="8"
                                                style="width:80%;">
                                            <br>
                                            <input type="button" class="btn btn-primary" value="Search Candidate"
                                                onclick="searchCandidate()">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Full Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly name="name" id="name"
                                                class="form-control round-input" style="width:80%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Gender</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly name="gender" id="gender"
                                                class="form-control round-input" style="width:80%;">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Birth Date</label>
                                        <div class="col-sm-10">
                                            <input type="date" readonly name="dob" id="dob"
                                                style="width:80%;" class="form-control round-input">
                                            <span class="error" id="lblError"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Mobile Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly style="width:80%;" name="phone"
                                                id="phone" class="form-control round-input">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Province</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly name="province" id="province"
                                                class="form-control round-input" style="width:80%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">County</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly name="county" id="county"
                                                class="form-control round-input" style="width:80%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Constituency</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly name="constituency"
                                                class="form-control round-input" style="width:80%;" id="constituency">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Candidate Image</label>
                                        <div class="col-lg-2 col-sm-2">
                                            <div class="follow-ava2" style="position: relative; left:50px;">
                                                <img id="candidate_img"
                                                    src="{{ asset('storage/images/dp/user.png') }}"
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
                                            <select name="election_id" id="election_id"
                                                class="form-control round-input" oninput="this.setCustomValidity('')"
                                                oninvalid="this.setCustomValidity('Provide which election the candidate is running')"
                                                required style="width:80%;" onchange="populateParties(this.value)">
                                            </select>
                                        </div>
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
                                                <img id="party_img" src="{{ asset('storage/images/elections/political_parties.jpg') }}"
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
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button disabled id="submit_btn" class="btn btn-primary"
                                                type="submit">Add
                                                Candidate</button>
                                            <button disabled id="reset_btn" class="btn btn-default"
                                                type="reset">Reset</button>
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
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </body>
</x-master-admin>
