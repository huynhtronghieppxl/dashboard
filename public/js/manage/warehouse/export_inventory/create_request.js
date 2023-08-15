let checkSaveCreateRequestExportWarehouse = 0,
    tableCreateRequestExportWarehouse,
    optionCreateRequestActive = $('#select-list-request-export-warehouse').val();
$(function () {
    $('#note-create-request-export-warehouse').on('input', function () {
        if ($(this).val().length > 300) {
            $(this).val($(this).val().substring(0, 300));
        }
        $('#modal-create-request-export-warehouse').find('#char-count > span:eq(0)').text($('#note-create-request-export-warehouse').val().length);
    });
    $('#note-create-request-export-warehouse').on('paste', function (e) {
        let pasteData = e.originalEvent.clipboardData.getData('text/plain');
        if ($(this).val().length + pasteData.length > 300) {
            e.preventDefault();
            WarningNotify('Ghi chú dài tối đa 300 ký tự !');
        }
        setTimeout(function () {
            $('#modal-create-request-export-warehouse').find('#char-count > span:eq(0)').text($('#note-create-request-export-warehouse').val().length);
        },100);
    });
    $(document).on('change dp.change input paste',`#select-list-request-export-warehouse, #date-create-request-export-warehouse, #note-create-request-export-warehouse,
                                       #check-create-request-export-warehouse`, () => $('.btn-renew').removeClass('d-none'));
    $('#select-list-request-export-warehouse').on('select2:select', async function () {
        if (tableCreateRequestExportWarehouse.data().any()) {
            let title = 'Đổi phiếu yêu cầu ?',
                content = 'Bạn đã chọn nguyên liệu, đổi phiếu yêu cầu sẽ làm mới danh sách nguyên liệu !',
                icon = 'question';
            sweetAlertComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    optionCreateRequestActive = $(this).val();
                    $('#inventory-create-request-export-warehouse').text($('#select-list-request-export-warehouse option:selected').data('name'));
                    $('#inventory-target-create-request-export-warehouse').text($('#select-list-request-export-warehouse option:selected').data('export'));
                    dataTableMaterialRequestExportWarehouse();
                }else {
                    $('#select-list-request-export-warehouse').val(optionCreateRequestActive).trigger('change.select2');
                }
            });
        } else {
            optionCreateRequestActive = $(this).val();
            $('#inventory-create-request-export-warehouse').text($('#select-list-request-export-warehouse option:selected').data('name'));
            $('#inventory-target-create-request-export-warehouse').text($('#select-list-request-export-warehouse option:selected').data('export'));
            dataTableMaterialRequestExportWarehouse();
        }
    });
    $('.btn-renew').on('click', () => $('.btn-renew').addClass('d-none'));
})

function openCreateRequestExportInventoryWarehouse () {
    $('#modal-create-request-export-warehouse').modal('show');
    $('.btn-renew').addClass('d-none');
    $('#select-list-request-export-warehouse').select2({
        dropdownParent: $('#modal-create-request-export-warehouse'),
    })
    shortcut.remove("F3");
    shortcut.add('F3', function () {
        $('#select-list-request-export-warehouse').select2('open');
    });
    shortcut.add('ESC', closeModalCreateRequestExportWarehouse);
    shortcut.add('F4', saveModalCreateRequestExportWarehouse);
    dateTimePickerTemplate($('#date-create-request-export-warehouse'));
    dataTableMaterialRequestExportWarehouse([]);
    dataRequestCreateRequestExportWarehouse();
}

async function dataRequestCreateRequestExportWarehouse() {
    let method = 'get',
        url = 'export-inventory-warehouse.list-request',
        branch = $('.select-branch').val(),
        params = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-list-request-export-warehouse')]);
    $('#select-list-request-export-warehouse').html(res.data?.[0]);
}


async function dataTableMaterialRequestExportWarehouse(data) {
    let id = $('#table-material-create-request-export-warehouse'),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name'},
            {data: 'system_last_quantity', name: 'system_last_quantity', className: 'text-center'},
            {data: 'quantity_request', name: 'quantity_request', className: 'text-center'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'text-center d-none'},
        ];
    tableCreateRequestExportWarehouse = await DatatableTemplateNew(id, data, columns, vh_of_table, fixed_left, fixed_right);
}

async function saveModalCreateRequestExportWarehouse() {
    if (checkSaveCreateRequestExportWarehouse === 1) return false;
    if (!checkValidateSave($('#modal-create-request-export-warehouse'))) return false;
    let TableData = [];
    await tableMaterialRequestOutInventory.rows().every(function () {
        let row = $(this.node());
        if (removeformatNumber(row.find('td:eq(4)').find('input').val()) > 0) {
            TableData.push({
                "material_id": row.find('td:eq(5)').find('button').data('id'),
                "user_input_quantity": removeformatNumber(row.find('td:eq(4)').find('input').val()),
                "user_input_unit_type": 1,
                "note": '',
                "sort": 1
            });
        }
    })
    if (TableData.length === 0) {
        WarningNotify('Vui lòng chọn phiếu yêu cầu từ kho chi nhánh!');
        return false;
    }
    let note = $('#note-create-request-export-warehouse').val(),
        is_complete_export = Number($('#check-create-request-export-warehouse').is(':checked')),
        branch = $('.select-branch').val(),
        delivery_date = $('#date-create-request-export-warehouse').val(),
        export_type = $('#select-list-request-export-warehouse option:selected').data('id'),
        request_id = $('#select-list-request-export-warehouse option:selected').val(),
        inventory = $('#select-list-request-export-warehouse option:selected').data('inventory');
    checkSaveCreateRequestExportWarehouse = 1;
    let method = 'post',
        url = 'export-inventory-warehouse.create',
        params = null,
        data = {
            material: TableData,
            note: note,
            delivery_date: delivery_date,
            branch: branch,
            inventory: inventory,
            export_type: export_type,
            request_id: request_id,
            is_complete_export: is_complete_export,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-create-request-export-warehouse')]);
    checkSaveCreateRequestExportWarehouse = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalCreateRequestExportWarehouse();
            loadingDataExportInventory();
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            ErrorNotify(text);
            break
        default :
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
    }
}

function resetDataCreateRequestExportWarehouse() {
    $('#check-create-request-export-warehouse').prop('checked', false);
    tableCreateRequestExportWarehouse.clear().draw(false);
    $('#select-list-request-export-warehouse').val(null).trigger('change.select2');
    $('#date-create-request-export-warehouse').val(moment().format('DD/MM/YYYY'));
    $('#inventory-create-request-export-warehouse').text('---');
    $('#inventory-target-create-request-export-warehouse').text('---');
    $('#note-create-request-export-warehouse').val('');
}
function closeModalCreateRequestExportWarehouse () {
    $('#modal-create-request-export-warehouse').modal('hide');
    resetDataCreateRequestExportWarehouse();
    countCharacterTextarea()
}
