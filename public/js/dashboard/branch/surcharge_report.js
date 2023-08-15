let chartSurcharge ;
let typeFilterSurchargeReport, timeFilterSurchargeReport , fromFilterSurchargeReport, toFilterSurchargeReport;
typeFilterSurchargeReport = $('#select-type-surcharge-report select').find('option:selected').val();
timeFilterSurchargeReport = $('#select-type-surcharge-report select').find('option:selected').data('time');
/**
 * ĐĂNG KÝ CHART
 */
chartSurcharge = chartColumnEchart('chart-vertical-surcharge-report');

/**
 * Event
 */
$('#select-type-surcharge-report select').on('change', function () {
    loadDataSurchargeReport = 0;
    typeFilterSurchargeReport = $(this).val();
    timeFilterSurchargeReport = $(this).find('option:selected').data('time');
    switch (Number($(this).val())){
        case 13:
            fromFilterSurchargeReport = $(this).parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterSurchargeReport = $(this).parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            fromFilterSurchargeReport = $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterSurchargeReport = $(this).parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            fromFilterSurchargeReport = $(this).parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterSurchargeReport = $(this).parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            fromFilterSurchargeReport = "";
            toFilterSurchargeReport = "" ;
    }
    dataSurchargeReport();
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-surcharge-report'), $('#select-type-surcharge-report select'));
});
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-surcharge-report'), $('#select-type-surcharge-report select'));


$('#select-type-surcharge-report .search-date-option-filter-time-bar').on('click', function () {
    detectDateOptionTimeSurcharge(Number($('#select-type-surcharge-report select').find('option:selected').val()))
    // if(!CheckDateFormTo(fromFilterSurchargeReport, toFilterSurchargeReport)) return false
    if(!checkDashboardCustomDateTimePicker($(this), $('#select-type-surcharge-report select'))) return false;
    reloadSurchargeReport();
});

function detectDateOptionTimeSurcharge(type) {
    switch (type){
        case 13:
            fromFilterSurchargeReport = $('#select-type-surcharge-report select').parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterSurchargeReport = $('#select-type-surcharge-report select').parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            fromFilterSurchargeReport = $('#select-type-surcharge-report select').parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterSurchargeReport = $('#select-type-surcharge-report select').parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            fromFilterSurchargeReport = $('#select-type-surcharge-report select').parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterSurchargeReport = $('#select-type-surcharge-report select').parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            fromFilterSurchargeReport = "";
            toFilterSurchargeReport = "" ;
    }
}
/**
 * Call data
 * @returns {Promise<void>}
 */
function dataSurchargeReport() {
    $('.chart-vertical-surcharge-report-loading').remove();
    $('.chart-horizontal-surcharge-report-loading').remove();
    if (loadDataSurchargeReport === 1) return false;
    loadDataSurchargeReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        type = $('#select-type-surcharge-report').val(),
        time = $('#select-type-surcharge-report').find(':selected').data('time');
    $('#chart-vertical-surcharge-report').prepend(themeLoading($('#chart-vertical-surcharge-report').height(), 'chart-vertical-surcharge-report-loading'))
    axios({
        method: 'get',
        url: 'branch-dashboard.data-surcharge-report',
        params: {brand: brand, branch: branch, type: typeFilterSurchargeReport, time: timeFilterSurchargeReport , from: fromFilterSurchargeReport , to:toFilterSurchargeReport}
    }).then(function (res) {
        console.log(res);
        updateSurchargeChartColumnEchart(chartSurcharge,res.data[0])
        $('#detail-value-surcharge-report').on('change', function (){
            if($('#detail-value-surcharge-report').is(':checked')){
                chartSurcharge.setOption({
                    series : {
                        label: {
                            show: true,
                            verticalAlign: "middle",
                            position:[10, -5, 0, 0],
                            color: "#000",
                            distance: 15,
                            fontFamily: "roboto",
                            rotate : 60,
                            formatter : function (param){
                                return formatNumber(param.value);
                            }
                        },
                    },
                });
            }else {
                chartSurcharge.setOption({
                    series : {
                        label: {show: false},
                    },
                });
            }
        })
        $('#total-surcharge-report').text(res.data[1]);
        $('.chart-vertical-surcharge-report-loading').remove();
        $(window).on('resize', function () {
            chartSurcharge.resize();
        });
    }).catch(function (e) {
        console.log(e);
    });
}

function updateSurchargeChartColumnEchart(chart , data){
    let heightChart = data.timeline.length > 40 ? (heightWindow <= 797 ? '66%': '73%') : (heightWindow <= 797 ? '75%': '80%');
    dataChartTemplateUpdate = data;
    let option = {
        tooltip: {
            trigger: 'axis',
            // axisPointer: {
            //     type: 'shadow'
            // },
            textStyle: {
                fontSize: 12,
                fontFamily: 'Roboto'
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
        xAxis: [
            {
                type: "category",
                data: data.timeline,
                axisLabel: {
                    interval: data.timeline.length > 36 ? 2 : 0,
                    fontSize: 12,
                    rotate: 45,
                    fontFamily: "Roboto",
                },
                axisTick: {
                    show: true,
                    alignWithLabel: true
                },
            },
        ],
        grid : {
            y: 50,
            y2: 120,
            top: 60,
            width: "90%",
            left: "7%",
            height: heightChart
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
        // dataZoom: [{
        //     type: 'slider',
        //     show: data.timeline.length > 40,
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

    chart.setOption(option);
    window.onresize = function() {
        chart.resize();
    };
}

/**
 * Reload Data
 */
function reloadSurchargeReport() {
    loadDataSurchargeReport = 0;
    dataSurchargeReport();
}
