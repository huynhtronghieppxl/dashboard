// async function dataCategoryTable(data) {
//     let fixedLeft = 2;
//     let fixedRight = 0;
//     let id = $('#table-sell-card1-report');
//     let column = [
//         {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
//         {data: 'category_name', name: 'category_name', className: 'text-center'},
//         {data: 'total_original_amount', name: 'total_original_amount', className: 'text-center'},
//         {data: 'total_amount', name: 'total_amount', className: 'text-center'},
//         {data: 'profit', name: 'profit', className: 'text-center'},
//         {data: 'profit_ratio', name: 'profit_ratio', className: 'text-center'},
//         {data: 'action', name: 'action', className: 'text-center', width: '5%'},
//         {data: 'keysearch', className: 'd-none', width:'5%'},
//         ],
//         option = []
//     dataTableCategory = await DatatableTemplateNew(id, data, column, vh_of_table, fixedLeft, fixedRight, option);
//     $(document).on('input paste', '#table-sell-card1-report_filter', async function () {
//         let totalOriginPrice = 0,
//             totalAmount = 0,
//             totalProfit = 0;
//         await dataTableCategory.rows({'search': 'applied'}).every(function () {
//             let row = $(this.node());
//             totalOriginPrice += removeformatNumber(row.find('td:eq(2)').text());
//             totalAmount += removeformatNumber(row.find('td:eq(3)').text());
//             totalProfit += removeformatNumber(row.find('td:eq(4)').text());
//         })
//         $('#total-original-card1').text(formatNumber(totalOriginPrice));
//         $('#total-money-card1').text(formatNumber(totalAmount));
//         $('#total-profit-card1').text(formatNumber(totalProfit));
//     })
// }
//
// async function dataFoodsTable(data) {
//     let fixedLeft = 2;
//     let fixedRight = 0;
//     let id = $('#table-sell-card2-report');
//     let column = [
//         {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
//         {data: 'avatar', name: 'avatar'},
//         {data: 'quantity', name: 'quantity', className: 'text-center'},
//         {data: 'unit_name', name: 'unit_name', className: 'text-center'},
//         {data: 'total_original_amount', name: 'total_original_amount', className: 'text-center'},
//         {data: 'total_amount', name: 'total_amount', className: 'text-center'},
//         {data: 'profit', name: 'profit', className: 'text-center'},
//         {data: 'profit_ratio', name: 'profit_ratio', className: 'text-center'},
//         {data: 'action', name: 'action', className: 'text-center', width:'5%'},
//         {data: 'keysearch', className: 'd-none', width:'5%'},
//     ],
//         option = []
//     dataTableFoods = await DatatableTemplateNew(id, data, column, vh_of_table, fixedLeft, fixedRight, option);
//     $(document).on('input paste', '#table-sell-card2-report_filter', async function () {
//         let totalQuantity = 0,
//             totalOriginPrice = 0,
//             totalAmount = 0,
//             totalProfit = 0;
//         await dataTableFoods.rows({'search': 'applied'}).every(function () {
//             let row = $(this.node());
//             totalQuantity += removeformatNumber(row.find('td:eq(2)').text());
//             totalOriginPrice += removeformatNumber(row.find('td:eq(4)').text());
//             totalAmount += removeformatNumber(row.find('td:eq(5)').text());
//             totalProfit += removeformatNumber(row.find('td:eq(6)').text());
//         })
//         $('#total-quantity-card2').text(formatNumber(totalQuantity));
//         $('#total-original-card2').text(formatNumber(totalOriginPrice));
//         $('#total-money-card2').text(formatNumber(totalAmount));
//         $('#total-profit-card2').text(formatNumber(totalProfit));
//     })
// }
//
// async function dataFoodTable(data) {
//     let fixedLeft = 2;
//     let fixedRight = 0;
//     let id = $('#table-sell-card3-report');
//     let column = [
//         {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
//         {data: 'date', name: 'date', className: 'text-center'},
//         {data: 'quantity', name: 'quantity', className: 'text-center'},
//         {data: 'total_amount', name: 'total_amount', className: 'text-center'},
//         {data: 'keysearch', className: 'd-none', width:'5%'},
//         ],
//         option = []
//     dataTableFood = await DatatableTemplateNew(id, data, column, vh_of_table, fixedLeft, fixedRight, option);
// }
//
// async function dataGiftsTable(data) {
//     let fixedLeft = 2;
//     let fixedRight = 0;
//     let id = $('#table-sell-card4-report');
//     let column = [
//         {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
//         {data: 'name', name: 'name'},
//         {data: 'food_name', name: 'food', className: 'text-center'},
//         {data: 'quantity', name: 'quantity', className: 'text-center'},
//         {data: 'price', name: 'price', className: 'text-center'},
//         {data: 'total_amount', name: 'total_amount', className: 'text-center'},
//         {data: 'day', name: 'day', className: 'text-center'},
//         {data: 'table_name', name: 'table_name', className: 'text-center'},
//         {data: 'customer_slot_number', name: 'customer_slot_number', className: 'text-center'},
//         {data: 'action', name: 'action', className: 'text-center', width: '5%'},
//         {data: 'keysearch', className: 'd-none', width:'5%'},
//         ],
//         option = []
//     dataTableGifts = await DatatableTemplateNew(id, data, column, vh_of_table, fixedLeft, fixedRight, option);
//     $(document).on('input paste', '#table-sell-card4-report_filter', async function () {
//         let totalQuantity = 0,
//             totalAmount = 0;
//         await dataTableGifts.rows({'search': 'applied'}).every(function () {
//             let row = $(this.node());
//             totalQuantity += removeformatNumber(row.find('td:eq(3)').text());
//             totalAmount += removeformatNumber(row.find('td:eq(5)').text());
//         })
//         $('#total-quantity').text(formatNumber(totalQuantity));
//         $('#total-total').text(formatNumber(totalAmount));
//     })
// }
//
// async function dataDisTable(data) {
//     let fixedLeft = 2;
//     let fixedRight = 0;
//     let id = $('#table-sell-card5-report');
//     let column = [
//         {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
//         {data: 'index', name: 'index', className: 'text-center'},
//         {data: 'amount', name: 'amount', className: 'text-center'},
//         {data: 'action', name: 'action', className: 'text-center', width: '10%'},
//         {data: 'keysearch', className: 'd-none', width:'5%'},
//         ],
//         option = []
//     dataTableDis = await DatatableTemplateNew(id, data, column, vh_of_table, fixedLeft, fixedRight, option);
//     $(document).on('input paste', '#table-sell-card5-report_filter', async function () {
//         let totalDiscount = 0;
//         await dataTableDis.rows({'search': 'applied'}).every(function () {
//             let row = $(this.node());
//             totalDiscount += removeformatNumber(row.find('td:eq(2)').text());
//         })
//         $('#total-value').text(formatNumber(totalDiscount));
//     })
// }
//
// async function dataTakeawayTable(data) {
//     let fixedLeft = 2;
//     let fixedRight = 0;
//     let id = $('#table-sell-card6-report');
//     let column = [
//         {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
//         {data: 'avatar', name: 'avatar'},
//         {data: 'quantity', name: 'quantity', className: 'text-center'},
//         {data: 'unit_name', name: 'unit_name', className: 'text-center'},
//         {data: 'total_original_amount', name: 'total_original_amount', className: 'text-center'},
//         {data: 'total_amount', name: 'total_amount', className: 'text-center'},
//         {data: 'profit', name: 'profit', className: 'text-center'},
//         {data: 'profit_ratio', name: 'profit_ratio', className: 'text-center'},
//         {data: 'action', name: 'action', className: 'text-center', width:'10%'},
//         {data: 'keysearch',  className: 'd-none', width:'5%'},
//         ],
//         option = []
//     dataTableTakeaway = await DatatableTemplateNew(id, data, column, vh_of_table, fixedLeft, fixedRight, option);
//     $(document).on('input paste', '#table-sell-card6-report_filter', async function () {
//         let totalQuantity = 0,
//             totalOriginPrice = 0,
//             totalAmount = 0,
//             totalProfit = 0;
//         await dataTableTakeaway.rows({'search': 'applied'}).every(function () {
//             let row = $(this.node());
//             totalQuantity += removeformatNumber(row.find('td:eq(2)').text());
//             totalOriginPrice += removeformatNumber(row.find('td:eq(4)').text());
//             totalAmount += removeformatNumber(row.find('td:eq(5)').text());
//             totalProfit += removeformatNumber(row.find('td:eq(6)').text());
//         })
//         $('#total-quantity-card6').text(formatNumber(totalQuantity));
//         $('#total-original-card6').text(formatNumber(totalOriginPrice));
//         $('#total-money-card6').text(formatNumber(totalAmount));
//         $('#total-profit-card6').text(formatNumber(totalProfit));
//     })
// }
//
// async function dataCancleFoodTable(data) {
//     let fixedLeft = 2;
//     let fixedRight = 0;
//     let id = $('#table-sell-card7-report');
//     let column = [
//         {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
//         {data: 'name', name: 'name'},
//         {data: 'food_name', name: 'food', className: 'text-center'},
//         {data: 'quantity', name: 'quantity', className: 'text-center'},
//         {data: 'price', name: 'price', className: 'text-center'},
//         {data: 'total_amount', name: 'total_amount', className: 'text-center'},
//         {data: 'day', name: 'day', className: 'text-center'},
//         {data: 'table_name', name: 'table_name', className: 'text-center'},
//         {data: 'action', name: 'action', className: 'text-center', width: '5%'},
//         {data: 'keysearch', className: 'd-none', width:'5%'},
//         ],
//         option = []
//     dataTableCancelFood = await DatatableTemplateNew(id, data, column, vh_of_table, fixedLeft, fixedRight, option);
//     $(document).on('input paste', '#table-sell-card7-report_filter', async function () {
//         let totalQuantity = 0,
//             totalAmount = 0;
//         await dataTableCancelFood.rows({'search': 'applied'}).every(function () {
//             let row = $(this.node());
//             totalQuantity += removeformatNumber(row.find('td:eq(3)').text());
//             totalAmount += removeformatNumber(row.find('td:eq(5)').text());
//         })
//         $('#total-quantity-card7').text(formatNumber(totalQuantity));
//         $('#total-amount-card7').text(formatNumber(totalAmount));
//     })
// }
