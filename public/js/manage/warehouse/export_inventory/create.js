let checkSaveCreateExportWarehouse = 0,
    tableInventoryExportWarehouse,
    branchActive = $('#select-target-branch-create-export-inventory-warehouse').val(),
    cateTypeParentActive = $('#select-cate-type-parent-create-export-inventory-warehouse option:eq(0)').val();
$(function () {
    $('#note-create-export-inventory-warehouse').on('input', function () {
        if ($(this).val().length > 300) {
            $(this).val($(this).val().substring(0, 300));
        }
        $('#modal-create-export-inventory-warehouse').find('#char-count > span:eq(0)').text($('#note-create-export-inventory-warehouse').val().length);
    });
    $('#note-create-export-inventory-warehouse').on('paste', function (e) {
        let pasteData = e.originalEvent.clipboardData.getData('text/plain');
        if ($(this).val().length + pasteData.length > 300) {
            e.preventDefault();
            WarningNotify('Ghi chú dài tối đa 300 ký tự !');
        }
        setTimeout(function () {
            $('#modal-create-export-inventory-warehouse').find('#char-count > span:eq(0)').text($('#note-create-export-inventory-warehouse').val().length);
        },100);
    });
    $(document).on('change dp.change input paste',`#select-cate-type-parent-create-export-inventory-warehouse, #select-inventory-create-export-inventory-warehouse, #note-create-export-inventory-warehouse,
                                       #select-target-branch-create-export-inventory-warehouse, #date-create-export-inventory-warehouse`, () => $('.btn-renew').removeClass('d-none'));
    $('.btn-renew').on('click', () => $('.btn-renew').addClass('d-none'));
    dateTimePickerTemplate($('#date-create-export-inventory-warehouse'), '' , new Date());
    $(document).on('change', '#select-target-branch-create-export-inventory-warehouse, #select-cate-type-parent-create-export-inventory-warehouse ', changeBranch);
    $('#select-material-create-export-inventory-warehouse').unbind('select2:select').on('select2:select', function () {
        let unit = $(this).find(':selected').data('unit'),
            unit_value = $(this).find(':selected').data('unit-value'),
            system_small = $(this).find(':selected').data('system-small'),
            system_quantity = $(this).find(':selected').data('remain-quantity'),
            keysearch = $(this).find(':selected').data('keysearch'),
            value = (system_quantity) <= 1 ? system_quantity : 1;
        let data = {
            'id': $(this).find(':selected').val(),
            'DT_RowIndex': tableInventoryExportWarehouse.length,
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
                '<button class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="removeMaterialCreateExportInventoryWarehouse($(this))" data-id="' + $(this).find(':selected').val() + '" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"><i class="fi-rr-trash"></i></button>' +
                '</div>',
            'keysearch': keysearch
        }
        addRowDatatableTemplate(tableInventoryExportWarehouse, data);
        $(this).find(':selected').remove();
        $('#select-material-create-export-inventory-warehouse').find('option:first').prop('selected', true).trigger('change.select2');
    });
})

function openCreateExportInventoryWarehouse () {
    // if (!$('#select-target-branch-create-export-inventory-warehouse option').length) {
    //     WarningNotify('Vui lòng gán kho chi nhánh cho kho tổng trước khi tạo phiếu xuất kho !');
    //     return false;
    // }
    $('#modal-create-export-inventory-warehouse').modal('show');
    $('.btn-renew').addClass('d-none');
    $('#modal-create-export-inventory-warehouse .js-example-basic-single, #select-target-branch-create-export-inventory-warehouse').select2({
        dropdownParent: $('#modal-create-export-inventory-warehouse'),
    });
    $('#select-material-create-export-inventory-warehouse').select2({
        dropdownParent: $('#modal-create-export-inventory-warehouse'),
        templateResult : function (data, container){
            let span = '';
            if($(data.element).attr('data-system-small') <= 0 || $(data.element).attr('data-remain-quantity') <= 0){
                span = $(`<span class="d-flex align-items-center">${data.text} <i class="fa fa-exclamation-triangle text-danger"></i></span>`);
                $(container).addClass('disabled');
            }else {
                span = $(`<span class="text-left">${data.text}</span>`);
            }
            return span;
        }
    });
    shortcut.remove('F4');
    shortcut.add('F4', saveModalCreateExportInventoryWarehouse);
    shortcut.add('ESC', closeModalCreateExportInventoryWarehouse);
    drawTableCreateExportInventoryWarehouse();
    dataMaterialCreateExportInventoryWarehouse();
}

async function saveModalCreateExportInventoryWarehouse () {
    if (checkSaveCreateExportWarehouse === 1 ) return false;
    if (!checkValidateSave($('#modal-create-export-inventory-warehouse'))) return false;
    let TableData = [];
    tableInventoryExportWarehouse.rows().every(function () {
        let row = $(this.node());
        TableData.push({
            'DT_RowIndex': tableInventoryExportWarehouse.length,
            "material_id": row.find('td:eq(5)').find('button').data('id'),
            "user_input_quantity": removeformatNumber(row.find('td:eq(4)').find('input').val()),
            "user_input_unit_type": row.find('td:eq(3)').find('select').val(),
            "note": '',
        });
    });
    let note = $('#note-create-export-inventory-warehouse').val(),
        branch = $('.select-branch').val(),
        target_branch = $('#select-target-branch-create-export-inventory-warehouse').val(),
        delivery_date = $('#date-create-export-inventory-warehouse').val(),
        inventory = $('#select-cate-type-parent-create-export-inventory-warehouse').val();
    if (TableData.length === 0) {
        WarningNotify('Vui lòng chọn nguyên liệu !');
        return false;
    }
    checkSaveCreateExportWarehouse = 1;
    let method = 'post',
        url = 'export-inventory-warehouse.create',
        params = null,
        data = {
            table: TableData,
            note: note,
            date: delivery_date,
            branch_id: branch,
            target_branch_id: target_branch,
            inventory: inventory,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-create-export-inventory-warehouse')]);
    checkSaveCreateExportWarehouse = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            loadingDataExportInventory();
            closeModalCreateExportInventoryWarehouse();
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            ErrorNotify(text);
            break;
        default:
            text = $('#error-post-data-to-server').text();
            checkSaveCreateExportWarehouse = 0;
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
    }
}

