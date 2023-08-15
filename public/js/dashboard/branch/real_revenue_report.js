/**
 * Event
 */
$('#select-type-real-revenue-report').on('change', function () {
    dataRealRevenueReport();
});

/**
 * Call data
 * @returns {Promise<void>}
 */
async function dataRealRevenueReport() {
    let method = 'get',
        type = $('#select-type-real-revenue-report').val(),
        branch = $('.select-branch').val(),
        url = 'branch-dashboard.data-real-revenue-report',
        params = {type: type, branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#total-real-revenue-report').text(res.data[0].total);
    $('#total-real-revenue-report').text(res.data[0].office);
    $('#total-real-revenue-report').text(res.data[0].debt);
}

/**
 * Reload Data
 */
function reloadRealRevenueReport() {
    dataRealRevenueReport();
}
