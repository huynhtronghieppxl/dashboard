$('#btn-day').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#day').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-day').addClass('btn-grd-warning');
    typeActionCostDebtReport = 1;
    timeActionCostDebtReport = $('#calendar-day').val();
    loadData();
});
$('#btn-week').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#week').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-week').addClass('btn-grd-warning');
    typeActionCostDebtReport = 2;
    timeActionCostDebtReport = moment().format('WW/YYYY');
    loadData();
});
$('#btn-month').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#month').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-month').addClass('btn-grd-warning');
    typeActionCostDebtReport = 3;
    timeActionCostDebtReport = $('#calendar-month').val();
    loadData();
});
$('#btn-3month').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-3month').addClass('btn-grd-warning');
    typeActionCostDebtReport = 4;
    timeActionCostDebtReport = moment().format('MM/YYYY');
    loadData();
});
$('#btn-year').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#year').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-year').addClass('btn-grd-warning');
    typeActionCostDebtReport = 5;
    timeActionCostDebtReport = $('#calendar-year').val();
    loadData();
});
$('#btn-3year').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-3year').addClass('btn-grd-warning');
    typeActionCostDebtReport = 6;
    timeActionCostDebtReport = moment().format('YYYY');
    loadData();
});
$('#btn-allyear').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-allyear').addClass('btn-grd-warning');
    typeActionCostDebtReport = 7;
    timeActionCostDebtReport = moment($('#change_branch').find(':selected').data('created'), 'DD/MM/YYYY HH:mm').clone().format('YYYY');
    loadData();
});
