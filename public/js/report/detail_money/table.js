async function dataTableDate(data) {
    let scroll_Y = '50vh';
    let fixedLeft = 2;
    let fixedRight = 1;
    let id = $('#table-tab1-report');
    let column = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width:'5%'},
        {data: 'code', name: 'code', className: 'text-center'},
        {data: 'date', name: 'date', className: 'text-center'},
        {data: 'employee.name', name: 'employee', className: 'text-center'},
        {data: 'object_name', name: 'object_name', className: 'text-center'},
        {data: 'reason_name', name: 'reason_name', className: 'text-center'},
        {data: 'payment_method', name: 'payment_method', className: 'text-center'},
        {data: 'amount', name: 'amount', className: 'text-center'},
        {data: 'action', name: 'action', className: 'text-center', width:'10%'},
    ],
        option = [];
    dataDateTable = await DatatableTemplateNew(id, data, column, scroll_Y, fixedLeft, fixedRight, option);
}

async function dataTablePeriodic(data) {
    let scroll_Y = '50vh';
    let fixedLeft = 2;
    let fixedRight = 1;
    let id = $('#table-tab2-report');
    let column = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width:'5%'},
        {data: 'code', name: 'code', className: 'text-center'},
        {data: 'date', name: 'date', className: 'text-center'},
        {data: 'employee.name', name: 'employee', className: 'text-center'},
        {data: 'object_name', name: 'object_name', className: 'text-center'},
        {data: 'reason_name', name: 'reason_name', className: 'text-center'},
        {data: 'payment_method', name: 'payment_method', className: 'text-center'},
        {data: 'amount', name: 'amount', className: 'text-center'},
        {data: 'action', name: 'action', className: 'text-center', width:'10%'},
    ],
        option = [];
    dataPeriodicTable = await DatatableTemplateNew(id, data, column, scroll_Y, fixedLeft, fixedRight, option);
}
