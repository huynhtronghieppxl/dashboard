let checkSaveCreateInventoryWarehouseManage = 0, tableCreateInventoryWarehouseManage, checkInventoryHaveInventoryWarehouse;
$(function(){
    $(document).on('input paste', '#table-material-create-inventory-warehouse-manage .quantity', function () {
        let confirm = removeformatNumber($(this).val()),
            system = removeformatNumber($(this).parents('tr').find('td:eq(2)').text());
        $(this).parents('tr').find('td:eq(4)').text(formatNumber(checkDecimal(confirm - system)));
    });
    $('#select-inventory-create-inventory-warehouse-manage').on('select2:select', async function () {
        await updateTimeCreateInventoryWarehouseManage();
        dataMaterialCreateInventoryWarehouseManage();
    });
    $('#modal-create-inventory-warehouse-manage textarea').on('input', function () {
        $('#modal-create-inventory-warehouse-manage .btn-renew').removeClass('d-none')
    })

    $('#modal-create-inventory-warehouse-manage select').on('change', function () {
        $('#modal-create-inventory-warehouse-manage .btn-renew').removeClass('d-none')
    })

    $(document).on('input', '#table-material-create-inventory-warehouse-manage input', function () {
        $('#modal-create-inventory-warehouse-manage .btn-renew').removeClass('d-none')
    })

})
async function openCreateInventoryWarehouseManage() {
    checkSaveCreateInventoryWarehouseManage = 0;
    checkInventoryHaveInventoryWarehouse = 0;

    $('#modal-create-inventory-warehouse-manage').modal('show');
    shortcut.remove("ESC");
    shortcut.add('ESC', function () {
        closeModalCreateInventoryWarehouseManage();
    });
    shortcut.add('F4', function () {
        saveModalCreateInventoryWarehouseManage();
    });
    $('#select-inventory-create-inventory-warehouse-manage').select2({
        dropdownParent: $('#modal-create-inventory-warehouse-manage'),
    });

    // Ở TẠI TAB NÀO THÌ SELECT CHỌN KHO TRIGGER KHO ĐÓ
    let idActive = $('#nav-tab-inventory-warehouse .nav-link.active').data('id');
    switch (idActive) {
        // NGUYEN LIEU
        case 1:
            $('#select-inventory-create-inventory-warehouse-manage').val(idActive).trigger('change.select2');
            break;
        case 2:
            // HANG HOA
            $('#select-inventory-create-inventory-warehouse-manage').val(idActive).trigger('change.select2');
            break;
        case 3:
            // NOI BO
            $('#select-inventory-create-inventory-warehouse-manage').val(idActive).trigger('change.select2');
            break;
        case 12:
            // KHO KHAC
            $('#select-inventory-create-inventory-warehouse-manage').val(idActive).trigger('change.select2');
            break;
        default :
            // HUY
            $('#select-inventory-create-inventory-warehouse-manage').val(1).trigger('change.select2');
    }

    registerShortcutsCreateInventoryWarehouseManage();
    await updateTimeCreateInventoryWarehouseManage();
    dataMaterialCreateInventoryWarehouseManage();


}

async function updateTimeCreateInventoryWarehouseManage() {
    let branch = $('.select-branch').val(),
        inventory = $('#select-inventory-create-inventory-warehouse-manage').val(),
        method = 'get',
        url = 'inventory.final',
        params = {
            branch: branch,
            inventory: inventory,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#box-list-create-inventory-warehouse-manage')
    ]);
    if(res.data[1].data.list.length === 1 && res.data[1].data.list[0].employee_confirm_name === ''){
        checkInventoryHaveInventoryWarehouse = 1;
    }
    $('#checklist-date-create-inventory-warehouse-manage').text(res.data[0]);
}

