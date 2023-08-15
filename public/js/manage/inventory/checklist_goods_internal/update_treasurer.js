let dataMaterialTableUpdateTreasurerChecklistGoodsInternalManage,
    checkSaveUpdateTreasurerChecklistGoodsInternalManage = 0, idEmployeeCreateChecklistGoodsInternal, idEmployeeUpdateChecklistGoodsInternal, branchInnerInventoryTypeTreasurer;
async function openUpdateTreasurerChecklistGoodsInternalManage(id) {
    $('#modal-update-treasurer-checklist-goods-internal-manage').modal('show');
    shortcut.remove('ESC');
    shortcut.add('F4', function () {
        saveModalUpdateTreasurerChecklistGoodsInternalManage();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateTreasurerChecklistGoodsInternalManage();
    });
    $(document).on('input', '.confirm-quantity', function () {
        let confirm = removeformatNumber($(this).val()),
            quantity = removeformatNumber($(this).parents('tr').find('td:eq(1)').text());
        if (Number($(this).val().replace(/[^0-9_]/g, "")) > 999999) {
            $(this).val(999999)
        }
        $(this).parents('tr').find('td:eq(3)').text(formatNumber(checkDecimal(confirm - quantity)));
    });
    dataUpdateTreasurerChecklistGoodsInternalManage(id);
}

async function dataUpdateTreasurerChecklistGoodsInternalManage(id) {
    let method = 'get',
        url = 'checklist-goods-internal-manage.data-update',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-update-treasurer-checklist-goods-internal-manage')
    ]);
    branchIdUpdateChecklistGoodsInternalManage = res.data[1].data.branch_id;
    idUpdateChecklistGoodsInternalManage = res.data[1].data.id;
    idEmployeeCreateChecklistGoodsInternal = res.data[1].data.employee.id;
    idEmployeeUpdateChecklistGoodsInternal = res.data[1].data.employee_edit.id;
    branchInnerInventoryTypeTreasurer = res.data[1].data.branch_inner_inventory_type;
    $('#branch-update-treasurer-checklist-goods-internal-manage').text(res.data[1].data.branch_name);
    $('#code-update-treasurer-checklist-goods-internal-manage').text(res.data[1].data.code);
    $('#inventory-update-treasurer-checklist-goods-internal-manage').text(res.data[1].data.inventory);
    $('#type-update-treasurer-checklist-goods-internal-manage').text(res.data[1].data.type === 1 ? 'Kiểm kê ngày' : 'Kiểm kê kỳ');
    $('#employee-create-update-treasurer-checklist-goods-internal-manage').text(res.data[1].data.employee_create.name);
    $('#employee-create-update-treasurer-checklist-goods-internal-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ res.data[1].data.employee_create.id +')');
    $('#create-update-treasurer-checklist-goods-internal-manage').text(res.data[1].data.created_at);
    $('#image-create-update-treasurer-checklist-goods-internal-manage').attr('src',res.data[1].data.employee.avatar);
    if(res.data[1].data.employee_edit.id) {
        $('#employee-update-update-treasurer-checklist-goods-internal-manage').text(res.data[1].data.employee_edit.name);
        $('#employee-update-update-treasurer-checklist-goods-internal-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ res.data[1].data.employee_edit.id +')');
        $('#image-employee-update-update-treasurer-checklist-goods-internal-manage').attr('src',res.data[1].data.employee_edit.avatar);
        $('#update-update-treasurer-checklist-goods-internal-manage').text(res.data[1].data.employee_update_at);
    }else {
        $('#employee-update-update-treasurer-checklist-goods-internal-manage').text('---');
    }
    $('#note-treasurer-checklist-goods-internal-manage').text(res.data[1].data.employee_create_note ? res.data[1].data.employee_create_note : '---');
    $('#note-update-treasurer-checklist-goods-internal-manage').val(res.data[1].data.employee_update_note);
    dataTableUpdateTreasurerCheckListGoodsInternalDayManage(res.data[0].original.data);
    countCharacterTextarea()
}

async function dataTableUpdateTreasurerCheckListGoodsInternalDayManage(data) {
    let tableMaterialUpdateTreasurerCheckListGoodsInternal = $('#table-material-update-treasurer-checklist-goods-internal-manage'),
        fixed_left = 1,
        fixed_right = 0,
        columns = [
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'confirm_quantity', name: 'confirm_quantity', className: 'text-center'},
            {data: 'deficiency_system', name: 'deficiency_system', className: 'text-center'},
            {data: 'confirm_note', name: 'confirm_note', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none', width: '5%'},
        ], option = [];
    dataMaterialTableUpdateTreasurerChecklistGoodsInternalManage = await DatatableTemplateNew(tableMaterialUpdateTreasurerCheckListGoodsInternal, data, columns, '50vh', fixed_left, fixed_right, option);
}

async function saveModalUpdateTreasurerChecklistGoodsInternalManage() {
    if (checkSaveUpdateTreasurerChecklistGoodsInternalManage === 1) return false;
    if (!checkValidateSave($('#modal-update-treasurer-checklist-goods-internal-manage'))) return false;
    let tableData = [];
    await dataMaterialTableUpdateTreasurerChecklistGoodsInternalManage.rows().every(function () {
        let row = $(this.node());
        tableData.push({
            "id" : row.find('td:eq(5)').find('button').data('material-id'),
            "quantity" : removeformatNumber(row.find('td:eq(2)').find('input').val()),
            "note": row.find('td:eq(4)').find('input').val(),
            "user_input_unit_type": branchInnerInventoryTypeTreasurer === 2 ? 2 : 1,
        })
    });
    checkSaveUpdateTreasurerChecklistGoodsInternalManage = 1;
    let method = 'post',
        url = 'checklist-goods-internal-manage.update',
        params = null,
        data = {
            creator_type : 2,
            details_material: tableData,
            id: idUpdateChecklistGoodsInternalManage,
            confirm_note: $('#note-update-treasurer-checklist-goods-internal-manage').val(),
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-update-treasurer-checklist-goods-internal-manage')
    ]);
    checkSaveUpdateTreasurerChecklistGoodsInternalManage = 0;
    if (res.data.status === 200) {
        let text = $('#success-update-data-to-server').text();
        SuccessNotify(text);
        loadData();
        closeModalUpdateTreasurerChecklistGoodsInternalManage();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message) {
            text = res.data.message;
        }
        WarningNotify(text);
    }
}

function closeModalUpdateTreasurerChecklistGoodsInternalManage() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    $('#modal-update-treasurer-checklist-goods-internal-manage').modal('hide');
    $('#branch-update-treasurer-checklist-goods-internal-manage').text('---');
    $('#code-update-treasurer-checklist-goods-internal-manage').text('---');
    $('#inventory-update-treasurer-checklist-goods-internal-manage').text('---');
    $('#employee-create-update-treasurer-checklist-goods-internal-manage').text('---');
    $('#create-update-treasurer-checklist-goods-internal-manage').text('---');
    $('#employee-update-update-treasurer-checklist-goods-internal-manage').text('---');
    $('#update-update-treasurer-checklist-goods-internal-manage').text('---');
    countCharacterTextarea()
}
