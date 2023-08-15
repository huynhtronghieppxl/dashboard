let loadDataCurrentDayReport = 0,
    loadDataBusinessGrowthReport = 0,
    loadDataRevenueCostProfitReport = 0,
    loadDataInventoryReport = 0,
    loadDataCustomerReport = 0,
    loadDataAnalysisCostReport = 0,
    loadDataRevenueReport = 0,
    // loadDataCostReport = 0,
    // loadDataProfitReport = 0,
    loadDataFoodDrinkReport = 0,
    loadDataDrinkReport = 0,
    loadDataAreaReport = 0,
    loadDataEmployeeReport = 0,
    loadDataGiftFoodReport = 0,
    loadDataDiscountReport = 0,
    loadDataSurchargeReport = 0,
    loadDataOrderReport = 0,
    loadDataCategoryReport = 0,
    loadDataPointReport = 0,
    loadDataProfitLossReport = 0,
    loadDataRechargePointCardReport = 0,
    loadDataCostFreightReport = 0,
    isScrollLeft = false,
    isScrollRight = false;

let container = $("#chart-data-card1");

$(async function () {
    /**
     * Call Data
     */
    $.fn.isInViewport = function () {
        let elementTop = $(this).offset().top;
        let elementBottom = elementTop + $(this).outerHeight() / 2;
        let viewportTop = $(".seemt-main .page-wrapper").scrollTop();
        let viewportHalf =
            viewportTop + $(".seemt-main .page-wrapper").height() / 2;
        return elementBottom > 400 && elementTop < viewportHalf;
    };
    $(".cd-timeline").scroll(function () {
        // Ví trí thanh cuộn
        let scrollPositionTop = $(".cd-timeline").scrollTop();
        // Chiều cao của toàn bộ trang
        let pageHeight = $(document).height();
        // Tính toán chiều cao của cửa sổ trình duyệt
        let windowHeight = $(window).height();
        // Tính toán khoảng cách từ vị trí cuộn đến bottom của trang
        let distanceToTop = pageHeight - (scrollPositionTop + windowHeight);

        if (distanceToTop == 0) {
            $(this).parent().find(".fi-rr-caret-up").addClass("d-none");
            $(this).find(".fi-rr-caret-down").removeClass("d-none");
        } else {
            $(this).parent().find(".fi-rr-caret-up").removeClass("d-none");
            $(this).find(".fi-rr-caret-down").addClass("d-none");
        }
    });
    $(".select-option-filter-report").on("change", function () {
        switch (Number($(this).val())) {
            case 13:
                $(this)
                    .parents(".filter-dashboard-report")
                    .find(".custom-date")
                    .removeClass("d-none");
                $(this)
                    .parents(".filter-dashboard-report")
                    .find(".custom-month")
                    .addClass("d-none");
                $(this)
                    .parents(".filter-dashboard-report")
                    .find(".custom-year")
                    .addClass("d-none");
                break;
            case 15:
                $(this)
                    .parents(".filter-dashboard-report")
                    .find(".custom-date")
                    .addClass("d-none");
                $(this)
                    .parents(".filter-dashboard-report")
                    .find(".custom-month")
                    .removeClass("d-none");
                $(this)
                    .parents(".filter-dashboard-report")
                    .find(".custom-year")
                    .addClass("d-none");
                break;
            case 16:
                $(this)
                    .parents(".filter-dashboard-report")
                    .find(".custom-date")
                    .addClass("d-none");
                $(this)
                    .parents(".filter-dashboard-report")
                    .find(".custom-month")
                    .addClass("d-none");
                $(this)
                    .parents(".filter-dashboard-report")
                    .find(".custom-year")
                    .removeClass("d-none");
                break;
            default:
                $(this)
                    .parents(".filter-dashboard-report")
                    .find(".custom-date")
                    .addClass("d-none");
                $(this)
                    .parents(".filter-dashboard-report")
                    .find(".custom-month")
                    .addClass("d-none");
                $(this)
                    .parents(".filter-dashboard-report")
                    .find(".custom-year")
                    .addClass("d-none");
        }
    });

    $(".seemt-main .page-wrapper").on("load resize scroll", function () {
        $(".card-inview-dashboard").each(function () {
            if ($(this).isInViewport()) {
                $(".bg-customer-default").removeClass("active");
                $("." + $(this).data("key")).addClass("active");
                loadDataReport(
                    parseInt($("." + $(this).data("key")).data("position"))
                );
                return false;
            }
        });
    });
    $(".bg-customer-default").on("click", async function () {
        $("#" + $(this).data("key"))[0].scrollIntoView();
        $(".bg-customer-default").removeClass("active");
        $("." + $(this).data("key")).addClass("active");
    });

    dateTimePickerFromMaxToDate(
        $(".from-date-filter-time-bar"),
        $(".to-date-filter-time-bar")
    );
    dateTimePickerFromToMonthTemplate(
        $(".from-month-filter-time-bar"),
        $(".to-month-filter-time-bar")
    );
    dateTimePickerFromToYearTemplate(
        $(".from-year-filter-time-bar"),
        $(".to-year-filter-time-bar")
    );
    if ($(".select-branch option").length === 1) {
        await updateSessionBrandNew($(".select-brand"), 1);
        return false;
    }
    await loadDataReport(0);
});

