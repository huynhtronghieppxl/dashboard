let scrollTopCarousel = 0;
console.log( $('.play-btn-video-slide'))
$(function () {
    /** Hình ảnh tin nhắn **/
    $(document).on('click', '.gallery__item', async function (event) {
        event.stopPropagation();
        $('.play-btn-video-slide').addClass('d-none');
        $('#image-view-conversation-slider-visible-message').removeClass('d-none');
        let numberImg = $(this).parents('.chat-body-message-image').data('number-img');
        let sender = $(this).parents('.chat-body-message-element').data('name');
        let avatarSender = $(this).parents('.chat-body-message-element').data('avatar');
        let timeSender = $(this).parents('.chat-body-message-element').data('time');
        let src = $(this).find('img').attr('src');
        let arrSrc = [];
        if(numberImg <= 5) {
            for await(const v of $(this).parents('.chat-body-message-image').find('.gallery .gallery__item')) {
                let data = {
                    src: $(v).find('img').attr('src'),
                    nameSender: sender,
                    avatarSender: avatarSender,
                    time: timeSender,
                }
                arrSrc.push(data);
            }
        } else {
            for await(const v of $(this).parents('.chat-body-message-image').find('.sub-item-image div')) {
                let data = {
                    src: $(v).attr('data-src'),
                    nameSender: sender,
                    avatarSender: avatarSender,
                    time: timeSender,
                }
                arrSrc.push(data);
            }
        }
        await renderImagesMessageSlider(src, sender, avatarSender, timeSender, arrSrc);
    });
    /** Hình ảnh detail **/
    $(document).on('click', '.see-item-image-video-grid.item-image-about-visible-messages', async function () {
        console.log(123)
        $('.play-btn-video-slide').addClass('d-none');
        $('#image-view-conversation-slider-visible-message').removeClass('d-none');
        let sender = $(this).find('img').data('sender');
        let avatarSender = $(this).find('img').data('avatar');
        let timeSender = $(this).find('img').data('time');
        let src = $(this).find('img').attr('src');
        let arrSrc = [];
        for await(const v of $(this).parents('#data-image-about-visible-message').find('.see-item-image-video-grid-img')) {
            let data = {
                src: $(v).attr('src'),
                nameSender: $(v).data('sender'),
                avatarSender: $(v).data('avatar'),
                time: $(v).data('time'),
            }
            arrSrc.push(data);
        }
        renderImageDetailMessage(src, sender, avatarSender, timeSender, arrSrc);
    });
    /** Hình ảnh all **/
    $(document).on('click', '.see-item-image-video-grid.item-image-about-visible-messages', async function () {
        console.log(123)
        $('.play-btn-video-slide').addClass('d-none');
        $('#image-view-conversation-slider-visible-message').removeClass('d-none');
        let sender = $(this).find('img').data('sender');
        let avatarSender = $(this).find('img').data('avatar');
        let timeSender = $(this).find('img').data('time');
        let src = $(this).find('img').data('link-original')
        let arrSrc = [];
        for await(const v of $(this).parents('#detail-about-images-visible-message').find('.see-item-image-video-grid-img')) {
            let data = {
                src: $(v).attr('src'),
                nameSender: $(v).data('sender'),
                avatarSender: $(v).data('avatar'),
                time: $(v).data('time'),
            }
            arrSrc.push(data);
        }
        renderImageDetailMessage(src, sender, avatarSender, timeSender, arrSrc);
    });

    /** Video detail **/
    $(document).on('click', '.see-item-image-video-grid.video-about', async function (e) {
        $('.play-btn-video-slide').removeClass('d-none');
            let src = $(this).data('link'),
                nameSender = $(this).data('sender'),
                avatarSender = $(this).data('avatar-sender'),
                time = $(this).data('time'),
                thumb = $(this).data('thumb'),
                arrSrc = [];
            for await(const v of $(this).parents('#video-list-about-visible-message').find('.see-item-image-video-grid.video-about')) {
                let data = {
                    src: $(v).data('link'),
                    nameSender: $(v).data('sender'),
                    avatarSender: $(v).data('avatar-sender'),
                    time: $(v).data('time'),
                }
                arrSrc.push(data);
            }
            await renderSliderAllVideoSilder(src, nameSender, avatarSender, time, arrSrc, thumb)
    });
    /** Video detail ALL **/
    $(document).on('click', '.see-item-image-video-grid.video-about-all.all-video', async function (e) {
        $('.play-btn-video-slide').removeClass('d-none');
        let src = $(this).data('link'),
            nameSender = $(this).data('sender'),
            avatarSender = $(this).data('avatar-sender'),
            time = $(this).data('time'),
            thumb = $(this).data('thumb'),
            arrSrc = [];
        for await(const v of $(this).parents('#tab-video').find('.see-item-image-video-grid.video-about-all.all-video')) {
            let data = {
                src: $(v).data('link'),
                nameSender: $(v).data('sender'),
                avatarSender: $(v).data('avatar-sender'),
                time: $(v).data('time'),
            }
            arrSrc.push(data);
        }
        await renderSliderAllVideoSilder(src, nameSender, avatarSender, time, arrSrc, thumb)
    });
    /** ĐÓng slider **/
    $('.modal-show-grid-image-toolbar-icon.ti-close').on('click', function () {
        $('.modal-show-grid-images').removeClass('show');
        $('#slider-image-about-detail-visible-message').html('');
        $('#name-sender-conversation-slider-visible-message').text('');
        $('#time-conversation-slider-visible-message').text('');
        $('#avatar-sender-conversation-slider-visible-message').attr('src','');
        $('#image-view-conversation-slider-visible-message').attr('src','');
        $('#video-view-conversation-slider-visible-message source').attr('src','');
        $('#video-view-conversation-slider-visible-message').remove();
        $('#image-view-conversation-slider-visible-message').removeClass('d-none');
        $('.play-btn-video-slide').removeClass('d-none');
    });
    /** Xử lý lấy danh sách video **/
    $(document).on('click', '.see-item-image-video-grid.video-about', async function (e) {
        let url = $(this).data('link');
        let arrSrc = [];
        for await(const v of $(this).parents('#data-video-about-visible-message').find('.see-item-image-video-grid.video-about')) {
            let data = {
                src: $(v).data('link'),
            }
            arrSrc.push(data);
        }
        await renderSliderAllVideo(url, arrSrc);
    });

    /** Ẩn hiện scrollbar image **/
    $(document).on('click', '.modal-show-grid-image-toolbar-icon.fa.fa-columns', function () {
        $('.modal-show-grid-image-preview-right').toggleClass('show');
        $('#modal-see-all-images-visible-message .modal-show-grid-image-preview-images').css('width', '100%');
    });
    /** Xử lý chuyển ảnh sang ảnh khác **/
    $(document).on('click', '.slider-preview-image-img', function () {
        $(this).addClass('active').siblings().removeClass('active');
        $('#image-view-conversation-slider-visible-message').attr('src', $(this).find('img').attr('src'));
        $('#avatar-sender-conversation-slider-visible-message').attr('src', $(this).find('img').attr('data-avatar-sender'));
        $('#name-sender-conversation-slider-visible-message').text($(this).find('img').attr('data-sender'));
        $('#time-conversation-slider-visible-message').text($(this).find('img').attr('data-time'));
    });
    /** Xử lý chuyển sang video khác **/
    $(document).on('click', '.slider-preview-image-img.video', function () {
        $('#video-view-conversation-slider-visible-message').remove();
        $('#image-view-conversation-slider-visible-message').removeClass('d-none');
        $('.play-btn-video-slide').removeClass('d-none');
        $(this).addClass('active').siblings().removeClass('active');
        $('#image-view-conversation-slider-visible-message').attr('data-link', $(this).data('link-video'));
        $('#avatar-sender-conversation-slider-visible-message').attr('src', $(this).find('img').attr('data-avatar-sender'));
        $('#name-sender-conversation-slider-visible-message').text($(this).find('img').attr('data-sender'));
        $('#time-conversation-slider-visible-message').text($(this).find('img').attr('data-time'));
    });
    $(document).on('click', '.modal-show-grid-image-preview-left-button', function () {
        if ($(".slider-preview-image-img.active").is(":first-child")) {
            $(".slider-preview-image-img:last-child").click();
        } else {
            $(".slider-preview-image-img.active").prev().click();
        }
        $('.modal-show-grid-image-preview-left-button').attr('href', '#' + $(".slider-preview-image-img.active").prev().find('img').attr('src'));
        $('.modal-show-grid-image-preview-right-button').attr('href', '#' + $(".slider-preview-image-img.active").next().find('img').attr('src'));
    });
    $(document).on('click', '.modal-show-grid-image-preview-right-button', function () {
        if ($(".slider-preview-image-img.active").is(":last-child")) {
            $(".slider-preview-image-img:first-child").click();
            $('.slider-about-scroll-message').scrollTop(0);
            scrollTopCarousel = 0;
        } else {
            $(".slider-preview-image-img.active").next().click();
            $('.slider-about-scroll-message').addClass('scrolling').animate({scrollTop: scrollTopCarousel += 108}, 100, function () {
                $('.slider-about-scroll-message').removeClass('scrolling');
            });
        }
        $('.modal-show-grid-image-preview-left-button').attr('href', '#' + $(".slider-preview-image-img.active").prev().find('img').attr('src'));
        $('.modal-show-grid-image-preview-right-button').attr('href', '#' + $(".slider-preview-image-img.active").next().find('img').attr('src'));
    })
    zoomImageCarouse();
    /** Sự kiện nhấn tải ảnh **/
    $(document).on('click','.btn-download-file-upload',function (event){
        let url = $(this).find('i').attr('data-download');
        let name = $(this).find('i').attr('data-name-file');
        event.stopPropagation()
        DownloadFileChat(url, name)
    });
});

