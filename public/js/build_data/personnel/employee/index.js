let tableCheckInEmployee, tableNotCheckInEmployee, tableByPassCheckInEmployee, tableAllEmployee,
    tabCurrentEmployeeData = 1, selectBranchEmployeeManage = -1;

$(function () {

    if (getCookieShared('employee-data-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('employee-data-user-id-' + idSession));
        tabCurrentEmployeeData = dataCookie.tab;
    }

    $('#nav-tab-employee-data .nav-link').on('click', function () {
        tabCurrentEmployeeData = $(this).attr('data-id')
        updateCookieEmployeeData()
    })
    $(document).on('change', '.select-brand.select-employee-data', function () {
        $('.select-brand.select-employee-data').val($(this).val()).trigger('change.select2');
    })
    $('#nav-tab-employee-data .nav-link[data-id="' + tabCurrentEmployeeData + '"]').click();
    loadData();
});

function updateCookieEmployeeData() {
    saveCookieShared('employee-data-user-id-' + idSession, JSON.stringify({
        'tab': tabCurrentEmployeeData,
        'select': selectBranchEmployeeManage
    }))
}

async function loadData() {
    updateCookieEmployeeData()
    let method = 'get',
        url = 'employee-data.data',
        params = {
            brand: $('.select-brand.select-employee-data').val(),
            branch_id: $('.select-branch-employee-data').val()
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#tab-check-in-table-employee'), $('#tab-not-check-in-table-employee'), $('#tab-by-pass-table-employee')]);
    if (parseInt($('#level-template').val()) > 1) {
        dataTableEmployeeManage(res);
        dataTotalEmployeeManage(res.data[3]);
    } else {
        dataTableAllEmployeeManage(res);
    }

}

async function dataTableEmployeeManage(res) {
    let idTableCheckInEmployee = $('#tab-check-in-table-employee'),
        idTableNotCheckInEmployee = $('#tab-not-check-in-table-employee'),
        idTableByPassCheckInEmployee = $('#tab-by-pass-table-employee'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'employee_avatar', name: 'name', className: 'text-left'},
            {data: 'username', className: 'text-left'},
            {data: 'gender', className: 'text-left'},
            {data: 'phone', className: 'text-left'},
            {data: 'branch_name', className: 'text-left'},
            {data: 'action', className: 'text-center', width: '8%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    let option = [{
        'title': 'Thêm mới (F2)',
        'icon': 'fa fa-plus text-primary',
        'class': '',
        'function': 'openModalCreateEmployeeManage',
    }]
    tableCheckInEmployee = await DatatableTemplateNew(idTableCheckInEmployee, res.data[0].original.data, column, '60vh', fixed_left, fixed_right, option);
    tableNotCheckInEmployee = await DatatableTemplateNew(idTableNotCheckInEmployee, res.data[1].original.data, column, '60vh', fixed_left, fixed_right, option);
    tableByPassCheckInEmployee = await DatatableTemplateNew(idTableByPassCheckInEmployee, res.data[2].original.data, column, '60vh', fixed_left, fixed_right, option);
    $(document).on('input paste keyup keydown', 'input[type="search"]', function () {
        searchUpdateIndexDataTableEmployeeData(tableCheckInEmployee)
        searchUpdateIndexDataTableEmployeeData(tableNotCheckInEmployee)
        searchUpdateIndexDataTableEmployeeData(tableByPassCheckInEmployee)
        $('#total-record-check-in-employee').text(tableCheckInEmployee.rows({'search': 'applied'}).count());
        $('#total-record-not-check-in-employee').text(tableNotCheckInEmployee.rows({'search': 'applied'}).count());
        $('#total-record-bypass-check-in').text(tableByPassCheckInEmployee.rows({'search': 'applied'}).count());
    })
}

async function dataTableAllEmployeeManage(res) {
    let idTableAllEmployee = $('#table-all-employee'),
        fixed_left = 3,
        fixed_right = 2,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'employee_avatar',name: 'name', className: 'text-left'},
            {data: 'username', className: 'text-left'},
            {data: 'gender', className: 'text-left'},
            {data: 'phone', className: 'text-left'},
            {data: 'branch_name', className: 'text-left'},
            {data: 'action', className: 'text-center', width: '8%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    let option = [{
        'title': 'Thêm mới (F2)',
        'icon': 'fa fa-plus text-primary',
        'class': '',
        'function': 'openModalCreateEmployeeManage',
    }]
    tableAllEmployee = await DatatableTemplateNew(idTableAllEmployee, res.data[0].original.data, column, vh_of_table, fixed_left, fixed_right, option);
    $(document).on('input paste keyup keydown', 'input[type="search"]', function (){
        searchUpdateIndexDataTableEmployeeData(tableAllEmployee)
    })
}


async function searchUpdateIndexDataTableEmployeeData(datatable) {
    let index = 1;
    await datatable.rows({'search': 'applied'}).every(function () {
        let row = $(this.node())
        row.find('td:eq(0)').text(index)
        index++;
    })
}

function dataTotalEmployeeManage(data) {
    $('#total-record-bypass-check-in').text(data.total_bypass_check_in);
    $('#total-record-check-in-employee').text(data.total_check_in);
    $('#total-record-not-check-in-employee').text(data.total_not_check_in);
}
