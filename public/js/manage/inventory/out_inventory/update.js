let checkChangeUpdateOutInventoryManage = 0,
    idUpdateOutInventoryManage,
    branchUpdateOutInventoryManage,
    exportUpdateOutInventoryManage,
    tableDeleteUpdateOutInventoryManage = [],
    saveUpdateOutInventoryManage = 0, checkCancelOutInventoryManage = 0;

function openUpdateOutInventoryManage(id, branch) {
    checkChangeUpdateOutInventoryManage = 0;
    saveUpdateOutInventoryManage = 0;
    exportUpdateOutInventoryManage = '';
    $('#modal-update-out-inventory-manage').modal('show');
    $('#select-material-update-out-inventory-manage').select2({
        dropdownParent: $('#modal-update-out-inventory-manage'),
    });
    dateTimePickerDayTemplate($('#day-update-out-inventory-manage'));
    shortcut.remove('F2');
    shortcut.add('F4', function () {
        saveModalUpdateOutInventoryManage();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateOutInventoryManage();
    });
    idUpdateOutInventoryManage = id;
    branchUpdateOutInventoryManage = branch;
    $('#select-material-update-out-inventory-manage').unbind('select2:select').on('select2:select', function () {
        selectMaterialUpdateOutInventoryManage();
    });
    $('#discount-type-update-out-inventory-manage').on('change', function () {
        if ($(this).val() === '1' && removeformatNumber($('#discount-update-out-inventory-manage').val()) > 100) {
            $('#discount-update-out-inventory-manage').val('100');
            $('#discount-update-out-inventory-manage').select();
            alertify.notify('Chiết khấu tối đa 100% !', 'error', 5);
        }
        sumUpdateOutInventoryManage();
    });
    $(document).on('input', 'table#table-material-update-out-inventory-manage tbody input.quantity', function () {
        if (removeformatNumber($(this).val()) < 0) {
            $(this).val(1);
            $(this).select();
            alertify.notify('Tối thiểu bằng 1 !', 'error', 5);
        }
        if (removeformatNumber($(this).val()) > 1000000) {
            $(this).val('1,000,000');
            $(this).select();
            alertify.notify('Tối đa bằng 1,000,000 !', 'error', 5);
        }
        let quantity = parseFloat(removeformatNumber($(this).val()));
        let price = parseFloat(removeformatNumber($(this).parents('tr').find('.price').text()));
        $(this).parents('td').find('label').text(quantity);
        $(this).parents('tr').find('label.total').text(formatNumber(checkDecimal(quantity * price)));
        sumUpdateOutInventoryManage();
    });
    $(document).on('keypress', 'table#table-material-update-in-inventory-manage tbody input.quantity', function (e) {
        if (e.keyCode === 13) {
            let last_tr = $(this).parents('tr').index() + 1;
            $(this).parents('tbody').find('tr:eq(' + last_tr + ')').find('input.quantity').select();
        }
    });
    $(document).on('focus', 'input', function () {
        $(this).select();
    });
    dataUpdateOutInventoryManage(id, branch);
}

async function dataUpdateOutInventoryManage(id, branch) {
    let method = 'get',
        url = 'out-inventory-manage.data-update',
        params = {branch: branch, id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-update-out-inventory-manage')
    ]);
    $('#table-material-update-out-inventory-manage tbody').html(res.data[0]);
    $('#branch-update-out-inventory-manage').text(res.data[1].branch);
    $('#code-update-out-inventory-manage').text(res.data[1].code);
    $('#inventory-update-out-inventory-manage').text(res.data[1].inventory);
    $('#employee-update-out-inventory-manage').text(res.data[1].employee);
    $('#target-update-out-inventory-manage').text(res.data[1].export);
    $('#note-update-out-inventory-manage').val(res.data[1].note);
    exportUpdateOutInventoryManage = res.data[1].export_type;
    $('#create-update-out-inventory-manage').text(res.data[1].create);
    $('#date-update-out-inventory-manage').text(res.data[1].date);
    $('#inventory-id-update-out-inventory-manage').text(res.data[1].inventory_id);
    $('#total-record-update-out-inventory-manage').text(res.data[1].total_record_material);
    dataMaterialUpdateOutInventoryManage(res.data[1].branch_id, res.data[1].inventory_id, res.data[1].list_material)
}

async function dataMaterialUpdateOutInventoryManage(branch, inventory) {
    let method = 'get',
        url = 'out-inventory-manage.material',
        params = {branch: branch, inventory: inventory},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-material-update-out-inventory-manage')
    ]);
    $('#select-material-update-out-inventory-manage').html(res.data[0]);
}

