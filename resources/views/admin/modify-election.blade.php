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
            selectElectionType(document.getElementById("election-type").value);
        }

        function electionStatusChanged() {}

        function getElectionDetails(electionID) {
            let ajax = new XMLHttpRequest();
            ajax.open("GET", "/data/get-election-details/" + electionID, true);
            ajax.onload = function() {
                if (this.status == 200) {
                    let response = JSON.parse(this.responseText);
                    let election = response.election;
                    let electionTypes = response.electionTypes;
                    console.log(election, electionTypes);

                    let optionElectionTypes = "";
                    for (let i = 0; i < electionTypes.length; i++) {
                        optionElectionTypes += "<option value='" + electionTypes[i].id + "'>" +
                            electionTypes[i].election_type + "</option>"
                    }
                    document.getElementById("election-type").innerHTML = optionElectionTypes;
                    document.getElementById("election-type").value = election.election_type;
                    document.getElementById("election-status").value = election.election_status;
                    let startDateElement = document.getElementById("start-date");
                    let endDateElement = document.getElementById("end-date");

                    // remove readonly
                    startDateElement.removeAttribute("readonly");
                    endDateElement.removeAttribute("readonly");

                    // Parse the datetime string into a Date object
                    var datetime = new Date(election.start_date);
                    // Extract date components
                    var year = datetime.getFullYear();
                    var month = ("0" + (datetime.getMonth() + 1)).slice(-2); // Months are zero based
                    var day = ("0" + datetime.getDate()).slice(-2);
                    // Extract time components
                    var hours = ("0" + datetime.getHours()).slice(-2);
                    var minutes = ("0" + datetime.getMinutes()).slice(-2);
                    // Formatted datetime string without seconds
                    var formattedDatetime = year + "-" + month + "-" + day + " " + hours + ":" + minutes;
                    startDateElement.value = year + "-" + month + "-" + day + "T" + hours + ":" + minutes;

                    var datetime = new Date(election.end_date);
                    // Extract date components
                    var year = datetime.getFullYear();
                    var month = ("0" + (datetime.getMonth() + 1)).slice(-2); // Months are zero based
                    var day = ("0" + datetime.getDate()).slice(-2);
                    // Extract time components
                    var hours = ("0" + datetime.getHours()).slice(-2);
                    var minutes = ("0" + datetime.getMinutes()).slice(-2);
                    // Formatted datetime string without seconds
                    var formattedDatetime = year + "-" + month + "-" + day + " " + hours + ":" + minutes;
                    endDateElement.value = year + "-" + month + "-" + day + "T" + hours + ":" + minutes;

                    validateInputs();
                }
            };
            ajax.send();
        }
    </script>

    <body>
        <!-- container section start -->
        <section id="container" class="">
            <!--header start-->
            <!--main content start-->
            <section id="main-content" style=" margin-right:120px;">
                <section class="wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header"><i class="fa fa-file-text-o"></i>Modify Election</h3>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-home"></i>Home</li>
                                <li><i class="icon_document_alt"></i>Election</li>
                                <li><i class="fa fa-pencil"></i>Modify Election</li>
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
                                    <form class="form-horizontal " method="POST" action="/modify-election">
                                        @csrf
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Election ID</label>
                                            <div class="col-sm-10">
                                                <select name="election-id" required class="form-control round-input"
                                                    style="width:80%;" onchange="getElectionDetails(this.value)">
                                                </select>
                                            </div>
                                            <script>
                                                // Fetch the database for the election id using ajax
                                                var ajax = new XMLHttpRequest();
                                                ajax.open("GET", "/data/get-elections/0"/*upcoming|ongoing can be edited*/, true);
                                                ajax.onload = function() {
                                                    var list = JSON.parse(this.responseText).elections;
                                                    var option = "<option value=''>-- ELECTION ID --</option>";
                                                    for (var i = 0; i < list.length; i++) {
                                                        option += "<option value='" + list[i].id + "'>"+ list[i].type+ " [" + list[i].start_date + " - " + list[i].end_date + "]" + "</option>";
                                                    }
                                                    document.getElementsByName("election-id")[0].innerHTML = option;
                                                };
                                                ajax.send();
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Election Type</label>
                                            <div class="col-sm-10">
                                                <select name="election-type" id="election-type" required
                                                    class="form-control round-input" style="width:80%;"
                                                    onchange="validateInputs()">
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Election Status</label>
                                            <div class="col-sm-10">
                                                <select name="election-status" id="election-status" required
                                                    class="form-control round-input" style="width:80%;"
                                                    onchange="electionStatusChanged()">
                                                </select>
                                            </div>
                                            <script>
                                                function populateElectionStatus() {
                                                    let ajax = new XMLHttpRequest();
                                                    ajax.open("GET", "/data/election-statuses", true);
                                                    ajax.onload = function() {
                                                        if (this.status == 200) {
                                                            let statuses = JSON.parse(this.responseText).statuses;

                                                            let statusOptions = "";
                                                            for (let i = 0; i < statuses.length; i++) {
                                                                statusOptions += "<option value='" + statuses[i].id + "'>" +
                                                                    statuses[i].election_status + "</option>"
                                                            }
                                                            document.getElementById("election-status").innerHTML = statusOptions;
                                                        }
                                                    };
                                                    ajax.send();
                                                }
                                                populateElectionStatus();
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
                                                <input type="datetime-local" name="start-date" id="start-date"
                                                    value="" readonly class="form-control round-input"
                                                    style="width:80%;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">End Date</label>
                                            <div class="col-sm-10">
                                                <input type="datetime-local" name="end-date" id="end-date"
                                                    value="" readonly class="form-control round-input"
                                                    style="width:80%;">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <button class="btn btn-primary" type="submit">Modify Election</button>
                                                <button class="btn btn-default" type="reset">Reset</button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{-- <div class="col-lg-offset-2 col-lg-10">
                                                {% for message in messages %}
                                                <h3> {{ message }} </h3>
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
        </section>
    </body>
</x-master-admin>
