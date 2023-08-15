let dataTableCategory = null, typeTimeSellCategoryReport = 1, timeSellCategoryReport = $("#calendar-day").val(),
    checkSpamSellCategoryReport = 0, dateSellCategoryReport = $('#calendar-day').val(),
    monthSellCategoryReport = $('#calendar-month'), yearSellCategoryReport = $('#calendar-year'),
    myChartCategoryReport = chartColumnEchart('chart-category-sell-report-vertical-main'),  currentTypeCategoryReport = 'tiled', fromDateCategoryReport, toDateCategoryReport, checkLoadDataSortSellCategoryFood = 0;
let dataExcelCategoryReport,
    dataCategoryFoodReport, selectSort = $('#select-sort-sell-category-food-report option:selected').val();
$(async function () {
    dateTimePickerTemplate($('#calendar-day'));
    dateTimePickerMonthYearTemplate($('#calendar-month'));
    dateTimePickerYearTemplate($('#calendar-year'));
    templateReportTypeOption();

    if(!($('.select-branch').val())) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }
    $('#select-category-name-food-sell-report').on('select2:select', function () {
        dataCategoryFoodReport = $(this).val();
        loadDataCategoryFoodReport();
    });
    $(document).on("dp.change", "#calendar-day, #calendar-month, #calendar-year ",function () {
            timeSellCategoryReport = $(this).val();
    });
    $('#detail-value-category-report').on('change', function () {
        isVisibleDetailValueCateReport($('#detail-value-category-report'), myChartCategoryReport);
    })

    $('#select-sort-sell-category-food-report').on('change', function () {
        selectSort = $('#select-sort-sell-category-food-report option:selected').val()
        loadData()
    })

    $(document).on("change", "#select-time-report", async function () {
        let timeVal = $(this).val();
        switch (timeVal) {
            case "day":
                $(".add-display").addClass("d-none");
                $("#day").removeClass("d-none");
                typeTimeSellCategoryReport = 1;
                timeSellCategoryReport = $("#calendar-day").val();
                fromDateCategoryReport = '';
                toDateCategoryReport = '';
                break;
            case "week":
                $(".add-display").addClass("d-none");
                $("#week").removeClass("d-none");
                typeTimeSellCategoryReport = 2;
                timeSellCategoryReport = moment().format('WW/YYYY');
                fromDateCategoryReport = '';
                toDateCategoryReport = '';
                break;
            case "month":
                $(".add-display").addClass("d-none");
                $("#month").removeClass("d-none");
                dataCategoryFoodReport = -1;
                typeTimeSellCategoryReport = 3;
                timeSellCategoryReport = $("#calendar-month").val();
                fromDateCategoryReport = '';
                toDateCategoryReport = '';
                break;
            case "3month":
                $(".add-display").addClass("d-none");
                typeTimeSellCategoryReport = 4;
                timeSellCategoryReport = moment().format('MM/YYYY');
                fromDateCategoryReport = '';
                toDateCategoryReport = '';
                break;
            case "year":
                $(".add-display").addClass("d-none");
                $("#year.form-year-time-filter").removeClass("d-none");
                typeTimeSellCategoryReport = 5;
                timeSellCategoryReport = $('#calendar-year').val();
                fromDateCategoryReport = '';
                toDateCategoryReport = '';
                break;
            case "3year":
                $(".add-display").addClass("d-none");
                typeTimeSellCategoryReport = 6;
                timeSellCategoryReport = moment().format('YYYY');
                fromDateCategoryReport = '';
                toDateCategoryReport = '';
                break;
            case "13":
                $(".add-display").addClass("d-none");
                $('#btn-custom-time-filter').removeClass('d-none');
                $('#btn-custom-time-filter .custom-date').removeClass('d-none');
                fromDateCategoryReport = '';
                toDateCategoryReport = '';
                detectDateOptionTimeCategory(13);
                break;
            case "15":
                $(".add-display").addClass("d-none");
                $('#btn-custom-time-filter').removeClass('d-none');
                $('#btn-custom-time-filter .custom-month').removeClass('d-none');
                fromDateCategoryReport = '';
                toDateCategoryReport = '';
                detectDateOptionTimeCategory(15);
                break;
            case "16":
                $(".add-display").addClass("d-none");
                $('#btn-custom-time-filter').removeClass('d-none');
                $('#btn-custom-time-filter .custom-year').removeClass('d-none');
                fromDateCategoryReport = '';
                toDateCategoryReport = '';
                detectDateOptionTimeCategory(16);
                break;
            case "all_year":
                $(".add-display").addClass("d-none");
                typeTimeSellCategoryReport = 8;
                fromDateCategoryReport = '';
                toDateCategoryReport = '';
                timeSellCategoryReport = moment().format('YYYY');
                break;
        }
        await loadDataCategoryFoodReport();
        isVisibleDetailValueCateReport($('#detail-value-category-report'), myChartCategoryReport);
    });
    $('#month .custom-button-search').on('click', function () {
        typeTimeSellCategoryReport = 3;
        timeSellCategoryReport = $('#calendar-month').val();
        fromDateCategoryReport = '';
        toDateCategoryReport = '';
        loadDataCategoryFoodReport();
    })
    $('#year .custom-button-search').on('click', function () {
        typeTimeSellCategoryReport = 5;
        timeSellCategoryReport = $('#calendar-year').val();
        fromDateCategoryReport = '';
        toDateCategoryReport = '';
        loadDataCategoryFoodReport();
    })
    $('#day .custom-button-search').on('click', function () {
        typeTimeSellCategoryReport = 1;
        timeSellCategoryReport = $('#calendar-day').val();
        fromDateCategoryReport = '';
        toDateCategoryReport = '';
        loadDataCategoryFoodReport();
    })
    $('.search-date-option-filter-time-bar').on('click', async function (){
        dataCategoryFoodReport = -1;
        await detectDateOptionTimeCategory(Number($("#select-time-report").val()));
        loadDataCategoryFoodReport()
    })
    if (getCookieShared('sell-category-report-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('sell-category-report-user-id-' + idSession));
        typeTimeSellCategoryReport = dataCookie.type;
        dataCategoryFoodReport = dataCookie.select;
    }
    $('#btn-type-time-sell-category-report button').on('click', function () {
        typeTimeSellCategoryReport = $(this).attr('data-type');
        dataCategoryFoodReport = -1;
        updateCookieSellCategoryReport();
    });
    $('#btn-type-time-sell-category-report button[data-type=' + typeTimeSellCategoryReport + ']').click()
    $('#tab-category-data-1').click();
    getToMaxDateTimePickerReport();
})

