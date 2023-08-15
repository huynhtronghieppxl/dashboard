$(function () {
    const pickerOptions = {
        onEmojiSelect: handleEmojiSelect,
        previewPosition: 'none',
        emojiButtonSize: '36',
        emojiSize: '24',
        forLine: '10',
        maxFrequentRows: '1',
        locale: 'vi',
        emojiVersion: '14',
        set: 'apple',
        noCountryFlags:'false'
    }
    const picker = new EmojiMart.Picker(pickerOptions)
    $('#emoji-mart').append(picker)

    $(document).on('mouseup', function (e) {
        let container = $('#emoji-mart');
        if (!container.is(e.target) && container.has(e.target).length === 0 && !$('emoji-mart').hasClass('d-none')) {
            $('#emoji-mart').addClass('d-none');
        }
    });
})

async function handleEmojiSelect(emoji) {
    let htmlEditor = $('#input-message-visible-message').dxHtmlEditor('instance');
    let icon_emoji = emoji.native;

    let currentValue = htmlEditor.option('value');
    if (currentValue) {
        const spanArray = [];
        const positionArray = [];
        const parser = new DOMParser();
        const doc = parser.parseFromString(currentValue, 'text/html');
        const spans = doc.querySelectorAll('span.dx-mention');

        spans.forEach((span, index) => {
            const spanText = span.outerHTML;
            const position = currentValue.indexOf(spanText);
            spanArray.push(spanText);
            positionArray.push(position);
        });
        let positionArrayAfterReplace = []
        let currentSpanTextLength = 0
        spans.forEach((span, index) => {
            const spanText = span.outerHTML;
            let position;
            if (index != 0) {
                position = currentValue.indexOf(spanText) - currentSpanTextLength;
            } else {
                position = currentValue.indexOf(spanText)
            }
            currentSpanTextLength += spanText.length
            positionArrayAfterReplace.push(position);
        });

        spanArray.forEach((span) => {
            currentValue = currentValue.replace(span, '');
        });
        $(document).off('DOMNodeRemoved', '.dx-mention');
        let newValue
        let cursorPositionVisibleCurrent = cursorPositionVisible + 3
        let count = 0
        positionArrayAfterReplace.forEach((position) => {
            if (cursorPositionVisibleCurrent > position) {
                count++
            }
        });
        newValue = currentValue.substring(0, cursorPositionVisible - count + 3) + icon_emoji + currentValue.substring(cursorPositionVisible - count + 3);
        let countMention = 0
        spanArray.forEach((span, index) => {
            if (positionArrayAfterReplace[index] > cursorPositionVisible + 1) {
                newValue = newValue.substring(0, positionArray[index] + icon_emoji.length) + span + newValue.substring(positionArray[index] + icon_emoji.length);
            } else {
                newValue = newValue.substring(0, positionArray[index]) + span + newValue.substring(positionArray[index]);
                countMention += 2
            }
        });
        await $('.dx-htmleditor-content').html(newValue)
        cursorPositionVisible += icon_emoji.length
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
    } else {
        $('.dx-htmleditor-content').find('p').append(emoji.native)
        cursorPositionVisible=2
    }
    sizeBodyMessageThumbnail()
}


