let idDetailProfitReport, brandDetailProfitReport, branchDetailProfitReport,
    typeDetailProfitReport, timeDetailProfitReport, giftDetailProfitReport = 0,
    cancelDetailProfitReport = 0;

function openDetailProfitReport(r) {
    idDetailProfitReport = r.data('id');
    brandDetailProfitReport = r.data('brand');
    branchDetailProfitReport = r.data('branch');
    typeDetailProfitReport = r.data('type');
    timeDetailProfitReport = r.data('time');
    $('#name-detail-food-sell-report').text(r.data('name'));
    $('#modal-detail-food-sell-report').modal('show');
    addLoading('sell-report.detail-food', '#loading-modal-detail-food-sell-report');
    $('#title-detail-food-sell-report').text(r.data('title'));
    shortcut.add('ESC', function () {
        closeModalDetailProfitReport();
    });
    dataDetailProfitReport();
    getTimeBasedOnTypeReport($('#time-detail-food-sell-report'), r.data('type'));
}

async function dataDetailProfitReport() {
    let element = $('#table-detail-food-sell-report'),
        url =  "food-report.detail?id=" + idDetailProfitReport + "&brand=" + brandDetailProfitReport + "&branch=" + branchDetailProfitReport + "&type=" + typeDetailProfitReport + "&time=" + timeDetailProfitReport + "&gift=" + giftDetailProfitReport + "&cancel=" + cancelDetailProfitReport + "&limit=" + 100 + "&from_date=" + fromDateProfitReport + "&to_date=" + toDateProfitReport,
        column = [
            {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'id', name: 'id', className: 'text-center'},
            {data: 'name', name: 'name'},
            {data: 'table_name', name: 'table_name', className: 'text-center'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'total_amount_by_food_id', name: 'total_amount_by_food_id', className: 'text-center'},
            {data: 'total_amount', name: 'total_amount', className: 'text-center'},
            {data: 'customer_slot_number', name: 'customer_slot_number', className: 'text-center'},
            {data: 'created_at', name: 'created_at', className: 'text-center'},
            {data: 'use_time', name: 'use_time', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ];
    dataDetailProfitReportView(element, url, column);
}

async function dataDetailProfitReportView(element, url, column) {
    let fixedLeftTable = 2,
        fixedRightTable = 2,
        optionRenderTable = []
    return DatatableServerSideTemplateNew(element, url, column, '40vh', fixedLeftTable, fixedRightTable, optionRenderTable, callbackDetailProfitReportViewData);
}

function callbackDetailProfitReportViewData(response) {
    $('#original-detail-food-sell-report').text(response.total_original);
    $('#price-detail-food-sell-report').text(response.total_price);
    $('#profit-detail-food-sell-report').text(response.total_profit);
    $('#rate-profit-detail-food-sell-report').text(response.total_rate);
}

function closeModalDetailProfitReport() {
    $('#modal-detail-food-sell-report').modal('hide');
    $('#table-detail-food-sell-report').DataTable().destroy();
    resetModalDetailProfitReport();
}

function resetModalDetailProfitReport() {
    $('#name-detail-food-sell-report').text('---')
    $('#time-detail-food-sell-report').text('---')
    $('#original-detail-food-sell-report').text('0')
    $('#price-detail-food-sell-report').text('0')
    $('#profit-detail-food-sell-report').text('0')
    $('#rate-profit-detail-food-sell-report').text('0')
}
