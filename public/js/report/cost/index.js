let dataCostReportTable,
    typeActionCostReport = 1,
    timeActionCostReport = $("#calendar-day").val(),
    dateCostReport,
    yearCostReport,
    monthCostReport,
    fromDateCostReport,
    toDateCostReport,
    tabActiveCostReport;
let dataExcelCostReport = [];
let dataFilter = [];
let myChart = echarts.init(
    document.getElementById("chart-cost-report-main")
);
let checkSpamCostReport = 0;

$(function () {
    $("#chart-cost-report-main").css("min-height", "500px");

    $("#filter-sell-food-order-report").on(
        "dp.change",
        "#calendar-day, #calendar-month, #calendar-year",
        function () {
            typeActionCostReport = $(this).val();
        }
    );

    $(document).on("change", "#select-time-report", async function () {
        let timeVal = $(this).val();
        switch (timeVal) {
            case "day":
                typeActionCostReport = 1;
                timeActionCostReport = $("#calendar-day").val();
                fromDateCostReport = "";
                toDateCostReport = "";
                break;
            case "week":
                typeActionCostReport = 2;
                timeActionCostReport = moment().format("WW/YYYY");
                fromDateCostReport = "";
                toDateCostReport = "";
                break;
            case "month":
                typeActionCostReport = 3;
                timeActionCostReport = $("#calendar-month").val();
                fromDateCostReport = "";
                toDateCostReport = "";
                break;
            case "3month":
                typeActionCostReport = 4;
                timeActionCostReport = moment().format("MM/YYYY");
                fromDateCostReport = "";
                toDateCostReport = "";
                break;
            case "year":
                typeActionCostReport = 5;
                timeActionCostReport = $("#calendar-year").val();
                fromDateCostReport = "";
                toDateCostReport = "";
                break;
            case "3year":
                typeActionCostReport = 6;
                timeActionCostReport = moment().format("YYYY");
                fromDateCostReport = "";
                toDateCostReport = "";
                break;
            case "13":
                fromDateCostReport = "";
                toDateCostReport = "";
                detectDateOptionTimeCost(13);
                break;
            case "15":
                fromDateCostReport = "";
                toDateCostReport = "";
                detectDateOptionTimeCost(15);
                break;
            case "16":
                fromDateCostReport = "";
                toDateCostReport = "";
                detectDateOptionTimeCost(16);
                break;
            case "all_year":
                typeActionCostReport = 8;
                timeActionCostReport = moment().format("YYYY");
                fromDateCostReport = "";
                toDateCostReport = "";
                break;
        }
        await loadData();
    });
    $("#month .custom-button-search").on("click", function () {
        typeActionCostReport = 3;
        timeActionCostReport = $("#calendar-month").val();
        fromDateCostReport = "";
        toDateCostReport = "";
        loadData();
    });
    $("#year .custom-button-search").on("click", function () {
        typeActionCostReport = 5;
        timeActionCostReport = $("#calendar-year").val();
        fromDateCostReport = "";
        toDateCostReport = "";
        loadData();
    });
    $("#day .custom-button-search").on("click", function () {
        typeActionCostReport = 1;
        timeActionCostReport = $("#calendar-day").val();
        fromDateCostReport = "";
        toDateCostReport = "";
        loadData();
    });

    $(".search-date-option-filter-time-bar").on("click", async function () {
        await detectDateOptionTimeCost(Number($("#select-time-report").val()));
        loadData();
    });

    if (getCookieShared("cost-report-user-id-" + idSession)) {
        let dataCookie = JSON.parse(
            getCookieShared("cost-report-user-id-" + idSession)
        );
        tabActiveCostReport = dataCookie.tabActiveCostReport;
        dateCostReport = dataCookie.dateCostReport;
        monthCostReport = dataCookie.monthCostReport;
        yearCostReport = dataCookie.yearCostReport;
        $("#calendar-day").val(dateCostReport);
        $("#calendar-month").val(monthCostReport);
        $("#calendar-year").val(yearCostReport);
    }
    $("#type-time-group-cost-report button").on("click", function () {
        tabActiveCostReport = $(this).attr("id");
        updateCostReport();
    });
    $(
        '#type-time-group-cost-report button[id="' + tabActiveCostReport + '"]'
    ).click();
    loadData();

    // Vẽ lại chart khi kích thước màn hình thay đổi
    window.addEventListener('resize', function () {
        myChart.resize();
    });
});

function detectDateOptionTimeCost(type) {
    switch (type) {
        case 15:
            typeActionCostReport = 15;
            timeActionCostReport = "";
            fromDateCostReport = $(".from-month-filter-time-bar").val();
            toDateCostReport = $(".to-month-filter-time-bar").val();
            break;
        case 16:
            typeActionCostReport = 16;
            timeActionCostReport = "";
            fromDateCostReport = $(".from-year-filter-time-bar").val();
            toDateCostReport = $(".to-year-filter-time-bar").val();
            break;
        default:
            typeActionCostReport = 13;
            timeActionCostReport = "";
            fromDateCostReport = $(".from-date-filter-time-bar").val();
            toDateCostReport = $(".to-date-filter-time-bar").val();
    }
}

