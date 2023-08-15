let typeFilterFoodDrinkReport, timeFilterFoodDrinkReport , fromFilterFoodDrinkReport, toFilterFoodDrinkReport;
typeFilterFoodDrinkReport = $('#select-type-food-drink-report').find('option:selected').val();
timeFilterFoodDrinkReport = $('#select-type-food-drink-report').find('option:selected').data('time');
$('#select-type-food-drink-report .select-option-filter-report').on('change', function () {
    loadDataFoodDrinkReport = 0;
    typeFilterFoodDrinkReport = $(this).val();
    timeFilterFoodDrinkReport = $(this).find('option:selected').data('time');
    switch (Number($(this).val())){
        case 13:
            fromFilterFoodDrinkReport = $(this).parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterFoodDrinkReport = $(this).parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            fromFilterFoodDrinkReport = $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterFoodDrinkReport = $(this).parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            fromFilterFoodDrinkReport = $(this).parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterFoodDrinkReport = $(this).parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            fromFilterFoodDrinkReport = "";
            toFilterFoodDrinkReport = "" ;
    }
    dataFoodDrinkReport();
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-food-drink-report'), $('#select-type-food-drink-report'));
});
getTimeChangeSelectTypeDashboardReport($('#text-label-type-food-drink-report'), $('#select-type-food-drink-report'));


$('#select-type-food-drink-report .search-date-option-filter-time-bar').on('click', function () {
    detectDateOptionTimeFoodDrink(Number($('#select-type-food-drink-report select').find('option:selected').val()))
    if(!checkDashboardCustomDateTimePicker($(this), $('#select-type-food-drink-report select'))) return false;
    reloadFoodDrinkReport()
})

function detectDateOptionTimeFoodDrink(type) {
    switch (type){
        case 13:
            fromFilterFoodDrinkReport = $('#select-type-food-drink-report select').parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterFoodDrinkReport = $('#select-type-food-drink-report select').parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            fromFilterFoodDrinkReport = $('#select-type-food-drink-report select').parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterFoodDrinkReport = $('#select-type-food-drink-report select').parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            fromFilterFoodDrinkReport = $('#select-type-food-drink-report select').parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterFoodDrinkReport = $('#select-type-food-drink-report select').parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            fromFilterFoodDrinkReport = "";
            toFilterFoodDrinkReport = "" ;
    }
}

$('#food-drink-report').on('change', '#select-sort-food-report', function () {
    loadDataFoodDrinkReport = 0;
    dataFoodDrinkReport();
})

/**
 * Call data
 * @returns {Promise<void>}
 */
function dataFoodDrinkReport() {
    $('.chart-vertical-food-food-drink-report-loading').remove();
    $('.chart-horizontal-food-food-drink-report-loading').remove();
    $('.chart-vertical-drink-food-drink-report-loading').remove();
    $('.chart-horizontal-drink-food-drink-report-loading').remove();
    if (loadDataFoodDrinkReport === 1) return false;
    loadDataFoodDrinkReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        type_sort = $('#select-sort-food-report').val();
    $('#chart-vertical-food-food-drink-report').prepend(themeLoading($('#chart-vertical-food-food-drink-report').height(), 'chart-vertical-food-food-drink-report-loading'))
    $('#chart-vertical-food-food-drink-report-empty').prepend(themeLoading($('#chart-vertical-food-food-drink-report').height(), 'chart-vertical-food-food-drink-report-loading'))
    $('#chart-vertical-drink-food-drink-report').prepend(themeLoading($('#chart-vertical-drink-food-drink-report').height(), 'chart-vertical-drink-food-drink-report-loading'))
    axios({
        method: 'get',
        url: 'branch-dashboard.data-food-report',
        params: {brand: brand, branch: branch, type: typeFilterFoodDrinkReport, time: timeFilterFoodDrinkReport, from: fromFilterFoodDrinkReport , to:toFilterFoodDrinkReport, type_sort: type_sort}
    }).then(function (res) {
        console.log(res);
        let elementFood = document.getElementById("chart-vertical-food-food-drink-report");
        let elementFoodDetail = $('.detail-value-food-report')
        // if (res.data[0].length > 50) {
        //     $('#chart-vertical-food-food-drink-report').attr('style', 'width:' + res.data[0].length * 20 + 'px; min-width: 100%');
        // } else {
        //     $('#chart-vertical-food-food-drink-report').attr('style', false);
        // }

        drawFoodDrinkReportChart(res.data[0] === null
                ? []
                : res.data[0].map((i) => {
                    return i.timeline;
                }),
            res.data[0] === null
                ? []
                : res.data[0].map((i) => {
                    return i.revenue;
                }),
            res.data[0] === null
                ? []
                : res.data[0].map((i) => {
                    return i.total_original_amount;
                }),res.data[0] === null
                ? []
                : res.data[0].map((i) => {
                    return i.quantity;
                }), elementFood, elementFoodDetail, res.data[1]);
        $('.chart-vertical-food-food-drink-report-loading').remove();
        $('.chart-horizontal-food-food-drink-report-loading').remove();
        $('.chart-vertical-drink-food-drink-report-loading').remove();
        $('.chart-horizontal-drink-food-drink-report-loading').remove();
    }).catch(function (e) {
        console.log(e);
    });
}

