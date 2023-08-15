let idDetailWorkHistoryTreasurer,
    branchDetailWorkHistoryTreasurer,
    tableCashCheck;

function openModalDetailWorkHistory(id) {
    $('#modal-detail-work-history').modal('show');
    shortcut.remove("ESC");
    shortcut.add('ESC', function () {
        closeModalDetailWorkHistory();
    });
    $('#modal-revenue-detail-work-history').on('hidden.bs.modal', function () {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailWorkHistory();
        });
    });
    $('#modal-deposit-detail-work-history, #modal-return-deposit-detail-work-history, #modal-receipt-detail-work-history, #modal-payment-detail-work-history').on('hidden.bs.modal', function () {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailWorkHistory();
        });
    });
    idDetailWorkHistoryTreasurer = id;
    dataDetailWorkHistory(id);

}




async function dataDetailWorkHistory(id) {
    let method = 'get',
        url = 'work-history-treasurer.detail',
        branch = $('#select-branch-work-history-treasurer').val(),
        params = {id: id, branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#card-detail-deposit-treasuer'),
        $('#card-detail-work-treasuer'),
        $('#card-detail-receipts-addtionfee-treasuer'),
        $('#card-detail-payment-addtionfee-treasuer'),
        $('#card-detail-total-revenue-treasuer'),
        $('#card-detail-order-total-treasuer'),
        $('#table-value-detail-work-history-treasurer')]);
    branchDetailWorkHistoryTreasurer = res.data[0].branch_id;
    /**
     * Tiêu đề
     */
    $('.open-employee-detail-work-history-treasurer').text(res.data[0].open_employee_name);
    $('.open-time-detail-work-history-treasurer').text(res.data[0].open_time);
    $('.close-time-detail-work-history-treasurer').text(res.data[0].close_time);
    /**
     * Tiền cọc
     */
    $('.total-deposit-detail-work-history-treasurer').text(formatNumber(res.data[0].deposit_amount));
    $('#cash-deposit-detail-work-history-treasurer').text(formatNumber(res.data[0].deposit_cash_amount));
    $('#bank-deposit-detail-work-history-treasurer').text(formatNumber(res.data[0].deposit_bank_amount));
    $('#transfer-deposit-detail-work-history-treasurer').text(formatNumber(res.data[0].deposit_transfer_amount));
    $('.total-return-deposit-detail-work-history-treasurer').text(formatNumber(res.data[0].return_deposit_amount));
    $('.total-before-cash-detail-work-history-treasurer').text(formatNumber(res.data[0].before_cash));
    $('#cash-return-deposit-detail-work-history-treasurer').text(formatNumber(res.data[0].return_deposit_cash_amount));
    $('#transfer-return-deposit-detail-work-history-treasurer').text(formatNumber(res.data[0].return_deposit_transfer_amount));
    /**
     * Nạp thẻ
     */
    $('.total-recharge-detail-work-history-treasurer').text(formatNumber(res.data[0].total_top_up_card_amount));
    $('#cash-recharge-detail-work-history-treasurer').text(formatNumber(res.data[0].total_top_up_card_cash_amount));
    $('#bank-recharge-detail-work-history-treasurer').text(formatNumber(res.data[0].total_top_up_card_bank_amount));
    $('#transfer-recharge-detail-work-history-treasurer').text(formatNumber(res.data[0].total_top_up_card_transfer_amount));
    /**
     * Phiếu thu
     */
    $('#total-in-addtionfee-detail-work-history-treasurer').text(formatNumber(res.data[0].in_total_amount_by_addition_fee));
    $('#cash-in-addtionfee-detail-work-history-treasurer').text(formatNumber(res.data[0].in_cash_amount_by_addition_fee));
    $('#bank-in-addtionfee-detail-work-history-treasurer').text(formatNumber(res.data[0].in_bank_amount_by_addition_fee));
    $('#transfer-in-addtionfee-detail-work-history-treasurer').text(formatNumber(res.data[0].in_transfer_amount_by_addition_fee));
    /**
     * Phiếu chi
     */
    $('.total-out-addtionfee-detail-work-history-treasurer').text(formatNumber(res.data[0].out_total_amount_by_addition_fee));
    $('#cash-out-addtionfee-detail-work-history-treasurer').text(formatNumber(res.data[0].out_cash_amount_by_addition_fee));
    $('#transfer-out-addtionfee-detail-work-history-treasurer').text(formatNumber(res.data[0].out_transfer_amount_by_addition_fee));
    /**
     * Bán hàng
     */
    $('#total-revenue-detail-work-history-treasurer').text(formatNumber(res.data[0].total_amount));
    $('#total-current-revenue-detail-work-history-treasurer').text(formatNumber(res.data[0].total_amount));
    $('#cash-revenue-detail-work-history-treasurer').text(formatNumber(res.data[0].cash_amount));
    $('#bank-revenue-detail-work-history-treasurer').text(formatNumber(res.data[0].bank_amount));
    $('#transfer-revenue-detail-work-history-treasurer').text(formatNumber(res.data[0].transfer_amount));
    $('#debt-revenue-detail-work-history-treasurer').text(formatNumber(res.data[0].debt_amount));
    $('#total-debt-order').text(formatNumber(res.data[0].debt_amount));
    $('.tip-revenue-detail-work-history-treasurer').text(formatNumber(res.data[0].tip_amount));
    $('.cash-current-total-detail-work-history-treasurer').text(formatNumber(res.data[0].cash_amount - res.data[0].tip_amount));
    $('#total-cash-in').text(formatNumber(res.data[0].total_amount_final))
    $('#total-revenue-cash').text(formatNumber(res.data[0].cash_amount))
    $('#total-cash-out').text(formatNumber(res.data[0].total_cost_final))
    /**
     * Tổng hợp
     */
    $('#order-total-detail-work-history-treasurer').text(formatNumber(res.data[0].number_orders));
    $('#before-total-detail-work-history-treasurer').text(formatNumber(res.data[0].before_cash));
    $('#in-additionfee-total-detail-work-history-treasurer').text(formatNumber(res.data[0].in_cash_amount_by_addition_fee));
    $('#total-detail-work-history-treasurer').text(formatNumber(res.data[0].total_amount_final));
    $('#total-fund-detail-work-history-treasurer').text(formatNumber(res.data[0].after_cash));
    $('#cash-total-detail-work-history-treasurer').text(formatNumber(res.data[0].before_cash));
    $('.total-out-addtionfee-detail-work-history-treasurer').text(formatNumber(res.data[0].out_total_amount_by_addition_fee));
    $('#total-cost-detail-work-history-treasurer').text(formatNumber(res.data[0].out_cash_amount_by_addition_fee));
    $('#total-final-detail-work-history-treasurer').text(formatNumber(res.data[0].total_receipt_amount_final));
    $('#difference-total-detail-work-history-treasurer').text(formatNumber(res.data[0].difference_amount));
    $('#total-top-up-card-cash-amount').text(formatNumber(res.data[0].total_top_up_card_cash_amount));
    $('.point-recharge-detail-work-history-treasurer').text(formatNumber(res.data[0].total_top_up_used_amount));

    /**
     * Chi tiết kiểm đếm
     */
    dataTableDetailWorkHistory(res.data[1].original.data);
    $('.real-amount-detail-work-history-treasurer').text(formatNumber(res.data[0].real_amount));
}

