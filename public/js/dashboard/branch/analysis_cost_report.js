/**
 * Event
 */
let typeFilterAnalysisReport, timeFilterAnalysisReport , fromFilterAnalysisReport, toFilterAnalysisReport;
typeFilterAnalysisReport = $('#select-type-analysis-cost-report select').find('option:selected').val();
timeFilterAnalysisReport = $('#select-type-analysis-cost-report select').find('option:selected').data('time');
$('#select-type-analysis-cost-report select').on('change', function () {
    loadDataAnalysisCostReport = 0;
    typeFilterAnalysisReport = $(this).val();
    timeFilterAnalysisReport = $(this).find('option:selected').data('time');
    switch (Number($(this).val())){
        case 13:
            fromFilterAnalysisReport = $(this).parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterAnalysisReport = $(this).parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            fromFilterAnalysisReport = $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterAnalysisReport = $(this).parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            fromFilterAnalysisReport = $(this).parents('.filter-dashboard-report').find('.from-year-filter-time-bar-time-report').val();
            toFilterAnalysisReport = $(this).parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            fromFilterAnalysisReport = "";
            toFilterAnalysisReport = "" ;
    }
    dataAnalysisCostReport();
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-analysis-cost-report'), $('#select-type-analysis-cost-report'));
});
getTimeChangeSelectTypeDashboardReport($('#text-label-type-analysis-cost-report'), $('#select-type-analysis-cost-report'));

$('#select-type-analysis-cost-report .search-date-option-filter-time-bar').on('click', function () {
    detectDateOptionTime(Number($('#select-type-analysis-cost-report select').find('option:selected').val()))
    // if(!CheckDateFormTo(fromFilterAnalysisReport, toFilterAnalysisReport)) return false
    if(!checkDashboardCustomDateTimePicker($(this), $('#select-type-analysis-cost-report select'))) return false;
    reloadAnalysisCostReport()
})

/**
 * Call data
 * @returns {Promise<void>}
 */
function dataAnalysisCostReport() {
    $('.chart-analysis-cost-report-loading').remove();
    if (loadDataAnalysisCostReport === 1) return false;
    loadDataAnalysisCostReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        type = $('#select-type-analysis-cost-report').val(),
        time = $('#select-type-analysis-cost-report').find(':selected').data('time');
    $('#chart-analysis-cost-report').prepend(themeLoading($('#chart-analysis-cost-report').height(), 'chart-analysis-cost-report-loading'))
    axios({
        method: 'get',
        url: 'branch-dashboard.data-analysis-cost-report',
        params: {brand: brand, branch: branch, type: typeFilterAnalysisReport, time: timeFilterAnalysisReport, from: fromFilterAnalysisReport , to : toFilterAnalysisReport}
    }).then(async function (res) {
        console.log(res);
        let element = 'chart-analysis-cost-report';
        await pieChartAnalysisCostReport(res.data[0], element);
        $('.chart-analysis-cost-report-loading').remove();
    }).catch(function (e) {
        console.log(e);
        $('.chart-analysis-cost-report-loading').remove();
    });
}
function pieChartAnalysisCostReport(data, element, color) {
    // if (data.length == 0 || data === null) {
    //     $('#chart-analysis-cost-report').addClass('d-none');
    //     $('#chart-analysis-cost-report-empty').removeClass('d-none');
    //     return false;
    // }
    // $('#chart-analysis-cost-report').removeClass('d-none');
    // $('#chart-analysis-cost-report-empty').addClass('d-none');
    let chartDom = document.getElementById(element);
    let myChart = echarts.init(chartDom);
    let option = {
        tooltip: {
            trigger: 'item'
        },
        legend: {
            type: 'scroll',
            orient: 'vertical',
            left: 'right'
        },
        series: [
            {
                type: 'pie',
                radius: '55%',
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
    $(window).on('resize', function () {
        myChart.resize();
    });
}

function detectDateOptionTime(type) {
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



// function pieChartAnalysisCostReport(data, element) {
//     try {
//         if(data.length === 0){
//             $('#chart-analysis-cost-report-empty').removeClass('d-none');
//             $('#chart-analysis-cost-report').addClass('d-none');
//         } else {
//             $('#chart-analysis-cost-report-empty').addClass('d-none');
//             $('#chart-analysis-cost-report').removeClass('d-none');
//             if (data.length === 0) {
//                 $('#' + element).html(
//                     "<div class='empty-datatable-custom center-loading'><img src='../../../../files/assets/images/nodata-datatable2.png'></div>"
//                 );
//                 return false;
//             }
//             return AmCharts.makeChart(element, {
//                 "type": "pie",
//                 "theme": "light",
//                 "dataProvider": data,
//                 "valueField": "value",
//                 "titleField": "label",
//                 "addClassNames": false,
//                 "balloon": {
//                     "fixedPosition": true
//                 },
//                 "legend": {
//                     "position": "right",
//                     "marginBottom": 10,
//                     "autoMargins": true,
//                     "valueWidth": 50,
//                 },
//             });
//         }
//     } catch (e) {
//         console.log('Error Pie Multi Chart: ' + e);
//     }
// }

/**
 * Reload Data
 */
function reloadAnalysisCostReport() {
    $('.chart-analysis-cost-report-loading').remove();
    loadDataAnalysisCostReport = 0;
    dataAnalysisCostReport();
}