async function renderImagesMessageSlider(src, nameSender, avatarSender, time, arrSrc) {
    $('.modal-show-grid-images').addClass('show');
    $('#image-view-conversation-slider-visible-message').attr('src', src);
    $('#avatar-sender-conversation-slider-visible-message').attr('src', avatarSender);
    $('#name-sender-conversation-slider-visible-message').text(nameSender);
    $('#time-conversation-slider-visible-message').text(time);
    for await (const v of arrSrc) {
        let active = '';
        if (v.src === src) active = 'active';
        $('#slider-image-about-detail-visible-message').append(`<div class="slider-preview-image-img ${active}" id="${v.src}"><img class="img-view-preview-message" onerror="imageDefaultOnLoadError($(this))" src="${v.src}" data-time = "${v.time}" data-sender = "${v.nameSender}" data-avatar-sender = "${v.avatarSender}"></div>`);
    }
    $('.modal-show-grid-image-preview-left-button').attr('href', '#' + $(".slider-preview-image-img.active").prev().find('img').attr('src'));
    $('.modal-show-grid-image-preview-right-button').attr('href', '#' + $(".slider-preview-image-img.active").next().find('img').attr('src'));
}

async function renderImageDetailMessage(src, nameSender, avatarSender, time, arrSrc) {
    $('.modal-show-grid-images').addClass('show');
    $('#image-view-conversation-slider-visible-message').attr('src', src);
    $('#avatar-sender-conversation-slider-visible-message').attr('src', avatarSender);
    $('#name-sender-conversation-slider-visible-message').text(nameSender);
    $('#time-conversation-slider-visible-message').text(time);
    for await (const v of arrSrc) {
        let active = '';
        if (v.src === src) active = 'active';
        $('#slider-image-about-detail-visible-message').append(`<div class="slider-preview-image-img ${active}" id="${v.src}"><img class="img-view-preview-message" onerror="imageDefaultOnLoadError($(this))" src="${v.src}" data-time = "${v.time}" data-sender = "${v.nameSender}" data-avatar-sender = "${v.avatarSender}"></div>`);
    }
    $('.modal-show-grid-image-preview-left-button').attr('href', '#' + $(".slider-preview-image-img.active").prev().find('img').attr('src'));
    $('.modal-show-grid-image-preview-right-button').attr('href', '#' + $(".slider-preview-image-img.active").next().find('img').attr('src'));
}

