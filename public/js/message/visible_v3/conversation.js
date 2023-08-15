let pageDefaultConversation = 1;
let conversationId;

$(function () {
    dataConversation();

    /** Sự kiện click vào 1 cuộc trò chuyện **/
    $(document).on('click', '.item-conversation-visible-message', async function () {
        conversationId = $(this).data('id');
        resetLayoutConversation();
        renderDataConversationLocal($(this));
        $(this).find('.notifycation').addClass('d-none');
        $(this).find('.notifycation').text(0);
        if ($('#layout-body-visible-message').hasClass('d-none')) {
            $('#layout-body-visible-message').removeClass('d-none');
            $('#layout-about-visible-message').removeClass('d-none');
        }
       
        // if(isFirstGetMessage) {
        //     sizeBodyMessageThumbnail()
        // }
        // let idGroup = $(this).data('id');
        // let typeConversation = $(this).data('type');
        // numberWatchedConversationMessage = $(this).find('.notifycation span').text();
        // if (numberWatchedConversationMessage !== '') {
        //     let currentNum = $('.link-input-show-box-list-coversation-message .new-notify-unread-message').text() - numberWatchedConversationMessage;
        //     if (currentNum <= 0) {
        //         currentNum = 0;
        //         $('.link-input-show-box-list-coversation-message .new-notify-unread-message').addClass('d-none');
        //         faviconMessage.badge('');
        //         saveCookieShared('notify-message-id-' + idSession, '');
        //     } else {
        //         currentNum = currentNum;
        //         $('.link-input-show-box-list-coversation-message .new-notify-unread-message').removeClass('d-none');
        //         faviconMessage.badge(currentNum);
        //         saveCookieShared('notify-message-id-' + idSession, currentNum);
        //     }
        //     $('.link-input-show-box-list-coversation-message .new-notify-unread-message').text(currentNum);
        // }
        // if (typeConversation == 1) {
        //     $('#employee-list-about-visible-message').addClass('d-none');
        //     $('#remove-group-about').addClass('d-none');
        //     $('#tag-name-message').addClass('d-none');
        //     $('#out-group-about').text('Xóa cuộc trò chuyện');
        //     $('#add-user-in-group').addClass('d-none');
        //     $('#setting-in-group').parents('.action-content').addClass('d-none');
        //     $('#start-call').removeClass('d-none');
        //     $('#start-video-call').removeClass('d-none');
        //     $('.icon-remind-time.fa.fa-clock-o').addClass('d-none');
        //     $('#send-notify-important-message').addClass('d-none');
        // } else {
        //     $('#employee-list-about-visible-message').removeClass('d-none');
        //     $('#remove-group-about').removeClass('d-none');
        //     $('#tag-name-message').removeClass('d-none');
        //     $('#out-group-about').text('Giải tán nhóm');
        //     $('#add-user-in-group').removeClass('d-none');
        //     $('#setting-in-group').parents('.action-content').removeClass('d-none');
        //     $('#start-call').addClass('d-none');
        //     $('#start-video-call').addClass('d-none');
        //     $('.icon-remind-time.fa.fa-clock-o').removeClass('d-none');
        //     $('#send-notify-important-message').removeClass('d-none');
        // }
        // if ($(this).hasClass('active')) return false;
        // $(this).addClass('checked');
        resetPinDetailAboutVisibleMessage();
        resetVoteDetailAboutVisibleMessage();
        resetBodyVisibleMessage();
        resetAboutVisibleMessage();
        // pageMessageConversation = 1;
        // idCurrentConversation = $(this).data('id');
        // typeCurrentConversation = $(this).data('type');
        // supplierCurrentConversation = $(this).data('supplier');
        // $('#layout-about-visible-message').attr('data-log', 0);
        // $('.header-chat-name').text($(this).find('.name').text());
        // $('#avatar-about-visible-message').attr('src', $(this).find('img').attr('src'));
        // $('#avatar-about-visible-message').attr('data-src', $(this).find('img').attr('data-src'));
        // $('#name-about-visible-message').text($(this).find('.name').text());
        // $('#avatar-audio-call-header-visible-message').attr('src', $(this).find('img').attr('src'));
        // $('#avatar-video-call-header-visible-message').attr('src', $(this).find('img').attr('src'));
        // $('#tag-name-message').attr('data-id', idGroup);
        // $('#tag-name-message').attr('data-type', typeConversation);
        // $('#show-order-message').addClass('d-none');
        // $('.vote-visible-message').addClass('d-none');
        // $('#typing-data-message-visible-message').addClass('d-none');
        // switch ($(this).data('type')) {
        //     // case 0:
        //     case 3:
        //         $('.vote-visible-message').removeClass('d-none');
        //         $('.out-team-about-visible-message').addClass('d-none');
        //         $('.mention-tag-name').removeClass('d-none');
        //         $('#member-about-visible-message').removeClass('d-none');
        //         $('#header-info-group-visible-message').removeClass('d-none');
        //         $('#group-info-visible-message').removeClass('d-none');
        //         $('#header-visible-message img').attr('src', $(this).find('img').attr('src'));
        //         $('#role-name-visible-message').html(`<i id="name-role-header-visible-message" class="zmdi zmdi-label-alt tag-friend"></i><span class="text-role-visible-message">Nhóm </span>`);
        //         break;
        //     // case 1:
        //     case 2:
        //         $('.vote-visible-message').removeClass('d-none');
        //         $('.out-team-about-visible-message').addClass('d-none');
        //         $('.mention-tag-name').removeClass('d-none');
        //         $('#member-about-visible-message').removeClass('d-none');
        //         $('#header-info-group-visible-message').removeClass('d-none');
        //         $('#group-info-visible-message').removeClass('d-none');
        //         $('#header-visible-message img').attr('src', $(this).find('img').attr('src'));
        //         $('#role-name-visible-message').html(`<i id="name-role-header-visible-message" class="zmdi zmdi-label-alt tag-orange"></i><span class="text-role-visible-message">Nhóm công việc</span>`);
        //         break;
        //     // case 2:
        //     case 2:
        //         $('.image-about-visible-message .avt-img').addClass('d-none');
        //         $('.update-name-visible-message').addClass('d-none');
        //         $('.out-team-about-visible-message').removeClass('d-none');
        //         $('#header-visible-message img').attr('src', $(this).find('img').attr('src'));
        //         $('.mention-tag-name').addClass('d-none');
        //         $('#member-about-visible-message').addClass('d-none');
        //         $('.live-calls .audio-call, .live-calls .video-call').removeClass('d-none');
        //         $('#header-info-group-visible-message').addClass('d-none');
        //         $('#role-name-visible-message').html(`<i id="name-role-header-visible-message" class="zmdi zmdi-label-alt tag-greens"></i><span class="text-role-visible-message">Cá nhân</span>`);
        //         break;
        //     // case 3:
        //     //     $('#show-order-message').removeClass('d-none');
        //     //     $('.out-team-about-visible-message').addClass('d-none');
        //     //     $('.mention-tag-name').removeClass('d-none');
        //     //     $('#member-about-visible-message').removeClass('d-none');
        //     //     $('#header-info-group-visible-message').removeClass('d-none');
        //     //     $('#group-info-visible-message').removeClass('d-none');
        //     //     $('#header-visible-message img').attr('src', $(this).find('img').attr('src'));
        //     //     $('#role-name-visible-message').html(`<i id="name-role-header-visible-message" class="fa fa-bookmark-o tag-primary"></i><span class="text-role-visible-message">Nhà cung cấp</span>`);
        //     //     break;
        //     default:
        // }
      
        //Layout tin nhắc hẹn không được xóa
        // $('#data-message-visible-message').html(`<div class="chat-body-message-element notify-message-container" id="1666103296998" data-position="1" data-id="634eb8013774100012fc55ba" data-random-key="1666103296998" data-type="27" data-name="Trương Việt Hoà" data-sender="3439">
        //     <div class="body-message-remind">
        //         <div class="div-body-message-remind">
        //             <div class="contain-body-message-remind">
        //                 <div class="contain-body-message-remind-calendar">
        //                      <p class="contain-body-message-remind-calendar-month">Tháng 10</p>
        //                      <p class="contain-body-message-remind-calendar-day">Thứ 3</p>
        //                      <p class="contain-body-message-remind-calendar-num">18</p>
        //                      <p class="contain-body-message-remind-calendar-year">2022</p>
        //                 </div>
        //                 <div class="contain-body-message-remind-info">
        //                     <p class="contain-body-message-remind-info-title">Build 23H</p>
        //                     <div class="contain-body-message-remind-info-time">
        //                         <i class="contain-body-message-remind-info-time-icon ti-alarm-clock"></i>
        //                         <div class="contain-body-message-remind-info-time-title">Hôm nay lúc</div>
        //                         <div class="contain-body-message-remind-info-time-number">21:00</div>
        //                     </div>
        //                     <div class="contain-body-message-remind-info-time">
        //                         <i class="contain-body-message-remind-info-time-icon ti-loop"></i>
        //                         <div class="contain-body-message-remind-info-time-title-loop">Nhắc theo ngày</div>
        //                     </div>
        //                     <div class="contain-body-message-remind-info-member">
        //                         <div class="contain-body-message-remind-info-member-title">Thành viên tham gia</div>
        //                         <div class="contain-body-message-remind-info-member-number">4</div>
        //                     </div>
        //                 </div>
        //             </div>
        //             <div class="contain-footer-message-remind">
        //                 <button id="btn-close-create-specifications" style="width: 48%;" type="button" class="btn btn-grd-disabled">Từ chối</button>
        //                 <button type="button" class="btn btn-grd-primary" style="width: 48%;">Tham gia</button>
        //             </div>
        //         </div>
        //     </div>
        // </div>`);
    
        // $('.item-conversation-visible-message.active').removeClass('active');
        // $(this).addClass('active');
        // $('#input-message-visible-message').focus();
        // if (!$('#layout-about-visible-message').is(":visible")) {
        //     $('.icon-open-about').removeClass('d-none');
        //     $('.icon-close-about').addClass('d-none');
        // } else {
        //     $('.icon-open-about').addClass('d-none');
        //     $('.icon-close-about').removeClass('d-none');
        // }
        // $('.pin-details-content-about-visible-message').html('');
        // $('.dx-htmleditor-content').html('');
        // $('.dx-htmleditor-content').focus();
        // await dataMessageConversation(-1, -1, -1);
        // // renderDataTagVisibleMessage([]);
        // // dataPinDetailAboutVisibleMessage();
        // // dataPinnedCurrentVisibleMessage();
        // dataDetailConversation();
        // // leaveRoomGroupPersonal();
        // // joinRoomGroupPersonal();
        // // sizeBodyMessageThumbnail();
        // isFirstGetMessage=1
    });
});

