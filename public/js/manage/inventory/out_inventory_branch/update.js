let checkChangeUpdateOutInventoryBranchManage = 0,
    idUpdateOutInventoryBranchManage,
    branchUpdateOutInventoryBranchManage,
    tableDeleteUpdateOutInventoryBranchManage = [],
    inventoryUpdateOutInventoryBranchManage,
    targetUpdateOutInventoryBranchManage,
    checkUpdateCancelOutInventoryBranch = 0,checkDataMaterialOutInventoryUpdate = 0,
    saveUpdateOutInventoryBranchManage = 0;

function openUpdateOutInventoryInternalManage(id, branch) {
    checkChangeUpdateOutInventoryBranchManage = 0;
    saveUpdateOutInventoryBranchManage = 0;
    $('#modal-update-out-inventory-internal-manage').modal('show');
    $('#select-material-update-out-inventory-internal-manage').select2({
        dropdownParent: $('#modal-update-out-inventory-internal-manage'),
    });
    dateTimePickerDayTemplate($('#day-update-out-inventory-internal-manage'));
    shortcut.remove('F2');
    shortcut.add('F4', function () {
        saveModalUpdateOutInventoryInternalManage();
    });
    shortcut.add('F9', function () {
        if ($('#select-material-update-out-inventory-internal-manage').select2('isOpen') === true) {
            $('#select-material-update-out-inventory-internal-manage').select2('close');
        } else {
            $('#modal-update-out-inventory-internal-manage .js-example-basic-single').select2('close');
            $('#select-material-update-out-inventory-internal-manage').select2('open');
        }
    });
    shortcut.add('ESC', function () {
        closeModalUpdateOutInventoryInternalManage();
    });
    idUpdateOutInventoryBranchManage = id;
    branchUpdateOutInventoryBranchManage = branch;
    $('#select-material-update-out-inventory-internal-manage').unbind('select2:select').on('select2:select', function () {
        selectMaterialUpdateOutInventoryInternalManage();
    });
    $('#discount-type-update-out-inventory-internal-manage').on('change', function () {
        if ($(this).val() === '1' && removeformatNumber($('#discount-update-out-inventory-internal-manage').val()) > 100) {
            $('#discount-update-out-inventory-internal-manage').val('100');
            $('#discount-update-out-inventory-internal-manage').select();
            alertify.notify('Chiết khấu tối đa 100% !', 'error', 5);
        }
        sumUpdateOutInventoryInternalManage();
    });
    $(document).on('input', 'table#table-material-update-out-inventory-internal-manage tbody input.quantity', function () {
        let quantity = parseFloat(removeformatNumber($(this).val()));
        let price = parseFloat(removeformatNumber($(this).parents('tr').find('.price').text()));
        $(this).parents('td').find('label').text(quantity);
        $(this).parents('tr').find('label.total').text(formatNumber(checkDecimal(quantity * price)));
        sumUpdateOutInventoryInternalManage();
    });

    $(document).on('input', 'table#table-material-update-out-inventory-internal-manage tbody input.price', function () {
        let price = parseFloat(removeformatNumber($(this).val()));
        let quantity = parseFloat(removeformatNumber($(this).parents('tr').find('input.quantity').val()));
        $(this).parents('td').find('label').text(price);
        $(this).parents('tr').find('label.total').text(formatNumber(checkDecimal(quantity * price)));
        sumUpdateOutInventoryInternalManage();
    });

    $(document).on('keypress', 'table#table-material-update-out-inventory-internal-manage tbody input.quantity', function (e) {
        if (e.keyCode === 13) {
            $(this).parents('tr').find('input.price').select();
        }
    });
    $(document).on('keypress', 'table#table-material-update-out-inventory-internal-manage tbody input.price', function (e) {
        if (e.keyCode === 13) {
            let last_tr = $(this).parents('tr').index() + 1;
            $(this).parents('tbody').find('tr:eq(' + last_tr + ')').find('input.quantity').select();
        }
    });

    $(document).on('focus', 'input', function () {
        $(this).select();
    });
    dataUpdateOutInventoryInternalManage(id, branch);
}

async function dataUpdateOutInventoryInternalManage(id, branch) {
    let method = 'get',
        url = 'out-inventory-branch-manage.data-update',
        params = {branch: branch, id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $('#loading-update-out-inventory-internal-manage')
    ]);
    $('#table-material-update-out-inventory-internal-manage tbody').html(res.data[0]);
    $('#branch-update-out-inventory-internal-manage').text(res.data[1].branch);
    $('#target-branch-update-out-inventory-internal-manage').text(res.data[1].target_branch);
    $('#code-update-out-inventory-internal-manage').text(res.data[1].code);
    $('#inventory-update-out-inventory-internal-manage').text(res.data[1].inventory);
    $('#employee-update-out-inventory-internal-manage').text(res.data[1].employee);
    $('#create-update-out-inventory-internal-manage').text(res.data[1].create);
    $('#date-update-out-inventory-internal-manage').text(res.data[1].date);
    $('#total-record-update-out-inventory-internal-manage').text(res.data[1].total_record_material);
    $('#total-final-update-out-inventory-internal-manage').text(res.data[1].total_amount);

    inventoryUpdateOutInventoryBranchManage = res.data[1].inventory_id;
    targetUpdateOutInventoryBranchManage = res.data[1].target_branch_id;
    dataMaterialUpdateOutInventoryInternalManage(res.data[1].branch_id, res.data[1].inventory_id, res.data[1].list_material)
}

