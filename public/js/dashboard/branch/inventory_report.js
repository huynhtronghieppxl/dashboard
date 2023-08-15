let typeFilterInventoryReport, timeFilterInventoryReport , fromFilterInventoryReport, toFilterInventoryReport;
typeFilterInventoryReport = $('#select-type-inventory-report select').find('option:selected').val();
timeFilterInventoryReport = $('#select-type-inventory-report select').find('option:selected').data('time');

/**
 * Event
 */
$('#select-type-inventory-report select').on('change', function () {
    loadDataInventoryReport = 0;
    typeFilterInventoryReport = $(this).val();
    timeFilterInventoryReport = $(this).find('option:selected').data('time');
    switch (Number($(this).val())){
        case 13:
            fromFilterInventoryReport = $(this).parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterInventoryReport = $(this).parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            fromFilterInventoryReport = $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterInventoryReport = $(this).parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            fromFilterInventoryReport = $(this).parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterInventoryReport = $(this).parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            fromFilterInventoryReport = "";
            toFilterInventoryReport = "" ;
    }
    dataInventoryReport();
});


$('#select-type-inventory-report .search-date-option-filter-time-bar').on('click', function () {
    detectDateOptionTimeInventory(Number($('#select-type-inventory-report select').find('option:selected').val()))
    // if(!CheckDateFormTo(fromFilterInventoryReport, toFilterInventoryReport)) return false
    if(!checkDashboardCustomDateTimePicker($(this), $('#select-type-inventory-report select'))) return false;
    reloadInventoryReport()
})

function detectDateOptionTimeInventory(type) {
    switch (type){
        case 13:
            fromFilterInventoryReport = $('.search-date-option-filter-time-bar').parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterInventoryReport = $('.search-date-option-filter-time-bar').parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            fromFilterInventoryReport = $('.search-date-option-filter-time-bar').parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterInventoryReport = $('.search-date-option-filter-time-bar').parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            fromFilterInventoryReport = $('.search-date-option-filter-time-bar').parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterInventoryReport = $('.search-date-option-filter-time-bar').parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            fromFilterInventoryReport = "";
            toFilterInventoryReport = "" ;
    }
}

/**
 * Call data
 * @returns {Promise<void>}
 */
function dataInventoryReport() {
    if (loadDataInventoryReport === 1) return false;
    loadDataInventoryReport = 1;
    $('.loading-in-inventory-report-loading').remove();
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val();
    $('.revenue-content-group-sub').prepend(themeLoading(50, 'loading-in-inventory-report-loading'))
    axios({
        method: 'get',
        url: 'branch-dashboard.data-inventory-report',
        params: {brand : brand , branch: branch, type: typeFilterInventoryReport , from: fromFilterInventoryReport , to : toFilterInventoryReport , time : timeFilterInventoryReport}
    }).then(function (res) {
        console.log(res);
        $('#total-all-in-inventory-report').text(formatNumber(res.data[4].total_price));
        $('#total-material-in-inventory-report').text(formatNumber(res.data[6].total_in_material));
        $('#total-internal-in-inventory-report').text(formatNumber(res.data[6].total_in_internal));
        $('#total-goods-in-inventory-report').text(formatNumber(res.data[6].total_in_goods));
        $('#total-other-in-inventory-report').text(formatNumber(res.data[6].total_in_other));


        $('#total-main-material-in-inventory-report').text(res.data[0][0].total_price);
        $('#total-sub-material-in-inventory-report').text(res.data[0][1].total_price);
        $('#total-sub-material-in-inventory-report-other').text(res.data[0][2].total_price);

        $('#total-internal-internal-in-inventory-report').text(res.data[3][0].total_price);
        $('#total-sub-material-in-inventory-report-internal-other').text(res.data[3][1].total_price);


        $('#total-food-goods-in-inventory-report').text(res.data[1][0].total_price);
        $('#total-drink-goods-in-inventory-report').text(res.data[1][1].total_price);
        $('#total-produce-goods-in-inventory-report').text(res.data[1][2].total_price);
        $('#total-sub-material-in-inventory-report-goods-other').text(res.data[1][3].total_price);


        $('#total-indirect-other-in-inventory-report').text(res.data[2][0].total_price);
        $('#total-other-other-in-inventory-report').text(res.data[2][1].total_price);
        $('#total-stationery-other-in-inventory-report').text(res.data[2][2].total_price);
        $('#total-chemistry-other-in-inventory-report').text(res.data[2][3].total_price);
        $('#total-tool-other-in-inventory-report').text(res.data[2][4].total_price);
        $('#total-ice-other-in-inventory-report').text(res.data[2][5].total_price);
        $('#total-fuel-other-in-inventory-report').text(res.data[2][6].total_price);
        $('#total-other-food-packaging-in-inventory-report').text(res.data[2][7].total_price);
        $('#total-other-decorative-items-in-inventory-report').text(res.data[2][8].total_price);


        $('.loading-in-inventory-report-loading').remove();
    }).catch(function (e) {
        console.log(e);
        $('.loading-in-inventory-report-loading').remove();
    });
}

/**
 * Reload Data
 */
function reloadInventoryReport() {
    loadDataInventoryReport = 0;
    dataInventoryReport();
}
