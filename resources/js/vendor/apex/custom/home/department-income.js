var options = {
  chart: {
    height: 350,
    type: "line",
    toolbar: { show: false },
    fontFamily: "SF Pro Display, Inter, sans-serif",
    animations: {
      enabled: true,
      easing: "easeInOutCubic",
      speed: 900,
      animateGradually: { enabled: true, delay: 150 },
      dynamicAnimation: { enabled: true, speed: 600 },
    },
  },

  dataLabels: { enabled: false },

  fill: {
    type: ["gradient", "gradient", "gradient", "solid"],
    gradient: {
      shade: "light",
      type: "vertical",
      shadeIntensity: 0.4,
      gradientToColors: ["#8EB4F5", "#9CC6FA", "#AAD7FF"],
      inverseColors: false,
      opacityFrom: 0.7,
      opacityTo: 0.15,
      stops: [0, 100],
    },
  },

  stroke: {
    curve: "smooth",
    width: [0, 0, 0, 4],
    lineCap: "round",
  },

  series: [
    {
      name: "Neurology",
      type: "bar",
      data: [400, 450, 500, 550, 600, 650, 700, 750, 800, 850, 900, 950],
    },
    {
      name: "Dental Care",
      type: "bar",
      data: [300, 350, 400, 450, 500, 550, 600, 650, 700, 750, 800, 850],
    },
    {
      name: "Gynocology",
      type: "bar",
      data: [200, 250, 300, 350, 400, 450, 500, 550, 600, 650, 700, 750],
    },
    {
      name: "Orthopedic",
      type: "line",
      data: [100, 150, 200, 250, 300, 350, 400, 450, 500, 550, 600, 650],
    },
  ],

  colors: ["#566FE2", "#6480E7", "#7292EC", "#80A3F1"],

  plotOptions: {
    bar: {
      columnWidth: "45%",
      borderRadius: 8,
      endingShape: "rounded",
    },
  },

  grid: {
    borderColor: "rgba(0,0,0,0.08)",
    strokeDashArray: 4,
    xaxis: { lines: { show: false } },
    yaxis: { lines: { show: false } },
    padding: { top: 10, right: 0, bottom: 0, left: 0 },
  },

  xaxis: {
    categories: [
      "Jan", "Feb", "Mar", "Apr", "May", "Jun",
      "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
    ],
    labels: {
      style: {
        colors: "#6B7280",
        fontSize: "12px",
        fontWeight: 500,
      },
    },
    axisBorder: { show: false },
    axisTicks: { show: false },
  },

  yaxis: { labels: { show: false } },

  markers: {
    size: 6,
    colors: ["#fff"],
    strokeColors: "#80A3F1",
    strokeWidth: 3,
    hover: { size: 8 },
  },

  tooltip: {
    theme: "dark",
    fillSeriesColor: true,
    style: { fontSize: "13px", color: "#fff" },
    y: {
      formatter: function (val) {
        return "$" + val + "k";
      },
    },
  },

  legend: {
    position: "bottom",
    horizontalAlign: "center",
    fontSize: "13px",
    markers: { radius: 12 },
    labels: { colors: "#4B5563" },
    itemMargin: { horizontal: 10, vertical: 4 },
  },
};

var chart = new ApexCharts(document.querySelector("#departments"), options);
chart.render();