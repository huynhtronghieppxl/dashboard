let checkSaveCreateReturnInventoryInternalManage = 0,
    inventoryCreateInInventoryManage,
    branchCreateInInventoryManage,
    tableMaterialReturnInventoryInternalManage

async function openCreateReturnInventoryInternalManage() {
    inventoryCreateInInventoryManage = $('#select-inventory-target-create-return-inventory-internal-manage').val();
    branchCreateInInventoryManage = $('#change_branch').val();
    checkSaveCreateReturnInventoryInternalManage = 0;
    $('#modal-create-return-inventory-internal-manage').modal('show');
    dateTimePickerTemplate($('#delivery-create-return-inventory-internal-manage'), '' , new Date());
    $('#select-inventory-target-create-return-inventory-internal-manage').select2({
        dropdownParent: $('#modal-create-return-inventory-internal-manage'),
    });
    $('#select-material-create-return-inventory-internal-manage').select2({
        dropdownParent: $('#modal-create-return-inventory-internal-manage'),
    });
    shortcut.add('F4', function () {
        saveModalCreateReturnInventoryInternalManage();
    });
    shortcut.add('ESC', function () {
        closeModalCreateReturnInventoryInternalManage();
    });
    $('#select-material-create-return-inventory-internal-manage').unbind('select2:select').on('select2:select', function () {
        selectMaterialCreateReturnInventoryInternalManage();
    });
    $('#select-inventory-target-create-return-inventory-internal-manage').on('select2:select', function () {
        if (tableMaterialReturnInventoryInternalManage.data().any()) {
            let title = 'Đổi phiếu kho ?',
                content = 'Bạn đã chọn nguyên liệu, đổi phiếu kho sẽ làm mới danh sách nguyên liệu!',
                icon = 'warning';
            sweetAlertComponent(title, content, icon).then((result) => {
                if (result.value) {
                    inventoryCreateInInventoryManage = $(this).val();
                    dataMaterialCreateReturnInventoryInternalManage();
                    dataTableMaterialReturnInventoryInternalManage([]);
                } else {
                    $(this).val(inventoryCreateInInventoryManage).trigger('change.select2')
                }
            });
        } else {
            inventoryCreateInInventoryManage = $(this).val();
            dataMaterialCreateReturnInventoryInternalManage();
            dataTableMaterialReturnInventoryInternalManage([]);
        }
    });
    $(document).on('keypress', 'table#table-material-create-return-inventory-internal-manage tbody input.return', function (e) {
        if (e.keyCode === 13) {
            let last_tr = $(this).parents('tr').index() + 1;
            $(this).parents('tbody').find('tr:eq(' + last_tr + ')').find('input.return').select();
        }
    });

    $(document).on('focus', 'input', function () {
        $(this).select();
    });
    dataTableMaterialReturnInventoryInternalManage([]);
    dataMaterialCreateReturnInventoryInternalManage();
    showButtonReloadCreateInventoryInternalManage()
}

async function dataMaterialCreateReturnInventoryInternalManage() {
    $('#select-material-create-return-inventory-internal-manage').find('option').not(':first').remove();
    let method = 'get',
        url = 'return-inventory-internal-manage.material-internal',
        branch = $('#select-branch-return-inventory-internal').val(),
        params = {
            branch: branch,
            inventory: $('#select-inventory-target-create-return-inventory-internal-manage').val()
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-material-create-return-inventory-internal-manage')
    ]);
    $('#select-material-create-return-inventory-internal-manage').html(res.data[0]);
}

async function dataInventoryCreateReturnInventoryInternalManage() {
    let method = 'get',
        url = 'return-inventory-internal-manage.inventory',
        branch = $('#select-branch-return-inventory-internal').val(),
        inventory = $('#tab-id-return-inventory-internal-manage').text(),
        params = {branch: branch, inventory: inventory},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-inventory-create-return-inventory-internal-manage')
    ]);
    $('#select-inventory-create-return-inventory-internal-manage').html(res.data[0]);
}

