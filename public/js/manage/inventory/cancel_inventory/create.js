let tableCreateMaterialCancelInventory, saveCreateCancelInventoryManage,
    inventoryCreateOutInventoryManage = $('#select-parent-cancel-inventory-manage').val();

async function openCreateCancelInventoryManage() {
    $('#modal-create-cancel-inventory-manage').modal('show');
    $('#select-parent-cancel-inventory-manage').select2({
        dropdownParent: $('#modal-create-cancel-inventory-manage'),
    });
    $('#select-material-create-cancel-inventory-manage').select2({
        dropdownParent: $('#modal-create-cancel-inventory-manage'),
        templateResult : function (data, container){
            let span = '';
            let title_tooltip='';
            if($(data.element).attr('data-original-title')) title_tooltip=$(data.element).attr('data-original-title')
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

    let inventoryActive = $('#tab-change-cancel-inventory-manage').find('a.active').text().substring(0, $('#tab-change-cancel-inventory-manage').find('a.active').text().length - 2);
    switch (inventoryActive) {
        case 'Kho nguyên liệu' :
            $('#select-parent-cancel-inventory-manage').val(1).trigger('change.select2');
            break;
        case 'Kho hàng hóa' :
            $('#select-parent-cancel-inventory-manage').val(2).trigger('change.select2');
            break;
        case 'Kho nội bộ' :
            $('#select-parent-cancel-inventory-manage').val(3).trigger('change.select2');
            break;
        case 'Kho khác' :
            $('#select-parent-cancel-inventory-manage').val(12).trigger('change.select2');
            break;
    }
    dateTimePickerTemplate($('#delivery-create-cancel-inventory-manage'), '' , new Date());
    saveCreateCancelInventoryManage = 0;-

    shortcut.add('F4', function () {
        saveModalCreateCancelInventoryManage();
    });
    shortcut.add('ESC', function () {
        closeModalCreateCancelInventoryManage();
    });
    shortcut.remove('F1');
    shortcut.remove('F2');
    shortcut.remove('F4');
    shortcut.remove('F6');
    shortcut.remove('F9');
    shortcut.add('F4', function () {
        saveModalCreateCancelInventoryManage();
    });

    $('#select-material-create-cancel-inventory-manage').unbind('select2:select').on('select2:select', function () {
        selectMaterialCreateCancelInventoryManage();
        $('#table-material-create-cancel-inventory-manage .js-example-basic-single').select2({
            dropdownParent: $('#modal-create-cancel-inventory-manage'),
        });
    });
    $('.select2-selection__rendered').on('click', function (){
        let css=  $('.select2-dropdown').parent('.select2-container').attr('style')+ 'width:'+$('.select2-dropdown').width()+'px !important'
        $('.select2-dropdown').parent('.select2-container').attr('style', css)
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    })


    $('#select-parent-cancel-inventory-manage').on('change', async function () {
        if (tableCreateMaterialCancelInventory.data().any()) {
            let title = 'Đổi kho ?',
                content = 'Bạn đã chọn nguyên liệu, đổi kho sẽ làm mới danh sách nguyên liệu !',
                icon = 'question';
            sweetAlertComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    inventoryCreateOutInventoryManage = $(this).val();
                    dataTableMaterialCancelInventoryManage();
                    dataMaterialCreateCancelInventoryManage();
                } else {
                    $(this).val(inventoryCreateOutInventoryManage).trigger('change.select2');
                }
            });
        } else {
            inventoryCreateOutInventoryManage = $(this).val();
            dataTableMaterialCancelInventoryManage();
            dataMaterialCreateCancelInventoryManage();
        }
    });

    $(document).on('input', 'table#table-material-create-cancel-inventory-manage tbody input.cancel-quantity', function () {
        $(this).parents('td').find('label').text(parseFloat(removeformatNumber($(this).val())));
    });

    $(document).on('change', 'table#table-material-create-cancel-inventory-manage tbody select.select-unit', function () {
        let quantity = $(this).parents('tr').find('label.label-quantity').text();
        let unit_value = $(this).find(':selected').data('value');
        $(this).parents('tr').find('input.cancel-quantity').val(formatNumber(checkDecimal(quantity * unit_value)));
        $(this).parents('tr').find('label.label-quantity').text(checkDecimal(quantity * unit_value));
    });

    $('#modal-create-cancel-inventory-manage select').on('change', function () {
        $('#modal-create-cancel-inventory-manage .btn-renew').removeClass('d-none');
    });
    $('#delivery-create-cancel-inventory-manage').on('click', function () {
        $('#modal-create-cancel-inventory-manage .btn-renew').removeClass('d-none');
    });
    $('#modal-create-cancel-inventory-manage textarea').on('input', function () {
        $('#modal-create-cancel-inventory-manage .btn-renew').removeClass('d-none');
    });

    dataTableMaterialCancelInventoryManage();
    dataMaterialCreateCancelInventoryManage();
}

