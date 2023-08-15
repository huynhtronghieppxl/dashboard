let listTagInputVisibleMessage = [], keyTagName = '', fileAudio = [];
let timer = document.getElementById('timer');
let recorder = document.getElementById('recorder');
let time = "00:00"
let seconds = 0;
minutes = 0;
let restart = 0;
let sizeAudio;
let t;
timer.textContent = time;
let listLinkInput = [];
$('#time-audio').textContent = time;
let dataMemberTagNameAbout = [];
let checkTypingTMSRestaurantVisible = 0, checkTypingTMSSupplierVisible = 0;
let isPaste = 0;
let cursorPositionVisible=0
$(function () {

    /**
     * Sự kiển chuyển màu icon
     */
    $(document).on('focus', '.dx-htmleditor-content', function () {
        $('#layout-body-visible-message .action').css('border-left', '2px solid #ffa233');
        $('.layout-action-input-visible-message').css('border-bottom', '1px solid #0068ff');
        // $('.layout-action-input-visible-message i').css('color', '#0072bc');
        $('.icon-smile-visible-input').css('color', '#f9a236');
        $('.icon-like-input-visible-message').css('color', '#0072bc');
    })
    $(document).on('focusout', '.dx-htmleditor-content', function () {
        if (($(this)).text() !== "") {
            $('#layout-body-visible-message .action').css('border-left', '2px solid #ffa233')
            $('.layout-action-input-visible-message').css('border-bottom', '1px solid #0068ff');
        } else {
            $('.layout-action-input-visible-message i ').css('color', '#a3a3a3');
            $('.icon-smile-visible-input').css('color', '#a3a3a3');
            $('.icon-like-input-visible-message').css('color', '#a3a3a3');
            $('#layout-body-visible-message .action').css('border-left', '2px solid #a3a3a3')
            $('.layout-action-input-visible-message').css('border-bottom', '');
        }

    });

    $('#layout-body-visible-message .message-writing-box .layout-action-input-visible-message i ').on('mouseover', function () {
        $(this).attr('style', 'color:#0068ff !important');
    })
    $('#layout-body-visible-message .message-writing-box .layout-action-input-visible-message i ').on('mouseout', function () {
        $(this).attr('style', '');
    })

    /**
     * Event input
     */
    let arrFormatLink = ['aero', 'com', 'vn', 'net', 'org', 'info', 'biz', 'gov', 'edu', 'me', 'io', 'app', 'co', 'shop', 'club', 'tech', 'online', 'store', 'design', 'site'];
    let linkLoadCurrent = '';
    $('#input-message-visible-message').on('input paste', function () {
        if ($(this).find('.ql-code-block').text() !== '') {
            isPaste = 1
            let stringHTML = $(this).find('.ql-code-block').text();
            $(this).find('.ql-code-block-container').remove();
            $(this).find('p').append(stringHTML.replace(/\s+/g, ' '));
            setPositionMouseVisibleMessage();
        } else isPaste = 0;
        // if(typeCurrentConversation === 3) {
        //     typingOnTMSSupplierVisible();
        // }
        // else {
        //     typingOnTMSRestaurantVisible();
        // }
        // setCursorMarker($(this).find('.ql-editor.dx-htmleditor-content p').text(), this);
        $('.dx-htmleditor-content').removeClass('ql-blank');
        /**
         * Chuyển string -> array
         */
        let arrayInput = $(this).find('.ql-editor.dx-htmleditor-content p').text().split(" ");
        /**
         * Loại trừ params, tiền tố link
         */
        let linkNotParams = arrayInput.map(function (item) {
            return item.replace('https://', '').replace('http://', '').split("/")[0];
        });
        /**
         * Lấy ra tất cả phần tử mà có đuôi web
         */
        let link = linkNotParams.filter(item => arrFormatLink.includes(item.split('.').at(-1)) === true);
        /**
         * Lấy ra link cuối cùng
         */

        let lastLink = link.at(-1);
        let fullLastLink = arrayInput.filter(item => item.includes(lastLink) === true);
        listLinkInput = [];
        jQuery.each(link, function (i, v) {
            listLinkInput.push(arrayInput.filter(item => item.includes(v) === true)[0]);
        })
        if (fullLastLink.length > 0 && $('.layout-preview-input-visible-message').hasClass('d-none') && lastLink !== linkLoadCurrent) {
            $.ajax({
                url: "http://api.linkpreview.net",
                dataType: 'jsonp',
                data: {q: fullLastLink[0], key: 'f2f1689461771f55c1f51febe2820926'},
                success: function (response) {
                    if (!response.error) {
                        $('#image-thumbnail-preview').attr('src', response.image);
                        $('#title-thumbnail-preview').text(response.title);
                        $('#text-link-thumbnail-preview').text(response.url);
                        $('#link-thumbnail-preview').attr('src', response.url);
                        $('.layout-preview-input-visible-message').removeClass('d-none');
                    }
                    sizeBodyMessageThumbnail();
                    $('.layout-thumbnail-preview-visible-message').unbind('click').on('click', function () {
                        window.open($(this).find('#link-thumbnail-preview').attr('src'), '_blank');
                    })
                },
            });
        }
        cursorPositionVisible=htmlEditor.getSelection().index
        sizeBodyMessageThumbnail();
    })

    $('#input-message-visible-message').on("keydown cut", function (event) {
        isPaste = 0
        let tagCurrent = $(this).find('.dx-mention').length;
        if (tagCurrent < listTagInputVisibleMessage.length) {
            let tag = [];
            $(this).find('.dx-mention').each(function (i, v) {
                tag.push($(v).data('id'));
            })
            let data = listTagInputVisibleMessage.filter(o1 => tag.some(o2 => o1.member_id !== o2));
        }
        if ($('.dx-overlay-wrapper.dx-popup-wrapper.dx-suggestion-list-wrapper').is(':visible')) {
            if (event.keyCode === 13 || event.keyCode === 32 ) {
                setTimeout(function (){
                    $('.dx-list-item.dx-state-focused').click();
                }, 0)
                    // $('.dx-list-item.dx-state-focused').click();
            }


        } else {
            if (event.keyCode === 13) {
                if (event.shiftKey) {
                    sizeBodyMessageThumbnail();
                    event.stopPropagation();
                } else {
                    $('#button-send-message-visible-message').click();
                }
            }
        }
        cursorPositionVisible=htmlEditor.getSelection().index
        sizeBodyMessageThumbnail();
    })

    $(document).on('click', '.dx-htmleditor-content', function (event) {
        cursorPositionVisible=htmlEditor.getSelection().index
        getCaretCharacterOffsetWithin(event);
    })
    /**
     * Tắt thumbnail
     * */
    let textReplyInput = '';
    $('.icon-close-thumbnail-image-close-reply , .icon-close-thumbnail-link-visible-message').on('click', function () {
        $('.layout-reply-input-visible-message').addClass('d-none');
        $('.layout-preview-input-visible-message').addClass('d-none');
        let textInput = $('#input-message-visible-message').find('p').text();
        sizeBodyMessageThumbnail();
        if (textInput.trim() === textReplyInput.trim() && textInput.length === textReplyInput.length) {
            listTagInputVisibleMessage = [];
            messageInputVisibleMessage = '';
            $('#input-message-visible-message').find('.dx-htmleditor-content').html('');
        }
    })
    /**
     * Sự kiện nhấn vào khung reply đến tin nhắn đó
     */
    /**
     * Thay đổi icon header khi resize
     */
    $(window).on('resize', function () {
        if (!$('#layout-about-visible-message').is(":visible")) {
            $('.icon-double-right').addClass('d-none');
            $('.icon-double-left').removeClass('d-none');

        } else {
            $('.icon-double-right').removeClass('d-none');
            $('.icon-double-left').addClass('d-none');
        }
    })
    /**
     * Reply hiện khung
     */
    $(document).on('click', '#layout-body-visible-message .chat-body-message-item-action-item.item-action-reply', function () {
        $('.layout-audio-visible-message').addClass('d-none');
        $('.record-visible-message').removeClass('active');
        $('.layout-input-visible-message').removeClass('d-none');
        let data_type = $(this).parents('.chat-body-message-element').data('type'),
            name = $(this).parents('.chat-body-message-element').data('name'),
            sender = $(this).parents('.chat-body-message-element').data('sender'),
            text = $(this).parents('.chat-body-message-element').find('.chat-body-message-text').text(),
            imageReply = $(this).parents('.chat-body-message').find('img:first-child').attr('src'),
            countImage = $(this).parents('.chat-body-message').find('.chat-body-message-image img').length;
        $('.layout-reply-input-visible-message').attr('data-id', $(this).parents('.chat-body-message-element').data('random-key'));
        $('.layout-reply-input-visible-message').attr('data-type', data_type);
        if (data_type == 7) {
            text = $(this).parents('.chat-body-message-element').find('.chat-body-message-item-reply-text').text();
        }
        let html = '';
        switch (data_type) {
            case 2:
                html = `<img class="img-thumbnail-link-input-visible-message"
                     src="${imageReply}" alt=""/>`
                $('#image-id-reply-visible-message').html(html);
                $('#name-reply-name').text(nameSession);
                $('.footer-text-input-thumbnail-reply-visible-message').text(name + ' [Đã gửi ' + countImage + ' hình ảnh]');
                break;
            case 3:
                html = `<img class="img-thumbnail-link-input-visible-message"
                     src="${imageReply}" alt=""/>`
                $('#image-id-reply-visible-message').html(html);
                $('#name-reply-name').text(nameSession);
                $('.footer-text-input-thumbnail-reply-visible-message').text(name + ' [Đã gửi File]');
                break;
            case 4:
                html = `<img class="img-thumbnail-link-input-visible-message"
                     src="${imageReply}" alt=""/>`
                $('#image-id-reply-visible-message').html(html);
                $('#name-reply-name').text(nameSession);
                $('.footer-text-input-thumbnail-reply-visible-message').text(name + ' [Đã gửi Sticker]');
                break;
            case 5:
                html = `<img class="img-thumbnail-link-input-visible-message"
                     src="${imageReply}" alt=""/>`
                $('#image-id-reply-visible-message').html(html);
                $('#name-reply-name').text(nameSession);
                $('.footer-text-input-thumbnail-reply-visible-message').text(name + ' [Đã gửi Video]');
                break;
            case 6:
                html = `<img class="img-thumbnail-link-input-visible-message"
                     src="/images/tms/audio.png" alt=""/>`
                $('#image-id-reply-visible-message').html(html);
                $('#name-reply-name').text(nameSession);
                $('.footer-text-input-thumbnail-reply-visible-message').text(name + ' [Đã gửi Ghi âm]');
                break;
            default:
                $('.img-thumbnail-link-input-visible-message').remove();
                $('#name-reply-name').text(nameSession);
                $('.footer-text-input-thumbnail-reply-visible-message').text(name + ': ' + text);
                break;
        }
        $('.layout-reply-input-visible-message').removeClass('d-none');
        sizeBodyMessageThumbnail();
        if (sender !== idSession) {
            let htmlSpan = ` <span class="dx-mention" id="mention-reply" spellCheck="false" data-marker="@" data-mention-value=""
              data-id="2501">&#xFEFF;<span contentEditable="false"><span>@</span>${name} </span>&#xFEFF;</span>&#xFEFF`;
            $('#input-message-visible-message').find('p').html(htmlSpan);
            textInputCursor($('.dx-htmleditor-content p')[0]);
        } else {
            $('.dx-htmleditor-content').focus();
        }
        keyTagName = name.replace(name, moment().format('x'));
        textReplyInput = $('#input-message-visible-message').find('p').text() + '  ';
        listTagInputVisibleMessage.push({
            member_id: sender,
            full_name: name,
            key_tag_name: keyTagName,
        });

    })
    /**
     * Ghi âm
     */
    $('.record-visible-message').on('click', function () {
        if ($('.layout-audio-visible-message').hasClass('d-none')) {
            $('.layout-reply-input-visible-message').addClass('d-none');
            $(this).addClass('active');
            $('.layout-input-visible-message').addClass('d-none');
            $('.layout-audio-visible-message').removeClass('d-none');

        } else {
            $(this).removeClass('active');
            $('.layout-audio-visible-message').addClass('d-none');
            $('.layout-input-visible-message').removeClass('d-none');
            $('#input-message-visible-message').focus();
        }
        sizeBodyMessageThumbnail();
    })
    $('#turn-off-record-visible-message').click(function () {
        resetTimerAudio();
        $('.time-record-visible-message').text('00:00')
        $('#button').removeClass('recording');
    })

    /**
     * Thông báo bằng tin nhắn quan trọng
     */
    $('#send-notify-important-message').on('click', function () {
        if ($('.layout-send-notify-visible-message').hasClass('d-none')) {
            $('.layout-send-notify-visible-message').removeClass('d-none');
            $(this).addClass('active');
        } else {
            $('.layout-send-notify-visible-message').addClass('d-none');
            $(this).removeClass('active');
        }
        sizeBodyMessageThumbnail();
    })
    $('#close-send-notify-important-messager').click(function () {
        $('.layout-send-notify-visible-message').addClass('d-none');
        $('#send-notify-important-message').removeClass('active');
        sizeBodyMessageThumbnail();
    })

    /**
     * Vote
     */
    $('.vote-visible-message').on('click', function () {
        $(this).addClass('active');
        $('#modal-vote-visible-message').modal('show');
    })
    /**
     * Emoji
     */
    $('#emoji-button-input-visible-message').on('click', function (event) {
        $('#emoji-mart').toggleClass('d-none');
    });
    /**
     * Like
     */
    $('#like-input-visible-message').click(function () {
        let key = 'key-identification-' + moment().format('x');
        $('#data-message-visible-message').prepend(`<div class="chat-body-message-element message-right" id="" data-position="" data-id="" data-random-key="" data-identification="${key}" data-type="" data-name="" data-sender="">
                                                                    <div class="chat-body-message">
                                                                         <div class="chat-body-message-image" >
                                                                                <div class="gallery__item">
                                                                                <img style="width: 135px; height: 135px" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="https://beta.api.gateway.overate-vntech.com/short/P64iYOtlt8FbnvXIA-mxj" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                                                                </div>
                                                                        </div>
                                                                        ${footerMessage(idSession, moment().format('DD/MM/YYYY HH:mm:ss'))}
                                                                    </div>
                                                            </div>`);
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
        // socket.emit('chat-image', data);
    })
    /**
     * Xử lý event cho dán ảnh
     */
    $(document).on('click', '.item-media-input-visible-message span', function () {
        $(this).parents('.item-media-input-visible-message').remove();
        let countImage = ($('.layout-media-input-visible-message .item-media-input-visible-message.item-image').length > 99) ? '99+' : $('.layout-media-input-visible-message .item-media-input-visible-message.item-image').length;
        let countVideo = ($('.layout-media-input-visible-message .item-media-input-visible-message.item-video').length > 99) ? '99+' : $('.layout-media-input-visible-message .item-media-input-visible-message.item-video').length;
        let countFile = ($('.layout-media-input-visible-message .item-media-input-visible-message.item-file').length > 99) ? '99+' : $('.layout-media-input-visible-message .item-media-input-visible-message.item-file').length;
        $('#count-image-input-visible-message').text(countImage);
        $('#count-video-input-visible-message').text(countVideo);
        $('#count-file-input-visible-message').text(countFile);
        if (countImage === 0) $('.layout-media-input-visible-message .count-image').addClass('d-none');
        if (countVideo === 0) $('.layout-media-input-visible-message .count-video').addClass('d-none');
        if (countFile === 0) $('.layout-media-input-visible-message .count-file').addClass('d-none');
        sizeBodyMessageThumbnail();
    })
})


