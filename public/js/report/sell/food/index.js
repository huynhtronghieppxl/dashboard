let typeTimeSellFoodReport = 1,
    timeSellFoodReportV2 = $("#calendar-day-food").val(),
    checkSpamFoodReport = 0,
    myChartFoodReport = chartColumnEchart('chart-sell-food-report'),
    fromDateFoodReport,
    toDateCateFoodReport,
    tabActiveSellFoodReport,
    dataExcelFoodReport,
    selectSort = $('#select-sort-sell-food-report option:selected').val();

$(async function () {
    dateTimePickerTemplate($('#calendar-day-food'));
    dateTimePickerMonthYearTemplate($('#calendar-month-food'));
    dateTimePickerYearTemplate($('#calendar-year-food'));
    $(document).on("change", "#select-category-sell-food-report", function () {
        loadData();
    });
    $(document).on("dp.change", "#calendar-day-food, #calendar-month-food, #calendar-year-food ", function () {
        timeSellFoodReportV2 = $(this).val();
    });

    $('#detail-value-food-report').on('change', function () {
        isVisibleDetailValueFoodReport($('#detail-value-food-report'), myChartFoodReport);
    })

    $('#select-sort-sell-food-report').on('change', function () {
        selectSort = $('#select-sort-sell-food-report option:selected').val()
        loadData()
    })

    $(document).on("change", "#select-time-report", async function () {
        let timeVal = $(this).val();
        switch (timeVal) {
            case "day":
                $(".add-display").addClass("d-none");
                $("#day").removeClass("d-none");
                typeTimeSellFoodReport = 1;
                timeSellFoodReportV2 = $("#calendar-day-food").val();
                fromDateFoodReport = '';
                toDateCateFoodReport = '';
                break;
            case "week":
                $(".add-display").addClass("d-none");
                $("#week").removeClass("d-none");
                typeTimeSellFoodReport = 2;
                timeSellFoodReportV2 = moment().format("WW/YYYY");
                fromDateFoodReport = '';
                toDateCateFoodReport = '';
                break;
            case "month":
                $(".add-display").addClass("d-none");
                $("#month").removeClass("d-none");
                typeTimeSellFoodReport = 3;
                timeSellFoodReportV2 = $("#calendar-month-food").val();
                fromDateFoodReport = '';
                toDateCateFoodReport = '';
                break;
            case "3month":
                $(".add-display").addClass("d-none");
                typeTimeSellFoodReport = 4;
                timeSellFoodReportV2 = moment().format("MM/YYYY");
                fromDateFoodReport = '';
                toDateCateFoodReport = '';
                break;
            case "year":
                $(".add-display").addClass("d-none");
                $("#year.form-year-time-filter").removeClass("d-none");
                typeTimeSellFoodReport = 5;
                timeSellFoodReportV2 = $("#calendar-year-food").val();
                fromDateFoodReport = '';
                toDateCateFoodReport = '';
                break;
            case "3year":
                $(".add-display").addClass("d-none");
                typeTimeSellFoodReport = 6;
                timeSellFoodReportV2 = moment().format("YYYY");
                fromDateFoodReport = '';
                toDateCateFoodReport = '';
                break;
            case "13":
                $(".add-display").addClass("d-none");
                $('#btn-custom-time-filter').removeClass('d-none');
                $('#btn-custom-time-filter .custom-date').removeClass('d-none');
                fromDateFoodReport = '';
                toDateCateFoodReport = '';
                detectDateOptionTimeFood(13);
                break;
            case "15":
                $(".add-display").addClass("d-none");
                $('#btn-custom-time-filter').removeClass('d-none');
                $('#btn-custom-time-filter .custom-month').removeClass('d-none');
                fromDateFoodReport = '';
                toDateCateFoodReport = '';
                detectDateOptionTimeFood(15);
                break;
            case "16":
                $(".add-display").addClass("d-none");
                $('#btn-custom-time-filter').removeClass('d-none');
                $('#btn-custom-time-filter .custom-year').removeClass('d-none');
                fromDateFoodReport = '';
                toDateCateFoodReport = '';
                detectDateOptionTimeFood(16);
                break;
            case "all_year":
                $(".add-display").addClass("d-none");
                typeTimeSellFoodReport = 8;
                timeSellFoodReportV2 = moment().format("YYYY");
                fromDateFoodReport = '';
                toDateCateFoodReport = '';
                break;
        }
        await loadData();
        isVisibleDetailValueFoodReport($('#detail-value-food-report'), myChartFoodReport);
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
        await detectDateOptionTimeFood(Number($("#select-time-report").val()));
        loadData();
    });
    // Set cookie
    if (getCookieShared("sell-food-report-user-id-" + idSession)) {
        let dataCookie = JSON.parse(
            getCookieShared("sell-food-report-user-id-" + idSession)
        );
        tabActiveSellFoodReport = dataCookie.tabActiveSellFoodReport;
    }
    $("#btn-type-time-sell-food-report button").on("click", function () {
        tabActiveSellFoodReport = $(this).attr("id");
        updateCookieSellFoodReport();
    });
    $("#btn-type-time-sell-food-report button[id=" + tabActiveSellFoodReport + "]"
    ).click();
    if (!($('.select-branch').val())) {
        await updateSessionBrandNew($('.select-brand'));
    } else {
        loadData();
    }
    // End Cookie
});

