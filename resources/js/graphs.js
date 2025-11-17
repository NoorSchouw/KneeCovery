// Import ApexCharts library - it's a minified file without ES6 exports
// So we import it for side effects and use the global ApexCharts
import './vendor/apex/apexcharts.min.js';

// ApexCharts is now available globally
const ApexCharts = window.ApexCharts;

// Function to safely check if element exists and render chart
function renderChart(selector, options) {
    const element = document.querySelector(selector);
    if (element) {
        try {
            const chart = new ApexCharts(element, options);
            chart.render();
        } catch (error) {
            console.error(`Error rendering chart ${selector}:`, error);
        }
    }
}

// Wait for DOM to be fully loaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initGraphs);
} else {
    // DOM is already loaded
    setTimeout(initGraphs, 100);
}

function initGraphs() {
    const colors = ["#207a5a", "#248a65", "#566fe2", "#3ea37e", "#53ad8d", "#69b89b", "#7ec2a9", "#94ccb8", "#a9d6c6"];
    
    // Gauge
    renderChart("#gauge", {
        series: [75],
        chart: { height: 220, type: "radialBar", offsetY: -10 },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 135,
                dataLabels: {
                    name: { fontSize: "16px", offsetY: 120 },
                    value: {
                        offsetY: 76,
                        fontSize: "21px",
                        formatter: function (val) { return val + "%"; }
                    }
                }
            }
        },
        colors: colors,
        stroke: { dashArray: 4 },
        labels: ["Sales Ratio"]
    });

    // Radial Bar
    renderChart("#radial", {
        series: [40, 50, 60, 70, 80],
        chart: { height: 240, type: "radialBar" },
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: { fontSize: "22px" },
                    value: { fontSize: "16px" },
                    total: {
                        show: true,
                        label: "Total",
                        formatter: function (w) { return 249; }
                    }
                }
            }
        },
        labels: ["Samsung", "Apple", "Nokia", "Motorola", "Huawei"],
        colors: colors
    });

    // Funnel
    renderChart("#funnel", {
        series: [{ name: "Tickets", data: [1100, 880, 740, 548, 330, 200] }],
        chart: { type: "bar", height: 300, toolbar: { show: false } },
        plotOptions: {
            bar: {
                borderRadius: 0,
                horizontal: true,
                distributed: true,
                barHeight: "80%",
                isFunnel: true
            }
        },
        colors: colors,
        dataLabels: {
            enabled: true,
            formatter: function (val, opt) {
                return opt.w.globals.labels[opt.dataPointIndex];
            },
            dropShadow: { enabled: true }
        },
        xaxis: {
            categories: ["Closed", "Hold", "Resolved", "Waiting", "On Going", "Total"]
        },
        legend: { show: true }
    });

    // Pyramid
    renderChart("#pyramid", {
        series: [{ name: "Tickets", data: [200, 330, 548, 740, 880, 1100] }],
        chart: { type: "bar", height: 300, toolbar: { show: false } },
        plotOptions: {
            bar: {
                borderRadius: 0,
                horizontal: true,
                distributed: true,
                barHeight: "80%",
                isFunnel: true
            }
        },
        colors: colors,
        dataLabels: {
            enabled: true,
            formatter: function (val, opt) {
                return opt.w.globals.labels[opt.dataPointIndex];
            },
            dropShadow: { enabled: true }
        },
        xaxis: {
            categories: ["Closed", "Hold", "Resolved", "In Progress", "Open", "Total"]
        },
        legend: { show: true }
    });

    // Donut
    renderChart("#donut", {
        chart: { width: 300, type: "donut" },
        labels: ["Team A", "Team B", "Team C", "Team D", "Team E"],
        series: [20, 20, 20, 20, 20],
        legend: { position: "bottom" },
        dataLabels: { enabled: false },
        stroke: { width: 0 },
        colors: colors
    });

    // Pie
    renderChart("#pie", {
        chart: { width: 300, type: "pie" },
        labels: ["Team A", "Team B", "Team C", "Team D", "Team E"],
        series: [20, 20, 20, 20, 20],
        legend: { position: "bottom" },
        dataLabels: { enabled: false },
        stroke: { width: 0 },
        colors: colors
    });

    // CandleStick
    renderChart("#candleStick", {
        chart: {
            height: 300,
            type: "candlestick",
            toolbar: { show: false },
            dropShadow: { enabled: true, opacity: 0.1, blur: 5, left: -10, top: 10 }
        },
        series: [{
            data: [
                { x: new Date(1538778600000), y: [6629.81, 6650.5, 6623.04, 6633.33] },
                { x: new Date(1538780400000), y: [6632.01, 6643.59, 6620, 6630.11] },
                { x: new Date(1538782200000), y: [6630.71, 6648.95, 6623.34, 6635.65] },
                { x: new Date(1538784000000), y: [6635.65, 6651, 6629.67, 6638.24] },
                { x: new Date(1538785800000), y: [6638.24, 6640, 6620, 6624.47] },
                { x: new Date(1538787600000), y: [6624.53, 6636.03, 6621.68, 6624.31] },
                { x: new Date(1538789400000), y: [6624.61, 6632.2, 6617, 6626.02] },
                { x: new Date(1538791200000), y: [6627, 6627.62, 6584.22, 6603.02] },
                { x: new Date(1538793000000), y: [6605, 6608.03, 6598.95, 6604.01] },
                { x: new Date(1538794800000), y: [6604.5, 6614.4, 6602.26, 6608.02] },
                { x: new Date(1538796600000), y: [6608.02, 6610.68, 6601.99, 6608.91] }
            ]
        }],
        plotOptions: {
            candlestick: {
                colors: { upward: "#566fe2", downward: "#cf434f" }
            }
        },
        grid: { borderColor: "#dfd6ff" },
        xaxis: { type: "datetime" },
        yaxis: { tooltip: { enabled: true } }
    });

    // Area Graph
    renderChart("#areaGraph", {
        chart: { height: 300, type: "area", toolbar: { show: false } },
        dataLabels: { enabled: false },
        stroke: { curve: "smooth", width: 3 },
        series: [
            { name: "Sales", data: [10, 40, 15, 40, 20, 35, 20, 10, 31, 43, 56, 29] },
            { name: "Revenue", data: [2, 8, 25, 7, 20, 20, 51, 35, 42, 20, 33, 67] }
        ],
        grid: {
            borderColor: "#dfd6ff",
            strokeDashArray: 5,
            xaxis: { lines: { show: true } },
            yaxis: { lines: { show: false } },
            padding: { top: 0, right: 0, bottom: 10, left: 0 }
        },
        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
        },
        yaxis: { labels: { show: false } },
        colors: colors,
        markers: {
            size: 0,
            opacity: 0.3,
            colors: ["#2f477a", "#35508a", "#3b5999", "#4f6aa3", "#627aad", "#768bb8", "#899bc2", "#9daccc"],
            strokeColor: "#ffffff",
            strokeWidth: 2,
            hover: { size: 7 }
        }
    });

    // Line Graph
    renderChart("#lineGraph", {
        chart: { height: 300, type: "line", toolbar: { show: false } },
        dataLabels: { enabled: false },
        stroke: { curve: "smooth", width: 3 },
        series: [
            { name: "Sales", data: [10, 40, 15, 40, 20, 35, 20, 10, 31, 43, 56, 29] },
            { name: "Revenue", data: [2, 8, 25, 7, 20, 20, 51, 35, 42, 20, 33, 67] }
        ],
        grid: {
            borderColor: "#dfd6ff",
            strokeDashArray: 5,
            xaxis: { lines: { show: true } },
            yaxis: { lines: { show: false } },
            padding: { top: 0, right: 0, bottom: 10, left: 0 }
        },
        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
        },
        yaxis: { labels: { show: false } },
        colors: colors,
        markers: {
            size: 0,
            opacity: 0.3,
            colors: colors,
            strokeColor: "#ffffff",
            strokeWidth: 2,
            hover: { size: 7 }
        }
    });

    // Bar Graph
    renderChart("#barGraph", {
        chart: { height: 300, type: "bar", toolbar: { show: false } },
        dataLabels: { enabled: false },
        stroke: { curve: "smooth", width: 3 },
        series: [
            { name: "Sales", data: [10, 40, 15, 40, 20, 35, 20, 10, 31, 43, 56, 29] },
            { name: "Revenue", data: [2, 8, 25, 7, 20, 20, 51, 35, 42, 20, 33, 67] }
        ],
        grid: {
            borderColor: "#dfd6ff",
            strokeDashArray: 5,
            xaxis: { lines: { show: true } },
            yaxis: { lines: { show: false } },
            padding: { top: 0, right: 0, bottom: 10, left: 0 }
        },
        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
        },
        yaxis: { labels: { show: false } },
        colors: colors,
        markers: {
            size: 0,
            opacity: 0.3,
            colors: ["#2f477a", "#35508a", "#3b5999", "#4f6aa3", "#627aad", "#768bb8", "#899bc2", "#9daccc"],
            strokeColor: "#ffffff",
            strokeWidth: 2,
            hover: { size: 7 }
        }
    });

    // Column Area Graph
    renderChart("#columnArea", {
        series: [
            { name: "Income", type: "column", data: [25, 12, 20, 85, 12, 25, 19, 23, 18, 15, 22, 28] },
            { name: "Expenses", type: "area", data: [44, 55, 50, 40, 30, 10, 12, 22, 15, 19, 20, 17] }
        ],
        chart: { height: 300, type: "line", toolbar: { show: false } },
        stroke: { width: [0, 3], curve: "smooth" },
        plotOptions: {
            bar: {
                columnWidth: "70%",
                borderRadius: 8,
                distributed: true,
                dataLabels: { position: "top" }
            }
        },
        fill: {
            opacity: [0.85, 0.25, 1],
            gradient: {
                inverseColors: false,
                shade: "light",
                type: "vertical",
                opacityFrom: 0.85,
                opacityTo: 0.55,
                stops: [0, 100, 100, 100]
            }
        },
        markers: { size: 0 },
        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            axisBorder: { show: false },
            tooltip: { enabled: true },
            labels: { show: true, rotate: -45, rotateAlways: true }
        },
        yaxis: { show: false },
        legend: { show: false },
        grid: {
            borderColor: "#dfd6ff",
            strokeDashArray: 5,
            xaxis: { lines: { show: true } },
            yaxis: { lines: { show: false } },
            padding: { top: 0, right: 0, bottom: -20, left: 10 }
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " million";
                }
            }
        },
        colors: colors
    });

    // Heatmap
    renderChart("#heatmap", {
        series: [
            {
                name: "USA",
                data: [{ x: "Q1", y: 27 }, { x: "Q2", y: 36 }, { x: "Q3", y: 25 }, { x: "Q4", y: 32 }]
            },
            {
                name: "India",
                data: [{ x: "Q1", y: 43 }, { x: "Q2", y: 35 }, { x: "Q3", y: 26 }, { x: "Q4", y: 55 }]
            },
            {
                name: "Brazil",
                data: [{ x: "Q1", y: 28 }, { x: "Q2", y: 32 }, { x: "Q3", y: 16 }, { x: "Q4", y: 22 }]
            },
            {
                name: "Indonesia",
                data: [{ x: "Q1", y: 32 }, { x: "Q2", y: 21 }, { x: "Q3", y: 20 }, { x: "Q4", y: 46 }]
            }
        ],
        legend: { show: false },
        chart: { height: 300, type: "heatmap", toolbar: { show: false } },
        colors: colors,
        tooltip: {
            y: {
                formatter: function (val) {
                    return "$" + val + " Million";
                }
            }
        }
    });
}
