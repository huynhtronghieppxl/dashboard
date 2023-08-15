let typeFilterProfitLossReport, timeFilterProfitLossReport , formDateProfitLoss , toDateProfitLoss;
typeFilterProfitLossReport = $('#select-type-point-report select').find('option:selected').val();
timeFilterProfitLossReport = $('#select-type-point-report select').find('option:selected').data('time');

/**
 * Event
 */
$('#select-type-profit-loss-report select').on('change', function () {
    loadDataProfitLossReport = 0;
    typeFilterProfitLossReport = $(this).val();
    timeFilterProfitLossReport = $(this).find('option:selected').data('time');
    switch (Number($(this).val())){
        case 13:
            formDateProfitLoss = $(this).parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toDateProfitLoss = $(this).parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            formDateProfitLoss = $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toDateProfitLoss = $(this).parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            formDateProfitLoss = $(this).parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toDateProfitLoss = $(this).parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            formDateProfitLoss = "";
            toDateProfitLoss = "" ;
    }
    dataProfitLossReport();
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-profit-loss-report'), $('#select-type-profit-loss-report select'))
});
getTimeChangeSelectTypeDashboardReport($('#text-label-type-profit-loss-report'), $('#select-type-profit-loss-report'))

$('#select-type-profit-loss-report .search-date-option-filter-time-bar').on('click', function () {
    detectDateOptionTimeProfitLoss(Number($('#select-type-profit-loss-report select').find('option:selected').val()))
    // if(!CheckDateFormTo(formDateProfitLoss, toDateProfitLoss)) return false
    if(!checkDashboardCustomDateTimePicker($(this), $('#select-type-profit-loss-report select'))) return false;
    reloadProfitLossReport();
})

function detectDateOptionTimeProfitLoss(type) {
    switch (type){
        case 13:
            formDateProfitLoss = $('#select-type-profit-loss-report select').parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toDateProfitLoss = $('#select-type-profit-loss-report select').parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            formDateProfitLoss = $('#select-type-profit-loss-report select').parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toDateProfitLoss = $('#select-type-profit-loss-report select').parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            formDateProfitLoss = $('#select-type-profit-loss-report select').parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toDateProfitLoss = $('#select-type-profit-loss-report select').parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            formDateProfitLoss = "";
            toDateProfitLoss = "" ;
    }
}
function dataProfitLossReport() {
    $('.chart-profit-loss-report-loading').remove();
    if (loadDataProfitLossReport === 1) return false;
    loadDataProfitLossReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        type = $('#select-type-profit-loss-report select').val(),
        time = $('#select-type-profit-loss-report select').find(':selected').data('time');
    $('#chart-profit-loss-report').prepend(themeLoading($('#chart-profit-loss-report').height(), 'chart-profit-loss-report-loading'))
    $('#rate-revenue-profit-loss-report').prepend(themeLoading($('#rate-revenue-profit-loss-report').height(), 'chart-profit-loss-report-loading'))
    $('#rate-cost-profit-lost-report').prepend(themeLoading($('#rate-cost-profit-lost-report').height(), 'chart-profit-loss-report-loading'))
    $('#chart-cost-P-l-report').prepend(themeLoading($('#chart-cost-P-l-report').height(), 'chart-profit-loss-report-loading'))
    axios({
        method: 'get',
        url: 'branch-dashboard.data-profit-loss-report',
        params: {brand: brand, branch: branch, type: type, time: time, from: formDateProfitLoss, to: toDateProfitLoss}
    }).then(function (res) {
        console.log(res);
        chartPieProfitLossEchartTemplate(res['data'][0], 'chart-profit-loss-report')
        chartPieProfitLossEchartTemplate(res['data'][2], 'chart-profit-P-l-report')
        chartPieProfitLossEchartTemplate(res['data'][3], 'chart-cost-P-l-report')
        // $('#total-profit-P-l-report').text(formatNumber(res['data'][6]['total_profit']))
        $('#rate-revenue-profit-loss-report').html(res['data'][4])
        $('#rate-cost-profit-lost-report').html(res['data'][5])
        $('.chart-profit-loss-report-loading').remove();
        // $('#total-profit-P-l-report').text(formatNumber(res['data'][3]['total_profit']))

        if(res.data[1] === 0){
            $('#chart-profit-loss-report-empty').removeClass('d-none');
            $('#chart-profit-loss-report').addClass('d-none');
            $('#chart-profit-P-l-report-empty').removeClass('d-none');
            $('#chart-profit-P-l-report').addClass('d-none');
            $('#chart-cost-P-l-report-empty').removeClass('d-none');
            $('#chart-cost-P-l-report').addClass('d-none');
        } else {
            $('#chart-profit-loss-report-empty').addClass('d-none');
            $('#chart-profit-loss-report').removeClass('d-none');
            $('#chart-profit-P-l-report-empty').addClass('d-none');
            $('#chart-profit-P-l-report').removeClass('d-none');
            $('#chart-cost-P-l-report-empty').addClass('d-none');
            $('#chart-cost-P-l-report-report').removeClass('d-none');
        }
    }).catch(function (e) {
        console.log(e);
    });
}


function chartPieProfitLossEchartTemplate(data, element) {
    if (data === [] || data === null) {
        $('#' + element).html(
            "<div class='empty-datatable-custom center-loading'><img src='../../../../files/assets/images/nodata-datatable2.png'></div>"
        );
        return false;
    }
    let chartDom = document.getElementById(element);
    let myChart = echarts.init(chartDom);
    let option = {
        tooltip: {
            trigger: 'item',
        },
        legend: {
            // orient: 'vertical',
            top: 'bottom',
            type: 'scroll',
            formatter: function (name){
                let series = myChart.getOption().series[0];
                let value = series.data.filter(row => row.name === name)[0].value
                return name + ':  (' + formatNumber(value) + ')';
            },
            textStyle: {
                fontWeight: "normal"
            }
        },
        series: [
            {
                type: 'pie',
                radius: '50%',
                data: data,
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                },
                avoidLabelOverlap: false,
                label: {
                    show: true,
                    formatter: '{b} ({d}%)'
                },
                labelLine: {
                    minTurnAngle: 30,
                    length: 20,
                },
            },
        ]
    };
    option && myChart.setOption(option);
    myChart.resize();
    $(window).on('resize', function (){
        myChart.resize();
    });
}


function reloadProfitLossReport(){
    loadDataProfitLossReport = 0;
    dataProfitLossReport();
}
