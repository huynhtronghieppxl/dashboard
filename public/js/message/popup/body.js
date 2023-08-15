let timeCurrentAudioPopup = '';
$(function () {
    $(document).on('mouseover', '.chat-body-message-element', function (e) {
        if ($(e.target).closest('.chat-body-message-item-reactions').length === 0) {
            $(this).find('.chat-body-message-item-action-list').removeClass('d-none');
        }
    });

    $(document).on('mouseout', '.chat-body-message-element', function () {
        $(this).find('.chat-body-message-item-action-list').addClass('d-none');
    });

    /**
     * Sự kiện download các dạng file trong body chat
     */
    $(document).on('click','.icon-download-file',function (){
        let nameFile = $(this).parents('.chat-message-file-content').find('.chat-message-file-name').text();
        let linkFile = $(this).parents('.chat-body-message-file').find('a').attr('href');
        DownloadFileChat(linkFile,nameFile);
    })

    $(document).on('click','.download-audio',function (){
        let nameFile = '';
        let linkFile = $(this).find('a').attr('href');
        DownloadFileChat(linkFile,nameFile);
    })

    /**
     * Xử lý audio
     */
    $(document).on('click','#chat-body-message-popup .sound-container-play',function (event){
        timeCurrentAudioPopup = $(this).parents('.chat-body-message-audio').find('.sound-duration-time');
        let url = $(this).data('audio');
        let html = `<audio class="audio-message-visible" style="display:none;">
                    <source  src="${url}">
                </audio>`;
        $(this).parent().toggleClass('sound-mute');
        if (!$(this).parent().find('.play-audio-btn').hasClass('d-none')) {
            $(this).parents('.chat-body-message-audio').find('.media-fixed-progress-bar-dot').addClass('animation');
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
            $(this).parents('.chat-body-message-audio').find('.audio-message-visible')[0].pause();
            stopTimerAudio();
            $(this).find(".play-audio-btn").removeClass("d-none");
            $(this).find(".stop-audio-btn").addClass("d-none");
            $(this).parent().find(".sound-container-progress").find(".audio-wrapper").removeClass("animation");
        }
        $(this).parent()
            .find("audio")
            .on("ended", function () {
                stopTimerAudio();
                resetTimerAudio($(this));
                $('.sound-container-time').text('00:00');
                $(this).parents('.chat-body-message-audio').find('.media-fixed-progress-bar-dot').removeClass('animation');
                $(this).parents('.chat-body-message-audio').find('.audio-message-visible')[0].pause();
                $(this).parents('.chat-body-message-audio').find(".stop-audio-btn").addClass("d-none");
                $(this).parents('.chat-body-message-audio').find(".play-audio-btn").removeClass("d-none");
                $(this).parent().find(".sound-container-progress").find(".audio-wrapper").removeClass("animation");
            });
    })

})