/**
 * Tải file
 * @param urlLink
 * @param fileName
 * @constructor
 */

/**
 * Tính toán chiều cao web
 */
function sizeBodyMessageThumbnail() {
    let heightHeader = $('#header-visible-message').outerHeight(true);
    let heightPinMessage = $('#pin-visible-message').outerHeight(true);
    let heightHeaderInput = $('.layout-action-input-visible-message').outerHeight(true);
    let heightFooterInput = $('.layout-input-visible-message').outerHeight(true);
    let heightThumbnailPreview = $('.layout-preview-input-visible-message').outerHeight(true);
    let heightThumbnailReply = $('.layout-reply-input-visible-message').outerHeight(true);
    let heightThumbnailImage = $('.layout-media-input-visible-message').outerHeight(true);
    let heightAudio = $('.layout-audio-visible-message').outerHeight(true);
    let heightSendNotify = $('.layout-send-notify-visible-message').outerHeight(true);
    if (isPaste && heightFooterInput != 200) {
        heightFooterInput = heightFooterInput - 20
    }
    let heightInput = heightHeaderInput + heightFooterInput + heightThumbnailPreview + heightThumbnailReply + heightThumbnailImage + heightAudio + heightSendNotify;
    if ($('#pin-visible-message').hasClass('d-none')) {
        $('#body-visible-message').attr('style', 'height:calc(100vh - ' + '81px' + ' - ' + heightHeader + 'px' + ' - ' + heightInput + 'px');
    } else {
        $('#body-visible-message').attr('style', 'height:calc(100vh - ' + '81px' + ' - ' + heightHeader + 'px' + ' - ' + heightInput + 'px' + ' - ' + heightPinMessage + 'px)');
    }
    if(heightFooterInput>60){
        let positionEmoji=50 + heightFooterInput -59.9688
        $('#emoji-mart').attr('style','position: absolute;right: 10px;bottom:'+ positionEmoji+'px;z-index: 99;')
    }
    else   $('#emoji-mart').attr('style','position: absolute;right: 10px;bottom:50px;z-index: 99;')
}


