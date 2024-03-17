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
        <link href="{{ asset('css/jquery-jvectormap-1.2.2.cs') }}s" rel="stylesheet">
        <!-- Custom styles -->
        <link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}">
        <link href="{{ asset('css/widgets.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/xcharts.min.css') }}" rel=" stylesheet">
        <link href="{{ asset('css/jquery-ui-1.10.4.min.css') }}" rel="stylesheet">
    </head>

    <body>
        <section id="main-content" style="margin-left:0px;margin-top: 60px;">
            <section class="wrapper" style="margin-top:60px;">
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
                                <form class="form-horizontal" action="vview_result" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Election ID</label>
                                        <div class="col-sm-10">
                                            <select name="e_id" class="form-control" style="width:80%;height:34px;">
                                                <option value="" selected>Select Election ID</option>
                                                {{-- {% for i in elections %}
                                  <option value="{{i.election_id}}">{{i.election_id}}</option>
                              {% endfor %} --}}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Result Type</label>
                                        <div class="col-sm-10">
                                            <select name="resulttype" class="form-control"
                                                style="width:80%;height:34px;" required>
                                                <option value="" selected>Select Result Type</option>
                                                <option value="partywise">Partywise</option>
                                                <option value="constituencywise">Constituencywise</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button class="btn btn-primary" name="view_result" type="submit">View
                                                Result</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
                {{-- <div>
       {% for message in messages %}
       <h3 align="center">{{message}}</h3>
       {% endfor %}
   </div> --}}
            </section>
        </section>
    </body>

    </html>
</x-master-voter>