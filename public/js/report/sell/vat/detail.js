let brandDetailVatSellReport, branchDetailVatSellReport,
    typeDetailVatSellReport, timeDetailVatSellReport, fromDetailVatSellReport, toDetailVatSellReport;

function openModalDetailVATSellReport(r) {
    brandDetailVatSellReport = r.data('brand');
    branchDetailVatSellReport =  r.data('branch');
    typeDetailVatSellReport =  r.data('type-date');
    timeDetailVatSellReport =  r.data('date');
    fromDetailVatSellReport = r.data('from');
    toDetailVatSellReport = r.data('to');

    // getTimeBasedOnTypeReport($('#time-detail-discount-sell-report'), r.data('type'));

    $('#modal-detail-vat-sell-report').modal('show');
    addLoading('vat-report.detail-vat', '#loading-modal-detail-vat-sell-report');
    shortcut.add('ESC', function () {
        closeModalDetailVatSellReport();
    });
    dataDetailVatSellReport();
}

function openModalDetailByTypeVatSellReport(r) {
    brandDetailVatSellReport = r.data('brand');
    branchDetailVatSellReport =  r.data('branch');
    typeDetailVatSellReport =  r.data('type-date');
    timeDetailVatSellReport =  r.data('date');
    fromDetailVatSellReport = r.data('from');
    toDetailVatSellReport = r.data('to');
    switch (r.data('type')){
        case 1 :
            $('#time-detail-vat-sell-report').text(r.data('time-detail'))
            break;
        case 2 :
            $('#time-detail-vat-sell-report').text(r.parents('tr').find('td:eq(1)').text())
            break;
        default :
            $('#time-detail-vat-sell-report').text(r.data('date'))
    }
    $('#modal-detail-vat-sell-report').modal('show');
    addLoading('vat-report.detail-vat', '#loading-modal-detail-vat-sell-report');
    shortcut.add('ESC', function () {
        closeModalDetailVatSellReport();
    });
    dataDetailVatSellReport();
}

async function dataDetailVatSellReport() {
    let element = $('#table-detail-vat-sell-report'),
        url = "vat-report.detail-vat?brand=" + brandDetailVatSellReport + "&branch=" + branchDetailVatSellReport + "&type=" + typeDetailVatSellReport + "&time=" + timeDetailVatSellReport + "&limit=" + 100 + "&from=" + $('#from-date-filter-time-bar').val() + "&to=" + $('#to-date-filter-time-bar').val(),
        column = [
            {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'id', name: 'id', className: 'text-left'},
            {data: 'employee_full_name', name: 'employee_full_name', className: 'text-left'},
            {data: 'table_name', name: 'table_name', className: 'text-left'},
            {data: 'amount', name: 'amount', className: 'text-right'},
            {data: 'vat_amount', name: 'vat_amount', className: 'text-right'},
            {data: 'discount_amount', name: 'discount_amount', className: 'text-right'},
            {data: 'point', name: 'point', className: 'text-right'},
            {data: 'total_amount', name: 'total_amount', className: 'text-right'},
            {data: 'payment_date', name: 'payment_date', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ],
        option = []
    dataDetailVatSellReportView(element, url, column, option);
}

async function dataDetailVatSellReportView(element, url, column) {
    let fixedLeftTable = 2,
        fixedRightTable = 2,
        optionRenderTable = []
    return DatatableServerSideTemplateNew(element, url, column, '40vh', fixedLeftTable, fixedRightTable, optionRenderTable, callbackDetailVatSellReportViewData);
}

function callbackDetailVatSellReportViewData(response) {
    $('#amount-detail-vat-sell-report').text(response.total_original);
    $('#vat-detail-vat-sell-report').text(response.total_vat);
    $('#discount-detail-discount-sell-report').text(response.total_discount);
    $('#point-detail-vat-sell-report').text(response.total_point);
    $('#total-amount-detail-vat-sell-report').text(response.total_amount);
}

function closeModalDetailVatSellReport() {
    $('#modal-detail-vat-sell-report').modal('hide');
    $('#table-detail-vat-sell-report').DataTable().destroy();
    resetModalDetailVatSellReport();
}

function resetModalDetailVatSellReport() {
    $('#time-detail-vat-sell-report').text('---')
    $('#amount-detail-vat-sell-report').text('0')
    $('#vat-detail-vat-sell-report').text('0')
    $('#discount-detail-discount-sell-report').text('0')
    $('#point-detail-vat-sell-report').text('0')
    $('#total-amount-detail-vat-sell-report').text('0')
}
