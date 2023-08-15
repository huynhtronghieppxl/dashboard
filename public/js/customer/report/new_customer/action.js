// Event Change Data
$('#btn-day').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#day').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-day').addClass('btn-grd-warning');
    typeActionNewCustomerReport = 1;
    timeActionNewCustomerReport = moment().format('DD/MM/YYYY');
    $('#calendar-day').val(timeActionNewCustomerReport);
    loadData();
});
$('#btn-week').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-week').addClass('btn-grd-warning');
    typeActionNewCustomerReport = 2;
    $('#type').val(typeActionNewCustomerReport);
    loadData();
});
$('#btn-month').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#month').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-month').addClass('btn-grd-warning');
    typeActionNewCustomerReport = 3;
    timeActionNewCustomerReport = moment().format('MM/YYYY');
    $('#calendar-month').val(timeActionNewCustomerReport);
    loadData();
});
$('#btn-3month').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-3month').addClass('btn-grd-warning');
    typeActionNewCustomerReport = 4;
    $('#type').val(typeActionNewCustomerReport);
    loadData();
});
$('#btn-year').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#year').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-year').addClass('btn-grd-warning');
    typeActionNewCustomerReport = 5;
    timeActionNewCustomerReport = moment().format('YYYY');
    $('#calendar-year').val(timeActionNewCustomerReport);
    loadData();
});
$('#btn-3year').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-3year').addClass('btn-grd-warning');
    typeActionNewCustomerReport = 6;
    timeActionNewCustomerReport = $('#calendar-year').val();
    loadData();
});
$('#btn-allyear').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-allyear').addClass('btn-grd-warning');
    typeActionNewCustomerReport = 8;
    timeActionNewCustomerReport = $('#calendar-year').val();
    loadData();
});

// Show-hide value chart
$(document).on('change', '#label-chart', function () {
    if ($(this).is(':checked')) {
        $('.amcharts-graph-column text').removeClass('d-none');
    } else {
        $('.amcharts-graph-column text').addClass('d-none');
    }
});

// Change chart
$(document).on('click', '#chart_vertical', function () {
    $('#chart-new-customer-report-vertical').removeClass('d-none');
    $('#chart-new-customer-report-horizontal').addClass('d-none');
    $('#label-chart').prop('checked', true);
});

$(document).on('click', '#chart_horizontal', function () {
    $('#chart-new-customer-report-vertical').addClass('d-none');
    $('#chart-new-customer-report-horizontal').removeClass('d-none');
    $('#label-chart').prop('checked', true);
});
