let checkChangeCreateInInventoryManage = 0,
    saveCreateInInventoryManage = 0,
    loadSupplierCreateInInventoryManage = 0,
    dataMaterialCreateInInventoryManage,
    dataSelectedCreateInInventoryManage = [],
    tableMaterialCreateInInventoryManage,
    supplierCreateInInventoryManage = $('#select-supplier-create-in-inventory-manage').val(),
    inventoryCreateInInventoryManage = $('#select-inventory-create-in-inventory-manage').val(),
    branchCreateInInventoryManage = $('#select-branch-create-in-inventory-manage').val(),
    materialCategoryTypeParentId,checkDataCreateInInventory = 0,checkDataMaterialCreateInInventoryManage = 0;

async function openCreateInInventoryManage() {
    checkChangeCreateInInventoryManage = 0;
    saveCreateInInventoryManage = 0;
    $('#modal-create-in-inventory-manage').modal('show');
    $('.js-example-basic-single').select2({
        dropdownParent: $('#modal-create-in-inventory-manage'),
    });
    await $('#select-branch-create-in-inventory-manage').val($('#change_branch').val()).trigger('change.select2');
    registerShortcutCreateInInventoryManage();
    dateTimePickerTemplate($('#date-create-in-inventory-manage'));

    $('#select-material-create-in-inventory-manage').unbind('select2:select').on('select2:select', async function () {
        await selectMaterialCreateInInventoryManage();
        $('#table-material-create-in-inventory-manage tbody tr:eq(0)').find('input.quantity').select();
        $('#select-material-create-in-inventory-manage').find(':selected').remove();
        $('#select-material-create-in-inventory-manage').val('').trigger('change.select2');
        sumCreateInInventoryManage();
    });

    $('#select-branch-create-in-inventory-manage').unbind('select2:select').on('select2:select', function () {
        if ($('#table-material-create-in-inventory-manage tbody tr').length > 0) {
            let title = 'Đổi chi nhánh ?',
                content = 'Bạn đã chọn nguyên liệu, đổi chi nhánh sẽ làm mới danh sách nguyên liệu !',
                icon = 'warning';
            sweetAlertComponent(title, content, icon).then((result) => {
                if (result.value) {
                    branchCreateInInventoryManage = $(this).val();
                    $('#table-material-create-in-inventory-manage tbody tr').remove();
                    sumCreateInInventoryManage();
                    dataMaterialCreateInInventoryManage();
                } else {
                    $(this).val(branchCreateInInventoryManage).trigger('change.select2')
                }
            });
        } else {
            branchCreateInInventoryManage = $(this).val();
            $('#table-material-create-in-inventory-manage tbody tr').remove();
            sumCreateInInventoryManage();
            dataMaterialCreateInInventoryManage();
        }
    });

    $('#select-inventory-create-in-inventory-manage').unbind('select2:select').on('select2:select', function () {
        if ($('#table-material-create-in-inventory-manage tbody tr').length > 0) {
            let title = 'Đổi kho ?',
                content = 'Bạn đã chọn nguyên liệu, đổi kho sẽ làm mới danh sách nguyên liệu !',
                icon = 'warning';
            sweetAlertComponent(title, content, icon).then((result) => {
                if (result.value) {
                    inventoryCreateInInventoryManage = $(this).val();
                    $('#table-material-create-in-inventory-manage tbody tr').remove();
                    sumCreateInInventoryManage();
                    dataMaterialCreateInInventoryManage();
                    dataExportTargetCreateInInventoryManage();
                } else {
                    $(this).val(inventoryCreateInInventoryManage).trigger('change.select2')
                }
            });
        } else {
            inventoryCreateInInventoryManage = $(this).val();
            $('#table-material-create-in-inventory-manage tbody tr').remove();
            sumCreateInInventoryManage();
            dataMaterialCreateInInventoryManage();
            dataExportTargetCreateInInventoryManage();
        }
    });

    $('#select-supplier-create-in-inventory-manage').unbind('select2:select').on('select2:select', function () {
        if ($('#table-material-create-in-inventory-manage tbody tr').length > 0) {
            let title = 'Đổi nhà cung cấp ?',
                content = 'Bạn đã chọn nguyên liệu, đổi nhà cung cấp sẽ làm mới danh sách nguyên liệu !',
                icon = 'question';
            sweetAlertComponent(title, content, icon).then((result) => {
                if (result.value) {
                    supplierCreateInInventoryManage = $(this).val();
                    $('#table-material-create-in-inventory-manage tbody tr').remove();
                    sumCreateInInventoryManage();
                    dataMaterialCreateInInventoryManage();
                } else {
                    $(this).val(supplierCreateInInventoryManage).trigger('change.select2')
                }
            });
        } else {
            supplierCreateInInventoryManage = $(this).val();
            $('#table-material-create-in-inventory-manage tbody tr').remove();
            sumCreateInInventoryManage();
            dataMaterialCreateInInventoryManage();
        }
    });

    $('#vat-create-in-inventory-manage').on('change', function () {
        sumCreateInInventoryManage();
    });

    $('#export-create-in-inventory-manage').on('change', function () {
        if ($(this).is(':checked') === true) {
            $('#div-export-target-create-in-inventory-manage').removeClass('d-none');
        } else {
            $('#div-export-target-create-in-inventory-manage').addClass('d-none');
        }
    });

    $('#discount-create-in-inventory-manage').on('input', function () {
        sumCreateInInventoryManage();
    });

    $('#discount-type-create-in-inventory-manage').on('change', function () {
        if ($(this).val() === '1' && removeformatNumber($('#discount-create-in-inventory-manage').val()) > 100) {
            $('#discount-create-in-inventory-manage').val('100');
            $('#discount-create-in-inventory-manage').select();
            alertify.notify('Chiết khấu tối đa 100% !', 'error', 5);
        }
        sumCreateInInventoryManage();
    });

    $(document).on('input', 'table#table-material-create-in-inventory-manage tbody input.quantity', function () {
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
        sumCreateInInventoryManage();
    });

    $(document).on('input', 'table#table-material-create-in-inventory-manage tbody input.price', function () {
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
        sumCreateInInventoryManage();
    });

    $(document).on('keypress', 'table#table-material-create-in-inventory-manage tbody input.quantity', function (e) {
        if (e.keyCode === 13) {
            $(this).parents('tr').find('input.price').select();
        }
    });

    $(document).on('keypress', 'table#table-material-create-in-inventory-manage tbody input.price', function (e) {
        if (e.keyCode === 13) {
            let last_tr = $(this).parents('tr').index() + 1;
            $(this).parents('tbody').find('tr:eq(' + last_tr + ')').find('input.quantity').select();
        }
    });

    $(document).on('focus', 'input', function () {
        $(this).select();
    });
    await dataSupplierCreateInInventoryManage();
    dataMaterialCreateInInventoryManage();
}

