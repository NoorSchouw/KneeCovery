$(document).ready(function () {

    $('#executionSelect').on('change', function () {

        const executionId = $(this).val();
        if (!executionId) return;

        $.get(`/report/execution/by-id/${executionId}`, function (data) {

            // Geen execution
            if (!data) {
                $('#executionVideo').hide();
                $('#noVideoText').show();
                $('#feedbackText').text('No feedback available.');
                $('#matchPercentage').text('0%');
                return;
            }

            // Video
            $('#videoSource').attr('src', data.video_url);
            $('#executionVideo')[0].load();
            $('#executionVideo').show();
            $('#noVideoText').hide();

            // Feedback
            $('#feedbackText').text(data.feedback ?? 'No feedback available.');

            // Match percentage
            $('#matchPercentage').text(data.match_percentage + '%');
        });
    });

});
