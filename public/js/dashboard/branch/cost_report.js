let typeFilterCostReport, timeFilterCostReport, fromFilterCostReport, toFilterCostReport;
typeFilterCostReport = $('#select-type-cost-report select').find('option:selected').val();
timeFilterCostReport = $('#select-type-cost-report select').find('option:selected').data('time');
$('#select-type-cost-report select').on('change', function () {
    loadDataCostReport = 0;
    typeFilterCostReport = $(this).val();
    timeFilterCostReport = $(this).find('option:selected').data('time');
    switch (Number($(this).val())) {
        case 13:
            fromFilterCostReport = $(this).parents('.filter-dashboard-report').find('.from-day-filter-time-report').val();
            toFilterCostReport = $(this).parents('.filter-dashboard-report').find('.to-day-filter-time-report').val();
            break;
        case 15:
            fromFilterCostReport = $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-report').val();
            toFilterCostReport = $(this).parents('.filter-dashboard-report').find('.to-month-filter-time-report').val();
            break;
        case 16:
            fromFilterCostReport = $(this).parents('.filter-dashboard-report').find('.from-year-filter-time-report').val();
            toFilterCostReport = $(this).parents('.filter-dashboard-report').find('.to-year-filter-time-report').val();
            break;
        default:
            fromFilterCostReport = "";
            toFilterCostReport = "";
    }
    dataCostReport();
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-cost-report'), $('#select-type-cost-report'));
});
getTimeChangeSelectTypeDashboardReport($('#text-label-type-cost-report'), $('#select-type-cost-report'));

$('#label-chart-all-cost-report').on('change', function () {
    if ($(this).is(':checked')) {
        $('#chart-vertical-all-cost-report .amcharts-graph-column text').removeClass('d-none');
        $('#chart-horizontal-all-cost-report .amcharts-graph-column text').removeClass('d-none');
    } else {
        $('#chart-vertical-all-cost-report .amcharts-graph-column text').addClass('d-none');
        $('#chart-horizontal-all-cost-report .amcharts-graph-column text').addClass('d-none');
    }
});

$('#label-chart-adjacent-cost-report').on('change', function () {
    if ($(this).is(':checked')) {
        $('#chart-adjacent-cost-report .amcharts-graph-line text').removeClass('d-none');
    } else {
        $('#chart-adjacent-cost-report .amcharts-graph-line text').addClass('d-none');
    }
});

$('#label-chart-same-period-cost-report').on('change', function () {
    if ($(this).is(':checked')) {
        $('#chart-same-period-cost-report .amcharts-graph-line text').removeClass('d-none');
    } else {
        $('#chart-same-period-cost-report .amcharts-graph-line text').addClass('d-none');
    }
});


$('#select-type-cost-report button').on('click', function () {
    switch (Number($('#select-type-cost-report select').find('option:selected').val())) {
        case 13:
            fromFilterCostReport = $(this).parents('.filter-dashboard-report').find('.from-day-filter-time-report').val();
            toFilterCostReport = $(this).parents('.filter-dashboard-report').find('.to-day-filter-time-report').val();
            break;
        case 15:
            fromFilterCostReport = $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-report').val();
            toFilterCostReport = $(this).parents('.filter-dashboard-report').find('.to-month-filter-time-report').val();
            break;
        case 16:
            fromFilterCostReport = $(this).parents('.filter-dashboard-report').find('.from-year-filter-time-report').val();
            toFilterCostReport = $(this).parents('.filter-dashboard-report').find('.to-year-filter-time-report').val();
            break;
        default:
            fromFilterCostReport = "";
            toFilterCostReport = "";
    }
    reloadCostReport()
})


async function dataCostReport() {
    if (loadDataCostReport === 1) return false;
    loadDataCostReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val();
    let method = 'get',
        url = 'branch-dashboard.data-cost-report',
        params = {
            brand: brand,
            branch: branch,
            type: typeFilterCostReport,
            time: timeFilterCostReport,
            from: fromFilterCostReport,
            to: toFilterCostReport
        },
        data = {};
    let res = await axiosTemplate(method, url, params, data, [$("#chart-cost-current")]);
    drawEchartCostReportDashboard(res.data[0]);
    $('#total-cost-report').text(res.data[3].amount);
}

