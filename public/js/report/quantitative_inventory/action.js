// Event Change Data
$('#btn-day').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#day').removeClass('d-none');
    $('.btn-edit-display').addClass('btn-outline-warning');
    $('#btn-day').removeClass('btn-outline-warning');
});
$('#btn-week').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').addClass('btn-outline-warning');
    $('#btn-week').removeClass('btn-outline-warning');
});
$('#btn-month').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#month').removeClass('d-none');
    $('.btn-edit-display').addClass('btn-outline-warning');
    $('#btn-month').removeClass('btn-outline-warning');
});
$('#btn-3month').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').addClass('btn-outline-warning');
    $('#btn-3month').removeClass('btn-outline-warning');
});
$('#btn-year').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#year').removeClass('d-none');
    $('.btn-edit-display').addClass('btn-outline-warning');
    $('#btn-year').removeClass('btn-outline-warning');
});
$('#btn-3year').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').addClass('btn-outline-warning');
    $('#btn-3year').removeClass('btn-outline-warning');
});
$('#btn-allyear').on('click', function () {
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').addClass('btn-outline-warning');
    $('#btn-allyear').removeClass('btn-outline-warning');
});

// Event Call Data
$('#btn-week').on('click', function () {
    let type = 2;
    let time = $('#calendar-day').val();
    $('#type').val(type);
    $('#time').val(time);
    loadData();
});

$('#btn-day').on('click', function () {
    let type = 1;
    var time = moment().format('DD/MM/YYYY');
    $('#type').val(type);
    $('#time').val(time);
    loadData();
});

$('#btn-month').on('click', function () {
    let type = 3;
    let time = moment().format('MM/YYYY');
    $('#type').val(type);
    $('#time').val(time);
    loadData();
});

$('#btn-year').on('click', function () {
    let type = 5;
    let time = $('#calendar-year').val();
    $('#type').val(type);
    $('#time').val(time);
    loadData();
});
$('#btn-3month').on('click', function () {
    let type = 4;
    $('#type').val(type);
    loadData();
});
$('#btn-3year').on('click', function () {
    let type = 6;
    $('#type').val(type);
    loadData();
});
$('#btn-allyear').on('click', function () {
    let type = 8;
    $('#type').val(type);
    loadData();
});
