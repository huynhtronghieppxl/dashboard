let chartGift = chartColumnEchart('chart-vertical-gift-food-report');
let typeFilterGiftFoodReport, timeFilterGiftFoodReport , fromFilterGiftFoodReport, toFilterGiftFoodReport;
typeFilterGiftFoodReport = $('#select-type-gift-food-report .select-option-filter-report').find('option:selected').val();
timeFilterGiftFoodReport = $('#select-type-gift-food-report .select-option-filter-report').find('option:selected').data('time');
/**
 * Event
 */
$('#select-type-gift-food-report .select-option-filter-report').on('change', function () {
    loadDataGiftFoodReport = 0;
    typeFilterGiftFoodReport = $(this).val();
    timeFilterGiftFoodReport = $(this).find('option:selected').data('time');
    switch (Number($(this).val())){
        case 13:
            fromFilterGiftFoodReport = $(this).parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterGiftFoodReport = $(this).parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            fromFilterGiftFoodReport = $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterGiftFoodReport = $(this).parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            fromFilterGiftFoodReport = $(this).parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterGiftFoodReport = $(this).parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            fromFilterGiftFoodReport = "";
            toFilterGiftFoodReport = "" ;
    }
    dataGiftFoodReport();
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-gift-food-report'), $('#select-type-gift-food-report'));
});
getTimeChangeSelectTypeDashboardReport($('#text-label-type-gift-food-report'), $('#select-type-gift-food-report'));

$('#select-type-gift-food-report .search-date-option-filter-time-bar').on('click', function () {
    detectDateOptionTimeGiftFood(Number($('#select-type-gift-food-report select').find('option:selected').val()))
    // if(!CheckDateFormTo(fromFilterGiftFoodReport, toFilterGiftFoodReport)) return false
    if(!checkDashboardCustomDateTimePicker($(this), $('#select-type-gift-food-report select'))) return false;
    reloadGiftFoodReport()
})

$('#select-sort-gift-food-report').on('change', function () {
    loadDataGiftFoodReport = 0;
    dataGiftFoodReport()
})


function detectDateOptionTimeGiftFood(type) {
    switch (type){
        case 13:
            fromFilterGiftFoodReport = $('#select-type-gift-food-report select').parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterGiftFoodReport = $('#select-type-gift-food-report select').parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            fromFilterGiftFoodReport = $('#select-type-gift-food-report select').parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterGiftFoodReport = $('#select-type-gift-food-report select').parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            fromFilterGiftFoodReport = $('#select-type-gift-food-report select').parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterGiftFoodReport = $('#select-type-gift-food-report select').parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            fromFilterGiftFoodReport = "";
            toFilterGiftFoodReport = "" ;
    }
}
/**
 * Call data
 * @returns {Promise<void>}
 */
function dataGiftFoodReport() {
    $('.chart-vertical-gift-food-report-loading').remove();
    $('.loading-food-gift-report-loading').remove();
    if (loadDataGiftFoodReport === 1) return false;
    loadDataGiftFoodReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        type = $('#select-type-gift-food-report').val(),
        time = $('#select-type-gift-food-report').find(':selected').data('time'),
        selectSort = $('#select-sort-gift-food-report').val();
    $('#chart-vertical-gift-food-report').prepend(themeLoading($('#chart-vertical-gift-food-report').height(), 'loading-food-gift-report-loading'))
    $('#chart-vertical-gift-food-report-empty').prepend(themeLoading($('#chart-vertical-gift-food-report').height(), 'loading-food-gift-report-loading'))
    $('#table-gift-food-report').prepend(themeLoading($('#chart-vertical-gift-food-report').height(), 'loading-food-gift-report-loading'))
    axios({
        method: 'get',
        url: 'branch-dashboard.data-gift-food-report',
        params: {brand: brand, branch: branch, type: typeFilterGiftFoodReport, time: timeFilterGiftFoodReport, from: fromFilterGiftFoodReport, to: toFilterGiftFoodReport, selectSort: selectSort}
    }).then(function (res) {
        console.log(res);
        if (res.data[0].length > 50) {
            $('#chart-vertical-gift-food-report').attr('style', 'width:' + res.data[0].length * 20 + 'px; min-width: 100%');
            $('#chart-horizontal-gift-food-report').attr('style', 'height:' + res.data[0].length * 15 + 'px; min-height: 400px');
        } else {
            $('#chart-vertical-gift-food-report').attr('style', false);
            $('#chart-horizontal-gift-food-report').attr('style', false);
        }

        updateChartGiftColumnEchart(chartGift, res.data[0] === null
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
        $('#detail-value-gift-food-report').on('change', function (){
            if($('#detail-value-gift-food-report').is(':checked')){
                chartGift.setOption({
                    series: chartGift.getOption().series.map((seriesItem) => {
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
                chartGift.setOption({
                    series: chartGift.getOption().series.map((seriesItem) => {
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
        tableGiftFoodReport(res.data[1].original.data);
        $('.total-gift-food-report').text(res.data[2].total);
        $('#total-price-gift-food-report').text(res.data[2].total_price_foods);
        $('#total-quantity-gift-food-report').text(res.data[2].quantity);
        $('.chart-vertical-gift-food-report-loading').remove();
        $('.chart-horizontal-gift-food-report-loading').remove();
        $('.loading-food-gift-report-loading').remove();
    }).catch(function (e) {
        console.log(e);
    });
}

function updateChartGiftColumnEchart(chart , dataTimeline, dataTotalAmount, dataOriginalAmount, quantity, dataTotal){
    let heightChart =dataTimeline.length > 40 ? (heightWindow <= 797 ? '65%': '70%') : (heightWindow <= 797 ? '70%': '75%');
    if(dataTimeline.length === 0){
        $('#chart-vertical-gift-food-report-empty').removeClass('d-none');
        $('#chart-vertical-gift-food-report').addClass('d-none');
    } else {
        $('#chart-vertical-gift-food-report-empty').addClass('d-none');
        $('#chart-vertical-gift-food-report').removeClass('d-none');
    }
    let option = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            },
            textStyle: {
                fontFamily: 'Roboto',
                fontSize: 12
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
                data: dataTimeline,
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
                axisTick: {
                    show: true,
                    alignWithLabel: true
                },
            },
        ],
        grid : {
            y: 50,
            y2: 120,
            width: "90%",
            left: "7%",
            top: 80,
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
            show:dataTimeline.length > 40,
            height: 20,
            startValue: 0,
            endValue: 39,
            // start: 0,
            // end:dataTimeline.length > 20 ? 19 : 100,
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

    chart.setOption(option);
    window.onresize = function() {
        chart.resize();
    };
}

function tableGiftFoodReport(data) {
    let scroll_Y = '40vh';
    let fixed_left = 0;
    let fixed_right = 0;
    let id = $('#table-gift-food-report');
    let column = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
        {data: 'food_name', name: 'food_name', className: 'text-center'},
        {data: 'quantity', name: 'quantity', className: 'text-center'},
        {data: 'amount', name: 'amount', className: 'text-center'},
        {data: 'action', name: 'action', className: 'text-center'},
    ];
    DatatableTemplateNew(id, data, column, scroll_Y, fixed_left, fixed_right, '');
}

/**
 * Reload Data
 */
function reloadGiftFoodReport() {
    loadDataGiftFoodReport = 0;
    dataGiftFoodReport();
}
