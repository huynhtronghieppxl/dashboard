let typeTimeSellVatReport = 1,
    timeSellVatReportV2 = moment().format('DD/MM/YYYY'),
    checkSpamVatReport = 0,
    myChartVatReport,
    currentTypeVatReport = "tiled",
    fromDateVatReport,
    toDateCateVatReport,
    tabActiveSellVatReport,
    dataExcelVatReport;

$(async function () {
    $(document).on("dp.change", "#calendar-day, #calendar-month, #calendar-year ", function () {
        timeSellVatReportV2 = $(this).val();
    });

    $('#detail-value-vat-report').on('change', function () {
        isVisibleDetailValueReport($('#detail-value-vat-report'), myChartVatReport);
    })

    $(document).on("change", "#select-time-report", async function () {
        let timeVal = $(this).val();
        switch (timeVal) {
            case "day":
                typeTimeSellVatReport = 1;
                timeSellVatReportV2 = $("#calendar-day").val();
                fromDateVatReport = '';
                toDateCateVatReport = '';
                break;
            case "week":
                typeTimeSellVatReport = 2;
                timeSellVatReportV2 = moment().format("WW/YYYY");
                fromDateVatReport = '';
                toDateCateVatReport = '';
                break;
            case "month":
                typeTimeSellVatReport = 3;
                timeSellVatReportV2 = $("#calendar-month").val();
                fromDateVatReport = '';
                toDateCateVatReport = '';
                break;
            case "3month":
                typeTimeSellVatReport = 4;
                timeSellVatReportV2 = moment().format("MM/YYYY");
                fromDateVatReport = '';
                toDateCateVatReport = '';
                break;
            case "year":
                typeTimeSellVatReport = 5;
                timeSellVatReportV2 = $("#calendar-year").val();
                fromDateVatReport = '';
                toDateCateVatReport = '';
                break;
            case "3year":
                typeTimeSellVatReport = 6;
                timeSellVatReportV2 = moment().format("YYYY");
                fromDateVatReport = '';
                toDateCateVatReport = '';
                break;
            case "13":
                fromDateVatReport = '';
                toDateCateVatReport = '';
                detectDateOptionTimeVat(13);
                break;
            case "15":
                fromDateVatReport = '';
                toDateCateVatReport = '';
                detectDateOptionTimeVat(15);
                break;
            case "16":
                fromDateVatReport = '';
                toDateCateVatReport = '';
                detectDateOptionTimeVat(16);
                break;
            case "all_year":
                typeTimeSellVatReport = 8;
                timeSellVatReportV2 = moment().format("YYYY");
                fromDateVatReport = '';
                toDateCateVatReport = '';
                break;
        }
        await loadData();
        isVisibleDetailValueReport($('#detail-value-vat-report'), myChartVatReport);
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
        await detectDateOptionTimeVat(Number($("#select-time-report").val()));
        loadData();
    });
    // Set cookie
    if (getCookieShared("sell-vat-report-user-id-" + idSession)) {
        let dataCookie = JSON.parse(
            getCookieShared("sell-vat-report-user-id-" + idSession)
        );
        tabActiveSellVatReport = dataCookie.tabActiveSellVatReport;
    }
    $("#btn-type-time-sell-vat-report button").on("click", function () {
        tabActiveSellVatReport = $(this).attr("id");
        updateCookieSellVatReport();
    });
    $("#btn-type-time-sell-vat-report button[id=" + tabActiveSellVatReport + "]"
    ).click();
    if(!($('.select-branch').val())) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }
    // End Cookie
});

