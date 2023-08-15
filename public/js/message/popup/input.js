let messageInputVisibleMessage = '', messageInputVisibleMessagePopup = '', sizeAudioPopup, fileAudioPopup = [], listLinkInputPopup = [], messageInputPopupMessage = '', listTagInputPopupMessage = [], keyTagNamePopup = '';
let checkTypingTMSSupplierPopup = 0, checkTypingTMSRestaurantPopup = 0, timePopup;
let arrFormatLink = ['aero', 'com', 'vn', 'net', 'org', 'info', 'biz', 'gov', 'edu'];
let linkLoadCurrent = '';
$(function(){
    $(document).on('click', '.chat-footer-message-animation.chat-footer-option-icon.fa.fa-smile-o',function () {
        console.log('click')
        $(this).parents('.chat-footer-message').find('emoji-picker').toggleClass('d-none');
        $('emoji-picker .search-row').attr('style', 'display:none !important')
    });
    document.querySelector('emoji-picker').addEventListener('emoji-click', event => addEmojiPopup(event.detail.unicode));

});
$(document).on('input paste', '.chat-footer-message-input', function (){
    if(typeCurrentConversationPopup === 3) {
        typingOnTMSSupplierPopup();
    }
    else {
        // typingOnTMSRestaurantPopup();
    }
    // setCursorMarker($(this).text(), this);
    // $('.dx-htmleditor-content').removeClass('ql-blank');
    /**
     * Chuyển string -> array
     */
    let arrayInput = $(this).text().split(" ");
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
    listLinkInputPopup = [];
    jQuery.each(link, function (i, v) {
        listLinkInputPopup.push(arrayInput.filter(item => item.includes(v) === true)[0]);
    })
    if (fullLastLink.length > 0 && $('.layout-preview-input-popup-message').hasClass('d-none') && lastLink !== linkLoadCurrent) {
        $.ajax({
            url: "https://api.linkpreview.net",
            dataType: 'jsonp',
            data: {q: fullLastLink[0], key: 'f2f1689461771f55c1f51febe2820926'},
            success: function (response) {
                console.log(response)
                $('#image-thumbnail-preview-popup').attr('src', response.image);
                $('#title-thumbnail-preview-popup').text(response.title);
                $('#text-link-thumbnail-preview-popup').text(response.url);
                $('#link-thumbnail-preview-popup').attr('src', response.url);
                $('.layout-preview-input-popup-message').removeClass('d-none');
                eventInputTypePopupMessage();
                $('.layout-thumbnail-preview-popup-message').unbind('click').on('click', function () {
                    window.open($(this).find('#link-thumbnail-preview-popup').attr('src'), '_blank');
                })
            },
        });
    }
})

/**
 * Tắt thumbnail
 * */
let textReplyInputPopup = '';
$(document).on('click', '.icon-close-thumbnail-image-close-reply-popup, .icon-close-thumbnail-link-popup-message', function (){
    $('.layout-reply-input-popup-message').addClass('d-none');
    $('.layout-preview-input-popup-message').addClass('d-none');
    let textInput = $('.chat-footer-message-input').text();
    eventInputTypePopupMessage();
    if (textInput.trim() === textReplyInputPopup.trim() && textInput.length === textReplyInputPopup.length) {
        listTagInputPopupMessage = [];
        messageInputPopupMessage = '';
        $('.chat-footer-message-input').text('');
    }
    $('#chat-popup-layout').find('.chat-footer-message-input').focus();
})

/**
 * Reply hiện khung
 */
