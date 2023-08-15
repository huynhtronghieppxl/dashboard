let chartVatFoodReport, loadDataVatFoodReport;

$('#select-vat-food-report').on('change', function () {
    loadDataVatFoodReport = 0;
    dataVatFoodReport();
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-off-menu-dishes-report'), $('#select-vat-food-report'));
});
getTimeChangeSelectTypeDashboardReport($('#text-label-type-off-menu-dishes-report'), $('#select-vat-food-report'));

async function dataVatFoodReport() {
    if (loadDataVatFoodReport === 1) return false;
    loadDataVatFoodReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        type = $('#select-vat-food-report').val(),
        time = $('#select-vat-food-report').find(':selected').data('time');
    let method = 'get',
        url = 'branch-dashboard.data-vat-food-report',
        params = {brand: brand, branch: branch, type: type, time: time},
        data = {};
    let res = await axiosTemplate(method, url, params, data, [$("#chart-vat-food-report")]);
    drawEchartVatFoodReportDashboard(res.data[0]);
}

function drawEchartVatFoodReportDashboard(data) {
    let heightChart = data.timeline.length > 40 ? (heightWindow <= 797 ? '63%' : '70%') : (heightWindow <= 797 ? '70%' : '75%');
    try {
        if (data.timeline.length === 0) {
            $('#chart-vat-food-report-empty').removeClass('d-none');
            $('#chart-vat-food-report').addClass('d-none');
        } else {
            $('#chart-vat-food-report-empty').addClass('d-none');
            $('#chart-vat-food-report').removeClass('d-none');
        }
        let dom = document.getElementById("chart-vat-food-report");
        chartVatFoodReport = echarts.init(dom, null, {
            renderer: "canvas",
            useDirtyRect: false,
        });
        let app = {};
        let option = {
            tooltip: {
                trigger: 'axis',
                // axisPointer: {
                //     type: 'shadow'
                // },
                textStyle: {
                    fontFamily: 'Roboto',
                    fontSize: 12
                },
                formatter: function (value, i) {
                    return `<div class="seemt-fz-16">${value[0].axisValue}</div>
                            <div class="d-flex align-items-center"><i class="fa-solid fa-circle mr-1" style="font-size: 5px"></i>Số lượng đơn : ${data.quantity[value[0].dataIndex]}</div>
                            <div class="d-flex align-items-center"><i class="fa-solid fa-circle mr-1" style="font-size: 5px"></i>Tổng tiền : ${formatNumber(value[0].value)}</div>`;
                },
            },
            title: {
                text: '{a|Tổng:} {b|' + data.total_amount + '} {a|VNĐ}',
                left: 'center',
                top: 0, // Khoảng cách giữa tiêu đề và đỉnh biểu đồ
                textStyle: {
                    rich: {
                        a: {
                            fontSize: 16,
                            color: '#000',
                            fontWeight: '600',
                            fontFamily: 'Roboto'
                        },
                        b: {
                            fontSize: 16,
                            color: '#FA6342',
                            fontWeight: '600',
                            fontFamily: 'Roboto'
                        }
                    }
                },
            },
            grid: {
                width: "90%",
                left: "7%",
                top: 80,
                height: heightChart
            },
            xAxis: [
                {
                    type: "category",
                    axisLabel: {
                        interval: data.timeline.length > 36 ? 2 : 0,
                        rotate: 45,
                        fontSize: 12,
                        fontWeight: 500,
                        overflow: 'truncate',
                        width: 80,
                        showMinLabel: true,
                        showMaxLabel: true,
                        fontFamily: 'Roboto',
                    },
                    data: data.timeline,
                },
            ],
            yAxis: {
                type: 'value',
                name: "SỐ TIỀN (VNĐ)",
                nameGap: 80,
                nameTextStyle: {
                    fontSize: 14,
                    fontWeight: 600,
                    fontFamily: 'Roboto'
                },
                nameRotate: 90,
                nameLocation: 'middle',
                axisLabel: {
                    formatter: function (value) {
                        return nFormatter(value);
                    }
                }
            },
            // dataZoom: [{
            //     type: 'slider',
            //     show: data.timeline.length > 40,
            //     height: 20,
            //     startValue: 0,
            //     endValue: 39,
            //     // start: 0,
            //     // end: data.timeline.length > 20 ? 19 : 100,
            //     xAxisIndex: 0,
            //     bottom: 0,
            //     realtime: true,
            //     zoomLock: true,
            //     showDetail: false,
            //     brushSelect: false
            // }],
            series: [
                {
                    name: "",
                    type: "line",
                    // seriesLayoutBy: "row",
                    data: data.value,
                    // barMaxWidth: 20,
                    itemStyle: {
                        color: '#2A74D9'
                    }
                },
            ],
        };

        if (option && typeof option === "object") {
            chartVatFoodReport.setOption(option);
        }
    } catch (e) {
        console.log(e);
        $('#chart-vat-food-report-empty').removeClass('d-none');
        $('#chart-vat-food-report').addClass('d-none');
    }
    $('#detail-value-vat-food-report').on('click', function () {
        if ($('#detail-value-vat-food-report').is(':checked')) {
            chartVatFoodReport.setOption({
                series: {
                    label: {
                        show: true,
                        verticalAlign: "middle",
                        position: [10, -5, 0, 0],
                        color: "#000",
                        rotate: 60,
                        distance: 15,
                        fontFamily: "roboto",
                        formatter: function (param) {
                            return formatNumber(param.value);
                        }
                    },
                },
            });
        } else {
            chartVatFoodReport.setOption({
                series: {
                    label: {show: false},
                },
            });
        }
    })
    chartVatFoodReport.resize();
    $(window).on('resize', function () {
        chartVatFoodReport.resize();
    });
}

/**
 * Reload Data
 */
function reloadVatFoodReport() {
    loadDataVatFoodReport = 0;
    dataVatFoodReport();
}
