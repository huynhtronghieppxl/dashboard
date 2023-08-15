let pagePinDetailAboutPopupMessage = 1;
let checkLoadingPinnedPopup = 1;
let currentNameConversationPopup = '';
let limitPinDetailAboutPopupMessage = 10;
let numberMessageUnreadRestaurant = 0, numberMessageUnreadSupplier = 0;
let supplierCurrentConversationPopup;
let pageVoteDetailAboutPopupMessage = 1,
    limitVoteDetailAboutPopupMessage = 10,
    checkLoadVoteDetailAboutPopupMessage = 0,
    currentLimitVoteDetailAboutPopupMessage = 10;
$(function(){
    /** Hiển thị popup khi bấm vào danh sách cuộc trò chuyện **/
    $(document).on("click", ".message-header-item", function () {
        resetPopupMessage();
        checkNumberFormPopup = false;
        let id = $(this).data('id');
        let nameGroup = $(this).find(".message-header-item-name").find('span').text();
        let imgGroup = $(this).find('.message-header-item-img').find('img').attr('src');
        $('.chat-header-avatar .chat-avatar-image').attr('src', imgGroup);
        $('.header-chat-display-name b').text(nameGroup);
        $('.chat-form').attr('data-id', id);
        $('#chat-popup-layout .chat-form').removeClass('d-none');
        $('.message-header-list').removeClass('active');
        $('.link-input-show-box-list-coversation-message').removeClass('active');
        idCurrentConversation = $(this).data("id");
        typeCurrentConversationPopup = $(this).data("type");
        supplierCurrentConversationPopup = $(this).data('supplier');
        leaveRoomGroupPersonal();
        joinRoomGroupPersonal();
        dataDetailConversationPopup();
        dataMessageConversationPopup();
        eventInputTypePopupMessage()
        dataPinDetailAboutPopupMessage();
        $('.chat-footer-message-input').focus();
        $(this).find('.message-header-item-name').find('.bg-c-pink').text(0);
        $(this).find('.message-header-item-name').find('.bg-c-pink').addClass('d-none');
        /** Ràng buộc ẩn hiện action setting giữa cuộc trò chuyện nhà cung cấp và nhà hàng **/
        if(typeCurrentConversationPopup === 3) {
            $('#icon-shopping-cart-popup-message').removeClass('d-none');
            $('.out-layout-chat-footer-option-cart').css('display','block');
            $('#chat-popup-layout .chat-footer-message').css('margin-left', '144px');
        }
        else {
            $('#icon-shopping-cart-popup-message').addClass('d-none');
            $('.out-layout-chat-footer-option-cart').css('display','none');
            $('#chat-popup-layout .chat-footer-message').css('margin-left', '115px');
        }
    });
    /** Đóng chat popup **/
    $(document).on("click", ".chat-box-tools-link.icon-font-size.close-popup", function () {
        $(this).parents(".chat-form").addClass("d-none");
        $('.chat-form:last-child').find('.chat-footer-message-input').focus();
        leaveRoomGroupPersonal();
        resetPopupMessage();
    });
    /** Gọi hàm tính toán độ dài input - body, các trường hợp khi nhâp tin nhắn **/
    $(document).on('input', '#chat-popup-layout .chat-footer-message-input', function () {
        eventInputTypePopupMessage()
    });
    /** Kiểm tra sự kiện nhấn ẩn hiện danh sách thông tin chi tiết popup **/
    $(document).on('click', '#chat-popup-layout .chat-header-info', function (){
        $('.list-infor-action-setting-popup-message').toggleClass('d-none');
    });
    $(document).on('mouseup', function (e) {
        let container = $('#chat-popup-layout .list-infor-action-setting-popup-message');
        if (!container.is(e.target) && container.has(e.target).length === 0 && !$('#chat-popup-layout .list-infor-action-setting-popup-message').hasClass('d-none')) {
            $('#chat-popup-layout .list-infor-action-setting-popup-message').addClass('d-none');
            backViewDefaultSettingPopupMessage();
        }
    });
    /** Bắt sự kiện bỏ active dấu cộng sổ thêm thao tác popup message hover (dấu cộng) **/
    $(document).on('mouseup', function (e) {
        let container = $('#chat-popup-layout .list-option-footer-popup');
        if (!container.is(e.target) && container.has(e.target).length === 0 && !$('#chat-popup-layout .list-option-footer-popup').hasClass('d-none')) {
            $('#chat-popup-layout .list-option-footer-popup').addClass('d-none');
        }
    });
    /** Bắt sự kiện kiểm tra trạng thái hiển thị cho nút xem thêm các thao tác chức năng popup message hover (dấu cộng) **/
    $(document).on('click', '#chat-popup-layout .chat-footer-other-action .icofont-plus-circle', function () {
        $('#chat-popup-layout .list-option-footer-popup').toggleClass('d-none');
        if($('#chat-popup-layout .chat-footer-message-input').text() == ''){
            $(".list-option-footer-popup li:eq(5)").removeClass("d-none");
            $(".list-option-footer-popup li:eq(4)").addClass("d-none");
            $(".list-option-footer-popup li:eq(3)").addClass("d-none");
            $(".list-option-footer-popup li:eq(2)").addClass("d-none");
            $(".list-option-footer-popup li:eq(1)").removeClass("d-none");
            $(".list-option-footer-popup li:eq(0)").removeClass("d-none");
        }
        else {
            $(".list-option-footer-popup li").removeClass("d-none");
        }
    });
    /** Xóa thành viên khỏi cuộc trò chuyện **/
    $(document).on('click', '#chat-popup-layout .remove-member', function (){
        removeUserGroupPopupMessage($(this));
    });
    /** Xóa thành viên khỏi cuộc trò chuyện **/
    $(document).on('click', '#chat-popup-layout .promote-member', function (){
        addPermisionGroupPopupMessage($(this));
    });
    /** Giải tán cuộc trò chuyện popup **/
    $(document).on('click', '#chat-popup-layout .remove-group-chat', function (){
        removeGroupPopupMessage($(this));
    });
    /** Sự kiện focus vào input **/
    $(document).on('focus', '.chat-footer-message-input', function (){
        $('#chat-popup-layout').addClass('focus-input');
        joinRoomForConnection();
    });
    $(document).on('focusout', '.chat-footer-message-input', function (){
        $('#chat-popup-layout').removeClass('focus-input');
        leaveRoomForConnection();
    });
    $(document).on('click', '.chat-form', function (){
        $('.chat-footer-message-input').focus();
        $('#chat-popup-layout').addClass('focus-input');
    });
    /** Mở danh sách vote **/
    $(document).on('click', '#member-message-setting-popup', function (){
        dataVoteDetailAboutVisibleMessage();
    });
});