async function dataTableMaterialReturnInventoryInternalManage(data) {
    let materialReturnInventoryInternalManage = $('#table-material-create-return-inventory-internal-manage'),
        scroll_Y = '40vh',
        fixed_left = 2,
        fixed_right = 1,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'restaurant_material_name', name: 'restaurant_material_name', className: 'text-center'},
            {data: 'restaurant_quantity', name: 'restaurant_quantity', className: 'text-center'},
            {data: 'restaurant_unit_full_name', name: 'restaurant_unit_full_name', className: 'text-center'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'note', name: 'note', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ];
    tableMaterialReturnInventoryInternalManage = await DatatableTemplateNew(materialReturnInventoryInternalManage, data, columns, scroll_Y, fixed_left, fixed_right);
}

function selectMaterialCreateReturnInventoryInternalManage() {
    let id = $('#select-material-create-return-inventory-internal-manage option:selected').val(),
        name = $('#select-material-create-return-inventory-internal-manage option:selected').text(),
        quantity = (removeformatNumber($('#select-material-create-return-inventory-internal-manage option:selected').data('quantity')) < 0 ) ? 0 : removeformatNumber( $('#select-material-create-return-inventory-internal-manage option:selected').data('quantity')),
        unit = $('#select-material-create-return-inventory-internal-manage option:selected').data('unit'),
        unit_value = $('#select-material-create-return-inventory-internal-manage option:selected').data('unit-value'),
        small_quantity = $('#select-material-create-return-inventory-internal-manage option:selected').data('small-quantity'),
        keysearch = $('#select-material-create-return-inventory-internal-manage option:selected').data('keysearch'),
        value = (quantity) <= 1 ? quantity : 1,
        data_max = (removeformatNumber(quantity) == 0 ) ? '999999999' : '999999999';

    let data = {
        'restaurant_material_name': '<label>' + name + '</label><input value="' + id + '" class="d-none"/>',
        'restaurant_quantity': formatNumber($('#select-material-create-return-inventory-internal-manage option:selected').data('quantity')),
        'restaurant_unit_full_name': '<select class="form-control edit-height-select-group rounded js-example-basic-single" onchange="onChangeUnit($(this))">' +
            '<option value="1" data-remain-quantity="' + formatNumber($('#select-material-create-return-inventory-internal-manage option:selected').data('quantity')) + '" >' + unit + '</option>' +
            '<option value="2" data-remain-quantity="' + formatNumber(small_quantity) + '">' + unit_value + '</option>' +
            '</select>',
        'quantity': '<div class="input-group border-group validate-table-validate">\n' +
            '  <input class="form-control text-center return rounded border-0 w-100" data-min="0.01" data-float="1" data-type="currency-edit" data-max="999999999">\n' +
            '  <label class="d-none"></label>\n' +
            '</div>',
        'note': '<div class="input-group border-group validate-table-validate">\n' +
            '  <input class="form-control text-left border-0 w-100" data-max-length="255">\n' +
            '</div>',
        'action': '<div class="btn-group-sm">' +
            '<button class="tabledit-delete-button btn seemt-red seemt-btn-hover-red waves-effect" onclick="removeRowCreateReturnInventoryInternalManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xóa" ><i class="fi-rr-trash"></i></button>' +
            '</div>',
        'keysearch': keysearch
    };

        addRowDatatableTemplate(tableMaterialReturnInventoryInternalManage, data);
        $('#select-material-create-return-inventory-internal-manage').find(':selected').remove();
        $('#select-material-create-return-inventory-internal-manage').find('option:first').prop('selected', true).trigger('change.select2');

}

