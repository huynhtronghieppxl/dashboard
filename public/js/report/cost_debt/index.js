let dataCostDebtReportTable, typeActionCostDebtReport = 1, timeActionCostDebtReport = $('#calendar-day').val(),
    typeTimeCostDebt, dateActionCostDebt, monthActionCostDebt, yearActionCostDebt,
    fromDateCostDebtReport, toDateCostDebtReport
let dataExcelCostDebtReport = [];

$(function () {
    dateTimePickerTemplate($('#calendar-day'));
    dateTimePickerMonthYearTemplate($('#calendar-month'));
    dateTimePickerYearTemplate($('#calendar-year'));
    loadData();
    templateReportTypeOption();
    $('#calendar-day').on('dp.change', function () {
        typeActionCostDebtReport = 1;
        timeActionCostDebtReport = $('#calendar-day').val();
        loadData();
        updateCookieCostDebt()
    });
    $('#calendar-week').on('dp.change', function () {
        typeActionCostDebtReport = 2;
        timeActionCostDebtReport = $('#calendar-week').val();
        loadData();
        updateCookieCostDebt()
    });
    $('#calendar-month').on('dp.change', function () {
        typeActionCostDebtReport = 3;
        timeActionCostDebtReport = $('#calendar-month').val();
        loadData();
        updateCookieCostDebt()
    });
    $('#calendar-year').on('dp.change', function () {
        typeActionCostDebtReport = 5;
        timeActionCostDebtReport = $('#calendar-year').val();
        loadData();
        updateCookieCostDebt()
    });
    $('#day .custom-button-search').on('click',function (){
        loadData();
    })
    $('#month .custom-button-search').on('click',function (){
        loadData();
    })
    $('#year .custom-button-search').on('click',function (){
        loadData();
    })
    $('.search-date-filter-time-bar').on('click', function (){
        switch (Number($('.custom-select-option-report').val())){
            case 15:
                typeActionCostDebtReport = 15
                timeActionCostDebtReport = ''
                fromDateCostDebtReport = $('.from-month-filter-time-bar').val()
                toDateCostDebtReport = $('.to-month-filter-time-bar').val()
                loadData()
                break;
            case 16:
                typeActionCostDebtReport = 16
                timeActionCostDebtReport = ''
                fromDateCostDebtReport = $('.from-year-filter-time-bar').val()
                toDateCostDebtReport = $('.to-year-filter-time-bar').val()
                loadData()
                break;
            default:
                typeActionCostDebtReport = 13
                timeActionCostDebtReport = ''
                fromDateCostDebtReport = $('.from-date-filter-time-bar').val()
                toDateCostDebtReport = $('.to-date-filter-time-bar').val()
                loadData()
        }
    })
    if(getCookieShared('cost-debt-report-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('cost-debt-report-user-id-' + idSession));
        typeTimeCostDebt = dataCookie.type;
        dateActionCostDebt = dataCookie.day;
        monthActionCostDebt = dataCookie.month;
        yearActionCostDebt = dataCookie.year;
        $('#calendar-day').val(dateActionCostDebt)
        $('#calendar-month').val(monthActionCostDebt)
        $('#calendar-year').val(yearActionCostDebt)
    }
    $('#btn-type-time-cost-debt-report button').on('click', function () {
        typeTimeCostDebt = $(this).attr('id');
        updateCookieCostDebt();
    });
    $('#btn-type-time-cost-debt-report button[id="' + typeTimeCostDebt + '"]').click();
    getToMaxDateTimePickerReport();
});

function updateCookieCostDebt() {
    saveCookieShared('cost-debt-report-user-id-' + idSession, JSON.stringify({
        type : typeTimeCostDebt,
        day : $('#calendar-day').val(),
        month : $('#calendar-month').val(),
        year : $('#calendar-year').val()
    }));
}

async function loadData() {
    let brand = $('#restaurant-branch-id-selected span').attr('data-value'),
        branch = $(".select-branch").val(),
        method = 'get',
        url = 'cost-debt-report.data',
        params = {
            brand: brand,
            branch: branch,
            type: typeActionCostDebtReport,
            time: timeActionCostDebtReport,
            from_date: fromDateCostDebtReport,
            to_date: toDateCostDebtReport,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$("#table-cost-debt-report")]);
    await dataTableCostDebtReport(res.data[0].original.data);
    dataExcelCostDebtReport = res.data[2].data;
    totalDoneCostDebtReport = res.data[1].total_amount;
    totalWaitingCostDebtReport = res.data[1].total_waiting;
    totalDebtCostDebtReport = res.data[1].total_debt;
    $('#total-done-cost-debt-report').text(totalDoneCostDebtReport);
    $('#total-waiting-cost-debt-report').text(totalWaitingCostDebtReport);
    $('#total-debt-cost-debt-report').text(totalDebtCostDebtReport);
}

async function dataTableCostDebtReport(data) {
    let id = $('#table-cost-debt-report');
    let column = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'addition_fee_reason_content', name: 'addition_fee_reason_content', className: 'text-center'},
        {data: 'amount', name: 'amount', className: 'text-center'},
        {data: 'waiting_amount', name: 'waiting_amount', className: 'text-center'},
        {data: 'debt_amount', name: 'debt_amount', className: 'text-center'},
        {data: 'keysearch', className: 'd-none'},
    ],
        option = [{
            'title': 'Xuất excel',
            'icon': 'fa fa-download text-warning',
            'class': '',
            'function': 'exportExcelCostDebtReport',
        }]
    let scrollY = vh_of_table;
    let fixedLeft = 0;
    let fixedRight = 0;
    dataCostDebtReportTable = await DatatableTemplateNew(id, data, column, scrollY, fixedLeft, fixedRight, option);
    $(document).on('input paste keyup', '#table-cost-debt-report_filter', async function () {
        let totalDone = 0,
            totalWaiting = 0,
            totalDebt = 0;
        await dataCostDebtReportTable.rows({'search': 'applied'}).every(function () {
            let row = $(this.node());
            totalDone += removeformatNumber(row.find('td:eq(2)').text());
            totalWaiting += removeformatNumber(row.find('td:eq(3)').text());
            totalDebt += removeformatNumber(row.find('td:eq(4)').text());
        })
        $('#total-done-cost-debt-report').text(formatNumber(totalDone));
        $('#total-waiting-cost-debt-report').text(formatNumber(totalWaiting));
        $('#total-debt-cost-debt-report').text(formatNumber(totalDebt));
    })
}
