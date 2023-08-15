let checkChangeCreateOutInventoryBranchManage = 0,
    saveCreateOutInventoryBranchManage = 0,
    inventoryCreateOutInventoryBranchManage = $('#select-inventory-create-out-inventory-internal-manage').val(), dataTableCreateOutInventoryBranchManage;

$(function (){
    $(document).on('change dp.change', $('#select-inventory-create-out-inventory-internal-manage',
                               '#select-inventory-create-out-inventory-internal-manage',
                               '#select-target-branch-create-out-inventory-internal-manage',
                               '#date-create-out-inventory-internal-manage'), function (){
        $('.btn-renew').removeClass('d-none')
    })
    $(document).on('input paste', $('#note-create-out-inventory-internal-manage'), function (){
        $('.btn-renew').removeClass('d-none')
    })
    $('.btn-renew').on('click', function (){
        $(this).addClass('d-none')
    })
    dateTimePickerTemplate($('#date-create-out-inventory-internal-manage'), '' , new Date());
})

async function openCreateOutInventoryInternalManage() {
    checkChangeCreateOutInventoryBranchManage = 0;
    saveCreateOutInventoryBranchManage = 0;
    $('.btn-renew').addClass('d-none')
    $('#modal-create-out-inventory-internal-manage').modal('show');
    let branchOptions = $(`.select-branch:nth(${$('#div-out-inventory-branch-manage a.nav-link.active').data('id')})`).html();
    $('#select-target-branch-create-out-inventory-internal-manage').html(branchOptions);

    $('#modal-create-out-inventory-internal-manage .js-example-basic-single, #select-target-branch-create-out-inventory-internal-manage').select2({
        dropdownParent: $('#modal-create-out-inventory-internal-manage'),
    });
    $('#select-material-create-out-inventory-internal-manage').select2({
        dropdownParent: $('#modal-create-out-inventory-internal-manage'),
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
    $('#select-target-branch-create-out-inventory-internal-manage option[value="' + $('.select-branch').val() + '"]').remove();
    shortcut.remove('F4');
    shortcut.add('F4', function () {
        saveModalCreateOutInventoryInternalManage();
    });
    shortcut.add('ESC', function () {
        closeModalCreateOutInventoryInternalManage();
    });
    dateTimePickerTemplate($('#date-create-out-inventory-internal-manage'));
    eventCreateOutInventoryInternalManage();
    dataMaterialCreateOutInventoryInternalManage();
    drawTableCreateInInventoryManage();
}

function eventCreateOutInventoryInternalManage() {
    $('#select-inventory-create-out-inventory-internal-manage').on('select2:select', function () {
        if (dataTableCreateOutInventoryBranchManage.data().any()) {
            let title = 'Đổi kho ?',
                content = 'Bạn đã chọn nguyên liệu, đổi kho sẽ làm mới danh sách nguyên liệu !',
                icon = 'question';
            sweetAlertComponent(title, content, icon).then((result) => {
                if (result.value) {
                    inventoryCreateOutInventoryBranchManage = $(this).val();
                    dataMaterialCreateOutInventoryInternalManage();
                    drawTableCreateInInventoryManage();
                } else {
                    $(this).val(inventoryCreateOutInventoryBranchManage).trigger('change.select2');
                }
            });
        } else {
            inventoryCreateOutInventoryBranchManage = $(this).val();
            dataMaterialCreateOutInventoryInternalManage();
            drawTableCreateInInventoryManage();
        }
    });
    $('#select-material-create-out-inventory-internal-manage').unbind('select2:select').on('select2:select', function () {
        let unit = $(this).find(':selected').data('unit'),
            unit_value = $(this).find(':selected').data('unit-value'),
            system_small = $(this).find(':selected').data('system-small'),
            system_quantity = $(this).find(':selected').data('remain-quantity'),
            keysearch = $(this).find(':selected').data('keysearch'),
            value = (system_quantity) <= 1 ? system_quantity : 1;
        let data = {
            'id': $(this).find(':selected').val(),
            'DT_RowIndex': dataTableCreateOutInventoryBranchManage.length,
            'restaurant_material_name': $(this).find(':selected').text(),
            'restaurant_unit_full_name': '<select class="form-control edit-height-select-group rounded js-example-basic-single" onchange="onChangeUnit($(this))">' +
                '<option value="1" data-remain-quantity="' + formatNumber(system_quantity) + '">' + unit + '</option>' +
                '<option value="2" data-system-small ="' + formatNumber(system_small) + '">' + unit_value + '</option>' +
                '</select>',
            'restaurant_quantity': formatNumber($(this).find(':selected').data('remain-quantity')),
            'quantity': '<div class="input-group border-group validate-table-validate">\n' +
                '<input class="form-control adjustment text-center rounded border-0 w-100" data-max="' + system_quantity + '" data-value-min-value-of="0" data-float="1"  value="' + value + '" data-type="currency-edit" data-check="0">\n' +
                '</div>',
            'action': '<div class="btn-group-sm">' +
                '<button class="tabledit-edit-button seemt-red btn seemt-btn-hover-red waves-effect waves-light" onclick="removeMaterialCreateOutInventoryInternalManage($(this))" data-id="' + $(this).find(':selected').val() + '" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"><i class="fi-rr-trash"></i></button>' +
                '</div>',
            'keysearch': keysearch
        }
        addRowDatatableTemplate(dataTableCreateOutInventoryBranchManage, data);
        $(this).find(':selected').remove();
        $('#select-material-create-out-inventory-internal-manage').find('option:first').prop('selected', true).trigger('change.select2');
    });
}

async function dataMaterialCreateOutInventoryInternalManage() {
    $('#select-material-create-out-inventory-internal-manage option').not(':first').remove();
    let method = 'get',
        url = 'out-inventory-branch-manage.material',
        branch = $('.select-branch').val(),
        inventory = $('#select-inventory-create-out-inventory-internal-manage').val(),
        params = {branch: branch, inventory: inventory},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-material-create-out-inventory-internal-manage')
    ]);
    $('#select-material-create-out-inventory-internal-manage').html(res.data[0]);
}

