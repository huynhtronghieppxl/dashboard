/**
 * Chart column vertical
 * @param data = [{
 *     timeline = xxx,
 *     value = yyy
 * }]
 * @param element = text id
 * @param titleX = $('#title-money-chart-component').val(),
 * @param unit = $('#unit-money-chart-component').val(),
 * @param color =  let color = "#0072bc",
 * @returns {boolean}
 */
let dataChartTemplateUpdate = [];

function chartColumnVerticalTemplate(data, element, titleX, unit, color) {
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
                "labelText": "[[value]]",
                "labelRotation": -90,
            }]
        });
    } catch (e) {
        console.log('Error Chart Vertical: ' + e);
    }
}

/**
 * Chart column vertical
 * @param data = [{
 *     timeline = xxx,
 *     value = yyy
 * }]
 * @param element = text id
 * @param titleX = $('#title-money-chart-component').val(),
 * @param unit = $('#unit-money-chart-component').val(),
 * @param color = $('#unit-money-chart-component').val(),
 * @returns {boolean}
 */
function chartColumnHorizontalTemplate(data, element, titleX, unit, color) {
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
                "labelRotation": 45
            },
            "valueAxes": [{
                "id": "a1",
                "title": titleX,
                "position": "top",
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
                "labelText": "[[value]]",
            }],
            "rotate": true
        });
    } catch (e) {
        console.log('Error Chart Horizontal: ' + e);
    }

}

/**
 * Chart line label
 * @param data = [{
 *     timeline = xxx,
 *     value = yyy
 * }]
 * @param element = text id
 * @param titleX = $('#title-money-chart-component').val(),
 * @param unit = $('#unit-money-chart-component').val(),
 * @param color = "#ffa233",
 * @returns {boolean}
 */
function chartLineLabelTemplate(data, element, titleX, unit, color) {
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
                "labelRotation": 45
            },
            "valueAxes": [{
                "id": "a3",
                "title": 'Số tiền (VNĐ)',
                "axisAlpha": 0,
                "labelFunction": function (value) {
                    return nFormatter(value);
                }
            }],
            "graphs": [{
                "id": "g3",
                "title": "value",
                "valueField": "value",
                "valueAxis": "a3",
                "lineColor": color,
                "balloonText": "[[label_text]]",
                "lineThickness": 2,
                "bullet": "round",
                "bulletBorderColor": color,
                "bulletBorderThickness": 1,
                "bulletBorderAlpha": 1,
                "dashLengthField": "dashLength",
                "animationPlayed": true,
                "showBalloon": true,
                "labelText": "[[label]]",
                "labelRotation": -45
            }]
        });
    } catch (e) {
        console.log('Error Chart Line Label: ' + e);
    }
}


/**
 * Chart pie
 * @param data
 * @param color
 * @param element = text id or class
 * @returns {boolean}
 */
function pieUnitChartTemplate(data, color, element) {
    if (data.length === 0 || data === null) {
        $('#' + element).html("<div class='empty-datatable-custom center-loading' ><img src='../../../../files/assets/images/nodata-datatable2.png'></div>");
        return false;
    }
    c3.generate({
        bindto: '#' + element,
        data: {
            columns: data,
            type: 'pie',
        },
        color: {
            pattern: color,
        },
        tooltip: {
            format: {
                value: function (value, ratio, id) {
                    let format = d3.format(',');
                    return format(value);
                }
            }
        }
    });
}


/**
 *
 * @param data
 * @param element
 * @returns {boolean}
 */
function pieChartMultiValueTemplate(data, element) {
    try {
        if (data.length === 0 || data === null) {
            $('#' + element).html(
                "<div class='empty-datatable-custom center-loading'><img src='../../../../files/assets/images/nodata-datatable2.png'></div>"
            );
            return false;
        }
        return AmCharts.makeChart(element, {
            "type": "pie",
            "theme": "light",
            "dataProvider": data,
            "valueField": "value",
            "titleField": "label",
            "addClassNames": false,
            "balloon": {
                "fixedPosition": true
            },
            "legend": {
                "position": "right",
                // "marginBottom": 10,
                "autoMargins": true
            },
        });
    } catch (e) {
        console.log('Error Pie Multi Chart: ' + e);
    }
}

