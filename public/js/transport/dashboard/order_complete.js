/**
 * Event
 */
$('#select-type-revenue-cost-profit-report').on('change', function () {
    load_data2 = 0;
    dataOrderCompleteTransportDashboard();
});

/**
 * Call data
 * @returns {Promise<void>}
 */
function dataOrderCompleteTransportDashboard() {
    // if (load_data2 === 1) return false;
    // load_data2 = 1;
    // let brand = $('#restaurant-branch-id-selected span').attr('data-value'),
    //     branch = $('#change_branch').val(),
    //     type = $('#select-type-revenue-cost-profit-report').val(),
    //     time = $('#select-type-revenue-cost-profit-report').find(':selected').data('time');
    axios({
        method: 'get',
        url: 'transport-dashboard.data-order-complete',
        params: {}
    }).then(async function (res) {
        console.log(res);
        let element = "chart-order-complete-transport-dashboard";
        chartLineMultiOrderCompleteTransportDashboard(res.data[0], element);
        $('.amcharts-axis-zero-grid').attr('stroke-opacity', 1);
    }).catch(function (e) {
        console.log(e);
    });
}

function chartLineMultiOrderCompleteTransportDashboard(data, element) {
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
                "axisColor": "#111111",
                "labelRotation": 45
            },
            "valueAxes": [
                {
                    "id": "a1",
                    "axisAlpha": 0,
                    "title": "Số đơn",
                    "labelFunction": function (value) {
                        return nFormatter(value);
                    }
                }],
            "graphs": [{
                "id": "g1",
                "title": "data1",
                "valueField": "data1",
                "valueAxis": "a1",
                "lineColor": "#ffa233",
                "balloonText": "<b>AhaMove:</b> [[value]] đơn",
                "lineThickness": 2,
                "legendValueText": "[[value]]",
                "bullet": "round",
                "bulletBorderColor": "#ffa233",
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
                "balloonText": "<b>Grab Express:</b> [[value]] đơn",
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
                "balloonText": "<b>J&T Express:</b> [[value]] đơn",
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
 * Reload Data
 */
function reloadOrderCompleteTransportDashboard() {
    load_data2 = 0;
    dataOrderCompleteTransportDashboard();
}
