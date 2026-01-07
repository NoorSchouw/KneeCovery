// /**************************
//  * Globale variabelen
//  **************************/
// let gaugeChart = null;
//
// /**************************
//  * Gauge initialisatie
//  **************************/
// const options = {
//     chart: { type: 'radialBar', height: 250 },
//     series: [0],
//     labels: [''],
//     colors: ['#FD7596'],
//     plotOptions: {
//         radialBar: {
//             dataLabels: {
//                 name: { show: false },
//                 value: {
//                     show: true,
//                     fontSize: '28px',
//                     formatter: function(val) { return val + '%'; }
//                 }
//             }
//         }
//     }
// };
//
// gaugeChart = new ApexCharts(document.querySelector("#gauge"), options);
// gaugeChart.render();
//
// /**************************
//  * updateGauge()
//  **************************/
// function updateGauge(value) {
//     if (gaugeChart) {
//         gaugeChart.updateSeries([value]);
//     }
// }
//
// /**************************
//  * loadExecutions()
//  **************************/
// async function loadExecutions() {
//     const date = $('#report-date').val();
//     const exercise = parseInt($('#exercise-select').val(), 10);
//
//     console.log("Selected date:", date);
//     console.log("Selected exercise_id:", exercise);
//
//     if (!date || !exercise) return;
//
//     const url = `/report/get-executions?date=${date}&exercise_id=${exercise}`;
//     const res = await fetch(url);
//     const executions = await res.json();
//
//     console.log("Executions returned from backend:", executions);
//
//     const videoContainer = document.getElementById('video-container');
//     const reportBox = document.getElementById('patient-report');
//
//     if (!executions || executions.length === 0) {
//         videoContainer.innerHTML = `<p>No video recorded for this date/exercise.</p>`;
//         reportBox.innerHTML = "";
//         updateGauge(0);
//         return;
//     }
//
//     // Plaats de video van de eerste execution
//     videoContainer.innerHTML = `
//         <video width="100%" controls>
//             <source src="/${executions[0].execution_video_path}" type="video/webm">
//             Your browser does not support the video tag.
//         </video>
//     `;
//
//     // Feedback tonen
//     reportBox.innerText = executions[0].feedback ?? "No feedback";
//
//     // Match percentage in gauge
//     updateGauge(executions[0].match_percentage ?? 0);
// }
//
// /**************************
//  * Datepicker + Event listeners
//  **************************/
// $(document).ready(function() {
//     // Datepicker
//     $('#report-date').daterangepicker({
//         singleDatePicker: true,
//         showDropdowns: true,
//         autoUpdateInput: true,
//         locale: { format: 'YYYY-MM-DD' }
//     });
//
//     // Event listeners
//     $('#report-date').on('change', loadExecutions);
//     $('#exercise-select').on('change', loadExecutions);
//
//     // Initial load
//     loadExecutions();
// });


// //**************************
// * Globale variabelen
// **************************/

// document.addEventListener("DOMContentLoaded", function () {
//
//     // Gauge initialiseren
//     var options = {
//         chart: { type: 'radialBar', height: 250 },
//         series: [0], // standaard 0
//         labels: [''],
//         colors: ['#FD7596'],
//         plotOptions: {
//             radialBar: {
//                 dataLabels: {
//                     name: { show: false },
//                     value: {
//                         show: true,
//                         fontSize: '28px',
//                         formatter: function(val) { return val + '%'; }
//                     }
//                 }
//             }
//         }
//     };
//
//     var gaugeChart = new ApexCharts(document.querySelector("#gauge"), options);
//     gaugeChart.render();
//
//     // Match percentage uit Blade ophalen
//     var matchPercentage = {{ $execution ? $execution->match_percentage : 0 }};
//     gaugeChart.updateSeries([matchPercentage]);
// });