async function renderSliderAllVideoSilder(src, nameSender, avatarSender, time, arrSrc, thumb) {
    $('.modal-show-grid-images').addClass('show');
    $('#image-view-conversation-slider-visible-message').attr('src', thumb);
    $('#image-view-conversation-slider-visible-message').attr('data-link', src);
    for await (const v of arrSrc) {
        let active = '';
        if (v.src === src) active = 'active';
        $('#slider-image-about-detail-visible-message').append(`<div class="slider-preview-image-img video ${active}" id="${v.src}" data-link-video="${v.src}">
                                                                    <img class="img-view-preview-message" onerror="imageDefaultOnLoadError($(this))" src="${v.thumb}" data-time="${v.time}" data-sender="${v.nameSender}" data-avatar-sender="${v.avatarSender}" />
                                                                    <i onclick="" class="play-video-to-link-btn">
                                                                        <svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="30px" width="30px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                                                                            <path
                                                                                class="stroke-solid"
                                                                                fill="none"
                                                                                stroke=""
                                                                                d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
                                                                                                                                                                     C97.3,23.7,75.7,2.3,49.9,2.5"
                                                                            ></path>
                                                                            <path class="icon" fill="" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z"></path>
                                                                        </svg>
                                                                    </i>
                                                                </div>`);
    }
}

