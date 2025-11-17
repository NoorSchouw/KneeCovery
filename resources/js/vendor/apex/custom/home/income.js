var options = {
  chart: {
    height: 370,
    type: "area",
    stacked: false,
    toolbar: { show: false },
    fontFamily: "SF Pro Display, Inter, sans-serif",
    animations: {
      enabled: true,
      easing: "easeOutQuart",
      speed: 900,
      animateGradually: { enabled: true, delay: 200 },
      dynamicAnimation: { enabled: true, speed: 600 },
    },
    dropShadow: {
      enabled: true,
      top: 2,
      left: 2,
      blur: 6,
      color: "rgba(0, 0, 0, 0.15)",
      opacity: 0.2,
    },
  },
  dataLabels: { enabled: false },
  plotOptions: {
    bar: {
      columnWidth: "35%",
      borderRadius: 12,
      endingShape: "rounded",
    },
  },
  stroke: {
    show: true,
    width: [0, 3],
    curve: "smooth",
    colors: ["#4F46E5"],
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
  fill: {
    type: ["solid", "gradient"],
    gradient: {
      shade: "light",
      type: "vertical",
      shadeIntensity: 0.4,
      gradientToColors: ["#6366F1", "#A5B4FC"],
      inverseColors: false,
      opacityFrom: 0.85,
      opacityTo: 0.25,
      stops: [0, 100],
    },
  },
  grid: {
    borderColor: "#E5E7EB",
    strokeDashArray: 4,
    xaxis: { lines: { show: false } },
    yaxis: { lines: { show: true } },
  },
  xaxis: {
    categories: [
      "Jan", "Feb", "Mar", "Apr", "May", "Jun",
      "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
    ],
    labels: {
      style: { fontSize: "13px", colors: "#6B7280", fontWeight: 500 },
    },
    axisBorder: { show: false },
    axisTicks: { show: false },
  },
  yaxis: {
    labels: { show: true, style: { colors: "#9CA3AF" } },
  },
  colors: ["#4F46E5", "#6366F1"],
  markers: {
    size: 6,
    strokeWidth: 2,
    strokeColors: "#fff",
    colors: ["#818CF8"],
    hover: { size: 9 },
  },
  tooltip: {
    theme: "dark",
    style: { fontSize: "14px", fontFamily: "Inter, sans-serif" },
    marker: { show: true },
    fillSeriesColor: true,
    y: {
      formatter: val => val,
    },
  },
  legend: {
    position: "top",
    horizontalAlign: "right",
    fontSize: "13px",
    labels: { colors: "#4B5563" },
    markers: { radius: 6 },
  },
};

var chart = new ApexCharts(document.querySelector("#income"), options);
chart.render();
