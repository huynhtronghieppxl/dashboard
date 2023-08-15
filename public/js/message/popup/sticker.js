$(function () {
    /**
     * Thao tác nhấn mở và tắt nút xem sticker
     */
    $(document).on('click','#in-layout-input-sticker-icon-message-popup, #input-sticker-icon-message-popup', function (e){
        if( $(this).hasClass('active')){
            $(this).removeClass('active');
        } else {
            e.stopPropagation();
            $(".sticker-input-visible-message").removeClass('d-none');
            if ($('#data-category-sticker-popup-message').html() == '') dataCategoryStickerPopup();
            $(this).addClass('active');
        }
    })

    $(document).on('mouseup', function (e) {
        let container = $('.sticker-input-visible-message');
        if (!container.is(e.target) && container.has(e.target).length === 0 && !$('.sticker-input-visible-message').hasClass('d-none')) {
            $('.sticker-input-visible-message').addClass('d-none');
            $('#input-sticker-icon-message-popup').removeClass('active');
        }
    });


    $(document).on('click', '.item-category-sticker-visible-message', function () {
        dataStickerConversation($(this).data('id'));
        $('.item-category-sticker-visible-message').removeClass('active');
        $(this).addClass('active');
    });

});
//
/**
 * Lấy danh sách dữ liệu STICKER về
 */
async function dataCategoryStickerPopup() {
    axios({
        method: 'get',
        url: 'visible-message.data-category-sticker-conversation',
    }).then(function (res) {
        $('#data-category-sticker-popup-message').html(res.data[0]);
        $('#data-sticker-visible-message').html(res.data[1]);
    }).catch(function (e) {
        console.log(e)
    })
}

async function dataStickerConversation(id) {
    axios({
        method: 'get',
        url: 'visible-message.data-sticker-conversation',
        params: {id: id}
    }).then(function (res) {
        $('#data-sticker-visible-message').html(res.data[0]);
    }).catch(function (e) {
        console.log(e)
    })
}