function sideScroll(element, direction, speed, distance, step) {
    let scrollAmount = 0;
    let slideTimer = setInterval(function () {
        if (direction == "left") {
            element.scrollLeft -= step;
        } else {
            element.scrollLeft += step;
        }
        scrollAmount += step;
        if (scrollAmount >= distance) {
            window.clearInterval(slideTimer);
        }
    }, speed);
}

function scrollLeftA() {
    if (isScrollLeft) return;
    isScrollLeft = true;
    let left = document.querySelector("#chart-data-card1");
    let widthElement = $("#chart-data-card1")
        .find(".revenue-content-sub:first")
        .outerWidth();
    left.scrollBy(widthElement * 2, 0);
    if (left.scrollLeft + widthElement * 2 === 0) {
        $("#scroll-to-left").removeClass("d-none");
        $("#scroll-to-right").addClass("d-none");
    }
    if (
        left.scrollLeft + widthElement * 2 ===
        left.scrollWidth - left.offsetWidth
    ) {
        $("#scroll-to-left").removeClass("d-none");
        $("#scroll-to-right").addClass("d-none");
    } else {
        $("#scroll-to-left").removeClass("d-none");
        $("#scroll-to-right").removeClass("d-none");
    }
    setTimeout(function () {
        isScrollLeft = false;
    }, 800);
}

function scrollRight() {
    if (isScrollRight) return;
    isScrollRight = true;
    let right = document.querySelector("#chart-data-card1");
    let widthElement = $("#chart-data-card1")
        .find(".revenue-content-sub:first")
        .outerWidth();
    right.scrollBy(-widthElement * 2, 0);
    if (right.scrollLeft - widthElement * 2 === 0) {
        $("#scroll-to-left").addClass("d-none");
        $("#scroll-to-right").removeClass("d-none");
    } else if (
        right.scrollLeft - widthElement * 2 ===
        right.scrollWidth - right.offsetWidth
    ) {
        $("#scroll-to-left").removeClass("d-none");
        $("#scroll-to-right").addClass("d-none");
    } else {
        $("#scroll-to-left").removeClass("d-none");
        $("#scroll-to-right").removeClass("d-none");
    }
    setTimeout(function () {
        isScrollRight = false;
    }, 800);
}

