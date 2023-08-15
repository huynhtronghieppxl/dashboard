let checksaveUpdateEmployeeBonusPunish = 0,
    idUpdateEmployeeBonusPunish = null,
    branchUpdateEmployeeBonusPunish = null,
    timeUpdateEmployeeBonusPunish = null,
    employeeUpdateEmployeeBonusPunish = null,
    proposerUpdateEmployeeBonusPunish = null;
function openModalUpdateEmployeeBonusPunish(id, branch) {
    $('#modal-update-employee-bonus-punish').modal('show');
    $('#type-update-employee-bonus-punish').select2({
        dropdownParent: $('#modal-update-employee-bonus-punish')
    });
    shortcut.add('ESC', function () {
        closeModalUpdateEmployeeBonusPunish();
    });
    shortcut.add('F4', function () {
        saveModalUpdateEmployeeBonusPunish();
    });
    $('#amount-update-employee-bonus-punish').on('input', function () {
        if (removeformatNumber($(this).val()) < 0) {
            ErrorNotify('Tiền thưởng phạt không được nhỏ hơn 0 !');
            $(this).val(0);
            $(this).select();
        }
    });
    idUpdateEmployeeBonusPunish = id;
    dataUpdateBonusPunish(id, branch);
}

async function dataUpdateBonusPunish(id, branch) {
    let method = 'get',
        url = 'employee-bonus-punish.data-update',
        params = {id: id, branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data , [$('#loading-modal-update-employee-bonus-punish')]);
    branchUpdateEmployeeBonusPunish = res.data.data.branch.id;
    timeUpdateEmployeeBonusPunish = res.data.data.time;
    employeeUpdateEmployeeBonusPunish = res.data.data.employee.id;
    proposerUpdateEmployeeBonusPunish = res.data.data.proposer.id;
    $('#branch-update-employee-bonus-punish').text(res.data.data.branch.name);
    $('#employee-update-employee-bonus-punish').text(res.data.data.employee.name);
    $('#proposer-update-employee-bonus-punish').text(res.data.data.proposer.name);
    $('#time-update-employee-bonus-punish').text(res.data.data.time);
    $('#amount-update-employee-bonus-punish').val(res.data.data.amount);
    $('#note-update-employee-bonus-punish').val(res.data.data.note);
    if (res.data.type_select === "0") {
        await $('#type-update-employee-bonus-punish').html($('#data-select-reward-update').html());
    } else {
        await $('#type-update-employee-bonus-punish').html($('#data-select-punish-update').html());
    }
    $('#type-update-employee-bonus-punish').val(res.data.data.type).trigger('change.select2');
}

async function saveModalUpdateEmployeeBonusPunish() {
    if (checksaveUpdateEmployeeBonusPunish === 1) return false;
    if(!checkValidateSave($('#modal-update-employee-bonus-punish'))) return false;
    let amount = removeformatNumber($('#amount-update-employee-bonus-punish').val()),
        type = $('#type-update-employee-bonus-punish').val(),
        punish = $('#type-update-employee-bonus-punish :selected').data('punish'),
        note = $('#note-update-employee-bonus-punish').val();
    if (type === '00' || type === '01') type = '0';
    let method = 'post',
        url = 'employee-bonus-punish.update',
        params = null,
        data = {
            id: idUpdateEmployeeBonusPunish,
            branch: branchUpdateEmployeeBonusPunish,
            employee: employeeUpdateEmployeeBonusPunish,
            proposer: proposerUpdateEmployeeBonusPunish,
            time: timeUpdateEmployeeBonusPunish,
            amount: amount,
            note: note,
            type: type,
            punish: punish
        };
    checksaveUpdateEmployeeBonusPunish = 1;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-employee-bonus-punish')]);
    checksaveUpdateEmployeeBonusPunish = 0;
    let text = $('#success-update-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalUpdateEmployeeBonusPunish();
            loadData();
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) text = res.data.message;
            ErrorNotify(text);
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) text = res.data.message;
            WarningNotify(text);
    }
}

function closeModalUpdateEmployeeBonusPunish() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    $('#modal-update-employee-bonus-punish').modal('hide');
    resetModalUpdateEmployeeBonusPunish();
    removeAllValidate();
}
function resetModalUpdateEmployeeBonusPunish(){
    $('#time-update-employee-bonus-punish').val(moment().format('DD/MM/YYYY'));
    $('#branch-update-employee-bonus-punish').text('---');
    $('#proposer-update-employee-bonus-punish').text('---');
    $('#employee-update-employee-bonus-punish').text('---');
    $('#amount-update-employee-bonus-punish').val('100');
    $('#type-update-employee-bonus-punish').val('1').trigger('change.select2');
    $('#note-update-employee-bonus-punish').val('');
}
