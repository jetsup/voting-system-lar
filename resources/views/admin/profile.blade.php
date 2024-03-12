<x-master-admin>
    <section id="main-content" style=" margin-right:110px;">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-user-md"></i> Profile</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/">Home</a></li>
                        <li><i class="fa fa-user-md"></i>Profile</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <!-- profile-widget -->
                <div class="col-lg-12">
                    <div class="profile-widget profile-widget-info"
                        style="background-color: white !important; color: black;">
                        <div class="panel-body">
                            <div class="col-lg-2 col-sm-2">
                                <div class="follow-ava">
                                    <img src="{{ 'image.url' }}" alt="Image not found">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 follow-info">
                                <p>{{ $user->id_number }}</p>
                                <p>{{ $user->first_name }} {{ $user->last_name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <div class="panel-body">
                            <!-- profile -->
                            <div id="profile" class="tab-pane">
                                <section class="panel">
                                    <div class="panel-body bio-graph-info" style="color: black;">
                                        <div class="row">
                                            <div class="bio-row">
                                                <p><span>ID Number </span>: {{ $user->id_number }} </p>
                                            </div>
                                            <div class="bio-row">
                                                <p><span>First Name </span>: {{ $user->first_name }} </p>
                                            </div>
                                            <div class="bio-row">
                                                <p><span>Last Name </span>: {{ $user->last_name }}</p>
                                            </div>
                                            <div class="bio-row">
                                                <p><span>Middle Name</span>:
                                                    {{ $user->middle_name == null ? 'NOT SET' : $user->middle_name }}
                                                </p>
                                            </div>
                                            <div class="bio-row">
                                                <p><span>Gender </span>: {{ $user->gender_id == 1 ? 'Male' : 'Female' }}
                                                </p>
                                            </div>
                                            <div class="bio-row">
                                                <p><span>Date of Birth </span>: {{ $user->dob }} </p>
                                            </div>
                                            <div class="bio-row">
                                                <p><span>Address </span>: {{ $user->ward }},
                                                    {{ $user->constituency }} </p>
                                            </div>
                                            <div class="bio-row">
                                                <p><span>Pincode </span>: {{ 'SET' }} </p>
                                            </div>
                                            <div class="bio-row">
                                                <p><span>Moblie </span>: {{ $user->phone }} </p>
                                            </div>
                                            <div class="bio-row">
                                                <p><span>Email </span>: {{ $user->email }} </p>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section>
                                    <div class="row">
                                    </div>
                                </section>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- page end-->
        </section>
    </section>
</x-master-admin>