function loadData() {
    loadDataCurrentDayReport = 0;
    loadDataBusinessGrowthReport = 0;
    loadDataRevenueCostProfitReport = 0;
    loadDataInventoryReport = 0;
    loadDataCustomerReport = 0;
    loadDataAnalysisCostReport = 0;
    loadDataRevenueReport = 0;
    // loadDataCostReport = 0;
    // loadDataProfitReport = 0;
    loadDataFoodDrinkReport = 0;
    loadDataDrinkReport = 0;
    loadDataAreaReport = 0;
    loadDataEmployeeReport = 0;
    loadDataGiftFoodReport = 0;
    loadDataDiscountReport = 0;
    loadDataSurchargeReport = 0;
    loadDataOrderReport = 0;
    loadDataCategoryReport = 0;
    loadDataProfitLossReport = 0;
    // loadDataCostFreightReport = 0;
    loadDataRechargePointCardReport = 0;
    loadDataPointReport = 0;
    loadDataReport($(".bg-customer-default.active").data("position"));
}

function loadDataReport(position) {
    switch (position) {
        case 0:
            dataCurrentDayReport();
            dataRevenueCostProfitReport();
            dataBusinessGrowthReport();
            break;
        case 1:
            dataBusinessGrowthReport();
            dataRevenueCostProfitReport();
            dataInventoryReport();
            break;
        case 2:
            dataRevenueCostProfitReport();
            dataInventoryReport();
            dataCustomerReport();
            // dataAnalysisCostReport();
            break;
        case 3:
            dataInventoryReport();
            dataCustomerReport();
            // dataAnalysisCostReport();
            loadDataRevenueReportDashboard();
            break;
        case 4:
            // dataAnalysisCostReport();
            dataCustomerReport();
            loadDataRevenueReportDashboard();
            dataAreaReport();
            break;
        case 5:
            loadDataRevenueReportDashboard();
            dataAreaReport();
            dataEmployeeReport();
            break;
        case 6:
            dataAreaReport();
            dataEmployeeReport();
            dataFoodDrinkReport();
            break;
        case 7:
            dataEmployeeReport();
            dataFoodDrinkReport();
            dataDrinkReport();
            break;
        case 8:
            dataFoodDrinkReport();
            dataDrinkReport();
            dataCategoryReport();
            break;
        case 9:
            dataDrinkReport();
            dataCategoryReport();
            dataGiftFoodReport();
            break;
        case 10:
            dataCategoryReport();
            dataGiftFoodReport();
            dataOffDishedMenuReport();
            break;
        case 11:
            dataGiftFoodReport();
            dataOffDishedMenuReport();
            dataFoodCancelReport();
            break;
        case 12:
            dataOffDishedMenuReport();
            dataFoodCancelReport();
            dataTakeAwayReport();
            // dataDiscountReport();
            // dataSurchargeReport();
            // dataOrderReport();
            break;
        case 13:
            dataFoodCancelReport();
            dataTakeAwayReport();
            dataVatFoodReport();
            break;
        case 14:
            dataTakeAwayReport();
            dataVatFoodReport();
            dataDiscountReport();
            break;
        case 15:
            dataVatFoodReport();
            dataDiscountReport();
            dataProfitLossReport();
            break;
        case 16:
            dataDiscountReport();
            dataProfitLossReport();
            // dataCostFreightReport();
            // dataPointReport();
            break;
        case 17:
            dataSurchargeReport();
            dataProfitLossReport();
            if (parseInt($('#level-template').val()) > 6) {
                dataRechargePointCardReport();
            }
            break;
        case 18:
            dataProfitLossReport();
            if (parseInt($('#level-template').val()) > 6) {
                dataRechargePointCardReport();
            }
            if (parseInt($('#level-template').val()) > 2) {
                dataPointReport();
            }
            break;
        case 19:
            if (parseInt($('#level-template').val()) > 6) {
                dataRechargePointCardReport();
            }
            if (parseInt($('#level-template').val()) > 2) {
                dataPointReport();
            }
            break;
        case 20:
            if (parseInt($('#level-template').val()) > 2) {
                dataPointReport();
            }
            break;
    }
}
