let checkSaveCreateEmployeeBonusPunish = 0;

function openModalCreateEmployeeBonusPunish() {

    $('#modal-create-employee-bonus-punish').modal('show');
    $('#branch-create-employee-bonus-punish, #employee-create-employee-bonus-punish, #proposer-create-employee-bonus-punish, #type-create-employee-bonus-punish').select2({
        dropdownParent: $('#modal-create-employee-bonus-punish')
    });
    $('#branch-create-employee-bonus-punish').val($('#select-branch-employee-bonus-punish').val()).trigger('change.select2');
    dateTimePickerMonthYearTemplate($('#time-create-employee-bonus-punish'));
    shortcut.add('ESC', function () {
        closeModalCreateEmployeeBonusPunish();
    });
    shortcut.add('F4', function () {
        saveModalCreateEmployeeBonusPunish();
    });
    $('#branch-create-employee-bonus-punish').unbind('select2:select').on('select2:select', function () {
        dataEmployeeCreateBonusPunish();
    });
    $('#modal-create-employee-bonus-punish select').on('change',function (){
        $('.btn-renew').removeClass('d-none');
    })
    $('#modal-create-employee-bonus-punish input, #modal-create-employee-bonus-punish textarea').on('input',function (){
        $('.btn-renew').removeClass('d-none');
    })
    $('#time-create-employee-bonus-punish').on('dp.change',function (){
        $('.btn-renew').removeClass('d-none');
    })
    // dataEmployeeCreateBonusPunish();
    dataEmployeeCreateBonusPunish()
}

async function dataEmployeeCreateBonusPunish() {
    let method = 'get',
        url = 'employee-bonus-punish.employee-working',
        branch = $('#select-branch-employee-bonus-punish').val(),
        params = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#proposer-create-holiday-employee-bonus-punish'),$('#proposer-create-employee-bonus-punish'), $('#employee-create-employee-bonus-punish'),
        $('#table-holiday-employee-bonus-punish')
    ]);
    console.log('wk',res)
    $('#proposer-create-employee-bonus-punish').html(res.data[0]);
    $('#employee-create-employee-bonus-punish').html(res.data[1]);
    $('#proposer-create-holiday-employee-bonus-punish').html(res.data[0]);
    tableEmployeeCreateHolidayBonusPunish(res.data[2].original.data);
    tableConvertEmployeeCreateHolidayBonusPunish([]);
}

async function saveModalCreateEmployeeBonusPunish() {
    if (checkSaveCreateEmployeeBonusPunish === 1) return false;
    if (!checkValidateSave($('#loading-modal-create-employee-bonus-punish'))) return false;
    let employee = $('#employee-create-employee-bonus-punish').val(),
        proposer = $('#proposer-create-employee-bonus-punish').val(),
        time = $('#time-create-employee-bonus-punish').val(),
        amount = removeformatNumber($('#amount-create-employee-bonus-punish').val()),
        type = $('#type-create-employee-bonus-punish').val(),
        punish = $('#type-create-employee-bonus-punish').find(':selected').data('punish'),
        note = $('#note-create-employee-bonus-punish').val(),
        branch = $('#select-branch-employee-bonus-punish').val();
    checkSaveCreateEmployeeBonusPunish = 1;
    let method = 'post',
        url = 'employee-bonus-punish.create',
        params = null,
        data = {
            branch: branch,
            employee: employee,
            proposer: proposer,
            time: time,
            amount: amount,
            note: note,
            type: type,
            punish: punish
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-employee-bonus-punish')]);
    checkSaveCreateEmployeeBonusPunish = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalCreateEmployeeBonusPunish();
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

function closeModalCreateEmployeeBonusPunish() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    $('#modal-create-employee-bonus-punish').modal('hide');
    resetModalCreateEmployeeBonusPunish();
}

function resetModalCreateEmployeeBonusPunish() {
    $('#branch-create-employee-bonus-punish, #employee-create-employee-bonus-punish, #proposer-create-employee-bonus-punish, #type-create-employee-bonus-punish').select2({
        dropdownParent: $('#modal-create-employee-bonus-punish')
    });
    $('#proposer-create-employee-bonus-punish').val(-1).trigger('change.select2');
    $('#employee-create-employee-bonus-punish').val(-1).trigger('change.select2');
    $('#modal-create-employee-bonus-punish textarea').val('');
    $('#modal-create-employee-bonus-punish select').find('option:first').trigger('change.select2');
    $('#type-create-employee-bonus-punish').val('1').trigger('change.select2');
    $('#note-create-employee-bonus-punish').val('');
    $('#amount-create-employee-bonus-punish').val('100');
    $('#time-create-employee-bonus-punish').val(moment(new Date).format('MM/YYYY'))
    $('.btn-renew').addClass('d-none');
    removeErrorInput($('#note-create-employee-bonus-punish, #modal-create-employee-bonus-punish select, #amount-create-employee-bonus-punish'))
    $('#modal-create-employee-bonus-punish .error').remove()
}



