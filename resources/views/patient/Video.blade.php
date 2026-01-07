
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Exercise Videos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">My Exercise Videos</h2>

@forelse ($executions as $execution)
    <div class="card mb-4 shadow-sm">
        <div class="card-body">

            <h5 class="card-title">
                {{ $execution->calendarEntry->exercise->exercise_name ?? 'Exercise' }}
            </h5>

            <p class="text-muted">
                Date: {{ $execution->execution_date }}
            </p>

            {{-- 🎥 VIDEO STREAMED THROUGH LARAVEL --}}
            <video width="100%" controls class="mb-3">
                <source src="{{ url('/video/' . $execution->execution_id) }}">
                Your browser does not support the video tag.
            </video>

            {{-- 📊 MATCH PERCENTAGE --}}
            <p>
                <strong>Match Percentage:</strong>
                {{ $execution->match_percentage }}%
            </p>

            {{-- 💬 FEEDBACK --}}
            <p>
                <strong>Feedback:</strong>

                {{ $execution->feedback }}
            </p>

        </div>
    </div>
@empty
    <p>No exercise executions found.</p>
    @endforelse
    </div>

    </body>
    </html>





