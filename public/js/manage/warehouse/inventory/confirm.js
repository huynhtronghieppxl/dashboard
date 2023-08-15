let checkSaveConfirmInventoryWarehouseManage,
    idConfirmInventoryWarehouseManage,
    branchConfirmInventoryWarehouseManage,
    tableConfirmInventoryWarehouseManage;

function openConfirmInventoryWarehouseManage(r) {
    $('#modal-confirm-inventory-warehouse-manage').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalConfirmInventoryWarehouseManage();
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalConfirmInventoryWarehouseManage();
        });
    })
    checkSaveConfirmInventoryWarehouseManage = 0;
    idConfirmInventoryWarehouseManage = r.data('id');
    branchConfirmInventoryWarehouseManage = r.data('branch');
    $(document).on('input paste', '#table-material-confirm-inventory-warehouse-manage .quantity', function () {
        let confirm = removeformatNumber($(this).val()),
            system = removeformatNumber($(this).parents('tr').find('td:eq(2)').text());
        $(this).parents('tr').find('td:eq(4)').text(formatNumber(checkDecimal(confirm - system)));
    });
    $(document).on('focus', 'input', function () {
        $(this).select();
    });
    dataConfirmInventoryWarehouse(r.data('id'));
}

async function dataConfirmInventoryWarehouse(id) {
    let method = 'get',
        url = 'inventory.detail',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#box-list-zero-confirm-inventory-warehouse-manage')
    ]);
    dataTableConfirmInventoryWarehouseManage(res.data[1].original.data);
    $('#branch-confirm-inventory-warehouse-manage').text(res.data[0].branch_name);
    $('#code-confirm-inventory-warehouse-manage').text(res.data[0].code);
    $('#inventory-confirm-inventory-warehouse-manage').text(res.data[0].inventory);
    $('#time-confirm-inventory-warehouse-manage').text(res.data[0].time);
    $('#employee-create-confirm-inventory-warehouse-manage').text(res.data[0].employee_create_name);
    $('#time-create-confirm-inventory-warehouse-manage').text(res.data[0].created_at);
    $('#image-employee-create-confirm-inventory-warehouse-manage').text(res.data[0].employee_create_avartar);
    $('#employee-create-confirm-inventory-warehouse-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ res.data[0].employee_create_id +')');


    $('#employee-update-confirm-inventory-warehouse-manage').text(res.data[0].employee_edit_name);
    $('#time-update-confirm-inventory-warehouse-manage').text(res.data[0].edited_at);
    $('#image-employee-update-confirm-inventory-warehouse-manage').text(res.data[0].employee_edit_avartar);
    $('#employee-update-confirm-inventory-warehouse-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ res.data[0].employee_edit_id +')');

    $('#employee-confirm-confirm-inventory-warehouse-manage').text(res.data[0].employee_confirm_name);
    $('#time-confirm-inventory-warehouse-manage').text(res.data[0].time);
    $('#image-employee-confirm-confirm-inventory-warehouse-manage').text(res.data[0].employee_confirm_avartar);
    $('#employee-confirm-confirm-inventory-warehouse-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ res.data[0].employee_confirm_id +')');

    $('#note-confirm-inventory-warehouse-manage').val(res.data[0].note);
    $('#status-confirm-inventory-warehouse-manage').html(res.data[0].status_label);
}

async function dataMaterialConfirmInventoryWarehouseManage(r) {
    let method = 'get',
        url = 'inventory.data-material',
        params = {
            id: r.data('id'),
            branch: r.data('branch'),
            inventory: r.data('inventory'),
            time: r.data('time'),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#box-table-confirm-inventory-warehouse-manage'),
    ]);
    dataTableConfirmInventoryWarehouseManage(res.data[0].original.data);
}