async function drawTableCreateInInventoryManage() {
    let tableMaterialCreateOutInventoryInternalManage = $('#table-material-create-out-inventory-internal-manage'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'restaurant_material_name', name: 'restaurant_material_name', className: 'text-center'},
            {data: 'restaurant_quantity', name: 'restaurant_quantity', className: 'text-center'},
            {data: 'restaurant_unit_full_name', name: 'restaurant_unit_full_name', className: 'text-center',},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ];
    dataTableCreateOutInventoryBranchManage = await DatatableTemplateNew(tableMaterialCreateOutInventoryInternalManage, [], column, vh_of_table, fixed_left, fixed_right);
}

async function removeMaterialCreateOutInventoryInternalManage(r) {
    let name = r.parents('tr').find('td:eq(1)').text(),
        id = r.parents('tr').find('td:eq(5)').find('button').data('id'),
        unit = r.parents('tr').find('td:eq(3)').find('select option:first').text(),
        data_remain_quantity = r.parents('tr').find('td:eq(3)').find('select option:nth-child(1)').data('remain-quantity'),
        data_remain_quantity_small = r.parents('tr').find('td:eq(3)').find('select option:nth-child(2)').data('system-small'),
        unit_value = r.parents('tr').find('td:eq(3)').find('select option:nth-child(2)').text(),
        quantity = r.parents('tr').find('td:eq(4)').find('input').val(),
        keysearch = r.parents('tr').find('td:eq(6)').text(),
    option = '<option value="' + id + '" data-system-small="' + data_remain_quantity_small + '"  data-remain-quantity ="' + data_remain_quantity + '" data-unit="' + unit + '"  data-unit-value="' + unit_value + '" data-quantity="' + quantity + '" data-keysearch="' + keysearch + '">' + name + '</option>';
    $('#select-material-create-out-inventory-internal-manage').append(option);
    removeRowDatatableTemplate(dataTableCreateOutInventoryBranchManage, r , true);
}

