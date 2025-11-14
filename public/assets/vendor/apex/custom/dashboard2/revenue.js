var options = {
    chart: {
        height: 260,
        type: "line",
        toolbar: {
            show: false,
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        width: 5,
    },
    series: [
        {
            name: "Knee Flexion (°)",
            data: [125, 128, 130, 132, 134, 136, 138],
        },
        {
            name: "Knee Extension (°)",
            data: [4, 3, 3, 2, 2, 1, 0],
        },
    ],
    grid: {
        borderColor: "#d8dee6",
        strokeDashArray: 5,
        xaxis: {
            lines: {
                show: true,
            },
        },
        yaxis: {
            lines: {
                show: false,
            },
        },
        padding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0,
        },
    },
    xaxis: {
        categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
        title: {
            text: "Day of Week",
            style: {
                fontSize: "12px",
                color: "#6c757d",
            },
        },
    },
    yaxis: {
        title: {
            text: "Angle (degrees)",
            style: {
                fontSize: "12px",
                color: "#6c757d",
            },
        },
        min: 0,
        max: 140,
    },
    colors: ["#0d6efd", "#20c997"], // blue for flexion, green for extension
    markers: {
        size: 4,
        opacity: 0.9,
        colors: ["#0d6efd", "#20c997"],
        strokeColor: "#ffffff",
        strokeWidth: 2,
        hover: {
            size: 6,
        },
    },
    tooltip: {
        y: {
            formatter: function (val) {
                return val + "°";
            },
        },
    },
};

var chart = new ApexCharts(document.querySelector("#revenue"), options);

chart.render();
