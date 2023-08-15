let loadDataRevenueCostCashFlow = 0,
    loadDataProfitLossReport = 0,
    loadDataCostFreightReport = 0;

$(async function () {
    $.fn.isInViewport = function () {
        let elementTop = $(this).offset().top;
        let elementBottom = elementTop + $(this).outerHeight();
        let viewportTop = $('.seemt-main .page-wrapper').scrollTop();
        let viewportHalf = viewportTop + $('.seemt-main .page-wrapper').height();
        return elementBottom > 400 && elementTop < viewportHalf;
    };
    $('.seemt-main .page-wrapper').on('load resize scroll', function () {
        $('.card-inview-dashboard').each(function () {
            if ($(this).isInViewport()) {
                $('.bg-customer-default').removeClass('active');
                $('.' + $(this).data('key')).addClass('active');
                loadDataDashboardCompanyReport(parseInt($('.' + $(this).data('key')).data('position')));
                return false;
            }
        });
    });
    $(".bg-customer-default").on('click', async function () {
        $('#' + $(this).data('key'))[0].scrollIntoView()
        $('.bg-customer-default').removeClass('active');
        $('.' + $(this).data('key')).addClass('active');
    })
    // if(!$('.select-branch').val()) {
    //     await updateSessionBrandNew($('.select-brand'));
    //     return false;
    // }
    await loadDataDashboardCompanyReport(0);
})

function loadData() {
    loadDataRevenueCostCashFlow = 0;
    loadDataProfitLossReport = 0;
    loadDataCostFreightReport = 0;
    loadDataDashboardCompanyReport($('.bg-customer-default.active').data('position'));
}


function loadDataDashboardCompanyReport(position) {
    switch (position) {
        case 0:
            dataRevenueCostCashFlowReport();
            dataCostFreightReport();
            // dataProfitLossReport();
            break;
        case 1:
            dataProfitLossReport();
            break;
        case 2:
            dataCostFreightReport();
            break;
    }
}
