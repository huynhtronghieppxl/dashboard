let timeCurrentAudio = '';
let isPlaying = false;
$(function () {
    $(window).resize(function(){
        isPaste=0;
        sizeBodyMessageThumbnail()
        // if($(this).width() < 1200 && !$('#layout-body-visible-message').hasClass('about-active')) {
        //     $('#layout-body-visible-message').css('width', '100%');
        // } else if($(this).width() < 1200 && $('#layout-body-visible-message').hasClass('about-active')) {
        //     // $('#layout-body-visible-message').css('width', '100%');
        //     $('#layout-body-visible-message').css('width', 'calc(100vw - 700px - 92px )');
        // }
        // else {
        //     $('#layout-body-visible-message').css('width', 'calc(100wv - 700px - 92px)');
        // }
    });
    /** Ghim tin nhắn hiển thị chi tiết danh sách ghim lên **/
    $(document).on('click', '.detail-pin-visible-message', function () {
        $('#pin-layout-visible-message').addClass('show');
        dataPinDetailAboutVisibleMessage();
        closeModalPinnedCurrentMessage();
    });

    $(document).on('click', '.back-arrow-all-media', function () {
        $('#pin-layout-visible-message').removeClass('show');
    });
    btnOnTop();

    $(document).on('mouseover', '.chat-body-message-element', function (e) {
        if ($(e.target).closest('.chat-body-message-item-reactions').length === 0) {
            $(this).find('.chat-body-message-item-action-list').removeClass('d-none');
        }
    });

    $(document).on('mouseout', '.chat-body-message-element', function () {
        $(this).find('.chat-body-message-item-action-list').addClass('d-none');
    });

    $(document).on('click', '.icon-close-about', function () {
        $('#layout-body-visible-message').removeClass('about-active');
        $('#layout-about-visible-message').addClass('d-none');
        $(this).addClass('d-none');
        $('.icon-open-about').removeClass('d-none');
        // $('#layout-body-visible-message').css('width', '100%');
        $('#layout-body-visible-message').css('width', 'calc(100vw - 350px - 92px )');
    });

    $(document).on('click', '.icon-open-about', function () {
        $('#layout-body-visible-message').addClass('about-active');
        $('#layout-body-visible-message').css('width', 'calc(100vw - 700px - 80px )');
        $('#layout-about-visible-message').removeClass('d-none');
        $('#layout-about-visible-message').css({'width': '350px', 'display': 'block'});
        $(this).addClass('d-none');
        $('.icon-close-about').removeClass('d-none');
        if ($('#layout-about-visible-message').attr('data-log') == 0) {
            dataDetailConversation();
        }
    });

    $('.pin-visible-message-option-item.remove-pin').on('click', function () {
        $('#pin-visible-message').addClass('d-none');
        sizeBodyMessageThumbnail();
    });

    let selectedClass = "";
    $(".filter").click(function () {
        selectedClass = $(this).attr("data-rel");
        $("#gallery").fadeTo(100, 0.1);
        $("#gallery div").not("." + selectedClass).fadeOut().removeClass('animation');
        setTimeout(function () {
            $("." + selectedClass).fadeIn().addClass('animation');
            $("#gallery").fadeTo(300, 1);
        }, 300);
    });

    $(document).on('click', '.recall-message-button', function () {
        if ($(this).parents('.chat-body-message').find('.chat-body-message-text').data('type') === 22) {
            $('#start-call').click();
        } else {
            $('#start-video-call').click();
        }
    });

    /** Xử lý Audio **/
    $(document).on('click', '.sound-container-play', function (e) {
        timeCurrentAudio = $(this).parents('.chat-body-message-audio').find('.sound-duration-time');
        let url = $(this).data('audio');
        let html = `<audio class="audio-message-visible audio-play-message-visible" style="display:none;">
                        <source  src="${url}">
                    </audio>`;
        $(this).parent().toggleClass('sound-mute');
        if (!$(this).parent().find('.play-audio-btn').hasClass('d-none')) {
            $(this).parents('.chat-body-message-audio').find('.media-fixed-progress-bar-dot').addClass('animation');
            isPlaying = true;
            $(this).parents('.chat-body-message-audio').find('.audio-play-message-visible').bind('timeupdate', updateProgress($(this)), e);
            rangeTimeAudio($(this));
            timeAudio();
            buildTimeAudio();
            $(this).parent().append(html);
            $(this).parents('.chat-body-message-audio').find('.audio-message-visible')[0].play();
            $(this).find(".play-audio-btn").addClass("d-none");
            $(this).find(".stop-audio-btn").removeClass("d-none");
            $(this).parent().find(".sound-container-progress").find(".audio-wrapper").addClass("animation");
        } else {
            $(this).parents('.chat-body-message-audio').find('.media-fixed-progress-bar-dot').removeClass('animation');
            isPlaying = false;
            clearInterval(interval);
            $(this).parents('.chat-body-message-audio').find('.audio-play-message-visible').bind('timeupdate', updateProgress($(this)), e);
            $(this).parents('.chat-body-message-audio').find('.audio-message-visible')[0].pause();
            stopTimerAudio();
            $(this).find(".play-audio-btn").removeClass("d-none");
            $(this).find(".stop-audio-btn").addClass("d-none");
            $(this).parent().find(".sound-container-progress").find(".audio-wrapper").removeClass("animation");
        }
        $(this).parent()
            .find("audio")
            .on("ended", function () {
                resetTimerAudio($(this));
                $('.sound-container-time').text('00:00');
                $(this).parents('.chat-body-message-audio').find('.media-fixed-progress-bar-dot').removeClass('animation');
                $(this).parents('.chat-body-message-audio').find('.audio-message-visible')[0].pause();
                $(this).parents('.chat-body-message-audio').find(".stop-audio-btn").addClass("d-none");
                $(this).parents('.chat-body-message-audio').find(".play-audio-btn").removeClass("d-none");
                $(this).parent().find(".sound-container-progress").find(".audio-wrapper").removeClass("animation");
            });
    });

    $(document).on('input', '.progress-bar-audio', function (e) {
        const audio = $(this).parents('.chat-body-message-audio').find('.audio-play-message-visible')[0];
        const {value} = e.target;
        const progressTime = Math.ceil((audio.duration / 100) * value);
        audio.currentTime = progressTime;
    });
});

