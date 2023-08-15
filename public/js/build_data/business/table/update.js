let idUpdateTableBuildData, statusUpdateTableBuildData, thisUpdateTableData, checkSaveUpdateTableData;

function openModalUpdateTableBuildData(r) {
    checkSaveUpdateTableData = 0;
    thisUpdateTableData = r;
    $('#modal-update-table-build-data').modal('show');
    addLoading('table-data.update');
    idUpdateTableBuildData = r.data('id');
    statusUpdateTableBuildData = r.data('status');
    $('#select-area-update-table-build-data').val(r.data('area-id')).trigger('change.select2');
    $('#name-update-table-build-data').val(r.data('name'));
    $('#number-update-table-build-data').val(formatNumber(r.data('number')));
    $('#select-area-update-table-build-data').select2({
        dropdownParent: $('#modal-update-table-build-data'),
    });
    $('#modal-update-table-build-data input').on('click', function () {
        $(this).select();
    });
    shortcut.remove('F2');
    shortcut.add('F4', function () {
        saveModalUpdateTableBuildData();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateTableBuildData();
    });
}

async function saveModalUpdateTableBuildData() {
    if (checkSaveUpdateTableData === 1) return false;
    if (!checkValidateSave($('#modal-update-table-build-data'))) return false;
    checkSaveUpdateTableData = 1;
    let area_id = $('#select-area-update-table-build-data').val(),
        name = $('#name-update-table-build-data').val(),
        number = removeformatNumber($('#number-update-table-build-data').val());
    let method = 'post',
        url = 'table-data.update',
        params = null,
        data = {
            id: idUpdateTableBuildData,
            name: name,
            area_id: area_id,
            number: number,
            status: statusUpdateTableBuildData,
            branch_id: $('.select-branch').val(),
        };
    let res = await axiosTemplate(method, url, params, data, [$("#loading-modal-update-table-build-data")]);

    checkSaveUpdateTableData = 0;
    let text = '';
    switch (res.data.status ) {
        case 200:
            text = $('#success-update-data-to-server').text();
            SuccessNotify(text);
            if (area_id === $('.select-area-table-build-data').val()) {
                drawDataUpdateTableData(res.data.data);
            } else {
                let countItem = -1;
                formatNumber(drawDataTableEnableTableData.rows().every(function (){
                    countItem++;
                }))
                $('#total-record-enable').text(countItem);
                removeRowDatatableTemplate(drawDataTableEnableTableData, thisUpdateTableData, true);
            }
            shortcut.remove('F4');
            shortcut.remove('ESC');
            shortcut.add('F2', function (){
                openModalCreateTableBuildData()
            })
            closeModalUpdateTableBuildData();
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            ErrorNotify(text);
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
    }
}

function drawDataUpdateTableData(data) {
    thisUpdateTableData.parents('tr').find('td:eq(1)').text(data.name);
    thisUpdateTableData.parents('tr').find('td:eq(2)').text(data.slot_number);
    thisUpdateTableData.parents('tr').find('td:eq(3)').html(data.action);
}

function closeModalUpdateTableBuildData() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function (){
        openModalCreateTableBuildData()
    })
    removeAllValidate();
    $('#modal-update-table-build-data input').val('');
    $('#modal-update-table-build-data').modal('hide');
}
