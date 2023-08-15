let dataTableCategory = null, typeTimeSellTakeAwayReport = 1, timeSellTakeAwayReport = $('#calendar-day').val(),
    myChartTakeAwayReport = chartColumnEchart('chart-sell-take-away-report-vertical-main'), currentTypeTakeAwayReport = 'tiled', checkSpamTakeAwayReport = 0, dataTableTakeaway;
let dataExcelTakeAwayReport, fromDateTakeAwayReport, toDateTakeAwayReport, tabActiveSellTakeAwayReport,
    selectSort = $('#select-sort-sell-take-away-report option:selected').val();
$(async function () {
    // loadData()
    $('#detail-value-take-away-report').on('change', function () {
        isVisibleDetailValueReport($('#detail-value-take-away-report'), myChartTakeAwayReport);
    })

    $('#select-sort-sell-take-away-report').on('change', function () {
        selectSort = $('#select-sort-sell-take-away-report option:selected').val()
        loadData()
    })

    $(document).on("change", "#select-time-report", async function () {
        let timeVal = $(this).val();
        switch (timeVal) {
            case "day":
                typeTimeSellTakeAwayReport = 1;
                timeSellTakeAwayReport = $('#calendar-day').val();
                fromDateTakeAwayReport = '';
                toDateTakeAwayReport = '';
                break;
            case "week":
                typeTimeSellTakeAwayReport = 2;
                timeSellTakeAwayReport = moment().format('WW/YYYY');
                fromDateTakeAwayReport = '';
                toDateTakeAwayReport = '';
                break;
            case "month":
                typeTimeSellTakeAwayReport = 3;
                timeSellTakeAwayReport = $('#calendar-month').val();
                fromDateTakeAwayReport = '';
                toDateTakeAwayReport = '';
                break;
            case "3month":
                typeTimeSellTakeAwayReport = 4;
                timeSellTakeAwayReport = moment().format('MM/YYYY');
                fromDateTakeAwayReport = '';
                toDateTakeAwayReport = '';
                break;
            case "year":
                typeTimeSellTakeAwayReport = 5;
                timeSellTakeAwayReport = $('#calendar-year').val();
                fromDateTakeAwayReport = '';
                toDateTakeAwayReport = '';
                break;
            case "3year":
                typeTimeSellTakeAwayReport = 6;
                timeSellTakeAwayReport = moment().format('YYYY');
                fromDateTakeAwayReport = '';
                toDateTakeAwayReport = '';
                break;
            case "13":
                fromDateTakeAwayReport = '';
                toDateTakeAwayReport = '';
                detectDateOptionTimeTakeAway(13);
                break;
            case "15":
                fromDateTakeAwayReport = '';
                toDateTakeAwayReport = '';
                detectDateOptionTimeTakeAway(15);
                break;
            case "16":
                fromDateTakeAwayReport = '';
                toDateTakeAwayReport = '';
                detectDateOptionTimeTakeAway(16);
                break;
            case "all_year":
                typeTimeSellTakeAwayReport = 8;
                timeSellTakeAwayReport = moment().format('YYYY');
                fromDateTakeAwayReport = '';
                toDateTakeAwayReport = '';
                break;
        }
        loadData();
        isVisibleDetailValueReport($('#detail-value-take-away-report'), myChartTakeAwayReport);
    });

    $("#day .custom-button-search").on("click", function () {
        loadData();
    });

    $("#month .custom-button-search").on("click", function () {
        loadData();
    });

    $("#year .custom-button-search").on("click", function () {
        loadData();
    });

    $(".search-date-option-filter-time-bar").on("click", async function () {
        await detectDateOptionTimeTakeAway(Number($("#select-time-report").val()));
        loadData();
    });

    if (getCookieShared('sell-take-away-report-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('sell-take-away-report-user-id-' + idSession));
        tabActiveSellTakeAwayReport = dataCookie.tabActiveSellTakeAwayReport;
        dateSellCategoryReport = dataCookie.day;
        monthSellCategoryReport = dataCookie.month;
        yearSellCategoryReport = dataCookie.year;
        $('#calendar-day').val(dateSellCategoryReport);
        $('#calendar-month').val(monthSellCategoryReport);
        $('#calendar-year').val(yearSellCategoryReport);
    }
    $('#btn-type-time-sell-report button').on('click', function () {
        tabActiveSellTakeAwayReport = $(this).attr('id')
        updateCookieSellTakeAwayReport();
    });
    $('#btn-type-time-sell-report button[id=' + tabActiveSellTakeAwayReport + ']').click()
    if(!($('.select-branch').val())) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }
})

function updateCookieSellTakeAwayReport() {
    saveCookieShared('sell-take-away-report-user-id-' + idSession, JSON.stringify({
        tabActiveSellTakeAwayReport: tabActiveSellTakeAwayReport,
        day: $('#calendar-day').val(),
        month: $('#calendar-month').val(),
        year: $('#calendar-year').val()
    }))
}