/**
 *
 * @param data
 * @param element
 * @param titleX
 * @returns {boolean}
 */
function chartLineTemplate(data, element, titleX) {
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
                "labelRotation": 45
            },
            "valueAxes": [
                {
                    "id": "a1",
                    "axisAlpha": 0,
                    "title": "Số tiền (VNĐ)",
                    "labelFunction": function (value) {
                        return nFormatter(value);
                    }
                }],
            "graphs": [{
                "id": "g3",
                "title": "value",
                "valueField": "value",
                "valueAxis": "a3",
                "lineColor": "#fe5d70",
                // "balloonText": "<b>Chi phí:</b> [[value]] VNĐ",
                "lineThickness": 2,
                "legendValueText": "[[value]]",
                "bullet": "round",
                "bulletBorderColor": "#fe5d70",
                "bulletBorderThickness": 1,
                "bulletBorderAlpha": 1,
                "dashLengthField": "dashLength",
                "animationPlayed": true,
                "showBalloon": true,
                "type": "smoothedLine",
            }],
            "chartCursor": {
                "cursorAlpha": 0,
                "valueLineAlpha": 0.2
            }
        });
    } catch (e) {
        console.log('Error Line Chart: ' + e);
    }
}

function chartLineMultiTemplate(data, element) {
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
                "labelRotation": 45
            },
            "valueAxes": [
                {
                    "id": "a1",
                    "axisAlpha": 0,
                    "title": "Số tiền (VNĐ)",
                    "labelFunction": function (value) {
                        return nFormatter(value);
                    }
                }],
            "graphs": [{
                "id": "g1",
                "title": "data1",
                "valueField": "data1",
                "valueAxis": "a1",
                "lineColor": "#0072bc",
                "balloonText": "<b>Doanh thu:</b> [[value]] VNĐ",
                "lineThickness": 2,
                "legendValueText": "[[value]]",
                "bullet": "round",
                "bulletBorderColor": "#0072bc",
                "bulletBorderThickness": 1,
                "bulletBorderAlpha": 1,
                "dashLengthField": "dashLength",
                "animationPlayed": true,
                "showBalloon": true,
                "type": "smoothedLine",
            }, {
                "id": "g2",
                "title": "data2",
                "valueField": "data2",
                "valueAxis": "a2",
                "lineColor": "#0ac282",
                "balloonText": "<b>Lợi nhuận:</b> [[value]] VNĐ",
                "lineThickness": 2,
                "legendValueText": "[[value]]",
                "bullet": "round",
                "bulletBorderColor": "#0ac282",
                "bulletBorderThickness": 1,
                "bulletBorderAlpha": 1,
                "dashLengthField": "dashLength",
                "animationPlayed": true,
                "showBalloon": true,
                "type": "smoothedLine",
            }, {
                "id": "g3",
                "title": "data3",
                "valueField": "data3",
                "valueAxis": "a3",
                "lineColor": "#fe5d70",
                "balloonText": "<b>Chi phí:</b> [[value]] VNĐ",
                "lineThickness": 2,
                "legendValueText": "[[value]]",
                "bullet": "round",
                "bulletBorderColor": "#fe5d70",
                "bulletBorderThickness": 1,
                "bulletBorderAlpha": 1,
                "dashLengthField": "dashLength",
                "animationPlayed": true,
                "showBalloon": true,
                "type": "smoothedLine",
            }],
            "chartCursor": {
                "cursorAlpha": 0,
                "valueLineAlpha": 0.2
            }
        });
    } catch (e) {
        console.log('Error Line Chart Multi: ' + e);
    }
}