async function dataTableDetailWorkHistory(data) {
    let id = $('#table-value-money-detail-work-history-treasurer'),
        column = [
            {data: 'value', name: 'value', className: 'text-center'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'amount', name: 'amount', className: 'text-center'},
            {data: 'keysearch', className: 'd-none'},
        ],
        scroll_Y = '65vh',
        fixedLeft = 0,
        fixedRight = 0,
        option = [];

    tableCashCheck = await DatatableTemplateNew(id, data, column, scroll_Y, fixedLeft, fixedRight, option);
    $(document).on('input paste', '#table-value-money-detail-work-history-treasurer_filter', function () {
        let totalTableCashCheck = searchTableCashCheck(tableCashCheck)
        $('#real-amount-detail-work-history-treasurer').text(formatNumber(totalTableCashCheck))
    })
    $('#table-value-money-detail-work-history-treasurer_filter, #table-value-money-detail-work-history-treasurer_length, #table-value-money-detail-work-history-treasurer_info, #table-value-money-detail-work-history-treasurer_paginate').addClass('d-none')
}

function searchTableCashCheck(datatable){
    let totalRealAmount = 0;
    datatable.rows({'search': 'applied'}).every(function () {
        let row = $(this.node());
        totalRealAmount += removeformatNumber(row.find('td:eq(2)').text());
    })
    return totalRealAmount
}

function closeModalDetailWorkHistory() {
    $('#modal-detail-work-history').modal('hide');
    resetModalDetailWorkHistory();
}

function resetModalDetailWorkHistory() {
    $('#cash-deposit-detail-work-history-treasurer').text('0');
    $('#bank-deposit-detail-work-history-treasurer').text('0');
    $('#transfer-deposit-detail-work-history-treasurer').text('0');
    $('#total-return-deposit-detail-work-history-treasurer').text('0');
    $('#cash-return-deposit-detail-work-history-treasurer').text('0');
    $('#transfer-return-deposit-detail-work-history-treasurer').text('0');
    $('#cash-recharge-detail-work-history-treasurer').text('0');
    $('#bank-recharge-detail-work-history-treasurer').text('0');
    $('#cash-deposit-detail-work-history-treasurer').text('0');
    $('#transfer-recharge-detail-work-history-treasurer').text('0');
    $('#total-in-addtionfee-detail-work-history-treasurer').text('0');
    $('#cash-in-addtionfee-detail-work-history-treasurer').text('0');
    $('#bank-in-addtionfee-detail-work-history-treasurer').text('0');
    $('#transfer-in-addtionfee-detail-work-history-treasurer').text('0');
    $('#cash-out-addtionfee-detail-work-history-treasurer').text('0');
    $('#transfer-out-addtionfee-detail-work-history-treasurer').text('0');
    $('#total-revenue-detail-work-history-treasurer').text('0');
    $('#cash-revenue-detail-work-history-treasurer').text('0');
    $('#bank-revenue-detail-work-history-treasurer').text('0');
    $('#transfer-revenue-detail-work-history-treasurer').text('0');
    $('#debt-revenue-detail-work-history-treasurer').text('0');
    $('#total-current-revenue-detail-work-history-treasurer').text('0');
    $('#order-total-detail-work-history-treasurer').text('0');
    $('#before-total-detail-work-history-treasurer').text('0');
    $('#in-additionfee-total-detail-work-history-treasurer').text('0');
    $('#total-detail-work-history-treasurer').text('0');
    $('#cash-total-detail-work-history-treasurer').text('0');
    $('#total-final-detail-work-history-treasurer').text('0');
    $('#difference-total-detail-work-history-treasurer').text('0');
    $('#real-amount-detail-work-history-treasurer').text('0');
    $('.total-before-cash-detail-work-history-treasurer').text('0');
}
