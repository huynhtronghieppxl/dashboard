let checkSaveCreateChecklistGoodsManage = 0, tableCreateChecklistGoodsManage, checkInventoryHaveChecklist;
$(function(){
    $(document).on('input paste', '#table-material-create-checklist-goods-manage .quantity', function () {
        let confirm = removeformatNumber($(this).val()),
            system = removeformatNumber($(this).parents('tr').find('td:eq(2)').text());
        $(this).parents('tr').find('td:eq(4)').text(formatNumber(checkDecimal(confirm - system)));
    });
    $('#select-inventory-create-checklist-goods-manage').on('select2:select', async function () {
        await updateTimeCreateCheckListGoodsManage();
        dataMaterialCreateCheckListGoodsManage();
    });
    $('#modal-create-checklist-goods-manage textarea').on('input', function () {
        $('#modal-create-checklist-goods-manage .btn-renew').removeClass('d-none')
    })

    $('#modal-create-checklist-goods-manage select').on('change', function () {
        $('#modal-create-checklist-goods-manage .btn-renew').removeClass('d-none')
    })

    $(document).on('input', '#table-material-create-checklist-goods-manage input', function () {
        $('#modal-create-checklist-goods-manage .btn-renew').removeClass('d-none')
    })

})
async function openCreateCheckListGoodsManage() {
    checkSaveCreateChecklistGoodsManage = 0;
    checkInventoryHaveChecklist = 0;

    $('#modal-create-checklist-goods-manage').modal('show');
    shortcut.remove("ESC");
    shortcut.add('ESC', function () {
        closeModalCreateCheckListGoodsManage();
    });
    shortcut.add('F4', function () {
        saveModalCreateCheckListGoodsManage();
    });
    $('#select-inventory-create-checklist-goods-manage').select2({
        dropdownParent: $('#modal-create-checklist-goods-manage'),
    });

    // Ở TẠI TAB NÀO THÌ SELECT CHỌN KHO TRIGGER KHO ĐÓ
    let idActive = $('#nav-tab-checklist-good .nav-link.active').data('id');
    switch (idActive) {
        // NGUYEN LIEU
        case 1:
            $('#select-inventory-create-checklist-goods-manage').val(idActive).trigger('change.select2');
            break;
        case 2:
            // HANG HOA
            $('#select-inventory-create-checklist-goods-manage').val(idActive).trigger('change.select2');
            break;
        case 3:
            // NOI BO
            $('#select-inventory-create-checklist-goods-manage').val(idActive).trigger('change.select2');
            break;
        case 12:
            // KHO KHAC
            $('#select-inventory-create-checklist-goods-manage').val(idActive).trigger('change.select2');
            break;
        default :
            // HUY
            $('#select-inventory-create-checklist-goods-manage').val(1).trigger('change.select2');
    }

    registerShortcutsCreateCheckListGoodsManage();
    await updateTimeCreateCheckListGoodsManage();
    dataMaterialCreateCheckListGoodsManage();


}

async function updateTimeCreateCheckListGoodsManage() {
    let branch = $('.select-branch').val(),
        inventory = $('#select-inventory-create-checklist-goods-manage').val(),
        method = 'get',
        url = 'checklist-goods-manage.final',
        params = {
            branch: branch,
            inventory: inventory,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#box-list-create-checklist-goods-manage')
    ]);
    if(res.data[1].data?.list?.length === 1 && res.data[1].data?.list?.[0]?.employee_confirm_name === ''){
        checkInventoryHaveChecklist = 1;
    }
    $('#checklist-date-create-checklist-goods-manage').text(res.data[0]);
}

