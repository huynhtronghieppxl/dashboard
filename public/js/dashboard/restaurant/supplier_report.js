/**
 * Event
 */
$('#select-type-supplier-report').on('change', function () {
    load_data2 = 0;
    dataSupplierReport();
});
$('#label-chart-supplier-report').on('change', function () {
    if ($(this).is(':checked')) {
        $('#chart-vertical-supplier-report .amcharts-graph-column text').removeClass('d-none');
        $('#chart-horizontal-supplier-report .amcharts-graph-column text').removeClass('d-none');
    } else {
        $('#chart-vertical-supplier-report .amcharts-graph-column text').addClass('d-none');
        $('#chart-horizontal-supplier-report .amcharts-graph-column text').addClass('d-none');
    }
});
$('#show-vertical-supplier-report').on('click', function () {
    $('#chart-vertical-supplier-report').removeClass('d-none');
    $('#chart-horizontal-supplier-report').addClass('d-none');
    $('#label-chart-supplier-report').prop('checked', true);
});
$('#show-horizontal-supplier-report').on('click', function () {
    $('#chart-vertical-supplier-report').addClass('d-none');
    $('#chart-horizontal-supplier-report').removeClass('d-none');
    $('#label-chart-supplier-report').prop('checked', true);
});

/**
 * Call data
 * @returns {Promise<void>}
 */
function dataSupplierReport() {
    if (load_data2 === 1) return false;
    load_data2 = 1;
    let brand = $('#restaurant-branch-id-selected span').attr('data-value'),
        branch = $('#change_branch').val(),
        type = $('#select-type-supplier-report').val(),
        time = $('#select-type-supplier-report').find(':selected').data('time');
    axios({
        method: 'get',
        url: 'restaurant-dashboard.data-supplier-report',
        params: {brand: brand, branch: branch, type: type, time: time}
    }).then(function (res) {
        console.log(res);
        let element1 = 'chart-vertical-supplier-report';
        let element2 = 'chart-horizontal-supplier-report';
        let titleX = $('#title-money-chart-component').val();
        let unit = $('#unit-money-chart-component').val();
        if (res.data[2].length > 50) {
            $('#chart-vertical-supplier-report').attr('style', 'width:' + res.data[0].length * 20 + 'px; min-width: 100%');
            $('#chart-horizontal-supplier-report').attr('style', 'height:' + res.data[0].length * 15 + 'px; min-height: 400px');
        } else {
            $('#chart-vertical-supplier-report').attr('style', false);
            $('#chart-horizontal-supplier-report').attr('style', false);
        }
        let color = "#0072bc";
        chartColumnVerticalTemplate(res.data[0], element1, titleX, unit, color);
        chartColumnHorizontalTemplate(res.data[0], element2, titleX, unit, color);
        $('#total-supplier-report').text(res.data[1].total);
    }).catch(function (e) {
        console.log(e);
    });
}

/**
 * Reload Data
 */
function reloadSupplierReport() {
    load_data2 = 0;
    dataSupplierReport();
}

