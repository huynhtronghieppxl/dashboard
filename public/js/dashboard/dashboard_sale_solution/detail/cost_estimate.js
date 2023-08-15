function openModalDetailCostEstimate() {
    $('#modal-detail-cost-estimate-branch-report').modal('show');
    time = $('#select-type-revenue-cost-profit-report :selected').data('time');
    $('#title-detail-cost-estimate-branch-report').text('Chi tiết chi phí ước tính ' + time);
}

function dataDetailCostEstimate(data) {
    let a = '5%';
    $('#total-detail-cost-estimate').text(data.total_cost);
    $('#total-order-cost-estimate').html(data.total_cost_restaurant_debt_amount + '<span class="f-right">' + data.rate_cost_restaurant_debt_amount + '%' + '</span>');
    $('#rate-order-cost-estimate').css('width',  data.rate_cost_restaurant_debt_amount + '%');

    $('#total-salary-cost-estimate').html(data.total_salary_cost_amount + '<span class="f-right">' + data.rate_total_salary_cost_amount + '%' + '</span>');
    $('#rate-salary-cost-estimate').css('width', data.rate_total_salary_cost_amount + '%');

    $('#total-current-salary-cost-estimate').html((data.total_amount_salary) + '<span class="f-right">' + data.rate_total_amount_salary + '%' + '</span>');
    $('#rate-current-salary-cost-estimate').css('width', data.rate_total_amount_salary + '%');

    $('#total-estimate-salary-cost-estimate').html((data.total_basic_salary_estimate) + '<span class="f-right">' + data.rate_total_basic_salary_estimate + '%' + '</span>');
    $('#rate-estimate-salary-cost-estimate').css('width', data.rate_total_basic_salary_estimate + '%');

    // Chi phí các hạng mục chi khác
    $('#total-payment-cost-estimate').html(data.total_addition_fee_amount  + '<span class="f-right">' + data.rate_total_addition_amount + '%' + '</span>');
    $('#rate-payment-cost-estimate').css('width', data.rate_total_addition_amount + '%');
}

function closeModalDetailCostEstimate() {
    $('#modal-detail-cost-estimate-branch-report').modal('hide');
}