function registerShortcutCreateInInventoryManage() {
    removeAllShortcuts();
    shortcut.add('ESC', function () {
        closeModalCreateInInventoryManage();
    });
    shortcut.add('F2', function () {
        if ($('#select-supplier-create-in-inventory-manage').select2('isOpen') === true) {
            $('#select-supplier-create-in-inventory-manage').select2('close');
        } else {
            $('#modal-create-in-inventory-manage .js-example-basic-single').select2('close');
            $('#select-supplier-create-in-inventory-manage').select2('open');
        }
    });
    shortcut.add('F4', function () {
        saveModalCreateInInventoryManage();
    })
}

async function dataSupplierCreateInInventoryManage() {
    if (checkDataCreateInInventory === 1) return false;
    if (loadSupplierCreateInInventoryManage === 0) {
        checkDataCreateInInventory = 1;
        let method = 'get',
            url = 'in-inventory-manage.supplier',
            params = {branch_id: $('#select-branch-create-in-inventory-manage').val()},
            data = null;
        let res = await axiosTemplate(method, url, params, data);
        checkDataCreateInInventory = 0
        loadSupplierCreateInInventoryManage = 1;
        $('#select-supplier-create-in-inventory-manage').html(res.data[0]);
    }
}

async function dataMaterialCreateInInventoryManage() {
    if (checkDataMaterialCreateInInventoryManage === 1) return false;
    checkDataMaterialCreateInInventoryManage = 1;
    let method = 'post',
        url = 'in-inventory-manage.material',
        material = [],
        branch = $('#select-branch-create-in-inventory-manage').val(),
        supplier = $('#select-supplier-create-in-inventory-manage').val(),
        inventory = $('#select-inventory-create-in-inventory-manage').val(),
        params = null,
        data = {branch: branch, supplier: supplier, inventory: inventory, material: material};
    let res = await axiosTemplate(method, url, params, data);
    checkDataMaterialCreateInInventoryManage = 0;
    $('#select-material-create-in-inventory-manage').html(res.data[0]);
    dataMaterialCreateInInventoryManage = res.data[1].original.data;
    dataSelectedCreateInInventoryManage = [];
}

