let progressChart;

function loadProgress() {
    const exercise = $('#exerciseSelector').val();
    const range = $('#rangeSelector').val();

    $.get('/homepage/progress', { exercise, range }, function (data) {
        if (!data.length) {
            $('#Progress').html('<div class="text-center text-muted">No data for this exercise</div>');
            return;
        }

        const dates = data.map(d => d.execution_date);
        const values = data.map(d => d.match_percentage);

        const options = {
            chart: {
                type: 'line',
                height: 300,
                background: '#1c1c1c', // dark card background
            },
            series: [{
                name: 'Match %',
                data: values
            }],
            xaxis: {
                categories: dates,
                labels: { style: { colors: '#e5e5e5' } }
            },
            yaxis: {
                max: 100,
                labels: { style: { colors: '#e5e5e5' } }
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            colors: ['#ff69b4'], // Pink line
            grid: { borderColor: '#333' },
            tooltip: { theme: 'dark' },
        };

        if (!progressChart) {
            progressChart = new ApexCharts(document.querySelector("#Progress"), options);
            progressChart.render();
        } else {
            progressChart.updateOptions(options);
        }
    });
}

// Trigger reload when selectors change
$('#exerciseSelector, #rangeSelector').on('change', loadProgress);

// Initial load
loadProgress();
