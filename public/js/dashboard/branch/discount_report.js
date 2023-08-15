let chartDiscount;
let typeFilterDiscountReport, timeFilterDiscountReport , fromFilterDiscountReport, toFilterDiscountReport;
typeFilterDiscountReport = $('#select-type-discount-report select').find('option:selected').val();
timeFilterDiscountReport = $('#select-type-discount-report select').find('option:selected').data('time');
$(function(){
    $('#select-type-discount-report select').on('change', function () {
        loadDataDiscountReport = 0;
        typeFilterDiscountReport = $(this).val();
        timeFilterDiscountReport = $(this).find('option:selected').data('time');
        switch (Number($(this).val())){
            case 13:
                fromFilterDiscountReport = $(this).parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
                toFilterDiscountReport = $(this).parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
                break;
            case 15:
                fromFilterDiscountReport = $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
                toFilterDiscountReport = $(this).parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
                break;
            case 16:
                fromFilterDiscountReport = $(this).parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
                toFilterDiscountReport = $(this).parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
                break;
            default:
                fromFilterDiscountReport = "";
                toFilterDiscountReport = "" ;
        }
        dataDiscountReport();
        getTimeChangeSelectTypeDashboardReport($('#text-label-type-discount-report'), $('#select-type-discount-report select'));
    });
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-discount-report'), $('#select-type-discount-report select'));
})


$('#select-type-discount-report .search-date-option-filter-time-bar').on('click', function () {
    detectDateOptionTimeDiscount(Number($('#select-type-discount-report select').find('option:selected').val()))
    if(!checkDashboardCustomDateTimePicker($(this), $('#select-type-discount-report select'))) return false;
    reloadDiscountReport();
});

function detectDateOptionTimeDiscount(type) {
    switch (type){
        case 13:
            fromFilterDiscountReport = $('#select-type-discount-report select').parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterDiscountReport = $('#select-type-discount-report select').parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            fromFilterDiscountReport = $('#select-type-discount-report select').parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterDiscountReport = $('#select-type-discount-report select').parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            fromFilterDiscountReport = $('#select-type-discount-report select').parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterDiscountReport = $('#select-type-discount-report select').parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            fromFilterDiscountReport = "";
            toFilterDiscountReport = "" ;
    }
}

/**
 * Call data
 */
function dataDiscountReport() {
    $('.chart-vertical-discount-report-loading').remove();
    $('.chart-horizontal-discount-report-loading').remove();
    if (loadDataDiscountReport === 1) return false;
    loadDataDiscountReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        time = $('#select-type-discount-report').find(':selected').data('time');
    $('#chart-vertical-discount-report').prepend(themeLoading($('#chart-vertical-discount-report').height(), 'chart-vertical-discount-report-loading'))
    $('#chart-vertical-discount-report-empty').prepend(themeLoading($('#chart-vertical-discount-report').height(), 'chart-vertical-discount-report-loading'))
    $('#chart-horizontal-discount-report').prepend(themeLoading($('#chart-horizontal-discount-report').height(), 'chart-horizontal-discount-report-loading'))

    axios({
        method: 'get',
        url: 'branch-dashboard.data-discount-report',
        params: {brand: brand, branch: branch, type: typeFilterDiscountReport, time: timeFilterDiscountReport, from: fromFilterDiscountReport , to: toFilterDiscountReport}
    }).then(function (res) {
        console.log(res);
        if (res.data[0].length > 50) {
            $('#chart-vertical-discount-report').attr('style', 'width:' + res.data[0].length * 20 + 'px; min-width: 100%');
            $('#chart-horizontal-discount-report').attr('style', 'height:' + res.data[0].length * 15 + 'px; min-height: 400px');
        } else {
            $('#chart-vertical-discount-report').attr('style', false);
            $('#chart-horizontal-discount-report').attr('style', false);
        }


        if(res.data[2] === 0){
            $('#chart-vertical-discount-report-empty').removeClass('d-none');
            $('#chart-vertical-discount-report').addClass('d-none');
        } else {
            $('#chart-vertical-discount-report-empty').addClass('d-none');
            $('#chart-vertical-discount-report').removeClass('d-none');
        }

        drawEchartDiscountReportDashboard(res.data[0])
        $('#total-discount-report').text(res.data[1]);
        $('.chart-vertical-discount-report-loading').remove();
        $('.chart-horizontal-discount-report-loading').remove();
    }).catch(function (e) {
        console.log(e);
    });
}

function drawEchartDiscountReportDashboard(data){
    let heightChart = data.timeline.length > 40 ? (heightWindow <= 797 ? '66%': '73%') : (heightWindow <= 797 ? '75%': '80%');
    try{
        let dom = document.getElementById("chart-vertical-discount-report");
        chartDiscount = echarts.init(dom, null, {
            renderer: "canvas",
            useDirtyRect: false,
        });
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
                        fontSize: 12,
                        rotate: 60,
                        fontFamily: "Roboto",
                    },
                    data: data.timeline,
                },
            ],
            grid : {
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
            chartDiscount.setOption(option);
        }
        $('#detail-value-discount-report').on('change', function (){
            if($('#detail-value-discount-report').is(':checked')){
                chartDiscount.setOption({
                    series : {
                        label: {
                            show: true,
                            verticalAlign: "middle",
                            position: [10, -5, 0, 0],
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
                chartDiscount.setOption({
                    series : {
                        label: {show: false},
                    },
                });
            }
        })
        chartDiscount.resize();
        $(window).on('resize', function () {
            chartDiscount.resize();
        });
    } catch (e) {
        console.log(e);
        $('#chart-vertical-discount-report-empty').removeClass('d-none');
        $('#chart-vertical-discount-report').addClass('d-none');
    }
    chartDiscount.resize();
    $(window).on('resize', function (){
        chartDiscount.resize();
    });
}

/**
 * Reload Data
 */
function reloadDiscountReport() {
    loadDataDiscountReport = 0;
    dataDiscountReport();
}