/**
 *
 * @param element (string)
 * @param data (string)
 */
function chartDonutTemplate(element, data) {
    try {
        if (JSON.parse(data.check) === 0) {
            let id = $('#null-' + element);
            nullDataImg(id);
            return false;
        }
        let ctx = document.getElementById(element).getContext("2d");
        window.myDoughnut = new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: JSON.parse(data.data),
                    backgroundColor: JSON.parse(data.colors),
                }],
                labels: JSON.parse(data.labels)
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: "",
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });
    } catch (e) {
        console.log("Error chart donut: " + e);
    }
}

/**
 * @param data = [data_check, data_chart_column, data_chart_color] full string
 * @param element = id-name
 * @returns {boolean}
 */
function chartC3MultipleTemplate(data, element) {
    try {
        if (data.check_chart === null || data.length === 0) {
            let id = $('#' + element);
            nullDataImg(id);
            return false;
        }
        c3.generate({
            bindto: '#' + element,
            data: {
                columns: JSON.parse(data.data_chart_column),
                type: 'pie',
                onclick: function (d, i) {
                    console.log("onclick", d, i);
                },
            },
            color: {
                pattern: JSON.parse(data.data_chart_color)
            },
            tooltip: {
                format: {
                    value: function (value, ratio, id) {
                        let format = d3.format(',');
                        return format(value) + 'VNĐ';
                    }
                }
            },
        });
    } catch (e) {
        console.log("Error chart C3 multiple: " + e);
    }
}


/*
* ECHART
* */

