<x-master-voter>
    @csrf
    @section('sidebar')
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
                    <li class="sub-menu">
                        <a class="category" href="#" data-category="mca">
                            <i class=""></i>
                            <span>MCA</span>
                        </a>
                    </li>
                </ul>
                <!-- sidebar menu end-->
            </div>
        </aside>
    @endsection

    <body>
        <section id="main-content" style="margin-left: 180px; margin-right: 50px;margin-top: 70px;height: fit-content;">
            <section class="wrapper" style="margin-top: 0px;">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-inbox"></i>Election</h3>
                    </div>
                </div>

                <section id="container" class="">
                    <section id="main-content" style=" margin-right:0px;margin-left:0px;">
                        <section class="wrapper" style="margin-top: 0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <section class="panel">
                                        <form class="form-horizontal" action="/election/vote" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="category-list" id="president-list">
                                                <!-- List of president candidates -->
                                                <h1>President</h1>
                                                <div class="row"
                                                    style="    display: flex;flex-direction: row;flex-wrap: wrap;align-content: center;justify-content: center;align-items: center;">
                                                    @foreach ($presidents as $president)
                                                        <x-candidate-vote-view :candidate=$president />
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="category-list" id="governor-list" style="display:none;">
                                                <!-- List of governor candidates -->
                                                <h1>Governor</h1>
                                                <div class="row"
                                                    style="    display: flex;flex-direction: row;flex-wrap: wrap;align-content: center;justify-content: center;align-items: center;">
                                                    @foreach ($governors as $governor)
                                                        <x-candidate-vote-view :candidate=$governor />
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="category-list" id="senetor-list" style="display:none;">
                                                <!-- List of senetor candidates -->
                                                <h1>Senetor</h1>
                                                <div class="row"
                                                    style="    display: flex;flex-direction: row;flex-wrap: wrap;align-content: center;justify-content: center;align-items: center;">
                                                    @foreach ($senators as $senator)
                                                        <x-candidate-vote-view :candidate=$senator />
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="category-list" id="women-rep-list" style="display:none;">
                                                <!-- List of women-rep candidates -->
                                                <h1>Women Representative</h1>
                                                <div class="row"
                                                    style="    display: flex;flex-direction: row;flex-wrap: wrap;align-content: center;justify-content: center;align-items: center;">
                                                    @foreach ($womenRepresentatives as $womanRepresentative)
                                                        <x-candidate-vote-view :candidate=$womanRepresentative />
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="category-list" id="mp-list" style="display:none;">
                                                <!-- List of mp candidates -->
                                                <h1>MP</h1>
                                                <div class="row"
                                                    style="    display: flex;flex-direction: row;flex-wrap: wrap;align-content: center;justify-content: center;align-items: center;">
                                                    @foreach ($mps as $mp)
                                                        <x-candidate-vote-view :candidate=$mp />
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="category-list" id="mca-list" style="display:none;">
                                                <!-- List of mca candidates -->
                                                <h1>MCA</h1>
                                                <div class="row"
                                                    style="    display: flex;flex-direction: row;flex-wrap: wrap;align-content: center;justify-content: center;align-items: center;">
                                                    @foreach ($mcas as $mca)
                                                        <x-candidate-vote-view :candidate=$mca />
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div
                                                style="display: flex;flex-direction: row;flex-wrap: nowrap;align-content: center;justify-content: center;align-items: center;margin-top: 20px">
                                                <input class="btn btn-danger " style="margin-right: 20px" type="reset"
                                                    value="Reset" id="btn-submit">
                                                <input class="btn btn-outline-success " type="submit"
                                                    value="Submit Vote" style="margin-left: 20px" id="btn-submit">
                                            </div>
                                        </form>
                                    </section>
                                </div>
                            </div>
                        </section>
                    </section>
                </section>
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
</x-master-voter>