/**
 * Insert Emoji
 * @param specialChar
 * @param pos
 */

let caretPos = 0;


function getCaretCharacterOffsetWithin(event) {
    let element = event.target;
    let caretOffset = 0;
    let doc = element.ownerDocument || element.document;
    let win = doc.defaultView || doc.parentWindow;
    let sel;
    if (typeof win.getSelection != "undefined") {
        sel = win.getSelection();
        if (sel.rangeCount > 0) {
            let range = win.getSelection().getRangeAt(0);
            let preCaretRange = range.cloneRange();
            preCaretRange.selectNodeContents(element);
            preCaretRange.setEnd(range.endContainer, range.endOffset);
            caretOffset = preCaretRange.toString().length;
        }
    } else if ((sel = doc.selection) && sel.type != "Control") {
        let textRange = sel.createRange();
        let preCaretTextRange = doc.body.createTextRange();
        preCaretTextRange.moveToElementText(element);
        preCaretTextRange.setEndPoint("EndToEnd", textRange);
        caretOffset = preCaretTextRange.text.length;
    }
    caretPos = caretOffset;
}

/**
 * Hàm đưa con trỏ chuột ra cuối cùng
 * @param el
 */


/**
 * Kiểm tra sự kiện nhấn nút ghi âm
 */

if (navigator.mediaDevices.getUserMedia) {

    let btn_status = 'inactive',
        mediaRecorder,
        chunks = [],
        audio = new Audio(),
        mediaStream,

        type = {
            'type': 'audio/ogg,codecs=opus'
        },
        ctx,
        analys,
        blob;

    $(document).on('click', '#button', function () {
        if (btn_status == 'inactive') {
            $(this).addClass('recording');
            $('.recorder-visible-message').removeAttr('data-original-title')
            $('.recorder-visible-message').attr('data-original-title', 'Nhấn vào để ngưng ghi âm');
            console.log($('.recorder-visible-message').data('original-title'))
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover'
            });
            start();
        } else if (btn_status == 'recording') {
            $(this).removeClass('recording');
            stop();
            $('.recorder-visible-message').removeAttr('data-original-title')
            $('.recorder-visible-message').attr('data-original-title', 'Nhấn vào để ghi âm');
            console.log($('.recorder-visible-message').data('original-title'))
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover'
            });
        }
    })

    function start() {
        resetTimerAudio();
        startTimerAudio();
        $('#turn-off-record-visible-message').addClass('d-none');
        $('#send-audio-input-visible-message').addClass('d-none');
        navigator.mediaDevices.getUserMedia({'audio': true}).then(function (stream) {
            mediaRecorder = new MediaRecorder(stream);
            mediaRecorder.start();
            btn_status = 'recording';
            if (navigator.vibrate) navigator.vibrate(150);
            mediaRecorder.ondataavailable = function (event) {
                chunks.push(event.data);
            }
            mediaRecorder.onstop = async function () {
                stream.getTracks().forEach(function (track) {
                    track.stop()
                });
                blob = new Blob(chunks, type);
                let file = new File([blob], 'record.mp3');
                audioSrc = window.URL.createObjectURL(blob);
                chunks = [];
                let a = document.createElement('a');
                a.download = 'record.mp3';
                a.href = audioSrc;
                let res = await uploadMediaTemplate(file, 0);
                let name = new Date();
                let name1 = name.getFullYear();
                let name2 = name.getMonth();
                let name3 = name.getDay();
                let name4 = name.getMilliseconds();
                let name5 = `${name1}${name2}${name3}${name4}`;
                fileAudio = [{
                    "link_thumb": "",
                    "type": 0,
                    "link_original": res.data[0],
                    "ratio": 0,
                    "name_file": "file_" + `${name5}` + '.mp3',
                    "link_thumb_video": "",
                    "height": 0,
                    "width": 0,
                    "size": sizeAudio
                }]
            }
        }).catch(function (error) {
            if (location.protocol != 'https:') {
            } else {
            }
            $(this).addClass('disabled')
        });
    }

    function stop() {
        stopTimerAudio();
        $('#turn-off-record-visible-message').removeClass('d-none');
        $('#send-audio-input-visible-message').removeClass('d-none');
        mediaRecorder.stop();
        btn_status = 'inactive';
        if (navigator.vibrate) navigator.vibrate([200, 100, 200]);
        let now = Math.ceil(new Date().getTime() / 1000);
    }


} else {
    if (location.protocol != 'https:') {
    } else {
    }
    $(this).addClass('disabled')
}