function removeRowCreateReturnInventoryInternalManage(r) {
    let name = r.parents('tr').find('td:eq(1)').find('label').text(),
        id = r.parents('tr').find('td:eq(1)').find('input').val(),
        unit = r.parents('tr').find('td:eq(3)').find('select option:first').text(),
        unit_value = r.parents('tr').find('td:eq(3)').find('select option:last-child').text(),
        quantity = r.parents('tr').find('td:eq(3)').find('select option:eq(0)').data('remain-quantity'),
        small_quantity = r.parents('tr').find('td:eq(3)').find('select option:last-child').data('remain-quantity'),
        keysearch = r.parents('tr').find('td:eq(7)').text();
    $('#select-material-create-return-inventory-internal-manage').append('<option data-small-quantity="' + small_quantity + '" data-quantity="' + quantity + '" data-unit="' + unit + '" data-unit-value="' + unit_value + '" value="' + id + '" data-keysearch="' + keysearch + '">' + name + '</option>');
    removeRowDatatableTemplate(tableMaterialReturnInventoryInternalManage, r, true)
}

async function saveModalCreateReturnInventoryInternalManage() {
    if (checkSaveCreateReturnInventoryInternalManage === 1) return false;
    if (!checkValidateSave($('#modal-create-return-inventory-internal-manage'))) return false;
    let TableData = [];
    tableMaterialReturnInventoryInternalManage.rows().every(function (i) {
        let row = $(this.node());
        if (removeformatNumber(row.find('td:eq(4)').find('input').val()) > 0) {
            TableData.push({
                "id": row.find('td:eq(1)').find('input').val(),
                "user_input_quantity": removeformatNumber(row.find('td:eq(4)').find('input').val()),
                "user_input_unit_type": row.find('td:eq(3)').find('select').val(),
                "note": row.find('td:eq(5)').find('input').val(),
            })
        }else{
            WarningNotify('Vui lòng chọn nguyên liệu cần trả');
            return false;
        }
    });
    if (TableData.length == 0) {
        WarningNotify('Vui lòng chọn nguyên liệu cần trả');
        return false;
    }

    let note = $('#note-create-return-inventory-internal-manage').val(),
        branch = $('#select-branch-return-inventory-internal').val(),
        object = $('#select-inventory-target-create-return-inventory-internal-manage').val(),
        date = $('#delivery-create-return-inventory-internal-manage').val();
    checkSaveCreateReturnInventoryInternalManage = 1;
    let method = 'post',
        url = 'return-inventory-internal-manage.create',
        params = null,
        data = {
            table: TableData,
            branch: branch,
            object: object,
            note: note,
            date: date
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-create-return-inventory-internal-manage')
    ]);
    checkSaveCreateReturnInventoryInternalManage = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalCreateReturnInventoryInternalManage();
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

function onChangeUnit(r) {
    let wholesaleQuantity;
    let quantity = removeformatNumber(r.parents('tr').find('td:eq(4)').find('input').val());
    let data_max = (removeformatNumber(wholesaleQuantity) == 0 ) ? '999999999' : '999999999';
    if (r.val() == 1) {
        r.parents('tr').find('td:eq(2)').text(formatNumber(r.find(':selected').data('remain-quantity')))
        wholesaleQuantity = (removeformatNumber(r.parents('tr').find('td:eq(2)').text()) < 0) ? 0 : removeformatNumber(r.parents('tr').find('td:eq(2)').text());
        (quantity <= wholesaleQuantity) ? r.parents('tr').find('td:eq(4)').find('input').val(r.parents('tr').find('td:eq(4)').find('input').val()) : r.parents('tr').find('td:eq(4)').find('input').val(formatNumber(wholesaleQuantity));
        r.parents('tr').find('td:eq(4)').find('input').attr('data-max', removeformatNumber(data_max));
        r.parents('tr').find('td:eq(4)').find('input').attr('data-value-min-value-of', '0');
        r.parents('tr').find('td:eq(4)').find('input').attr('float', '1');
    } else {
        r.parents('tr').find('td:eq(2)').text(formatNumber(r.find(':selected').data('remain-quantity')))
        wholesaleQuantity = (removeformatNumber(r.parents('tr').find('td:eq(2)').text()) < 0) ? 0 : removeformatNumber(r.parents('tr').find('td:eq(2)').text());
        (quantity <= wholesaleQuantity) ? r.parents('tr').find('td:eq(4)').find('input').val(r.parents('tr').find('td:eq(4)').find('input').val()) : r.parents('tr').find('td:eq(4)').find('input').val(formatNumber(wholesaleQuantity));
        r.parents('tr').find('td:eq(4)').find('input').attr('data-max', removeformatNumber(data_max));
        r.parents('tr').find('td:eq(4)').find('input').attr('data-value-min-value-of', '0');
        r.parents('tr').find('td:eq(4)').find('input').attr('float', '1');
    }
}

