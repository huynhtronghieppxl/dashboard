function openModalDetailDebtRevenueCostProfit() {
    $('#modal-detail-debt-revenue-cost-profit-report').modal('show');
}

function dataDetailDebtRevenueCostProfit() {
    let id = $('#table-detail-debt-revenue-cost-profit-report'),
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'employee_name', name: 'employee_name', className: 'text-center'},
            {data: 'employee_name', name: 'employee_name', className: 'text-center'},
            {data: 'employee_name', name: 'employee_name', className: 'text-center'},
            {data: 'employee_name', name: 'employee_name', className: 'text-center'},
            {data: 'employee_name', name: 'employee_name', className: 'text-center'},
            {data: 'employee_name', name: 'employee_name', className: 'text-center'},
            {data: 'employee_name', name: 'employee_name', className: 'text-center'},
            {data: 'employee_name', name: 'employee_name', className: 'text-center'},
        ],
        scroll_Y = '60vh',
        fixed_left = 0,
        fixed_right = 0;
    DatatableTemplateNew(id, [], columns, scroll_Y, fixed_left, fixed_right);
}

function closeModalDetailDebtRevenueCostProfit() {
    $('#modal-detail-debt-revenue-cost-profit-report').modal('hide');
}