function onChangeUnit(r) {
    let wholesaleQuantity;
    let quantity = removeformatNumber(r.parents('tr').find('td:eq(4)').find('input').val());
    if (r.val() == 1) {
        r.parents('tr').find('td:eq(2)').text(formatNumber(r.find(':selected').data('remain-quantity')))
        wholesaleQuantity = removeformatNumber(r.parents('tr').find('td:eq(2)').text());
        (quantity <= wholesaleQuantity) ? r.parents('tr').find('td:eq(4)').find('input').val(r.parents('tr').find('td:eq(4)').find('input').val()) : r.parents('tr').find('td:eq(4)').find('input').val(wholesaleQuantity);
        r.parents('tr').find('td:eq(4)').find('input').attr('data-max', removeformatNumber(formatNumber(wholesaleQuantity)));
        r.parents('tr').find('td:eq(4)').find('input').attr('data-value-min-value-of', '0');
        r.parents('tr').find('td:eq(4)').find('input').attr('float', '1');
    } else {
        r.parents('tr').find('td:eq(2)').text(formatNumber(r.find(':selected').data('system-small')))
        wholesaleQuantity = removeformatNumber(r.parents('tr').find('td:eq(2)').text());
        (quantity <= wholesaleQuantity) ? r.parents('tr').find('td:eq(4)').find('input').val(r.parents('tr').find('td:eq(4)').find('input').val()) : r.parents('tr').find('td:eq(4)').find('input').val(wholesaleQuantity);
        r.parents('tr').find('td:eq(4)').find('input').attr('data-max', removeformatNumber(formatNumber(wholesaleQuantity)));
        r.parents('tr').find('td:eq(4)').find('input').attr('data-value-min-value-of', '0');
        r.parents('tr').find('td:eq(4)').find('input').attr('float', '1');
    }
}

async function saveModalCreateOutInventoryInternalManage() {
    if (saveCreateOutInventoryBranchManage === 1 ) return false;
    if (!checkValidateSave($('#modal-create-out-inventory-internal-manage'))) return false;
    let TableData = [];
    dataTableCreateOutInventoryBranchManage.rows().every(function () {
        let row = $(this.node());
        TableData.push({
            'DT_RowIndex': dataTableCreateOutInventoryBranchManage.length,
            "material_id": row.find('td:eq(5)').find('button').data('id'),
            "user_input_quantity": removeformatNumber(row.find('td:eq(4)').find('input').val()),
            "user_input_unit_type": row.find('td:eq(3)').find('select').val(),
            "note": '',
        });
    });
    let note = $('#note-create-out-inventory-internal-manage').val(),
        branch = $('.select-branch').val(),
        target_branch = $('#select-target-branch-create-out-inventory-internal-manage').val(),
        delivery_date = $('#date-create-out-inventory-internal-manage').val(),
        inventory = $('#select-inventory-create-out-inventory-internal-manage').val();
    if (TableData.length == 0) {
        WarningNotify('Vui lòng chọn nguyên liệu !');
        return false;
    }
    saveCreateOutInventoryBranchManage = 1;
    let method = 'post',
        url = 'out-inventory-branch-manage.create',
        params = null,
        data = {
            table: TableData,
            note: note,
            date: delivery_date,
            branch_id: branch,
            target_branch_id: target_branch,
            inventory: inventory,
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-create-out-inventory-internal-manage')
    ]);
    saveCreateOutInventoryBranchManage = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            loadingData();
            closeModalCreateOutInventoryInternalManage();
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            ErrorNotify(text);
            break;
        default:
            text = $('#error-post-data-to-server').text();
            saveCreateOutInventoryBranchManage = 0;
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
    }
}

function closeModalCreateOutInventoryInternalManage() {
    shortcut.remove('F1');
    shortcut.remove('F2');
    shortcut.remove('F3');
    shortcut.remove('F4');
    shortcut.remove('F5');
    shortcut.remove('F6');
    shortcut.remove('F9');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openCreateOutInventoryInternalManage();
    });
    $('#modal-create-out-inventory-internal-manage').modal('hide');
    resetModalCreateOutInventoryInternalManage()
    removeAllValidate();
    countCharacterTextarea()
}

function resetModalCreateOutInventoryInternalManage() {
    dataTableCreateOutInventoryBranchManage.search( '' ).columns().search( '' ).draw(false);
    $('#modal-create-out-inventory-internal-manage .js-example-basic-single').find('option:first').prop('selected', true).trigger('change.select2');
    $('#total-record-create-out-inventory-internal-manage, #total-final-create-out-inventory-internal-manage').text('0');
    $('#note-create-out-inventory-internal-manage').val('');
    // $('#select-inventory-create-out-inventory-internal-manage').val(1).trigger('change.select2');
    $('#date-create-out-inventory-internal-manage').val(moment().format('DD/MM/YYYY'));
    // $('#select-target-branch-create-out-inventory-internal-manage').val($('#select-target-branch-create-out-inventory-internal-manage').find('option:first-child').val()).trigger('change.select2');
    dataMaterialCreateOutInventoryInternalManage();
    dataTableCreateOutInventoryBranchManage.clear().draw(false);
}
