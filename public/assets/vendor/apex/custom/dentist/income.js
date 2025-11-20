var options = {
  chart: {
    height: 320,
    type: "area",
    toolbar: { show: false },
    fontFamily: "Inter, SF Pro Display, sans-serif",
    animations: {
      enabled: true,
      easing: "easeInOutQuart",
      speed: 1000,
      animateGradually: { enabled: true, delay: 150 },
      dynamicAnimation: { enabled: true, speed: 600 },
    },
  },

  series: [
    {
      name: "Appointments",
      type: "column",
      data: [10, 40, 15, 40, 20, 35, 20, 10, 31, 43, 56, 29],
    },
    {
      name: "Surgeries",
      type: "area",
      data: [2, 8, 25, 7, 20, 20, 51, 35, 42, 20, 33, 67],
    },
  ],

  colors: ["#566FE2", "#6480E7"],

  plotOptions: {
    bar: {
      columnWidth: "45%",
      borderRadius: 6,
      distributed: false,
    },
  },

  stroke: {
    curve: "smooth",
    width: [0, 4],
    lineCap: "round",
  },

  fill: {
    type: ["solid", "gradient"],
    gradient: {
      shade: "light",
      type: "vertical",
      shadeIntensity: 0.3,
      gradientToColors: ["#9CC6FA"],
      inverseColors: false,
      opacityFrom: 0.45,
      opacityTo: 0.05,
      stops: [0, 100],
    },
  },

  grid: {
    borderColor: "rgba(255,255,255,0.15)",
    strokeDashArray: 4,
    xaxis: { lines: { show: true } },
    yaxis: { lines: { show: false } },
    padding: { top: 5, right: 5, bottom: 5, left: 5 },
  },

  markers: {
    size: 5,
    strokeWidth: 2,
    strokeColors: "#fff",
    hover: { size: 7 },
    colors: ["#566FE2", "#6480E7"],
  },

  xaxis: {
    categories: [
      "Jan", "Feb", "Mar", "Apr", "May", "Jun",
      "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
    ],
    axisBorder: { show: false },
    axisTicks: { show: false },
    labels: {
      style: {
        colors: "#E5E7EB",
        fontSize: "12px",
        fontWeight: 500,
      },
    },
  },

  yaxis: {
    labels: { show: false },
  },

  legend: {
    position: "bottom",
    horizontalAlign: "center",
    fontSize: "13px",
    labels: {
      colors: "#F3F4F6",
    },
    markers: {
      width: 10,
      height: 10,
      radius: 12,
    },
  },

  tooltip: {
    theme: "dark",
    fillSeriesColor: true,
    style: {
      fontSize: "13px",
      fontFamily: "Inter, sans-serif",
      color: "#fff",
    },
    y: {
      formatter: function (val) {
        return "$" + val + "k";
      },
    },
  },
};

var chart = new ApexCharts(document.querySelector("#income"), options);
chart.render();
