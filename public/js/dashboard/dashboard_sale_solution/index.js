let loadDataCurrentDayReport = 0,
    loadDataRevenueReport = 0,
    loadDataAreaReport = 0,
    loadDataEmployeeReport = 0,
    loadDataFoodDrinkReport = 0,
    loadDataDrinkReport = 0,
    loadDataCategoryReport = 0,
    loadDataGiftFoodReport = 0,
    loadDataDiscountReport = 0,
    loadDataSurchargeReport = 0;

$(function () {
    /**
     * Call Data
     */
    $.fn.isInViewport = function () {
        let elementTop = $(this).offset().top;
        let elementBottom = elementTop + $(this).outerHeight() / 2;
        let viewportTop = $('.seemt-main .page-wrapper').scrollTop();
        let viewportHalf = viewportTop + $('.seemt-main .page-wrapper').height() / 2;
        return elementBottom > 400 && elementTop < viewportHalf;
    };

    $(".select-option-filter-report").on("change", function () {
        switch (Number($(this).val())) {
            case 13:
                $(this).parents(".filter-dashboard-report").find(".custom-date").removeClass("d-none");
                $(this).parents(".filter-dashboard-report").find(".custom-month").addClass("d-none");
                $(this).parents(".filter-dashboard-report").find(".custom-year").addClass("d-none");
                break;
            case 15:
                $(this).parents(".filter-dashboard-report").find(".custom-date").addClass("d-none");
                $(this).parents(".filter-dashboard-report").find(".custom-month").removeClass("d-none");
                $(this).parents(".filter-dashboard-report").find(".custom-year").addClass("d-none");
                break;
            case 16:
                $(this).parents(".filter-dashboard-report").find(".custom-date").addClass("d-none");
                $(this).parents(".filter-dashboard-report").find(".custom-month").addClass("d-none");
                $(this).parents(".filter-dashboard-report").find(".custom-year").removeClass("d-none");
                break;
            default:
                $(this).parents(".filter-dashboard-report").find(".custom-date").addClass("d-none");
                $(this).parents(".filter-dashboard-report").find(".custom-month").addClass("d-none");
                $(this).parents(".filter-dashboard-report").find(".custom-year").addClass("d-none");
        }
    });

    $('.seemt-main .page-wrapper').on('load resize scroll', function () {
        $('.card-inview-dashboard').each(function () {
            if ($(this).isInViewport()) {
                $('.bg-customer-default').removeClass('active');
                $('.' + $(this).data('key')).addClass('active');
                loadDataReport(parseInt($('.' + $(this).data('key')).data('position')));
                return false;
            }
        });
        $('[data-toggle="tooltip"]').tooltip('hide');
    });
    $(".bg-customer-default").on('click', async function () {
        $('#' + $(this).data('key'))[0].scrollIntoView()
        $('.bg-customer-default').removeClass('active');
        $('.' + $(this).data('key')).addClass('active');
    })
    loadDataReport(0);
    dateTimePickerFromMaxToDate($(".from-date-filter-time-bar"),$(".to-date-filter-time-bar"));
    dateTimePickerFromToMonthTemplate($(".from-month-filter-time-bar"),$(".to-month-filter-time-bar"));
    dateTimePickerFromToYearTemplate($(".from-year-filter-time-bar"),$(".to-year-filter-time-bar"));
});

function loadData() {
        loadDataCurrentDayReport = 0;
        loadDataRevenueReport = 0;
        loadDataAreaReport = 0;
        loadDataEmployeeReport = 0;
        loadDataFoodDrinkReport = 0;
        loadDataDrinkReport = 0;
        loadDataCategoryReport = 0;
        loadDataGiftFoodReport = 0;
        loadDataOffMenuDishesReport = 0;
        loadDataFoodCancelReport = 0;
        loadDataTakeAwayReport = 0;
        loadDataVatFoodReport = 0;
        loadDataDiscountReport = 0;
        loadDataSurchargeReport = 0;
    loadDataReport($('.bg-customer-default.active').data('position'));
}

function loadDataReport(position) {
    switch (position) {
        case 0:
            dataCurrentDayReport();
            loadDataRevenueReportDashboard();
            dataAreaReport();
            break;
        case 1:
            loadDataRevenueReportDashboard();
            dataAreaReport();
            dataEmployeeReport();
            break;
        case 2:
            dataAreaReport();
            dataEmployeeReport();
            dataFoodDrinkReport();
            break;
        case 3:
            dataEmployeeReport();
            dataFoodDrinkReport();
            dataDrinkReport();
            break;
        case 4:
            dataFoodDrinkReport();
            dataDrinkReport();
            dataCategoryReport();
            break;
        case 5:
            dataDrinkReport();
            dataCategoryReport();
            dataGiftFoodReport();
            break;
        case 6:
            dataCategoryReport();
            dataGiftFoodReport();
            dataOffDishedMenuReport();
            break;
        case 7:
            dataGiftFoodReport();
            dataOffDishedMenuReport();
            dataFoodCancelReport();
            break;
        case 8:
            dataOffDishedMenuReport();
            dataFoodCancelReport();
            dataTakeAwayReport();
            break;
        case 9:
            dataFoodCancelReport();
            dataTakeAwayReport();
            dataVatFoodReport();
            break;
        case 10:
            dataTakeAwayReport();
            dataVatFoodReport();
            dataDiscountReport();
            break;
        case 11:
            dataVatFoodReport();
            dataDiscountReport();
            dataSurchargeReport();
            break;
        case 12:
            dataSurchargeReport();
            break;
    }
}
