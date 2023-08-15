// Event Change Data
$('#btn-day').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#day').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-day').addClass('btn-grd-warning');
    let typeActionHistoryPoint = 1;
    let timeActionHistoryPoint = moment().format('DD/MM/YYYY');
    $('#type').val(typeActionHistoryPoint);
    $('#time').val(timeActionHistoryPoint);
    $('#calendar-day').val(timeActionHistoryPoint);
    loadData();
});
$('#btn-week').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-week').addClass('btn-grd-warning');
    let typeActionHistoryPoint = 2;
    $('#type').val(typeActionHistoryPoint);
    loadData();
});
$('#btn-month').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#month').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-month').addClass('btn-grd-warning');
    let typeActionHistoryPoint = 3;
    let timeActionHistoryPoint = moment().format('MM/YYYY');
    $('#type').val(typeActionHistoryPoint);
    $('#time').val(timeActionHistoryPoint);
    $('#calendar-month').val(timeActionHistoryPoint);
    loadData();
});
$('#btn-3month').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-3month').addClass('btn-grd-warning');
    let typeActionHistoryPoint = 4;
    $('#type').val(typeActionHistoryPoint);
    loadData();
});
$('#btn-year').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#year').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-year').addClass('btn-grd-warning');
    let typeActionHistoryPoint = 5;
    let timeActionHistoryPoint = moment().format('YYYY');
    $('#type').val(typeActionHistoryPoint);
    $('#time').val(timeActionHistoryPoint);
    $('#calendar-year').val(timeActionHistoryPoint);
    loadData();
});
$('#btn-3year').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-3year').addClass('btn-grd-warning');
    let typeActionHistoryPoint = 6;
    let timeActionHistoryPoint = $('#calendar-year').val();
    $('#type').val(typeActionHistoryPoint);
    $('#time').val(timeActionHistoryPoint);
    loadData();
});
$('#btn-allyear').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-allyear').addClass('btn-grd-warning');
    let typeActionHistoryPoint = 8;
    let timeActionHistoryPoint = $('#calendar-year').val();
    $('#type').val(typeActionHistoryPoint);
    $('#time').val(timeActionHistoryPoint);
    loadData();
});
