$('#btn-day').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#day').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-day').addClass('btn-grd-warning');
    typeActionProfitReport = 1;
    timeActionProfitReport = $('#calendar-day').val();
    updateCookieProfitReportData();
    loadData();
});
$('#btn-week').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#week').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-week').addClass('btn-grd-warning');
    typeActionProfitReport = 2;
    timeActionProfitReport = moment().format('WW/YYYY');
    updateCookieProfitReportData();
    loadData();
});
$('#btn-month').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#month').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-month').addClass('btn-grd-warning');
    typeActionProfitReport = 3;
    timeActionProfitReport = $('#calendar-month').val();
    updateCookieProfitReportData();
    loadData();
});
$('#btn-3month').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-3month').addClass('btn-grd-warning');
    typeActionProfitReport = 4;
    timeActionProfitReport = moment().format('MM/YYYY');
    updateCookieProfitReportData();
    loadData();
});
$('#btn-year').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#year').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-year').addClass('btn-grd-warning');
    typeActionProfitReport = 5;
    timeActionProfitReport = $('#calendar-year').val();
    updateCookieProfitReportData();
    loadData();
});
$('#btn-3year').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-3year').addClass('btn-grd-warning');
    typeActionProfitReport = 6;
    timeActionProfitReport = moment().format('YYYY');
    updateCookieProfitReportData();
    loadData();
});
$('#btn-allyear').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-allyear').addClass('btn-grd-warning');
    typeActionProfitReport = 7;
    timeActionProfitReport = moment($('#change_branch').find(':selected').data('created'), 'DD/MM/YYYY HH:mm').clone().format('YYYY');
    updateCookieProfitReportData();
    loadData();
});

// Show-hide value chart
$(document).on('change', '#label-chart', function () {
    if ($(this).is(':checked')) {
        $('#chart-profit-report-vertical .amcharts-graph-column text').removeClass('d-none');
        $('#chart-profit-report-horizontal .amcharts-graph-column text').removeClass('d-none');
    } else {
        $('#chart-profit-report-vertical .amcharts-graph-column text').addClass('d-none');
        $('#chart-profit-report-horizontal .amcharts-graph-column text').addClass('d-none');
    }
});

// Change chart
$(document).on('click', '#chart_vertical', function () {
    $('#chart-profit-report-vertical').removeClass('d-none');
    $('#chart-profit-report-horizontal').addClass('d-none');
    $('#label-chart').prop('checked', true);
});

$(document).on('click', '#chart_horizontal', function () {
    $('#chart-profit-report-vertical').addClass('d-none');
    $('#chart-profit-report-horizontal').removeClass('d-none');
    $('#label-chart').prop('checked', true);
});
