let tableCashPayment, tableTransferPayment, totalAmountWorkHistory;

$(function (){
    $(document).on('input paste','#loading-modal-payment-detail-work-history-treasurer input[type="search"]', function () {
        $('#total-record-cash-payment-detail-work-history-treasurer').text(tableCashPayment.rows({'search':'applied'}).count())
        $('#total-record-transfer-payment-detail-work-history-treasurer').text(tableTransferPayment.rows({'search':'applied'}).count())

        let totalTableCashPayment = searchTableDetailPayment(tableCashPayment),
            totalTableTransferPayment = searchTableDetailPayment(tableTransferPayment)

        $('#total-cash-payment-detail-work-history-treasurer').text(formatNumber(totalTableCashPayment))
        $('#total-transfer-payment-detail-work-history-treasurer').text(formatNumber(totalTableTransferPayment))

    })
})

function openModalPaymentDetailWorkHistory() {
    $('#modal-payment-detail-work-history').modal('show');
    shortcut.remove("ESC");
    shortcut.add('ESC', function () {
        closeModalPaymentDetailWorkHistory();
    });
    loadData1PaymentDetailWorkHistory();
}

async function loadData1PaymentDetailWorkHistory() {
    let method = 'get',
        url = 'work-history-treasurer.payment-detail',
        params = {
            id: idDetailWorkHistoryTreasurer,
            branch: branchDetailWorkHistoryTreasurer,
            restaurant_brands_id : $('#restaurant-branch-id-selected span').attr('data-value')
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-payment-detail-work-history-treasurer')
    ]);
    dataTablePaymentDetailWorkHistory(res);
    dataTotalPaymentDetailWorkHistory(res.data[2]);
}

async function dataTablePaymentDetailWorkHistory(data) {
    let id1 = $('#table-cash-payment-detail-work-history-treasurer'),
        id2 = $('#table-transfer-payment-detail-work-history-treasurer'),
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
    tableCashPayment = await DatatableTemplateNew(id1, data.data[0].original.data, column, scroll_Y, fixedLeft, fixedRight, option);
    tableTransferPayment = await DatatableTemplateNew(id2, data.data[1].original.data, column, scroll_Y, fixedLeft, fixedRight, option);
}

function searchTableDetailPayment(datatable){
    let totalAmount = 0;
    datatable.rows({'search': 'applied'}).every(function () {
        let row = $(this.node());
        totalAmount += removeformatNumber(row.find('td:eq(5)').text());
    })
    return totalAmount
}

function dataTotalPaymentDetailWorkHistory(data) {
    $('#total-record-cash-payment-detail-work-history-treasurer').text(data.total_record_cash);
    $('#total-record-transfer-payment-detail-work-history-treasurer').text(data.total_record_transfer);
    $('#total-transfer-payment-detail-work-history-treasurer').text(data.total_amount_transfer);
    $('#total-cash-payment-detail-work-history-treasurer').text(formatNumber(data.total_amount));

}

function closeModalPaymentDetailWorkHistory() {
    $('#modal-payment-detail-work-history').modal('hide');
}
