let dataMemberConversationTag = [];
let htmlEditor;
let dataMemberConversationTagCurrent
$(function () {
    /**
     * tag tên
     */

    $(document).on('click', '.dx-list-item', async function (e) {
        $('.dx-popup-content').addClass('active');
        let name = $(this).find('.li-tag-event').data('name'),
            id = $(this).find('.li-tag-event').data('id'),
            avatar = $(this).find('.li-tag-event').data('avatar');
        messageInputVisibleMessage = $('#input-message-visible-message').find('p').html();
        keyTagName = name.replace(name, moment().format('x'));
        listTagInputVisibleMessage.push({
            member_id: id,
            full_name: name,
            avatar: avatar,
            key_tag_name: keyTagName,
        });
        let selection = htmlEditor.getSelection();
        let val = htmlEditor.option("value");
        let cursorPosition = selection.index + selection.length;
        dataMemberConversationTagCurrent = dataMemberConversationTagCurrent.filter(o1 => o1.member_id !== id);
        renderDataTagVisibleMessage(dataMemberConversationTagCurrent);
        $(document).off('DOMNodeRemoved', '.dx-mention');
        await $('.dx-htmleditor-content').html(val)
        htmlEditor.focus();
        setTimeout(function () {
            selection.start = cursorPosition;
            selection.end = cursorPosition;
            htmlEditor.setSelection(selection);
        }, 0)
        $(document).on('DOMNodeRemoved', '.dx-mention', function (e) {
            if (e.target === $(this)[0]) {
                let id = $(this)[0].dataset.id
                if (id != -1) {
                    let result = listTagInputVisibleMessage.find(function (obj) {
                        return obj.member_id == id;
                    });
                    let index = listTagInputVisibleMessage.findIndex(function (obj) {
                        return obj.member_id == id;
                    });
                    if (index != -1) {
                        listTagInputVisibleMessage.splice(index, 1);
                    }
                    dataMemberConversationTagCurrent = dataMemberConversationTagCurrent.concat([result])
                } else {
                    dataMemberConversationTagCurrent.unshift({
                        "avatar": "/images/chat/@_mention.png",
                        "member_id": -1,
                        "full_name": "All"
                    });
                }
                callRenderDataTagVisibleMessage()
            }
        });

    });

})

function callRenderDataTagVisibleMessage() {
    setTimeout(async function () {
        let selection = htmlEditor.getSelection();
        let val = htmlEditor.option("value");
        let cursorPosition = selection.index + selection.length;
        renderDataTagVisibleMessage(dataMemberConversationTagCurrent);
        $(document).off('DOMNodeRemoved', '.dx-mention');
        await $('.dx-htmleditor-content').html(val)
        htmlEditor.focus();
        setTimeout(function () {
            selection.start = cursorPosition;
            selection.end = cursorPosition;
            htmlEditor.setSelection(selection);
        }, 0)
        $(document).on('DOMNodeRemoved', '.dx-mention', function (e) {
            if (e.target === $(this)[0]) {
                let id = $(this)[0].dataset.id
                if (id != -1) {
                    let result = listTagInputVisibleMessage.find(function (obj) {
                        return obj.member_id == id;
                    });
                    let index = listTagInputVisibleMessage.findIndex(function (obj) {
                        return obj.member_id == id;
                    });
                    if (index != -1) {
                        listTagInputVisibleMessage.splice(index, 1);
                    }
                    dataMemberConversationTagCurrent = dataMemberConversationTagCurrent.concat([result])
                } else {
                    dataMemberConversationTagCurrent.unshift({
                        "avatar": "/images/chat/@_mention.png",
                        "member_id": -1,
                        "full_name": "All"
                    });
                }
                callRenderDataTagVisibleMessage()
            }
        });
    }, 0);
}