function dataExportTargetCreateInInventoryManage() {
    switch ($('#select-inventory-create-in-inventory-manage').val()) {
        case '1':
            $('#select-export-target-create-in-inventory-manage').html($('#inventory-tab1-create-in-inventory-manage').html());
            break;
        case '2':
            $('#select-export-target-create-in-inventory-manage').html($('#inventory-tab2-create-in-inventory-manage').html());
            break;
        case '3':
            $('#select-export-target-create-in-inventory-manage').html($('#inventory-tab3-create-in-inventory-manage').html());
            break;
        case '12':
            $('#select-export-target-create-in-inventory-manage').html($('#inventory-tab4-create-in-inventory-manage').html());
            break;
    }
}

async function dataTableMaterialCreateInInventoryManage(data) {
    let id = $('#table-select-material-create-in-inventory-manage'),
        scroll_Y = '40vh',
        fixed_left = 2,
        fixed_right = 1,
        column = [
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
        ];
    tableMaterialCreateInInventoryManage = await DatatableTemplate(id, data, column, scroll_Y, fixed_left, fixed_right);
}

async function openTableMaterialCreateInInventoryManage() {
    $('#modal-table-material-create-in-inventory-manage').modal('show');
    await dataTableMaterialCreateInInventoryManage(dataMaterialCreateInInventoryManage);
    mapDataTableMaterialCreateInInventoryManage();
}

function checkAllMaterialCreateInInventoryManage(r) {
    if ($(r).is(':checked') === true) {
        tableMaterialCreateInInventoryManage.rows().every(function (index, element) {
            let x = $(this.node());
            x.find('td:eq(0)').find('input').prop('checked', true);
            let data = {
                'id': x.find('td:eq(0)').find('input.id-material').val(),
                'name': x.find('td:eq(0)').find('input.id-material').data('name'),
                'supplier': x.find('td:eq(0)').find('input.id-material').data('supplier'),
                'supplier_id': x.find('td:eq(0)').find('input.id-material').data('supplier-id'),
                'remain_quantity': x.find('td:eq(0)').find('input.id-material').data('remain-quantity'),
                'unit': x.find('td:eq(0)').find('input.id-material').data('unit'),
                'unit_value': x.find('td:eq(0)').find('input.id-material').data('unit-value'),
                'price_format': x.find('td:eq(0)').find('input.id-material').data('price-format'),
                'price': x.find('td:eq(0)').find('input.id-material').data('price'),
            };
            dataSelectedCreateInInventoryManage.push(data);
        })
    } else {
        tableMaterialCreateInInventoryManage.rows().every(function (index, element) {
            let x = $(this.node());
            x.find('td:eq(0)').find('input').prop('checked', false);
        });
        dataSelectedCreateInInventoryManage = [];
    }
}

