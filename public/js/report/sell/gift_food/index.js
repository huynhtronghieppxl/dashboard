let typeTimeSellGiftFoodReport = 1, timeSellGiftFoodReport = $('#calendar-day').val(), checkSpamGiftFoodReport = 0;
let dataTableGifts, fromDateGiftFoodReport, toDateCateGiftFoodReport, tabActiveGiftFoodReport,
    typeActionGiftFoodReport = 1, dataExportGiftFood , chartGift;
chartGift = chartColumnEchart('chart-vertical-gift-food-report');
$(async function (){
    $(document).on("dp.change", "#calendar-day, #calendar-month, #calendar-year", function () {
        timeSellGiftFoodReport = $(this).val();
    });

    $('#detail-value-gift-food-report').on('change', function () {
        isVisibleDetailValueReport($('#detail-value-gift-food-report'), chartGift);
    })

    $(document).on("change", "#select-time-report", async function () {
        let timeVal = $(this).val();
        switch (timeVal) {
            case "day":
                typeTimeSellGiftFoodReport = 1;
                timeSellGiftFoodReport = $('#calendar-day').val();
                fromDateGiftFoodReport = '';
                toDateCateGiftFoodReport = '';
                break;
            case "week":
                typeTimeSellGiftFoodReport = 2;
                timeSellGiftFoodReport = moment().format('WW/YYYY');
                fromDateGiftFoodReport = '';
                toDateCateGiftFoodReport = '';
                break;
            case "month":
                typeTimeSellGiftFoodReport = 3;
                timeSellGiftFoodReport = $('#calendar-month').val();
                fromDateGiftFoodReport = '';
                toDateCateGiftFoodReport = '';
                break;
            case "3month":
                typeTimeSellGiftFoodReport = 4;
                timeSellGiftFoodReport = moment().format('MM/YYYY');
                fromDateGiftFoodReport = '';
                toDateCateGiftFoodReport = '';
                break;
            case "year":
                typeTimeSellGiftFoodReport = 5;
                timeSellGiftFoodReport = $('#calendar-year').val();
                fromDateGiftFoodReport = '';
                toDateCateGiftFoodReport = '';
                break;
            case "3year":
                typeTimeSellGiftFoodReport = 6;
                timeSellGiftFoodReport = moment().format('YYYY');
                fromDateGiftFoodReport = '';
                toDateCateGiftFoodReport = '';
                break;
            case "13":
                fromDateGiftFoodReport = '';
                toDateCateGiftFoodReport = '';
                detectDateOptionTimeGiftFood(13);
                break;
            case "15":
                fromDateGiftFoodReport = '';
                toDateCateGiftFoodReport = '';
                detectDateOptionTimeGiftFood(15);
                break;
            case "16":
                fromDateGiftFoodReport = '';
                toDateCateGiftFoodReport = '';
                detectDateOptionTimeGiftFood(16);
                break;
            case "all_year":
                typeTimeSellGiftFoodReport = 8;
                timeSellGiftFoodReport = moment().format('YYYY');
                fromDateGiftFoodReport = '';
                toDateCateGiftFoodReport = '';
                break;
        }
        await loadData();
        updateCookieSellGiftFoodReport();
        isVisibleDetailValueReport($('#detail-value-gift-food-report'), chartGift);
    });
    $('#month .custom-button-search').on('click', function () {
        typeTimeSellGiftFoodReport = 3;
        timeSellGiftFoodReport = $('#calendar-month').val();
        fromDateGiftFoodReport = '';
        toDateCateGiftFoodReport = '';
        loadData();
        updateCookieSellGiftFoodReport();
    })
    $('#year .custom-button-search').on('click', function () {
        typeTimeSellGiftFoodReport = 5;
        timeSellGiftFoodReport = $('#calendar-year').val();
        fromDateGiftFoodReport = '';
        toDateCateGiftFoodReport = '';
        loadData();
        updateCookieSellGiftFoodReport();
    })
    $('#day .custom-button-search').on('click', function () {
        typeTimeSellGiftFoodReport = 1;
        timeSellGiftFoodReport = $('#calendar-day').val();
        fromDateGiftFoodReport = '';
        toDateCateGiftFoodReport = '';
        loadData();
        updateCookieSellGiftFoodReport();
    })
    $(".search-date-option-filter-time-bar").on("click", async function () {
        await detectDateOptionTimeGiftFood( Number($("#select-time-report").val()));
        loadData();
    });

    /* Set cookie */
    if (getCookieShared('sell-gift-food-report-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('sell-gift-food-report-user-id-' + idSession));
        tabActiveGiftFoodReport = dataCookie.tabActiveGiftFoodReport;
    }
    $('#btn-type-time-sell-gift-food-report button').on('click', function () {
        tabActiveGiftFoodReport = $(this).attr('id')
        updateCookieSellGiftFoodReport();
    });
    $('#btn-type-time-sell-gift-food-report button[id="'+ tabActiveGiftFoodReport +'"]').click();
    $('#select-sort-gift-food-sell-report').on('change', function () {
        loadDataGiftFoodReport = 0;
        loadData();
    })
    if(!($('.select-branch').val())) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }
    /* end cookie */
})