async function dataMaterialCreateCancelInventoryManage() {
    $('#select-material-create-cancel-inventory-manage').find('option').not(':first').remove();
    let branch_id = $('.select-branch').val();
    let method = 'get',
        url = 'cancel-inventory-manage.material',
        params = {
            branch: branch_id,
            category_type: $('#select-parent-cancel-inventory-manage').val()
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-material-create-cancel-inventory-manage')
    ]);
    if ((res.data[0]) === null){
        $('#select-material-create-cancel-inventory-manage').attr('disabled', true);
    } else {
        $('#select-material-create-cancel-inventory-manage').html(res.data[0]);
    }
}

async function dataTableMaterialCancelInventoryManage() {
    let id = $('#table-material-create-cancel-inventory-manage'),
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
    tableCreateMaterialCancelInventory = await DatatableTemplateNew(id, [], columns, scroll_Y, fixed_left, fixed_right);
}

async function selectMaterialCreateCancelInventoryManage() {
    let id = $('#select-material-create-cancel-inventory-manage').find(':selected').val(),
        name = $('#select-material-create-cancel-inventory-manage').not(':disabled').find(':selected').attr('data-original-title'),
        quantity = $('#select-material-create-cancel-inventory-manage').find(':selected').data('quantity'),
        unit = $('#select-material-create-cancel-inventory-manage').find(':selected').data('unit'),
        unit_value = $('#select-material-create-cancel-inventory-manage').find(':selected').data('unit-value'),
        system_small = $('#select-material-create-cancel-inventory-manage').find(':selected').data('small-quantity'),
        system_quantity = $('#select-material-create-cancel-inventory-manage').find(':selected').data('quantity'),
        title_tooltip= $('#select-material-create-cancel-inventory-manage').not(':disabled').find(':selected').attr('data-original-title'),
        keysearch = $('#select-material-create-cancel-inventory-manage option:selected').data('keysearch'),
        value = quantity == 0 ? 0 : 1;
    let data = {
        'id': id,
        'DT_RowIndex': tableCreateMaterialCancelInventory.rows().count(),
        'restaurant_material_name': `<label style="max-width: 368px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" data-toggle="tooltip"' +
            'data-placement="top" data-original-title= "${title_tooltip}" >${name}</label><input value="${id}" class="d-none"/>`,
        'restaurant_quantity':  system_quantity,
        'restaurant_unit_full_name': '<select class="form-control edit-height-select-group rounded js-example-basic-single" data-select="1" onchange="onChangeUnit($(this))">' +
            '<option value="1" data-remain-quantity ="' + system_quantity + '">' + unit + '</option>' +
            '<option value="2" data-system-small ="' + system_small + '">' + unit_value + '</option>' +
            '</select>',
        'quantity': '<div id="create-cancel-inventory-manage-quantity" class="input-group border-group validate-table-validate">' +
            '<input class="form-control text-center return rounded border-0 w-100" data-max="' + removeformatNumber(system_quantity) + '" data-type="currency-edit" data-min="0.01" data-float="1" value="' + value + '">' +
            '</div>',
        'note': '<div class="input-group border-group validate-table-validate">' +
            '<input class="form-control text-right return rounded border-0 w-100" data-max-length="255">' +
            '</div>',
        'action': '<div class="btn-group-sm">' +
            '<button class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="removeRowCreateCancelInventoryManage($(this))"  data-id="' + id + '" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"><i class="fi-rr-trash"></i></button>' +
            '</div>',
        'keysearch': keysearch
    }
    addRowDatatableTemplate(tableCreateMaterialCancelInventory, data);
    $('#select-material-create-cancel-inventory-manage').find(':selected').remove();
    $('.tooltip').remove()
    $('#select-material-create-cancel-inventory-manage').find('option:first').prop('selected', true).trigger('change.select2');
}

