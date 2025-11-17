var options = {
  chart: {
    height: 260,
    type: "line",
    toolbar: { show: false },
    fontFamily: "Inter, SF Pro Display, sans-serif",
    animations: {
      enabled: true,
      easing: "easeInOutQuart",
      speed: 1000,
      animateGradually: { enabled: true, delay: 150 },
      dynamicAnimation: { enabled: true, speed: 600 },
    },
    dropShadow: {
      enabled: true,
      top: 3,
      left: 0,
      blur: 8,
      color: "#566FE2",
      opacity: 0.2,
    },
  },

  series: [
    {
      name: "New",
      type: "area",
      data: [400, 500, 400, 600, 500, 600, 500, 700, 600, 800, 700, 900],
    },
    {
      name: "Return",
      type: "line",
      data: [300, 400, 500, 600, 400, 500, 400, 600, 400, 600, 600, 800],
    },
  ],

  colors: ["#566FE2", "#6480E7"],

  stroke: {
    curve: "smooth",
    width: [4, 3],
    lineCap: "round",
  },

  fill: {
    type: "gradient",
    gradient: {
      shade: "light",
      type: "vertical",
      shadeIntensity: 0.4,
      gradientToColors: ["#80A3F1", "#9CC6FA"],
      inverseColors: false,
      opacityFrom: 0.45,
      opacityTo: 0.1,
      stops: [0, 90, 100],
    },
  },

  grid: {
    borderColor: "rgba(255,255,255,0.15)",
    strokeDashArray: 4,
    yaxis: { lines: { show: true } },
    xaxis: { lines: { show: false } },
    padding: { top: 10, right: 10, bottom: 0, left: 10 },
  },

  markers: {
    size: 5,
    strokeWidth: 2,
    strokeColors: "#fff",
    hover: { size: 8 },
    colors: ["#566FE2", "#6480E7"],
    discrete: [],
    animation: {
      enabled: true,
      speed: 200,
    },
  },

  xaxis: {
    categories: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ],
    axisBorder: { show: false },
    axisTicks: { show: false },
    labels: {
      style: {
        colors: "#808896ff",
        fontSize: "12px",
        fontWeight: 500,
      },
    },
  },

  yaxis: {
    labels: {
      show: false,
    },
  },

  legend: {
    position: "bottom",
    horizontalAlign: "center",
    fontSize: "13px",
    labels: {
      colors: "#adb3beff",
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
    marker: {
      show: true,
    },
    y: {
      formatter: (val) => val,
    },
  },
};

var chart = new ApexCharts(document.querySelector("#patients"), options);
chart.render();
