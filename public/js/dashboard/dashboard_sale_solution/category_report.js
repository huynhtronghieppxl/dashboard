let chartCategory;
let typeFilterCategoryReport, timeFilterCategoryReport , fromFilterCategoryReport, toFilterCategoryReport;
typeFilterCategoryReport = $('#select-type-category-report select').find('option:selected').val();
timeFilterCategoryReport = $('#select-type-category-report select').find('option:selected').data('time');
$(function(){
    $('#select-type-category-report select').on('change', function () {
        loadDataCategoryReport = 0;
        typeFilterCategoryReport = $(this).val();
        timeFilterCategoryReport = $(this).find('option:selected').data('time');
        switch (Number($(this).val())){
            case 13:
                fromFilterCategoryReport = $(this).parents('.filter-dashboard-report').find('.from-day-filter-time-report').val();
                toFilterCategoryReport = $(this).parents('.filter-dashboard-report').find('.to-day-filter-time-report').val();
                break;
            case 15:
                fromFilterCategoryReport = $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-report').val();
                toFilterCategoryReport = $(this).parents('.filter-dashboard-report').find('.to-month-filter-time-report').val();
                break;
            case 16:
                fromFilterCategoryReport = $(this).parents('.filter-dashboard-report').find('.from-year-filter-time-report').val();
                toFilterCategoryReport = $(this).parents('.filter-dashboard-report').find('.to-year-filter-time-report').val();
                break;
            default:
                fromFilterCategoryReport = "";
                toFilterCategoryReport = "" ;
        }
        dataCategoryReport();
        getTimeChangeSelectTypeDashboardReport($('#text-label-type-category-report'), $('#select-type-category-report select'));
    });
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-category-report'), $('#select-type-category-report select'));
})

$('#select-type-category-report button').on('click', function () {
    if(!checkDashboardCustomDateTimePicker($(this), $('#select-type-category-report select'))) return false;
    switch (Number($('#select-type-category-report select').find('option:selected').val())){
        case 13:
            fromFilterCategoryReport = $(this).parents('.filter-dashboard-report').find('.from-day-filter-time-report').val();
            toFilterCategoryReport = $(this).parents('.filter-dashboard-report').find('.to-day-filter-time-report').val();
            break;
        case 15:
            fromFilterCategoryReport = $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-report').val();
            toFilterCategoryReport = $(this).parents('.filter-dashboard-report').find('.to-month-filter-time-report').val();
            break;
        case 16:
            fromFilterCategoryReport = $(this).parents('.filter-dashboard-report').find('.from-year-filter-time-report').val();
            toFilterCategoryReport = $(this).parents('.filter-dashboard-report').find('.to-year-filter-time-report').val();
            break;
        default:
            fromFilterCategoryReport = "";
            toFilterCategoryReport = "" ;
    }
    reloadCategoryReport();
});
/**
 * Call data
 * @returns {Promise<void>}
 */
function dataCategoryReport() {
    // $('.chart-vertical-category-report-loading').remove();
    // $('.chart-horizontal-category-report-loading').remove();
    // $('.chart-pie-category-report-loading').remove();
    if (loadDataCategoryReport === 1) return false;
    loadDataCategoryReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val();
    $('#chart-vertical-category-report').prepend(themeLoading($('#chart-vertical-category-report').height(), 'chart-vertical-category-report-loading'))
    $('#chart-vertical-category-report-empty').prepend(themeLoading($('#chart-vertical-category-report-empty').height(), 'chart-vertical-category-report-loading'))
    $('#chart-horizontal-category-report').prepend(themeLoading($('#chart-horizontal-category-report').height(), 'chart-horizontal-category-report-loading'))
    $('#chart-pie-category-report').prepend(themeLoading($('#chart-pie-category-report').height(), 'chart-pie-category-report-loading'))

    axios({
        method: 'get',
        url: 'branch-dashboard.data-category-report',
        params: {brand: brand, branch: branch, type: typeFilterCategoryReport, time: timeFilterCategoryReport, from: fromFilterCategoryReport, to: toFilterCategoryReport}
    }).then(function (res) {
        console.log(res)
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
        // updateChartColumnEchartCategory(chartCategory,res.data[0]);
        drawCategoryReportChart(res.data[0]);
        // chartColumnHorizontalTemplate(res.data[0], element2, titleX, unit, color);
        chartPieCategoryEchartTemplate(res.data[1], element3);
        $('#total-category-report').text(res.data[2]);
        $('.chart-vertical-category-report-loading').remove();
        $('.chart-horizontal-category-report-loading').remove();
        $('.chart-pie-category-report-loading').remove();
    }).catch(function (e) {
        console.log(e);
    });
}

function chartPieCategoryEchartTemplate(data, element, color){
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
        legend: {
            orient: 'vertical',
            left: 'right',
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

function drawCategoryReportChart(data) {
    try{
        if(data.timeline.length === 0){
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
            dataZoom: [{
                    type: "slider",
                    zoomOnMouseWheel: false,
                    moveOnMouseMove: 'shift',
                    realtime: true,
                    show: data.timeline.length > 8 ? true : false,
                    start: 0,
                    end: data.timeline.length > 8 ? 20 : 100,
                    brushSelect: false,
                    yAxisIndex: 0,
                    filterMode: "empty",
                    width: 30,
                    height: "80%",
                    // zoomLock: true,
                    showDataShadow: false,
                    handleSize: 20,
                    left: "93%",
                }],
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
            chartCategory.setOption(option);
        }
        $('#detail-value-category-report').on('change', function (){
            if($('#detail-value-category-report').is(':checked')){
                chartCategory.setOption({
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
                chartCategory.setOption({
                    series : {
                        label: {show: false},
                    },
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
