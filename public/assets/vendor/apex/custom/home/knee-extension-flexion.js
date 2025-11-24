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

    stroke: {
        curve: "smooth",
        width: 4,
        colors: ["#fd7596", "#faaa89"],
    },

    markers: {
        size: 5,
        strokeWidth: 3,
        strokeColors: "#fff",
        colors: ["#fd7596"],
        hover: { size: 8 }
    },

    dataLabels: { enabled: false },

    /* ---------------------------------------------------
          REALISTIC ACL TEAR WEEK-1 ROM DATA
    --------------------------------------------------- */
    series: [
        {
            name: "Flexion (°)",
            type: "line",
            data: [45, 55, 65, 72, 78, 83, 88], // realistic week-1 flexion
        },
        {
            name: "Extension (°)",
            type: "line",
            data: [-8, -7, -6, -5, -3, -2, -1], // realistic week-1 extension
        }
    ],

    xaxis: {
        categories: [
            "Day 1", "Day 2", "Day 3", "Day 4", "Day 5", "Day 6", "Day 7"
        ],
        labels: {
            style: { fontSize: "13px", colors: "#6B7280", fontWeight: 500 },
        },
        axisBorder: { show: false },
        axisTicks: { show: false },
    },

    yaxis: {
        labels: {
            style: { colors: "#9CA3AF" },
            formatter: (val) => val + "°",
        }
    },

    grid: {
        borderColor: "#E5E7EB",
        strokeDashArray: 4,
    },

    colors: ["#fd7596", "#faaa89"],

    tooltip: {
        theme: "dark",
        y: {
            formatter: val => val + "°",
        },
    },

    legend: {
        position: "top",
        horizontalAlign: "right",
        fontSize: "13px",
        labels: { colors: "#4B5563" },
    },
};

var chart = new ApexCharts(document.querySelector("#Knee-extension-flexion"), options);
chart.render();