async function dataMaterialUpdateOutInventoryInternalManage(branch, inventory, material) {
    if (checkDataMaterialOutInventoryUpdate === 1) return false;
    checkDataMaterialOutInventoryUpdate = 1;
    let method = 'post',
        url = 'out-inventory-branch-manage.material',
        params = null,
        data = {branch: branch, inventory: inventory, material: material};
    let res = await axiosTemplate(method, url, params, data,[
        $('#select-material-update-out-inventory-internal-manage')
    ]);
    checkDataMaterialOutInventoryUpdate = 0;
    $('#select-material-update-out-inventory-internal-manage').html(res.data[0]);
}

function selectMaterialUpdateOutInventoryInternalManage() {
    let id = $('#select-material-update-out-inventory-internal-manage').find(':selected').val(),
        name = $('#select-material-update-out-inventory-internal-manage').find(':selected').text(),
        supplier = $('#select-material-update-out-inventory-internal-manage').find(':selected').data('supplier'),
        remain_quantity = $('#select-material-update-out-inventory-internal-manage').find(':selected').data('remain-quantity'),
        unit = $('#select-material-update-out-inventory-internal-manage').find(':selected').data('unit'),
        unit_value = $('#select-material-update-out-inventory-internal-manage').find(':selected').data('unit-value'),
        price = $('#select-material-update-out-inventory-internal-manage').find(':selected').data('price'),
        price_format = $('#select-material-update-out-inventory-internal-manage').find(':selected').data('price-format');
    $('#table-material-update-out-inventory-internal-manage tbody').prepend('<tr>\n' +
        '<td class="text-center"><label>' + name + '</label><input value="' + id + '" class="d-none" data-type="0" data-id-update="0"/></td>\n' +
        '<td class="text-center">' + supplier + '</td>\n' +
        '<td class="text-center"><label>' + remain_quantity + '</label></td>\n' +
        '<td class="text-center"><select class="form-control edit-height-select-group change-type-table">\n' +
        '<option value="1">' + unit + '</option>\n' +
        '<option value="2">' + unit_value + '</option>\n' +
        '</select></td>\n' +
        '<td><input class="form-control quantity text-right" data-max="1000000" data-value-min-value-of="0" data-float="1" value="1"/><label class="d-none quantity-label">1</label></td>\n' +
        '<td><input class="form-control price text-right" data-type="currency-edit" value="1" placeholder="1" value="' + price_format + '"/><label class="d-none price-label">' + price + '</label></td>\n' +
        '<td class="text-center"><label class="total">' + price_format + '</label></td>\n' +
        '<td class="text-center">\n' +
        '<div class="btn-group-sm">\n' +
        '<button class="tabledit-delete-button btn btn-danger waves-effect waves-light" onclick="removeMaterialUpdateOutInventoryInternalManage(this)"><span class="icofont icofont-ui-delete"></span></button>\n' +
        '</div></td>\n' +
        '</tr>');
    $('#select-material-update-out-inventory-internal-manage').find(':selected').remove();
    $('#select-material-update-out-inventory-internal-manage').val('').trigger('change.select2');
    $('#table-material-update-out-inventory-internal-manage tbody tr:eq(0)').find('input.quantity').select();
    checkRemoveUpdateOutInventoryInternalManage(id);
    sumUpdateOutInventoryInternalManage();
}

function checkRemoveUpdateOutInventoryInternalManage(id) {
    jQuery.each(tableDeleteUpdateOutInventoryBranchManage, function (row, tr) {
        if (tr.material_id === id) {
            tableDeleteUpdateOutInventoryBranchManage.splice(row, 1);
            return false;
        }
    });
}


function removeMaterialUpdateOutInventoryInternalManage(r) {
    let i = r.parentNode.parentNode.parentNode;
    $('#table-material-update-out-inventory-internal-manage tbody tr').eq(i.rowIndex - 1).remove();
    sumUpdateOutInventoryInternalManage();
    let supplier = $(i).find('td:eq(1)').find('label').text(),
        remain_quantity = $(i).find('td:eq(3)').text(),
        unit = $(i).find('td:eq(4)').find('select option:first').text(),
        unit_value = $(i).find('td:eq(4)').find('select option:nth-child(2)').text(),
        price = $(i).find('td:eq(6)').find('label').text(),
        price_format = $(i).find('td:eq(6)').find('input').val(),
        material_id = $(i).find('td:eq(0)').find('input').val(),
        name = $(i).find('td:eq(0)').find('label').text();
    $('#select-material-update-out-inventory-internal-manage').append('<option data-supplier="' + supplier + '" data-supplier-id="' + supplier_id + '" data-remain-quantity="' + remain_quantity + '" data-unit="' + unit + '" data-unit-value="' + unit_value + '" data-price="' + price + '" data-price-format="' + price_format + '" value="' + material_id + '">' + name + '</option>');

    if ($('#select-material-update-out-inventory-internal-manage').find('option:first').val() === '0') {
        $('#select-material-update-out-inventory-internal-manage').find('option:first').val('');
        $('#select-material-update-out-inventory-internal-manage').find('option:first').text($('#option-default-update-in-inventory-internal-manage').text());
        $('#select-material-update-out-inventory-internal-manage').select2({
            dropdownParent: $('#modal-update-out-inventory-internal-manage'),
        });
    }
}