function chartColumnVerticalEchartTemplate(data, element, unit, color) {
    if (data.value === null || data.value.length === 0) {
        let id = $('#' + element);
        nullDataImg(id);
        return false;
    }
    let chartDom = document.getElementById(element);
    let myChart = echarts.init(chartDom, null, {
        renderer: 'canvas',
        useDirtyRect: false
    });
    let option = {
        tooltip: {
            trigger: 'axis',
            formatter: function (value, index) {
                return formatNumber(value[0]['value']) + ' VNĐ'
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        title: {
            show: data.value.length === 0,
            textStyle: {
                color: "grey",
                fontSize: 20
            },
            // text: "No data",
            left: "center",
            top: "center",
        },
        toolbox: {
            show: true,
            showTitle: false,
            itemSize: 20,
            feature: {
                show: true,
                showTitle: false,
                myTool2: {
                    icon: 'image://https://cdn-icons-png.flaticon.com/512/4262/4262066.png',
                    title: 'Biểu đồ dọc',
                    onclick: function (params) {
                        if (params.option.xAxis[0].type === "value") {
                            myChart.setOption({
                                xAxis: {
                                    type: 'category',
                                    data: data.timeline,
                                    axisTick: {
                                        alignWithLabel: true
                                    },
                                },
                                toolbox: {
                                    feature: {
                                        myTool2: {
                                            icon: 'image://https://cdn-icons-png.flaticon.com/512/4262/4262066.png',
                                            title: 'Biểu đồ ngang',
                                        }
                                    },
                                    tooltip: { // same as option.tooltip
                                        show: true,
                                        showTitle: false,
                                        formatter: function (param) {
                                            return '<div>' + param.title + '</div>'; // user-defined DOM structure
                                        },
                                        backgroundColor: '#222',
                                        textStyle: {
                                            fontSize: 12,
                                            color: '#fff'
                                        },
                                        extraCssText: 'box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);' // user-defined CSS styles
                                    }
                                },
                                yAxis: {
                                    type: 'value',
                                    name: "SỐ TIỀN (VNĐ)",
                                    nameGap: 80,
                                    nameTextStyle: {
                                        fontSize: 14,
                                        fontWeight: 600
                                    },
                                    nameRotate: 90,
                                    nameLocation: 'middle',
                                }
                            })
                        } else {
                            myChart.setOption({
                                xAxis: {
                                    type: 'value',
                                    name: "SỐ TIỀN (VNĐ)",
                                    nameGap: 80,
                                    nameTextStyle: {
                                        fontSize: 14,
                                        fontWeight: 600
                                    },
                                    nameRotate: 90,
                                    nameLocation: 'middle',
                                },
                                toolbox: {
                                    feature: {
                                        myTool2: {
                                            icon: 'image://https://cdn-icons-png.flaticon.com/512/3585/3585852.png',
                                            title: 'Biểu đồ dọc',
                                        }
                                    },
                                    tooltip: { // same as option.tooltip
                                        show: true,
                                        showTitle: false,
                                        formatter: function (param) {
                                            return '<div>' + param.title + '</div>'; // user-defined DOM structure
                                        },
                                        backgroundColor: '#222',
                                        textStyle: {
                                            fontSize: 12,
                                            color: '#fff'
                                        },
                                        extraCssText: 'box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);' // user-defined CSS styles
                                    }
                                },
                                yAxis: {
                                    type: 'category',
                                    data: data.timeline
                                }
                            })
                        }

                    },
                },
                myTool1: {
                    icon: 'image://https://cdn-icons-png.flaticon.com/512/159/159604.png',
                    title: 'Xem chi tiết',
                    onclick: function (params) {
                        if (params.option.series[0].label.show) {
                            myChart.setOption({
                                toolbox: {
                                    showTitle: false,
                                    feature: {
                                        myTool1: {
                                            icon: 'image://https://cdn-icons-png.flaticon.com/512/159/159604.png',
                                            title: 'Bỏ chi tiết',
                                        }
                                    },
                                    tooltip: { // same as option.tooltip
                                        show: true,
                                        showTitle: false,
                                        formatter: function (param) {
                                            return '<div>' + param.title + '</div>'; // user-defined DOM structure
                                        },
                                        backgroundColor: '#222',
                                        textStyle: {
                                            fontSize: 12,
                                            color: '#fff'
                                        },
                                        extraCssText: 'box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);' // user-defined CSS styles
                                    }
                                },
                                series: {
                                    label: {show: false},
                                },
                            })
                        } else {
                            myChart.setOption({
                                toolbox: {
                                    showTitle: false,
                                    feature: {
                                        myTool1: {
                                            icon: 'image://https://cdn-icons-png.flaticon.com/512/565/565655.png',
                                            title: 'Xem chi tiết',
                                        }
                                    },
                                    tooltip: { // same as option.tooltip
                                        show: true,
                                        showTitle: false,
                                        formatter: function (param) {
                                            return '<div>' + param.title + '</div>'; // user-defined DOM structure
                                        },
                                        backgroundColor: '#222',
                                        textStyle: {
                                            fontSize: 12,
                                            color: '#fff'
                                        },
                                        extraCssText: 'box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);' // user-defined CSS styles
                                    }
                                },
                                series: {
                                    label: {
                                        show: true,
                                        formatter: function (param) {
                                            return formatNumber(param.value);
                                        },
                                        textStyle: {
                                            fontSize: 12,
                                            color: '#fff'
                                        },
                                    },
                                },
                            })
                        }

                    }
                },
            },
            tooltip: {
                show: true,
                formatter: function (param) {
                    return '<div>' + param.title + '</div>'; // user-defined DOM structure
                },
                backgroundColor: '#222',
                textStyle: {
                    fontSize: 12,
                    color: '#fff'
                },
                extraCssText: 'box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);' // user-defined CSS styles
            },
            top: -5
        },
        xAxis: [
            {
                type: 'category',
                data: [],
                // axisTick: {
                //     alignWithLabel: true
                // },
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: "SỐ TIỀN (VNĐ)",
                nameGap: 80,
                nameTextStyle: {
                    fontSize: 14,
                    fontWeight: 600
                },
                nameRotate: 90,
                nameLocation: 'middle',
            }
        ],
        series: [
            {
                type: 'bar',
                barWidth: '60%',
                data: [],
                label: {
                    show: false,
                    color: "rgba(0, 0, 0, 1)",
                },
            }
        ]
    };
    option && myChart.setOption(option);
    $(window).on('resize', function () {
        myChart.resize();
    });
}


function chartPieEchartTemplate(data, element, color) {
    let chartDom = document.getElementById(element);
    let myChart = echarts.init(chartDom);
    let option = {
        tooltip: {
            trigger: 'item'
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
                    show: false,
                    position: 'center'
                },
                labelLine: {
                    show: false
                },
            },
        ]
    };
    option && myChart.setOption(option);
}