function closeModalCreateReturnInventoryInternalManage() {
    $('#modal-create-return-inventory-internal-manage').modal('hide');
    tableMaterialReturnInventoryInternalManage.clear().draw(false);
    resetModalCreateReturnInventoryInternalManage()
    countCharacterTextarea()
}

function resetModalCreateReturnInventoryInternalManage() {
    removeAllValidate();
    $('#note-create-return-inventory-internal-manage').val('');
    tableMaterialReturnInventoryInternalManage.clear().draw(false);
    $('#note-create-return-inventory-internal-manage').val('');
    $('#table-material-create-return-inventory-internal-manage tbody tr').remove();
    $('#select-inventory-target-create-return-inventory-internal-manage').val(2).trigger('change.select2');
    $('#delivery-create-return-inventory-internal-manage').val(moment().format('DD/MM/YYYY'));
    $('#char-count > span').text('0/255');
    $('#select-inventory-target-create-return-inventory-internal-manage').on('select2:select', function () {
        if (tableMaterialReturnInventoryInternalManage.data().any()) {
            let title = 'Đổi phiếu kho ?',
                content = 'Bạn đã chọn nguyên liệu, đổi phiếu kho sẽ làm mới danh sách nguyên liệu!',
                icon = 'warning';
            sweetAlertComponent(title, content, icon).then((result) => {
                if (result.value) {
                    inventoryCreateInInventoryManage = $(this).val();
                    $('#table-material-create-return-inventory-internal-manage tbody tr').remove();
                    $('#select-material-create-return-inventory-internal-manage').find('option').not(':first').remove();
                    dataMaterialCreateReturnInventoryInternalManage();
                    dataTableMaterialReturnInventoryInternalManage([]);
                } else {
                    $(this).val(inventoryCreateInInventoryManage).trigger('change.select2')
                }
            });
        } else {
            inventoryCreateInInventoryManage = $(this).val();
            $('#table-material-create-return-inventory-internal-manage tbody tr').remove();
            $('#select-material-create-return-inventory-internal-manage').find('option').not(':first').remove();
            dataMaterialCreateReturnInventoryInternalManage();
            dataTableMaterialReturnInventoryInternalManage([]);
        }
    });
    dataTableMaterialReturnInventoryInternalManage([]);
    dataMaterialCreateReturnInventoryInternalManage();
    $('#modal-create-return-inventory-internal-manage .btn-renew').addClass('d-none')
}

function showButtonReloadCreateInventoryInternalManage() {
    $('#modal-create-return-inventory-internal-manage select').change(function () {
        $('#modal-create-return-inventory-internal-manage .btn-renew').removeClass('d-none')
    })
    $('#modal-create-return-inventory-internal-manage textarea').on('keyup', function () {
        $('#modal-create-return-inventory-internal-manage .btn-renew').removeClass('d-none')
    })
    $('#delivery-create-return-inventory-internal-manage').on('dp.change', function () {
        $('#modal-create-return-inventory-internal-manage .btn-renew').removeClass('d-none')
    })
}



