/**
 * Event
 */
$('#select-type-debt-report').on('change', function () {
    switch (Number($('#select-type-debt-report').val())){
        case 13:
            $('#select-time-debt-month-report').addClass('d-none');
            $('#select-time-debt-day-report').removeClass('d-none');
            $('#select-time-debt-year-report').addClass('d-none');
            break;
        case 15:
            $('#select-time-debt-month-report').removeClass('d-none');
            $('#select-time-debt-day-report').addClass('d-none');
            $('#select-time-debt-year-report').addClass('d-none');
            break;
        case 16:
            $('#select-time-debt-month-report').addClass('d-none');
            $('#select-time-debt-day-report').addClass('d-none');
            $('#select-time-debt-year-report').removeClass('d-none');
            break;
        default:
            $('#select-time-debt-month-report').addClass('d-none');
            $('#select-time-debt-day-report').addClass('d-none');
            $('#select-time-debt-year-report').addClass('d-none');
    }
    if ($('#select-type-revenue-cost-profit-report').find('option:selected').val() == 13){
    }else {
        $('#select-time-revenue-cost-profit-report').addClass('d-none');
    }
    loadDataDebtReport = 0;
    loadSupplierDebtData();
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-debt-report'), $('#select-type-debt-report'))

});
getTimeChangeSelectTypeDashboardReport($('#text-label-type-debt-report'), $('#select-type-debt-report'))

/**
 * Call data
 * @returns {Promise<void>}
 */
// function dataDebtReport() {
//     tableSupplierDebtReport([]);
//     $('.loading-det-report-loading').remove();
//     if (loadDataDebtReport === 1) return false;
//     loadDataDebtReport = 1;
//     $('.loading-det-report').prepend(themeLoading($('#loading-det-report').height(), 'loading-det-report-loading'))
//     let brand = $('#restaurant-branch-id-selected span').attr('data-value'),
//         branch = $('#change_branch').val(),
//         type = $('#select-type-debt-report').val(),
//         time = $('#select-type-debt-report').find(':selected').data('time');
//     axios({
//         method: 'get',
//         url: 'branch-dashboard.data-debt-report',
//         params: {brand: brand, branch: branch, type: type, time: time}
//     }).then(function (res) {
//         console.log(res);
//         $('#total-amount-debt-report').text(res.data[0].debt_amount);
//         $('#total-quantity-debt-report').text(res.data[0].debt_count);
//         $('#total-amount-order-debt-report').text(res.data[0].total_amount);
//         $('#total-quantity-order-debt-report').text(res.data[0].number_session);
//         $('#total-amount-paid-debt-report').text(res.data[0].paid_amount);
//         $('#total-quantity-paid-debt-report').text(res.data[0].paid_count);
//         $('#total-amount-return-debt-report').text(res.data[0].total_return_amount);
//         $('#total-quantity-return-debt-report').text(res.data[0].number_return_session);
//         $('#total-amount-waiting-debt-report').text(res.data[0].waiting_payment_amount);
//         $('#total-quantity-waiting-debt-report').text(res.data[0].waiting_payment_count);
//         $('.loading-det-report-loading').remove();
//     }).catch(function (e) {
//         console.log(e);
//     });
// }

async function loadSupplierDebtData() {
    if(loadDataDebtReport) return false;
    loadDataDebtReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        type = $('#select-type-debt-report').val(),
        time = $('#select-type-debt-report').find(':selected').data('time');
    let url = 'branch-dashboard.data-supplier-debt-report',
        method = 'get',
        params = {brand: brand,
                    branch: branch,
                    type: type,
                    time: time,
                },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-supplier-debt-dashboard-report')]);
    tableSupplierDebtReport(res.data[0].original.data);
}

function tableSupplierDebtReport(data) {
    let scroll_Y = vh_of_table;
    let fixed_left = 0;
    let fixed_right = 0;
    let id = $('#table-supplier-debt-dashboard-report');
    let column = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'supplier_code', name: 'supplier_code', className: 'text-center'},
        {data: 'supplier_name', name: 'supplier_name', className: 'text-center'},
        {data: 'debt_amount', name: 'debt_amount', className: 'text-center'},
        {data: 'watting_payment', name: 'watting_payment', className: 'text-center'},
        {data: 'paid_amount', name: 'paid_amount', className: 'text-center'},
        {data: 'owed_amount', name: 'owed_amount', className: 'text-center'},
        {data: 'action', name: 'action', className: 'text-center'},
        {data: 'keysearch', name: 'keysearch', className: 'd-none'},
    ];
    DatatableTemplateNew(id, data, column, scroll_Y, fixed_left, fixed_right, []);
}

/**
 * Reload Data
 */
function reloadDebtReport() {
    loadDataDebtReport = 0;
    loadSupplierDebtData();
}
