$(function (){
    loadData();
})

async function loadData(){
    let method = 'get',
        params = {},
        data = null,
        url = 'all-report.data';
    let res = await axiosTemplate(method, url, params, data);
    chartData( 'chart-price-change-histories-container-1' , res['data'][0])
    chartData( 'chart-price-change-histories-container-2' , res['data'][1])
    chartData( 'chart-price-change-histories-container-3' , res['data'][2])
    chartData( 'chart-price-change-histories-container-4' , res['data'][3])
    chartData( 'chart-price-change-histories-container-5' , res['data'][4])
    chartData( 'chart-price-change-histories-container-6' , res['data'][5])
    chartData( 'chart-price-change-histories-container-7' , res['data'][6])
    chartData( 'chart-price-change-histories-container-8' , res['data'][7])
    chartData( 'chart-price-change-histories-container-9' , res['data'][8])
    chartData( 'chart-price-change-histories-container-10' , res['data'][9])
}


function chartData(element, data){
    let chartDom = document.getElementById(element);
    let myChart = echarts.init(chartDom, null, {
        renderer: "canvas",
        useDirtyRect: false,
    });
    let option = {
        grid: {
            top : '20%',
            left: '1%',
            right: '2%',
            bottom: '8%',
            containLabel: true
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: data.timeline,
        },
        yAxis: {
            type: 'value',
            axisLabel : {
                formatter : function (value, index){
                    if(index == 0 || index === data.value.length - 2) {
                        return nFormatter(value);
                    } else {
                        return ''
                    }
                }
            }
        },
        series: [
            {
                type: 'line',
                data: data.value
            },
        ]
    };

    option && myChart.setOption(option);
    $(window).on('resize', function () {
        myChart.resize();
    });
}
