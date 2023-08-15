$(document ).ready(function() {
    dateTimePickerTemplate($('#birthday-emp'));
    dateTimePickerTemplate($('#birthday-emp-update'));
    loadData();
    $('img').on('load', function(){
        console.log('loading....')
    })
});

async function loadData() {
    let method = 'get',
        url = 'employee-manage.data',
        restaurant_brand_id = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        params = {branch: branch,restaurant_brand_id:restaurant_brand_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data);

    if (res.data.length > 4) {
        dataTableEmployeeManage(res);
        dataTotalEmployeeManage(res.data[6]);
    } else {
        dataTableNotTMSEmployeeManage(res);
        dataTotalNotTMSEmployeeManage(res.data[2]);
    }
}

function dataTableEmployeeManage(res) {
    let id1 = $('#tab1-table-employee'),
        id2 = $('#tab2-table-employee'),
        id3 = $('#tab3-table-employee'),
        id5 = $('#tab5-table-employee'),
        id6 = $('#tab6-table-employee'),
        scroll_Y = '60vh',
        fixed_left = 3,
        fixed_right = 1,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'employee_avatar', className: 'text-center', width: '5%'},
            {data: 'name', className: 'text-center'},
            {data: 'username', className: 'text-center'},
            {data: 'gender', className: 'text-center'},
            {data: 'phone', className: 'text-center'},
            {data: 'branch_name', className: 'text-center'},
            {data: 'role_name', className: 'text-center'},
            {data: 'employee_rank_name', className: 'text-center'},
            {data: 'status', className: 'text-center'},
            {data: 'action', className: 'text-center', width: '8%'},
        ];
    DatatableTemplateNew(id1, res.data[0].original.data, column, scroll_Y, fixed_left, fixed_right);
    DatatableTemplateNew(id2, res.data[1].original.data, column, scroll_Y, fixed_left, fixed_right);
    DatatableTemplateNew(id3, res.data[2].original.data, column, scroll_Y, fixed_left, fixed_right);
    DatatableTemplateNew(id5, res.data[4].original.data, column, scroll_Y, fixed_left, fixed_right);
    DatatableTemplateNew(id6, res.data[5].original.data, column, scroll_Y, fixed_left, fixed_right);

}

function dataTotalEmployeeManage(data) {
    $('#total-record-check-in-employee').text(data.total_check_in);
    $('#total-record-not-check-in-employee').text(data.total_not_check_in);
    $('#total-record-employee-off').text(data.total_off);
    $('#total-record-employee-quit-job').text(data.total_quit_job);
    $('#total-record-bypass-employee').text(data.total_bypass);
    $('#total-record-never-check-in-employee').text(data.total_never_check_in);
}

function dataTableNotTMSEmployeeManage(data) {
    let scroll_Y = vh_of_table,
        fixed_left = 3,
        fixed_right = 1,
        id1 = $('#tab1-not-tms-table-employee'),
        id2 = $('#tab2-not-tms-table-employee'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'avatar', className: 'text-center'},
            {data: 'name', className: 'text-center'},
            {data: 'description', className: 'text-center'},
            {data: 'action', className: 'text-center', width: '5%'},
        ];
    DatatableTemplateNew(id1, data.data[0].original.data, column, scroll_Y, fixed_left, fixed_right);
    DatatableTemplateNew(id2, data.data[1].original.data, column, scroll_Y, fixed_left, fixed_right);
}
