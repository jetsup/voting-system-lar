{{-- {% extends 'admin/master.html' %} --}}
<x-master-admin>
    <script>
        function getCounties(provinceID) {
            if (provinceID == "") {
                document.getElementById("county").innerHTML = "<option value=''>-- SELECT PROVINCE --</option>";
                document.getElementById("constituency").innerHTML = "<option value=''>-- SELECT COUNTY --</option>";
                return;
            }
            var ajax = new XMLHttpRequest();
            ajax.open("GET", "get_counties/?province_id=" + provinceID, true);
            ajax.onload = function() {
                var list = JSON.parse(this.responseText);
                var option = "";
                option += "<option value=''>-- COUNTY --</option>";
                for (var i = 0; i < list.length; i++) {
                    option += "<option value='" + list[i]['county_id'] + "'>" + list[i]['county_name'] + "</option>";
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
            ajax.open("GET", "get_constituencies/?county_id=" + countyID, true);
            ajax.onload = function() {
                var list = JSON.parse(this.responseText);
                var option = "";
                option += "<option value=''>-- CONSTITUENCY --</option>";
                for (var i = 0; i < list.length; i++) {
                    option += "<option value='" + list[i]['constituency_id'] + "'>" + list[i]['constituency_name'] +
                        "</option>";
                }
                document.getElementById("constituency").innerHTML = option;
            };
            ajax.send();
        }
    </script>

    <body>
        <!--header start-->

        <!--main content start-->
        <section id="main-content" style=" margin-right:110px;">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-file-text-o"></i>Add voter</h3>
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i>Home</li>
                            <li><i class="icon_document_alt"></i>Voter</li>
                            <li><i class="fa fa-file-text-o"></i>Add Voter</li>
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
                                <form class="form-horizontal" method="post" enctype="multipart/form-data"
                                    action="add_voter">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Voter Image</label>
                                        <div class="col-lg-2 col-sm-2">
                                            <div class="follow-ava2" style="position: relative; left:50px;">
                                                <img id="output" src="{{ asset('images/user2.png') }}"
                                                    alt="Upload Image"
                                                    style="max-height:150px; max-width: 150px; min-width: 150px; min-height: 150px;
                                border-top-left-radius: 50% 50%;
                                    border-top-right-radius: 50% 50%;
                                    border-bottom-left-radius: 50% 50%;
                                    border-bottom-right-radius: 50% 50%;">
                                            </div>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="file" required accept="image/*" name="vphoto"
                                                onchange="loadfile(event)" style="position: relative; left: 90px;">
                                            <script>
                                                var loadfile = function(event) {
                                                    var output = document.getElementById('output');
                                                    output.src = URL.createObjectURL(event.target.files[0]);
                                                    output.onload = function() {
                                                        URL.revokeObjectURL(output.src)
                                                    }
                                                };
                                            </script>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Voter ID</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control round-input" name="vid"
                                                required maxlength="8" pattern="^[0-9]{6,8}$"
                                                onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
                        if(this.checkValidity()) form.pwd2.pattern = RegExp.escape(this.value);"
                                                title="Only A-Z and 0-9 allowed minimum 10 characters"
                                                style="width:80%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" required
                                                class="form-control round-input" oninput="this.setCustomValidity('')"
                                                oninvalid="this.setCustomValidity('Enter Name')" style="width:80%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Father Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" required name="fname"
                                                class="form-control round-input" oninput="this.setCustomValidity('')"
                                                oninvalid="this.setCustomValidity('Enter Father Name')"
                                                style="width:80%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Gender</label>
                                        <div class="col-sm-10">
                                            <select name="gender" class="form-control round-input" required
                                                style="width:80%;">
                                                <option selected value="">Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Date of Birth</label>
                                        <div class="col-sm-10">
                                            <input type="date" required name="dob" id="dob"
                                                placeholder="For example: 02/04/1998" style="width:80%;"
                                                class="form-control round-input">
                                            <span class="error" id="lblError"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Address</label>
                                        <div class="col-sm-10">
                                            <textarea required name="address" class="form-control round-input" style="width:80%;"></textarea>
                                        </div>
                                    </div>
                                    <!-- TODO: This will actually change to password -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Pincode</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="pincode" required maxlength="6"
                                                pattern="[0-9]{6}$" class="form-control round-input" style="width:80%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Verify Pincode</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="pincode-confirmation" required
                                                maxlength="6" pattern="[0-9]{6}$" class="form-control round-input"
                                                style="width:80%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Mobile Number</label>
                                        <div class="col-sm-10">
                                            <input type="tel" pattern="^0[17]\d{8}$"
                                                oninput="this.setCustomValidity('')" style="width:80%;"
                                                oninvalid="this.setCustomValidity('Enter your Number')" required
                                                maxlength="10" name="mno" id="mno"
                                                class="form-control round-input">
                                        </div>
                                    </div>
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
                                            ajax.open("GET", "get_provinces/", true);
                                            ajax.onload = function() {
                                                var list = JSON.parse(this.responseText);
                                                var option = "<option value=''>-- PROVINCE --</option>";
                                                for (var i = 0; i < list.length; i++) {
                                                    option += "<option value='" + list[i]['province_id'] + "'>" + list[i]['province_name'] + "</option>";
                                                }
                                                document.getElementById("province").innerHTML = option;
                                            };
                                            ajax.send();
                                        </script>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">County</label>
                                        <div class="col-sm-10">
                                            <select name="county" class="form-control round-input"
                                                style="width:80%;" required id="county"
                                                onchange="getConstituencies(this.value)">
                                                <option value="">-- SELECT PROVINCE --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Assembly Constituency</label>
                                        <div class="col-sm-10">
                                            <select name="constituency" class="form-control round-input"
                                                style="width:80%;" id="constituency">
                                                <option value="">-- SELECT COUNTY --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                            <button class="btn btn-default" type="reset">Reset</button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <!-- TODO: Replace this with alpineJS bubble popup -->
                                            {{-- {% for message in messages %}
                                        <h3 style="color: green;"> {{message}} </h3>
                                        {% endfor %} --}}
                                        </div>
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