async function dataPinnedCurrentVisibleMessage() {
    let method = 'get',
        url = 'visible-message.detail-pinned-current-conversation',
        params = {
            id : idCurrentConversation
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data)
    showMessagePinnedCurrentConversation(res.data);
}

async function showMessagePinnedCurrentConversation(data) {
    console.log('du lieu', data);
    if (data._id !== undefined) {
        $('.pin-details-content-item-visible-message .pin-details-content-image-header').attr('src', domainSession + data.sender.avatar);
        $('.pin-details-content-item-visible-message .name-pinner').text(data.sender.full_name);
        $('.pin-details-content-item-visible-message .pin-details-content-image-body').attr('src', domainSession + data.message_pinned.sender.avatar);
        $('.pin-details-content-item-visible-message .name-user-pined-body-content').text(data.message_pinned.sender.full_name);
        $('.pin-details-content-item-visible-message .content-pined-visible-message').html('');
        switch (data.message_pinned.message_type) {
            case 1: //text
                $('.pin-details-content-item-visible-message .content-pined-visible-message').html('<div class="chat-body-message"><div class="chat-body-message-text"></div></div>');
                $('.pin-details-content-item-visible-message .chat-body-message-text').text(data.message_pinned.message);
                break;
            case 2: //image
                $('.pin-details-content-item-visible-message .content-pined-visible-message').html('<div class="chat-body-message">' +
                    '                                                                                 <div class="chat-body-message-image">\n' +
                                                            '                                            <div class="wrapper one-image">\n' +
                                                            '                                                <div class="gallery">\n' +
                                                            '                                                    <div class="gallery__item gallery__item--1">\n' +
                                                            '                                                        <a href="javascript:void(0)" class="gallery__link">\n' +
                                                            '                                                            <img  onerror="imageDefaultOnLoadError($(this))" alt="Hình ảnh" class="gallery__image" loading="lazy" src=""/>\n' +
                                                            '                                                        </a>\n' +
                                                            '                                                    </div>\n' +
                                                            '                                                </div>\n' +
                                                            '                                            </div>\n' +
                                                            '                                        </div>' +
                    '                                                                               </div>');
                $('.pin-details-content-item-visible-message .chat-body-message-image img').attr('src', domainSession + data.message_pinned.files[0].link_original);
                break;
            case 3: //file
                let iconFile = convertImageFile(data.message_pinned.files[0].link_original),
                    sizeFile = convertSizeFile(data.message_pinned.files[0].size),
                    fileName = data.message_pinned.files[0].name_file.split('.').slice(0, -1).join('.');

                $('.pin-details-content-item-visible-message .content-pined-visible-message').html('<div class="chat-body-message"><div class="chat-body-message-file">\n' +
                    '                                            <a href="" download>\n' +
                    '                                                <img class="chat-message-file-icon-image" onerror="imageDefaultOnLoadError($(this))" src="" loading="lazy" data-link_original=""/>\n' +
                    '                                            </a>\n' +
                    '                                            <div class="chat-message-file-content">\n' +
                    '                                                <div class="chat-message-file-action">\n' +
                    '                                                    <span class="chat-message-file-name"></span>\n' +
                    '                                                    <span class="chat-message-file-size-body"></span>\n' +
                    '                                                </div>\n' +
                    '                                                <div class="see-item-image-video-grid-download btn-download-file-upload d-flex">\n' +
                    '                                                    <i class="fa fa-download" data-download="" data-name-file=""></i>\n' +
                    '                                                </div>\n' +
                    '                                            </div>\n' +
                    '                                        </div></div>');

                $('.pin-details-content-item-visible-message .chat-message-file-icon-image').attr('src', iconFile);
                $('.pin-details-content-item-visible-message .chat-message-file-icon-image').attr('data-link_original', data.message_pinned.files[0].link_original);
                $('.pin-details-content-item-visible-message .chat-message-file-name').text(fileName);
                $('.pin-details-content-item-visible-message .chat-message-file-size-body').text(sizeFile);
                $('.pin-details-content-item-visible-message .chat-body-message-file i').attr('data-link_original', domainSession + data.message_pinned.files[0].link_original);
                $('.pin-details-content-item-visible-message .chat-body-message-file i').attr('data-name-file', fileName);

                 break;
            case 4: //sticker
                $('.pin-details-content-item-visible-message .content-pined-visible-message').html('<div class="chat-body-message">' +
                    '                                                                                   <div class="chat-body-message-sticker">\n' +
                                                            '                                                <img onerror="imageDefaultOnLoadError($(this))" src="" alt="Sticker">\n' +
                                                            '                                        </div>' +
                                                            '                                   </div>');
                $('.pin-details-content-item-visible-message .chat-body-message-sticker img').attr('src', domainSession + data.message_pinned.message);
                break;
            case 5: //video
                $('.pin-details-content-item-visible-message .content-pined-visible-message').html('<div class="chat-body-message-video">\n' +
                    '                                            <div class="chat-message-video-content">\n' +
                    '                                                <img onerror="imageDefaultOnLoadError($(this))" src="\' . $image . \'" data-video="" loading="lazy">\n' +
                    '                                                <i class="play-video-to-link-btn" onclick="viewVideo($(this))">\n' +
                    '                                                    <svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" height="50px" width="50px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" fill="#000" xml:space="preserve">\n' +
                    '                                                        <path class="stroke-solid" fill="none" stroke=""\n' +
                    '                                                                d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7\n' +
                    '                                                                                        C97.3,23.7,75.7,2.3,49.9,2.5"/>\n' +
                    '                                                        <path class="icon" fill="#fff" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z" />\n' +
                    '                                                    </svg>\n' +
                    '                                                </i>\n' +
                    '                                            </div>\n' +
                    '                                        </div>');
                $('.pin-details-content-item-visible-message .chat-body-message-video img').attr('src', domainSession + data.message_pinned.files[0].link_thumb);
                $('.pin-details-content-item-visible-message .chat-body-message-video img').attr('data-video', domainSession + data.message_pinned.files[0].link_original);
                break;
            case 6: //audio
                $('.pin-details-content-item-visible-message .content-pined-visible-message').html('<div class="chat-body-message">' +
                    '                                             <div class="chat-body-message-audio">\n' +
                    '                                                <div class="chat-audio-header d-flex align-items-center">\n' +
                    '                                                    <a title="Play" class="sound-container-play" data-audio="">\n' +
                    '                                                        <i class="fa fa-play-circle play-audio-btn"></i>\n' +
                    '                                                        <i class="fa fa-pause stop-audio-btn d-none"></i>\n' +
                    '                                                    </a>\n' +
                    '                                                    <div class="chat-audio-name" data-duration=""></div>\n' +
                    '                                                    <div class="see-item-image-video-grid-download audio btn-download-file-upload">\n' +
                    '                                                        <i class="fa fa-download" data-download="" data-name-file=""></i>\n' +
                    '                                                    </div>\n' +
                    '                                                </div>\n' +
                    '                                                <div class="play-audio-body-message">\n' +
                    '                                                    <div class="sound-container-time sound-duration-time">00:00</div>\n' +
                    '                                                    <div class="progress">\n' +
                    '                                                        <div class="currentValue" style="width: 0%;">\n' +
                    '                                                            <div class="media-fixed-progress-bar-dot"></div>\n' +
                    '                                                        </div>\n' +
                    '                                                        <input type="range" min="0" max="100" value="0" id="progress" class="progress-bar-audio"/>\n' +
                    '                                                    </div>\n' +
                    '                                                    <div class="sound-resutl-time">10:10</div>\n' +
                    '                                                </div>\n' +
                    '                                            </div>' +
                    '                                          </div>');
                $('.pin-details-content-item-visible-message .chat-body-message-audio a').attr('data-audio', domainSession + data.message_pinned.files[0].link_original);
                $('.pin-details-content-item-visible-message .chat-body-message-audio .chat-audio-name').attr('data-duration', domainSession + data.message_pinned.files[0].size);
                $('.pin-details-content-item-visible-message .chat-body-message-audio .chat-audio-name').text(data.message_pinned.files[0].name_file);
                $('.pin-details-content-item-visible-message .chat-body-message-audio .see-item-image-video-grid-download i').attr('data-download', domainSession + data.message_pinned.files[0].link_original);
                $('.pin-details-content-item-visible-message .chat-body-message-audio .see-item-image-video-grid-download i').attr('data-name-file', data.message_pinned.files[0].name_file);
                break;
            // case 7://reply
            //     for await (const v of data.message_pinned.list_tag_name) {
            //         data.message_pinned.message = data.message_pinned.message.replace(v.key_tag_name, `<span class="tag-name">@${v.full_name}</span>`);
            //     }
            //     $('.pin-visible-message-text').html(data.message_pinned.sender.full_name + ': ' + data.message_pinned.message);
            //     break;
            // case 8: //link
            //     for await (const v of data.message_pinned.list_tag_name) {
            //         data.message_pinned.message = data.message_pinned.message.replace(v.key_tag_name, `<span class="tag-name">@${v.full_name}</span>`);
            //     }
            //     $('.pin-visible-message-text').html(data.message_pinned.sender.full_name + ': ' + 'Link -> ' + data.message_pinned.message);
            //     break;
            default:
                $('.pin-visible-message-text').text(data.message_pinned.sender.full_name + ': ' + data.message_pinned.message);
        }
    }
}


