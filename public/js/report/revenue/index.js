let dataRevenueReportTable, typeActionRevenueReport = 1, timeActionRevenueReport = $('#calendar-day').val(),
    typeDataTimeButton = 1, dateRevenueReport, yearRevenueReport, monthRevenueReport,
    fromDateRevenueReport, toDateRevenueReport, tabActiveRevenueReport;
let dataExcelRevenueReport = [];
let dataFilter = [];
let myChart = echarts.init(document.getElementById('chart-revenue-report-main'));
let checkSpamRevenueReport = 0

$(async function () {

    $('#chart-revenue-report').css('min-height', '500px');

    $('#filter-sell-food-order-report').on("dp.change", "#calendar-day, #calendar-month, #calendar-year", function () {
        typeActionRevenueReport = $(this).val();
    });

    $(window).on("load resize", function() {
        if ($(window).width() < 1380) {
            $(".amount-total-header-report").addClass("d-none");
            $(".amount-total-header-report1").removeClass("d-none");
            $(".filter-header").removeClass("d-none");
        } else {
            $(".amount-total-header-report1").addClass("d-none");
            $(".filter-header").addClass("d-none");
            $(".amount-total-header-report").removeClass("d-none");
        }
    });

    $(document).on("change", "#select-time-report", async function () {
        let timeVal = $(this).val();
        switch (timeVal) {
            case "day":
                typeActionRevenueReport = 1;
                timeActionRevenueReport = $('#calendar-day').val();
                fromDateRevenueReport = '';
                toDateRevenueReport = '';
                break;
            case "week":
                typeActionRevenueReport = 2;
                timeActionRevenueReport = moment().format('WW/YYYY');
                fromDateRevenueReport = '';
                toDateRevenueReport = '';
                break;
            case "month":
                typeActionRevenueReport = 3;
                timeActionRevenueReport = $('#calendar-month').val();
                fromDateRevenueReport = '';
                toDateRevenueReport = '';
                break;
            case "3month":
                typeActionRevenueReport = 4;
                timeActionRevenueReport = moment().format('MM/YYYY');
                fromDateRevenueReport = '';
                toDateRevenueReport = '';
                break;
            case "year":
                typeActionRevenueReport = 5;
                timeActionRevenueReport = $('#calendar-year').val();
                fromDateRevenueReport = '';
                toDateRevenueReport = '';
                break;
            case "3year":
                typeActionRevenueReport = 6;
                timeActionRevenueReport = moment().format('YYYY');
                fromDateRevenueReport = '';
                toDateRevenueReport = '';
                break;
            case "13":
                fromDateRevenueReport = '';
                toDateRevenueReport = '';
                detectDateOptionTimeRevenue(13);
                break;
            case "15":
                fromDateRevenueReport = '';
                toDateRevenueReport = '';
                detectDateOptionTimeRevenue(15);
                break;
            case "16":
                fromDateRevenueReport = '';
                toDateRevenueReport = '';
                detectDateOptionTimeRevenue(16);
                break;
            case "all_year":
                typeActionRevenueReport = 8;
                timeActionRevenueReport = moment().format('YYYY');
                fromDateRevenueReport = '';
                toDateRevenueReport = '';
                break;
        }
        await loadData();

        window.addEventListener('resize', function () {
            myChart.resize();
        });
    });

    $('#month .custom-button-search').on('click', function () {
        typeActionRevenueReport = 3;
        timeActionRevenueReport = $('#calendar-month').val();
        fromDateRevenueReport = '';
        toDateRevenueReport = '';
        loadData();
    })
    $('#year .custom-button-search').on('click', function () {
        typeActionRevenueReport = 5;
        timeActionRevenueReport = $('#calendar-year').val();
        fromDateRevenueReport = '';
        toDateRevenueReport = '';
        loadData();
    })
    $('#day .custom-button-search').on('click', function () {
        typeActionRevenueReport = 1;
        timeActionRevenueReport = $('#calendar-day').val();
        fromDateRevenueReport = '';
        toDateRevenueReport = '';
        loadData();
    })

    $(".search-date-option-filter-time-bar").on("click", async function () {
        await detectDateOptionTimeRevenue(Number($("#select-time-report").val()));
        loadData();
    });

    if (getCookieShared('revenue-report-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('revenue-report-user-id-' + idSession));
        tabActiveRevenueReport = dataCookie.tabActiveRevenueReport
    }
    $('#type-time-group-revenue-report button').on('click', function () {
        tabActiveRevenueReport = $(this).attr('id');
        updateRevenueReport();
    });
    $('#type-time-group-revenue-report button[id="' + tabActiveRevenueReport + '"]').click();
    if (!$(".select-branch").val()) {
        await updateSessionBrandNew($(".select-brand"), true);
        return false;
    }
    await loadData();
});

function detectDateOptionTimeRevenue(type) {
    switch (type) {
        case 15:
            typeActionRevenueReport = 15;
            timeActionRevenueReport = "";
            fromDateRevenueReport = $(".from-month-filter-time-bar").val();
            toDateRevenueReport = $(".to-month-filter-time-bar").val();
            break;
        case 16:
            typeActionRevenueReport = 16;
            timeActionRevenueReport = "";
            fromDateRevenueReport = $(".from-year-filter-time-bar").val();
            toDateRevenueReport = $(".to-year-filter-time-bar").val();
            break;
        default:
            typeActionRevenueReport = 13;
            timeActionRevenueReport = "";
            fromDateRevenueReport = $(".from-date-filter-time-bar").val();
            toDateRevenueReport = $(".to-date-filter-time-bar").val();
    }
}

function updateRevenueReport() {
    saveCookieShared('revenue-report-user-id-' + idSession, JSON.stringify({
        tabActiveRevenueReport: tabActiveRevenueReport,
    }))
}

async function loadData() {
    if(checkSpamRevenueReport === 1) return false;
    updateRevenueReport();
    checkSpamRevenueReport = 1;
    let brand = $('.select-brand').val(),
        branch = $(".select-branch").val(),
        method = 'get',
        url = 'revenue-report.data',
        params = {
                brand: brand,
                branch: branch,
                type: typeActionRevenueReport,
                time: timeActionRevenueReport,
                from_date: fromDateRevenueReport,
                to_date: toDateRevenueReport,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$("#chart-sell-report-rounded"), $('#table-revenue-report')]);
    checkSpamRevenueReport = 0;
    $(".empty-datatable-custom").remove()
    eChartPie(res.data[5].filter(i => i.amount > 0), $("#chart-revenue-report"))
    dataTableRevenueReport(res.data[1].original.data);
    $('#total').text(res.data[2].total_amount_revenue);
    $('#total1').text(res.data[2].total_amount_revenue);
    dataTotalRevenueReport(res.data[2].total_amount_revenue);
    dataExcelRevenueReport = res.data[3].data;
}