function updateCookieSellCategoryReport() {
    saveCookieShared('sell-category-report-user-id-' + idSession, JSON.stringify({
        type: typeTimeSellCategoryReport,
        select: dataCategoryFoodReport,
    }))
}

async function loadData(){
    await getCategoryNameDataReport();
    await loadDataCategoryFoodReport();
}

async function getCategoryNameDataReport() {
    if (checkLoadDataSortSellCategoryFood === 1) {
        return;
    }
    let method = 'get',
        url = 'category-report.category-food-report',
        brand = $('.select-brand').val(),
        params = {brand: brand},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    await $('#select-category-name-food-sell-report').html(res.data[0]);
    checkLoadDataSortSellCategoryFood = 1;
    // await loadDataCategoryFoodReport();
}

async function loadDataCategoryFoodReport() {
    if (checkSpamSellCategoryReport === 1) return false;
    checkSpamSellCategoryReport = 1;
    let brand = $('.select-brand').val(),
        branch = $(".select-branch").val(),
        method = 'get',
        params = {
            brand: brand,
            branch: branch,
            type: typeTimeSellCategoryReport,
            time: timeSellCategoryReport,
            from_date: fromDateCategoryReport,
            to_date: toDateCategoryReport,
            category: dataCategoryFoodReport,
            category_type:  $('#select-category-name-food-sell-report option:selected').data('category-type'),
            selectSort: selectSort
        },
        data = null,
        url = 'category-report.data',
        res = await axiosTemplate(method, url, params, data, [
            $("#table-sell-card1-report"),
            $("#chart-category-sell-report-vertical-center"),
            $("#chart-category-sell-report-vertical"),
            $("#chart-sell-report-line"),
        ]);
    checkSpamSellCategoryReport = 0;
    // let arr = []
    // $.each(res.data[2], function(key, value) {
    //     arr.push(value)
    // });
    if (res.data[0].length === 0 ) {
        $('#chart-category-sell-report-vertical-empty').removeClass('d-none')
        $('#chart-category-sell-report-vertical-main').addClass('d-none')
        $('#detail-value-category-report-box').addClass('d-none')
    } else {
        $('#chart-category-sell-report-vertical-empty').addClass('d-none')
        $('#chart-category-sell-report-vertical-main').removeClass('d-none')
        $('#detail-value-category-report-box').removeClass('d-none')
    }
    dataCategoryTable(res.data[1].original.data);
    dataCategoryTotal(res.data[2]);
    dataExcelCategoryReport = res.data[3].data.list;
    switch (parseInt(selectSort)) {
        case 3:
            myChartCategoryReport.clear();
            eChartProfit(myChartCategoryReport, res.data[6]);
            break;
        default:
            myChartCategoryReport.clear();
            eChartCategoryFood(myChartCategoryReport,
                res.data[0] === null ? [] : res.data[0].map(i => {
                    return i.timeline;
                }),
                res.data[0] === null ? [] : res.data[0].map(i => {
                    return i.valueTotal;
                }),
                res.data[0] === null ? [] : res.data[0].map(i => {
                    return i.valueOriginalTotal;
                }),
                res.data[0] === null ? [] : res.data[0].map(i => {
                    return i.valueProfit;
                }), res.data[5] )
    }
}