async function loadData() {
    if (!$('.select-branch').val()) return false;
    if (checkSpamFoodReport === 1) return false;
    checkSpamFoodReport = 1;
    let brand = $(".select-brand").val(),
        branch = $(".select-branch").val(),
        inventory = $("#select-category-sell-food-report").val(),
        foodId = -1,
        method = "get",
        url = "food-report.data",
        params = {
            brand: brand,
            branch: branch,
            food_id: foodId,
            type: typeTimeSellFoodReport,
            time: timeSellFoodReportV2,
            inventory: inventory,
            from_date: fromDateFoodReport,
            to_date: toDateCateFoodReport,
            selectSort: selectSort
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $("#content-body-techres"),
    ]);
    if (res.data[0].length === 0 ) {
        $('#chart-sell-report-vertical-empty').removeClass('d-none')
        $('#chart-sell-food-report').addClass('d-none')
        $('#detail-value-food-report-box').addClass('d-none')
    } else {
        $('#chart-sell-report-vertical-empty').addClass('d-none')
        $('#chart-sell-food-report').removeClass('d-none')
        $('#detail-value-food-report-box').removeClass('d-none')
    }
    checkSpamFoodReport = 0;
    switch (parseInt(selectSort)) {
        case 3:
            myChartFoodReport.clear();
            eChartProfit(myChartFoodReport, res.data[5]);
            break;
        default:
            myChartFoodReport.clear();
            eChartThreeColumn(
                myChartFoodReport,
                res.data[0] === null
                    ? []
                    : res.data[0].map((i) => {
                        return i.timeline;
                    }),
                res.data[0] === null
                    ? []
                    : res.data[0].map((i) => {
                        return i.valueTotal;
                    }),
                res.data[0] === null
                    ? []
                    : res.data[0].map((i) => {
                        return i.valueOriginalTotal;
                    }),
                res.data[0] === null
                    ? []
                    : res.data[0].map((i) => {
                        return i.valueProfit;
                    }),
                res.data[4],
                res.data[0] === null
                    ? []
                    : res.data[0].map((i) => {
                        return i.quantity;
                    }),
            );
    }
    dataFoodsTable(res.data[1].original.data);
    dataFoodsTotal(res.data[2]);
    dataExcelFoodReport = res.data[1].original.data;
}

function updateCookieSellFoodReport() {
    saveCookieShared(
        "sell-food-report-user-id-" + idSession,
        JSON.stringify({
            tabActiveSellFoodReport: tabActiveSellFoodReport,
        })
    );
}

async function dataFoodsTable(data) {
    let fixedLeft = 2;
    let fixedRight = 0;
    let id = $("#table-sell-card2-report");
    let column = [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                class: "text-center",
                width: "5%",
            },
            {data: "avatar", name: "avatar"},
            {data: "quantity", name: "quantity", className: "text-right"},
            {
                data: "total_original_amount",
                name: "total_original_amount",
                className: "text-right",
            },
            {
                data: "total_amount",
                name: "total_amount",
                className: "text-right",
            },
            {data: "profit", name: "profit", className: "text-right"},
            {
                data: "profit_ratio",
                name: "profit_ratio",
                className: "text-right",
            },
            {
                data: "action",
                name: "action",
                className: "text-center",
                width: "5%",
            },
            {data: "keysearch", className: "d-none", width: "5%"},
        ],
        option = [
            {
                title: "Xuất excel",
                icon: "fi-rr-print",
                class: "seemt-btn-hover-blue",
                function: "exportExcelFoodReport",
            },
        ];
    let dataTableFoods = await DatatableTemplateNew(
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
            let totalQuantity = 0,
                totalOriginPrice = 0,
                totalAmount = 0,
                totalProfit = 0;
            await dataTableFoods.rows({search: "applied"}).every(function () {
                let row = $(this.node());
                totalQuantity += removeformatNumber(
                    row.find("td:eq(2)").text()
                );
                totalOriginPrice += removeformatNumber(
                    row.find("td:eq(4)").text()
                );
                totalAmount += removeformatNumber(row.find("td:eq(5)").text());
                totalProfit += removeformatNumber(row.find("td:eq(6)").text());
            });
            $("#total-quantity-card2").text(formatNumber(totalQuantity));
            $("#total-original-card2").text(formatNumber(totalOriginPrice));
            $("#total-money-card2").text(formatNumber(totalAmount));
            $("#total-profit-card2").text(formatNumber(totalProfit));
        }
    );
}

function dataFoodsTotal(data) {
    $("#total-money-card2").text(data.total);
    $("#total-quantity-card2").text(data.sum_quantity);
    $("#total-original-card2").text(data.sum_total_original);
    $("#total-profit-card2").text(data.sum_profit);
}

function detectDateOptionTimeFood(type) {
    switch (type) {
        case 15:
            typeTimeSellFoodReport = 15;
            timeSellFoodReportV2 = "";
            fromDateFoodReport = $(".from-month-filter-time-bar").val();
            toDateCateFoodReport = $(".to-month-filter-time-bar").val();
            break;
        case 16:
            typeTimeSellFoodReport = 16;
            timeSellFoodReportV2 = "";
            fromDateFoodReport = $(".from-year-filter-time-bar").val();
            toDateCateFoodReport = $(".to-year-filter-time-bar").val();
            break;
        default:
            typeTimeSellFoodReport = 13;
            timeSellFoodReportV2 = "";
            fromDateFoodReport = $(".from-date-filter-time-bar").val();
            toDateCateFoodReport = $(".to-date-filter-time-bar").val();
    }
}

function isVisibleDetailValueFoodReport(checkBoxElm, chartReport) {
    const isChecked = checkBoxElm.is(':checked');
    const labelOption = isChecked ? {
        show: true,
        verticalAlign: "middle",
        position: [10, -5, 0, 0],
        color: "#000",
        rotate: 60,
        distance: 15,
        fontFamily: "roboto",
        formatter: function (param) {
            return formatNumber(param.value);
        }
    } : {
        show: false
    };
    const series = chartReport.getOption().series;
    for (let i = 0; i < series.length; i++) {
        series[i].label = labelOption;
    }
    chartReport.setOption({
        series: series
    });
}
