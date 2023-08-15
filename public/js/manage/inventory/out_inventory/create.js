let checkSaveCreateOutInventoryManage = 0,
    tableMaterialCreateOutInventoryManage = [], tableGoodsCreateOutInventoryManage = [],
    tableInternalCreateOutInventoryManage = [], tableOtherCreateOutInventoryManage = [],
    branchCreateOutInventoryManage,
    materialCreateOutInventoryManage = [];

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('#check-create-request-out-inventory-manage').on('change', function () {
        $(this).tooltip('hide');
    })
})
async function openCreateOutInventoryManage() {
    $('#modal-create-out-inventory-manage').modal('show');
    checkSaveCreateOutInventoryManage = 0;
    branchCreateOutInventoryManage = $('.select-branch').val();
    $('#select-goods-create-out-inventory-manage,#select-internal-create-out-inventory-manage,#select-other-create-out-inventory-manage,#select-inventory-target-create-out-inventory-manage').select2({
        dropdownParent: $('#modal-create-out-inventory-manage'),
    });
    $('#select-material-create-out-inventory-manage, #select-goods-create-out-inventory-manage, #select-internal-create-out-inventory-manage, #select-other-create-out-inventory-manage').select2({
        dropdownParent: $('#modal-create-out-inventory-manage'),
        templateResult : function (data, container){
            let span = '';
            if($(data.element).attr('data-system-small') <= 0 || $(data.element).attr('data-remain-quantity') <= 0){
                span = $(`<span class="text-left">${data.text} <i class="fa fa-exclamation-triangle text-danger"></i></span>`);
                $(container).addClass('disabled');
            }else {
                span = $(`<span class="text-left">${data.text}</span>`);
            }
            return span;
        }
    })
    dateTimePickerTemplate($('#date-create-out-inventory-manage'), '' , new Date());
    $('#select-material-create-out-inventory-manage').prop("disabled", true);
    $('#select-goods-create-out-inventory-manage').prop("disabled", true);
    $('#select-internal-create-out-inventory-manage').prop("disabled", true);
    $('#select-other-create-out-inventory-manage').prop("disabled", true);
    dateTimePickerTemplate($('#date-create-out-inventory-manage'));
    shortcut.remove('F5');
    shortcut.remove('F1');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalCreateOutInventoryManage();
    });
    shortcut.add('F4', function () {
        saveModalCreateOutInventoryManage();
    });
    shortcut.add('F3', function () {
        openSelectMaterial();
    });
    await $('#select-material-create-out-inventory-manage').val($('.select-branch').val()).trigger('change');

    $('#select-material-create-out-inventory-manage').unbind('select2:select').on('select2:select', function () {
        let unit = $('#select-material-create-out-inventory-manage').find(':selected').data('unit'),
            unit_value = $('#select-material-create-out-inventory-manage').find(':selected').data('unit-value'),
            system_small = $('#select-material-create-out-inventory-manage').find(':selected').data('system-small'),
            system_quantity = $('#select-material-create-out-inventory-manage').find(':selected').data('remain-quantity'),
            keysearch = $('#select-material-create-out-inventory-manage').find(':selected').data('keysearch'),
            value = (system_quantity) >= 1 ? 1 : (system_quantity);
        let data = {
            'id': $(this).find(':selected').val(),
            'DT_RowIndex': tableMaterialCreateOutInventoryManage.length,
            'restaurant_material_name': $(this).find(':selected').text(),
            'restaurant_unit_full_name': '<select class="form-control edit-height-select-group rounded js-example-basic-single" onchange="onChangeUnit($(this))">' +
                '<option value="1" data-remain-quantity ="' + formatNumber(system_quantity) + '">' + unit + '</option>' +
                '<option value="2" data-system-small ="' + formatNumber(system_small) + '">' + unit_value + '</option>' +
                '</select>',
            'restaurant_quantity': formatNumber(checkDecimal($(this).find(':selected').data('remain-quantity'))),
            'quantity': '<div class="input-group border-group validate-table-validate">\n' +
                '  <input class="form-control adjustment text-center rounded border-0 w-100" data-id="' + $(this).find(':selected').val() + '" data-max="' + system_quantity + '" data-value-min-value-of="0" data-float="1"  value="' + value + '" data-type="currency-edit" data-check="0">\n' +
                '</div>',
            'action': '<div class="btn-group-sm">' +
                '<button class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="removeMaterialCreateOutInventoryManage($(this) , 1)" data-id="' + $(this).find(':selected').val() + '" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"><i class="fi-rr-trash"></i> </button>' +
                '</div>',
            'keysearch': keysearch

        }
        addRowDatatableTemplate(tableMaterialCreateOutInventoryManage, data);
        sumMaterialCreateOutInventoryManage()
        $(this).find(':selected').remove();
        $('#select-material-create-out-inventory-manage').find('option:first').prop('selected', true).trigger('change.select2');
    })

    $('#select-goods-create-out-inventory-manage').unbind('select2:select').on('select2:select', function () {
        let unit = $('#select-goods-create-out-inventory-manage').find(':selected').data('unit'),
            unit_value = $('#select-goods-create-out-inventory-manage').find(':selected').data('unit-value'),
            system_small = $('#select-goods-create-out-inventory-manage').find(':selected').data('system-small'),
            system_quantity = $('#select-goods-create-out-inventory-manage').find(':selected').data('remain-quantity'),
            keysearch = $('#select-goods-create-out-inventory-manage').find(':selected').data('keysearch');
        let data = {
            'id': $(this).find(':selected').val(),
            'DT_RowIndex': tableGoodsCreateOutInventoryManage.length,
            'restaurant_material_name': $(this).find(':selected').text(),
            'restaurant_unit_full_name': '<select class="form-control edit-height-select-group rounded js-example-basic-single" onchange="onChangeUnit($(this))">' +
                '<option value="1" data-remain-quantity ="' + formatNumber(system_quantity) + '">' + unit + '</option>' +
                '<option value="2" data-system-small ="' + formatNumber(system_small) + '">' + unit_value + '</option>' +
                '</select>',
            'restaurant_quantity': formatNumber(checkDecimal($(this).find(':selected').data('remain-quantity'))),
            'quantity': '<div class="input-group border-group validate-table-validate">\n' +
                '  <input class="form-control adjustment text-center rounded border-0 w-100" data-max="' + system_quantity + '" data-value-min-value-of="0" data-float="1" value="1" data-type="currency-edit" >\n' +
                '</div>',
            'action': '<div class="btn-group-sm">' +
                '<button class="tabledit-delete-button btn seemt-red seemt-btn-hover-red  waves-effect waves-light" onclick="removeMaterialCreateOutInventoryManage($(this) , 2)" data-id="' + $(this).find(':selected').val() + '" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"><i class="fi-rr-trash"></i></button>' +
                '</div>',
            'keysearch': keysearch

        }
        addRowDatatableTemplate(tableGoodsCreateOutInventoryManage, data);
        sumMaterialCreateOutInventoryManage()
        $(this).find(':selected').remove();
        $('#select-goods-create-out-inventory-manage').find('option:first').prop('selected', true).trigger('change.select2');
    })
    $('#select-internal-create-out-inventory-manage').unbind('select2:select').on('select2:select', function () {
        let unit = $('#select-internal-create-out-inventory-manage').find(':selected').data('unit'),
            unit_value = $('#select-internal-create-out-inventory-manage').find(':selected').data('unit-value'),
            system_small = $('#select-internal-create-out-inventory-manage').find(':selected').data('system-small'),
            system_quantity = $('#select-internal-create-out-inventory-manage').find(':selected').data('remain-quantity'),
            keysearch = $('#select-internal-create-out-inventory-manage').find(':selected').data('keysearch');
        let data = {
            'id': $(this).find(':selected').val(),
            'DT_RowIndex': tableInternalCreateOutInventoryManage.length,
            'restaurant_material_name': $(this).find(':selected').text(),
            'restaurant_unit_full_name': '<select class="form-control edit-height-select-group rounded js-example-basic-single" onchange="onChangeUnit($(this))">' +
                '<option value="1" data-remain-quantity ="' + formatNumber(system_quantity) + '">' + unit + '</option>' +
                '<option value="2" data-system-small ="' + formatNumber(system_small) + '">' + unit_value + '</option>' +
                '</select>',
            'restaurant_quantity': formatNumber(checkDecimal($(this).find(':selected').data('remain-quantity'))),
            'quantity': '<div class="input-group border-group validate-table-validate">\n' +
                '  <input class="form-control adjustment text-center rounded border-0 w-100" data-max="' + system_quantity + '" data-value-min-value-of="0" data-float="1" value="1" data-type="currency-edit"  data-check="0">\n' +
                '</div>',
            'action': ' <div class="btn-group-sm">' +
                '<button class="tabledit-delete-button btn seemt-red seemt-btn-hover-red  waves-effect waves-light" onclick="removeMaterialCreateOutInventoryManage($(this) , 3)" data-id="' + $(this).find(':selected').val() + '" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"><i class="fi-rr-trash"></i> </button>' +
                '</div>',
            'keysearch': keysearch
        }
        addRowDatatableTemplate(tableInternalCreateOutInventoryManage, data);
        sumMaterialCreateOutInventoryManage()
        $(this).find(':selected').remove();
        $('#select-internal-create-out-inventory-manage').find('option:first').prop('selected', true).trigger('change.select2');
    })
    $('#select-other-create-out-inventory-manage').unbind('select2:select').on('select2:select', function () {
        let unit = $('#select-other-create-out-inventory-manage').find(':selected').data('unit'),
            unit_value = $('#select-other-create-out-inventory-manage').find(':selected').data('unit-value'),
            system_small = $('#select-other-create-out-inventory-manage').find(':selected').data('system-small'),
            system_quantity = $('#select-other-create-out-inventory-manage').find(':selected').data('remain-quantity'),
            keysearch = $('#select-other-create-out-inventory-manage').find(':selected').data('keysearch');
        let data = {
            'id': $(this).find(':selected').val(),
            'DT_RowIndex': tableOtherCreateOutInventoryManage.length,
            'restaurant_material_name': $(this).find(':selected').text(),
            'restaurant_unit_full_name': '<select class="form-control edit-height-select-group rounded js-example-basic-single" onchange="onChangeUnit($(this))">' +
                '<option value="1" data-remain-quantity ="' + formatNumber(system_quantity) + '">' + unit + '</option>' +
                '<option value="2" data-system-small ="' + formatNumber(system_small) + '">' + unit_value + '</option>' +
                '</select>',
            'restaurant_quantity': formatNumber(checkDecimal($(this).find(':selected').data('remain-quantity'))),
            'quantity': '<div class="input-group border-group validate-table-validate">\n' +
                '  <input class="form-control adjustment text-center rounded border-0 w-100" data-max="' + system_quantity + '" data-float="1" value="1" data-type="currency-edit" data-check="0">\n' +
                '</div>',
            'action': '<div class="btn-group-sm">' +
                '<button class="tabledit-delete-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="removeMaterialCreateOutInventoryManage($(this) , 4)" data-id="' + $(this).find(':selected').val() + '" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"> <i class="fi-rr-trash"></i></button>' +
                '</div>',
            'keysearch': keysearch
        }
        addRowDatatableTemplate(tableOtherCreateOutInventoryManage, data);
        sumMaterialCreateOutInventoryManage()
        $(this).find(':selected').remove();
        $('#select-other-create-out-inventory-manage').find('option:first').prop('selected', true).trigger('change.select2');
    })
    $('#tab-create-out-inventory-manage').on('click', function () {
        tableMaterialCreateOutInventoryManage.draw();
        tableGoodsCreateOutInventoryManage.draw();
        tableInternalCreateOutInventoryManage.draw();
        tableOtherCreateOutInventoryManage.draw();
    })

    $('#modal-create-out-inventory-manage select').on('change', function (){
        $('#modal-create-out-inventory-manage .btn-renew').removeClass('d-none')
    })
    $('#date-create-out-inventory-manage').on('dp.change', function (){
        $('#modal-create-out-inventory-manage .btn-renew').removeClass('d-none')
    })
    $('#modal-create-out-inventory-manage textarea').on('input', function (){
        $('#modal-create-out-inventory-manage .btn-renew').removeClass('d-none')
    })

    $('#modal-create-out-inventory-manage .btn-renew').addClass('d-none');
    dataMaterialCreateOutInventoryManage();
    drawTableCreateOutInventoryManage();
}

