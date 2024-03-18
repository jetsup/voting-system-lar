<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Digital Voting</title>

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
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-ui-1.10.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-1.8.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-ui-1.9.2.custom.min.js') }}"></script>
    <!-- bootstrap -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- nice scroll -->
    <script src="{{ asset('js/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nicescroll.js') }}" type="text/javascript"></script>
    <!-- charts scripts -->
    <script src="{{ asset('assets/jquery-knob/js/jquery.knob.js') }}"></script>
    <script src="{{ asset('js/jquery.sparkline.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.js') }}"></script>
    <!-- jQuery full calendar -->
    <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
    <!-- Full Google Calendar - Calendar -->
    <script src="{{ asset('assets/fullcalendar/fullcalendar/fullcalendar.js') }}"></script>
    <!--script for this page only-->
    <script src="{{ asset('js/calendar-custom.js') }}"></script>
    <script src="{{ asset('js/jquery.rateit.min.js') }}"></script>
    <!-- custom select -->
    <script src="{{ asset('js/jquery.customSelect.min.js') }}"></script>
    <script src="{{ asset('assets/chart-master/Chart.js') }}"></script>

    <!--custome script for all page-->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <!-- custom script for this page-->
    <script src="{{ asset('js/sparkline-chart.js') }}"></script>
    <script src="{{ asset('js/easy-pie-chart.js') }}"></script>
    <script src="{{ asset('js/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('js/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('js/xcharts.min.js') }}"></script>
    <script src="{{ asset('js/jquery.autosize.min.js') }}"></script>
    <script src="{{ asset('js/jquery.placeholder.min.js') }}"></script>
    <script src="{{ asset('js/gdp-data.js') }}"></script>
    <script src="{{ asset('js/morris.min.js') }}"></script>
    <script src="{{ asset('js/sparklines.js') }}"></script>
    <script src="{{ asset('js/charts.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>
    <!-- Bootstrap CSS File -->
    <link href="{{ asset('voter/lib/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="{{ asset('voter/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('voter/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('voter/lib/venobox/venobox.css') }}" rel="stylesheet">
    <link href="{{ asset('voter/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="{{ asset('voter/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <button type="button" id="mobile-nav-toggle"><i class="fa fa-bars"></i></button>
    <header id="header">
        <div class="container">

            <div id="logo" class="pull-left">
                <a href="/" class="scrollto"
                    style="color:white;padding: 5px;
                display: inline-block;
                font-family: sans-serif;
                font-weight: 600;
                font-size: 25px;">
                    {{ env('APP_NAME') }}</a>
            </div>

            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li><a href="/">Home</a></li>
                    <li><a href="/profile">Profile</a></li>
                    <li><a href="/view-candidate">Candidate</a></li>
                    <li><a href="/election">Election</a></li>
                    <li><a href="/view-result">Result</a></li>
                    <li><a href="/view-report">Report</a></li>
                    <li><a href="/complain">Complain</a></li>
                    {{-- <li class="buy-tickets"><a href="/logout">Logout</a></li> --}}
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown" href="#" style="a:focus color:#797979">
                            <span class="profile-ava">
                                <img alt="Image not found" src="{{ getUserDP() }}" height="30px" width="30px">
                            </span>
                            <span class="username">{{ auth()->user()->first_name }}
                                {{ auth()->user()->last_name }}</span>
                        </a>
                        <ul class="dropdown-menu extended logout"
                            style="border-radius: 10%; border-bottom-right-radius: 10%;border-bottom-left-radius: 10%;">
                            <div class="log-arrow-up">
                            </div>
                            <li class="eborder-top">
                                <a href="/profile"><i class="icon_profile"></i> Profile</a>
                            </li>
                            <li>
                                <a href="vchangepassword"><i class="fa fa-key"></i>Change password</a>
                            </li>
                            <li>
                                <a href="/logout" style="background-color: #040919 !important"><i
                                        class="fa fa-unlock-alt"></i> Log
                                    Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav><!-- #nav-menu-container -->
        </div>
    </header><!-- #header -->

    <!--==========================
    Intro Section
  ============================-->
    @csrf
    {{ $slot }}
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="fa fa-angle-right"></i> <a href="/">Home</a></li>
                            <li><i class="fa fa-angle-right"></i> <a href="#">About us</a></li>
                            <li><i class="fa fa-angle-right"></i> <a href="#">Services</a></li>
                            <li><i class="fa fa-angle-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="fa fa-angle-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h4>Contact Us</h4>
                        <p>
                            <strong>Email:</strong> {{env("MAIL_FROM_ADDRESS")}}<br>
                        </p>

                        <div class="social-links">
                            <a href="https://www.twitter.com/George_x86" class="twitter"><i
                                    class="fa fa-twitter"></i></a>
                            <a href="https://www.facebook.com/GeorgeyX86" class="facebook"><i
                                    class="fa fa-facebook"></i></a>
                            <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                            <a href="https://www.linkedin.com/in/george-n-5408161b7" class="linkedin"><i
                                    class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- #footer -->
    <!-- JavaScript Libraries -->
    <script src="{{ asset('voter/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('voter/lib/jquery/jquery-migrate.min.js') }}"></script>
    <script src="{{ asset('voter/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('voter/lib/superfish/hoverIntent.js') }}"></script>
    <script src="{{ asset('voter/lib/superfish/superfish.min.js') }}"></script>
    <script src="{{ asset('voter/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('voter/lib/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('voter/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Form JavaScript File -->
    <script src="{{ asset('voter/contactform/contactform.js') }}"></script>
    <script src="{{ asset('voter/js/main.js') }}"></script>

</body>

</html>
