let checkChangeUpdateInInventoryManage,
    idUpdateInInventoryManage,
    branchUpdateInInventoryManage,
    saveUpdateInInventoryManage,
    tableDeleteUpdateInInventoryManage = [],
    getSelectMaterialUpdateInInventoryManage = $('#select-material-update-in-inventory-manage'),
    vatUpdateInInventoryManage = $('#vat-update-in-inventory-manage'),
    discountUpdateInInventoryManage = $('#discount-update-in-inventory-manage'),
    showModalUpdateInInventoryManage = $('#modal-update-in-inventory-manage');

async function openUpdateInInventoryManage(id, branch) {
    checkChangeUpdateInInventoryManage = 0;
    idUpdateInInventoryManage = id;
    branchUpdateInInventoryManage = branch;
    saveUpdateInInventoryManage = 0;
    showModalUpdateInInventoryManage.modal('show');
    getSelectMaterialUpdateInInventoryManage.select2({
        dropdownParent: showModalUpdateInInventoryManage,
    });
   dateTimePickerDayTemplate($('#day-update-in-inventory-manage'));
    shortcut.add('F4', function () {
        saveModalUpdateInInventoryManage();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateInInventoryManage();
    });
    vatUpdateInInventoryManage.on('change', function () {
        sumUpdateInInventoryManage();
    });
    discountUpdateInInventoryManage.on('input', function () {
        sumUpdateInInventoryManage();
    });
    getSelectMaterialUpdateInInventoryManage.unbind('select2:select').on('select2:select', function () {
        selectMaterialUpdateInInventoryManage();
    });
    $('#discount-type-update-in-inventory-manage').on('change', function () {
        if ($(this).val() === '1' && removeformatNumber(discountUpdateInInventoryManage.val()) > 100) {
            discountUpdateInInventoryManage.val('100');
            discountUpdateInInventoryManage.select();
            alertify.notify('Chiết khấu tối đa 100% !', 'error', 5);
        }
        sumUpdateInInventoryManage();
    });
    $(document).on('input', 'table#table-material-update-in-inventory-manage tbody input.quantity', function () {
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
        let price = parseFloat(removeformatNumber($(this).parents('tr').find('input.price').val()));
        $(this).parents('td').find('label').text(quantity);
        $(this).parents('tr').find('label.total').text(formatNumber(checkDecimal(quantity * price)));
        sumUpdateInInventoryManage();
    });
    $(document).on('input', 'table#table-material-update-in-inventory-manage tbody input.price', function () {
        if (removeformatNumber($(this).val()) < 0) {
            $(this).val(0);
            $(this).select();
            alertify.notify('Tối thiểu bằng 0 !', 'error', 5);
        }
        if (removeformatNumber($(this).val()) > 100000000) {
            $(this).val('100,000,000');
            $(this).select();
            alertify.notify('Tối đa bằng 100,000,000 !', 'error', 5);
        }
        let price = parseFloat(removeformatNumber($(this).val()));
        let quantity = parseFloat(removeformatNumber($(this).parents('tr').find('input.quantity').val()));
        $(this).parents('td').find('label').text(price);
        $(this).parents('tr').find('label.total').text(formatNumber(checkDecimal(quantity * price)));
        sumUpdateInInventoryManage();
    });
    $(document).on('keypress', 'table#table-material-update-in-inventory-manage tbody input.quantity', function (e) {
        if (e.keyCode === 13) {
            $(this).parents('tr').find('input.price').select();
        }
    });

    $(document).on('keypress', 'table#table-material-update-in-inventory-manage tbody input.price', function (e) {
        if (e.keyCode === 13) {
            let last_tr = $(this).parents('tr').index() + 1;
            $(this).parents('tbody').find('tr:eq(' + last_tr + ')').find('input.quantity').select();
        }
    });
    $(document).on('focus', 'input', function () {
        $(this).select();
    });
    dataUpdateInInventoryManage(id, branch);
}