async function loadData(){
    if(checkSpamGiftFoodReport === 1) return false;
    checkSpamGiftFoodReport = 1;
    updateCookieSellGiftFoodReport()
    let brand = $('.select-brand').val(),
        branch = $(".select-branch").val(),
        sortSelect = $('#select-sort-gift-food-sell-report').val(),
        method = 'get',
        params = {
            brand: brand,
            branch: branch,
            type: typeTimeSellGiftFoodReport,
            time: timeSellGiftFoodReport,
            from_date: fromDateGiftFoodReport,
            to_date: toDateCateGiftFoodReport,
            sortSelect : sortSelect
        },
        data = null, url = null, res = null;
    url = 'gift-food-report.data';
    res = await axiosTemplate(method, url, params, data, [$("#table-sell-card4-report"), $('#chart-vertical-gift-food-report')]);
    if (res.data[2].length === 0) {
        $('#chart-vertical-gift-food-report-empty').removeClass('d-none');
        $('#chart-vertical-gift-food-report').addClass('d-none');
        $('#detail-value-gift-food-report-box').addClass('d-none');
    } else {
        $('#chart-vertical-gift-food-report-empty').addClass('d-none');
        $('#chart-vertical-gift-food-report').removeClass('d-none');
        $('#detail-value-gift-food-report-box').removeClass('d-none');
    }

    checkSpamGiftFoodReport = 0;
    dataGiftsTable(res.data[0].original.data);
    dataGiftsTotal(res.data[1]);
    dataExportGiftFood = res.data[0].original.data;
    updateChartGiftFoodColumnEchart(chartGift,res.data[2] === null
            ? []
            : res.data[2].map((i) => {
                return i.timeline;
            }),
        res.data[2] === null
            ? []
            : res.data[2].map((i) => {
                return i.total_amount;
            }),
        res.data[2] === null
            ? []
            : res.data[2].map((i) => {
                return i.original_amount;
            }),res.data[2] === null
            ? []
            : res.data[2].map((i) => {
                return i.quantity;
            }),
        res.data[3]);
}

