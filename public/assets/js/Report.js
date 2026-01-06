/**************************
 * 1. Globale variabele
 **************************/
let gaugeChart = null;



/**************************
 * 2. Gauge initialisatie
 **************************/
var options = {
    chart: { type: 'radialBar', height: 250 },
    series: [67],
    labels: [''],
    colors: ['#FD7596'],
    plotOptions: {
        radialBar: {
            dataLabels: {
                name: { show: false },
                value: {
                    show: true,
                    fontSize: '28px',
                    formatter: function(val) { return val + '%'; }
                }
            }
        }
    }
};

gaugeChart = new ApexCharts(document.querySelector("#gauge"), options);
gaugeChart.render();



/**************************
 * 3. updateGauge()
 **************************/
function updateGauge(value) {
    if (gaugeChart) {
        gaugeChart.updateSeries([value]);
    }
}

/**************************
 * 4. Datepicker + event listeners
 **************************/
document.addEventListener("DOMContentLoaded", function () {

    // FIXED: Daterangepicker werkt nu weer
    $('#report-date').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoUpdateInput: true,
        locale: { format: 'YYYY-MM-DD' }
    });

    $('#report-date').on('change', loadExecutions);
    $('#exercise-select').on('change', loadExecutions);
});


/**************************
 * 4. Event listeners voor filters
 **************************/
document.addEventListener("DOMContentLoaded", function () {

    $('#report-date').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoUpdateInput: true,
        locale: { format: 'YYYY-MM-DD' }
    });

    $('#report-date').on('change', loadExecutions);
    $('#exercise-select').on('change', loadExecutions);

    // 🚀 FIX: laad backend direct bij paginalaad
    loadExecutions();
});




/**************************
 * 5. loadExecutions() functie
 **************************/
async function loadExecutions() {

    const date = $('#report-date').val();
    const exercise = $('#exercise-select').val();

    if (!date || !exercise) return;

    const url = `/report/get-executions?date=${date}&exercise_id=${exercise}`;
    const res = await fetch(url);
    const executions = await res.json();

    const videoContainer = document.getElementById('video-container');
    const reportBox = document.getElementById('patient-report');

    if (executions.length === 0) {
        videoContainer.innerHTML = `<p>No video recorded for this date/exercise.</p>`;
        reportBox.innerHTML = "";
        updateGauge(0);
        return;
    }

    videoContainer.innerHTML = "";

    executions.forEach(exec => {
        videoContainer.innerHTML += `
            <div class="mb-3">
                <strong>${exec.start_time ?? "Unknown time"}</strong><br>
                <video width="100%" controls>
                    <source src="/${exec.execution_video_path}">
                </video>
            </div>
        `;
    });

    reportBox.innerText = executions[0].feedback ?? "No feedback";
    updateGauge(executions[0].score ?? 0);
}
