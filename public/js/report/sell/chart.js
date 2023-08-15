// function chartRevenueVertical(data) {
//     let element = 'chart-sell-report-vertical';
//     let titleX = $('#title-money-chart-component').val();
//     let unit = $('#unit-money-chart-component').val();
//     let color = "#0072bc";
//     chartColumnVerticalTemplate(data, element, titleX, unit,color);
// }
//
// function chartRevenueHorizontal(data){
//     let element = 'chart-sell-report-horizontal';
//     let titleX = $('#title-money-chart-component').val();
//     let unit = $('#unit-money-chart-component').val();
//     let color = "#0072bc";
//     chartColumnHorizontalTemplate(data, element, titleX, unit,color);
// }
//
// async function eChart(id, data1, data2, data3, data4){
//     if(data1.length === 0 && data2.length === 0 && data3.length === 0 && data4.length === 0){
//         // const element = $('#' + id);
//         // await nullDataImg(element);
//         $('#chart-sell-report-vertical-center.empty-datatable-custom').removeClass('d-none')
//         $('#chart-sell-report-vertical-main').addClass('d-none')
//     }else{
//         $('#chart-sell-report-vertical-center.empty-datatable-custom').addClass('d-none')
//         $('#chart-sell-report-vertical-main').removeClass('d-none')
// // $('#chart-sell-report-vertical .empty-datatable-custom').remove()
//         let chartDom = document.getElementById(id);
//         let myChart = await echarts.init(chartDom);
//         let labelOption = {
//             show: false,
//             rotate: 90,
//             align: 'left',
//             verticalAlign: 'middle',
//             position: 'insideBottom',
//             distance: 15,
//             fontSize: 9,
//             color: '#000',
//             formatter: function (value, index){
//                 return formatNumber(value.value) + ' vnd';
//             },
//             rich: {
//                 name: {}
//             }
//         };
//         let option = {
//             // title: {
//             //     text: 'DƯ IEU BIEU DO'
//             // },
//             xAxis: {
//                 type: 'category',
//                 data: data1,
//                 axisLabel: {
//                     interval: 0,
//                     rotate: 30
//                 },
//             },
//             yAxis: {
//                 type: 'value',
//                 axisLabel: {
//                     formatter: function (value, index){
//                         if(value > 999999999){
//                             return formatNumber((value / 1000000000).toFixed(1)) + ' tỷ'
//                         }
//                         if(value > 999999){
//                             return formatNumber((value / 1000000).toFixed(1)) + ' triệu'
//                         }
//                         if(value > 999){
//                             return formatNumber((value / 1000).toFixed(1)) + ' ngàn'
//                         }
//                     },
//                     margin: 0
//                 },
//
//             },
//             legend: {
//                 data: ['Tổng tiền', 'Giá vốn', 'Lợi nhuận'],
//                 top: 'bottom'
//             },
//             series: [
//                 {
//                     name: 'Tổng tiền',
//                     type: 'bar',
//                     data: data2,
//                     emphasis: {
//                         focus: 'series'
//                     },
//                     // label: labelOption,
//                 },
//                 {
//                     name: 'Giá vốn',
//                     type: 'bar',
//                     data: data3,
//                     emphasis: {
//                         focus: 'series'
//                     },
//                     // label: labelOption,
//                 },
//                 {
//                     name: 'Lợi nhuận',
//                     type: 'bar',
//                     data: data4,
//                     emphasis: {
//                         focus: 'series'
//                     },
//                     // label: labelOption,
//                 },
//             ],
//             tooltip: {
//                 trigger: 'axis',
//                 position: 'top'
//             },
//             toolbox: {
//                 show: true,
//                 feature: {
//                     mark: { show: true },
//                     saveAsImage: { show: true },
//                     magicType: {type:['stack', 'tiled']},
//                     myFeature: {
//                         show: true,
//                         icon: 'path://M432.45,595.444c0,2.177-4.661,6.82-11.305,6.82c-6.475,0-11.306-4.567-11.306-6.82s4.852-6.812,11.306-6.812C427.841,588.632,432.452,593.191,432.45,595.444L432.45,595.444z M421.155,589.876c-3.009,0-5.448,2.495-5.448,5.572s2.439,5.572,5.448,5.572c3.01,0,5.449-2.495,5.449-5.572C426.604,592.371,424.165,589.876,421.155,589.876L421.155,589.876z M421.146,591.891c-1.916,0-3.47,1.589-3.47,3.549c0,1.959,1.554,3.548,3.47,3.548s3.469-1.589,3.469-3.548C424.614,593.479,423.062,591.891,421.146,591.891L421.146,591.891zM421.146,591.891',
//                         title: 'Detail',
//                         onclick: function (){
//                             if($('#chart-sell-report-vertical-main').hasClass('detail-chart')){
//                                 $('#chart-sell-report-vertical-main').removeClass('detail-chart')
//                                 myChart.setOption(
//                                     {
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
//                             }else {
//                                 $('#chart-sell-report-vertical-main').addClass('detail-chart')
//                                 myChart.setOption(
//                                     {
//                                         series: [
//                                             {
//                                                 label: {show: true},
//                                             },
//                                             {
//                                                 label: {show: true},
//                                             },
//                                             {
//                                                 label: {show: true},
//                                             },
//                                         ],
//                                     }
//                                 )
//                             }
//                         }
//                     }
//                 },
//             },
//         };
//         myChart.setOption(option);
//     }
//
// }