async function dataUpdateInInventoryManage(id, branch) {
    let method = 'get',
        url = 'in-inventory-manage.data-update',
        params = {branch: branch, id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $('#loading-update-in-inventory-manage')
    ]);
    $('#branch-update-in-inventory-manage').text(res.data[1].branch);
    $('#code-update-in-inventory-manage').text(res.data[1].branch);
    $('#supplier-update-in-inventory-manage').text(res.data[1].supplier);
    $('#inventory-update-in-inventory-manage').text(res.data[1].inventory);
    $('#employee-update-in-inventory-manage').text(res.data[1].employee);
    $('#create-update-in-inventory-manage').text(res.data[1].create);
    $('#date-update-in-inventory-manage').text('/' + (res.data[1].date).slice(3, 10));
    $('#day-update-in-inventory-manage').val((res.data[1].date).slice(0, 2));
    $('#table-material-update-in-inventory-manage tbody').html(res.data[0]);
    discountUpdateInInventoryManage.val(res.data[1].discount);
    $('#inventory-id-update-in-inventory-manage').text(res.data[1].inventory_id);
    $('#discount-type-update-in-inventory-manage').val(res.data[1].discount_type).trigger('change');
    if (res.data[1].vat === 1) {
        vatUpdateInInventoryManage.prop('checked', true);
    } else {
        vatUpdateInInventoryManage.prop('checked', false);
    }
    $('#total-record-update-in-inventory-manage').text(res.data[1].total_record_material);
    $('#total-sum-price-update-in-inventory-manage').text(res.data[1].amount);
    $('#total-final-update-in-inventory-manage').text(res.data[1].total_amount);
    $('#note-update-in-inventory-manage').text(res.data[1].note);
    $('#discount-update-in-inventory-manage').val(res.data[1].discount);
    dataMaterialUpdateInInventoryManage(res.data[1].branch_id, res.data[1].supplier_id, res.data[1].inventory_id, res.data[1].list_material)
}

async function dataMaterialUpdateInInventoryManage(branch, supplier, inventory, material) {
    let method = 'POST',
        url = 'in-inventory-manage.material',
        params = null,
        data = {branch: branch, supplier: supplier, inventory: inventory, material: material};
    let res = await axiosTemplate(method, url, params, data,[
        $('#loading-update-in-inventory-manage')
    ]);
    $('#select-material-update-in-inventory-manage').html(res.data[0]);
}

function selectMaterialUpdateInInventoryManage() {
    let id = getSelectMaterialUpdateInInventoryManage.find(':selected').val(),
        name = getSelectMaterialUpdateInInventoryManage.find(':selected').text(),
        supplier = getSelectMaterialUpdateInInventoryManage.find(':selected').data('supplier'),
        supplier_id = getSelectMaterialUpdateInInventoryManage.find(':selected').data('supplier-id'),
        remain_quantity = getSelectMaterialUpdateInInventoryManage.find(':selected').data('remain-quantity-format'),
        unit = getSelectMaterialUpdateInInventoryManage.find(':selected').data('unit'),
        unit_value = getSelectMaterialUpdateInInventoryManage.find(':selected').data('unit-value'),
        price = getSelectMaterialUpdateInInventoryManage.find(':selected').data('price'),
        price_format = getSelectMaterialUpdateInInventoryManage.find(':selected').data('price-format');
    if (remain_quantity === undefined) remain_quantity = 0;
    $('#table-material-update-in-inventory-manage tbody').append('<tr>\n' +
        '<td class="text-center"><label>' + name + '</label><input value="' + id + '" class="d-none" data-type="0" data-id-update="0"/></td>\n' +
        '<td class="text-center"><label>' + supplier + '</label><input value="' + supplier_id + '" class="d-none"/></td>\n' +
        '<td class="text-center"><label>' + remain_quantity + '</label></td>\n' +
        '<td class="text-center"><select class="form-control edit-height-select-group change-type-table rounded">\n' +
        '<option value="1">' + unit + '</option>\n' +
        '<option value="2">' + unit_value + '</option>\n' +
        '</select></td>\n' +
        '<td><input class="form-control quantity text-right rounded" data-table="1000000" data-type="currency-edit" value="1" placeholder="1" data-table-not-empty/><label class="d-none quantity-label">1</label></td>\n' +
        '<td><input class="form-control price text-right rounded" data-table="100000000" data-type="currency-edit" value="' + price_format + '" placeholder="1" data-table-not-empty/><label class="d-none price-label">' + price + '</label></td>\n' +
        '<td class="text-center"><label class="total">' + price_format + '</label></td>\n' +
        '<td class="text-center">\n' +
        '<div class="btn-group-sm">\n' +
        '<button class="tabledit-delete-button btn btn-danger waves-effect waves-light" onclick="removeMaterialUpdateInInventoryManage(this)"><span class="icofont icofont-ui-delete"></span></button>\n' +
        '</div></td>\n' +
        '</tr>');
    getSelectMaterialUpdateInInventoryManage.find(':selected').remove();
    getSelectMaterialUpdateInInventoryManage.val('').trigger('change.select2');
    $('#table-material-update-in-inventory-manage tbody tr:eq(0)').find('input.quantity').select();
    checkRemoveUpdateInInventoryManage(id);
    sumUpdateInInventoryManage();
}

