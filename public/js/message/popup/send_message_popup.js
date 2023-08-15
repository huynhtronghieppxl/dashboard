    /**
     * Nhấn nút like
     */
    $(document).on('click','#chat-footer-like',function (){
        sendLikeContentMessagePopup();
    })

    /**
     * Nhấn enter để gửi tin nhắn
     */
    $(document).on('keypress','.chat-footer-message-input',function (e){
        if (e.keyCode == 13) {
            if($(".chat-footer-message-input").text() !== ''){
                if ($('.layout-reply-input-popup-message').hasClass('d-none')) {
                    if (listLinkInputPopup.length === 0) {
                        sendTextMessagePopup();
                    } else {
                        sendLinkPopupMessage();
                    }
                }
                else {
                    sendReplyPopupMessage();
                }
                $('.chat-footer-message-input').empty();
                $('#chat-body-message-popup').scrollTop(0);
            }
            e.preventDefault();
        }
    });

    let loveReactionPopup = '<img class="react-icon m-auto" src="/images/message/love.gif" loading="lazy"/>',
        hahaReactionPopup = '<img class="react-icon m-auto" src="/images/message/haha.gif" loading="lazy"/>',
        likeReactionPopup = '<img class="react-icon m-auto" src="/images/message/like.gif" loading="lazy"/>',
        sadReactionPopup = '<img class="react-icon m-auto" src="/images/message/sad.gif" loading="lazy"/>',
        angryReactionPopup = '<img class="react-icon m-auto" src="/images/message/angry.gif" loading="lazy"/>',
        wowReactionPopup = '<img class="react-icon m-auto" src="/images/message/wow.gif" loading="lazy"/>';
    let dataMediaImageCurrentPopup = [], dataMediaVideoCurrentPopup = [], dataMediaFileCurrentPopup = [];
    let imageThumbLinkPopup;

