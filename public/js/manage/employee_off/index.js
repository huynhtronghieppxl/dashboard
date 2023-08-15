let tabEmployeeOffChange = 1, selectMonthEmployeeOff, selectYearEmployeeOff,
    tableEmployeeOffManageMonth, tableEmployeeOffYear,
    selectDiligenceEmployeeOff, selectStatusEmployeeOff;
$(function () {
    dateTimePickerMonthYearTemplate($('#month-employee-off'));
    dateTimePickerYearTemplate($('#year-employee-off'));

    // get cookie
    if(getCookieShared('employee-off-manage-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('employee-off-manage-user-id-' + idSession));
        tabEmployeeOffChange = dataCookie.tabEmployeeOffChange;
        selectMonthEmployeeOff = dataCookie.selectMonthEmployeeOff;
        selectYearEmployeeOff = dataCookie.selectYearEmployeeOff;
        selectDiligenceEmployeeOff = dataCookie.selectDiligenceEmployeeOff;
        selectStatusEmployeeOff = dataCookie.selectStatusEmployeeOff;
        $('#month-employee-off').val(selectMonthEmployeeOff);
        $('#year-employee-off').val(selectYearEmployeeOff);
        selectSortDataEmployeeOff();
    }
    $('#data-list-employee-off-manage a.nav-link[data-id="' + tabEmployeeOffChange + '"]').click();
    $('.search-btn-employee-off-manage-by-month').on('click', function () {
        loadDataByMonth();
    });
    $('.search-btn-employee-off-manage-by-year').on('click', function () {
        loadDataByYear();
    });
    // $('#month-employee-off').on('dp.change',function (){
    //     if($(this).val() === ''){
    //         $(this).val(moment(new Date).format('MM/YYYY'));
    //     }
    //     loadDataByMonth();
    // })
    // $('#year-employee-off').on('dp.change',function (){
    //     if($(this).val() === ''){
    //         $(this).val(moment(new Date).format('YYYY'));
    //     }
    //     loadDataByYear();
    // })
    $('#nav-tabs-employee-off li a').on('click', function () {
        tabEmployeeOffChange = $(this).data('id');
        updateCookieEmployeeOffManageTabs();
    })
    $('.select-diligence-employee-off-manage').on('select2:select',async function () {
        $('.select-diligence-employee-off-manage').val($(this).val()).trigger('change.select2');
        selectDiligenceEmployeeOff = $(this).val();
        await updateCookieEmployeeOffManageTabs();
        loadData();
    });
    $('.select-status-employee-off-manage').on('select2:select',async  function () {
        $('.select-status-employee-off-manage').val($(this).val()).trigger('change.select2');
        selectStatusEmployeeOff = $(this).val();
        await updateCookieEmployeeOffManageTabs();
        loadData();
    });
    loadData();
    });
function updateCookieEmployeeOffManageTabs(){
    saveCookieShared('employee-off-manage-user-id-' + idSession, JSON.stringify({
        tabEmployeeOffChange : tabEmployeeOffChange,
        selectMonthEmployeeOff : $('#month-employee-off').val(),
        selectYearEmployeeOff : $('#year-employee-off').val(),
        selectDiligenceEmployeeOff : $('.select-diligence-employee-off-manage').val(),
        selectStatusEmployeeOff : $('.select-status-employee-off-manage').val(),
    }))
}

function loadData() {
    loadDataByMonth();
    loadDataByYear();
}

async function loadDataByMonth() {
    let method = 'get',
        url = 'employee-off-manage.data',
        time_picker_val = $('#month-employee-off').val(),
        branch = $('.select-branch-employee-off-data').val(),
        status = $('.select-status-employee-off-manage').val(),
        diligence = $('.select-diligence-employee-off-manage').val(),
        year = time_picker_val.substr(time_picker_val.lastIndexOf('/') + 1),
        month = time_picker_val.substr(0, time_picker_val.lastIndexOf('/')),
        params = {year: year, month: month, branch: branch, status: status, diligence: diligence},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$('#table-employee-off-manage-by-month')]);
    await dataTableEmployeeOffManageMonth(res.data[0].original.data);
    $('#total-record-month-employee-off').text(res.data[0].original.data.length);
}

