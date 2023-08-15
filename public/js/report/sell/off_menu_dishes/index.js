let typeTimeSellOffMenuReport = 1, timeSellOffMenuReport = $('#calendar-day').val(), checkSpamOffMenuReport = 0;
let dataTableOffMenu, fromDateOffMenuReport, toDateCateOffMenuReport, tabActiveGiftFoodReport,
    typeActionGiftFoodReport = 1, dataExportOffMenuDishes , myOffMenuChart;
myOffMenuChart = chartColumnEchart('chart-vertical-off-menu-report');
$(async function (){
    $(document).on("dp.change", "#calendar-day, #calendar-month, #calendar-year", function () {
        timeSellOffMenuReport = $(this).val();
    });

    $('#detail-value-off-menu-report').on('change', function () {
        isVisibleDetailValueReport($('#detail-value-off-menu-report'), myOffMenuChart);
    })

    $('#select-sort-off-menu-sell-report').on('change', function () {
        checkSpamOffMenuReport = 0;
        loadData();
    })

    if(!$('.select-branch').val()) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }

    $(document).on("change", "#select-time-report", async function () {
        let timeVal = $(this).val();
        switch (timeVal) {
            case "day":
                typeTimeSellOffMenuReport = 1;
                timeSellOffMenuReport = $('#calendar-day').val();
                fromDateOffMenuReport = '';
                toDateCateOffMenuReport = '';
                break;
            case "week":
                typeTimeSellOffMenuReport = 2;
                timeSellOffMenuReport = moment().format('WW/YYYY');
                fromDateOffMenuReport = '';
                toDateCateOffMenuReport = '';
                break;
            case "month":
                typeTimeSellOffMenuReport = 3;
                timeSellOffMenuReport = $('#calendar-month').val();
                fromDateOffMenuReport = '';
                toDateCateOffMenuReport = '';
                break;
            case "3month":
                typeTimeSellOffMenuReport = 4;
                timeSellOffMenuReport = moment().format('MM/YYYY');
                fromDateOffMenuReport = '';
                toDateCateOffMenuReport = '';
                break;
            case "year":
                typeTimeSellOffMenuReport = 5;
                timeSellOffMenuReport = $('#calendar-year').val();
                fromDateOffMenuReport = '';
                toDateCateOffMenuReport = '';
                break;
            case "3year":
                typeTimeSellOffMenuReport = 6;
                timeSellOffMenuReport = moment().format('YYYY');
                fromDateOffMenuReport = '';
                toDateCateOffMenuReport = '';
                break;
            case "13":
                fromDateOffMenuReport = '';
                toDateCateOffMenuReport = '';
                detectDateOptionTimeOffMenu(13);
                break;
            case "15":
                fromDateOffMenuReport = '';
                toDateCateOffMenuReport = '';
                detectDateOptionTimeOffMenu(15);
                break;
            case "16":
                fromDateOffMenuReport = '';
                toDateCateOffMenuReport = '';
                detectDateOptionTimeOffMenu(16);
                break;
            case "all_year":
                typeTimeSellOffMenuReport = 8;
                timeSellOffMenuReport = moment().format('YYYY');
                fromDateOffMenuReport = '';
                toDateCateOffMenuReport = '';
                break;
        }
        await loadData();
        isVisibleDetailValueReport($('#detail-value-off-menu-report'), myOffMenuChart);
    });
    $('#month .custom-button-search').on('click', function () {
        typeTimeSellOffMenuReport = 3;
        timeSellOffMenuReport = $('#calendar-month').val();
        fromDateOffMenuReport = '';
        toDateCateOffMenuReport = '';
        loadData();
    })
    $('#year .custom-button-search').on('click', function () {
        typeTimeSellOffMenuReport = 5;
        timeSellOffMenuReport = $('#calendar-year').val();
        fromDateOffMenuReport = '';
        toDateCateOffMenuReport = '';
        loadData();
    })
    $('#day .custom-button-search').on('click', function () {
        typeTimeSellOffMenuReport = 1;
        timeSellOffMenuReport = $('#calendar-day').val();
        fromDateOffMenuReport = '';
        toDateCateOffMenuReport = '';
        loadData();
        updateCookieSellGiftFoodReport();
    })
    $(".search-date-option-filter-time-bar").on("click", async function () {
        await detectDateOptionTimeOffMenu( Number($("#select-time-report").val()));
        loadData();
    });

    // /* Set cookie */
    // if (getCookieShared('sell-gift-food-report-user-id-' + idSession)) {
    //     let dataCookie = JSON.parse(getCookieShared('sell-gift-food-report-user-id-' + idSession));
    //     tabActiveGiftFoodReport = dataCookie.tabActiveGiftFoodReport;
    // }
    // $('#btn-type-time-sell-gift-food-report button').on('click', function () {
    //     tabActiveGiftFoodReport = $(this).attr('id')
    //     updateCookieSellGiftFoodReport();
    // });
    // $('#btn-type-time-sell-gift-food-report button[id="'+ tabActiveGiftFoodReport +'"]').click()
    // loadData();
    // /* end cookie */
    // getToMaxDateTimePickerReport();
})

