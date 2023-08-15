function openModalDetailCostCurrent() {
    $('#modal-detail-cost-current-branch-report').modal('show');
    time = $('#select-type-revenue-cost-profit-report :selected').data('time');
    $('#title-detail-cost-current-branch-report').text('Chi tiết chi phí thực tế ' + time);

    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalDetailCostCurrent();
    });
}

function dataDetailCostCurrent(data) {
    $('#total-detail-cost-current').text(data.present_cost);
    $('#total-payment-cost-current').html(data.present_addition_fee_amount + '<span class="f-right">' + data.present_cost_rate + '% </span>');
    $('#rate-payment-cost-current').css('width', data.present_cost_rate +'%');
    $('#total-debt-cost-current').html(data.present_restaurant_debt_amount + '<span class="f-right">' + data.restaurant_debt_amount_rate + '%</span>');
    $('#rate-debt-cost-current').css('width', data.restaurant_debt_amount_rate+'%');
}

function closeModalDetailCostCurrent() {
    $('#modal-detail-cost-current-branch-report').modal('hide');
}
