$(function () {
    $('.marker-filter').width($('.active-mess').outerWidth())
    /**
     * text emoji
     */
    $(document).on('click', '.item-invite', function () {
        if ($('.show-notification-input-visible-message').hasClass('d-none')) {
            $('.show-notification-input-visible-message').removeClass('d-none');
        } else {
            $('.show-notification-input-visible-message').addClass('d-none');
        }
    })
    /**
     *tìm kiếm theo tên , theo bộ phận
     */
    $(".search-text-filter-header").on("keyup", function () {
        $('#data-conversation-visible-message-restaurant').html('');
        if ((parseInt($('.filter-left.active-mess').data('id')) === 0)) {
            pageConversation = 1;
            dataConversationTMS = "";
            dataConversation();
        } else {
            pageConversationSupplier = 1;
            dataConversationSupplier = "";
            dataConversationOfSupplier();
        }
    });
    /**
     * Phân loại
     */
    $(document).on("click",".dropdown-category-filter-custom", function() {
       $(this).find('.dropdown-list-filter-message-custom').toggleClass('d-none');
       $(this).find('#type-filter-conversation').toggleClass('active');
    });


    /**
     * Nút tắt phân loại
     */
    $(document).on("click",".module-reset-filter-classify", function() {
        $(this).find('.dropdown-list-filter-message-custom').addClass('d-none');
        $(".category-filter").html("Phân Loại");
        $(".module-reset-filter-classify").addClass("d-none");
        $("i.type-message-icon").removeClass("d-none");
        $(".btn-classify").removeClass("active-change-color-background");
        $(".btn-classify span").removeClass("active-mess");
        $("#type-filter-conversation").data("id", '-1');
        $('#data-conversation-visible-message-restaurant').html('');
        pageConversation = 1;
        dataConversationTMS = "";
        dataConversation();
    });
    $(document).on('mouseup', function (e) {
        let container = $('.dropdown-list-filter-message-custom');
        if (!container.is(e.target) && container.has(e.target).length === 0 && !$('.dropdown-list-filter-message-custom').hasClass('d-none')) {
            $('.dropdown-list-filter-message-custom').addClass('d-none');
            $('.icon-sticker-footer-visible-message').removeClass('active');
            $(this).find('#type-filter-conversation').removeClass('active');
        }
    });

    $('.dropdown-item-filter-message-custom').on("click", function () {
        if(checkLoadDataConversation === 1) {
            return false;
        }
        else {
            $(".module-reset-filter-classify").removeClass("d-none");
            $(".btn-classify span").addClass("active-mess");
            $("i.type-message-icon").addClass("d-none");
            $(".btn-classify").addClass("active-change-color-background");
            if ($(this).data("id") === $("#type-filter-conversation").data("id")) {
                $("#type-filter-conversation").data("id", -1);
                $(".btn-classify").removeClass("active-change-color-background");
                $(".btn-classify span").removeClass("active-mess");
                $(".module-reset-filter-classify").addClass("d-none");
                $("i.type-message-icon").removeClass("d-none");
            } else {
                $("#type-filter-conversation").data('id', $(this).data("id"));
                switch ($(this).data("id")) {
                    case 0:
                        $(".category-filter").html("Nhóm");
                        break;
                    case 1:
                        $(".category-filter").html("Công Việc");
                        break;
                    case 2:
                        $(".category-filter").html("Cá nhân");
                        break;
                }
            }
            $('#data-conversation-visible-message-restaurant').html('');
            pageConversation = 1;
            dataConversationTMS = "";
            dataConversation();
        }
    });

    /**
     *  nếu bấm lọc , data-id = 0 thì Công ty/Nhà hàng active, data-id = 1 active nhà cung cấp
     */
    $(".filter-left").on("click", function () {
        $('.filter-left').removeClass('active-mess');
        $(this).addClass("active-mess");
        $(".search-text-filter-header").val("");
        $('#data-conversation-visible-message-restaurant').html('');
        $(".ion-close-circled-header-filter").css({
            opacity: "0",
            transition: "all 0.01s ease-in-out"
        });
        $(".search-text-filter-header").removeClass("show-search-text-full-layout");
        $(".module-create .dropdown-module-overide").remove();
        $(".module-open-popup-create-group-and-list-user-visible-message").addClass("animate-translate-after-three-module-header-filter");
        $(".module-open-popup-create-group-and-list-user-visible-message").removeClass("animate-translate-three-module-header-filter");
        $(".dropdown-module-overide").css({
            opacity: "0",
            transition: "all 0.1s ease-in-out"
        });
        $(".ion-close-circled-header-filter").css({
            opacity: "0",
            transition: "all 0.01s ease-in-out"
        });
        // $(".category-filter").html("Phân Loại");
        // $(".module-reset-filter-classify").addClass("d-none");
        // $("i.type-message-icon").removeClass("d-none");
        // $(".btn-classify").removeClass("active-change-color-background");
        $(".btn-classify span").removeClass("active-mess");
        $(".btn-classify").attr('data-id', '-1');
        if ($(this).data("id") === 0) {
            $(".right-tool").css("opacity", "1");
            $('#data-conversation-visible-message-restaurant').html(dataConversationTMS);
            if (dataConversationTMS.length === 0) {
                pageConversation = 1;
                dataConversation();
            }
        } else {
            $(".right-tool").css("opacity", "0");
            $('#data-conversation-visible-message-supplier').html(dataConversationSupplier);
            if (dataConversationSupplier.length === 0) {
                pageConversationSupplier = 1;
                dataConversationOfSupplier();
            }
        }
    });

    // $(".search-header-filter").on("input paste", function (e) {
    //     if ($(".search-text-filter-header").val() === "") {
    //         $('.title-filter-not-read').removeClass('d-none') && $(".right-tool").removeClass('d-none') && $('.title-filter-all').removeClass('d-none') && $('.right-tool').css('opacity', '1') && $('.title-filter-all').css('opacity', '1') && $('.marker-filter').removeClass('width-maker')
    //         $(".search-text-filter-header").removeClass("show-search-text-full-layout");
    //         $(".module-open-popup-create-group-and-list-user-visible-message .dropdown-module-overide").remove();
    //         $(".module-open-popup-create-group-and-list-user-visible-message").addClass("animate-translate-after-three-module-header-filter");
    //         $(".module-open-popup-create-group-and-list-user-visible-message").removeClass("animate-translate-three-module-header-filter");
    //         $(".dropdown-module-overide").css({
    //             opacity: "0",
    //             transition: "all 0.1s ease-in-out"
    //         });
    //         $(".ion-close-circled-header-filter").css({
    //             opacity: "0",
    //             transition: "all 0.01s ease-in-out"
    //         });
    //     } else if (e.keyCode !== 38 && e.keyCode !== 40) {
    //         $(".search-text-filter-header").show();
    //         $(".search-text-filter-header").addClass("show-search-text-full-layout");
    //         $(".module-open-popup-create-group-and-list-user-visible-message").addClass("animate-translate-three-module-header-filter");
    //         $(".module-open-popup-create-group-and-list-user-visible-message").removeClass("animate-translate-after-three-module-header-filter");
    //         $(".module-open-popup-create-group-and-list-user-visible-message").prepend(``);
    //         $(".dropdown-module-overide").css({
    //             opacity: "1",
    //             transition: "all 2s ease-in-out"
    //         });
    //         $(".ion-close-circled-header-filter").css({
    //             opacity: "1",
    //             transition: "all 2s ease-in-out"
    //         });
    //     }
    // });

    $(document).on('click', '.ion-close-circled-header-filter', function () {
        $(".search-text-filter-header").val("");
        $('.data-conversation-visible-message').html('');
        $(this).css({
            opacity: "0",
            transition: "all 0.01s ease-in-out"
        });
        $(".search-text-filter-header").removeClass("show-search-text-full-layout");
        $(".module-create .dropdown-module-overide").remove();
        $(".module-open-popup-create-group-and-list-user-visible-message").addClass("animate-translate-after-three-module-header-filter");
        $(".module-open-popup-create-group-and-list-user-visible-message").removeClass("animate-translate-three-module-header-filter");
        $(".dropdown-module-overide").css({
            opacity: "0",
            transition: "all 0.1s ease-in-out"
        });
        $(".ion-close-circled-header-filter").css({
            opacity: "0",
            transition: "all 0.01s ease-in-out"
        });
        if ((parseInt($('.filter-left.active-mess').data('id')) === 0)) {
            pageConversation = 1;
            dataConversationTMS = "";
            dataConversation();
        } else {
            pageConversationSupplier = 1;
            dataConversationSupplier = "";
            dataConversationOfSupplier();
        }
    })
    $('.search-text-filter-header').on('focus',function (){
        $('.search-header-filter').css('border','1px solid #0068ff');
    })
    $('.search-text-filter-header').on('focusout',function (){
        $('.search-header-filter').css('border','');
    })
});

let marker = document.querySelector(".marker-filter");
let item = document.querySelectorAll("nav .filter-left");

function indicator(e) {
    marker.style.left = e.offsetLeft + "px";
    marker.style.width = e.offsetWidth + "px";
}

item.forEach((link) => {
    link.addEventListener("click", (e) => {
        indicator(e.target);
    });
});
