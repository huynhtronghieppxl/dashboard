let typeRechargeReport = 1, timeRechargeReport = $('#calendar-day').val(), fromRechargeReport, toRechargeReport,
    myChartRechargeReport = chartColumnEchart('chart-recharge-card-vertical-main');

$(async function () {
    $(document).on("dp.change", "#calendar-day, #calendar-month, #calendar-year", function () {
        timeRechargeReport = $(this).val();
    });
    dateTimePickerTemplate($('#calendar-day'));
    dateTimePickerMonthYearTemplate($('#calendar-month'));
    dateTimePickerYearTemplate($('#calendar-year'));
    templateReportTypeOption();

    $(document).on("change", "#select-time-report", async function () {
        let timeVal = $(this).val();
        switch (timeVal) {
            case "day":
                typeRechargeReport = 1;
                timeRechargeReport = $('#calendar-day').val();
                fromRechargeReport = '';
                toRechargeReport = '';
                break;
            case "week":
                typeRechargeReport = 2;
                timeRechargeReport = moment().format("WW/YYYY");
                fromRechargeReport = '';
                toRechargeReport = '';
                break;
            case "month":
                typeRechargeReport = 3;
                timeRechargeReport = $("#calendar-month").val();
                fromRechargeReport = '';
                toRechargeReport = '';
                break;
            case "3month":
                typeRechargeReport = 4;
                timeRechargeReport = moment().format("MM/YYYY");
                fromRechargeReport = '';
                toRechargeReport = '';
                break;
            case "year":
                typeRechargeReport = 5;
                timeRechargeReport = $("#calendar-year").val();
                fromRechargeReport = '';
                toRechargeReport = '';
                break;
            case "3year":
                typeRechargeReport = 6;
                timeRechargeReport = moment().format("YYYY");
                fromRechargeReport = '';
                toRechargeReport = '';
                break;
            case "13":
                fromRechargeReport = '';
                toRechargeReport = '';
                detectDateOptionRechargeCard(13);
                break;
            case "15":
                fromRechargeReport = '';
                toRechargeReport = '';
                detectDateOptionRechargeCard(15);
                break;
            case "16":
                fromRechargeReport = '';
                toRechargeReport = '';
                detectDateOptionRechargeCard(16);
                break;
            case "all_year":
                typeRechargeReport = 8;
                timeRechargeReport = moment().format("YYYY");
                fromRechargeReport = '';
                toRechargeReport = '';
                break;
        }
        await loadData();
        isVisibleDetailValueReport($('#detail-value-recharge-card-report'), myChartRechargeReport)
    });
    $('#month .custom-button-search').on('click', function () {
        loadData();
    })
    $('#year .custom-button-search').on('click', function () {
        loadData();
    })

    $('#day .custom-button-search').on('click', function () {
        loadData();
    })
    $(".search-date-option-filter-time-bar").on("click", async function () {
        await detectDateOptionRechargeCard(Number($("#select-time-report").val()));
        loadData();
    });

    $(document).on('change', '#detail-value-recharge-card-report', function () {
        isVisibleDetailValueReport($('#detail-value-recharge-card-report'), myChartRechargeReport)
    })
    if (!($('.select-branch').val())) {
        await updateSessionBrandNew($('.select-brand'));
    } else {
        loadData();
    }
})

async function loadData() {
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        method = 'get',
        params = {
            brand: brand,
            branch: branch,
            type: typeRechargeReport,
            time: timeRechargeReport,
            from_date: fromRechargeReport,
            to_date: toRechargeReport,
        },
        data = null,
        url = 'deposit-to-card-report.data';
    let res = await axiosTemplate(method, url, params, data,
        [
            $('#chart-recharge-card-vertical-main-empty'),
            $('#chart-recharge-card-vertical-main'),
            $('#table-recharge-card-report'),
        ]);

    chartRechargePointEchartReport(res.data[0])
    dataRechargeTable(res.data[1].original.data)
}

