<x-master-admin>

    <body>
        <section id="main-content" style=" margin-right:120px;">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-file-text-o"></i>Reply Complain</h3>
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i>Home</li>
                            <li><i class="icon_document_alt"></i>Complain</li>
                            <li><i class="fa fa-file-text-o"></i>Reply Complain</li>
                        </ol>
                    </div>
                </div>
                <!-- page start-->
                <div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Reply to complain
                            </header>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Complain ID</th>
                                        <th>Voter ID</th>
                                        <th>Complain</th>
                                    </tr>
                                </thead>
                                {{-- {% for i in complain %}
                <tbody>
                  <tr>
                      <td>{{i.id}}</td>
                      <td>{{i.voterid_no}}</td>
                      <td>{{i.complain}}</td>
                  </tr>
                </tbody>
                {% endfor %} --}}
                            </table>
                        </section>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <h3>Reply Complain</h3>
                            </header>
                            <div class="panel-body">
                                <form class="form-horizontal" action="reply_complain" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Complain</label>
                                        <div class="col-sm-10">
                                            <select name="complainid" required class="form-control" style="width:80%;">
                                                <option value="" selected="">Select complain no.</option>
                                                {{-- {% for i in complain %}
                            <option value="{{i.id}}">{{i.id}}</option>
                            {% endfor %} --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Complain</label>
                                        <div class="col-sm-10">
                                            <textarea name="replycomplain" placeholder="Reply" style="width:80%;" cols="6" rows="4" class="form-control"
                                                required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button class="btn btn-primary" type="submit">Reply</button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            {{-- {% for i in complainid %}
                            <h3">Replied to Complain ID {{i}} </h3>
                            {% endfor %} --}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{-- <div class="col-lg-offset-2 col-lg-10">
                        {% for message in messages %}
                            <h3 style="color: red;"> {{message}} </h3>
                            {% endfor %}
                      </div> --}}
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
                <!-- page end-->
            </section>
        </section>
    </body>
</x-master-admin>
