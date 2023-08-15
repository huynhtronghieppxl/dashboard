let dataMaterialTableUpdateChecklistGoodsInternalManage,
    branchIdUpdateChecklistGoodsInternalManage,
    checkSaveUpdateChecklistGoodsInternalManage = 0,
    idUpdateChecklistGoodsInternalManage,checkCancelChecklistGoodsInternalManage = 0,
    branchInnerInventoryType;

async function openUpdateChecklistGoodsInternalManage(id, type) {
    shortcut.remove('ESC');
    if (type === 1) {
        $('#modal-update-checklist-goods-internal-manage').modal('show');
        shortcut.remove('ESC');
        shortcut.add('F4', function () {
            saveModalUpdateChecklistGoodsInternalManage();
        });
        shortcut.add('ESC', function () {
            closeModalUpdateChecklistGoodsInternalManage();
        });
        $(document).on('input', '.confirm-quantity', function () {
            let confirm = removeformatNumber($(this).val()),
                // check = removeformatNumber($(this).parents('tr').find('td:eq(2)').text()),
                quantity = removeformatNumber($(this).parents('tr').find('td:eq(1)').text());
            // $(this).parents('tr').find('td:eq(5)').text(formatNumber(checkDecimal(confirm - check)));
            $(this).parents('tr').find('td:eq(6)').text(formatNumber(checkDecimal(confirm - quantity)));
        });
        dataUpdateChecklistGoodsInternalManage(id);
    } else {
        openUpdateTreasurerChecklistGoodsInternalManage(id);
    }
}

async function dataUpdateChecklistGoodsInternalManage(id) {
    let method = 'get',
        url = 'checklist-goods-internal-manage.data-update',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-material-update-checklist-goods-internal-manage_wrapper'), $('#box-right-info-checklist-goods-internal-manage-update')
    ]);
    branchIdUpdateChecklistGoodsInternalManage = res.data[1].data.branch_id;
    idUpdateChecklistGoodsInternalManage = res.data[1].data.id;
    branchInnerInventoryType = res.data[1].data.branch_inner_inventory_type;
    $('#branch-update-checklist-goods-internal-manage').text(res.data[1].data.branch_name);
    $('#code-update-checklist-goods-internal-manage').text(res.data[1].data.code);
    $('#type-update-checklist-goods-internal-manage').text(res.data[1].data.type === 1 ? 'Kiểm kê ngày' : 'Kiểm kê kỳ');
    $('#inventory-update-checklist-goods-internal-manage').text(res.data[1].data.inventory);
    $('#employee-create-update-checklist-goods-internal-manage').text(res.data[1].data.employee_create.name);
    $('#employee-create-update-checklist-goods-internal-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ res.data[1].data.employee_create.id +')');
    $('#create-update-checklist-goods-internal-manage').text(res.data[1].data.created_at);
    if(res.data[1].data.employee_edit.id) {
        $('#employee-update-update-checklist-goods-internal-manage').text(res.data[1].data.employee_edit.name);
        $('#employee-update-update-checklist-goods-internal-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ res.data[1].data.employee_edit.id +')');
        $('#update-update-checklist-goods-internal-manage').text(res.data[1].data.employee_update_at);
    }else {
        $('#employee-update-update-checklist-goods-internal-manage').text('---');
    }
    $('#check-note-update-checklist-goods-internal-manage').text(res.data[1].data.employee_create_note ? res.data[1].data.employee_create_note : '---');
    $('#confirm-note-update-checklist-goods-internal-manage').val(res.data[1].data.employee_update_note);
    dataTableCreateCheckListGoodsInternalDayManage(res.data[0].original.data);
}

async function dataTableCreateCheckListGoodsInternalDayManage(data) {
    let tableMaterialUpdateCheckListGoodsInternalManage = $('#table-material-update-checklist-goods-internal-manage'),
        fixed_left = 1,
        fixed_right = 0,
        columns = [
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'check_quantity', name: 'system_last_quantity', className: 'text-center'},
            // {data: 'check_note', name: 'check_note', className: 'text-center'},
            {data: 'confirm_quantity', name: 'confirm_quantity', className: 'text-center'},
            {data: 'confirm_note', name: 'confirm_note', className: 'text-center'},
            {data: 'deficiency_treasurer', name: 'deficiency_treasurer', className: 'text-center'},
            {data: 'deficiency_system', name: 'deficiency_system', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ], option = [];
    dataMaterialTableUpdateChecklistGoodsInternalManage = await DatatableTemplateNew(tableMaterialUpdateCheckListGoodsInternalManage, data, columns, '50vh', fixed_left, fixed_right, option);
}