async function dataTableRevenueReport(data) {
    let id = $('#table-revenue-report'),
        fixed_left = 1,
        fixed_right = 1,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'addition_fee_reason_content', name: 'addition_fee_reason_content', className: 'text-center'},
            {data: 'amount', name: 'amount', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'}
        ],
        option = [{
            'title': 'Xuất excel',
            'icon': 'fi-rr-print',
            'class': 'seemt-btn-hover-blue',
            'function': 'exportExcelRevenueReport',
        }]
    dataRevenueReportTable = await DatatableTemplateNew(id, data, column, vh_of_table_report, fixed_left, fixed_right, option);
    $(document).on('input paste keyup','input[type="search"]', function (){
        searchUpdateIndexRevenue(dataRevenueReportTable);
    })
}

function dataTotalRevenueReport(data) {
    $('#total-amount-revenue-report').text(data);
    totalAmountRevenueReport = data
}

async function eChartPie(data) {
    if (data.length === 0) {
        $('#chart-revenue-report-center').removeClass('d-none')
        $('#chart-revenue-report-main').addClass('d-none')
    } else {
        $('#chart-revenue-report-center').addClass('d-none')
        $('#chart-revenue-report-main').removeClass('d-none')
        // let myChart = echarts.init(document.getElementById('chart-revenue-report-main'));
        let option = {
            title: {
                left: 'center'
            },
            textStyle: {
                fontFamily: 'Roboto'
            },
            tooltip: {
                trigger: 'item',
                formatter: '{b} {d}%'
            },
            legend: {
                type: 'scroll',
                orient: 'horizontal',
                left: 'center',
                bottom: 0
            },
            dataset: {
                source: data
            },
            toolbox: {
                feature: {
                    // dataView: {show: true},
                    saveAsImage: {
                        show: false,
                        type: 'png',
                        title: 'Tải ảnh xuống'
                    },
                    restore: {show: false},
                }
            },
            series: [
                {
                    name: false,
                    type: 'pie',
                    radius: '60%',
                    center: ['50%', '45%'],
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    },
                    label: {
                        formatter: '{b} {d}%',
                        alignTo: 'none',
                        edgeDistance: 10,
                        minMargin: 5,
                        lineHeight: 15,
                        fontSize: 14,
                        width: 200,
                        ellipsis: '...'
                    },
                    labelLine: {
                        minTurnAngle: 90,
                        length: 70,
                    },
                    percentPrecision: 1,
                    showInTooltip: false
                }
            ],
        };
        option && myChart.setOption(option);
    }

}

async function searchUpdateIndexRevenue(datatable){
    let totalAmount = 0;
    await datatable.rows({ 'search': 'applied' }).every(function () {
        let row = $(this.node());
        let amount = parseFloat(row.find('td:eq(2)').text().replace(/[^0-9.-]+/g, ""));
        totalAmount += amount;
    });
    $('#total-amount-revenue-report').text(formatNumber(totalAmount));
}