$(function () {
    /**
     * Gửi text
     */
    $(document).on('click', '#chat-footer-send', function () {
        if ($('.chat-footer-message-input').text() !== "") {
            if ($('.layout-reply-input-popup-message').hasClass('d-none')) {
                if (listLinkInputPopup.length === 0) {
                    sendTextMessagePopup();
                } else {
                    sendLinkPopupMessage();
                }
            } else {
                sendReplyPopupMessage();
            }
            $('.chat-footer-message-input').empty();
        } else {
            $('.chat-footer-message-input').empty();
        }
        $('#chat-body-message-popup').scrollTop(0);
    })

    /**
     *  Gửi ảnh
     */
    $(document).on('click', '#item-option-footer-popup-image', async function(){
        $('#chat-footer-option-image').unbind('click').click();
    });

    $(document).on('change', '#chat-footer-option-image',async function () {
        for await (const v of $(this).prop('files')) {
            dataMediaImageCurrentPopup.push(v);
        }
        sendImagePopupMessage();

        $(this).replaceWith($(this).val('').clone(true));
        $('#chat-body-message-popup').scrollTop(0);
        $('.list-option-footer-popup').addClass('d-none');
    });

    /**
     * Gửi sticker
     */
    $(document).on('click', '#chat-popup-layout .item-sticker-visible-message', function () {
        $('.sticker-input-visible-message').addClass('d-none');
        $('#input-sticker-icon-message-popup').removeClass('active');
        let key = 'key-identification-' + moment().format('x');
        $('#chat-body-message-popup').prepend(`<div class="chat-body-message-element message-right" id="" data-position="" data-id="" data-random-key="" data-identification="${key}" data-type="4" data-name="" data-sender="">
                                                        <div class="chat-body-message">
                                                            <div class="chat-body-message-sticker">
                                                                <img  onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  src="${domainSession + $(this).find('img').data('src')}" alt="Sticker">
                                                            </div>
                                                             ${footerMessage(idSession, moment().format('DD/MM/YYYY HH:mm:ss'))}
                                                        </div>
                                                    </div>`);
        sendStickerPopupMessage($(this).data('id'), $(this).find('img').data('src'), key);
        $('#chat-body-message-popup').scrollTop(0);
    });

    /**
     * Gửi video
     */
    $(document).on('change','#chat-footer-option-video', async function () {
        let file = $(this).prop('files')[0];
        let fileReader = new FileReader();
        fileReader.onload = async function () {
            let blob = new Blob([fileReader.result], {type: file.type});
            let url = URL.createObjectURL(blob);
            let video = document.createElement('video');
            let timeupdate = function () {
                if (snapImage()) {
                    video.removeEventListener('timeupdate', timeupdate);
                    video.pause();
                }
            };
            video.addEventListener('loadeddata', function () {
                if (snapImage()) {
                    video.removeEventListener('timeupdate', timeupdate);
                }
            });
            let snapImage = async function () {
                let canvas = document.createElement('canvas');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                let image = canvas.toDataURL("image/png");
                let res = await uploadMediaTemplate(dataURLtoFile(image), 0);
                file.thumb = res.data[0];
                sendVideoPopupMessage(file);
                $('#input-video-message').replaceWith($('#input-video-message').val('').clone(true));
                $('#data-message-visible-message').scrollTop(0);
            };
            video.addEventListener('timeupdate', timeupdate);
            video.preload = 'metadata';
            video.src = url;
            video.muted = true;
            video.playsInline = true;
            video.play();
        };
        fileReader.readAsArrayBuffer(file);
    })

    /**
     * Gửi reaction
     */
    $(document).on('click', '#chat-body-message-popup .reactionss-emoji-img', function () {
        let element = $(this).parents('.chat-body-message-element');
        sendReactionPopupMessage(element.data('random-key'), $(this).data('id'));
        (element.find('.total-reacts').text() === '99') ? element.find('.total-reacts').text('99+') : element.find('.total-reacts').text(parseInt(element.find('.total-reacts').text()) + 1);
        element.find('.reacts-list').removeClass('d-none');
        if (element.find('.total-reacts') === "0") {
            element.find('.total-reacts').text('1');
            switch (parseInt($(this).data('id'))) {
                case 1: //love
                    element.find('.react-icon-list').append(loveReactionPopup);
                    element.find('.chat-body-message-item-reactions-group').html(loveReactionPopup);
                    break;
                case 2: //smile
                    element.find('.react-icon-list').append(hahaReactionPopup);
                    element.find('.chat-body-message-item-reactions-group').html(hahaReactionPopup);
                    break;
                case 3: //like
                    element.find('.react-icon-list').append(likeReactionPopup);
                    element.find('.chat-body-message-item-reactions-group').html(likeReactionPopup);
                    break;
                case 4: //sad
                    element.find('.react-icon-list').append(sadReactionPopup);
                    element.find('.chat-body-message-item-reactions-group').html(sadReactionPopup);
                    break;
                case 5: //angry
                    element.find('.react-icon-list').append(angryReactionPopup);
                    element.find('.chat-body-message-item-reactions-group').html(angryReactionPopup);
                    break;
                case 6: //wow
                    element.find('.react-icon-list').append(wowReactionPopup);
                    element.find('.chat-body-message-item-reactions-group').html(wowReactionPopup);
                    break;
            }
        } else {
            switch (parseInt($(this).data('id'))) {
                case 1: //love
                    element.find('.react-icon-list').data('love', element.find('.react-icon-list').data('love') + 1);
                    element.find('.chat-body-message-item-reactions-group').html(loveReactionPopup);
                    break;
                case 2: //smile
                    element.find('.react-icon-list').data('smile', element.find('.react-icon-list').data('smile') + 1);
                    element.find('.chat-body-message-item-reactions-group').html(hahaReactionPopup);
                    break;
                case 3: //like
                    element.find('.react-icon-list').data('like', element.find('.react-icon-list').data('like') + 1);
                    element.find('.chat-body-message-item-reactions-group').html(likeReactionPopup);
                    break;
                case 4: //sad
                    element.find('.react-icon-list').data('sad', element.find('.react-icon-list').data('sad') + 1);
                    element.find('.chat-body-message-item-reactions-group').html(sadReactionPopup);
                    break;
                case 5: //angry
                    element.find('.react-icon-list').data('angry', element.find('.react-icon-list').data('angry') + 1);
                    element.find('.chat-body-message-item-reactions-group').html(angryReactionPopup);
                    break;
                case 6: //wow
                    element.find('.react-icon-list').data('wow', element.find('.react-icon-list').data('wow') + 1);
                    element.find('.chat-body-message-item-reactions-group').html(wowReactionPopup);
                    break;
            }
            let arr = [
                {
                    content: loveReactionPopup,
                    quantity: element.find('.react-icon-list').data('love')
                },
                {
                    content: hahaReactionPopup,
                    quantity: element.find('.react-icon-list').data('smile')
                },
                {
                    content: likeReactionPopup,
                    quantity: element.find('.react-icon-list').data('like')
                },
                {
                    content: sadReactionPopup,
                    quantity: element.find('.react-icon-list').data('sad')
                },
                {
                    content: angryReactionPopup,
                    quantity: element.find('.react-icon-list').data('angry')
                },
                {
                    content: wowReactionPopup,
                    quantity: element.find('.react-icon-list').data('wow')
                }];
            arr = arr.sort((a, b) => a.quantity - b.quantity).reverse().slice(0, 3);
            arr = arr.filter(item => item.quantity !== 0);
            let content = arr.map(function (item) {
                return item.content;
            });
            element.find('.react-icon-list').html(content.join(""));
        }
    });

    /**
     * Gửi file
     */
    $(document).on('click', '#item-option-footer-popup-file', async function(){
        $('#chat-footer-option-file').unbind('click').click();
    });

    $(document).on('change', '#chat-footer-option-file', async function () {
        for await (const v of $(this).prop('files')) {
            dataMediaFileCurrentPopup.push(v);
        }
        sendFilePopupMessage();
        // }
        $(this).replaceWith($(this).val('').clone(true));
        $('#chat-body-message-popup').scrollTop(0);
    })

    /**
     * Gửi audio
     */
    $('#send-audio-input-popup-message').click(async function () {
        let second = (sizeAudio + 1000) / 1000;
        let minute = Math.floor(second / 60);
        let time = second - minute * 60;
        let timeAudio = '';
        if (time < 10) {
            timeAudio = `0${minute}:0${time}`
        } else {
            timeAudio = `0${minute}:${time}`
        }
        let key = 'key-identification-' + moment().format('x');
        $('#chat-body-message-popup').prepend(`<div class="chat-body-message-element message-right" id="" data-position="" data-id="" data-random-key="" data-identification="${key}" data-type="6" data-name="" data-sender="${idSession}">
                                                        <div class="chat-body-message">
                                                        <div class="chat-body-message-audio">
                                            <div class="sound-container">
                                                <div class="sound-container-progress">
                                                    <div class="audio-wrapper random"> <!-- add class animation -->
                                                        <div class="bar-1"></div>
                                                        <div class="bar-2"></div>
                                                        <div class="bar-3"></div>
                                                        <div class="bar-4"></div>
                                                        <div class="bar-5"></div>
                                                        <div class="bar-6"></div>
                                                        <div class="bar-7"></div>
                                                    </div>
                                                </div>
                                                <i class="icon-dowload-about-visible-message ti-download download-audio" data-toggle="tooltip" data-placement="top" data-original-title="Tải xuống">
                                                    <a href="${domainSession + fileAudioPopup[0].link_original}" download>
                                                </i>
                                            </div>
                                                <div   class="sound-container-time sound-duration-time">
                                                    00:00
                                                </div>
                                                 <div   class=" sound-resutl-time">
                                                     ${timeAudio}
                                                </div>
                                                <div class="play-audio-body-message">
                                                     <a  title="Play" class="sound-container-play" data-audio="${audioSrc}" >
                                                        <i  class="fa fa-play play-audio-btn"></i>
                                                        <i class="fa fa-stop stop-audio-btn d-none"></i>
                                                    </a>
                                               <div class="progress">
                                                    <div class="currentValue" style="width: 100%;"></div>
                                                </div>
                                                </div>
                                        </div>
                                         ${footerMessage(idSession, moment().format('DD/MM/YYYY HH:mm:ss'))}
                                                        </div>
                                                    </div>`);
        $('#turn-off-record-popup-message').addClass('d-none');
        $('#send-audio-input-popup-message').addClass('d-none');
        $('#timer').text('00:00');
        sendAudioPopupMessage(fileAudioPopup, key);
        $('#chat-body-message-popup').scrollTop(0);
    })

    /**
     * Thu hồi tin nhắn
     */
    $(document).on('click', '#chat-body-message-popup .item-action-revoke', function () {
        let element = $(this).parents('.chat-body-message-element');
        let key = 'key-identification-' + moment().format('x');
        sendRevokePopupMessage(element.data('random-key'), key);
        element.find('.chat-body-message').html('<div class="chat-body-message-revoke">Tin nhắn đã thu hồi</div>');
    });

    /**
     * Ghim tin nhắn
     */
    $(document).on('click', '#chat-popup-layout .item-action-pin', function () {
        let require = 1;
        let thisTargetContentPin = $(this),
            idthisTargetContentPin = thisTargetContentPin.parents('.chat-body-message-element').attr('id');
        $('#get-pinned-list-popup-message .pin-details-content-item-visible-message').each(function (i, e) {
            if ($(this).attr('data-random-key') == idthisTargetContentPin) {
                require = 0;
                return false;
            }
        });
        if(require == 1) {
            $('#pin-visible-message').removeClass('d-none');
            let type = $(this).parents('.chat-body-message-element').data('type'),
                name = $(this).parents('.chat-body-message-element').data('name');
            $('#pin-visible-message .pin-visible-message-img').addClass('d-none');
            switch (type) {
                case 2:
                    $('#pin-visible-message .pin-visible-message-img').attr('src', $(this).parents('.chat-body-message-element').find('.chat-body-message-image img').attr('src'));
                    $('#pin-visible-message .pin-visible-message-img').removeClass('d-none');
                    $('#pin-visible-message .pin-visible-message-name').text(name);
                    $('#pin-visible-message .pin-visible-message-text').text('[Đã ghim hình ảnh]');
                    break;
                case 3:
                    $('#pin-visible-message .pin-visible-message-img').attr('src', $(this).parents('.chat-body-message-element').find('.chat-body-message-file img').attr('src'));
                    $('#pin-visible-message .pin-visible-message-img').removeClass('d-none');
                    $('#pin-visible-message .pin-visible-message-name').text(name);
                    $('#pin-visible-message .pin-visible-message-text').text('[Đã ghim File]');
                    break;
                case 4:
                    $('#pin-visible-message .pin-visible-message-img').attr('src', $(this).parents('.chat-body-message-element').find('.chat-body-message-sticker img').attr('src'));
                    $('#pin-visible-message .pin-visible-message-img').removeClass('d-none');
                    $('#pin-visible-message .pin-visible-message-name').text(name);
                    $('#pin-visible-message .pin-visible-message-text').text('[Đã ghim Sticker]');
                    break;
                case 5:
                    $('#pin-visible-message .pin-visible-message-img').attr('src', $(this).parents('.chat-body-message-element').find('.chat-body-message-video img').attr('src'));
                    $('#pin-visible-message .pin-visible-message-img').removeClass('d-none');
                    $('#pin-visible-message .pin-visible-message-name').text(name);
                    $('#pin-visible-message .pin-visible-message-text').text('[Đã ghim Video]');
                    break;
                case 6:
                    $('#pin-visible-message .pin-visible-message-img').attr('src', '/images/tms/audio.png');
                    $('#pin-visible-message .pin-visible-message-img').removeClass('d-none');
                    $('#pin-visible-message .pin-visible-message-name').text(name);
                    $('#pin-visible-message .pin-visible-message-text').text('[Đã ghim Ghim âm]');
                    break;
                default:
                    $('#pin-visible-message .pin-visible-message-img').attr('src', '');
                    $('#pin-visible-message .pin-visible-message-name').text(name);
                    $('#pin-visible-message .pin-visible-message-text').text($(this).parents('.chat-body-message-element').find('.chat-body-message-text').text());
                    break;
            }
            let key = 'key-identification-' + moment().format('x');
            sendPinPopupMessage($(this).parents('.chat-body-message-element').data('random-key'), key);
            $('#chat-body-message-popup').prepend(`<div class="chat-body-message-element notify-message-container" id="" data-position="" data-identification="${key}">
                    <div class="notify-message-content">
                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  class="chat-body-message-item-pin-img" src="${domainSession + avatarSession}" alt="" />
                        <div class="notify-message-block">
                            <span  class="notify-message-username showmore underline"><span class="event-message-content-name showmore underline">Bạn</span> </span>
                            <span class="notify-message-text">đã ghim tin nhắn</span>
                            <i class="event-message-content-info-icon typcn typcn-pin"></i>
                        </div>
                    </div>
                </div>`);
        }
    });

    /**
     * Bỏ ghim tin nhắn
     */
    $(document).on('click', '#chat-popup-layout .item-action-revoke-pin', async function (){
        let title = 'Xác nhận bỏ tin nhắn ghim ?',
            content = '',
            icon = 'question';
        sweetAlertComponent(title, content, icon).then(async (result) => {
            if (result.value) {
                let key = 'key-identification-' + moment().format('x');
                await sendRevokePinPopupMessage($(this).parents('.pin-details-content-item-visible-message').data('random-key'), key)
                $('#chat-body-message-popup').prepend(`<div class="chat-body-message-element notify-message-container">
                    <div class="notify-message-content">
                        <img onerror="imageDefaultOnLoadError($(this))" class="chat-body-message-item-pin-img" src="" alt="" />
                        <div class="notify-message-block">
                            <span class="notify-message-username showmore underline"><span class="event-message-content-name showmore underline">Bạn</span></span>
                            <span class="notify-message-text">đã bỏ ghim tin nhắn</span>
                            <i class="event-message-content-info-icon icofont icofont-ban"></i>
                        </div>
                    </div>
                </div>`)
                $(this).parent().remove();
                SuccessNotify('Đã gỡ tin nhắn được ghim!');
            }
        })
    })

    /**
     * Gửi tin nhắn đơn hàng
     */
    $(document).on('click', '#chat-popup-layout .action-send-card-order-message', function (){
        let r = $(this);
        if (typeCurrentConversationPopup === 3) {
            let data = {
                member_id: idSession,
                app_name: "tms",
                group_id: idCurrentConversation,
                group_id_tms_supplier: idCurrentConversation,
                message_order: {
                    code: r.data('code'),
                    total: r.data('amount'),
                    order_id: r.data('id'),
                    order_status: r.data('status'),
                    supplier_id: supplierCurrentConversationPopup,
                    message_type: 1,
                    order_time_delivery: r.data('time'),
                    message: "Đơn hàng",
                    files: [],
                    list_tag_name: [],
                },
                message_type: 25,

            };
            console.log('chat-order-tms-supplier', data);
            socket.emit('chat-order-tms-supplier', data);
            // $('#show-order-message').removeClass('active');
            // $('.order-input-visible-message').addClass('d-none');
        } else {
            let data = {
                random_key: id.toString(),
                member_id: idSession,
                group_id: idCurrentConversation,
                message_type: 13,
                key_message_error: key,

            };
            console.log('pinned-message', data);
            socket.emit('pinned-message', data);
        }
    })
})
    /**
     *  ================================== FUNCTION_TODO_WORK =================================
     */

    /**
     * Gửi nút like
     */
    async function sendLikeContentMessagePopup() {
        let key = 'key-identification-' + moment().format('x'),
            html = `<div class="chat-body-message-element message-right" id="" data-position="" data-id="" data-random-key="" data-identification="${key}" data-type="" data-name="" data-sender="">
                                                                    <div class="chat-body-message" style="background-color: #e2f1fa !important;">
                                                                         <div class="chat-body-message-image" style="width: 165px;height: 120px;">
                                                                                <div class="gallery__item">
                                                                                <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="https://beta.api.gateway.overate-vntech.com/short/P64iYOtlt8FbnvXIA-mxj" alt="Hình ảnh" style="width: 145px;height: 110px;margin:10px" class="gallery__image"  loading="lazy"/>
                                                                                </div>
                                                                        </div>
                                                                        ${footerMessage(idSession, moment().format('DD/MM/YYYY HH:mm:ss'))}
                                                                    </div>
                                                            </div>`;
        $('.chat-form:first #chat-body-message-popup').prepend(html);
        $('#chat-body-message-popup').scrollTop(0);
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            files: [{
                "link_thumb": 'https://beta.api.gateway.overate-vntech.com/short/P64iYOtlt8FbnvXIA-mxj',
                "type": 1,
                "width": 300,
                "height": 300,
                "ratio": 1,
                "link_original": 'https://beta.api.gateway.overate-vntech.com/short/P64iYOtlt8FbnvXIA-mxj',
                "name_file": 'icon_like',
                "size": '20kb'
            }],
            message_type: 2,
            key_message_error: key
        };
        console.log('chat-image', data);
        socket.emit('chat-image', data);
    }

    /**
     * Gửi tin nhắn text
     */
    async function sendTextMessagePopup() {
        messageInputPopupMessage = $('.chat-footer-message-input').html().replaceAll('<br>',' \n ');
        let key = 'key-identification-' + moment().format('x');
        let dataRender = {
            list_tag_name: listTagInputPopupMessage,
            list_link: listLinkInputPopup,
            message: messageInputPopupMessage,
            random_key: '',
            _id: '',
            message_type: '',
            key_message_error: key,
            sender: {
                member_id: idSession,
                full_name: nameSession,
                avatar: avatarSession,
            },
            created_at: moment().format('YYYY/MM/DD HH:mm:ss')
        }
        renderMessageTextPopup(dataRender);
        if (typeCurrentConversationPopup === 3) {
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                group_id_tms_supplier: idCurrentConversation,
                code: '',
                message: messageInputPopupMessage,
                message_type: 1,
                list_tag_name: listTagInputPopupMessage,
                key_message_error: key
            };
            socket.emit('chat-text-tms-supplier', data);
        } else {
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                message: messageInputPopupMessage,
                message_type: 1,
                list_tag_name: listTagInputPopupMessage,
                key_message_error: key
            };
            socket.emit('chat-text', data);
        }
        messageInputPopupMessage = '';
        listTagInputPopupMessage = [];
        $('.chat-footer-message-input').html('');
        eventInputTypePopupMessage();
    }

    /** Tin nhắn video **/
    async function sendVideoPopupMessage(data) {
        let key = 'key-identification-' + moment().format('x');
        if (checkIdEmpty(idCurrentConversation, idSession)) return false;
        $('#chat-body-message-popup').prepend(`<div class="chat-body-message-element message-right" id="" data-position="" data-id="" data-random-key="" data-identification="${key}" data-type="" data-name="" data-sender="">
                <div class="chat-body-message">
                    <div class="chat-body-message-video">
                        <div class="chat-message-video-content">
                            <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  src="${domainSession + data.thumb}" data-video="${URL.createObjectURL(data)}" loading="lazy">
                            <video class="video-after-img d-none" controls>
                                <source src="${URL.createObjectURL(data)}"/>
                            </video>
                            <i class="play-video-to-link-btn" onclick="viewVideoPopup($(this))">
                                <svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" height="50px" width="50px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" fill="#000" xml:space="preserve">
                                    <path class="stroke-solid" fill="none" stroke=""
                                            d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
                                                                    C97.3,23.7,75.7,2.3,49.9,2.5"/>
                                    <path class="icon" fill="#fff" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z" />
                                </svg>
                            </i>
                        </div>
                    </div>
                        ${footerMessage(idSession, moment().format('DD/MM/YYYY HH:mm:ss'))}
                </div>
        </div>`);
        let res = await uploadMediaTemplate(data, 0);
        let file = [{
            "link_thumb": data.thumb,
            "link_thumb_video": data.thumb,
            "type": 1,
            "width": 300,
            "height": 300,
            "ratio": 1,
            "link_original": res.data[0],
            "name_file": data.name,
            "size": data.size
        }]
        if (typeCurrentConversation === 3) {
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                group_id_tms_supplier: idCurrentConversation,
                code: '',
                files: file,
                message_type: 5,
                app_name: 'tms',
                key_message_error: key
            };
            socket.emit('chat-video-tms-supplier', data);
        } else {
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                files: file,
                message_type: 5,
                key_message_error: key
            };
            socket.emit('chat-video', data);
        }
        return false;
        for await(const v of dataMediaVideoCurrent) {
            let key = 'key-identification-' + moment().format('x');
            if (checkIdEmpty(idCurrentConversation, idSession)) return false;
            $('#data-message-visible-message').prepend(`<div class="chat-body-message-element message-right" id="" data-position="" data-id="" data-random-key="" data-identification="${key}" data-type="" data-name="" data-sender="">
                <div class="chat-body-message">
                    <div class="chat-body-message-video">
                        <div class="chat-message-video-content">
                            <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  src="${imageThumbLink}" data-video="${URL.createObjectURL(v)}" loading="lazy">
                            <i class="play-video-to-link-btn" onclick="viewVideo($(this))">
                                <svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" height="50px" width="50px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" fill="#000" xml:space="preserve">
                                    <path class="stroke-solid" fill="none" stroke=""
                                            d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
                                                                    C97.3,23.7,75.7,2.3,49.9,2.5"/>
                                    <path class="icon" fill="#fff" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z" />
                                </svg>
                            </i>
                        </div>
                    </div>
                        ${footerMessage(idSession, moment().format('DD/MM/YYYY HH:mm:ss'))}
                </div>
        </div>`);
            let res = await uploadMediaTemplate(v, 0);
            let file = [{
                "link_thumb": res.data[1],
                "link_thumb_video": res.data[1],
                "type": 1,
                "width": 300,
                "height": 300,
                "ratio": 1,
                "link_original": res.data[0],
                "name_file": v.name,
                "size": v.size
            }]
            dataMediaVideoCurrent = [];
            if (typeCurrentConversation === 3) {
                let data = {
                    member_id: idSession,
                    group_id: idCurrentConversation,
                    group_id_tms_supplier: idCurrentConversation,
                    code: '',
                    files: file,
                    message_type: 5,
                    app_name: 'tms',
                    key_message_error: key
                };
                socket.emit('chat-video-tms-supplier', data);
            } else {
                let data = {
                    member_id: idSession,
                    group_id: idCurrentConversation,
                    files: file,
                    message_type: 5,
                    key_message_error: key
                };
                socket.emit('chat-video', data);
            }
        }
    }


    /**
     * Gửi ảnh
     */
    async function sendImagePopupMessage() {
        let dataImage = [], imageMedia = [];
        for await (const v of $('.item-media-input-visible-message.item-image img.image-paste')) {
            imageMedia.push(dataURLtoFile($(v).attr('src')));
        }
        console.log(imageMedia);
        dataMediaImageCurrentPopup = dataMediaImageCurrentPopup.concat(imageMedia);
        let imageSocket = await countImageInputPopup(dataMediaImageCurrentPopup), key = 'key-identification-' + moment().format('x');
        $('#chat-body-message-popup').prepend(`<div class="chat-body-message-element message-right" id="" data-position="" data-id="" data-random-key="" data-identification="${key}" data-type="2" data-name="" data-sender="">
                                                                    <div class="chat-body-message">
                                                                        ${imageSocket}
                                                                        ${footerMessage(idSession, moment().format('DD/MM/YYYY HH:mm:ss'))}
                                                                    </div>
                                                            </div>`);
        let size = (dataMediaImageCurrentPopup.length > 0) ? await displayPreviewPopup(dataMediaImageCurrentPopup[0]) : '';
        for await(const v of dataMediaImageCurrentPopup) {
            if (v.size <= 5 * 1024 * 1024) {
                let res = await uploadMediaTemplate(v, 0);
                dataImage.push({
                    "link_thumb": res.data[1],
                    "type": 0,
                    "width": size.width,
                    "height": size.height,
                    "ratio": size.width / size.height,
                    "link_original": res.data[0],
                    "name_file": v.name,
                    "size": v.size
                })
            }
        }
        dataMediaImageCurrentPopup = [];
        if (typeCurrentConversationPopup === 3) {
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                group_id_tms_supplier: idCurrentConversation,
                code: "",
                files: dataImage,
                message_type: 2,
                app_name: 'tms',
                key_message_error: key
            };
            console.log('chat-image-tms-supplier', data);
            socket.emit('chat-image-tms-supplier', data);
        }
        else {
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                files: dataImage,
                message_type: 2,
                key_message_error: key
            };
            console.log('chat-image', data);
            socket.emit('chat-image', data);
        }
    }


    /**
     * Gửi sticker
     */
    async function sendStickerPopupMessage(id, src, key) {
        if (typeCurrentConversationPopup === 3) {
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                group_id_tms_supplier: idCurrentConversation,
                code: '',
                sticker_id: id,
                message_type: 4,
                message: src,
                app_name: 'tms',
                key_message_error: key
            };
            console.log('chat-sticker-tms-supplier', data);
            socket.emit('chat-sticker-tms-supplier', data);
        }
        else {
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                sticker_id: id,
                message_type: 4,
                message: src,
                key_message_error: key
            };
            socket.emit('chat-sticker', data);
        }
    }

    /**
     * Gửi tin nhắn dạng link
     */
    async function sendLinkPopupMessage() {
        messageInputPopupMessage = $('.chat-footer-message-input').text();
        // if ($('#input-message-visible-message').find('span').hasClass('dx-mention')) {
        //     for (const member of listTagInputPopupMessage) {
        //         messageInputPopupMessage = messageInputPopupMessage.replace(`@${member.full_name}`, member.key_tag_name);
        //     }
        // } else {
        listTagInputPopupMessage = [];
        keyTagName = '';
        // }
        let key = 'key-identification-' + moment().format('x');
        let dataRender = {
            list_tag_name: listTagInputPopupMessage,
            message: messageInputPopupMessage,
            random_key: '',
            _id: '',
            message_type: '',
            key_message_error: key,
            message_link: {
                media_thumb: $('#image-thumbnail-preview-popup').attr('src'),
                cannonical_url: $('#link-thumbnail-preview-popup').attr('src'),
                title: $('#title-thumbnail-preview-popup').text(),
                favicon: $('#image-thumbnail-preview-popup').attr('src'),
                description: $('#link-thumbnail-preview-popup').attr('src'),
            },
            list_link: listLinkInputPopup,
            sender: {
                member_id: idSession,
                full_name: nameSession,
                avatar: avatarSession,
            },
            created_at: moment().format('YYYY/MM/DD HH:mm:ss')
        }
        renderMessageLinkPopup(dataRender);
        if(typeCurrentConversationPopup === 3){
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                group_id_tms_supplier: idCurrentConversation,
                code: '',
                message: messageInputPopupMessage,
                message_link: {
                    media_thumb: $('#image-thumbnail-preview-popup').attr('src'),
                    cannonical_url: $('#link-thumbnail-preview-popup').attr('src'),
                    title: $('#title-thumbnail-preview-popup').text(),
                    favicon: $('#image-thumbnail-preview-popup').attr('src'),
                    description: $('#link-thumbnail-preview-popup').attr('src'),
                },
                message_type: 8,
                app_name: 'tms',
                key_message_error: key
            };
            socket.emit('chat-link-tms-supplier', data);
        }
        else {
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                message: messageInputPopupMessage,
                list_tag_name: listTagInputPopupMessage,
                message_link: {
                    media_thumb: $('#image-thumbnail-preview-popup').attr('src'),
                    cannonical_url: $('#link-thumbnail-preview-popup').attr('src'),
                    title: $('#title-thumbnail-preview-popup').text(),
                    favicon: $('#image-thumbnail-preview-popup').attr('src'),
                    description: $('#link-thumbnail-preview-popup').attr('src'),
                },
                list_link: listLinkInputPopup,
                message_type: 8,
                key_message_error: key
            };
            socket.emit('chat-link', data);
        }
        listLinkInputPopup = [];
        $('.layout-preview-input-popup-message').addClass('d-none');
        $('#image-thumbnail-preview-popup').attr('src', '');
        $('#title-thumbnail-preview-popup').text('');
        $('#text-link-thumbnail-preview-popup').text('');
        $('#link-thumbnail-preview-popup').attr('src', '');
        messageInputPopupMessage = '';
        listTagInputPopupMessage = [];
        $('.chat-footer-message-input').text('');

    }


    /**
     * Thả cảm xúc tin nhắn
     */
    async function sendReactionPopupMessage(id, reaction) {
        if(typeCurrentConversationPopup === 3){
            let data = {
                last_reactions_id: idSession,
                last_reactions: reaction,
                member_id: idSession,
                group_id: idCurrentConversation,
                group_id_tms_supplier: idCurrentConversation,
                key_message_error: '',
                code: '',
                random_key: id.toString(),
            };
            socket.emit('reaction-message-tms-supplier', data);
        }
        else {
            let data = {
                last_reactions_id: idSession,
                last_reactions: reaction,
                member_id: idSession,
                group_id: idCurrentConversation,
                group_id_tms_supplier: "",
                key_message_error: '',
                random_key: id.toString(),
            };
            socket.emit('reaction-message', data);
        }
    }

    function footerMessage(id, time) {
        let action = (id === idSession) ? `<li class="chat-body-message-item-action-item item-action-revoke">
                                           <i class="chat-body-message-item-action-icon ion-refresh"></i>
                                       </li>
                                       <li class="chat-body-message-item-action-item item-action-reply">
                                            <i class="chat-body-message-item-action-icon ion-quote"></i>
                                       </li>
                                       <li class="chat-body-message-item-action-item item-action-pin">
                                            <i class="chat-body-message-item-action-icon ion-pin"></i>
                                       </li>` :
            `<li class="chat-body-message-item-action-item item-action-reply">
                <i class="chat-body-message-item-action-icon ion-quote"></i>
            </li>
            <li class="chat-body-message-item-action-item item-action-pin">
                <i class="chat-body-message-item-action-icon ion-pin"></i>
            </li>`;
        return `<div class="chat-body-message-footer">
                            <ul class="chat-body-message-item-action-list d-none">${action}</ul>
                            <div class="chat-body-message-item-reactions">
                                <div class="chat-body-message-item-reactions-group reactions-group-icon">
                                    <i class="chat-body-message-item-reactions-icon fa fa-thumbs-o-up"></i>
                                </div>
                                <div class="emoji-container">
                                    <div class="reactionss-emoji-boder">
                                        <div class="reactionss-emoji-img circle like" data-id="3"></div>
                                    </div>
                                    <div class="reactionss-emoji-boder">
                                        <div class="reactionss-emoji-img circle love" data-id="1"></div>
                                    </div>
                                    <div class="reactionss-emoji-boder">
                                        <div class="reactionss-emoji-img circle haha" data-id="2"></div>
                                    </div>
                                    <div class="reactionss-emoji-boder">
                                        <div class="reactionss-emoji-img circle wow" data-id="6"></div>
                                    </div>
                                    <div class="reactionss-emoji-boder">
                                        <div class="reactionss-emoji-img circle sad" data-id="4"></div>
                                    </div>
                                    <div class="reactionss-emoji-boder">
                                        <div class="reactionss-emoji-img circle angry" data-id="5"></div>
                                    </div>
                                    <i class="reactions-close icofont icofont-close d-none"></i>
                                </div>
                            </div>
                            <div class="chat-body-message-status-send d-none">
                                <i class="chat-body-message-sending-icon fa fa-check-circle-o"></i>
                                <i class="chat-body-message-send-icon fa fa-check-circle d-none"></i>
                            </div>
                            <div class="reacts-list-content">
                                <div class="reacts-list d-none">
                                   <div class="react-icon-list" data-love="0" data-smile="0" data-like="0" data-angry="0" data-sad="0" data-wow="0"></div>
                                   <div class="total-reacts">0</div>
                                </div>
                            </div>
                            <span class="time-message-ago" data-time="${time}">${time.slice(11, 16)}</span>
                        </div>`;
    }

    /**
     * Thu hồi tin nhắn
     */
    async function sendRevokePopupMessage(id, key) {
        if(typeCurrentConversationPopup === 3){
            let data = {
                random_key: id.toString(),
                member_id: idSession,
                group_id: idCurrentConversation,
                group_id_tms_supplier: idCurrentConversation,
                code: '',
                message_type: 9,
                key_message_error: key,
            };
            console.log('revoke-message-tms-supplier', data);
            socket.emit('revoke-message-tms-supplier', data);
        }
        else {
            let data = {
                random_key: id.toString(),
                member_id: idSession,
                group_id: idCurrentConversation,
                position_message_revoke: -1,
                message_type: 9,
                key_message_error: key,
            };
            console.log('revoke-messagee', data);
            socket.emit('revoke-message', data);
        }
    }

    /**
     * Ghim tin nhắn
     */
    async function sendPinPopupMessage(id, key) {
        if(typeCurrentConversationPopup === 3){
            let data = {
                random_key: id.toString(),
                member_id: idSession,
                group_id: idCurrentConversation,
                group_id_tms_supplier: idCurrentConversation,
                message_type: 13,
                key_message_error: key,
                code: '',
                app_name: 'tms'
            };
            console.log('pinned-message-tms-supplier', data);
            socket.emit('pinned-message-tms-supplier', data);
        }
        else {
            let data = {
                random_key: id.toString(),
                member_id: idSession,
                group_id: idCurrentConversation,
                message_type: 13,
                key_message_error: key,

            };
            console.log('pinned-messagee', data);
            socket.emit('pinned-message', data);
        }
    }

    /**
     * Bỏ ghim tin nhắn
     */
    async function sendRevokePinPopupMessage(id, key) {
        if(typeCurrentConversationPopup === 3){
            let data = {
                random_key: id.toString(),
                member_id: idSession,
                group_id: idCurrentConversation,
                group_id_tms_supplier: idCurrentConversation,
                message_type: 11,
                key_message_error: key,
                code: '',
                app_name: 'tms'
            };
            console.log('revoke-pinned-message-tms-supplier', data);
            socket.emit('revoke-pinned-message-tms-supplier', data);
        }
        else {
            let data = {
                random_key: id.toString(),
                member_id: idSession,
                group_id: idCurrentConversation,
                message_type: 11,
                key_message_error: key,
            };
            console.log('revoke-pinned-message', data);
            socket.emit('revoke-pinned-message', data);
        }
    }

    /**
     * Gửi tin nhắn file
     */
    async function sendFilePopupMessage() {
        for (const v of dataMediaFileCurrentPopup) {
            let res = await uploadMediaTemplate(v, 0);
            let key = 'key-identification-' + v.name + moment().format('x'),
                iconFile = convertImageFilePopup(v.name),
                sizeFile = convertSizeFilePopup(v.size),
                fileName = v.name.split('.').slice(0, -1).join('.');
            $('#chat-body-message-popup').prepend(`<div class="chat-body-message-element message-right" id="" data-position="" data-id="" data-random-key="" data-identification="${key}" data-type="3" data-name="${v.name}" data-sender="" >
            <div class="chat-body-message">
                   <div class="chat-body-message-file">
                           <a href="${domainSession + res.data[0]}" download>
                             <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="chat-message-file-icon-image" src=" ${iconFile}" loading="lazy"/>
                           </a>
                           <div class="chat-message-file-content">
                                <div class="chat-message-file-action">
                                    <span class="chat-message-file-name">${fileName}</span>
                                    <span>${sizeFile}</span>
                                </div>
                                <i id="download-files-visible-message" class="ti-download icon-download-file"></i>
                           </div>
                   </div>
                ${footerMessage(idSession, moment().format('DD/MM/YYYY HH:mm:ss'))}
            </div>
      </div> `);
            if(typeCurrentConversationPopup === 3){
                let data = {
                    member_id: idSession,
                    group_id: idCurrentConversation,
                    group_id_tms_supplier: idCurrentConversation,
                    code: '',
                    files: [{
                        "link_thumb": res.data[1],
                        "link_original": res.data[0],
                        "name_file": res.data[3],
                        "type": 0,
                        "size": v.size,
                    }],
                    message_type: 3,
                    app_name: "tms",
                    key_message_error: key
                };
                dataMediaFileCurrentPopup = []
                console.log('chat-file-tms-supplier', data)
                socket.emit('chat-file-tms-supplier', data);
            }
            else {
                let data = {
                    member_id: idSession,
                    group_id: idCurrentConversation,
                    files: [{
                        "link_thumb": res.data[1],
                        "link_original": res.data[0],
                        "name_file": res.data[3],
                        // fileName
                        "size": v.size,
                    }],
                    message_type: 3,
                    key_message_error: key
                };
                dataMediaFileCurrentPopup = []
                console.log('chat-file', data)
                socket.emit('chat-file', data);
            }
        }
    }

    /**
     * Tin nhắn audio
     */
    async function sendAudioPopupMessage(file, key) {
        if(typeCurrentConversationPopup === 3){
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                group_id_tms_supplier: idCurrentConversation,
                code: '',
                files: file,
                message_type: 6,
                app_name: 'tms',
                key_message_error: key
            };
            console.log('chat-audio-tms-supplier', data);
            socket.emit('chat-audio-tms-supplier', data);
        }
        else {
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                files: file,
                message_type: 6,
                key_message_error: key
            };
            console.log('chat-audio', data);
            socket.emit('chat-audio', data);
        }
    }

    /**
     * Reply tin nhắn
     */
    async function sendReplyPopupMessage() {
        eventInputTypePopupMessage();
        messageInputPopupMessage = $('.chat-footer-message-input').text();
        // if ($('#input-message-visible-message').find('span').hasClass('dx-mention')) {
        //     for (const member of listTagInputPopupMessage) {
        //         messageInputPopupMessage = messageInputPopupMessage.replace(`@${member.full_name}`, member.key_tag_name);
        //     }
        // } else {
        listTagInputPopupMessage = [];
        // keyTagName = '';
        // }
        let key = 'key-identification-' + moment().format('x');
        let classImage = 'd-none';
        let message = messageInputPopupMessage;
        for await (const v of listTagInputPopupMessage) {
            message = message.replace(v.key_tag_name, `<span class="tag-name">@${v.full_name}</span>`);
        }

        if (['2', '3', '4', '5'].includes($('.layout-reply-input-popup-message').attr('data-type'))) classImage = '';

        $('#chat-body-message-popup').prepend(`<div class="chat-body-message-element message-right" id="" data-position="" data-id="" data-random-key="" data-identification="${key}" data-type="" data-name="" data-sender="">
                                                        <div class="chat-body-message">
                                                            <a class="transition-reply" data-id="${$('.layout-reply-input-popup-message').data('id')}">
                                                                <div class="chat-body-message-item-reply">
                                                                    <div class="chat-body-message-item-reply-image ${classImage}">
                                                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  class="chat-body-message-item-reply-img" src="${$('.img-thumbnail-link-input-popup-message').attr('src')}" alt="" />
                                                                    </div>
                                                                    <div class="chat-body-message-item-reply-info">
                                                                        <div class="chat-body-message-item-reply-name">${$('#name-reply-name-popup').text()}</div>
                                                                        <div class="chat-body-message-item-reply-type">${$('.footer-text-input-thumbnail-reply-popup-message').text()}</div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <div class="chat-body-message-item-reply-text">${message}</div>
                                                             ${footerMessage(idSession, moment().format('DD/MM/YYYY HH:mm:ss'))}
                                                        </div>
                                                    </div>`);
        if(typeCurrentConversationPopup === 3){
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                group_id_tms_supplier: idCurrentConversation,
                code: '',
                message: messageInputPopupMessage,
                random_key: $('.layout-reply-input-popup-message').attr('data-random-key').toString(),
                message_type: 7,
                list_tag_name: listTagInputPopupMessage,
                app_name: 'tms',
                key_message_error: key,
            };
            console.log('chat-reply-tms-supplier', data);
            socket.emit('chat-reply-tms-supplier', data);
        }
        else {
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                message: messageInputPopupMessage,
                random_key: $('.layout-reply-input-popup-message').attr('data-random-key').toString(),
                message_type: 7,
                list_tag_name: listTagInputPopupMessage,
                key_message_error: key,
                position_image_reply: 1,
            };
            console.log('chat-reply', data);
            socket.emit('chat-reply', data);
        }

        $('.layout-reply-input-popup-message').attr('data-type', '');
        $('.img-thumbnail-link-input-popup-message').attr('src', '');
        $('#name-reply-name-popup').text('');
        $('.footer-text-input-thumbnail-reply-popup-message').text('');
        $('.layout-reply-input-popup-message').addClass('d-none');
        $('.layout-reply-input-popup-message').data('id', '');
        listTagInputPopupMessage = [];
        messageInputPopupMessage = '';
        $('.chat-footer-message-input').html('');
        eventInputTypePopupMessage();
    }


