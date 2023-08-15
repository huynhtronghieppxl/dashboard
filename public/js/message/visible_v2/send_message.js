let loveReaction = '<img class="react-icon m-auto" src="/images/message/love.gif" loading="lazy"/>',
    hahaReaction = '<img class="react-icon m-auto" src="/images/message/haha.gif" loading="lazy"/>',
    likeReaction = '<img class="react-icon m-auto" src="/images/message/like.gif" loading="lazy"/>',
    sadReaction = '<img class="react-icon m-auto" src="/images/message/sad.gif" loading="lazy"/>',
    angryReaction = '<img class="react-icon m-auto" src="/images/message/angry.gif" loading="lazy"/>',
    wowReaction = '<img class="react-icon m-auto" src="/images/message/wow.gif" loading="lazy"/>';
let dataMediaImageCurrent = [], dataMediaVideoCurrent = [], dataMediaFileCurrent = [];
let imageThumbLink;
$(function () {
    /**
     * Gửi text
     */
    $('#button-send-message-visible-message').on('click', function (e) {
        if ($('#input-message-visible-message').find('.ql-editor.dx-htmleditor-content p').text() !== "") {
            if ($('.layout-reply-input-visible-message').hasClass('d-none')) {
                // if ($('.layout-send-notify-visible-message').hasClass('d-none')) {
                if (listLinkInput.length === 0) {
                    sendTextVisibleMessage();
                } else {
                    sendLinkVisibleMessage();
                }
                if ($('#count-image-input-visible-message').is(':visible')) {
                    sendImageVisibleMessage();
                }
                $('#input-message-visible-message').find('.ql-editor.dx-htmleditor-content p').empty();
                // }
                // else {
                //     sendNotifyVisibleMessage();
                // }

            } else {
                sendReplyVisibleMessage();
                $('#input-message-visible-message').find('.ql-editor.dx-htmleditor-content p').empty();
            }
            $('.icon-like-input-visible-message').removeClass('d-none');
            $('.icon-send-visible-message').addClass('d-none');
        } else {
            if ($('#count-image-input-visible-message').is(':visible')) {
                sendImageVisibleMessage();
            }
            else {
                $('#input-message-visible-message').find('.ql-editor.dx-htmleditor-content p').empty();
                $('#input-message-visible-message').find('.ql-editor.dx-htmleditor-content p:last-child').remove();
                return false;
            }
        }

        if ($('#count-video-input-visible-message').is(':visible')) sendVideoVisibleMessage();
        if ($('#count-file-input-visible-message').is(':visible')) sendFileVisibleMessage();
        $('.layout-media-input-visible-message').addClass('d-none');
        $('.layout-media-input-visible-message .count-image').addClass('d-none');
        $('.layout-media-input-visible-message .count-video').addClass('d-none');
        $('.layout-media-input-visible-message .count-file').addClass('d-none');
        $('.layout-send-notify-visible-message').addClass('d-none')
        $('.notify-visible-message').removeClass('active');
        $('.layout-media-input-visible-message .list-media').empty();
        $('#count-image-input-visible-message').text('0');
        $('#count-video-input-visible-message').text('0');
        $('#count-file-input-visible-message').text('0');
        $('.dx-htmleditor-content').addClass('ql-blank');
        $('.icon-close-thumbnail-image-close-reply , .icon-close-thumbnail-link-visible-message').click()
        sizeBodyMessageThumbnail();
        $('#data-message-visible-message').scrollTop(0);
    })
    /**
     *  Gửi ảnh
     */
    $(document).on('change','#input-image-message, #input-image-message-about', async function () {
        if ($('.layout-media-input-visible-message').is(':visible')) {
            for await (const v of $(this).prop('files')) {
                dataMediaImageCurrent.push(v);
                $('.layout-media-input-visible-message .list-media').append(`
                                        <div class="item-media-input-visible-message item-image">
                                            <span class="remove-item-media-input-visible-message"><i
                                                    class="typcn typcn-times"></i></span>
                                            <div class="image-item-media-input-visible-message">
                                                <img src="${URL.createObjectURL(v)}" alt="">
                                            </div>
                                        </div>`);
            }
            let countImage = ($('.layout-media-input-visible-message .item-media-input-visible-message.item-image').length > 99) ? '99+' : $('.layout-media-input-visible-message .item-media-input-visible-message.item-image').length;
            $('.layout-media-input-visible-message .count-image').removeClass('d-none');
            $('#count-image-input-visible-message').text(countImage);
            sizeBodyMessageThumbnail();
        } else {
            for await (const v of $(this).prop('files')) {
                dataMediaImageCurrent.push(v);
            }
            sendImageVisibleMessage();
        }
        $(this).replaceWith($(this).val('').clone(true));
        $('#data-message-visible-message').scrollTop(0);
    })
    /**
     * Gửi video
     */
    $(document).on('change','#input-video-message, #input-video-message-about', async function () {
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
                canvas.width = 300;
                canvas.height =300;
                canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                let image = canvas.toDataURL("image/png");
                file.thumb=image
                sendVideoVisibleMessage(file);
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
     * Gửi file
     */
    $(document).on('change','#input-file-message, #input-file-message-about', async function () {
        if ($('.layout-media-input-visible-message').is(':visible')) {
            for await (const v of $(this).prop('files')) {
                dataMediaFileCurrent.push(v);
                let iconFile = convertImageFile(dataMediaFileCurrent.name);
                $('.layout-media-input-visible-message .list-media').append(`
                                        <div class="item-media-input-visible-message item-file">
                                            <span class="remove-item-media-input-visible-message"><i
                                                    class="typcn typcn-times"></i></span>
                                            <div class="image-item-media-input-visible-message">
                                                <img src="${iconFile}" alt="">
                                                <p>${v.name}</p>
                                            </div>
                                        </div>`);
            }
            let countFile = ($('.layout-media-input-visible-message .item-media-input-visible-message.item-file').length > 99) ? '99+' : $('.layout-media-input-visible-message .item-media-input-visible-message.item-file').length;
            $('.layout-media-input-visible-message .count-file').removeClass('d-none');
            $('#count-file-input-visible-message').text(countFile);
            sizeBodyMessageThumbnail();
        } else {
            for await (const v of $(this).prop('files')) {
                dataMediaFileCurrent.push(v);
            }
            sendFileVisibleMessage();
        }
        $(this).replaceWith($(this).val('').clone(true));
        $('#data-message-visible-message').scrollTop(0);
    });
    /**
     * Gửi sticker
     */
    $(document).on('click', '#main-visible-message .item-sticker-visible-message', function () {
        $('.sticker-input-visible-message').addClass('d-none');
        $('.icon-sticker-footer-visible-message').removeClass('active');
        let key = 'key-identification-' + moment().format('x');
        $('#data-message-visible-message').prepend(`<div class="chat-body-message-element message-right" id="" data-position="" data-id="" data-random-key="" data-identification="${key}" data-type="4" data-name="" data-sender="">
                                                        <div class="chat-body-message">
                                                            <div class="chat-body-message-sticker">
                                                                <img  onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  src="${domainSession + $(this).find('img').data('src')}" alt="Sticker">
                                                            </div>
                                                             ${footerMessage(idSession, moment().format('DD/MM/YYYY HH:mm:ss'))}
                                                        </div>
                                                    </div>`);
        sendStickerVisibleMessage($(this).data('id'), $(this).find('img').data('src'), key);
        $('#data-message-visible-message').scrollTop(0);
    })
    /**
     * Gửi audio
     */
    $('#send-audio-input-visible-message').click(async function () {
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
        $('#data-message-visible-message').prepend(`<div class="chat-body-message-element message-right" id="" data-position="" data-id="" data-random-key="" data-identification="${key}" data-type="6" data-name="" data-sender="${idSession}">
                                                        <div class="chat-body-message">
                                                        <div class="chat-body-message-audio">
                                            <div class="chat-audio-header d-flex align-items-center">
                                                    <a title="Play" class="sound-container-play" data-audio="${domainSession + fileAudio[0].link_original}">
                                                        <i class="fa fa-play-circle play-audio-btn"></i>
                                                        <i class="fa fa-pause stop-audio-btn d-none"></i>
                                                    </a>
                                                    <div class="chat-audio-name">${domainSession + fileAudio[0].name_file}</div>
                                                    <div class="see-item-image-video-grid-download audio btn-download-file-upload">
                                                        <i class="fa fa-download" data-download="${domainSession + fileAudio[0].link_original}" data-name-file="${domainSession + fileAudio[0].name_file}"></i>
                                                    </div>
                                                </div>
                                                <div class="play-audio-body-message">
                                                    <div class="sound-container-time sound-duration-time">00:00</div>
                                                    <div class="progress">
                                                        <div class="currentValue" style="width: 100%;">
                                                            <div class="media-fixed-progress-bar-dot"></div>
                                                        </div>
                                                    </div>
                                                    <div class="sound-resutl-time">${timeAudio}</div>
                                                </div>
                                        </div>
                                         ${footerMessage(idSession, moment().format('DD/MM/YYYY HH:mm:ss'))}
                                                        </div>
                                                    </div>`);
        $('#turn-off-record-visible-message').addClass('d-none');
        $('#send-audio-input-visible-message').addClass('d-none');
        $('#timer').text('00:00');
        sendAudioVisibleMessage(fileAudio, key);
        $('#data-message-visible-message').scrollTop(0);
    })
    /**
     * Gửi reaction
     */
    $(document).on('click', '.reactionss-emoji-img', function () {
        let element = $(this).parents('.chat-body-message-element');
        sendReactionVisibleMessage(element.data('random-key'), $(this).data('id'));
        (element.find('.total-reacts').text() === '99' || element.find('.total-reacts').text() === '99+') ? element.find('.total-reacts').text('99+') : element.find('.total-reacts').text(parseInt(element.find('.total-reacts').text()) + 1);
        element.find('.reacts-list').removeClass('d-none');
        if (element.find('.total-reacts') === "0") {
            element.find('.total-reacts').text('1');
            switch (parseInt($(this).data('id'))) {
                case 1: //love
                    element.find('.react-icon-list').append(loveReaction);
                    element.find('.chat-body-message-item-reactions-group').html(loveReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 1);
                    break;
                case 2: //smile
                    element.find('.react-icon-list').append(hahaReaction);
                    element.find('.chat-body-message-item-reactions-group').html(hahaReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 2);
                    break;
                case 3: //like
                    element.find('.react-icon-list').append(likeReaction);
                    element.find('.chat-body-message-item-reactions-group').html(likeReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 3);
                    break;
                case 4: //sad
                    element.find('.react-icon-list').append(sadReaction);
                    element.find('.chat-body-message-item-reactions-group').html(sadReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 4);
                    break;
                case 5: //angry
                    element.find('.react-icon-list').append(angryReaction);
                    element.find('.chat-body-message-item-reactions-group').html(angryReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 5);
                    break;
                case 6: //wow
                    element.find('.react-icon-list').append(wowReaction);
                    element.find('.chat-body-message-item-reactions-group').html(wowReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 6);
                    break;
            }
        } else {
            switch (parseInt($(this).data('id'))) {
                case 1: //love
                    element.find('.react-icon-list').data('love', element.find('.react-icon-list').data('love') + 1);
                    element.find('.chat-body-message-item-reactions-group').html(loveReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 1);
                    break;
                case 2: //smile
                    element.find('.react-icon-list').data('smile', element.find('.react-icon-list').data('smile') + 1);
                    element.find('.chat-body-message-item-reactions-group').html(hahaReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 2);
                    break;
                case 3: //like
                    element.find('.react-icon-list').data('like', element.find('.react-icon-list').data('like') + 1);
                    element.find('.chat-body-message-item-reactions-group').html(likeReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 3);
                    break;
                case 4: //sad
                    element.find('.react-icon-list').data('sad', element.find('.react-icon-list').data('sad') + 1);
                    element.find('.chat-body-message-item-reactions-group').html(sadReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 4);
                    break;
                case 5: //angry
                    element.find('.react-icon-list').data('angry', element.find('.react-icon-list').data('angry') + 1);
                    element.find('.chat-body-message-item-reactions-group').html(angryReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 5);
                    break;
                case 6: //wow
                    element.find('.react-icon-list').data('wow', element.find('.react-icon-list').data('wow') + 1);
                    element.find('.chat-body-message-item-reactions-group').html(wowReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 6);
                    break;
            }
            let arr = [
                {
                    content: loveReaction,
                    quantity: element.find('.react-icon-list').data('love')
                },
                {
                    content: hahaReaction,
                    quantity: element.find('.react-icon-list').data('smile')
                },
                {
                    content: likeReaction,
                    quantity: element.find('.react-icon-list').data('like')
                },
                {
                    content: sadReaction,
                    quantity: element.find('.react-icon-list').data('sad')
                },
                {
                    content: angryReaction,
                    quantity: element.find('.react-icon-list').data('angry')
                },
                {
                    content: wowReaction,
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

    $(document).on('click', '.chat-body-message-item-reactions-group', function () {
        let element = $(this).parents('.chat-body-message-element');
        sendReactionVisibleMessage(element.data('random-key'), $(this).data('id'));
        (element.find('.total-reacts').text() === '99' || element.find('.total-reacts').text() === '99+') ? element.find('.total-reacts').text('99+') : element.find('.total-reacts').text(parseInt(element.find('.total-reacts').text()) + 1);
        element.find('.reacts-list').removeClass('d-none');
        if (element.find('.total-reacts') === "0") {
            element.find('.total-reacts').text('1');
            switch (parseInt($(this).data('id'))) {
                case 1: //love
                    element.find('.react-icon-list').append(loveReaction);
                    element.find('.chat-body-message-item-reactions-group').html(loveReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 1);
                    break;
                case 2: //smile
                    element.find('.react-icon-list').append(hahaReaction);
                    element.find('.chat-body-message-item-reactions-group').html(hahaReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 2);
                    break;
                case 3: //like
                    element.find('.react-icon-list').append(likeReaction);
                    element.find('.chat-body-message-item-reactions-group').html(likeReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 3);
                    break;
                case 4: //sad
                    element.find('.react-icon-list').append(sadReaction);
                    element.find('.chat-body-message-item-reactions-group').html(sadReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 4);
                    break;
                case 5: //angry
                    element.find('.react-icon-list').append(angryReaction);
                    element.find('.chat-body-message-item-reactions-group').html(angryReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 5);
                    break;
                case 6: //wow
                    element.find('.react-icon-list').append(wowReaction);
                    element.find('.chat-body-message-item-reactions-group').html(wowReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 6);
                    break;
            }
        } else {
            switch (parseInt($(this).data('id'))) {
                case 1: //love
                    element.find('.react-icon-list').data('love', element.find('.react-icon-list').data('love') + 1);
                    element.find('.chat-body-message-item-reactions-group').html(loveReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 1);
                    break;
                case 2: //smile
                    element.find('.react-icon-list').data('smile', element.find('.react-icon-list').data('smile') + 1);
                    element.find('.chat-body-message-item-reactions-group').html(hahaReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 2);
                    break;
                case 3: //like
                    element.find('.react-icon-list').data('like', element.find('.react-icon-list').data('like') + 1);
                    element.find('.chat-body-message-item-reactions-group').html(likeReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 3);
                    break;
                case 4: //sad
                    element.find('.react-icon-list').data('sad', element.find('.react-icon-list').data('sad') + 1);
                    element.find('.chat-body-message-item-reactions-group').html(sadReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 4);
                    break;
                case 5: //angry
                    element.find('.react-icon-list').data('angry', element.find('.react-icon-list').data('angry') + 1);
                    element.find('.chat-body-message-item-reactions-group').html(angryReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 5);
                    break;
                case 6: //wow
                    element.find('.react-icon-list').data('wow', element.find('.react-icon-list').data('wow') + 1);
                    element.find('.chat-body-message-item-reactions-group').html(wowReaction);
                    element.find('.chat-body-message-item-reactions-group').data('id', 6);
                    break;
            }
            let arr = [
                {
                    content: loveReaction,
                    quantity: element.find('.react-icon-list').data('love')
                },
                {
                    content: hahaReaction,
                    quantity: element.find('.react-icon-list').data('smile')
                },
                {
                    content: likeReaction,
                    quantity: element.find('.react-icon-list').data('like')
                },
                {
                    content: sadReaction,
                    quantity: element.find('.react-icon-list').data('sad')
                },
                {
                    content: angryReaction,
                    quantity: element.find('.react-icon-list').data('angry')
                },
                {
                    content: wowReaction,
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
     * Thu hồi tin nhắn
     */
    $(document).on('click', '#data-message-visible-message .item-action-revoke', function () {
        let element = $(this).parents('.chat-body-message-element');
        sendRevokeVisibleMessage(element.data('random-key'));
        element.find('.chat-body-message').html('<div class="chat-body-message-revoke">Tin nhắn đã thu hồi</div>');
    });
    /**
     * Ghim tin nhắn
     */
    $(document).on('click', '#main-visible-message .item-action-pin', function () {
        let require = 1;
        let thisTargetContentPin = $(this),
            idthisTargetContentPin = thisTargetContentPin.parents('.chat-body-message-element').attr('id');
        $('.pin-details-content-about-visible-message .pin-details-content-item-visible-message').each(function (i, e) {
            if ($(this).attr('data-random-key') == idthisTargetContentPin) {
                require = 0;
                return false;
            }
        });
        if (require == 1) {
            $('#pin-visible-message').removeClass('d-none');
            let type = thisTargetContentPin.parents('.chat-body-message-element').data('type'),
                name = thisTargetContentPin.parents('.chat-body-message-element').data('name');
            $('#pin-visible-message .pin-visible-message-img').addClass('d-none');
            switch (type) {
                case 2:
                    $('#pin-visible-message .pin-visible-message-img').attr('src', thisTargetContentPin.parents('.chat-body-message-element').find('.chat-body-message-image img').attr('src'));
                    $('#pin-visible-message .pin-visible-message-img').removeClass('d-none');
                    $('#pin-visible-message .pin-visible-message-name').text(name);
                    $('#pin-visible-message .pin-visible-message-text').text('[Đã ghim hình ảnh]');
                    break;
                case 3:
                    $('#pin-visible-message .pin-visible-message-img').attr('src', thisTargetContentPin.parents('.chat-body-message-element').find('.chat-body-message-file img').attr('src'));
                    $('#pin-visible-message .pin-visible-message-img').removeClass('d-none');
                    $('#pin-visible-message .pin-visible-message-name').text(name);
                    $('#pin-visible-message .pin-visible-message-text').text('[Đã ghim File]');
                    break;
                case 4:
                    $('#pin-visible-message .pin-visible-message-img').attr('src', thisTargetContentPin.parents('.chat-body-message-element').find('.chat-body-message-sticker img').attr('src'));
                    $('#pin-visible-message .pin-visible-message-img').removeClass('d-none');
                    $('#pin-visible-message .pin-visible-message-name').text(name);
                    $('#pin-visible-message .pin-visible-message-text').text('[Đã ghim Sticker]');
                    break;
                case 5:
                    $('#pin-visible-message .pin-visible-message-img').attr('src', thisTargetContentPin.parents('.chat-body-message-element').find('.chat-body-message-video img').attr('src'));
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
                    $('#pin-visible-message .pin-visible-message-text').text(thisTargetContentPin.parents('.chat-body-message-element').find('.chat-body-message-text').text());
                    break;
            }
            let key = 'key-identification-' + moment().format('x');
            sendPinVisibleMessage(thisTargetContentPin.parents('.chat-body-message-element').data('random-key'), key);
            $('#data-message-visible-message').prepend(`<div class="chat-body-message-element notify-message-container" id="" data-position="" data-identification="${key}">
                    <div class="notify-message-content">
                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  class="chat-body-message-item-pin-img" src="${domainSession + avatarSession}" alt="" />
                        <div class="notify-message-block">
                            <span onclick="openModalInfoEmployeeManage(6362)" class="notify-message-username showmore underline"><span class="event-message-content-name showmore underline">Bạn</span> </span>
                            <span class="notify-message-text">đã ghim tin nhắn</span>
                            <i class="event-message-content-info-icon typcn typcn-pin"></i>
                        </div>
                    </div>
                </div>`);
            sizeBodyMessageThumbnail();
        }
    });
    /**
     * Bỏ ghim tin nhắn
     */
    $(document).on('click', '#layout-pin-detail-about-visible-message .item-action-revoke-pin', async function () {
        let title = 'Xác nhận bỏ tin nhắn ghim ?',
            content = '',
            icon = 'question';
        sweetAlertComponent(title, content, icon).then(async (result) => {
            if (result.value) {
                let key = 'key-identification-' + moment().format('x');
                await sendRevokePinVisibleMessage($(this).parents('.pin-details-content-item-visible-message').data('random-key'), key)
                $('#data-message-visible-message').prepend(`<div class="chat-body-message-element notify-message-container">
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
    $(document).on('click', '#main-visible-message .action-send-card-order-message', function () {
        let r = $(this);
        if (typeCurrentConversation === 3) {
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
                    supplier_id: supplierCurrentConversation,
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
            $('#show-order-message').removeClass('active');
            $('.order-input-visible-message').addClass('d-none');
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

/** Function xử lý socket emit **/
/** Tin nhắn text **/
async function sendTextVisibleMessage() {
    messageInputVisibleMessage = $('#input-message-visible-message').find('p').html().replaceAll('<br>', ' \n ');
    // $('#input-message-visible-message').find('.dx-htmleditor-content').html('');
    if (messageInputVisibleMessage.trim() === '') return false;
    console.log(messageInputVisibleMessage)
    if ($('#input-message-visible-message').find('span').hasClass('dx-mention')) {
        for (const member of listTagInputVisibleMessage) {
            let replace_text='<span class="dx-mention" spellcheck="false" data-marker="@" data-mention-value="'+member.full_name+'" data-id="'+member.member_id+'">﻿<span contenteditable="false"><span>@</span>'+member.full_name+'</span>﻿</span>'
            messageInputVisibleMessage = messageInputVisibleMessage.replace(`${replace_text}`, member.key_tag_name);
        }
        console.log(messageInputVisibleMessage)
    } else {
        listTagInputVisibleMessage = [];
        keyTagName = '';
    }
    let key = 'key-identification-' + moment().format('x');
    let notify='';
    if(!$('.layout-send-notify-visible-message').hasClass('d-none'))   notify=' <div class="content-notify"><i class="fa fa-exclamation mr-1"></i> Quan trọng</div>'
    let dataRender = {
        list_tag_name: listTagInputVisibleMessage,
        list_link: listLinkInput,
        message: messageInputVisibleMessage,
        random_key: '',
        _id: '',
        message_type: '',
        key_message_error: key,
        sender: {
            member_id: idSession,
            full_name: nameSession,
            avatar: avatarSession,
        },
        notify:notify,
        created_at: moment().format('YYYY/MM/DD HH:mm:ss')
    }
    if (checkIdEmpty(idCurrentConversation, idSession)) return false;
    else  await renderMessageText(dataRender);
    if (typeCurrentConversation === 3) {
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            group_id_tms_supplier: idCurrentConversation,
            code: '',
            message: messageInputVisibleMessage,
            message_type: 1,
            list_tag_name: listTagInputVisibleMessage,
            key_message_error: key
        };
        socket.emit('chat-text-tms-supplier', data);
    } else {
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            message: messageInputVisibleMessage,
            message_type: 1,
            list_tag_name: listTagInputVisibleMessage,
            key_message_error: key
        };
        socket.emit('chat-text', data);
    }
    messageInputVisibleMessage = '';
    listTagInputVisibleMessage = [];
}

/** Tin nhắn link **/
async function sendLinkVisibleMessage() {
    // messageInputVisibleMessage = $('#input-message-visible-message').find('p').text();
    messageInputVisibleMessage = $('#input-message-visible-message').find('p').html().replaceAll('<br>', ' \n ');
    if ($('#input-message-visible-message').find('span').hasClass('dx-mention')) {
         for (const member of listTagInputVisibleMessage) {
            let replace_text='<span class="dx-mention" spellcheck="false" data-marker="@" data-mention-value="'+member.full_name+'" data-id="'+member.member_id+'">﻿<span contenteditable="false"><span>@</span>'+member.full_name+'</span>﻿</span>'
            messageInputVisibleMessage = messageInputVisibleMessage.replace(`${replace_text}`, member.key_tag_name);
        }
     } else {
        listTagInputVisibleMessage = [];
        keyTagName = '';
    }
    let key = 'key-identification-' + moment().format('x');
    let notify='';
    if(!$('.layout-send-notify-visible-message').hasClass('d-none'))   notify=' <div class="content-notify"><i class="fa fa-exclamation mr-1"></i> Quan trọng</div>'
    let dataRender = {
        list_tag_name: listTagInputVisibleMessage,
        message: messageInputVisibleMessage,
        random_key: '',
        _id: '',
        message_type: '',
        key_message_error: key,
        message_link: {
            media_thumb: $('#image-thumbnail-preview').attr('src'),
            cannonical_url: $('#link-thumbnail-preview').attr('src'),
            title: $('#title-thumbnail-preview').text(),
            favicon: $('#image-thumbnail-preview').attr('src'),
            description: $('#link-thumbnail-preview').attr('src'),
        },
        list_link: listLinkInput,
        sender: {
            member_id: idSession,
            full_name: nameSession,
            avatar: avatarSession,
        },
        notify:notify,
        created_at: moment().format('YYYY/MM/DD HH:mm:ss')
    }
    if (checkIdEmpty(idCurrentConversation, idSession)) return false;
    await renderMessageLink(dataRender);
    if (typeCurrentConversation === 3) {
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            group_id_tms_supplier: idCurrentConversation,
            code: '',
            message: messageInputVisibleMessage,
            message_link: {
                media_thumb: $('#image-thumbnail-preview').attr('src'),
                cannonical_url: $('#link-thumbnail-preview').attr('src'),
                title: $('#title-thumbnail-preview').text(),
                favicon: $('#image-thumbnail-preview').attr('src'),
                description: $('#link-thumbnail-preview').attr('src'),
            },
            message_type: 8,
            app_name: 'tms',
            key_message_error: key
        };
        socket.emit('chat-link-tms-supplier', data);
    } else {
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            message: messageInputVisibleMessage,
            list_tag_name: listTagInputVisibleMessage,
            message_link: {
                media_thumb: $('#image-thumbnail-preview').attr('src'),
                cannonical_url: $('#link-thumbnail-preview').attr('src'),
                title: $('#title-thumbnail-preview').text(),
                favicon: $('#image-thumbnail-preview').attr('src'),
                description: $('#link-thumbnail-preview').attr('src'),
            },
            list_link: listLinkInput,
            message_type: 8,
            key_message_error: key
        };
        socket.emit('chat-link', data);
    }
    listLinkInput = [];
    $('.layout-preview-input-visible-message').addClass('d-none');
    $('#image-thumbnail-preview').attr('src', '');
    $('#title-thumbnail-preview').text('');
    $('#text-link-thumbnail-preview').text('');
    $('#link-thumbnail-preview').attr('src', '');
    messageInputVisibleMessage = '';
    listTagInputVisibleMessage = [];
    $('#input-message-visible-message').find('.dx-htmleditor-content').html('');
    sizeBodyMessageThumbnail();
}

/** Tin nhắn ảnh **/
async function sendImageVisibleMessage() {
    let dataImage = [], imageMedia = [];
    for await (const v of $('.item-media-input-visible-message.item-image img.image-paste')) {
        imageMedia.push(dataURLtoFile($(v).attr('src')));
    }
    dataMediaImageCurrent = dataMediaImageCurrent.concat(imageMedia);
    if (checkIdEmpty(idCurrentConversation, idSession)) return false;
    let imageSocket = await countImageInput(dataMediaImageCurrent), key = 'key-identification-' + moment().format('x');
    $('#data-message-visible-message').prepend(`<div class="chat-body-message-element message-right" id="" data-position="" data-id="" data-random-key="" data-identification="${key}" data-type="2" data-name="" data-sender="">
                                                                    <div class="chat-body-message">
                                                                        ${imageSocket}
                                                                        ${footerMessage(idSession, moment().format('DD/MM/YYYY HH:mm:ss'))}
                                                                    </div>
                                                            </div>`);
    let size = (dataMediaImageCurrent.length > 0) ? await displayPreview(dataMediaImageCurrent[0]) : '';
    for await(const v of dataMediaImageCurrent) {
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
    dataMediaImageCurrent = [];
    if (typeCurrentConversation === 3) {
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            group_id_tms_supplier: idCurrentConversation,
            code: '',
            files: dataImage,
            message_type: 2,
            app_name: 'tms',
            key_message_error: key
        };
        socket.emit('chat-image-tms-supplier', data);
    } else {
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            files: dataImage,
            message_type: 2,
            key_message_error: key
        };
        socket.emit('chat-image', data);
    }
}

/** Tin nhắn file **/
async function sendAudioVisibleMessage(file, key) {
    if (checkIdEmpty(idCurrentConversation, idSession)) return false;
    if (typeCurrentConversation === 3) {
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
        socket.emit('chat-audio-tms-supplier', data);
    } else {
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            files: file,
            message_type: 6,
            key_message_error: key
        };
        socket.emit('chat-audio', data);
    }
}

/** Tin nhắn video **/
async function sendVideoVisibleMessage(data) {
    let key = 'key-identification-' + moment().format('x');
    if (checkIdEmpty(idCurrentConversation, idSession)) return false;
    $('#data-message-visible-message').prepend(`<div class="chat-body-message-element message-right" id="" data-position="" data-id="" data-random-key="" data-identification="${key}" data-type="" data-name="" data-sender="">
                <div class="chat-body-message">
                    <div class="chat-body-message-video">
                        <div class="chat-message-video-content">
                            <video class="video-after-img d-none" controls>
                                <source src="${URL.createObjectURL(data)}"/>
                            </video>
                            <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  src="${data.thumb}" data-video="${URL.createObjectURL(data)}" loading="lazy">
<!--                            <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  src="${domainSession + data.thumb}" data-video="${URL.createObjectURL(data)}" loading="lazy">-->
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
    let res = await uploadMediaTemplate(data, 1);
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
        // socket.emit('chat-video-tms-supplier', data);
    } else {
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            files: file,
            message_type: 5,
            key_message_error: key
        };
        // socket.emit('chat-video', data);
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

/** Tin nhắn file **/
async function sendFileVisibleMessage() {
    for (const v of dataMediaFileCurrent) {
        let res = await uploadMediaTemplate(v, 0);
        let key = 'key-identification-' + v.name + moment().format('x'),
            iconFile = convertImageFile(res.data[0].link_original),
            sizeFile = convertSizeFile(v.size),
            fileName = v.name.split('.').slice(0, -1).join('.');
        if (checkIdEmpty(idCurrentConversation, idSession)) return false;
        $('#data-message-visible-message').prepend(`<div class="chat-body-message-element message-right" id="" data-position="" data-id="" data-random-key="" data-identification="${key}" data-type="3" data-name="${v.name}" data-sender="" >
            <div class="chat-body-message">
                   <div class="chat-body-message-file">
                           <a href="${domainSession + res.data[0]}" download>
                             <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="chat-message-file-icon-image" src=" ${iconFile}" loading="lazy"/>
                           </a>
                           <div class="chat-message-file-content">
                                <div class="chat-message-file-action">
                                    <span class="chat-message-file-name">${fileName}</span>
                                    <span class="chat-message-file-size-body"> ${sizeFile}</span>
                                </div>
                                 <div class="see-item-image-video-grid-download btn-download-file-upload d-flex">
                                    <i class="fa fa-download" data-download="${domainSession + res.data[0]}" data-name-file="${fileName}"></i>
                                 </div>
                           </div>
                   </div>
                ${footerMessage(idSession, moment().format('DD/MM/YYYY HH:mm:ss'))}
            </div>
      </div> `);

        if (typeCurrentConversation === 3) {
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                group_id_tms_supplier: idCurrentConversation,
                code: '',
                files: [{
                    "link_thumb": res.data[1],
                    "link_original": res.data[0],
                    "name_file": res.data[3],
                    "size": v.size,
                    "type": 0
                }],
                message_type: 3,
                app_name: 'tms',
                key_message_error: key
            };
            // console.log('chat-file-tms-supplier', data)
            socket.emit('chat-file-tms-supplier', data);
        } else {
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                files: [{
                    "link_thumb": res.data[1],
                    "link_original": res.data[0],
                    "name_file": res.data[3],
                    "size": v.size,
                }],
                message_type: 3,
                key_message_error: key
            };
            // console.log('chat-file', data)
            socket.emit('chat-file', data);
        }
        dataMediaFileCurrent = []
    }
}

/** Tin nhắn sticker **/
async function sendStickerVisibleMessage(id, src, key) {
    if (checkIdEmpty(idCurrentConversation, idSession)) return false;
    if (typeCurrentConversation === 3) {
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
        // console.log('chat-sticker-tms-supplier', data);
        socket.emit('chat-sticker-tms-supplier', data);
    } else {
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            sticker_id: id,
            message_type: 4,
            message: src,
            key_message_error: key
        };
        // console.log('chat-sticker', data);
        socket.emit('chat-sticker', data);
    }
}

/** Tin nhắn notify **/
async function sendNotifyVisibleMessage() {
    messageInputVisibleMessage = $('#input-message-visible-message').find('p').html().replaceAll('<br>', ' \n ');
    if ($('#input-message-visible-message').find('span').hasClass('dx-mention')) {
        for (const member of listTagInputVisibleMessage) {
            messageInputVisibleMessage = messageInputVisibleMessage.replace(`@${member.full_name}`, member.key_tag_name);
        }
    } else {
        listTagInputVisibleMessage = [];
        keyTagName = '';
    }
    let key = 'key-identification-' + moment().format('x');
    let dataRender = {
        list_tag_name: listTagInputVisibleMessage,
        list_link: listLinkInput,
        message: messageInputVisibleMessage,
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
    if (checkIdEmpty(idCurrentConversation, idSession)) return false;
    renderMessageNotify(dataRender);
    if (typeCurrentConversation === 3) {
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            group_id_tms_supplier: idCurrentConversation,
            code: '',
            message: messageInputVisibleMessage,
            message_type: 1,
            list_tag_name: listTagInputVisibleMessage,
            key_message_error: key
        };
        // console.log('chat-text-tms-supplier', data);
        socket.emit('chat-text-tms-supplier', data);
    } else {
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            message: messageInputVisibleMessage,
            message_type: 1,
            list_tag_name: listTagInputVisibleMessage,
            is_important: 1,
            key_message_error: key
        };
        // console.log('chat-text', data);
        socket.emit('chat-text', data);
    }
    messageInputVisibleMessage = '';
    listTagInputVisibleMessage = [];
    $('#input-message-visible-message').find('.dx-htmleditor-content').html('');
}

/** Tin nhắn reply **/
async function sendReplyVisibleMessage() {
    sizeBodyMessageThumbnail();
    messageInputVisibleMessage = $('#input-message-visible-message').find('p').text();
    if ($('#input-message-visible-message').find('span').hasClass('dx-mention')) {
        for (const member of listTagInputVisibleMessage) {
            messageInputVisibleMessage = messageInputVisibleMessage.replace(`@${member.full_name}`, member.key_tag_name);
        }
    } else {
        listTagInputVisibleMessage = [];
        keyTagName = '';
    }
    if (checkIdEmpty(idCurrentConversation, idSession)) return false;
    let key = 'key-identification-' + moment().format('x');
    let classImage = 'd-none';
    let message = messageInputVisibleMessage;
    for await (const v of listTagInputVisibleMessage) {
        message = message.replace(v.key_tag_name, `<span class="tag-name">@${v.full_name}</span>`);
    }

    if (['2', '3', '4', '5'].includes($('.layout-reply-input-visible-message').attr('data-type'))) classImage = '';

    $('#data-message-visible-message').prepend(`<div class="chat-body-message-element message-right" id="" data-position="" data-id="" data-random-key="" data-identification="${key}" data-type="" data-name="" data-sender="">
                                                        <div class="chat-body-message">
                                                            <a class="transition-reply" data-id="${$('.layout-reply-input-visible-message').data('id')}">
                                                                <div class="chat-body-message-item-reply">
                                                                    <div class="chat-body-message-item-reply-image ${classImage}">
                                                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  class="chat-body-message-item-reply-img" src="${$('.img-thumbnail-link-input-visible-message').attr('src')}" alt="" />
                                                                    </div>
                                                                    <div class="chat-body-message-item-reply-info">
                                                                        <div class="chat-body-message-item-reply-name">${$('#name-reply-name').text()}</div>
                                                                        <div class="chat-body-message-item-reply-type">${$('.footer-text-input-thumbnail-reply-visible-message').text()}</div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <div class="chat-body-message-item-reply-text">${message}</div>
                                                             ${footerMessage(idSession, moment().format('DD/MM/YYYY HH:mm:ss'))}
                                                        </div>
                                                    </div>`);

    if (typeCurrentConversation === 3) {
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            group_id_tms_supplier: idCurrentConversation,
            code: '',
            message: messageInputVisibleMessage,
            random_key: $('.layout-reply-input-visible-message').attr('data-id').toString(),
            message_type: 7,
            list_tag_name: listTagInputVisibleMessage,
            app_name: 'tms',
            key_message_error: key,
        };
        socket.emit('chat-reply-tms-supplier', data);
    } else {
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            message: messageInputVisibleMessage,
            random_key: $('.layout-reply-input-visible-message').attr('data-id').toString(),
            message_type: 7,
            list_tag_name: listTagInputVisibleMessage,
            key_message_error: key,
            position_image_reply: 1,
        };
        socket.emit('chat-reply', data);
    }
    $('.layout-reply-input-visible-message').attr('data-type', '');
    $('.img-thumbnail-link-input-visible-message').attr('src', '');
    $('#name-reply-name').text('');
    $('.footer-text-input-thumbnail-reply-visible-message').text('');
    $('.layout-reply-input-visible-message').addClass('d-none');
    $('.layout-reply-input-visible-message').data('id', '');
    listTagInputVisibleMessage = [];
    messageInputVisibleMessage = '';
    $('#input-message-visible-message').find('.dx-htmleditor-content').html('');
    sizeBodyMessageThumbnail();
}

/** Tin nhắn reaction **/
async function sendReactionVisibleMessage(id, reaction) {
    if (checkIdEmpty(idCurrentConversation, idSession)) return false;
    if (typeCurrentConversation === 3) {
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
    } else {
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

/** Tin nhắn thu hồi ghim **/
async function sendRevokePinVisibleMessage(id, key) {
    if (checkIdEmpty(idCurrentConversation, idSession)) return false;
    if (typeCurrentConversation === 3) {
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
        socket.emit('revoke-pinned-message-tms-supplier', data);
    } else {
        let data = {
            random_key: id.toString(),
            member_id: idSession,
            group_id: idCurrentConversation,
            message_type: 11,
            key_message_error: key,
        };
        socket.emit('revoke-pinned-message', data);
    }
}

/** Tin nhắn thu hồi **/
async function sendRevokeVisibleMessage(id) {
    if (checkIdEmpty(idCurrentConversation, idSession)) return false;
    let key = 'key-identification-' + moment().format('x');
    if (typeCurrentConversation === 3) {
        let data = {
            random_key: id.toString(),
            member_id: idSession,
            group_id: idCurrentConversation,
            group_id_tms_supplier: idCurrentConversation,
            code: '',
            message_type: 9,
            key_message_error: key,
        };
        socket.emit('revoke-message-tms-supplier', data);
    } else {
        let data = {
            random_key: id.toString(),
            member_id: idSession,
            group_id: idCurrentConversation,
            position_message_revoke: -1,
            message_type: 9,
            key_message_error: key,

        };
        socket.emit('revoke-message', data);
    }
}

/** Tin nhắn ghim **/
async function sendPinVisibleMessage(id, key) {
    if (checkIdEmpty(idCurrentConversation, idSession)) return false;
    if (typeCurrentConversation === 3) {
        let data = {
            random_key: id.toString(),
            member_id: idSession,
            group_id: idCurrentConversation,
            group_id_tms_supplier: idCurrentConversation,
            message_type: 13,
            code: '',
            app_name: 'tms',
            key_message_error: key,

        };
        // console.log('pinned-message-tms-supplier', data);
        socket.emit('pinned-message-tms-supplier', data);
    } else {
        let data = {
            random_key: id.toString(),
            member_id: idSession,
            group_id: idCurrentConversation,
            message_type: 13,
            key_message_error: key,

        };
        // console.log('pinned-message', data);
        socket.emit('pinned-message', data);
    }
}

/** Function xử lý ảnh thumbnail video **/
function displayPreview(data) {
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

function thumbnailUploadVideo(files) {
    console.log('file', file);
    let fileReader = new FileReader();
    fileReader.onload = function (file) {
        console.log('filessss', file);
        let blob = new Blob([fileReader.result], {type: file.type});
        console.log(blob);
        let url = URL.createObjectURL(blob);
        let video = document.createElement("video");
        let timeupdate = function () {
            if (snapImage()) {
                video.removeEventListener("timeupdate", timeupdate);
                video.pause();
            }
        };
        video.addEventListener("loadeddata", function () {
            if (snapImage()) {
                video.removeEventListener("timeupdate", timeupdate);
            }
        });
        video.addEventListener("timeupdate", timeupdate);
        video.preload = "metadata";
        video.src = url;
        video.muted = true;
        video.playsInline = true;
        video.play();
        let snapImage = async function () {
            let canvas = document.createElement("canvas");
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext("2d").drawImage(video, 0, 0, canvas.width, canvas.height);
            let image = canvas.toDataURL("image/png");
            getImage = image;
            let imageData = await uploadMediaTemplate(dataURLtoFile(image), 0);
            let res = await uploadMediaTemplate($(this).prop('files')[0], 0);
            console.log(res, "RES", imageData, "IMAGE DATA");
            file = [{
                "link_thumb": imageData.data[0],
                "link_thumb_video": res.data[0],
                "type": 1,
                "width": 300,
                "height": 300,
                "ratio": 1,
                "link_original": res.data[0],
                "name_file": $(this).prop('files')[0].name,
                "size": $(this).prop('files')[0].size
            }];
            return file;
        };
    }
    linkImage = snapImage;
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
                                <div class="chat-body-message-item-reactions-group reactions-group-icon" data-id="3">
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

/** function xử lý  **/