async function selectModalMaterialCreateInInventoryManage() {
    $('#table-material-create-in-inventory-manage tbody tr').remove();
    jQuery.each(dataSelectedCreateInInventoryManage, function (i, v) {
        $('#table-material-create-in-inventory-manage tbody').append('<tr>\n' +
            '<td class="text-center"><label>' + v.name + '</label><input value="' + v.id + '" class="d-none"/></td>\n' +
            '<td class="text-center"><label>' + v.supplier + '</label><input value="' + v.supplier_id + '" class="d-none"/></td>\n' +
            '<td class="text-center"><label>' + v.remain_quantity + '</label></td>\n' +
            '<td class="text-center"><select class="form-control edit-height-select-group change-type-table">\n' +
            '<option value="1">' + v.unit + '</option>\n' +
            '<option value="2">' + v.unit_value + '</option>\n' +
            '</select></td>\n' +
            '<td><input class="form-control quantity text-right" data-type="currency-edit" value="1" placeholder="1"/><label class="d-none quantity-label">1</label></td>\n' +
            '<td><input class="form-control price text-right" data-type="currency-edit" value="' + v.price_format + '" placeholder="0"/><label class="d-none price-label">' + v.price + '</label></td>\n' +
            '<td class="text-center"><label class="total">' + v.price_format + '</label></td>\n' +
            '<td class="text-center">\n' +
            '<div class="btn-group-sm">\n' +
            '<button class="tabledit-delete-button btn btn-danger waves-effect waves-light" onclick="removeMaterialCreateInInventoryManage(this)"><span class="icofont icofont-ui-delete"></span></button>\n' +
            '</div></td>\n' +
            '</tr>');
    });
    mapDataSelectMaterialCreateInInventoryManage();
    sumCreateInInventoryManage();
    $('#modal-table-material-create-in-inventory-manage').modal('hide');
    $('#table-material-create-in-inventory-manage tbody tr:eq(0)').find('input.quantity').select();
}

async function checkItemMaterialCreateInInventoryManage(r) {
    if (r.is(':checked') === true) {
        let data = {
            'id': r.parents('td').find('input.id-material').val(),
            'name': r.parents('td').find('input.id-material').data('name'),
            'supplier': r.parents('td').find('input.id-material').data('supplier'),
            'supplier_id': r.parents('td').find('input.id-material').data('supplier-id'),
            'remain_quantity': r.parents('td').find('input.id-material').data('remain-quantity'),
            'unit': r.parents('td').find('input.id-material').data('unit'),
            'unit_value': r.parents('td').find('input.id-material').data('unit-value'),
            'price_format': r.parents('td').find('input.id-material').data('price-format'),
            'price': r.parents('td').find('input.id-material').data('price'),
        };
        dataSelectedCreateInInventoryManage.push(data);
    } else {
        jQuery.each(dataSelectedCreateInInventoryManage, function (i, v) {
            if (v.id === r.parents('td').find('input.id-material').val()) {
                dataSelectedCreateInInventoryManage.splice(i, 1);
            }
        })
    }
    let checked = true;
    await tableMaterialCreateInInventoryManage.rows().every(function (index, element) {
        let x = $(this.node());
        if (x.find('td:eq(0)').find('input[type="checkbox"]').is(':checked') === false) {
            $('#check-all-material-table-create-in-inventory-manage').prop('checked', false);
            checked = false;
        }
    });
    if (checked === true) {
        $('#check-all-material-table-create-in-inventory-manage').prop('checked', true);
        tableMaterialCreateInInventoryManage = [];
        await tableMaterialCreateInInventoryManage.rows().every(function (index, element) {
            let x = $(this.node());
            let data = {
                'id': x.find('td:eq(0)').find('input.id-material').val(),
                'name': x.find('td:eq(0)').find('input.id-material').data('name'),
                'supplier': x.find('td:eq(0)').find('input.id-material').data('supplier'),
                'supplier_id': x.find('td:eq(0)').find('input.id-material').data('supplier-id'),
                'remain_quantity': x.find('td:eq(0)').find('input.id-material').data('remain-quantity'),
                'unit': x.find('td:eq(0)').find('input.id-material').data('unit'),
                'unit_value': x.find('td:eq(0)').find('input.id-material').data('unit-value'),
                'price_format': x.find('td:eq(0)').find('input.id-material').data('price-format'),
                'price': x.find('td:eq(0)').find('input.id-material').data('price'),
            };
            dataSelectedCreateInInventoryManage.push(data);
        });
    }
}