async function dataMaterialCreateOutInventoryManage() {
    $('#select-material-create-out-inventory-manage').prop("disabled", true);
    $('#select-goods-create-out-inventory-manage').prop("disabled", true);
    $('#select-internal-create-out-inventory-manage').prop("disabled", true);
    $('#select-other-create-out-inventory-manage').prop("disabled", true);
    let branch = $('.select-branch').val(),
        method = 'get',
        url = 'out-inventory-manage.material',
        params = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-material-create-out-inventory-manage'),
        $('#select-goods-create-out-inventory-manage'),
        $('#select-internal-create-out-inventory-manage'),
        $('#select-other-create-out-inventory-manage')
    ]);
    $('#select-material-create-out-inventory-manage').html(res.data[0]);
    $('#select-goods-create-out-inventory-manage').html(res.data[1]);
    $('#select-internal-create-out-inventory-manage').html(res.data[2]);
    $('#select-other-create-out-inventory-manage').html(res.data[3]);

    $('#select-material-create-out-inventory-manage').prop("disabled", false);
    $('#select-goods-create-out-inventory-manage').prop("disabled", false);
    $('#select-internal-create-out-inventory-manage').prop("disabled", false);
    $('#select-other-create-out-inventory-manage').prop("disabled", false);
}

async function drawTableCreateOutInventoryManage() {
    let idTableMaterialCreateOutInventoryManage = $('#table-material-create-out-inventory-manage'),
        idTableGoodsCreateOutInventoryManage = $('#table-goods-create-out-inventory-manage'),
        idTableInternalCreateOutInventoryManage = $('#table-internal-create-out-inventory-manage'),
        idTableOtherCreateOutInventoryManage = $('#table-other-create-out-inventory-manage'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'restaurant_material_name', name: 'restaurant_material_name', className: 'text-center'},
            {data: 'restaurant_quantity', name: 'restaurant_quantity', className: 'text-center'},
            {
                data: 'restaurant_unit_full_name',
                name: 'restaurant_unit_full_name',
                className: 'text-center',
                width: '10%'
            },
            {data: 'quantity', name: 'quantity', className: 'text-center', width: '5%'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'text-center d-none', width: '5%'},
        ];
    tableMaterialCreateOutInventoryManage = await DatatableTemplateNew(idTableMaterialCreateOutInventoryManage, [], column, '40vh', fixed_left, fixed_right);
    tableGoodsCreateOutInventoryManage = await DatatableTemplateNew(idTableGoodsCreateOutInventoryManage, [], column, '40vh', fixed_left, fixed_right);
    tableInternalCreateOutInventoryManage = await DatatableTemplateNew(idTableInternalCreateOutInventoryManage, [], column, '40vh', fixed_left, fixed_right);
    tableOtherCreateOutInventoryManage = await DatatableTemplateNew(idTableOtherCreateOutInventoryManage, [], column, '40vh', fixed_left, fixed_right);
    $(document).on('input paste', 'input[type="search"]', async function () {
        $('#total-record-material-create-out-inventory-manage').text(tableMaterialCreateOutInventoryManage.rows({'search': 'applied'}).count())
        $('#total-record-goods-create-out-inventory-manage').text(tableGoodsCreateOutInventoryManage.rows({'search': 'applied'}).count())
        $('#total-record-internal-create-out-inventory-manage').text(tableInternalCreateOutInventoryManage.rows({'search': 'applied'}).count())
        $('#total-record-other-create-out-inventory-manage').text(tableOtherCreateOutInventoryManage.rows({'search': 'applied'}).count())
    })
}

