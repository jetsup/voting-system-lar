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
        <!--header start-->

        <!--main content start-->
        <section id="main-content" style=" margin-right:120px;">
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
                                    action="/add_voter">
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
                                            <input type="file" required accept="image/*" name="dp"
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
                                        <label class="col-sm-2 control-label">ID Number</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control round-input" name="id_number"
                                                required min-length="6" max-length="8" pattern="^[0-9]{6,8}$"
                                                onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
                        if(this.checkValidity()) form.pwd2.pattern = RegExp.escape(this.value);"
                                                title="Only A-Z and 0-9 allowed minimum 10 characters"
                                                style="width:80%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">First Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="first_name" minlength="3" required
                                                class="form-control round-input" oninput="this.setCustomValidity('')"
                                                oninvalid="this.setCustomValidity('Enter First Name')"
                                                style="width:80%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Last Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" required name="last_name" minlength="3"
                                                class="form-control round-input" oninput="this.setCustomValidity('')"
                                                oninvalid="this.setCustomValidity('Enter Last Name')"
                                                style="width:80%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Middle Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="middle_name" minlength="3"
                                                class="form-control round-input" oninput="this.setCustomValidity('')"
                                                oninvalid="this.setCustomValidity('Enter Middle Name')"
                                                style="width:80%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Gender</label>
                                        <div class="col-sm-10">
                                            <select name="gender_id" class="form-control round-input" required
                                                style="width:80%;">
                                                <option selected value="">Gender</option>
                                                <option value="1">Male</option>
                                                <option value="2">Female</option>
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
                                    {{-- <div class="form-group">
                                        <label class="col-sm-2 control-label">Address</label>
                                        <div class="col-sm-10">
                                            <textarea required name="address" class="form-control round-input" style="width:80%;"></textarea>
                                        </div>
                                    </div> --}}
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Mobile Number</label>
                                        <div class="col-sm-10">
                                            <input type="tel" pattern="^0[17]\d{8}$"
                                                oninput="this.setCustomValidity('')" style="width:80%;"
                                                oninvalid="this.setCustomValidity('Enter your Number')" required
                                                maxlength="10" name="phone" id="phone"
                                                placeholder="07xxxxxxxx/01xxxxxxxx" class="form-control round-input">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" oninput="this.setCustomValidity('')"
                                                style="width:80%;"
                                                oninvalid="this.setCustomValidity('Enter your Email address')" required
                                                name="email" id="email" placeholder="someone@example.com"
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
                                            <select name="county" class="form-control round-input"
                                                style="width:80%;" required id="county"
                                                onchange="getConstituencies(this.value)">
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
                                        <label class="col-sm-2 control-label">Ward</label>
                                        <div class="col-sm-10">
                                            <input type="text" oninput="this.setCustomValidity('')"
                                                style="width:80%;"
                                                oninvalid="this.setCustomValidity('Provide your Ward')" required
                                                minlength="4" name="ward" id="ward"
                                                placeholder="eg. Starehe" class="form-control round-input">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Account Type</label>
                                        <div class="col-sm-10">
                                            <select name="user_type_id" class="form-control round-input" required
                                                style="width:80%;">
                                                <option value="2">Voter</option>
                                                <option value="1">Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- TODO: This will actually change to password -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password" required minlength="8"
                                                class="form-control round-input" style="width:80%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Password Confirmation</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password_confirmation" required
                                                minlength="8" class="form-control round-input" style="width:80%;">
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