async function loadData() {
    if(checkSpamTakeAwayReport === 1) return false
    updateCookieSellTakeAwayReport()
    checkSpamTakeAwayReport = 1;
    let brand = $('.select-brand').val(),
        branch = $(".select-branch").val(),
        method = 'get',
        params = {
            brand: brand,
            branch: branch,
            type: typeTimeSellTakeAwayReport,
            time: timeSellTakeAwayReport,
            from_date: fromDateTakeAwayReport,
            to_date: toDateTakeAwayReport,
            selectSort: selectSort
        },
        data = null,
        url = 'take-away-report.data',
        res = await axiosTemplate(method, url, params, data, [
            $("#table-sell-card1-report"),
            $("#chart-sell-take-away-report-vertical-empty"),
            $("#chart-sell-take-away-report-vertical-main"),
        ]);
    checkSpamTakeAwayReport = 0;
    if (res.data[0].length === 0 ) {
        $('#chart-sell-take-away-report-vertical-empty').removeClass('d-none')
        $('#chart-sell-take-away-report-vertical-main').addClass('d-none')
        $('#detail-value-take-away-report-box').addClass('d-none')
    } else {
        $('#chart-sell-take-away-report-vertical-empty').addClass('d-none')
        $('#chart-sell-take-away-report-vertical-main').removeClass('d-none')
        $('#detail-value-take-away-report-box').removeClass('d-none')
    }
    dataTakeawayTable(res.data[1].original.data);
    dataTakeawayTotal(res.data[3]);
    dataExcelTakeAwayReport = res.data[2].data.list

    switch (parseInt(selectSort)) {
        case 3:
            myChartTakeAwayReport.clear();
            eChartProfit(myChartTakeAwayReport, res.data[5]);
            break;
        default:
            myChartTakeAwayReport.clear();
            eChartThreeColumn(myChartTakeAwayReport,
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
                }),
                res.data[4],
                res.data[0] === null ? [] : res.data[0].map(i => {
                    return i.quantity;
                }),
            );
    }

}

async function dataTakeawayTable(data) {
    let fixedLeft = 2;
    let fixedRight = 0;
    let id = $('#table-sell-card6-report');
    let column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar'},
            {data: 'quantity', name: 'quantity', className: 'text-right'},
            {data: 'total_original_amount', name: 'total_original_amount', className: 'text-right'},
            {data: 'total_amount', name: 'total_amount', className: 'text-right'},
            {data: 'profit', name: 'profit', className: 'text-right'},
            {data: 'profit_ratio', name: 'profit_ratio', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch', className: 'd-none', width: '5%'},
        ],
        option = [
            {
                'title': 'Xuất excel',
                'icon': 'fi-rr-print',
                'class': 'seemt-btn-hover-blue',
                'function': 'exportExcelTakeAwayReport',
            }
        ]
    dataTableTakeaway = await DatatableTemplateNew(id, data, column, vh_of_table_report, fixedLeft, fixedRight, option);
    $(document).on('input paste', '#table-sell-card6-report_filter', async function () {
        let totalQuantity = 0,
            totalOriginPrice = 0,
            totalAmount = 0,
            totalProfit = 0;
        await dataTableTakeaway.rows({'search': 'applied'}).every(function () {
            let row = $(this.node());
            totalQuantity += removeformatNumber(row.find('td:eq(2)').text());
            totalOriginPrice += removeformatNumber(row.find('td:eq(4)').text());
            totalAmount += removeformatNumber(row.find('td:eq(5)').text());
            totalProfit += removeformatNumber(row.find('td:eq(6)').text());
        })
        $('#total-quantity-card6').text(formatNumber(totalQuantity));
        $('#total-original-card6').text(formatNumber(totalOriginPrice));
        $('#total-money-card6').text(formatNumber(totalAmount));
        $('#total-profit-card6').text(formatNumber(totalProfit));
    })
}

function dataTakeawayTotal(data) {
    $('#total').text(data.total);
    totalQuantityTakeAwayReport = data.sum_quantity;
    $('#total-quantity-card6').text(totalQuantityTakeAwayReport);
    totalOriginalAmountTakeAwayReport = data.sum_total_original;
    $('#total-original-card6').text(totalOriginalAmountTakeAwayReport);
    totalAmountTakeAwayReport = data.total;
    $('#total-money-card6').text(totalAmountTakeAwayReport);
    totalProfitTakeAwayReport = data.sum_profit;
    $('#total-profit-card6').text(totalProfitTakeAwayReport);
}

function detectDateOptionTimeTakeAway (type) {
    switch (type) {
        case 15:
            typeTimeSellTakeAwayReport = 15
            timeSellTakeAwayReport = ''
            fromDateTakeAwayReport = $('.from-month-filter-time-bar').val()
            toDateTakeAwayReport = $('.to-month-filter-time-bar').val()
            break;
        case 16:
            typeTimeSellTakeAwayReport = 16
            timeSellTakeAwayReport = ''
            fromDateTakeAwayReport = $('.from-year-filter-time-bar').val()
            toDateTakeAwayReport = $('.to-year-filter-time-bar').val()
            break;
        default:
            typeTimeSellTakeAwayReport = 13
            timeSellTakeAwayReport = ''
            fromDateTakeAwayReport = $('.from-date-filter-time-bar').val()
            toDateTakeAwayReport = $('.to-date-filter-time-bar').val()
    }
}
