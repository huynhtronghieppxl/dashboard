$(function (){
    /*********************************TƯƠNG TÁC TIN NHẮN *********************************/
    /**
     * Có người đang soạn tin nhắn Công ty/Nhà hàng
     */
    socket.on('res-user-is-typing', async data => {
        console.log('res-user-is-typing', data);
        if (data.member_id !== idSession && data.group_id === idCurrentConversation) {
            $('#typing-data-message-popup-message').removeClass('d-none');
        }
    })
    /**
     * Có người đã ngừng soạn tin nhắn Công ty/Nhà hàng
     */
    socket.on('res-user-is-not-typing', async data => {
        console.log('res-user-is-not-typing', data);
        if (data.member_id !== idSession && data.group_id === idCurrentConversation) {
            $('#typing-data-message-popup-message').addClass('d-none');
        }
    })

    /**
     * Có người đang soạn tin nhắn nhà cung cấp
     */
    socket.on('res-user-is-typing-tms-supplier', async data => {
        console.log('res-user-is-typing-tms-supplier', data);
        if (data.member_id !== idSession && data.group_id === idCurrentConversation) {
            $('#typing-data-message-popup-message').removeClass('d-none');
        }
    })
    /**
     * Có người đã ngừng soạn tin nhắn nhà cung cấp
     */
    socket.on('res-user-is-not-typing-tms-supplier', async data => {
        console.log('res-user-is-not-typing-tms-supplier', data);
        if (data.member_id !== idSession && data.group_id === idCurrentConversation) {
            $('#typing-data-message-popup-message').addClass('d-none');
        }
    })

    /**
     * Nhận số tin nhắn mới nhất của một cuộc trò chuyện Công ty/Nhà hàng
     */
    socket.on('message-not-seen-by-one-group/'+idSession, async data => {
        let sender = "";
        if (data.user_last_message_id === idSession) {
            sender = 'Bạn';
        } else {
            sender = data.user_name_last_message;
        }
        let scrollTop = $('#chat-body-message-popup').scrollTop();
        $('#chat-body-message-popup .user-seen-message').remove();
            if ($('.message-header-item[data-id="' + data._id + '"]').length === 1) {
                $('.message-header-item[data-id="' + data._id + '"]').prependTo("#message-header-list-body-restaurant");
                let element = $('.message-header-item[data-id="' + data._id + '"]');
                if (data.last_message_type === 15) {
                    element.find('img').attr('onerror', "this.onerror=null; this.src='/images/tms/default.jpeg'");
                    element.find('img').attr('src', domainSession + data.avatar);
                    element.find('img').attr('data-src', data.avatar);
                }
                element.find('.message-header-item-message .sender-last-message span').text(sender);
                element.find('.message-header-item-message .info-mess').html(showLastMessageConversationPopup(data.last_message_type, data));
                element.find('.message-header-item-time-ago').text(data.created_last_message);
                if (data._id !== idCurrentConversation) {
                    if (data.user_last_message_id === idSession) {
                        element.find('.message-header-item-name p').remove();
                    } else {
                        element.find('.message-header-item-name p').removeClass('d-none');
                        if (element.find('.message-header-item-name p').length === 1) {
                            switch (element.find('.message-header-item-name p').text()) {
                                case '99':
                                    element.find('.message-header-item-name p').text('99+');
                                    break;
                                case '99+':
                                    break;
                                default:
                                    element.find('.message-header-item-name p').text(parseInt(element.find('.message-header-item-name p').text()) + 1);
                            }
                        } else {
                            $('.message-header-item[data-id="' + data._id + '"]').find('.message-header-item-name').append(`<p class="badge bg-c-pink text-center mr-2">1</p>`);
                        }
                    }
                }
            }
            else {
                let tag = ''
                switch (data.conversation_type) {
                    case 0:
                        tag = '<i class="fa fa-tag tag-friend"></i>';
                        break;
                    case 1:
                        tag = '<i class="fa fa-tag tag-orange"></i>';
                        break;
                    case 2:
                        tag = '<i class="fa fa-tag tag-greens"></i>';
                        break;
                }
            }
            dataConversationPopupRestaurant = $('#message-header-list-body-restaurant').html();
        // }
        if (data.user_last_message_id !== idSession && idCurrentConversation == data._id) {
            if (scrollTop === 0) {
                $('.action-scroll-back-current-message-popup').addClass('d-none');
                // $('.chat-body-text-scroll-top-btn').addClass('d-none');
                $('#chat-body-message-popup').scrollTop(0);
            } else {
                $('.action-scroll-back-current-message-popup').addClass('d-none');
                // $('.chat-body-text-scroll-top-btn').removeClass('d-none');
            }
        }
        eventOpenPopupWithNewMessenger(data);
    })

    /**
     * Nhận số tin nhắn mới nhất của một cuộc trò chuyện nhà cung cấp
     */
    socket.on('message-not-seen-by-one-group-tms-supplier/tms/'+idSession, async data => {
        console.log('message-not-seen-by-one-group-tms-supplier/tms/'+idSession, data);
        let scrollTop = $('#chat-body-message-popup').scrollTop();
        $('#chat-body-message-popup .user-seen-message').remove();
        // if ($('.filter-left-popup.active-mess-popup').data('id') === 1) {
            if ($('.message-header-item[data-id="' + data._id + '"]').length === 1) {
                $('.message-header-item[data-id="' + data._id + '"]').prependTo("#message-header-list-body-supplier");
                let element = $('.message-header-item[data-id="' + data._id + '"]');
                if (data.last_message_type === 15) {
                    element.find('img').attr('onerror', "this.onerror=null; this.src='/images/tms/default.jpeg'");
                    element.find('img').attr('src', domainSession + data.avatar);
                    element.find('img').attr('data-src', data.avatar);
                }
                element.find('.message-header-item-name span').text(data.name);
                element.find('.message-header-item-message span').html(data.last_message);
                element.find('.message-header-item-time-ago').text(data.created_last_message);
                if (data._id !== idCurrentConversation) {
                    if (data.user_last_message_id === idSession) {
                        element.find('.message-header-item-name p').remove();
                    } else {
                        element.find('.message-header-item-name p').removeClass('d-none');
                        if (element.find('.message-header-item-name p').length === 1) {
                            switch (element.find('.message-header-item-name p').text()) {
                                case '99':
                                    element.find('.message-header-item-name p').text('99+');
                                    break;
                                case '99+':
                                    break;
                                default:
                                    element.find('.message-header-item-name p').text(parseInt(element.find('.message-header-item-name p').text()) + 1);
                            }
                        } else {
                            $('.message-header-item[data-id="' + data._id + '"]').find('.message-header-item-name').append(`<p class="badge bg-c-pink text-center mr-2">1</p>`);
                        }
                    }
                }
            }
            else {
                let tag = ''
                switch (data.conversation_type) {
                    case 0:
                        tag = '<i class="fa fa-tag tag-friend"></i>';
                        break;
                    case 1:
                        tag = '<i class="fa fa-tag tag-orange"></i>';
                        break;
                    case 2:
                        tag = '<i class="fa fa-tag tag-greens"></i>';
                        break;
                }
                $('#message-header-list-body-supplier').prepend(`<li class="message-header-item popup-message" data-type="${data.conversation_type}" data-id="${data['_id']}">
                    <div class="message-header-item-img">
                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="${domainSession + data.avatar}" data-src="${data.avatar}" alt="">
                    </div>
                    <div class="message-header-item-info">
                        <div class="message-header-item-name">
                            <span>${data.name}</span>
                        </div>
                        <div class="message-header-item-message">
                            ${tag}
                            <span>${data.last_message}</span>
                            <div class="message-header-item-time-ago">${data.created_last_message}</div>
                        </div>
                    </div>
                </li>`);
            }
            dataConversationPopupSupplier = $('#message-header-list-body-supplier').html();
        // }
        if (data.user_last_message_id !== idSession && idCurrentConversation == data._id) {
            if (scrollTop === 0) {
                $('.action-scroll-back-current-message-popup').addClass('d-none');
                // $('.chat-body-text-scroll-top-btn').addClass('d-none');
                $('#chat-body-message-popup').scrollTop(0);
            } else {
                $('.action-scroll-back-current-message-popup').addClass('d-none');
                // $('.chat-body-text-scroll-top-btn').removeClass('d-none');
            }
        }
        eventOpenPopupWithNewMessenger(data);
    })

    /**
     * Nhận số tin nhắn mới nhất của tất cả cuộc trò chuyện mục Công ty/Nhà hàng
     */
    // socket.on('message-not-seen-by-all-group/'+idSession, async data => {
    //     console.log('popup-message-not-seen-by-all-group/'+idSession, data);
    //     numberMessageUnreadSupplier = data.message_not_seen_group + data.message_not_seen_personal + data.message_not_seen_two_personal;
    //     // faviconMessage.badge(numberMessageUnreadSupplier);
    //     // eventSumTwoCountMessagerUnreadSupplierTMS();
    //     $('#set-number-count-message-not-seen-restaurant').removeClass('d-none');
    //     $('#number-count-message-not-seen-restaurant').text(data.message_not_seen_group + data.message_not_seen_personal + data.message_not_seen_two_personal);
    // })

    /**
     * Nhận số tin nhắn mới nhất của tất cả cuộc trò chuyện mục nhà cung cấp visbie và popup
     */
    socket.on('message-not-seen-by-all-group-tms-supplier/tms/'+idSession, async data => {
        console.log('message-not-seen-by-all-group-tms-supplier/tms/'+idSession, data);
        numberMessageUnreadRestaurant = data.message_not_seen_group;
        // eventSumTwoCountMessagerUnreadSupplierTMS();
        $('#set-number-count-message-not-seen-supplier').removeClass('d-none');
        $('#number-count-message-not-seen-supplier').text(numberMessageUnreadRestaurant);

        $('.link-input-show-box-list-coversation-message .new-notify-unread-message').removeClass('d-none');
        if (numberMessageUnreadRestaurant > 99) {
            saveCookieShared('notify-message-id-' + idSession, 99);
            faviconMessage.badge(99);
            $('.link-input-show-box-list-coversation-message .new-notify-unread-message').text(99);
        } else if (numberMessageUnreadRestaurant > 0) {
            saveCookieShared('notify-message-id-' + idSession, numberMessageUnreadRestaurant);
            faviconMessage.badge(numberMessageUnreadRestaurant);
            $('.link-input-show-box-list-coversation-message .new-notify-unread-message').text(numberMessageUnreadRestaurant);
        } else if (numberMessageUnreadRestaurant <= 0) {
            saveCookieShared('notify-message-id-' + idSession, 0);
            faviconMessage.badge('');
            $('.link-input-show-box-list-coversation-message .new-notify-unread-message').text(0);
            $('.link-input-show-box-list-coversation-message .new-notify-unread-message').addClass('d-none');
        }
    })

    /**
     * Nhận tin nhắn text Công ty/Nhà hàng
     */
    socket.on('res-chat-text', async data => {
        console.log('res-chat-text', data, idSession);
        renderMessageTextPopup(data);
    })

    /**
     * Nhận tin nhắn text nhà cung cấp
     */
    socket.on('res-chat-text-tms-supplier', async data => {
        console.log('res-chat-text-tms-supplier', data, idSession);
        renderMessageTextPopup(data);
    })

    /**
     * Nhận tin nhắn link Công ty/Nhà hàng
     */
    socket.on('res-chat-link', async data => {
        console.log('res-chat-link', data, idSession)
        renderMessageLinkPopup(data);
    })

    /**
     * Nhận tin nhắn link nhà cung cấp
     */
    socket.on('res-chat-link-tms-supplier', async data => {
        console.log('res-chat-link-tms-supplier', data, idSession)
        renderMessageLinkPopup(data);
    })

    /**
     * Nhận tin nhắn reply Công ty/Nhà hàng
     */
    socket.on('res-chat-reply', async  data => {
        console.log('res-chat-reply', data, idSession);
        renderMessageReplyPopup(data);
    })

    /**
     * Nhận tin nhắn reply nhà cung cấp
     */
    socket.on('res-chat-reply-tms-supplier', async  data => {
        console.log('res-chat-reply-tms-supplier', data, idSession);
        renderMessageReplyPopup(data);
    })

    /**
     * Nhận tin nhắn image Công ty/Nhà hàng
     */
    socket.on('res-chat-image', async data => {
        console.log('res-chat-image', data, idSession);
        renderMessageImagePopup(data);
    })

    /**
     * Nhận tin nhắn image nhà cung cấp
     */
    socket.on('res-chat-image-tms-supplier', async data => {
        console.log('res-chat-image-tms-supplier', data, idSession);
        renderMessageImagePopup(data);
    })

    /**
     * Nhận tin nhắn video Công ty/Nhà hàng
     */
    socket.on('res-chat-video', async data => {
        console.log("res-chat-video", data, idSession);
        renderMessageVideoPopup(data)
    })

    /**
     * Nhận tin nhắn video nhà cung cấp
     */
    socket.on('res-chat-video-tms-supplier', async data => {
        console.log("res-chat-video-tms-supplier", data, idSession);
        renderMessageVideoPopup(data)
    })

    /**
     * Nhận tin nhắn audio Công ty/Nhà hàng
     */
    socket.on('res-chat-audio', async data => {
        console.log('res-chat-audio', data, idSession);
        renderMessageAudioPopup(data)
    })

    /**
     * Nhận tin nhắn audio nhà cung cấp
     */
    socket.on('res-chat-audio-tms-supplier', async data => {
        console.log('res-chat-audio-tms-supplier', data, idSession);
        renderMessageAudioPopup(data)
    })

    /**
     * Nhận tin nhắn sticker Công ty/Nhà hàng
     */
    socket.on('res-chat-sticker', async data => {
        console.log('res-chat-sticker', data, idSession);
        renderMessageStickerPopup(data)
    })

    /**
     * Nhận tin nhắn sticker nhà cung cấp
     */
    socket.on('res-chat-sticker-tms-supplier', async data => {
        console.log('res-chat-sticker-tms-supplier', data, idSession);
        renderMessageStickerPopup(data)
    })

    /**
     * Nhận tin nhắn file Công ty/Nhà hàng
     */
    socket.on('res-chat-file', async data => {
        console.log('res-chat-file', data, idSession);
        renderMessageFilePopup(data)
    });

    /**
     * Nhận tin nhắn file nhà cung cấp
     */
    socket.on('res-chat-file-tms-supplier', async data => {
        console.log('res-chat-file-tms-supplier', data, idSession);
        renderMessageFilePopup(data)
    });

    /**
     * Nhận tin nhắn đơn hàng (popup + visible)
     */
    socket.on('res-chat-order-tms-supplier', async data => {
        console.log('res-chat-order-tms-supplier', data, idSession);
        renderMessageOrderPopup(data);
    })

    /**
     * Thu hồi tin nhắn Công ty/Nhà hàng
     */
    socket.on('res-revoke-message', async data => {
        console.log('res-revoke-message', data, idSession);
        multiCallFunctionRevokeMessagePopup(data);
    })

    /**
     * Thu hồi tin nhắn nhà cung cấp
     */
    socket.on('res-revoke-message-tms-supplier', async data => {
        console.log('res-revoke-message-tms-supplier', data, idSession);
        multiCallFunctionRevokeMessagePopup(data);
    })

    /**
     * Ghim tin nhắn Công ty/Nhà hàng
     */
    socket.on('res-pinned-message', async data => {
        console.log('res-pinned-message', data);
        multiCallFunctionPinnedMessagePopup(data);
    })

    /**
     * Ghim tin nhắn nhà cung cấp
     */
    socket.on('res-pinned-message-tms-supplier', async data => {
        console.log('res-pinned-message-tms-supplier', data);
        multiCallFunctionPinnedMessagePopup(data);
    })

    /**
     * Bỏ ghim tin nhắn Công ty/Nhà hàng
     */
    socket.on('res-revoke-pinned-message', async data =>{
        console.log('res-revoke-pinned-message', data);
        multiCallFunctionRevokePinnedMessagePopup(data);
    })

    /**
     * Bỏ ghim tin nhắn nhà cung cấp
     */
    socket.on('res-revoke-pinned-message-tms-supplier', async data =>{
        console.log('res-revoke-pinned-message-tms-supplier', data);
        multiCallFunctionRevokePinnedMessagePopup(data);
    })

    /**
     * Reaction Công ty/Nhà hàng
     */
    socket.on('res-reaction-message', async data => {
        console.log('res-reaction-message', data);
        multiCallFunctionReactionPopup(data);
    })

    /**
     * Reaction nhà cung cấp
     */
    socket.on('res-reaction-message-tms-supplier', async data => {
        console.log('res-reaction-message-tms-supplier', data);
        multiCallFunctionReactionPopup(data);
    })

    /**
     * Xóa thành viên ở cuộc trò chuyện
     */
    socket.on('res-remove-user', async data => {
        console.log('res-remove-user', data);
        renderActionRemoveMember(data);
    })

    /**
     * Bổ nhiệm phó nhóm thành viên ở cuộc trò chuyện
     */
    socket.on('res-promote-group-vice', async data => {
        let html = `<div class="chat-body-message-element notify-message-container">
                        <div class="notify-message-content">
                            <span class="notify-message-text">${data.message}</span>
                        </div>
                    </div>`
        $('#chat-body-message-popup').prepend(html);
        console.log('res-promote-group-vice', data);
    })
    /**
     * Tạo vote
     */
    socket.on('res-create-vote', async data => {
        showMessageVoteFormPopup(data);
    })
})