function selectMaterialUpdateOutInventoryManage() {
    let id = $('#select-material-update-out-inventory-manage').find(':selected').val(),
        name = $('#select-material-update-out-inventory-manage').find(':selected').text(),
        supplier = $('#select-material-update-out-inventory-manage').find(':selected').data('supplier'),
        remain_quantity = $('#select-material-update-out-inventory-manage').find(':selected').data('remain-quantity'),
        unit = $('#select-material-update-out-inventory-manage').find(':selected').data('unit'),
        unit_value = $('#select-material-update-out-inventory-manage').find(':selected').data('unit-value'),
        price = $('#select-material-update-out-inventory-manage').find(':selected').data('price'),
        price_format = $('#select-material-update-out-inventory-manage').find(':selected').data('price-format'),
        unit_option = '',
        unit_option_value = '';
    if ($('#select-inventory-update-out-inventory-manage').val() === '2') {
        unit_option = unit_value;
        unit_option_value = 2;
    } else {
        unit_option = unit;
        unit_option_value = 1;
    }
    $('#table-material-update-out-inventory-manage tbody').append('<tr>\n' +
        '<td class="text-center"><label>' + name + '</label><input value="' + id + '" class="d-none" data-type="0" data-id-update="0"/></td>\n' +
        '<td class="text-center d-none">' + supplier + '</td>\n' +
        '<td class="text-center"><label>' + remain_quantity + '</label></td>\n' +
        '<td class="text-center"><label data-value="' + unit_option_value + '">' + unit_option + '</label></td>\n' +
        '<td><input class="form-control quantity text-right" data-type="currency-edit" value="1" placeholder="1" data-table-not-empty/><label class="d-none quantity-label">1</label></td>\n' +
        '<td class="text-center d-none"><input class="d-none" value="' + price + '"/><label class="price">' + price_format + '</label></td>\n' +
        '<td class="text-center d-none"><label class="total">' + price_format + '</label></td>\n' +
        '<td class="text-center">\n' +
        '<div class="btn-group-sm">\n' +
        '<button class="tabledit-delete-button btn btn-danger waves-effect waves-light" onclick="removeMaterialUpdateOutInventoryManage(this)"><span class="icofont icofont-ui-delete"></span></button>\n' +
        '</div></td>\n' +
        '</tr>');
    $('#select-material-update-out-inventory-manage').find(':selected').remove();
    $('#select-material-update-out-inventory-manage').val('').trigger('change.select2');
    $('#table-material-update-out-inventory-manage tbody tr:eq(0)').find('input.quantity').select();
    checkRemoveUpdateOutInventoryManage(id);
    sumUpdateOutInventoryManage();
}

function checkRemoveUpdateOutInventoryManage(id) {
    jQuery.each(tableDeleteUpdateOutInventoryManage, function (row, tr) {
        if (tr.material_id === id) {
            tableDeleteUpdateOutInventoryManage.splice(row, 1);
            return false;
        }
    });
}

function removeMaterialUpdateOutInventoryManage(r) {
    let i = r.parentNode.parentNode.parentNode;
    $('#table-material-update-out-inventory-manage tbody tr').eq(i.rowIndex - 1).remove();
    sumUpdateOutInventoryManage();
    let supplier = $(i).find('td:eq(1)').find('label').text(),
        remain_quantity = $(i).find('td:eq(3)').text(),
        unit = $(i).find('td:eq(4)').find('select option:first').text(),
        unit_value = $(i).find('td:eq(4)').find('select option:nth-child(2)').text(),
        price = $(i).find('td:eq(6)').find('label').text(),
        price_format = $(i).find('td:eq(6)').find('input').val(),
        id = $(i).find('td:eq(0)').find('input').attr('data-id-update'),
        material_id = $(i).find('td:eq(0)').find('input').val(),
        name = $(i).find('td:eq(0)').find('label').text();
    $('#select-material-update-out-inventory-manage').append('<option data-supplier="' + supplier + '" data-remain-quantity="' + remain_quantity + '" data-unit="' + unit + '" data-unit-value="' + unit_value + '" data-price="' + price + '" data-price-format="' + price_format + '" value="' + material_id + '">' + name + '</option>');
    tableDeleteUpdateOutInventoryManage.push({
        "id": id,
        "action_type": "2",
        "material_id": material_id,
        "user_input_quantity": "1",
        "user_input_unit_type": "1",
        "user_input_price": "0",
        "note": JSON.stringify(""),
        "sort": "0"
    });
    if ($('#select-material-update-out-inventory-manage').find('option:first').val() === '0') {
        $('#select-material-update-out-inventory-manage').find('option:first').val('');
        $('#select-material-update-out-inventory-manage').find('option:first').text($('#option-default-update-in-inventory-manage').text());
        $('#select-material-update-out-inventory-manage').select2({
            dropdownParent: $('#modal-update-out-inventory-manage'),
        });
    }
}