$(document).on('click', '#chat-body-message-popup .chat-body-message-item-action-item.item-action-reply', function () {
    $('#chat-popup-layout').find('.chat-footer-message-input').focus();
    $('.layout-audio-visible-message').addClass('d-none');
    // $('.record-visible-message').removeClass('active');
    $('#chat-footer-message').removeClass('d-none');
    let data_type = $(this).parents('.chat-body-message-element').data('type'),
        name = $(this).parents('.chat-body-message-element').data('name'),
        sender = $(this).parents('.chat-body-message-element').data('sender'),
        text = $(this).parents('.chat-body-message-element').find('.chat-body-message-text').text(),
        imageReply = $(this).parents('.chat-body-message').find('img:first-child').attr('src'),
        countImage = $(this).parents('.chat-body-message').find('.chat-body-message-image img').length,
        avatar = $(this).parents('.chat-body-message-element').data('avatar');
    $('.layout-reply-input-popup-message').attr('data-id', $(this).parents('.chat-body-message-element').data('id'));
    $('.layout-reply-input-popup-message').attr('data-random-key', $(this).parents('.chat-body-message-element').data('random-key'));
    $('.layout-reply-input-popup-message').attr('data-type', data_type);
    if(data_type == 7){
        text = $(this).parents('.chat-body-message-element').find('.chat-body-message-item-reply-text').text();
    }
    let html = '';
    switch (data_type) {
        case 2:
            html = `<img class="img-thumbnail-link-input-popup-message"
                     src="${imageReply}" alt=""/>`
            $('#image-id-reply-popup-message').html(html);
            $('#name-reply-name-popup').text(name);
            $('.footer-text-input-thumbnail-reply-popup-message').text(' [Đã gửi ' + countImage + ' hình ảnh]');
            break;
        case 3:
            html = `<img class="img-thumbnail-link-input-popup-message"
                     src="${imageReply}" alt=""/>`
            $('#image-id-reply-popup-message').html(html);
            $('#name-reply-name-popup').text(name);
            $('.footer-text-input-thumbnail-reply-popup-message').text(' [Đã gửi File]');
            break;
        case 4:
            html = `<img class="img-thumbnail-link-input-popup-message"
                     src="${imageReply}" alt=""/>`
            $('#image-id-reply-popup-message').html(html);
            $('#name-reply-name-popup').text(name);
            $('.footer-text-input-thumbnail-reply-popup-message').text(' [Đã gửi Sticker]');
            break;
        case 5:
            html = `<img class="img-thumbnail-link-input-popup-message"
                     src="${imageReply}" alt="video"/>`
            $('#image-id-reply-popup-message').html(html);
            $('#name-reply-name-popup').text(name);
            $('.footer-text-input-thumbnail-reply-popup-message').text(' [Đã gửi Video]');
            break;
        case 6:
            html = `<img class="img-thumbnail-link-input-popup-message"
                     src="/images/tms/audio.png" alt=""/>`
            $('#image-id-reply-popup-message').html(html);
            $('#name-reply-name-popup').text(name);
            $('.footer-text-input-thumbnail-reply-popup-message').text(' [Đã gửi Ghi âm]');
            break;
        default:
            $('.img-thumbnail-link-input-popup-message').remove();
            $('#name-reply-name-popup').text(name);
            $('.footer-text-input-thumbnail-reply-popup-message').text(text);
            break;
    }
    $('.layout-reply-input-popup-message').removeClass('d-none');
    // sizeBodyMessageThumbnail();
    eventInputTypePopupMessage();
    //idSession
    // if (sender !== idSession ) {
    //     let htmlSpan = ` <span class="dx-mention" id="mention-reply" spellCheck="false" data-marker="@" data-mention-value=""
    //           data-id="2501">&#xFEFF;<span contentEditable="false"><span>@</span>${name} </span>&#xFEFF;</span>&#xFEFF`;
    //     $('#input-message-visible-message').find('p').html(htmlSpan);
    //     textInputCursor($('.dx-htmleditor-content p')[0]);
    // }else {
    //     $('.dx-htmleditor-content').focus();
    // }
    // keyTagNamePopup = name.replace(name, moment().format('x'));
    keyTagNamePopup = $('#mention-reply').text();
    textReplyInputPopup = $('.chat-footer-message-input').text() + '  ';
    // listTagInputVisibleMessage.push({
    //     member_id: sender,
    //     full_name: name,
    //     key_tag_name: keyTagNamePopup,
    //     avatar: avatar
    // });

})

/**
 * Ẩn hiện ghi âm
 */
