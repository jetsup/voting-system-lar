<x-master-voter>
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
        <section id="main-content" style="margin-left:0px;margin-top: 60px;">
            <section class="wrapper" style="margin-top:60px;">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-file-text-o"></i>List of candidate</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <div class="panel-body">
                                <form class="form-horizontal" action="vview_candidate" id="CandidateCustomFilter"
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
                                            <select name="county" class="form-control" id="county"
                                                onchange="getConstituencies(this.value)" style="width:80%;height:34px;">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Constituency</label>
                                        <div class="col-sm-10">
                                            <select name="constituency" class="form-control" id="constituency"
                                                style="width:80%;height:34px;">
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
                            </div>
                        </section>
                    </div>
                </div>
                {{-- {% for candidate in candidates %}
      <div class="row">
        <div class="col-lg-12">
          <div class="profile-widget profile-widget-info">
            <div class="panel-body" style="background-color: rgba(6, 12, 34, 0.98);">
              <div class="col-lg-2 col-sm-2 mt-4">
                <div class="follow-ava">
                  <a><img src="{{candidate.candidate_identity.voter_image.url}}" alt="" class="het-90"></a>
                </div>
                <p><strong>{{candidate.name}}</strong></p>
              </div>
              <div class="col-lg-4 col-sm-4 follow-info">
                <p><strong>Province :</strong> {{candidate.candidate_identity.province_id|get_province}}</p>
                <p><strong>County:</strong> {{candidate.candidate_identity.county_id|get_county}}</p>
                <p><strong>Constituency:</strong> {{candidate.candidate_identity.constituency_id|get_constituency}}</p>
                <p><strong>Party :</strong> {{candidate.candidate_party_id|get_party}}</p>
                <p><strong><a href="{{candidate.affidavit.url}}" target="_blank">Download Affidavit</a></strong></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      {% endfor %} --}}
                {{-- <div>
        {% for message in messages %}
        <h3 align="center">{{message}}</h3>
        {% endfor %}
      </div> --}}
            </section>
        </section>
    </body>
</x-master-voter>
