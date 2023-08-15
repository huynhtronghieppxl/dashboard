let percent = ' ' + $('#rate-percent-text-revenue-cost-profit-report').text(), formDateRevenueCostProfit, toDateRevenueCostProfit;
let vnd = $('#unit-text-revenue-cost-profit-report').text();
let chartRevenueCostProfit;
/**
 * Event
 */
$(function () {

})
$('#select-type-revenue-cost-profit-report').on('change', function () {
    switch (Number($('#select-type-revenue-cost-profit-report').val())){
        case 13:
            $('#select-time-month-revenue-cost-profit-report').addClass('d-none');
            $('#select-time-day-revenue-cost-profit-report').removeClass('d-none');
            $('#select-time-year-revenue-cost-profit-report').addClass('d-none');
            formDateRevenueCostProfit = $('#select-time-day-revenue-cost-profit-report .from-date-filter-time-bar').val();
            toDateRevenueCostProfit = $('#select-time-day-revenue-cost-profit-report .to-date-filter-time-bar').val();
            break;
        case 15:
            $('#select-time-month-revenue-cost-profit-report').removeClass('d-none');
            $('#select-time-day-revenue-cost-profit-report').addClass('d-none');
            $('#select-time-year-revenue-cost-profit-report').addClass('d-none');
            formDateRevenueCostProfit = $('#select-time-month-revenue-cost-profit-report .from-month-filter-time-bar').val();
            toDateRevenueCostProfit = $('#select-time-month-revenue-cost-profit-report .from-month-filter-time-bar').val();
            break;
        case 16:
            $('#select-time-month-revenue-cost-profit-report').addClass('d-none');
            $('#select-time-day-revenue-cost-profit-report').addClass('d-none');
            $('#select-time-year-revenue-cost-profit-report').removeClass('d-none');
            formDateRevenueCostProfit = $('#select-time-year-revenue-cost-profit-report .from-year-filter-time-bar').val();
            toDateRevenueCostProfit = $('#select-time-year-revenue-cost-profit-report .to-year-filter-time-bar').val();
            break;
        default:
            $('#select-time-month-revenue-cost-profit-report').addClass('d-none');
            $('#select-time-day-revenue-cost-profit-report').addClass('d-none');
            $('#select-time-year-revenue-cost-profit-report').addClass('d-none');
            formDateRevenueCostProfit = "";
            toDateRevenueCostProfit = "" ;
    }
    loadDataRevenueCostProfitReport = 0;
    dataRevenueCostProfitReport();
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-revenue-cost-profit-report'), $('#select-type-revenue-cost-profit-report'))
});
getTimeChangeSelectTypeDashboardReport($('#text-label-type-revenue-cost-profit-report'), $('#select-type-revenue-cost-profit-report'))

$('#select-time-revenue-cost-profit-report .search-date-filter-time-bar').on('click', function () {
    reloadRevenueCostProfitReport();
})



/**
 * Call data
 * @returns {Promise<void>}
 */
