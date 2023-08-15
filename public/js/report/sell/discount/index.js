let dataTableCategory = null, typeTimeSellDiscountReport = 1, timeSellDiscountReport = $('#calendar-day').val(),
    currentTypeDiscountReport = 'bar', checkSpamDiscountReport = 0, tabTimeSellDiscountReport;
let dataExcelDiscountReport, fromDateDiscountReport, toDateDiscountReport, newDataAfterChangeTimeDiscountReport, dataTableDiscount;
 myChartDiscountReport = chartDiscountColumnEchart('chart-sell-report-vertical');
$(async function () {
    $('#content-detail').on("dp.change", "#calendar-day, #calendar-month, #calendar-year ",function () {
        timeSellDiscountReport = $(this).val();
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
        await detectDateOptionTimeDiscount(Number($("#select-time-report").val()));
        loadData();
    });

    $(document).on('change', '#detail-value-discount-report', function () {
        isVisibleDetailValueReport($('#detail-value-discount-report'), myChartDiscountReport);
    })
    $(document).on("change", "#select-time-report", async function () {
        let timeVal = $(this).val();
        switch (timeVal) {
            case "day":
                typeTimeSellDiscountReport = 1;
                timeSellDiscountReport = $('#calendar-day').val();
                fromDateDiscountReport = '';
                toDateDiscountReport = '';
                break;
            case "week":
                typeTimeSellDiscountReport = 2;
                timeSellDiscountReport = moment().format('WW/YYYY');
                fromDateDiscountReport = '';
                toDateDiscountReport = '';
                break;
            case "month":
                typeTimeSellDiscountReport = 3;
                timeSellDiscountReport = $('#calendar-month').val();
                fromDateDiscountReport = '';
                toDateDiscountReport = '';
                break;
            case "3month":
                typeTimeSellDiscountReport = 4;
                timeSellDiscountReport = moment().format('MM/YYYY');
                fromDateDiscountReport = '';
                toDateDiscountReport = '';
                break;
            case "year":
                typeTimeSellDiscountReport = 5;
                timeSellDiscountReport = $('#calendar-year').val();
                fromDateDiscountReport = '';
                toDateDiscountReport = '';
                break;
            case "3year":
                typeTimeSellDiscountReport = 6;
                timeSellDiscountReport = moment().format('YYYY');
                fromDateDiscountReport = '';
                toDateDiscountReport = '';
                break;
            case "13":
                fromDateDiscountReport = '';
                toDateDiscountReport = '';
                detectDateOptionTimeDiscount(13);
                break;
            case "15":
                fromDateDiscountReport = '';
                toDateDiscountReport = '';
                detectDateOptionTimeDiscount(15);
                break;
            case "16":
                fromDateDiscountReport = '';
                toDateDiscountReport = '';
                detectDateOptionTimeDiscount(16);
                break;
            case "all_year":
                typeTimeSellDiscountReport = 8;
                timeSellDiscountReport = moment().format('YYYY');
                fromDateDiscountReport = '';
                toDateDiscountReport = '';
                break;
        }
        await loadData();
        isVisibleDetailValueReport($('#detail-value-discount-report'), myChartDiscountReport);
    });
    $('#filter-sell-discount-report #month .custom-button-search').on('click', async function () {
            typeTimeSellDiscountReport = 3;
            timeSellDiscountReport = $('#calendar-month').val();
            fromDateDiscountReport = '';
            toDateDiscountReport = '';
            await loadData();
            isVisibleDetailValueDiscountReport($('#detail-value-discount-report'), myChartDiscountReport);
    })
    $('#filter-sell-discount-report #year .custom-button-search').on('click',async function () {
            typeTimeSellDiscountReport = 5;
            timeSellDiscountReport = $('#calendar-year').val();
            fromDateDiscountReport = '';
            toDateDiscountReport = '';
            await loadData();
            isVisibleDetailValueDiscountReport($('#detail-value-discount-report'), myChartDiscountReport);
    })
    $('#filter-sell-discount-report #day .custom-button-search').on('click',async function () {
            typeTimeSellDiscountReport = 1;
            timeSellDiscountReport = $('#calendar-day').val();
            fromDateDiscountReport = '';
            toDateDiscountReport = '';
            await loadData();
            isVisibleDetailValueDiscountReport($('#detail-value-discount-report'), myChartDiscountReport);
    })
    $('#filter-sell-discount-report .search-date-option-filter-time-bar').on('click', async function (){
        detectDateOptionTimeDiscount(Number($("#select-time-report").val()));
        await loadData();
        isVisibleDetailValueDiscountReport($('#detail-value-discount-report'), myChartDiscountReport);
    })
    if (getCookieShared('sell-discount-report-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('sell-discount-report-user-id-' + idSession));
        tabTimeSellDiscountReport = dataCookie.tabTimeSellDiscountReport;
        dateSellCategoryReport = dataCookie.day;
        monthSellCategoryReport = dataCookie.month;
        yearSellCategoryReport = dataCookie.year;
    }
    $('#btn-type-time-sell-report button').on('click', function () {
        tabTimeSellDiscountReport = $(this).attr('id');
        updateCookieSellDiscountReport();
    });
    $('#btn-type-time-sell-report button[id="' + tabTimeSellDiscountReport + '"]').click();
    if(!($('.select-branch').val())) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }
});

