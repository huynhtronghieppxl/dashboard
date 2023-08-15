let tabTimeKeeping = 1, selectDateTimeKeeping, selectMonthTimeKeeping, selectEmployeeTimeKeeping, tableDateTimeKeepingEmployee, tableMonthTimeKeepingEmployee;
$(function () {
    dateTimePickerTemplate($('#date-time-keeping-manage'));
    dateTimePickerMonthYearTemplate($('#month-time-keeping-manage'));
    //get cookie
    if(getCookieShared('time-keeping-user-id-'+ idSession)){
        let dataCookie = JSON.parse(getCookieShared('time-keeping-user-id-'+ idSession));
        tabTimeKeeping = dataCookie.tab;
        selectDateTimeKeeping = dataCookie.date;
        selectMonthTimeKeeping = dataCookie.month;
        selectEmployeeTimeKeeping = dataCookie.employee;
        $('#date-time-keeping-manage').val(selectDateTimeKeeping);
        $('#month-time-keeping-manage').val(selectMonthTimeKeeping);

    }
    $('#nav-tabs-time-keeping li a').on('click', function () {
        tabTimeKeeping = $(this).data('id');
        updateCookeTimeKeeping();
    })

    $('.search-btn-time-keeping').on('change', function (){
        loadData();
    })

    loadData();
    $('.search-btn-date-time-keeping').on('click', function () {
        dataDateTimeKeepingManage();
        updateCookeTimeKeeping();
    });
    $('.search-btn-month-time-keeping').on('click', async function () {
        dataEmployeeTimeKeepingManage();
        await dataMonthTimeKeepingManage();
        updateCookeTimeKeeping();
    });
    $('#select-employee-time-keeping-manage').on('select2:select', function () {
        selectEmployeeTimeKeeping = $(this).val()
        updateCookeTimeKeeping();
        dataMonthTimeKeepingManage();
    });
    $('#nav-tabs-time-keeping a[data-id="' + tabTimeKeeping + '"]').click()
});

function updateCookeTimeKeeping(){
    saveCookieShared('time-keeping-user-id-'+ idSession, JSON.stringify({
        'tab' : tabTimeKeeping,
        'date' : $('#date-time-keeping-manage').val(),
        'month' : $('#month-time-keeping-manage').val(),
        'employee' : selectEmployeeTimeKeeping,
    }))
}

async function loadData() {
    await dataEmployeeTimeKeepingManage();
    dataDateTimeKeepingManage();
    dataMonthTimeKeepingManage();
}

async function dataEmployeeTimeKeepingManage() {
    let method = 'get',
        url = 'time-keeping-manage.employee',
        branch = $('.select-branch-time-keeping-data').val(),
        time = $('#month-time-keeping-manage').val(),
        params = {branch: branch, time: time},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-employee-time-keeping-manage')
    ]);
    $('#select-employee-time-keeping-manage').html(res.data[0])
    checkHasInSelect(selectEmployeeTimeKeeping, $('#select-employee-time-keeping-manage'))
}

async function dataDateTimeKeepingManage() {
    let method = 'get',
        url = 'time-keeping-manage.data-date',
        time = $('#date-time-keeping-manage').val(),
        branch = $('.select-branch-time-keeping-data').val(),
        params = {
            time: time,
            branch: branch
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $('#content-body-techres'),
    ]);
    tableDateTimeKeepingManage(res.data[0].original.data);
    $('#total-record-date-time-keeping-manage').text(res.data[1]);
}

async function tableDateTimeKeepingManage(data) {
    let id = $('#table-date-time-keeping-manage'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar'},
            {data: 'shift', name: 'shift', className: 'text-center'},
            {data: 'date', name: 'date', className: 'text-center'},
            {data: 'checkin', name: 'checkin', className: 'text-center'},
            {data: 'checkout', name: 'checkout', className: 'text-center'},
            {data: 'late_minutes_time', name: 'late_minutes_time', className: 'text-center', width: '5%'},
            {data: 'address', name: 'address', className: 'text-left'},
        ],option = [],
        fixed_left = 0,
        fixed_right = 0;
    tableDateTimeKeepingEmployee = await DatatableTemplateNew(id, data, column, vh_of_table, fixed_left, fixed_right,option)
    $(document).on('input paste keyup keydown', 'input[type="search"]',async function (){
        let index = 1;
        await tableDateTimeKeepingEmployee.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            row.find('td:eq(0)').text(index)
            index++;
        })
        $('#total-record-date-time-keeping-manage').text(tableDateTimeKeepingEmployee.rows({'search':'applied'}).count());
    })
}

async function dataMonthTimeKeepingManage() {
    let method = 'get',
        url = 'time-keeping-manage.data-month',
        time = $('#month-time-keeping-manage').val(),
        employee = $('#select-employee-time-keeping-manage').val(),
        branch = $('.select-branch-time-keeping-data').val(),
        params = {
            time: time,
            employee: employee,
            branch: branch
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $('#content-body-techres')
    ]);
    tableMonthTimeKeepingManage(res.data[0].original.data);
    $('#total-record-month-time-keeping-manage').text(res.data[1]);
}

async function tableMonthTimeKeepingManage(data) {
    let id = $('#table-month-time-keeping-manage'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', width: '5%'},
            {data: 'shift', name: 'shift', className: 'text-center'},
            {data: 'date', name: 'date', className: 'text-center'},
            {data: 'checkin', name: 'checkin', className: 'text-center',},
            {data: 'checkout', name: 'checkout', className: 'text-center',},
            {data: 'late_minutes_time', name: 'late_minutes_time', className: 'text-center', width: '5%'},
            {data: 'address', name: 'address', className: 'text-left'},
            {data: 'status', name: 'status', className: 'text-center'},
            {data: 'action', name: 'action', className: "text-center", width: '5%'}
        ],option = [],
        fixed_left = 0,
        fixed_right = 1;
    tableMonthTimeKeepingEmployee = await DatatableTemplateNew(id, data, column, vh_of_table, fixed_left, fixed_right,option)
    $(document).on('input paste keyup keydown', 'input[type="search"]',async function (){
        let index = 1;
        await tableMonthTimeKeepingEmployee.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            row.find('td:eq(0)').text(index)
            index++;
        })
        $('#total-record-month-time-keeping-manage').text(tableMonthTimeKeepingEmployee.rows({'search':'applied'}).count());
    })
}

function changeTabTimeKeepingManage(r) {
    if (r === 1) {
        $('#div-select-employee-time-keeping-manage').addClass('d-none');
        $('#month-time-keeping-manage').addClass('d-none');
        $('#date-time-keeping-manage').removeClass('d-none');

        $('.month-time-keeping-manage').addClass('d-none');
        $('.date-time-keeping-manage').removeClass('d-none');
    } else {
        $('#div-select-employee-time-keeping-manage').removeClass('d-none');
        $('#date-time-keeping-manage').addClass('d-none');
        $('#month-time-keeping-manage').removeClass('d-none');

        $('.date-time-keeping-manage').addClass('d-none');
        $('.month-time-keeping-manage').removeClass('d-none');
    }
}

