$('#btn-day').on('click', function () {
    if ($(this).hasClass('btn-grd-warning')) return false;
    $('.add-display').addClass('d-none');
    $('#day').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-day').addClass('btn-grd-warning');
    typeTimeSellFoodReport = 1;
    timeSellFoodReportV2 = $('#calendar-day-food').val();
    loadData();
});

$('#btn-week').on('click', function () {
    if ($(this).hasClass('btn-grd-warning')) return false;
    $('.add-display').addClass('d-none');
    $('#week').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-week').addClass('btn-grd-warning');
    typeTimeSellFoodReport = 2;
    timeSellFoodReportV2 = moment().format('WW/YYYY');
    loadData();
});

$('#btn-month').on('click', function () {
    if ($(this).hasClass('btn-grd-warning')) return false;
    $('.add-display').addClass('d-none');
    $('#month').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-month').addClass('btn-grd-warning');
    typeTimeSellFoodReport = 3;
    timeSellFoodReportV2 = $('#calendar-month-food').val();
    loadData();
});

$('#btn-3month').on('click', function () {
    if ($(this).hasClass('btn-grd-warning')) return false;
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-3month').addClass('btn-grd-warning');
    typeTimeSellFoodReport = 4;
    timeSellFoodReportV2 = moment().format('MM/YYYY');
    loadData();
});

$('#btn-year').on('click', function () {
    if ($(this).hasClass('btn-grd-warning')) return false;
    $('.add-display').addClass('d-none');
    $('#year').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-year').addClass('btn-grd-warning');
    typeTimeSellFoodReport = 5;
    timeSellFoodReportV2 = $('#calendar-year-food').val();
    loadData();
});

$('#btn-3year').on('click', function () {
    if ($(this).hasClass('btn-grd-warning')) return false;
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-3year').addClass('btn-grd-warning');
    typeTimeSellFoodReport = 6;
    timeSellFoodReportV2 = moment().format('YYYY');
    loadData();
});

$('#btn-allyear').on('click', function () {
    if ($(this).hasClass('btn-grd-warning')) return false;
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-allyear').addClass('btn-grd-warning');
    typeTimeSellFoodReport = 8;
    timeSellFoodReportV2 = moment().format('YYYY');
    loadData();
});