function updateCostReport() {
    saveCookieShared(
        "cost-report-user-id-" + idSession,
        JSON.stringify({
            tabActiveCostReport: tabActiveCostReport,
            dateCostReport: $("#calendar-day").val(),
            monthCostReport: $("#calendar-month").val(),
            yearCostReport: $("#calendar-year").val(),
        })
    );
}

async function loadData() {
    if (checkSpamCostReport === 1) return false;
    checkSpamCostReport = 1;
    let brand = $(".select-brand").val(),
        branch = $(".select-branch").val(),
        method = "get",
        url = "cost-report.data",
        params = {
            brand: brand,
            branch: branch,
            type: typeActionCostReport,
            time: timeActionCostReport,
            from_date: fromDateCostReport,
            to_date: toDateCostReport,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $("#chart-sell-cost-report-rounded"),
        $("#table-cost-report"),
    ]);
    checkSpamCostReport = 0;
    $(".empty-datatable-custom").remove();
    eChartPie(
        res.data[0].filter((i) => i.amount > 0),
        $("#chart-cost-report-main")
    );
    dataTableCostReport(res.data[2].original.data);
    $("#total").text(res.data[3].total_amount_cost);
    dataTotalCostReport(res.data[3].total_amount_cost);
    dataExcelCostReport = res.data[4].data;
}

async function dataTableCostReport(data) {
    let id = $("#table-cost-report"),
        fixed_left = 1,
        fixed_right = 1,
        column = [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                class: "text-center",
                width: "5%",
            },
            {
                data: "addition_fee_reason_content",
                name: "addition_fee_reason_content",
                className: "text-center",
            },
            { data: "amount", name: "amount", className: "text-center" },
            { data: "action", name: "action", className: "text-center", width: "5%" },
            { data: "keysearch", name: "keysearch", className: "d-none" },
        ],
        option = [
            {
                title: "Xuất excel",
                icon: "fi-rr-print",
                class: "seemt-btn-hover-blue",
                function: "exportExcelCostReport",
            },
        ];
    dataCostReportTable = await DatatableTemplateNew(
        id,
        data,
        column,
        vh_of_table_report,
        fixed_left,
        fixed_right,
        option
    );
    $(document).on(
        "input paste keyup",
        "#table-cost-report_filter",
        async function () {
            let totalAmount = 0;
            await dataCostReportTable
                .rows({ search: "applied" })
                .every(function () {
                    let row = $(this.node());
                    totalAmount += removeformatNumber(
                        row.find("td:eq(2)").text()
                    );
                });
            $("#total-amount-cost-report").text(formatNumber(totalAmount));
        }
    );
}

function dataTotalCostReport(data) {
    $("#total-amount-cost-report").text(data);
    // totalAmountCostReport = data
}

async function eChartPie(data) {
    if (data.length === 0) {
        $("#chart-cost-report-center").removeClass("d-none");
        $("#chart-cost-report-main").addClass("d-none");
        // $('#detail-value-cost-report-box').addClass('d-none')
    } else {
        $("#chart-cost-report-center").addClass("d-none");
        $("#chart-cost-report-main").removeClass("d-none");
        // $('#detail-value-cost-report-box').removeClass('d-none')
        $(window).on("resize", function () {
            myChart.resize();
        });
        let option = {
            title: {
                left: "center",
            },
            textStyle: {
                fontFamily:
                    '"Gilroy", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
            },
            tooltip: {
                trigger: "item",
                formatter: "{b} {d}%",
            },
            legend: {
                type: "scroll",
                orient: "horizontal",
                left: "center",
                bottom: 0,
            },
            dataset: {
                source: data,
            },
            toolbox: {
                feature: {
                    // dataView: {show: true},
                    saveAsImage: {
                        show: false,
                        type: "png",
                        title: "Tải ảnh xuống",
                    },
                    restore: { show: false },
                },
            },
            series: [
                {
                    name: false,
                    type: "pie",
                    radius: "60%",
                    center: ['50%', '40%'],
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: "rgba(0, 0, 0, 0.5)",
                        },
                    },
                    label: {
                        formatter: "{b} {d}%",
                        alignTo: "none",
                        edgeDistance: 10,
                        minMargin: 5,
                        fontSize: 14,
                        lineHeight: 15,
                        width: 200,
                        ellipsis: "...",
                    },
                    labelLine: {
                        minTurnAngle: 90,
                        length: 70,
                    },
                    percentPrecision: 1,
                    showInTooltip: false,
                },
            ],
        };
        option && myChart.setOption(option);
    }
}