function mapDataSelectMaterialCreateInInventoryManage() {
    $('#select-material-create-in-inventory-manage option').each(function (i1, v1) {
        jQuery.each(dataSelectedCreateInInventoryManage, function (i2, v2) {
            if ($(v1).val() === v2.id) {
                $(v1).remove();
            }
        })
    });
}

function mapDataTableMaterialCreateInInventoryManage() {
    tableMaterialCreateInInventoryManage.rows().every(function (index, element) {
        let x = $(this.node());
        jQuery.each(dataSelectedCreateInInventoryManage, function (i, v) {
            if (x.find('td:eq(0)').find('input.id-material').val() === v.id) {
                x.find('td:eq(0)').find('input[type="checkbox"]').prop('checked', true);
                x.find('td:eq(0)').find('input.id-material').data('check', '1');
            }
        });
    });
}

function closeModalMaterialCreateInInventoryManage() {
    $('#modal-table-material-create-in-inventory-manage').modal('hide');
}

function selectMaterialCreateInInventoryManage() {
    let id = $('#select-material-create-in-inventory-manage').find(':selected').val(),
        name = $('#select-material-create-in-inventory-manage').find(':selected').text(),
        supplier = $('#select-material-create-in-inventory-manage').find(':selected').data('supplier'),
        supplier_id = $('#select-material-create-in-inventory-manage').find(':selected').data('supplier-id'),
        remain_quantity = $('#select-material-create-in-inventory-manage').find(':selected').data('remain-quantity-format'),
        unit = $('#select-material-create-in-inventory-manage').find(':selected').data('unit'),
        unit_value = $('#select-material-create-in-inventory-manage').find(':selected').data('unit-value'),
        price = $('#select-material-create-in-inventory-manage').find(':selected').data('price'),
        price_format = $('#select-material-create-in-inventory-manage').find(':selected').data('price-format');
    if (remain_quantity === undefined) remain_quantity = 0;
    let data = {
        'id': id,
        'name': name,
        'supplier': supplier,
        'supplier_id': supplier_id,
        'remain_quantity': remain_quantity,
        'unit': unit,
        'unit_value': unit_value,
        'price_format': price_format,
        'price': price,
    };
    dataSelectedCreateInInventoryManage.push(data);
    $('#table-material-create-in-inventory-manage tbody').prepend('<tr>\n' +
        '<td class="text-center"><label>' + name + '</label><input value="' + id + '" class="d-none"/></td>\n' +
        '<td class="text-center"><label>' + supplier + '</label><input v alue="' + supplier_id + '" class="d-none"/></td>\n' +
        '<td class="text-center"><label>' + remain_quantity + '</label></td>\n' +
        '<td class="text-center"><select class="form-control edit-height-select-group change-type-table rounded">\n' +
        '<option value="1">' + unit + '</option>\n' +
        '<option value="2">' + unit_value + '</option>\n' +
        '</select></td>\n' +
        '<td><input class="form-control quantity text-right rounded" data-table="1000000" data-type="currency-edit" value="1" placeholder="1" data-table-not-empty/><label class="d-none quantity-label">1</label></td>\n' +
        '<td><input class="form-control price text-right rounded" data-table="100000000" data-type="currency-edit" value="' + price_format + '" placeholder="0" data-table-not-empty/><label class="d-none price-label">' + price + '</label></td>\n' +
        '<td class="text-center"><label class="total">' + price_format + '</label></td>\n' +
        '<td class="text-center">\n' +
        '<div class="btn-group-sm">\n' +
        '<button class="tabledit-delete-button btn btn-danger waves-effect waves-light" onclick="removeMaterialCreateInInventoryManage(this)"><span class="icofont icofont-ui-delete"></span></button>\n' +
        '</div></td>\n' +
        '</tr>');
}