async function dataMaterialCreateInventoryWarehouseManage() {
    if ($('#date-create-inventory-warehouse-manage').text() === $('#checklist-date-create-inventory-warehouse-manage').text() || checkInventoryHaveInventoryWarehouse === 1  ) {
        $('#modal-create-inventory-warehouse-manage h5.sub-title').addClass('d-none');
        $('#modal-create-inventory-warehouse-manage .modal-dialog').removeClass('modal-xl');
        $('#modal-create-inventory-warehouse-manage .modal-dialog').addClass('modal-md');
        $('#modal-create-inventory-warehouse-manage .modal-body').removeClass('background-body-color');
        $('#modal-create-inventory-warehouse-manage .modal-body .edit-flex-auto-fill:eq(0)').addClass('d-none');
        $('#modal-create-inventory-warehouse-manage .modal-body .edit-flex-auto-fill:eq(1)').removeClass('col-lg-4');
        $('#modal-create-inventory-warehouse-manage .modal-body .edit-flex-auto-fill:eq(1)').addClass('col-lg-12');
        $('#modal-create-inventory-warehouse-manage .modal-body .edit-flex-auto-fill:eq(1) .flex-sub').removeClass('card');
        $('#modal-create-inventory-warehouse-manage .modal-footer .btn-grd-primary').addClass('d-none');
        sweetAlertNextComponent(`${$('#select-inventory-create-inventory-warehouse-manage option:selected').text()} đã kiểm kê !`, 'Kho bạn chọn đã kiểm kê hoặc phiếu chưa hoàn tất, hãy hoàn tất phiếu trước khi tạo phiếu mới!', 'warning');
        checkInventoryHaveInventoryWarehouse = 0;
    } else {
        $('#modal-create-inventory-warehouse-manage h5.sub-title').removeClass('d-none');
        $('#modal-create-inventory-warehouse-manage .modal-dialog').addClass('modal-xl');
        $('#modal-create-inventory-warehouse-manage .modal-dialog').removeClass('modal-md');
        $('#modal-create-inventory-warehouse-manage .modal-body').addClass('background-body-color');
        $('#modal-create-inventory-warehouse-manage .modal-body .edit-flex-auto-fill:eq(0)').removeClass('d-none');
        $('#modal-create-inventory-warehouse-manage .modal-body .edit-flex-auto-fill:eq(1)').addClass('col-lg-4');
        $('#modal-create-inventory-warehouse-manage .modal-body .edit-flex-auto-fill:eq(1)').removeClass('col-lg-12');
        $('#modal-create-inventory-warehouse-manage .modal-body .edit-flex-auto-fill:eq(1) .flex-sub').addClass('card');
        $('#modal-create-inventory-warehouse-manage .modal-footer .btn-grd-primary').removeClass('d-none');
        let branch = $('.select-branch').val(),
            inventory = $('#select-inventory-create-inventory-warehouse-manage').val(),
            time = $('#date-create-inventory-warehouse-manage').text(),
            method = 'get',
            url = 'inventory.data-material',
            params = {
                id: 0,
                branch: branch,
                inventory: inventory,
                time: time
            },
            data = null;
        let res = await axiosTemplate(method, url, params, data, [
            $('#box-list-one-create-inventory-warehouse-manage')
        ]);
        dataTableCreateInventoryWarehouse(res.data[0].original.data);
        checkInventoryHaveInventoryWarehouse = 0;
    }
}

async function dataTableCreateInventoryWarehouse(data) {
    let id = $('#table-material-create-inventory-warehouse-manage'),
        scroll_Y = '40vh',
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'system_last_quantity', name: 'system_last_quantity', className: 'text-center'},
            {data: 'confirm_create', name: 'confirm_create', className: 'text-center'},
            {
                data: 'confirm_create_wastage_quantity',
                name: 'confirm_create_wastage_quantity',
                className: 'text-center'
            },
            {data: 'note', name: 'note', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'text-center d-none'},

        ];
    let option = [];
    tableCreateInventoryWarehouseManage = await DatatableTemplateNew(id, data, columns, scroll_Y, fixed_left, fixed_right, option);
}

async function saveModalCreateInventoryWarehouseManage() {
    if (checkSaveCreateInventoryWarehouseManage === 1) return false;
    if (!checkValidateSave($('#modal-create-inventory-warehouse-manage'))) return false;
    let branch = $('.select-branch').val(),
        time = $('#date-create-inventory-warehouse-manage').text(),
        material_category_type_parent_id = $('#select-inventory-create-inventory-warehouse-manage').val(),
        note = $('#note-create-inventory-warehouse-manage').val();
    let material = [];
    await tableCreateInventoryWarehouseManage.rows().every(function (index, element) {
        let row = $(this.node());
        material.push({
            'inventory_report_detail_id': 0,
            'restaurant_material_id': row.find('button.material-id').data('id'),
            'confirm_quantity': removeformatNumber(row.find('input.quantity').val()),
            'note': row.find('input.note').val(),
        })
    });
    checkSaveCreateInventoryWarehouseManage = 1;
    let method = 'post',
        url = 'inventory.create',
        params = null,
        data = {
            material_category_type_parent_id: material_category_type_parent_id,
            note: note,
            branch: branch,
            time: time,
            material: material
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-create-inventory-warehouse-manage')
    ]);
    checkSaveCreateInventoryWarehouseManage = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status) {
        case 200:
            SuccessNotify(text);
            loadData();
            closeModalCreateInventoryWarehouseManage();
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

function closeModalCreateInventoryWarehouseManage() {s
    dataTableCreateInventoryWarehouse([]);
    $('#modal-create-inventory-warehouse-manage').modal('hide');
    $('#modal-create-inventory-warehouse-manage input,textarea').val('')
    let id = $('#select-inventory-create-inventory-warehouse-manage').text();
    $('#tab-' + id + 'inventory-warehouse-manage').click();
    shortcut.remove('F3');
    shortcut.remove('F4');
    removeAllValidate();
    checkInventoryHaveInventoryWarehouse = 0;
    countCharacterTextarea()
}

function registerShortcutsCreateInventoryWarehouseManage() {
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F4', function () {
        saveModalCreateInventoryWarehouseManage();
    });
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalCreateInventoryWarehouseManage();
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalCreateInventoryWarehouseManage();
        });
    })
}

// function resetModalCreateCheckListGoodsManage() {
//     $('#select-inventory-create-checklist-goods-manage').val(1).trigger('change.select2');
//     $('#note-create-checklist-goods-manage').val('');
//     dataMaterialCreateCheckListGoodsManage();
//     $('#modal-create-checklist-goods-manage .btn-renew').addClass('d-none');
// }