async function countImagePopup(data) {
        let styleBoxImageLike = '',styleContentImageLike = '';
        for await (const v of data.files) {
            if (v.type === 0 && !v.link_original.includes(domainSession)) v.link_original = domainSession + v.link_original;
        }
        switch (data.files.length) {
            case 1:
                if(data.files[0].name_file == 'icon_like') {
                    styleBoxImageLike = 'width: 165px;height: 120px;';
                    styleContentImageLike = 'width: 110px;height: 75px;margin-left: 30px;margin-top: 30px;';
                }
                return `<div class="chat-body-message-image" style="${styleBoxImageLike}">
                    <div class="wrapper one-image">
                        <div class="gallery">
                            <div class="gallery__item gallery__item--1">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img style="${styleContentImageLike}" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${data.files[0].link_original}" alt="Hình ảnh" class=""  loading="lazy"/>
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
                jQuery.each(data.files.slice(5), function (_i, v) {
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
                                        <div class="more-photos"><span>  ${data.files.length - 5}<span></div>
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

    async function countImageInputPopup(data) {
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

    function displayPreviewPopup(data) {
        const img = document.createElement("img");
        const promise = new Promise((resolve, reject) => {
            img.onload = async function () {
                const width = img.naturalWidth;
                const height = img.naturalHeight;
                resolve({
                    width: width,
                    height: height
                });
            };
            img.onerror = reject;
        });
        img.src = URL.createObjectURL(data);
        return promise;
    }

    async function replyMessagePopup(db) {
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
                let iconFile = convertImageFilePopup(db.message_reply.files[0].name_file);
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

    function convertImageFilePopup(name) {
        if (!name) return '/images/message/file.png';
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
                return '/images/message/image.png';
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

    function convertSizeFilePopup(size) {
        let i = Math.floor(Math.log(size) / Math.log(1024));
        return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
    }

    /** convert base64 to url **/
    function dataURLtoFile(dataUrl) {
        let arr = dataUrl.split(','),
            mime = arr[0].match(/:(.*?);/)[1],
            suffix = mime.split('/').at(1),
            bstr = atob(arr[1]),
            n = bstr.length,
            u8arr = new Uint8Array(n);
        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }
        return new File([u8arr], dataUrl.slice(-5) + moment().format('x') + '.' + suffix, {type: mime});
    }


    /** Function check lỗi truyền rỗng group id và member id **/
    function checkIdEmpty(idGroup, idMember) {
        if (idGroup === "" || idMember === "") {
            Swal.fire({
                icon: 'error',
                title: 'Có lỗi khi gửi tin nhắn',
                text: '',
            })
            return 1;
        } else {
            console.log(idGroup, idMember, "data not empty");
            return 0;
        }
    }

    function checkEmptyMessageId(idGroup, idMember, idMessage) {
        if (idGroup === "" || idMember === "" || idMessage === "") {
            console.log("idGroup or idMember is empty");
            return 1;
        } else {
            console.log(idGroup, idMember, "data not empty");
            return 0;
        }
    }