async function saveModalUpdateChecklistGoodsInternalManage() {
    if (checkSaveUpdateChecklistGoodsInternalManage === 1) return false;
    if (!checkValidateSave($('#modal-update-checklist-goods-internal-manage'))) return false;
    let updateData = [];
    await dataMaterialTableUpdateChecklistGoodsInternalManage.rows().every(function () {
        let row = $(this.node());
        updateData.push({
            "id" : row.find('button').data('material-id'),
            "quantity" : removeformatNumber(row.find('td:eq(3)').find('input').val()),
            "note": row.find('td:eq(4)').find('input').val(),
            "user_input_unit_type": row.find('td:eq(7)').find('button').data('id') === 2 ? 2 : 1,
        });
    });
    checkSaveUpdateChecklistGoodsInternalManage = 1;
    let method = 'post',
        url = 'checklist-goods-internal-manage.update',
        params = null,
        data = {
            creator_type : 2,
            details_material: updateData,
            id: idUpdateChecklistGoodsInternalManage,
            confirm_note: $('#confirm-note-update-checklist-goods-internal-manage').val(),
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-update-checklist-goods-internal-manage')
    ]);
    checkSaveUpdateChecklistGoodsInternalManage = 0;
    if (res.data.status === 200) {
        let text = $('#success-update-data-to-server').text();
        SuccessNotify(text);
        loadData();
        closeModalUpdateChecklistGoodsInternalManage();
    } else if (res.data.status !== 200) {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        WarningNotify(text);
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        WarningNotify(text);
    }
}

function cancelChecklistGoodsInternalManage() {
    if (checkCancelChecklistGoodsInternalManage === 1) return false;
    let title = 'Huỷ phiếu kiểm kê',
        content = '',
        icon = 'warning';
    sweetAlertInputComponent(title, 'id-cancel-confirm-checklist-internal', content, icon).then(async (result) => {
        if (result.value) {
            checkCancelChecklistGoodsInternalManage = 1;
            let method = 'post',
                url = 'checklist-goods-internal-manage.cancel',
                params = null,
                data = {id: idUpdateChecklistGoodsInternalManage, reason: result.value, status: 3, is_export_inventory_next_month: 0};
            let res = await axiosTemplate(method, url, params, data, [
                $('#loading-update-checklist-goods-internal-manage')
            ]);
            checkCancelChecklistGoodsInternalManage = 0;
            let text = $('#success-cancel-data-to-server').text();
            switch (res.data.status){
                case 200:
                    SuccessNotify(text);
                    closeModalUpdateChecklistGoodsInternalManage();
                    closeModalUpdateTreasurerChecklistGoodsInternalManage();
                    loadData();
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if (data.data.message !== null) {
                        text = data.data.message;
                    }
                    ErrorNotify(text);
                    break;
                default:
                    text = $('#error-post-data-to-server').text();
                    if (data.data.message !== null) {
                        text = data.data.message;
                    }
                    WarningNotify(text);
            }
        }
    })
}

function closeModalUpdateChecklistGoodsInternalManage() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    $('#modal-update-checklist-goods-internal-manage').modal('hide');
    $('#branch-update-checklist-goods-internal-manage').text('---');
    $('#code-update-checklist-goods-internal-manage').text('---');
    $('#inventory-update-checklist-goods-internal-manage').text('---');
    $('#employee-create-update-checklist-goods-internal-manage').text('---');
    $('#create-update-checklist-goods-internal-manage').text('---');
    $('#employee-update-update-checklist-goods-internal-manage').text('---');
    $('#update-update-checklist-goods-internal-manage').text('---');
    $('#confirm-note-update-checklist-goods-internal-manage').text('');
    countCharacterTextarea();
}