/**
 * Hàm tính toán độ dài input - body, các trường hợp khi nhâp tin nhắn
 */
async function eventInputTypePopupMessage(){
    let heightInputPopup = $('#chat-popup-layout .chat-footer-popup').outerHeight(true),
        heightHeaderPopup = $('#chat-popup-layout .chat-header').outerHeight(true),
        heightPopup = $('#chat-popup-layout .chat-form').outerHeight(true),
        heightPreview = ($('.layout-preview-input-popup-message').hasClass('d-none')) ? 0 : $('.layout-preview-input-popup-message').outerHeight(),
        heightReply = ($('.layout-reply-input-popup-message').hasClass('d-none')) ? 0 : $('.layout-reply-input-popup-message').outerHeight();
    /**
     * Kiểm tra độ cao body popup dãn nở theo các điều kiện có tồn tại thanh ghim
     */
    $('#chat-popup-layout .chat-body').css('padding-top','0px');
    let heightBodyPopup = heightPopup - heightHeaderPopup - heightInputPopup - heightPreview - heightReply;
    $('#chat-popup-layout .chat-body').height(heightBodyPopup);
    /**
     * Kiểm tra các trường hợp ẩn hiện icon và nút send - like, thay đổi icon action danh sách chức năng (dấu cộng) - giỏ hàng
     */
    if($('#chat-popup-layout .chat-footer-message-input').text() == ''){
        $('#chat-popup-layout .chat-footer-message').css('transition', 'all 0.2s linear 0s');
        if(typeCurrentConversationPopup === 3) {
            $('#chat-popup-layout .chat-footer-message').css('margin-left', '144px');
        }
        else {
            $('#chat-popup-layout .chat-footer-message').css('margin-left', '115px');
        }
        $('#chat-popup-layout #chat-footer-send').addClass('d-none');
        $('#chat-popup-layout #chat-footer-like').removeClass('d-none');
    }
    else {
        $('#chat-popup-layout .chat-footer-message').css('transition', 'all 0.2s linear 0s');
        $('#chat-popup-layout .chat-footer-message').css('margin-left', '53px');
        $('#chat-popup-layout #chat-footer-send').removeClass('d-none');
        $('#chat-popup-layout #chat-footer-like').addClass('d-none');
    }
}

