$('#btn-day').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#day').removeClass('d-none');
    $('.btn-edit-display').addClass('btn-outline-warning');
    $('#btn-day').removeClass('btn-outline-warning');
    typeActionMaterialFoodReport = 1;
    timeActionMaterialFoodReport = $('#calendar-day').val();
    loadData();
});
$('#btn-week').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#week').removeClass('d-none');
    $('.btn-edit-display').addClass('btn-outline-warning');
    $('#btn-week').removeClass('btn-outline-warning');
    typeActionMaterialFoodReport = 2;
    timeActionMaterialFoodReport = moment().format('WW/YYYY');
    loadData();
});
$('#btn-month').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#month').removeClass('d-none');
    $('.btn-edit-display').addClass('btn-outline-warning');
    $('#btn-month').removeClass('btn-outline-warning');
    typeActionMaterialFoodReport = 3;
    timeActionMaterialFoodReport = $('#calendar-month').val();
    loadData();
});
$('#btn-3month').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').addClass('btn-outline-warning');
    $('#btn-3month').removeClass('btn-outline-warning');
    typeActionMaterialFoodReport = 4;
    timeActionMaterialFoodReport = moment().format('MM/YYYY');
    loadData();
});
$('#btn-year').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#year').removeClass('d-none');
    $('.btn-edit-display').addClass('btn-outline-warning');
    $('#btn-year').removeClass('btn-outline-warning');
    typeActionMaterialFoodReport = 5;
    timeActionMaterialFoodReport = $('#calendar-year').val();
    loadData();
});
$('#btn-3year').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').addClass('btn-outline-warning');
    $('#btn-3year').removeClass('btn-outline-warning');
    typeActionMaterialFoodReport = 6;
    timeActionMaterialFoodReport = moment().format('YYYY');
    loadData();
});
$('#btn-allyear').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').addClass('btn-outline-warning');
    $('#btn-allyear').removeClass('btn-outline-warning');
    typeActionMaterialFoodReport = -1;
    timeActionMaterialFoodReport = moment($('#change_branch').find(':selected').data('created'), 'DD/MM/YYYY HH:mm').clone().format('YYYY');
    loadData();
});
