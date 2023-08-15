let typeTimeSellSurchargeReport = 1, timeSellSurchargeReport = $('#calendar-day').val(), checkSpamSurchargeReport = 0, tabTimeSellDiscountReport;
let dataExcelDiscountReport, fromDateDiscountReport, toDateDiscountReport, newDataAfterChangeTimeSurchargeReport, dataTableSurcharge;
let chartSurchargeReport = chartSurchargeColumnEchart('chart-sell-surcharge-report-vertical');
$(async function () {

    $('#content-detail').on("dp.change", "#calendar-day, #calendar-month, #calendar-year ",function () {
        timeSellSurchargeReport = $(this).val();
    });

    $(window).resize(function () {
        if ($(window).width() < 1450) {
            $('.filter-header').removeClass('d-none')
            $('.total-surcharge').removeClass('d-none')
            $('.amount-total-header-report').addClass('d-none')
        }else {
            $('.filter-header').addClass('d-none')
            $('.total-surcharge').addClass('d-none')
            $('.amount-total-header-report').removeClass('d-none')
        }
    })

    $(document).on('change', '#select-time-report', async function () {
        let timeVal = $(this).val();
        switch (timeVal) {
            case 'day' :
                $('.add-display').addClass('d-none');
                $('#day').removeClass('d-none');
                typeTimeSellSurchargeReport = 1;
                timeSellSurchargeReport = $('#calendar-day').val();
                fromDateDiscountReport = '';
                toDateDiscountReport = '';
                break;
            case 'week' :
                $('.add-display').addClass('d-none');
                $('#week').removeClass('d-none');
                typeTimeSellSurchargeReport = 2;
                timeSellSurchargeReport = moment().format('WW/YYYY');
                fromDateDiscountReport = '';
                toDateDiscountReport = '';
                break;
            case 'month' :
                $('.add-display').addClass('d-none');
                $('#month').removeClass('d-none');
                typeTimeSellSurchargeReport = 3;
                timeSellSurchargeReport = $('#calendar-month').val();
                fromDateDiscountReport = '';
                toDateDiscountReport = '';
                break;
            case '3month' :
                $('.add-display').addClass('d-none');
                typeTimeSellSurchargeReport = 4;
                timeSellSurchargeReport = moment().format('MM/YYYY');
                fromDateDiscountReport = '';
                toDateDiscountReport = '';
                break;
            case 'year' :
                $('.add-display').addClass('d-none');
                $('#year').removeClass('d-none');
                typeTimeSellSurchargeReport = 5;
                timeSellSurchargeReport = $('#calendar-year').val();
                fromDateDiscountReport = '';
                toDateDiscountReport = '';
                break;
            case '3year' :
                $('.add-display').addClass('d-none');
                typeTimeSellSurchargeReport = 6;
                timeSellSurchargeReport = moment().format('YYYY');
                fromDateDiscountReport = '';
                toDateDiscountReport = '';
                break;
            case 'select_time' :
                $('.add-display').addClass('d-none');
                $('#btn-custom-time-filter').removeClass('d-none');
                typeTimeSellSurchargeReport = 6;
                timeSellSurchargeReport = moment().format('YYYY');
                fromDateDiscountReport = '';
                toDateDiscountReport = '';
                break;
            case 'all_year' :
                $('.add-display').addClass('d-none');
                typeTimeSellSurchargeReport = 8;
                timeSellSurchargeReport = moment().format('YYYY');
                fromDateDiscountReport = '';
                toDateDiscountReport = '';
                break;
        }
        await loadData();
        isVisibleDetailValueReport($('#detail-value-surcharge-report'), chartSurchargeReport);
    })

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
        await detectDateOptionTimeSurcharge(Number($("#select-time-report").val()));
        loadData();
    });
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

    $('#detail-value-surcharge-report').on('change', function () {
        isVisibleDetailValueReport($('#detail-value-surcharge-report'), chartSurchargeReport);
    })
});

function updateCookieSellDiscountReport(){
    saveCookieShared('sell-discount-report-user-id-' + idSession, JSON.stringify({
        tabTimeSellDiscountReport : tabTimeSellDiscountReport,
        day : $('#calendar-day').val(),
        month : $('#calendar-month').val(),
        year : $('#calendar-year').val(),
    }))
}

