let checkSaveCreatePeriodChecklistGoodsManage, tableCreatePeriodChecklistGoodsInternalManage,
    checkHaveChecklistGoodsInternalManage = 0;

async function openCreatePeriodCheckListGoodsInternalManage() {
    $('#modal-create-period-checklist-goods-internal-manage').modal('show');
    checkHaveChecklistGoodsInternalManage = 0;
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F4', function () {
        saveModalCreatePeriodCheckListGoodsInternalManage();
    });
    shortcut.add('ESC', function () {
        closeModalCreatePeriodCheckListGoodsInternalManage();
    });
    checkSaveCreatePeriodChecklistGoodsManage = 0;
    $('#select-inventory-create-period-checklist-goods-internal-manage').select2({
        dropdownParent: $('#modal-create-period-checklist-goods-internal-manage'),
    });
    $('#select-inventory-create-period-checklist-goods-internal-manage').unbind('select2:select').on('select2:select', async function () {
        await updateTimeCreatePeriodCheckListGoodsInternalManage();
        dataMaterialCreatePeriodCheckListGoodsInternalManage();
    });
    $(document).on('input paste', '#table-material-create-period-checklist-goods-internal-manage .confirm-quantity', function () {
        let confirm = removeformatNumber($(this).val()),
            quantity = removeformatNumber($(this).parents('tr').find('td:eq(1)').text());
        $(this).parents('tr').find('td:eq(3)').text(formatNumber(checkDecimal(confirm - quantity)));
    });

    $('#modal-create-period-checklist-goods-internal-manage select').on('change', function () {
        $('#modal-create-period-checklist-goods-internal-manage .btn-renew').removeClass('d-none')
    });

    $(document).on('input', '#modal-create-period-checklist-goods-internal-manage input', function () {
        $('#modal-create-period-checklist-goods-internal-manage .btn-renew').removeClass('d-none')
    });

    $('#modal-create-period-checklist-goods-internal-manage textarea').on('input', function () {
        $('#modal-create-period-checklist-goods-internal-manage .btn-renew').removeClass('d-none')
    });
    await updateTimeCreatePeriodCheckListGoodsInternalManage();
    dataMaterialCreatePeriodCheckListGoodsInternalManage();
}

