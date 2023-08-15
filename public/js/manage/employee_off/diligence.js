function openModalDiligenceEmployeeManage(r) {
    $('#employee-name-diligence-employee-off-manage').text(r.data('name'));
    $('#modal-diligence-employee-off-manage').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalDiligenceEmployeeManage();
    });
    loadDataDiligence(r)
}

async function drawTableDiligenceEmployeeManage(data) {
    let id = $('#table-diligence-employee-off-manage'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'months', name: 'months', className: 'text-center'},
            {data: 'is_diligence', name: 'is_diligence', className: 'text-center'},
        ];
    await DatatableTemplateNew(id,data , column, vh_of_table, fixed_left, fixed_right,[]);
}

async function loadDataDiligence(r) {
    let method = 'get',
        url = 'employee-off-manage.diligence',
        params = {diligence: r.data('diligence')},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$('#table-employee-off-manage-by-month')]);
    await drawTableDiligenceEmployeeManage(res.data[0].original.data);
    $('#table-diligence-employee-off-manage_filter, #table-diligence-employee-off-manage_length, #table-diligence-employee-off-manage_info, #table-diligence-employee-off-manage_paginate').addClass('d-none');
}

function closeModalDiligenceEmployeeManage() {
    $('#modal-diligence-employee-off-manage').modal('hide');
    shortcut.remove('ESC');
}
