function openModalDetailCost() {
    $('#modal-detail-cost-branch-report').modal('show');
    time = $('#select-type-revenue-cost-profit-report :selected').data('time');
    $('#title-detail-cost-branch-report').text('Chi tiết chi phí tổng ' + time);
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalDetailCost();
    });
}

function dataDetailCost(data) {
    let a = '5%';
    $('#total-detail-cost').text(data.total_cost);
    $('#total-order-cost').html(data.present_restaurant_debt_amount + '<span class="f-right">' + a + '</span>');
    $('#rate-order-cost').css('width', '50%');
    $('#total-salary-cost').html(data.present_salary_cost_amount + '<span class="f-right">' + a + '</span>');
    $('#rate-salary-cost').css('width', '50%');
    $('#total-current-salary-cost').html(data.present_amount_salary + '<span class="f-right">' + a + '</span>');
    $('#rate-current-salary-cost').css('width', '50%');
    $('#total-estimate-salary-cost').html(data.present_basic_salary_estimate + '<span class="f-right">' + a + '</span>');
    $('#rate-salary-cost').css('width', '50%');
    $('#total-payment-cost').html(data.present_addition_fee_amount_other + '<span class="f-right">' + a + '</span>');
    $('#rate-payment-cost').css('width', '50%');
    $('#total-debt-cost').html(data.present_debt_amount + '<span class="f-right">' + a + '</span>');
    $('#rate-debt-cost').css('width', '50%');
}

function closeModalDetailCost() {
    $('#modal-detail-cost-branch-report').modal('hide');
}
