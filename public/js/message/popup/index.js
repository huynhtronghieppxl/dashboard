let checkNumberFormPopupSidebar;
let checkNumberFormPopup;
let pageConversationPopup = 1, pageConversationSupplierPopup = 1, currentLengthConversationPopup = 20, pageMessageConversationPopup = 1,
    currentLengthMessageConversationPopup = 20, currentLengthConversationSupplierPopup = 20;
let checkLoadDataConversationPopup = 0, checkLoadDataConversationSupplierPopup = 0, checkLoadDataMessageConversationPopup = 0;
let typeCurrentConversationPopup, idMemberMessagePopup, dataConversationPopupRestaurant = '', dataConversationPopupSupplier = '';
let limitPopup = 20, currentPagePopup = 1, currentMesLengthPopup = 20;
$(function () {
    $(".filter-left-popup").on("click", function (e) {
        $('.filter-left-popup').removeClass('active-mess-popup');
        $(this).addClass('active-mess-popup');
        if ($(this).data("id") === 0) {
            pageConversationPopup = 1;
            $('#message-header-list-body-restaurant').html(dataConversationPopupRestaurant);
            if (dataConversationPopupRestaurant.length === 0) {
                dataConversationPopup();
            }
        } else {
            pageConversationSupplierPopup = 1;
            $('#message-header-list-body-supplier').html(dataConversationPopupSupplier);
            if (dataConversationPopupSupplier.length === 0) {
                dataConversationOfSupplierPopup();
            }
        }
    });

    $('#chat-body-message-popup').on('scroll', async function () {
        if(Math.abs(($('#chat-body-message-popup')[0].scrollHeight - $('#chat-body-message-popup')[0].clientHeight + $('#chat-body-message-popup')[0].scrollTop)) <= 1 ){
            if (currentMesLengthPopup === limitPopup){
                currentPagePopup = currentPagePopup + 1;
                await dataMessageOfConversationPopup(idCurrentConversation);
                $('#loading-data-message-visible-message').remove();
            }
        }
    });
});

async function dataMessageOfConversationPopup(id) {
    $('#data-message-visible-message').prepend(`<div class="preloader3 loader-block" id="loading-data-message-visible-message">
                                            <div class="circ1"></div>
                                            <div class="circ2"></div>
                                            <div class="circ3"></div>
                                            <div class="circ4"></div>
                                        </div>`);
    axios({
        method: 'get',
        url: 'popup-message.message-conversation',
        params: {
            id: id,
            limit : limitPopup,
            page: currentPagePopup,
            type: typeCurrentConversationPopup
        }
    }).then(function (res) {
        $('#chat-body-message-popup').append(res.data[0]);
        currentMesLengthPopup = res.data[1].data['list'].length;
        $('#loading-data-message-visible-message').remove();
    }).catch(function (e) {
        console.log(e)
    })
}

/**
 * Function lấy danh sách cuộc trò chuyện Công ty/Nhà hàng
 */
async function dataConversationPopup() {
    if (checkLoadDataConversationPopup === 1) return false;
    checkLoadDataConversationPopup = 1;
    $('#loading-data-message-visible-message').remove();
    let html = `<div class="preloader3 loader-block" id="loading-data-message-visible-message">
                    <div class="circ1"></div>
                    <div class="circ2"></div>
                    <div class="circ3"></div>
                    <div class="circ4"></div>
                </div>`;
    $('#message-header-list-body-restaurant').html(html);
    let x1 = moment();
    axios({
        method: 'get',
        url: 'popup-message.data-conversation',
        params: {
            is_supplier: $('.filter-left.active-mess').data('id'),
            type: -1,
            keyword: '',
            page: pageConversationPopup,
        },
    }).then(function (res) {
        $('#loading-data-message-visible-message').remove();
        pageConversationPopup++;
        currentLengthMessageConversationPopup = res.data[1].data.total_record;
        $('#message-header-list-body-restaurant').html(res.data[0]);
        dataConversationPopupRestaurant += res.data[0]
        $('#data-conversation-right-popup-visible-message').html(res.data[2]);
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover'
        });
    }).catch(function (e) {
        console.log(e)
    })
}

/**
 * Function lấy danh sách cuộc trò chuyện nhà cung cấp
 */
async function dataConversationOfSupplierPopup() {
    if (checkLoadDataConversationSupplierPopup === 1) return false;
    checkLoadDataConversationSupplierPopup = 1;
    $('#loading-data-message-visible-message').remove();
    let html = `<div class="preloader3 loader-block" id="loading-data-message-visible-message">
                    <div class="circ1"></div>
                    <div class="circ2"></div>
                    <div class="circ3"></div>
                    <div class="circ4"></div>
                </div>`;
    $('#message-header-list-body-supplier').html(html);
    axios({
        method: 'get',
        url: 'popup-message-supplier.data-conversation',
        params: {
            keyword: $('.search-text-filter-header').val(),
            page: pageConversationSupplierPopup
        },
    }).then(function (res) {
        $('#div-empty-conversation').remove();
        pageConversationSupplierPopup++;
        currentLengthConversationSupplierPopup = res.data[1].data.total_record;
        dataConversationPopupSupplier += res.data[0];
        $('#message-header-list-body-supplier').html(res.data[0]);
    }).catch(function (e) {
        console.log(e)
    })
}

/**
 * Lấy nội dung chi tiết cuộc trò chuyện popup
 */
async function dataMessageConversationPopup() {
    if (checkLoadDataMessageConversationPopup === 1) return false;
    checkLoadDataMessageConversationPopup = 1;
    $('#loading-data-message-visible-message').remove();
    $('#chat-body-message-popup').append(`<div class="preloader3 loader-block" id="loading-data-message-visible-message">
    <div class="circ1"></div>
    <div class="circ2"></div>
    <div class="circ3"></div>
    <div class="circ4"></div>
    </div>`);
    let x1 = moment();
    axios({
        method: 'get',
        url: 'popup-message.message-conversation',
        params: {
            id: idCurrentConversation,
            page: pageMessageConversationPopup,
            type: typeCurrentConversationPopup,
            limit: limitPopup
        },
        data: null,
    }).then(function (res) {
        $(".chat-form[data-id='6285b5e5159f42002b9db2d3']").css('background-color', 'red')
        $('#loading-data-message-visible-message').remove();
        checkLoadDataMessageConversationPopup = 0;
        $('.chat-form:first #chat-body-message-popup').append(res.data[0]);
        // $('#chat-body-message-popup').unbind('scroll').on('scroll', function (){
        //     getScrollBodyPopup($(this));
        // })
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover'
        });
    }).catch(function (e) {
        console.log(e)
    })
}


/**
 * Thực hiện cộng và hiển thị tổng số tin nhắn mới nhân được của web
 */
async function eventSumTwoCountMessagerUnreadSupplierTMS(){
    let totalnumberMessageUnread = numberMessageUnreadSupplier + numberMessageUnreadRestaurant;
    if(totalnumberMessageUnread >= 99) totalnumberMessageUnread = '99+';
    $('.link-input-show-box-list-coversation-message .new-notify-unread-message').text(totalnumberMessageUnread);
    $('.link-input-show-box-list-coversation-message .new-notify-unread-message').removeClass('d-none');
}
