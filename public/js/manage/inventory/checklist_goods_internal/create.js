let checkSaveCreateChecklistGoodsManage, tableCreateChecklistGoodsInternalManage, canBeChecklist = true;
async function openCreateCheckListGoodsInternalManage() {
    $('#modal-create-checklist-goods-internal-manage').modal('show');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F4', function () {
        saveModalCreateCheckListGoodsInternalManage();
    });
    shortcut.add('ESC', function () {
        closeModalCreateCheckListGoodsInternalManage();
    });
    checkSaveCreateChecklistGoodsManage = 0;
    $('#select-inventory-create-checklist-goods-internal-manage').select2({
        dropdownParent: $('#modal-create-checklist-goods-internal-manage'),
    });
    $('#select-inventory-create-checklist-goods-internal-manage').unbind('select2:select').on('select2:select', async function () {
        await updateTimeCreateCheckListGoodsInternalManage();
        dataSelectMaterialCheckGoodsList();
    });
    $(document).on('input paste', 'table#table-material-create-checklist-goods-internal-manage .confirm-quantity', function () {
        let confirm = removeformatNumber($(this).val()),
            quantity = removeformatNumber($(this).parents('tr').find('td:eq(1)').text());
        $(this).parents('tr').find('td:eq(2) input').val($(this).val());
        $(this).parents('tr').find('td:eq(3)').text(formatNumber(checkDecimal(confirm - quantity)));
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalCreateCheckListGoodsInternalManage();
        });
    });
    $('#modal-create-checklist-goods-internal-manage select').on('change', function () {
        $('#modal-create-checklist-goods-internal-manage .btn-renew').removeClass('d-none')
    });
    $('#modal-create-checklist-goods-internal-manage textarea').on('input', function () {
        $('#modal-create-checklist-goods-internal-manage .btn-renew').removeClass('d-none')
    });
    await updateTimeCreateCheckListGoodsInternalManage();
    dataSelectMaterialCheckGoodsList();
}

// function selectItemCreateCheckListGoodsInternalManage() {
//     let type_inventory = $('#select-inventory-create-checklist-goods-internal-manage option:selected').val()
//     let id = $('#select-material-create-checklist-goods-internal-manage').val(),
//         name = $('#select-material-create-checklist-goods-internal-manage').find(':selected').text(),
//         unit = $('#select-material-create-checklist-goods-internal-manage').find(':selected').data('unit'),
//         unit_full_name = $('#select-material-create-checklist-goods-internal-manage').find(':selected').data('unit-full-name'),
//         quantity = $('#select-material-create-checklist-goods-internal-manage').find(':selected').data('system-last-quantity'),
//         keysearch = $('#select-material-create-checklist-goods-internal-manage').find(':selected').data('keysearch');
//     addRowDatatableTemplate(tableCreateChecklistGoodsInternalManage, {
//         'name': name + `<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
//                                                                          <i class="fi-rr-hastag"></i>
//                                                                          <label class="m-0">${type_inventory == 2 ? unit : unit_full_name}</label>
//                                                                     </div>`,
//         'quantity': formatNumber(quantity),
//         'confirm_quantity': `<div class="input-group border-group validate-table-validate">
//                                 <input class="form-control text-center rounded confirm-quantity border-0 w-100" data-max="999999" data-min="0" data-type="currency-edit" data-float="1" value="0">
//                             </div>`,
//         'confirm_note': `<div class="input-group border-group validate-table-validate">
//                                 <input class="form-control border-0 w-100" value="" data-max-length="255">
//                            </div>`,
//         'deficiency_system': formatNumber(0 - quantity),
//         'action': `<div class="btn-group btn-group-sm">
//                        <button type="button" class="tabledit-edit-button seemt-red btn seemt-btn-hover-red waves-effect waves-light" data-id="${id}" data-system-last-quantity="${quantity}" data-name="${name}" data-unit="${unit}" data-unit-full-name="${unit_full_name}" data-toggle="tooltip" data- data-placement="top" data-original-title="Xoá" onclick="removeItemCreateCheckListGoodsInternalManage($(this))"><i class="fi-rr-trash"></i></button>
//                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" onclick="openModalDetailMaterialData(${id})"><i class="fi-rr-eye"></i></button>
//                    </div>`,
//         'keysearch': keysearch
//     });
//     $('#select-material-create-checklist-goods-internal-manage').find(':selected').remove();
//     $('#select-material-create-checklist-goods-internal-manage').find('option:first').trigger('change.select2');
//     $('[data-toggle="tooltip"]').tooltip({
//         trigger: 'hover'
//     });
// }

