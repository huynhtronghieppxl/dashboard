let checkSpamRevenueReport = 0;
let typeFilterRevenueReport, timeFilterRevenueReport , fromFilterRevenueReport, toFilterRevenueReport;
typeFilterRevenueReport = $('#select-type-revenue-report select').find('option:selected').val();
timeFilterRevenueReport = $('#select-type-revenue-report select').find('option:selected').data('time');
$('#select-type-revenue-report select').on('change', function () {
    checkSpamRevenueReport = 0;
    loadDataRevenueReport = 0;
    typeFilterRevenueReport = $(this).val();
    timeFilterRevenueReport = $(this).find('option:selected').data('time');
    switch (Number($(this).val())){
        case 13:
            fromFilterRevenueReport = $(this).parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterRevenueReport = $(this).parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            fromFilterRevenueReport = $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterRevenueReport = $(this).parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            fromFilterRevenueReport = $(this).parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterRevenueReport = $(this).parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            fromFilterRevenueReport = "";
            toFilterRevenueReport = "" ;
    }
    loadDataRevenueReportDashboard()
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-revenue-report'), $('#select-type-revenue-report'));
});
getTimeChangeSelectTypeDashboardReport($('#text-label-type-revenue-report'), $('#select-type-revenue-report'));

$('#select-type-revenue-report .search-date-option-filter-time-bar').on('click', function () {
    detectDateOptionTimeRevenue(Number($('#select-type-revenue-report select').find('option:selected').val()))
    // if(!CheckDateFormTo(fromFilterRevenueReport, toFilterRevenueReport)) return false
    if(!checkDashboardCustomDateTimePicker($(this), $('#select-type-revenue-report select'))) return false;
    reloadRevenueReport();
});

function detectDateOptionTimeRevenue(type) {
    switch (type){
        case 13:
            fromFilterRevenueReport = $('#select-type-revenue-report select').parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterRevenueReport = $('#select-type-revenue-report select').parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            fromFilterRevenueReport = $('#select-type-revenue-report select').parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterRevenueReport = $('#select-type-revenue-report select').parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            fromFilterRevenueReport = $('#select-type-revenue-report select').parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterRevenueReport = $('#select-type-revenue-report select').parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            fromFilterRevenueReport = "";
            toFilterRevenueReport = "" ;
    }
}

$('#label-chart-all-revenue-report').on('change', function () {
    if ($(this).is(':checked')) {
        $('#chart-vertical-all-revenue-report .amcharts-graph-column text').removeClass('d-none');
        $('#chart-horizontal-all-revenue-report .amcharts-graph-column text').removeClass('d-none');
    } else {
        $('#chart-vertical-all-revenue-report .amcharts-graph-column text').addClass('d-none');
        $('#chart-horizontal-all-revenue-report .amcharts-graph-column text').addClass('d-none');
    }
});



$('#label-chart-adjacent-revenue-report').on('change', function () {
    if ($(this).is(':checked')) {
        $('#chart-adjacent-revenue-report .amcharts-graph-line text').removeClass('d-none');
    } else {
        $('#chart-adjacent-revenue-report .amcharts-graph-line text').addClass('d-none');
    }
});

$('#label-chart-same-period-revenue-report').on('change', function () {
    if ($(this).is(':checked')) {
        $('#chart-same-period-revenue-report .amcharts-graph-line text').removeClass('d-none');
    } else {
        $('#chart-same-period-revenue-report .amcharts-graph-line text').addClass('d-none');
    }
});

$('#show-vertical-all-revenue-report').on('click', function () {
    $('#chart-vertical-all-revenue-report').removeClass('d-none');
    $('#chart-horizontal-all-revenue-report').addClass('d-none');
    $('#label-chart-all-revenue-report').prop('checked', true);
});

$('#show-horizontal-all-revenue-report').on('click', function () {
    $('#chart-vertical-all-revenue-report').addClass('d-none');
    $('#chart-horizontal-all-revenue-report').removeClass('d-none');
    $('#label-chart-all-revenue-report').prop('checked', true);
});