async function sumUpdateOutInventoryInternalManage() {
    let total_price = 0;
    $('#total-record-update-out-inventory-internal-manage').text(formatNumber($('#table-material-update-out-inventory-internal-manage tbody tr').length));
    await $('table#table-material-update-out-inventory-internal-manage tbody tr').each(function () {
        total_price += parseFloat(removeformatNumber($(this).find('td:eq(6)').text()));
    });
    $('#total-final-update-out-inventory-internal-manage').text(formatNumber(total_price));
}

async function saveModalUpdateOutInventoryInternalManage() {
    if (saveUpdateOutInventoryBranchManage === 1) return false;
    if (!checkValidateSave($('#modal-create-out-inventory-internal-manage'))) return false;
    let TableData = [];
    $('#table-material-update-out-inventory-internal-manage tbody tr').each(function (row, tr) {
        TableData[row] = {
            "id": $(tr).find('td:eq(0)').find('input').data('id-update'),
            "action_type": $(tr).find('td:eq(0)').find('input').data('type'),
            "material_id": $(tr).find('td:eq(0)').find('input').val(),
            "supplier_material_id": $(tr).find('td:eq(1)').find('input').val(),
            "user_input_quantity": $(tr).find('td:eq(4)').find('label').text(),
            "user_input_unit_type": $(tr).find('td:eq(3)').find('select').val(),
            "user_input_price": $(tr).find('td:eq(5)').find('input').val(),
            "note": JSON.stringify(""),
            "sort": row
        };
    });
    let TableAll = TableData.concat(tableDeleteUpdateOutInventoryBranchManage);
    let note = $('#note-update-out-inventory-internal-manage').val(),
        date = $('#date-update-out-inventory-internal-manage').text();
    if (TableData.length === 0) {
        WarningNotify('Vui lòng chọn nguyên liệu !');
        return false;
    }
    saveUpdateOutInventoryBranchManage = 1;
    let method = 'post',
        url = 'out-inventory-branch-manage.update',
        params = null,
        data = {
            table: TableAll,
            note: note,
            id: idUpdateOutInventoryBranchManage,
            delivery_date: date,
            branch_id: branchUpdateOutInventoryBranchManage,
            target_branch_id: targetUpdateOutInventoryBranchManage,
            inventory: inventoryUpdateOutInventoryBranchManage,
        };
    let res = await axiosTemplate(method, url, params, data,[
        $('#loading-update-out-inventory-internal-manage')
    ]);
    saveUpdateOutInventoryBranchManage = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalUpdateOutInventoryInternalManage();
            loadData();
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
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

function cancelOutInventoryInternalManage() {
    if (checkUpdateCancelOutInventoryBranch === 1) return false;
    let title = 'Vui lòng nhập lý do hủy !',
        element = 'cancel-out-inventory-internal-manage';
    sweetAlertInputComponent(title, element).then(async (result) => {
        if (result.isConfirmed) {
            checkUpdateCancelOutInventoryBranch = 1;
            let method = 'post',
                branch = branchUpdateOutInventoryBranchManage,
                id = idUpdateOutInventoryBranchManage,
                note = $('#cancel-out-inventory-internal-manage').val(),
                url = 'out-inventory-branch-manage.cancel',
                params = null,
                data = {branch: branch, id: id, note: note};
            let res = await axiosTemplate(method, url, params, data);
            checkUpdateCancelOutInventoryBranch = 0;
            let text = $('#success-create-data-to-server').text();
            switch (res.data.status){
                case 200:
                    SuccessNotify(text);
                    closeModalUpdateOutInventoryInternalManage();
                    loadData();
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
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
    });
}

function closeModalUpdateOutInventoryInternalManage() {
    shortcut.add('F2', function () {
        openCreateOutInventoryInternalManage();
    });
    shortcut.remove('F4');
    shortcut.remove('F9');
    shortcut.remove('ESC');
    $('#modal-update-out-inventory-internal-manage').modal('hide');

    $('#table-material-update-out-inventory-internal-manage tbody').html('');
    $('#branch-update-out-inventory-internal-manage').text('');
    $('#target-branch-update-out-inventory-internal-manage').text('');
    $('#code-update-out-inventory-internal-manage').text('');
    $('#inventory-update-out-inventory-internal-manage').text('');
    $('#employee-update-out-inventory-internal-manage').text('');
    $('#create-update-out-inventory-internal-manage').text('');
    $('#date-update-out-inventory-internal-manage').text('');
    $('#total-record-update-out-inventory-internal-manage').text('');
    $('#total-final-update-out-inventory-internal-manage').text('');
}
