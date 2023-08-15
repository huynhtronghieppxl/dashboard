let checkSaveConfirmChecklistGoodsManage,
    idConfirmChecklistGoodsManage,
    branchConfirmChecklistGoodsManage,
    tableConfirmChecklistGoodsManage,
    materialCategoryTypeParentId;

function openConfirmCheckListGoodsManage(r) {
    $('#modal-confirm-checklist-goods-manage').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalConfirmCheckListGoodsManage();
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalConfirmCheckListGoodsManage();
        });
    })
    checkSaveConfirmChecklistGoodsManage = 0;
    idConfirmChecklistGoodsManage = r.data('id');
    branchConfirmChecklistGoodsManage = r.data('branch-id');
    $(document).on('input paste', '#table-material-confirm-checklist-goods-manage .quantity', function () {
        let confirm = removeformatNumber($(this).val()),
            system = removeformatNumber($(this).parents('tr').find('td:eq(2)').text());
        $(this).parents('tr').find('td:eq(4)').text(formatNumber(checkDecimal(confirm - system)));
    });
    $(document).on('focus', 'input', function () {
        $(this).select();
    });
    dataConfirmCheckListGoodsManage(r.data('id'), r);
}

async function dataConfirmCheckListGoodsManage(id, r) {
    let method = 'get',
        url = 'checklist-goods-manage.detail',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#box-list-zero-confirm-checklist-goods-manage')
    ]);
    dataTableConfirmCheckListGoodsManage(res.data[1].original.data);
    materialCategoryTypeParentId = res.data[0].material_category_type_parent_id;
    $('#status-confirm-checklist-goods-manage').html(res.data[0].status_label);
    $('#branch-confirm-checklist-goods-manage').text(res.data[0].branch_name);
    $('#code-confirm-checklist-goods-manage').text(res.data[0].code);
    $('#inventory-confirm-checklist-goods-manage').text(res.data[0].inventory);
    $('#time-confirm-checklist-goods-manage').text(res.data[0].time);

    $('#employee-create-confirm-checklist-goods-manage').text(r.parents('tr').find('td:eq(2)').find('.title-name-new-table span').text());
    $('#time-create-confirm-checklist-goods-manage').text(res.data[0].employee_create_at);
    $('#image-employee-create-confirm-checklist-goods-manage').text(r.parents('tr').find('td:eq(2)').find('img').data('src'));
    $('#employee-create-confirm-checklist-goods-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ res.data[0].employee_create_id +')');


    if(res.data[0].employee_update_id) {
        $('#employee-update-confirm-checklist-goods-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ res.data[0].employee_update_id +')');
        $('#image-employee-update-confirm-checklist-goods-manage').attr('src','http://172.16.10.118:7080/short/' + r.data('employee_update_avartar'));
        $('#employee-update-confirm-checklist-goods-manage').text(r.data('employee-update-name'));
        $('#time-update-confirm-checklist-goods-manage').text(r.data('employee-update-at'));
    }else {
        $('#employee-update-confirm-checklist-goods-manage').text('---');
    }
    $('#note-confirm-checklist-goods-manage').val(res.data[0].employee_update_id ? res.data[0].employee_update_note : res.data[0].employee_create_note);
    countCharacterTextarea()
}

async function dataMaterialConfirmCheckListGoodsManage(r) {
    let method = 'get',
        url = 'checklist-goods-manage.data-material',
        params = {
            id: r.data('id'),
            branch: r.data('branch'),
            inventory: r.data('inventory'),
            time: r.data('time'),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#box-table-confirm-checklist-goods-manage'),
    ]);
    dataTableConfirmCheckListGoodsManage(res.data[0].original.data);
}

