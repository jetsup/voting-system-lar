<x-master-admin>

    <body>
        <section id="main-content" style=" margin-right:120px;">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-file-text-o"></i>Voting</h3>
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i>Home</li>
                            <li><i class="icon_document_alt"></i>Forms</li>
                            <li><i class="fa fa-file-text-o"></i>Voting</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Voting
                            </header>
                            <div class="panel-body">
                                <form class="form-horizontal" action="votervotesub" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Election ID</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control round-input" required
                                                name="eid" style="width:80%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Voter ID</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control round-input" name="vid"
                                                required maxlength="10" pattern="^[A-Z0-9]{10}$"
                                                onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
                        if(this.checkValidity()) form.pwd2.pattern = RegExp.escape(this.value);"
                                                title="Only A-Z and 0-9 allowed minimum 10 characters"
                                                style="width:80%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button class="btn btn-primary" type="submit">Voter voted</button>
                                            <button class="btn btn-default" type="reset">Reset</button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{-- <div class="col-lg-offset-2 col-lg-10">
                        {% for message in messages %}
                            <h3 style="color: green;"> {{message}} {{where}} </h3>
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
