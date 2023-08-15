let chartCategory;
let typeFilterCategoryReport, timeFilterCategoryReport , fromFilterCategoryReport, toFilterCategoryReport;

typeFilterCategoryReport = $('#select-type-category-report .select-option-filter-report').find('option:selected').val();
timeFilterCategoryReport = $('#select-type-category-report .select-option-filter-report').find('option:selected').data('time');
$(function(){
    $('#select-type-category-report .select-option-filter-report').on('change', function () {
        loadDataCategoryReport = 0;
        typeFilterCategoryReport = $(this).val();
        timeFilterCategoryReport = $(this).find('option:selected').data('time');
        switch (Number($(this).val())){
            case 13:
                fromFilterCategoryReport = $(this).parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
                toFilterCategoryReport = $(this).parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
                break;
            case 15:
                fromFilterCategoryReport = $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
                toFilterCategoryReport = $(this).parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
                break;
            case 16:
                fromFilterCategoryReport = $(this).parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
                toFilterCategoryReport = $(this).parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
                break;
            default:
                fromFilterCategoryReport = "";
                toFilterCategoryReport = "" ;
        }
        dataCategoryReport();
        getTimeChangeSelectTypeDashboardReport($('#text-label-type-category-report'), $('#select-type-category-report .select-option-filter-report'));
    });
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-category-report'), $('#select-type-category-report .select-option-filter-report'));
})

$('#select-type-category-report .search-date-option-filter-time-bar').on('click', function () {
    detectDateOptionTimeCategory(Number($('#select-type-category-report .select-option-filter-report').find('option:selected').val()))
    // if(!CheckDateFormTo(fromFilterCategoryReport, toFilterCategoryReport)) return false
    if(!checkDashboardCustomDateTimePicker($(this), $('#select-type-category-report .select-option-filter-report'))) return false;
    reloadCategoryReport();
});

$('#category-report').on('change', '#select-sort-category-report', function () {
    loadDataCategoryReport = 0;
    dataCategoryReport();
})

function detectDateOptionTimeCategory(type) {
    switch (type){
        case 13:
            fromFilterCategoryReport = $('#select-type-category-report select').parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterCategoryReport = $('#select-type-category-report select').parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            fromFilterCategoryReport = $('#select-type-category-report select').parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterCategoryReport = $('#select-type-category-report select').parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            fromFilterCategoryReport = $('#select-type-category-report select').parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterCategoryReport = $('#select-type-category-report select').parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            fromFilterCategoryReport = "";
            toFilterCategoryReport = "" ;
    }
}
/**
 * Call data
 * @returns {Promise<void>}
 */
function dataCategoryReport() {
    $('.chart-vertical-category-report-loading').remove();
    $('.chart-horizontal-category-report-loading').remove();
    $('.chart-pie-category-report-loading').remove();
    if (loadDataCategoryReport === 1) return false;
    loadDataCategoryReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        sortSelect = $('#select-sort-category-report').val();
    $('#chart-vertical-category-report').prepend(themeLoading($('#chart-vertical-category-report').height(), 'chart-vertical-category-report-loading'))
    $('#chart-vertical-category-report-empty').prepend(themeLoading($('#chart-vertical-category-report').height(), 'chart-vertical-category-report-loading'))
    $('#chart-horizontal-category-report').prepend(themeLoading($('#chart-horizontal-category-report').height(), 'chart-horizontal-category-report-loading'))
    $('#chart-pie-category-report').prepend(themeLoading($('#chart-pie-category-report').height(), 'chart-pie-category-report-loading'))

    axios({
        method: 'get',
        url: 'branch-dashboard.data-category-report',
        params: {brand: brand, branch: branch, type: typeFilterCategoryReport, time: timeFilterCategoryReport, from: fromFilterCategoryReport, to: toFilterCategoryReport, sortSelect}
    }).then(function (res) {
        let element1 = 'chart-vertical-category-report';
        let element3 = 'chart-pie-category-report';
        let titleX = $('#title-money-chart-component').val();
        let unit = $('#unit-money-chart-component').val();
        if (res.data[0].length > 50) {
            $('#chart-vertical-category-report').attr('style', 'width:' + res.data[0].length * 20 + 'px; min-width: 100%');
            $('#chart-horizontal-category-report').attr('style', 'height:' + res.data[0].length * 15 + 'px; min-height: 400px');
        } else {
            $('#chart-vertical-category-report').attr('style', false);
            $('#chart-horizontal-category-report').attr('style', false);
        }
        let color = "#0072bc";
        drawCategoryReportChart(res.data[0] === null
                ? []
                : res.data[0].map((i) => {
                    return i.timeline;
                }),
            res.data[0] === null
                ? []
                : res.data[0].map((i) => {
                    return i.total_amount;
                }),
            res.data[0] === null
                ? []
                : res.data[0].map((i) => {
                    return i.original_amount;
                }),res.data[0] === null
                ? []
                : res.data[0].map((i) => {
                    return i.quantity;
                }),
            res.data[3]);
        chartPieCategoryEchartTemplate(res.data[1], element3, res.data[2]);
        $('#total-category-report').text(res.data[2]);
        $('.chart-vertical-category-report-loading').remove();
        $('.chart-horizontal-category-report-loading').remove();
        $('.chart-pie-category-report-loading').remove();
    }).catch(function (e) {
        console.log(e);
    });
}

