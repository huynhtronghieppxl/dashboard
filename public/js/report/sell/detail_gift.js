let idDetailGiftFoodSellReport, brandDetailGiftFoodSellReport, branchDetailGiftFoodSellReport,
    typeDetailGiftFoodSellReport, timeDetailGiftFoodSellReport, giftDetailGiftFoodSellReport,
    cancelDetailGiftFoodSellReport;


function openDetailGiftFoodSellReport(r) {
    idDetailGiftFoodSellReport = r.data('id');
    brandDetailGiftFoodSellReport = r.data('brand');
    branchDetailGiftFoodSellReport = r.data('branch');
    typeDetailGiftFoodSellReport = r.data('type');
    timeDetailGiftFoodSellReport = r.data('time');
    giftDetailGiftFoodSellReport = r.data('gift');
    cancelDetailGiftFoodSellReport = r.data('cancel');
    $('#name-detail-gift-food-sell-report').text(r.data('name'));
    $('#modal-detail-gift-food-sell-report').modal('show');
    addLoading('sell-report.detail-food', '#loading-modal-detail-gift-food-sell-report');
    $('#title-detail-gift-food-sell-report').text(r.data('title'));
    shortcut.add('ESC', function () {
        closeModalDetailGiftFoodSellReport();
    });
    getTimeBasedOnTypeReport($('#time-detail-gift-food-sell-report'), r.data('type'))
    dataDetailGiftFoodSellReport();
}

async function dataDetailGiftFoodSellReport() {
    let element = $('#table-detail-gift-food-sell-report'),
        url = "sell-report.detail-food?id=" + idDetailGiftFoodSellReport + "&brand=" + brandDetailGiftFoodSellReport + "&branch=" + branchDetailGiftFoodSellReport + "&type=" + typeDetailGiftFoodSellReport + "&time=" + timeDetailGiftFoodSellReport + "&gift=" + giftDetailGiftFoodSellReport + "&cancel=" + cancelDetailGiftFoodSellReport + "&limit=" + 100 + "&from=" + $('.from-date-filter-time-bar').val() + "&to=" + $('.to-date-filter-time-bar').val(),
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
        ],
        option = []
    dataDetailGiftFoodSellReportView(element, url, column, option);
}

async function dataDetailGiftFoodSellReportView(element, url, column) {
    let fixedLeftTable = 2,
        fixedRightTable = 2,
        optionRenderTable = []
    return DatatableServerSideTemplateNew(element, url, column, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, callbackDetailGiftFoodSellReportViewData);
}

function callbackDetailGiftFoodSellReportViewData(response) {
    $('#price-detail-gift-food-sell-report').text(response.total_price);
}

function closeModalDetailGiftFoodSellReport() {
    $('#modal-detail-gift-food-sell-report').modal('hide');
    $('#table-detail-gift-food-sell-report').DataTable().destroy();
    resetModalDetailGiftFoodSellReport();
}

function resetModalDetailGiftFoodSellReport() {
    $('#name-detail-gift-food-sell-report').text('---');
    $('#price-detail-gift-food-sell-report').text('0');
    $('#time-detail-gift-food-sell-report').text('---')
}