async function drawEchartCostReportDashboard(data) {
    try {
        if (data.timeline.length === 0) {
            $('#chart-cost-current-empty').removeClass('d-none');
            $('#chart-cost-current').addClass('d-none');
        } else {
            $('#chart-cost-current-empty').addClass('d-none');
            $('#chart-cost-current').removeClass('d-none');
        }
        let dom = document.getElementById("chart-cost-current");
        let chartCost = await echarts.init(dom, null, {
            renderer: "canvas",
            useDirtyRect: false,
        });
        let option = {
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                },
                formatter: function (value, i) {
                    return `<i class="fa fa-money"></i> Tổng tiền : ${formatNumber(value[0].value)}`;
                },
            },
            xAxis: [
                {
                    type: "category",
                    axisLabel: {
                        interval: 0,
                        fontSize: 12,
                        fontFamily: "Segoe UI",
                    },
                    data: data.timeline,
                },
            ],
            grid : {
                width: "90%",
                left: "7%"
            },
            yAxis: [
                {
                    axisLabel: {
                        inside: false,
                        formatter: function (value, index) {
                            if (value > 999999999) {
                                return value % 1000000000 === 0 ? formatNumber(value / 1000000000) + " tỷ" : formatNumber((value / 1000000000).toFixed(1)) + " tỷ";
                            }
                            if (value > 999999) {
                                return value % 1000000 === 0 ? formatNumber(value / 1000000) + " triệu" : formatNumber((value / 1000000).toFixed(1)) + " triệu";
                            }
                            if (value > 999) {
                                return value % 1000 === 0 ? formatNumber(value / 1000) + " ngàn" : formatNumber((value / 1000).toFixed(1)) + " ngàn";
                            }
                            if (value < -999999999) {
                                return value % 1000000000 === 0 ? formatNumber(value / 1000000000) + " tỷ" : formatNumber((value / 1000000000).toFixed(1)) + " tỷ";
                            }
                            if (value < -999999) {
                                return value % 1000000 === 0 ? formatNumber(value / 1000000) + " triệu" : formatNumber((value / 1000000).toFixed(1)) + " triệu";
                            }
                            if (value < -999) {
                                return value % 1000 === 0 ? formatNumber(value / 1000) + " ngàn" : formatNumber((value / 1000).toFixed(1)) + " ngàn";
                            }
                        },
                        margin: 10,
                    },
                    name: "SỐ TIỀN (VNĐ)",
                    nameGap: 80,
                    nameTextStyle: {
                        fontSize: 14,
                        fontWeight: 600,
                        fontFamily: "Roboto",
                    },
                    nameRotate: 90,
                    nameLocation: "middle",
                },
            ],
            // dataZoom: [
            //     {
            //         type: "slider",
            //         realtime: true,
            //         show: data.timeline.length > 8 ? true : false,
            //         start: 0,
            //         end: data.timeline.length > 8 ? 20 : 100,
            //         brushSelect: false,
            //         zoomOnMouseWheel: false,
            //         moveOnMouseMove: 'shift',
            //     },
            //     // {
            //     //     show: false,
            //     //     yAxisIndex: 0,
            //     //     filterMode: "empty",
            //     //     width: 30,
            //     //     height: "80%",
            //     //     // zoomLock: true,
            //     //     showDataShadow: false,
            //     //     handleSize: 20,
            //     //     left: "93%",
            //     //     brushSelect: false,
            //     // },
            // ],
            series: [
                {
                    name: "",
                    type: "bar",
                    seriesLayoutBy: "row",
                    data: data.value,
                },
            ],
        };
        if (option && typeof option === "object") {
            chartCost.setOption(option);
        }
        $('#detail-value-cost-report').on('change', function (){
            if($('#detail-value-cost-report').is(':checked')){
                chartCost.setOption({
                    series : {
                        label: {
                            show: true,
                            verticalAlign: "middle",
                            position: "top",
                            color: "rgba(0, 0, 0, 1)",
                            rotate: 0,
                            distance: 15,
                            fontWeight: "bolder",
                            fontFamily: "roboto",
                            formatter : function (param){
                                return formatNumber(param.value);
                            }
                        },
                    },
                });
            }else {
                chartCost.setOption({
                    series : {
                        label: {show: false},
                    },
                });
            }
        })
        $('#detail-value-point-report').on('change', function (){
            if($('#detail-value-cost-report').is(':checked')){
                chartCost.setOption({
                    series : {
                        label: {
                            show: true,
                            verticalAlign: "middle",
                            position: "top",
                            color: "rgba(0, 0, 0, 1)",
                            rotate: 0,
                            distance: 15,
                            fontWeight: "bolder",
                            fontFamily: "roboto",
                            formatter : function (param){
                                return formatNumber(param.value);
                            }
                        },
                    },
                });
            }else {
                chartCost.setOption({
                    series : {
                        label: {show: false},
                    },
                });
            }
        })
        chartCost.resize();
        $(window).on('resize', function () {
            chartCost.resize();
        });

    } catch (e) {
        console.log(e);
        $('#chart-cost-current-empty').removeClass('d-none');
        $('#chart-cost-current').addClass('d-none');
    }

}