function removeMaterialCreateInInventoryManage(r) {
    let i = r.parentNode.parentNode.parentNode;
    let supplier = $(i).find('td:eq(1)').find('label').text(),
        supplier_id = $(i).find('td:eq(1)').find('input').val(),
        remain_quantity = $(i).find('td:eq(2)').text(),
        unit = $(i).find('td:eq(3)').find('select option:first').text(),
        unit_value = $(i).find('td:eq(3)').find('select option:nth-child(1)').text(),
        price = $(i).find('td:eq(5)').find('label').text(),
        price_format = $(i).find('td:eq(5)').find('input').val(),
        id = $(i).find('td:eq(0)').find('input').val(),
        name = $(i).find('td:eq(0)').find('label').text();
    jQuery.each(dataSelectedCreateInInventoryManage, function (i, v) {
        if (id === v.id) dataSelectedCreateInInventoryManage.splice(i, 1);
    });
    $('#select-material-create-in-inventory-manage').append('<option data-supplier="' + supplier + '" data-supplier-id="' + supplier_id + '" data-remain-quantity="' + remain_quantity + '" data-unit="' + unit + '" data-unit-value="' + unit_value + '" data-price="' + price + '" data-price-format="' + price_format + '" value="' + id + '">' + name + '</option>');
    $('#table-material-create-in-inventory-manage tbody tr').eq(i.rowIndex - 1).remove();
    sumCreateInInventoryManage();
}

async function sumCreateInInventoryManage() {
    let total_price = 0,
        discount = $('#discount-create-in-inventory-manage').val(),
        vat = 0;
    $('#total-record-create-in-inventory-manage').text(formatNumber($('#table-material-create-in-inventory-manage tbody tr').length));
    await $('table#table-material-create-in-inventory-manage tbody tr').each(function () {
        total_price += parseFloat(removeformatNumber($(this).find('td:eq(6)').text()));
    });
    $('#total-sum-price-create-in-inventory-manage').text(formatNumber(total_price));
    if ($('#discount-type-create-in-inventory-manage').val() === '1') {
        discount = checkDecimal(total_price * parseFloat(removeformatNumber($('#discount-create-in-inventory-manage').val()) / 100));
    }
    if ($('#vat-create-in-inventory-manage').is(':checked')) {
        vat = parseFloat($('#vat-default').val()) / 100;
    }
    let total_vat = checkDecimal((total_price - discount) * vat);
    $('#total-final-create-in-inventory-manage').text(formatNumber(total_price - discount + total_vat));
}

