// let idDetailFoodSellReport, brandDetailFoodSellReport, branchDetailFoodSellReport,
//     typeDetailFoodSellReport, timeDetailFoodSellReport, giftDetailFoodSellReport,
//     cancelDetailFoodSellReport;
//
// function openDetailFoodSellReport(r) {
//     idDetailFoodSellReport = r.data('id');
//     brandDetailFoodSellReport = r.data('brand');
//     branchDetailFoodSellReport = r.data('branch');
//     typeDetailFoodSellReport = r.data('type');
//     timeDetailFoodSellReport = r.data('time');
//     giftDetailFoodSellReport = r.data('gift');
//     cancelDetailFoodSellReport = r.data('cancel');
//     $('#name-detail-food-sell-report').text(r.data('name'));
//     $('#modal-detail-food-sell-report').modal('show');
//     addLoading('sell-report.detail-food', '#loading-modal-detail-food-sell-report');
//     $('#title-detail-food-sell-report').text(r.data('title'));
//     shortcut.add('ESC', function () {
//         closeModalDetailFoodSellReport();
//     });
//     dataDetailFoodSellReport()
// }
//
// async function dataDetailFoodSellReport() {
//     let element = $('#table-detail-food-sell-report'),
//         url =  "food-report.detail?id=" + idDetailFoodSellReport + "&brand=" + brandDetailFoodSellReport + "&branch=" + branchDetailFoodSellReport + "&type=" + typeDetailFoodSellReport + "&time=" + timeDetailFoodSellReport + "&gift=" + giftDetailFoodSellReport + "&cancel=" + cancelDetailFoodSellReport + "&limit=" + 100 + "&from_date=" + fromDateFoodReport + "&to_date=" + toDateCateFoodReport,
//         column = [
//             {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
//             {data: 'id', name: 'id', className: 'text-center'},
//             {data: 'name', name: 'name'},
//             {data: 'table_name', name: 'table_name', className: 'text-center'},
//             {data: 'quantity', name: 'quantity', className: 'text-center'},
//             {data: 'total_amount_by_food_id', name: 'total_amount_by_food_id', className: 'text-center'},
//             {data: 'total_amount', name: 'total_amount', className: 'text-center'},
//             {data: 'customer_slot_number', name: 'customer_slot_number', className: 'text-center'},
//             {data: 'created_at', name: 'created_at', className: 'text-center'},
//             {data: 'use_time', name: 'use_time', className: 'text-center'},
//             {data: 'action', name: 'action', className: 'text-center', width: '5%'},
//         ];
//     dataDetailFoodSellReportView(element, url, column);
// }
//
// async function dataDetailFoodSellReportView(element, url, column) {
//     let fixedLeftTable = 2,
//         fixedRightTable = 2,
//         optionRenderTable = []
//     return DatatableServerSideTemplateNew(element, url, column, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, callbackDetailFoodSellReportViewData);
// }
//
// function callbackDetailFoodSellReportViewData(response) {
//     $('#original-detail-food-sell-report').text(response.total_original);
//     $('#price-detail-food-sell-report').text(response.total_price);
//     $('#profit-detail-food-sell-report').text(response.total_profit);
//     $('#rate-profit-detail-food-sell-report').text(response.total_rate);
//     $('#time-detail-food-sell-report').text(response.time);
// }
//
// function closeModalDetailFoodSellReport() {
//     $('#modal-detail-food-sell-report').modal('hide');
//     $('#table-detail-food-sell-report').DataTable().destroy();
//     resetModalDetailFoodSellReport();
// }
//
// function resetModalDetailFoodSellReport() {
//     $('#name-detail-food-sell-report').text('---')
//     $('#time-detail-food-sell-report').text(moment().format('DD/MM/YYYY') + ' - ' + moment().format('DD/MM/YYYY'))
//     $('#original-detail-food-sell-report').text('0')
//     $('#price-detail-food-sell-report').text('0')
//     $('#profit-detail-food-sell-report').text('0')
//     $('#rate-profit-detail-food-sell-report').text('0')
// }