function chartColumnEchart(element) {
    element = echarts.init(document.getElementById(element));
    element.setOption({
        title: {
            textStyle: {
                color: "grey",
                fontSize: 20
            },
            // text: "No data",
            left: "center",
            top: "center",
        }
    });
    return element;
}

function updateChartColumnEchart(chart, data) {
    let heightChart = data.timeline.length > 40 ? ($(window).innerHeight() <= 797 ? '65%' : '77%') : ($(window).innerHeight() <= 797 ? '75%' : '80%');
    dataChartTemplateUpdate = data;
    let option = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            },
            textStyle: {
                fontSize: 12,
                fontFamily: "Roboto"
            },
            formatter: function (value, i) {
                return `<div class="seemt-fz-14 f-w-600 text-left">${value[0].axisValue}</div>
                        <div class="d-flex align-items-center"><i class="fa-solid fa-circle mr-1" style="font-size: 5px"></i>Số lượng đơn: ${data.quantity[value[0].dataIndex]}</div>
                        <div class="d-flex align-items-center"><i class="fa-solid fa-circle mr-1" style="font-size: 5px"></i>Tổng tiền: ${formatNumber(value[0].value)}</div>`;
            },
        },
        title: {
            text: '{a|Tổng:} {b|' + data.total_amount + '} {a|VNĐ}',
            left: 'center',
            top: 0,
            textStyle: {
                rich: {
                    a: {
                        fontSize: 16,
                        color: '#000',
                        fontWeight: '600',
                        fontFamily: 'Roboto'
                    },
                    b: {
                        fontSize: 16,
                        color: '#FA6342',
                        fontWeight: '600',
                        fontFamily: 'Roboto'
                    }
                }
            },
        },
        xAxis: [
            {
                type: "category",
                data: data.timeline,
                axisLabel: {
                    interval: 0,
                    rotate: 45,
                    fontSize: 12,
                    fontWeight: 500,
                    overflow: 'truncate',
                    width: 80,
                    showMinLabel: true,
                    showMaxLabel: true,
                    fontFamily: 'Roboto',
                },
                axisTick: {
                    show: true,
                    alignWithLabel: true
                },
            },
        ],
        grid: {
            y: 50,
            y2: 120,
            top: 80,
            width: "90%",
            left: "7%",
            height: heightChart
        },
        yAxis: [
            {
                axisLabel: {
                    inside: false,
                    formatter: function (value, index) {
                        if (value > 999999999) {
                            return value % 1000000000 === 0 ? formatNumber(value / 1000000000) + " tỷ" : formatNumber((value / 1000000000).toFixed(1)) + " tỷ";
                        }
                        if (value > 999999) {
                            return value % 1000000 === 0 ? formatNumber(value / 1000000) + " triệu" : formatNumber((value / 1000000).toFixed(1)) + " triệu";
                        }
                        if (value > 999) {
                            return value % 1000 === 0 ? formatNumber(value / 1000) + " ngàn" : formatNumber((value / 1000).toFixed(1)) + " ngàn";
                        }
                        if (value < -999999999) {
                            return value % 1000000000 === 0 ? formatNumber(value / 1000000000) + " tỷ" : formatNumber((value / 1000000000).toFixed(1)) + " tỷ";
                        }
                        if (value < -999999) {
                            return value % 1000000 === 0 ? formatNumber(value / 1000000) + " triệu" : formatNumber((value / 1000000).toFixed(1)) + " triệu";
                        }
                        if (value < -999) {
                            return value % 1000 === 0 ? formatNumber(value / 1000) + " ngàn" : formatNumber((value / 1000).toFixed(1)) + " ngàn";
                        }
                    },
                    margin: 10,
                },
                name: "SỐ TIỀN (VNĐ)",
                nameGap: 80,
                nameTextStyle: {
                    fontSize: 14,
                    fontWeight: 600,
                    fontFamily: "Roboto",
                },
                nameRotate: 90,
                nameLocation: "middle",
            },
        ],
        dataZoom: [{
            type: 'slider',
            show: data.timeline.length > 40,
            startValue: 0,
            endValue: 39,
            // start: 0,
            // end: data.timeline.length > 20 ? 19 : 100,
            xAxisIndex: 0,
            bottom: 0,
            realtime: true,
            zoomLock: true,
            showDetail: false,
            brushSelect: false
        }],
        series: [
            {
                name: "",
                type: "bar",
                seriesLayoutBy: "row",
                data: data.value,
                barMaxWidth: 30,
                itemStyle: {
                    color: '#2A74D9'
                }
            },
        ],
    };

    chart.setOption(option);
    window.onresize = function () {
        chart.resize();
    };
}

