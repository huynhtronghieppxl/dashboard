let typeFilterRechargePointCardReport,
    timeFilterRechargePointCardReport,
    fromFilterRechargePointCardReport,
    toFilterRechargePointCardReport;
typeFilterRechargePointCardReport = $(
    "#select-type-recharge-card-point-report select"
)
    .find("option:selected")
    .val();
timeFilterRechargePointCardReport = $(
    "#select-type-recharge-card-point-report select"
)
    .find("option:selected")
    .data("time");
/**
 * Event
 */
$("#select-type-recharge-card-point-report select").on("change", function () {
    loadDataRechargePointCardReport = 0;
    typeFilterRechargePointCardReport = $(this).val();
    timeFilterRechargePointCardReport = $(this)
        .find("option:selected")
        .data("time");
    switch (Number($(this).val())) {
        case 13:
            fromFilterRechargePointCardReport = $(this)
                .parents(".filter-dashboard-report")
                .find(".from-date-filter-time-bar")
                .val();
            toFilterRechargePointCardReport = $(this)
                .parents(".filter-dashboard-report")
                .find(".to-date-filter-time-bar")
                .val();
            break;
        case 15:
            fromFilterRechargePointCardReport = $(this)
                .parents(".filter-dashboard-report")
                .find(".from-month-filter-time-bar")
                .val();
            toFilterRechargePointCardReport = $(this)
                .parents(".filter-dashboard-report")
                .find(".to-month-filter-time-bar")
                .val();
            break;
        case 16:
            fromFilterRechargePointCardReport = $(this)
                .parents(".filter-dashboard-report")
                .find(".from-year-filter-time-bar")
                .val();
            toFilterRechargePointCardReport = $(this)
                .parents(".filter-dashboard-report")
                .find(".to-year-filter-time-bar")
                .val();
            break;
        default:
            fromFilterRechargePointCardReport = "";
            toFilterRechargePointCardReport = "";
    }
    dataRechargePointCardReport();
    getTimeChangeSelectTypeDashboardReport(
        $("#text-label-type-point-report"),
        $("#select-type-recharge-card-point-report")
    );
});
getTimeChangeSelectTypeDashboardReport(
    $("#text-label-type-point-report"),
    $("#select-type-recharge-card-point-report")
);

$("#select-option-type-sort-filter-report").on("change", function () {
    reloadRechargePointCardReport();
});

$("#select-option-type-point-filter-report").on("change", function () {
    reloadRechargePointCardReport();
});

$("#select-type-recharge-card-point-report .search-date-option-filter-time-bar").on("click", function () {
    detectDateOptionTimeRechargePoint(Number($('#select-type-recharge-card-point-report select').find('option:selected').val()))
    // if(!CheckDateFormTo(fromFilterRechargePointCardReport, toFilterRechargePointCardReport)) return false
    if(!checkDashboardCustomDateTimePicker($(this), $('#select-type-recharge-card-point-report select'))) return false;
    reloadRechargePointCardReport();
});

function detectDateOptionTimeRechargePoint(type) {
    switch (type){
        case 13:
            fromFilterRechargePointCardReport = $('#select-type-recharge-card-point-report select').parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterRechargePointCardReport = $('#select-type-recharge-card-point-report select').parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            fromFilterRechargePointCardReport = $('#select-type-recharge-card-point-report select').parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterRechargePointCardReport = $('#select-type-recharge-card-point-report select').parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            fromFilterRechargePointCardReport = $('#select-type-recharge-card-point-report select').parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterRechargePointCardReport = $('#select-type-recharge-card-point-report select').parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            fromFilterRechargePointCardReport = "";
            toFilterRechargePointCardReport = "" ;
    }
}
/**
 * Call data
 * @returns {Promise<void>}
 */
