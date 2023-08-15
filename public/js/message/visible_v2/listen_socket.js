let arrUserTyping = [];
$(function () {
    /**
     * *********************************** TƯƠNG TÁC VỚI NHÓM *********************************
     */
    /** Hển thị số tin nhắn chưa đọc **/
    socket.on('message-not-seen-by-all-group/' + idSession, async data => {
        $('.link-input-show-box-list-coversation-message .new-notify-unread-message').removeClass('d-none');
        if (data.message_not_seen_all > 99) {
            saveCookieShared('notify-message-id-' + idSession, 99);
            faviconMessage.badge(99);
            $('.link-input-show-box-list-coversation-message .new-notify-unread-message').text(99);
        } else if (data.message_not_seen_all > 0) {
            saveCookieShared('notify-message-id-' + idSession, data.message_not_seen_all);
            faviconMessage.badge(data.message_not_seen_all);
            $('.link-input-show-box-list-coversation-message .new-notify-unread-message').text(data.message_not_seen_all);
        } else if (data.message_not_seen_all <= 0) {
            saveCookieShared('notify-message-id-' + idSession, 0);
            faviconMessage.badge('');
            $('.link-input-show-box-list-coversation-message .new-notify-unread-message').text(0);
            $('.link-input-show-box-list-coversation-message .new-notify-unread-message').addClass('d-none');
        }
    });
    /** Nhận tin nhắn mới nội bộ */
    socket.on('message-not-seen-by-one-group/' + idSession, async data => {
        let scrollTop = $('#data-message-visible-message').scrollTop();
        $('#div-empty-conversation').remove();
        $('#data-message-visible-message .user-seen-message').remove();
        if (data.conversation_type === $("#type-filter-conversation").data("id") || $("#type-filter-conversation").data("id") === -1 && $('.filter-left.active-mess').data('id') === 0) {
            if ($('#data-conversation-visible-message-restaurant .item-conversation-visible-message[data-id="' + data._id + '"]').length === 1) {
                $('#data-conversation-visible-message-restaurant .item-conversation-visible-message[data-id="' + data._id + '"]').prependTo("#data-conversation-visible-message-restaurant");
                let element = $('.item-conversation-visible-message[data-id="' + data._id + '"]').first();
                if(data.last_message_type === 15) {
                    element.find('img').attr('onerror', "this.onerror=null; this.src='/images/tms/default.jpeg'");
                    element.find('img').attr('src', domainSession + data.avatar);
                    element.find('img').attr('data-src', data.avatar);
                }
                element.find('.content .name').text(data.name);
                element.find('.info-mess').html(showLastMessageConversation(data.last_message_type, data));
                element.find('.time-last-message-conversation').text(data.created_last_message);
                element.find('.time-last-message-conversation').data('time', moment().format('YYYY-MM-DD HH:mm:ss'));
                if (data._id !== idCurrentConversation) {
                    if (data.user_last_message_id === idSession) {
                        element.find('.notifycation').addClass('d-none');
                    } else {
                        element.find('.notifycation').removeClass('d-none');
                        if (element.find('.notifycation span').text() !== '') {
                            element.find('.notifycation span').text(parseInt(element.find('.notifycation span').text()) + 1);
                            if (element.find('.notifycation span').text() >= 99) {
                                element.find('.notifycation span').text('99');
                            }
                        } else {
                            $('.item-conversation-visible-message[data-id="' + data._id + '"] .notifycation').html(`<span>1</span>`);
                        }
                    }
                }
            } else {
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
        }
        dataConversationTMS = $('#data-conversation-visible-message-restaurant').html();
        if (data.user_last_message_id !== idSession && idCurrentConversation == data._id) {
            if (scrollTop === 0) {
                $('.chat-body-scroll-top-btn').addClass('d-none');
                $('.chat-body-text-scroll-top-btn').addClass('d-none');
                $('#data-message-visible-message').scrollTop(0);
            } else {
                $('.chat-body-scroll-top-btn').addClass('d-none');
                $('.chat-body-text-scroll-top-btn').removeClass('d-none');
            }
        }
        if ($('.dx-htmleditor-content').hasClass('out-focus')) {
            let number = data.number;
            $('.item-conversation-visible-message[data-id="' + data._id + '"]').find('.notifycation.pl-0.pr-0').removeClass('d-none');
            $('.item-conversation-visible-message[data-id="' + data._id + '"]').find('.notifycation.pl-0.pr-0').text(number)
        } else {
            if(data.number !== 0) {
                $('.item-conversation-visible-message[data-id="' + data._id + '"]').find('.notifycation.pl-0.pr-0').removeClass('d-none');
                $('.item-conversation-visible-message[data-id="' + data._id + '"]').find('.notifycation.pl-0.pr-0').text(data.number)
            }
            else {
                $('.item-conversation-visible-message[data-id="' + data._id + '"]').find('.notifycation.pl-0.pr-0').addClass('d-none');
                $('.item-conversation-visible-message[data-id="' + data._id + '"]').find('.notifycation.pl-0.pr-0').text(data.number)
            }

        }
    });
    /** Nhận tin nhắn mới nhà cung cấp **/
    socket.on('message-not-seen-by-one-group-tms-supplier/tms/' + idSession, async data => {
        let scrollTop = $('#data-message-visible-message').scrollTop();
        $('#data-message-visible-message .user-seen-message').remove();
        if ($('.filter-left.active-mess').data('id') === 1) {
            if ($('#data-conversation-visible-message-supplier .item-conversation-visible-message[data-id="' + data._id + '"]').length === 1) {
                $('#data-conversation-visible-message-supplier .item-conversation-visible-message[data-id="' + data._id + '"]').prependTo("#data-conversation-visible-message-supplier");
                let element = $('#data-conversation-visible-message-supplier .item-conversation-visible-message[data-id="' + data._id + '"]');
                if (data.last_message_type === 15) {
                    element.find('img').attr('onerror', "this.onerror=null; this.src='/images/tms/default.jpeg'");
                    element.find('img').attr('src', domainSession + data.avatar);
                    element.find('img').attr('data-src', data.avatar);
                }
                element.find('.content .name').text(data.name);
                element.find('.info-mess').html(data.last_message);
                element.find('.time-last-message-conversation').text(data.created_last_message);
                element.find('.time-last-message-conversation').data('time', moment().format('YYYY-MM-DD HH:mm:ss'));
                if (data._id !== idCurrentConversation) {
                    if (data.user_last_message_id === idSession) {
                        element.find('.notifycation').addClass('d-none');
                    } else {
                        element.find('.notifycation').removeClass('d-none');
                        if (element.find('.notifycation span').text() !== '') {
                            element.find('.notifycation span').text(parseInt(element.find('.notifycation span').text()) + 1);
                            if (element.find('.notifycation span').text() >= 99) {
                                element.find('.notifycation span').text('99');
                            }
                        } else {
                            $('.item-conversation-visible-message[data-id="' + data._id + '"] .notifycation').html(`<span>1</span>`);
                        }
                    }
                }
            } else {
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
                $('#data-conversation-visible-message-supplier').prepend(`<li class="item-conversation-visible-message box-user" data-id="${data._id}" data-type="${data.conversation_type}">
                    <div class="user_chat">
                            <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="${domainSession + data.avatar}" data-src="${data.avatar}" alt="" class="img_userchat">
                    <div class="content">
                            <h9 class="name pl-0 pr-0">${data.name}</h9>
                            <div class="Message-preview-and-category-tags">
                                ${tag}
                           <p class="info-mess">${data.last_message}</p>
                    </div>
                        </div>
                        <div class="option">
                            <span class="time-last-message-conversation">${data.created_last_message}</span>
                            <div>
                                 <div class="notifycation pl-0 pr-0"></div>
                            </div>
                        </div>
                    </div>
                </li>`);
            }
        }
        dataConversationSupplier = $('#data-conversation-visible-message-supplier').html();
        if (data.user_last_message_id !== idSession && idCurrentConversation == data._id) {
            if (scrollTop === 0) {
                $('.chat-body-scroll-top-btn').addClass('d-none');
                $('.chat-body-text-scroll-top-btn').addClass('d-none');
                $('#data-message-visible-message').scrollTop(0);
            } else {
                $('.chat-body-scroll-top-btn').addClass('d-none');
                $('.chat-body-text-scroll-top-btn').removeClass('d-none');
            }
        }
    })

    /**
     * Có nhóm mới tạo
     */
    socket.on('res-new-group-created/' + idSession, async data => {
        $('#div-empty-conversation').remove();
        if ($('#data-conversation-visible-message-restaurant .item-conversation-visible-message[data-id="' + data._id + '"]').length === 0) {
            let tag = '', name = data.name, avatar = data.avatar;
            switch (data.conversation_type) {
                case 0:
                    tag = '<i class="fa fa-tag tag-friend"></i>';
                    break;
                case 1:
                    tag = '<i class="fa fa-tag tag-orange"></i>';
                    break;
                case 2:
                    tag = '<i class="fa fa-tag tag-greens"></i>';
                    name = data.member.full_name;
                    avatar = data.member.avatar;
                    break;
            }
            let user = (data.admin_id === idSession) ? 'Bạn' : data.user_name_last_message;
            $('#data-conversation-visible-message-restaurant').prepend(`<li class="item-conversation-visible-message box-user" data-id="${data._id}" data-type="${data.conversation_type}">
                    <div class="user_chat">
                            <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="${domainSession + avatar}" data-src="${avatar}" alt="" class="img_userchat">
                    <div class="content">
                            <h9 class="name pl-0 pr-0">${name}</h9>
                            <div class="Message-preview-and-category-tags">
                                ${tag}
                           <p class="info-mess">${user} vừa tạo nhóm</p>
                    </div>
                        </div>
                        <div class="option">
                            <span class="time-last-message-conversation">Vài giây</span>
                            <div>
                                 <div class="notifycation pl-0 pr-0"></div>
                            </div>
                        </div>
                    </div>
                </li>`);
        }
    })
    /**
     * Có nhóm bị xoá
     */
    socket.on('res-remove-group/' + idSession, async data => {
        console.log('Có nhóm bị xoá', data, idSession);
        if (data.group_id == idCurrentConversation) {
            resetBodyVisibleMessage();
            resetAboutVisibleMessage();
            $('#layout-body-visible-message').addClass('d-none');
            $('#layout-about-visible-message').addClass('d-none');
            leaveRoomGroupPersonal();
            $('#data-conversation-visible-message-restaurant .item-conversation-visible-message[data-id="' + data.group_id + '"]').remove();
        } else {
            $('#data-conversation-visible-message-restaurant .item-conversation-visible-message[data-id="' + data.group_id + '"]').remove();
        }
        if ($('#data-conversation-visible-message-restaurant .item-conversation-visible-message').length === 0) {
            $('#data-conversation-visible-message-restaurant').html(`<div id="div-empty-conversation" style="height: 295px; width: 100%; margin-top: 20%">
                                                             <div class="text-center">
                                                                 <img src="/images/message/conversation_empty.png" style="width: 160px;">
                                                                 <div class="text-center">
                                                                     <div>Chưa có cuộc trò chuyện</div>
                                                                 </div>
                                                                 <button class="btn btn-grd-primary" id="open-form-new-conversation" style="margin-top: 10px;">Thêm trò chuyện</button>
                                                             </div>
                                                          </div>`);
        }
    })
    /** Đổi tên nhóm **/
    socket.on('res-update-group-name/' + idSession, async data => {
        if (data.sender.member_id !== idSession) {
            $('#data-message-visible-message').prepend(`<div class="chat-body-message-element notify-message-container" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}">
                                                                    <div class="notify-message-content">
                                                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="chat-body-message-item-pin-img" src="${domainSession + data.sender.avatar}" alt="" />
                                                                        <div class="notify-message-block">
                                                                             <span class="event-message-content-name-show showmore-you underline-you text-report-body-visible-message">${data.sender.full_name} </span>
                                                                             <span>đã đổi tên nhóm thành </span>
                                                                             <span class="event-vote-message-content-name">${data.name}</span>
                                                                             </div>
                                                                    </div>
                                                                </div>`);
        } else {
            $('#data-message-visible-message').prepend(`<div class="chat-body-message-element notify-message-container" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}">
                                                                    <div class="notify-message-content">
                                                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="chat-body-message-item-pin-img" src="${domainSession + data.sender.avatar}" alt="" />
                                                                        <div class="notify-message-block">
                                                                             <span class="event-message-content-name showmore underline">Bạn</span>
                                                                             <span>đã đổi tên nhóm thành</span>
                                                                             <span class="event-vote-message-content-name">${data.name}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>`);
        }
        if (data.receiver_id === idCurrentConversation) {
            $('.header-chat-name').text(data.name);
            $('.name-about-custom-style').text(data.name);
        }
    })
    /** Đổi avatar nhóm **/
    socket.on('res-update-group-avatar/' + idSession, async data => {
        if (data.sender.member_id !== idSession) {
            $('#data-message-visible-message').prepend(`<div class="chat-body-message-element notify-message-container" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}">
                                                                    <div class="notify-message-content">
                                                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="chat-body-message-item-pin-img" src="${domainSession + data.sender.avatar}" alt="" />
                                                                        <div class="notify-message-block">
                                                                             <span class="event-message-content-name-show showmore-you underline-you text-report-body-visible-message">${data.sender.full_name} </span>
                                                                             <span>đã đổi ảnh đại diện nhóm </span>
                                                                             <i class="event-message-content-info-icon fa fa-image"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>`);
        } else {
            $('#data-message-visible-message').prepend(`<div class="chat-body-message-element notify-message-container" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}">
                                                                    <div class="notify-message-content">
                                                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="chat-body-message-item-pin-img" src="${domainSession + data.sender.avatar}" alt="" />
                                                                        <div class="notify-message-block">
                                                                             <span class="event-message-content-name showmore underline">Bạn </span>
                                                                             <span>đã đổi ảnh đại diện nhóm </span>
                                                                             <i class="event-message-content-info-icon fa fa-image"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>`);
        }
        $('#data-conversation-visible-message-restaurant .item-conversation-visible-message[data-id="' + data.receiver_id + '"]').find('img').attr('src', domainSession + data.avatar);
        if (idCurrentConversation === data.receiver_id) {
            $('#header-visible-message img').attr('src', domainSession + data.avatar);
            $('.image-about-visible-message').find('img').attr('src', domainSession + data.avatar);
        }
    })
    /**
     * *********************************** TƯƠNG TÁC VỚI THÀNH VIÊN *********************************
     */
    /**
     * Thêm người vào nhóm
     */
    socket.on('res-add-new-user', async data => {
        console.log('res-add-new-user', data, idSession);
        let addMemberLength = data.list_member.length;
        let reviewUser = '';
        let dataMember = '';
        if (addMemberLength == 1) {
            reviewUser = `<span class="event-message-content-name-show showmore-you underline-you text-report-body-visible-message">${data.list_member[0].full_name}</span>`;
        } else {
            reviewUser = `<span class="event-message-content-name-show showmore-you underline-you text-report-body-visible-message">${data.list_member[0].full_name} </span><span>và ${addMemberLength - 1} người nữa</span>`;

        }
        if (data.sender.member_id !== idSession) {
            $('#data-message-visible-message').prepend(`<div class="chat-body-message-element notify-message-container">
                    <div class="notify-message-content">
                          <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  class="" src="${domainSession + data.list_member[0].avatar}" alt="" loading="lazy">
                                        <div class="notify-message-block">
                                        <span class="notify-message-username">${reviewUser}</span>
                                        <span class="notify-message-text">được</span>
                                        <span class="notify-message-username "><span class="text-report-body-visible-message showmore-you underline-you d-flex">${data.sender.full_name}</span></span>
                                        <span class="notify-message-text">thêm vào nhóm</span></div>
                    </div>
                </div>`)
        } else {
            $('#data-message-visible-message').prepend(`<div class="chat-body-message-element notify-message-container">
                    <div class="notify-message-content">
                          <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  class="" src="${domainSession + data.list_member[0].avatar}" alt="" loading="lazy">
                                        <div class="notify-message-block">
                                        <span class="notify-message-username">${reviewUser}</span>
                                        <span class="notify-message-text">được</span>
                                        <span class="notify-message-username "><span class="event-message-content-name showmore underline">Bạn</span></span>
                                        <span class="notify-message-text">thêm vào nhóm</span></div>
                    </div>
                </div>`)
        }
        let option = ` <div class="dropdown dropdown-action-user-about">
                                         <button class="dropdown-toggle action-user-member" type="button" data-toggle="dropdown">
                                              <i class="fa fa-ellipsis-h"></i>
                                         </button>
                                         <div class="dropdown-menu">
                                              <a class="dropdown-item remove-member dropdown-item-custom" href="javascript:void(0)">Mời khỏi nhóm</a>
                                         </div>
                                    </div>`

        for (let i = 0; i < data.list_member.length; i++) {
            for (let j = 0; j < dataMemberConversation.length; j++) {
                if (dataMemberConversation[j].member_id == idSession && dataMemberConversation[j].permissions == 1 && data.sender.member_id == idSession) {
                    dataMember = `<div class="row-member" data-id="${data.receiver_id}"  data-member-id = "${data.list_member[i].member_id}">
                                   <div class="img-members-about">
                                         <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  loading="lazy" class="img-avt-member" src="${domainSession + data.list_member[i].avatar}" alt="">
                                   </div>
                                   <div class="info-member-about">
                                         <div class="info-name-member-about">${data.list_member[i].full_name}</div>
                                         <div class="title-key-admin">${data.list_member[i].role_name}</div>
                                   </div>
                                  ${option}
                               </div>`
                }
                if (dataMemberConversation[j].member_id == idSession && dataMemberConversation[j].permissions == 0 && data.sender.member_id == idSession) {
                    dataMember = `<div class="row-member" data-id="${data.receiver_id}"  data-member-id = "${data.list_member[i].member_id}">
                                   <div class="img-members-about">
                                         <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  loading="lazy" class="img-avt-member" src="${domainSession + data.list_member[i].avatar}" alt="">
                                   </div>
                                   <div class="info-member-about">
                                         <div class="info-name-member-about">${data.list_member[i].full_name}</div>
                                         <div class="title-key-admin">${data.list_member[i].role_name}</div>
                                   </div>
                               </div>`
                }
            }
            for (let j = 0; j < dataMemberConversation.length; j++) {
                if (dataMemberConversation[j].member_id == idSession && dataMemberConversation[j].permissions == 0 && data.sender.member_id !== idSession) {
                    dataMember = `<div class="row-member" data-id="${data.receiver_id}"  data-member-id = "${data.list_member[i].member_id}">
                                   <div class="img-members-about">
                                         <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  loading="lazy" class="img-avt-member" src="${domainSession + data.list_member[i].avatar}" alt="">
                                   </div>
                                   <div class="info-member-about">
                                         <div class="info-name-member-about">${data.list_member[i].full_name}</div>
                                         <div class="title-key-admin">${data.list_member[i].role_name}</div>
                                   </div>
                               </div>`

                }
                if (dataMemberConversation[j].member_id == idSession && dataMemberConversation[j].permissions == 1 && data.sender.member_id !== idSession) {
                    dataMember = `<div class="row-member" data-id="${data.receiver_id}"  data-member-id = "${data.list_member[i].member_id}">
                                   <div class="img-members-about">
                                         <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  loading="lazy" class="img-avt-member" src="${domainSession + data.list_member[i].avatar}" alt="">
                                   </div>
                                   <div class="info-member-about">
                                         <div class="info-name-member-about">${data.list_member[i].full_name}</div>
                                         <div class="title-key-admin">${data.list_member[i].role_name}</div>
                                   </div>
                                   ${option}
                               </div>`
                }
            }

            $('#data-all-member-visible-message').append(dataMember);
            dataMemberConversationTag.push({
                "member_id": data.list_member[i].member_id,
                "role_id": data.list_member[i].role_id,
                "role_name": data.list_member[i].role_name,
                "avatar": data.list_member[i].avatar,
                "full_name": data.list_member[i].full_name,
                "number": 0,
                "tag_name": 1,
                "is_notification": 1,
                "is_join_room": 0,
                "normalize_name": "",
                "prefix": "",
                "permissions": 0,
            })
            renderDataTagVisibleMessage(dataMemberConversationTag)
            dataMemberConversation.push({
                "member_id": data.list_member[i].member_id,
                "role_id": data.list_member[i].role_id,
                "role_name": data.list_member[i].role_name,
                "avatar": data.list_member[i].avatar,
                "full_name": data.list_member[i].full_name,
                "number": 0,
                "tag_name": 1,
                "is_notification": 1,
                "is_join_room": 0,
                "normalize_name": "",
                "prefix": "",
                "permissions": 0,
            })
        }
        let currentMember = $('#data-all-member-visible-message div.row-member').length;
        $('.header-chat-number_employee').text(currentMember + ' thành viên');
        $('.number-person-about').text(currentMember);
        (currentMember > 5) ? $('#see-all-member-about').removeClass('d-none') : $('#see-all-member-about').addClass('d-none');
        if (currentMember > 5) {
            $('#data-member-about-visible-message').html($('#data-all-member-visible-message .row-member:eq(0)')[0].outerHTML + $('#data-all-member-visible-message .row-member:eq(1)')[0].outerHTML + $('#data-all-member-visible-message .row-member:eq(2)')[0].outerHTML + $('#data-all-member-visible-message .row-member:eq(3)')[0].outerHTML + $('#data-all-member-visible-message .row-member:eq(4)')[0].outerHTML);
        }
        if (currentMember <= 5) {
            $('#data-member-about-visible-message').append(dataMember);
        }
    })
    /**
     * Bổ nhiệm phó nhóm
     */
    socket.on('res-promote-group-vice', async data => {
        let html = `<div class="chat-body-message-element notify-message-container">
                        <div class="notify-message-content">
                            <span class="notify-message-text">${data.message}</span>
                        </div>
                    </div>`
        $('#data-message-visible-message').prepend(html);
        console.log('res-promote-group-vice', data);
    })
    /**
     * Xoá người khỏi nhóm
     */
    socket.on('res-remove-user', async data => {
        console.log('res-remove-user', data, idSession);
        if (data.list_member[0].member_id == idSession) {
            if (data.receiver_id == idCurrentConversation) {
                resetBodyVisibleMessage();
                resetAboutVisibleMessage();
                $('#layout-body-visible-message').addClass('d-none');
                $('#layout-about-visible-message').addClass('d-none');
                $('#data-conversation-visible-message-restaurant .item-conversation-visible-message[data-id="' + data.receiver_id + '"]').remove();
                leaveRoomGroupPersonal();
            } else {
                $('#data-conversation-visible-message-restaurant .item-conversation-visible-message[data-id="' + data.receiver_id + '"]').remove();
            }
        } else {
            $('#data-message-visible-message').prepend(`<div class="chat-body-message-element notify-message-container">
                    <div class="notify-message-content">
                          <img  onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  class=""  src="${domainSession + data.list_member[0].avatar}" alt="" loading="lazy">
                          <div class="notify-message-block">
                              <span class="notify-message-username "><span class="event-message-content-name-show text-report-body-visible-message showmore-you underline-you"> ${data.list_member[0].full_name}</span></span>
                              <span class="notify-message-text">đã bị mời rời khỏi nhóm</span>
                          </div>
                    </div>
                </div>`)
        }
        let currentMember = $('#data-all-member-visible-message div.row-member').length;
        let countRemoveUser = $('#member-about-visible-message').data('employee');
        $('.header-chat-number_employee').text(countRemoveUser + ' thành viên');
        $('.number-person-about').text(countRemoveUser);
        $('#member-about-visible-message').attr('data-employee', countRemoveUser - 1);
        /**
         * Xóa thành viên khỏi danh sách about
         */
        $('.row-member').each(function (i, v) {
            if (data.list_member[0].member_id == $(this).data('member-id')) {
                $(this).remove();
            }
        })
        /**
         * Xóa thành viên khỏi danh sách tag
         */
        $('.li-tag-event').each(function () {
            if (data.list_member[0].member_id == $(this).data('id')) {
                $(this).remove();
            }
        })
        /**
         * Kiểm tra số thành viên hiển thị about và detail
         */
        if (currentMember > 5) {
            $('#data-member-about-visible-message').html($('#data-all-member-visible-message .row-member:eq(0)')[0].outerHTML + $('#data-all-member-visible-message .row-member:eq(1)')[0].outerHTML + $('#data-all-member-visible-message .row-member:eq(2)')[0].outerHTML + $('#data-all-member-visible-message .row-member:eq(3)')[0].outerHTML + $('#data-all-member-visible-message .row-member:eq(4)')[0].outerHTML);
        }
        (currentMember > 6) ? $('#see-all-member-about').removeClass('d-none') : $('#see-all-member-about').addClass('d-none');
        $('.number-person-about').text(currentMember - 1);
        $('.header-chat-number_employee').text(currentMember - 1 + ' thành viên');
        for (let i = 0; i < dataMemberConversation.length; i++) {
            if (dataMemberConversation[i].member_id == data.list_member[0].member_id) {
                dataMemberConversation.splice(i, 1);
            }
            if (dataMemberConversationTag[i].member_id == data.list_member[0].member_id) {
                dataMemberConversationTag.splice(i, 1);
            }
        }

        renderDataTagVisibleMessage(dataMemberConversationTag)
    })
    /**
     * Có người rời nhóm
     */
    socket.on('res-member-leave-group', async data => {
        console.log('res-member-leave-group', data, idSession);
        if (data.sender.member_id == idSession) {
            $('#data-conversation-visible-message-restaurant .item-conversation-visible-message[data-id="' + data.group_id + '"]').remove();
        } else {
            $('#data-message-visible-message').prepend(`<div class="chat-body-message-element notify-message-container" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}">
                    <div class="notify-message-content">
                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  class="" src="${domainSession + data.sender.avatar}" alt="" loading="lazy">
                        <span class="notify-message-username text-report-body-visible-message showmore-you underline-you"> ${data.list_member[0].full_name}</span>
                        <span class="notify-message-text">đã rời khỏi nhóm</span>
                    </div>
                </div>`)
        }
        let currentMember = $('#data-all-member-visible-message div.row-member').length;
        let countRemoveUser = $('#member-about-visible-message').data('employee');
        $('.header-chat-number_employee').text(countRemoveUser + ' thành viên');
        $('.number-person-about').text(countRemoveUser);
        $('#member-about-visible-message').attr('data-employee', countRemoveUser - 1);
        /**
         * Xóa thành viên khỏi danh sách about
         */
        $('.row-member').each(function (i, v) {
            if (data.list_member[0].member_id == $(this).data('member-id')) {
                $(this).remove();
            }
        })
        /**
         * Xóa thành viên khỏi danh sách tag
         */
        $('.li-tag-event').each(function () {
            if (data.list_member[0].member_id == $(this).data('id')) {
                $(this).remove();
            }
        })
        /**
         * Kiểm tra số thành viên hiển thị about và detail
         */
        if (currentMember > 5) {
            $('#data-member-about-visible-message').html($('#data-all-member-visible-message .row-member:eq(0)')[0].outerHTML + $('#data-all-member-visible-message .row-member:eq(1)')[0].outerHTML + $('#data-all-member-visible-message .row-member:eq(2)')[0].outerHTML + $('#data-all-member-visible-message .row-member:eq(3)')[0].outerHTML + $('#data-all-member-visible-message .row-member:eq(4)')[0].outerHTML);
        }
        (currentMember > 6) ? $('#see-all-member-about').removeClass('d-none') : $('#see-all-member-about').addClass('d-none');
        $('.number-person-about').text(currentMember - 1);
        $('.header-chat-number_employee').text(currentMember - 1 + ' thành viên');
        for (let i = 0; i < dataMemberConversation.length; i++) {
            if (dataMemberConversation[i].member_id == data.list_member[0].member_id) {
                dataMemberConversation.splice(i, 1);
            }
            if (dataMemberConversationTag[i].member_id == data.list_member[0].member_id) {
                dataMemberConversationTag.splice(i, 1);
            }
        }
        renderDataTagVisibleMessage(dataMemberConversationTag)
    })
    /**
     * *********************************** TƯƠNG TÁC VỚI TIN NHẮN *********************************
     */
    /**
     * Có người đang nhập tin nhắn Công ty/Nhà hàng
     */
    socket.on('res-user-is-typing', async data => {
        if (data.member_id !== idSession && data.group_id === idCurrentConversation) {
            if (arrUserTyping.filter(el => el.member_id === data.member_id).length === 0) {
                arrUserTyping.push(data);
            }
            let typing = '';
            switch (arrUserTyping.length) {
                case 1:
                    typing = `<img style="width: 15px; border-radius: 100%" src="${domainSession + arrUserTyping[0].avatar}"/> ` + arrUserTyping[0].name;
                    break;
                case 2:
                    typing = `<img style="width: 15px; border-radius: 100%" src="${domainSession + arrUserTyping[0].avatar}"/> ` + arrUserTyping[0].name + `, <img style="width: 15px; border-radius: 100%" src="${domainSession + arrUserTyping[1].avatar}"/> ` + arrUserTyping[1].name;
                    break;
                default:
                    typing = `<img style="width: 15px; border-radius: 100%" src="${domainSession + arrUserTyping[0].avatar}"/> ` + arrUserTyping[0].name + `, <img style="width: 15px; border-radius: 100%" src="${domainSession + arrUserTyping[1].avatar}"/> ` + arrUserTyping[1].name + `và ${arrUserTyping.length - 1} người nữa`;
                    break;
            }
            $('#typing-data-message-visible-message .content-data-message-visible-message').html(typing + ' đang nhập');
            $('#typing-data-message-visible-message').removeClass('d-none');
        }
    })

    /**
     * Có người đang nhập tin nhắn nhà cung cấp
     */
    socket.on('res-user-is-typing-tms-supplier', async data => {
        if (data.member_id !== idSession && data.group_id === idCurrentConversation) {
            $('#typing-data-message-visible-message').removeClass('d-none');
        }
    })

    /**
     * Người đó ngừng nhập tin nhắn Công ty/Nhà hàng
     */
    socket.on('res-user-is-not-typing', async data => {
        if (data.member_id !== idSession && data.group_id === idCurrentConversation) {
            arrUserTyping = arrUserTyping.filter(el => el.member_id !== data.member_id);
            if (arrUserTyping.length === 0) {
                $('#typing-data-message-visible-message .content-data-message-visible-message').html('');
                $('#typing-data-message-visible-message').addClass('d-none');
            } else {
                let typing = '';
                switch (arrUserTyping.length) {
                    case 1:
                        typing = `<img style="width: 15px; border-radius: 100%" src="${domainSession + arrUserTyping[0].avatar}"/> ` + arrUserTyping[0].name;
                        break;
                    case 2:
                        typing = `<img style="width: 15px; border-radius: 100%" src="${domainSession + arrUserTyping[0].avatar}"/> ` + arrUserTyping[0].name + `, <img style="width: 15px; border-radius: 100%" src="${domainSession + arrUserTyping[1].avatar}"/> ` + arrUserTyping[1].name;
                        break;
                    default:
                        typing = `<img style="width: 15px; border-radius: 100%" src="${domainSession + arrUserTyping[0].avatar}"/> ` + arrUserTyping[0].name + `, <img style="width: 15px; border-radius: 100%" src="${domainSession + arrUserTyping[1].avatar}"/> ` + arrUserTyping[1].name + `và ${arrUserTyping.length - 1} người nữa`;
                        break;
                }
                $('#typing-data-message-visible-message .content-data-message-visible-message').html(typing + ' đang nhập');
            }
        }
    })

    /**
     * Người đó ngừng nhập tin nhắn nhà cung cấp
     */
    socket.on('res-user-is-not-typing-tms-supplier', async data => {
        if (data.member_id !== idSession && data.group_id === idCurrentConversation) {
            $('#typing-data-message-visible-message').addClass('d-none');
        }
    })

    /**
     * Danh sách người đã xem tin nhắn
     */
    socket.on('res-list-message-viewed', async data => {
        console.log('Ai đã xem tin nhắn ta', data);
        if ($('#data-message-visible-message .chat-body-message-element:eq(0)').hasClass('message-right')) {
            $('.user-seen-message').remove();
            let dataMessage = '<div class="user-seen-message"><div class="users-thumb-list">';
            jQuery.each(data, function (i, v) {
                dataMessage += `<a data-toggle="tooltip" data-original-title="${v.full_name}">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" alt="" src="${domainSession + v.avatar}">
                                </a>`;
            });
            dataMessage += '</div></div>';
            $('#data-message-visible-message').prepend(dataMessage);
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover'
            });
        }
    })

    /**
     * Thu hồi tin nhắn Công ty/Nhà hàng
     */
    socket.on('res-revoke-message', async data => {
        console.log('res-revoke-message', data, idSession);
        multiCallFunctionRevokeMessageVisible(data);
    })

    /**
     * Thu hồi tin nhắn nhà cung cấp
     */
    socket.on('res-revoke-message-tms-supplier', async data => {
        console.log('res-revoke-message-tms-supplier', data, idSession);
        multiCallFunctionRevokeMessageVisible(data);
    })

    /**
     * Ghim tin nhắn Công ty/Nhà hàng
     */
    socket.on('res-pinned-message', async data => {
        console.log('res-pinned-message', data, idSession);
        multiCallFunctionPinnedMessageVisible(data)
    })

    /**
     * Ghim tin nhắn nhà cung cấp
     */
    socket.on('res-pinned-message-tms-supplier', async data => {
        console.log('res-pinned-message-tms-supplier', data, idSession);
        multiCallFunctionPinnedMessageVisible(data)
    })

    /**
     * Bỏ ghim tin nhắn Công ty/Nhà hàng
     */
    socket.on('res-revoke-pinned-message', async data => {
        console.log('res-revoke-pinned-message', data);
        multiCallFunctionRevokePinnedMessageVisible(data);
    })

    /**
     * Bỏ ghim tin nhắn nhà cung cấp
     */
    socket.on('res-revoke-pinned-message-tms-supplier', async data => {
        console.log('res-revoke-pinned-message-tms-supplier', data);
        multiCallFunctionRevokePinnedMessageVisible(data);
    })


    /**
     * Reaction Công ty/Nhà hàng
     */
    socket.on('res-reaction-message', async data => {
        console.log('res-reaction-message', data, idSession);
        multiCallFunctionReactionMessageVisible(data)
    })

    /**
     * Reaction nhà cung cấp
     */
    socket.on('res-reaction-message-tms-supplier', async data => {
        console.log('res-reaction-message-tms-supplier', data, idSession);
        multiCallFunctionReactionMessageVisible(data)
    })

    /**
     * Tạo vote
     */
    socket.on('res-create-vote', async data => {
        console.log('res-create-vote', data, idSession);
        showMessageVoteForm(data);
    })

    /**
     * Có người thay đổi option vote
     */
    socket.on('res-add-option-vote/' + idSession, async data => {
        console.log('res-add-option-vote/' + idSession, data, idSession);
        showMessageVoteForm(data);
    })

    /**
     * Có người vote
     */
    socket.on('res-user-vote/' + idSession, async data => {
        console.log('res-user-vote/' + idSession, data, idSession);
        showMessageVoteForm(data);
    })

    /**
     * Vote text
     */
    socket.on('res-vote-message-text', async data => {
        console.log('res-vote-message-text', data, idSession);
        showMessageVoteText(data);
    })

    /**
     * Nhận tin nhắn text
     */
    socket.on('res-chat-text', async data => {
        console.log('res-chat-text', data, idSession);
        if (data.is_important === 1) {
            renderMessageNotify(data);
        } else {
            renderMessageText(data);
        }
    })
    socket.on('res-chat-text-tms-supplier', async data => {
        console.log(data, idSession);
        renderMessageText(data);
    })

    /**
     * Nhận tin nhắn link Công ty/Nhà hàng
     */
    socket.on('res-chat-link', async data => {
        console.log('res-chat-link', data, idSession);
        renderMessageLink(data);
    })

    /**
     * Nhận tin nhắn link nhà cung cấp
     */
    socket.on('res-chat-link-tms-supplier', async data => {
        console.log('res-chat-link-tms-supplier', data, idSession);
        renderMessageLink(data);
    })

    /**
     * Nhận tin nhắn image Công ty/Nhà hàng
     */
    socket.on('res-chat-image', async data => {
        console.log('res-chat-image', data, idSession);
        renderMessageImage(data);
    })

    /**
     * Nhận tin nhắn image nhà cung cấp
     */
    socket.on('res-chat-image-tms-supplier', async data => {
        console.log('res-chat-image-tms-supplier', data, idSession);
        renderMessageImage(data);
    })

    /**
     * Nhận tin nhắn audio Công ty/Nhà hàng
     */
    socket.on('res-chat-audio', async data => {
        console.log('res-chat-audio', data, idSession);
        renderMessageAudio(data)
    })

    /**
     * Nhận tin nhắn audio nhà cung cấp
     */
    socket.on('res-chat-audio-tms-supplier', async data => {
        console.log('res-chat-audio-tms-supplier', data, idSession);
        renderMessageAudio(data)
    })

    /**
     * Nhận tin nhắn video Công ty/Nhà hàng
     */
    socket.on('res-chat-video', async data => {
        console.log('res-chat-video', data, idSession);
        renderMessageVideo(data)
    })

    /**
     * Nhận tin nhắn video nhà cung cấp
     */
    socket.on('res-chat-video-tms-supplier', async data => {
        console.log('res-chat-video-tms-supplier', data, idSession);
        renderMessageVideo(data)
    })

    /**
     * Nhận tin nhắn file Công ty/Nhà hàng
     */
    socket.on('res-chat-file', async data => {
        console.log('res-chat-file', data, idSession);
        renderMessageFile(data)
    })

    /**
     * Nhận tin nhắn file nhà cung cấp
     */
    socket.on('res-chat-file-tms-supplier', async data => {
        console.log('res-chat-file-tms-supplier', data, idSession);
        renderMessageFile(data)
    })

    /**
     * Nhận tin nhắn sticker Công ty/Nhà hàng
     */
    socket.on('res-chat-sticker', async data => {
        console.log('res-chat-sticker', data, idSession);
        renderMessageSticker(data)
    })

    /**
     * Nhận tin nhắn sticker nhà cung cấp
     */
    socket.on('res-chat-sticker-tms-supplier', async data => {
        console.log('res-chat-sticker-tms-supplier', data, idSession);
        renderMessageSticker(data)
    })

    /**
     * Nhận tin nhắn reply Công ty/Nhà hàng
     */
    socket.on('res-chat-reply', async data => {
        console.log('res-chat-reply', data, idSession);
        renderMessageReply(data);
    })

    /**
     * Nhận tin nhắn reply nhà cung cấp
     */
    socket.on('res-chat-reply-tms-supplier', async data => {
        console.log('res-chat-reply-tms-supplier', data, idSession);
        renderMessageReply(data);
    })

    // /**
    //  * Nhận tin nhắn đơn hàng
    //  */
    // socket.on('res-chat-order-tms-supplier', async data => {
    //     console.log('res-chat-order-tms-supplier', data, idSession);
    //     renderMessageOrder(data);
    // })
})