function updateCookieSellDiscountReport(){
    saveCookieShared('sell-discount-report-user-id-' + idSession, JSON.stringify({
        tabTimeSellDiscountReport : tabTimeSellDiscountReport,
        day : $('#calendar-day').val(),
        month : $('#calendar-month').val(),
        year : $('#calendar-year').val(),
    }))
}

async function loadData() {
    if(checkSpamDiscountReport === 1) return false;
    updateCookieSellDiscountReport()
    checkSpamDiscountReport = 1;
    let brand = $('.select-brand').val(),
        branch = $(".select-branch").val(),
        method = 'get',
        params = {
            brand: brand,
            branch: branch,
            type: typeTimeSellDiscountReport,
            time: timeSellDiscountReport,
            from_date: fromDateDiscountReport,
            to_date: toDateDiscountReport,
        },
        data = null,
        url = 'discount-report.data',
        res = await axiosTemplate(method, url, params, data, [
            $("#table-sell-card1-report"),
            $("#chart-sell-report-vertical-center"),
            $("#chart-sell-report-vertical"),
        ]);

    checkSpamDiscountReport = 0;
    await dataDisTable(res.data[1].original.data);
    dataDisTotal(res.data[2]);
    updateChartDiscountColumnEchart(myChartDiscountReport, res.data[0], res.data[2].total);
}


