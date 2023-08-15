$('#btn-month').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#month').removeClass('d-none');
    $('.btn-edit-display').addClass('btn-outline-warning');
    $('#btn-month').removeClass('btn-outline-warning');
    typeActionBusinessResult = 3;
    timeActionBusinessResult = $('#calendar-month').val();
    indexActionBusinessResult = moment($('#calendar-month').val(), 'MM/YYYY').clone().endOf('month').format('DD');
    loadData();
});
$('#btn-year').on('click', function () {
    $('.add-display').addClass('d-none');
    $('#year').removeClass('d-none');
    $('.btn-edit-display').addClass('btn-outline-warning');
    $('#btn-year').removeClass('btn-outline-warning');
    typeActionBusinessResult = 5;
    timeActionBusinessResult = $('#calendar-year').val();
    indexActionBusinessResult = 12;
    loadData();
});

$(document).on('change', '.label-chart-business-result', function () {
    if ($(this).is(':checked')) {
        $(this).parents('.card-shadow-custom-2').find('.amcharts-graph-column text').removeClass('d-none');
    } else {
        $(this).parents('.card-shadow-custom-2').find('.amcharts-graph-column text').addClass('d-none');
    }
});

// Change chart
$(document).on('click', '#chart_vertical', function () {
    $('#chart-business-results-report-vertical').removeClass('d-none');
    $('#chart-business-results-report-horizontal').addClass('d-none');
    $('#label-chart').prop('checked', true);
});

$(document).on('click', '#chart_horizontal', function () {
    $('#chart-business-results-report-vertical').addClass('d-none');
    $('#chart-business-results-report-horizontal').removeClass('d-none');
    $('#label-chart').prop('checked', true);
});