function dataRevenueCostProfitReport() {
    if (loadDataRevenueCostProfitReport === 1) return false;
    loadDataRevenueCostProfitReport = 1;
    $('#rate-one-revenue-cost-profit-report').attr('style', 'height:400px;');
    $('#rate-two-revenue-cost-profit-report').attr('style', 'height:400px;');
    $('#chart-revenue-card2').prepend(themeLoading($('#chart-revenue-card2').height(), 'chart-revenue-card2-loading'))
    // $('#chart-revenue-card2-1').prepend(themeLoading($('#chart-revenue-card2-1').height(), 'chart-revenue-card2-1-loading'))
    $('#chart-revenue-card2-3').prepend(themeLoading($('#chart-revenue-card2-3').height(), 'chart-revenue-card2-3-loading'))
    $('.loading-reveneu-report').prepend(themeLoading($('.loading-reveneu-report').height(), 'loading-revenue-report-loading'))

    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        type = $('#select-type-revenue-cost-profit-report').val(),
        time = $('#select-type-revenue-cost-profit-report').find(':selected').data('time');

    axios({
        method: 'get',
        url: 'branch-dashboard.data-revenue-cost-profit-report',
        params: {brand: brand, branch: branch, type: type, time: time , from : formDateRevenueCostProfit , to : toDateRevenueCostProfit}
    }).then(function (res) {
        console.log(res);
        chartRevenueCostProfitReport(res.data[0], res.data[1], res.data[2]);
        $('#revenue_total').text(res.data[3].total_revenue);
        $('#cost_total').text(res.data[3].total_cost);
        $('#profit_total').text(res.data[3].total_profit);


        //     $('#revenue_present').text(res.data[4].present_revenue);
        // $('#cost_present').text(res.data[4].present_cost);
        // $('#profit_present').text(res.data[4].present_profit);


        $('#profit_rates_present').text(res.data[3].profit);
        $('#revenue_present_total').text(res.data[5].total_revenue);
        $('#cost_present_total').text(res.data[5].total_cost);
        $('#profit_present_total').text(res.data[5].total_profit);


        $('#revenue_present_present').text(res.data[3].total_profit);
        $('#profit_rates_total').text(res.data[3].profit_rate_format + percent);
        $('#profit-rates-card-present #profit_rates_present').text(res.data[3].present_profit_rate_format + percent);
        $('#profit_rates_present_total').text(res.data[5].total_profit_rate_format + percent);
        dataDetailCostEstimate(res.data[3]);
        dataDetailCostCurrent(res.data[4]);
        dataDetailCost(res.data[5]);
        $('#reveneu-cost-profit-rate-total .progress-profit-rates-total').css({
            'width':  + res.data[5].total_profit_rate_format + '%',
            'background-color': '#ffa233'
        });

        $('#profit-rates-estimate .progress-profit-rates-total').css({
            'width':  + res.data[3].profit_rate_format + '%',
            'background-color': '#ffa233'
        });

        rateRevenueCostProfitReport(res.data[7], res.data[8]);
        $('.chart-revenue-card2-loading').remove()
        // $('.chart-revenue-card2-1-loading').remove()
        $('.chart-revenue-card2-3-loading').remove()
        $('.loading-revenue-report-loading').remove()
        $('#rate-one-revenue-cost-profit-report').attr('style', '');
        $('#rate-two-revenue-cost-profit-report').attr('style', '');
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover',
            container: 'body',
            html: true
        });

        $('#warehouse-inventory').on('click', function () {
            $(this).parent().find('.list-warehouse-inventory').toggleClass('d-none')
        })
    }).catch(function (e) {
        $('.chart-revenue-card2-loading').remove()
        // $('.chart-revenue-card2-1-loading').remove()
        $('.chart-revenue-card2-3-loading').remove()
        $('.loading-revenue-report-loading').remove()
        console.log(e);
    });

}

async function chartRevenueCostProfitReport(data1, data2, data3) {
    let element1 = "chart-revenue-card2";
    // let element2 = "chart-revenue-card2-1";
    let element3 = "chart-revenue-card2-3";
    revenueCostProfitEchartReport(element1, data1, 1);
    // revenueCostProfitEchartReport(element2, data2, 2);
    revenueCostProfitEchartReport(element3, data3, 3);
    $('.amcharts-axis-zero-grid').attr('stroke-opacity', 1);
}

function rateRevenueCostProfitReport(data1, data2, data3) {
    $('#rate-one-revenue-cost-profit-report').html(data1);
    $('#rate-two-revenue-cost-profit-report').html(data2);
    $('#rate-three-revenue-cost-profit-report').html(data3);
}

/**
 * Reload Data
 */
function reloadRevenueCostProfitReport() {
    loadDataRevenueCostProfitReport = 0;
    dataRevenueCostProfitReport();
}


/**
 * ECHART ===========
 */