/**
 * Trả về giao diện setting thông tin các tính năng của popup
 */
async function backViewDefaultSettingPopupMessage(){
    $('.main-list-infor-detail-popup-message').removeClass('d-none');
    $('#get-member-list-popup-message').addClass('d-none');
    $('#get-pinned-list-popup-message').addClass('d-none');
}


/**
 * PINNED
 * Sự kiện hiển thị popup danh sách các tin nhắn đã được ghim
 */
async function openModalListPinnedPopupMessage(){
    dataPinDetailAboutPopupMessage();
    $('.list-infor-action-setting-popup-message').removeClass('d-none');
    $('#get-pinned-list-popup-message').removeClass('d-none');
    $('.main-list-infor-detail-popup-message').addClass('d-none');
    $('#get-member-list-popup-message').addClass('d-none');
}

/**
 * Sử dụng sự kiện chọn mở chi tiết tin nhắn ghim
 */
async function dataPinDetailAboutPopupMessage() {
    let method = 'get',
        url = 'visible-message.detail-pinned-conversation',
        params = {
            id: idCurrentConversation,
            page: pagePinDetailAboutPopupMessage,
            limit: limitPinDetailAboutPopupMessage,
            type: typeCurrentConversationPopup,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#div-empty-pinned').remove();
    $('#get-pinned-list-popup-message').html(res.data[0]);
}

/**
 * Chi tiết của một cuộc trò chuyện (member)
 */
async function dataDetailConversationPopup() {
    let x1 = moment();
    axios({
        method: 'get',
        url: 'visible-message.detail-conversation',
        params: {
            id: idCurrentConversation,
            type: typeCurrentConversationPopup,
        },
        data: null,
    }).then(function (res) {
        /**
         * Thành viên
         */
        $('#chat-popup-layout .number-person-about').text(res.data[0]['data'].number_employee);
        $('#chat-popup-layout #data-all-member-visible-message').html(res.data[1]);
    }).catch(function (e) {
        let dataTagName = [];
        renderDataTagVisibleMessage(dataTagName);
    })
}

/**
 * Xóa thành viên khỏi nhóm chat
 */
function removeUserGroupPopupMessage (r) {
    let title = 'Xóa thành viên này khỏi nhóm',
        content = '',
        icon = 'warning';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            axios({
                method: 'post',
                url: 'visible-message.remove-user-group',
                data: {
                    id_group: r.parents('.row-member').data('group-id'),
                    member_id: r.parents('.row-member').data('member-id'),
                }
            }).then(function (res) {
                console.log(res);
            })
        }
    })
}

/**
 * Bổ nhiệm phó nhóm cuộc trò chuyện
 */