/** Xử lý Audio **/
function updateProgress(r, e){
    // console.log(r, e)
    // const audio = r.parents('.chat-body-message-audio').find('.audio-play-message-visible')[0];
    // const {value} = e.target;
    // if (isPlaying) {
    //     const {duration, currentTime} = e.target;
    //     let current = Math.ceil((audio.duration / 100) * value);
    //     console.log(current, "sâfafsasf");
    //     // const progressPercent = (currentTime / duration) * 100;
    //     console.log(progressPercent);
    //     $("#progress").val(progressPercent);
    //     if (progressPercent == 100) {
    //         stopTimerAudio();
    //         $(this).parents('.chat-body-message-audio').find('.audio-message-visible')[0].pause();
    //     }
    // }
}

function rangeTimeAudio(r) {
    setInterval(function () {
        r.parents('.chat-body-message-audio').find('.progress .currentValue').css({width: r.parents('.chat-body-message-audio').find('.audio-message-visible')[0].currentTime / r.parents('.chat-body-message-audio').find('.audio-message-visible')[0].duration * 100 + '%'});
    }, 1000 / 60);
}

/** Function xử lý xem video và nút play video **/
function viewVideo(r) {
    let heightImg = r.parents('.chat-message-video-content').find('img').height();
    let widthImg = r.parents('.chat-message-video-content').find('img').width();
    r.parent().height(`${heightImg}px`);
    r.parent().width(`${widthImg}px`);
    r.parent().find("img").addClass("d-none");
    r.parent().find('video').removeClass('d-none');
    r.parent().find('video').attr('style', `height: ${heightImg}px;width: ${widthImg}px;`);
    r.parent().find("video").get(0).play();
    r.parent().find(".play-video-to-link-btn").addClass("d-none");
    r.parent().find(".chat-message-video-count").addClass("d-none");
    r.parent()
        .find("video")
        .on("ended", function () {
            r.parent().find("img").removeClass("d-none");
            r.parent().find('video').addClass('d-none');
            r.parent().find(".play-video-to-link-btn").removeClass("d-none");
            r.parent().find(".chat-message-video-count").removeClass("d-none");
        });
}