function changeBranch() {
    if (tableInventoryExportWarehouse.data().any()) {
        let title = 'Đổi kho ?',
            content = 'Bạn đã chọn nguyên liệu, thay đổi này sẽ làm mới danh sách nguyên liệu !',
            icon = 'question';
        sweetAlertComponent(title, content, icon).then((result) => {
            if (result.value) {
                branchActive = $('#select-target-branch-create-export-inventory-warehouse').val();
                cateTypeParentActive = $('#select-cate-type-parent-create-export-inventory-warehouse').val();
                dataMaterialCreateExportInventoryWarehouse();
                drawTableCreateExportInventoryWarehouse();
            }else {
                $('#select-target-branch-create-export-inventory-warehouse').val(branchActive).trigger('select2:select');
                $('#select-cate-type-parent-create-export-inventory-warehouse').val(cateTypeParentActive).trigger('change.select2');
            }
        });
    } else {
        branchActive = $('#select-target-branch-create-export-inventory-warehouse').val();
        cateTypeParentActive = $('#select-cate-type-parent-create-export-inventory-warehouse').val();
        dataMaterialCreateExportInventoryWarehouse();
        drawTableCreateExportInventoryWarehouse();
    }
}

async function dataMaterialCreateExportInventoryWarehouse() {
    let method = 'get',
        url = 'export-inventory-warehouse.material',
        branch = $('.select-branch').val(),
        branchTarget = $('#select-target-branch-create-export-inventory-warehouse').val(),
        categoryTypeParent = $('#select-cate-type-parent-create-export-inventory-warehouse').val(),
        params = {branch, branchTarget, categoryTypeParent},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-material-create-export-inventory-warehouse')]);
    $('#select-material-create-export-inventory-warehouse').html(res.data?.[0]);
}

function removeMaterialCreateExportInventoryWarehouse (r) {
    let name = r.parents('tr').find('td:eq(1)').text(),
        id = r.parents('tr').find('td:eq(5)').find('button').data('id'),
        unit = r.parents('tr').find('td:eq(3)').find('select option:first').text(),
        data_remain_quantity = r.parents('tr').find('td:eq(3)').find('select option:nth-child(1)').data('remain-quantity'),
        data_remain_quantity_small = r.parents('tr').find('td:eq(3)').find('select option:nth-child(2)').data('system-small'),
        unit_value = r.parents('tr').find('td:eq(3)').find('select option:nth-child(2)').text(),
        quantity = r.parents('tr').find('td:eq(4)').find('input').val(),
        keysearch = r.parents('tr').find('td:eq(6)').text(),
        option = '<option value="' + id + '" data-system-small="' + data_remain_quantity_small + '"  data-remain-quantity ="' + data_remain_quantity + '" data-unit="' + unit + '"  data-unit-value="' + unit_value + '" data-quantity="' + quantity + '" data-keysearch="' + keysearch + '">' + name + '</option>';
    $('#select-material-create-export-inventory-warehouse').append(option);
    removeRowDatatableTemplate(tableInventoryExportWarehouse, r , true);
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
async function drawTableCreateExportInventoryWarehouse() {
    let table = $('#table-material-create-export-inventory-warehouse'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'restaurant_material_name', name: 'restaurant_material_name', className: 'text-left'},
            {data: 'restaurant_quantity', name: 'restaurant_quantity', className: 'text-center'},
            {data: 'restaurant_unit_full_name', name: 'restaurant_unit_full_name', className: 'text-center',},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ];
    tableInventoryExportWarehouse = await DatatableTemplateNew(table, [], column, vh_of_table, fixed_left, fixed_right);
}

function resetModalCreateExportInventoryWarehouse () {
    tableInventoryExportWarehouse.search( '' ).columns().search( '' ).draw(false);
    $('#modal-create-export-inventory-warehouse .js-example-basic-single').find('option:first').prop('selected', true).trigger('change.select2');
    // $('#total-record-create-out-inventory-internal-manage, #total-final-create-out-inventory-internal-manage').text('0');
    $('#note-create-export-inventory-warehouse').val('');
    $('#select-cate-type-parent-create-export-inventory-warehouse').val(1).trigger('change.select2');
    $('#date-create-export-inventory-warehouse').val(moment().format('DD/MM/YYYY'));
    $('#select-target-branch-create-export-inventory-warehouse').val($('#select-target-branch-create-export-inventory-warehouse').find('option:first-child').val()).trigger('change.select2');
    dataMaterialCreateExportInventoryWarehouse();
    tableInventoryExportWarehouse.clear().draw(false);
}

function closeModalCreateExportInventoryWarehouse () {
    shortcut.remove('F1');
    shortcut.remove('F2');
    shortcut.remove('F3');
    shortcut.remove('F4');
    shortcut.remove('F5');
    shortcut.remove('F6');
    shortcut.remove('F9');
    shortcut.remove('ESC');
    shortcut.add('F2', openCreateExportInventoryWarehouse);
    resetModalCreateExportInventoryWarehouse();
    $('#modal-create-export-inventory-warehouse').modal('hide');
    removeAllValidate();
    countCharacterTextarea()
}