function dataRechargePointCardReport() {
    $(".chart-recharge-point-report-loading").remove();
    $(".loading-point-customer-report-loading").remove();
    if (loadDataRechargePointCardReport === 1) return false;
    loadDataRechargePointCardReport = 1;
    let brand = $(".select-brand").val(),
        branch = $(".select-branch").val(),
        type_sort = $("#select-option-type-sort-filter-report").val(),
        type_point = $("#select-option-type-point-filter-report").val();
    $("#chart-recharge-card-point-report").prepend(themeLoading($("#chart-recharge-card-point-report").height(),"chart-recharge-point-report-loading")
    );
    $("#chart-recharge-card-point-report-empty").prepend(
        themeLoading(
            $("#chart-recharge-card-point-report").height(),
            "chart-recharge-point-report-loading"
        )
    );
    $("#table-recharge-cart-point-report").prepend(
        themeLoading(
            $("#chart-recharge-card-point-report").height(),
            "loading-point-customer-report-loading"
        )
    );
    axios({
        method: "get",
        url: "branch-dashboard.data-recharge-point-report",
        params: {
            brand: brand,
            branch: branch,
            type: typeFilterRechargePointCardReport,
            time: timeFilterRechargePointCardReport,
            from: fromFilterRechargePointCardReport,
            to: toFilterRechargePointCardReport,
            type_point: type_point,
            type_sort: type_sort,
        },
    })
        .then(function (res) {
            console.log(res);
            if (res.data[0].length == 0) {
                $("#chart-recharge-card-point-report").addClass("d-none");
                $("#chart-recharge-card-point-report-empty").removeClass(
                    "d-none"
                );
            } else {
                $("#chart-recharge-card-point-report-empty").addClass("d-none");
                $("#chart-recharge-card-point-report").removeClass("d-none");
            }
            chartRechargePointEchartReport(res.data[0]);
            tableRechargePointCardReport(res.data[1].original.data);
            $(".chart-recharge-point-report-loading").remove();
            $(".loading-point-customer-report-loading").remove();
        })
        .catch(function (e) {
            console.log(e);
        });
}

function chartRechargePointEchartReport(data) {
    let heightChart = data.length > 40 ? (heightWindow <= 797 ? '55%': '70%') : (heightWindow <= 797 ? '65%': '75%');
    let chartDom = document.getElementById("chart-recharge-card-point-report");
    let myChart = echarts.init(chartDom);
    let option = {
        tooltip: {
            trigger: "axis",
            axisPointer: {
                type: "shadow",
            },
            textStyle:{
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
                    overflow: 'truncate', // sử dụng overflow để đảm bảo không bị cắt chữ khi text xuống hàng
                    width: 80,
                    showMinLabel: true,
                    showMaxLabel: true,
                    fontFamily: 'Roboto',
                },
                data: data.map((item) => {
                    return item.name;
                }),
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
                data: data.map((item) => {
                    return item.value;
                }),
                barMaxWidth: 20,
                itemStyle: {
                    color: '#2A74D9'
                }
            },
        ],
    };

    $(".detail-value-recharge-card-report").on("click", function () {
        if ($(".detail-value-recharge-card-report").is(":checked")) {
            myChart.setOption({
                series: {
                    label: {
                        show: true,
                        verticalAlign: "middle",
                        position: "top",
                        color: "rgba(0, 0, 0, 1)",
                        rotate: 0,
                        distance: 15,
                        fontWeight: "bolder",
                        fontFamily: "roboto",
                        formatter: function (param) {
                            return formatNumber(param.value);
                        },
                    },
                },
            });
        } else {
            myChart.setOption({
                series: {
                    label: { show: false },
                },
            });
        }
    });
    myChart.resize();
    $(window).on("resize", function () {
        myChart.resize();
    });
    option && myChart.setOption(option);
}

function tableRechargePointCardReport(data) {
    let id = $("#table-recharge-cart-point-report"),
        scroll_Y = "60vh",
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                class: "text-center",
                width: "5%",
            },
            {
                data: "avatar",
                name: "avatar",
                className: "text-left",
                width: "5%",
            },
            { data: "name", name: "first_name", className: "text-left" },
            {
                data: "restaurant_membership_card_name",
                name: "restaurant_membership_card_name",
                className: "text-left",
            },
            {
                data: "total_top_up_point",
                name: "total_top_up_point",
                className: "text-right",
            },
            {
                data: "top_up_point",
                name: "top_up_point",
                className: "text-right",
            },
            {
                data: "total_top_up_point_used",
                name: "total_top_up_point_used",
                className: "text-right",
            },
            {
                data: "top_up_point_used",
                name: "top_up_point_used",
                className: "text-right",
            },
            {
                data: "total_top_up_point_remaining",
                name: "total_top_up_point_remaining",
                className: "text-right",
            },
            { data: "action", name: "action", className: "text-center" },
        ];
    DatatableTemplateNew(id, data, column, scroll_Y, fixed_left, fixed_right);
}

/**
 * Reload Data
 */
function reloadRechargePointCardReport() {
    loadDataRechargePointCardReport = 0;
    dataRechargePointCardReport();
}
