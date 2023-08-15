// /**
//  * CART
//  * Đóng mở gọi danh sách các đơn hàng
//  */
// async function openModalListCartPopupMessage(){
//     $('.box-cart-restaurant-popup-message').removeClass('d-none');
//     $('.main-list-infor-detail-popup-message').addClass('d-none');
//     $('#get-member-list-popup-message').addClass('d-none');
//     $('#get-pinned-list-popup-message').addClass('d-none');
//     dataCartDetailAboutPopupMessage();
// }
//
// async function dataCartDetailAboutPopupMessage() {
//     let method = 'GET',
//         url = 'popup-message.data-order',
//         params = {
//             limit: limitOrderPopupMessage,
//             page: currentPageOrderPopupMessage,
//             key: currentNameConversationPopup,
//         },
//         data = null;
//     let res = await axiosTemplate(method, url, params, data);
//     $('.body-cart-restaurant-popup-message').html(res.data[0]);
// }


let currentPageOrderPopupMessage = 1, limitOrderPopupMessage = 6;
$(function () {
    $('.out-layout-chat-footer-option-cart').on('click', function (e) {
        currentPageOrderPopupMessage = 1;
        $('#chat-popup-layout #text-filter-cart-restaurant-popup-message').val('');
        $('#chat-popup-layout .box-cart-restaurant-popup-message').removeClass('d-none');
        loadDataOrderPopupMessage();
    });

    $(document).on('mouseup', function (e) {
        let container = $('.box-cart-restaurant-popup-message');
        if (!container.is(e.target) && container.has(e.target).length === 0 && !$('.box-cart-restaurant-popup-message').hasClass('d-none')) {
            $('.box-cart-restaurant-popup-message').addClass('d-none');
        }
    });

    $('#text-filter-cart-restaurant-popup-message').on('input paste', function () {
        currentPageOrderPopupMessage = 1;
        loadDataOrderPopupMessage();
    })
})

async function loadDataOrderPopupMessage() {
    let method = 'get',
        url = 'visible-message-supplier.data-order',
        params = {
            id: supplierCurrentConversationPopup,
            branch: $('#change_branch').val(),
            limit: limitOrderPopupMessage,
            page: currentPageOrderPopupMessage,
            key: $('#text-filter-cart-restaurant-popup-message').val(),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    await $('.body-cart-restaurant-popup-message').html(res.data[0]);
    setupPaginationPopup(res.data[1].data.total_record);
}

function setupPaginationPopup(length) {
    $('.simple-pagination').pagination({
        items: length,
        itemsOnPage: limitOrderPopupMessage,
        currentPage: currentPageOrderPopupMessage,
        prevText: "&laquo;",
        nextText: "&raquo;",
        hrefTextPrefix: "javascript:void(0)",
        onPageClick: function (pageNumber) {
            currentPageOrderPopupMessage = pageNumber;
            loadDataOrderPopupMessage();
        }
    });
}