function renderDataTagVisibleMessage(r) {
    if (r.length == 0) {
        $('.dx-overlay-content.dx-popup-normal.dx-popup-draggable.dx-resizable').addClass('d-none')
        return
    } else $('.dx-overlay-content.dx-popup-normal.dx-popup-draggable.dx-resizable').removeClass('d-none')
    r = [r[0]].concat(r.slice(1).sort(function (a, b) {
        let nameA = a.full_name.toUpperCase();
        let nameB = b.full_name.toUpperCase();
        if (nameA < nameB) {
            return -1;
        } else if (nameA > nameB) {
            return 1;
        } else {
            return 0;
        }
    }));
    htmlEditor = $('#input-message-visible-message').dxHtmlEditor({
        abortUpload: function (file, uploadInfo) {
        },
        onOptionChanged: function (e) {
            $('.dx-empty-message').text('Không tìm thấy dữ liệu')
            if ($('#input-message-visible-message').find('.dx-htmleditor-content p').text() !== '') {
                $('#like-input-visible-message').addClass('d-none');
                $('#button-send-message-visible-message').removeClass('d-none');
            } else {
                if ($('.layout-media-input-visible-message').hasClass('d-none')) {
                    $('#like-input-visible-message').removeClass('d-none');
                    $('#button-send-message-visible-message').addClass('d-none');
                } else {
                    $('#like-input-visible-message').addClass('d-none');
                    $('#button-send-message-visible-message').removeClass('d-none');
                }
            }
            if ($('#input-message-visible-message p img').length > 0) {
                let imgThumbnail = $('#input-message-visible-message').find('img').attr('src');
                $('#input-message-visible-message').find('img').remove();
                $('.layout-media-input-visible-message').removeClass('d-none');
                $('.layout-media-input-visible-message .list-media').append(`
                                        <div class="item-media-input-visible-message item-image">
                                            <span class="remove-item-media-input-visible-message"><i
                                                    class="typcn typcn-times"></i></span>
                                            <div class="image-item-media-input-visible-message">
                                                <img class="image-paste" src="${imgThumbnail}" alt="">
                                            </div>
                                        </div>`);
                let countImage = ($('.layout-media-input-visible-message .item-media-input-visible-message.item-image').length > 99) ? '99+' : $('.layout-media-input-visible-message .item-media-input-visible-message').length;
                $('.layout-media-input-visible-message .count-image').removeClass('d-none');
                $('#count-image-input-visible-message').text(countImage);
                sizeBodyMessageThumbnail();
            }
        },
        activeStateEnabled: true,
        allowSoftLineBreak: true,
        placeholder: 'Nhập tin nhắn tại đây',
        mentions: [{
            marker: "@",
            component: null,
            searchTimeout: 0,
            dataSource: r,
            searchExpr: 'full_name',
            displayExpr: 'full_name',
            mediaResizing: {
                enabled: true
            },
            itemTemplate: function (item, itemIndex, itemElement) {
                try {
                    itemElement.append(`<div class="li-tag-event" data-id="${item.member_id}" data-name="${item.full_name}" data-avatar="${item.avatar}">
                                <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" loading="lazy" class="image-tag" src="${item.avatar}">
                                <span class="span-tag-event">${item.full_name}</span>
                            </div>`)
                } catch (error) {

                }
            },
            valueExpr: 'member_id',

        }],
    }).dxHtmlEditor("instance");

    $('.dx-overlay-content.dx-popup-normal.dx-popup-draggable.dx-resizable').prepend(`<div class="header-tag-name-contain">
                                                                                                    <img src="/images/chat/@_mention.png" alt="" class="header-tag-name-contain-img" />
                                                                                                    <div class="header-tag-name-contain-info">
                                                                                                        <div class="header-tag-name-contain-text">Bấm ⇧ hoặc ⇩ và Enter để chọn người cần nhắc tên</div>
                                                                                                    </div>
                                                                                                </div>`);
}

function repeatTagName() {
    let allTagName = [{
        "avatar": "/public/resource/TMS/FOOD/0/0/1/2022/10/5-10-2022/image/original/web-1664944466-icn_mentio...e4.png",
        "member_id": -1,
        "full_name": "Báo cho cả nhóm @ALL"
    }]
    let arrayTagName = allTagName.concat(dataMemberConversation);
    renderDataTagVisibleMessage(arrayTagName);
}



