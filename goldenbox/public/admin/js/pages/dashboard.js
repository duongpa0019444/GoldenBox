<<<<<<< HEAD
/**
* Theme: Larkon - Responsive Bootstrap 5 Admin Dashboard
* Author: Techzaa
* Module/App: Dashboard
*/

//
// Conversions
// 
var options = {
    chart: {
        height: 292,
        type: 'radialBar',
    },
    plotOptions: {
        radialBar: {
            startAngle: -135,
            endAngle: 135,
            dataLabels: {
                name: {
                    fontSize: '14px',
                    color: "undefined",
                    offsetY: 100
                },
                value: {
                    offsetY: 55,
                    fontSize: '20px',
                    color: undefined,
                    formatter: function (val) {
                        return val + "%";
                    }
                }
            },
            track: {
                background: "rgba(170,184,197, 0.2)",
                margin: 0
            },
        }
    },
    fill: {
        gradient: {
            enabled: true,
            shade: 'dark',
            shadeIntensity: 0.2,
            inverseColors: false,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 50, 65, 91]
        },
    },
    stroke: {
        dashArray: 4
    },
    colors: ["#ff6c2f", "#22c55e"],
    series: [65.2],
    labels: ['Returning Customer'],
    responsive: [{
        breakpoint: 380,
        options: {
            chart: {
                height: 180
            }
        }
    }],
    grid: {
        padding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
        }
    }
}

var chart = new ApexCharts(
    document.querySelector("#conversions"),
    options
);

chart.render();


