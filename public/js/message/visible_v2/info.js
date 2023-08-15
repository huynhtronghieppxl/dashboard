let idInfoEmployee;
async function openModalInfoEmployeeManage(id) {
    idInfoEmployee = id
    $('#modal-info-employee-manage').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalInfoEmployeeManage();
    });
    $('.reset-data-info-employee-manage').html('---');
    await dataInfoEmployeeManage(id);
}

async function dataInfoEmployeeManage(id) {
    let method = 'get',
        url = 'employee-manage.info',
        params = {
            id: id,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-info-employee-manage'),
    ]);
    $('#name-info-employee-manage').text(res.data[0].name);
    $('#birthday-info-employee-manage').text(res.data[0].birthday);
    $('#gender-info-employee-manage').text(res.data[0].gender);
    $('#phone-info-employee-manage').text(res.data[0].phone);
    $('#branch-info-employee-manage').text(res.data[0].branch);
    $('#role-info-employee-manage').text(res.data[0].role);
    $('#avatar-info-employee-manage').attr('src', res.data[0].avatar);
    $('#status-info-employee-manage').html(res.data[0].status);
    (res.data[0].employee_role_type === 2) ? $('#show-rank-info-employee-manage').removeClass('d-none') : $('#show-rank-info-employee-manage').addClass('d-none');
}
function closeModalInfoEmployeeManage() {
    $('#modal-info-employee-manage').modal('hide');
    reloadModalInfoEmployeeManage();
}

function reloadModalInfoEmployeeManage() {
    $('#avatar-info-employee-manage').attr('src', '');
}