async function sumUpdateOutInventoryManage() {
    $('#total-record-update-out-inventory-manage').text(formatNumber($('#table-material-update-out-inventory-manage tbody tr').length));
}

async function saveModalUpdateOutInventoryManage() {
    if (saveUpdateOutInventoryManage === 1) return false;
    if ($('#table-material-update-out-inventory-manage tbody tr').length === 0) {
        ErrorNotify('Vui lòng nhập dữ liệu !');
        return false;
    }
    let TableData = [];
    let check_empty_table = 0;
    await $('#table-material-update-out-inventory-manage tbody tr').each(function (row, tr) {
        if ($(tr).find('td:eq(4)').find('label').text() === "" || $(tr).find('td:eq(4)').find('label').text() === "0") {
            $(tr).find('td:eq(4)').find('input').addClass('error-valid');
            check_empty_table = 1;
        }
        TableData[row] = {
            "id": $(tr).find('td:eq(0)').find('input').data('id-update'),
            "action_type": $(tr).find('td:eq(0)').find('input').data('type'),
            "material_id": $(tr).find('td:eq(0)').find('input').val(),
            "user_input_quantity": $(tr).find('td:eq(4)').find('label').text(),
            "user_input_unit_type": $(tr).find('td:eq(3)').find('label').data('value'),
            "user_input_price": $(tr).find('td:eq(5)').find('input').val(),
            "note": JSON.stringify(""),
            "sort": row
        };
    });
    if (check_empty_table === 1) return false;
    let TableAll = TableData.concat(tableDeleteUpdateOutInventoryManage);
    let note = $('#note-update-out-inventory-manage').val(),
        date = $('#date-update-out-inventory-manage').val(),
        inventory = $('#inventory-id-update-out-inventory-manage').text();
    saveUpdateOutInventoryManage = 1;
    let method = 'post',
        url = 'out-inventory-manage.update',
        params = null,
        data = {
            table: TableAll,
            note: note,
            id: idUpdateOutInventoryManage,
            delivery_date: date,
            branch_id: branchUpdateOutInventoryManage,
            inventory: inventory,
            export: exportUpdateOutInventoryManage
        };

    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-update-out-inventory-manage')
    ]);
    saveUpdateOutInventoryManage = 0;
    let text = $('#success-update-data-to-server').text();
    switch (res.data.status) {
        case 200 :
            SuccessNotify(text);
            closeModalUpdateOutInventoryManage();
            loadingData();
            break;
        case 500:
             text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            ErrorNotify(text);
            break;
        default :
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
    }
}

function cancelOutInventoryManage() {
    if (checkCancelOutInventoryManage === 1) return false;
    let title = 'Vui lòng nhập lý do hủy !',
        element = 'input-cancel-out-inventory-manage';
    sweetAlertInputComponent(title, element).then(async (result) => {
        if (result.value) {
            checkCancelOutInventoryManage = 1;
            let method = 'post',
                branch = branchUpdateOutInventoryManage,
                id = idUpdateOutInventoryManage,
                note = $('#input-cancel-out-inventory-manage').val(),
                url = 'out-inventory-manage.cancel',
                params = null,
                data = {branch: branch, id: id, note: note};
            let res = await axiosTemplate(method, url, params, data,[
                $('#loading-update-out-inventory-manage')
            ]);
            checkCancelOutInventoryManage = 0;
            let text = $('#success-cancel-data-to-server').text();
            switch (res.data.status){
                case 200:
                    SuccessNotify(text);
                    closeModalUpdateOutInventoryManage();
                    loadData();
                case 500:
                     text = $('#error-post-data-to-server').data();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    ErrorNotify(text);
                default :
                    text = $('#error-post-data-to-server').data();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    WarningNotify(text);
            }
        }
    });
}

function closeModalUpdateOutInventoryManage() {
    shortcut.add('F2', function () {
        openCreateOutInventoryManage();
    });
    shortcut.remove('F4');
    shortcut.remove('ESC');
    $('#modal-update-out-inventory-manage').modal('hide');
}
