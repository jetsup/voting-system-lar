<x-master-admin>
    <script>
        function getCounties(provinceID) {
            if (provinceID == "") {
                document.getElementById("county").innerHTML = "<option value=''>-- SELECT PROVINCE --</option>";
                document.getElementById("constituency").innerHTML = "<option value=''>-- SELECT COUNTY --</option>";
                return;
            }
            var ajax = new XMLHttpRequest();
            ajax.open("GET", "/data/get_counties/" + provinceID, true);
            ajax.onload = function() {
                var list = JSON.parse(this.responseText);
                var option = "";
                option += "<option value=''>-- COUNTY --</option>";
                for (var i = 0; i < list.length; i++) {
                    option += "<option value='" + list[i]['id'] + "'>" + list[i]['county'] + "</option>";
                }
                document.getElementById("county").innerHTML = option;
            };
            ajax.send();
        }

        function getConstituencies(countyID) {
            if (countyID == "") {
                document.getElementById("constituency").innerHTML = "<option value=''>-- SELECT COUNTY --</option>";
                return;
            }
            var ajax = new XMLHttpRequest();
            ajax.open("GET", "/data/get_constituencies/" + countyID, true);
            ajax.onload = function() {
                var list = JSON.parse(this.responseText);
                var option = "";
                option += "<option value=''>-- CONSTITUENCY --</option>";
                for (var i = 0; i < list.length; i++) {
                    option += "<option value='" + list[i]['id'] + "'>" + list[i]['constituency'] +
                        "</option>";
                }
                document.getElementById("constituency").innerHTML = option;
            };
            ajax.send();
        }

        function filterVoters() {
            let provinceVal = document.getElementById("province").value;
            if (!provinceVal) {
                return;
            }

            let countyVal = document.getElementById("county").value;
            let constituencyVal = document.getElementById("constituency").value;
            console.log("ELEMENT: ", provinceVal, countyVal, constituencyVal);
            /**
            send a request with an id for which query
            0 - province ONLY
            1 - province + county
            2 - province + county + constituency
            */
            let queryTypeID;
            let placeID;
            if (constituencyVal) {
                queryTypeID = 2;
                placeID = constituencyVal;
            } else {
                if (countyVal) {
                    queryTypeID = 1;
                    placeID = countyVal;
                } else {
                    queryTypeID = 0;
                    placeID = provinceVal;
                }
            }
            let ajax = new XMLHttpRequest();
            ajax.open("GET", "/data/view_voters/" + queryTypeID + "/" + placeID);
            ajax.onload = function() {
                console.log("RES:", this.responseText, this.status);
                if (this.status == 200) {
                    let voters = JSON.parse(this.responseText).voters;
                    // populate the table with the voters
                    let tbody = document.getElementById("voters-body");
                    let html = "";
                    for (let i = 0; i < voters.length; i++) {
                        html += "<tr>";
                        // html +=
                        //     "<td><img src=`getUserDP($dp)` alt='Image not found' height='150' width='180'></td>";
                        html += "<td>" + voters[i].id_number + "</td>";
                        if (voters[i].middle_name) {
                            html += "<td>" + voters[i].first_name + " " + voters[i].middle_name.charAt(0) + ". " +
                                voters[i].last_name + "</td>";
                        } else {
                            html += "<td>" + voters[i].first_name + " " + voters[i].last_name + "</td>";
                        }
                        var genderIcon = (voters[i].gender_id == 1) ? "fa-male" : "fa-female";
                        var gender = (voters[i].gender_id == 1) ? "MALE" : "FEMALE";
                        html += "<td><i class='fa " + genderIcon + "'></i> " + gender + "</td>";
                        html += "<td>" + voters[i].dob + "</td>";
                        html += "<td>" + voters[i].province + "</td>";
                        html += "<td>" + voters[i].county + "</td>";
                        html += "<td>" + voters[i].constituency + "</td>";
                        html += "<td>" + voters[i].ward + "</td>";
                        html += "</tr>";
                    }
                    tbody.innerHTML = html;
                }
            };
            ajax.send();
        }
    </script>

    <body>
        <!-- container section start -->
        <section id="main-content" style=" margin-right:110px;">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-file-text-o"></i>View Voter</h3>
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i>Home</li>
                            <li><i class="icon_document_alt"></i>Voter</li>
                            <li><i class="fa fa-file-text-o"></i>View Voter</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Voter
                            </header>
                            <div class="panel-body">
                                <div>
                                    <label class="col-sm-2 control-label">Province</label>
                                    <div class="col-sm-10">
                                        <select name="province" id="province" class="form-control round-input"
                                            style="width:80%;" required onchange="getCounties(this.value)">
                                        </select>
                                    </div>
                                    <script>
                                        // Fetch the database for the provinces using ajax
                                        var ajax = new XMLHttpRequest();
                                        ajax.open("GET", "/data/get_provinces", true);
                                        ajax.onload = function() {
                                            var list = JSON.parse(this.responseText);
                                            var option = "<option value=''>-- PROVINCE --</option>";
                                            for (var i = 0; i < list.length; i++) {
                                                option += "<option value='" + list[i]['id'] + "'>" + list[i]['province'] + "</option>";
                                            }
                                            document.getElementById("province").innerHTML = option;
                                        };
                                        ajax.send();
                                    </script>
                                </div>
                                <div style="margin-top: 60px">
                                    <label class="col-sm-2 control-label">County</label>
                                    <div class="col-sm-10">
                                        <select name="county" class="form-control round-input" style="width:80%;"
                                            id="county" onchange="getConstituencies(this.value)">
                                            <option value="">-- SELECT PROVINCE --</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="margin-top: 120px">
                                    <label class="col-sm-2 control-label">Constituency</label>
                                    <div class="col-sm-10">
                                        <select name="constituency_id" class="form-control round-input"
                                            style="width:80%;" id="constituency">
                                            <option value="">-- SELECT COUNTY --</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="margin-top: 180px">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-primary" id="btn-filter"
                                            onclick="filterVoters()">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                List of voter
                            </header>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            {{-- <th><i class="icon_camera_alt"></i> Voter Image</th> --}}
                                            <th><i class="icon_id"></i> ID Number</th>
                                            <th><i class="icon_profile"></i> Name</th>
                                            <th><img src="{{ asset('images/gender.png') }}"> Gender</th>
                                            <th><i class="icon_calendar"></i> Date of birth</th>
                                            <th><img src="{{ asset('images/parliament.png') }}"> Province</th>
                                            <th><img src="{{ asset('images/parliament1.png') }}"> County</th>
                                            <th><img src="{{ asset('images/assembly.png') }}">Constituency</th>
                                            <th><img src="{{ asset('images/assembly.png') }}">Ward</th>
                                        </tr>
                                    </thead>
                                    <tbody id="voters-body"></tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>
        <!-- page end-->
    </body>
</x-master-admin>
