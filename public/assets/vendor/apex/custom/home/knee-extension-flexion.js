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
            data: [150, 145 , 145, 130, 120, 110], // realistic week-1 flexion
        },
        {
            name: "Extension (°)",
            type: "line",
            data: [160, 160, 165, 168, 170, 170], // realistic week-1 extension
        }
    ],

    xaxis: {
        categories: [
            "25/11", "27/11", "29/11", "01/12", "03/12", "05/12"
        ],
        labels: {
            style: { fontSize: "13px", colors: "#6B7280", fontWeight: 500 },
        },
        axisBorder: { show: false },
        axisTicks: { show: false },
    },

    yaxis: {
        min: 90,
        max: 180,
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