async function saveModalCreateInInventoryManage() {
    if (saveCreateInInventoryManage ===1) {
        return false;
    }
    if ($('#table-material-create-in-inventory-manage tbody tr').length === 0) {
        ErrorNotify('Vui lòng nhập dữ liệu !');
        return false;
    }
    let TableData = [];
    let check_empty_table = 0;
    await $('#table-material-create-in-inventory-manage tbody tr').each(function (row, tr) {
        if ($(tr).find('td:eq(4)').find('label').text() === "" || $(tr).find('td:eq(4)').find('label').text() === "0") {
            $(tr).find('td:eq(4)').find('input').addClass('error-valid');
            check_empty_table = 1;
        }
        if ($(tr).find('td:eq(5)').find('label').text() === "" || parseInt($(tr).find('td:eq(5)').find('label').text()) < 0) {
            $(tr).find('td:eq(5)').find('input').addClass('error-valid');
            check_empty_table = 1;
        }
        TableData[row] = {
            "id": '0',
            "action_type": '0',
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

    let branch = $('#select-branch-create-in-inventory-manage').val(),
        note = $('#note-create-in-inventory-manage').val(),
        supplier_id = $('#select-supplier-create-in-inventory-manage').val(),
        discount_amount = 0,
        discount_percent = 0,
        discount_type = $('#discount-type-create-in-inventory-manage').val(),
        vat = 0,
        delivery_date = $('#date-create-in-inventory-manage').val(),
        inventory = $('#select-inventory-create-in-inventory-manage').val(),
        export_info = "";
    if (discount_type === '1') {
        discount_percent = removeformatNumber($('#discount-create-in-inventory-manage').val());
    } else {
        discount_amount = removeformatNumber($('#discount-create-in-inventory-manage').val());
    }
    if ($('#vat-create-in-inventory-manage').is(':checked') === true) {
        vat = 1;
    }
    if ($('#export-create-in-inventory-manage').is(':checked') === true) {
        export_info = {
            'export_type': $('#select-export-target-create-in-inventory-manage').val(),
            'target_branch': ''
        }
    }
    saveCreateInInventoryManage = 1;
    let method = 'post',
        url = 'in-inventory-manage.create',
        params = null,
        data = {
            table: TableData,
            note: note,
            discount_amount: discount_amount,
            discount_type: discount_type,
            is_include_vat: vat,
            delivery_date: delivery_date,
            supplier_id: supplier_id,
            branch_id: branch,
            discount_percent: discount_percent,
            inventory: inventory,
            export_info: export_info
        };
    let res = await axiosTemplate(method, url, params, data);
    saveCreateInInventoryManage = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalCreateInInventoryManage();
            loadData();
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

async function nextModalCreateInInventoryManage() {
    if (saveCreateInInventoryManage !== 0) {
        return false;
    }
    if ($('#table-material-create-in-inventory-manage tbody tr').length === 0) {
        ErrorNotify('Vui lòng nhập dữ liệu !');
        return false;
    }
    let TableData = [];
    let check_empty_table = 0;
    await $('#table-material-create-in-inventory-manage tbody tr').each(function (row, tr) {
        if ($(tr).find('td:eq(4)').find('label').text() === "") {
            $(tr).find('td:eq(4)').find('label').addClass('error-valid');
            check_empty_table = 1;
        }
        if ($(tr).find('td:eq(5)').find('label').text() === "") {
            $(tr).find('td:eq(5)').find('label').addClass('error-valid');
            check_empty_table = 1;
        }
        TableData[row] = {
            "id": '0',
            "action_type": '0',
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

    let branch = $('#select-branch-create-in-inventory-manage').val(),
        note = $('#note-create-in-inventory-manage').val(),
        supplier_id = $('#select-supplier-create-in-inventory-manage').val(),
        discount_amount = 0,
        discount_percent = 0,
        discount_type = $('#discount-type-create-in-inventory-manage').val(),
        vat = 0,
        delivery_date = $('#date-create-in-inventory-manage').val(),
        inventory = $('#select-inventory-create-in-inventory-manage').val(),
        export_info = "";
    if (discount_type === '1') {
        discount_percent = removeformatNumber($('#discount-create-in-inventory-manage').val());
    } else {
        discount_amount = removeformatNumber($('#discount-create-in-inventory-manage').val());
    }
    if ($('#vat-create-in-inventory-manage').is(':checked') === true) {
        vat = 1;
    }
    if ($('#export-create-in-inventory-manage').is(':checked') === true) {
        export_info = {
            'export_type': $('#select-export-target-create-in-inventory-manage').val(),
            'target_branch': ''
        }
    }
    let rowCount = await $('#table-material-create-in-inventory-manage tbody tr').length;
    if (rowCount == 0) {
        checkSelectTemplate('#loading-create-in-inventory-manage');
        return false;
    }
    saveCreateInInventoryManage = 1;
    let method = 'post',
        url = 'in-inventory-manage.create',
        params = null,
        data = {
            table: TableData,
            note: note,
            discount_amount: discount_amount,
            discount_type: discount_type,
            is_include_vat: vat,
            delivery_date: delivery_date,
            supplier_id: supplier_id,
            branch_id: branch,
            discount_percent: discount_percent,
            inventory: inventory,
            export_info: export_info
        };

    let res = await axiosTemplate(method, url, params, data);
    saveCreateInInventoryManage = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            removeDataNextCreateInInventoryManage();
            loadData();
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
            $("#btn-next-in-inventory-manage").prop('disabled', false);
            shortcut.add('F3', function () {
                nextModalCreateInInventoryManage();
            });
    }
}

function closeModalCreateInInventoryManage() {
    cancelShortcutCreateInInventoryManage();
    removeDataCreateInInventoryManage();
    $('#modal-create-in-inventory-manage').modal('hide');
    switch (materialCategoryTypeParentId) {
        case 1:
            $('#tab-in-inventory-manage-1').click();
            break;
        case 2:
            $('#tab-in-inventory-manage-2').click();
            break;
        case 3:
            $('#tab-in-inventory-manage-3').click();
            break;
        case 12:
            $('#tab-in-inventory-manage-12').click();
            break;
    }
    $('#note-create-in-inventory-manage').val('');
    $('#discount-create-in-inventory-manage').val('');
    removeAllValidate();
}

function cancelShortcutCreateInInventoryManage() {
    removeAllShortcuts();
    shortcut.add('F1', function () {
        let check = $('#styleSelector').hasClass('open');
        if (check === true) {
            $('#styleSelector').removeClass('open');
        } else {
            $('#styleSelector').addClass('open');
        }
    });
    shortcut.add('F2', function () {
        openCreateInInventoryManage();
    });
    shortcut.add('F5', function () {
        loadData();
    });
}

function removeDataCreateInInventoryManage() {
    $('#table-material-create-in-inventory-manage tbody tr').remove();
    $('#select-supplier-create-in-inventory-manage').find('option:first').trigger('change.select2');
    $('#select-inventory-create-in-inventory-manage').find('option:first').trigger('change.select2');
    $('#date-create-in-inventory-manage').val(moment().format('DD/MM/YYYY'));
    $('#export-create-in-inventory-manage').prop('checked', false);
    $('#div-export-target-create-in-inventory-manage').addClass('d-none');
    $('#select-export-target-create-in-inventory-manage').find('option:first').trigger('change.select2');
    $('#total-record-create-in-inventory-manage').text('');
    $('#total-sum-price-create-in-inventory-manage').text('');
    $('#total-sum-price-create-in-inventory-manage').text('');
    $('#total-final-create-in-inventory-manage').text('');
    $('#discount-create-in-inventory-manage').val('');
    $('#note-create-in-inventory-manage').val('');
    $('#discount-create-in-inventory-manage').val('0');
    $('#discount-type-create-in-inventory-manage').find('option:first').trigger('change');
    $('#discount-type-create-in-inventory-manage').find('option:first').trigger('change.select2');
    $('#vat-create-in-inventory-manage').prop('checked', false);
    $('#check-all-material-table-create-in-inventory-manage').prop('checked', false);
}

function removeDataNextCreateInInventoryManage() {
    $('#table-material-create-in-inventory-manage tbody tr').remove();
    $('#select-supplier-create-in-inventory-manage').find('option:first').trigger('change.select2');
    $('#date-create-in-inventory-manage').val(moment().format('DD/MM/YYYY'));
    $('#export-create-in-inventory-manage').prop('checked', false);
    $('#div-export-target-create-in-inventory-manage').addClass('d-none');
    $('#select-export-target-create-in-inventory-manage').find('option:first').trigger('change.select2');
    $('#total-record-create-in-inventory-manage').text('');
    $('#total-sum-price-create-in-inventory-manage').text('');
    $('#total-sum-price-create-in-inventory-manage').text('');
    $('#total-final-create-in-inventory-manage').text('');
    $('#discount-create-in-inventory-manage').val('');
    $('#note-create-in-inventory-manage').val('');
    $('#discount-create-in-inventory-manage').val('0');
    $('#discount-type-create-in-inventory-manage').find('option:first').trigger('change');
    $('#discount-type-create-in-inventory-manage').find('option:first').trigger('change.select2');
    $('#vat-create-in-inventory-manage').prop('checked', false);
    $('#check-all-material-table-create-in-inventory-manage').prop('checked', false);
    dataMaterialCreateInInventoryManage();
}

