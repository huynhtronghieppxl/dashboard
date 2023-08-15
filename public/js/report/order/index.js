let chartOrder;
chartOrder = chartColumnOrderEchart('chart-vertical-order-report')
let typeActionOrderReport = 1, timeActionOrderReport = $('#calendar-day').val(), loadDataOrderReport = 0,
    timeFilterOrderReport = 0;
let fromDateOrderReport, toDateOrderReport, tableSellOrderReportByTime;
$( async function () {

    $(document).on("dp.change", "#calendar-day, #calendar-month, #calendar-year ", function () {
        timeActionOrderReport = $(this).val();
    });

    $(document).on("change", "#select-time-report", async function () {
        let timeVal = $(this).val();
        switch (timeVal) {
            case "day":
                typeActionOrderReport = 1;
                timeActionOrderReport = $('#calendar-day').val();
                fromDateOrderReport = '';
                toDateOrderReport = '';
                break;
            case "week":
                typeActionOrderReport = 2;
                timeActionOrderReport = moment().format('WW/YYYY');
                fromDateOrderReport = '';
                toDateOrderReport = '';
                break;
            case "month":
                typeActionOrderReport = 3;
                timeActionOrderReport = $('#calendar-month').val();
                fromDateOrderReport = '';
                toDateOrderReport = '';
                break;
            case "3month":
                typeActionOrderReport = 4;
                timeActionOrderReport = moment().format('MM/YYYY');
                fromDateOrderReport = '';
                toDateOrderReport = '';
                break;
            case "year":
                typeActionOrderReport = 5;
                timeActionOrderReport = $('#calendar-year').val();
                fromDateOrderReport = '';
                toDateOrderReport = '';
                break;
            case "3year":
                typeActionOrderReport = 6;
                timeActionOrderReport = moment().format('YYYY');
                fromDateOrderReport = '';
                toDateOrderReport = '';
                break;
            case "13":
                fromDateOrderReport = '';
                toDateOrderReport = '';
                detectDateOptionTimeOrder(13);
                break;
            case "15":
                fromDateOrderReport = '';
                toDateOrderReport = '';
                detectDateOptionTimeOrder(15);
                break;
            case "16":
                fromDateOrderReport = '';
                toDateOrderReport = '';
                detectDateOptionTimeOrder(16);
                break;
            case "all_year":
                typeActionOrderReport = 8;
                timeActionOrderReport = moment().format('YYYY');
                fromDateOrderReport = '';
                toDateOrderReport = '';
                break;
        }
        await loadData();
        isVisibleDetailValueReport($('#detail-value-order-report'), chartOrder)
    });

    $("#day .custom-button-search").on("click", function () {
        loadData();
    });

    $("#month .custom-button-search").on("click", function () {
        loadData();
    });

    $("#year .custom-button-search").on("click", function () {
        loadData();
    });

    $(".search-date-option-filter-time-bar").on("click", async function () {
        await detectDateOptionTimeOrder(Number($("#select-time-report").val()));
        loadData();
    });

    function detectDateOptionTimeOrder(type) {
        switch (type) {
            case 15:
                typeActionOrderReport = 15;
                timeActionOrderReport = "";
                fromDateOrderReport = $(".from-month-filter-time-bar").val();
                toDateOrderReport = $(".to-month-filter-time-bar").val();
                break;
            case 16:
                typeActionOrderReport = 16;
                timeActionOrderReport = "";
                fromDateOrderReport = $(".from-year-filter-time-bar").val();
                toDateOrderReport = $(".to-year-filter-time-bar").val();
                break;
            default:
                typeActionOrderReport = 13;
                timeActionOrderReport = "";
                fromDateOrderReport = $(".from-date-filter-time-bar").val();
                toDateOrderReport = $(".to-date-filter-time-bar").val();
        }
    }

    if(!$(".select-branch").val()) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }

    $('.type-chart-area-report-vertical').on('change', function () {
        if ($(this).val() == 1) {
            $('#div-chart-area-report-vertical').removeClass('d-none')
            $('#div-table-area-report-vertical').addClass('d-none')
        } else {
            $('#div-chart-area-report-vertical').addClass('d-none')
            $('#div-table-area-report-vertical').removeClass('d-none')
        }
    })
    let lastScrollTop = 0;
    $(".scroll-containers").on("scroll", function () {
        let now = $(this).scrollTop();
        if(now >= lastScrollTop && now > 0 ) {
            $(this).scrollTop($(this).height());
        }else {
            $(this).scrollTop(0)
        }
        lastScrollTop = now;
    });
})

