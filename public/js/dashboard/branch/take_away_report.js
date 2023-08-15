let chartTakeAwayReport = chartColumnEchart('chart-take-away-report'), loadDataTakeAwayReport;

$('#select-take-away-report').on('change', function () {
    loadDataTakeAwayReport = 0;
    dataTakeAwayReport();
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-off-menu-dishes-report'), $('#select-take-away-report'));
});
getTimeChangeSelectTypeDashboardReport($('#text-label-type-off-menu-dishes-report'), $('#select-take-away-report'));
$('#take-away-report').on('change', '#select-sort-take-away-report', function () {
    loadDataTakeAwayReport = 0;
    dataTakeAwayReport();
})

async function dataTakeAwayReport() {
    if (loadDataTakeAwayReport === 1) return false;
    loadDataTakeAwayReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        type = $('#select-take-away-report').val(),
        time = $('#select-take-away-report').find(':selected').data('time'),
        sortSelect = $('#select-sort-take-away-report').val();
    let method = 'get',
        url = 'branch-dashboard.data-take-away-report',
        params = {brand: brand, branch: branch, type: type, time: time, sortSelect},
        data = {};
    let res = await axiosTemplate(method, url, params, data, [$("#chart-take-away-report")]);
    drawEchartTakeAwayReportDashboard(res.data[0] === null
            ? []
            : res.data[0].map((i) => {
                return i.timeline;
            }),
        res.data[0] === null
            ? []
            : res.data[0].map((i) => {
                return i.total_amount;
            }),
        res.data[0] === null
            ? []
            : res.data[0].map((i) => {
                return i.original_amount;
            }),res.data[0] === null
            ? []
            : res.data[0].map((i) => {
                return i.quantity;
            }),
        res.data[2]);
}

function drawEchartTakeAwayReportDashboard(dataTimeline, dataTotalAmount, dataOriginalAmount, quantity, dataTotal){
    let heightChart =dataTimeline.length > 40 ? (heightWindow <= 797 ? '55%': '60%') : (heightWindow <= 797 ? '65%': '75%');
    try{
        if(dataTimeline.length === 0){
            $('#chart-take-away-report-empty').removeClass('d-none');
            $('#chart-take-away-report').addClass('d-none');
        } else {
            $('#chart-take-away-report-empty').addClass('d-none');
            $('#chart-take-away-report').removeClass('d-none');
        }
        let option = {
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                },
                textStyle: {
                    fontFamily: 'Roboto',
                    fontSize: 12
                },
                formatter: function (value, i) {
                    let colorBar = value.length > 1 ? `<div class="d-flex align-items-center">${value[1].marker} ${value[1].seriesName} : ${formatNumber(value[1].value)}</div>` : '';
                    return `<strong class="d-flex align-items-center">${value[0].name}</strong>
                            <div class="d-flex align-items-center">Số lượng món : ${quantity[value[0].dataIndex]}</div>
                            <div class="d-flex align-items-center">${value[0].marker} ${value[0].seriesName} : ${formatNumber(value[0].value)}</div>
                            ${colorBar}`;
                },
            },
            grid : {
                width: "90%",
                left: "7%",
                top: 80,
                height: heightChart
            },
            xAxis: [
                {
                    type: "category",
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
                    data: dataTimeline,
                },
            ],
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
                show: dataTimeline.length > 40,
                height: 20,
                startValue: 0,
                endValue: 39,
                // start: 0,
                // end:dataTimeline.length > 20 ? 19 : 100,
                xAxisIndex: 0,
                bottom: 0,
                realtime: true,
                zoomLock: true,
                showDetail: false,
                brushSelect: false
            }],
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
            },
            series: [
                {
                    name: "Giá bán",
                    type: "bar",
                    seriesLayoutBy: "row",
                    barGap: 0,
                    data: dataTotalAmount,
                    barMaxWidth: 20,
                    barCategoryGap: "10%",
                    emphasis: {
                        focus: 'series'
                    },
                    itemStyle: {
                        color: '#2A74D9'
                    }
                }
                ,{
                    name: "Giá vốn",
                    type: "bar",
                    seriesLayoutBy: "row",
                    data: dataOriginalAmount,
                    barMaxWidth: 20,
                    barCategoryGap: "10%",
                    emphasis: {
                        focus: 'series'
                    },
                    itemStyle: {
                        color: '#FFA400'
                    }
                },
            ],
        };

        if (option && typeof option === "object") {
            chartTakeAwayReport.setOption(option);
        }
    } catch (e) {
        console.log(e);
        $('#chart-take-away-report-empty').removeClass('d-none');
        $('#chart-take-away-report').addClass('d-none');
    }
    $('#detail-take-away-report').on('change', function () {
        const showLabels = $(this).is(':checked');

        const currentOptions = chartTakeAwayReport.getOption();
        const updatedSeries = currentOptions.series.map((seriesItem) => {
            return {
                ...seriesItem,
                label: {
                    show: showLabels,
                    verticalAlign: "middle",
                    position: [10, -5, 0, 0],
                    color: "#000",
                    rotate: 60,
                    distance: 15,
                    fontFamily: "roboto",
                    formatter: function (param) {
                        return formatNumber(param.value);
                    }
                }
            };
        });

        chartTakeAwayReport.setOption({
            series: updatedSeries
        });
    });
    chartTakeAwayReport.resize();
    $(window).on('resize', function (){
        chartTakeAwayReport.resize();
    });
}

/**
 * Reload Data
 */
function reloadTakeAwayReport() {
    loadDataTakeAwayReport = 0;
    dataTakeAwayReport();
}