function selectMaterialCreateOutInventoryManage(table, r) {
    let data = {
        'id': r.find(':selected').val(),
        'DT_RowIndex': table.length,
        'restaurant_material_name': r.find(':selected').text(),
        'restaurant_unit_full_name': r.find(':selected').data('unit'),
        'restaurant_quantity': r.find(':selected').data('remain-quantity'),
        'quantity': '<input class="form-control adjustment text-right rounded" data-float="1" value="1"/>',
        'action': '<div class="btn-group-sm">' +
            '<button class="tabledit-delete-button btn seemt-btn-hover-red waves-effect waves-light" onclick="removeMaterialCreateOutInventoryManage($(this))" data-id="' + r.find(':selected').val() + '"><i class="fi-rr-trash"></i> </button>' +
            '</div>'
    }
    addRowDatatableTemplate(table, data);
    // sumMaterialCreateOutInventoryManage();
    $('#select-material-create-out-inventory-manage').val('').trigger('change.select2');
    $('#select-goods-create-out-inventory-manage').val('').trigger('change.select2');
    $('#select-internal-create-out-inventory-manage').val('').trigger('change.select2');
    $('#select-other-create-out-inventory-manage').val('').trigger('change.select2');
    sumMaterialCreateOutInventoryManage();
}

function removeMaterialCreateOutInventoryManage(r, index) {
    let name = r.parents('tr').find('td:eq(1)').text(),
        id = r.parents('tr').find('td:eq(5)').find('button').data('id'),
        unit = r.parents('tr').find('td:eq(3)').find('select option:first').text(),
        data_remain_quantity = removeformatNumber(r.parents('tr').find('td:eq(3)').find('select option:nth-child(1)').data('remain-quantity')),
        data_remain_quantity_small = removeformatNumber(r.parents('tr').find('td:eq(3)').find('select option:nth-child(2)').data('system-small')),
        unit_value = r.parents('tr').find('td:eq(3)').find('select option:nth-child(2)').text(),
        quantity = r.parents('tr').find('td:eq(4)').find('input').val(),
        keysearch = r.parents('tr').find('td:eq(6)').text(),
        option = '<option value="' + id + '" data-system-small="' + data_remain_quantity_small + '"  data-remain-quantity ="' + data_remain_quantity + '" data-unit="' + unit + '"  data-unit-value="' + unit_value + '"    data-quantity="' + quantity + '"  data-keysearch="' + keysearch + '"  >' + name + '</option>';
    switch (index) {
        case 1:
            $('#select-material-create-out-inventory-manage').append(option);
            tableMaterialCreateOutInventoryManage.row(r.parents('tr')).remove().draw(false);
            removeRowDatatableTemplate(tableMaterialCreateOutInventoryManage, r , true);
            break;
        case 2:
            $('#select-goods-create-out-inventory-manage').append(option);
            removeRowDatatableTemplate(tableGoodsCreateOutInventoryManage, r , true);

            break;
        case 3:
            $('#select-internal-create-out-inventory-manage').append(option);
            removeRowDatatableTemplate(tableInternalCreateOutInventoryManage, r , true);

            break;
        case 4:
            $('#select-other-create-out-inventory-manage').append(option);
            removeRowDatatableTemplate(tableOtherCreateOutInventoryManage, r , true);
            break;
    }
    sumMaterialCreateOutInventoryManage();
}

