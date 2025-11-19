var options = {
  chart: {
    height: 300,
    type: "area",
    toolbar: { show: false },
    fontFamily: "Inter, SF Pro Display, sans-serif",
    animations: {
      enabled: true,
      easing: "easeInOutCubic",
      speed: 900,
      animateGradually: { enabled: true, delay: 200 },
      dynamicAnimation: { enabled: true, speed: 600 },
    },
  },

  dataLabels: { enabled: false },

  stroke: {
    curve: "smooth",
    width: 4,
    lineCap: "round",
  },

  series: [
    {
      name: "New",
      data: [0, 10, 60, 30, 100, 50, 150],
    },
    {
      name: "Return",
      data: [0, 40, 20, 80, 40, 120, 60],
    },
  ],

  colors: ["#566FE2", "#80A3F1"],

  fill: {
    type: "gradient",
    gradient: {
      shade: "light",
      type: "vertical",
      shadeIntensity: 0.4,
      gradientToColors: ["#9CC6FA", "#AAD7FF"],
      inverseColors: false,
      opacityFrom: 0.5,
      opacityTo: 0.05,
      stops: [0, 100],
    },
  },

  grid: {
    borderColor: "rgba(0,0,0,0.08)",
    strokeDashArray: 5,
    padding: { top: 5, right: 0, bottom: 5, left: 20 },
    xaxis: { lines: { show: false } },
    yaxis: { lines: { show: false } },
  },

  xaxis: {
    categories: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
    axisBorder: { show: false },
    axisTicks: { show: false },
    labels: {
      style: {
        colors: "#6B7280",
        fontSize: "12px",
        fontWeight: 500,
      },
    },
  },

  yaxis: {
    labels: { show: false },
  },

  markers: {
    size: 5,
    colors: ["#fff"],
    strokeColors: ["#566FE2", "#80A3F1"],
    strokeWidth: 3,
    hover: { size: 8 },
  },

  tooltip: {
    theme: "dark",
    fillSeriesColor: true,
    style: {
      fontSize: "13px",
      color: "#fff",
      fontFamily: "Inter, sans-serif",
    },
    y: {
      formatter: function (val) {
        return val;
      },
    },
  },

  legend: {
    position: "top",
    horizontalAlign: "right",
    fontSize: "13px",
    labels: {
      colors: "#4B5563",
    },
    markers: {
      width: 10,
      height: 10,
      radius: 12,
    },
  },
};

var chart = new ApexCharts(document.querySelector("#patients"), options);
chart.render();
