let typeActionBusinessResult = 5,
    timeActionBusinessResult = $('#calendar-year').val(),
    indexActionBusinessResult = 12,
    monthActionBusinessResult, yearActionBusinessResult,
    typeTimeBusinessResult, currentTypeBusinessResultReport, myChartBusinessResultReport;

$(function () {
    /* Set cookie */
    if(getCookieShared('business-result-data-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('business-result-data-user-id-' + idSession));
        typeTimeBusinessResult = dataCookie.type;
        monthActionBusinessResult = dataCookie.month;
        yearActionBusinessResult = dataCookie.year;
        $('#calendar-month').val(monthActionBusinessResult);
        $('#calendar-year').val(yearActionBusinessResult);
    }
    $('#btn-type-time-business-result-report button').on('click', function () {
        typeTimeBusinessResult = $(this).attr('id')
        updateCookieBusinessResultData();
    })
    $('#btn-type-time-business-result-report button[id="' + typeTimeBusinessResult + '"]').click();
    /* End cookie */

    dateTimePickerMonthYearTemplate($('#calendar-month'));
    dateTimePickerYearTemplate($('#calendar-year'));
    loadData();
    $('#calendar-month').on('dp.change', function () {
        typeActionBusinessResult = 3;
        timeActionBusinessResult = $('#calendar-month').val();
        indexActionBusinessResult = moment($('#calendar-month').val(), 'MM/YYYY').clone().endOf('month').format('DD');
        loadData();
        updateCookieBusinessResultData();
    });
    $('#calendar-year').on('dp.change', function () {
        typeActionBusinessResult = 5;
        timeActionBusinessResult = $('#calendar-year').val();
        indexActionBusinessResult = 12;
        loadData();
        updateCookieBusinessResultData();
    });
    $('#month .custom-button-search').on('click',function (){
        loadData();
    })
    $('#year .custom-button-search').on('click',function (){
        loadData();
    })
});

/* Set cookie */
function updateCookieBusinessResultData() {
    saveCookieShared('business-result-data-user-id-' + idSession, JSON.stringify({
        type : typeTimeBusinessResult,
        month : $('#calendar-month').val(),
        year : $('#calendar-year').val()
    }))
}
/* End cookie */

async function loadData() {
    let brand = $('#restaurant-branch-id-selected span').attr('data-value'),
        branch = $(".select-branch").val(),
        method = 'get',
        params = {brand: brand, branch: branch, type: typeActionBusinessResult, time: timeActionBusinessResult, index: indexActionBusinessResult},
        data = null,
        url = 'business-results-report.data';
    let res = await axiosTemplate(method, url, params, data,[
        $("#chart-business-results-report-vertical-card-revenue"),
        $("#chart-business-results-report-vertical-card-profit"),
        $("#chart-business-result-card1-0"),
        $("#chart-business-result-card1-1"),
        $("#chart-business-result-card1-2"),
        $("#chart-business-result-card1-3"),
        $("#chart-business-result-card1-4"),
        $("#chart-business-result-card1-5"),
        $("#chart-business-result-card1-6"),
        $("#chart-business-result-card1-7"),
        $("#chart-business-result-card1-8"),
        $("#chart-business-result-card1-9"),
        $("#chart-business-result-card1-10"),
        $("#chart-business-result-card1-11"),
        $("#chart-business-result-card1-12"),
        $("#chart-business-result-card1-13"),
        $("#chart-business-result-card1-14"),
        $("#chart-business-result-card1-15"),
        $("#chart-business-result-card1-16"),
        $("#chart-business-result-card1-17"),
        $("#chart-business-result-card1-18"),
        $("#chart-business-result-card1-19"),
        $("#chart-business-result-card1-20"),
        $("#chart-business-result-card1-21"),
        $("#chart-business-result-card1-22"),
        $("#chart-business-result-card1-23"),
        $("#chart-business-result-card1-24"),
        $("#chart-business-result-card1-25"),
        $("#chart-business-result-card1-26"),
        $("#chart-business-result-card1-27"),
    ]);
    let arr = []
    // Revenue
    $.each(res.data[0], function(key, value) {
        arr.push(value)
    });
    eChart('chart-business-results-report-vertical-card-revenue-main',
        res.data[0] === null ? [] : res.data[0].map(i => {
            return i.timeline;
        }),
        res.data[0] === null ? [] : res.data[0].map(i => {
            return i.value;
        }),
        // res.data[6].total_profit
    )
    // Profit
    $.each(res.data[1], function(key, value) {
        arr.push(value)
    });
    eChart('chart-business-results-report-vertical-card-profit-main',
        res.data[1] === null ? [] : res.data[1].map(i => {
            return i.timeline;
        }),
        res.data[1] === null ? [] : res.data[1].map(i => {
            return i.value;
        }),
        res.data[6].total_revenue,
    res.data[6].total_profit
    )
    // dataCardRevenue(res.data[0]);
    // dataCardProfit(res.data[1]);
    dataCardCost(res.data[2]);
    $('#total-revenue-business-results-report').text(res.data[6].total_revenue);
    $('#total-profit-business-results-report').text(res.data[6].total_profit);
}
