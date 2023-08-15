// let dataTableCategory = null,
//     dataTableFoods = null,
//     dataTableFood = null,
//     dataTableGifts = null,
//     dataTableDis = null,
//     dataTableTakeaway = null,
//     dataTableCancelFood = null,
//     dataTableBill = null;
// let list = [
//     '#chart-sell-report-vertical',
//     '#chart-sell-report-horizontal',
//     '.table-responsive',
// ];
// let typeActionSellReport = 1, timeActionSellReport = $('#calendar-day').val(), typeTabSellReport = 1, loadDataBill = 0,
//     typeTimeSellReport, dateActionSellReport, monthActionSellReport, yearActionSellReport, iconChartSellReport,
//     radioChartSellReport, selectTypeSellReport = -1;
//
// $(function () {
//     /* Set cookie */
//     if(getCookieShared('sell-report-user-id-' + idSession)){
//         let dataCookie = JSON.parse(getCookieShared('sell-report-user-id-' + idSession));
//         selectTypeSellReport = dataCookie.select
//         typeTimeSellReport = dataCookie.type;
//         dateActionSellReport = dataCookie.day;
//         monthActionSellReport = dataCookie.month;
//         yearActionSellReport = dataCookie.year;
//         radioChartSellReport = dataCookie.radio;
//         iconChartSellReport = dataCookie.click;
//         $('#calendar-day').val(dateActionSellReport);
//         $('#calendar-month').val(monthActionSellReport);
//         $('#calendar-year').val(yearActionSellReport);
//         $('#select-category-card2').val(selectTypeSellReport);
//     }
//     $('#select-category-card2').on('change', function () {
//         selectTypeSellReport = $(this).val()
//         updateCookieSellReportData();
//     });
//     $('#btn-type-time-sell-report button').on('click', function () {
//         typeTimeSellReport = $(this).attr('id')
//         updateCookieSellReportData();
//     })
//     $('#btn-type-time-sell-report button[id="' + typeTimeSellReport + '"]').click();
//
//     $('#chart-input-radio-sell-report input').on('click', function (){
//         radioChartSellReport = $(this).attr('id')
//         updateCookieSellReportData();
//     })
//     $('#chart-input-radio-sell-report input[id="'+ radioChartSellReport +'"]').click();
//
//     // $('.cd-timeline-icon').on('click', function (){
//     //
//     // })
//     /* end cookie */
//     dateTimePickerTemplate($('#calendar-day'));
//     dateTimePickerMonthYearTemplate($('#calendar-month'));
//     dateTimePickerYearTemplate($('#calendar-year'));
//     loadData();
//     $('#data-null-detail').addClass('d-none');
//     $('#content-detail').removeClass('d-none');
//     $('#card1-title').addClass('card-shadow-custom');
//     $('#card1-title').addClass('border-active');
//     $('#table-card1').removeClass('d-none');
//     $('#calendar-day').on('dp.change', function () {
//         typeActionSellReport = 1;
//         timeActionSellReport = $('#calendar-day').val();
//         loadData();
//         updateCookieSellReportData();
//     });
//     $('#calendar-month').on('dp.change', function () {
//         typeActionSellReport = 3;
//         timeActionSellReport = $('#calendar-month').val();
//         loadData();
//         updateCookieSellReportData();
//     });
//     $('#calendar-year').on('dp.change', function () {
//         typeActionSellReport = 5;
//         timeActionSellReport = $('#calendar-year').val();
//         loadData();
//         updateCookieSellReportData();
//     });
//     $('#select-category-card2').on('select2:select', function () {
//         dataCardFoods();
//     });
//     $('#select-food-card3').on('select2:select', function () {
//         dataCardFood();
//     });
//
//     $('#month .custom-button-search').on('click',function (){
//         loadData();
//     })
//
//     $('#year .custom-button-search').on('click',function (){
//         loadData();
//     })
//
//     $('#day .custom-button-search').on('click',function (){
//         loadData();
//     })
//     $(".bg-customer-default").click( function () {
//         iconChartSellReport = $(this).data('type')
//         updateCookieSellReportData();
//         $('html,body').animate({
//             scrollTop: 0
//         })
//         $('.bg-customer-default').removeClass('active');
//         $(this).addClass('active');
//     })
//     $('.cd-timeline-icon[data-type="'+ iconChartSellReport +'"]').click();
// });
//
// /* Set cookie */
// function updateCookieSellReportData(){
//     saveCookieShared('sell-report-user-id-' + idSession, JSON.stringify({
//         'select' : selectTypeSellReport,
//         'radio' : radioChartSellReport,
//         'click' : iconChartSellReport,
//         type : typeTimeSellReport,
//         day : $('#calendar-day').val(),
//         month : $('#calendar-month').val(),
//         year : $('#calendar-year').val()
//     }))
// }
// /* end cookie */
//
// async function changeDataSell(r) {
//     iconChartSellReport = r.data('type');
//     showContent(r);
// }
//
// async function loadData() {
//     $('#title-chart').removeClass('d-none');
//     $('#data-chart').removeClass('d-none');
//     $('#select-category-card2-div').addClass('d-none');
//     $('#select-food-card3-div').addClass('d-none');
//     let brand = $('#restaurant-branch-id-selected span').attr('data-value'),
//         branch = $('#change_branch').val(),
//         method = 'get',
//         params = {brand: brand, branch: branch, type: typeActionSellReport, time: timeActionSellReport},
//         data = null, url = null, res = null;
//     switch (iconChartSellReport) {
//         case 1:
//             url = 'sell-report.data-category-revenue';
//             res = await axiosTemplate(method, url, params, data,[
//                 $("#table-sell-card1-report"),
//                 $("#chart-sell-report-vertical-center"),
//                 $("#chart-sell-report-vertical-main"),
//             ]);
//             // chartRevenueVertical(res.data[4]);
//             // chartRevenueHorizontal(res.data[4]);
//             eChart('chart-sell-report-vertical-main', res.data[0] === null ? [] : res.data[0].map(i => {
//                     return i.timeline;
//                 }), res.data[0] === null ? [] : res.data[0].map(i => {
//                     return i.valueTotal;
//                 }),
//                 res.data[0] === null ? [] : res.data[0].map(i => {
//                     return i.valueOriginalTotal;
//                 }),
//                 res.data[0] === null ? [] : res.data[0].map(i => {
//                     return i.valueProfit;
//                 }))
//             dataCategoryTable(res.data[1].original.data);
//             dataCategoryTotal(res.data[2]);
//             break;
//         case 2:
//             $('#select-category-card2-div').removeClass('d-none');
//             dataCardFoods();
//             break;
//         case 3:
//             alert('API chưa có !');
//             break;
//             $('#select-food-card3-div').removeClass('d-none');
//             dataFood();
//             dataCardFood();
//             break;
//         case 4:
//             $('#title-chart').addClass('d-none');
//             $('#data-chart').addClass('d-none');
//             url = 'sell-report.data-gift-food-report';
//             res = await axiosTemplate(method, url, params, data,[$("#table-sell-card4-report")]);
//             dataGiftsTable(res.data[0].original.data);
//             dataGiftsTotal(res.data[1]);
//             break;
//         case 5:
//             url = 'sell-report.data-discount-report';
//             res = await axiosTemplate(method, url, params, data,[$("#table-sell-card5-report"),$("#chart-sell-report-vertical")]);
//             // chartRevenueVertical(res.data[0]);
//             // chartRevenueHorizontal(res.data[0]);
//             eChart('chart-sell-report-vertical-main', res.data[0] === null ? [] : res.data[0].map(i => {
//                 return i.timeline;
//             }), res.data[0] === null ? [] : res.data[0].map(i => {
//                 return i.value;
//             }))
//             dataDisTable(res.data[1].original.data);
//             dataDisTotal(res.data[2]);
//             break;
//         case 6:
//             url = 'sell-report.data-food-take-away-report';
//             res = await axiosTemplate(method, url, params, data,[$("#table-sell-card6-report"),$("#chart-sell-report-vertical")]);
//             // chartRevenueVertical(res.data[0]);
//             // chartRevenueHorizontal(res.data[0]);
//             eChart('chart-sell-report-vertical-main', res.data[0] === null ? [] : res.data[0].map(i => {
//                 return i.timeline;
//             }), res.data[0] === null ? [] : res.data[0].map(i => {
//                 return i.value;
//             }));
//             dataTakeawayTable(res.data[1].original.data);
//             dataTakeawayTotal(res.data[2]);
//             break;
//         case 7:
//             $('#title-chart').addClass('d-none');
//             $('#data-chart').addClass('d-none');
//             url = 'sell-report.data-food-cancel-report';
//             res = await axiosTemplate(method, url, params, data,[$("#table-sell-card7-report")]);
//             dataCancleFoodTable(res.data[0].original.data);
//             dataCancleFoodTotal(res.data[1]);
//             break;
//         case 8:
//             $('#title-chart').addClass('d-none');
//             $('#data-chart').addClass('d-none');
//             $('#type-data').val(typeTabSellReport);
//             if (loadDataBill === 0) {
//                 let element = $('#table-sell-card8-report'),
//                     url = "sell-report.data-order-report?brand=" + brand + "&branch=" + branch + "&type=" + typeActionSellReport + "&time=" + timeActionSellReport + "&limit=" + 100,
//                     column = [
//                             {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
//                             {data: 'name', name: 'name'},
//                             {data: 'table_name', name: 'table_name', className: 'text-center'},
//                             {data: 'table_merging_names', name: 'table_merging_names', className: 'text-center'},
//                             {data: 'move_from_table_name', name: 'move_from_table_name', className: 'text-center'},
//                             {data: 'customer_slot_number', name: 'customer_slot_number', className: 'text-center'},
//                             {data: 'vat_amount', name: 'vat_amount', className: 'text-center'},
//                             {data: 'vat_amount', name: 'vat_amount', className: 'text-center'},
//                             {data: 'bank_amount', name: 'bank_amount', className: 'text-center'},
//                             {data: 'cash_amount', name: 'cash_amount', className: 'text-center'},
//                             {data: 'transfer_amount', name: 'transfer_amount', className: 'text-center'},
//                             {data: 'total_amount', name: 'total_amount', className: 'text-center'},
//                             {data: 'created_at', name: 'created_at', className: 'text-center'},
//                             {data: 'used_time', name: 'used_time', className: 'text-center'},
//                             {data: 'action', name: 'action', className: 'text-center', width: '5%'},
//                     ];
//                 dataTableBill = await loadDataBillTable(element, url, column);
//                 $('#btn-type-time-sell-report button[id="' + typeTimeSellReport + '"]').click();
//                 loadDataBill = 1;
//             } else {
//                 dataTableBill.ajax.url("sell-report.data-order-report?brand=" + brand + "&branch=" + branch + "&type=" + typeActionSellReport + "&time=" + timeActionSellReport + "&limit=" + 100).load().draw();
//             }
//             break;
//         default:
//             $('#content-detail').addClass('d-none');
//             $('#data-null-detail').removeClass('d-none');
//     }
// }
//
// async function loadDataBillTable(element, url, column) {
//     let fixedLeftTable = 2,
//         fixedRightTable = 3,
//         optionRenderTable = []
//     return DatatableServerSideTemplateNew(element, url, column, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, callbackLoadData);
// }
//
// function callbackLoadData(response) {
//     $('#total').text(response.total_amount);
//     $('#total-value-order').text(response.total_amount);
//     $('#total-vat').text(response.vat_amount);
//     $('#total-discount').text(response.discount_amount);
//     $('#total-bank').text(response.bank_amount);
//     $('#total-cash').text(response.cash_amount);
//     $('#total-transfer').text(response.transfer_amount);
//     $('#total-customer-order').text(response.total_customer);
// }
//
// async function dataFood() {
//     let branch = $('#change_branch').val(),
//         method = 'get',
//         params = {
//             branch: branch,
//             restaurant_brand_id: restaurant_brand_id
//         },
//         data = null,
//         url = 'sell-report.data-list-food';
//     let res = await axiosTemplate(method, url, params, data);
//     $('#select-food-card3').html(res.data[0]);
// }
//
// async function dataCardFoods() {
//     let brand = $('#restaurant-branch-id-selected span').attr('data-value'),
//         branch = $('#change_branch').val(),
//         inventory = $('#select-category-card2').val(),
//         method = 'get',
//         url = 'sell-report.data-food-revenue',
//         params = {brand: brand, branch: branch, type: typeActionSellReport, time: timeActionSellReport, inventory: inventory},
//         data = null;
//     let res = await axiosTemplate(method, url, params, data,[
//         $("#table-sell-card2-report"),
//         $("#chart-sell-report-vertical"),
//         $("#select-category-card2-div")
//     ]);
//     // chartRevenueVertical(res.data[0]);
//     // chartRevenueHorizontal(res.data[0]);
//
//     dataFoodsTable(res.data[1].original.data);
//     dataFoodsTotal(res.data[2]);
//     // $('#select-category-card2').val(selectTypeSellReport).change();
//     eChart('chart-sell-report-vertical-main', res.data[0] === null ? [] : res.data[0].map(i => {
//             return i.timeline;
//         }), res.data[0] === null ? [] : res.data[0].map(i => {
//             return i.valueTotal;
//         }),
//         res.data[0] === null ? [] : res.data[0].map(i => {
//             return i.valueOriginalTotal;
//         }),
//         res.data[0] === null ? [] : res.data[0].map(i => {
//             return i.valueProfit;
//         }))
// }
//
// async function dataCardFood() {
//     let type_date = $('#type').val(),
//         time = $('#time').val(),
//         branch = $('#change_branch').val(),
//         method = 'get',
//         food_id = $('#select-food-card3').val(),
//         params = {type: type_date, time: time, branch: branch, food_id: food_id},
//         data = null,
//         url = 'sell-report.data-detail-food-revenue';
//     let res = await axiosTemplate(method, url, params, data);
//     // chartRevenueVertical(res.data[0]);
//     // chartRevenueHorizontal(res.data[0]);
//     dataFoodTable([]);
//     dataFoodTotal(res.data[2]);
// }
//
// function exportExcel() {
//     let id = '';
//     let name = '';
//     switch (typeTabSellReport) {
//         case 1:
//             id = $('#table-sell-card1-report');
//             name = $('#name-card1').val();
//             exportExcelTemplate(id, dataTableCategory, name);
//             break;
//         case 2:
//             id = $('#table-sell-card2-report');
//             name = $('#name-card2').val();
//             exportExcelTemplate(id, dataTableFoods, name);
//             break;
//         case 3:
//             id = $('#table-sell-card3-report');
//             name = $('#name-card3').val();
//             exportExcelTemplate(id, dataTableFood, name);
//             break;
//         case 4:
//             id = $('#table-sell-card4-report');
//             name = $('#name-card4').val();
//             exportExcelTemplate(id, dataTableGifts, name);
//             break;
//         case 5:
//             id = $('#table-sell-card5-report');
//             name = $('#name-card5').val();
//             exportExcelTemplate(id, dataTableDis, name);
//             break;
//         case 6:
//             id = $('#table-sell-card6-report');
//             name = $('#name-card6').val();
//             exportExcelTemplate(id, dataTableTakeaway, name);
//             break;
//         case 7:
//             id = $('#table-sell-card7-report');
//             name = $('#name-card7').val();
//             exportExcelTemplate(id, dataTableCancelFood, name);
//             break;
//         default:
//             break;
//     }
// }