async function reloadCostReport() {
    loadDataCostReport = 0;
    await dataCostReport();
}

function eChartLineCostReport(id, data) {
    let chartDom = document.getElementById(id);
    let myChart = echarts.init(chartDom);
    let labelOption = {
        show: true,
        rotate: 90,
        align: 'left',
        verticalAlign: 'middle',
        position: 'insideBottom',
        distance: 15,
        fontSize: 9,
        color: '#000',
        formatter: function (value, index) {
            return formatNumber(value.value);
        },
        rich: {
            name: {}
        }
    }
    let option = {
        tooltip: {
            show: true,
            trigger: 'axis',
            formatter: function (value, index, callback) {
                return value[0].data['label_text'];
            },
            borderColor: "#fe5d70"
        },
        xAxis: {
            type: 'category',
            data: data.map(item => {
                return item.timeline;
            }),
        },
        grid: {
            top: '2%',
            left: '1%',
            right: '2%',
            bottom: '1%',
            containLabel: true
        },
        yAxis: {
            type: 'value',
            axisLabel: {
                formatter: function (value, index) {
                    return nFormatter(value);
                }
            }
        },
        series: [
            {
                type: 'line',
                smooth: true,
                stack: 'Total',
                data: data,
                itemStyle: {
                    color: 'rgb(254, 93, 112)',
                },
            },

        ],
        toolbox: {
            show: true,
            orient: "vertical",
            right: -6,
            top: "center",
            feature: {
                saveAsImage: {
                    show: false,
                    title: 'Lưu ảnh',
                },
                myFeature: {
                    show: true,
                    icon: 'path://M432.45,595.444c0,2.177-4.661,6.82-11.305,6.82c-6.475,0-11.306-4.567-11.306-6.82s4.852-6.812,11.306-6.812C427.841,588.632,432.452,593.191,432.45,595.444L432.45,595.444z M421.155,589.876c-3.009,0-5.448,2.495-5.448,5.572s2.439,5.572,5.448,5.572c3.01,0,5.449-2.495,5.449-5.572C426.604,592.371,424.165,589.876,421.155,589.876L421.155,589.876z M421.146,591.891c-1.916,0-3.47,1.589-3.47,3.549c0,1.959,1.554,3.548,3.47,3.548s3.469-1.589,3.469-3.548C424.614,593.479,423.062,591.891,421.146,591.891L421.146,591.891zM421.146,591.891',
                    title: 'Xem chi tiết',
                    onclick: function () {
                        if ($('#chart-cost-adjacent').hasClass('detail-chart')) {
                            $('#chart-cost-adjacent').removeClass('detail-chart')
                            myChart.setOption(
                                {
                                    series: [
                                        {
                                            label: {show: false},
                                        }
                                    ],
                                }
                            )
                        } else {
                            $('#chart-cost-adjacent').addClass('detail-chart')
                            myChart.setOption(
                                {
                                    series: [
                                        {
                                            label: labelOption,
                                        },
                                    ],
                                }
                            )
                        }
                    }
                },
            },
        }
    };

    option && myChart.setOption(option);
}
