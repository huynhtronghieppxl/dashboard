let load_data1 = 0, load_data2 = 0;

$(function () {
    $('#change-restaurant-branch-id li').on('click', async function () {
        load_data1 = 0;
        load_data2 = 0;
        loadData($('.bg-customer-default.active').data('position'));
    });
    /**
     * Call Data
     */
    $.fn.isInViewport = function () {
        console.log(2);
        let elementTop = $(this).offset().top;
        let elementBottom = elementTop + $(this).outerHeight() / 2;
        let viewportTop = $(window).scrollTop();
        let viewportHalf = viewportTop + $(window).height() / 2;
        return elementBottom > viewportTop && elementTop < viewportHalf;
    };

    $(window).on('load resize scroll', function () {
        $('.card-inview-dashboard').each(function () {
            if ($(this).isInViewport()) {
                $('.bg-customer-default').removeClass('active');
                $('.' + $(this).data('key')).addClass('active');
                loadData(parseInt($('.' + $(this).data('key')).data('position')));
                return false;
            }
        });
    });

    $(".bg-customer-default").click(async function () {
        $('html,body').animate({
            scrollTop: $('.' + $(this).data('key')).offset().top
        }, 0);
        $('.bg-customer-default').removeClass('active');
        $('.' + $(this).data('key')).addClass('active');
    })
});


function loadData(position) {
    switch (position) {
        case 1:
            // dataRealProfitReport();//1
            // dataSupplierReport();//1
            break;
    }
}
