let foodName, typeDetailOffMenuSellReport, timeDetailTakeAwaySellReport , brand, branch, amount;

function openDetailOffMenuSellReport(r) {
    foodName = r.data('food-name');
    typeDetailOffMenuSellReport = r.data('type');
    timeDetailTakeAwaySellReport = r.data('time');
    brand = r.data('brand')
    branch = r.data('branch')
    amount = r.data('amount')
    $('#name-detail-off-menu-sell-report').text(r.data('name'));
    $('#modal-detail-off-menu-sell-report').modal('show');
    addLoading('sell-report.detail-food', '#loading-modal-detail-off-menu-sell-report');
    $('#title-detail-take-away-sell-report').text(r.data('title'));
    shortcut.add('ESC', function () {
        closeModalDetailOffMenuSellReport();
    });
    getTimeBasedOnTypeReport($('#time-detail-take-away-sell-report'), r.data('type'));
    dataDetailOffMenuSellReport()
}

async function dataDetailOffMenuSellReport() {
    let element = $('#table-detail-off-menu-sell-report'),
        url =  "off-menu-dishes-report.detail?food_name=" + foodName +"&brand=" + brand + '&branch=' + branch + '&amount=' + amount + "&type=" + typeDetailOffMenuSellReport + "&time=" + timeDetailTakeAwaySellReport + "&limit=" + 100 + "&from_date=" + fromDateOffMenuReport + "&to_date=" + toDateCateOffMenuReport,
        column = [
            {data: 'index',render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
            {data: 'id', name: 'id', className: 'text-center'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'table_name', name: 'table_name', className: 'text-center'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'total_amount_by_food_id', name: 'total_amount_by_food_id', className: 'text-center'},
            {data: 'total_amount', name: 'total_amount', className: 'text-center'},
            {data: 'customer_slot_number', name: 'customer_slot_number', className: 'text-center'},
            {data: 'created_at', name: 'created_at', className: 'text-center'},
            {data: 'use_time', name: 'use_time', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ];
    await dataDetailOffMenuSellReportView(element, url, column);
}

async function dataDetailOffMenuSellReportView(element, url, column) {
    let fixedLeftTable = 2,
        fixedRightTable = 2,
        optionRenderTable = []
    return DatatableServerSideTemplateNew(element, url, column, '40vh', fixedLeftTable, fixedRightTable, optionRenderTable, callbackDetailOffMenuSellReportViewData);
}

function callbackDetailOffMenuSellReportViewData(response) {
    console.log(response)
    $('#original-detail-off-menu-sell-report').text(response.total_original);
    $('#price-detail-off-menu-sell-report').text(response.total_price);
    $('#profit-detail-off-menu-sell-report').text(response.total_profit);
    $('#rate-profit-detail-off-menu-sell-report').text(response.total_rate);
    $('#total-amount-amount-detail-food-sell-report').text(response.total_amount);
    $('#total-amount-using-slot-table-detail-food-sell-report').text(response.total_customer_slot_number);
}

function closeModalDetailOffMenuSellReport() {
    $('#modal-detail-off-menu-sell-report').modal('hide');
    $('#table-detail-off-menu-sell-report').DataTable().destroy();
    resetModalDetailOffMenuSellReport();
}

function resetModalDetailOffMenuSellReport() {
    $('#name-detail-off-menu-sell-report').text('---')
    $('#time-detail-take-away-sell-report').text('---')
    $('#original-detail-off-menu-sell-report').text('0')
    $('#price-detail-off-menu-sell-report').text('0')
    $('#profit-detail-off-menu-sell-report').text('0')
    $('#rate-profit-detail-off-menu-sell-report').text('0')
}
