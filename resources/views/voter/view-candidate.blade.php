<x-master-voter>
    <script>
        // TODO: Take this functions to admin side
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
                getCandidates();
            };
            ajax.send();
        }

        function getCandidates() {
            let countyID = document.getElementById("county").value;
            if (countyID == "") {
                return;
            }
            let constituencyID = document.getElementById("constituency").value;
            // 1 - for county 2- for constituency
            let queryFor = 1;
            let placeID = countyID;
            if (constituencyID != "") {
                queryFor = 2;
                placeID = constituencyID;
            }
            let ajax = new XMLHttpRequest();
            ajax.open("GET", "/data/get-candidates/" + queryFor + "/" + placeID, true);
            ajax.onload = function() {
                if (this.status == 200) {
                    let candidates = JSON.parse(this.responseText).candidates;
                    console.log(candidates);

                    let tbody = document.getElementById("tbody-candidates");
                    let trData = "";

                    for (let i = 0; i < candidates.length; i++) {
                        trData += `<tr>
                            <td><img src=` + "storage/" + candidates[i].dp + ` alt="Candidate Image" width="10%" style="width: 40px"></td>
                            <td>` + candidates[i].first_name + " " + candidates[i].last_name + `</td>
                            <td>` + candidates[i].party + `</td>
                            <td><img src=` + "storage/" + candidates[i].party_image + ` alt="Candidate Image" width="10%" style="width: 40px"></td>
                            <td>` + candidates[i].position + `</td>
                            </tr>`
                    }
                    tbody.innerHTML = trData;
                }
            };
            ajax.send();
        }
    </script>

    <body>
        <section id="main-content" style="margin-left:0px;">
            <section class="wrapper" style="margin-top:60px;">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-file-text-o"></i>List of candidate</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            {{-- TODO: Migrate this to admin side --}}
                            {{-- <div class="panel-body">
                                <form class="form-horizontal" action="view-candidate" id="CandidateCustomFilter"
                                    method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Province</label>
                                        <div class="col-sm-10">
                                            <select id="province" name="province" class="form-control"
                                                style="width:80%;height:34px;" required
                                                onchange="getCounties(this.value)">
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
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">County</label>
                                        <div class="col-sm-10">
                                            <select name="county" class="form-control" id="county"
                                                onchange="getConstituencies(this.value)" style="width:80%;height:34px;">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Constituency</label>
                                        <div class="col-sm-10">
                                            <select name="constituency" class="form-control" id="constituency"
                                                style="width:80%;height:34px;" onchange="getCandidates()">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button class="btn btn-primary" name="view_candidate"
                                                type="submit">Filter</button>
                                        </div>
                                    </div>
                                </form>
                            </div> --}}

                            <div class="panel-body">
                                <table class="table">
                                    <thead>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Party</th>
                                        <th>Party Logo</th>
                                        <th>Position</th>
                                    </thead>

                                    <tbody id="tbody-candidates">
                                        @if ($candidates)
                                            @foreach ($candidates as $candidate)
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset('storage/' . $candidate->dp) }}"
                                                            alt="Candidate Image" width="10%" style="width: 40px">
                                                    </td>
                                                    <td>{{ $candidate->first_name }} {{ $candidate->last_name }}</td>
                                                    <td>{{ $candidate->party }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/' . $candidate->party_image) }}"
                                                            alt="Candidate Image" width="10%" style="width: 40px">
                                                    </td>
                                                    <td>{{$candidate->position}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </body>
</x-master-voter>
