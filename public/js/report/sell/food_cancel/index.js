let typeTimeSellCancelFoodReport = 1, timeSellCancelFoodReport = $('#calendar-day').val(), dataTableCancelFood, checkSpamCancelFoodReport = 0,
    fromDateFoodCancelReport, toDateFoodCancelReport, tabActiveSellCancelFoodReport, px_of_table_report;

$(async function (){
    px_of_table_report = $(window).height() - ($('.seemt-header').outerHeight(true) + $('.table').outerHeight(true) + 55) - 100 - 48 + 'px';
    dateTimePickerTemplate($('#calendar-day'));
    dateTimePickerMonthYearTemplate($('#calendar-month'));
    dateTimePickerYearTemplate($('#calendar-year'));
    templateReportTypeOption();
    $('#select-time-report ~ .select2.select2-container').on('click', function () {
        $('#select-time-report').val() === 'day' ? $("#day").removeClass("d-none") : false;
    })
    $(document).on("dp.change", "#calendar-day, #calendar-month, #calendar-year", function () {
        timeSellCategoryReport = $(this).val();
    });
    $(document).on("change", "#select-time-report", async function () {
        let timeVal = $(this).val();
        switch (timeVal) {
            case "day":
                $(".add-display").addClass("d-none");
                $("#day").removeClass("d-none");
                typeTimeSellCancelFoodReport = 1;
                timeSellCancelFoodReport = $('#calendar-day').val();
                fromDateFoodCancelReport = ''
                toDateFoodCancelReport = ''
                break;
            case "week":
                $(".add-display").addClass("d-none");
                $("#week").removeClass("d-none");
                typeTimeSellCancelFoodReport = 2;
                timeSellCancelFoodReport = moment().format('WW/YYYY');
                fromDateFoodCancelReport = '';
                toDateFoodCancelReport = '';
                break;
            case "month":
                $(".add-display").addClass("d-none");
                $("#month").removeClass("d-none");
                typeTimeSellCancelFoodReport = 3;
                timeSellCancelFoodReport = $('#calendar-month').val();
                fromDateFoodCancelReport = '';
                toDateFoodCancelReport = '';
                break;
            case "3month":
                $(".add-display").addClass("d-none");
                typeTimeSellCancelFoodReport = 4;
                timeSellCancelFoodReport = moment().format('MM/YYYY');
                fromDateFoodCancelReport = '';
                toDateFoodCancelReport = '';
                break;
            case "year":
                $(".add-display").addClass("d-none");
                $("#year.form-year-time-filter").removeClass("d-none");
                typeTimeSellCancelFoodReport = 5;
                timeSellCancelFoodReport = $('#calendar-year').val();
                fromDateFoodCancelReport = '';
                toDateFoodCancelReport = '';
                break;
            case "3year":
                $(".add-display").addClass("d-none");
                typeTimeSellCancelFoodReport = 6;
                timeSellCancelFoodReport = moment().format('YYYY');
                fromDateFoodCancelReport = '';
                toDateFoodCancelReport = '';
                break;
            case "13":
                $(".add-display").addClass("d-none");
                $('#btn-custom-time-filter').removeClass('d-none');
                $('#btn-custom-time-filter .custom-date').removeClass('d-none');
                fromDateFoodCancelReport = '';
                toDateFoodCancelReport = '';
                detectDateOptionTimeFoodCancel(13);
                break;
            case "15":
                $(".add-display").addClass("d-none");
                $('#btn-custom-time-filter').removeClass('d-none');
                $('#btn-custom-time-filter .custom-month').removeClass('d-none');
                fromDateFoodCancelReport = '';
                toDateFoodCancelReport = '';
                detectDateOptionTimeFoodCancel(15);
                break;
            case "16":
                $(".add-display").addClass("d-none");
                $('#btn-custom-time-filter').removeClass('d-none');
                $('#btn-custom-time-filter .custom-year').removeClass('d-none');
                fromDateFoodCancelReport = '';
                toDateFoodCancelReport = '';
                detectDateOptionTimeFoodCancel(16);
                break;
            case "all_year":
                $(".add-display").addClass("d-none");
                typeTimeSellCancelFoodReport = 7;
                timeSellCancelFoodReport = moment().format('YYYY');
                fromDateFoodCancelReport = '';
                toDateFoodCancelReport = '';
                break;
        }
        await loadData();
    });

    $('#month .custom-button-search').on('click', function () {
        typeTimeSellCancelFoodReport = 3;
        timeSellCancelFoodReport = $('#calendar-month').val();
        fromDateFoodCancelReport = '';
        toDateFoodCancelReport = '';
        loadData();
    })
    $('#year .custom-button-search').on('click', function () {
        typeTimeSellCancelFoodReport = 5;
        timeSellCancelFoodReport = $('#calendar-year').val();
        fromDateFoodCancelReport = '';
        toDateFoodCancelReport = '';
        loadData();
    })
    $('#day .custom-button-search').on('click', function () {
        typeTimeSellCancelFoodReport = 1;
        timeSellCancelFoodReport = $('#calendar-day').val();
        fromDateFoodCancelReport = ''
        toDateFoodCancelReport = ''
        loadData();
    })
    $(document).on('input paste', '#table-sell-card7-report_filter', async function () {
        let totalQuantity = 0,
            totalAmount = 0;
        await dataTableCancelFood.rows({'search': 'applied'}).every(function () {
            let row = $(this.node());
            totalQuantity += removeformatNumber(row.find('td:eq(3)').text());
            totalAmount += removeformatNumber(row.find('td:eq(5)').text());
        })
        $('#total-quantity-card7').text(formatNumber(totalQuantity));
        $('#total-amount-card7').text(formatNumber(totalAmount));
    })
    $('.search-date-option-filter-time-bar').on('click', async function (){
        await detectDateOptionTimeFoodCancel(Number($("#select-time-report").val()));
        if(!CheckDateFormTo(fromDateFoodCancelReport, toDateFoodCancelReport)) return false
        loadData();
    })
    if (getCookieShared('sell-food-cancel-report-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('sell-food-cancel-report-user-id-' + idSession));
        tabActiveSellCancelFoodReport = dataCookie.tabActiveSellCancelFoodReport;
    }
    $('#btn-type-time-sell-report button').on('click', function () {
        tabActiveSellCancelFoodReport = $(this).attr('id');
        updateCookieSellCancelFoodReport();
    });
    $('#btn-type-time-sell-report button[id=' + tabActiveSellCancelFoodReport + ']').click();
    $('#select-sort-cancel-food-sell-report').on('change', function () {
        checkSpamCancelFoodReport = 0;
        loadData();
    })
    if(!($('.select-branch').val())) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }
    getToMaxDateTimePickerReport();
})

