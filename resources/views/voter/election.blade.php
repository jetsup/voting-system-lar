<x-master-voter>
    @csrf

    <body>
        <section id="main-content" style="margin-left: 60px; margin-right: 50px;margin-top: 60px;">
            <section class="wrapper" style="margin-top: 60px;">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-inbox"></i>Election</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <form class="form-horizontal" action="vote" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    {{-- {% for candidate in candidates %}
                                    <div class="col-lg-12">
                                        <div class="profile-widget profile-widget-info">
                                            <div class="panel-body" style="background-color: white; color:black;">
                                                <div class="col-lg-2 col-sm-2">
                                                    <div class="follow-ava">
                                                        <a><img src="{{ candidate . candidate_identity . voter_image . url }}"
                                                                alt="" class="het-90"></a>
                                                    </div>
                                                    <h4 class="bg-red">{{ "candidate . candidate_identity . name" }}
                                                        {{ "candidate . candidate_identity . father_name" }}</h4>
                                                </div>
                                                <div class="col-lg-2 col-sm-2">
                                                    <div class="follow-ava">
                                                        <a><img src="{{ candidate . party_image . url }}" alt=""
                                                                class="het-90"></a>
                                                    </div>
                                                    <div class="bg-red">
                                                        <label for="can">
                                                            My Text
                                                        </label>
                                                        <input class="form-control" type="radio" name="can"
                                                            value="{{ candidate . vi_position_id }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {% endfor %} --}}
                                    <div>
                                        <!-- TODO: style -->
                                        <br>
                                        <video id="video" width="320" height="240" autoplay></video>
                                    </div>
                                    <div>
                                        <div class="col-lg-12">
                                            <label for="image-verified">Image Verification</label>
                                            <input type="text" name="image-verified" id="image-verified"
                                                value="Not Verified" class="form-control round-input bg-danger"
                                                disabled>

                                            <button type="submit" id="btn-submit"
                                                class="form-control bg-danger">Vote</button>
                                            <button type="reset" class="form-control">Reset</button>
                                        </div>
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', () => {
                                            const video = document.getElementById('video');
                                            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                                                navigator.mediaDevices.getUserMedia({
                                                        video: true
                                                    })
                                                    .then((stream) => {
                                                        video.srcObject = stream;
                                                        // Send each frame to the Django endpoint for image detection
                                                        setInterval(() => {
                                                            const canvas = document.createElement('canvas');
                                                            canvas.width = video.videoWidth;
                                                            canvas.height = video.videoHeight;
                                                            const context = canvas.getContext('2d');
                                                            context.drawImage(video, 0, 0, canvas.width, canvas.height);

                                                            const imageData = canvas.toDataURL('image/jpeg');
                                                            var ajax = new XMLHttpRequest();
                                                            ajax.open("POST", "verify_visual/", true);
                                                            ajax.setRequestHeader("Content-type", "application/json");
                                                            ajax.setRequestHeader("X-CSRFToken", "{{ csrf_token() }}");
                                                            ajax.onload = function() {
                                                                var responseJSON = JSON.parse(ajax.responseText);
                                                                console.log(responseJSON);
                                                                if (responseJSON.voter_verified) {
                                                                    // remove a value from a class and add another
                                                                    if (document.getElementById("btn-submit").classList.contains(
                                                                            "bg-danger")) {
                                                                        document.getElementById("image-verified").classList.remove(
                                                                            "bg-danger");
                                                                        document.getElementById("image-verified").classList.add(
                                                                            "bg-success");
                                                                        document.getElementById("btn-submit").classList.remove(
                                                                            "bg-danger");
                                                                        document.getElementById("btn-submit").classList.add(
                                                                            "bg-success");
                                                                    }
                                                                } else {
                                                                    if (document.getElementById("btn-submit").classList.contains(
                                                                            "bg-success")) {
                                                                        document.getElementById("image-verified").classList.remove(
                                                                            "bg-success");
                                                                        document.getElementById("image-verified").classList.add(
                                                                            "bg-danger");
                                                                        document.getElementById("btn-submit").classList.remove(
                                                                            "bg-success");
                                                                        document.getElementById("btn-submit").classList.add(
                                                                            "bg-danger");
                                                                    }
                                                                }
                                                                console.log("ClassProperties:", document.getElementById(
                                                                    "image-verified").classList.toString())
                                                            };
                                                            ajax.send(JSON.stringify({
                                                                imageData
                                                            }));
                                                        }, 3000); // Adjust the interval based on your requirements
                                                    })
                                                    .catch((error) => {
                                                        console.error('Error accessing camera:', error);
                                                    });
                                            } else {
                                                console.error('getUserMedia is not supported');
                                            }
                                        });
                                    </script>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </body>
</x-master-voter>
