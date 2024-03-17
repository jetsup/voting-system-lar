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

        function filterCandidates() {
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
            ajax.open("GET", "/data/view-candidates/" + queryTypeID + "/" + placeID);
            ajax.onload = function() {
                console.log("RES:", this.responseText, this.status);
                if (this.status == 200) {
                    let candidates = JSON.parse(this.responseText).candidates;
                    let divs = "";
                    for (let i = 0; i < candidates.length; i++) {
                        divs += `<div class="row" style="margin-bottom: 20px;"><div class="col-lg-12">
                            <div class="profile-widget profile-widget-info">
                                <div class="panel-body" style="background-color: #444d50;">
                                    <div class="col-lg-2 col-sm-2 mt-4">
                                        <div class="follow-ava">
                                            <a><img src="/storage/` + candidates[i].dp + `" alt=""
                                                    class="het-90"></a>
                                        </div>
                                        <p><strong> ` + candidates[i].first_name + ` ` + candidates[i].last_name + `</strong></p>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 follow-info">
                                        <p><strong>Province :</strong> ` + candidates[i].province + `</p>
                                        <p><strong>County:</strong> ` + candidates[i].county + `</p>
                                        <p><strong>Constituency:</strong> ` + candidates[i].constituency + `</p>
                                        <p><strong>Party :</strong> ` + candidates[i].party + `</p>
                                        <p><strong>Position :</strong> ` + candidates[i].position + `</p>
                                        {{-- <p><strong><a href="{{ 'candidate . affidavit . url' }}" target="_blank">Download
                                                    Affidavit</a></strong></p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`
                    }
                    document.getElementById("candidates-div").innerHTML = divs;
                }
            };
            ajax.send();
        }
    </script>

    <body>
        <section id="main-content" style="margin-right:120px;">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-file-text-o"></i>View Candidate</h3>
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i><a href="/">Home</a></li>
                            <li><i class="icon_document_alt"></i>Candidate</li>
                            <li><i class="fa fa-file-text-o"></i>View Candidate</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <div class="panel-body">
                                <div>
                                    <label class="col-sm-2 control-label">Province</label>
                                    <div class="col-sm-10">
                                        <select id="province" name="province" class="form-control"
                                            onchange="getCounties(this.value)" style="width:80%;" required>
                                        </select>
                                    </div>
                                    <script>
                                        // Fetch the database for the provinces using ajax
                                        var ajax = new XMLHttpRequest();
                                        ajax.open("GET", "/data/get-provinces", true);
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
                                        <select name="county" class="form-control" id="county"
                                            onchange="getConstituencies(this.value)"style="width:80%;" required>
                                        </select>
                                    </div>
                                </div>
                                <div style="margin-top: 120px">
                                    <label class="col-sm-2 control-label">Constituency</label>
                                    <div class="col-sm-10">
                                        <select name="constituency" class="form-control" id="constituency"
                                            style="width:80%;" required>
                                        </select>
                                    </div>
                                </div>
                                <div style="margin-top: 180px">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-primary" name="view_candidate" type="submit"
                                            onclick="filterCandidates()">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div id="candidates-div">
                </div>
                {{-- <div>
        {% for message in messages %}
        <h3 align="center">{{message}}</h3>
        {% endfor %}
    </div> --}}
            </section>
        </section>
    </body>
</x-master-admin>