$('#item-option-footer-popup-audio').on('click', function () {
    if ($('#chat-popup-layout .layout-audio-visible-message').hasClass('d-none')) {
        $('#chat-popup-layout .layout-audio-visible-message').removeClass('d-none');
        $('#chat-popup-layout .chat-footer-popup-action').addClass('d-none');
        $('#chat-popup-layout .chat-footer-popup-action').removeClass('d-flex');
        $('#chat-popup-layout .chat-footer-message').addClass('d-none');
        $('#chat-popup-layout .chat-footer-send').addClass('d-none');
    }
    // else {
    //     $('#chat-popup-layout .layout-audio-visible-message').addClass('d-none');
    //     $('#chat-popup-layout .chat-footer-popup-action').removeClass('d-none');
    //     $('#chat-popup-layout .chat-footer-message').removeClass('d-none');
    //     $('#chat-popup-layout .chat-footer-send').removeClass('d-none');
    //     $('#chat-popup-layout .chat-footer-message-input').focus();
    // }
})
$('#turn-off-record-popup-message').on('click', function () {
    $('#chat-popup-layout .layout-audio-visible-message').addClass('d-none');
    $('#chat-popup-layout .chat-footer-popup-action').removeClass('d-none');
    $('#chat-popup-layout .chat-footer-popup-action').addClass('d-flex');
    $('#chat-popup-layout .chat-footer-message').removeClass('d-none');
    $('#chat-popup-layout .chat-footer-send').removeClass('d-none');
    $('#chat-popup-layout .chat-footer-message-input').focus();
    resetTimerAudio();
    $('.time-record-visible-message').text('00:00')
    $('#button').removeClass('recording');
})