async function eChartCategoryFood(myChart, dataTimeline, dataValueTotal, dataValueOriginalTotal, dataValueProfit, dataTotal) {
    let heightChart = dataTimeline.length > 40 ? ($(window).innerHeight() <= 797 ? '70%' : '75%') : ($(window).innerHeight() <= 797 ? '80%' : '85%');

    $(window).on('resize', function () {
        myChart.resize();
    });
    let option = {
        grid: {
            y: 50,
            y2: 100,
            left: 100,
            right: 10,
            height: heightChart
        },
        dataZoom: [{
            type: 'slider',
            show: dataTimeline.length > 20,
            startValue: 0,
            endValue: 19,
            // start: 0,
            // end: dataTimeline.length > 20 ? 30 : 100,
            xAxisIndex: 0,
            realtime: true,
            zoomLock: true,
            showDetail: false,
            brushSelect: false
        }],
        xAxis: {
            type: 'category',
            data: dataTimeline,
            axisTick: {
                alignWithLabel: true,
            },
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
        },
        yAxis: {
            type: 'value',
            scale: true,
            axisLabel: {
                inside: false,
                formatter: function (value, index) {
                    if (value > 999999999) {
                        return value % 1000000000 === 0 ? formatNumber(value / 1000000000) + ' tỷ' : formatNumber((value / 1000000000).toFixed(1)) + ' tỷ'
                    }
                    if (value > 999999) {
                        return value % 1000000 === 0 ? formatNumber(value / 1000000) + ' triệu' : formatNumber((value / 1000000).toFixed(1)) + ' triệu'
                    }
                    if (value > 999) {
                        return value % 1000 === 0 ? formatNumber(value / 1000) + ' ngàn' : formatNumber((value / 1000).toFixed(1)) + ' ngàn'
                    }
                    if (value < -999999999) {
                        return value % 1000000000 === 0 ? formatNumber(value / 1000000000) + ' tỷ' : formatNumber((value / 1000000000).toFixed(1)) + ' tỷ'
                    }
                    if (value < -999999) {
                        return value % 1000000 === 0 ? formatNumber(value / 1000000) + ' triệu' : formatNumber((value / 1000000).toFixed(1)) + ' triệu'
                    }
                    if (value < -999) {
                        return value % 1000 === 0 ? formatNumber(value / 1000) + ' ngàn' : formatNumber((value / 1000).toFixed(1)) + ' ngàn'
                    }
                },
                margin: 0
            },
            name: 'Số tiền (VNĐ)',
            nameGap: 80,
            nameTextStyle: {
                fontSize: 14,
                fontWeight: 600,
                fontFamily: "Roboto"
            },
            nameRotate: 90,
            nameLocation: 'middle',
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
                name: 'Doanh thu',
                type: 'bar',
                barGap: 0,
                barMaxWidth: 30,
                data: dataValueTotal,
                emphasis: {
                    focus: 'series'
                },
                itemStyle: {
                    color: '#2A74D9'
                }
            },
            {
                name: 'Giá vốn',
                type: 'bar',
                barMaxWidth: 30,
                data: dataValueOriginalTotal,
                emphasis: {
                    focus: 'series'
                },
                itemStyle: {
                    color: '#FFA400'
                }
            },
            {
                name: 'Lợi nhuận',
                type: 'bar',
                barMaxWidth: 30,
                data: dataValueProfit,
                emphasis: {
                    focus: 'series'
                },
                itemStyle: {
                    color: '#009328'
                }
            },
        ],
        tooltip: {
            trigger: 'axis',
            position: 'top'
        },
    };
    myChart.setOption(option);
}