async function loadData() {
    if (checkSpamVatReport === 1) return false;
    checkSpamVatReport = 1;
    let brand = $(".select-brand").val(),
        branch = $(".select-branch").val(),
        method = "get",
        url = "vat-report.data",
        params = {
            brand: brand,
            branch: branch,
            type: typeTimeSellVatReport,
            time: timeSellVatReportV2,
            from_date: fromDateVatReport,
            to_date: toDateCateVatReport,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $("#content-body-techres"),
    ]);
    checkSpamVatReport = 0;
    eChartVatSellReport(
        "chart-sell-vat-report-vertical-main",
        res.data[0] === null
            ? []
            : res.data[0].map((i) => {
                return i.timeline;
            }),
        res.data[0] === null
            ? []
            : res.data[0].map((i) => {
                return i.valueVat;
            }),
        res.data[0] === null
            ? []
            : res.data[0].map((i) => {
                return i.quantity;
            }),
        res.data[3].data.vat_amount
    );
    dataVatsTable(res.data[1].original.data);
    dataVatsTotal(res.data[2]);
    dataExcelVatReport = res.data[1].original.data;
}

function updateCookieSellVatReport() {
    saveCookieShared(
        "sell-vat-report-user-id-" + idSession,
        JSON.stringify({
            tabActiveSellVatReport: tabActiveSellVatReport,
        })
    );
}

async function dataVatsTable(data) {
    let fixedLeft = 2;
    let fixedRight = 0;
    let id = $("#table-sell-vat-report");
    let column = [
            {data: "DT_RowIndex", name: "DT_RowIndex", class: "text-center", width: "5%"},
            {data: "report_time", name: "report_time", class: "text-center"},
            {data: "vat_amount", name: "vat_amount", className: "text-center"},
            {data: "action", name: "action", className: "text-center"},
            {data: "keysearch", className: "d-none", width: "5%"},
        ],
        option = [
            {
                title: "Xuất excel",
                icon: "fi-rr-print",
                class: "seemt-btn-hover-blue",
                function: "exportExcelVatReport",
            },
        ];
    let dataTableVats = await DatatableTemplateNew(
        id,
        data,
        column,
        vh_of_table_report,
        fixedLeft,
        fixedRight,
        option
    );
    $(document).on(
        "input paste",
        "#table-sell-card2-report_filter",
        async function () {
            let totalAmount = 0;
            await dataTableVats.rows({search: "applied"}).every(function () {
                let row = $(this.node());
                totalAmount += removeformatNumber(row.find("td:eq(2)").text());
            });
            $("#total-value").text(formatNumber(totalAmount));
        }
    );
}

function dataVatsTotal(data) {
    $("#total").text(data.total);
    $("#total-value").text(data.total);
}

function detectDateOptionTimeVat(type) {
    switch (type) {
        case 15:
            typeTimeSellVatReport = 15;
            timeSellVatReportV2 = "";
            fromDateVatReport = $(".from-month-filter-time-bar").val();
            toDateCateVatReport = $(".to-month-filter-time-bar").val();
            break;
        case 16:
            typeTimeSellVatReport = 16;
            timeSellVatReportV2 = "";
            fromDateVatReport = $(".from-year-filter-time-bar").val();
            toDateCateVatReport = $(".to-year-filter-time-bar").val();
            break;
        default:
            typeTimeSellVatReport = 13;
            timeSellVatReportV2 = "";
            fromDateVatReport = $(".from-date-filter-time-bar").val();
            toDateCateVatReport = $(".to-date-filter-time-bar").val();
    }
}

