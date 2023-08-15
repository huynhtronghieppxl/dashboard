let checkChangeCreateCancelInventoryManage = 0,
    saveCreateCancelInventoryManage = 0,
    branchCreateCancelInventoryManage,
    tableMaterialCreateCancelInventoryInternal,
    inventoryCreateCancelInInventoryManage = $('#select-object-cancel-inventory-manage').val();
async function openCreateCancelInventoryManage() {
    branchCreateCancelInventoryManage = $('#change_branch').val();
    checkChangeCreateCancelInventoryManage = 0;
    saveCreateCancelInventoryManage = 0;
    $('#modal-create-cancel-inventory-manage').modal('show');
    dateTimePickerTemplate($('#delivery-create-cancel-inventory-manage'), '' , new Date());
    $('#select-object-cancel-inventory-manage').select2({
        dropdownParent: $('#modal-create-cancel-inventory-manage'),
    });
    $('#select-material-create-cancel-inventory-manage').select2({
        dropdownParent: $('#modal-create-cancel-inventory-manage'),
    });
    shortcut.remove('F2');
    shortcut.remove('F9');
    shortcut.add('F4', function () {
        saveModalCreateCancelInventoryManage();
    });
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalCreateCancelInventoryManage();
    });
    $('#select-material-create-cancel-inventory-manage').unbind('select2:select').on('select2:select', function () {
        selectMaterialCreateCancelInventoryManage();
    });
    $('#modal-create-cancel-inventory-manage textarea').on('input', function (){
        $('#modal-create-cancel-inventory-manage .btn-renew').removeClass('d-none');
    });
    $('#modal-create-cancel-inventory-manage select').on('change', function () {
        $('#modal-create-cancel-inventory-manage .btn-renew').removeClass('d-none');
    });
    $('#delivery-create-cancel-inventory-manage').on('click', function () {
        $('#modal-create-cancel-inventory-manage .btn-renew').removeClass('d-none');
    });
    $('#select-object-cancel-inventory-manage').on('select2:select', function () {
        if (tableMaterialCreateCancelInventoryInternal.data().any()) {
            let title = 'Đổi kho ?',
                content = 'Bạn đã chọn nguyên liệu, đổi kho sẽ làm mới danh sách nguyên liệu!',
                icon = 'warning';
            sweetAlertComponent(title, content, icon).then((result) => {
                if (result.value) {
                    inventoryCreateCancelInInventoryManage = $(this).val();
                    dataMaterialCreateCancelInventoryManage();
                    dataTableMaterialCancelInventoryManage([]);
                } else {
                    $(this).val(inventoryCreateCancelInInventoryManage).trigger('change.select2')
                }
            });
        } else {
            inventoryCreateCancelInInventoryManage = $(this).val();
            dataMaterialCreateCancelInventoryManage();
            dataTableMaterialCancelInventoryManage([]);
        }
    });

    $(document).on('focus', 'input', function () {
        $(this).select();
    });
    dataTableMaterialCancelInventoryManage([]);
    dataMaterialCreateCancelInventoryManage();
}