async function countImage(data) {
    for await (const v of data.files) {
        if (v.type === 0 && !v.link_original.includes(domainSession)) v.link_original = domainSession + v.link_original;
    }
    switch (data.files.length) {
        case 1:
            return `<div class="chat-body-message-image">
                        <div class="wrapper one-image">
                            <div class="gallery">
                                <div class="gallery__item gallery__item--1">
                                    <a href="javascript:void(0)" class="gallery__link">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${data.files[0].link_original}" alt="Hình ảnh" class=""  loading="lazy"/>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>`;
        case 2:
            return `<div class="chat-body-message-image">
                    <div class="wrapper two-image">
                        <div class="gallery">
                            <div class="gallery__item gallery__item--1">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${data.files[0].link_original}" alt="Hình ảnh" class=""  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--2">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${data.files[1].link_original}" alt="Hình ảnh" class=""  loading="lazy"/>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>`;
        case 3:
            return `<div class="chat-body-message-image">
                                <div class="wrapper three-image">
                                    <div class="gallery">
                                        <div class="gallery__item gallery__item--1">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="${data.files[0].link_original}" class="gallery__image" loading="lazy">
                                            </a>
                                        </div>
                                        <div class="gallery__item gallery__item--2">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="${data.files[1].link_original}" loading="lazy">
                                            </a>
                                        </div>
                                        <div class="gallery__item gallery__item--3">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="${data.files[2].link_original}" class="gallery__image" loading="lazy">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
        case 4:
            return `<div class="chat-body-message-image" >
                    <div class="wrapper four-image">
                        <div class="gallery">
                            <div class="gallery__item gallery__item--1">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${data.files[0].link_original}" alt="Hình ảnh" class=""  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--2">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${data.files[1].link_original}" alt="Hình ảnh" class=""  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--3">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${data.files[2].link_original}" alt="Hình ảnh" class=""  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--4">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${data.files[3].link_original}" alt="Hình ảnh" class=""  loading="lazy"/>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>`;
        case 5:
            return `<div class="chat-body-message-image" >
                     <div class="wrapper five-image">
                        <div class="gallery">
                             <div class="gallery__item gallery__item--1">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${data.files[0].link_original}" alt="Hình ảnh" class=""  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--2">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${data.files[1].link_original}" alt="Hình ảnh" class=""  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--3">
                                <a href="javascript:void(0)" class="gallery__link">
                                     <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${data.files[2].link_original}" alt="Hình ảnh" class=""  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--4">
                                <a href="javascript:void(0)" class="gallery__link">
                                     <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${data.files[3].link_original}" alt="Hình ảnh" class=""  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--5">
                                <a href="javascript:void(0)" class="gallery__link">
                                     <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${data.files[4].link_original}" alt="Hình ảnh" class=""  loading="lazy"/>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>`;
        default:
            let item = '';
            jQuery.each(data.files.slice(5), function (i, v) {
                item += `<div data-src="${domainSession + v.link_original}"></div>`;
            })
            return `<div class="chat-body-message-image">
                        <div class="wrapper five-image">
                            <div class="gallery">
                                <div class="gallery__item gallery__item--1">
                                   <a href="javascript:void(0)" class="gallery__link">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${data.files[0].link_original}" alt="Hình ảnh" class=""  loading="lazy"/>
                                  </a>
                                </div>
                                <div class="gallery__item gallery__item--2">
                                    <a href="javascript:void(0)" class="gallery__link">
                                       <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${data.files[1].link_original}" alt="Hình ảnh" class=""  loading="lazy"/>
                                    </a>
                                </div>
                                <div class="gallery__item gallery__item--3">
                                    <a href="javascript:void(0)" class="gallery__link">
                                       <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${data.files[2].link_original}" alt="Hình ảnh" class=""  loading="lazy"/>
                                    </a>
                                </div>
                                <div class="gallery__item gallery__item--4">
                                    <a href="javascript:void(0)" class="gallery__link">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${data.files[3].link_original}" alt="Hình ảnh" class=""  loading="lazy"/>
                                    </a>
                                </div>
                                <div class="gallery__item gallery__item--5">
                                    <a href="javascript:void(0)" class="gallery__link">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${data.files[4].link_original}" alt="Hình ảnh" class=""  loading="lazy"/>
                                        <div class="more-photos"><span>+${data.files.length - 5}<span></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="sub-item-image d-none">
                             ${item}
                        </div>
                    </div>`;
    }
}