async function updateTimeCreatePeriodCheckListGoodsInternalManage() {
    let branch = $('#select-branch-checklist-goods-internal').val(),
        inventory = $('#select-inventory-create-period-checklist-goods-internal-manage').val(),
        type = 2, //period
        method = 'get',
        url = ' checklist-goods-internal-manage.final',
        params = {
            branch: branch,
            inventory: inventory,
            type: type,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#boxlist-create-period-checklist-goods-internal-manage')]);
    $('#checklist-date-create-period-checklist-goods-internal-manage').text(res.data[0]);
    if(res.data[1].data.id && (res.data[1].data.status === 0 || res.data[1].data.status === 1)) {
        checkHaveChecklistGoodsInternalManage = 1;
    }
}

async function dataMaterialCreatePeriodCheckListGoodsInternalManage() {
    if (checkHaveChecklistGoodsInternalManage === 1) {
        $('#modal-create-period-checklist-goods-internal-manage h5.sub-title').addClass('d-none');
        $('#modal-create-period-checklist-goods-internal-manage .modal-dialog').removeClass('modal-xl');
        $('#modal-create-period-checklist-goods-internal-manage .modal-dialog').addClass('modal-md');
        $('#modal-create-period-checklist-goods-internal-manage .modal-body').removeClass('background-body-color');
        $('#modal-create-period-checklist-goods-internal-manage .modal-body .edit-flex-auto-fill:eq(0)').addClass('d-none');
        $('#modal-create-period-checklist-goods-internal-manage .modal-body .edit-flex-auto-fill:eq(1)').removeClass('col-lg-4');
        $('#modal-create-period-checklist-goods-internal-manage .modal-body .edit-flex-auto-fill:eq(1)').addClass('col-lg-12');
        // $('#modal-create-period-checklist-goods-internal-manage .modal-body .edit-flex-auto-fill:eq(1) .flex-sub').removeClass('card');
        $('#modal-create-period-checklist-goods-internal-manage .modal-footer .btn-grd-primary').addClass('d-none');
        checkHaveChecklistGoodsInternalManage = 0;
        sweetAlertNextComponent(`${$('#select-inventory-create-period-checklist-goods-internal-manage option:selected').text()} đã kiểm kê !`, 'Kho bạn chọn đã kiểm kê hoặc phiếu chưa hoàn tất, hãy hoàn tất phiếu trước khi tạo phiếu mới!', 'warning');
    } else {
        $('#modal-create-period-checklist-goods-internal-manage h5.sub-title').removeClass('d-none');
        $('#modal-create-period-checklist-goods-internal-manage .modal-dialog').addClass('modal-xl');
        $('#modal-create-period-checklist-goods-internal-manage .modal-dialog').removeClass('modal-md');
        $('#modal-create-period-checklist-goods-internal-manage .modal-body').addClass('background-body-color');
        $('#modal-create-period-checklist-goods-internal-manage .modal-body .edit-flex-auto-fill:eq(0)').removeClass('d-none');
        $('#modal-create-period-checklist-goods-internal-manage .modal-body .edit-flex-auto-fill:eq(1)').addClass('col-lg-4');
        $('#modal-create-period-checklist-goods-internal-manage .modal-body .edit-flex-auto-fill:eq(1)').removeClass('col-lg-12');
        $('#modal-create-period-checklist-goods-internal-manage .modal-body .edit-flex-auto-fill:eq(1) .flex-sub').addClass('card');
        $('#modal-create-period-checklist-goods-internal-manage .modal-footer .btn-grd-primary').removeClass('d-none');
        let branch = $('#select-branch-checklist-goods-internal').val(),
            type = 2, //period
            inventory = $('#select-inventory-create-period-checklist-goods-internal-manage').val(),
            time = $('#date-create-period-checklist-goods-internal-manage').text(),
            method = 'get',
            url = 'checklist-goods-internal-manage.data-material',
            params = {
                id: 0,
                branch: branch,
                type: type,
                inventory: inventory,
                time: time,
            },
            data = null;
        let res = await axiosTemplate(method, url, params, data, [
            $('#table-material-create-period-checklist-goods-internal-manage')
        ]);
        dataTableCreatePeriodChecklistGoodsInternalManage(res.data[0].original.data);
    }
}

async function dataTableCreatePeriodChecklistGoodsInternalManage(data) {
    let tableMaterialCreatePeriodCheckListGoodsInternalManage = $('#table-material-create-period-checklist-goods-internal-manage'),
        scroll_Y = '50vh',
        fixed_left = 2,
        fixed_right = 1,
        columns = [
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'confirm_quantity', name: 'confirm_quantity', className: 'text-center'},
            {data: 'deficiency_system', name: 'deficiency_system', className: 'text-center'},
            {data: 'confirm_note', name: 'confirm_note', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ], option = [];
    tableCreatePeriodChecklistGoodsInternalManage = await DatatableTemplateNew(tableMaterialCreatePeriodCheckListGoodsInternalManage, data, columns, scroll_Y, fixed_left, fixed_right, option);
    checkHaveChecklistGoodsInternalManage = 0;
}

async function saveModalCreatePeriodCheckListGoodsInternalManage() {
    if (checkSaveCreatePeriodChecklistGoodsManage === 1) return false;
    if (!checkValidateSave($('#modal-create-period-checklist-goods-internal-manage'))) return false;
    let branch = $('#select-branch-checklist-goods-internal').val(),
        time = $('#date-create-period-checklist-goods-internal-manage').text(),
        inventory = $('#select-inventory-create-period-checklist-goods-internal-manage').val(),
        note = $('#note-create-period-checklist-goods-internal-manage').val(),
        type = 2, //period
        materials = [];
    await tableCreatePeriodChecklistGoodsInternalManage.rows().every(function () {
        let row = $(this.node());
        console.log(row.find('td:eq(0)').find('.unit-material').data('cate-type-parent'))
        materials.push({
            'id': row.find('td:eq(5)').find('button').data('id'),
            'note': row.find('td:eq(4)').find('input').val(),
            'quantity': removeformatNumber(row.find('td:eq(2)').find('input').val()),
            "user_input_unit_type": row.find('td:eq(0)').find('.unit-material').data('cate-type-parent') === 2 ? 2 : 1
        });
    });
    if (materials.length === 0) {
        WarningNotify('Vui lòng chọn nguyên liệu');
        return false;
    }
    checkSaveCreatePeriodChecklistGoodsManage = 1;
    let method = 'post',
        url = 'checklist-goods-internal-manage.create',
        params = null,
        data = {
            inventory: inventory,
            note: note,
            type: type,
            branch: branch,
            time: time,
            materials: materials,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-period-checklist-goods-internal-manage')]);
    checkSaveCreatePeriodChecklistGoodsManage = 0;
    if (res.data.status === 200) {
        let text = $('#success-create-data-to-server').text();
        SuccessNotify(text);
        loadData();
        closeModalCreatePeriodCheckListGoodsInternalManage();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message) {
            text = res.data.message;
        }
        WarningNotify(text);
    }
}

function closeModalCreatePeriodCheckListGoodsInternalManage() {
    $('#modal-create-period-checklist-goods-internal-manage').modal('hide');
    $('#note-create-period-checklist-goods-internal-manage').val('');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    $('#checklist-date-create-period-checklist-goods-internal-manage').text('---');
    $('#select-inventory-create-period-checklist-goods-internal-manage').val(1).trigger('change.select2');
    $('#note-create-period-checklist-goods-internal-manage').val('');
    $('#modal-create-period-checklist-goods-internal-manage .btn-renew').addClass('d-none');
    checkHaveChecklistGoodsInternalManage = 0;
    removeAllValidate();
    countCharacterTextarea();
}

function resetModalCreatePeriodCheckListGoodsInternalManage() {
    $('#select-inventory-create-period-checklist-goods-internal-manage').val(1).trigger('change.select2');
    updateTimeCreatePeriodCheckListGoodsInternalManage();
    $('#modal-create-period-checklist-goods-internal-manage .btn-renew').addClass('d-none');
    checkHaveChecklistGoodsInternalManage = 0;
    dataMaterialCreatePeriodCheckListGoodsInternalManage();
}