async function selectMaterialCreateCancelInventoryManage() {
    let id = $('#select-material-create-cancel-inventory-manage option:selected').val(),
        name = $('#select-material-create-cancel-inventory-manage option:selected').text(),
        quantity = (removeformatNumber($('#select-material-create-cancel-inventory-manage option:selected').data('quantity')) < 0 ) ? 0 : removeformatNumber( $('#select-material-create-cancel-inventory-manage option:selected').data('quantity')),
        unit = $('#select-material-create-cancel-inventory-manage option:selected').data('unit'),
        unit_value = $('#select-material-create-cancel-inventory-manage option:selected').data('unit-value'),
        small_quantity = $('#select-material-create-cancel-inventory-manage option:selected').data('small-quantity'),
        keysearch = $('#select-material-create-cancel-inventory-manage option:selected').data('keysearch'),
        value = (quantity) == 0 ? 0 : 1,
        data_max = removeformatNumber(quantity) === 0 ? '999999999' : quantity;
    let data = {
        'restaurant_material_name': name,
        'restaurant_quantity': formatNumber($('#select-material-create-cancel-inventory-manage option:selected').data('quantity')),
        'restaurant_unit_full_name':
            '<select class="form-control edit-height-select-group rounded js-example-basic-single" onchange="onChangeUnit($(this))">' +
            '<option value="1" data-remain-quantity="' + formatNumber($('#select-material-create-cancel-inventory-manage option:selected').data('quantity')) + '" >' + unit + '</option>' +
            '<option value="2" data-remain-quantity="' + formatNumber(small_quantity) + '">' + unit_value + '</option>' +
            '</select>',
        'quantity':
            '<div class="input-group border-group validate-table-validate">\n' +
            '    <input class="form-control text-center return rounded border-0 w-100" data-min="0.01" data-float="1" data-type="currency-edit" value="' + value + '" data-max="999999999" />\n' +
            '</div>\n',
        'note':
            '<div class="input-group border-group validate-table-validate">\n' +
            '  <input class="form-control text-left rounded border-0 w-100" data-max-length="255"/>\n' +
            '</div>',
        'action': '<div class="btn-group-sm">' +
            '<button class="tabledit-delete-button seemt-red btn seemt-btn-hover-red waves-effect waves-light" onclick="removeRowCreateCancelInventoryManage($(this))" data-keysearch="' + keysearch + '" data-id="' + id + '" data-toggle="tooltip" data-placement="top" data-original-title="Xóa"><i class="fi-rr-trash"></i></button>' +
            '</div>',
        'keysearch': keysearch
    };
        addRowDatatableTemplate(tableMaterialCreateCancelInventoryInternal, data);
        $('#select-material-create-cancel-inventory-manage').find(':selected').remove();
        $('#select-material-create-cancel-inventory-manage').find('option:first').prop('selected', true).trigger('change.select2');
}

function removeRowCreateCancelInventoryManage(r) {
    let name = r.parents('tr').find('td:eq(1)').text(),
        id = r.parents('tr').find('td:eq(6)').find('button').data('id'),
        unit = r.parents('tr').find('td:eq(3)').find('select option:eq(0)').text(),
        unit_value = r.parents('tr').find('td:eq(3)').find('select option:eq(1)').text(),
        quantity = r.parents('tr').find('td:eq(3)').find('select option:eq(0)').data('remain-quantity'),
        small_quantity = r.parents('tr').find('td:eq(3)').find('select option:eq(1)').data('remain-quantity'),
        keysearch = r.parents('tr').find('td:eq(7)').text();
    $('#select-material-create-cancel-inventory-manage').append('<option data-quantity="' + removeformatNumber(quantity) + '" data-small-quantity="' + removeformatNumber(small_quantity) + '"  data-unit="' + unit + '" data-unit-value="' + unit_value + '" value="' + id + '" data-keysearch="' + keysearch + '">' + name + '</option>');
    removeRowDatatableTemplate(tableMaterialCreateCancelInventoryInternal, r , true);
}

async function dataTableMaterialCancelInventoryManage(data) {
    let tableMaterialCreateCancelInventoryManage = $('#table-material-create-cancel-inventory-manage'),
        scroll_Y = '40vh',
        fixed_left = 2,
        fixed_right = 1,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'restaurant_material_name', name: 'restaurant_material_name', className: 'text-center'},
            {data: 'restaurant_quantity', name: 'restaurant_quantity', className: 'text-center', width: '5%'},
            {
                data: 'restaurant_unit_full_name',
                name: 'restaurant_unit_full_name',
                className: 'text-center',
                width: '5%'
            },
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'note', name: 'note', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ];
    tableMaterialCreateCancelInventoryInternal = await DatatableTemplateNew(tableMaterialCreateCancelInventoryManage, data, columns, scroll_Y, fixed_left, fixed_right);
}