/**
 * Xử lý ảnh trong carousel
 */
function zoomImageCarouse() {
    let rotate = 0;
    let scale = 1;
    $(document).on('click', '.modal-show-grid-image-toolbar-icon.ti-zoom-in', function () {
        scale = scale + 0.2;
        if (scale > 3) {
            scale = 3;
        }
        $('#data-image-carousel-visible-message img').css({
            'transform': 'rotate(' + rotate + 'deg) scale(' + scale + ')'
        });
    });
    $(document).on('click', '.modal-show-grid-image-toolbar-icon.ti-zoom-out', function () {
        scale = scale - 0.2;
        if (scale < 1) {
            scale = 1;
        }
        $('#data-image-carousel-visible-message img').css({
            'transform': 'rotate(' + rotate + 'deg) scale(' + scale + ')'
        });
    });
    $(document).on('click', '.modal-show-grid-image-toolbar-icon.fa.fa-rotate-right', function () {
        rotate = rotate + 90;
        $('#data-image-carousel-visible-message img').css({
            'transform': 'rotate(' + rotate + 'deg) scale(' + scale + ')'
        });
    });
    $(document).on('click', '.modal-show-grid-image-toolbar-icon.fa.fa-rotate-left', function () {
        rotate = rotate - 90;
        $('#data-image-carousel-visible-message img').css({
            'transform': 'rotate(' + rotate + 'deg) scale(' + scale + ')'
        });
    });
}
/**
 * Function download file
 */
function DownloadFileChat(urlLink, fileName) {
    fetch(urlLink)
        .then(response => response.blob())
        .then(blob => {
            const link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = fileName;
            link.click();
        })
        .catch(console.error);
}
/** Function xem video **/
function viewVideoSlide(r) {
    r.addClass('d-none');
    $('#image-view-conversation-slider-visible-message').addClass('d-none');
    let url = r.parents('#data-image-carousel-visible-message').find(".modal-show-grid-image-preview-image").attr('data-link');
    let html = ` <video class="modal-show-grid-image-preview-image" id="video-view-conversation-slider-visible-message" controls>
                    <source src="${url}" />
                </video>`
    r.parent().append(html);
    r.parent().find("video").get(0).play();
    r.parent().find(".play-video-to-link-btn").addClass("d-none");
    r.parent().find("img").addClass("d-none");
    r.parent().find(".chat-message-video-count").addClass("d-none");
    r.parent()
        .find("video")
        .on("ended", function () {
            r.parent().find("video").attr('src','');
            r.parent().find(".play-video-to-link-btn").removeClass("d-none");
            r.parent().find("img").removeClass("d-none");
            r.parent().find("video").remove();
            r.parent().find(".chat-message-video-count").removeClass("d-none");
            r.removeClass('d-none');
        });
}
