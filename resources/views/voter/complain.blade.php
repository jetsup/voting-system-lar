<x-master-voter>
    <html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keyword"
            content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
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
        <link href="{{ asset('css/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">
        <!-- Custom styles -->
        <link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}">
        <link href="{{ asset('css/widgets.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/xcharts.min.css') }}" rel=" stylesheet">
        <link href="{{ asset('css/jquery-ui-1.10.4.min.css') }}" rel="stylesheet">
    </head>

    <body>
        <section id="main-content" style="margin-left:0px; margin-right:5px; margin-top: 60px;">
            <section class="wrapper" style="margin-top: 60px;">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-file-text-o"></i>complain</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <div class="panel-body">
                                <form class="form-horizontal" method="POST" action="/complain">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Voter ID</label>
                                        <div class="col-sm-10">
                                            <label name="v_id" class="form-control"
                                                style="width:80%;">{{ auth()->user()->id_number }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Complain</label>
                                        <div class="col-sm-10">
                                            <textarea name="complain" style="width:80%;" cols="6" rows="4" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-default" type="button">Cancel</button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Reply of complain
                            </header>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Complain ID</th>
                                        <th>Your Complain</th>
                                        <th>Complain Reply</th>
                                    </tr>
                                </thead>
                                {{-- {% for i in reply %}
                                <tbody>
                                    <tr>
                                        <td>{{ i . id }}</td>
                                        <td>{{ i . complain }}</td>
                                        <td>{{ i . complain_reply }}</td>
                                    </tr>
                                </tbody>
                                {% endfor %} --}}
                                <tbody>
                                    @foreach ($complains as $complain)
                                        <tr>
                                            <td>{{ $complain->id }}</td>
                                            <td>{{ $complain->message }}</td>
                                            {{-- <td>{{ $complain->reply }}</td> --}}
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </body>

    </html>
</x-master-voter>
