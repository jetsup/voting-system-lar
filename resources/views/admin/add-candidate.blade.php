<x-master-admin>
    <script>
        /*function DOB() {
        var lblError = document.getElementById("lblError");

        //Get the date from the TextBox.
        var dateString = document.getElementById("dob").value;
        var regex = /(((0|1)[0-9]|2[0-9]|3[0-1])\/(0[1-9]|1[0-2])\/((19|20)\d\d))$/;

        //Check whether valid dd/MM/yyyy Date Format.
        if (regex.test(dateString)) {
            var parts = dateString.split("/");
            var dtDOB = new Date(parts[1] + "/" + parts[0] + "/" + parts[2]);
            var dtCurrent = new Date();
            lblError.innerHTML = "Minimum age must be 18 years."
            if (dtCurrent.getFullYear() - dtDOB.getFullYear() < 18) {
                return false;
            }

            if (dtCurrent.getFullYear() - dtDOB.getFullYear() == 18) {

                //CD: 11/06/2018 and DB: 15/07/2000. Will turned 18 on 15/07/2018.
                if (dtCurrent.getMonth() < dtDOB.getMonth()) {
                    return false;
                }
                if (dtCurrent.getMonth() == dtDOB.getMonth()) {
                    //CD: 11/06/2018 and DB: 15/06/2000. Will turned 18 on 15/06/2018.
                    if (dtCurrent.getDate() < dtDOB.getDate()) {
                        return false;
                    }
                }
            }
            lblError.innerHTML = "";
            return true;
        } else {
            lblError.innerHTML = "Enter date in dd/mm/yyyy format ONLY."
            return false;
        }
    }*/
        function searchCandidate() {
            var ajax = new XMLHttpRequest();
            var candidateID = document.getElementById("cid").value;
            console.log("candidateID: " + candidateID);
            if (candidateID == "") {
                // set an error message
                document.getElementById("cid").style.borderColor = "red";
                document.getElementById("cid").setCustomValidity("Enter Candidate ID");
                return;
            }
            // include the csrf token in the ajax request
            var csrfToken = document.getElementsByName("csrfmiddlewaretoken")[0].value;
            var search_param = {
                "voter_id": candidateID
            };
            ajax.open("POST", "search_voter/", true);
            ajax.setRequestHeader("Content-type", "application/json; charset=utf-8");
            ajax.setRequestHeader("X-CSRFToken", csrfToken);
            ajax.onload = function() {
                var candidate = JSON.parse(this.responseText);
                console.log("candidate: " + Object.keys(candidate).length);
                console.log("candidate: " + Object.keys(candidate));
                if (Object.keys(candidate).length > 1) {
                    document.getElementById("name").value = candidate.first_name;
                    document.getElementById("fname").value = candidate.last_name;
                    document.getElementById("gender").value = candidate.gender.toUpperCase();
                    document.getElementById("dob").value = candidate.dob;
                    document.getElementById("address").value = candidate.address;
                    document.getElementById("mno").value = candidate.mobile_no;
                    document.getElementById("province").value = candidate.province;
                    document.getElementById("county").value = candidate.county;
                    document.getElementById("constituency").value = candidate.constituency;
                    document.getElementById("candidate_img").src = candidate.voter_image;
                    if (candidate.candidate) {
                        document.getElementById("submit_btn").disabled = true;
                    } else {
                        document.getElementById("submit_btn").disabled = false;
                    }
                    document.getElementById("reset_btn").disabled = false;
                } else {
                    document.getElementById("addCandidateForm").reset();
                    document.getElementById("reset_btn").disabled = true;
                    document.getElementById("cid").value = candidateID;
                    //Alpine.data['your-popup-id'].message = candidate.error;
                    console.log(candidate.error);
                    // Alpine.data['your-popup-id'].showMessage = true;
                    // Alpine.store('err', { showMessage: true, message: candidate.error });
                    var data = Alpine.data(document.querySelector('[x-data]'));
                    var element = document.getElementById("custom-popup");
                    console.log(element.getAttribute("id"));
                    console.log(Alpine.data(element).message);
                    // Update the showMessage property
                    data.showMessage = true;

                    // You can also set a timeout to hide the message after a certain duration
                    setTimeout(() => {
                        data.showMessage = false;
                    }, 3000);
                }
            };
            ajax.send(JSON.stringify(search_param));
        }
        // Alpine.start();
    </script>

    <body>
        <section id="main-content">
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
                                <form id="addCandidateForm" class="form-horizontal " action="add_candidate"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Candidate ID Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control round-input" name="cid"
                                                id="cid" required minlength="6" maxlength="8"
                                                style="width:80%;">
                                            <br>
                                            <input type="button" class="btn btn-primary" value="Search Candidate"
                                                onclick="searchCandidate()">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Candidate Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly name="name" id="name"
                                                class="form-control round-input" style="width:80%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Father Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly required name="fname" id="fname"
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
                                            <input type="text" readonly name="dob" id="dob"
                                                style="width:80%;" class="form-control round-input">
                                            <span class="error" id="lblError"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Address</label>
                                        <div class="col-sm-10">
                                            <textarea readonly required name="address" id="address" class="form-control round-input" style="width:80%;"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Mobile Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly style="width:80%;" name="mno"
                                                id="mno" class="form-control round-input">
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
                                                class="form-control round-input" style="width:80%;"
                                                id="constituency">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Candidate Image</label>
                                        <div class="col-lg-2 col-sm-2">
                                            <div class="follow-ava2" style="position: relative; left:50px;">
                                                <img id="candidate_img" src="{% static 'images/user.png' %}"
                                                    style="max-height:150px; max-width: 150px; min-width: 150px; min-height: 150px;
                                     border-top-left-radius: 50% 50%;
                                         border-top-right-radius: 50% 50%;
                                         border-bottom-left-radius: 50% 50%;
                                         border-bottom-right-radius: 50% 50%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Candidate Party</label>
                                        <div class="col-sm-10">
                                            <select name="party" id="party" class="form-control round-input"
                                                oninput="this.setCustomValidity('')"
                                                oninvalid="this.setCustomValidity('Enter candidate party Name')"
                                                required style="width:80%;">
                                            </select>
                                        </div>
                                        <script>
                                            var ajax = new XMLHttpRequest();
                                            ajax.open("GET", "get_parties/", true);
                                            ajax.onload = function() {
                                                var partiesList = JSON.parse(this.responseText);
                                                var option = "<option value=''>-- SELECT PARTY --</option>";
                                                for (var i = 0; i < partiesList.length; i++) {
                                                    option += "<option value='" + partiesList[i][0] + "'>" + partiesList[i][1] + "</option>";
                                                }
                                                document.getElementById("party").innerHTML = option;
                                            }
                                            ajax.send();
                                        </script>
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
                                        <script>
                                            var ajax = new XMLHttpRequest();
                                            ajax.open("GET", "get_positions/", true);
                                            ajax.onload = function() {
                                                var positionsList = JSON.parse(this.responseText);
                                                var option = "<option value=''>-- SELECT POSITION --</option>";
                                                for (var i = 0; i < positionsList.length; i++) {
                                                    option += "<option value='" + positionsList[i][0] + "'>" + positionsList[i][1] + "</option>";
                                                }
                                                document.getElementById("position").innerHTML = option;
                                            }
                                            ajax.send();
                                        </script>
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
                                        <div class="col-sm-10">
                                            <input type="file" required accept="image/*" name="party_img"
                                                onchange="loadfile1(event)" style="position: relative; left: 90px;">
                                            <script>
                                                var loadfile1 = function(event) {
                                                    var output = document.getElementById('party_img');
                                                    output.src = URL.createObjectURL(event.target.files[0]);
                                                    output.onload = function() {
                                                        URL.revokeObjectURL(output.src)
                                                    }
                                                };
                                            </script>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Candidate Affidavit</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="affidavit" required accept="application/pdf"
                                                style="width:80%;">
                                        </div>
                                    </div>
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
