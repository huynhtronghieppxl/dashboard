let dataTableEmployeeReport, typeActionEmployeeReport = 1, timeActionEmployeeReport = $('#calendar-day').val(),
    typeTimeEmployeeReport, dateActionEmployeeReport, monthActionEmployeeReport, yearActionEmployeeReport,
    radioChartEmployeeReport, currentTypeEmployeeReport = 'tiled';
let fromDateEmployeeReport, toDateEmployeeReport, myChartEmployeeReport;
let list = [
    '#chart-employee-report-vertical',
    '#chart-employee-report-horizontal',
    '.table-responsive'
];
let chartEmployeeReport = chartEmployeeReportColumnEchart('chart-employee-report-vertical-main')
let dataExcelEmployeeReport = [];

$(async function () {
    $(document).on("dp.change", "#calendar-day, #calendar-month, #calendar-year", function () {
        timeActionEmployeeReport = $(this).val();
    });

    $(document).on("change", "#select-time-report", async function () {
        let timeVal = $(this).val();
        switch (timeVal) {
            case "day":
                typeActionEmployeeReport = 1;
                timeActionEmployeeReport = $('#calendar-day').val();
                fromDateEmployeeReport = '';
                toDateEmployeeReport = '';
                break;
            case "week":
                typeActionEmployeeReport = 2;
                timeActionEmployeeReport = moment().format("WW/YYYY");
                fromDateEmployeeReport = '';
                toDateEmployeeReport = '';
                break;
            case "month":
                typeActionEmployeeReport = 3;
                timeActionEmployeeReport = $("#calendar-month").val();
                fromDateEmployeeReport = '';
                toDateEmployeeReport = '';
                break;
            case "3month":
                typeActionEmployeeReport = 4;
                timeActionEmployeeReport = moment().format("MM/YYYY");
                fromDateEmployeeReport = '';
                toDateEmployeeReport = '';
                break;
            case "year":
                typeActionEmployeeReport = 5;
                timeActionEmployeeReport = $("#calendar-year").val();
                fromDateEmployeeReport = '';
                toDateEmployeeReport = '';
                break;
            case "3year":
                typeActionEmployeeReport = 6;
                timeActionEmployeeReport = moment().format("YYYY");
                fromDateEmployeeReport = '';
                toDateEmployeeReport = '';
                break;
            case "13":
                $(".add-display").addClass("d-none");
                $('#btn-custom-time-filter').removeClass('d-none');
                $('#btn-custom-time-filter .custom-date').removeClass('d-none');
                fromDateEmployeeReport = '';
                toDateEmployeeReport = '';
                detectDateOptionTimeFood(13);
                break;
            case "15":
                $(".add-display").addClass("d-none");
                $('#btn-custom-time-filter').removeClass('d-none');
                $('#btn-custom-time-filter .custom-date').removeClass('d-none');
                $(this)
                    .parents(".filter-report")
                    .find(".custom-date")
                    .addClass("d-none");
                $(this)
                    .parents(".filter-report")
                    .find(".custom-month")
                    .removeClass("d-none");
                $(this)
                    .parents(".filter-report")
                    .find(".custom-year")
                    .addClass("d-none");
                fromDateEmployeeReport = '';
                toDateEmployeeReport = '';
                detectDateOptionTimeFood(15);
                break;
            case "16":
                $(".add-display").addClass("d-none");
                $('#btn-custom-time-filter').removeClass('d-none');
                $('#btn-custom-time-filter .custom-date').removeClass('d-none');
                $(this)
                    .parents(".filter-report")
                    .find(".custom-date")
                    .addClass("d-none");
                $(this)
                    .parents(".filter-report")
                    .find(".custom-month")
                    .addClass("d-none");
                $(this)
                    .parents(".filter-report")
                    .find(".custom-year")
                    .removeClass("d-none");
                fromDateEmployeeReport = '';
                toDateEmployeeReport = '';
                detectDateOptionTimeFood(16);
                break;
            case "all_year":
                typeActionEmployeeReport = 8;
                timeActionEmployeeReport = moment().format("YYYY");
                fromDateEmployeeReport = '';
                toDateEmployeeReport = '';
                break;
        }
        await loadData();
        isVisibleDetailValueReport($('#detail-value-order-report'), chartEmployeeReport)
    });
    $('#month .custom-button-search').on('click',function (){
        loadData();
    })
    $('#year .custom-button-search').on('click',function (){
        loadData();
    })

    $('#day .custom-button-search').on('click',function (){
        loadData();
    })
    $(".search-date-option-filter-time-bar").on("click", async function () {
        await detectDateOptionTimeFood(Number($("#select-time-report").val()));
        loadData();
    });

    // $('.search-date-filter-time-bar').on('click', function (){
    //     switch (Number($('.custom-select-option-report').val())){
    //         case 15:
    //             typeActionEmployeeReport = 15
    //             timeActionEmployeeReport = ''
    //             fromDateEmployeeReport = $('.from-month-filter-time-bar').val()
    //             toDateEmployeeReport = $('.to-month-filter-time-bar').val()
    //             loadData()
    //             break;
    //         case 16:
    //             typeActionEmployeeReport = 16
    //             timeActionEmployeeReport = ''
    //             fromDateEmployeeReport = $('.from-year-filter-time-bar').val()
    //             toDateEmployeeReport = $('.to-year-filter-time-bar').val()
    //             loadData()
    //             break;
    //         default:
    //             typeActionEmployeeReport = 13
    //             timeActionEmployeeReport = ''
    //             fromDateEmployeeReport = $('.from-date-filter-time-bar').val()
    //             toDateEmployeeReport = $('.to-date-filter-time-bar').val()
    //             loadData()
    //     }
    // })

    /* Set cookie */
    if(getCookieShared('employee-report-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('employee-report-user-id-' + idSession));
        typeTimeEmployeeReport = dataCookie.typeTimeEmployeeReport;
        dateActionEmployeeReport = dataCookie.day;
        monthActionEmployeeReport = dataCookie.month;
        yearActionEmployeeReport = dataCookie.year;
        radioChartEmployeeReport = dataCookie.radio;
        $('#calendar-day').val(dateActionEmployeeReport);
        $('#calendar-month').val(monthActionEmployeeReport);
        $('#calendar-year').val(yearActionEmployeeReport);
    }
    $('#btn-type-time-employee-report button').on('click', function () {
        typeTimeEmployeeReport = $(this).attr('id')
        updateCookieEmployeeReportData();
    })
    $('#btn-type-time-employee-report button[id="' + typeTimeEmployeeReport + '"]').click();
    if(!$('select-branch').val()) {
        await updateSessionBrandNew($('.select-brand'))
    }else {
        loadData();
    }
    /* End cookie */
    $(document).on('input paste', '#table-employee-report_filter', async function () {
        let totalOrder = 0,
            totalRevenue = 0;
        await dataTableEmployeeReport.rows({'search': 'applied'}).every(function () {
            let row = $(this.node());
            totalOrder += removeformatNumber(row.find('td:eq(2)').text());
            totalRevenue += removeformatNumber(row.find('td:eq(3)').text());
        })
        $('#total-order-employee-report').text(formatNumber(totalOrder));
        $('#total-revenue-employee-report').text(formatNumber(totalRevenue));
    })

    $(document).on('change', '#detail-value-order-report', function () {
        isVisibleDetailValueReport($('#detail-value-order-report'), chartEmployeeReport)
    })
});

/* Set cookie */
function updateCookieEmployeeReportData(){
    saveCookieShared('employee-report-user-id-' + idSession, JSON.stringify({
        typeTimeEmployeeReport : typeTimeEmployeeReport,
        day : $('#calendar-day').val(),
        month : $('#calendar-month').val(),
        year : $('#calendar-year').val()
    }))
}
/* end cookie */

function chartEmployeeReportColumnEchart(element){
    element = echarts.init(document.getElementById(element));
    element.setOption({
        title: {
            textStyle: {
                color: "grey",
                fontSize: 20
            },
            // text: "No data",
            left: "center",
            top: "center",
        }
    });
    return element;
}

async function loadData() {
    let brand = $('.select-brand').val(),
        branch = $(".select-branch").val(),
        method = 'get',
        params = {
            brand: brand,
            branch: branch,
            type: typeActionEmployeeReport,
            time: timeActionEmployeeReport,
            from_date: fromDateEmployeeReport,
            to_date: toDateEmployeeReport,
        },
        data = null,
        url = 'employee-report.data';
    let res = await axiosTemplate(method, url, params, data,[$("#table-employee-report"),$("#chart-employee-report-vertical-main")]);

    if (!res.data[0].timeline.length) {
        $('#chart-employee-report-vertical-empty').removeClass('d-none')
        $('#chart-employee-report-vertical-main').addClass('d-none')
    }else {
        $('#chart-employee-report-vertical-empty').addClass('d-none')
        $('#chart-employee-report-vertical-main').removeClass('d-none')
    }

    loadTable(res.data[1].original.data);
    loadTotal(res.data[2]);
    dataExcelEmployeeReport = res.data[3].data.list;
    totalOrderEmployeeReport = res.data[2].total_order;
    totalRevenueEmployeeReport = res.data[2].total_revenue;
    $('#total-order-employee-report').text(totalOrderEmployeeReport)
    $('#total-revenue-employee-report').text(totalRevenueEmployeeReport)
    $('#total-employee-report').text(totalRevenueEmployeeReport)
    updateChartColumnEchart(chartEmployeeReport, res.data[0]);
}

async function loadTable(data) {
    let id = $('#table-employee-report'),
        fixed_left = 2,
        fixed_right = 1,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'employee_name', name: 'employee_name'},
            {data: 'order_count', name: 'order_count', className: 'text-center'},
            {data: 'revenue', name: 'revenue', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = [{
            'title': 'Xuất excel',
            'icon': 'fi-rr-print',
            'class': 'seemt-btn-hover-blue',
            'function': 'exportExcelEmployeeReport',
        }];
    dataTableEmployeeReport = await DatatableTemplateNew(id, data, column, vh_of_table_report, fixed_left, fixed_right, option);
}

function detectDateOptionTimeFood(type) {
    switch (type) {
        case 15:
            typeActionEmployeeReport = 15;
            timeActionEmployeeReport = "";
            fromDateEmployeeReport = $(".from-month-filter-time-bar").val();
            toDateEmployeeReport = $(".to-month-filter-time-bar").val();
            break;
        case 16:
            typeActionEmployeeReport = 16;
            timeActionEmployeeReport = "";
            fromDateEmployeeReport = $(".from-year-filter-time-bar").val();
            toDateEmployeeReport = $(".to-year-filter-time-bar").val();
            break;
        default:
            typeActionEmployeeReport = 13;
            timeActionEmployeeReport = "";
            fromDateEmployeeReport = $(".from-date-filter-time-bar").val();
            toDateEmployeeReport = $(".to-date-filter-time-bar").val();
    }
}

function loadTotal(data) {
    $('#total').text(data.total);
    $('#total-table').text(data.total);
}

function exportExcel() {
    let id = $('#table-employee-report');
    let name = $('#title').html();
    exportExcelTemplate(id, dataTableEmployeeReport, name);
}
