<x-master-admin>
    <script>
        function selectElectionType(electionTypeID) {
            if (electionTypeID == 1) {
                // national
                document.getElementById("province-div").hidden = true;
                document.getElementById("county-div").hidden = true;
                document.getElementById("constituency-div").hidden = true;
            } else {
                // bi
                document.getElementById("province-div").hidden = false;
                document.getElementById("county-div").hidden = false;
                document.getElementById("constituency-div").hidden = false;

                populateProvinces();
            }
        }

        function populateProvinces() {
            let ajax = new XMLHttpRequest();
            ajax.open("GET", "/data/get-provinces", true);
            ajax.onload = function() {
                if (this.status == 200) {
                    var list = JSON.parse(this.responseText);
                    var option = "<option value=''>-- PROVINCE --</option>";
                    for (var i = 0; i < list.length; i++) {
                        option += "<option value='" + list[i]['id'] + "'>" + list[i]['province'] + "</option>";
                    }
                    document.getElementById("province").innerHTML = option;
                }
            };
            ajax.send();
        }

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

        function validateInputs() {
            if (document.getElementById("election-type").value == 1) {
                document.getElementById("province").required = false;
                document.getElementById("county").required = false;
            } else if (document.getElementById("election-type").value == 2) {
                document.getElementById("province").required = true;
                document.getElementById("county").required = true;
            }
        }
    </script>

    <body>
        <section id="main-content" style=" margin-right:120px;">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-file-text-o"></i>Generate Election</h3>
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i>Home</li>
                            <li><i class="icon_document_alt"></i>Election</li>
                            <li><i class="fa fa-file-text-o"></i>Generate Election</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Election
                            </header>
                            <div class="panel-body">
                                <form class="form-horizontal" method="POST" action="/generate-election"
                                    onsubmit="validateInputs()">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Election Type</label>
                                        <div class="col-sm-10">
                                            <select name="election-type" id="election-type" required
                                                class="form-control round-input" style="width:80%;"
                                                onchange="selectElectionType(this.value)">
                                                <option value="" selected="">-- SELECT ELECTION TYPE --
                                                </option>
                                            </select>
                                        </div>
                                        <script>
                                            var ajax = new XMLHttpRequest();
                                            ajax.open("GET", "/data/get-election-types", true);
                                            ajax.onload = function() {
                                                var list = JSON.parse(this.responseText).electionTypes;
                                                var option = "<option value=''>-- SELECT ELECTION TYPE --</option>";
                                                for (var i = 0; i < list.length; i++) {
                                                    option += "<option value='" + list[i].id + "'>" + list[i].election_type + "</option>";
                                                }
                                                document.getElementById("election-type").innerHTML = option;
                                            };
                                            ajax.send();
                                        </script>
                                    </div>

                                    <div class="form-group" id="province-div" hidden>
                                        <label class="col-sm-2 control-label">Province</label>
                                        <div class="col-sm-10">
                                            <select name="province" class="form-control round-input" id="province"
                                                style="width:80%;" onchange="getCounties(this.value)">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group" id="county-div" hidden>
                                        <label class="col-sm-2 control-label">County</label>
                                        <div class="col-sm-10">
                                            <select name="county" class="form-control round-input" id="county"
                                                style="width:80%;" onchange="getConstituencies(this.value)">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group" id="constituency-div" hidden>
                                        <label class="col-sm-2 control-label">Constituency</label>
                                        <div class="col-sm-10">
                                            <select name="constituency" class="form-control round-input"
                                                id="constituency" style="width:80%;">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Start Date</label>
                                        <div class="col-sm-10">
                                            <input type="datetime-local" class="form-control round-input"
                                                min="{{ Carbon\Carbon::now()->addDay()->startOfDay()->addHours(7) }}"
                                                required name="start-date" style="width:80%;">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">End Date</label>
                                        <div class="col-sm-10">
                                            <input type="datetime-local"
                                                class="form-control round-input"min="{{ Carbon\Carbon::now()->addDays(2)->startOfDay()->addHours(7) }}"
                                                required name="end-date" style="width:80%;">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button class="btn btn-primary" type="submit">Generate Election</button>
                                            <button class="btn btn-default" type="reset">Reset</button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{-- <div class="col-lg-offset-2 col-lg-10">
                    {% for message in messages %}
                    <h3> {{message}} </h3>
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
