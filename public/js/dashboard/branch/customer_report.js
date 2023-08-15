/**
 * Event
 */
let typeFilterCustomerReport, timeFilterCustomerReport , fromFilterCustomerReport , toFilterCustomerReport;
typeFilterCustomerReport = $('#select-filter-custom-report select').find('option:selected').val();
timeFilterCustomerReport = $('#select-filter-custom-report select').find('option:selected').data('time');
$('#select-filter-custom-report select').on('change', function () {
    loadDataCustomerReport = 0;
    typeFilterCustomerReport = $(this).val();
    timeFilterCustomerReport = $(this).find('option:selected').data('time');
    switch (Number($(this).val())){
        case 13:
            // console.log('13', $(this).parents('.filter-dashboard-report').find('.from-day-filter-time-report').val(), $(this).parents('.filter-dashboard-report').find('.to-day-filter-time-report').val())
            fromFilterCustomerReport = $(this).parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterCustomerReport = $(this).parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            // console.log('15', $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-report').val())
            fromFilterCustomerReport = $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterCustomerReport = $(this).parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            fromFilterCustomerReport = $(this).parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterCustomerReport = $(this).parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            fromFilterCustomerReport = "";
            toFilterCustomerReport = "" ;
    }
    dataCustomerReport();
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-customer-report'), $('#select-type-customer-report'));
});
getTimeChangeSelectTypeDashboardReport($('#text-label-type-customer-report'), $('#select-type-customer-report'));

$('#select-filter-custom-report .search-date-option-filter-time-bar').on('click', async function () {
    await detectDateOptionTimeCustomer(Number($('#select-filter-custom-report select').find('option:selected').val()))
    // if(!CheckDateFormTo(fromFilterCustomerReport, toFilterCustomerReport)) return false
    if(!checkDashboardCustomDateTimePicker($(this), $('#select-filter-custom-report select'))) return false;
    reloadCustomerReport()
})

function detectDateOptionTimeCustomer(type) {
    switch (type){
        case 13:
            fromFilterCustomerReport = $('#select-filter-custom-report select').parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterCustomerReport = $('#select-filter-custom-report select').parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            fromFilterCustomerReport = $('#select-filter-custom-report select').parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterCustomerReport = $('#select-filter-custom-report select').parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            fromFilterCustomerReport = $('#select-filter-custom-report select').parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterCustomerReport = $('#select-filter-custom-report select').parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            fromFilterCustomerReport = "";
            toFilterCustomerReport = "" ;
    }
    console.log(fromFilterCustomerReport, toFilterCustomerReport)
}

$('#label-chart-customer-report').on('change', function () {
    if ($(this).is(':checked')) {
        $('#chart-vertical-customer-report .amcharts-graph-column text').removeClass('d-none');
        $('#chart-horizontal-customer-report .amcharts-graph-column text').removeClass('d-none');
    } else {
        $('#chart-vertical-customer-report .amcharts-graph-column text').addClass('d-none');
        $('#chart-horizontal-customer-report .amcharts-graph-column text').addClass('d-none');
    }
});
$('#show-vertical-customer-report').on('click', function () {
    $('#chart-vertical-customer-report').removeClass('d-none');
    $('#chart-horizontal-customer-report').addClass('d-none');
    $('#label-chart-customer-report').prop('checked', true);
});
$('#show-horizontal-customer-report').on('click', function () {
    $('#chart-vertical-customer-report').addClass('d-none');
    $('#chart-horizontal-customer-report').removeClass('d-none');
    $('#label-chart-customer-report').prop('checked', true);
});

/**
 * Call data
 * @returns {Promise<void>}
 */
