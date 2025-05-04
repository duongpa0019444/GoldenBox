//Lấy dữ liệu doanh thu các ngày trong tuần

document.addEventListener('DOMContentLoaded', async function () {
    try {
        // Dữ liệu linh động
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
        const response = await fetch('/admin/dashboard/chartturnover');
        const data = await response.json();

        //gán dữ liệu cho ngày
        dataSets.ngay.tongTien = data.turnoverDate.map(item => parseFloat(item.doanh_thu));
        dataSets.ngay.soLuongDon = data.turnoverDate.map(item => item.so_don);

        //gán dữ liệu cho tuần
        dataSets.tuan.tongTien = data.turnoverWeek.map(item => parseFloat(item.doanh_thu));
        dataSets.tuan.soLuongDon = data.turnoverWeek.map(item => item.so_don);

        //gán dữ liệu cho tháng
        dataSets.thang.tongTien = data.turnoverMonth.map(item => parseFloat(item.doanh_thu));
        dataSets.thang.soLuongDon = data.turnoverMonth.map(item => item.so_don);


        // Cấu hình mặc định ban đầu (theo tháng)
        var options = {
            series: [
                {
                    name: "Tổng Tiền",
                    type: "bar",
                    data: data.turnoverMonth.map(item => parseFloat(item.doanh_thu)),
                },
                {
                    name: "Số lượng đơn",
                    type: "area",
                    data: data.turnoverMonth.map(item => item.so_don),
                }
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
                categories: dataSets.thang.categories,
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
                y: [
                    {
                        formatter: function (y) {
                            if (typeof y !== "undefined") {
                                return y.toLocaleString() + " đ";
                            }
                            return y;
                        },
                    },
                    {
                        formatter: function (y) {
                            if (typeof y !== "undefined") {
                                return y + " đơn";
                            }
                            return y;
                        },
                    },
                ],
            },
        };

        // Render biểu đồ ban đầu
        var chart = new ApexCharts(
            document.querySelector("#dash-performance-chart"),
            options
        );

        chart.render();

        // Xử lý sự kiện khi click các nút (Ngày, Tuần, Tháng)
        document.querySelectorAll(".btn-outline-light").forEach((btn) => {
            btn.addEventListener("click", function () {
                document.querySelectorAll(".btn-outline-light").forEach((b) =>
                    b.classList.remove("active")
                );
                this.classList.add("active");

                const label = this.innerText.trim().toLowerCase(); // "ngày", "tuần", "tháng"
                let selectedSet;

                if (label === "ngày") {
                    selectedSet = dataSets.ngay;
                } else if (label === "tuần") {
                    selectedSet = dataSets.tuan;
                } else {
                    selectedSet = dataSets.thang;
                }

                // Cập nhật dữ liệu và trục X
                chart.updateOptions({
                    xaxis: {
                        categories: selectedSet.categories
                    }
                });

                chart.updateSeries([
                    {
                        name: "Tổng Tiền",
                        data: selectedSet.tongTien
                    },
                    {
                        name: "Số lượng đơn",
                        data: selectedSet.soLuongDon
                    }
                ]);
            });
        });

    } catch (error) {
        console.error("Lỗi:", error);
    }
});

