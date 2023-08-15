// let vnd = $('#unit-text-revenue-cost-profit-report').text();
let chartRevenueCostProfitCashFlow;

$(function () {
    $('#select-type-revenue-cost-cash-flow-report').on('change', function () {
        loadDataRevenueCostCashFlow = 0;
        dataRevenueCostCashFlowReport()
    });
})

/**
 * Call data
 * @returns {Promise<void>}
 */
function dataRevenueCostCashFlowReport() {
    if (loadDataRevenueCostCashFlow === 1) return false;
    loadDataRevenueCostCashFlow = 1;
    $('#chart-revenue-cost-cash-flow').prepend(themeLoading($('#chart-revenue-cost-cash-flow').height(), 'chart-revenue-card2-1-loading'))
    $('.loading-revenue-report').prepend(themeLoading($('.loading-revenue-report').height(), 'loading-revenue-report-loading'))

    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        type = $('#select-type-revenue-cost-cash-flow-report').val(),
        time = $('#select-type-revenue-cost-cash-flow-report').find(':selected').data('time');

    axios({
        method: 'get',
        url: 'company-dashboard.data-revenue-cost-cash-flow-report',
        params: {brand: brand, branch: branch, type: type, time: time}
    }).then( res => {
        console.log(res);
        $('.chart-revenue-card2-1-loading').remove()
        revenueCostProfitCashFlowEchartReport('chart-revenue-cost-cash-flow',res.data[0]);
        $('#revenue_present').text(res.data[1].present_revenue);
        $('#cost_present').text(res.data[1].present_cost);
        $('#profit_present').text(res.data[1].present_profit);
    }).catch(function (e) {
        $('.chart-revenue-card2-1-loading').remove()
        console.log(e);
    });

}

/**
 * Reload Data
 */
function reloadRevenueCostCashFlowReport() {
    loadDataRevenueCostCashFlow = 0;
    dataRevenueCostCashFlowReport();
}


/**
 * ECHART ===========
 */

async function revenueCostProfitCashFlowEchartReport(element , data) {
    console.log({data})
    let chartDom = document.getElementById(element);
    let myChart = echarts.init(chartDom, null, {
        renderer: "canvas",
        useDirtyRect: false,
    });
    let option = {
        tooltip: {
            trigger: 'axis',
            // formatter: function (data) {
            //     return `<h4>${ data[0].name }</h4>
            //             <ul style="14px / 21px sans-seri">
            //                 <li><span style="font-size: 14px !important;font-weight: 400">${data[0].marker + data[0].seriesName }</span> : <span style="font-weight: 900;">${ formatNumber(data[0].value[1]) }</span></li>
            //                 <li><span style="font-size: 14px !important;font-weight: 400">${data[1].marker +  data[1].seriesName }</span> : <span style="font-weight: 900;">${ formatNumber(data[1].value[1]) }</span></li>
            //                     <ul style="padding-left: 3em;list-style: initial ">
            //                         <li><span style="font-size: 11px; font-weight: 400;">Cố định: </span><span style="font-size: 13px !important; font-weight: 900;">${formatNumber(data[1].data.total_recuring_average_cost)}</span></li>
            //                         <li><span style="font-size: 11px; font-weight: 400;">Phiếu chi: </span><span style="font-size: 13px !important; font-weight: 900;">${formatNumber(data[1].data.addition_fee_amount)}</span></li>
            //                     </ul>
            //                 <li><span style="font-size: 14px !important;font-weight: 400">${data[2].marker +  data[2].seriesName }</span> : <span style="font-weight: 900;">${ formatNumber(data[2].value[1]) }</span></li>
            //             </ul>`
            // }
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
