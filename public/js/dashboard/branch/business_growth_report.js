$(function () {
    $('#select-type-business-growth-report').select2({
        dropdownParent: $('#business-growth-report'),
    });
});
/**
 * Event
 */
$('#select-type-business-growth-report').on('change', function () {
    loadDataBusinessGrowthReport = 0;
    dataBusinessGrowthReport();
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-business-growth-report'), $('#select-type-business-growth-report'))
});
getTimeChangeSelectTypeDashboardReport($('#text-label-type-business-growth-report'), $('#select-type-business-growth-report'))


/**
 * Call data
 * @returns {Promise<void>}
 */
function dataBusinessGrowthReport() {
    $('.chart-pro-business-growth-report-loading').remove();
    $('.chart-business-growth-report-loading').remove();
    $('.chart-pro-business-growth-report-loading').remove();
    $('.chart-test-business-growth-report-loading').remove();
    $('.chart-test2-business-growth-report-loading').remove();
    $('.loading-business-growth-report-loading').remove();
    // return false;

    if (loadDataBusinessGrowthReport === 1) return false;
    $('#chart-business-growth-report').prepend(themeLoading($('#chart-business-growth-report').height(), 'chart-business-growth-report-loading'))
    $('#chart-pro-business-growth-report').prepend(themeLoading($('#chart-pro-business-growth-report').height(), 'chart-pro-business-growth-report-loading'))
    $('#chart-test-business-growth-report').prepend(themeLoading($('#chart-test-business-growth-report').height(), 'chart-test-business-growth-report-loading'))
    $('#chart-test2-business-growth-report').prepend(themeLoading($('#chart-test2-business-growth-report').height(), 'chart-test2-business-growth-report-loading'))
    $('.loading-business-growth-report').prepend(themeLoading($('.loading-business-growth-report').height(), 'loading-business-growth-report-loading'))


    loadDataBusinessGrowthReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        type = $('#select-type-business-growth-report').val(),
        time = $('#select-type-business-growth-report').find(':selected').data('time');

    axios({
        method: 'get',
        url: 'branch-dashboard.data-business-growth-report',
        params: {brand: brand, branch: branch, type: type, time: time,},
    }).then(async function (res) {
        console.log(res);
        // await chartLineMultiTemplate(res.data[0], 'chart-business-growth-report');
        // await chartLineMultiTemplate(res.data[1], 'chart-pro-business-growth-report');
        // await chartLineMultiTemplate(res.data[3], 'chart-test-business-growth-report');
        // await chartLineMultiTemplate(res.data[4], 'chart-test2-business-growth-report');
        growthChartReport('chart-test2-business-growth-report', res.data);
        // $('#revenue-growth').text(res.data[2].revenue);
        // $('#cost-growth').text(res.data[2].cost);
        // $('#profit-growth').text(res.data[2].profit);
        // $('#rate-profit-growth').text(res.data[2].rate_profit);
        // $('#average-revenue-growth').text(res.data[2].average_revenue);
        // $('#average-cost-growth').text(res.data[2].average_cost);
        // $('#average-profit-growth').text(res.data[2].average_profit);
        // $('#estimate-revenue-growth').text(res.data[2].estimate_revenue);
        // $('#estimate-cost-growth').text(res.data[2].estimate_cost);
        // $('#estimate-profit-growth').text(res.data[2].estimate_profit);
        // $('.amcharts-axis-zero-grid').attr('stroke-opacity', 2);
        // $('#total-test-1').text(res.data[2].total_1);
        // $('#total-test-2').text(res.data[2].total_2);
        // $('#total-test-3').text(res.data[2].total_3);
        $('#total-test2-1').text(res.data[4].revenue);
        $('#total-test2-2').text(res.data[4].cost);
        $('#total-test2-3').text(res.data[4].profit);
        // drawEstimateChart(res.data[2].index);
        $('.chart-pro-business-growth-report-loading').remove();
        $('.chart-business-growth-report-loading').remove();
        $('.chart-pro-business-growth-report-loading').remove();
        $('.chart-test-business-growth-report-loading').remove();
        $('.chart-test2-business-growth-report-loading').remove();
        $('.loading-business-growth-report-loading').remove();
    }).catch(function (e) {
        console.log(e);
    });
}

async function growthChartReport(element, data) {
    let chartDom = document.getElementById(element);
    let myChart = echarts.init(chartDom, null, {
        renderer: "canvas",
        useDirtyRect: false,
    });
    let option = {
        tooltip: {
            trigger: 'axis',
        },
        grid: {
            top: '2%',
            left: '1%',
            right: '2%',
            bottom: '1%',
            containLabel: true
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: data[0],
            axisLabel: {
                margin: 10.5
            }
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
                name: 'Doanh thu',
                type: 'line',
                smooth: true,
                itemStyle: {
                    color: '#0072bc',
                },
                stack: 'Total',
                data: data[1]
            },
            {
                name: 'Chi phí',
                type: 'line',
                smooth: true,
                stack: 'Total',
                itemStyle: {
                    color: '#fe5d70',
                },
                data: data[2]
            },
            {
                name: 'Lợi nhuận',
                type: 'line',
                smooth: true,
                stack: 'Total',
                itemStyle: {
                    color: '#0ac282',
                },
                data: data[3]
            },
        ]
    };

    option && myChart.setOption(option);
    $(window).on('resize', function () {
        myChart.resize();
    });
}