function checkRemoveUpdateInInventoryManage(id) {
    jQuery.each(tableDeleteUpdateInInventoryManage, function (row, tr) {
        if (tr.material_id === id) {
            tableDeleteUpdateInInventoryManage.splice(row, 1);
            return false;
        }
    });
}


function removeMaterialUpdateInInventoryManage(r) {
    let i = r.parentNode.parentNode.parentNode;
    $('#table-material-update-in-inventory-manage tbody tr').eq(i.rowIndex - 1).remove();
    sumUpdateInInventoryManage();
    let supplier = $(i).find('td:eq(1)').find('label').text(),
        supplier_id = $(i).find('td:eq(1)').find('input').val(),
        remain_quantity = $(i).find('td:eq(2)').text(),
        unit = $(i).find('td:eq(3)').find('select option:first').text(),
        unit_value = $(i).find('td:eq(3)').find('select option:nth-child(2)').text(),
        price = $(i).find('td:eq(5)').find('label').text(),
        price_format = $(i).find('td:eq(5)').find('input').val(),
        id_update = $(i).find('td:eq(0)').find('input').data('id-update'),
        id = $(i).find('td:eq(0)').find('input').val(),
        name = $(i).find('td:eq(0)').find('label').text();
    getSelectMaterialUpdateInInventoryManage.append('<option data-supplier="' + supplier + '" data-supplier-id="' + supplier_id + '" data-remain-quantity="' + remain_quantity + '" data-unit="' + unit + '" data-unit-value="' + unit_value + '" data-price="' + price + '" data-price-format="' + price_format + '" value="' + id + '">' + name + '</option>');
    // let text = 'Xóa nguyên liệu thành công !';
    tableDeleteUpdateInInventoryManage.push({
        "id": id_update,
        "action_type": 2,
        "material_id": id,
        "supplier_material_id": supplier_id,
        "user_input_quantity": 1,
        "user_input_unit_type": 1,
        "user_input_price": 0,
        "note": "---",
        "sort": 0
    });
    // SuccessNotify(text);
}

async function sumUpdateInInventoryManage() {
    let total_price = 0,
        discount = discountUpdateInInventoryManage.val(),
        vat = 0;
    $('#total-record-update-in-inventory-manage').text(formatNumber($('#table-material-update-in-inventory-manage tbody tr').length));
    await $('table#table-material-update-in-inventory-manage tbody tr').each(function () {
        total_price += parseFloat(removeformatNumber($(this).find('td:eq(6)').text()));
    });
    $('#total-sum-price-update-in-inventory-manage').text(formatNumber(total_price));
    if ($('#discount-type-update-in-inventory-manage').val() === '1') {
        discount = checkDecimal(total_price * parseFloat(removeformatNumber(discountUpdateInInventoryManage.val()) / 100));
    }
    if (vatUpdateInInventoryManage.is(':checked')) {
        vat = parseFloat($('#vat-default').val()) / 100;
    }
    let total_vat = checkDecimal((total_price - discount) * vat);
    $('#total-final-update-in-inventory-manage').text(formatNumber(total_price - discount + total_vat));
}

