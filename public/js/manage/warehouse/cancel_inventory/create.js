let tableCreateMaterialCancelInventoryWarehouse = '',
    checkSaveCreateCancelInventory = 0;

$(function () {
    $('#note-create-cancel-inventory-warehouse').on('input', function () {
        if ($(this).val().length > 300) {
            $(this).val($(this).val().substring(0, 300));
        }
        $('#modal-create-cancel-inventory-warehouse').find('#char-count > span:eq(0)').text($('#note-create-cancel-inventory-warehouse').val().length);
    });
    $('#note-create-cancel-inventory-warehouse').on('paste', function (e) {
        let pasteData = e.originalEvent.clipboardData.getData('text/plain');
        if ($(this).val().length + pasteData.length > 300) {
            e.preventDefault();
            WarningNotify('Lý do hủy hàng dài tối đa 300 ký tự !');
        }
        setTimeout(function () {
            $('#modal-create-cancel-inventory-warehouse').find('#char-count > span:eq(0)').text($('#note-create-cancel-inventory-warehouse').val().length);
        },100);
    });
    $('#select-parent-cancel-inventory-warehouse').on('change', async function () {
        if (tableCreateMaterialCancelInventoryWarehouse.data().any()) {
            let title = 'Đổi kho ?',
                content = 'Bạn đã chọn nguyên liệu, đổi kho sẽ làm mới danh sách nguyên liệu !',
                icon = 'question';
            sweetAlertComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    dataMaterialCreateCancelInventoryWarehouse();
                    dataTableMaterialCancelInventoryWarehouse();
                }
            });
        } else {
            dataMaterialCreateCancelInventoryWarehouse();
            dataTableMaterialCancelInventoryWarehouse();
        }
    });

    $('#select-material-create-cancel-inventory-warehouse').unbind('select2:select').on('select2:select', function () {
        selectMaterialCreateCancelInventoryWarehouse();
        $('#table-material-create-cancel-inventory-warehouse .js-example-basic-single').select2({
            dropdownParent: $('#modal-create-cancel-inventory-warehouse'),
        });
    });
    $(document).on('input', 'table#table-material-create-cancel-inventory-warehouse tbody input.cancel-quantity', function () {
        $(this).parents('td').find('label').text(parseFloat(removeformatNumber($(this).val())));
    });

    $(document).on('change', 'table#table-material-create-cancel-inventory-warehouse tbody select.select-unit', function () {
        let quantity = $(this).parents('tr').find('label.label-quantity').text();
        let unit_value = $(this).find(':selected').data('value');
        $(this).parents('tr').find('input.cancel-quantity').val(formatNumber(checkDecimal(quantity * unit_value)));
        $(this).parents('tr').find('label.label-quantity').text(checkDecimal(quantity * unit_value));
    });

    $('#modal-create-cancel-inventory-warehouse select').on('change', function () {
        $('#modal-create-cancel-inventory-warehouse .btn-renew').removeClass('d-none');
    });
    $('#delivery-create-cancel-inventory-warehouse').on('click', function () {
        $('#modal-create-cancel-inventory-warehouse .btn-renew').removeClass('d-none');
    });
    $('#modal-create-cancel-inventory-warehouse textarea').on('input', function () {
        $('#modal-create-cancel-inventory-warehouse .btn-renew').removeClass('d-none');
    });
})
function openCreateCancelInventoryWarehouse () {
    $('#modal-create-cancel-inventory-warehouse').modal('show');
    $('#select-parent-cancel-inventory-warehouse').select2({
        dropdownParent: $('#modal-create-cancel-inventory-warehouse'),
    });
    $('#select-material-create-cancel-inventory-warehouse').select2({
        dropdownParent: $('#modal-create-cancel-inventory-warehouse'),
        templateResult : function (data, container){
            let span = '';
            let title_tooltip='';
            if($(data.element).attr('data-original-title')) {
                title_tooltip=$(data.element).attr('data-original-title');
            }
            if($(data.element).attr('data-quantity') <= 0 || $(data.element).attr('data-small-quantity') <= 0){
                span = $(`<span class="text-left d-flex justify-content-center" data-toggle="tooltip" data-placement="top" data-original-title="${title_tooltip}" style="align-items: baseline;padding-right:10px !important;">${data.text} <i class="fa fa-exclamation-triangle text-danger ml-1" style="font-size: 14px;transform: translateY(-1px);
                    }"></i></span>`);
                $(container).addClass('disabled');
            }else {
                span = $(`<span class="text-left d-flex" data-toggle="tooltip" data-placement="top" data-original-title="${title_tooltip}" style="align-items: baseline;padding-right:18px !important;">${data.text}</span>`);
            }
            return span;
        }
    });
    let inventoryActive = $('#tab-change-cancel-inventory-warehouse').find('a.active').text().substring(0, $('#tab-change-cancel-inventory-warehouse').find('a.active').text().length - 2);
    switch (inventoryActive) {
        case 'Kho nguyên liệu' :
            $('#select-parent-cancel-inventory-warehouse').val(1).trigger('change.select2');
            break;
        case 'Kho hàng hóa' :
            $('#select-parent-cancel-inventory-warehouse').val(2).trigger('change.select2');
            break;
        case 'Kho nội bộ' :
            $('#select-parent-cancel-inventory-warehouse').val(3).trigger('change.select2');
            break;
        case 'Kho khác' :
            $('#select-parent-cancel-inventory-warehouse').val(12).trigger('change.select2');
            break;
    }

    shortcut.add('F4', function () {
        saveModalCreateCancelInventoryWarehouse();
    });
    shortcut.add('ESC', function () {
        closeModalCreateCancelInventoryWarehouse();
    });
    shortcut.remove('F1');
    shortcut.remove('F2');
    shortcut.remove('F4');
    shortcut.remove('F6');
    shortcut.remove('F9');
    shortcut.add('F4', function () {
        saveModalCreateCancelInventoryWarehouse();
    });

    dateTimePickerTemplate($('#delivery-create-cancel-inventory-warehouse'), '' , new Date());
    dataMaterialCreateCancelInventoryWarehouse();
    dataTableMaterialCancelInventoryWarehouse();
}