async function revenueCostProfitEchartReport(element , data, type) {
    // if (data.value.data.length === 0) {
    //     let id = $('#' + element);
    //     nullDataImg(id);
    //     return false;
    // }
    let chartDom = document.getElementById(element);
    let myChart = echarts.init(chartDom, null, {
        renderer: "canvas",
        useDirtyRect: false,
    });
    let option = {
        tooltip: {
            trigger: 'axis',
            formatter: function (data) {
                if(type === 2){
                    return `<h4>${ data[0].name }</h4>
                        <ul style="font: 14px / 21px sans-seri">
                            <li><span style="font-size: 14px !important;font-weight: 400">${data[0].marker + data[0].seriesName }</span> : <span style="font-weight: 900;">${ formatNumber(data[0].value[1]) }</span></li>
                            <li><span style="font-size: 14px !important;font-weight: 400">${data[1].marker +  data[1].seriesName }</span> : <span style="font-weight: 900;">${ formatNumber(data[1].value[1]) }</span></li>
                                <ul style="padding-left: 3em;list-style: initial ">
                                    <li><span style="font-size: 11px; font-weight: 400;">Cố định: </span><span style="font-size: 13px !important; font-weight: 900;">${formatNumber(data[1].data.total_recuring_average_cost)}</span></li>
                                    <li><span style="font-size: 11px; font-weight: 400;">Phiếu chi: </span><span style="font-size: 13px !important; font-weight: 900;">${formatNumber(data[1].data.addition_fee_amount)}</span></li>
                                </ul>
                            <li><span style="font-size: 14px !important;font-weight: 400">${data[2].marker +  data[2].seriesName }</span> : <span style="font-weight: 900;">${ formatNumber(data[2].value[1]) }</span></li>
                        </ul>`
                }else {
                    return `<h4>${ data[0].name }</h4>
                        <ul style="font: 14px / 21px sans-seri">
                            <li><span style="font-size: 14px !important;font-weight: 400">${data[0].marker + data[0].seriesName }</span> : <span style="font-weight: 900;">${ formatNumber(data[0].value[1]) }</span></li>
                            <li><span style="font-size: 14px !important;font-weight: 400">${data[1].marker +  data[1].seriesName }</span> : <span style="font-weight: 900;">${ formatNumber(data[1].value[1]) }</span></li>
                                <ul style="padding-left: 3em;list-style: initial ">
                                    <li><span style="font-size: 11px; font-weight: 400;">Cố định: </span><span style="font-size: 13px !important; font-weight: 900;">${formatNumber(data[1].data.total_recuring_average_cost)}</span></li>
                                    <li><span style="font-size: 11px; font-weight: 400;">Lương nhân viên: </span><span style="font-size: 13px !important; font-weight: 900;">${formatNumber(data[1].data.total_salary_cost)}</span></li>
                                    <li><span style="font-size: 11px; font-weight: 400;">Nhập kho: </span><span style="font-size: 13px !important; font-weight: 900;">${formatNumber(data[1].data.restaurant_debt_amount)}</span></li>
                                    <li><span style="font-size: 11px; font-weight: 400;">Phiếu chi: </span><span style="font-size: 13px !important; font-weight: 900;">${formatNumber(data[1].data.addition_fee_amount)}</span></li>
                                </ul>
                            <li><span style="font-size: 14px !important;font-weight: 400">${data[2].marker +  data[2].seriesName }</span> : <span style="font-weight: 900;">${ formatNumber(data[2].value[1]) }</span></li>
                        </ul>`
                }
            }
        },
        grid: {
            top : '2%',
            left: '1%',
            right: '2%',
            bottom: '1%',
            containLabel: true
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: data.timeline,
            axisLabel : {
                margin: 10.5
            }
        },
        yAxis: {
            type: 'value',
            axisLabel : {
                formatter : function (value, index){
                    return nFormatter(value);
                }
            }
        },
        series: [
            {
                name: 'Doanh thu',
                type: 'line',
                smooth: true,
                itemStyle : {
                    color : '#0072bc',
                },
                // stack: 'Total',
                data: data.revenue
            },
            {
                name: 'Chi phí',
                type: 'line',
                smooth: true,
                // stack: 'Total',
                itemStyle : {
                    color : '#fe5d70',
                },
                data: data.cost
            },
            {
                name: 'Lợi nhuận',
                type: 'line',
                smooth: true,
                // stack: 'Total',
                itemStyle : {
                    color : '#0ac282',
                },
                data: data.profit
            },
        ]
    };

    option && myChart.setOption(option);
    $(window).on('resize', function () {
        myChart.resize();
    });
}
