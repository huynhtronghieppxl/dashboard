/**
 * Event
 */
$('#select-type-real-profit-report').on('change', function () {
    loadDataRealProfitReport = 0;
    // dataRealProfitReport();
});

/**
 * Call data
 * @returns {Promise<void>}
 */
async function dataRealProfitReport() {
    if (loadDataRealProfitReport === 1) return false;
    loadDataRealProfitReport = 1;
    let brand = $('#restaurant-branch-id-selected span').attr('data-value'),
        type = $('#select-type-real-profit-report').val(),
        time = $('#select-type-real-profit-report').find(':selected').data('time');
    $('.loading-real-profit-report-loading').remove();
    $('.loading-real-profit-report').prepend(themeLoading($('.loading-real-profit-report').height(), 'loading-real-profit-report-loading'))

    axios({
        method: 'get',
        url: 'restaurant-dashboard.data-real-profit-report',
        params: {
            brand: brand,
            type: type,
            time: time
        }
    }).then(function (res) {
        console.log(res);
        $('#total-real-profit-report').text(res.data[0].current_profit);
        $('#profit-real-profit-report').text(res.data[0].profit);
        $('#debt-real-profit-report').text(res.data[0].debt);
        $('.loading-real-profit-report-loading').remove();
    }).catch(function (e) {
        console.log(e);
    });
}

/**
 * Reload Data
 */
function reloadRealProfitReport() {
    loadDataRealProfitReport = 0;
    // dataRealProfitReport();
}