async function countImageInput(data) {
    switch (data.length) {
        case 1:
            return `<div class="chat-body-message-image" data-number-img="${data.length}">
                        <div class="wrapper one-image">
                            <div class="gallery">
                                <div class="gallery__item gallery__item--1">
                                    <a href="javascript:void(0)" class="gallery__link">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${URL.createObjectURL(data[0])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                    </a>
                                </div>
                            </div>
                        </div>
                   </div>`;
        case 2:
            return `<div class="chat-body-message-image" data-number-img="${data.length}">
                    <div class="wrapper two-image">
                        <div class="gallery">
                            <div class="gallery__item gallery__item--1">
                                <a href="javascript:void(0)" class="gallery__link">
                                  <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" data-name="" src="${URL.createObjectURL(data[0])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--2">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${URL.createObjectURL(data[1])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>`;
        case 3:
            return `<div class="chat-body-message-image" data-number-img="${data.length}">
                                <div class="wrapper three-image">
                                    <div class="gallery">
                                        <div class="gallery__item gallery__item--1">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="${URL.createObjectURL(data[0])}" class="gallery__image" loading="lazy">
                                            </a>
                                        </div>
                                        <div class="gallery__item gallery__item--2">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="${URL.createObjectURL(data[1])}" class="gallery__image" loading="lazy">
                                            </a>
                                        </div>
                                        <div class="gallery__item gallery__item--3">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="${URL.createObjectURL(data[2])}" class="gallery__image" loading="lazy">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
        case 4:
            return `<div class="chat-body-message-image" data-number-img="${data.length}">
                    <div class="wrapper four-image">
                        <div class="gallery">
                            <div class="gallery__item gallery__item--1">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${URL.createObjectURL(data[0])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--2">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${URL.createObjectURL(data[1])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--3">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${URL.createObjectURL(data[2])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--4">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${URL.createObjectURL(data[3])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>`;
        case 5:
            return `<div class="chat-body-message-image" data-number-img="${data.length}">
                     <div class="wrapper five-image">
                        <div class="gallery">
                             <div class="gallery__item gallery__item--1">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${URL.createObjectURL(data[0])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--2">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${URL.createObjectURL(data[1])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--3">
                                <a href="javascript:void(0)" class="gallery__link">
                                     <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${URL.createObjectURL(data[2])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--4">
                                <a href="javascript:void(0)" class="gallery__link">
                                     <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${URL.createObjectURL(data[3])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--5">
                                <a href="javascript:void(0)" class="gallery__link">
                                     <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${URL.createObjectURL(data[4])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>`;
        default:
            let item = '', srcImg = '';
            let srcOfImg = [];
            jQuery.each(data, function (i, v) {
                srcImg = URL.createObjectURL(v);
                item += `<div data-src="${srcImg}"></div>`;
                srcOfImg.push(srcImg);
            });

            return `<div class="chat-body-message-image" data-number-img="${data.length}">
                        <div class="wrapper five-image">
                            <div class="gallery">
                                <div class="gallery__item gallery__item--1">
                                   <a href="javascript:void(0)" class="gallery__link">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${srcOfImg[0]}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                  </a>
                                </div>
                                <div class="gallery__item gallery__item--2">
                                    <a href="javascript:void(0)" class="gallery__link">
                                       <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${srcOfImg[1]}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                    </a>
                                </div>
                                <div class="gallery__item gallery__item--3">
                                    <a href="javascript:void(0)" class="gallery__link">
                                       <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${srcOfImg[2]}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                    </a>
                                </div>
                                <div class="gallery__item gallery__item--4">
                                    <a href="javascript:void(0)" class="gallery__link">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${srcOfImg[3]}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                    </a>
                                </div>
                                <div class="gallery__item gallery__item--5">
                                    <a href="javascript:void(0)" class="gallery__link">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${srcOfImg[4]}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                        <div class="more-photos"><span>+${data.length - 5}<span></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                         <div class="sub-item-image d-none">
                              ${item}
                         </div>
                     </div>`;
    }
}

function convertSizeFile(size) {
    let i = Math.floor(Math.log(size) / Math.log(1024));
    return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
}

function convertImageFile(name) {
    if (!name) return '/images/message/file.png';
    let fileLink  = name;
    name = name.split('.');
    switch (name[name.length - 1]) {
        case 'ai':
            return '/images/message/adobe-illustrator.png';
        case 'apk':
            return '/images/message/apk.png';
        case 'css':
            return '/images/message/css.png';
        case 'disc':
            return '/images/message/disc.png';
        case 'doc':
            return '/images/message/doc.png';
        case 'xls':
        case 'xlsx':
            return '/images/message/excel.png';
        case 'jpeg':
        case 'jpg':
        case 'gif':
        case 'png':
            return domainSession + fileLink;
        case 'iso':
            return '/images/message/iso.png';
        case 'js':
            return '/images/message/js-file.png';
        case 'mp3':
            return '/images/message/music.png';
        case 'pdf':
            return '/images/message/pdf.png';
        case 'php':
            return '/images/message/php.png';
        case 'ppt':
        case 'pptx':
            return '/images/message/ppt.png';
        case 'psd':
            return '/images/message/psd.png';
        case 'sql':
            return '/images/message/sql.png';
        case 'svg':
            return '/images/message/svg.png';
        case 'txt':
            return '/images/message/txt.png';
        case 'mp4':
            return '/images/message/video.png';
        case 'zip':
        case 'rar':
            return '/images/message/zip.png';
        default:
            return '/images/message/file.png';
    }
}

async function replyMessageVisible(db) {
    switch (db.message_reply.message_type) {
        case 2:
            return `<a class="transition-reply" data-id=" ${db.random_key} ">
                        <div class="chat-body-message-item-reply">
                            <div class="chat-body-message-item-reply-image">
                            <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  class="chat-body-message-item-reply-img" src=" ${domainSession + db.message_reply.files[0].link_thumb}" alt="" />
                            </div>
                            <div class="chat-body-message-item-reply-info">
                                <div class="chat-body-message-item-reply-name">
                                    ${db.message_reply.sender.full_name}
                                </div>
                                <div class="chat-body-message-item-reply-type">[Đã gửi ${db.message_reply.files.length} hình ảnh]</div>
                            </div>
                        </div>
                    </a>
                    <div class="chat-body-message-item-reply-text"> ${db.message}</div>`;
        case 5:
            return `<a class="transition-reply" data-id="${db.random_key}">
                        <div class="chat-body-message-item-reply">
                            <div class="chat-body-message-item-reply-image">
                            <img class="chat-body-message-item-reply-img" src="/images/tms/video_icon.svg" alt="" />
                            </div>
                            <div class="chat-body-message-item-reply-info">
                                <div class="chat-body-message-item-reply-name">
                                    ${db.message_reply.sender.full_name}
                                </div>
                                <div class="chat-body-message-item-reply-type">[Đã gửi Video]</div>
                            </div>
                        </div>
                    </a>
                    <div class="chat-body-message-item-reply-text"> ${db.message}</div>`;
        case 3:
            let iconFile = convertImageFile(db.message_reply.files[0].name_file);
            return `<a class="transition-reply" data-id=" ${db.random_key}">
                        <div class="chat-body-message-item-reply">
                            <div class="chat-body-message-item-reply-image">
                            <img class="chat-body-message-item-reply-img" src=" ${iconFile}" alt="" />
                            </div>
                            <div class="chat-body-message-item-reply-info">
                                <div class="chat-body-message-item-reply-name">
                                    ${db.message_reply.sender.full_name}
                                </div>
                                <div class="chat-body-message-item-reply-type">[Đã gửi File]</div>
                            </div>
                        </div>
                    </a>
                    <div class="chat-body-message-item-reply-text"> ${db.message}</div>`;
        case 4:
            return `<a class="transition-reply" data-id="${db.random_key}">
                        <div class="chat-body-message-item-reply">
                            <div class="chat-body-message-item-reply-image">
                            <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  class="chat-body-message-item-reply-img" src=" ${domainSession + db.message_reply.message}" alt="" />
                            </div>
                            <div class="chat-body-message-item-reply-info">
                                <div class="chat-body-message-item-reply-name">
                                     ${db.message_reply.sender.full_name}
                                </div>
                                <div class="chat-body-message-item-reply-type">[Đã gửi Sticker]</div>
                            </div>
                        </div>
                    </a>
                    <div class="chat-body-message-item-reply-text"> ${db.message}</div>`;
        case 6:
            return `<a class="transition-reply" data-id="${db.random_key}">
                        <div class="chat-body-message-item-reply">
                            <div class="chat-body-message-item-reply-image">
                            <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  class="chat-body-message-item-reply-img" src="/images/tms/audio.png" alt="" />
                            </div>
                            <div class="chat-body-message-item-reply-info">
                                <div class="chat-body-message-item-reply-name">
                                     ${db.message_reply.sender.full_name}
                                </div>
                                <div class="chat-body-message-item-reply-type">[Đã gửi Ghi âm]</div>
                            </div>
                        </div>
                    </a>
                    <div class="chat-body-message-item-reply-text"> ${db.message}</div>`;
        default:
            for await (const v of db.message_reply.list_tag_name) {
                db.message_reply.message = db.message_reply.message.replace(v.key_tag_name, `<span class="tag-name">@${v.full_name}</span>`);
            }
            return `<a class="transition-reply" data-id=" ${db.random_key}">
                        <div class="chat-body-message-item-reply">
                            <div class="chat-body-message-item-reply-info">
                                <div class="chat-body-message-item-reply-name">
                                     ${db.message_reply.sender.full_name}
                                </div>
                                <div class="chat-body-message-item-reply-type"> ${db.message_reply.message}</div>
                            </div>
                        </div>
                    </a>
                    <div class="chat-body-message-item-reply-text">${db.message}</div>`;
    }
}

function showMessageVoteText(data) {
    if (data.message_vote.title.length > 50) data.message_vote.title = data.message_vote.title.slice(0, 47) + '...<i class="f-16 fa fa-comment-o text-inverse"></i>';
    let user = (data.sender.member_id === idSession) ? `<span class="event-message-content-name showmore underline">Bạn</span>` : `<span class="notify-message-username text-report-body-visible-message showmore-you underline-you">${data.sender.full_name}</span>`;
    $('#data-message-visible-message').prepend(`<div class="chat-body-message-element notify-message-container" id="${data.random_key}" data-position="1" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}">
                                                            <div class="notify-message-content">
                                                                 <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  class="" src="${domainSession + data.sender.avatar}" alt="" loading="lazy">
                                                                 ${user}
                                                                 <span class="notify-message-text">${data.message_vote.message}</span>
                                                                 <span class="event-vote-message-content-name" onclick="openModalDetailVoteVisibleMessage(${data.random_key_message_vote})">${data.message_vote.title}</span>
                                                            </div>
                                                        </div>`);
}

function showMessageVoteForm(data) {
    $('#data-message-visible-message .chat-body-message-element[id="' + data.random_key + '"]').remove();
    data.message_vote.list_option = data.message_vote.list_option.filter(item => item.id !== -1);
    let classTextVote = 'd-none', textVote = '';
    if (data.message_vote.list_option.length > 2) {
        classTextVote = '';
        textVote = '* Còn ' + (data.message_vote.list_option.length - 2) + ' lựa chọn khác';
    }
    $('#data-message-visible-message').prepend(`<div class="chat-body-message-element notify-message-container" id="${data.random_key}" data-position="1" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}">
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

function showLastMessageConversation(type, data) {
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


