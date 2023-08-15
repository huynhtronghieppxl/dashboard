let chartArea;
let typeFilterAreaReport, timeFilterAreaReport, fromFilterAreaReport, toFilterAreaReport;
typeFilterAreaReport = $('#select-type-area-report select').find('option:selected').val();
timeFilterAreaReport = $('#select-type-area-report select').find('option:selected').data('time');

// $(function () {
//     $('.seemt-container').on('click',function () {
//         $(this).find('.report-revenue .add-display').removeClass('border-danger')
//         $(this).find('.report-revenue .add-display').tooltip('hide')
//     })
// })
$('#select-type-area-report select').on('change', function () {
    loadDataAreaReport = 0;
    typeFilterAreaReport = $(this).val();
    timeFilterAreaReport = $(this).find('option:selected').data('time');
    switch (Number($(this).val())) {
        case 13:
            fromFilterAreaReport = $(this).parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterAreaReport = $(this).parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            fromFilterAreaReport = $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterAreaReport = $(this).parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            fromFilterAreaReport = $(this).parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterAreaReport = $(this).parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            fromFilterAreaReport = "";
            toFilterAreaReport = "";
    }
    dataAreaReport();
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-area-report'), $('#select-type-area-report'));
});
getTimeChangeSelectTypeDashboardReport($('#text-label-type-area-report'), $('#select-type-area-report'));


$('#select-type-area-report .search-date-option-filter-time-bar').on('click', function () {
    detectDateOptionTimeArea(Number($('#select-type-area-report select').find('option:selected').val()))
    // if(!CheckDateFormTo(fromFilterAreaReport, toFilterAreaReport)) return false
    if (!checkDashboardCustomDateTimePicker($(this), $('#select-type-area-report select'))) return false;
    reloadAreaReport();
})

function detectDateOptionTimeArea(type) {
    switch (type) {
        case 13:
            fromFilterAreaReport = $('#select-type-area-report select').parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterAreaReport = $('#select-type-area-report select').parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            fromFilterAreaReport = $('#select-type-area-report select').parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterAreaReport = $('#select-type-area-report select').parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            fromFilterAreaReport = $('#select-type-area-report select').parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterAreaReport = $('#select-type-area-report select').parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            fromFilterAreaReport = "";
            toFilterAreaReport = "";
    }
}


/**
 * Call data
 * @returns {Promise<void>}
 */
function dataAreaReport() {
    $('.chart-vertical-area-report-loading').remove();
    $('.chart-horizontal-area-report-loading').remove();
    $('.chart-pie-area-report-loading').remove();
    if (loadDataAreaReport === 1) return false;
    loadDataAreaReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        type = $('#select-type-area-report').val(),
        time = $('#select-type-area-report').find(':selected').data('time');
    $('#chart-vertical-area-report').prepend(themeLoading($('#chart-vertical-category-report').height(), 'chart-vertical-area-report-loading'))
    $('#chart-vertical-category-report-empty').prepend(themeLoading($('#chart-vertical-category-report-empty').height(), 'chart-horizontal-area-report-loading'))
    $('#chart-pie-area-report').prepend(themeLoading($('#chart-pie-category-report').height(), 'chart-pie-area-report-loading'))

    axios({
        method: 'get',
        url: 'branch-dashboard.data-area-report',
        params: {
            brand: brand,
            branch: branch,
            type: typeFilterAreaReport,
            time: timeFilterAreaReport,
            from: fromFilterAreaReport,
            to: toFilterAreaReport
        }
    }).then(function (res) {
        console.log(res);
        let element3 = 'chart-pie-area-report';
        if (res.data[2].length > 50) {
            $('#chart-vertical-area-report').attr('style', 'width:' + res.data[0].length * 20 + 'px; min-width: 100%');
            $('#chart-horizontal-area-report').attr('style', 'height:' + res.data[0].length * 15 + 'px; min-height: 400px');
        } else {
            $('#chart-vertical-area-report').attr('style', false);
            $('#chart-horizontal-area-report').attr('style', false);
        }

        if (res.data[0].timeline.length === 0) {
            $('#chart-vertical-area-report-empty').removeClass('d-none');
            $('#chart-vertical-area-report').addClass('d-none');
        } else {
            $('#chart-vertical-area-report-empty').addClass('d-none');
            $('#chart-vertical-area-report').removeClass('d-none');
        }

        drawEchartAreaReportDashboard(res.data[0], res.data[2].total);
        chartPieAreaEchartTemplate(res.data[1], element3, res.data[2].total);
        $('#total-area-report').text(res.data[2].total);
        $('.chart-vertical-area-report-loading').remove();
        $('.chart-horizontal-area-report-loading').remove();
        $('.chart-pie-area-report-loading').remove();
    }).catch(function (e) {
        console.log(e);
    });
}

