let tableReceipt = '',
    tablePayment = '',
    brand,
    branch, typeTabDetailMoneyReport = 1, typeTimeDetailMoneyReport = 1;
let tabCurrent = 0, typeActionDetailMoneyReport = 1, loadingTabReceipt = 0,
    loadingTabPayment = 0, timeActionDetailMoneyReport = $('#calendar-day').val(),
    dateDetailMoneyReport, monthDetailMoneyReport, yearDetailMoneyReport;

$(function () {
    dateTimePickerTemplate($('#calendar-day'));
    dateTimePickerMonthYearTemplate($('#calendar-month'));
    dateTimePickerYearTemplate($('#calendar-year'));
    if(getCookieShared('detail-money-report-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('detail-money-report-user-id-' + idSession));
        typeTabDetailMoneyReport = dataCookie.tab;
        typeTimeDetailMoneyReport = dataCookie.typeTime;
        dateDetailMoneyReport = dataCookie.date;
        monthDetailMoneyReport = dataCookie.month;
        yearDetailMoneyReport = dataCookie.year;
        $('#calendar-year').val(yearDetailMoneyReport);
        $('#calendar-month').val(monthDetailMoneyReport);
        $('#calendar-day').val(dateDetailMoneyReport);
    }

    brand = $('#restaurant-branch-id-selected span').attr('data-value');
    branch = $(".select-branch").val(),
    $('#calendar-day').on('dp.change', function () {
        typeActionDetailMoneyReport = 1;
        timeActionDetailMoneyReport = $('#calendar-day').val();
        loadingData();
        updateCookieDetailMoney()
    });
    $('#calendar-month').on('dp.change', function () {
        typeActionDetailMoneyReport = 3;
        timeActionDetailMoneyReport = $('#calendar-month').val();
        loadingData();
        updateCookieDetailMoney()
    });
    $('#calendar-year').on('dp.change', function () {
        typeActionDetailMoneyReport = 5;
        timeActionDetailMoneyReport = $('#calendar-year').val();
        loadingData();
        updateCookieDetailMoney()
    });

    $('#month .custom-button-search').on('click',function (){
        loadData();
    })

    $('#year .custom-button-search').on('click',function (){
        loadData();
    })

    $('#day .custom-button-search').on('click',function (){
        loadData();
    })

    $('#nav-tabs-detail-money li a').on('click', function () {
        typeTabDetailMoneyReport = $(this).data('tab');
        updateCookieDetailMoney()

    })

    $('#btn-group-time-detail-money-report button').on('click', function () {
        typeTimeDetailMoneyReport = $(this).data('type');
        updateCookieDetailMoney()

    })
    $('#nav-tabs-detail-money li a[data-tab="' + typeTabDetailMoneyReport + '"]').click();
});

function updateCookieDetailMoney(){
        saveCookieShared('detail-money-report-user-id-' + idSession, JSON.stringify({
            'tab' : typeTabDetailMoneyReport,
            'typeTime' : typeTimeDetailMoneyReport,
            'date' :  $('#calendar-day').val(),
            'month' :  $('#calendar-month').val(),
            'year' :  $('#calendar-year').val(),
        }))
}

async function loadData() {
    branch = $(".select-branch").val(),
    loadingData();
}

async function loadingData() {
    if (tabCurrent === 0) {
        loadingTabReceipt = 1;
        loadingTabPayment = 0;
        tableReceipt.ajax.url("detail-money-report.data?brand=" + brand + "&branch=" + branch + "&type=" + typeActionDetailMoneyReport + "&time=" + timeActionDetailMoneyReport + "&object_type=" + 0).load();
    } else {
        loadingTabReceipt = 0;
        loadingTabPayment = 1;
        tablePayment.ajax.url("detail-money-report.data?brand=" + brand + "&branch=" + branch + "&type=" + typeActionDetailMoneyReport + "&time=" + timeActionDetailMoneyReport + "&object_type=" + 1).load();
    }
}

async function tabContent(tab) {
    tabCurrent = tab;
    if (tab === 0) {
        if (tableReceipt === '') {
            let element = $('#table-tab1-report'),
                url = "detail-money-report.data?brand=" + brand + "&branch=" + branch + "&type=" + typeActionDetailMoneyReport + "&time=" + timeActionDetailMoneyReport + "&object_type=" + 0,
                column = [
                    {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
                    {data: 'code', name: 'code', className: 'text-center'},
                    {data: 'employee_full_name', name: 'employee'},
                    {data: 'create_at', name: 'create_at', className: 'text-center'},
                    {data: 'object_name', name: 'object_name', className: 'text-center'},
                    {data: 'addition_fee_reason_content', name: 'addition_fee_reason_content', className: 'text-center'},
                    {data: 'amount', name: 'amount', className: 'text-center'},
                    {data: 'action', name: 'action', className: 'text-center', width: '5%'},
                    {data: 'keysearch', name: 'keysearch', className: 'd-none'}
                ];
            tableReceipt = await loadDataDetailMoney(element, url, column);
            $('#btn-group-time-detail-money-report button[data-type="' + typeTimeDetailMoneyReport + '"]').click();
            loadingTabReceipt = 1;
        } else if (loadingTabReceipt === 0) {
            tableReceipt.ajax.url("detail-money-report.data?brand=" + brand + "&branch=" + branch + "&type=" + typeActionDetailMoneyReport + "&time=" + timeActionDetailMoneyReport + "&object_type=" + 0).load();
        }
    } else {
        if (tablePayment === '') {
            let element = $('#table-tab2-report'),
                url =  "detail-money-report.data?brand=" + brand + "&branch=" + branch + "&type=" + typeActionDetailMoneyReport + "&time=" + timeActionDetailMoneyReport + "&object_type=" + 1,
                column = [
                    {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
                    {data: 'code', name: 'code', className: 'text-center'},
                    {data: 'employee_full_name', name: 'employee', className: 'text-center'},
                    {data: 'create_at', name: 'create_at', className: 'text-center'},
                    {data: 'object_name', name: 'object_name', className: 'text-center'},
                    {data: 'addition_fee_reason_content', name: 'addition_fee_reason_content', className: 'text-center'},
                    {data: 'amount', name: 'amount', className: 'text-center'},
                    {data: 'action', name: 'action', className: 'text-center', width: '10%'},
                    {data: 'keysearch', name: 'keysearch', className: 'd-none'}
                ];
            tablePayment = await loadDataDetailMoney(element, url, column);
            $('#btn-group-time-detail-money-report button[data-type="' + typeTimeDetailMoneyReport + '"]').click();
            loadingTabPayment = 1;
        } else if (loadingTabPayment === 0) {
            tablePayment.ajax.url("detail-money-report.data?brand=" + brand + "&branch=" + branch + "&type=" + typeActionDetailMoneyReport + "&time=" + timeActionDetailMoneyReport + "&object_type=" + 1).load();
        }
    }
}

async function loadDataDetailMoney(element, url, column) {
    let fixedLeftTable = 2,
        fixedRightTable = 2,
        optionRenderTable = [{
            'title': 'Xuất excel',
            'icon': 'fa fa-download text-warning',
            'class': '',
            'function': 'exportExcelDetailMoneyReport',
        }]
    return DatatableServerSideTemplateNew(element, url, column, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, callbackDetailMoneyData);
}

function callbackDetailMoneyData(response) {
    $('#total-in-amount').text(response.total_amount_payment);
    $('#total-out-amount').text(response.total_amount_receipt);
    $('#total-receipt').text(response.total_record_receipt);
    $('#total-payment').text(response.total_record_payment);
    dataExcelDetailMoneyReport = response.data;
    totalInDetailMoneyReport = response.total_amount_payment;
    totalOutDetailMoneyReport = response.total_amount_receipt;
}
