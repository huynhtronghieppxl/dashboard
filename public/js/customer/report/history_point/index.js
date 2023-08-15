let typeTimeHistoryPointReport = 1, timeHistoryPointReport = $('#calendar-day').val(), loadDataBill = 0, dataTableBill = '',
    fromDateHistoryPointReport  = '', toDateHistoryPointReport = '',
    dataExcelHistoryPointReport, tabActiveHistoryPointReport, checkGetHistoryPointTime = 0;

$(function (){
    dateTimePickerTemplate($('#calendar-day'));
    dateTimePickerMonthYearTemplate($('#calendar-month'));
    dateTimePickerYearTemplate($('#calendar-year'));
    $('#select-time-report ~ .select2.select2-container').on('click', function () {
        $('#select-time-report').val() === 'day' ? $("#day").removeClass("d-none") : false;
    })
    $(document).on("dp.change", "#calendar-day, #calendar-month, #calendar-year", function () {
        timeHistoryPointReport = $(this).val();
    });
    loadData();

    $(document).on("change", "#select-time-report", async function () {
        let timeVal = $(this).val();
        switch (timeVal) {
            case "day":
                $(".add-display").addClass("d-none");
                $("#day").removeClass("d-none");
                typeTimeHistoryPointReport = 1;
                timeHistoryPointReport = $('#calendar-day').val();
                fromDateHistoryPointReport = '';
                toDateHistoryPointReport = '';
                break;
            case "week":
                $(".add-display").addClass("d-none");
                $("#week").removeClass("d-none");
                typeTimeHistoryPointReport = 2;
                timeHistoryPointReport = moment().format('WW/YYYY');
                fromDateHistoryPointReport = '';
                toDateHistoryPointReport = '';
                break;
            case "month":
                $(".add-display").addClass("d-none");
                $("#month").removeClass("d-none");
                typeTimeHistoryPointReport = 3;
                timeHistoryPointReport = $('#calendar-month').val();
                fromDateHistoryPointReport = '';
                toDateHistoryPointReport = '';
                break;
            case "3month":
                $(".add-display").addClass("d-none");
                typeTimeHistoryPointReport = 4;
                timeHistoryPointReport = moment().format('MM/YYYY');
                fromDateHistoryPointReport = '';
                toDateHistoryPointReport = '';
                break;
            case "year":
                $(".add-display").addClass("d-none");
                $("#year.form-year-time-filter").removeClass("d-none");
                typeTimeHistoryPointReport = 5;
                timeHistoryPointReport = $('#calendar-year').val();
                fromDateHistoryPointReport = '';
                toDateHistoryPointReport = '';
                break;
            case "3year":
                $(".add-display").addClass("d-none");
                typeTimeHistoryPointReport = 6;
                timeHistoryPointReport = moment().format('YYYY');
                fromDateHistoryPointReport = '';
                toDateHistoryPointReport = '';
                break;
            case "all_year":
                $(".add-display").addClass("d-none");
                typeTimeHistoryPointReport = 8;
                timeHistoryPointReport = moment().format('YYYY');
                fromDateHistoryPointReport = '';
                toDateHistoryPointReport = '';
                break;
        }
        await loadData();
    });

    $('#month .custom-button-search').on('click', function () {
        typeTimeHistoryPointReport = 3;
        timeHistoryPointReport = $('#calendar-month').val();
        fromDateHistoryPointReport = '';
        toDateHistoryPointReport = '';
        loadData();
    })
    $('#year .custom-button-search').on('click', function () {
        typeTimeHistoryPointReport = 5;
        timeHistoryPointReport = $('#calendar-year').val();
        fromDateHistoryPointReport = '';
        toDateHistoryPointReport = '';
        loadData();
    })
    $('#day .custom-button-search').on('click', function () {
        typeTimeHistoryPointReport = 1;
        timeHistoryPointReport = $('#calendar-day').val();
        fromDateHistoryPointReport = '';
        toDateHistoryPointReport = '';
        loadData();
    })

    // Set cookie
    if (getCookieShared('history-point-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('history-point-user-id-' + idSession));
        tabActiveHistoryPointReport = dataCookie.tabActiveHistoryPointReport;
        dateHistoryPointReport = dataCookie.day;
        monthHistoryPointReport = dataCookie.month;
        yearHistoryPointReport = dataCookie.year;
        $('#calendar-day').val(dateHistoryPointReport);
        $('#calendar-month').val(monthHistoryPointReport);
        $('#calendar-year').val(yearHistoryPointReport);
    } else {
        loadData();
    }
    $('#btn-type-time-sell-report button').on('click', function () {
        tabActiveHistoryPointReport = $(this).attr('id');
        updateCookieHistoryPoint();
    });
    $('#btn-type-time-sell-report button[id=' + tabActiveHistoryPointReport + ']').click();
    // End Cookie
    getToMaxDateTimePickerReport();
})

function updateCookieHistoryPoint(){
    saveCookieShared('history-point-user-id-' + idSession, JSON.stringify({
        time : timeHistoryPointReport,
        dateHistoryPointReport : $('#calendar-day').val(),
        monthHistoryPointReport : $('#calendar-month').val(),
        yearHistoryPointReport : $('#calendar-year').val()
    }))
}

async function loadData() {
    if(checkGetHistoryPointTime === 1) return false;
    let method = 'get',
        params = {
            type: typeTimeHistoryPointReport,
            time: timeHistoryPointReport,

        },
        data = null,
        url = 'history-point-report.data';
    checkGetHistoryPointTime = 1;
    let res = await axiosTemplate(method, url, params, data,[$("#table-history-point-report")]);
    checkGetHistoryPointTime = 0;
    await dataTableHistoryPointReport(res.data[0].original.data);
    dataExcelHistoryPointReport = res.data[1].data;
}

async function dataTableHistoryPointReport(data) {
    let scroll_Y = '65vh';
    let fixedLeft = 2;
    let fixedRight = 0;
    let id = $('#table-history-point-report');
    let column = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'name', name: 'name', className: 'text-left'},
        {data: 'gender', name: 'gender', className: 'text-left'},
        {data: 'added_point_count', name: 'added_point_count', className: 'text-center'},
        {data: 'added_point', name: 'added_point', className: 'text-right'},
        {data: 'subtracted_point_count', name: 'subtracted_point_count', className: 'text-center'},
        {data: 'subtracted_point', name: 'subtracted_point', className: 'text-right'},
        {data: 'keysearch', className: 'd-none'},
    ],
        option = [{
            'title': 'Xuất Excel',
            'icon': 'fi-rr-print',
            'class': '',
            'function': 'exportExcelHistoryPointReport',
        }]
    tableHistoryPointReport = await DatatableTemplateNew(id, data, column, scroll_Y, fixedLeft, fixedRight, option);
}