function showMessageVoteFormPopup(data) {
    $('#data-message-visible-message .chat-body-message-element[id="' + data.random_key + '"]').remove();
    data.message_vote.list_option = data.message_vote.list_option.filter(item => item.id !== -1);
    let classTextVote = 'd-none', textVote = '';
    if (data.message_vote.list_option.length > 2) {
        classTextVote = '';
        textVote = '* Còn ' + (data.message_vote.list_option.length - 2) + ' lựa chọn khác';
    }
    $('#chat-body-message-popup').prepend(`<div class="chat-body-message-element notify-message-container" id="${data.random_key}" data-position="1" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}">
                                                    <div class="body-message-vote">
                                                        <div class="div-body-message-vote">
                                                            <div class="title-message-vote">${data.message_vote.title}</div>
                                                            <div class="member-message-vote"><span>Đã có ${data.message_vote.number_user_vote} người bình chọn<i class="ion-arrow-right-b"></i></span></div>
                                                            <div style="position: relative;">
                                                                <div class="item-vote">
                                                                    <div class="div-vote" style="width: ${rateTemplate(data.message_vote.list_option[0].list_user.length, data.message_vote.list_option[0].list_user.length)}%;"></div>
                                                                    <div class="content-vote"><span>${data.message_vote.list_option[0].content}</span></div>
                                                                    <div class="count-vote">${data.message_vote.list_option[0].list_user.length}</div>
                                                                </div>
                                                                <div class="item-vote">
                                                                    <div class="div-vote" style="width:${rateTemplate(data.message_vote.list_option[1].list_user.length, data.message_vote.list_option[0].list_user.length)}%;"></div>
                                                                    <div class="content-vote"><span>${data.message_vote.list_option[1].content}</span></div>
                                                                    <div class="count-vote">${data.message_vote.list_option[1].list_user.length}</div>
                                                                </div>
                                                            </div>
                                                            <span class="other-vote-message-vote ${classTextVote}">${textVote}</span>
                                                            <div class="pin-details-content-item-bottom">
                                                                <button class="button-message-vote" onclick="openModalDetailVoteVisibleMessage(${data.random_key})">Xem bình chọn</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>`);
}

function showLastMessageConversationPopup(type, data) {
    switch (type) {
        case 2:
            return `<i class="fa fa-image"></i>Hình ảnh`;
        case 3:
            return `<i class="fa fa-file"></i>Tệp đính kèm`;
        case 4:
            return `<i class="ti-themify-favicon"></i>Sticker`;
        case 5:
            return `<i class="fa fa-video-camera"></i>Video`;
        case 6:
            return `<i class="fa fa-microphone"></i>Âm thanh`;
        case 9:
            return `</i>Đã thu hồi tin nhắn`;
        case 10:
            return `</i>Type 10`;
        case 11:
            return `</i>Type 11`;
        case 13:
            return `<i class="icofont icofont-tack-pin"></i>Đã ghim tin nhắn`;
        case 14:
            return `Đã đổi tên nhóm`;
        case 15:
            return `Đã đổi ảnh nhóm`;
        case 27:
            return `<i class="fa fa-signal"></i>Tạo bình chọn mới`;
        case 28:
            return `<i class="fa fa-signal"></i>${data.last_message}`;
        default:
            return `${data.last_message}`;
    }
}