async function selectMaterialCreateCancelInventoryWarehouse() {
    let id = $('#select-material-create-cancel-inventory-warehouse').find(':selected').val(),
        name = $('#select-material-create-cancel-inventory-warehouse').not(':disabled').find(':selected').attr('data-original-title'),
        quantity = $('#select-material-create-cancel-inventory-warehouse').find(':selected').data('quantity'),
        unit = $('#select-material-create-cancel-inventory-warehouse').find(':selected').data('unit'),
        unit_value = $('#select-material-create-cancel-inventory-warehouse').find(':selected').data('unit-value'),
        system_small = $('#select-material-create-cancel-inventory-warehouse').find(':selected').data('small-quantity'),
        system_quantity = $('#select-material-create-cancel-inventory-warehouse').find(':selected').data('quantity'),
        title_tooltip= $('#select-material-create-cancel-inventory-warehouse').not(':disabled').find(':selected').attr('data-original-title'),
        keysearch = $('#select-material-create-cancel-inventory-warehouse option:selected').data('keysearch'),
        value = quantity == 0 ? 0 : 1;
    let data = {
        'id': id,
        'DT_RowIndex': tableCreateMaterialCancelInventoryWarehouse.rows().count(),
        'restaurant_material_name': `<label style="max-width: 368px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;display: inline;" data-toggle="tooltip"' +
            'data-placement="top" data-original-title= "${title_tooltip}" >${name}</label><input value="${id}" class="d-none"/>`,
        'restaurant_quantity':  system_quantity,
        'restaurant_unit_full_name': '<select class="form-control edit-height-select-group rounded js-example-basic-single" data-select="1" onchange="onChangeUnit($(this))">' +
            '<option value="1" data-remain-quantity ="' + system_quantity + '">' + unit + '</option>' +
            '<option value="2" data-system-small ="' + system_small + '">' + unit_value + '</option>' +
            '</select>',
        'quantity': '<div id="create-cancel-inventory-warehouse-quantity" class="input-group border-group validate-table-validate">' +
            '<input class="form-control text-center return rounded border-0 w-100" data-max="' + removeformatNumber(system_quantity) + '" data-type="currency-edit" data-min="0.01" data-float="1" value="' + value + '">' +
            '</div>',
        'note': '<div class="input-group border-group validate-table-validate">' +
            '<input class="form-control text-right return rounded border-0 w-100" data-max-length="255">' +
            '</div>',
        'action': '<div class="btn-group-sm">' +
            '<button class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="removeRowCreateCancelInventoryWarehouse($(this))"  data-id="' + id + '" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"><i class="fi-rr-trash"></i></button>' +
            '</div>',
        'keysearch': keysearch
    }
    addRowDatatableTemplate(tableCreateMaterialCancelInventoryWarehouse, data);
    $('#select-material-create-cancel-inventory-warehouse').find(':selected').remove();
    $('.tooltip').remove()
    $('#select-material-create-cancel-inventory-warehouse').find('option:first').prop('selected', true).trigger('change.select2');
}

