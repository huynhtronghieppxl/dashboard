let list = [
    '#chart-area-report-vertical',
    '#chart-area-report-horizontal',
    '.table-responsive',
];
let dataTableAreaReport, typeActionAreaReport = 1, timeActionAreaReport = $('#calendar-day').val(), tabActiveReportArea = 1,
    typeTimeAreaReport, dateActionAreaReport, monthActionAreaReport, yearActionAreaReport, radioChartAreaReport,
    currentTypeAreaReport, checkSpamAreaReport = 0;
let dataExcelAreaReport = [];
let fromDateAreaReport, toDateAreaReport;
let myChartAreaReport = chartColumnEchart('chart-area-report-vertical-main');
$(async function () {
    /* Set cookie */
    if(getCookieShared('area-report-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('area-report-user-id-' + idSession));
        typeTimeAreaReport = dataCookie.type;
        dateActionAreaReport = dataCookie.day;
        monthActionAreaReport = dataCookie.month;
        yearActionAreaReport = dataCookie.year;
        radioChartAreaReport = dataCookie.radio;
        $('#calendar-day').val(dateActionAreaReport);
        $('#calendar-month').val(monthActionAreaReport);
        $('#calendar-year').val(yearActionAreaReport);
    }

    $(document).on("dp.change", "#calendar-day, #calendar-month, #calendar-year ", function () {
        timeActionAreaReport = $(this).val();
    });

    $(".search-date-option-filter-time-bar").on("click", async function () {
        await detectDateOptionTimeArea(Number($("#select-time-report").val()));
        loadData();
    });


    $(document).on("change", "#select-time-report", async function () {
        let timeVal = $(this).val();
        switch (timeVal) {
            case "day":
                typeActionAreaReport = 1;
                timeActionAreaReport = $("#calendar-day").val();
                fromDateAreaReport = '';
                toDateAreaReport = '';
                break;
            case "week":
                typeActionAreaReport = 2;
                timeActionAreaReport = moment().format("WW/YYYY");
                fromDateAreaReport = '';
                toDateAreaReport = '';
                break;
            case "month":
                typeActionAreaReport = 3;
                timeActionAreaReport = $("#calendar-month").val();
                fromDateAreaReport = '';
                toDateAreaReport = '';
                break;
            case "3month":
                typeActionAreaReport = 4;
                timeActionAreaReport = moment().format("MM/YYYY");
                fromDateAreaReport = '';
                toDateAreaReport = '';
                break;
            case "year":
                typeActionAreaReport = 5;
                timeActionAreaReport = $("#calendar-year").val();
                fromDateAreaReport = '';
                toDateAreaReport = '';
                break;
            case "3year":
                typeActionAreaReport = 6;
                timeActionAreaReport = moment().format("YYYY");
                fromDateAreaReport = '';
                toDateAreaReport = '';
                break;
            case "13":
                fromDateAreaReport = '';
                toDateAreaReport = '';
                detectDateOptionTimeArea(13);
                break;
            case "15":
                fromDateAreaReport = '';
                toDateAreaReport = '';
                detectDateOptionTimeArea(15);
                break;
            case "16":
                fromDateAreaReport = '';
                toDateAreaReport = '';
                detectDateOptionTimeArea(16);
                break;
            case "all_year":
                typeActionAreaReport = 8;
                timeActionAreaReport = moment().format("YYYY");
                fromDateAreaReport = '';
                toDateAreaReport = '';
                break;
        }
        await loadData();
        updateCookieAreaReportData();
        isVisibleDetailValueAreaReport($('#chart-sell-report-vertical-center'), myChartAreaReport)
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

    $('#btn-type-time-sell-gift-food-report button').on('click', function () {
        typeTimeAreaReport = $(this).attr('id')
        updateCookieAreaReportData();
    })
    $('#btn-type-time-sell-gift-food-report button[id="' + typeTimeAreaReport + '"]').click();
    /* end cookie */
    if(!$('select-branch').val()) {
        await updateSessionBrandNew($('.select-brand'))
    }else {
        loadData()
    }

    isVisibleDetailValueAreaReport ()
    $('#btn-type-time-sell-gift-food-report button').on('click', function (){
        tabActiveReportArea = $(this).attr('data-id')
    })
    // loadData();

    $(document).on('input paste', '#table-area-report_filter', async function () {
        let totalOrder = 0,
            totalRevenue = 0;
        await dataTableAreaReport.rows({'search': 'applied'}).every(function () {
            let row = $(this.node());
            totalOrder += removeformatNumber(row.find('td:eq(2)').text());
            totalRevenue += removeformatNumber(row.find('td:eq(3)').text());
        })
        $('#total-order-area-report').text(formatNumber(totalOrder));
        $('#total-revenue-area-report').text(formatNumber(totalRevenue));
    })
});

function detectDateOptionTimeArea(type) {
    switch (type) {
        case 15:
            typeActionAreaReport = 15;
            timeActionAreaReport = "";
            fromDateAreaReport = $(".from-month-filter-time-bar").val();
            toDateAreaReport = $(".to-month-filter-time-bar").val();
            break;
        case 16:
            typeActionAreaReport = 16;
            timeActionAreaReport = "";
            fromDateAreaReport = $(".from-year-filter-time-bar").val();
            toDateAreaReport = $(".to-year-filter-time-bar").val();
            break;
        default:
            typeActionAreaReport = 13;
            timeActionAreaReport = "";
            fromDateAreaReport = $(".from-date-filter-time-bar").val();
            toDateAreaReport = $(".to-date-filter-time-bar").val();
    }
}

async function loadData() {
    if (checkSpamAreaReport === 1) return false;
    checkSpamAreaReport = 1
    let brand = $('.select-brand').val(),
        branch = $(".select-branch").val(),
        method = 'get',
        params = {
            brand: brand,
            branch: branch,
            type: typeActionAreaReport,
            time: timeActionAreaReport,
            from_date: fromDateAreaReport,
            to_date: toDateAreaReport
        },
        data = null,
        url = 'area-report.data';
    let res = await axiosTemplate(method, url, params, data,
        [
            $("#table-area-report"),
            $("#chart-sell-report-vertical-center"),
            $("#chart-area-report-vertical")
        ]);
    checkSpamAreaReport = 0
    let arr = []
    $.each(res.data[2], function(key, value) {
        arr.push(value)
    });

    if (res.data[0].timeline.length === 0) {
        $('#detail-value-area-report-box').addClass('d-none')
    }else {
        $('#detail-value-area-report-box').removeClass('d-none')
    }

    updateChartColumnEchart(myChartAreaReport, res.data[0])
    await loadTable(res.data[1].original.data);
    dataExcelAreaReport = res.data[3].data.list;
    totalOrderCountAreaReport = res.data[2].total_order;
    totalRevenueAreaReport = res.data[2].total_revenue;
    $('#total-order-area-report').text(totalOrderCountAreaReport);
    $('#total-revenue-area-report').text(totalRevenueAreaReport);
    loadTotal(res.data[2]);
    $('#detail-chart-area-report-vertical').on('change', function () {
        isVisibleDetailValueAreaReport()
    })
}

function isVisibleDetailValueAreaReport() {
    const isChecked = $('#detail-chart-area-report-vertical').is(':checked');
    const labelOption = isChecked ? {
        show: true,
        verticalAlign: "middle",
        position: [10, -5, 0, 0],
        color: "#000",
        rotate: 60,
        distance: 15,
        textStyle: {
            fontFamily: "roboto",
            fontSize: 12,
        },
        formatter: function (param) {
            return formatNumber(param.value);
        }
    } : {
        show: false
    };
    const series = myChartAreaReport.getOption().series;
    for (let i = 0; i < series.length; i++){
        series[i].label = labelOption;
    }
    myChartAreaReport.setOption({
        series: series
    });
}

/* Set cookie */
function updateCookieAreaReportData(){
    saveCookieShared('area-report-user-id-' + idSession, JSON.stringify({
        type : typeTimeAreaReport,
        day : $('#calendar-day').val(),
        month : $('#calendar-month').val(),
        year : $('#calendar-year').val()
    }))
}
/* end cookie */

async function loadTable(data) {
    let id = $('#table-area-report'),
        fixed_left = 2,
        fixed_right = 1,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'area_name', name: 'area_name', className: 'text-left'},
            {data: 'order_count', name: 'order_count', className: 'text-right'},
            {data: 'revenue', name: 'revenue', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = [{
            'title': 'Xuất excel',
            'icon': 'fi-rr-print',
            'class': 'seemt-btn-hover-blue',
            'function': 'exportExcelAreaReport',
        }];
    dataTableAreaReport = await DatatableTemplateNew(id, data, column, vh_of_table_report, fixed_left, fixed_right, option);
}
function loadTotal(data) {
    $('#total').text(data.total);
}