async function eChartThreeColumn(myChart, dataTimeline, dataValueTotal, dataValueOriginalTotal, dataValueProfit, dataTotal, quantity) {
    let heightChart = dataTimeline.length > 40 ? ($(window).innerHeight() <= 797 ? '70%' : '75%') : ($(window).innerHeight() <= 797 ? '80%' : '85%');

    $(window).on('resize', function () {
        myChart.resize();
    });
    let option = {
        grid: {
            y: 50,
            y2: 100,
            left: 100,
            right: 10,
            height: heightChart
        },
        dataZoom: [{
            type: 'slider',
            show: dataTimeline.length > 20,
            startValue: 0,
            endValue: 19,
            // start: 0,
            // end: dataTimeline.length > 20 ? 30 : 100,
            xAxisIndex: 0,
            realtime: true,
            zoomLock: true,
            showDetail: false,
            brushSelect: false
        }],
        xAxis: {
            type: 'category',
            data: dataTimeline,
            axisTick: {
                alignWithLabel: true,
            },
            axisLabel: {
                interval: 0,
                rotate: 45,
                fontSize: 12,
                fontWeight: 500,
                overflow: 'truncate',
                width: 80,
                showMinLabel: true,
                showMaxLabel: true,
                fontFamily: 'Roboto',
            },
        },
        yAxis: {
            type: 'value',
            scale: true,
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
                fontWeight: 600,
                fontFamily: "Roboto"
            },
            nameRotate: 90,
            nameLocation: 'middle',
        },
        legend: {
            show: true,
            textStyle: {
                rich: {
                    num: {
                        fontSize: 16,
                        color: "#fa6342",
                        fontWeight: "bold",
                    },
                }
            },
            formatter: function (name) {
                return `${name}: {num|${dataTotal[name]}}`;
            },
            top: 'top',
            selectMode: 'single'
        },
        series: [
            {
                name: 'Doanh thu',
                type: 'bar',
                barGap: 0,
                barMaxWidth: 30,
                data: dataValueTotal,
                emphasis: {
                    focus: 'series'
                },
                itemStyle: {
                    color: '#2A74D9'
                }
            },
            {
                name: 'Giá vốn',
                type: 'bar',
                barMaxWidth: 30,
                data: dataValueOriginalTotal,
                emphasis: {
                    focus: 'series'
                },
                itemStyle: {
                    color: '#FFA400'
                }
            },
            {
                name: 'Lợi nhuận',
                type: 'bar',
                barMaxWidth: 30,
                data: dataValueProfit,
                emphasis: {
                    focus: 'series'
                },
                itemStyle: {
                    color: '#009328'
                }
            },
        ],
        tooltip: {
            trigger: 'axis',
            position: 'top',
            textStyle: {
                fontFamily: 'Roboto'
            },
            formatter: function (value) {
                let valueBar;

                switch (value.length) {
                    case 1: valueBar = `<strong class="d-flex align-items-center">${value[0].name}</strong>
                            <div class="d-flex align-items-center">Số lượng món : ${quantity[value[0].dataIndex]}</div>
                            <div class="d-flex align-items-center">${value[0].marker} ${value[0].seriesName} : ${formatNumber(value[0].value)}</div>`
                        break;
                    case 2: valueBar = `<strong class="d-flex align-items-center">${value[0].name}</strong>
                            <div class="d-flex align-items-center">Số lượng món : ${quantity[value[0].dataIndex]}</div>
                            <div class="d-flex align-items-center">${value[0].marker} ${value[0].seriesName} : ${formatNumber(value[0].value)}</div>
                            <div class="d-flex align-items-center">${value[1].marker} ${value[1].seriesName} : ${formatNumber(value[1].value)}</div>`
                        break;
                    case 3: valueBar = `<strong class="d-flex align-items-center">${value[0].name}</strong>
                            <div class="d-flex align-items-center">Số lượng món : ${quantity[value[0].dataIndex]}</div>
                            <div class="d-flex align-items-center">${value[0].marker} ${value[0].seriesName} : ${formatNumber(value[0].value)}</div>
                            <div class="d-flex align-items-center">${value[1].marker} ${value[1].seriesName} : ${formatNumber(value[1].value)}</div>
                            <div class="d-flex align-items-center">${value[2].marker} ${value[2].seriesName} : ${formatNumber(value[2].value)}</div>`
                        break;
                }

                return valueBar;
            },
        },
    };
    myChart.setOption(option);
}

