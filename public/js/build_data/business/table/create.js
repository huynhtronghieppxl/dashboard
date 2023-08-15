let checkSaveCreateTableData;

async function openModalCreateTableBuildData() {
    checkSaveCreateTableData = 0;
    $('#modal-create-table-build-data').modal('show');
    await $('#select-branch-table').val($('.select-branch').val()).trigger('change');
    $('#select-area-create-table-build-data').val($('#select-area-table-build-data').val()).trigger('change.select2');
    $('#select-branch-table, #select-area-create-table-build-data').select2({
        dropdownParent: $('#modal-create-table-build-data'),
    });
    $('#modal-create-table-build-data input').on('click', function () {
        $(this).select();
    });
    shortcut.add('F4', function () {
        saveModalCreateTableBuildData();
    });
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalCreateTableBuildData();
    });

    $('#modal-create-table-build-data input').on('input', function (){
        $('#modal-create-table-build-data .btn-renew').removeClass('d-none')
    })
}

async function saveModalCreateTableBuildData() {
    if (checkSaveCreateTableData === 1) return false;
    if (!checkValidateSave($('#modal-create-table-build-data'))) return false;
    checkSaveCreateTableData = 1;
    let area_id = $('.select-area-table-build-data').val(),
        name = $('#name-create-table-build-data').val(),
        slot = removeformatNumber($('#number-create-table-build-data').val()),
        branch_id = $('.select-branch').val();
    let method = 'post',
        url = 'table-data.create',
        params = null,
        data = {
            table_name: name,
            area_id: area_id,
            total_slot: slot,
            branch_id: branch_id,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-table-build-data')]);
    checkSaveCreateTableData = 0;
    let text = '';
    switch (res.data.status ) {
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            shortcut.remove('F4');
            shortcut.remove('ESC');
            shortcut.add('F2', function (){
                openModalCreateTableBuildData()
            })
            closeModalCreateTableBuildData();
            addRowDatatableTemplate(drawDataTableEnableTableData, {
                'name': res.data.data.name,
                'slot_number': res.data.data.slot_number,
                'action': res.data.data.action,
                'keysearch': res.data.data.keysearch,
            });
            $('#total-record-enable').text(Number(formatNumber($('#total-record-enable').text())) + 1);
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

function closeModalCreateTableBuildData() {
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function (){
        openModalCreateTableBuildData()
    })
    $('#modal-create-table-build-data').modal('hide');
    reloadModalCreateTableBuildData();
}

function reloadModalCreateTableBuildData() {
    removeAllValidate();
    $('#modal-create-table-build-data input').val('');
    $('#name-create-table-build-data').val('')
    $('#number-create-table-build-data').val(1)
    $('#modal-create-table-build-data .btn-renew').addClass('d-none')
}