/**
 *  reset Body Visible Message
 */
function resetBodyVisibleMessage() {
    $('#data-message-visible-message').html('');
    $('#layout-body-visible-message .pin-message-list-dropdown').removeClass('active');
    $('#tag-input-body-visible-message').addClass('d-none');
    $('.layout-reply-input-visible-message').addClass('d-none');
    $('.layout-audio-visible-message').addClass('d-none');
    $('.layout-preview-input-visible-message').addClass('d-none');
    $('.layout-send-notify-visible-message').addClass('d-none');
    $('.layout-media-input-visible-message').addClass('d-none');

    $('.layout-media-input-visible-message .count-image').addClass('d-none');
    $('.layout-media-input-visible-message .count-video').addClass('d-none');
    $('.layout-media-input-visible-message .count-file').addClass('d-none');
    $('.layout-media-input-visible-message .list-media').empty();
    $('#count-image-input-visible-message').text('0');
    $('#count-video-input-visible-message').text('0');
    $('#count-file-input-visible-message').text('0');

    $('.layout-input-visible-message').removeClass('d-none');
    // $('.header-chat-number_employee').text('0' + ' thành viên');
    $('#name-audio-call-header-visible-message').text($(this).find('.name').text());
    $('#name-video-call-header-visible-message').text($(this).find('.name').text());
    $('#status-of-user-header-visible-message').text($(this).find('.name').text());
    $('#turn-off-record-visible-message').addClass('d-none');
    $('#send-audio-input-visible-message').addClass('d-none');
    $('.time-record-visible-message').text('00:00');
    $('.record_btn').removeClass('.recording');
    $('.chat-body-text-scroll-top-btn').addClass('d-none');
    stopTimerAudio();
    resetTimerAudio();
}












