async function dataCardRevenue(data) {
    let element = 'chart-business-results-report-vertical-card-revenue';
    let titleX = $('#title-money-chart-component').val();
    let unit = $('#unit-money-chart-component').val();
    let color = "#0072bc";
    await chartColumnVerticalBusinessResult(data, element, titleX, unit, color);
}

async function dataCardProfit(data) {
    let element = 'chart-business-results-report-vertical-card-profit';
    let titleX = $('#title-money-chart-component').val();
    let unit = $('#unit-money-chart-component').val();
    let color = "#0ac282";
    await chartColumnVerticalBusinessResult(data, element, titleX, unit, color);
}

function dataCardCost(data) {
    $('#div-card').html('');
    data.forEach(function (element, index) {
        let total_value = 0;
        element.data.map(item => {
            total_value += removeformatNumber(item.value);
        })
        $('#div-card').append('<div class="col-lg-12 card-block">' +
            '<div class="card-block card-shadow-custom-2">\n' +
            '<h5 class="sub-title pb-3">' + element.name + '<span class="font-1-em float-right">' + formatNumber(total_value) + ' VNĐ </span></h5>\n' +
            '<div id="chart-business-result-card1-' + index + '" class="h-250px count-loading-chart"></div>\n' +
            '</div>' +
            '</div>');
        chartBusinessResult(element.data, index);
    });
}

function chartBusinessResult(data, index) {
    let element = 'chart-business-result-card1-' + index;
    let titleX = $('#title-money-chart-component').val();
    chartLineTemplate(data, element, titleX);
}

function chartColumnVerticalBusinessResult(data, element, titleX, unit, color) {
    try {
        if (data === null || data.length === 0) {
            let id = $('#' + element);
            nullDataImg(id);
            return false;
        }
        return AmCharts.makeChart(element, {
            "type": "serial",
            "theme": "light",
            "dataProvider": data,
            "addClassNames": true,
            "startDuration": 1,
            "marginLeft": 0,
            "categoryField": "timeline",
            "categoryAxis": {
                "autoGridCount": false,
                "gridCount": data.length,
                "gridAlpha": 0.1,
                "gridColor": "#FFFFFF",
                "axisColor": "#555555",
                "labelRotation": 45,
            },
            "valueAxes": [{
                "id": "a1",
                "title": titleX,
                "axisAlpha": 0,
                "labelFunction": function (value) {
                    return nFormatter(value);
                }
            }],
            "graphs": [{
                "id": "g1",
                "valueField": "value",
                "title": "value",
                "type": "column",
                "fillAlphas": 0.9,
                "valueAxis": "a1",
                "balloonText": "[[value]] " + unit,
                "legendValueText": "[[value]] " + unit,
                "legendPeriodValueText": "total: [[value.sum]] " + unit,
                "lineColor": color,
                "alphaField": "alpha",
            }]
        });
    } catch (e) {
        console.log('Error Chart Vertical: ' + e);
    }
}

