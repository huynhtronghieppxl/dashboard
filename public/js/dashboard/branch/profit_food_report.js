let chartProfitFood,chartProfitFoodDrink ;
chartProfitFood = chartColumnEchart('chart-vertical-food-profit-food-report')
chartProfitFoodDrink = chartColumnEchart('chart-vertical-drink-profit-food-report')
/**
 * Event
 */
$('#select-type-profit-food-report').on('change', function () {
    loadDataProfitFoodReport = 0;
    dataProfitFoodReport();
});

/**
 * Call data
 * @returns {Promise<void>}
 */
function dataProfitFoodReport() {
    $('.chart-vertical-food-profit-food-report-loading').remove();
    $('.chart-horizontal-food-profit-food-report-loading').remove();
    $('.chart-vertical-drink-profit-food-report-loading').remove();
    $('.chart-horizontal-drink-profit-food-report-loading').remove();
    if (loadDataProfitFoodReport === 1) return false;
    loadDataProfitFoodReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        type = $('#select-type-profit-food-report').val(),
        time = $('#select-type-profit-food-report').find(':selected').data('time');
    $('#chart-vertical-food-profit-food-report').prepend(themeLoading($('#chart-vertical-food-profit-food-report').height(), 'chart-vertical-food-profit-food-report-loading'))
    $('#chart-horizontal-food-profit-food-report').prepend(themeLoading($('#chart-horizontal-food-profit-food-report').height(), 'chart-horizontal-food-profit-food-report-loading'))
    $('#chart-vertical-drink-profit-food-report').prepend(themeLoading($('#chart-vertical-drink-profit-food-report').height(), 'chart-vertical-drink-profit-food-report-loading'))
    $('#chart-horizontal-drink-profit-food-report').prepend(themeLoading($('#chart-horizontal-drink-profit-food-report').height(), 'chart-horizontal-drink-profit-food-report-loading'))

    axios({
        method: 'get',
        url: 'branch-dashboard.data-profit-food-report',
        params: {brand: brand, branch: branch, type: type, time: time}
    }).then(function (res) {
        console.log(res);
        let element1 = 'chart-vertical-food-profit-food-report';
        let element2 = 'chart-horizontal-food-profit-food-report';
        let element3 = 'chart-vertical-drink-profit-food-report';
        let element4 = 'chart-horizontal-drink-profit-food-report';
        let titleX = $('#title-money-chart-component').val();
        let unit = $('#unit-money-chart-component').val();
        if (res.data[0].length > 50) {
            $('#chart-vertical-food-profit-food-report').attr('style', 'width:' + res.data[0].length * 20 + 'px; min-width: 100%');
            $('#chart-horizontal-food-profit-food-report').attr('style', 'height:' + res.data[0].length * 15 + 'px; min-height: 400px');
        } else {
            $('#chart-vertical-food-profit-food-report').attr('style', false);
            $('#chart-horizontal-food-profit-food-report').attr('style', false);
        }
        if (res.data[1].length > 50) {
            $('#chart-vertical-drink-profit-food-report').attr('style', 'width:' + res.data[1].length * 20 + 'px; min-width: 100%');
            $('#chart-horizontal-drink-profit-food-report').attr('style', 'height:' + res.data[1].length * 15 + 'px; min-height: 400px');
        } else {
            $('#chart-vertical-drink-profit-food-report').attr('style', false);
            $('#chart-horizontal-drink-profit-food-report').attr('style', false);
        }
        updateChartColumnEchart(chartProfitFood, res.data[0]);
        updateChartColumnEchart(chartProfitFoodDrink, res.data[1]);

        // chartColumnHorizontalTemplate(res.data[1], element4, titleX, unit, color);
        $('#total-food-profit-food-report').text(res.data[2].total_food);
        $('#total-drink-profit-food-report').text(res.data[2].total_drink);
        $('.chart-vertical-food-profit-food-report-loading').remove();
        $('.chart-horizontal-food-profit-food-report-loading').remove();
        $('.chart-vertical-drink-profit-food-report-loading').remove();
        $('.chart-horizontal-drink-profit-food-report-loading').remove();
    }).catch(function (e) {
        console.log(e);
    });
}

/**
 * Reload Data
 */
function reloadProfitFoodReport() {
    loadDataProfitFoodReport = 0;
    dataProfitFoodReport();
}
