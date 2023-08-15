let idDetailAreaReport, brandDetailAreaReport, branchDetailAreaReport,
    typeDetailAreaReport, timeDetailAreaReport;

function openModalDetailAreaReport(r) {
    idDetailAreaReport = r.data('id');
    brandDetailAreaReport = r.data('brand');
    branchDetailAreaReport = r.data('branch');
    typeDetailAreaReport = r.data('type');
    timeDetailAreaReport = r.data('time');
    $('#name-detail-area-report').text(r.data('name'));
    $('#modal-detail-area-report').modal('show');
    addLoading('area-report.detail', '#loading-modal-detail-area-report');
    getTimeBasedOnTypeReport($('#time-detail-area-report'), r.data('type'));
    shortcut.add('ESC', function () {
        closeModalDetailAreaReport();
    });
    dataDetailAreaReport();
}

async function dataDetailAreaReport() {
    let element = $('#table-detail-area-report'),
        url = "area-report.detail?id=" + idDetailAreaReport + "&brand=" + brandDetailAreaReport + "&branch=" + branchDetailAreaReport + "&type=" + typeDetailAreaReport + "&time=" + timeDetailAreaReport + "&limit=" + 100 + "&from_date=" + fromDateAreaReport + "&to_date=" + toDateAreaReport,
        column = [
            {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'id', name: 'id', className: 'text-center'},
            {data: 'table_name', name: 'table_name', className: 'text-center'},
            {data: 'employee_full_name', name: 'employee_full_name', className: 'text-center'},
            {data: 'amount', name: 'amount', className: 'text-center'},
            {data: 'vat_amount', name: 'vat_amount', className: 'text-center'},
            {data: 'discount_amount', name: 'discount_amount', className: 'text-center'},
            {data: 'point', name: 'point', className: 'text-center'},
            {data: 'total_amount', name: 'total_amount', className: 'text-center'},
            {data: 'payment_date', name: 'payment_date', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ];
        let fixedLeftTable = 2,
            fixedRightTable = 2
            optionRenderTable = []
    DatatableServerSideTemplateNew(element, url, column, '35vh', fixedLeftTable, fixedRightTable, optionRenderTable, callbackDetailAreaViewData);
}

function callbackDetailAreaViewData(response) {
    $('#amount-detail-area-report').text(response.total_original);
    $('#vat-detail-area-report').text(response.total_vat);
    $('#discount-detail-area-report').text(response.total_discount);
    $('#point-detail-area-report').text(response.total_point);
    $('#total-amount-detail-area-report').text(response.total_amount);
}

function closeModalDetailAreaReport() {
    $('#modal-detail-area-report').modal('hide');
    $('#table-detail-area-report').DataTable().destroy();
    resetModalDetailAreaReport();
}

function resetModalDetailAreaReport() {
    $('#time-detail-area-report').text(moment().format('HH:mm') + ' ' + moment().format('DD/MM/YYYY') + ' - ' + moment().format('HH:mm') + ' ' + moment().format('DD/MM/YYYY'));
    $('#name-detail-area-report').text('---')
    $('#discount-detail-area-report').text('0')
    $('#amount-detail-area-report').text('0')
    $('#point-detail-area-report').text('0')
    $('#vat-detail-area-report').text('0')
    $('#total-amount-detail-area-report').text('0')
}