function buildTimerAudio() {
    seconds++;
    if (seconds >= 60) {
        seconds = 0;
        minutes++;
        if (minutes >= 60) {
            minutes = 0;
            seconds = 0;
        }
    }
    sizeAudio = seconds * 1000;
    timer.textContent = (minutes < 10 ? "0" + minutes.toString() : minutes) + ":" + (seconds < 10 ? "0" + seconds.toString() : seconds);
    if (minutes === 5) {
        stop();
    }
}

function stopTimerAudio() {
    clearTimeout(t);
}

function startTimerAudio() {
    clearTimeout(t);
    t = setInterval(buildTimerAudio, 1000);
    restart = 1;

}

function timeAudio() {
    clearTimeout(t);
    t = setInterval(buildTimeAudio, 1000);
    restart = 1;
}

function resetTimerAudio() {
    restart = 0;
    seconds = 0;
    minutes = 0;
    clearTimeout(t);
}

function buildTimeAudio() {
    seconds++;
    if (seconds >= 60) {
        seconds = 0;
        minutes++;
        if (minutes >= 60) {
            minutes = 0;
            seconds = 0;
        }
    }
    sizeAudio = seconds * 1000;
    timeCurrentAudio.text((minutes < 10 ? "0" + minutes.toString() : minutes) + ":" + (seconds < 10 ? "0" + seconds.toString() : seconds));
    if (seconds === 300) {
        stop();
    }
}

