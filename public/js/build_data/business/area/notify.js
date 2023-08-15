let dataConfirmPauseTableArea = [], checkSaveConfirmPauseTableArea = 0, rowTable = null;
function openModalNotifyAreaData (res, data, r, status) {
    $('#modal-notify-change-status-area').modal('show');
    $('#modal-notify-change-status-area #title-change-area').text(`${res.data.message}`);
    if(status === 205) {
        $('.btn-change-unit-material').addClass('d-none');
    }else {
        $('.btn-change-unit-material').removeClass('d-none');
    }
    rowTable = r;
    shortcut.remove('ESC');
    shortcut.add("ESC",closeModalNotifyAreaData);
    dataConfirmPauseTableArea = data;
    drawTableChangeStatusAreaData(res);
}

async function drawTableChangeStatusAreaData(res) {
    let tableChangeStatusAreaData = $('#table-change-status-area-data'),
        scroll_Y = '300px',
        fixed_left = 0,
        fixed_right = 0,
        columnArea = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '8%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'slot_number', name: 'slot_number', className: 'text-center'},
            {data: 'keysearch', className: 'd-none'},
        ];
    let dataTableArea = await DatatableTemplateNew(tableChangeStatusAreaData, res.data.data.original.data, columnArea, scroll_Y, fixed_left, fixed_right, []);
    $(document).on('input paste','#table-change-status-area-data_filter input', function (){
        let indexArea = 1;
        dataTableArea.rows({'search':'applied'}).every(function () {
            let row = $(this.node())
            row.find('td:eq(0)').text(indexArea)
            indexArea++;
        });
    })
}

async function saveConfirmPauseTableAreaData () {
    if(checkSaveConfirmPauseTableArea === 1) return false;
    checkSaveConfirmPauseTableArea = 1;
    let title = 'Bạn muốn tắt toàn bộ bàn của khu vực này',
        content = '',
        icon = 'question'
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if(result.value) {
            let method = 'post',
                url = 'area-data.status',
                params = {};
            let res = await axiosTemplate(method, url, params, dataConfirmPauseTableArea, [$('#modal-notify-change-status-area')]);
            checkSaveConfirmPauseTableArea = 0;
            switch (res.data.status) {
                case 200:
                    SuccessNotify($('#msg-success-status-area').text());
                    closeModalNotifyAreaData();
                    if (res.data.data.status === 1) {
                        addRowDatatableTemplate(tableEnableAreaData, {
                            'name': res.data.data.name,
                            'active_count': res.data.data.active_count,
                            'action': res.data.data.action,
                            'keysearch': res.data.data.keysearch,
                        });
                        removeRowDatatableTemplate(tableDisableAreaData, rowTable, true);
                        $('#total-record-enable').text(Number($('#total-record-enable').text()) + 1);
                        $('#total-record-disable').text(Number($('#total-record-disable').text()) - 1);
                    } else {
                        addRowDatatableTemplate(tableDisableAreaData, {
                            'name': res.data.data.name,
                            'active_count': res.data.data.active_count,
                            'action': res.data.data.action,
                            'keysearch': res.data.data.keysearch,
                        });
                        removeRowDatatableTemplate(tableEnableAreaData, rowTable, true);
                        $('#total-record-enable').text(Number($('#total-record-enable').text()) - 1);
                        $('#total-record-disable').text(Number($('#total-record-disable').text()) + 1);
                    }
                    break;
                case 500:
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    ErrorNotify($('#error-post-data-to-server').text());
                    break;
                default:
                    let text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    WarningNotify(text);
            }
        }else {
            checkSaveConfirmPauseTableArea = 0;
        }
    })
}
function closeModalNotifyAreaData(){
    checkSaveConfirmPauseTableArea = 0;
    dataConfirmPauseTableArea = [];
    $('#modal-notify-change-status-area').modal('hide');
    shortcut.remove("ESC");
}
