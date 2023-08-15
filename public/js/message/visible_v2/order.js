let currentPageOrderVisibleMessage = 1, limitOrderVisibleMessage = 6, checkLoadDataOrderVisibleMessage = 0;
$(function () {
    $('#show-order-message').on('click', function (e) {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            currentPageOrderVisibleMessage = 1;
            $('.filter-order-input-visible-message').val('');
            $('.order-input-visible-message').removeClass('d-none');
            loadDataOrderVisibleMessage();
            $(this).addClass('active');
        }
    });

    $(document).on('mouseup', function (e) {
        let container = $('.order-input-visible-message');
        if (!container.is(e.target) && container.has(e.target).length === 0 && !$('.order-input-visible-message').hasClass('d-none')) {
            $('.order-input-visible-message').addClass('d-none');
            $('#show-order-message').removeClass('active');
        }
    });

    $('.filter-order-input-visible-message').on('keyup paste', function () {
        currentPageOrderVisibleMessage = 1;
        loadDataOrderVisibleMessage();
    })
})

async function loadDataOrderVisibleMessage() {
    if(checkLoadDataOrderVisibleMessage === 1) return false;
    checkLoadDataOrderVisibleMessage = 1;
    let method = 'get',
        url = 'visible-message-supplier.data-order',
        params = {
            id: supplierCurrentConversation,
            branch: $('#change_branch').val(),
            limit: limitOrderVisibleMessage,
            page: currentPageOrderVisibleMessage,
            key: $('.filter-order-input-visible-message').val(),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    checkLoadDataOrderVisibleMessage = 0;
    await $('#data-order-visible-message').html(res.data[0]);
    setupPagination(res.data[1].data.total_record);
}

function setupPagination(length) {
    $('.simple-pagination').pagination({
        items: length,
        itemsOnPage: limitOrderVisibleMessage,
        currentPage: currentPageOrderVisibleMessage,
        prevText: "&laquo;",
        nextText: "&raquo;",
        hrefTextPrefix: "javascript:void(0)",
        onPageClick: function (pageNumber) {
            currentPageOrderVisibleMessage = pageNumber;
            loadDataOrderVisibleMessage();
        }
    });
}
