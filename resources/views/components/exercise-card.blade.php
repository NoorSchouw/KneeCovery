<div class="col-12">
    <div class="card mb-4 w-100">
        <div class="card-body">
            <div class="row align-items-center">

                <!-- Video -->
                <div class="col-sm-6">
                    <video class="img-fluid rounded-2 w-100" controls preload="none">
                        <source src="{{ asset('assets/videos/' . $exercise->exercise_video_path) }}" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>
                </div>

                <!-- Text -->
                <div class="col-sm-6 d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="header-text">{{ $exercise->exercise_name }}</h5>

                        <p>
                            <strong>Frequency:</strong> {{ $exercise->frequency ?? 'Not specified' }}<br>
                            <strong>Date:</strong> {{ \Carbon\Carbon::parse($exercise->date)->format('d M Y') }}<br>
                            <strong>How to perform:</strong><br>
                            @foreach (explode('|', $exercise->exercise_description ?? '') as $step)
                                {{ $loop->iteration }}. {{ $step }}<br>
                            @endforeach
                        </p>
                    </div>

                    <div class="text-end">
                        @if($exercise->is_today)
                            <a href="{{ route('filming.show', ['calendar_entry' => $exercise->calendar_entry_id]) }}" class="btn btn-primary">Start Exercise</a>
                        @else
                            <span class="text-muted">Not scheduled for today</span>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
