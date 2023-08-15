/**
 * table order report
 * @param data
 */
function tableOrderReport(data) {
    let scroll_Y = '40vh';
    let fixed_left = 0;
    let fixed_right = 0;
    let id = $('#table-order-report');
    let column = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
        {data: 'order', name: 'order', className: 'text-center'},
        {data: 'revenue', name: 'revenue', className: 'text-center'},
    ];
    DatatableTemplate(id, data, column, scroll_Y, fixed_left, fixed_right);
}

/**
 * table debt report
 * @param data
 */
function tableDebtReport(data) {
    let scroll_Y = '40vh';
    let fixed_left = 0;
    let fixed_right = 0;
    let id = $('#table-debt-report');
    let column = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'restaurant_supplier_name', name: 'restaurant_supplier_name', className: 'text-center'},
        {data: 'number_session', name: 'number_session', className: 'text-center'},
        {data: 'total_amount', name: 'total_amount', className: 'text-center'},
        {data: 'number_return_session', name: 'number_return_session', className: 'text-center'},
        {data: 'total_return_amount', name: 'total_return_amount', className: 'text-center'},
        {data: 'paid_count', name: 'paid_count', className: 'text-center'},
        {data: 'paid_amount', name: 'paid_amount', className: 'text-center'},
        {data: 'waiting_payment_count', name: 'waiting_payment_count', className: 'text-center'},
        {data: 'waiting_payment_amount', name: 'waiting_payment_amount', className: 'text-center'},
        {data: 'debt_count', name: 'debt_count', className: 'text-center'},
        {data: 'debt_amount', name: 'debt_amount', className: 'text-center'},
    ];
    DatatableTemplate(id, data, column, scroll_Y, fixed_left, fixed_right);
}