function updateChartGiftFoodColumnEchart(chart , dataTimeline, dataTotalAmount, dataOriginalAmount, quantity, dataTotal){
    let heightChart = dataTimeline.length > 40 ? ($(window).innerHeight() <= 797 ? '80%': '85%') : ($(window).innerHeight() <= 797 ? '85%': '90%');
    if (dataTimeline.length === 0) {
        $('#chart-sell-report-vertical-empty').removeClass('d-none')
        $('#chart-sell-surcharge-report-vertical-main').addClass('d-none')
        $('#detail-value-surcharge-report-box').addClass('d-none')
    } else {
        $('#chart-sell-report-vertical-empty').addClass('d-none')
        $('#chart-sell-surcharge-report-vertical-main').removeClass('d-none')
        $('#detail-value-surcharge-report-box').removeClass('d-none')
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
                formatter: function (value, index) {
                    let colorBar = value.length > 1 ? `<div class="d-flex align-items-center">${value[1].marker} ${value[1].seriesName} : ${formatNumber(value[1].value)}</div>` : '';
                    return `<strong class="d-flex align-items-center">${value[0].name}</strong>
                            <div class="d-flex align-items-center">Số lượng món : ${quantity[value[0].dataIndex]}</div>
                            <div class="d-flex align-items-center">${value[0].marker} ${value[0].seriesName} : ${formatNumber(value[0].value)}</div>
                            ${colorBar}`;
                }
            },
            grid: {
                left: '3%',
                right: '4%',
                top: 80,
                height: heightChart,
                containLabel: true
            },
            dataZoom: [{
                type: 'slider',
                show: dataTimeline.length > 40,
                startValue: 0,
                endValue: 39,
                // start: 0,
                // end: data.length > 30 ? 20 : 100,
                xAxisIndex: 0,
                realtime: true,
                zoomLock: true,
                showDetail: false,
                brushSelect: false
            }],
            xAxis: {
                type: 'category',
                data: dataTimeline,
                axisLabel: {
                    interval: 0,
                    rotate: 45,
                    width: 120,
                    fontFamily: 'Roboto'
                },
            },
            yAxis: {
                show: dataTimeline.length !== 0,
                type: 'value',
                name: "SỐ TIỀN (VNĐ)",
                nameGap: 80,
                nameTextStyle: {
                    fontSize: 14,
                    fontWeight: 600,
                    fontFamily: 'Roboto'
                },
                nameRotate: 90,
                nameLocation: 'middle',
                axisLabel: {
                    formatter: function (value) {
                        return nFormatter(value);
                    }
                }
            },
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
        window.onresize = function () {
            chart.resize();
        };
    }
}

function updateCookieSellGiftFoodReport() {
    saveCookieShared('sell-gift-food-report-user-id-' + idSession, JSON.stringify({
        tabActiveGiftFoodReport: tabActiveGiftFoodReport,
    }))
}

async function dataGiftsTable(data) {
    let fixedLeft = 2;
    let fixedRight = 0;
    let id = $('#table-sell-card4-report');
    let column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name'},
            {data: 'food_name', name: 'food', className: 'text-left'},
            {data: 'quantity', name: 'quantity', className: 'text-right'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'total_amount', name: 'total_amount', className: 'text-right'},
            {data: 'day', name: 'day', className: 'text-center'},
            {data: 'table_name', name: 'table_name', className: 'text-left'},
            {data: 'customer_slot_number', name: 'customer_slot_number', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none', width:'5%'},
        ],
        option = [
            {
                'title': 'Xuất excel',
                'icon': 'fi-rr-print',
                'class': 'seemt-btn-hover-blue',
                'function': 'exportExcelGiftFoodReport',
            }
        ]
    dataTableGifts = await DatatableTemplateNew(id, data, column, vh_of_table_report, fixedLeft, fixedRight, option);
    $(document).on('input paste keyup keydown', '#table-sell-card4-report_filter', async function () {
        let totalQuantity = 0,
            totalAmount = 0;
        await dataTableGifts.rows({'search': 'applied'}).every(function () {
            let row = $(this.node());
            totalQuantity += removeformatNumber(row.find('td:eq(3)').text());
            totalAmount += removeformatNumber(row.find('td:eq(5)').text());
        })
        $('#total-quantity').text(formatNumber(totalQuantity));
        $('#total-total').text(formatNumber(totalAmount));
    })
}
function dataGiftsTotal(data) {
    $('#total').text(data.total);
    $('#total-quantity').text(data.quantity);
    $('#total-total').text(data.total);
    $('#total-food-food-drink-report').text(data.total);
}

function detectDateOptionTimeGiftFood (type) {
    switch (type) {
        case 15:
            typeTimeSellGiftFoodReport = 15;
            timeSellGiftFoodReport = "";
            fromDateGiftFoodReport = $(".from-month-filter-time-bar").val();
            toDateCateGiftFoodReport = $(".to-month-filter-time-bar").val();
            break;
        case 16:
            typeTimeSellGiftFoodReport = 16;
            timeSellGiftFoodReport = "";
            fromDateGiftFoodReport = $(".from-year-filter-time-bar").val();
            toDateCateGiftFoodReport = $(".to-year-filter-time-bar").val();
            break;
        default:
            typeTimeSellGiftFoodReport = 13;
            timeSellGiftFoodReport = "";
            fromDateGiftFoodReport = $(".from-date-filter-time-bar").val();
            toDateCateGiftFoodReport = $(".to-date-filter-time-bar").val();
    }
}
