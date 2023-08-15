// async function eChartFoodSellReport(id, dataTimeline, dataValueTotal, dataValueOriginalTotal, dataValueProfit, dataTotal) {
//     if (dataTimeline.length === 0 && dataValueTotal.length === 0 && dataValueOriginalTotal.length === 0 && dataValueProfit.length === 0) {
//         $('#chart-sell-report-vertical-center').removeClass('d-none')
//         $('#chart-sell-report-vertical-main').addClass('d-none')
//         $('.hidden-detail').addClass('d-none')
//         $('#detail-value-food-report-box').addClass('d-none')
//     } else {
//         $('#chart-sell-report-vertical-center').addClass('d-none')
//         $('#chart-sell-report-vertical-main').removeClass('d-none')
//         $('#detail-value-food-report-box').removeClass('d-none')
//         $('.hidden-detail').removeClass('d-none')
//         let chartDom = document.getElementById(id);
//         myChartFoodReport = await echarts.init(chartDom);
//         $(window).on('resize', function (){
//             myChartFoodReport.resize();
//         });
//         let option = {
//             grid: {
//                 y: 50,
//                 y2: 100,
//                 left: 100,
//                 right: 10,
//             },
//             // dataZoom: [
//             //     {
//             //         realtime: true,
//             //         start: 0,
//             //         end: dataTimeline.length > 12 ? 30 : 100,
//             //         maxSpan: 40,
//             //         show: true,
//             //         brushSelect: false,
//             //     },
//             //     {
//             //         type: "slider",
//             //         start: 94,
//             //         end: 100,
//             //         brushSelect: false,
//             //     },
//             //     {
//             //         show: false,
//             //         yAxisIndex: 0,
//             //         filterMode: "empty",
//             //         width: 30,
//             //         height: "80%",
//             //         showDataShadow: false,
//             //         left: "93%",
//             //         brushSelect: false,
//             //     },
//             // ],
//             xAxis: {
//                 type: 'category',
//                 data: dataTimeline,
//                 axisTick: {
//                     alignWithLabel: true,
//                 },
//                 axisLabel: {
//                     interval: 0,
//                     rotate: 20,
//                     width: 120,
//                     overflow: 'truncate',
//                     ellipsis: '...'
//                 },
//             },
//             yAxis: {
//                 type: 'value',
//                 scale: true,
//                 axisLabel: {
//                     inside: false,
//                     formatter: function (value, index) {
//                         if (value > 999999999) {
//                             return value % 1000000000 === 0 ? formatNumber(value / 1000000000) + ' tỷ' : formatNumber((value / 1000000000).toFixed(1)) + ' tỷ'
//                         }
//                         if (value > 999999) {
//                             return value % 1000000 === 0 ? formatNumber(value / 1000000) + ' triệu' : formatNumber((value / 1000000).toFixed(1)) + ' triệu'
//                         }
//                         if (value > 999) {
//                             return value % 1000 === 0 ? formatNumber(value / 1000) + ' ngàn' : formatNumber((value / 1000).toFixed(1)) + ' ngàn'
//                         }
//                         if (value < -999999999) {
//                             return value % 1000000000 === 0 ? formatNumber(value / 1000000000) + ' tỷ' : formatNumber((value / 1000000000).toFixed(1)) + ' tỷ'
//                         }
//                         if (value < -999999) {
//                             return value % 1000000 === 0 ? formatNumber(value / 1000000) + ' triệu' : formatNumber((value / 1000000).toFixed(1)) + ' triệu'
//                         }
//                         if (value < -999) {
//                             return value % 1000 === 0 ? formatNumber(value / 1000) + ' ngàn' : formatNumber((value / 1000).toFixed(1)) + ' ngàn'
//                         }
//                     },
//                     margin: 0
//                 },
//                 name: 'Số tiền (VNĐ)',
//                 nameGap: 80,
//                 nameTextStyle: {
//                     fontSize: 14,
//                     fontWeight: 600
//                 },
//                 nameRotate: 90,
//                 nameLocation: 'middle',
//             },
//             legend: {
//                 show: true,
//                 textStyle: {
//                     rich: {
//                         num: {
//                             fontSize : 16,
//                             color:"#fa6342",
//                             fontWeight: "bold",
//                         },
//                     }
//                 },
//                 formatter: function (name){
//                     return `${name}: {num|${dataTotal[name]}}`;
//                 },
//                 top: 'top',
//             },
//             series: [
//                 {
//                     name: 'Tổng tiền',
//                     type: 'bar',
//                     data: dataValueTotal,
//                     emphasis: {
//                         focus: 'series'
//                     },
//                 },
//                 {
//                     name: 'Giá vốn',
//                     type: 'bar',
//                     data: dataValueOriginalTotal,
//                     emphasis: {
//                         focus: 'series'
//                     },
//                 },
//                 {
//                     name: 'Lợi nhuận',
//                     type: 'bar',
//                     data: dataValueProfit,
//                     emphasis: {
//                         focus: 'series'
//                     },
//                 },
//             ],
//             tooltip: {
//                 trigger: 'axis',
//                 position: 'top'
//             },
//             toolbox: {
//                 show: true,
//                 itemSize : 20,
//                 feature: {
//                     show: true,
//                     showTitle: false,
//                     myTool1: {
//                         // show: true,
//                         // icon: 'image://https://cdn-icons-png.flaticon.com/512/159/159604.png',
//                         // title: 'Xem Chi tiết',
//                         onclick: function (params) {
//                             if(params.option.series[0].label.show){
//                                 myChartFoodReport.setOption(
//                                     {
//                                         toolbox : {
//                                             showTitle: false,
//                                             feature : {
//                                                 myTool1: {
//                                                     icon: 'image://https://cdn-icons-png.flaticon.com/512/159/159604.png',
//                                                     title : 'Ẩn chi tiết',
//                                                 }
//                                             },
//                                             tooltip: { // same as option.tooltip
//                                                 show: true,
//                                                 showTitle: false,
//                                                 formatter: function (param) {
//                                                     return '<div>' + param.title + '</div>'; // user-defined DOM structure
//                                                 },
//                                                 backgroundColor: '#222',
//                                                 textStyle: {
//                                                     fontSize: 12,
//                                                     color : '#fff'
//                                                 },
//                                                 extraCssText: 'box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);' // user-defined CSS styles
//                                             }
//                                         },
//                                         series: [
//                                             {
//                                                 label: {show: false},
//                                             },
//                                             {
//                                                 label: {show: false},
//                                             },
//                                             {
//                                                 label: {show: false},
//                                             },
//                                         ],
//                                     }
//                                 )
//                             } else {
//                                 let labelOption = {
//                                     show: true ,
//                                     verticalAlign: "middle",
//                                     position: params.option.xAxis[0].type === "value" ? "inside" : "top",
//                                     color: "rgba(0, 0, 0, 1)",
//                                     rotate: 0,
//                                     distance: 15,
//                                     fontWeight: "bolder",
//                                     fontFamily: "roboto",
//                                     formatter : function (param)
//                                     {
//                                         return formatNumber(param.value);
//                                     }
//                                 };
//                                 myChartFoodReport.setOption(
//                                     {
//                                         toolbox : {
//                                             showTitle: false,
//                                             feature : {
//                                                 myTool1: {
//                                                     // icon: 'image://https://cdn-icons-png.flaticon.com/512/565/565655.png',
//                                                     // title : 'Xem chi tiết',
//                                                 }
//                                             },
//                                             tooltip: { // same as option.tooltip
//                                                 show: true,
//                                                 showTitle: false,
//                                                 formatter: function (param) {
//                                                     return '<div>' + param.title + '</div>'; // user-defined DOM structure
//                                                 },
//                                                 backgroundColor: '#222',
//                                                 textStyle: {
//                                                     fontSize: 12,
//                                                     color : '#fff'
//                                                 },
//                                                 extraCssText: 'box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);' // user-defined CSS styles
//                                             },
//                                         },
//                                         series: [
//                                             {
//                                                 label: labelOption,
//                                             },
//                                             {
//                                                 label: labelOption,
//                                             },
//                                             {
//                                                 label: labelOption,
//                                             },
//                                         ]
//                                     }
//                                 )
//                             }
//                         }
//                     }
//                 },
//                 right: 0,
//             },
//         };
//         myChartFoodReport.setOption(option);
//     }
// }

