<x-master-voter>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>View Report</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/favicon.png">

        <title>Digital Voting</title>

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
        <link href="{{ asset('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css') }}" rel="stylesheet"
            type="text/css" media="screen" />
        <!-- owl carousel -->
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}" type="text/css">
        <link href="{{ asset('css/jquery-jvectormap-1.2.2.css') }}s" rel="stylesheet">
        <!-- Custom styles -->
        <link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}">
        <link href="{{ asset('css/widgets.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/xcharts.min.css') }}" rel=" stylesheet">
        <link href="{{ asset('css/jquery-ui-1.10.4.min.css') }}" rel="stylesheet">
    </head>

    <body>
        <aside>
            <div id="sidebar" class="nav-collapse" style="background-color: rgba(21, 30, 65, 0.98);">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu" style="margin-top: 0px;">
                    <li class="sub-menu">
                        <a class="category" href="#" data-category="president">
                            <i class=""></i>
                            <span>President</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a class="category" href="#" data-category="governor">
                            <i class=""></i>
                            <span>Governor</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a class="category" href="#" data-category="senetor">
                            <i class=""></i>
                            <span>Senetor</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a class="category" href="#" data-category="women-rep">
                            <i class=""></i>
                            <span>Women Rep</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a class="category" href="#" data-category="mp">
                            <i class=""></i>
                            <span>MP</span>
                        </a>
                    </li>
                    {{-- <li class="sub-menu">
                        <a class="category" href="#" data-category="mca">
                            <i class=""></i>
                            <span>MCA</span>
                        </a>
                    </li> --}}
                </ul>
                <!-- sidebar menu end-->
            </div>
        </aside>

        <section id="main-content" style="margin-left: 180px; margin-right: 50px;margin-top: 70px;height: fit-content;">
            <section class="wrapper" style="margin-top:0px;">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-file-text-o"></i>Result</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Result
                            </header>
                            <div class="panel-body">
                                <div class="category-list" id="president-list">
                                    <!-- List of president candidates -->
                                    <h1>President</h1>
                                    <div class="">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Profile</th>
                                                    <th>Name</th>
                                                    <th>Party Name</th>
                                                    <th>Logo</th>
                                                    <th>Votes</th>
                                                    <th>Total Cast</th>
                                                    <th>% Votes</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- loop the data --}}
                                                @foreach ($presidents as $president)
                                                    @if (is_object($president) && get_class($president) == 'App\Models\Candidates')
                                                        <tr>
                                                            <td><img src="{{ asset('storage/' . $president->dp) }}"
                                                                    alt="Profile Image" width="10%"
                                                                    style="width: 40px">
                                                            </td>
                                                            <td>{{ $president->first_name }}
                                                                {{ $president->last_name }}
                                                            </td>
                                                            <td>{{ $president->party }}</td>
                                                            <td>
                                                                <img src="{{ asset('storage/' . $president->party_image) }}"
                                                                    alt="Profile Image" width="10%"
                                                                    style="width: 40px">
                                                            </td>
                                                            <td>{{ $president->total_votes }}</td>
                                                            <td> {{ $presidents['cast_votes'] }}</td>
                                                            <td>{{ ($president->total_votes / $presidents['cast_votes']) * 100 }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="category-list" id="governor-list" style="display:none;">
                                    <!-- List of governor candidates -->
                                    <h1>Governor</h1>
                                    <div class="">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Profile</th>
                                                    <th>Name</th>
                                                    <th>Party Name</th>
                                                    <th>Logo</th>
                                                    <th>Votes</th>
                                                    <th>Total Cast</th>
                                                    <th>% Votes</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- loop the data --}}
                                                @foreach ($governors as $governor)
                                                    @if (is_object($governor) && get_class($governor) == 'App\Models\Candidates')
                                                        <tr>
                                                            <td><img src="{{ asset('storage/' . $governor->dp) }}"
                                                                    alt="Profile Image" width="10%"
                                                                    style="width: 40px">
                                                            </td>
                                                            <td>{{ $governor->first_name }} {{ $governor->last_name }}
                                                            </td>
                                                            <td>{{ $governor->party }}</td>
                                                            <td>
                                                                <img src="{{ asset('storage/' . $governor->party_image) }}"
                                                                    alt="Profile Image" width="10%"
                                                                    style="width: 40px">
                                                            </td>
                                                            <td>{{ $governor->total_votes }}</td>
                                                            <td> {{ $governors['cast_votes'] }}</td>
                                                            <td>{{ ($governor->total_votes / $governors['cast_votes']) * 100 }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="category-list" id="senetor-list" style="display:none;">
                                    <!-- List of senetor candidates -->
                                    <h1>Senetor</h1>
                                    <div class="">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Profile</th>
                                                    <th>Name</th>
                                                    <th>Party Name</th>
                                                    <th>Logo</th>
                                                    <th>Votes</th>
                                                    <th>Total Cast</th>
                                                    <th>% Votes</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- loop the data --}}
                                                @foreach ($senators as $senator)
                                                    @if (is_object($senator) && get_class($senator) == 'App\Models\Candidates')
                                                        <tr>
                                                            <td><img src="{{ asset('storage/' . $senator->dp) }}"
                                                                    alt="Profile Image" width="10%"
                                                                    style="width: 40px">
                                                            </td>
                                                            <td>{{ $senator->first_name }} {{ $senator->last_name }}
                                                            </td>
                                                            <td>{{ $senator->party }}</td>
                                                            <td>
                                                                <img src="{{ asset('storage/' . $senator->party_image) }}"
                                                                    alt="Profile Image" width="10%"
                                                                    style="width: 40px">
                                                            </td>
                                                            <td>{{ $senator->total_votes }}</td>
                                                            <td> {{ $senators['cast_votes'] }}</td>
                                                            <td>{{ ($senator->total_votes / $senators['cast_votes']) * 100 }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="category-list" id="women-rep-list" style="display:none;">
                                    <!-- List of women-rep candidates -->
                                    <h1>Women Representative</h1>
                                    <div class="">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Profile</th>
                                                    <th>Name</th>
                                                    <th>Party Name</th>
                                                    <th>Logo</th>
                                                    <th>Votes</th>
                                                    <th>Total Cast</th>
                                                    <th>% Votes</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- loop the data --}}
                                                @foreach ($womenRepresentatives as $womanRepresentative)
                                                    @if (is_object($womanRepresentative) && get_class($womanRepresentative) == 'App\Models\Candidates')
                                                        <tr>
                                                            <td><img src="{{ asset('storage/' . $womanRepresentative->dp) }}"
                                                                    alt="Profile Image" width="10%"
                                                                    style="width: 40px">
                                                            </td>
                                                            <td>{{ $womanRepresentative->first_name }}
                                                                {{ $womanRepresentative->last_name }}
                                                            </td>
                                                            <td>{{ $womanRepresentative->party }}</td>
                                                            <td>
                                                                <img src="{{ asset('storage/' . $womanRepresentative->party_image) }}"
                                                                    alt="Profile Image" width="10%"
                                                                    style="width: 40px">
                                                            </td>
                                                            <td>{{ $womanRepresentative->total_votes }}</td>
                                                            <td> {{ $womenRepresentatives['cast_votes'] }}</td>
                                                            <td>{{ ($womanRepresentative->total_votes / $womenRepresentatives['cast_votes']) * 100 }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="category-list" id="mp-list" style="display:none;">
                                    <!-- List of mp candidates -->
                                    <h1>MP</h1>
                                    <div class="">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Profile</th>
                                                    <th>Name</th>
                                                    <th>Party Name</th>
                                                    <th>Logo</th>
                                                    <th>Votes</th>
                                                    <th>Total Cast</th>
                                                    <th>% Votes</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- loop the data --}}
                                                @foreach ($mps as $mp)
                                                    @if (is_object($mp) && get_class($mp) == 'App\Models\Candidates')
                                                        <tr>
                                                            <td><img src="{{ asset('storage/' . $mp->dp) }}"
                                                                    alt="Profile Image" width="10%"
                                                                    style="width: 40px">
                                                            </td>
                                                            <td>{{ $mp->first_name }} {{ $mp->last_name }}
                                                            </td>
                                                            <td>{{ $mp->party }}</td>
                                                            <td>
                                                                <img src="{{ asset('storage/' . $mp->party_image) }}"
                                                                    alt="Profile Image" width="10%"
                                                                    style="width: 40px">
                                                            </td>
                                                            <td>{{ $mp->total_votes }}</td>
                                                            <td> {{ $mps['cast_votes'] }}</td>
                                                            <td>{{ ($mp->total_votes / $mps['cast_votes']) * 100 }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                {{-- TODO For MCA data for ward will need to be added to get a finite response --}}
                                {{-- <div class="category-list" id="mca-list" style="display:none;">
                                    <!-- List of mca candidates -->
                                    <h1>MCA</h1>
                                    <div class="">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Profile</th>
                                                    <th>Name</th>
                                                    <th>Party Name</th>
                                                    <th>Logo</th>
                                                    <th>Votes</th>
                                                    <th>Total Cast</th>
                                                    <th>% Votes</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($mcas as $mca)
                                                    @if (is_object($mca) && get_class($mca) == 'App\Models\Candidates')
                                                        <tr>
                                                            <td><img src="{{ asset('storage/' . $mca->dp) }}"
                                                                    alt="Profile Image" width="10%"
                                                                    style="width: 40px">
                                                            </td>
                                                            <td>{{ $mca->first_name }} {{ $mca->last_name }}
                                                            </td>
                                                            <td>{{ $mca->party }}</td>
                                                            <td>
                                                                <img src="{{ asset('storage/' . $mca->party_image) }}"
                                                                    alt="Profile Image" width="10%"
                                                                    style="width: 40px">
                                                            </td>
                                                            <td>{{ $mca->total_votes }}</td>
                                                            <td> {{ $mcas["cast_votes"] }}</td>
                                                            <td>{{ ($mca->total_votes / $mcas["cast_votes"]) * 100 }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div> --}}
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const categories = document.querySelectorAll('.category');
                categories.forEach(function(category) {
                    category.addEventListener('click', function(event) {
                        event.preventDefault();
                        const categoryToShow = this.getAttribute('data-category');
                        showCategory(categoryToShow);
                    });
                });

                function showCategory(category) {
                    const categoryLists = document.querySelectorAll('.category-list');
                    categoryLists.forEach(function(list) {
                        if (list.id === category + '-list') {
                            list.style.display = 'block';
                        } else {
                            list.style.display = 'none';
                        }
                    });
                }
            });
        </script>
    </body>

    </html>
</x-master-voter>