async function dataTableConfirmCheckListGoodsManage(data) {
    let id = $('#table-material-confirm-checklist-goods-manage'),
        scroll_Y = '40vh',
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'system_last_quantity', name: 'system_last_quantity', className: 'text-center'},
            {data: 'confirm', name: 'confirm', className: 'text-center'},
            {data: 'confirm_wastage_quantity', name: 'confirm_wastage_quantity', className: 'text-center'},
            {data: 'note_input', name: 'note_input', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ];
    tableConfirmChecklistGoodsManage = await DatatableTemplateNew(id, data, columns, scroll_Y, fixed_left, fixed_right);
}

async function saveModalConfirmCheckListGoodsManage() {
    if (checkSaveConfirmChecklistGoodsManage === 1) return false;
    let material = [];
    await tableConfirmChecklistGoodsManage.rows().every(function () {
        let row = $(this.node());
        material.push({
            'id': row.find('button.material-id').data('id'),
            'note': row.find('td:eq(5) input').val(),
            'quantity': removeformatNumber(row.find('td:eq(3) input').val()),
            "user_input_unit_type": materialCategoryTypeParentId === 2 ? 2 : 1,
        });
    });
    checkSaveConfirmChecklistGoodsManage = 1;
    let method = 'post',
        url = 'checklist-goods-manage.confirm',
        params = null,
        data = {
            id: idConfirmChecklistGoodsManage,
            branch: branchConfirmChecklistGoodsManage,
            material: material,
            note: $('#note-confirm-checklist-goods-manage').val(),
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-confirm-checklist-goods-manage')
    ]);
    checkSaveConfirmChecklistGoodsManage = 0;
    if (res.status === 200) {
        let text = $('#success-update-data-to-server').text();
        SuccessNotify(text);
        loadData();
        closeModalConfirmCheckListGoodsManage();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.message !== null) {
            text = res.message;
        }
        WarningNotify(text);
    }
}

function cancelUpdateCheckListGoodsManage() {
    if (checkSaveConfirmChecklistGoodsManage === 1) return false;
    let title = 'Hủy phiếu ?',
        content = 'Hủy phiếu sẽ không thể thay đổi được nữa !',
        icon = 'question';
    sweetAlertInputComponent(title, 'id-cancel-confirm-checklist', content, icon).then(async (result) => {
        if (result.value) {
            checkSaveConfirmChecklistGoodsManage = 1;
            let method = 'post',
                url = 'checklist-goods-manage.cancel',
                params = null,
                data = {id: idConfirmChecklistGoodsManage, reason: result.value, status: 3, is_export_inventory_next_month : 0,};
            let res = await axiosTemplate(method, url, params, data, [
                $('#loading-modal-confirm-checklist-goods-manage')
            ]);
            checkSaveConfirmChecklistGoodsManage = 0;
            let text = $('#success-cancel-data-to-server').text();
            switch (res.data.status) {
                case 200:
                    SuccessNotify(text);
                    loadData();
                    closeModalConfirmCheckListGoodsManage();
                    $('#tab-cancel-checklist-goods').click();
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    ErrorNotify(text);
                    break;
                default:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    WarningNotify(text);
            }
        }

    })
}

function closeModalConfirmCheckListGoodsManage() {
    $('#modal-confirm-checklist-goods-manage').modal('hide');
    resetModalConfirmCheckListGoodsManage();
    countCharacterTextarea()
}

function resetModalConfirmCheckListGoodsManage() {
    $('#branch-confirm-checklist-goods-manage').text('---');
    $('#code-confirm-checklist-goods-manage').text('---');
    $('#inventory-confirm-checklist-goods-manage').text('---');
    $('#time-confirm-checklist-goods-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#employee-create-confirm-checklist-goods-manage').text('---');
    $('#time-create-confirm-checklist-goods-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#employee-update-confirm-checklist-goods-manage').text('---');
    $('#time-update-confirm-checklist-goods-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#employee-confirm-confirm-checklist-goods-manage').text('---');
    $('#note-confirm-checklist-goods-manage').text('');
    $('#status-confirm-checklist-goods-manage').html('---');
    $('#char-count > span').text('0/300');
    tableConfirmChecklistGoodsManage.clear().draw(false);
}
