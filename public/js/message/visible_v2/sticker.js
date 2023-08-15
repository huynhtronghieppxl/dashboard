$(function () {
    $('.icon-sticker-footer-visible-message').on('click', function (e) {
        if( $(this).hasClass('active')){
            $(this).removeClass('active');
        } else {
            e.stopPropagation();
            $(".sticker-input-visible-message").removeClass('d-none');
            if ($('#data-category-sticker-visible-message').html() === "") dataCategoryStickerConversation();
            $(this).addClass('active');
        }
    });

    $(document).on('click', '.item-category-sticker-visible-message', function () {
        dataStickerConversation($(this).data('id'));
        $('.item-category-sticker-visible-message').removeClass('active');
        $(this).addClass('active');
    });

    $(document).on('mouseup', function (e) {
        let container = $('.sticker-input-visible-message');
        if (!container.is(e.target) && container.has(e.target).length === 0 && !$('.sticker-input-visible-message').hasClass('d-none')) {
            $('.sticker-input-visible-message').addClass('d-none');
            $('.icon-sticker-footer-visible-message').removeClass('active');
        }

    });
});

async function dataCategoryStickerConversation() {
    let x1 = moment();
    axios({
        method: 'get',
        url: 'visible-message.data-category-sticker-conversation',
    }).then(function (res) {
        console.log(res);
        console.log('Thời gian Axios: ' + (moment() - x1) / 1000 + 's');
        $('#data-category-sticker-visible-message').html(res.data[0]);
        $('#data-sticker-visible-message').html(res.data[1]);
        $('.item-category-sticker-visible-message:eq(0)').addClass('active');
    }).catch(function (e) {
        console.log(e)
    })
}

async function dataStickerConversation(id) {
    let x1 = moment();
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