function addPermisionGroupPopupMessage(r) {
    let title = 'Thêm thành viên này làm phó nhóm',
        content = '',
        icon = 'warning';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            axios({
                method: 'post',
                url: 'visible-message.authorized',
                data: {
                    id: r.parents('.row-member').data('group-id'),
                    member_id: r.parents('.row-member').data('member-id')
                }
            }).then(function (res) {
                r.remove();
            })
            r.parents('.row-member').find('.img-members-about').append('<i class="fa fa-key key-member-detail-visible-message"></i>');
        }
    })
}

/**
 * Giải tán cuộc trò chuyện popup
 */
function removeGroupPopupMessage() {
    let title = 'Giản tán nhóm sẽ đồng thời xóa toàn bộ tin nhắn của nhóm đó. Bạn có muốn tiếp tục',
        content = '',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            axios({
                method: 'post',
                url: 'visible-message.disband-group',
                data: {
                    id: idCurrentConversation,
                }
            }).then(function (res) {
                $('.message-header-list-body').find('.item-conversation-visible-message[data-id="' + idCurrentConversation + '"]').remove();
                $('.message-header-list-body').find('.message-header-item[data-id="' + idCurrentConversation + '"]').remove();
                $('.chat-box-tools-link.icon-font-size.close-popup').click();
            })
        }
    })
}

/**
 * MEMBER
 * Đóng mở gọi danh sách các thành viên
 */
async function openModalListMemberPopupMessage(){
    $('.main-list-infor-detail-popup-message').addClass('d-none');
    $('#get-member-list-popup-message').removeClass('d-none');
    $('#get-pinned-list-popup-message').addClass('d-none');
}

async function openModalListVotePopupMessage(){
    $('.main-list-infor-detail-popup-message').addClass('d-none');
    $('#get-member-list-popup-message').addClass('d-none');
    $('#get-vote-list-popup-message').removeClass('d-none');
    $('#get-pinned-list-popup-message').addClass('d-none');
}

async function dataVoteDetailAboutVisibleMessage() {
    if (checkLoadVoteDetailAboutPopupMessage === 0) {
        checkLoadVoteDetailAboutPopupMessage = 1;
        let method = 'get',
            url = 'visible-message.detail-vote-conversation',
            params = {
                type: typeCurrentConversation,
                id: "634cd10d3774100012fc506f",
                page:  pageVoteDetailAboutPopupMessage,
                limit: limitVoteDetailAboutPopupMessage
            },
            data = null;
        let res = await axiosTemplate(method, url, params, data);
        $('#div-empty-vote').remove();
        pageVoteDetailAboutPopupMessage++;
        currentLimitVoteDetailAboutPopupMessage = res.data[1].data.total_record;
        checkLoadVoteDetailAboutPopupMessage = 1;
        $('#data-all-vote-visible-message').append(res.data[0]);
    }
}

/**
 * Xóa text search thành viên about
 */
$(document).on('click', '.clear-text-area-member-search-about', function () {
    $('#search-info-member-about').val("");
    $('.clear-text-area-member-search-about').css({'visibility': 'hidden', 'opacity': '0'});
    $("#data-all-member-visible-message .row-member").show();
})

/**
 * Hiển thị icon xóa text search, tìm kiếm theo tên thành viên
 */
$(document).on('keyup', '#search-info-member-about', function () {
    if (($('#search-info-member-about').val()).length > 0) {
        $('.clear-text-area-member-search-about').css({'visibility': 'visible', 'opacity': '1'});
    } else {
        $('.clear-text-area-member-search-about').css({'visibility': 'hidden', 'opacity': '0'});
    }
    let keySearch = removeVietnameseStringLowerCase($(this).val());
    $("#data-all-member-visible-message .row-member").each(function () {
        removeVietnameseStringLowerCase($(this).text()).indexOf(keySearch) > -1 ? $(this).show() : $(this).hide();
    });
});

