let chartProfit = chartColumnEchart('chart-profit-report')
/**
 * Event
 */
let typeFilterProfitReport, timeFilterProfitReport , fromFilterProfitReport, toFilterProfitReport;
typeFilterProfitReport = $('#select-type-analysis-cost-report select').find('option:selected').val();
timeFilterProfitReport = $('#select-type-analysis-cost-report select').find('option:selected').data('time');
$('#select-type-profit-report select').on('change', function () {
    loadDataProfitReport = 0;
    typeFilterProfitReport = $(this).val();
    timeFilterProfitReport = $(this).find('option:selected').data('time');
    switch (Number($(this).val())){
        case 13:
            fromFilterProfitReport = $(this).parents('.filter-dashboard-report').find('.from-day-filter-time-report').val();
            toFilterProfitReport = $(this).parents('.filter-dashboard-report').find('.to-day-filter-time-report').val();
            break;
        case 15:
            fromFilterProfitReport = $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-report').val();
            toFilterProfitReport = $(this).parents('.filter-dashboard-report').find('.to-month-filter-time-report').val();
            break;
        case 16:
            fromFilterProfitReport = $(this).parents('.filter-dashboard-report').find('.from-year-filter-time-report').val();
            toFilterProfitReport = $(this).parents('.filter-dashboard-report').find('.to-year-filter-time-report').val();
            break;
        default:
            fromFilterProfitReport = "";
            toFilterProfitReport = "" ;
    }
    dataProfitReport();
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-profit-report'), $('#select-type-profit-report'));
});
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-profit-report'), $('#select-type-profit-report'));


$('#select-type-profit-report button').on('click', function () {
    switch (Number($('#select-type-profit-report select').find('option:selected').val())){
        case 13:
            fromFilterProfitReport = $(this).parents('.filter-dashboard-report').find('.from-day-filter-time-report').val();
            toFilterProfitReport = $(this).parents('.filter-dashboard-report').find('.to-day-filter-time-report').val();
            break;
        case 15:
            fromFilterProfitReport = $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-report').val();
            toFilterProfitReport = $(this).parents('.filter-dashboard-report').find('.to-month-filter-time-report').val();
            break;
        case 16:
            fromFilterProfitReport = $(this).parents('.filter-dashboard-report').find('.from-year-filter-time-report').val();
            toFilterProfitReport = $(this).parents('.filter-dashboard-report').find('.to-year-filter-time-report').val();
            break;
        default:
            fromFilterProfitReport = "";
            toFilterProfitReport = "" ;
    }
    reloadProfitReport()
})


/**
 * Call data
 * @returns {Promise<void>}
 */
function dataProfitReport() {
    $('.load-chart-profit-day-loading').remove();
    if (loadDataProfitReport === 1) return false;
    loadDataProfitReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        type = $('#select-type-profit-report').val(),
        time = $('#select-type-profit-report').find(':selected').data('time');
    $('.load-chart-profit-day').prepend(themeLoading($('.load-chart-profit-day').height(), 'load-chart-profit-day-loading'))

    axios({
        method: 'get',
        url: 'branch-dashboard.data-profit-report',
        params: {brand: brand, branch: branch, type: typeFilterProfitReport, time: timeFilterProfitReport, from : fromFilterProfitReport , to: toFilterProfitReport}
    }).then(function (res) {
        console.log(res);
        chartProfitReport(res.data[0], res.data[1], res.data[2])
        $('.load-chart-profit-day-loading').remove();
        $('#total-profit-report').text(res.data[3].amount);
        $('#total-revenue-profit-report').text(res.data[3].amount);
        $('#total-same-period-profit-report').text(res.data[3].same_period);
        $('#total-rate-same-period-profit-report').html(res.data[3].rate_same_period);
    }).catch(function (e) {
        console.log(e);
        $('.load-chart-profit-day-loading').remove();
    });
}

/**
 * Reload Data
 */
function reloadProfitReport() {
    loadDataProfitReport = 0;
    dataProfitReport();
}

async function chartProfitReport(data1, data2, data3) {
    let element2 = "chart-adjacent-profit-report";
    let element3 = "chart-same-period-profit-report";
    updateChartColumnEchart(chartProfit, data1);
    $('#detail-value-profit-report').on('change', function (){
        if($('#detail-value-profit-report').is(':checked')){
            chartProfit.setOption({
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
            chartProfit.setOption({
                series : {
                    label: {show: false},
                },
            });
        }
    })
    $(window).on('resize', function () {
        chartProfit.resize();
    });

    // eChartLineProfitReport(element2, data2);
    // eChartLineProfitReport(element3, data3);
}

function eChartLineProfitReport(id , data) {
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
            formatter : function (value, index, callback){
                return value[0].data['label_text'];
            },
            borderColor: "rgb(10, 194, 130)"
        },
        xAxis: {
            type: 'category',
            data: data.map(item=>{
                return item.timeline;
            }),
        },
        grid: {
            top : '2%',
            left: '1%',
            right: '2%',
            bottom: '1%',
            containLabel: true
        },
        yAxis: {
            type: 'value',
            axisLabel : {
                formatter : function (value, index){
                    return nFormatter(value);
                }
            }
        },
        series: [
            {
                type: 'line',
                smooth: true,
                stack: 'Total',
                data:  data,
                itemStyle : {
                    color : 'rgb(10, 194, 130)',
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
                    show: true,
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
    $('#detail-value-profit-report').on('change', function (){
        if($('#detail-value-profit-report').is(':checked')){
            myChart.setOption({
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
            myChart.setOption({
                series : {
                    label: {show: false},
                },
            });
        }
    })
}