/**
 * Tinh vị trí con trỏ chuột insert emoji
 * @param text
 * @param element
 */

// function setCursorMarker(text, element) {
//     const [pos] = getCaretPosition(element)
//     text = text.slice(0, pos + 1) + text.slice(pos + 1, text.length);
//     caretPos = pos + 1;
// }
//
// function node_walk(node, func) {
//     var result = func(node);
//     for (node = node.firstChild; result !== false && node; node = node.nextSibling)
//         result = node_walk(node, func);
//     return result;
// }
//
// function getCaretPosition(elem) {
//     var sel = window.getSelection();
//     var cum_length = [0, 0];
//     if (sel.anchorNode == elem)
//         cum_length = [sel.anchorOffset, sel.extentOffset];
//     else {
//         var nodes_to_find = [sel.anchorNode, sel.extentNode];
//         if (!elem.contains(sel.anchorNode) || !elem.contains(sel.extentNode))
//             return undefined;
//         else {
//             var found = [0, 0];
//             var i;
//             node_walk(elem, function (node) {
//                 for (i = 0; i < 2; i++) {
//                     if (node == nodes_to_find[i]) {
//                         found[i] = true;
//                         if (found[i == 0 ? 1 : 0])
//                             return false; // all done
//                     }
//                 }
//                 if (node.textContent && !node.firstChild) {
//                     for (i = 0; i < 2; i++) {
//                         if (!found[i])
//                             cum_length[i] += node.textContent.length;
//                     }
//                 }
//             });
//             cum_length[0] += sel.anchorOffset;
//             cum_length[1] += sel.extentOffset;
//         }
//     }
//     if (cum_length[0] <= cum_length[1])
//         return cum_length;
//     return [cum_length[1], cum_length[0]];
// }

