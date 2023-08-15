let chartEmployee;
let typeFilterEmployeeReport, timeFilterEmployeeReport, fromFilterEmployeeReport, toFilterEmployeeReport;
typeFilterEmployeeReport = $('#select-type-employee-report select').find('option:selected').val();
timeFilterEmployeeReport = $('#select-type-employee-report select').find('option:selected').data('time');
$('#select-type-employee-report select').on('change', function () {
    loadDataEmployeeReport = 0;
    typeFilterEmployeeReport = $(this).val();
    timeFilterEmployeeReport = $(this).find('option:selected').data('time');
    switch (Number($(this).val())) {
        case 13:
            fromFilterEmployeeReport = $(this).parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterEmployeeReport = $(this).parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            fromFilterEmployeeReport = $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterEmployeeReport = $(this).parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            fromFilterEmployeeReport = $(this).parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterEmployeeReport = $(this).parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            fromFilterEmployeeReport = "";
            toFilterEmployeeReport = "";
    }
    dataEmployeeReport();
    getTimeChangeSelectTypeDashboardReport($('#text-label-type-employee-report'), $('#select-type-employee-report'));
});
getTimeChangeSelectTypeDashboardReport($('#text-label-type-employee-report'), $('#select-type-employee-report'));

$('#select-type-employee-report .search-date-option-filter-time-bar').on('click', function () {
    detectDateOptionTimeEmployee(Number($('#select-type-employee-report select').find('option:selected').val()))
    // if(!CheckDateFormTo(fromFilterEmployeeReport, toFilterEmployeeReport)) return false
    if(!checkDashboardCustomDateTimePicker($(this), $('#select-type-employee-report select'))) return false;
    reloadEmployeeReport()
})

function detectDateOptionTimeEmployee(type) {
    switch (type){
        case 13:
            fromFilterEmployeeReport = $('#select-type-employee-report select').parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterEmployeeReport = $('#select-type-employee-report select').parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            break;
        case 15:
            fromFilterEmployeeReport = $('#select-type-employee-report select').parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterEmployeeReport = $('#select-type-employee-report select').parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            break;
        case 16:
            fromFilterEmployeeReport = $('#select-type-employee-report select').parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterEmployeeReport = $('#select-type-employee-report select').parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            break;
        default:
            fromFilterEmployeeReport = "";
            toFilterEmployeeReport = "" ;
    }
}

/**
 * Event
 */

/**
 * Call data
 * @returns {Promise<void>}
 */
function dataEmployeeReport() {
    $('.chart-vertical-employee-report-loading').remove();
    $('.chart-horizontal-employee-report-loading').remove();
    $('.loading-employee-report-loading').remove();
    if (loadDataEmployeeReport === 1) return false;
    loadDataEmployeeReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val();
    $('#chart-vertical-employee-report').prepend(themeLoading($('#chart-vertical-employee-report').height(), 'chart-horizontal-employee-report-loading'))
    $('#chart-vertical-employee-report-empty').prepend(themeLoading($('#chart-vertical-employee-report').height(), 'chart-horizontal-employee-report-loading'))
    $('#table-employee-report_wrapper').prepend(themeLoading($('#chart-vertical-employee-report').height(), 'loading-employee-report-loading'))
    axios({
        method: 'get',
        url: 'branch-dashboard.data-employee-report',
        params: {brand: brand, branch: branch, type: typeFilterEmployeeReport, time: timeFilterEmployeeReport , form: fromFilterEmployeeReport , to: toFilterEmployeeReport}
    }).then(function (res) {
        console.log(res);
        if (res.data[0].length > 50) {
            $('#chart-vertical-employee-report').attr('style', 'width:' + res.data[0].length * 20 + 'px; min-width: 100%');
            $('#chart-horizontal-employee-report').attr('style', 'height:' + res.data[0].length * 15 + 'px; min-height: 400px');
        } else {
            $('#chart-vertical-employee-report').attr('style', false);
            $('#chart-horizontal-employee-report').attr('style', false);
        }
        drawEchartEmployeeReportDashboard(res.data[0]);
        let scroll_Y = '60vh';
        let fixed_left = 0;
        let fixed_right = 0;
        let id = $('#table-employee-report');
        let column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', className: 'text-center', width: '5%'},
            {data: 'employee_name', name: 'employee_name', className: 'text-center'},
            {data: 'employee_role_name', name: 'employee_role_name', className: 'text-center'},
            {data: 'revenue', name: 'revenue', className: 'text-center'},
        ];
        DatatableTemplateNew(id, res.data[1].original.data, column, scroll_Y, fixed_left, fixed_right);
        $('.chart-vertical-employee-report-loading').remove();
        $('.chart-horizontal-employee-report-loading').remove();
        $('.loading-employee-report-loading').remove();
    }).catch(function (e) {
        console.log(e);
    });
}