function chartPieCategoryEchartTemplate(data, element, total_amount){
    if (data.value === [] || data.value === null) {
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
            orient: 'vertical',
            left: 'right',
            type: 'scroll',
            formatter: function (name){
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
                data: data,
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                },
                avoidLabelOverlap: false,
                label: {
                    show: true,
                    formatter:'{b}: ({d}%)',
                },
                labelLine: {
                    show: true
                },
            },
        ]
    };
    option && myChart.setOption(option);
}

function drawCategoryReportChart(dataTimeline, dataTotalAmount, dataOriginalAmount, quantity, dataTotal) {
    let heightChart = dataTimeline.length > 40 ? (heightWindow <= 797 ? '55%': '60%') : (heightWindow <= 797 ? '65%': '75%');
    try {
        if(dataTimeline.length === 0){
            $('#chart-vertical-category-report-empty').removeClass('d-none');
            $('#chart-vertical-category-report').addClass('d-none');
        } else {
            $('#chart-vertical-category-report-empty').addClass('d-none');
            $('#chart-vertical-category-report').removeClass('d-none');
        }
        let dom = document.getElementById("chart-vertical-category-report");
        chartCategory = echarts.init(dom, null, {
            renderer: "canvas",
            useDirtyRect: false,
        });
        let app = {};
        let option = {
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                },
                textStyle: {
                    fontSize: 12,
                    fontFamily: 'Roboto'
                },
                formatter: function (value, i) {
                    let colorBar = value.length > 1 ? `<div class="d-flex align-items-center">${value[1].marker} ${value[1].seriesName} : ${formatNumber(value[1].value)}</div>` : '';
                    return `<strong class="d-flex align-items-center">${value[0].name}</strong>
                            <div class="d-flex align-items-center">Số lượng món : ${quantity[value[0].dataIndex]}</div>
                            <div class="d-flex align-items-center">${value[0].marker} ${value[0].seriesName} : ${formatNumber(value[0].value)}</div>
                            ${colorBar}`;
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
                        overflow: 'truncate', // sử dụng overflow để đảm bảo không bị cắt chữ khi text xuống hàng
                        width: 80,
                        showMinLabel: true,
                        showMaxLabel: true,
                        fontFamily: 'Roboto',
                    },
                    data: dataTimeline,
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
            dataZoom: [{
                type: 'slider',
                show: dataTimeline.length > 40,
                height: 20,
                startValue: 0,
                endValue: 39,
                // start: 0,
                // end: dataTimeline.length > 20 ? 19 : 100,
                xAxisIndex: 0,
                bottom: 0,
                realtime: true,
                zoomLock: true,
                showDetail: false,
                brushSelect: false
            }],
            legend: {
                show: true,
                textStyle: {
                    rich: {
                        num: {
                            fontSize: 16,
                            color: "#fa6342",
                            fontWeight: "bold",
                        },
                    }
                },
                formatter: function (name) {
                    return `${name}: {num|${dataTotal[name]}}`;
                },
                top: 'top',
            },
            series: [
                {
                    name: "Giá bán",
                    type: "bar",
                    seriesLayoutBy: "row",
                    barGap: 0,
                    data: dataTotalAmount,
                    barMaxWidth: 20,
                    barCategoryGap: "10%",
                    emphasis: {
                        focus: 'series'
                    },
                    itemStyle: {
                        color: '#2A74D9'
                    }
                }
                ,{
                    name: "Giá vốn",
                    type: "bar",
                    seriesLayoutBy: "row",
                    data: dataOriginalAmount,
                    barMaxWidth: 20,
                    barCategoryGap: "10%",
                    emphasis: {
                        focus: 'series'
                    },
                    itemStyle: {
                        color: '#FFA400'
                    }
                },
            ],
        };

        if (option && typeof option === "object") {
            chartCategory.setOption(option);
        }
        $('#detail-value-category-report').on('change', function (){
            if($('#detail-value-category-report').is(':checked')){
                chartCategory.setOption({
                    series: chartCategory.getOption().series.map((seriesItem) => {
                        return {
                            ...seriesItem,
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
                            }
                        };
                    })
                });
            }else {
                chartCategory.setOption({
                    series: chartCategory.getOption().series.map((seriesItem) => {
                        return {
                            ...seriesItem,
                            label: {
                                show: false
                            }
                        };
                    })
                });
            }
        })

    } catch (e) {
        console.log(e);
        $('#chart-vertical-category-report-empty').removeClass('d-none');
        $('#chart-vertical-category-report').addClass('d-none');
    }
    chartCategory.resize();
    $(window).on('resize', function (){
        chartCategory.resize();
    });
}

/**
 * Reload Data
 */
function reloadCategoryReport() {
    loadDataCategoryReport = 0;
    dataCategoryReport();
}
