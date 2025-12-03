<div class="col-12">
    <div class="card mb-4 w-100">
        <div class="card-body">
            <div class="row align-items-center">

                <!-- Video -->
                <div class="col-sm-6">
                    <video class="img-fluid rounded-2 w-100" controls preload="none">
                        <source src="{{ asset('assets/videos/' . $video) }}" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>
                </div>

                <!-- Text -->
                <div class="col-sm-6 d-flex flex-column justify-content-between">

                    <div>
                        <h5 class="header-text">{{ $title }}</h5>

                        <p>
                            <strong>How to perform:</strong><br>
                            @foreach ($steps as $step)
                                {{ $loop->iteration }}. {{ $step }}<br>
                            @endforeach
                        </p>
                    </div>

                    <div class="text-end">
                        <a href="{{url("/filming")}}" class="btn btn-primary">Start Exercise</a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