function dataCustomerReport() {
    $('.chart-customer-report-loading').remove();
    if (loadDataCustomerReport === 1) return false;
    loadDataCustomerReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val();
    $('.loading-customer-report-loading').remove();
    $('#chart-customer-report').prepend(themeLoading($('#chart-customer-report').height(), 'chart-customer-report-loading'));
    $('.loading-customer-report').prepend(themeLoading($('.loading-customer-report').height(), 'loading-customer-report-loading'));
    axios({
        method: 'get',
        url: 'branch-dashboard.data-customer-report',
        params: {brand: brand, branch: branch, type: typeFilterCustomerReport, time: timeFilterCustomerReport , from: fromFilterCustomerReport, to: toFilterCustomerReport}
    }).then(function (res) {
        console.log(res);
        let element = 'chart-customer-report';
        CustomerEchartReport(element, res.data[0]);
        $('.chart-customer-report-loading').remove();
        $('#checkin-customer-report').text(res.data[1].total_customer_come_to_restaurant);
        $('#app-customer-report').text(res.data[1].total_customer_used_aloline);
        $('#use-point-customer-report').text(res.data[1].total_customer_used_point);
        $('#accumulate-point-customer-report').text(res.data[1].total_customer_point_added);
        $('#gift-customer-report').text(res.data[1].total_customer_receive_gifts);
        $('#total-orders-customer-report').text(res.data[1].total_orders);
        $('.loading-customer-report-loading').remove();

    }).catch(function (e) {
        console.log(e);
    });
}
/**
 * ECHART ===========
 */

function CustomerEchartReport(id , data) {
    let chartDom = document.getElementById(id);
    let myChart = echarts.init(chartDom);
    let option = {
        tooltip: {
            trigger: 'axis',
        },
        legend: {
            data: [$('#text-checkin-customer-report').text(), $('#text-app-customer-report').text(), $('#text-use-point-customer-report').text() , $('#text-accumulate-point-customer-report').text(), $('#text-gift-customer-report').text()],
        },
        grid: {
            top : '15%',
            left: '1%',
            right: '2%',
            bottom: '1%',
            containLabel: true
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: data.customer.timeline,
            axisLabel : {
                margin: 10.5
            }
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
                name: $('#text-checkin-customer-report').text(),
                type: 'line',
                smooth: true,
                markPoint: {
                    data: [
                        { type: 'max', name: 'Max' },
                    ],
                    itemStyle: {
                        color: "#AA7C62",
                    },
                    label: {
                        color: "#000",
                        formatter: function (params) {
                            return formatNumber(params.value);
                        }
                    }
                },
                itemStyle : {
                    color : '#AA7C62',
                },
                data: data.customer.restaurant.value
            },
            {
                name:  $('#text-app-customer-report').text(),
                type: 'line',
                smooth: true,
                markPoint: {
                    data: [
                        { type: 'max', name: 'Max' },
                    ],
                    itemStyle: {
                        color: "#fe5d70",
                    },
                    label: {
                        color: "#000",
                        formatter: function (params) {
                            return formatNumber(params.value);
                        }
                    }
                },
                itemStyle : {
                    color : '#fe5d70',
                },
                data: data.customer.register.value
            },
            {
                name: $('#text-use-point-customer-report').text(),
                type: 'line',
                smooth: true,
                markPoint: {
                    data: [
                        { type: 'max', name: 'Max' },
                    ],
                    itemStyle: {
                        color: "#0ac282",
                    },
                    label: {
                        color: "#000",
                        formatter: function (params) {
                            return formatNumber(params.value);
                        }
                    }
                },
                itemStyle : {
                    color : '#0ac282',
                },
                data: data.customer.use_point.value
            },
            {
                name: $('#text-accumulate-point-customer-report').text(),
                type: 'line',
                smooth: true,
                markPoint: {
                    data: [
                        { type: 'max', name: 'Max' },
                    ],
                    itemStyle: {
                        color: "#0072bc",
                    },
                    label: {
                        color: "#000",
                        formatter: function (params) {
                            return formatNumber(params.value);
                        }
                    }
                },
                itemStyle : {
                    color : '#0072bc',
                },
                data: data.customer.save_point.value
            },
            {
                name: $('#text-gift-customer-report').text(),
                type: 'line',
                smooth: true,
                markPoint: {
                    data: [
                        { type: 'max', name: 'Max' },
                    ],
                    itemStyle: {
                        color: "#ffa233",
                    },
                    label: {
                        color: "#000",
                        formatter: function (params) {
                            return formatNumber(params.value);
                        }
                    }
                },
                itemStyle : {
                    color : '#ffa233',
                },
                data: data.customer.receiving_gifts.value
            },
        ]
    };
    option && myChart.setOption(option);
    $(window).on('resize', function () {
        myChart.resize();
    });
}

/**
 * Reload Data
 */
function reloadCustomerReport() {
    $('.chart-customer-report-loading').remove();
    loadDataCustomerReport = 0;
    dataCustomerReport();
}