function updateChartDiscountColumnEchart(chart , data, totalAmount){
    let heightChart = data.timeline.length > 40 ? ($(window).innerHeight() <= 797 ? '65%': '83%') : ($(window).innerHeight() <= 797 ? '75%': '80%');
    if (data?.length === 0) {
        $('#chart-sell-report-vertical-center').removeClass('d-none')
        $('#chart-sell-report-vertical-main').addClass('d-none')
        $('#detail-value-discount-report-box').addClass('d-none')
    } else {
        $('#chart-sell-report-vertical-center').addClass('d-none')
        $('#chart-sell-report-vertical-main').removeClass('d-none')
        $('#detail-value-discount-report-box').removeClass('d-none')
        newDataAfterChangeTimeDiscountReport = data;
        let option = {
            tooltip: {
                trigger: 'axis',
                textStyle: {
                    fontFamily: 'Roboto',
                    fontSize: 12
                },
                formatter: function (value, index) {
                    return `<div class="seemt-fz-16">${value[0].axisValue}</div>
                            <div class="d-flex align-items-center"><i class="fa-solid fa-circle mr-1" style="font-size: 5px"></i>Số lượng đơn: ${data.quantity[value[0].dataIndex]}</div>
                            <div class="d-flex align-items-center"><i class="fa-solid fa-circle mr-1" style="font-size: 5px"></i>Tổng tiền: ${formatNumber(value[0].value)}</div>`
                }
            },
            grid: {
                y: 50,
                y2: 100,
                left: '3%',
                right: '4%',
                top: 80,
                height: heightChart,
                containLabel: true
            },
            // dataZoom: [{
            //     type: 'slider',
            //     show: data.length > 40,
            //     startValue: 0,
            //     endValue: 39,
            //     // start: 0,
            //     // end: data.length > 30 ? 20 : 100,
            //     xAxisIndex: 0,
            //     realtime: true,
            //     zoomLock: true,
            //     showDetail: false,
            //     brushSelect: false
            // }],
            title: {
                text: '{a|Tổng:} {b|' + totalAmount + '} {a|VNĐ}',
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
                data: data.timeline,
                axisLabel: {
                    interval: data.timeline.length > 36 ? 2 : 0,
                    rotate: 45
                },
                show: newDataAfterChangeTimeDiscountReport.length !== 0,
            },
            yAxis: {
                show: data.timeline.length !== 0,
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
                    type: 'line',
                    smooth: true,
                    data: data.value,
                    label: {
                        show: false,
                        verticalAlign: "middle",
                        position: "top",
                        color: "rgba(0, 0, 0, 1)",
                        rotate: 90,
                        distance: 15,
                        formatter: function (param) {
                            return formatNumber(param.value);
                        },
                    },
                    itemStyle: {
                        color: '#2A74D9'
                    }
                }
            ]
        };
        chart.setOption(option);
        window.onresize = function () {
            chart.resize();
        };
    }
}

function chartDiscountColumnEchart(element){
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


async function dataDisTable(data) {
    let fixedLeft = 2;
    let fixedRight = 0;
    let id = $('#table-sell-card5-report');
    let column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'id', name: 'id', className: 'text-center'},
            {data: 'table_name', name: 'table_name', className: 'text-left'},
            {data: 'customer_slot_number', name: 'customer_slot_number', className: 'text-center'},
            {data: 'employee_full_name', name: 'employee_full_name', className: 'text-left'},
            {data: 'amount', name: 'amount', className: 'text-right'},
            {data: 'discount_percent', name: 'discount_percent', className: 'text-right'},
            {data: 'discount_amount', name: 'discount_amount', className: 'text-right'},
            {data: 'total_amount', name: 'total_amount', className: 'text-right'},
            {data: 'payment_date', name: 'payment_date', className: 'text-left'},
            {data: 'note', name: 'note', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch', className: 'd-none', width:'5%'},
        ],
        option = [
            {
                'title': 'Xuất excel',
                'icon': 'fi-rr-print text-warning',
                'class': '',
                'function': 'exportExcelDiscountReport',
            }
        ]
    dataTableDiscount = await DatatableTemplateNew(id, data, column, vh_of_table_report, fixedLeft, fixedRight, option);
}
function dataDisTotal(data) {
    $('#total').text(data.total);
    totalValueDiscountReport = data.total;
    $('#total-value').text(totalValueDiscountReport);
}

function detectDateOptionTimeDiscount (type) {
    switch (type) {
        case 15:
            typeTimeSellDiscountReport = 15
            timeSellDiscountReport = ''
            fromDateDiscountReport = $('.from-month-filter-time-bar').val()
            toDateDiscountReport = $('.to-month-filter-time-bar').val()
            break;
        case 16:
            typeTimeSellDiscountReport = 16
            timeSellDiscountReport = ''
            fromDateDiscountReport = $('.from-year-filter-time-bar').val()
            toDateDiscountReport = $('.to-year-filter-time-bar').val()
            break;
        default:
            typeTimeSellDiscountReport = 13
            timeSellDiscountReport = ''
            fromDateDiscountReport = $('.from-date-filter-time-bar').val()
            toDateDiscountReport = $('.to-date-filter-time-bar').val()
    }
}
