<x-master-admin>
    <script>
        function openComplain(complainID) {
          document.getElementById("reply-complain-model").style.display;
        }
    </script>

    <body>
        <!-- container section start -->
        <!--main content start-->
        <section id="main-content" style=" margin-right:120px;">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-file-text-o"></i>View Complain</h3>
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i>Home</li>
                            <li><i class="icon_document_alt"></i>Complain</li>
                            <li><i class="fa fa-file-text-o"></i>View Complain</li>
                        </ol>
                    </div>
                </div>
                <!-- page start-->
                <div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Complain
                            </header>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Complain ID</th>
                                        <th>Voter ID</th>
                                        <th>Complain</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($complains as $complain)
                                        <tr>
                                            <td>{{ $complain->id }}</td>
                                            <td>{{ $complain->first_name . ' ' . $complain->last_name }}</td>
                                            <td style="cursor: pointer;" onclick="openComplain({{ $complain->id }})">
                                                {{ $complain->complain }}</td>
                                            <td>
                                                <form method="POST" action="/complain/resolve">
                                                    @csrf
                                                    <input name="complain-id" value="{{ $complain->id }}" hidden>
                                                    <button class="btn badge btn-primary bg-success">Mark
                                                        Resolved</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </section>
                    </div>
                </div>
                <!-- page end-->
                {{-- TODO: prepare a modal for replying complains --}}
            </section>
        </section>
    </body>
</x-master-admin>