async function loadDataRevenueReportDashboard() {
    if (checkSpamRevenueReport === 1) return false
    checkSpamRevenueReport = 1;
    $('.load-chart-revenue-day-loading').remove();
    if (loadDataRevenueReport === 1) return false;
    loadDataRevenueReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val();
    let method = 'get',
        url = 'branch-dashboard.data-revenue-report',
        params = {brand: brand, branch: branch, type: typeFilterRevenueReport, time: timeFilterRevenueReport , from: fromFilterRevenueReport , to: toFilterRevenueReport},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#chart-revenue-current'), $('#chart-revenue-adjacent'), $('#chart-revenue-same-period')]);
    checkSpamRevenueReport = 0;
    // $('#total-revenue-report').text(formatNumber(res.data[3].amount));
    if (res.data[3].amount == 0) {
        $('#chart-revenue-current-empty').removeClass('d-none');
        $('#chart-revenue-current').addClass('d-none');
    } else {
        $('#chart-revenue-current-empty').addClass('d-none');
        $('#chart-revenue-current').removeClass('d-none');
        drawEchartRevenueReportDashboard(res.data[0]);
    }
}

async function drawEchartRevenueReportDashboard(data){
    let heightChart = data.timeline.length > 40 ? (heightWindow <= 797 ? '65%': '70%') : (heightWindow <= 797 ? '75%': '77%');
    let widthChart = window.innerWidth <= 1536 ? '9%' : '7%';
    try{
        let dom = document.getElementById("chart-revenue-current");
        let chartMy = await echarts.init(dom, null, {
            renderer: "canvas",
            useDirtyRect: false,
        });
        let option = {
            responsive: true,
            grid : {
                width: "90%",
                top: 80,
                left: widthChart,
                height: heightChart
            },
            tooltip: {
                trigger: 'axis',
                // axisPointer: {
                //     type: 'shadow'
                // },
                textStyle: {
                    fontSize: 12,
                    fontFamily: "Roboto",
                },
                formatter: function (value, i) {
                    return `<div class="seemt-fz-16">${value[0].axisValue}</div>
                            <div class="d-flex align-items-center"><i class="fa-solid fa-circle mr-1" style="font-size: 5px"></i>Số lượng đơn: ${data.quantity[value[0].dataIndex]}</div>
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
            xAxis: [
                {
                    type: "category",
                    axisLabel: {
                        interval: data.timeline.length > 36 ? 2 : 0,
                        rotate: 45,
                        fontSize: 12,
                        fontFamily: "Roboto",
                    },
                    data: data.timeline,
                    axisTick: {
                        alignWithLabel: true
                    },
                },
            ],
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
                        // margin: 10,
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
            // dataZoom: [{
            //     type: 'slider',
            //     show: data.timeline.length > 40,
            //     startValue: 0,
            //     endValue: 39,
            //     height: 20,
            //     // start: 0,
            //     // end: data.timeline.length > 20 ? 19 : 100,
            //     xAxisIndex: 0,
            //     realtime: true,
            //     zoomLock: true,
            //     showDetail: false,
            //     brushSelect: false
            // }],
            series: [
                {
                    name: "Doanh thu",
                    type: "bar",
                    // seriesLayoutBy: "row",
                    data: data.value,
                    barMaxWidth: 20,
                    itemStyle: {
                        color: '#2A74D9'
                    }
                },
            ],
        };

        if (option && typeof option === "object") {
            chartMy.setOption(option);
        }
        $(window).on('resize', function (){
            chartMy.resize();
        });

        $('#detail-value-revenue-report').on('change', function (){
            if($('#detail-value-revenue-report').is(':checked')){
                chartMy.setOption({
                    series : {
                        label: {
                            show: true,
                            verticalAlign: "middle",
                            position:[10, -5, 0, 0],
                            color: "#000",
                            rotate: 60,
                            distance: 15,
                            fontFamily: "roboto",
                            formatter : function (param){
                                return formatNumber(param.value);
                            }
                        },
                    },
                });
            }else {
                chartMy.setOption({
                    series : {
                        label: {show: false},
                    },
                });
            }
        })
    } catch (e) {
        console.log(e);
    }
}

/** Reload Data **/
async function reloadRevenueReport() {
    loadDataRevenueReport = 0;
    checkSpamRevenueReport = 0
    await loadDataRevenueReportDashboard();
}