function isVisibleDetailValueCateReport(checkBoxElm, chartReport) {
    const isChecked = checkBoxElm.is(':checked');
    const labelOption = isChecked ? {
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
    } : {
        show: false
    };
    const series = chartReport.getOption().series;
    for (let i = 0; i < series.length; i++){
        series[i].label = labelOption;
    }
    chartReport.setOption({
        series: series
    });
}

async function dataCategoryTable(data) {
    let id = $('#table-sell-card1-report'),
        fixedLeft = 2,
        fixedRight = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'category_name', name: 'category_name', className: 'text-left'},
            {data: 'total_original_amount', name: 'total_original_amount', className: 'text-right'},
            {data: 'total_amount', name: 'total_amount', className: 'text-right'},
            {data: 'total_profit', name: 'total_profit', className: 'text-right'},
            {data: 'profit_ratio', name: 'profit_ratio', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none', width: '5%'},
        ],
        option = [
            {
                'title': 'Xuất excel',
                'icon': 'fi-rr-print',
                'class': 'seemt-btn-hover-blue',
                'function': 'exportExcelCategoryReport',
            }
        ]
    dataTableCategory = await DatatableTemplateNew(id, data, column, vh_of_table_report, fixedLeft, fixedRight, option);
    $(document).on('input paste', '#table-sell-card1-report_filter', async function () {
        let totalOriginPrice = 0,
            totalAmount = 0,
            totalProfit = 0;
        await dataTableCategory.rows({'search': 'applied'}).every(function () {
            let row = $(this.node());
            totalOriginPrice += removeformatNumber(row.find('td:eq(2)').text());
            totalAmount += removeformatNumber(row.find('td:eq(3)').text());
            totalProfit += removeformatNumber(row.find('td:eq(4)').text());
        })
        $('#total-original-card1').text(formatNumber(totalOriginPrice));
        $('#total-money-card1').text(formatNumber(totalAmount));
        $('#total-profit-card1').text(formatNumber(totalProfit));
    })
}

function dataCategoryTotal(data) {
    $('#total').text(data.total);
    $('#total-quantity-card1').text(data.sum_quantity);
    totalOriginalAmountCategoryReport = data.sum_total_original;
    $('#total-original-card1').text(totalOriginalAmountCategoryReport);
    totalAmountCategoryReport = data.total;
    $('#total-money-card1').text(totalAmountCategoryReport);
    totalProfitCategoryReport = data.sum_profit;
    $('#total-profit-card1').text(totalProfitCategoryReport);
}

function detectDateOptionTimeCategory(type) {
    switch (type) {
        case 15:
            typeTimeSellCategoryReport = 15
            timeSellCategoryReport = ''
            fromDateCategoryReport = $('.from-month-filter-time-bar').val()
            toDateCategoryReport = $('.to-month-filter-time-bar').val()
            break;
        case 16:
            typeTimeSellCategoryReport = 16
            timeSellCategoryReport = ''
            fromDateCategoryReport = $('.from-year-filter-time-bar').val()
            toDateCategoryReport = $('.to-year-filter-time-bar').val()
            break;
        default:
            typeTimeSellCategoryReport = 13
            timeSellCategoryReport = ''
            fromDateCategoryReport = $('.from-date-filter-time-bar').val()
            toDateCategoryReport = $('.to-date-filter-time-bar').val()
    }
}