function removeRowCreateCancelInventoryManage(r) {
    let name = r.parents('tr').find('td:eq(1)').find('label').text().slice(0,17)+'...',
        id = r.parents('tr').find('td:eq(1)').find('input').val(),
        unit = r.parents('tr').find('td:eq(3)').find('select option:nth-child(1)').text(),
        unit_value = r.parents('tr').find('td:eq(3)').find('select option:nth-child(2)').text(),
        small_quantity = r.parents('tr').find('td:eq(3)').find('select option:nth-child(2)').data('system-small'),
        remain_quantity = r.parents('tr').find('td:eq(3)').find('select option:nth-child(1)').data('remain-quantity'),
        keysearch = r.parents('tr').find('td:eq(7)').text(),
        title_tooltip=r.parents('tr').find('td:eq(1)').find('label').attr('data-original-title')
    $('#select-material-create-cancel-inventory-manage').append('<option data-small-quantity="' + small_quantity + '" data-quantity="' + remain_quantity + '"  data-unit="' + unit + '" data-unit-value="' + unit_value + '" value="' + id + '" data-keysearch="' + keysearch + '" data-toggle="tooltip" data-placement="top" data-original-title="'+ title_tooltip +'">' + name + '</option>');
    removeRowDatatableTemplate(tableCreateMaterialCancelInventory, r , true);

}

async function saveModalCreateCancelInventoryManage() {
    if (saveCreateCancelInventoryManage !== 0) return false;
    let TableData = [];
    tableCreateMaterialCancelInventory.rows().every(function () {
        let row = $(this.node());
        TableData.push({
            "material_id": row.find('td:eq(1)').find('input').val(),
            "user_input_quantity": removeformatNumber(row.find('td:eq(4)').find('input').val()),
            "user_input_unit_type": row.find('td:eq(3)').find('select').val(),
            "note": row.find('td:eq(5)').find('input').val(),
        })
    });
    if (TableData.length === 0) {
        WarningNotify('Vui lòng chọn nguyên liệu !');
        return false;
    }
    if (!checkValidateSave($('#modal-create-cancel-inventory-manage'))) return false;
    let note = $('#note-create-cancel-inventory-manage').val(),
        branch = $('.select-branch').val(),
        inventory = $('#tab-id-cancel-inventory-manage').text(),
        date = $('#delivery-create-cancel-inventory-manage').val(),
        parent = $('#select-parent-cancel-inventory-manage').val();

    saveCreateCancelInventoryManage = 1;
    let method = 'post',
        url = 'cancel-inventory-manage.create',
        params = null,
        data = {
            table: TableData,
            branch: branch,
            inventory: inventory,
            note: note,
            date: date,
            parent: parent,
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-create-cancel-inventory-manage')
    ]);
    saveCreateCancelInventoryManage = 0;
    let text;
    switch (res.data.status){
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            closeModalCreateCancelInventoryManage();
            loadingData();
            switch (Number($('#select-parent-cancel-inventory-manage').val())) {
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

async function closeModalCreateCancelInventoryManage() {
    shortcut.add("F2", function () {
        openCreateCancelInventoryManage();
    });
    shortcut.remove('F4');
    $('#modal-create-cancel-inventory-manage').modal('hide');
    resetModalCreateCancelInventoryManage();
    countCharacterTextarea()
}

function resetModalCreateCancelInventoryManage() {
    $('#select-parent-cancel-inventory-manage').val(1).trigger('change.select2');
    dataMaterialCreateCancelInventoryManage();
    tableCreateMaterialCancelInventory.clear().draw(false);
    $('#delivery-create-cancel-inventory-manage').val(moment().format('DD/MM/YYYY'));
    $('#note-create-cancel-inventory-manage').val('');
    $('#modal-create-cancel-inventory-manage .btn-renew').addClass('d-none');
    $('#char-count > span').text('0/300');
}