async function eChartProfit(chart, data) {
// chart = await echarts.init(chartDom);

    dataChartTemplateUpdate = data;
    let option = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            },
            formatter: function (value, i) {
                return `<div class="d-flex align-items-center">Tý suất lợi nhuận : ${formatNumber(value[0].value)} %</div>`;
            },
            textStyle: {
                fontFamily: "Roboto"
            }
        },
        xAxis: [
            {
                type: "category",
                data: data.timeline,
                axisLabel: {
                    interval: 0,
                    fontSize: 12,
                    rotate: 40,
                    fontFamily: "Roboto",
                },
                axisTick: {
                    show: true,
                    alignWithLabel: true
                },
            },
        ],
        grid: {
            y: 50,
            y2: 120,
            top: 80,
            width: "90%",
            left: "7%",
            height: "70%"
        },
        yAxis: [
            {
                axisLabel: {
                    inside: false,
                    margin: 10,
                },
                name: "TỶ SUẤT LỢI NHUẬN (%)",
                nameGap: 80,
                nameTextStyle: {
                    fontSize: 14,
                    fontWeight: 600,
                    fontFamily: "Roboto",
                },
                nameRotate: 90,
                nameLocation: "middle",
            },
        ],
        dataZoom: [{
            type: 'slider',
            show: data.timeline.length > 20,
            startValue: 0,
            endValue: 19,
            // start: 0,
            // end: data.timeline.length > 20 ? 19 : 100,
            xAxisIndex: 0,
            bottom: 0,
            realtime: true,
            zoomLock: true,
            showDetail: false,
            brushSelect: false
        }],
        series: [
            {
                name: "",
                type: "bar",
                seriesLayoutBy: "row",
                data: data.value,
                barMaxWidth: 250,
                itemStyle: {
                    color: '#FAC858'
                }
            },
        ],
    };

    chart.setOption(option);
    window.onresize = function () {
        chart.resize();
    };
}