function chartLineMultiTemplate(data, element) {
    try {
        if (data === null || data.length === 0) {
            let id = $('#' + element);
            nullDataImg(id);
            return false;
        }
        return AmCharts.makeChart(element, {
            "type": "serial",
            "theme": "light",
            "dataProvider": data,
            "addClassNames": true,
            "startDuration": 1,
            "marginLeft": 0,
            "categoryField": "timeline",
            "categoryAxis": {
                "autoGridCount": false,
                "gridCount": data.length,
                "gridAlpha": 0.1,
                "zeroGridAlpha": 0.5,
                "gridColor": "#FFFFFF",
                "axisColor": "#555555",
                // "labelRotation": 45
            },
            "valueAxes": [
                {
                    "id": "a1",
                    "axisAlpha": 0,
                    "title": "Số tiền (VNĐ)",
                    "labelFunction": function (value) {
                        return nFormatter(value);
                    }
                }],
            "graphs": [{
                "id": "g1",
                "title": "revenue",
                "valueField": "revenue",
                "valueAxis": "a1",
                "lineColor": "#0072bc",
                "balloonText": "[[growth_revenue_label]]",
                "lineThickness": 2,
                "legendValueText": "[[value]]",
                "bullet": "round",
                "bulletBorderColor": "#0072bc",
                "bulletBorderThickness": 1,
                "bulletBorderAlpha": 1,
                "dashLengthField": "dashLength",
                "animationPlayed": true,
                "showBalloon": true,
                // "labelText": "<b></b>[[data_rate_growth_revenue]]",
            }, {
                "id": "g2",
                "title": "profit",
                "valueField": "profit",
                "valueAxis": "a2",
                "lineColor": "#0ac282",
                "balloonText": "[[growth_profit_label]]",
                "lineThickness": 2,
                "legendValueText": "[[value]]",
                "bullet": "round",
                "bulletBorderColor": "#0ac282",
                "bulletBorderThickness": 1,
                "bulletBorderAlpha": 1,
                "dashLengthField": "dashLength",
                "animationPlayed": true,
                "showBalloon": true,
                // "labelHtml": "<b></b>[[data_rate_growth_profit]]",
            }, {
                "id": "g3",
                "title": "cost",
                "valueField": "cost",
                "valueAxis": "a3",
                "lineColor": "#fe5d70",
                "balloonText": "[[growth_cost_label]]",
                "lineThickness": 2,
                "legendValueText": "[[value]]",
                "bullet": "round",
                "bulletBorderColor": "#fe5d70",
                "bulletBorderThickness": 1,
                "bulletBorderAlpha": 1,
                "dashLengthField": "dashLength",
                "animationPlayed": true,
                "showBalloon": true,
                // "labelText": "<b></b>[[data_rate_growth_cost]]",
            }],
            "chartCursor": {
                "cursorAlpha": 0,
                "valueLineAlpha": 0.2
            }
        });
    } catch (e) {
        console.log('Error Line Chart Multi: ' + e);
    }
}

function drawEstimateChart(index) {
    $('#chart-business-growth-report .amcharts-graph-g1 circle.amcharts-graph-bullet').each(function (i, v) {
        if (i >= index - 1) {
            $(this).attr('fill', '#ffa233');
            $(this).attr('stroke', '#ffa233');
        }
    });
    $('#chart-business-growth-report .amcharts-graph-g2 circle.amcharts-graph-bullet').each(function (i, v) {
        if (i >= index - 1) {
            $(this).attr('fill', '#ffa233');
            $(this).attr('stroke', '#ffa233');
        }
    });
    $('#chart-business-growth-report .amcharts-graph-g3 circle.amcharts-graph-bullet').each(function (i, v) {
        if (i >= index - 1) {
            $(this).attr('fill', '#ffa233');
            $(this).attr('stroke', '#ffa233');
        }
    });
    $('#chart-pro-business-growth-report .amcharts-graph-g1 circle.amcharts-graph-bullet').each(function (i, v) {
        if (i >= index - 1) {
            $(this).attr('fill', '#ffa233');
            $(this).attr('stroke', '#ffa233');
        }
    });
    $('#chart-pro-business-growth-report .amcharts-graph-g2 circle.amcharts-graph-bullet').each(function (i, v) {
        if (i >= index - 1) {
            $(this).attr('fill', '#ffa233');
            $(this).attr('stroke', '#ffa233');
        }
    });
    $('#chart-pro-business-growth-report .amcharts-graph-g3 circle.amcharts-graph-bullet').each(function (i, v) {
        if (i >= index - 1) {
            $(this).attr('fill', '#ffa233');
            $(this).attr('stroke', '#ffa233');
        }
    });
    $('#chart-test-business-growth-report .amcharts-graph-g1 circle.amcharts-graph-bullet').each(function (i, v) {
        if (i >= index - 1) {
            $(this).attr('fill', '#ffa233');
            $(this).attr('stroke', '#ffa233');
        }
    });
    $('#chart-test-business-growth-report .amcharts-graph-g2 circle.amcharts-graph-bullet').each(function (i, v) {
        if (i >= index - 1) {
            $(this).attr('fill', '#ffa233');
            $(this).attr('stroke', '#ffa233');
        }
    });
    $('#chart-test-business-growth-report .amcharts-graph-g3 circle.amcharts-graph-bullet').each(function (i, v) {
        if (i >= index - 1) {
            $(this).attr('fill', '#ffa233');
            $(this).attr('stroke', '#ffa233');
        }
    })
}

/**
 * Reload Data
 */
function reloadBusinessGrowthReport() {
    loadDataBusinessGrowthReport = 0;
    dataBusinessGrowthReport();
}
