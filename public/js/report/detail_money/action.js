$('#btn-day').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#day').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-day').addClass('btn-grd-warning');
    typeActionDetailMoneyReport = 1;
    timeActionDetailMoneyReport = $('#calendar-day').val();
    loadingData();
});
$('#btn-week').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#week').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-week').addClass('btn-grd-warning');
    typeActionDetailMoneyReport = 2;
    timeActionDetailMoneyReport = moment().format('WW/YYYY');
    loadingData();
});
$('#btn-month').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#month').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-month').addClass('btn-grd-warning');
    typeActionDetailMoneyReport = 3;
    timeActionDetailMoneyReport = $('#calendar-month').val();
    loadingData();
});
$('#btn-3month').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-3month').addClass('btn-grd-warning');
    typeActionDetailMoneyReport = 4;
    timeActionDetailMoneyReport = moment().format('MM/YYYY');
    loadingData();
});
$('#btn-year').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#year').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-year').addClass('btn-grd-warning');
    typeActionDetailMoneyReport = 5;
    timeActionDetailMoneyReport = $('#calendar-year').val();
    loadingData();
});
$('#btn-3year').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-3year').addClass('btn-grd-warning');
    typeActionDetailMoneyReport = 6;
    timeActionDetailMoneyReport = moment().format('YYYY');
    loadingData();
});
$('#btn-allyear').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-allyear').addClass('btn-grd-warning');
    typeActionDetailMoneyReport = 7;
    timeActionDetailMoneyReport = moment($('#change_branch').find(':selected').data('created'), 'DD/MM/YYYY HH:mm').clone().format('YYYY');
    loadingData();
});