// function eChartLineFoodSellReport(id , data) {
//     let chartDom = document.getElementById(id);
//     let myChart = echarts.init(chartDom);
//     let option = {
//         tooltip: {
//             trigger: 'axis',
//         },
//         xAxis: {
//             type: 'category',
//             data: data.map(item=>{
//                 return item.timeline;
//             }),
//         },
//         grid: {
//             top : '2%',
//             left: '1%',
//             right: '2%',
//             bottom: '1%',
//             containLabel: true
//         },
//         yAxis: {
//             type: 'value',
//             axisLabel : {
//                 formatter : function (value){
//                     return nFormatter(value);
//                 }
//             }
//         },
//         series: [
//             {
//                 name: 'Tổng tiền',
//                 type: 'line',
//                 smooth: true,
//                 data:  data.map(item=>{
//                     return item.valueTotal;
//                 }),
//                 itemStyle : {
//                     color : '#0072bc',
//                 },
//             },
//             {
//                 name: 'Giá vốn',
//                 type: 'line',
//                 smooth: true,
//                 data:  data.map(item=>{
//                     return item.valueOriginalTotal;
//                 }),
//                 itemStyle : {
//                     color : '#fe5d70',
//                 },
//             },
//             {
//                 name: 'Lợi nhuận',
//                 type: 'line',
//                 smooth: true,
//                 data:  data.map(item=>{
//                     return item.valueProfit;
//                 }),
//                 itemStyle : {
//                     color : '#0ac282',
//                 },
//             },
//         ],
//     };
//     option && myChart.setOption(option);
// }
// function isVisibleDetailValueFoodReport () {
//     if($('#detail-value-food-report').is(':checked')) {
//         myChartFoodReport.setOption({
//             series : {
//                 label: {
//                     show: true,
//                     verticalAlign: "middle",
//                     position: "top",
//                     color: "rgba(0, 0, 0, 1)",
//                     rotate: 0,
//                     distance: 15,
//                     fontWeight: "bolder",
//                     fontFamily: "roboto",
//                     formatter : function (param){
//                         return formatNumber(param.value);
//                     }
//                 },
//             },
//         })
//     }else {
//         myChartFoodReport.setOption({
//             series : {
//                 label: {show: false},
//             }
//         })
//     }
// }


// function isVisibleDetailValueFoodReport() {
//     const isChecked = $('#detail-value-food-report').is(':checked');
//     const labelOption = isChecked ? {
//         show: true,
//         verticalAlign: "middle",
//         position: "top",
//         color: "rgba(0, 0, 0, 1)",
//         rotate: 0,
//         distance: 15,
//         fontWeight: "bolder",
//         fontFamily: "roboto",
//         formatter: function (param) {
//             return formatNumber(param.value);
//         }
//     } : {
//         show: false
//     };
//     const series = myChartFoodReport.getOption().series;
//     for (let i = 0; i < series.length; i++){
//         series[i].label = labelOption;
//     }
//     myChartFoodReport.setOption({
//         series: series
//     });
// }
