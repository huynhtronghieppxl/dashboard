let checkLoadPinDetailAboutVisibleMessage = 0, pagePinDetailAboutVisibleMessage = 1,
    limitPinDetailAboutVisibleMessage = 10, currentLimitPinDetailAboutVisibleMessage = 10;
let checkLoadVoteDetailAboutVisibleMessage = 0, pageVoteDetailAboutVisibleMessage = 1,
    limitVoteDetailAboutVisibleMessage = 10, currentLimitVoteDetailAboutVisibleMessage = 10;
$(function () {
    $('.pin-details-content-about-visible-message').on('scroll', function () {
        if ($(this).innerHeight() + $(this).scrollTop() + 300 >= $(this)[0].scrollHeight) {
            if (currentLimitPinDetailAboutVisibleMessage === limitPinDetailAboutVisibleMessage) {
                dataPinDetailAboutVisibleMessage();
            }
        }
    })
    $('.vote-details-content-about-visible-message').on('scroll', function () {
        if ($(this).innerHeight() + $(this).scrollTop() + 300 >= $(this)[0].scrollHeight) {
            if (currentLimitVoteDetailAboutVisibleMessage === limitVoteDetailAboutVisibleMessage) {
                dataVoteDetailAboutVisibleMessage();
            }
        }
    })
    $('#pin-layout-visible-message .nav-tabs-visible-message .nav-item:eq(1)').on('click', function () {
        dataVoteDetailAboutVisibleMessage();
    })
})

async function dataPinDetailAboutVisibleMessage() {
        let method = 'get',
            url = 'visible-message.detail-pinned-conversation',
            params = {
                id: idCurrentConversation,
                page: pagePinDetailAboutVisibleMessage,
                limit: limitPinDetailAboutVisibleMessage,
                type: typeCurrentConversation
            },
            data = null;
        let res = await axiosTemplate(method, url, params, data);
    $('.pin-details-content-about-visible-message').append(res.data[0]); // hard code

        // switch (res.data[0].message_pinned.message_type) {
        //     case 2:
        //         let secondSize = ((int)(data.message_pinned.files[0].size) + 1000) / 1000;
        //         let minute = Math.floor(secondSize / 60);
        //         let second = Math.floor(secondSize - minute * 60);
        //         if (minute < 10) minute = '0' + minute;
        //         if (second < 10) second = '0' + second;
        //         console.log(minute + ':' + second, "sdfsfsfs");
        //         $('.pin-details-content-image-header').attr('src', domainSession + data.sender.avatar);
        //         $('.pin-details-content-item-bottom div').text(data.sender.full_name + ': ' + 'Đã ghim tin nhắn thoại');
        //         $('.name-user-pined-body-content').text(data.message_pinned.sender.full_name);
        //         $('.content-pined-visible-message.body-visible-message .chat-body-message').html(`<div class="chat-body-message-audio">
        //                                                                                             <div class="chat-audio-header d-flex align-items-center">
        //                                                                                                 <a title="Play" class="sound-container-play" data-audio="${domainSession + data.message_pinned.files[0].link_original}">
        //                                                                                                     <i class="fa fa-play-circle play-audio-btn"></i>
        //                                                                                                     <i class="fa fa-pause stop-audio-btn d-none"></i>
        //                                                                                                 </a>
        //                                                                                                 <div class="chat-audio-name" data-duration="${data.message_pinned.files[0].size}">${data.message_pinned.files[0].name_file}</div>
        //                                                                                             </div>
        //                                                                                             <div class="play-audio-body-message">
        //                                                                                                 <div class="sound-container-time sound-duration-time">00:00</div>
        //                                                                                                 <div class="progress">
        //                                                                                                     <div class="currentValue" style="width: 100%;">
        //                                                                                                         <div class="media-fixed-progress-bar-dot"></div>
        //                                                                                                     </div>
        //                                                                                                     <input type="range" min="0" max="100" value="0" id="progress" class="progress-bar-audio" />
        //                                                                                                 </div>
        //                                                                                                 <div class="sound-resutl-time">00:00</div>
        //                                                                                             </div>
        //                                                                                         </div>
        //                                                                                         `);
        // }
        $('#div-empty-pinned').remove();
        pagePinDetailAboutVisibleMessage++;
        currentLimitPinDetailAboutVisibleMessage = res.data[1].data.length;
        $('.pin-details-content-about-visible-message').append(res.data[0]);
    // }
}

function resetPinDetailAboutVisibleMessage() {
    checkLoadPinDetailAboutVisibleMessage = 0;
    pagePinDetailAboutVisibleMessage = 1;
    $('#pin-visible-message').addClass('d-none');
    $('.pin-details-content-about-visible-message').html('');
    $('#pin-layout-visible-message').removeClass('show');
}

async function dataVoteDetailAboutVisibleMessage() {
    if (checkLoadVoteDetailAboutVisibleMessage === 0) {
        checkLoadVoteDetailAboutVisibleMessage = 1;
        let method = 'get',
            url = 'visible-message.detail-vote-conversation',
            params = {
                type: typeCurrentConversation,
                id: idCurrentConversation,
                page: pageVoteDetailAboutVisibleMessage,
                limit: limitVoteDetailAboutVisibleMessage
            },
            data = null;
        let res = await axiosTemplate(method, url, params, data);
        $('#div-empty-vote').remove();
        pageVoteDetailAboutVisibleMessage++;
        // currentLimitVoteDetailAboutVisibleMessage = res.data[1].data.total_record;
        currentLimitVoteDetailAboutVisibleMessage = 1; // hardcode
        checkLoadVoteDetailAboutVisibleMessage = 1;
        $('.vote-details-content-about-visible-message').append(res.data[0]);
    }
}

function resetVoteDetailAboutVisibleMessage() {
    checkLoadVoteDetailAboutVisibleMessage = 0;
    pageVoteDetailAboutVisibleMessage = 1;
    $('.vote-details-content-about-visible-message').html('');
}

function openNewFeedDetailVisibleMessage() {
    $('.detail-pin-visible-message').click();
}