//
//Performance-chart
//
var options = {
    series: [{
        name: "Page Views",
        type: "bar",
        data: [34, 65, 46, 68, 49, 61, 42, 44, 78, 52, 63, 67],
    },
    {
        name: "Clicks",
        type: "area",
        data: [8, 12, 7, 17, 21, 11, 5, 9, 7, 29, 12, 35],
    },
    ],
    chart: {
        height: 313,
        type: "line",
        toolbar: {
            show: false,
        },
    },
    stroke: {
        dashArray: [0, 0],
        width: [0, 2],
        curve: 'smooth'
    },
    fill: {
        opacity: [1, 1],
        type: ['solid', 'gradient'],
        gradient: {
            type: "vertical",
            inverseColors: false,
            opacityFrom: 0.5,
            opacityTo: 0,
            stops: [0, 90]
        },
    },
    markers: {
        size: [0, 0],
        strokeWidth: 2,
        hover: {
            size: 4,
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
        axisTicks: {
            show: false,
        },
        axisBorder: {
            show: false,
        },
    },
    yaxis: {
        min: 0,
        axisBorder: {
            show: false,
        }
    },
    grid: {
        show: true,
        strokeDashArray: 3,
        xaxis: {
            lines: {
                show: false,
            },
        },
        yaxis: {
            lines: {
                show: true,
            },
        },
        padding: {
            top: 0,
            right: -2,
            bottom: 0,
            left: 10,
        },
    },
    legend: {
        show: true,
        horizontalAlign: "center",
        offsetX: 0,
        offsetY: 5,
        markers: {
            width: 9,
            height: 9,
            radius: 6,
        },
        itemMargin: {
            horizontal: 10,
            vertical: 0,
        },
    },
    plotOptions: {
        bar: {
            columnWidth: "30%",
            barHeight: "70%",
            borderRadius: 3,
        },
    },
    colors: ["#ff6c2f", "#22c55e"],
    tooltip: {
        shared: true,
        y: [{
            formatter: function (y) {
                if (typeof y !== "undefined") {
                    return y.toFixed(1) + "k";
                }
                return y;
            },
        },
        {
            formatter: function (y) {
                if (typeof y !== "undefined") {
                    return y.toFixed(1) + "k";
                }
                return y;
            },
        },
        ],
    },
}

var chart = new ApexCharts(
    document.querySelector("#dash-performance-chart"),
    options
);

chart.render();


class VectorMap {


    initWorldMapMarker() {
        const map = new jsVectorMap({
            map: 'world',
            selector: '#world-map-markers',
            zoomOnScroll: true,
            zoomButtons: false,
            markersSelectable: true,
            markers: [
                { name: "Canada", coords: [56.1304, -106.3468] },
                { name: "Brazil", coords: [-14.2350, -51.9253] },
                { name: "Russia", coords: [61, 105] },
                { name: "China", coords: [35.8617, 104.1954] },
                { name: "United States", coords: [37.0902, -95.7129] }
            ],
            markerStyle: {
                initial: { fill: "#7f56da" },
                selected: { fill: "#22c55e" }
            },
            labels: {
                markers: {
                    render: marker => marker.name
                }
            },
            regionStyle: {
                initial: {
                    fill: 'rgba(169,183,197, 0.3)',
                    fillOpacity: 1,
                },
            },
        });
    }

    init() {
        this.initWorldMapMarker();
    }

}

document.addEventListener('DOMContentLoaded', function (e) {
    new VectorMap().init();
});
=======

document.addEventListener('DOMContentLoaded', async function () {
    try {
        // Khởi tạo đối tượng dữ liệu
        const dataSets = {
            ngay: {
                tongTien: [],
                soLuongDon: [],
                categories: ["T2", "T3", "T4", "T5", "T6", "T7", "CN"]
            },
            tuan: {
                tongTien: [],
                soLuongDon: [],
                categories: ["Tuần 1", "Tuần 2", "Tuần 3", "Tuần 4"]
            },
            thang: {
                tongTien: [],
                soLuongDon: [],
                categories: ["Th1", "Th2", "Th3", "Th4", "Th5", "Th6", "Th7", "Th8", "Th9", "Th10", "Th11", "Th12"]
            }
        };

        const selectElement = document.getElementById('product-categories');
        let currentSet = 'thang'; // Mặc định theo tháng

        // Hàm load và cập nhật dữ liệu từ API
        async function loadData(productId = '') {
            const url = productId
                ? `/admin/dashboard/chartturnover/${productId}`
                : '/admin/dashboard/chartturnover';

            const response = await fetch(url);
            const data = await response.json();
            console.log(data.turnoverDate);

            // Gán dữ liệu vào dataSets
            dataSets.ngay.tongTien = data.turnoverDate.map(item => parseFloat(item.doanh_thu));
            dataSets.ngay.soLuongDon = data.turnoverDate.map(item => item.so_don);

            dataSets.tuan.tongTien = data.turnoverWeek.map(item => parseFloat(item.doanh_thu));
            dataSets.tuan.soLuongDon = data.turnoverWeek.map(item => item.so_don);

            dataSets.thang.tongTien = data.turnoverMonth.map(item => parseFloat(item.doanh_thu));
            dataSets.thang.soLuongDon = data.turnoverMonth.map(item => item.so_don);

            // Cập nhật biểu đồ
            updateChart();
        }

        // Cấu hình ApexCharts
        const options = {
            series: [],
            chart: {
                height: 313,
                type: "line",
                toolbar: { show: false },
            },
            stroke: {
                dashArray: [0, 0],
                width: [0, 2],
                curve: 'smooth'
            },
            fill: {
                opacity: [1, 1],
                type: ['solid', 'gradient'],
                gradient: {
                    type: "vertical",
                    inverseColors: false,
                    opacityFrom: 0.5,
                    opacityTo: 0,
                    stops: [0, 90]
                }
            },
            markers: {
                size: [0, 0],
                strokeWidth: 2,
                hover: { size: 4 }
            },
            xaxis: {
                categories: [],
                axisTicks: { show: false },
                axisBorder: { show: false }
            },
            yaxis: {
                min: 0,
                axisBorder: { show: false }
            },
            grid: {
                show: true,
                strokeDashArray: 3,
                xaxis: { lines: { show: false } },
                yaxis: { lines: { show: true } },
                padding: { top: 0, right: -2, bottom: 0, left: 10 }
            },
            legend: {
                show: true,
                horizontalAlign: "center",
                offsetX: 0,
                offsetY: 5,
                markers: {
                    width: 9,
                    height: 9,
                    radius: 6
                },
                itemMargin: { horizontal: 10, vertical: 0 }
            },
            plotOptions: {
                bar: {
                    columnWidth: "30%",
                    barHeight: "70%",
                    borderRadius: 3
                }
            },
            colors: ["#ff6c2f", "#22c55e"],
            tooltip: {
                shared: true,
                y: [
                    {
                        formatter: function (y) {
                            return y !== undefined ? y.toLocaleString() + " đ" : y;
                        }
                    },
                    {
                        formatter: function (y) {
                            return y !== undefined ? y + " đơn" : y;
                        }
                    }
                ]
            }
        };

        // Tạo biểu đồ
        const chart = new ApexCharts(
            document.querySelector("#dash-performance-chart"),
            options
        );
        chart.render();

        // Cập nhật biểu đồ khi có dữ liệu
        function updateChart() {
            const selectedSet = dataSets[currentSet];

            chart.updateOptions({
                xaxis: {
                    categories: selectedSet.categories
                }
            });

            chart.updateSeries([
                {
                    name: "Tổng Tiền",
                    type: "bar",
                    data: selectedSet.tongTien
                },
                {
                    name: "Số lượng",
                    type: "area",
                    data: selectedSet.soLuongDon
                }
            ]);
        }

        // Xử lý sự kiện chọn sản phẩm
        selectElement.addEventListener('change', function () {
            const selectedValue = this.value;
            loadData(selectedValue);
        });

        // Xử lý nút "Ngày", "Tuần", "Tháng"
        document.querySelectorAll(".btn-outline-light").forEach((btn) => {
            btn.addEventListener("click", function () {
                document.querySelectorAll(".btn-outline-light").forEach((b) =>
                    b.classList.remove("active")
                );
                this.classList.add("active");

                const label = this.innerText.trim().toLowerCase();
                currentSet = (label === "ngày") ? 'ngay' : (label === "tuần") ? 'tuan' : 'thang';

                updateChart();
            });
        });

        // Gọi lần đầu khi load trang
        await loadData();

    } catch (error) {
        console.error("Lỗi:", error);
    }
});
>>>>>>> 17d4d96a776f010598a17eafd006c45f04996fff
