function openModalDetailAdvanceSalaryEmployee(r){
    $('#modal-detail-advance-salary-employee').modal('show');
    dataDetailAdvanceSalaryEmployee(r)
    shortcut.remove("ESC");
    shortcut.add('ESC', function () {
        closeModalDetailAdvanceSalaryEmployee();
    });
}

async function dataDetailAdvanceSalaryEmployee(r){
    let method = 'get',
        url = 'advance-salary-employee.detail',
        params = {
            id: r.data('id'),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-detail-surcharge-data')]);
    console.log('123', res)
    switch (res.data.data.status){
        case 4:
            $('#cancel-detail-advance-salary-employee-div').addClass('d-none')
            $('#cancel_reason-detail-advance-salary-employee-div').addClass('d-none')
            $('#approved-detail-advance-salary-employee-div').addClass('d-none')
            $('#paid-detail-advance-salary-employee-div').removeClass('d-none')
            break;
        case 3:
            $('#cancel-detail-advance-salary-employee-div').removeClass('d-none')
            $('#cancel_reason-detail-advance-salary-employee-div').removeClass('d-none')
            $('#approved-detail-advance-salary-employee-div').addClass('d-none')
            $('#paid-detail-advance-salary-employee-div').addClass('d-none')
            break;
        default:
            $('#cancel-detail-advance-salary-employee-div').addClass('d-none')
            $('#cancel_reason-detail-advance-salary-employee-div').addClass('d-none')
            $('#approved-detail-advance-salary-employee-div').removeClass('d-none')
            $('#paid-detail-advance-salary-employee-div').addClass('d-none')
    }
    $('#status-detail-advance-salary-employee').html(res.data.data.status_name)
    $('#employee-detail-advance-salary-employee').text(res.data.data.employee.name)
    $('#avatar-employee-detail-advance-salary-employee').text(res.data.data.employee.avatar)
    $('#employee-approved-detail-advance-salary-employee').text(res.data.data.employee_approved.name)
    $('#avatar-employee-approved-detail-advance-salary-employee').text(res.data.data.employee_approved.avatar)
    $('#employee-paid-detail-advance-salary-employee').text(res.data.data.employee_paid.name)
    $('#avatar-employee-paid-detail-advance-salary-employee').text(res.data.data.employee_paid.avatar)
    $('#employee-cancel-detail-advance-salary-employee').text(res.data.data.employee_cancel.name)
    $('#avatar-employee-cancel-detail-advance-salary-employee').text(res.data.data.employee_cancel.avatar)
    $('#time-detail-advance-salary-employee').text(res.data.data.time)
    $('#amount-detail-advance-salary-employee').text(formatNumber(res.data.data.amount))
    $('#reason-detail-advance-salary-employee').text(res.data.data.reason)
    $('#cancel_reason-detail-advance-salary-employee').text(res.data.data.cancel_reason)
}

function closeModalDetailAdvanceSalaryEmployee() {
    $('#modal-detail-advance-salary-employee').modal('hide');
    resetModalDetailAdvanceSalaryEmployee()
}

function resetModalDetailAdvanceSalaryEmployee() {
    // $('#object-name-detail-payment-recurring-bill').text('---')
    // $('#fee-reason-name-detail-payment-recurring-bill').text('---')
    // $('#amount-at-detail-payment-recurring-bill').text('---')
    // $('#type-detail-payment-recurring-bill').text('---')
    // $('#start-from-detail-payment-recurring-bill').text('---')
    // $('#note-detail-payment-recurring-bill').text('---')
    // $('#revenue-detail-payment-recurring-bill').text('---')
}
