$('#btn-day').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#day').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-day').addClass('btn-grd-warning');
    typeActionEmployeeReport = 1;
    timeActionEmployeeReport = $('#calendar-day').val();
    loadData();
});
$('#btn-week').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#week').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-week').addClass('btn-grd-warning');
    typeActionEmployeeReport = 2;
    timeActionEmployeeReport = moment().format('WW/YYYY');
    loadData();
});
$('#btn-month').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#month').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-month').addClass('btn-grd-warning');
    typeActionEmployeeReport = 3;
    timeActionEmployeeReport = $('#calendar-month').val();
    loadData();
});
$('#btn-3month').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-3month').addClass('btn-grd-warning');
    typeActionEmployeeReport = 4;
    timeActionEmployeeReport = moment().format('MM/YYYY');
    loadData();
});
$('#btn-year').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#year').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-year').addClass('btn-grd-warning');
    typeActionEmployeeReport = 5;
    timeActionEmployeeReport = $('#calendar-year').val();
    loadData();
});
$('#btn-3year').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-3year').addClass('btn-grd-warning');
    typeActionEmployeeReport = 6;
    timeActionEmployeeReport = moment().format('YYYY');
    loadData();
});
$('#btn-allyear').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-allyear').addClass('btn-grd-warning');
    typeActionEmployeeReport = 7;
    timeActionEmployeeReport = moment().format('YYYY');
    loadData();
});

// Show-hide value chart
$(document).on('change', '#label-chart', function () {
    if ($(this).is(':checked')) {
        $('#chart-employee-report-vertical .amcharts-graph-column text').removeClass('d-none');
        $('#chart-employee-report-horizontal .amcharts-graph-column text').removeClass('d-none');
    } else {
        $('#chart-employee-report-vertical .amcharts-graph-column text').addClass('d-none');
        $('#chart-employee-report-horizontal .amcharts-graph-column text').addClass('d-none');
    }
});

// Change chart
$(document).on('click', '#chart_vertical', function () {
    $('#chart-employee-report-vertical').removeClass('d-none');
    $('#chart-employee-report-horizontal').addClass('d-none');
    $('#label-chart').prop('checked', true);
});

$(document).on('click', '#chart_horizontal', function () {
    $('#chart-employee-report-vertical').addClass('d-none');
    $('#chart-employee-report-horizontal').removeClass('d-none');
    $('#label-chart').prop('checked', true);
});