function drawEchartAreaReportDashboard(data, total_amount) {
    let heightChart = data.timeline.length > 40 ? (heightWindow <= 797 ? '67%': '75%') : (heightWindow <= 797 ? '75%': '80%');
    try {
        let dom = document.getElementById("chart-vertical-area-report");
        chartArea = echarts.init(dom, null, {
            renderer: "canvas",
            useDirtyRect: false,
        });
        let option = {
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                },
                textStyle: {
                    fontSize: 12,
                    fontWeight: 500,
                    fontFamily: 'Roboto',
                },
                formatter: function (value, i) {
                    return `<div class="d-flex align-items-center">Số lượng đơn : ${data.quantity[value[0].dataIndex]}</div>
                            <div class="d-flex align-items-center">Tổng tiền : ${formatNumber(value[0].value)}</div>`;
                },
            },

            xAxis: [
                {
                    type: "category",
                    axisLabel: {
                        interval: 0,
                        rotate: 45,
                        fontSize: 12,
                        fontWeight: 500,
                        overflow: 'truncate',
                        width: 100,
                        showMinLabel: true,
                        showMaxLabel: true,
                        fontFamily: 'Roboto',
                    },
                    data: data.timeline,
                },
            ],
            grid: {
                width: "80%",
                left: "15%",
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
            dataZoom: [{
                type: 'slider',
                show: data.timeline.length > 40,
                height: 20,
                startValue: 0,
                endValue: 39,
                // start: 0,
                // end: data.timeline.length > 20 ? 19 : 100,
                xAxisIndex: 0,
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
                    barMaxWidth: 20,
                    data: data.value,
                    itemStyle: {
                        color: '#2A74D9'
                    },
                },
            ],
        };
        if (option && typeof option === "object") {
            chartArea.setOption(option);
        }
        $('#detail-value-area-report').on('change', function () {
            if ($('#detail-value-area-report').is(':checked')) {
                chartArea.setOption({
                    series: {
                        label: {
                            show: true,
                            verticalAlign: "middle",
                            position: [10, -5, 0, 0],
                            color: "#000",
                            rotate: 60,
                            distance: 15,
                            // fontWeight: "bolder",
                            fontFamily: "roboto",
                            formatter: function (param) {
                                return formatNumber(param.value);
                            }
                        },
                    },
                });
            } else {
                chartArea.setOption({
                    series: {
                        label: {show: false},
                    },
                });
            }
        })
        chartArea.resize();
        $(window).on('resize', function () {
            chartArea.resize();
        });
    } catch (e) {
        console.log(e);
        $('#chart-vertical-area-report-empty').removeClass('d-none');
        $('#chart-vertical-area-report').addClass('d-none');
    }
    chartArea.resize();
    $(window).on('resize', function () {
        chartArea.resize();
    });
}

function chartPieAreaEchartTemplate(data, element, total_amount) {
    if (data === [] || data === null) {
        $('#' + element).html(
            "<div class='empty-datatable-custom center-loading'><img src='../../../../files/assets/images/nodata-datatable2.png'></div>"
        );
        return false;
    }
    let chartDom = document.getElementById(element);
    let myChart = echarts.init(chartDom);
    let option = {
        tooltip: {
            trigger: 'item'
        },
        title: {
            text: '{a|Tổng:} {b|' + total_amount + '} {a|VNĐ}',
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
        legend: {
            bottom: 10,
            left: 'center',
            type: 'scroll',
            formatter: function (name) {
                let series = myChart.getOption().series[0];
                let value = series.data.filter(row => row.name === name)[0].value
                return name + ':  (' + formatNumber(value) + ')';
            },
            textStyle: {
                fontWeight: "normal",
                fontFamily: "Roboto"
            }
        },
        series: [
            {
                type: 'pie',
                radius: '50%',
                center: ['50%', '50%'],
                data: data,
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)',
                    }
                },
                avoidLabelOverlap: false,
                label: {
                    show: true,
                    formatter: '{b} ({d}%)'
                },
                labelLine: {
                    show: true
                },
            },
        ]
    };
    option && myChart.setOption(option);
}

/**
 * Reload Data
 */
function reloadAreaReport() {
    loadDataAreaReport = 0;
    dataAreaReport();
}