async function dataRechargeTable(data) {
    let fixedLeft = 0;
    let fixedRight = 0;
    let id = $('#table-recharge-card-report');
    let column = [
            {data: "DT_RowIndex", name: "DT_RowIndex", class: "text-center", width: "5%"},
            {data: "avatar", name: "avatar", className: "text-left", width: "5%"},
            {data: "name", name: "first_name", className: "text-left"},
            {data: "restaurant_membership_card_name", name: "restaurant_membership_card_name", className: "text-left"},
            {data: "total_top_up_point", name: "total_top_up_point", className: "text-right"},
            {data: "top_up_point", name: "top_up_point", className: "text-right"},
            {data: "total_top_up_point_used", name: "total_top_up_point_used", className: "text-right"},
            {data: "top_up_point_used", name: "top_up_point_used", className: "text-right"},
            {data: "total_top_up_point_remaining", name: "total_top_up_point_remaining", className: "text-right"},
            {data: "action", name: "action", className: "text-center"},
        ],
        option = [];
    await DatatableTemplateNew(id, data, column, vh_of_table_report, fixedLeft, fixedRight, option);
}

function chartRechargePointEchartReport(data) {
    if (data.timeline.length === 0) {
        $('#chart-recharge-card-vertical-main-empty').removeClass('d-none');
        $('#chart-recharge-card-vertical-main').addClass('d-none');
        $('#detail-value-recharge-card-report-box').addClass('d-none');
    } else {
        $('#chart-recharge-card-vertical-main-empty').addClass('d-none');
        $('#chart-recharge-card-vertical-main').removeClass('d-none');
        $('#detail-value-recharge-card-report-box').removeClass('d-none');
    }
    let heightChart = data.timeline.length > 40 ? ($(window).innerHeight() <= 797 ? '65%' : '70%') : ($(window).innerHeight() <= 797 ? '75%' : '80%');
    let option = {
        tooltip: {
            trigger: "axis",
            axisPointer: {
                type: "shadow",
            },
            textStyle: {
                fontSize: 12,
                fontFamily: "Roboto"
            },
            formatter: function (value, i) {
                return `<strong class="d-flex align-items-center ">${value[0].axisValue}</strong>
                        <div class="d-flex align-items-center"><i class="fa-solid fa-circle mr-1" style="font-size: 5px"></i>Tổng tiền : ${formatNumber(value[0].value)}</div>`;
            },
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
                data: data.timeline
            },
        ],
        grid: {
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
                            return value % 1000000000 === 0
                                ? formatNumber(value / 1000000000) + " tỷ"
                                : formatNumber(
                                (value / 1000000000).toFixed(1)
                            ) + " tỷ";
                        }
                        if (value > 999999) {
                            return value % 1000000 === 0
                                ? formatNumber(value / 1000000) + " triệu"
                                : formatNumber((value / 1000000).toFixed(1)) +
                                " triệu";
                        }
                        if (value > 999) {
                            return value % 1000 === 0
                                ? formatNumber(value / 1000) + " ngàn"
                                : formatNumber((value / 1000).toFixed(1)) +
                                " ngàn";
                        }
                        if (value < -999999999) {
                            return value % 1000000000 === 0
                                ? formatNumber(value / 1000000000) + " tỷ"
                                : formatNumber(
                                (value / 1000000000).toFixed(1)
                            ) + " tỷ";
                        }
                        if (value < -999999) {
                            return value % 1000000 === 0
                                ? formatNumber(value / 1000000) + " triệu"
                                : formatNumber((value / 1000000).toFixed(1)) +
                                " triệu";
                        }
                        if (value < -999) {
                            return value % 1000 === 0
                                ? formatNumber(value / 1000) + " ngàn"
                                : formatNumber((value / 1000).toFixed(1)) +
                                " ngàn";
                        }
                    },
                    margin: 10,
                },
                name: "Số tiền sử dụng (VNĐ)",
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
            show: data.length > 40,
            height: 20,
            startValue: 0,
            endValue: 39,
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

    myChartRechargeReport.setOption(option);
    window.onresize = function () {
        myChartRechargeReport.resize();
    };
}

function detectDateOptionRechargeCard(type) {
    switch (type) {
        case 15:
            typeRechargeReport = 15;
            timeRechargeReport = "";
            fromRechargeReport = $(".from-month-filter-time-bar").val();
            toRechargeReport = $(".to-month-filter-time-bar").val();
            break;
        case 16:
            typeRechargeReport = 16;
            timeRechargeReport = "";
            fromRechargeReport = $(".from-year-filter-time-bar").val();
            toRechargeReport = $(".to-year-filter-time-bar").val();
            break;
        default:
            typeRechargeReport = 13;
            timeRechargeReport = "";
            fromRechargeReport = $(".from-date-filter-time-bar").val();
            toRechargeReport = $(".to-date-filter-time-bar").val();
    }
}