$('#reset-record-popup-message').click(function () {
    resetTimerAudio();
    $('.time-record-visible-message').text('00:00')
    $('#button').removeClass('recording');
})

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

    $(document).on('click', '#button', function (){
        if (btn_status == 'inactive') {
            $(this).addClass('recording');
            $('.recorder-visible-message').removeAttr('data-original-title')
            $('.recorder-visible-message').attr('data-original-title','Nhấn vào để ngưng ghi âm');
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover'
            });
            start();
        } else if (btn_status == 'recording') {
            $(this).removeClass('recording');
            stop();
            $('.recorder-visible-message').removeAttr('data-original-title')
            $('.recorder-visible-message').attr('data-original-title','Nhấn vào để ghi âm');
            console.log( $('.recorder-visible-message').data('original-title'))
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover'
            });
        }
    })

    function start() {
        resetTimerAudio();
        startTimerAudio();
        $('#reset-record-popup-message').addClass('d-none');
        $('#send-audio-input-popup-message').addClass('d-none');
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
                fileAudioPopup = [{
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
        $('#reset-record-popup-message').removeClass('d-none');
        $('#send-audio-input-popup-message').removeClass('d-none');
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
    clearTimeout(timePopup);
}

function startTimerAudio() {
    clearTimeout(timePopup);
    timePopup = setInterval(buildTimerAudio, 1000);
    restart = 1;

}

function timeAudio() {
    clearTimeout(timePopup);
    timePopup = setInterval(buildTimeAudio, 1000);
    restart = 1;

}

function resetTimerAudio() {
    restart = 0;
    seconds = 0;
    minutes = 0;
    clearTimeout(timePopup);
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
    timeCurrentAudioPopup.text((minutes < 10 ? "0" + minutes.toString() : minutes) + ":" + (seconds < 10 ? "0" + seconds.toString() : seconds));
    if (seconds === 300) {
        stop();
    }
}


function rangeTimeAudio(r) {
    setInterval(function () {
        r.parents('.chat-body-message-audio').find('.progress .currentValue').css({width: r.parents('.chat-body-message-audio').find('.audio-message-visible')[0].currentTime / r.parents('.chat-body-message-audio').find('.audio-message-visible')[0].duration * 100 + '%'});
    }, 1000 / 60);
}

function typingOnTMSSupplierPopup() {
    if (checkTypingTMSSupplierPopup === 0) {
        socket.emit('user-is-typing-tms-supplier', {
            group_id: idCurrentConversation,
            member_id: idSession
        })
        console.log('user-is-typing-tms-supplier', {
            group_id: idCurrentConversation,
            member_id: idSession
        })
        setTimeout(function () {
            typingOffTMSSupplierPopup()
        }, 2000);
        checkTypingTMSSupplierPopup = 1;
    }
}

function typingOffTMSSupplierPopup() {
    socket.emit('user-is-not-typing-tms-supplier', {
        group_id: idCurrentConversation,
        member_id: idSession
    })
    checkTypingTMSSupplierPopup = 0;
    console.log('user-is-not-typing-tms-supplier', {
        group_id: idCurrentConversation,
        member_id: idSession
    })

}

function typingOnTMSRestaurantPopup() {
    if (checkTypingTMSRestaurantPopup === 0) {
        socket.emit('user-is-typing', {
            group_id: idCurrentConversation,
            member_id: idSession
        })
        console.log('user-is-typing', {
            group_id: idCurrentConversation,
            member_id: idSession
        })
        setTimeout(function () {
            typingOffTMSRestaurantPopup()
        }, 2000);
        checkTypingTMSRestaurantPopup = 1;
    }
}

function typingOffTMSRestaurantPopup() {
    socket.emit('user-is-not-typing', {
        group_id: idCurrentConversation,
        member_id: idSession
    })
    checkTypingTMSRestaurantPopup = 0;
    console.log('user-is-not-typing', {
        group_id: idCurrentConversation,
        member_id: idSession
    })
}

let caretPosPopup = 0;


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
    caretPosPopup = caretOffset;
}


function addEmojiPopup(emoji) {
    $(".chat-footer-message").find('.chat-footer-message-input').focus();
    // insertHTMLAtCaret("<p class='app-moji'>"+ emoji +"</p>");
    this.insertIntoFormula(`${emoji}`, caretPosPopup);
    this.insertIntoFormulaPopup(`${emoji}`, caretPosPopup);
}

function setCursorMarker(text, element) {
    const [pos] = getCaretPosition(element)
    text = text.slice(0, pos + 1) + text.slice(pos + 1, text.length);
    caretPosPopup = pos + 1;
}

function node_walk(node, func) {
    var result = func(node);
    for (node = node.firstChild; result !== false && node; node = node.nextSibling)
        result = node_walk(node, func);
    return result;
}

function getCaretPosition(elem) {
    var sel = window.getSelection();
    var cum_length = [0, 0];
    if (sel.anchorNode == elem)
        cum_length = [sel.anchorOffset, sel.extentOffset];
    else {
        var nodes_to_find = [sel.anchorNode, sel.extentNode];
        if (!elem.contains(sel.anchorNode) || !elem.contains(sel.extentNode))
            return undefined;
        else {
            var found = [0, 0];
            var i;
            node_walk(elem, function (node) {
                for (i = 0; i < 2; i++) {
                    if (node == nodes_to_find[i]) {
                        found[i] = true;
                        if (found[i == 0 ? 1 : 0])
                            return false; // all done
                    }
                }
                if (node.textContent && !node.firstChild) {
                    for (i = 0; i < 2; i++) {
                        if (!found[i])
                            cum_length[i] += node.textContent.length;
                    }
                }
            });
            cum_length[0] += sel.anchorOffset;
            cum_length[1] += sel.extentOffset;
        }
    }
    if (cum_length[0] <= cum_length[1])
        return cum_length;
    return [cum_length[1], cum_length[0]];
}

function insertIntoFormula(specialChar, pos) {
    const textarea = $('#input-message-visible-message').find('p').text();
    let value = textarea;
    let beforeText = value.slice(0, pos);
    let afterText = value.slice(pos);
    value = beforeText + specialChar + afterText;
    $('#input-message-visible-message').find('p').text(value);
    // $('#input-message-visible-message').find('.ql-editor.ql-blank.dx-htmleditor-content').focus();
    messageInputVisibleMessage = $('#input-message-visible-message').find('p').text();
}

function insertIntoFormulaPopup(specialChar, pos) {
    const textarea = $('.chat-footer-message').find('.chat-footer-message-input').text();
    let value = textarea;
    let beforeText = value.slice(0, pos);
    let afterText = value.slice(pos);
    value = beforeText + specialChar + afterText;
    $('.chat-footer-message').find('.chat-footer-message-input').text(value);
    messageInputVisibleMessagePopup = $('.chat-footer-message').find('.chat-footer-message-input').text();
}

function textInputCursor(el) {
    const selection = window.getSelection();
    const range = document.createRange();
    selection.removeAllRanges();
    range.selectNode(el);
    range.collapse(false);
    selection.addRange(range);
    el.focus();
}

function uniq(a) {
    return Array.from(new Set(a));
}
