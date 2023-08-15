function openModalDepositDetailWorkHistory() {
    $('#modal-deposit-detail-work-history').modal('show');
    shortcut.remove("ESC");
    shortcut.add('ESC', function () {
        closeModalDepositDetailWorkHistory();
    });
    dataDepositDetailWorkHistory();
}

async function dataDepositDetailWorkHistory() {
    let method = 'get',
        url = 'work-history-treasurer.deposit-detail',
        params = {id: idDetailWorkHistoryTreasurer, type: 1},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-deposit-detail-work-history-treasurer')
    ]);
    dataTableDepositDetailWorkHistory(res);
    dataTotalDepositDetailWorkHistory(res.data[3]);
}

function dataTableDepositDetailWorkHistory(data) {
    let id1 = $('#table-cash-deposit-detail-work-history-treasurer'),
        id2 = $('#table-bank-deposit-detail-work-history-treasurer'),
        id3 = $('#table-transfer-deposit-detail-work-history-treasurer'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'booking_id', name: 'booking_id', className: 'text-left'},
            {data: 'customer_name', name: 'customer_name', className: 'text-left'},
            {data: 'amount', name: 'amount', className: 'text-right'},
            {data: 'time', name: 'time', className: 'text-center'},
        ],
        option = [],
        scroll_Y = '40vh',
        fixedLeft = 2,
        fixedRight = 1;
    DatatableTemplateNew(id1, data.data[0].original.data, column, scroll_Y, fixedLeft, fixedRight,option);
    DatatableTemplateNew(id2, data.data[1].original.data, column, scroll_Y, fixedLeft, fixedRight,option);
    DatatableTemplateNew(id3, data.data[2].original.data, column, scroll_Y, fixedLeft, fixedRight,option);
}

function dataTotalDepositDetailWorkHistory(data) {
    $('#total-record-cash-deposit-detail-work-history-treasurer').text(data.total_record_cash);
    $('#gettotal-record-bank-revenue-detail-work-history-treasurer').text(data.total_record_bank);
    $('#total-record-transfer-deposit-detail-work-history-treasurer').text(data.total_record_transfer);
    $('#total-cash-deposit-detail-work-history-treasurer').text(data.total_cash);
    $('#total-bank-deposit-detail-work-history-treasurer').text(data.total_bank);
    $('#total-transfer-deposit-detail-work-history-treasurer').text(data.total_transfer);
}

function closeModalDepositDetailWorkHistory() {
    $('#modal-deposit-detail-work-history').modal('hide');
}
