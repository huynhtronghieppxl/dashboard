let tableCashReceipt, tableBankReceipt, tableTransferReceipt;

$(function (){
    $(document).on('input paste','#loading-modal-receipt-detail-work-history-treasurer input[type="search"]', function () {
        $('#total-record-cash-receipt-detail-work-history-treasurer').text(tableCashReceipt.rows({'search':'applied'}).count())
        $('#total-record-bank-receipt-detail-work-history-treasurer').text(tableBankReceipt.rows({'search':'applied'}).count())
        $('#total-record-transfer-receipt-detail-work-history-treasurer').text(tableTransferReceipt.rows({'search':'applied'}).count())

        let totalTableCashReceipt = searchTableDetailReceipt(tableCashReceipt),
            totalTableBankReceipt = searchTableDetailReceipt(tableBankReceipt),
            totalTableTransferReceipt = searchTableDetailReceipt(tableTransferReceipt)

        $('#total-cash-receipt-detail-work-history-treasurer').text(formatNumber(totalTableCashReceipt))
        $('#total-bank-receipt-detail-work-history-treasurer').text(formatNumber(totalTableBankReceipt))
        $('#total-transfer-receipt-detail-work-history-treasurer').text(formatNumber(totalTableTransferReceipt))

    })
})

function openModalReceiptDetailWorkHistory() {
    $('#modal-receipt-detail-work-history').modal('show');
    shortcut.remove("ESC");
    shortcut.add('ESC', function () {
        closeModalReceiptDetailWorkHistory();
    });
    dataReceiptDetailWorkHistory();
}

async function dataReceiptDetailWorkHistory() {
    let method = 'get',
        url = 'work-history-treasurer.receipt-detail',
        params = {id: idDetailWorkHistoryTreasurer, branch: branchDetailWorkHistoryTreasurer},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-receipt-detail-work-history-treasurer')
    ]);
    dataTableReceiptDetailWorkHistory(res);
    dataTotalReceiptDetailWorkHistory(res.data[3]);
}

async function dataTableReceiptDetailWorkHistory(data) {
    let idTableCashReceipt = $('#table-cash-receipt-detail-work-history-treasurer'),
        idTableBankReceipt = $('#table-bank-receipt-detail-work-history-treasurer'),
        idTableTransferReceipt = $('#table-transfer-receipt-detail-work-history-treasurer'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-left'},
            {data: 'employee.name', name: 'employee', className: 'text-left'},
            {data: 'object_name', name: 'object_name', className: 'text-left'},
            {data: 'addition_fee_reason_name', name: 'addition_fee_reason_name', className: 'text-left'},
            {data: 'amount', name: 'amount', className: 'text-right'},
            {data: 'fee_month', name: 'fee_month', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ],
        scroll_Y = '40vh',
        fixedLeft = 2,
        fixedRight = 1,
        option = [];
    tableCashReceipt = await DatatableTemplateNew(idTableCashReceipt, data.data[0].original.data, column, scroll_Y, fixedLeft, fixedRight, option);
    tableBankReceipt = await DatatableTemplateNew(idTableBankReceipt, data.data[1].original.data, column, scroll_Y, fixedLeft, fixedRight, option);
    tableTransferReceipt = await DatatableTemplateNew(idTableTransferReceipt, data.data[2].original.data, column, scroll_Y, fixedLeft, fixedRight, option);
}

function searchTableDetailReceipt(datatable){
    let totalAmount = 0;
    datatable.rows({'search': 'applied'}).every(function () {
        let row = $(this.node());
        totalAmount += removeformatNumber(row.find('td:eq(5)').text());
    })
    return totalAmount
}

function dataTotalReceiptDetailWorkHistory(data) {
    $('#total-record-cash-receipt-detail-work-history-treasurer').text(data.total_record_cash);
    $('#total-record-bank-receipt-detail-work-history-treasurer').text(data.total_record_bank);
    $('#total-record-transfer-receipt-detail-work-history-treasurer').text(data.total_record_transfer);
    $('#total-cash-receipt-detail-work-history-treasurer').text(data.total_amount_cash);
    $('#total-bank-receipt-detail-work-history-treasurer').text(data.total_amount_bank);
    $('#total-transfer-receipt-detail-work-history-treasurer').text(data.total_amount_transfer);
}

function closeModalReceiptDetailWorkHistory() {
    $('#modal-receipt-detail-work-history').modal('hide');
}
