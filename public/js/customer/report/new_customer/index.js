// let tableNewCustomerReport, typeActionNewCustomerReport = 1,
//     timeActionNewCustomerReport = $('#calendar-day-new-customer-report').val(),
//     indexButtonTabNewCustomerReport, dateNewCustomerReport,
//     monthNewCustomerReport,yearNewCustomerReport;
// let dataExcelNewCustomerReport = [];
// let checkGetNewCustomerTime = 0;
//
// $(function () {
//     dateTimePickerTemplate($('#calendar-day-new-customer-report'));
//     dateTimePickerMonthYearTemplate($('#calendar-month-new-customer-report'));
//     dateTimePickerYearTemplate($('#calendar-year-new-customer-report'));
//     if(getCookieShared('new-customer-report-user-id-' + idSession)){
//         let dataCookie = JSON.parse(getCookieShared('new-customer-report-user-id-' + idSession));
//         typeActionNewCustomerReport = dataCookie.index
//         timeActionNewCustomerReport = dataCookie.time
//         dateNewCustomerReport = dataCookie.dateNewCustomerReport
//         monthNewCustomerReport = dataCookie.monthNewCustomerReport
//         yearNewCustomerReport = dataCookie.yearNewCustomerReport
//         $('#calendar-day-new-customer-report').val(dateNewCustomerReport);
//         $('#calendar-month-new-customer-report').val(monthNewCustomerReport);
//         $('#calendar-year-new-customer-report').val(yearNewCustomerReport);
//     }
//     $('#calendar-day-new-customer-report').on('dp.change', function () {
//         typeActionNewCustomerReport = 1;
//         timeActionNewCustomerReport = $('#calendar-day-new-customer-report').val();
//         loadData();
//         updateCookieNewCustomerReport()
//     });
//     $('#calendar-month-new-customer-report').on('dp.change', function () {
//         typeActionNewCustomerReport = 3;
//         timeActionNewCustomerReport = $('#calendar-month-new-customer-report').val();
//         loadData();
//         updateCookieNewCustomerReport()
//     });
//     $('#calendar-year-new-customer-report').on('dp.change', function () {
//         typeActionNewCustomerReport = 5;
//         timeActionNewCustomerReport = $('#calendar-year-new-customer-report').val();
//         loadData();
//         updateCookieNewCustomerReport()
//     });
//     $('#index-tab-new-customer-report button').on('click', function (){
//         indexButtonTabNewCustomerReport = $(this).data('index');
//         typeActionNewCustomerReport = indexButtonTabNewCustomerReport
//         switch (indexButtonTabNewCustomerReport) {
//             case 1:
//                     timeActionNewCustomerReport = $('#calendar-day-new-customer-report').val();
//                 break;
//             case 3:
//                 timeActionNewCustomerReport = $('#calendar-month-new-customer-report').val();
//                 break;
//             case 5:
//                 timeActionNewCustomerReport = $('#calendar-year-new-customer-report').val();
//                 break;
//         }
//         updateCookieNewCustomerReport();
//         loadData();
//     })
//     $('#index-tab-new-customer-report button[data-index="' + typeActionNewCustomerReport + '"]').click()
// });
//
// function updateCookieNewCustomerReport(){
//     saveCookieShared('new-customer-report-user-id-' + idSession, JSON.stringify({
//         index : indexButtonTabNewCustomerReport,
//         time : timeActionNewCustomerReport,
//         dateNewCustomerReport : $('#calendar-day-new-customer-report').val(),
//         monthNewCustomerReport : $('#calendar-month-new-customer-report').val(),
//         yearNewCustomerReport : $('#calendar-year-new-customer-report').val(),
//     }))
// }
//
// async function loadData() {
//     if(checkGetNewCustomerTime === 1) return false;
//     let method = 'get',
//         params = {type: typeActionNewCustomerReport, time: timeActionNewCustomerReport},
//         data = null,
//         url = 'new-customer-report.data';
//     checkGetNewCustomerTime = 1;
//     let res = await axiosTemplate(method, url, params, data,[
//         $("#load-chart-new-customer-report-vertical"),
//         $("#chart-new-customer-report-vertical"),
//         $("#table-new-customer-report"),
//     ]);
//     checkGetNewCustomerTime = 0;
//     chartRevenueVertical(res.data[0]);
//     chartRevenueHorizontal(res.data[0]);
//     await dataTableNewCustomerReport(res.data[1].original.data);
//     dataTotalNewCustomerReport(res.data[4]);
//     dataExcelNewCustomerReport = res.data[3].data.list;
// }
//
// function chartRevenueVertical(data) {
//     let element = 'chart-new-customer-report-vertical';
//     let titleX = $('#title-quantity-chart-component').val();
//     let unit = '';
//     let color = "#0072bc";
//     chartColumnVerticalTemplate(data, element, titleX, unit, color);
// }
//
// function chartRevenueHorizontal(data) {
//     let element = 'chart-new-customer-report-horizontal';
//     let titleX = $('#title-quantity-chart-component').val();
//     let unit = '';
//     let color = "#0072bc";
//     chartColumnHorizontalTemplate(data, element, titleX, unit, color);
// }
//
// async function dataTableNewCustomerReport(data) {
//     let scroll_Y = '65vh';
//     let fixedLeft = 2;
//     let fixedRight = 0;
//     let id = $('#table-new-customer-report');
//     let column = [
//         {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
//         {data: 'name', name: 'name', width: '5%'},
//         {data: 'gender', name: 'gender', className: 'text-center'},
//         {data: 'created_at', name: 'created_at', className: 'text-center'},
//         {data: 'restaurant_membership_card_name', name: 'restaurant_membership_card_name', className: 'text-center'},
//         {data: 'point', name: 'point', className: 'text-center'},
//         {data: 'keysearch', className: 'd-none'},
//     ],
//         option = [{
//             'title': 'Xuất Excel',
//             'icon': 'fa fa-download text-warning',
//             'class': '',
//             'function': 'exportExcelNewCustomerReport',
//         }]
//     tableNewCustomerReport = await DatatableTemplateNew(id, data, column, scroll_Y, fixedLeft, fixedRight, option);
//     $(document).on('input paste', '#table-new-customer-report_filter', async function () {
//         let totalPoint = 0;
//         await tableNewCustomerReport.rows({'search': 'applied'}).every(function () {
//             let row = $(this.node());
//             totalPoint += removeformatNumber(row.find('td:eq(5)').text());
//         })
//         $('#total-accumulate-point-new-customer-report').text(formatNumber(totalPoint));
//     })
// }
//
// function dataTotalNewCustomerReport(data) {
//     $('#total-accumulate-point-new-customer-report').text(data.total_point_new_customer);
// }