function openSelectMaterial() {
    let index = $('.remove-draw-table.active').data('type');
    switch (index) {
        case 1:
            $('#select-material-create-out-inventory-manage').select2('open');
            break;
        case 2:
            $('#select-goods-create-out-inventory-manage').select2('open');
            break;
        case 3:
            $('#select-internal-create-out-inventory-manage').select2('open');
            break;
        case 4:
            $('#select-other-create-out-inventory-manage').select2('open');
            break;
    }
}

function onChangeUnit(r) {
    let wholesaleQuantity;
    let quantity = removeformatNumber(r.parents('tr').find('td:eq(4)').find('input').val());
    if (r.val() == 1) {
        r.parents('tr').find('td:eq(2)').text(formatNumber(r.find(':selected').data('remain-quantity')))
        wholesaleQuantity = removeformatNumber(r.parents('tr').find('td:eq(2)').text());
        (quantity <= wholesaleQuantity) ? r.parents('tr').find('td:eq(4)').find('input').val(formatNumber(r.parents('tr').find('td:eq(4)').find('input').val())) : r.parents('tr').find('td:eq(4)').find('input').val(formatNumber(wholesaleQuantity));
        r.parents('tr').find('td:eq(4)').find('input').attr('data-max', removeformatNumber(formatNumber(wholesaleQuantity)));
        r.parents('tr').find('td:eq(4)').find('input').attr('data-value-min-value-of', '0');
        r.parents('tr').find('td:eq(4)').find('input').attr('float', '1');
    } else {
        r.parents('tr').find('td:eq(2)').text(formatNumber(r.find(':selected').data('system-small')))
        wholesaleQuantity = removeformatNumber(r.parents('tr').find('td:eq(2)').text());
        (quantity <= wholesaleQuantity) ? r.parents('tr').find('td:eq(4)').find('input').val(formatNumber(r.parents('tr').find('td:eq(4)').find('input').val())) : r.parents('tr').find('td:eq(4)').find('input').val(formatNumber(wholesaleQuantity));
        r.parents('tr').find('td:eq(4)').find('input').attr('data-max', removeformatNumber(formatNumber(wholesaleQuantity)));
        r.parents('tr').find('td:eq(4)').find('input').attr('data-value-min-value-of', '0');
        r.parents('tr').find('td:eq(4)').find('input').attr('float', '1');
    }
}