/**
 * Nhấn nút back quay trở lại giao diện chính của danh sách các thông tin popup
 */
$(document).on('click', '.button-back-list-infor-action-setting-popup-message', function () {
    backViewDefaultSettingPopupMessage();
});

async function backViewDefaultSettingPopupMessage(){
    $('.main-list-infor-detail-popup-message').removeClass('d-none');
    $('#get-member-list-popup-message').addClass('d-none');
    $('#get-pinned-list-popup-message').addClass('d-none');
}

/**
 * Mở layout các tính năng hỗ trợ chi tiết của cuộc trò chuyện
 */
$(document).on('click', '#chat-popup-layout .chat-header-info', function (){
    $('.main-list-infor-detail-popup-message').removeClass('d-none');
    $('#get-member-list-popup-message').addClass('d-none');
    $('#get-pinned-list-popup-message').addClass('d-none');
});

/** Function xử lý xem video và nút play video **/
function viewVideoPopup(r) {
    let heightImg = r.parents('.chat-message-video-content').find('img').height();
    let widthImg = r.parents('.chat-message-video-content').find('img').width();
    r.parent().height(`${heightImg}px`);
    r.parent().width(`${widthImg}px`);
    r.parent().find("img").addClass("d-none");
    r.parent().find('video').removeClass('d-none');
    r.parent().find('video').attr('style', `height: ${heightImg}px;width: ${widthImg}px;`);
    r.parent().find("video").get(0).play();
    r.parent().find(".play-video-to-link-btn").addClass("d-none");
    r.parent().find(".chat-message-video-count").addClass("d-none");
    r.parent()
        .find("video")
        .on("ended", function () {
            r.parent().find(".play-video-to-link-btn").removeClass("d-none");
            r.parent().find('video').addClass('d-none');
            r.parent().find("img").removeClass("d-none");
            r.parent().find(".chat-message-video-count").removeClass("d-none");
        });
}

/**
 * Xóa dữ liệu của popup khi được đóng
 */
function resetPopupMessage() {
    $('.chat-form').removeData('data-id');
    $('.chat-header-avatar .chat-avatar-image').attr('src', '');
    $('.header-chat-display-name b').text('');
    $('#number-count-pinned-popup-message').text('0');
    $('.chat-footer-message-input').text('');
    $('#chat-popup-layout input').val('');
    $('#chat-body-message-popup').html('');
    $('#get-pinned-list-popup-message').html('');
    $('#turn-off-record-popup-message').click();
}


/**
 * Sự kiện nhận được tin nhắn mới và kiểm tra hiển thị lên màn hình web
 */
async function eventOpenPopupWithNewMessenger(dataMessagerSupplierAndTMS) {
    if (window.location.pathname !== '/visible-message' && $('#setting-notification-new-message').hasClass('active')) {
        if($('#chat-popup-layout .chat-form').hasClass('d-none')){
            $('#chat-popup-layout .chat-form').removeClass('d-none');
            let id = dataMessagerSupplierAndTMS._id;
            $('.chat-header-avatar .chat-avatar-image').attr('onerror', "this.onerror=null; this.src='/images/tms/default.jpeg'");
            $('.chat-header-avatar .chat-avatar-image').attr('src', domainSession + dataMessagerSupplierAndTMS.avatar);
            $('.chat-header-avatar .chat-avatar-image').attr('data-src', dataMessagerSupplierAndTMS.avatar);
            $('.header-chat-display-name b').text(dataMessagerSupplierAndTMS.name);
            $('.chat-form').attr('data-id', id);
            leaveRoomGroupPersonal();
            $('.message-header-list').removeClass('active');
            $('.link-input-show-box-list-coversation-message').removeClass('active');
            idCurrentConversation = id;
            typeCurrentConversationPopup = dataMessagerSupplierAndTMS.conversation_type;
            joinRoomGroupPersonal();
            dataMessageConversationPopup();
        }
    }
}

























