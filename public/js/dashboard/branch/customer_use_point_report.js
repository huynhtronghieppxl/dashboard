/**
 * Event
 */
$('#select-type-customer-use-point-report, #type-customer-use-point-report input').on('change', function () {
    load_data21 = 0;
    dataCustomerUsePointReport();
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-customer-use-point-report'), $('#select-type-customer-use-point-report'));
});
getTimeChangeSelectTypeDashboardReport($('#text-label-type-customer-use-point-report'), $('#select-type-customer-use-point-report'));

/**
 * Call data
 * @returns {Promise<void>}
 */
function dataCustomerUsePointReport() {
    $('.chart-customer-use-point-report-loading').remove();
    $('.loading-point-customer-report-loading').remove();
    if (load_data21 === 1) return false;
    load_data21 = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        type = $('#select-type-customer-use-point-report').val(),
        type_point = '-1',
        time = $('#select-type-customer-use-point-report option:selected').attr('data-time');
    console.log(time);
    $('#chart-customer-use-point-report').prepend(themeLoading($('#chart-customer-use-point-report').height(), 'chart-customer-use-point-report-loading'))
    $('.loading-point-customer-report').prepend(themeLoading($('.loading-point-customer-report').height(), 'loading-point-customer-report-loading'))
    axios({
        method: 'get',
        url: 'branch-dashboard.data-customer-use-point-report',
        params: {brand: brand, branch: branch, type: type, time: time, type_point:type_point}
    }).then(function (res) {
        console.log(12123,res);
        // chartCustomerUsePointReport(res.data[0]);
        chartCustomerUsePointEchartReport(res.data[0]);
        tableCustomerUsePointReport(res.data[1].original.data);
        $('.chart-customer-use-point-report-loading').remove();
        $('.loading-point-customer-report-loading').remove();
    }).catch(function (e) {
        console.log(e);
    });
}

function chartCustomerUsePointEchartReport(){
    let chartDom = document.getElementById('chart-customer-use-point-report');
    let myChart = echarts.init(chartDom);
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
    }
    let option = {
        tooltip: {
            trigger: 'axis',
            formatter : function (value, index){
                return value[0].marker + formatNumber(value[0].value);
            }
        },
        xAxis: {
            type: 'category',
            data: data.map(item=>{
                return item.timeline;
            }),
        },
        grid: {
            top : '2%',
            left: '1%',
            right: '2%',
            bottom: '1%',
            containLabel: true
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
                type: 'bar',
                smooth: true,
                stack: 'Total',
                data:  data.map(item=>{
                    return item.value;
                }),
                itemStyle : {
                    color : 'rgb(254, 93, 112)',
                },
            },
        ],
        toolbox: {
            show: true,
            right: 0,
            top: 0,
            feature: {
                myFeature: {
                    show: true,
                    icon: 'path://M432.45,595.444c0,2.177-4.661,6.82-11.305,6.82c-6.475,0-11.306-4.567-11.306-6.82s4.852-6.812,11.306-6.812C427.841,588.632,432.452,593.191,432.45,595.444L432.45,595.444z M421.155,589.876c-3.009,0-5.448,2.495-5.448,5.572s2.439,5.572,5.448,5.572c3.01,0,5.449-2.495,5.449-5.572C426.604,592.371,424.165,589.876,421.155,589.876L421.155,589.876z M421.146,591.891c-1.916,0-3.47,1.589-3.47,3.549c0,1.959,1.554,3.548,3.47,3.548s3.469-1.589,3.469-3.548C424.614,593.479,423.062,591.891,421.146,591.891L421.146,591.891zM421.146,591.891',
                    title: 'Xem chi tiết',
                    onclick: function () {
                        if ($('#chart-cost-current').hasClass('detail-chart')) {
                            $('#chart-cost-current').removeClass('detail-chart')
                            myChart.setOption(
                                {
                                    series: [
                                        {
                                            label: {show: false},
                                        }
                                    ],
                                }
                            )
                        } else {
                            $('#chart-cost-current').addClass('detail-chart')
                            myChart.setOption(
                                {
                                    series: [
                                        {
                                            label: labelOption,
                                        },
                                    ],
                                }
                            )
                        }
                    }
                },
            },
        }

    };

    option && myChart.setOption(option);
}



function chartCustomerUsePointReport(data) {
    try {
        if (data === null || data.length === 0) {
            nullDataImg($('#chart-customer-use-point-report'));
            return false;
        }
        AmCharts.makeChart("chart-customer-use-point-report",
            {
                "type": "serial",
                "theme": "none",
                "dataProvider": data,
                "startDuration": 1,
                "graphs": [{
                    "balloonText": "<span style='font-size:13px;'>[[category]]: <b>[[value]]</b></span>",
                    "bulletOffset": 10,
                    "bulletSize": 52,
                    "colorField": "color",
                    "cornerRadiusTop": 8,
                    "customBulletField": "bullet",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0,
                    "type": "column",
                    "valueField": "points"
                }],
                "marginTop": 0,
                "marginRight": 0,
                "marginLeft": 0,
                "marginBottom": 0,
                "autoMargins": false,
                "categoryField": "name",
                "categoryAxis": {
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "inside": true,
                    "tickLength": 0
                },
                "export": {
                    "enabled": true
                }
            });
    } catch (e) {
        console.log('Error chart-customer-use-point-report: ' + e);
    }
}

function tableCustomerUsePointReport(data) {
    let id = $('#table-customer-use-point-report'),
        scroll_Y = '60vh',
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'card', name: 'card', className: 'text-center'},
            {data: 'phone', name: 'phone', className: 'text-center'},
            {data: 'point', name: 'point', className: 'text-center'},
            {data: 'total_point', name: 'total_point', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center'},
        ];
    DatatableTemplate(id, data, column, scroll_Y, fixed_left, fixed_right)
}

/**
 * Reload Data
 */
function reloadCustomerUsePointReport() {
    load_data21 = 0;
    dataCustomerUsePointReport();
}

function a(){
    am5.ready(function() {
        var root = am5.Root.new("chart-customer-use-point-report");
        root.setThemes([
            am5themes_Animated.new(root)
        ]);
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
            panX: false,
            panY: false,
            wheelX: "panX",
            wheelY: "zoomX",
            layout: root.verticalLayout
        }));
        var colors = chart.get("colors");
        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
            categoryField: "country",
            renderer: am5xy.AxisRendererX.new(root, {
                minGridDistance: 30
            }),
            bullet: function (root, axis, dataItem) {
                return am5xy.AxisBullet.new(root, {
                    location: 0.5,
                    sprite: am5.Picture.new(root, {
                        width: 24,
                        height: 24,
                        centerY: am5.p50,
                        centerX: am5.p50,
                        src: dataItem.dataContext.icon
                    })
                });
            }
        }));
        xAxis.get("renderer").labels.template.setAll({
            paddingTop: 21
        });
        xAxis.data.setAll(data);
        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
            renderer: am5xy.AxisRendererY.new(root, {})
        }));
        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "visits",
            categoryXField: "country"
        }));
        series.columns.template.setAll({
            tooltipText: "{categoryX}: {valueY}",
            tooltipY: 0,
            strokeOpacity: 0,
            templateField: { fill: colors.next() }
        });
        series.data.setAll(data);
        series.appear();
        chart.appear(1000, 100);

    });
}
