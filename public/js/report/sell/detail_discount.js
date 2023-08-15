let brandDetailDiscountSellReport, branchDetailDiscountSellReport,
    typeDetailDiscountSellReport, timeDetailDiscountSellReport, fromDetailDiscountSellReport, toDetailDiscountSellReport;

function openModalDetailDiscountSellReport(r) {
    brandDetailDiscountSellReport = r.data('brand');
    branchDetailDiscountSellReport =  r.data('branch');
    typeDetailDiscountSellReport =  r.data('type');
    timeDetailDiscountSellReport =  r.data('time');
    fromDetailDiscountSellReport = r.data('from');
    toDetailDiscountSellReport = r.data('to');
    // getTimeBasedOnTypeReport($('#time-detail-discount-sell-report'), r.data('type'));

    $('#modal-detail-discount-sell-report').modal('show');
    addLoading('sell-report.detail-discount', '#loading-modal-detail-discount-sell-report');
    shortcut.add('ESC', function () {
        closeModalDetailDiscountSellReport();
    });
    dataDetailDiscountSellReport();
}

function openModalDetailByTypeDiscountSellReport(r) {
    brandDetailDiscountSellReport = r.data('brand');
    branchDetailDiscountSellReport =  r.data('branch');
    typeDetailDiscountSellReport =  r.data('type-date');
    timeDetailDiscountSellReport =  r.data('date');
    fromDetailDiscountSellReport = r.data('from');
    toDetailDiscountSellReport = r.data('to');
    switch (r.data('type')){
        case 1 :
            $('#time-detail-discount-sell-report').text(r.data('time-detail'))
            break;
        case 2 :
            $('#time-detail-discount-sell-report').text(r.parents('tr').find('td:eq(1)').text())
            break;
        default :
            $('#time-detail-discount-sell-report').text(r.data('date'))
    }
    $('#modal-detail-discount-sell-report').modal('show');
    addLoading('sell-report.detail-discount', '#loading-modal-detail-discount-sell-report');
    shortcut.add('ESC', function () {
        closeModalDetailDiscountSellReport();
    });
    dataDetailDiscountSellReport();
}

async function dataDetailDiscountSellReport() {
    let element = $('#table-detail-discount-sell-report'),
        url = "sell-report.detail-discount?brand=" + brandDetailDiscountSellReport + "&branch=" + branchDetailDiscountSellReport + "&type=" + typeDetailDiscountSellReport + "&time=" + timeDetailDiscountSellReport + "&limit=" + 100 + "&from=" + $('#from-date-filter-time-bar').val() + "&to=" + $('#to-date-filter-time-bar').val(),
        column = [
            {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'id', name: 'id', className: 'text-center'},
            {data: 'employee_full_name', name: 'employee_full_name', className: 'text-center'},
            {data: 'table_name', name: 'table_name', className: 'text-center'},
            {data: 'amount', name: 'amount', className: 'text-center'},
            {data: 'vat_amount', name: 'vat_amount', className: 'text-center'},
            {data: 'discount_amount', name: 'discount_amount', className: 'text-center'},
            {data: 'point', name: 'point', className: 'text-center'},
            {data: 'total_amount', name: 'total_amount', className: 'text-center'},
            {data: 'payment_date', name: 'payment_date', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ],
        option = []
    dataDetailDiscountSellReportView(element, url, column, option);
}

async function dataDetailDiscountSellReportView(element, url, column) {
    let fixedLeftTable = 2,
        fixedRightTable = 2,
        optionRenderTable = []
    return DatatableServerSideTemplateNew(element, url, column, '40vh', fixedLeftTable, fixedRightTable, optionRenderTable, callbackDetailDiscountSellReportViewData);
}

function callbackDetailDiscountSellReportViewData(response) {
    $('#amount-detail-discount-sell-report').text(response.total_original);
    $('#vat-detail-discount-sell-report').text(response.total_vat);
    $('#discount-detail-discount-sell-report').text(response.total_discount);
    $('#point-detail-discount-sell-report').text(response.total_point);
    $('#total-amount-detail-discount-sell-report').text(response.total_amount);
}

function closeModalDetailDiscountSellReport() {
    $('#modal-detail-discount-sell-report').modal('hide');
    $('#table-detail-discount-sell-report').DataTable().destroy();
    resetModalDetailDiscountSellReport();
}

function resetModalDetailDiscountSellReport() {
    $('#time-detail-discount-sell-report').text('---')
    $('#amount-detail-discount-sell-report').text('0')
    $('#discount-detail-discount-sell-report').text('0')
    $('#vat-detail-discount-sell-report').text('0')
    $('#point-detail-discount-sell-report').text('0')
    $('#total-amount-detail-discount-sell-report').text('0')
}
