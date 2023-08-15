let typeTimeSellDetailRevenueReport = 1, timeSellDetailRevenueReport = $('#calendar-day').val(), checkSpamOffMenuReport = 0;
let  fromDateDetailRevenueReport, toDateDetailRevenueReport,
    loadDataDetailRevenueReport = 0, dataExportOffMenuDishes ;
 $(async function (){
    $(document).on("dp.change", "#calendar-day, #calendar-month, #calendar-year", function () {
        timeSellDetailRevenueReport = $(this).val();
    });
    if(!$('.select-branch').val()) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }
    $(document).on("change", "#select-time-report", async function () {
        let timeVal = $(this).val();
        switch (timeVal) {
            case "day":
                typeTimeSellDetailRevenueReport = 1;
                timeSellDetailRevenueReport = $('#calendar-day').val();
                fromDateDetailRevenueReport = '';
                toDateDetailRevenueReport = '';
                break;
            case "week":
                typeTimeSellDetailRevenueReport = 2;
                timeSellDetailRevenueReport = moment().format('WW/YYYY');
                fromDateDetailRevenueReport = '';
                toDateDetailRevenueReport = '';
                break;
            case "month":
                typeTimeSellDetailRevenueReport = 3;
                timeSellDetailRevenueReport = $('#calendar-month').val();
                fromDateDetailRevenueReport = '';
                toDateDetailRevenueReport = '';
                break;
            case "3month":
                typeTimeSellDetailRevenueReport = 4;
                timeSellDetailRevenueReport = moment().format('MM/YYYY');
                fromDateDetailRevenueReport = '';
                toDateDetailRevenueReport = '';
                break;
            case "year":
                typeTimeSellDetailRevenueReport = 5;
                timeSellDetailRevenueReport = $('#calendar-year').val();
                fromDateDetailRevenueReport = '';
                toDateDetailRevenueReport = '';
                break;
            case "3year":
                typeTimeSellDetailRevenueReport = 6;
                timeSellDetailRevenueReport = moment().format('YYYY');
                fromDateDetailRevenueReport = '';
                toDateDetailRevenueReport = '';
                break;
            case "13":
                fromDateDetailRevenueReport = '';
                toDateDetailRevenueReport = '';
                detectDateOptionTimeDetailRevenue(13);
                break;
            case "15":
                fromDateDetailRevenueReport = '';
                toDateDetailRevenueReport = '';
                detectDateOptionTimeDetailRevenue(15);
                break;
            case "16":
                fromDateDetailRevenueReport = '';
                toDateDetailRevenueReport = '';
                detectDateOptionTimeDetailRevenue(16);
                break;
            case "all_year":
                typeTimeSellDetailRevenueReport = 8;
                timeSellDetailRevenueReport = moment().format('YYYY');
                fromDateDetailRevenueReport = '';
                toDateDetailRevenueReport = '';
                break;
        }
        loadData();
     });
    $('#month .custom-button-search').on('click', function () {
        typeTimeSellDetailRevenueReport = 3;
        timeSellDetailRevenueReport = $('#calendar-month').val();
        fromDateDetailRevenueReport = '';
        toDateDetailRevenueReport = '';
        loadData();
    })
    $('#year .custom-button-search').on('click', function () {
        typeTimeSellOffMenuReport = 5;
        timeSellDetailRevenueReport = $('#calendar-year').val();
        fromDateDetailRevenueReport = '';
        toDateDetailRevenueReport = '';
        loadData();
    })
    $('#day .custom-button-search').on('click', function () {
        typeTimeSellOffMenuReport = 1;
        timeSellDetailRevenueReport = $('#calendar-day').val();
        fromDateDetailRevenueReport = '';
        toDateDetailRevenueReport = '';
        loadData();
     })
    $(".search-date-option-filter-time-bar").on("click", function () {
        detectDateOptionTimeDetailRevenue(Number($("#select-time-report").val()));
        loadData();
    });

})
async function loadData() {
    if (loadDataDetailRevenueReport === 1) return false;
    loadDataDetailRevenueReport = 1;
    let brand = $('.select-brand').val(),
        branch= $('.select-branch').val(),
        url = 'branch-dashboard.data-detail-revenue-sell-report',
        method = 'get',
        params = {
            brand: brand,
            branch: branch,
            type: typeTimeSellDetailRevenueReport,
            time: timeSellDetailRevenueReport ,
            from : fromDateDetailRevenueReport ,
            to : toDateDetailRevenueReport
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#rate-increase-detail-revenue-sell-report'), $('#rate-decrease-detail-revenue-sell-report')]);
    loadDataDetailRevenueReport = 0;
    if(res.data[3].status==200){
        $('#rate-increase-detail-revenue-sell-report').html(res.data[0])
        $('#rate-decrease-detail-revenue-sell-report').html(res.data[1])
        $('#total-revenue-sell').text(res.data[2])
    }
}

function detectDateOptionTimeDetailRevenue (type) {
    switch (type) {
        case 15:
            typeTimeSellDetailRevenueReport = 15;
            timeSellDetailRevenueReport = "";
            fromDateDetailRevenueReport = $(".from-month-filter-time-bar").val();
            toDateDetailRevenueReport = $(".to-month-filter-time-bar").val();
            break;
        case 16:
            typeTimeSellDetailRevenueReport = 16;
            timeSellDetailRevenueReport = "";
            fromDateDetailRevenueReport = $(".from-year-filter-time-bar").val();
            toDateDetailRevenueReport = $(".to-year-filter-time-bar").val();
            break;
        default:
            typeTimeSellDetailRevenueReport = 13;
            timeSellDetailRevenueReport = "";
            fromDateDetailRevenueReport = $(".from-date-filter-time-bar").val();
            toDateDetailRevenueReport = $(".to-date-filter-time-bar").val();
    }
}