async function saveModalUpdateInInventoryManage() {
    if (saveUpdateInInventoryManage !== 0) {
        return false;
    }
    if ($('#table-material-update-in-inventory-manage tbody tr').length === 0) {
        ErrorNotify('Vui lòng nhập dữ liệu !');
        return false;
    }
    let TableData = [];
    let check_empty_table = 0;
    await $('#table-material-update-in-inventory-manage tbody tr').each(function (row, tr) {
        if ($(tr).find('td:eq(4)').find('label').text() === "" || $(tr).find('td:eq(4)').find('label').text() === "0") {
            $(tr).find('td:eq(4)').find('input').addClass('error-valid');
            check_empty_table = 1;
        }
        if ($(tr).find('td:eq(5)').find('label').text() === "" || $(tr).find('td:eq(5)').find('label').text() === "0") {
            $(tr).find('td:eq(5)').find('input').addClass('error-valid');
            check_empty_table = 1;
        }
        TableData[row] = {
            "id": $(tr).find('td:eq(0)').find('input').data('id-update'),
            "action_type": $(tr).find('td:eq(0)').find('input').data('type'),
            "material_id": $(tr).find('td:eq(0)').find('input').val(),
            "supplier_material_id": $(tr).find('td:eq(1)').find('input').val(),
            "user_input_quantity": $(tr).find('td:eq(4)').find('label').text(),
            "user_input_unit_type": $(tr).find('td:eq(3)').find('select').val(),
            "user_input_price": $(tr).find('td:eq(5)').find('label').text(),
            "note": JSON.stringify(""),
            "sort": row
        };
    });
    if (check_empty_table === 1) return false;
    let TableAll = TableData.concat(tableDeleteUpdateInInventoryManage);
    let note = $('#note-update-in-inventory-manage').val(),
        discount_amount = '0',
        discount_percent = '0',
        vat = '0',
        discount_type = $('#discount-type-update-in-inventory-manage').val(),
        date = $('#day-update-in-inventory-manage').val() + $('#date-update-in-inventory-manage').text(),
        inventory = $('#inventory-id-update-in-inventory-manage').text();
    if (discount_type === '1') {
        discount_percent = removeformatNumber($('#discount-update-in-inventory-manage').val());
    } else {
        discount_amount = removeformatNumber($('#discount-update-in-inventory-manage').val());
    }
    if (vatUpdateInInventoryManage.is(':checked')) {
        vat = '1';
    }

    saveUpdateInInventoryManage = 1;
    let method = 'post',
        url = 'in-inventory-manage.update',
        params = null,
        data = {
            table: TableAll,
            note: note,
            id: idUpdateInInventoryManage,
            discount_amount: discount_amount,
            discount_type: discount_type,
            is_include_vat: vat,
            branch_id: branchUpdateInInventoryManage,
            discount_percent: discount_percent,
            inventory: inventory,
            delivery_date: date,
        };

    let res = await axiosTemplate(method, url, params, data,[
        $('#loading-update-in-inventory-manage')
    ]);
    if (res.data.status === 200) {
        let text = $('#success-update-data-to-server').text();
        SuccessNotify(text);
        closeModalUpdateInInventoryManage();
        loadData();

    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

// function cancelInInventoryManage() {
//     let title = 'Vui lòng nhập lý do hủy !',
//         element = 'input-cancel-in-inventory-manage';
//     sweetAlertInputComponent(title, element).then(async (result) => {
//         if (result.isConfirmed) {
//             let method = 'post',
//                 branch = branchUpdateInInventoryManage,
//                 note = $('#input-cancel-in-inventory-manage').val(),
//                 id = idUpdateInInventoryManage,
//                 url = 'in-inventory-manage.cancel',
//                 params = null,
//                 data = {branch: branch, id: id, note: note};
//             let res = await axiosTemplate(method, url, params, data);
//             if (res.data.status === 200) {
//                 let text = $('#success-cancel-data-to-server').text();
//                 SuccessNotify(text);
//                 closeModalUpdateInInventoryManage();
//                 loadData();
//                 $('#tab-canecel-nav-in-inventory-manage').click();
//             } else {
//                 let text = $('#error-post-data-to-server').text();
//                 if (res.data.message !== null) {
//                     text = res.data.message;
//                 }
//                 ErrorNotify(text);
//             }
//         }
//     });
// }

function closeModalUpdateInInventoryManage() {
    shortcut.remove('ESC');
    shortcut.remove('F2');
    shortcut.remove('F3');
    shortcut.remove('F4');
    shortcut.remove('F6');
    shortcut.add('F2', function () {
        openCreateInInventoryManage();
    });
    showModalUpdateInInventoryManage.modal('hide');
    tableDeleteUpdateInInventoryManage = [];
}