function drawEchartEmployeeReportDashboard(data){
    let heightChart = data.timeline.length > 40 ? (heightWindow <= 797 ? '55%': '60%') : (heightWindow <= 797 ? '65%': '75%');
    try{
        if(data.timeline.length === 0){
            $('#chart-vertical-employee-report-empty').removeClass('d-none');
            $('#chart-vertical-employee-report').addClass('d-none');
        } else {
            $('#chart-vertical-employee-report-empty').addClass('d-none');
            $('#chart-vertical-employee-report').removeClass('d-none');
        }
        let dom = document.getElementById("chart-vertical-employee-report");
        chartEmployee = echarts.init(dom, null, {
            renderer: "canvas",
            useDirtyRect: false,
        });
        let option = {
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                },
                textStyle: {
                    fontFamily: 'Roboto',
                    fontSize: 12
                },
                formatter: function (value, i) {
                    return `<strong class="d-flex align-items-center ">${value[0].axisValue}</strong>
                            <div class="d-flex align-items-center"><i class="fa-solid fa-circle mr-1" style="font-size: 5px"></i>Số lượng đơn : ${data.quantity[value[0].dataIndex]}</div>
                            <div class="d-flex align-items-center"><i class="fa-solid fa-circle mr-1" style="font-size: 5px"></i>Tổng tiền : ${formatNumber(value[0].value)}</div>`;
                },
            },
            title: {
                text: '{a|Tổng:} {b|' + data.total_amount + '} {a|VNĐ}',
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
            xAxis: [
                {
                    type: "category",
                    axisLabel: {
                        interval: 0,
                        rotate: 45,
                        fontSize: 12,
                        fontWeight: 500,
                        overflow: 'truncate', // sử dụng overflow để đảm bảo không bị cắt chữ khi text xuống hàng
                        width: 100,
                        showMinLabel: true,
                        showMaxLabel: true,
                        fontFamily: 'Roboto',
                    },
                    data: data.timeline,
                },
            ],
            grid : {
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
                                return value % 1000000000 === 0 ? formatNumber(value / 1000000000) + " tỷ" : formatNumber((value / 1000000000).toFixed(1)) + " tỷ";
                            }
                            if (value > 999999) {
                                return value % 1000000 === 0 ? formatNumber(value / 1000000) + " triệu" : formatNumber((value / 1000000).toFixed(1)) + " triệu";
                            }
                            if (value > 999) {
                                return value % 1000 === 0 ? formatNumber(value / 1000) + " ngàn" : formatNumber((value / 1000).toFixed(1)) + " ngàn";
                            }
                            if (value < -999999999) {
                                return value % 1000000000 === 0 ? formatNumber(value / 1000000000) + " tỷ" : formatNumber((value / 1000000000).toFixed(1)) + " tỷ";
                            }
                            if (value < -999999) {
                                return value % 1000000 === 0 ? formatNumber(value / 1000000) + " triệu" : formatNumber((value / 1000000).toFixed(1)) + " triệu";
                            }
                            if (value < -999) {
                                return value % 1000 === 0 ? formatNumber(value / 1000) + " ngàn" : formatNumber((value / 1000).toFixed(1)) + " ngàn";
                            }
                        },
                        margin: 10,
                    },
                    name: "SỐ TIỀN (VNĐ)",
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
                show: data.timeline.length > 20,
                height: 20,
                startValue: 0,
                endValue: 19,
                // start: 0,
                // end: data.timeline.length > 20 ? 19 : 100,
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
                    data: data.value,
                    barMaxWidth: 20,
                    itemStyle: {
                        color: '#2A74D9',
                    },
                },
            ],
        };
        if (option && typeof option === "object") {
            chartEmployee.setOption(option);
        }
        $('.detail-value-employee-report').on('change', function (){
            if($('.detail-value-employee-report').is(':checked')){
                chartEmployee.setOption({
                    series : {
                        label: {
                            show: true,
                            verticalAlign: "middle",
                            position: [10, -5, 0, 0],
                            color: "#000",
                            rotate: 60,
                            distance: 15,
                            textStyle: {
                                fontFamily: "Roboto",
                                fontSize: 12
                            },
                            formatter : function (param){
                                return formatNumber(param.value);
                            }
                        },
                    },
                });
            }else {
                chartEmployee.setOption({
                    series : {
                        label: {show: false},
                    },
                });
            }
        })
        chartEmployee.resize();
        $(window).on('resize', function () {
            chartEmployee.resize();
        });
    } catch (e) {
        console.log(e);
        $('#chart-vertical-employee-report-empty').removeClass('d-none');
        $('#chart-vertical-employee-report').addClass('d-none');
    }
    chartEmployee.resize();
    $(window).on('resize', function (){
        chartEmployee.resize();
    });
}

/**
 * Reload Data
 */
function reloadEmployeeReport() {
    loadDataEmployeeReport = 0;
    dataEmployeeReport();
}

