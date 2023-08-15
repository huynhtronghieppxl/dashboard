let dataDebtReportTable, typeActionDebtReport = 1, timeActionDebtReport = $('#calendar-day').val(),
    dateDebtReport, yearDebtReport, monthDebtReport,
    fromDateDebtReport, toDateDebtReport, tabActiveDebtReport;
let dataExcelDebtReport;
let checkSpamDebtReport = 0

$(function () {
    dateTimePickerTemplate($('#calendar-day'));
    dateTimePickerMonthYearTemplate($('#calendar-month'));
    dateTimePickerYearTemplate($('#calendar-year'));
    templateReportTypeOption();
    $('#calendar-day').on('dp.change', function () {
        typeActionDebtReport = 1;
        timeActionDebtReport = $('#calendar-day').val();
        fromDateDebtReport = '';
        toDateDebtReport = '';
        loadData();
        updateCookieDebtReport();
    });
    $('#calendar-month').on('dp.change', function () {
        typeActionDebtReport = 3;
        timeActionDebtReport = $('#calendar-month').val();
        fromDateDebtReport = '';
        toDateDebtReport = '';
        loadData();
        updateCookieDebtReport();
    });
    $('#calendar-year').on('dp.change', function () {
        typeActionDebtReport = 5;
        timeActionDebtReport = $('#calendar-year').val();
        fromDateDebtReport = '';
        toDateDebtReport = '';
        loadData();
    });
    $('#month .custom-button-search').on('click', function () {
        typeActionDebtReport = 3
        timeActionDebtReport = $('#calendar-day').val()
        fromDateDebtReport = '';
        toDateDebtReport = '';
        loadData();
        updateCookieDebtReport();
    })
    $('#year .custom-button-search').on('click', function () {
        typeActionDebtReport = 5
        timeActionDebtReport = $('#calendar-year').val()
        fromDateDebtReport = '';
        toDateDebtReport = '';
        loadData();
        updateCookieDebtReport();
    })
    $('#day .custom-button-search').on('click', function () {
        typeActionDebtReport = 1
        fromDateDebtReport = '';
        toDateDebtReport = '';
        loadData();
        updateCookieDebtReport();
    })
    $('.search-date-filter-time-bar').on('click', function (){
        switch (Number($('.custom-select-option-report').val())){
            case 15:
                typeActionDebtReport = 15
                timeActionDebtReport = ''
                fromDateDebtReport = $('.from-month-filter-time-bar').val()
                toDateDebtReport = $('.to-month-filter-time-bar').val()
                loadData()
                break;
            case 16:
                typeActionDebtReport = 16
                timeActionDebtReport = ''
                fromDateDebtReport = $('.from-year-filter-time-bar').val()
                toDateDebtReport = $('.to-year-filter-time-bar').val()
                loadData()
                break;
            default:
                typeActionDebtReport = 13
                timeActionDebtReport = ''
                fromDateDebtReport = $('.from-date-filter-time-bar').val()
                toDateDebtReport = $('.to-date-filter-time-bar').val()
                loadData()
        }
    })
    if (getCookieShared('debt-report-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('debt-report-user-id-' + idSession));
        tabActiveDebtReport = dataCookie.tabActiveDebtReport
        dateDebtReport = dataCookie.dateDebtReport
        monthDebtReport = dataCookie.monthDebtReport
        yearDebtReport = dataCookie.yearDebtReport
        $('#calendar-day').val(dateDebtReport)
        $('#calendar-month').val(monthDebtReport)
        $('#calendar-year').val(yearDebtReport)
    }
    $('#type-time-group-debt-report button').on('click', function () {
        tabActiveDebtReport = $(this).attr('id');
        updateCookieDebtReport();
    });
    $('#type-time-group-debt-report button[id="' + tabActiveDebtReport + '"]').click();
    loadData();
    getToMaxDateTimePickerReport();
});

function updateCookieDebtReport() {
    saveCookieShared('debt-report-user-id-' + idSession, JSON.stringify({
        tabActiveDebtReport: tabActiveDebtReport,
        dateDebtReport: $('#calendar-day').val(),
        monthDebtReport: $('#calendar-month').val(),
        yearDebtReport: $('#calendar-year').val(),
    }))
}

async function loadData() {
    if(checkSpamDebtReport === 1) return false;
    checkSpamDebtReport = 1;
    let brand = $('#restaurant-branch-id-selected span').attr('data-value'),
        branch = $(".select-branch").val(),
        method = 'get',
        url = 'debt-report.data',
        params = {
            brand: brand,
            branch: branch,
            type: typeActionDebtReport,
            time: timeActionDebtReport,
            from_date: fromDateDebtReport,
            to_date: toDateDebtReport,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$("#table-debt-report")]);
    checkSpamDebtReport = 0;
    tableDebtReport(res.data[0].original.data);
    dataExcelDebtReport = res.data[1].data.list;
}

async function tableDebtReport(data) {
    let id = $('#table-debt-report'),
        fixed_left = 1,
        fixed_right = 1,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'supplier_code', name: 'supplier_code', className: 'text-center'},
            {data: 'supplier_name', name: 'supplier_name', className: 'text-center'},
            {data: 'debt_amount', name: 'debt_amount', className: 'text-center'},
            {data: 'watting_payment', name: 'watting_payment', className: 'text-center'},
            {data: 'paid_amount', name: 'paid_amount', className: 'text-center'},
            {data: 'owed_amount', name: 'owed_amount', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        option = [{
            'title': 'Xuất excel',
            'icon': 'fa fa-download text-warning',
            'class': '',
            'function': 'exportExcelDebtReport',
        }]
    dataDebtReportTable = await DatatableTemplateNew(id, data, column, "40vh", fixed_left, fixed_right, option);
}