async function loadDataByYear() {
    let method = 'get',
        url = 'employee-off-manage.data',
        branch = $('.select-branch-employee-off-data').val(),
        year = $('#year-employee-off').val(),
        status = $('.select-status-employee-off-manage').val(),
        diligence = $('.select-diligence-employee-off-manage').val(),
        month = '',
        params = {year: year, month: month, branch: branch, status: status, diligence: diligence},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$('#table-employee-off-manage-by-year')]);
    await dataTableEmployeeOffManageYear(res.data[1].original.data);
    $('#total-record-year-employee-off').text(res.data[0].original.data.length);
}

function selectSortDataEmployeeOff() {
    $('.select-diligence-employee-off-manage').val(selectDiligenceEmployeeOff).trigger('change.select2');
    $('.select-status-employee-off-manage').val(selectStatusEmployeeOff).trigger('change.select2');
    checkHasInSelect(selectDiligenceEmployeeOff, $('.select-diligence-employee-off-manage'));
    selectDiligenceEmployeeOff = $('.select-diligence-employee-off-manage').val();
    checkHasInSelect(selectStatusEmployeeOff, $('.select-status-employee-off-manage'));
    selectStatusEmployeeOff = $('.select-status-employee-off-manage').val();
}

async function dataTableEmployeeOffManageYear(data) {
    let id = $('#table-employee-off-manage-by-year'),
    scroll_Y = '60vh',
    fixedLeft = 3,
    fixedRight = 1,
    column = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'avatar', name: 'avatar', width: '5%'},
        {data: 'branch_name', name: 'branch_name', className: 'text-left'},
        {data: 'total_yearly_off_day', name: 'total_yearly_off_day', className: 'text-center'},
        {data: 'used_yearly_off_day', name: 'used_yearly_off_day', className: 'text-center'},
        {data: 'total_yearly_off_day_available', name: 'total_yearly_off_day_available', className: 'text-center'},
        {data: 'diligence_months', name: 'diligence_months', className: 'text-center'},
        {data: 'created_at', name: 'created_at', className: 'text-center'},
        {data: 'working_from_begin', name: 'working_from_begin', className: 'text-left'},
        {data: 'status', name: 'status', className: 'text-center', width: '5%'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        {data: 'keysearch', name: 'keysearch', className: 'd-none'},
    ],option = []
    tableEmployeeOffYear = await DatatableTemplateNew(id, data, column, scroll_Y, fixedLeft, fixedRight, option);
    $(document).on('input paste','#table-employee-off-manage-by-year_filter', function (){
        let index1 = 1
        tableEmployeeOffYear.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            row.find('td:eq(0)').text(index1)
            index1++;
        })
        $('#total-record-year-employee-off').text(formatNumber(tableEmployeeOffYear.rows({'search':'applied'}).count()))
    })
}

async function dataTableEmployeeOffManageMonth(data) {
    let id = $('#table-employee-off-manage-by-month'),
    scroll_Y = '60vh',
    fixedLeft = 3,
    fixedRight = 1,
    column = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'avatar', name: 'avatar', width: '5%'},
        {data: 'branch_name', name: 'branch_name', className: 'text-left'},
        {data: 'total_monthly_off_day', name: 'total_monthly_off_day', className: 'text-center'},
        {data: 'used_monthly_off_day', name: 'used_monthly_off_day', className: 'text-center'},
        {data: 'total_monthly_off_day_available', name: 'total_monthly_off_day_available', className: 'text-center'},
        {data: 'total_month_diligence', name: 'total_month_diligence', className: 'text-center'},
        {data: 'created_at', name: 'created_at', className: 'text-center'},
        {data: 'working_from_begin', name: 'working_from_begin', className: 'text-left'},
        {data: 'status', name: 'status', className: 'text-center', width: '5%'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        {data: 'keysearch', name: 'keysearch', className: 'd-none'},
    ], option = []
    tableEmployeeOffManageMonth =  await DatatableTemplateNew(id, data, column, scroll_Y, fixedLeft, fixedRight, option);
    $(document).on('input paste','#table-employee-off-manage-by-month_filter', function (){
        let index = 1
        tableEmployeeOffManageMonth.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            row.find('td:eq(0)').text(index)
            index++;
        })
        $('#total-record-month-employee-off').text(formatNumber(tableEmployeeOffManageMonth.rows({'search':'applied'}).count()))
    })
}

function changeTabEmployeeOff(type) {
    if (type === 1) {
        $('#div-btn-employee-off-manage-by-month').removeClass('d-none');
        $('#div-btn-employee-off-manage-by-year').addClass('d-none');
    } else {
        $('#div-btn-employee-off-manage-by-month').addClass('d-none');
        $('#div-btn-employee-off-manage-by-year').removeClass('d-none');
    }
}
