document.addEventListener("DOMContentLoaded", function() {

    // -------------------------------
    // Exercise Progress Data (Week 1)
    // -------------------------------
    const exerciseProgress = {
        heelSlides: [95, 90, 92, 95, 100],
        squat: [100, 95, 87, 90, 95, 100, 100],
        hamstringCurls: [88, 85, 88, 92, 97, 100, 100]
    };

    const exerciseNames = {
        heelSlides: "Heel Slide Flexion",
        squat: "Squat Depth",
        hamstringCurls: "Hamstring Curls"
    };

    // -------------------------------
    // ApexCharts Options
    // -------------------------------
    var options = {
        chart: {
            height: 370,
            type: "line",
            stacked: false,
            toolbar: { show: false },
            fontFamily: "SF Pro Display, Inter, sans-serif",
            animations: {
                enabled: true,
                easing: "easeOutQuart",
                speed: 900,
                animateGradually: { enabled: true, delay: 200 },
                dynamicAnimation: { enabled: true, speed: 600 },
            }
        },
        stroke: { curve: "smooth", width: 4, colors: ["#fd7596"] },
        markers: { size: 5, strokeWidth: 3, strokeColors: "#fff", colors: ["#fd7596"], hover: { size: 8 } },
        dataLabels: { enabled: false },
        series: [
            { name: exerciseNames.heelSlides + " (%)", data: exerciseProgress.heelSlides }
        ],
        xaxis: {
            categories: ["25/11", "27/11", "29/11", "01/12", "03/12", "05/12"],
            labels: { style: { fontSize: "13px", colors: "#6B7280", fontWeight: 500 } },
            axisBorder: { show: false },
            axisTicks: { show: false }
        },
        yaxis: {
            min: 80,
            max: 100,
            labels: { style: { colors: "#9CA3AF" }, formatter: (val) => val + "%" }
        },
        grid: { borderColor: "#E5E7EB", strokeDashArray: 4 },
        tooltip: { theme: "dark", y: { formatter: val => val + "%" } },
        legend: { position: "top", horizontalAlign: "right", fontSize: "13px", labels: { colors: "#4B5563" } }
    };

    // -------------------------------
    // Initialize Chart
    // -------------------------------
    var chart = new ApexCharts(document.querySelector("#Progress"), options);
    chart.render();

    // -------------------------------
    // Update Chart on Exercise Selection
    // -------------------------------
    const selector = document.getElementById("exerciseSelector");
    selector.addEventListener("change", function() {
        const selected = this.value;
        chart.updateSeries([{
            name: exerciseNames[selected] + " (%)",
            data: exerciseProgress[selected]
        }]);
    });

});
