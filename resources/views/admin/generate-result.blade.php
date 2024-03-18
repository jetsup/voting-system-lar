<x-master-admin>
    <script>
        function fetchResults() {
            let ajax = new XMLHttpRequest();
            ajax.open("GET", "/data/election-results", true);
            ajax.onload = function() {
                if (this.status == 200) {
                    let results = JSON.parse(this.responseText).results;
                }
            }
            ajax.send();
        }

        function filterType(electionValues) {
            let electionType = electionValues.split(" ")[1];
            console.log(electionType);
            if (electionType == 1) { // national election
                // display a filter by positions
                let ajax = new XMLHttpRequest();
                ajax.open("GET", "/data/get-positions", true);
                ajax.onload = function() {
                    if (this.status == 200) {
                        let positions = JSON.parse(this.responseText).positions;

                        let positionOptions = "";
                        for (let i = 0; i < positions.length; i++) {
                            positionOptions += "<option value='" + positions[i].id + "'>" + positions[i].position +
                                "</option>";
                        }
                        document.getElementById("position").innerHTML = positionOptions;
                    }
                };
                ajax.send();
            } else if (electionType == 2) { // bi election
                // display a filter by positions less president
                let ajax = new XMLHttpRequest();
                ajax.open("GET", "/data/get-positions", true);
                ajax.onload = function() {
                    if (this.status == 200) {
                        let positions = JSON.parse(this.responseText).positions;

                        let positionOptions = "";
                        for (let i = 1; i < positions.length; i++) {
                            positionOptions += "<option value='" + positions[i].id + "'>" + positions[i].position +
                                "</option>";
                        }
                        document.getElementById("position").innerHTML = positionOptions;
                        // populate places, the default is governor, populate counties
                        populatePlaces(2 /*less than 4 will populate counties*/ );
                    }
                };
                ajax.send();
            }
        }

        function populatePlaces(placeType) {
            let ajax = new XMLHttpRequest();
            ajax.open("GET", "/data/get-places/" + placeType, true);
            ajax.onload = function() {
                if (this.status == 200) {
                    let places = JSON.parse(this.responseText).places;

                    let placeOptions = "";
                    for (let i = 0; i < places.length; i++) {
                        placeOptions += "<option value='" + places[i].id + "'>" + places[i].name + "</option>";
                    }
                    document.getElementById("county").innerHTML = placeOptions;
                }
            };
            ajax.send();
        }
    </script>

    <body>
        <section id="main-content" style="margin-right: 10px;overflow: hidden">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-file-text-o"></i>Generate Result</h3>
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i>Home</li>
                            <li><i class="icon_document_alt"></i>Result</li>
                            <li><i class="fa fa-file-text-o"></i>Generate Result</li>
                        </ol>
                    </div>
                </div>
                <div class="row w-100">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Result
                            </header>
                            <div class="panel-body">
                                <div class="row">
                                    <div>
                                        <label class="col-sm-2 control-label">Election ID</label>
                                        <div class="col-sm-10">
                                            <select name="election-id" id="election-id" required
                                                class="form-control round-input" style="width:80%;"
                                                onchange="filterType(this.value)">
                                            </select>
                                        </div>
                                        <script>
                                            // Fetch the database for the election id using ajax
                                            function getElections() {
                                                var ajax = new XMLHttpRequest();
                                                ajax.open("GET", "/data/get-elections/1", true);
                                                ajax.onload = function() {
                                                    var list = JSON.parse(this.responseText).elections;
                                                    var option = "<option value=''>-- ELECTION ID --</option>";
                                                    for (var i = 0; i < list.length; i++) {
                                                        option += "<option value='" + list[i].id + " " + list[i].election_type + "'>" + list[i]
                                                            .type + " [" + list[i].start_date + " - " + list[i].end_date + "]" + "</option>";
                                                    }
                                                    document.getElementsByName("election-id")[0].innerHTML = option;
                                                };
                                                ajax.send();
                                            }
                                            getElections();
                                        </script>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 10px">
                                    <div>
                                        <label class="col-sm-2 control-label">Election Position</label>
                                        <div class="col-sm-4">
                                            <select name="position" id="position" required
                                                class="form-control round-input" style="width:80%;"
                                                onchange="filterPosition(this.value)">
                                            </select>
                                        </div>
                                    </div>

                                    <div>
                                        {{-- filter by county for now but can be narrowed down as desired --}}
                                        <label class="col-sm-2 control-label" style="margin-left: -40px">County</label>
                                        <div class="col-sm-4" style="margin-left: -100px">
                                            <select name="county" id="county" required
                                                class="form-control round-input" style="width:77%;"
                                                onchange="filterPosition(this.value)">
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 20px">
                                    <div>
                                        <div class="col-lg-offset-5 col-lg-10">
                                            <button class="btn btn-primary" onclick="fetchResults()">Fetch
                                                Result</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </body>
</x-master-admin>