async function loadData(){
    if(!$('.select-branch').val()) return false;
    if(checkSpamOffMenuReport === 1) return false;
    checkSpamOffMenuReport = 1;
    // updateCookieSellGiftFoodReport()
    let brand = $('.select-brand').val(),
        inventory = $("#select-off-menu-report").val(),
        branch = $(".select-branch").val(),
        sortSelect = $('#select-sort-off-menu-sell-report').val(),
        method = 'get',
        params = {
            brand: brand,
            branch: branch,
            inventory: inventory,
            type: typeTimeSellOffMenuReport,
            time: timeSellOffMenuReport,
            from_date: fromDateOffMenuReport,
            to_date: toDateCateOffMenuReport,
            sortSelect: sortSelect
        },
        data = null, url = null, res = null;
    url = 'off-menu-dishes-report.data';
    res = await axiosTemplate(method, url, params, data, [$("#table-sell-off-menu-report"), $('#chart-vertical-off-menu-report')]);
    if (res.data[1].length === 0) {
        $('#chart-vertical-off-menu-report-empty').removeClass('d-none');
        $('#chart-vertical-off-menu-report').addClass('d-none');
        $('#detail-value-off-menu-report-box').addClass('d-none');
    } else {
        $('#chart-vertical-off-menu-report-empty').addClass('d-none');
        $('#chart-vertical-off-menu-report').removeClass('d-none');
        $('#detail-value-off-menu-report-box').removeClass('d-none');
    }
    checkSpamOffMenuReport = 0;
    dataOffMenuTable(res.data[0].original.data);
    dataOffMenuTotal(res.data[2]);
    dataExportOffMenuDishes = res.data[0].original.data;
    updateChartOffMenuEchart(myOffMenuChart, res.data[1] === null
            ? []
            : res.data[1].map((i) => {
                return i.timeline;
            }),
        res.data[1] === null
            ? []
            : res.data[1].map((i) => {
                return i.total_amount;
            }),
        res.data[1] === null
            ? []
            : res.data[1].map((i) => {
                return i.original_amount;
            }),res.data[1] === null
            ? []
            : res.data[1].map((i) => {
                return i.quantity;
            }),
        res.data[4]);
}

function updateChartOffMenuEchart(chart , dataTimeline, dataTotalAmount, dataOriginalAmount, quantity, dataTotal){
    let heightChart = dataTimeline.length > 40 ? ($(window).innerHeight() <= 797 ? '65%': '77%') : ($(window).innerHeight() <= 797 ? '75%': '80%');
    let option = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            },
            textStyle: {
                fontSize: 12,
                fontFamily: "Roboto"
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
            top: 80,
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

    chart.setOption(option);
    window.onresize = function() {
        chart.resize();
    };
}

function updateCookieSellGiftFoodReport() {
    saveCookieShared('sell-gift-food-report-user-id-' + idSession, JSON.stringify({
        tabActiveGiftFoodReport: tabActiveGiftFoodReport,
    }))
}

async function dataOffMenuTable(data) {
    let fixedLeft = 2;
    let fixedRight = 0;
    let id = $('#table-sell-off-menu-report');
    let column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', className: 'text-left'},
            {data: 'quantity', name: 'quantity', className: 'text-right'},
            {data: 'total_original_amount', name: 'total_original_amount', className: 'text-right'},
            {data: 'total_amount', name: 'total_amount', className: 'text-right'},
            {data: 'profit', name: 'profit', className: 'text-right'},
            {data: 'profit_ratio', name: 'profit_ratio', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center'},
            {data: 'keysearch', className: 'd-none', width:'5%'},
        ],
        option = [
            {
                'title': 'Xuất excel',
                'icon': 'fi-rr-print',
                'class': 'seemt-btn-hover-blue',
                'function': 'exportExcelOffMenuDishes',
            }
        ]
    dataTableOffMenu = await DatatableTemplateNew(id, data, column, vh_of_table_report, fixedLeft, fixedRight, option);
    $(document).on('input paste keyup keydown', '#table-sell-off-menu-report_filter', async function () {
        let totalQuantity = 0,
            totalOriginal = 0,
            totalAmount = 0,
            totalProfit = 0;
        await dataTableOffMenu.rows({search: 'applied'}).every(function () {
            let row = $(this.node());
            totalQuantity += removeformatNumber(row.find('td:eq(2)').text());
            totalOriginal += removeformatNumber(row.find('td:eq(3)').text());
            totalAmount += removeformatNumber(row.find('td:eq(4)').text());
            totalProfit += removeformatNumber(row.find('td:eq(5)').text());
        })
        $('#total-quantity-card6').text(formatNumber(totalQuantity));
        $('#total-original-card6').text(formatNumber(totalOriginal));
        $('#total-money-card6').text(formatNumber(totalAmount));
        $('#total-profit-card6').text(formatNumber(totalProfit));
    })
}
function dataOffMenuTotal(data) {
    $('#total-original-card6').text(data.sum_total_original);
    $('#total-quantity-card6').text(data.sum_quantity);
    $('#total-money-card6').text(data.total);
    $('#total-profit-card6').text(data.sum_profit);
    $('#total').text(data.total);
}

function detectDateOptionTimeOffMenu (type) {
    switch (type) {
        case 15:
            typeTimeSellOffMenuReport = 15;
            timeSellOffMenuReport = "";
            fromDateOffMenuReport = $(".from-month-filter-time-bar").val();
            toDateCateOffMenuReport = $(".to-month-filter-time-bar").val();
            break;
        case 16:
            typeTimeSellOffMenuReport = 16;
            timeSellOffMenuReport = "";
            fromDateOffMenuReport = $(".from-year-filter-time-bar").val();
            toDateCateOffMenuReport = $(".to-year-filter-time-bar").val();
            break;
        default:
            typeTimeSellOffMenuReport = 13;
            timeSellOffMenuReport = "";
            fromDateOffMenuReport = $(".from-date-filter-time-bar").val();
            toDateCateOffMenuReport = $(".to-date-filter-time-bar").val();
    }
}
