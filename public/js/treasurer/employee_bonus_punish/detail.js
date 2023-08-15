async function openModalDetailEmployeeBonusPunish(id, branch) {
    $('#modal-detail-employee-bonus-punish').modal('show');
    $('#modal-detail-employee-bonus-punish')
    let method = 'get',
        url = 'employee-bonus-punish.detail',
        params = {id:id, branch:branch},
        data = null;
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalDetailEmployeeBonusPunish();
    });
    let res = await axiosTemplate(method, url, params, data, [$('#modal-detail-employee-bonus-punish .modal-body')]);
    console.log('122', res)
    $('#employee-detail-employee-bonus-punish').text(res.data.data.employee.name);
    $('#role-detail-employee-bonus-punish').text(res.data.data.employee.role_name);
    // $('#assigner-detail-employee-bonus-punish').text(res.data.data.assigner.name);
    $('#proposer-detail-employee-bonus-punish').text(res.data.data.proposer.name);
    $('#proposer-avatar-detail-employee-bonus-punish').attr('src', res.data.data.proposer.avatar);
    $('#create-employee-name-detail-employee-bonus-punish').text(res.data.data.assigner.name);
    $('#create-employee-avatar-detail-employee-bonus-punish').attr('src', res.data.data.assigner.avatar);
    $('#employee-approved-name-detail-employee-bonus-punish').text(res.data.data.employee_approve.name);
    $('#employee-approved-avatar-detail-employee-bonus-punish').attr('src', res.data.data.employee_approve.avatar);
    $('#employee-cancel-name-detail-employee-bonus-punish').text(res.data.data.employee_cancel.name);
    $('#employee-cancel-avatar-detail-employee-bonus-punish').attr('src', res.data.data.employee_cancel.avatar);
    $('#update-employee-name-detail-employee-bonus-punish').text(res.data.data.employee_edit.name)
    $('#update-employee-avatar-detail-employee-bonus-punish').attr('src', res.data.data.employee_edit.avatar)

    switch (res.data.data.status){
        case 2:
            $('#tab-waiting-approved-employee-bonus-punish').addClass('d-none')
            $('#tab-approved-employee-bonus-punish').removeClass('d-none')
            $('#tab-cancel-employee-bonus-punish').addClass('d-none')
            $('#date-approved-detail-employee-bonus-punish-div').removeClass('d-none')
            $('#date-cancel-detail-employee-bonus-punish-div').addClass('d-none')
            $('#date-update-detail-employee-bonus-punish-div').addClass('d-none')

            break;
        case 3:
            $('#tab-waiting-approved-employee-bonus-punish').addClass('d-none')
            $('#tab-approved-employee-bonus-punish').addClass('d-none')
            $('#tab-cancel-employee-bonus-punish').removeClass('d-none')
            $('#date-cancel-detail-employee-bonus-punish-div').removeClass('d-none')
            $('#date-approved-detail-employee-bonus-punish-div').addClass('d-none')
            $('#date-update-detail-employee-bonus-punish-div').addClass('d-none')

            break;
        default:
            $('#tab-approved-employee-bonus-punish').addClass('d-none')
            $('#tab-cancel-employee-bonus-punish').addClass('d-none')
            $('#tab-waiting-approved-employee-bonus-punish').removeClass('d-none')
            $('#date-cancel-detail-employee-bonus-punish-div').addClass('d-none')
            $('#date-approved-detail-employee-bonus-punish-div').addClass('d-none')
            $('#date-update-detail-employee-bonus-punish-div').removeClass('d-none')
    }
    res.data.data.status === 3 ? $('#cancel-reason-detail-employee-bonus-punish-div').removeClass('d-none') : $('#cancel-reason-detail-employee-bonus-punish-div').addClass('d-none')
    $('#type-detail-employee-bonus-punish').text(res.data.data.type_name);
    $('#time-detail-employee-bonus-punish').text(res.data.data.time);
    $('#amount-detail-employee-bonus-punish').text(res.data.data.amount);
    $('#note-detail-employee-bonus-punish').text(res.data.data.note === '' ? '---' : res.data.data.note);
    $('#cancel-reason-detail-employee-bonus-punish').text(res.data.data.reason === '' ? '---' : res.data.data.reason);
    $('#status-detail-employee-bonus-punish').html(res.data.data.status_name);
    $('#branch-detail-employee-bonus-punish').html(res.data.data.branch.name);
    $('#confirm-employee-name-detail-employee-bonus-punish').text(res.data.data.employee_confirm.name);
    $('#confirm-employee-avatar-detail-employee-bonus-punish').attr('src', res.data.data.employee_confirm.avatar);
    $('#date-create-detail-employee-bonus-punish').text(res.data.data.created_at);
    $('#date-update-detail-employee-bonus-punish').text(res.data.data.updated_at);
    $('#date-approved-detail-employee-bonus-punish').text(res.data.data.updated_at);
    $('#date-cancel-detail-employee-bonus-punish').text(res.data.data.updated_at);
}

function closeModalDetailEmployeeBonusPunish() {
    $('#modal-detail-employee-bonus-punish').modal('hide');
    resetModalDetailEmployeeBonusPunish();
}
 function resetModalDetailEmployeeBonusPunish(){
     $('#employee-detail-employee-bonus-punish').text('---');
     $('#assigner-detail-employee-bonus-punish').text('---');
     $('#proposer-detail-employee-bonus-punish').text('---');
     $('#amount-detail-employee-bonus-punish').text('0');
     $('#branch-detail-employee-bonus-punish').text('---');
     $('#type-detail-employee-bonus-punish').text('---');
     $('#role-detail-employee-bonus-punish').text('---');
     $('#time-detail-employee-bonus-punish').val(moment().format('DD/MM/YYYY'));
     $('#note-detail-employee-bonus-punish').text('---');
     $('#create-employee-name-detail-employee-bonus-punish').text('---');
     $('#update-employee-name-detail-employee-bonus-punish').text('---');
     $('#confirm-employee-name-detail-employee-bonus-punish').text('---');
     $('#date-create-detail-employee-bonus-punish').val(moment().format('DD/MM/YYYY'));
     $('#date-update-detail-employee-bonus-punish').val(moment().format('DD/MM/YYYY'));
     $('#date-confirm-detail-employee-bonus-punish').val(moment().format('DD/MM/YYYY'));
 }
