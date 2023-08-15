"use strict";
$(document).ready(function() {
    var chatbg = $(window).height()-57;
    $('.chat-bg').css('min-height', chatbg);
    var a = $(window).height() - 70;
    $(".user-box").slimScroll({
        height: a,
        allowPageScroll: false,
        color: '#000'
    });

    // search
    $(".search-text").on("keyup",async function() {
        // addLoading('chat-data-2', '#main-chat')
        // let g = $(this).val().toLowerCase();
        // let method = 'GET',
        //     url = 'chat-data-2',
        //     params = {
        //         keyword: g,
        //         page: paging_group,
        //         paging_personal: paging_personal,
        //         paging_supplier: paging_supplier
        //     },
        //     data = null;
        // let res = await axiosTemplate(method, url, params, data)
        // try {
        //     if (res.data[3].group > 0) {
        //         $('#message-not-seen-group-tms').removeClass('d-none');
        //         $('#message-not-seen-group-tms').html(res.data[3].group)
        //     } else {
        //         $('#message-not-seen-group-tms').addClass('d-none');
        //         $('#message-not-seen-group-tms').html(0)
        //     }
        //
        //     if (res.data[3].personal > 0) {
        //         $('#message-not-seen-personal-tms').removeClass('d-none')
        //         $('#message-not-seen-personal-tms').html(res.data[3].group)
        //     } else {
        //         $('#message-not-seen-personal-tms').addClass('d-none')
        //         $('#message-not-seen-personal-tms').html(0)
        //     }
        //
        //     if (res.data[3].supplier > 0) {
        //         $('#message-not-seen-supplier-tms').removeClass('d-none')
        //         $('#message-not-seen-supplier-tms').html(res.data[3].supplier)
        //     } else {
        //         $('#message-not-seen-supplier-tms').addClass('d-none')
        //         $('#message-not-seen-supplier-tms').html(0)
        //     }
        //
        //     if (paging_group > 1) {
        //         $('#list-group-chat-2').append(res.data[0]);
        //     } else {
        //         $('#list-group-chat-2').html(res.data[0]);
        //     }
        //     if (paging_personal > 1) {
        //         $('#list-personal-chat-2').append(res.data[1]);
        //     } else {
        //         $('#list-personal-chat-2').html(res.data[1]);
        //     }
        //     if (res.data[7] == true) {
        //         $('#group-support-2').html(res.data[2]);
        //         $('#list-supplier-chat-2').html(res.data[8])
        //     }
        //     if (res.data[3].all > 0) {
        //         $('#number-count-message-not-seen').removeClass('d-none')
        //         $('#number-count-message-not-seen').text(res.data[3].all);
        //     } else {
        //         $('#number-count-message-not-seen').text(0);
        //         $('#number-count-message-not-seen').addClass('d-none')
        //     }
        //
        // } catch (e) {
        //     console.log('====================================');
        //     console.log(e);
        //     console.log('====================================');
        // }
        let g = $(this).val().toLowerCase();
        $(".userlist-box .media-body .chat-header").each(function() {
            let s = $(this).text().toLowerCase();
            $(this).closest('.userlist-box')[removeVietnameseString(s).indexOf(removeVietnameseString(g)) !== -1 ? 'show' : 'hide']();
        });
    });
});