function drawFoodDrinkReportChart(dataTimeLine, dataRevenue, dataTotalOriginal, quantity, element, elementDetail, dataTotal) {
    let heightChart = dataTimeLine.length > 40 ? (heightWindow <= 797 ? '55%': '60%') : (heightWindow <= 797 ? '65%': '75%');
    try{
        if(dataTimeLine.length === 0){
            $('#chart-vertical-food-food-drink-report-empty').removeClass('d-none');
            $('#chart-vertical-food-food-drink-report').addClass('d-none');
        } else {
            $('#chart-vertical-food-food-drink-report-empty').addClass('d-none');
            $('#chart-vertical-food-food-drink-report').removeClass('d-none');
        }
        let chartFoodDrinkFood = echarts.init(element, null, {
            renderer: "canvas",
            useDirtyRect: false,
        });
        let option = {
            tooltip: {
                trigger: 'axis',
                filterMode: 'filter',
                axisPointer: {
                    type: 'shadow'
                },
                textStyle: {
                    fontSize: 12,
                    fontWeight: 500,
                    fontFamily: 'Roboto',
                },
                formatter: function (value) {
                    let colorBar = value.length > 1 ? `<div class="d-flex align-items-center">${value[1].marker} ${value[1].seriesName} : ${formatNumber(value[1].value)}</div>` : '';
                    return `<strong class="d-flex align-items-center">${value[0].name}</strong>
                            <div class="d-flex align-items-center">Số lượng món : ${quantity[value[0].dataIndex]}</div>
                            <div class="d-flex align-items-center">${value[0].marker} ${value[0].seriesName} : ${formatNumber(value[0].value)}</div>
                            ${colorBar}`;
                },
            },
            // title: {
            //     text: '{a|Tổng:} {b|' + data.total_amount + '} {a|VNĐ}',
            //     left: 'center',
            //     top: 0, // Khoảng cách giữa tiêu đề và đỉnh biểu đồ
            //     textStyle: {
            //         rich: {
            //             a: {
            //                 fontSize: 16,
            //                 color: '#000',
            //                 fontWeight: '600',
            //                 fontFamily: 'Roboto'
            //             },
            //             b: {
            //                 fontSize: 16,
            //                 color: '#FA6342',
            //                 fontWeight: '600',
            //                 fontFamily: 'Roboto'
            //             }
            //         }
            //     },
            // },
            xAxis: [
                {
                    type: "category",
                    axisLabel: {
                        interval: 0,
                        rotate: 45,
                        fontSize: 12,
                        fontWeight: 500,
                        overflow: 'truncate',
                        width: 80,
                        showMinLabel: true,
                        showMaxLabel: true,
                        fontFamily: 'Roboto',
                    },
                    data: dataTimeLine,
                    axisTick: {
                        alignWithLabel: true
                    },
                    axisPointer: {
                        type: 'shadow' // sử dụng axisPointer để hiển thị tooltip trên trục x
                    },
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
                    // nameRotate: 90,
                    nameLocation: "middle",
                },
            ],
            dataZoom: [{
                type: 'slider',
                show: dataTimeLine.length > 40,
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
                    // seriesLayoutBy: "row",
                    data: dataRevenue,
                    barGap: 0,
                    barMaxWidth: 20,
                    barCategoryGap: "10%",
                    emphasis: {
                        focus: 'series'
                    },
                    itemStyle: {
                        color: '#2A74D9'
                    }
                },
                {
                    name: "Giá vốn",
                    type: "bar",
                    // seriesLayoutBy: "row",
                    data: dataTotalOriginal,
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
            chartFoodDrinkFood.setOption(option);
        }
        elementDetail.on('change', function (){
            if(elementDetail.is(':checked')){
                chartFoodDrinkFood.setOption({
                    series: chartFoodDrinkFood.getOption().series.map((seriesItem) => {
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
                chartFoodDrinkFood.setOption({
                    series: chartFoodDrinkFood.getOption().series.map((seriesItem) => {
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
        chartFoodDrinkFood.resize();
        $(window).on('resize', function (){
            chartFoodDrinkFood.resize();
        });
    } catch (e) {
        console.log(e);
        $('#chart-vertical-category-report-empty').removeClass('d-none');
        $('#chart-vertical-category-report').addClass('d-none');
    }
}

function reloadFoodDrinkReport() {
    loadDataFoodDrinkReport = 0;
    dataFoodDrinkReport();
}