async function saveModalCreateCancelInventoryManage() {
    if (saveCreateCancelInventoryManage !== 0) return false;
    if (!checkValidateSave($('#modal-create-cancel-inventory-manage'))) return false;
    let TableData = [];
    tableMaterialCreateCancelInventoryInternal.rows().every(function (index, element) {
        let row = $(this.node());
        if (removeformatNumber(row.find('td:eq(4)').find('input').val()) > 0) {
            TableData.push({
                "id": row.find('td:eq(6)').find('button').data('id'),
                "user_input_quantity": removeformatNumber(row.find('td:eq(4)').find('input').val()),
                "user_input_unit_type": row.find('td:eq(3)').find('select').val(),
                "note": row.find('td:eq(5)').find('input').val(),
            })
        }
    });
    if (TableData.length === 0) {
        ErrorNotify('Vui lòng chọn nguyên liệu cần hủy !');
        return false;
    }
    let note = $('#note-create-cancel-inventory-manage').val(),
        branch = $('#select-branch-cancel-inventory-internal').val(),
        inventory = $('#tab-id-cancel-inventory-manage').text(),
        date = $('#delivery-create-cancel-inventory-manage').val(),
        object = $('#select-object-cancel-inventory-manage').val();
    saveCreateCancelInventoryManage = 1;
    let method = 'post',
        url = 'cancel-inventory-internal-manage.create',
        params = null,
        data = {
            table: TableData,
            branch: branch,
            inventory: inventory,
            note: note,
            date: date,
            object: object,
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-create-cancel-inventory-manage')
    ]);
    saveCreateCancelInventoryManage = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalCreateCancelInventoryManage();
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
    let data_max = (removeformatNumber(wholesaleQuantity) <= 0 ) ? '999999999' : '999999999';
    let quantity = (removeformatNumber(r.parents('tr').find('td:eq(4)').find('input').val()) < 0 ) ? 0 : removeformatNumber(r.parents('tr').find('td:eq(4)').find('input').val());
    if (r.val() == 1) {
        r.parents('tr').find('td:eq(2)').text(formatNumber(r.find(':selected').data('remain-quantity')))
        wholesaleQuantity = (removeformatNumber(r.parents('tr').find('td:eq(2)').text()) < 0) ? 0 : removeformatNumber(r.parents('tr').find('td:eq(2)').text());
        (quantity <= wholesaleQuantity) ? r.parents('tr').find('td:eq(4)').find('input').val(r.parents('tr').find('td:eq(4)').find('input').val()) : r.parents('tr').find('td:eq(4)').find('input').val(formatNumber(wholesaleQuantity));
        r.parents('tr').find('td:eq(4)').find('input').attr('data-max', data_max);
        r.parents('tr').find('td:eq(4)').find('input').attr('data-value-min-value-of', '0');
        r.parents('tr').find('td:eq(4)').find('input').attr('float', '1');
    } else {
        r.parents('tr').find('td:eq(2)').text(formatNumber(r.find(':selected').data('remain-quantity')))
        wholesaleQuantity = (removeformatNumber(r.parents('tr').find('td:eq(2)').text()) < 0) ? 0 : removeformatNumber(r.parents('tr').find('td:eq(2)').text());
        (quantity <= wholesaleQuantity) ? r.parents('tr').find('td:eq(4)').find('input').val(r.parents('tr').find('td:eq(4)').find('input').val()) : r.parents('tr').find('td:eq(4)').find('input').val(formatNumber(wholesaleQuantity));
        r.parents('tr').find('td:eq(4)').find('input').attr('data-max', data_max);
        r.parents('tr').find('td:eq(4)').find('input').attr('data-value-min-value-of', '0');
        r.parents('tr').find('td:eq(4)').find('input').attr('float', '1');
    }
}

async function dataMaterialCreateCancelInventoryManage() {
    $('#select-material-create-cancel-inventory-manage').find('option').not(':first').remove();
    let method = 'get',
        url = 'cancel-inventory-internal-manage.material-internal',
        branch = $('#select-branch-cancel-inventory-internal').val(),
        params = {
            branch: branch,
            inventory: $('#select-object-cancel-inventory-manage').val(),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-material-create-cancel-inventory-manage')
    ]);
    $('#select-material-create-cancel-inventory-manage').html(res.data[0]);
}

function closeModalCreateCancelInventoryManage() {
    $('#modal-create-cancel-inventory-manage').modal('hide');
    resetModalCreateCancelInventoryManage();
    shortcut.remove('F4');
    shortcut.remove('F6');
    shortcut.remove('F9');
    removeAllValidate();
    countCharacterTextarea()
}

function resetModalCreateCancelInventoryManage() {
    $('#nav-tab-cancel-inventory-internal-manage li:eq("' + $('#select-object-cancel-inventory-manage option:selected').data('value') + '") a').click();
    $('#modal-create-cancel-inventory-manage .js-example-basic-single').find('option:eq(0)').prop('selected', true).trigger('change.select2');
    $('#note-create-cancel-inventory-manage').val('');
    tableMaterialCreateCancelInventoryInternal.clear().draw(false);
    $('#delivery-create-cancel-inventory-manage').val(moment().format('DD/MM/YYYY'));
    dataTableMaterialCancelInventoryManage([]);
    dataMaterialCreateCancelInventoryManage();
    $('#modal-create-cancel-inventory-manage .btn-renew').addClass('d-none');
}
