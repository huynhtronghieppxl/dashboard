let checkSpamPointReport = 0,
    typeTimeSellPointReport = 1,
    timeSellPointReport = $('#calendar-day').val(),
    fromDatePointReport,
    toDatePointReport,
    dataTablePoint,
    tabActivePointFoodReport,
    pointType = $('#select-point-type').val(),
    pointSort = $('#select-point-sort').val(),
    myChartPoint = chartColumnEchart('chart-sell-report-vertical-main');

$(function () {

    $('#select-time-report ~ .select2.select2-container').on('click', function () {
        $('#select-time-report').val() === 'day' ? $("#day").removeClass("d-none") : false;
    })
    $(document).on("dp.change", "#calendar-day, #calendar-month, #calendar-year", function () {
        timeSellPointReport = $(this).val();
    });

    $(document).on('change', '#select-point-sort', function () {
        pointSort = $(this).val()
        loadData()
    })

    $(document).on('change', '#select-point-type', function () {
        pointType = $(this).val()
        loadData()
    })

    $('#detail-value-gift-food-report').on('change', function () {
        isVisibleDetailValueReport($('#detail-value-gift-food-report'), myChartPoint);
    })

    $(document).on("change", "#select-time-report", async function () {
        let timeVal = $(this).val();
        switch (timeVal) {
            case "day":
                $(".add-display").addClass("d-none");
                $("#day").removeClass("d-none");
                typeTimeSellPointReport = 1;
                timeSellPointReport = $('#calendar-day').val();
                fromDatePointReport = '';
                toDatePointReport = '';
                break;
            case "week":
                $(".add-display").addClass("d-none");
                $("#week").removeClass("d-none");
                typeTimeSellPointReport = 2;
                timeSellPointReport = moment().format('WW/YYYY');
                fromDatePointReport = '';
                toDatePointReport = '';
                break;
            case "month":
                $(".add-display").addClass("d-none");
                $("#month").removeClass("d-none");
                typeTimeSellPointReport = 3;
                timeSellPointReport = $('#calendar-month').val();
                fromDatePointReport = '';
                toDatePointReport = '';
                break;
            case "3month":
                $(".add-display").addClass("d-none");
                typeTimeSellPointReport = 4;
                timeSellPointReport = moment().format('MM/YYYY');
                fromDatePointReport = '';
                toDatePointReport = '';
                break;
            case "year":
                $(".add-display").addClass("d-none");
                $("#year.form-year-time-filter").removeClass("d-none");
                typeTimeSellPointReport = 5;
                timeSellPointReport = $('#calendar-year').val();
                fromDatePointReport = '';
                toDatePointReport = '';
                break;
            case "3year":
                $(".add-display").addClass("d-none");
                typeTimeSellPointReport = 6;
                timeSellPointReport = moment().format('YYYY');
                fromDatePointReport = '';
                toDatePointReport = '';
                break;
            case "13":
                $(".add-display").addClass("d-none");
                $('#btn-custom-time-filter').removeClass('d-none');
                $('#btn-custom-time-filter .custom-date').removeClass('d-none');
                fromDatePointReport = '';
                toDatePointReport = '';
                detectDateOptionTimePointFood(13);
                break;
            case "15":
                $(".add-display").addClass("d-none");
                $('#btn-custom-time-filter').removeClass('d-none');
                $('#btn-custom-time-filter .custom-month').removeClass('d-none');
                fromDatePointReport = '';
                toDatePointReport = '';
                detectDateOptionTimePointFood(15);
                break;
            case "16":
                $(".add-display").addClass("d-none");
                $('#btn-custom-time-filter').removeClass('d-none');
                $('#btn-custom-time-filter .custom-year').removeClass('d-none');
                fromDatePointReport = '';
                toDatePointReport = '';
                detectDateOptionTimePointFood(16);
                break;
            case "all_year":
                $(".add-display").addClass("d-none");
                typeTimeSellPointReport = 8;
                timeSellPointReport = moment().format('YYYY');
                fromDatePointReport = '';
                toDatePointReport = '';
                break;
        }
        await loadData();
        updateCookieSellPointFoodReport()
        isVisibleDetailValueReport($('#detail-value-point-report'), myChartPoint);
    });
    $('#month .custom-button-search').on('click', function () {
        typeTimeSellPointReport = 3;
        timeSellPointReport = $('#calendar-month').val();
        fromDatePointReport = '';
        toDatePointReport = '';
        loadData();
        updateCookieSellPointFoodReport()
    })
    $('#year .custom-button-search').on('click', function () {
        typeTimeSellPointReport = 5;
        timeSellPointReport = $('#calendar-year').val();
        fromDatePointReport = '';
        toDatePointReport = '';
        loadData();
        updateCookieSellPointFoodReport()
    })
    $('#day .custom-button-search').on('click', function () {
        typeTimeSellPointReport = 1;
        timeSellPointReport = $('#calendar-day').val();
        fromDatePointReport = '';
        toDatePointReport = '';
        loadData();
        updateCookieSellPointFoodReport()
    })
    $(".search-date-option-filter-time-bar").on("click", async function () {
        await detectDateOptionTimePointFood( Number($("#select-time-report").val()));
        loadData();
    });

    /* Set cookie */
    if (getCookieShared('sell-point-food-report-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('sell-point-food-report-user-id-' + idSession));
        tabActivePointFoodReport = dataCookie.tabActivePointFoodReport;
    }
    $('#btn-type-time-sell-gift-food-report button').on('click', function () {
        tabActivePointFoodReport = $(this).attr('id')
        updateCookieSellPointFoodReport()
    });
    $('#btn-type-time-sell-gift-food-report button[id="'+ tabActivePointFoodReport +'"]').click()
    loadData();
    /* end cookie */
})

async function loadData(){
    if(checkSpamPointReport === 1) return false;
    checkSpamPointReport = 1
    updateCookieSellPointFoodReport()
    let method = 'get',
        url = 'point-report.data',
        params = {
            pointType: pointType,
            pointSort: pointSort,
            type: typeTimeSellPointReport,
            time: timeSellPointReport,
            from_date: fromDatePointReport,
            to_date: toDatePointReport
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,
        [$('#table-sell-card9-report'),
            $('#chart-sell-report-vertical-main')
        ])
    checkSpamPointReport = 0;
    dataPointTable(res.data[1].original.data);
    dataVatsTotal(res.data[2]);
    chartPointEchartReport(res.data[0])
}

function dataVatsTotal(data) {
    $("#point-revenue").text(data.totalNumberReceive);
    $("#point-number").text(data.totalReceive);
    $("#point-use").text(data.totalNumberUsed);
    $("#total-point-use").text(data.totalUsed);
    $("#remaining-point").text(data.totalRemaining);
}

async function dataPointTable(data) {
    let fixedLeft = 2;
    let fixedRight = 0;
    let id = $('#table-sell-card9-report');
    let column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', class: 'text-center'},
            {data: 'name', name: 'name'},
            {data: 'restaurant_membership_card_name', name: 'restaurant_membership_card_name', className: 'text-left'},
            {data: 'total_point_receive', name: 'total_points_received', className: 'text-right'},
            {data: 'point_receive', name: 'point_received', className: 'text-right'},
            {data: 'total_point_use', name: 'total_point_use', className: 'text-right'},
            {data: 'point_use', name: 'point_use', className: 'text-right'},
            {data: 'total_point_remaining', name: 'remaining_point', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none', width:'5%'},
        ],
        option = [
            {
                'title': 'Xuất excel',
                'icon': 'fi-rr-print',
                'class': 'seemt-btn-hover-blue',
                'function': 'exportExcelGiftFoodReport',
            }
        ]
    dataTablePoint = await DatatableTemplateNew(id, data, column, '45vh', fixedLeft, fixedRight, option);
    $(document).on('input paste keyup keydown', '#table-sell-card9-report_filter', async function () {
        let total_points_received = 0,
        point_received = 0,
        total_point_use = 0,
        point_use = 0,
        remaining_point = 0;
        await dataTablePoint.rows({'search': 'applied'}).every(function () {
            let row = $(this.node());
            total_points_received += removeformatNumber(row.find('td:eq(4)').text());
            point_received += removeformatNumber(row.find('td:eq(5)').text());
            total_point_use += removeformatNumber(row.find('td:eq(6)').text());
            point_use += removeformatNumber(row.find('td:eq(7)').text());
            remaining_point += removeformatNumber(row.find('td:eq(8)').text());
        })
        $('#point-revenue').text(formatNumber(total_points_received));
        $('#point-number').text(formatNumber(point_received));
        $('#point-use').text(formatNumber(total_point_use));
        $('#total-point-use').text(formatNumber(point_use));
        $('#remaining-point').text(formatNumber(remaining_point));
    })
}

function updateCookieSellPointFoodReport() {
    saveCookieShared('sell-point-food-report-user-id-' + idSession, JSON.stringify({
        tabActivePointFoodReport: tabActivePointFoodReport,
    }))
}

function detectDateOptionTimePointFood (type) {
    switch (type) {
        case 15:
            typeTimeSellPointReport = 15;
            timeSellPointReport = "";
            fromDatePointReport = $(".from-month-filter-time-bar").val();
            toDatePointReport = $(".to-month-filter-time-bar").val();
            break;
        case 16:
            typeTimeSellPointReport = 16;
            timeSellPointReport = "";
            fromDatePointReport = $(".from-year-filter-time-bar").val();
            toDatePointReport = $(".to-year-filter-time-bar").val();
            break;
        default:
            typeTimeSellPointReport = 13;
            timeSellPointReport = "";
            fromDatePointReport = $(".from-date-filter-time-bar").val();
            toDatePointReport = $(".to-date-filter-time-bar").val();
    }
}



function chartPointEchartReport(data){
    let heightChart = data.length > 40 ? ($(window).innerHeight() <= 797 ? '65%': '75%') : ($(window).innerHeight() <= 797 ? '70%': '80%');
    if(data.length === 0){
        $('#chart-sell-report-vertical-empty').removeClass('d-none')
        $('#chart-sell-report-vertical-main').addClass('d-none')
        return false;
    }else {
        $('#chart-sell-report-vertical-empty').addClass('d-none')
        $('#chart-sell-report-vertical-main').removeClass('d-none')
    }
    let chartDom = document.getElementById('chart-sell-report-vertical-main');
    let myChart = echarts.init(chartDom);
    let option = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            },
            textStyle: {
                fontSize: 12,
                fontFamily: 'Roboto'
            },
            formatter: function (value, i) {
                return `<strong class="d-flex align-items-center ">${value[0].axisValue}</strong>
                        <div class="d-flex align-items-center"><i class="fa-solid fa-circle mr-1" style="font-size: 5px"></i>Tổng điểm : ${formatNumber(value[0].value)}</div>`;
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
                data:  data.map(item=>{
                    return item.timeline;
                }),
            },
        ],
        grid : {
            width: "90%",
            height: heightChart,
            left: "8%"
        },
        yAxis: [
            {
                axisLabel: {
                    margin: 10,
                },
                name: "Số điểm sử dụng",
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
            startValue: 0,
            endValue: 39,
            // start: 0,
            // end: data.length > 20 ? 20 : 100,
            xAxisIndex: 0,
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
                barMaxWidth: 30,
                data:  data.map(item=>{
                    return item.value;
                }),
                itemStyle: {
                    color: '#2A74D9'
                }
            },
        ],
    };

    $('#detail-value-point-report').on('click', function (){
        if($('#detail-value-point-report').is(':checked')){
            myChart.setOption({
                series : {
                    label: {
                        show: true,
                        verticalAlign: "middle",
                        position: "top",
                        color: "rgba(0, 0, 0, 1)",
                        rotate: 0,
                        distance: 15,
                        fontWeight: "bolder",
                        fontFamily: "roboto",
                        formatter : function (param){
                            return formatNumber(param.value);
                        }
                    },
                },
            });
        }else {
            myChart.setOption({
                series : {
                    label: {show: false},
                },
            });
        }
    })
    myChart.resize();
    $(window).on('resize', function () {
        myChart.resize();
    });
    option && myChart.setOption(option);
}
