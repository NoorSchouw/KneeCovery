// Date picker init (moet nog aangepast worden)
$('#report-date').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    autoUpdateInput: true,
    locale: {
        format: 'YYYY-MM-DD'
    }
});

// Gauge
var options = {
    chart: { type: 'radialBar', height: 250 },
    series: [67],
    labels: [''], // Score label weg
    colors: ['#FD7596'], // Cirkel roze
    plotOptions: {
        radialBar: {
            dataLabels: {
                name: { show: false },
                value: {
                    show: true,
                    fontSize: '28px', // percentage groter
                    color: undefined, // standaard kleur
                    formatter: function(val) { return val + '%'; }
                }
            }
        }
    }
};
var chart = new ApexCharts(document.querySelector("#gauge"), options);
chart.render();




