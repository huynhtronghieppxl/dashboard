let list = [
    '#chart-profit-report-horizontal',
    '#chart-profit-report-vertical-main',
    '.table-responsive'
];
let dataTableProfitReport, typeActionProfitReport = 1, timeActionProfitReport = $('#calendar-day').val(),
    typeTimeProfitReport, selectTypeProfitReport = -1, dateActionProfitReport, monthActionProfitReport, yearActionProfitReport,
    radioChartProfitReport;
let dataExcelProfitReport = [], currentTypeProfitReport = 'tiled', myChartProfitReport;
let fromDateProfitReport, toDateProfitReport, tabTimeProfitReport;

$(function () {
    dateTimePickerTemplate($('#calendar-day'));
    dateTimePickerMonthYearTemplate($('#calendar-month'));
    dateTimePickerYearTemplate($('#calendar-year'));
    templateReportTypeOption();
    $('#calendar-day').on('dp.change', function () {
        typeActionProfitReport = 1;
        timeActionProfitReport = $('#calendar-day').val();
        loadData();
    });
    $('#calendar-week').on('dp.change', function () {
        typeActionProfitReport = 2;
        timeActionProfitReport = $('#calendar-week').val();
        fromDateProfitReport = '';
        toDateProfitReport = '';
        loadData();
    });
    $('#calendar-month').on('dp.change', function () {
        typeActionProfitReport = 3;
        timeActionProfitReport = $('#calendar-month').val();
        fromDateProfitReport = '';
        toDateProfitReport = '';
        loadData();
    });
    $('#calendar-year').on('dp.change', function () {
        typeActionProfitReport = 5;
        timeActionProfitReport = $('#calendar-year').val();
        fromDateProfitReport = '';
        toDateProfitReport = '';
        loadData();
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
    $('#select-type-profit-report').on('select2:select', function () {
        loadData();
    })
    $('.search-date-filter-time-bar').on('click', function (){
        switch (Number($('.custom-select-option-report').val())){
            case 15:
                typeActionProfitReport = 15
                timeActionProfitReport = ''
                fromDateProfitReport = $('.from-month-filter-time-bar').val()
                toDateProfitReport = $('.to-month-filter-time-bar').val()
                loadData()
                break;
            case 16:
                typeActionProfitReport = 16
                timeActionProfitReport = ''
                fromDateProfitReport = $('.from-year-filter-time-bar').val()
                toDateProfitReport = $('.to-year-filter-time-bar').val()
                loadData()
                break;
            default:
                typeActionProfitReport = 13
                timeActionProfitReport = ''
                fromDateProfitReport = $('.from-date-filter-time-bar').val()
                toDateProfitReport = $('.to-date-filter-time-bar').val()
                loadData()
        }
    })
    // Set cookie
    if(getCookieShared('profit-report-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('profit-report-user-id-' + idSession));
        selectTypeProfitReport = dataCookie.select
        tabTimeProfitReport = dataCookie.tabTimeProfitReport;
        $('#select-type-profit-report').val(selectTypeProfitReport)
    }
    $('#select-type-profit-report').on('change', function () {
        selectTypeProfitReport = $(this).val()
        updateCookieProfitReportData();
    })
    $('#btn-type-time-profit-report button').on('click', function () {
        tabTimeProfitReport = $(this).attr('id')
        updateCookieProfitReportData();
    })
    $('#btn-type-time-profit-report button[id="' + tabTimeProfitReport + '"]').click();
    loadData();
    // End Cookie
    getToMaxDateTimePickerReport();
});

async function loadData() {
    let brand = $('#restaurant-branch-id-selected span').attr('data-value'),
        branch = $(".select-branch").val(),
        category = $('#select-type-profit-report').val(),
        method = 'get',
        params = {
                brand: brand,
                branch: branch,
                category: category,
                type: typeActionProfitReport,
                time: timeActionProfitReport,
                from_date: fromDateProfitReport,
                to_date: toDateProfitReport,
        },
        data = null,
        url = 'profit-report.data';
    let res = await axiosTemplate(method, url, params, data,[$("#table-profit-report"),$("#chart-profit-report-vertical")]);
    eChartProfitReport('chart-profit-report-vertical-main',
        res.data[0] === null ? [] : res.data[0].map(i => {
                return i.timeline;
                }),
        res.data[0] === null ? [] : res.data[0].map(i => {
            return i.profit_ratio;
                }),
        res.data[4]
    )
    loadTable(res.data[1].original.data);
    dataExcelProfitReport = res.data[1].original.data;
    loadTotal(res.data[2]);
    selectTypeProfitReport = $('#select-type-profit').val()
}

function updateCookieProfitReportData(){
    saveCookieShared('profit-report-user-id-' + idSession, JSON.stringify({
        'select' : selectTypeProfitReport,
        tabTimeProfitReport : tabTimeProfitReport,
    }))
}

async function loadTable(data) {
    let id = $('#table-profit-report'),
        fixed_left = 3,
        fixed_right = 2,
        column = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'avatar', name: 'avatar', width: '5%'},
        {data: 'type', name: 'type', className: 'text-center'},
        {data: 'quantity', name: 'quantity', className: 'text-center'},
        {data: 'total_original_amount', name: 'total_original_amount', className: 'text-center'},
        {data: 'total_amount', name: 'total_amount', className: 'text-center'},
        {data: 'total_profit', name: 'total_profit', className: 'text-center'},
        {data: 'profit_ratio', name: 'profit_ratio', className: 'text-center'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        {data: 'keysearch', name: 'keysearch', className: 'd-none'}
    ],
        option = [{
            'title': 'Xuất excel',
            'icon': 'fa fa-download text-warning',
            'class': '',
            'function': 'exportExcelProfitReport',
        }];
    dataTableProfitReport = await DatatableTemplateNew(id, data, column, '40vh', fixed_left, fixed_right, option);
    $(document).on('input paste', '#table-profit-report_filter', async function () {
        let totalQuantity = 0,
            totalOriginPrice = 0,
            totalRevenue = 0,
            totalProfit = 0;
        await dataTableProfitReport.rows({'search': 'applied'}).every(function () {
            let row = $(this.node());
            totalQuantity += removeformatNumber(row.find('td:eq(3)').text());
            totalOriginPrice += removeformatNumber(row.find('td:eq(4)').text());
            totalRevenue += removeformatNumber(row.find('td:eq(5)').text());
            totalProfit += removeformatNumber(row.find('td:eq(6)').text());
        })
        $('#total-quantity').text(formatNumber(totalQuantity));
        $('#total-original').text(formatNumber(totalOriginPrice));
        $('#total-revenue').text(formatNumber(totalRevenue));
        $('#total-profit').text(formatNumber(totalProfit));
    })
}

async function eChartProfitReport(id, dataTimeline, dataProfitRatio, dataTotalProfitRatio) {
    if (dataTimeline.length === 0 && dataProfitRatio.length === 0) {
        $('#chart-profit-report-vertical-center').removeClass('d-none')
        $('#chart-profit-report-vertical-main').addClass('d-none')
    } else {
        $('#chart-profit-report-vertical-center').addClass('d-none')
        $('#chart-profit-report-vertical-main').removeClass('d-none')
        let chartDom = document.getElementById(id);
        myChartProfitReport = await echarts.init(chartDom);
        $(window).on('resize', function (){
            myChartProfitReport.resize();
        });
        let option = {
            grid: {
                y: 50,
                y2: 100,
                left: 100,
                right: 10,

            },
            textStyle: {
                fontFamily: '"Gilroy", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"'
            },
            // dataZoom: [
            //     {
            //         type: 'slider',
            //         start: 0,
            //         end: dataTimeline.length > 30 ? 20 : 100,
            //         realtime: true,
            //         show: true,
            //         maxSpan: 50,
            //         minSpan: 30,
            //         brushSelect: false
            //     },
            // ],
            xAxis: {
                type: 'category',
                data: dataTimeline,
                axisLabel: {
                    interval: 0,
                    rotate: 20,
                    width: 120,
                    overflow: 'truncate',
                    ellipsis: '...'
                },
            },
            yAxis: {
                type: 'value',
                axisLabel: {
                    formatter: function (value, index) {
                        if (value < 9999) {
                            return value % 10000 === 0 ? formatNumber(value / 1) + ' %' : formatNumber((value / 1)) + ' %'
                        }
                        if (value < 999) {
                            return value % 1000 === 0 ? formatNumber(value / 1) + ' %' : formatNumber((value / 1)) + ' %'
                        }
                        if (value < 99) {
                            return value % 100 === 0 ? formatNumber(value / 1) + ' %' : formatNumber((value / 1)) + ' %'
                        }
                        if (value < 9) {
                            return value % 10 === 0 ? formatNumber(value / 10) + ' %' : formatNumber((value / 10)) + ' %'
                        }
                        if (value < -9999) {
                            return value % 10000 === 0 ? formatNumber(value / 10000) + ' %' : formatNumber((value / 10000)) + ' %'
                        }
                        if (value < -999) {
                            return value % 1000 === 0 ? formatNumber(value / 1000) + ' %' : formatNumber((value / 1000)) + ' %'
                        }
                        if (value < -99) {
                            return value % 100 === 0 ? formatNumber(value / 1) + ' %' : formatNumber((value / 1)) + ' %'
                        }
                        if (value < -9) {
                            return value % 10 === 0 ? formatNumber(value / 10) + ' %' : formatNumber((value / 10)) + ' %'
                        }
                    },
                    margin: 0
                },
                name: 'Tỷ suất lợi nhuận(%)',
                nameGap: 80,
                nameTextStyle: {
                    fontSize: 14,
                    fontWeight: 600
                },
                nameRotate: 90,
                nameLocation: 'middle',
            },
            legend: {
                show :true,
                textStyle: {
                    rich: {
                        num: {
                            fontSize : 16,
                            color:"#fa6342",
                            fontWeight: "bold",
                        },
                    }
                },
                formatter: function (name){
                    return `${name}: {num|${dataTotalProfitRatio.total_profit_ratio}}`;
                },
                top: 'top'
            },
            series: [
                {
                    name: 'Tỷ suất lợi nhuận(%)',
                    type: 'bar',
                    data: dataProfitRatio,
                    emphasis: {
                        focus: 'series'
                    },
                },
            ],
            tooltip: {
                trigger: 'axis',
                position: 'top'
            },
            toolbox: {
                show: true,
                feature: {
                    show: true,
                    showTitle: false,
                    myTool1: {
                        show: true,
                        icon: 'image://https://cdn-icons-png.flaticon.com/512/159/159604.png',
                        title: 'Xem Chi tiết',
                        onclick: function (params) {
                            if(params.option.series[0].label.show){
                                myChartProfitReport.setOption(
                                    {
                                        toolbox : {
                                            showTitle: false,
                                            feature : {
                                                myTool1: {
                                                    icon: 'image://https://cdn-icons-png.flaticon.com/512/159/159604.png',
                                                    title : 'Ẩn chi tiết',
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
                                                    color : '#fff'
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
                                    show: true ,
                                    verticalAlign: "middle",
                                    position: params.option.xAxis[0].type === "value" ? "inside" : "top",
                                    color: "rgba(0, 0, 0, 1)",
                                    rotate: 0,
                                    distance: 15,
                                    fontWeight: "bolder",
                                    fontFamily: "roboto",
                                    formatter : function (param)
                                    {
                                        return formatNumber(param.value);
                                    }
                                };
                                myChartProfitReport.setOption(
                                    {
                                        toolbox : {
                                            showTitle: false,
                                            feature : {
                                                myTool1: {
                                                    icon: 'image://https://cdn-icons-png.flaticon.com/512/565/565655.png',
                                                    title : 'Xem chi tiết',
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
                                                    color : '#fff'
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
        myChartProfitReport.setOption(option);
    }
}

function loadTotal(data) {
    $('#total').text(data.sum_profit);
    totalQuantityProfitReport = data.sum_quantity;
    totalOriginalProfitReport = data.sum_total_original;
    totalRevenueProfitReport = data.sum_total;
    totalProfitProfitReport = data.sum_profit;
    $('#total-quantity').text(totalQuantityProfitReport);
    $('#total-original').text(totalOriginalProfitReport);
    $('#total-revenue').text(totalRevenueProfitReport);
    $('#total-profit').text(totalProfitProfitReport);
}
