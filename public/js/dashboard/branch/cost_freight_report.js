let typeFilterCostFreightReport, timeFilterCostFreightReport , formDateCostFreight , toDateCostFreight;
typeFilterCostFreightReport = $('#select-type-cost-freight-report select').find('option:selected').val();
timeFilterCostFreightReport = $('#select-type-cost-freight-report select').find('option:selected').data('time');

/**
 * Event
 */
$('#select-type-cost-freight-report select').on('change', function () {
    loadDataCostFreightReport = 0;
    typeFilterCostFreightReport = $(this).val();
    timeFilterCostFreightReport = $(this).find('option:selected').data('time');
    switch (Number($(this).val())){
        case 13:
            formDateCostFreight = $(this).parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toDateCostFreight = $(this).parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            formDateCostFreight = $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toDateCostFreight = $(this).parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            formDateCostFreight = $(this).parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toDateCostFreight = $(this).parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            formDateCostFreight = "";
            toDateCostFreight = "" ;
    }
    dataCostFreightReport();
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-cost-freight-report'), $('#select-type-cost-freight-report select'))
});
getTimeChangeSelectTypeDashboardReport($('#text-label-type-cost-freight-report'), $('#select-type-cost-freight-report'))

$('#select-type-cost-freight-report .search-date-option-filter-time-bar').on('click', function () {
    detectDateOptionTimeCostFreight(Number($('#select-type-cost-freight-report select').find('option:selected').val()))
    // if(!CheckDateFormTo(formDateCostFreight, toDateCostFreight)) return false
    if(!checkDashboardCustomDateTimePicker($(this), $('#select-type-cost-freight-report select'))) return false;
    reloadCostFreightReport();
})

function detectDateOptionTimeCostFreight(type) {
    switch (type){
        case 13:
            formDateCostFreight = $('#select-type-cost-freight-report select').parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toDateCostFreight = $('#select-type-cost-freight-report select').parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            formDateCostFreight = $('#select-type-cost-freight-report select').parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toDateCostFreight = $('#select-type-cost-freight-report select').parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            formDateCostFreight = $('#select-type-cost-freight-report select').parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toDateCostFreight = $('#select-type-cost-freight-report select').parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            formDateCostFreight = "";
            toDateCostFreight = "" ;
    }
}


function dataCostFreightReport() {
    $('.chart-cost-freight-report-loading').remove();
    if (loadDataCostFreightReport === 1) return false;
    loadDataCostFreightReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        type = $('#select-type-cost-freight-report select').find('option:selected').val(),
        time = $('#select-type-cost-freight-report select').find('option:selected').data('time');
    $('#chart-cost-freight-report').prepend(themeLoading($('#chart-cost-freight-report').height(), 'chart-cost-freight-report-loading'))
    axios({
        method: 'get',
        url: 'branch-dashboard.data-cost-freight-report',
        params: {brand: brand, branch: branch, type: type, time: time, from: formDateCostFreight, to: toDateCostFreight}
    }).then(function (res) {
        console.log(res)
        chartPieCostFreightEchartTemplate(res['data'][0], 'chart-cost-freight-report');
        $('.chart-cost-freight-report-loading').remove();
        if(res.data[1] === 0){
            $('#chart-cost-freight-report-empty').removeClass('d-none');
            $('#chart-cost-freight-report').addClass('d-none');
        } else {
            $('#chart-cost-freight-report-empty').addClass('d-none');
            $('#chart-cost-freight-report').removeClass('d-none');
        }
    }).catch(function (e) {
        console.log(e);
    });
}


function chartPieCostFreightEchartTemplate(data, element) {
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
                fontWeight: "normal",
                fontFamily: "Roboto"
            }
        },
        series: [
            {
                type: 'pie',
                radius: '80%',
                center: ['40%', '50%'],
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


function reloadCostFreightReport(){
    loadDataCostFreightReport = 0;
    dataCostFreightReport();
}