function removeRowCreateCancelInventoryWarehouse (r) {
    let name = r.parents('tr').find('td:eq(1)').find('label').text().slice(0,17)+'...',
        id = r.parents('tr').find('td:eq(1)').find('input').val(),
        unit = r.parents('tr').find('td:eq(3)').find('select option:nth-child(1)').text(),
        unit_value = r.parents('tr').find('td:eq(3)').find('select option:nth-child(2)').text(),
        small_quantity = r.parents('tr').find('td:eq(3)').find('select option:nth-child(2)').data('system-small'),
        remain_quantity = r.parents('tr').find('td:eq(3)').find('select option:nth-child(1)').data('remain-quantity'),
        keysearch = r.parents('tr').find('td:eq(7)').text(),
        title_tooltip=r.parents('tr').find('td:eq(1)').find('label').attr('data-original-title')
    $('#select-material-create-cancel-inventory-warehouse').append('<option data-small-quantity="' + small_quantity + '" data-quantity="' + remain_quantity + '"  data-unit="' + unit + '" data-unit-value="' + unit_value + '" value="' + id + '" data-keysearch="' + keysearch + '" data-toggle="tooltip" data-placement="top" data-original-title="'+ title_tooltip +'">' + name + '</option>');
    removeRowDatatableTemplate(tableCreateMaterialCancelInventoryWarehouse, r , true);
}

async function dataTableMaterialCancelInventoryWarehouse() {
    let id = $('#table-material-create-cancel-inventory-warehouse'),
        scroll_Y = '50vh',
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
    tableCreateMaterialCancelInventoryWarehouse = await DatatableTemplateNew(id, [], columns, scroll_Y, fixed_left, fixed_right);
}


async function dataMaterialCreateCancelInventoryWarehouse() {
    let branch_id = $('.select-branch').val();
    let method = 'get',
        url = 'cancel-inventory-warehouse.data-material',
        params = {
            branch: branch_id,
            category_type: $('#select-parent-cancel-inventory-warehouse').val()
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-material-create-cancel-inventory-warehouse')
    ]);
    if ((res.data[0]) === null){
        $('#select-material-create-cancel-inventory-warehouse').attr('disabled', true);
    } else {
        $('#select-material-create-cancel-inventory-warehouse').html(res.data[0]);
    }
}