async function dataMaterialCreateCheckListGoodsManage() {
    if ($('#date-create-checklist-goods-manage').text() === $('#checklist-date-create-checklist-goods-manage').text() || checkInventoryHaveChecklist === 1  ) {
        $('#modal-create-checklist-goods-manage h5.sub-title').addClass('d-none');
        $('#modal-create-checklist-goods-manage .modal-dialog').removeClass('modal-xl');
        $('#modal-create-checklist-goods-manage .modal-dialog').addClass('modal-md');
        $('#modal-create-checklist-goods-manage .modal-body').removeClass('background-body-color');
        $('#modal-create-checklist-goods-manage .modal-body .edit-flex-auto-fill:eq(0)').addClass('d-none');
        $('#modal-create-checklist-goods-manage .modal-body .edit-flex-auto-fill:eq(1)').removeClass('col-lg-4');
        $('#modal-create-checklist-goods-manage .modal-body .edit-flex-auto-fill:eq(1)').addClass('col-lg-12');
        $('#modal-create-checklist-goods-manage .modal-body .edit-flex-auto-fill:eq(1) .flex-sub').removeClass('card');
        $('#modal-create-checklist-goods-manage .modal-footer .btn-grd-primary').addClass('d-none');
        sweetAlertNextComponent(`${$('#select-inventory-create-checklist-goods-manage option:selected').text()} đã kiểm kê !`, 'Kho bạn chọn đã kiểm kê hoặc phiếu chưa hoàn tất, hãy hoàn tất phiếu trước khi tạo phiếu mới!', 'warning');
        checkInventoryHaveChecklist = 0;
    } else {
        $('#modal-create-checklist-goods-manage h5.sub-title').removeClass('d-none');
        $('#modal-create-checklist-goods-manage .modal-dialog').addClass('modal-xl');
        $('#modal-create-checklist-goods-manage .modal-dialog').removeClass('modal-md');
        $('#modal-create-checklist-goods-manage .modal-body').addClass('background-body-color');
        $('#modal-create-checklist-goods-manage .modal-body .edit-flex-auto-fill:eq(0)').removeClass('d-none');
        $('#modal-create-checklist-goods-manage .modal-body .edit-flex-auto-fill:eq(1)').addClass('col-lg-4');
        $('#modal-create-checklist-goods-manage .modal-body .edit-flex-auto-fill:eq(1)').removeClass('col-lg-12');
        $('#modal-create-checklist-goods-manage .modal-body .edit-flex-auto-fill:eq(1) .flex-sub').addClass('card');
        $('#modal-create-checklist-goods-manage .modal-footer .btn-grd-primary').removeClass('d-none');
        let branch = $('.select-branch').val(),
            inventory = $('#select-inventory-create-checklist-goods-manage').val(),
            method = 'get',
            url = 'checklist-goods-manage.data-material',
            params = {
                branch: branch,
                inventory: inventory,
            },
            data = null;
        let res = await axiosTemplate(method, url, params, data, [
            $('#box-list-one-create-checklist-goods-manage')
        ]);
        dataTableCreateChecklistGoods(res.data[0].original.data);
        checkInventoryHaveChecklist = 0;
    }
}

async function dataTableCreateChecklistGoods(data) {
    let id = $('#table-material-create-checklist-goods-manage'),
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
    tableCreateChecklistGoodsManage = await DatatableTemplateNew(id, data, columns, scroll_Y, fixed_left, fixed_right, option);
}

async function saveModalCreateCheckListGoodsManage() {
    if (checkSaveCreateChecklistGoodsManage === 1) return false;
    if (!checkValidateSave($('#modal-create-checklist-goods-manage'))) return false;
    let branch = $('.select-branch').val(),
        material_category_type_parent_id = $('#select-inventory-create-checklist-goods-manage').val(),
        note = $('#note-create-checklist-goods-manage').val();
    let restaurant_materials= [];
    await tableCreateChecklistGoodsManage.rows().every(function (index, element) {
        let row = $(this.node());
        restaurant_materials.push({
            "id" : row.find('button.material-id').data('id'),
            "note" : row.find('input.note').val(),
            "quantity" : removeformatNumber(row.find('input.quantity').val()),
            "user_input_unit_type": material_category_type_parent_id === '2' ? 2 : 1,
        })
    });
    checkSaveCreateChecklistGoodsManage = 1;
    let method = 'post',
        url = 'checklist-goods-manage.create',
        params = null,
        data = {
            material_category_type_parent_id: material_category_type_parent_id,
            note: note,
            branch: branch,
            restaurant_materials: restaurant_materials
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-create-checklist-goods-manage')
    ]);
    checkSaveCreateChecklistGoodsManage = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status) {
        case 200:
            SuccessNotify(text);
            loadData();
            closeModalCreateCheckListGoodsManage();
            break;
        case 400:
            if(res.data.data?.length > 0) {
                openModalListUnfinishedOrder(res.data.table_unfinished_order.original.data);
            }else {
                text = $('#error-post-data-to-server').text();
                if (res.data.message !== null) {
                    text = res.data.message;
                }
                WarningNotify(text);
            }
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

function closeModalCreateCheckListGoodsManage() {
    dataTableCreateChecklistGoods([]);
    $('#modal-create-checklist-goods-manage').modal('hide');
    $('#modal-create-checklist-goods-manage input,textarea').val('');
    $('#select-inventory-create-checklist-goods-manage').val(1).trigger('change.select2');
    $('#modal-create-checklist-goods-manage .btn-renew').addClass('d-none');
    $('#char-count > span').text('0/300');
    let id = $('#select-inventory-create-checklist-goods-manage').text();
    $('#tab-' + id + 'checklist-goods-manage').click();
    shortcut.remove('F3');
    shortcut.remove('F4');
    removeAllValidate();
    checkInventoryHaveChecklist = 0;
    countCharacterTextarea()
}

function registerShortcutsCreateCheckListGoodsManage() {
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F4', function () {
        saveModalCreateCheckListGoodsManage();
    });
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalCreateCheckListGoodsManage();
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalCreateCheckListGoodsManage();
        });
    })
}

function resetModalCreateCheckListGoodsManage() {
    $('#select-inventory-create-checklist-goods-manage').val(1).trigger('change.select2');
    $('#note-create-checklist-goods-manage').val('');
    dataMaterialCreateCheckListGoodsManage();
    $('#modal-create-checklist-goods-manage .btn-renew').addClass('d-none');
    $('#char-count > span').text('0/300');
}
