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
                                <form class="form-horizontal" method="post" action="/data/view_voters"
                                    id="CandidateCustomFilter">
                                    @csrf
                                    <div class="form-group">
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
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">County</label>
                                        <div class="col-sm-10">
                                            <select name="county" class="form-control round-input" style="width:80%;"
                                                required id="county" onchange="getConstituencies(this.value)">
                                                <option value="">-- SELECT PROVINCE --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Constituency</label>
                                        <div class="col-sm-10">
                                            <select name="constituency_id" class="form-control round-input"
                                                style="width:80%;" id="constituency">
                                                <option value="">-- SELECT COUNTY --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button class="btn btn-primary" name="view_voter"
                                                type="submit">Filter</button>
                                        </div>
                                    </div>
                                </form>
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
                                    <tbody>
                                        <tr>
                                            <th><i class="icon_camera_alt"></i>photo</th>
                                            <th><i class="icon_id"></i> voter ID</th>
                                            <th><i class="icon_profile"></i> Full Name</th>
                                            <th><img src="{% static 'images/gender.png' %}"> Gender</th>
                                            <th><i class="icon_calendar"></i> Date of birth</th>
                                            <th><img src="{% static 'images/parliament.png' %}"> State</th>
                                            <th><img src="{% static 'images/parliament1.png' %}"> Parliamentary</th>
                                            <th><img src="{% static 'images/assembly.png' %}">Assembly</th>
                                        </tr>
                                        {{-- @foreach ($voters as $voter)
                                            <tr>
                                                <td><img src="{{ 'voter.jpg' }}" alt="Image not found"
                                                        height="150" width="180"></td> --}}
                                        {{-- <td>{{ voter . voterid_no }}</td>
                                            <td>{{ voter . name }}</td>
                                            <td>{{ voter . gender }}</td>
                                            <td>{{ voter . dateofbirth }}</td>
                                            <td>{{ voter . state }}</td>
                                            <td>{{ voter . parliamentary }}</td>
                                            <td>{{ voter . assembly }}</td> --}}
                                        {{-- </tr>
                                        @endforeach --}}
                                    </tbody>
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