// function addEmoji(emoji) {
//     $('#input-message-visible-message').find('.ql-editor.ql-blank.dx-htmleditor-content').focus();
//     // insertHTMLAtCaret("<p class='app-moji'>"+ emoji +"</p>");
//     this.insertIntoFormula(`${emoji}`, caretPos);
// }

// function insertHTMLAtCaret(html) {
//     var sel, range;
//     if (window.getSelection) {
//         sel = window.getSelection();
//         if (sel.getRangeAt && sel.rangeCount) {
//             range = sel.getRangeAt(0);
//             range.deleteContents();
//             var el = document.createElement("div");
//             el.innerHTML = html;
//             var frag = document.createDocumentFragment(),
//                 node,
//                 lastNode;
//             while ((node = el.firstChild)) {
//                 lastNode = frag.appendChild(node);
//             }
//             range.insertNode(frag);
//
//             if (lastNode) {
//                 range = range.cloneRange();
//                 range.setStartAfter(lastNode);
//                 range.collapse(true);
//                 sel.removeAllRanges();
//                 sel.addRange(range);
//             }
//         }
//     } else if (document.selection && document.selection.type != "Control") {
//         document.selection.createRange().pasteHTML(html);
//     }
// }


// function insertIntoFormula(specialChar, pos) {
//     const textarea = $('#input-message-visible-message').find('p').text();
//     let value = textarea;
//     let beforeText = value.slice(0, pos);
//     let afterText = value.slice(pos);
//     value = beforeText + specialChar + afterText;
//     $('#input-message-visible-message').find('p').text(value);
//     // $('#input-message-visible-message').find('.ql-editor.ql-blank.dx-htmleditor-content').focus();
//     messageInputVisibleMessage = $('#input-message-visible-message').find('p').text();
// }
//
// function textInputCursor(el) {
//     const selection = window.getSelection();
//     const range = document.createRange();
//     selection.removeAllRanges();
//     range.selectNode(el);
//     range.collapse(false);
//     selection.addRange(range);
//     el.focus();
// }
//
// function uniq(a) {
//     return Array.from(new Set(a));
// }