async function eChart(id, data1, data2, data3, data4) {
    // let number = [100, 200,300];
    // let iChart = 0
    if (data1.length === 0 && data2.length === 0) {
        $('#chart-business-results-report-vertical-card-revenue-center .empty-datatable-custom').removeClass('d-none')
        $('#chart-business-results-report-vertical-card-revenue-main').addClass('d-none')
    } else {
        $('#chart-business-results-report-vertical-card-revenue-center .empty-datatable-custom').addClass('d-none')
        $('#chart-business-results-report-vertical-card-revenue-main').removeClass('d-none')
        let chartDom = document.getElementById(id);
        myChartBusinessResultReport = await echarts.init(chartDom);
        let labelOption = {
            show: true,
            rotate: 90,
            align: 'left',
            verticalAlign: 'middle',
            position: 'insideBottom',
            distance: 15,
            fontSize: 9,
            color: '#000',
            formatter: function (value, index) {
                return formatNumber(value.value);
            },
            rich: {
                name: {}
            }
        };
        let option = {
            // title: {
            //     text: 'DƯ IEU BIEU DO'
            // },
            grid: {
                y: 50,
                y2: 100,
                // top: 0,
                left: 100,
                right: 10,
            },
            dataZoom: [
                {
                    type: 'slider',
                    start: 0,
                    end: data1.length > 30 ? 30 : 100,
                    realtime: true,
                    show: data1.length > 30 ? true : false
                    // show: true
                },
            ],
            xAxis: {
                type: 'category',
                data: data1,
                axisLabel: {
                    interval: 0,
                    rotate: 20,
                    width: 120,
                    overflow: 'truncate',
                    ellipsis: '...'
                },
            },
            yAxis: {
                type: 'value',
                axisLabel: {
                    inside: false,
                    formatter: function (value, index) {
                        if (value > 999999999) {
                            return value % 1000000000 === 0 ? formatNumber(value / 1000000000) + ' tỷ' : formatNumber((value / 1000000000).toFixed(1)) + ' tỷ'
                        }
                        if (value > 999999) {
                            return value % 1000000 === 0 ? formatNumber(value / 1000000) + ' triệu' : formatNumber((value / 1000000).toFixed(1)) + ' triệu'
                        }
                        if (value > 999) {
                            return value % 1000 === 0 ? formatNumber(value / 1000) + ' ngàn' : formatNumber((value / 1000).toFixed(1)) + ' ngàn'
                        }
                        if (value < -999999999) {
                            return value % 1000000000 === 0 ? formatNumber(value / 1000000000) + ' tỷ' : formatNumber((value / 1000000000).toFixed(1)) + ' tỷ'
                        }
                        if (value < -999999) {
                            return value % 1000000 === 0 ? formatNumber(value / 1000000) + ' triệu' : formatNumber((value / 1000000).toFixed(1)) + ' triệu'
                        }
                        if (value < -999) {
                            return value % 1000 === 0 ? formatNumber(value / 1000) + ' ngàn' : formatNumber((value / 1000).toFixed(1)) + ' ngàn'
                        }
                    },
                    margin: 0
                },
                name: 'Số tiền (VNĐ)',
                nameGap: 80,
                nameTextStyle: {
                    fontSize: 14,
                    fontWeight: 600
                },
                nameRotate: 90,
                nameLocation: 'middle',
            },
            legend: {
                show :false,
                textStyle: {
                    rich: {
                        num: {
                            fontSize : 16,
                            color:"#fa6342",
                            fontWeight: "bold",
                        },
                    }
                },
                formatter: function (name){
                    return `${name}: {num|${data4}}`;
                },
                top: 'top'
            },
            series: [
                {
                    name: 'Tổng doanh thu',
                    type: 'bar',
                    data: data2,
                    emphasis: {
                        focus: 'series'
                    },
                },
            ],
            tooltip: {
                trigger: 'axis',
                position: 'top'
            },
            toolbox: {
                show: true,
                feature: {
                    mark: {show: true},
                    saveAsImage: {
                        show: true,
                        title: 'Tải ảnh xuống',
                    },
                    myFeature: {
                        show: false,
                        icon: 'path://M432.45,595.444c0,2.177-4.661,6.82-11.305,6.82c-6.475,0-11.306-4.567-11.306-6.82s4.852-6.812,11.306-6.812C427.841,588.632,432.452,593.191,432.45,595.444L432.45,595.444z M421.155,589.876c-3.009,0-5.448,2.495-5.448,5.572s2.439,5.572,5.448,5.572c3.01,0,5.449-2.495,5.449-5.572C426.604,592.371,424.165,589.876,421.155,589.876L421.155,589.876z M421.146,591.891c-1.916,0-3.47,1.589-3.47,3.549c0,1.959,1.554,3.548,3.47,3.548s3.469-1.589,3.469-3.548C424.614,593.479,423.062,591.891,421.146,591.891L421.146,591.891zM421.146,591.891',
                        title: 'Chi tiết',
                        onclick: function () {
                            if ($('#chart-business-results-report-vertical-card-revenue-main').hasClass('detail-chart')) {
                                $('#chart-business-results-report-vertical-card-revenue-main').removeClass('detail-chart')
                                myChartBusinessResultReport.setOption(
                                    {
                                        series: [
                                            {
                                                label: {show: false},
                                            },
                                            {
                                                label: {show: false},
                                            },
                                            {
                                                label: {show: false},
                                            },
                                        ],
                                    }
                                )
                            } else if (currentTypeBusinessResultReport == 'stack') {
                                myChartBusinessResultReport.setOption(
                                    {
                                        series: [
                                            {
                                                label: {show: false},
                                            },
                                            {
                                                label: {show: false},
                                            },
                                            {
                                                label: {show: false},
                                            },
                                        ],
                                    }
                                )
                            } else {
                                $('#chart-business-results-report-vertical-card-revenue-main').addClass('detail-chart')
                                myChartBusinessResultReport.setOption(
                                    {
                                        series: [
                                            {
                                                label: labelOption,
                                            },
                                            {
                                                label: labelOption,
                                            },
                                            {
                                                label: labelOption,
                                            },
                                        ],
                                    }
                                )
                            }
                        }
                    }
                },
                right: 0,
            },
        };

        myChartBusinessResultReport.setOption(option);
        myChartBusinessResultReport.on('magictypechanged', function (obj) {
            if (obj.currentType === 'stack') {
                currentTypeBusinessResultReport = 'stack';
                myChartBusinessResultReport.setOption({
                    series: [
                        {
                            label: {show: false},
                        },
                        {
                            label: {show: false},
                        },
                        {
                            label: {show: false},
                        },
                    ],
                })
            } else {
                currentTypeBusinessResultReport = 'tiled';
            }
        })
    }
}