async function loadDataConversation() {}

/** Hàm lấy dữ liệu cuộc trò chuyện **/
async function dataConversation() {
    const method = "get";
    const url = "visible-message.data-conversation";
    const data = {};
    let params = {
        type: $("#type-filter-conversation").data("id"),
        page: pageDefaultConversation,
    };
    let res = await axiosTemplate(method, url, params, data);
    try {
        $("#div-empty-conversation").remove();
        $("#data-conversation-visible-message-restaurant").append(res.data[0]);
        // pageConversation++;
        // currentLengthConversation = res.data[1].data.length;
        // checkLoadDataConversation = 0;
        // dataConversationTMS += res.data[0];
        // $(".number-message-not-seen").html(res.data[2]);
    } catch (e) {
        console.log(e);
    }
}

async function resetLayoutConversation() {
    $('.mesg-area-head .active-user img').attr('src', '/images/tms/default.jpeg');
    $('.header-chat-name').text('---');
    $('.header-chat-number_employee').text('0 thành viên');
    $('#avatar-about-visible-message').attr('src', '/images/tms/default.jpeg');
    $('#name-about-visible-message').text('---');
    $('#data-message-visible-message').html('');
}

async function renderDataConversationLocal(r) {
    let name = r.find('.name').text();
    let avatar = r.find('.user_chat_avatar img').attr('src');
    let member = r.data('no-of-member');
    $('.mesg-area-head .active-user img').attr('src', avatar);
    $('.header-chat-name').text(name);
    $('.header-chat-number_employee').text(`${member} thành viên`);
    $('#avatar-about-visible-message').attr('src', avatar);
    $('#name-about-visible-message').text(name);
}