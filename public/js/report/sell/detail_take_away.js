let idDetailTakeAwaySellReport, brandDetailTakeAwaySellReport, branchDetailTakeAwaySellReport,
    typeDetailTakeAwaySellReport, timeDetailTakeAwaySellReport, giftDetailTakeAwaySellReport,
    cancelDetailTakeAwaySellReport;

function openDetailTakeAwaySellReport(r) {
    idDetailTakeAwaySellReport = r.data('id');
    brandDetailTakeAwaySellReport = r.data('brand');
    branchDetailTakeAwaySellReport = r.data('branch');
    typeDetailTakeAwaySellReport = r.data('type');
    timeDetailTakeAwaySellReport = r.data('time');
    giftDetailTakeAwaySellReport = r.data('gift');
    cancelDetailTakeAwaySellReport = r.data('cancel');
    $('#name-detail-take-away-sell-report').text(r.data('name'));
    $('#modal-detail-take-away-sell-report').modal('show');
    addLoading('sell-report.detail-food', '#loading-modal-detail-take-away-sell-report');
    $('#title-detail-take-away-sell-report').text(r.data('title'));
    shortcut.add('ESC', function () {
        closeModalDetailTakeAwaySellReport();
    });
    getTimeBasedOnTypeReport($('#time-detail-take-away-sell-report'), r.data('type'));
    dataDetailTakeAwaySellReport()
}

async function dataDetailTakeAwaySellReport() {
    let element = $('#table-detail-take-away-sell-report'),
        url =  "take-away-report.detail?id=" + idDetailTakeAwaySellReport + "&brand=" + brandDetailTakeAwaySellReport + "&branch=" + branchDetailTakeAwaySellReport + "&type=" + typeDetailTakeAwaySellReport + "&time=" + timeDetailTakeAwaySellReport + "&gift=" + giftDetailTakeAwaySellReport + "&cancel=" + cancelDetailTakeAwaySellReport + "&limit=" + 100 + "&from_date=" + fromDateTakeAwayReport + "&to_date=" + toDateTakeAwayReport,
        column = [
            {data: 'index',render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
            {data: 'id', name: 'id', className: 'text-right'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'table_name', name: 'table_name', className: 'text-left'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'total_amount_by_food_id', name: 'total_amount_by_food_id', className: 'text-right'},
            {data: 'total_amount', name: 'total_amount', className: 'text-right'},
            {data: 'customer_slot_number', name: 'customer_slot_number', className: 'text-center'},
            {data: 'created_at', name: 'created_at', className: 'text-center'},
            {data: 'use_time', name: 'use_time', className: 'text-center'},
            // {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ];
    dataDetailTakeAwaySellReportView(element, url, column);
}

async function dataDetailTakeAwaySellReportView(element, url, column) {
    let fixedLeftTable = 2,
        fixedRightTable = 2,
        optionRenderTable = []
    return DatatableServerSideTemplateNew(element, url, column, '40vh', fixedLeftTable, fixedRightTable, optionRenderTable, callbackDetailTakeAwaySellReportViewData);
}

function callbackDetailTakeAwaySellReportViewData(response) {
    $('#original-detail-take-away-sell-report').text(response.total_original);
    $('#price-detail-take-away-sell-report').text(response.total_price);
    $('#profit-detail-take-away-sell-report').text(response.total_profit);
    $('#rate-profit-detail-take-away-sell-report').text(response.total_rate);
}

function closeModalDetailTakeAwaySellReport() {
    $('#modal-detail-take-away-sell-report').modal('hide');
    $('#table-detail-take-away-sell-report').DataTable().destroy();
    resetModalDetailTakeAwaySellReport();
}

function resetModalDetailTakeAwaySellReport() {
    $('#name-detail-take-away-sell-report').text('---')
    $('#time-detail-take-away-sell-report').text('---')
    $('#original-detail-take-away-sell-report').text('0')
    $('#price-detail-take-away-sell-report').text('0')
    $('#profit-detail-take-away-sell-report').text('0')
    $('#rate-profit-detail-take-away-sell-report').text('0')
}
