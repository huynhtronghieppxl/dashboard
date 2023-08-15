$('#btn-day').on('click', function () {
    if($(this).hasClass('btn-grd-warning')) return false;
    $('.add-display').addClass('d-none');
    $('#day').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-day').addClass('btn-grd-warning');
    typeActionRevenueReport = 1;
    timeActionRevenueReport = $('#calendar-day').val();
    fromDateRevenueReport = '';
    toDateRevenueReport = '';

    loadData();
});
$('#btn-week').on('click', function () {
    if($(this).hasClass('btn-grd-warning')) return false;
    $('.add-display').addClass('d-none');
    $('#week').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-week').addClass('btn-grd-warning');
    typeActionRevenueReport = 2;
    timeActionRevenueReport = moment().format('WW/YYYY');
    fromDateRevenueReport = '';
    toDateRevenueReport = '';
    updateRevenueReport();
    loadData();
});
$('#btn-month').on('click', function () {
    if($(this).hasClass('btn-grd-warning')) return false;
    $('.add-display').addClass('d-none');
    $('#month').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-month').addClass('btn-grd-warning');
    typeActionRevenueReport = 3;
    timeActionRevenueReport = $('#calendar-month').val();
    fromDateRevenueReport = '';
    toDateRevenueReport = '';
    updateRevenueReport();
    loadData();
});
$('#btn-3month').on('click', function () {
    if($(this).hasClass('btn-grd-warning')) return false;
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-3month').addClass('btn-grd-warning');
    typeActionRevenueReport = 4;
    timeActionRevenueReport = moment().format('MM/YYYY');
    fromDateRevenueReport = '';
    toDateRevenueReport = '';
    updateRevenueReport();
    loadData();
});
$('#btn-year').on('click', function () {
    if($(this).hasClass('btn-grd-warning')) return false;
    $('.add-display').addClass('d-none');
    $('#year').removeClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-year').addClass('btn-grd-warning');
    typeActionRevenueReport = 5;
    timeActionRevenueReport = $('#calendar-year').val();
    fromDateRevenueReport = '';
    toDateRevenueReport = '';
    loadData();
});
$('#btn-3year').on('click', function () {
    if($(this).hasClass('btn-grd-warning')) return false;
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-3year').addClass('btn-grd-warning');
    typeActionRevenueReport = 6;
    timeActionRevenueReport = moment().format('YYYY');
    fromDateRevenueReport = '';
    toDateRevenueReport = '';
    updateRevenueReport();
    loadData();
});
$('#btn-allyear').on('click', function () {
    if($(this).hasClass('btn-grd-warning')) return false;
    $('.add-display').addClass('d-none');
    $('.btn-edit-display').removeClass('btn-grd-warning');
    $('#btn-allyear').addClass('btn-grd-warning');
    typeActionRevenueReport = 8;
    timeActionRevenueReport = moment().format('YYYY');
    fromDateRevenueReport = '';
    toDateRevenueReport = '';
    updateRevenueReport();
    loadData();
});
