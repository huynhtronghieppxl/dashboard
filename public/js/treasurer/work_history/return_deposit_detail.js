function openModalReturnDepositDetailWorkHistory() {
    $('#modal-return-deposit-detail-work-history').modal('show');
    shortcut.remove("ESC");
    shortcut.add('ESC', function () {
        closeModalReturnDepositDetailWorkHistory();
    });
    dataReturnDepositDetailWorkHistory();
}

async function dataReturnDepositDetailWorkHistory() {
    let method = 'get',
        url = 'work-history-treasurer.deposit-detail',
        params = {id: idDetailWorkHistoryTreasurer, type: 2},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-return-deposit-detail-work-history-treasurer')
    ]);
    dataTableReturnDepositDetailWorkHistory(res);
    dataTotalReturnDepositDetailWorkHistory(res.data[2]);
}

async function dataTableReturnDepositDetailWorkHistory(data) {
    let id1 = $('#table-cash-return-deposit-detail-work-history-treasurer'),
        id2 = $('#table-transfer-return-deposit-detail-work-history-treasurer'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'customer_name', name: 'customer_name', className: 'text-left'},
            {data: 'amount', name: 'amount', className: 'text-right'},
            {data: 'time', name: 'time', className: 'text-center'},
        ],
        scroll_Y = '40vh',
        fixedLeft = 2,
        fixedRight = 1,
        option = [];
    let tableCashPaymentTreasurer = await DatatableTemplateNew(id1, data.data[0].original.data, column, scroll_Y, fixedLeft, fixedRight, option);
    let bonusTransferPaymentTreasurer = await DatatableTemplateNew(id2, data.data[1].original.data, column, scroll_Y, fixedLeft, fixedRight, option);
    $(document).on('input paste keyup', '#loading-modal-return-deposit-detail-work-history-treasurer input[type="search"]', async function () {
        $('#total-record-cash-return-deposit-detail-work-history-treasurer').text(tableCashPaymentTreasurer.rows({'search': 'applied'}).count());
        $('#total-record-transfer-return-deposit-detail-work-history-treasurer').text(bonusTransferPaymentTreasurer.rows({'search': 'applied'}).count());
        let tableCashPayment = await searchTableDetailReturn(tableCashPaymentTreasurer),
            tableTransfer = await searchTableDetailReturn(bonusTransferPaymentTreasurer);
        $('#total-cash-return-deposit-detail-work-history-treasurer').text(formatNumber(tableCashPayment))
        $('#total-transfer-return-deposit-detail-work-history-treasurer').text(formatNumber(tableTransfer))
    })
}

function searchTableDetailReturn(datatable){
    let totalAmount = 0;
    datatable.rows({'search': 'applied'}).every(function () {
        let row = $(this.node());
        totalAmount += removeformatNumber(row.find('td:eq(2)').text());
    })
    return totalAmount;
}

function dataTotalReturnDepositDetailWorkHistory(data) {
    $('#total-record-cash-return-deposit-detail-work-history-treasurer').text(data.total_record_cash);
    $('#total-record-transfer-return-deposit-detail-work-history-treasurer').text(data.total_record_transfer);
    $('#total-cash-return-deposit-detail-work-history-treasurer').text(data.total_cash);
    $('#total-transfer-return-deposit-detail-work-history-treasurer').text(data.total_transfer);
}

function closeModalReturnDepositDetailWorkHistory() {
    $('#modal-return-deposit-detail-work-history').modal('hide');
}
