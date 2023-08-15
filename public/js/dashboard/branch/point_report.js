let chartPointDashboard = chartColumnEchart('chart-vertical-discount-report');
let typeFilterPointReport, timeFilterPointReport , fromFilterPointReport , toFilterPointReport;
typeFilterPointReport = $('#select-type-point-report select').find('option:selected').val();
timeFilterPointReport = $('#select-type-point-report select').find('option:selected').data('time');
// typePointReport = $('#select-option-type-point-filter-report').find('option:selected').val();
// typeSortReport = $('#select-option-type-sort-filter-report').find('option:selected').val();
/**
 * Event
 */
$('#select-type-point-report select').on('change', function () {
    loadDataPointReport = 0;
    typeFilterPointReport = $(this).val();
    timeFilterPointReport = $(this).find('option:selected').data('time');
    switch (Number($(this).val())){
        case 13:
            fromFilterPointReport = $(this).parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterPointReport = $(this).parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            $('#time-filter').text(`${fromFilterPointReport} - ${toFilterPointReport}`)
            break;
        case 15:
            fromFilterPointReport = $(this).parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterPointReport = $(this).parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            $('#time-filter').text(`${fromFilterPointReport} - ${toFilterPointReport}`)
            break;
        case 16:
            fromFilterPointReport = $(this).parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterPointReport = $(this).parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            $('#time-filter').text(`${fromFilterPointReport} - ${toFilterPointReport}`)
            break;
        default:
            fromFilterPointReport = "";
            toFilterPointReport = "" ;
    }
    dataPointReport();
    getTimeChangeSelectTypeDashboardPointReport($('#text-label-type-point-report'), $('#select-type-point-report'));
});
getTimeChangeSelectTypeDashboardPointReport($('#text-label-type-point-report'), $('#select-type-point-report'));

$('#select-option-type-sort-filter-report').on('change', function (){
    reloadPointReport()
})

$('#select-option-type-point-filter-report').on('change', function (){
    reloadPointReport()
})

$('#select-point-type').on('change', function () {
    reloadPointReport()
})

$('#select-point-sort').on('change', function () {
    reloadPointReport()
})

$('#select-type-point-report .search-date-option-filter-time-bar').on('click', function () {
    detectDateOptionTimePoint(Number($('#select-type-point-report select').find('option:selected').val()))
    // if(!CheckDateFormTo(fromFilterPointReport, toFilterPointReport)) return false
    if(!checkDashboardCustomDateTimePicker($(this), $('#select-type-point-report select'))) return false;
    reloadPointReport();
})

function detectDateOptionTimePoint(type) {
    switch (type){
        case 13:
            fromFilterPointReport = $('#select-type-point-report select').parents('.filter-dashboard-report').find('.from-date-filter-time-bar').val();
            toFilterPointReport = $('#select-type-point-report select').parents('.filter-dashboard-report').find('.to-date-filter-time-bar').val();
            $('#time-filter').text(`${fromFilterPointReport} - ${toFilterPointReport}`)
            break;
        case 15:
            fromFilterPointReport = $('#select-type-point-report select').parents('.filter-dashboard-report').find('.from-month-filter-time-bar').val();
            toFilterPointReport = $('#select-type-point-report select').parents('.filter-dashboard-report').find('.to-month-filter-time-bar').val();
            $('#time-filter').text(`${fromFilterPointReport} - ${toFilterPointReport}`)
            break;
        case 16:
            fromFilterPointReport = $('#select-type-point-report select').parents('.filter-dashboard-report').find('.from-year-filter-time-bar').val();
            toFilterPointReport = $('#select-type-point-report select').parents('.filter-dashboard-report').find('.to-year-filter-time-bar').val();
            $('#time-filter').text(`${fromFilterPointReport} - ${toFilterPointReport}`)
            break;
        default:
            fromFilterPointReport = "";
            toFilterPointReport = "" ;
    }
}
/**
 * Call data
 * @returns {Promise<void>}
 */
function dataPointReport() {
    $('.chart-point-report-loading').remove();
    $('.loading-point-customer-report-loading').remove();
    if (loadDataPointReport === 1) return false;
    loadDataPointReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        type_sort = $('#select-option-type-sort-filter-report').val(),
        type_point = $('#select-option-type-point-filter-report').val();
    $('#chart-customer-use-point-report').prepend(themeLoading($('#chart-customer-use-point-report').height(), 'chart-point-report-loading'))
    $('#table-point-report').prepend(themeLoading($('#table-point-report').height(), 'loading-point-customer-report-loading'))
    axios({
        method: 'get',
        url: 'branch-dashboard.data-point-report',
        params: {brand: brand, branch: branch, type: typeFilterPointReport, time: timeFilterPointReport, from: fromFilterPointReport, to: toFilterPointReport, type_point: type_point, type_sort: type_sort}
    }).then(function (res) {
        console.log(res);
        if(res.data[0].timeline.length == 0){
            $('#chart-customer-use-point-report').addClass('d-none');
            $('#chart-customer-use-point-report-empty').removeClass('d-none');
        }else {
            $('#chart-customer-use-point-report-empty').addClass('d-none');
            $('#chart-customer-use-point-report').removeClass('d-none');
        }
        chartPointEchartReport(res.data[0]);
        tablePointReport(res.data[1].original.data);

        $('#total-receive').text(res.data[2]['totalReceive']);
        $('#total-used').text(res.data[2]['totalUsed']);
        $('#total-remaining').text(res.data[2]['totalRemaining']);
        $('#total-number-receive').text(res.data[2]['totalNumberReceive']);
        $('#total-number-used').text(res.data[2]['totalNumberUsed']);
        $('.chart-point-report-loading').remove();
        $('.loading-point-customer-report-loading').remove();
    }).catch(function (e) {
        console.log(e);
    });
}


function chartPointEchartReport(data){
    let heightChart = data.timeline.length > 40 ? (heightWindow <= 797 ? '55%': '70%') : (heightWindow <= 797 ? '65%': '75%');
    let chartDom = document.getElementById('chart-customer-use-point-report');
    let myChart = echarts.init(chartDom);
    let option = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            },
            textStyle:{
                fontSize: 12,
                fontFamily: "Roboto"
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
                data:  data.timeline
            },
        ],
        grid : {
            width: "90%",
            height: heightChart,
            left: '7%'
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
            show: data.timeline.length > 40,
            height: 20,
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
                data:  data.value,
                barMaxWidth: 20,
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
                        position: [10, -5, 0, 0],
                        color: "#000",
                        rotate: 60,
                        distance: 15,
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

function tablePointReport(data) {
    let id = $('#table-point-report'),
        scroll_Y = '40vh',
        fixed_left = 0,
        fixed_right = 1,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left',  width: '15%'},
            {data: 'restaurant_membership_card_name', name: 'restaurant_membership_card_name', className: 'text-left'},
            {data: 'total_point_receive', name: 'total_point_receive', className: 'text-right'},
            {data: 'total_point_use', name: 'total_point_use', className: 'text-right'},
            {data: 'total_point_remaining', name: 'total_point_remaining', className: 'text-right'},
            {data: 'point_receive', name: 'total_point_receive', className: 'text-right'},
            {data: 'point_use', name: 'total_point_use', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center'},
        ];
    DatatableTemplateNew(id, data, column, scroll_Y, fixed_left, fixed_right)
}

/**
 * Reload Data
 */
function reloadPointReport() {
    loadDataPointReport = 0;
    dataPointReport();
}