/**
 * Thực hiện đăng kí socket đang soạn tin nhắn cho Công ty/Nhà hàng
 */
function typingOnTMSRestaurantVisible() {
    if (checkTypingTMSRestaurantVisible === 0) {
        socket.emit('user-is-typing', {
            group_id: idCurrentConversation,
            member_id: idSession
        })
        console.log('user-is-typing', {
            group_id: idCurrentConversation,
            member_id: idSession
        })
        setTimeout(function () {
            typingOffTMSRestaurantVisible()
        }, 3000);
        checkTypingTMSRestaurantVisible = 1;
    }
}

function typingOffTMSRestaurantVisible() {
    socket.emit('user-is-not-typing', {
        group_id: idCurrentConversation,
        member_id: idSession
    });
    checkTypingTMSRestaurantVisible = 0;
}

/**
 * Thực hiện đăng kí socket đang soạn tin nhắn cho nhà cung cấp
 */
function typingOnTMSSupplierVisible() {
    if (checkTypingTMSSupplierVisible === 0) {
        socket.emit('user-is-typing-tms-supplier', {
            group_id: idCurrentConversation,
            member_id: idSession,
        });
        setTimeout(function () {
            typingOffTMSSupplierVisible()
        }, 3000);
        checkTypingTMSSupplierVisible = 1;
    }
}

function typingOffTMSSupplierVisible() {
    socket.emit('user-is-not-typing-tms-supplier', {
        group_id: idCurrentConversation,
        member_id: idSession,
    })
    checkTypingTMSSupplierVisible = 0;
    console.log('user-is-not-typing-tms-supplier', {
        group_id: idCurrentConversation,
        member_id: idSession,
    })
}

/**
 * Xử lí đặt dấu nháy ở phía cuối cùng nội dung chat trong input
 */
function setPositionMouseVisibleMessage() {
    var el = document.getElementById("input-message-visible-message"),
        range = document.createRange(),
        sel = window.getSelection();

    range.setStart(el.firstChild.firstChild.firstChild, 2);
    range.collapse(true);

    sel.removeAllRanges();
    sel.addRange(range);
}