// function removeItemCreateCheckListGoodsInternalManage(r) {
//     let type_bar_kitchen = $('#select-inventory-create-checklist-goods-internal-manage option:selected').val()
//     type_bar_kitchen == 1 ? $('#select-material-create-checklist-goods-internal-manage').append(`<option value="${r.data('id')}" data-system-last-quantity="${r.data('system-last-quantity')}" data-unit="${r.data('unit')}" data-unit-full-name="${r.data('unit-full-name')}" data-keysearch="${removeVietnameseString(r.data('name') + r.data('unit-full-name') + r.data('system-last-quantity'))}">${r.data('name')}</option>`) :  $('#select-material-create-checklist-goods-internal-manage').append(`<option value="${r.data('id')}" data-system-last-quantity="${r.data('system-last-quantity')}" data-unit="${r.data('unit')}"  data-keysearch="${removeVietnameseString(r.data('name') + r.data('unit') + r.data('system-last-quantity'))}">${r.data('name')}</option>`)
//
//     removeRowDatatableTemplate(tableCreateChecklistGoodsInternalManage, r, false);
// }

async function updateTimeCreateCheckListGoodsInternalManage() {
    canBeChecklist = true;
    let branch = $('#select-branch-checklist-goods-internal').val(),
        inventory = $('#select-inventory-create-checklist-goods-internal-manage').val(),
        type = 1,
        method = 'get',
        url = 'checklist-goods-internal-manage.final',
        params = {
            branch: branch,
            inventory: inventory,
            type: type,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#boxlist-create-checklist-goods-internal-manage')]);
    $('#checklist-date-create-checklist-goods-internal-manage').text(res.data[0]);
    if(res.data[1].data.id && (res.data[1].data.status === 0 || res.data[1].data.status === 1 )) {
        canBeChecklist = false;
    }
}


async function dataSelectMaterialCheckGoodsList() {
    dataTableMaterialCreateChecklistGoodsInternalManage([]);
    if (!canBeChecklist) {
        $('#modal-create-checklist-goods-internal-manage h5.sub-title').addClass('d-none');
        $('#modal-create-checklist-goods-internal-manage .modal-dialog').removeClass('modal-xl');
        $('#modal-create-checklist-goods-internal-manage .modal-dialog').addClass('modal-md');
        $('#modal-create-checklist-goods-internal-manage .modal-body').removeClass('background-body-color');
        $('#modal-create-checklist-goods-internal-manage .modal-body .edit-flex-auto-fill:eq(0)').addClass('d-none');
        $('#modal-create-checklist-goods-internal-manage .modal-body .edit-flex-auto-fill:eq(1)').removeClass('col-lg-4');
        $('#modal-create-checklist-goods-internal-manage .modal-body .edit-flex-auto-fill:eq(1)').addClass('col-lg-12');
        $('#modal-create-checklist-goods-internal-manage .modal-body .edit-flex-auto-fill:eq(1) .flex-sub').removeClass('card');
        $('#modal-create-checklist-goods-internal-manage .modal-footer .btn-grd-primary').addClass('d-none');
        sweetAlertNextComponent('Kho đã kiểm kê !', 'Kho bạn chọn đã kiểm kê đến thời gian hiện tại, vui lòng kiểm kê kho khác !', 'warning');
    } else {
        $('#modal-create-checklist-goods-internal-manage h5.sub-title').removeClass('d-none');
        $('#modal-create-checklist-goods-internal-manage .modal-dialog').addClass('modal-xl');
        $('#modal-create-checklist-goods-internal-manage .modal-dialog').removeClass('modal-md');
        $('#modal-create-checklist-goods-internal-manage .modal-body').addClass('background-body-color');
        $('#modal-create-checklist-goods-internal-manage .modal-body .edit-flex-auto-fill:eq(0)').removeClass('d-none');
        $('#modal-create-checklist-goods-internal-manage .modal-body .edit-flex-auto-fill:eq(1)').addClass('col-lg-4');
        $('#modal-create-checklist-goods-internal-manage .modal-body .edit-flex-auto-fill:eq(1)').removeClass('col-lg-12');
        $('#modal-create-checklist-goods-internal-manage .modal-body .edit-flex-auto-fill:eq(1) .flex-sub').addClass('card');
        $('#modal-create-checklist-goods-internal-manage .modal-footer .btn-grd-primary').removeClass('d-none');
        let branch = $('#select-branch-checklist-goods-internal').val(),
            inventory = $('#select-inventory-create-checklist-goods-internal-manage').val(),
            time = $('#date-create-checklist-goods-internal-manage').text(),
            method = 'get',
            url = 'checklist-goods-internal-manage.select-material',
            params = {
                id: 0,
                branch: branch,
                inventory: inventory,
                time: time,
                type: 1, //day
            },
            data = null;
        let res = await axiosTemplate(method, url, params, data, [$('#table-material-create-checklist-goods-internal-manage')]);
        dataTableMaterialCreateChecklistGoodsInternalManage(res.data[0].original.data);
    }
}

async function dataTableMaterialCreateChecklistGoodsInternalManage(data) {
    let tableMaterialCreateCheckListGoodsInternalManage = $('#table-material-create-checklist-goods-internal-manage'),
        scroll_Y = '50vh',
        fixed_left = 2,
        fixed_right = 1,
        columns = [
            {data: 'name', name: 'name', className: 'text-left', width: '10%'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'confirm_quantity', name: 'confirm_quantity', className: 'text-center'},
            {data: 'deficiency_system', name: 'deficiency_system', className: 'text-center'},
            {data: 'confirm_note', name: 'confirm_note', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ];
    tableCreateChecklistGoodsInternalManage = await DatatableTemplateNew(tableMaterialCreateCheckListGoodsInternalManage, data, columns, scroll_Y, fixed_left, fixed_right);
}

async function saveModalCreateCheckListGoodsInternalManage() {
    if (checkSaveCreateChecklistGoodsManage === 1) return false;
    if (!checkValidateSave($('#modal-create-checklist-goods-internal-manage'))) return false;
    let branch = $('#select-branch-checklist-goods-internal').val(),
        time = $('#date-create-checklist-goods-internal-manage').text(),
        inventory = $('#select-inventory-create-checklist-goods-internal-manage').val(),
        note = $('#note-create-checklist-goods-internal-manage').val(),
        type = 1, //day
        materials = [];
    await tableCreateChecklistGoodsInternalManage.rows().every(function () {
        let row = $(this.node());
        materials.push({
            'id': row.find('td:eq(5)').find('button').data('id'),
            'note': row.find('td:eq(4)').find('input').val(),
            'quantity': removeformatNumber(row.find('td:eq(2)').find('input').val()),
            "user_input_unit_type": row.find('td:eq(5)').find('button').data('cate-type-parent') === 2 ? 2 : 1
        });
    });
    if (materials.length === 0) {
        WarningNotify('Vui lòng chọn nguyên liệu');
        return false;
    }
    checkSaveCreateChecklistGoodsManage = 1;
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
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-checklist-goods-internal-manage')]);
    checkSaveCreateChecklistGoodsManage = 0;
    if (res.data.status === 200) {
        let text = $('#success-create-data-to-server').text();
        SuccessNotify(text);
        loadData();
        closeModalCreateCheckListGoodsInternalManage();
    } else if (res.data.status !== 200) {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

function closeModalCreateCheckListGoodsInternalManage() {
    $('#modal-create-checklist-goods-internal-manage').modal('hide');
    resetModalCreateCheckListGoodsInternalManage();
    shortcut.remove('ESC');
    shortcut.remove('F4');
    $('#checklist-date-create-checklist-goods-internal-manage').text('---');
    removeAllValidate();
    countCharacterTextarea()
    canBeChecklist = true;
}

function resetModalCreateCheckListGoodsInternalManage() {
    $('#select-inventory-create-checklist-goods-internal-manage').val(1).trigger('change.select2');
    $('#note-create-checklist-goods-internal-manage').val('');
    tableCreateChecklistGoodsInternalManage.clear().draw(false);
    $('#modal-create-checklist-goods-internal-manage .btn-renew').addClass('d-none');
    $('#char-count > span').text('0/255');
}

