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
    <link href="{{ asset('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css') }}" rel="stylesheet" type="text/css"
        media="screen" />
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
    <script>
        function getCounties(provinceID) {
            if (provinceID == "") {
                document.getElementById("county").innerHTML = "<option value=''>-- SELECT PROVINCE --</option>";
                document.getElementById("constituency").innerHTML = "<option value=''>-- SELECT COUNTY --</option>";
                return;
            }
            var ajax = new XMLHttpRequest();
            ajax.open("GET", "/EC_Admin/get_counties/?province_id=" + provinceID, true);
            ajax.onload = function () {
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
            ajax.open("GET", "/EC_Admin/get_constituencies/?county_id=" + countyID, true);
            ajax.onload = function () {
                var list = JSON.parse(this.responseText);
                var option = "";
                option += "<option value=''>-- CONSTITUENCY --</option>";
                for (var i = 0; i < list.length; i++) {
                    option += "<option value='" + list[i]['constituency_id'] + "'>" + list[i]['constituency_name'] + "</option>";
                }
                document.getElementById("constituency").innerHTML = option;
            };
            ajax.send();
        }
    </script>
</head>

<body>
    <section id="main-content" style="margin-left:0px;margin-top: 60px;">
        <section class="wrapper" style="margin-top:60px;">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-file-text-o"></i>Report</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <div class="panel-body">
                            <form class="form-horizontal " action="vview_report" id="CandidateCustomFilter"
                                method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Election ID</label>
                                    <div class="col-sm-10">
                                        <select name="e_id" class="form-control" style="width:80%;height:34px;">
                                            {{-- {% for i in elections %}
                                            <option value="{{i.election_id}}">[{{i.start_date}} - {{i.end_date}}]
                                                {{i.election_type_id|get_election_type}}</option>
                                            {% endfor %} --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">State</label>
                                    <div class="col-sm-10">
                                        <select id="province" name="province" class="form-control"
                                            onchange="getCounties(this.value)" style="width:80%;height:34px;">
                                        </select>
                                    </div>
                                    <script>
                                        var ajax = new XMLHttpRequest();
                                        ajax.open("GET", "/EC_Admin/get_provinces/", true);
                                        ajax.onload = function () {
                                            var list = JSON.parse(this.responseText);
                                            var option = "<option value=''>-- PROVINCE --</option>";
                                            for (var i = 0; i < list.length; i++) {
                                                option += "<option value='" + list[i]['province_id'] + "'>" +
                                                    list[i]['province_name'] + "</option>";
                                            }
                                            document.getElementById("province").innerHTML = option;
                                            document.getElementById("county").innerHTML = "<option value=''>-- COUNTY --</option>";
                                            document.getElementById("constituency").innerHTML = "<option value=''>-- CONSTITUENCY --</option>";
                                        };
                                        ajax.send();
                                    </script>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">County</label>
                                    <div class="col-sm-10">
                                        <select name="county" class="form-control" id="county"
                                            onchange="getConstituencies(this.value)" style="width:80%;height:34px;"
                                            style="width:80%;height:34px;">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">constituency</label>
                                    <div class="col-sm-10">
                                        <select name="constituency" class="form-control" id="constituency"
                                            style="width:80%;height:34px;">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-primary" name="view_report" type="submit">View
                                            report</button>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table" border="1">
                                        <tbody>
                                            <tr>
                                                <th colspan="4">Electors</th>
                                                <th colspan="4">Voters</th>
                                                <th colspan="4">Poll</th>
                                            </tr>
                                            <tr>
                                                <th>Male</th>
                                                <th>Female</th>
                                                <th>Others</th>
                                                <th>Total</th>
                                                <th>Male</th>
                                                <th>Female</th>
                                                <th>Others</th>
                                                <th>Total</th>
                                                <th>Male</th>
                                                <th>Female</th>
                                                <th>Others</th>
                                                <th>Total</th>
                                            </tr>
                                            {{-- {% for i in report %}
                                            <tr>
                                                <td>{{i.electors_male}}</td>
                                                <td>{{i.electors_female}}</td>
                                                <td>{{i.electors_others}}</td>
                                                <td>{{i.electors_total}}</td>
                                                <td>{{i.voters_male}}</td>
                                                <td>{{i.voters_female}}</td>
                                                <td>{{i.voters_others}}</td>
                                                <td>{{i.voters_total}}</td>
                                                <td>{{i.poll_male}}%</td>
                                                <td>{{i.poll_female}}%</td>
                                                <td>{{i.poll_others}}%</td>
                                                <td>{{i.poll_total}}%</td>
                                            </tr>
                                        </tbody>
                                        {% endfor %} --}}
                                    </table>
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