async function dataTableConfirmInventoryWarehouseManage(data) {
    let id = $('#table-material-confirm-inventory-warehouse-manage'),
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
    tableConfirmInventoryWarehouseManage = await DatatableTemplateNew(id, data, columns, scroll_Y, fixed_left, fixed_right);
}

async function saveModalConfirmInventoryWarehouseManage() {
    if (checkSaveConfirmInventoryWarehouseManage === 1) return false;
    let material = [];
    await tableConfirmInventoryWarehouseManage.rows().every(function () {
        let row = $(this.node());
        material.push({
            'inventory_report_detail_id': 0,
            'restaurant_material_id': row.find('button.material-id').data('id'),
            'confirm_quantity': removeformatNumber(row.find('td:eq(3) input').val()),
            'note': row.find('td:eq(5) input').val(),
        })
    });
    checkSaveConfirmInventoryWarehouseManage = 1;
    let method = 'post',
        url = 'inventory.confirm',
        params = null,
        data = {
            id: idConfirmInventoryWarehouseManage,
            branch: branchConfirmInventoryWarehouseManage,
            material: material,
            note: $('#note-confirm-inventory-warehouse-manage').val(),
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-confirm-inventory-warehouse-manage')
    ]);
    checkSaveConfirmInventoryWarehouseManage = 0;
    if (res.data[0].status === 200 && res.data[1].status === 200) {
        let text = $('#success-create-data-to-server').text();
        SuccessNotify(text);
        loadData();
        closeModalConfirmInventoryWarehouseManage();
    } else if (res.data[0].status !== 200) {
        let text = $('#error-post-data-to-server').text();
        if (res.data[0].message !== null) {
            text = res.data[0].message;
        }
        WarningNotify(text);
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data[1].message !== null) {
            text = res.data[1].message;
        }
        WarningNotify(text);
    }
}

function cancelUpdateInventoryWarehouseManage() {
    if (checkSaveConfirmInventoryWarehouseManage === 1) return false;
    let title = 'Hủy phiếu ?',
        content = 'Hủy phiếu sẽ không thể thay đổi được nữa !',
        icon = 'question';
    sweetAlertInputComponent(title, 'id-cancel-confirm-checklist', content, icon).then(async (result) => {
        if (result.value) {
            checkSaveConfirmInventoryWarehouseManage = 1;
            let method = 'post',
                url = 'inventory.cancel',
                params = null,
                data = {id: idConfirmInventoryWarehouseManage, reason: result.value};
            let res = await axiosTemplate(method, url, params, data, [
                $('#loading-modal-confirm-inventory-warehouse-manage')
            ]);
            checkSaveConfirmInventoryWarehouseManage = 0;
            let text = $('#success-cancel-data-to-server').text();
            switch (res.data.status) {
                case 200:
                    SuccessNotify(text);
                    loadData();
                    closeModalConfirmInventoryWarehouseManage();
                    $('#tab-cancel-inventory-warehouse').click();
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

function closeModalConfirmInventoryWarehouseManage() {
    $('#modal-confirm-inventory-warehouse-manage').modal('hide');
    resetModalConfirmInventoryWarehouseManage();
    countCharacterTextarea()
}

function resetModalConfirmInventoryWarehouseManage() {
    $('#branch-confirm-inventory-warehouse-manage').text('---');
    $('#code-confirm-inventory-warehouse-manage').text('---');
    $('#inventory-confirm-inventory-warehouse-manage').text('---');
    $('#time-confirm-inventory-warehouse-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#employee-create-confirm-inventory-warehouse-manage').text('---');
    $('#time-create-confirm-inventory-warehouse-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#employee-update-confirm-inventory-warehouse-manage').text('---');
    $('#time-update-confirm-inventory-warehouse-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#employee-confirm-confirm-inventory-warehouse-manage').text('---');
    $('#note-confirm-inventory-warehouse-manage').text('---');
    $('#status-confirm-inventory-warehouse-manage').html('---');
    tableConfirmInventoryWarehouseManage.clear().draw(false);
}
