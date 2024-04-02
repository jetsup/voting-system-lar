<x-master-admin>
    <script>
        function populateElections() {
            let ajax = new XMLHttpRequest();
            ajax.open("GET", "/data/get-elections/1", true);
            ajax.onload = function() {
                if (this.status == 200) {
                    let elections = JSON.parse(this.responseText).elections;
                    let electionOptions = "";
                    for (let i = 0; i < elections.length; i++) {
                        electionOptions += "<option value='" + elections[i].id + "'>" +elections[i].id+ ". " +elections[i].type +
                            " [" + elections[i].start_date + " - " + elections[i].end_date + "]" + "</option>"
                    }
                    document.getElementById("election-id").innerHTML = electionOptions;
                }
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
                        <h3 class="page-header"><i class="fa fa-file-text-o"></i>Register Party</h3>
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i>Home</li>
                            <li><i class="icon_document_alt"></i>Parties</li>
                            <li><i class="fa fa-file-text-o"></i>Register Party</li>
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
                                    action="/create-party">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Party Logo</label>
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
                                            <input type="file" required accept="image/*" name="logo"
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
                                        <label class="col-sm-2 control-label">Party Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="party-name" minlength="3" required
                                                class="form-control round-input" oninput="this.setCustomValidity('')"
                                                oninvalid="this.setCustomValidity('Provide Party Name!')"
                                                placeholder="Party Name" style="width:80%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Party Slogan</label>
                                        <div class="col-sm-10">
                                            <input type="text" required name="slogan" minlength="3"
                                                class="form-control round-input" oninput="this.setCustomValidity('')"
                                                oninvalid="this.setCustomValidity('Every Party must have a slogan or a catch phrase :)')"
                                                placeholder="Slogan or Catch Phrase" style="width:80%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Party Leader</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="party-leader" minlength="3"
                                                class="form-control round-input" oninput="this.setCustomValidity('')"
                                                oninvalid="this.setCustomValidity('Provide the ID number of the party leader')"
                                                placeholder="ID Number of the Party Leader (If the ID does not match the user/voter in the database, Admin will be assigned the role)"
                                                title="This party leader should be unique in that the party leader should not have two parties which one is the leader of!"
                                                style="width:80%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Election</label>
                                        <div class="col-sm-10">
                                            <select name="election-id" id="election-id" class="form-control round-input"
                                                required style="width:80%;">
                                            </select>
                                        </div>
                                        <script>
                                            populateElections();
                                        </script>
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
