$(function () {
    addLoading('new-feed-facebook.feed.get-page-selected', '#data-feed');
    addLoading('new-feed-facebook.get-sender-page', '#data-feed');
    getFeedPage();
    getSenderFeedPage();
    getMediaNewFeedFacebook();

});

async function getFeedPage() {
    let method = 'get',
        url = 'new-feed-facebook.feed.get-page-selected',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('.img_cont img').attr('src', res.data[0].avatar);
    $('.name-avatar span').text(res.data[0].name);
    $('.name-avatar p').text(res.data[0].category);
    $('#list-new-feed').html(res.data[1]);
    $('.banner-image img').attr('src', res.data[0].cover);
    $('.box-list-comment').addClass('d-none');
}

async function getSenderFeedPage() {
    let method = 'get',
        url = 'new-feed-facebook.get-sender-page',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#data-sender-new-feed-page').html(res.data[0]);
}

function openChatPopupNewFeedFacebook(id, name, avatar) {
    if ($('#chat-box-new-feed-facebook .chat-single-box').hasClass('active') === true) {
        $('#chat-box-new-feed-facebook .name-sender-new-feed-facebook').text(name);
        $('#chat-box-new-feed-facebook .chat-single-box').attr('data-id', id);
    } else {
        $('#chat-box-new-feed-facebook .chat-single-box').addClass('active');
        $('#chat-box-new-feed-facebook .chat-single-box').removeClass('d-none');
        $('#chat-box-new-feed-facebook .name-sender-new-feed-facebook').text(name);
        $('#chat-box-new-feed-facebook .chat-single-box').attr('data-id', id);
    }
    loadDataMessengerSenderNewFeedFacebook(id, avatar);
}

async function loadDataMessengerSenderNewFeedFacebook(id, avatar) {
    $('#chat-box-new-feed-facebook .chat-body').html('');
    let method = 'get',
        url = 'new-feed-facebook.get-messenger-sender-page',
        params = {id: id, avatar: avatar},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    await $('#chat-box-new-feed-facebook .chat-body').html(res.data[0]);
    $('#chat-box-new-feed-facebook .chat-body').scrollTop(25000000000000000);
}

async function getMediaNewFeedFacebook() {
    let method = 'get',
        url = 'new-feed-facebook.get-media-page',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    await $('#profile-lightgallery').html(res.data[0]);
    // $('.filter-container').isotope({
    //     filter: '*',
    //     animationOptions: {
    //         duration: 750,
    //         easing: 'linear',
    //         queue: false
    //     }
    // });

    // $('.default-grid').isotope({
    //     itemSelector: '.default-grid-item',
    //     masonry: {}
    // });
}

function showComment(r){
    r.parent('.card').children('.box-list-comment').removeClass('d-none');
}
