<x-master-admin>
<body>
  <section id="main-content" style=" margin-right:110px;">
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
              <form class="form-horizontal" method="POST" action="generate_election">
                @csrf
                <!-- <div class="form-group">
                  <label class="col-sm-2 control-label">Election ID</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control round-input" required name="eno" id="eno" style="width:80%;">
                  </div>
                </div> -->
                <div class="form-group">
                  <label class="col-sm-2 control-label">Election Type</label>
                  <div class="col-sm-10">
                    <div class="btn-group open">
                      <select name="electiontype" id="electiontype" required class="form-control round-input"
                        style="width:100%;" onchange="selectElectionType(this.value)">
                        <option value="" selected="">-- ELECTION --</option>
                      </select>
                    </div>
                  </div>
                  <script>
                    getElections();

                    function getElections() {
                      var ajax = new XMLHttpRequest();
                      ajax.open("GET", "get_elections/", true);
                      ajax.onload = function () {
                        var list = JSON.parse(this.responseText);
                        var option = "<option value=''>-- ELECTION --</option>";
                        for (var i = 0; i < list.length; i++) {
                          option += "<option value='" + list[i][0] + "'>" + list[i][1] + "</option>";
                        }
                        document.getElementById("electiontype").innerHTML = option;
                      };
                      ajax.send();
                    }
                    function selectElectionType(electionTypeID) {
                      if (electionTypeID == 1) { // Bi election
                        document.getElementById("combo-province").hidden = false;
                        document.getElementById("combo-county").hidden = true;
                        document.getElementById("combo-constituency").hidden = true;
                      } else if (electionTypeID == 2) { // General election
                        document.getElementById("combo-province").hidden = true;
                        document.getElementById("combo-county").hidden = true;
                        document.getElementById("combo-constituency").hidden = true;
                      }
                    }
                  </script>
                </div>
                <div class="form-group" id="combo-province" hidden>
                  <label class="col-sm-2 control-label">Province</label>
                  <div class="col-sm-10">
                    <div class="btn-group open">
                      <select name="province" required class="form-control round-input" id="province"
                        style="width:100%;" onchange="selectedProvince(this.value)">
                      </select>
                    </div>
                    <script>
                      // window.onload = getProvinces("province");
                      var ajax = new XMLHttpRequest();
                      ajax.open("GET", "get_provinces/", true);
                      ajax.onload = function () {
                        var list = JSON.parse(this.responseText);
                        var option = "<option value=''>-- PROVINCE --</option>";
                        for (var i = 0; i < list.length; i++) {
                          option += "<option value='" + list[i]['province_id'] + "'>" + list[i]['province_name'] + "</option>";
                        }
                        document.getElementById("province").innerHTML = option;
                      };
                      ajax.send();

                      function selectedProvince(provinceID) {
                        if (provinceID == "") {
                          document.getElementById("combo-county").hidden = true;
                          document.getElementById("combo-constituency").hidden = true;
                          return;
                        }
                        var ajax = new XMLHttpRequest();
                        ajax.open("GET", "get_counties/?province_id=" + provinceID, true);
                        ajax.onload = function () {
                          var list = JSON.parse(this.responseText);
                          var option = "<option value=''>-- COUNTY --</option>";
                          for (var i = 0; i < list.length; i++) {
                            option += "<option value='" + list[i]['county_id'] + "'>" + list[i]['county_name'] + "</option>";
                          }
                          document.getElementById("county").innerHTML = option;
                          document.getElementById("combo-county").hidden = false;
                          document.getElementById("combo-constituency").hidden = true;
                        };
                        ajax.send();
                      }
                    </script>
                  </div>
                </div>
                <div class="form-group" id="combo-county" hidden>
                  <label class="col-sm-2 control-label">County</label>
                  <div class="col-sm-10">
                    <div class="btn-group open">
                      <select name="county" required class="form-control round-input" id="county" style="width:100%;" onchange="selectedCounty(this.value)">
                      </select>
                    </div>
                    <script>
                      var ajax = new XMLHttpRequest();
                      ajax.open("GET", "get_counties/", true);
                      ajax.onload = function () {
                        var list = JSON.parse(this.responseText);
                        var option = "<option value=''>-- County --</option>";
                        for (var i = 0; i < list.length; i++) {
                          option += "<option value='" + list[i]['county_id'] + "'>" + list[i]['county_name'] + "</option>";
                        }
                        document.getElementById("county").innerHTML = option;
                      };
                      ajax.send();

                      function selectedCounty(countyID){
                        if(countyID == ""){
                          document.getElementById("combo-constituency").hidden = true;
                          return;
                        }
                        var ajax = new XMLHttpRequest();
                        ajax.open("GET", "get_constituencies/?county_id=" + countyID, true);
                        ajax.onload = function () {
                          var list = JSON.parse(this.responseText);
                          var option = "<option value=''>-- CONSTITUENCY --</option>";
                          for (var i = 0; i < list.length; i++) {
                            option += "<option value='" + list[i]["constituency_id"] + "'>" + list[i]["constituency_name"] + "</option>";
                          }
                          document.getElementById("constituency").innerHTML = option;
                          document.getElementById("combo-constituency").hidden = false;
                        };
                        ajax.send();
                      }
                    </script>
                  </div>
                </div>
                <div class="form-group" id="combo-constituency" hidden>
                  <label class="col-sm-2 control-label">Constituency</label>
                  <div class="col-sm-10">
                    <div class="btn-group open">
                      <select name="constituency" required class="form-control round-input" id="constituency"
                        style="width:100%;">
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Start Date</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control round-input" required name="sdate" style="width:80%;">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Start Time</label>
                  <div class="col-sm-10">
                    <input type="time" class="form-control round-input" required name="stime" style="width:80%;">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">End Date</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control round-input" required name="edate" style="width:80%;">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">End Time</label>
                  <div class="col-sm-10">
                    <input type="time" class="form-control round-input" required name="etime" style="width:80%;">
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