async function saveModalCreateCancelInventoryWarehouse () {
    if(checkSaveCreateCancelInventory === 1) return false;
    let cancelInventoryData = [];
    tableCreateMaterialCancelInventoryWarehouse.rows().every(function () {
        let row = $(this.node());
        cancelInventoryData.push({
            "material_id": row.find('td:eq(1)').find('input').val(),
            "user_input_quantity": removeformatNumber(row.find('td:eq(4)').find('input').val()),
            "user_input_unit_type": row.find('td:eq(3)').find('select').val(),
            "note": row.find('td:eq(5)').find('input').val(),
        })
    });
    if (cancelInventoryData.length === 0) {
        WarningNotify('Vui lòng chọn nguyên liệu !');
        return false;
    }
    if (!checkValidateSave($('#modal-create-cancel-inventory-warehouse'))) return false;
    let note = $('#note-create-cancel-inventory-warehouse').val(),
        branch = $('.select-branch').val(),
        // inventory = $('#tab-id-cancel-inventory-manage').text(),
        date = $('#delivery-create-cancel-inventory-warehouse').val(),
        parent = $('#select-parent-cancel-inventory-warehouse').val();

    checkSaveCreateCancelInventory = 1;
    let method = 'post',
        url = 'cancel-inventory-warehouse.create',
        params = null,
        data = {
            table: cancelInventoryData,
            branch: branch,
            // inventory: inventory,
            note: note,
            date: date,
            parent: parent,
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-create-cancel-inventory-warehouse')
    ]);
    checkSaveCreateCancelInventory = 0;
    let text;
    switch (res.data.status){
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            closeModalCreateCancelInventoryWarehouse();
            loadingData();
            switch (Number($('#select-parent-cancel-inventory-warehouse').val())) {
                case 1:
                    $('#tab-change-cancel-inventory-manage').find('li:eq(0) a').click();
                    break;
                case 2:
                    $('#tab-change-cancel-inventory-manage').find('li:eq(1) a').click();
                    break;
                case 3:
                    $('#tab-change-cancel-inventory-manage').find('li:eq(2) a').click();
                    break;
                case 12:
                    $('#tab-change-cancel-inventory-manage').find('li:eq(3) a').click();
                    break;
            }
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            ErrorNotify(text);
            break
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
    if (r.val() == 1) {
        r.parents('tr').find('td:eq(2)').text(formatNumber(r.find(':selected').data('remain-quantity')))
        wholesaleQuantity = removeformatNumber(r.parents('tr').find('td:eq(2)').text());
        (quantity <= wholesaleQuantity) ? r.parents('tr').find('td:eq(4)').find('input').val(r.parents('tr').find('td:eq(4)').find('input').val()) : r.parents('tr').find('td:eq(4)').find('input').val(formatNumber(wholesaleQuantity));
        r.parents('tr').find('td:eq(4)').find('input').attr('data-max', removeformatNumber(wholesaleQuantity));
        r.parents('tr').find('td:eq(4)').find('input').attr('data-value-min-value-of', '0');
        r.parents('tr').find('td:eq(4)').find('input').attr('float', '1');
    } else {
        r.parents('tr').find('td:eq(2)').text(formatNumber(r.find(':selected').data('system-small')))
        wholesaleQuantity = removeformatNumber(r.parents('tr').find('td:eq(2)').text());
        (quantity <= wholesaleQuantity) ? r.parents('tr').find('td:eq(4)').find('input').val(r.parents('tr').find('td:eq(4)').find('input').val()) : r.parents('tr').find('td:eq(4)').find('input').val(formatNumber(wholesaleQuantity));
        r.parents('tr').find('td:eq(4)').find('input').attr('data-max', removeformatNumber(wholesaleQuantity));
        r.parents('tr').find('td:eq(4)').find('input').attr('data-value-min-value-of', '0');
        r.parents('tr').find('td:eq(4)').find('input').attr('float', '1');
    }
}
function resetModalCreateCancelInventoryWarehouse () {}
function closeModalCreateCancelInventoryWarehouse () {
    $('#modal-create-cancel-inventory-warehouse').modal('hide');
    resetModalCreateCancelInventoryWarehouse();
    countCharacterTextarea()
}

function resetModalCreateCancelInventoryWarehouse() {
    $('#select-parent-cancel-inventory-warehouse').val(1).trigger('change.select2');
    dataMaterialCreateCancelInventoryWarehouse();
    tableCreateMaterialCancelInventoryWarehouse.clear().draw(false);
    $('#delivery-create-cancel-inventory-warehouse').val(moment().format('DD/MM/YYYY'));
    $('#note-create-cancel-inventory-warehouse').val('');
    $('#modal-create-cancel-inventory-warehouse .btn-renew').addClass('d-none');
}
