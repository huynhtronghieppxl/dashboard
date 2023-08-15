let chartOrder;
chartOrder = chartColumnOrderEchart('chart-vertical-order-report')
let typeFilterOrderReport, timeFilterOrderReport , fromFilterOrderReport, toFilterOrderReport;
typeFilterOrderReport = $('#select-type-order-report select').find('option:selected').val();
timeFilterOrderReport = $('#select-type-order-report select').find('option:selected').data('time');
tableOrderReport([]);
/**
 * Event
 */
$('#select-type-order-report select').on('change', function () {
    loadDataOrderReport = 0;
    typeFilterOrderReport = $(this).val();
    timeFilterOrderReport = $(this).find('option:selected').data('time');
    switch (Number($(this).val())){
        case 13:
            fromFilterOrderReport = $(this).parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterOrderReport = $(this).parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            fromFilterOrderReport = $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterOrderReport = $(this).parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            fromFilterOrderReport = $(this).parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterOrderReport = $(this).parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            fromFilterOrderReport = "";
            toFilterOrderReport = "" ;
    }
    dataOrderReport();
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-order-report'), $('#select-type-order-report select'));
});
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-order-report'), $('#select-type-order-report select'));

$('#select-type-order-report .search-date-option-filter-time-bar').on('click', function () {
    detectDateOptionTimeOrder(Number($('#select-type-order-report select').find('option:selected').val()))
    // if(!CheckDateFormTo(fromFilterOrderReport, toFilterOrderReport)) return false
    if(!checkDashboardCustomDateTimePicker($(this), $('#select-type-order-report select'))) return false;
    reloadOrderReport();
});

function detectDateOptionTimeOrder(type) {
    switch (type){
        case 13:
            fromFilterOrderReport = $('#select-type-order-report select').parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterOrderReport = $('#select-type-order-report select').parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            fromFilterOrderReport = $('#select-type-order-report select').parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterOrderReport = $('#select-type-order-report select').parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            fromFilterOrderReport = $('#select-type-order-report select').parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterOrderReport = $('#select-type-order-report select').parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            fromFilterOrderReport = "";
            toFilterOrderReport = "" ;
    }
}
/**
 * Call data
 * @returns {Promise<void>}
 */
function dataOrderReport() {
    $('.chart-vertical-order-report-loading').remove();
    $('.chart-horizontal-order-report-loading').remove();
    $('.loading-order-report-loading').remove();
    if (loadDataOrderReport === 1) return false;
    loadDataOrderReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        type = $('#select-type-order-report').val(),
        time = $('#select-type-order-report').find(':selected').data('time');
    $('#chart-vertical-order-report').prepend(themeLoading($('#chart-vertical-order-report').height(), 'chart-vertical-order-report-loading'))
    $('#chart-horizontal-order-report').prepend(themeLoading($('#chart-horizontal-order-report').height(), 'chart-horizontal-order-report-loading'))
    $('.loading-order-report').prepend(themeLoading($('.loading-order-report').height(), 'loading-order-report-loading'))

    axios({
        method: 'get',
        url: 'branch-dashboard.data-order-report',
        params: {brand: brand, branch: branch, type: typeFilterOrderReport, time: timeFilterOrderReport, from: fromFilterOrderReport, to: toFilterOrderReport}
    }).then(function (res) {
        console.log(res);
        let titleX = 'Số đơn hàng (đơn)';
        if (res.data[0].length > 50) {
            $('#chart-vertical-order-report').attr('style', 'width:' + res.data[0].length * 20 + 'px; min-width: 100%');
            $('#chart-horizontal-order-report').attr('style', 'height:' + res.data[0].length * 15 + 'px; min-height: 400px');
        } else {
            $('#chart-vertical-order-report').attr('style', false);
            $('#chart-horizontal-order-report').attr('style', false);
        }
        updateChartOrderColumnEchart(chartOrder,res.data[0] , ' Đơn');
        $('#detail-value-order-report').on('change', function (){
            if($('#detail-value-order-report').is(':checked')){
                chartOrder.setOption({
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
                chartOrder.setOption({
                    series : {
                        label: {show: false},
                    },
                });
            }
        })
        tableOrderReport(res.data[1].original.data);
        $('#total-order-report').text(res.data[2].order);
        $('.total-revenue-order-report').text(res.data[2].revenue);
        $('.chart-vertical-order-report-loading').remove();
        $('.chart-horizontal-order-report-loading').remove();
        $('.loading-order-report-loading').remove();
    }).catch(function (e) {
        console.log(e);
    });
}

function chartColumnOrderEchart(element){
    element = echarts.init(document.getElementById(element));
    element.setOption({
        title: {
            textStyle: {
                color: "grey",
                fontSize: 20
            },
            // text: "No data",
            left: "center",
            top: "center",
        }
    });
    return element;
}


function updateChartOrderColumnEchart(chart , data,  label = 'Đơn'){
    let option = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            },
            formatter: function (value, i) {
                return `Số tiền : ${formatNumber(value[0].value)}`;
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
        xAxis: [
            {
                type: "category",
                axisLabel: {
                    interval: 0,
                    fontSize: 12,
                    rotate: 40,
                    fontFamily: "Segoe UI",
                },
                data: data.timeline,
            },
        ],
        grid : {
            width: "90%",
            left: "7%",
            height: "70%"
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
                name: "ĐƠN HÀNG",
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
        dataZoom: [{
            type: 'slider',
            show: data.timeline.length > 30,
            startValue: 0,
            endValue: 19,
            // start: 0,
            // end: data.timeline.length > 20 ? 19 : 100,
            xAxisIndex: 0,
            bottom: 0,
            realtime: true,
            zoomLock: true,
            showDetail: false,
            brushSelect: false
        }],
        series: [
            {
                name: "",
                type: "bar",
                seriesLayoutBy: "row",
                data: data.value,
                itemStyle: {
                    color: '#2A74D9'
                }
            },
        ],
    };

    chart.setOption(option);
    window.onresize = function() {
        chart.resize();
    };
}

function tableOrderReport(data) {
    let scroll_Y = '40vh';
    let fixed_left = 0;
    let fixed_right = 0;
    let id = $('#table-order-report');
    let column = [
        {data: 'report_time', name: 'report_time', className: 'text-center'},
        {data: 'order', name: 'order', className: 'text-center'},
        {data: 'amount', name: 'amount', className: 'text-center'},
    ],option = [];
    DatatableTemplateNew(id, data, column, scroll_Y, fixed_left, fixed_right,option);
}

/**
 * Reload Data
 */
function reloadOrderReport() {
    loadDataOrderReport = 0;
    dataOrderReport();
}