async function loadData() {
    $('.chart-vertical-order-report-loading').remove();
    $('.chart-horizontal-order-report-loading').remove();
    $('.loading-order-report-loading').remove();
    // if (loadDataOrderReport === 1) return false;
    loadDataOrderReport = 1;
    let brand = $('.select-brand').val(),
        branch =$(".select-branch").val();
    $('#chart-vertical-order-report').prepend(themeLoading($('#chart-vertical-order-report').height(), 'chart-vertical-order-report-loading'))
    $('#chart-horizontal-order-report').prepend(themeLoading($('#chart-horizontal-order-report').height(), 'chart-horizontal-order-report-loading'))
    $('.loading-order-report').prepend(themeLoading($('.loading-order-report').height(), 'loading-order-report-loading'))

    let method= 'get',
        url= 'sell-order-report.data',
        params= {
            brand: brand,
            branch: branch,
            type: typeActionOrderReport,
            time: timeActionOrderReport,
            from: fromDateOrderReport,
            to: toDateOrderReport
        },
        data = null
    let res = await axiosTemplate(method, url, params, data,
        [$('#chart-sell-report-vertical'), $("#table-sell-order-report-by-time")])
        if (res.data[0].timeline.length === 0 && res.data[0].revenue.length === 0) {
            $('#chart-sell-report-vertical-center').removeClass('d-none')
            $('#chart-vertical-order-report').addClass('d-none')
            $('#detail-value-order-report-box').addClass('d-none')
        } else {
            $('#chart-sell-report-vertical-center').addClass('d-none')
            $('#chart-vertical-order-report').removeClass('d-none')
            $('#detail-value-order-report-box').removeClass('d-none')
            updateChartOrderColumnEchart(chartOrder, res.data[0], res.data[2].revenue);
            $('#detail-value-order-report').on('change', function () {
                if ($('#detail-value-order-report').is(':checked')) {
                    chartOrder.setOption({
                        series: {
                            label: {
                                show: true,
                                verticalAlign: "middle",
                                position: [10, -5, 0, 0],
                                color: "#000",
                                rotate: 0,
                                distance: 15,
                                fontFamily: "roboto",
                                formatter: function (param) {
                                    return formatNumber(param.value);
                                }
                            },
                        },
                    });
                } else {
                    chartOrder.setOption({
                        series: {
                            label: {show: false},
                        },
                    });
                }
            })
        }
        dataTableSellOrderReportByTime(res.data[1].original.data);
        tableSellOrderReportByTime =  res.data[1].original.data;
        // $('#total-order-report').text(res.data[2].order);
        $('#total').text(res.data[2].revenue);
        $('.chart-vertical-order-report-loading').remove();
        $('.chart-horizontal-order-report-loading').remove();
        $('.loading-order-report-loading').remove();
}
function chartColumnOrderEchart(element) {
    element = echarts.init(document.getElementById(element));
    return element;
}

async function dataTableSellOrderReportByTime(data) {
    console.log({data})
    let fixedLeft = 2;
    let fixedRight = 0;
    let id = $("#table-sell-order-report-by-time");
    let columns = [
            {data: "DT_RowIndex",name: "DT_RowIndex",class: "text-center",width: "5%",},
            {data: "report_time", name: "report_time", className: "text-left"},
            {data: "order", name: "order", className: "text-center"},
            {data: "revenue_without_vat_amount", name: "revenue_without_vat_amount", className: "text-right"},
            {data: "vat_amount" ,name: "vat_amount", className: "text-right"},
            {data: "revenue_amount", name: "revenue_amount",className: "text-right"},
            {data: "keysearch",  name: 'keysearch', className: "d-none", width: "5%"},
        ],
        option = [
            {
                title: "Xuất excel",
                icon: "fi-rr-print",
                class: "seemt-btn-hover-blue",
                function: "exportExcelSellOrderReportByTime",
            },
        ];
    await DatatableTemplateNew(id, data, columns, vh_of_table_report, fixedLeft, fixedRight, option);
}

function updateChartOrderColumnEchart(chart, data, totalAmount) {
    let heightChart = data.timeline.length > 40 ? ($(window).innerHeight() <= 797 ? '65%': '77%') : ($(window).innerHeight() <= 797 ? '75%': '80%');
    let option = {
        tooltip: {
            trigger: 'axis',
            // axisPointer: {
            //     type: 'shadow'
            // },
            textStyle: {
                fontFamily: 'Roboto',
                fontSize: 12
            },
            formatter: function (value, i) {
                return `Số tiền : ${formatNumber(data.revenue[value[0].dataIndex])}</div>`;
            },
        },
        title: {
            text: '{a|Tổng:} {b|' + totalAmount + '} {a|VNĐ}',
            left: 'center',
            top: 0, // Khoảng cách giữa tiêu đề và đỉnh biểu đồ
            textStyle: {
                rich: {
                    a: {
                        fontSize: 18,
                        color: '#000',
                        fontWeight: '600',
                        fontFamily: 'Roboto'
                    },
                    b: {
                        fontSize: 18,
                        color: '#FA6342',
                        fontWeight: '600',
                        fontFamily: 'Roboto'
                    }
                }
            },
        },
        xAxis: [
            {
                type: 'category',
                data: data.timeline,
                axisTick: {
                    alignWithLabel: true,
                },
                axisLabel: {
                    interval: data.timeline.length > 40 ? 2 : 0,
                    rotate: 30,
                    width: 120,
                    overflow: 'truncate',
                    ellipsis: '...'
                },
            },
        ],
        grid: {
            width: "90%",
            left: "7%",
            top: 80,
            height: heightChart,
        },
        yAxis: [
            {
                axisLabel: {
                    margin: 10,
                },
                name: "SỐ TIỀN",
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
        series: [
            {
                name: "",
                type: "line",
                smooth: true,
                data: data.revenue,
                itemStyle: {
                    color: '#2A74D9'
                }
            }
        ],
    };

    chart.setOption(option);
    window.onresize = function () {
        chart.resize();
    };
}

function reloadDataOrderChart() {
    loadDataOrderReport = 0;
    loadData();
}