async function eChartVatSellReport(id, dataTimeline, dataValueVAT, quantity, dataVATAmount) {
    let heightChart = dataTimeline.length > 40 ? ($(window).innerHeight() <= 797 ? '65%': '75%') : ($(window).innerHeight() <= 797 ? '75%': '80%');
    if (dataTimeline.length === 0 && dataValueVAT.length === 0) {
        $('#chart-sell-report-vertical-center').removeClass('d-none')
        $('#chart-sell-report-vertical-main').addClass('d-none')
        $('#detail-value-vat-report-box').addClass('d-none')
    } else {
        $('#chart-sell-report-vertical-center').addClass('d-none')
        $('#chart-sell-report-vertical-main').removeClass('d-none')
        $('#detail-value-vat-report-box').removeClass('d-none')
        let chartDom = document.getElementById(id);
        myChartVatReport = await echarts.init(chartDom);
        $(window).on('resize', function () {
            myChartVatReport.resize();
        });
        let option = {
            grid: {
                y: 50,
                top: 80,
                y2: 100,
                left: 100,
                right: 10,
                height: heightChart
            },
            title: {
                text: '{a|Tổng:} {b|' + formatNumber(dataVATAmount) + '} {a|VNĐ}',
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
            xAxis: {
                type: 'category',
                data: dataTimeline,
                axisTick: {
                    alignWithLabel: true,
                },
                axisLabel: {
                    interval: dataTimeline.length > 36 ? 2 : 0,
                    rotate: 45,
                    width: 120,
                    overflow: 'truncate',
                    ellipsis: '...'
                },
            },
            yAxis: {
                type: 'value',
                name: "SỐ TIỀN (VNĐ)",
                nameGap: 80,
                nameTextStyle: {
                    fontSize: 14,
                    fontWeight: 600,
                    fontFamily: 'Roboto'
                },
                nameRotate: 90,
                nameLocation: 'middle',
                axisLabel: {
                    formatter: function (value) {
                        return nFormatter(value);
                    }
                }
            },
            series: [
                {
                    name: 'Số tiền (VAT)',
                    type: 'line',
                    data: dataValueVAT,
                    smooth: true,
                    emphasis: {
                        focus: 'series'
                    },
                    itemStyle: {
                        color: '#2A74D9'
                    }
                },
            ],
            tooltip: {
                trigger: 'axis',
                position: 'top',
                textStyle: {
                    fontFamily: 'Roboto',
                    fontSize: 12
                },
                formatter: function (value, i) {
                    return `<div class="seemt-fz-16">${value[0].axisValue}</div>
                            <div class="d-flex align-items-center"><i class="fa-solid fa-circle mr-1" style="font-size: 5px"></i>Số lượng đơn : ${quantity[value[0].dataIndex]}</div>
                            <div class="d-flex align-items-center"><i class="fa-solid fa-circle mr-1" style="font-size: 5px"></i>Tổng tiền : ${formatNumber(value[0].value)}</div>`;
                },
            },
            toolbox: {
                show: true,
                itemSize: 20,
                feature: {
                    show: true,
                    showTitle: false,
                    myTool1: {
                        // show: true,
                        // icon: 'image://https://cdn-icons-png.flaticon.com/512/159/159604.png',
                        // title: 'Xem Chi tiết',
                        onclick: function (params) {
                            if (params.option.series[0].label.show) {
                                myChartVatReport.setOption(
                                    {
                                        toolbox: {
                                            showTitle: false,
                                            feature: {
                                                myTool1: {
                                                    icon: 'image://https://cdn-icons-png.flaticon.com/512/159/159604.png',
                                                    title: 'Ẩn chi tiết',
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
                                let labelOption = {
                                    show: true,
                                    verticalAlign: "middle",
                                    position: params.option.xAxis[0].type === "value" ? "inside" : "top",
                                    color: "rgba(0, 0, 0, 1)",
                                    rotate: 0,
                                    distance: 15,
                                    fontWeight: "bolder",
                                    fontFamily: "roboto",
                                    formatter: function (param) {
                                        return formatNumber(param.value);
                                    }
                                };
                                myChartVatReport.setOption(
                                    {
                                        toolbox: {
                                            showTitle: false,
                                            feature: {
                                                myTool1: {
                                                    // icon: 'image://https://cdn-icons-png.flaticon.com/512/565/565655.png',
                                                    // title : 'Xem chi tiết',
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
                                            },
                                        },
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
                                        ]
                                    }
                                )
                            }
                        }
                    }
                },
                right: 0,
            },
        };
        myChartVatReport.setOption(option);
    }
}