let chartReportCustomerNew, loadDataCustomerNew = 0, tableNewCustomerReport;
let typeTimeCustomerNewReport = 1,
    timeCustomerNewReportV2 = $("#calendar-day").val(),
    checkSpamCustomerNewReport = 0,
    myChartCustomerNewReport,
    currentTypeCustomerNewReport = "tiled",
    fromDateCustomerNewReport,
    toDateCateCustomerNewReport,
    tabActiveCustomerNewReport,
    dataExcelNewCustomerReport = [], timeVal;

$(function () {
    /** click btn filter **/
    $("#select-time-customer-new-report").on("change", async function () {
        loadDataCustomerNew = 0;
        // loadData();
    });
    loadData();
    $(document).on("dp.change", "#calendar-day, #calendar-month, #calendar-year ", function () {
        loadDataCustomerNew = 0;
        timeCustomerNewReportV2 = $(this).val();
    });

    // $('#detail-value-report-new-customer').on('change', function () {
    //     isVisibleDetailValueDiscountReport($('#detail-value-report-new-customer'), chartReportCustomerNew);
    // })

    // $('.seemt-main').on('load resize scroll', function () {
    //     $('.card-inview-dashboard').each(function () {
    //         if ($(this).isInViewport()) {
    //             $('.bg-customer-default').removeClass('active');
    //             $('.' + $(this).data('key')).addClass('active');
    //             loadDataReport(parseInt($('.' + $(this).data('key')).data('position')));
    //             return false;
    //         }
    //     });
    // });

    $(document).on("change", "#select-time-customer-new-report", async function () {
        timeVal = $(this).val();
        switch (timeVal) {
            case "1":
                typeTimeCustomerNewReport = 1;
                timeCustomerNewReportV2 = $("#calendar-day").val();
                fromDateCustomerNewReport = '';
                toDateCateCustomerNewReport = '';
                break;
            case "2":
                typeTimeCustomerNewReport = 2;
                timeCustomerNewReportV2 = $("#select-time-customer-new-report option:selected").data('time'),
                fromDateCustomerNewReport = '';
                toDateCateCustomerNewReport = '';
                break;
            case "3":
                typeTimeCustomerNewReport = 3;
                timeCustomerNewReportV2 = $("#calendar-month").val();
                fromDateCustomerNewReport = '';
                toDateCateCustomerNewReport = '';
                break;
            case "4":
                typeTimeCustomerNewReport = 4;
                timeCustomerNewReportV2 = $("#select-time-customer-new-report option:selected").data('time'),
                fromDateCustomerNewReport = '';
                toDateCateCustomerNewReport = '';
                break;
            case "5":
                typeTimeCustomerNewReport = 5;
                timeCustomerNewReportV2 = $("#calendar-year").val();
                fromDateCustomerNewReport = '';
                toDateCateCustomerNewReport = '';
                break;
            case "6":
                typeTimeCustomerNewReport = 6;
                timeCustomerNewReportV2 = $("#select-time-customer-new-report option:selected").data('time'),
                fromDateCustomerNewReport = '';
                toDateCateCustomerNewReport = '';
                break;
            case "13":
                fromDateCustomerNewReport = '';
                toDateCateCustomerNewReport = '';
                detectDateOptionTimeNewCustomer(13);
                break;
            case "15":
                fromDateCustomerNewReport = '';
                toDateCateCustomerNewReport = '';
                detectDateOptionTimeNewCustomer(15);
                break;
            case "16":
                fromDateCustomerNewReport = '';
                toDateCateCustomerNewReport = '';
                detectDateOptionTimeNewCustomer(16);
                break;
            case "8":
                typeTimeCustomerNewReport = 8;
                timeCustomerNewReportV2 = moment().format("YYYY");
                fromDateCustomerNewReport = '';
                toDateCateCustomerNewReport = '';
                break;
        }
        await loadData();
        // isVisibleDetailValueDiscountReport($('#detail-value-report-new-customer'), chartReportCustomerNew);
    });

    $("#day .custom-button-search").on("click", function () {
        loadData();
        getReportCustomerNew();
    });

    $("#month .custom-button-search").on("click", function () {
        getReportCustomerNew();
        loadData();
    });

    $("#year .custom-button-search").on("click", function () {
        getReportCustomerNew();
        loadData();
    });
    $(".search-date-option-filter-time-bar").on("click", async function () {
        await detectDateOptionTimeNewCustomer(Number($("#select-time-customer-new-report").val()));
        if(!CheckDateFormTo(fromDateCustomerNewReport, toDateCateCustomerNewReport)) return false
        loadData();
    });
    // Set cookie
    if (getCookieShared('new-customer-report-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('sell-order-report-user-id-' + idSession));
        tabActiveCustomerNewReport = dataCookie.tabActiveCustomerNewReport;
        dateCustomerNewReport = dataCookie.day;
        monthCustomerNewReport = dataCookie.month;
        yearCustomerNewReport = dataCookie.year;
        $('#calendar-day').val(dateCustomerNewReport);
        $('#calendar-month').val(monthCustomerNewReport);
        $('#calendar-year').val(yearCustomerNewReport);
    } else {
        loadData();
    }

    $(window).on('resize', function (){
        chartReportCustomerNew.resize();
    });
})

function updateCookieNewCustomerReport() {
    saveCookieShared('new-customer-report-user-id-' + idSession, JSON.stringify({
        tabActiveCustomerNewReport : tabActiveCustomerNewReport,
        day : $('#calendar-day').val(),
        month : $('#calendar-month').val(),
        year : $('#calendar-year').val()
    }))
}

async function loadData() {
    updateCookieNewCustomerReport();
    let  url = 'report-customer-new.detail',
        method = 'get',
        params = {
            report_type: typeTimeCustomerNewReport,
            string_date: timeCustomerNewReportV2,
            from_date: fromDateCustomerNewReport,
            to_date: toDateCateCustomerNewReport,

        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
    await getReportCustomerNew();
    dataTableNewCustomerReport(res);
    dataExcelNewCustomerReport = res.data[0].original.data;
    $('#total-accumulate-point-new-customer-report').text(formatNumber(res.data[1].total_accumulate_point));
}

async function getReportCustomerNew() {
    if(loadDataCustomerNew == 1) return false;
    loadDataCustomerNew = 1;
    $('.loading-customer-new-report-loading').remove();
    $('#chart-new-customer-report').prepend(themeLoading($('.loading-customer-new-report').height(), 'loading-customer-new-report-loading'))
    axios({
        method: 'get',
        url: 'report-customer-new.data',
        params: {
            report_type: typeTimeCustomerNewReport,
            string_date: timeCustomerNewReportV2,
            from_date: fromDateCustomerNewReport,
            to_date: toDateCateCustomerNewReport,
        }
    }).then(function (res) {
        console.log(res);
        loadDataCustomerNew = 0;
        drawChartReportCustomerNew(res.data[1] === null
                ? []
                : res.data[1].map((i) => {
                    return i.timeline;
                }),
            res.data[1] === null
                ? []
                : res.data[1].map((i) => {
                    return i.value;
                }));
        $('.loading-customer-new-report-loading').remove();
    }).catch(function (e) {
        loadDataCustomerNew = 1;
        console.log(e);
    });
}

function drawChartReportCustomerNew(timeline, value) {
    let heightChart = timeline.length > 40 ? ($(window).innerHeight() <= 797 ? '70%' : '77%') : ($(window).innerHeight() <= 797 ? '73%' : '80%');
    let dom = document.getElementById("chart-new-customer-report");
    chartReportCustomerNew = echarts.init(dom, null, {
        renderer: "canvas",
        useDirtyRect: false,
    });
    let option = {
        title: {
        },
        tooltip: {
            trigger: 'axis',
            formatter: function (value, i) {
                return `
                          <i class="fa fa-user"></i > <b>Số khách hàng mới:</b>  ${formatNumber(value[0].value)}<br />`
            },
        },

        legend: {
            data: ['Tổng số','Tổng số tiền']
        },
        grid: {
            width: "90%",
            left: "7%",
            height: heightChart
        },
        toolbox: {
            feature: {
                // saveAsImage: {}
            }
        },
        dataZoom: [
            {
                type: 'slider',
                show: timeline.length > 24,
                startValue: 0,
                endValue: 23,
                // start: 0,
                // end: data.data[1].length > 15 ? 20 : 100,
                xAxisIndex: 0,
                realtime: true,
                zoomLock: true,
                showDetail: false,
                brushSelect: false
            }
        ],
        xAxis: {
            type: 'category',
            data: timeline,
            axisTick: {
                alignWithLabel: true,
            },
            axisLabel: {
                interval: 0,
                rotate: 45,
                width: 120,
                overflow: 'truncate',
                ellipsis: '...'
            },
        },
        yAxis: {
            axisLabel: {margin: 10},
            type: 'value',
            name: "Số khách hàng",
            nameGap: 80,
            nameTextStyle: {
                fontSize: 14,
                fontWeight: 600,
                fontFamily: "Roboto",
            },
            nameRotate: 90,
            nameLocation: "middle",
        },
        series: [
            {
                name: "Lợi nhuận",
                type: "line",
                data: value,
                smooth: true,
                markPoint: {
                    data: [
                        {type: 'max', name: 'Max'},
                    ],
                    itemStyle: {
                        color: "#fac858",
                    },
                    label: {
                        color: "#000",
                        formatter: function (params) {
                            return formatNumber(params.value);
                        }
                    }
                },
            }
        ]
    };
    if (option && typeof option === "object") {
        chartReportCustomerNew.setOption(option);
    }
}

async function dataTableNewCustomerReport(data) {
    let scroll_Y = vh_of_table_report;
    let fixedLeft = 2;
    let fixedRight = 0;
    let id = $('#table-new-customer-report');
    let column = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
        {data: 'name', name: 'name', width: '5%', className: 'text-left'},
        {data: 'gender', name: 'gender', className: 'text-left'},
        {data: 'register_at', name: 'register_at', className: 'text-center'},
        {data: 'card_type', name: 'card_type', className: 'text-left'},
        {data: 'used_accumulate_point', name: 'used_accumulate_point', className: 'text-right'},
        {data: 'keysearch', className: 'd-none'},
    ],
        option = [{
            'title': 'Xuất Excel',
            'icon': 'fi-rr-print',
            'class': '',
            'function': 'exportExcelNewCustomerReport',
        }]
    tableNewCustomerReport = await DatatableTemplateNew(id, data.data[0].original.data, column, scroll_Y, fixedLeft, fixedRight, option);
    $(document).on('input paste', '#table-new-customer-report_filter', async function () {
        let totalPoint = 0;
        await tableNewCustomerReport.rows({'search': 'applied'}).every(function () {
            let row = $(this.node());
            totalPoint += removeformatNumber(row.find('td:eq(5)').text());
        })
    })
}

function detectDateOptionTimeNewCustomer(type) {
    switch (type) {
        case 15:
            typeTimeCustomerNewReport = 15;
            timeCustomerNewReportV2 = "";
            fromDateCustomerNewReport = $(".from-month-filter-time-bar").val();
            toDateCateCustomerNewReport = $(".to-month-filter-time-bar").val();
            break;
        case 16:
            typeTimeCustomerNewReport = 16;
            timeCustomerNewReportV2 = "";
            fromDateCustomerNewReport = $(".from-year-filter-time-bar").val();
            toDateCateCustomerNewReport = $(".to-year-filter-time-bar").val();
            break;
        default:
            typeTimeCustomerNewReport = 13;
            timeCustomerNewReportV2 = "";
            fromDateCustomerNewReport = $(".from-date-filter-time-bar").val();
            toDateCateCustomerNewReport = $(".to-date-filter-time-bar").val();
    }
}
