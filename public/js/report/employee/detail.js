let idDetailEmployeeReport, brandDetailEmployeeReport, branchDetailEmployeeReport,
    typeDetailEmployeeReport, timeDetailEmployeeReport;

function openModalDetailEmployeeReport(r) {
    $('#modal-detail-employee-report').modal('show');
    addLoading('employee-report.detail', '#loading-modal-detail-employee-report');
    shortcut.add('ESC', function () {
        closeModalDetailEmployeeReport();
    });
    idDetailEmployeeReport = r.data('id');
    brandDetailEmployeeReport = r.data('brand');
    branchDetailEmployeeReport = r.data('branch');
    typeDetailEmployeeReport = r.data('type');
    timeDetailEmployeeReport = r.data('time');
    fromDateEmployeeReport = r.data('from');
    toDateEmployeeReport = r.data('to');
    $('#name-detail-employee-report').text(r.data('name'));
    $('#role-detail-employee-report').text(r.data('role'));
    getTimeBasedOnTypeReport($('#time-detail-employee-report'), r.data('type'))
    dataDetailEmployeeReport();
}

async function dataDetailEmployeeReport() {
    let element = $('#table-detail-employee-report'),
        url = "employee-report.detail?id=" + idDetailEmployeeReport + "&brand=" + brandDetailEmployeeReport + "&branch=" + branchDetailEmployeeReport + "&type=" + typeDetailEmployeeReport + "&time=" + timeDetailEmployeeReport + "&limit=" + 100 + "&from_date=" + fromDateEmployeeReport + "&to_date=" + toDateEmployeeReport,
        column = [
            {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'id', name: 'id', className: 'text-center'},
            {data: 'table_name', name: 'table_name', className: 'text-center'},
            {data: 'amount', name: 'amount', className: 'text-center'},
            {data: 'vat_amount', name: 'vat_amount', className: 'text-center'},
            {data: 'discount_amount', name: 'discount_amount', className: 'text-center'},
            {data: 'point', name: 'point', className: 'text-center'},
            {data: 'total_amount', name: 'total_amount', className: 'text-center'},
            {data: 'payment_date', name: 'payment_date', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ],
        fixedLeftTable = 2,
        fixedRightTable = 2
        optionRenderTable = []
    DatatableServerSideTemplateNew(element, url, column, '40vh', fixedLeftTable, fixedRightTable, optionRenderTable, callbackDetailEmployeeReportViewData);
}

function callbackDetailEmployeeReportViewData(response) {
    $('#amount-detail-employee-report').text(response.total_original);
    $('#vat-detail-employee-report').text(response.total_vat);
    $('#discount-detail-employee-report').text(response.total_discount);
    $('#point-detail-employee-report').text(response.total_point);
    $('#total-amount-detail-employee-report').text(response.total_amount);
}

function closeModalDetailEmployeeReport() {
    $('#modal-detail-employee-report').modal('hide');
    $('#table-detail-employee-report').DataTable().destroy();
    resetModalDetailEmployeeReport();
}

function resetModalDetailEmployeeReport() {
    $('#time-detail-employee-report').text('---');
    $('#name-detail-employee-report').text('---');
    $('#role-detail-employee-report').text('---');
    $('#amount-detail-employee-report').text('0');
    $('#vat-detail-employee-report').text('0');
    $('#discount-detail-employee-report').text('0');
    $('#point-detail-employee-report').text('0');
    $('#total-amount-detail-employee-report').text('0');
}
