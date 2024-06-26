<x-master-voter>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="{{ asset('css/bootstrap-theme.css') }}" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="{{ asset('css/elegant-icons-style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- full calendar css-->
    <link href="{{ asset('assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/fullcalendar/fullcalendar/fullcalendar.css') }}" rel="stylesheet" />
    <!-- easy pie chart-->
    <link href="{{ asset('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css') }}" rel="stylesheet" type="text/css"
        media="screen" />
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}" type="text/css">
    <link href="{{ asset('css/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}">
    <link href="{{ asset('css/widgets.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/xcharts.min.css') }}" rel=" stylesheet">
    <link href="{{ asset('css/jquery-ui-1.10.4.min.css') }}" rel="stylesheet">
    <!-- javascripts -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- nice scroll -->
    <script src="{{ asset('js/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nicescroll.js') }}" type="text/javascript"></script>
    <!-- jquery knob -->
    <script src="{{ asset('assets/jquery-knob/js/jquery.knob.js') }}"></script>
    <!--custome script for all page-->
    <script src="{{ asset('js/scripts.js') }}"></script>

    <script>
        //knob
        $(".knob").knob();
    </script>

    <body>
        <section id="main-content" style="margin-left:0px; margin-right:0px; margin-top:60px;">
            <section class="wrapper" style="margin-top: 60px;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="profile-widget profile-widget-info">
                            <div class="panel-body" style="background: rgba(6, 12, 34, 0.98);">
                                <!--style="background-image: url('{{ asset('images/fr.jpg') }}')"-->
                                <div class="col-lg-2 col-sm-2">
                                    <div class="follow-ava">
                                        <img src="{{ getUserDP() }}" alt="image"
                                            style="height: 100px; width: 100px;">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 follow-info">
                                    <p><i class="icon_id-2"></i> {{ $user->id_number }}</p>
                                    <p><i class="icon_profile"></i> {{ $user->first_name }} {{ $user->last_name }}</p>
                                    <p><i class="icon_phone"></i> {{ $user->phone }}</p>
                                    <h6>
                                        <span><i class="icon_calendar"></i> {{ $user->dob }}</span>
                                    </h6>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel" style="margin-bottom:0px;">
                            <header class="panel-heading tab-bg-info" style="background-color: white;">
                                <ul class="nav nav-tabs">
                                    <li>
                                        <a data-toggle="tab" href="#profile" style="color: black;">
                                            <i class="fa fa-user"></i>
                                            Profile
                                        </a>
                                    </li>
                                </ul>
                            </header>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <!-- profile -->
                                    <div id="profile" class="tab-pane">
                                        <section class="panel">
                                            <div class="panel-body bio-graph-info">
                                                <h1>Profile</h1>
                                                <div class="row" style="color:black;">
                                                    <div class="bio-row">
                                                        <p><span>Voter ID : </span> <label
                                                                name="v_id">{{ $user->id_number }}</label>
                                                        </p>
                                                    </div>
                                                    <div class="bio-row">
                                                        <p><span>Name : </span> {{ auth()->user()->first_name }}
                                                            {{ $user->last_name }}</p>
                                                    </div>
                                                    {{-- <div class="bio-row">
                                                        <p><span>Father Name : </span>{{ 'father_name' }}</p>
                                                    </div> --}}
                                                    <div class="bio-row">
                                                        <p><span>Gender : </span>
                                                            {{ $user->gender_id == 1 ? 'Male' : 'Female' }}
                                                        </p>
                                                    </div>
                                                    <div class="bio-row">
                                                        <p><span>Date of Birth : </span>{{ $user->dob }}</p>
                                                    </div>
                                                    {{-- <div class="bio-row">
                                                        <p><span>Address : </span> {{ $user->gender_id }}</p>
                                                    </div> --}}
                                                    <div class="bio-row">
                                                        <p><span>Phone: </span>{{ $user->phone }}</p>
                                                    </div>
                                                    <div class="bio-row">
                                                        <p><span>Email : </span>{{ $user->email }}</p>
                                                    </div>
                                                    {{-- <div class="bio-row">
                                                        <p><span>Pincode : </span>{{ 'pincode' }}</p>
                                                    </div> --}}
                                                    <div class="bio-row">
                                                        <p><span>Province : </span>{{ $user->province }}</p>
                                                    </div>
                                                    <div class="bio-row">
                                                        <p><span>County : </span> {{ $user->county }}</p>
                                                    </div>
                                                    <div class="bio-row">
                                                        <p><span>Constituency : </span>{{ $user->constituency }}</p>
                                                    </div>
                                                    <div class="bio-row">
                                                        <p><span>Ward : </span>{{ $user->ward }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <section>
                                            <div class="row">
                                            </div>
                                        </section>
                                    </div>
                                    <!-- edit-profile -->
                                    <div id="edit-profile" class="tab-pane">
                                        <section class="panel">
                                            <div class="panel-body bio-graph-info">
                                                <h1> Profile Info</h1>
                                                <form class="form-horizontal " method="post">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Profile</label>
                                                        <div class="col-lg-2 col-sm-2">
                                                            <div class="follow-ava2">
                                                                <img id="output"
                                                                    src="{{ asset('images/userd.png') }}"
                                                                    style="max-height:182px; max-width: 182px; min-width: 181px; min-height: 181px;">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input type="file" required accept="image/*"
                                                                onchange="loadfile(event)"
                                                                style="position: relative; left: 190px;">
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
                                                        <label class="col-sm-2 control-label">Full Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control round-input">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Father Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control round-input">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Gender</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control round-input">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Birth Date</label>
                                                        <div class="col-sm-10">
                                                            <input type="date" class="form-control round-input">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">E-mail</label>
                                                        <div class="col-sm-10">
                                                            <input type="email"
                                                                pattern="\b[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}\b"
                                                                class="form-control round-input">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Mobile Number</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" pattern="[6-9]{1}[0-9]{9}"
                                                                class="form-control round-input">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Address</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control round-input">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-lg-offset-2 col-lg-10">
                                                            <button class="btn btn-primary"
                                                                type="submit">Submit</button>
                                                            <button class="btn btn-default"
                                                                type="reset">Reset</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </body>
</x-master-voter>