function detectDateOptionTimeSurcharge(type) {
    switch (type) {
        case 15:
            typeTimeSellSurchargeReport = 15;
            timeSellSurchargeReport = "";
            fromDateDiscountReport = $(".from-month-filter-time-bar").val();
            toDateDiscountReport = $(".to-month-filter-time-bar").val();
            break;
        case 16:
            typeTimeSellSurchargeReport = 16;
            timeSellSurchargeReport = "";
            fromDateDiscountReport = $(".from-year-filter-time-bar").val();
            toDateDiscountReport = $(".to-year-filter-time-bar").val();
            break;
        default:
            typeTimeSellSurchargeReport = 13;
            timeSellSurchargeReport = "";
            fromDateDiscountReport = $(".from-date-filter-time-bar").val();
            toDateDiscountReport = $(".to-date-filter-time-bar").val();
    }
}

async function loadData() {
    if(checkSpamSurchargeReport === 1) return false;
    updateCookieSellDiscountReport();
    checkSpamSurchargeReport = 1;
    let brand = $('.select-brand').val(),
        branch = $(".select-branch").val(),
        method = 'get',
        params = {
            brand: brand,
            branch: branch,
            type: typeTimeSellSurchargeReport,
            time: timeSellSurchargeReport,
            from_date: fromDateDiscountReport,
            to_date: toDateDiscountReport,
        },
        data = null,
        url = 'surcharge-report.data',
        res = await axiosTemplate(method, url, params, data, [
            $("#chart-sell-surcharge-report-vertical-main"),
            $("#table-sell-surcharge-report"),
            $("#chart-sell-surcharge-report-vertical")
        ]);
    checkSpamSurchargeReport = 0;

    await dataDisTable(res.data[1].original.data);
    dataSurTotal(res.data[2]);
    updateChartSurchargeColumnEchart(chartSurchargeReport, res.data[0], res.data[2].total);
}
function updateChartSurchargeColumnEchart(chart , data, dataTotalAmount){
    let heightChart = data.length > 40 ? ($(window).innerHeight() <= 797 ? '80%': '85%') : ($(window).innerHeight() <= 797 ? '85%': '90%');
    if (data.length === 0) {
        $('#chart-sell-report-vertical-empty').removeClass('d-none')
        $('#chart-sell-surcharge-report-vertical-main').addClass('d-none')
        $('#detail-value-surcharge-report-box').addClass('d-none')
    } else {
        $('#chart-sell-report-vertical-empty').addClass('d-none')
        $('#chart-sell-surcharge-report-vertical-main').removeClass('d-none')
        $('#detail-value-surcharge-report-box').removeClass('d-none')
        newDataAfterChangeTimeSurchargeReport = data;
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
                left: '3%',
                right: '4%',
                // bottom: '15%',
                height: heightChart,
                containLabel: true
            },
            title: {
                text: '{a|Tổng:} {b|' + formatNumber(dataTotalAmount) + '} {a|VNĐ}',
                left: 'center',
                top: 0, // Khoảng cách giữa tiêu đề và đỉnh biểu đồ
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
                show: newDataAfterChangeTimeSurchargeReport.length !== 0,
                axisLabel: {
                    interval: data.timeline.length > 36 ? 2 : 0,
                    rotate: 45,
                    width: 120,
                    fontFamily: 'Roboto'
                },
            },
            yAxis: {
                show: data.length !== 0,
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

function chartSurchargeColumnEchart(element){
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
    let id = $('#table-sell-surcharge-report');
    let column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'amount', name: 'amount', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch', className: 'd-none', width:'5%'},
        ],
        option = [
            {
                'title': 'Xuất excel',
                'icon': 'fi-rr-print',
                'class': '',
                'function': 'exportExcelSurchargeReport',
            }
        ]
    dataTableSurcharge = await DatatableTemplateNew(id, data, column, vh_of_table_report, fixedLeft, fixedRight, option);
    $(document).on('input paste', '#table-sell-surcharge-report', async function () {
        let dataTableDis = 0;
        await dataTableDis.rows({'search': 'applied'}).every(function () {
            let row = $(this.node());
            dataTableDis += removeformatNumber(row.find('td:eq(2)').text());
        })
        $('#total-value').text(formatNumber(dataTableDis));
    })
}
function dataSurTotal(data) {
    $('#total').text(data.total);
    $('#total-surcharge').text(data.total);
    $('#total-value').text(data.total);
}