async function sumMaterialCreateOutInventoryManage() {
    $('#total-record-material-create-out-inventory-manage').text(formatNumber(tableMaterialCreateOutInventoryManage.data().count()));
    $('#total-record-goods-create-out-inventory-manage').text(formatNumber(tableGoodsCreateOutInventoryManage.data().count()));
    $('#total-record-internal-create-out-inventory-manage').text(formatNumber(tableInternalCreateOutInventoryManage.data().count()));
    $('#total-record-other-create-out-inventory-manage').text(formatNumber(tableOtherCreateOutInventoryManage.data().count()));
}

function pushArrayCreateOutInventoryManage(row) {
    if (removeformatNumber(row.find('td:eq(4)').find('input').val()) > 0) {
        materialCreateOutInventoryManage.push({
            "material_id": row.find('td:eq(5)').find('button').data('id'),
            "user_input_quantity": removeformatNumber(row.find('td:eq(4)').find('input').val()),
            "user": removeformatNumber(row.find('td:eq(2)').find('input').val()),
            "sort": '',
            "user_input_unit_type": row.find('td:eq(3)').find('select').val(),
            "note": JSON.stringify(''),
        })
    }
}

async function saveModalCreateOutInventoryManage() {
    if (checkSaveCreateOutInventoryManage === 1) return false;
    if (!checkValidateSave($('#modal-create-out-inventory-manage'))){
        if ($('.border-group').hasClass('border-danger')){
            $(".border-danger")[0].scrollIntoView();
        }else if ($('.form-validate-input').hasClass('validate-error')){
            $(".validate-error")[0].scrollIntoView();
        }
        return false
    }
    let branch = $('.select-branch').val(),
        note = $('#note-create-out-inventory-manage').val(),
        delivery_date = $('#date-create-out-inventory-manage').val(),
        export_type = $('#select-inventory-target-create-out-inventory-manage').val(),
        request_id = 0;
    materialCreateOutInventoryManage = [];
    tableMaterialCreateOutInventoryManage.rows().every(function () {
        let row = $(this.node());
        pushArrayCreateOutInventoryManage(row)
    });
    tableGoodsCreateOutInventoryManage.rows().every(function () {
        let row = $(this.node());
        pushArrayCreateOutInventoryManage(row)
    });
    tableInternalCreateOutInventoryManage.rows().every(function () {
        let row = $(this.node());
        pushArrayCreateOutInventoryManage(row)
    });
    tableOtherCreateOutInventoryManage.rows().every(function () {
        let row = $(this.node());
        pushArrayCreateOutInventoryManage(row)
    });
    if (materialCreateOutInventoryManage.length === 0) {
        WarningNotify('Vui lòng chọn nguyên liệu !!!');
        return false;
    }
    let method = 'post',
        url = 'out-inventory-manage.create',
        params = null,
        data = {
            branch: branch,
            material: materialCreateOutInventoryManage,
            note: note,
            delivery_date: delivery_date,
            export_type: export_type,
            request_id: request_id,
        };
    checkSaveCreateOutInventoryManage = 1;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-create-out-inventory-manage')]);
    checkSaveCreateOutInventoryManage = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            loadingData();
            closeModalCreateOutInventoryManage();
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
            if (res.data.message !== null)
                text = res.data.message;
            WarningNotify(text);
    }
}

