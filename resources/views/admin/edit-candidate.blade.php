<x-master-admin>

    <body>
        <section id="main-content" style=" margin-right:120px;">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="icon_pencil-edit"></i>Edit/Delete Candidate</h3>
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i>Home</li>
                            <li><i class="icon_document_alt"></i>Candidate</li>
                            <li><i class="icon_pencil-edit"></i>Edit/Delete Candidate</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Candidate
                            </header>
                            <div class="panel-body">
                                <form class="form-horizontal " method="POST" action="/edit-candidate">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Enter Candidate ID:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control round-input" name="id_number"
                                                required maxlength="10" style="width:80%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <input class="btn btn-primary" name="edit-candidate" type="submit"
                                                value="View Detail">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{-- <div class="col-lg-offset-2 col-lg-10">
                        {% for message in messages %}
                            <h3 style="color: green;"> {{message}} </h3>
                            {% endfor %}
                      </div> --}}
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
