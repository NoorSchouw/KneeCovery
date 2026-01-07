let kneeChart;

function loadKneeMetrics() {
    const exercise = $('#exerciseSelector').val();
    const range = $('#rangeSelector').val();

    $.get('/homepage/knee-metrics', { exercise, range }, function (data) {
        if (!data.length) {
            $('#Knee-extension-flexion').html('<div class="text-center text-muted">No data for this exercise</div>');
            return;
        }

        const dates = data.map(d => d.execution_date);
        const maxAngles = data.map(d => d.max_angle);
        const minAngles = data.map(d => d.min_angle);

        const options = {
            chart: {
                type: 'line',
                height: 300,
                background: '#1c1c1c', // dark card background
            },
            series: [
                { name: 'Max Angle', data: maxAngles },
                { name: 'Min Angle', data: minAngles }
            ],
            xaxis: {
                categories: dates,
                labels: { style: { colors: '#e5e5e5' } }
            },
            yaxis: {
                max: 180,
                labels: { style: { colors: '#e5e5e5' } }
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            colors: ['#ff69b4', '#FAAA89FF'], // Pink for max, orange for min
            grid: { borderColor: '#333' },
            tooltip: { theme: 'dark' }
        };

        if (!kneeChart) {
            kneeChart = new ApexCharts(document.querySelector("#Knee-extension-flexion"), options);
            kneeChart.render();
        } else {
            kneeChart.updateOptions(options);
        }
    });
}

// Trigger reload when selectors change
$('#exerciseSelector, #rangeSelector').on('change', loadKneeMetrics);

// Initial load
loadKneeMetrics();
