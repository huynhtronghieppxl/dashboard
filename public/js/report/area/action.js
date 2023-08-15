$('#btn-day').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#day').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-day').addClass('btn-grd-warning');
    typeActionAreaReport = 1;
    timeActionAreaReport = $('#calendar-day').val();
    loadData();
});
$('#btn-week').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#week').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-week').addClass('btn-grd-warning');
    typeActionAreaReport = 2;
    timeActionAreaReport = moment().format('WW/YYYY');
    loadData();
});
$('#btn-month').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#month').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-month').addClass('btn-grd-warning');
    typeActionAreaReport = 3;
    timeActionAreaReport = $('#calendar-month').val();
    loadData();
});
$('#btn-3month').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-3month').addClass('btn-grd-warning');
    typeActionAreaReport = 4;
    timeActionAreaReport = moment().format('MM/YYYY');
    loadData();
});
$('#btn-year').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#year').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-year').addClass('btn-grd-warning');
    typeActionAreaReport = 5;
    timeActionAreaReport = $('#calendar-year').val();
    loadData();
});
$('#btn-3year').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-3year').addClass('btn-grd-warning');
    typeActionAreaReport = 6;
    timeActionAreaReport = moment().format('YYYY');
    loadData();
});
$('#btn-allyear').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-allyear').addClass('btn-grd-warning');
    typeActionAreaReport = 7;
    timeActionAreaReport = moment($('#change_branch').find(':selected').data('created'), 'DD/MM/YYYY HH:mm').clone().format('YYYY');
    loadData();
});

// Show-hide value chart
$(document).on('change', '#label-chart', function () {
    if ($(this).is(':checked')) {
        $('#chart-area-report-vertical .amcharts-graph-column text').removeClass('d-none');
        $('#chart-area-report-horizontal .amcharts-graph-column text').removeClass('d-none');
    } else {
        $('#chart-area-report-vertical .amcharts-graph-column text').addClass('d-none');
        $('#chart-area-report-horizontal .amcharts-graph-column text').addClass('d-none');
    }
});

// Change chart
$(document).on('click', '#chart_vertical', function () {
    $('#chart-area-report-vertical').removeClass('d-none');
    $('#chart-area-report-horizontal').addClass('d-none');
    $('#label-chart').prop('checked', true);
});

$(document).on('click', '#chart_horizontal', function () {
    $('#chart-area-report-vertical').addClass('d-none');
    $('#chart-area-report-horizontal').removeClass('d-none');
    $('#label-chart').prop('checked', true);
});