function closeModalCreateOutInventoryManage() {
    $('#modal-create-out-inventory-manage').modal('hide');
    shortcut.remove('F3');
    shortcut.remove('F4');
    shortcut.remove('F5');
    shortcut.remove('F6');
    shortcut.remove('F1');
    shortcut.add("F2", function () {
        openCreateOutInventoryManage();
    });
    $('#modal-create-out-inventory-manage .btn-renew').addClass('d-none');
    resetModalCreateOutInventoryManage();
    countCharacterTextarea()
}
function resetModalCreateOutInventoryManage() {
    tableMaterialCreateOutInventoryManage.clear().draw(false);
    tableGoodsCreateOutInventoryManage.clear().draw(false);
    tableInternalCreateOutInventoryManage.clear().draw(false);
    tableOtherCreateOutInventoryManage.clear().draw(false);
    $('#tab-create-out-inventory-manage .nav-link:first').click();
    $('#select-inventory-target-create-out-inventory-manage').val(2).trigger('change.select2');
    $('#date-create-out-inventory-manage').val(moment().format('DD/MM/YYYY'));
    $('#note-create-out-inventory-manage').val('');
    dataMaterialCreateOutInventoryManage();
    sumMaterialCreateOutInventoryManage();
    $('#modal-create-out-inventory-manage .btn-renew').addClass('d-none');
    $('#char-count > span').text('0/300');
}

