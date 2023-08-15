/**
 * Event
 */
$('#select-type-customer-accumulate-point-report').on('change', function () {
    load_data20 = 0;
    dataCustomerAccumulatePointReport();
});

/**
 * Call data
 * @returns {Promise<void>}
 */
function dataCustomerAccumulatePointReport() {
    $('.chart-customer-accumulate-point-report-loading').remove();
    $('.loading-accumulate-report-loading').remove();
    if (load_data20 === 1) return false;
    load_data20 = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        type = $('#select-type-customer-accumulate-point-report').val(),
        time = $('#select-type-customer-accumulate-point-report').find(':selected').data('time');
    $('#chart-customer-accumulate-point-report').prepend(themeLoading($('#chart-customer-accumulate-point-report').height(), 'chart-customer-accumulate-point-report-loading'))
    $('.loading-accumulate-report').prepend(themeLoading($('.loading-accumulate-report').height(), 'loading-accumulate-report-loading'))
    axios({
        method: 'get',
        url: 'branch-dashboard.data-customer-accumulate-point-report',
        params: {brand: brand, branch: branch, type: type, time: time}
    }).then(function (res) {
        console.log(res);
        chartCustomerAccumulatePointReport(res.data[0]);
        tableCustomerAccumulatePointReport(res.data[1].original.data);
        $('.chart-customer-accumulate-point-report-loading').remove();
        $('.loading-accumulate-report-loading').remove();
    }).catch(function (e) {
        console.log(e);
    });
}

function chartCustomerAccumulatePointReport(data) {
    try {
        if (data === null || data.length === 0) {
            nullDataImg($('#chart-customer-accumulate-point-report'));
            return false;
        }
        AmCharts.makeChart("chart-customer-accumulate-point-report",
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
        console.log('Error chart-customer-accumulate-point-report: ' + e);
    }
}

function tableCustomerAccumulatePointReport(data) {
    let id = $('#table-customer-accumulate-point-report'),
        scroll_Y = '60vh',
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'card', name: 'card', className: 'text-center'},
            {data: 'phone', name: 'phone', className: 'text-center'},
            {data: 'accumulate_point', name: 'accumulate_point', className: 'text-center'},
            {data: 'total_accumulate_point', name: 'total_accumulate_point', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center'},
        ];
    DatatableTemplate(id, data, column, scroll_Y, fixed_left, fixed_right)
}

/**
 * Reload Data
 */
function reloadCustomerAccumulatePointReport() {
    load_data20 = 0;
    dataCustomerAccumulatePointReport();
}

function a() {
    am5.ready(function() {
        var root = am5.Root.new("chart-customer-accumulate-point-report");
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
            paddingTop: 20
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