function updateCookieSellCancelFoodReport(){
    saveCookieShared('sell-food-cancel-report-user-id-' + idSession, JSON.stringify({
        tabActiveSellCancelFoodReport : tabActiveSellCancelFoodReport,
    }))
}

async function loadData(){
    if(checkSpamCancelFoodReport !== 0) return false;
    updateCookieSellCancelFoodReport()
    checkSpamCancelFoodReport = 1;
    let brand = $('.select-brand').val(),
        branch = $(".select-branch").val(),
        sortSelect = $('#select-sort-cancel-food-sell-report').val(),
        method = 'get',
        params = {
            brand: brand,
            branch: branch,
            report_type: typeTimeSellCancelFoodReport,
            time: timeSellCancelFoodReport,
            from_date: fromDateFoodCancelReport,
            to_date: toDateFoodCancelReport,
            sortSelect:sortSelect
        },
        data = null,
    url = 'food-cancel-report.data',
    res = await axiosTemplate(method, url, params, data, [
        $("#table-sell-card7-report")
    ]);
    checkSpamCancelFoodReport = 0;
    dataCancelFoodTable(res.data[0].original.data);
    dataCancelFoodTotal(res.data[1]);
}

async function dataCancelFoodTable(data) {
    let fixedLeft = 2;
    let fixedRight = 0;
    let id = $('#table-sell-card7-report');
    let column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name'},
            {data: 'food_name', name: 'food', className: 'text-left'},
            {data: 'quantity', name: 'quantity', className: 'text-right'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'total_amount', name: 'total_amount', className: 'text-right'},
            {data: 'day', name: 'day', className: 'text-center'},
            {data: 'table_name', name: 'table_name', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none', width:'5%'},
        ],
        option = [{
            'title': 'Xuất Excel',
            'icon': 'fi-rr-print',
            'class': 'seemt-btn-hover-blue',
            'function': 'exportSellFoodCancelReport'
        }];
    dataTableCancelFood = await DatatableTemplateNew(id, data, column, px_of_table_report, fixedLeft, fixedRight, option);
    $(document).on('input paste keyup keydown', '#table-sell-card7-report_filter', async function () {
        let totalQuantity = 0,
            totalAmount = 0;
        await dataTableCancelFood.rows({'search': 'applied'}).every(function () {
            let row = $(this.node());
            totalQuantity += removeformatNumber(row.find('td:eq(3)').text());
            totalAmount += removeformatNumber(row.find('td:eq(5)').text());
        })
        $('#total-quantity-card7').text(formatNumber(totalQuantity));
        $('#total-amount-card7').text(formatNumber(totalAmount));
    });
}

function dataCancelFoodTotal(data) {
    $('#total').text(data.total_amount);
    $('#total-quantity-card7').text(data.total_quantity);
    $('#total-amount-card7').text(data.total_amount);
}

function detectDateOptionTimeFoodCancel(type) {
    switch (type){
        case 15:
            typeTimeSellCancelFoodReport = 15
            timeSellCancelFoodReport = ''
            fromDateFoodCancelReport = $('.from-month-filter-time-bar').val()
            toDateFoodCancelReport = $('.to-month-filter-time-bar').val()
            break;
        case 16:
            typeTimeSellCancelFoodReport = 16
            timeSellCancelFoodReport = ''
            fromDateFoodCancelReport = $('.from-year-filter-time-bar').val()
            toDateFoodCancelReport = $('.to-year-filter-time-bar').val()
            break;
        default:
            typeTimeSellCancelFoodReport = 13
            timeSellCancelFoodReport = ''
            fromDateFoodCancelReport = $('.from-date-filter-time-bar').val()
            toDateFoodCancelReport = $('.to-date-filter-time-bar').val()
    }
}
