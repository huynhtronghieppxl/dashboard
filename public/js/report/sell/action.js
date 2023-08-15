// $('#btn-day').on('click', function () {
//     $('.add-display').addClass('d-none');
//     $('#day').removeClass('d-none');
//     $('.btn-edit-display').removeClass('btn-grd-warning');
//     $('#btn-day').removeClass('btn-grd-warning');
//     typeActionSellReport = 1;
//     timeActionSellReport = $('#calendar-day').val();
//     loadData();
// });
// $('#btn-week').on('click', function () {
//     $('.add-display').addClass('d-none');
//     $('#week').removeClass('d-none');
//     $('.btn-edit-display').removeClass('btn-grd-warning');
//     $('#btn-week').addClass('btn-grd-warning');
//     typeActionSellReport = 2;
//     timeActionSellReport = moment().format('WW/YYYY');
//     loadData();
// });
// $('#btn-month').on('click', function () {
//     $('.add-display').addClass('d-none');
//     $('#month').removeClass('d-none');
//     $('.btn-edit-display').removeClass('btn-grd-warning');
//     $('#btn-month').addClass('btn-grd-warning');
//     typeActionSellReport = 3;
//     timeActionSellReport = $('#calendar-month').val();
//     loadData();
// });
// $('#btn-3month').on('click', function () {
//     $('.add-display').addClass('d-none');
//     $('.btn-edit-display').removeClass('btn-grd-warning');
//     $('#btn-3month').addClass('btn-grd-warning');
//     typeActionSellReport = 4;
//     timeActionSellReport = moment().format('MM/YYYY');
//     loadData();
// });
// $('#btn-year').on('click', function () {
//     $('.add-display').addClass('d-none');
//     $('#year').removeClass('d-none');
//     $('.btn-edit-display').removeClass('btn-grd-warning');
//     $('#btn-year').addClass('btn-grd-warning');
//     typeActionSellReport = 5;
//     timeActionSellReport = $('#calendar-year').val();
//     loadData();
// });
// $('#btn-3year').on('click', function () {
//     $('.add-display').addClass('d-none');
//     $('.btn-edit-display').removeClass('btn-grd-warning');
//     $('#btn-3year').addClass('btn-grd-warning');
//     typeActionSellReport = 6;
//     timeActionSellReport = moment().format('YYYY');
//     loadData();
// });
// $('#btn-allyear').on('click', function () {
//     $('.add-display').addClass('d-none');
//     $('.btn-edit-display').removeClass('btn-grd-warning');
//     $('#btn-allyear').addClass('btn-grd-warning');
//     typeActionSellReport = 7;
//     timeActionSellReport = moment($('#change_branch').find(':selected').data('created'), 'DD/MM/YYYY HH:mm').clone().format('YYYY');
//     loadData();
// });
//
// // Show-hide value chart
// $(document).on('change', '#label-chart', function () {
//     if ($(this).is(':checked')) {
//         $('.amcharts-graph-column text').removeClass('d-none');
//     } else {
//         $('.amcharts-graph-column text').addClass('d-none');
//     }
// });
//
// // Change chart
// $(document).on('click', '#chart_vertical', function () {
//     $('#chart-sell-report-vertical').removeClass('d-none');
//     $('#chart-sell-report-horizontal').addClass('d-none');
//     $('#label-chart').prop('checked', true);
// });
//
// $(document).on('click', '#chart_horizontal', function () {
//     $('#chart-sell-report-vertical').addClass('d-none');
//     $('#chart-sell-report-horizontal').removeClass('d-none');
//     $('#label-chart').prop('checked', true);
// });
