let typeFilterProfitLossReport, timeFilterProfitLossReport , formDateProfitLoss , toDateProfitLoss;
typeFilterProfitLossReport = $('#select-type-profit-loss-report select').find('option:selected').val();
timeFilterProfitLossReport = $('#select-type-profit-loss-report select').find('option:selected').data('time');

/**
 * Event
 */
$('#select-type-profit-loss-report select').on('change', function () {
    loadDataProfitLossReport = 0;
    typeFilterProfitLossReport = $(this).val();
    timeFilterProfitLossReport = $(this).find('option:selected').data('time');
    switch (Number($(this).val())){
        case 13:
            formDateProfitLoss = $(this).parents('.filter-dashboard-report').find('.from-day-filter-time-report').val();
            toDateProfitLoss = $(this).parents('.filter-dashboard-report').find('.to-day-filter-time-report').val();
            break;
        case 15:
            formDateProfitLoss = $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-report').val();
            toDateProfitLoss = $(this).parents('.filter-dashboard-report').find('.to-month-filter-time-report').val();
            break;
        case 16:
            formDateProfitLoss = $(this).parents('.filter-dashboard-report').find('.from-year-filter-time-report').val();
            toDateProfitLoss = $(this).parents('.filter-dashboard-report').find('.to-year-filter-time-report').val();
            break;
        default:
            formDateProfitLoss = "";
            toDateProfitLoss = "" ;
    }
    dataProfitLossReport();
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-profit-loss-report'), $('#select-type-profit-loss-report select'))
});
getTimeChangeSelectTypeDashboardReport($('#text-label-type-profit-loss-report'), $('#select-type-profit-loss-report'))

$('#select-time-profit-loss-report .search-date-filter-time-bar').on('click', function () {
    reloadProfitLossReport();
})

function dataProfitLossReport() {
    $('.chart-profit-loss-report-loading').remove();
    if (loadDataProfitLossReport === 1) return false;
    loadDataProfitLossReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        type = $('#select-type-profit-food-report').val(),
        time = $('#select-type-profit-food-report').find(':selected').data('time');
    $('#chart-profit-loss-report').prepend(themeLoading($('#chart-profit-loss-report').height(), 'chart-profit-loss-report-loading'))
    axios({
        method: 'get',
        url: 'branch-dashboard.data-profit-loss-report',
        params: {brand: brand, branch: branch, type: type, time: time}
    }).then(function (res) {
        console.log(res);
        chartPieProfitLossEchartTemplate(res['data'][0], 'chart-profit-loss-report')
        $('.chart-profit-loss-report-loading').remove();

        if(res.data[1] === 0){
            $('#chart-profit-loss-report-empty').removeClass('d-none');
            $('#chart-profit-loss-report').addClass('d-none');
        } else {
            $('#chart-profit-loss-report-empty').addClass('d-none');
            $('#chart-profit-loss-report').removeClass('d-none');
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
            orient: 'vertical',
            left: 'right',
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
                    show: true
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
