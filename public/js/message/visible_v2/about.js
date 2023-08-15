let checkLoadDataImage, checkLoadDataVideo, checkLoadDataFile, checkLoadDataLink, checkNameGroupChat;
let checkClick = 0, checkClickleft = 0 , checkClickVideo = 0;
let pageListImageDetail = 1, pageListVideoDetail = 1, pageListFileDetail = 1, pageListLinkDetail = 1;
$(function () {
    /** Xử lý active hình ảnh và scroll hình ảnh **/
    let thumbnails = $('.thumbnail')
    let activeImages = $('.active')
    for (let i = 0; i < thumbnails.length; i++) {
        $('.thumbnail').on('click', function () {
            if (activeImages.length > 0) {
                thumbnails.removeClass('active')
            }
            $(this).addClass('active');
        });
    }
    $(document).on('click', '#slide-left-click', function () {
        document.getElementById('slider-image-about-detail-visible-message').scrollLeft -= 100;
    });
    $(document).on('click', '#slide-right-click', function () {
        document.getElementById('slider-image-about-detail-visible-message').scrollLeft += 100;
    });
    /** Câp nhật thông tin nhóm **/
    $('.update-name-visible-message').on('click', function () {
        // $(this).addClass('d-none');
        // $('.save-name-visible-message').removeClass('d-none');
        // $('#name-about-visible-message').attr('contenteditable', true);
        // $('#name-about-visible-message').addClass('border-name');
        // $('#name-about-visible-message').attr('data-name', $('#name-about-visible-message').text());
        openModalChangeNameVisibleMessage()
    });
    $('.save-name-visible-message').on('click', function () {
        $('.header-chat-name').text($('#name-about-visible-message').text());
        $(this).addClass('d-none');
        $('.update-name-visible-message').removeClass('d-none');
        $('#name-about-visible-message').attr('contenteditable', false);
        $('#name-about-visible-message').removeClass('border-name');
        if ($('#name-about-visible-message').text() !== $('#name-about-visible-message').attr('data-name')) {
            updateConversation();
            $('.item-conversation-visible-message.active').find('.name').text($('#name-about-visible-message').text());
            $('#name-about-visible-message').attr('data-name', $('#name-about-visible-message').text());
        }
    });
    $('#name-about-visible-message').on('keypress', function (e) {
        if (e.keyCode === 13) {
            $('.save-name-visible-message').click();
        }
    });
    $(document).mouseup(function (e) {
        if (!$('#name-about-visible-message').is(e.target) && $('#name-about-visible-message').has(e.target).length === 0 && $('.save-name-visible-message').has(e.target).length === 0 && $('#name-about-visible-message').prop('contenteditable') === 'true') {
            $('.save-name-visible-message').addClass('d-none');
            $('.update-name-visible-message').removeClass('d-none');
            $('#name-about-visible-message').attr('contenteditable', false);
            $('#name-about-visible-message').removeClass('border-name');
            $('#name-about-visible-message').text($('#name-about-visible-message').data('name'));
        }
    });
    $('#upload-avatar-about-visible-message').on('change', uploadMediaCropTemplate($('#upload-avatar-about-visible-message'), $('#avatar-about-visible-message'), 3, updateConversation));
    /** Kiểm tra sự tồn tại của dropdown **/
    $(document).mouseup(function (e) {
        let target1 = $('.options-members-popup');
        if (!target1.is(e.target) && target1.has(e.target).length === 0) {
        }
    })
    /** Thông báo khi không có ảnh **/
    if ($('.scroll-detail-images-visble-message .border-color-about').length === 0) {
        $('#data-image-about-visible-message').html(`<div class="nothing-img">Chưa có ảnh được chia sẻ trong hội thoại này</div>`);
    } else {
        $('#see-all-img').removeClass('d-none');
        $('.arrow-img').removeClass('d-none');
        $('#resource-slider-img').removeAttr('style');
    }
    /** Dropdown all about **/
        $(document).on('click', '.ques',  function (e) {
            e.preventDefault();
            $(this).toggleClass('active').siblings('.ans').slideToggle();
            if($(this).hasClass('active')) {$(this).find('.hidden-general-info').addClass('rotate-icon-down')}
            else{ $(this).find('.hidden-general-info').removeClass('rotate-icon-down')}
        });
    /** Dropdown image all **/
    $(document).on('click', '.hide-img-by-date-about-visible-message', function () {
        $(this).parents('.item-image-detail-about-visible-message').find('.list-image-itemimage-detail-about-visible-message').slideToggle('slow')
    });
    /** Xem tất cả thành viên **/
    $(document).on('click', '#see-all-member-about', function () {
        $('.member-all-popup').addClass('show');
    });
    $('#header-info-group-visible-message').click(function () {
        $('.member-all-popup').addClass('show');
    });
    /** Đóng xem tất cả thành viên **/
    $(document).on('click', '.back-arrow-member-popup.hidden-see-all-member-popup', function () {
        $('.member-all-popup').removeClass('show');
    });
    /** Thêm thành viên **/
    $('.icon-add-member-visible-message').on('click',async function (e) {
        if ($('.icon-add-member-visible-message').is(e.target)){
           await openModalAddMemberConversation();
        }
    });
    /** Xem tất cả file **/
    $(document).on('click', '.nav-link.about-visible-message-nav-link', async function () {
        let type = $(this).data('type');
        if ($(this).data('check') !== 1) {
            switch (type) {
                case 2:
                    $('#div-empty-detail-image').remove();
                    $('#detail-about-images-visible-message').html(await dataFileDetailConversation(type, pageListImageDetail));
                    $(this).data('check', 1);
                    break;
                case 3:
                    $('#div-empty-detail-file').remove();
                    $('#detail-about-file-visible-message').html(await dataFileDetailConversation(type, pageListFileDetail));
                    $(this).data('check', 1);
                    break;
                case 5:
                    $('#div-empty-detail-video').remove();
                    $('#detail-about-video-visible-message').html(await dataFileDetailConversation(type, pageListVideoDetail));
                    $(this).data('check', 1);
                    break;
                case 8:
                    $('#div-empty-detail-link').remove();
                    $('#detail-about-link-visible-message').html(await dataFileDetailConversation(type, pageListLinkDetail));
                    $(this).data('check', 1);
                    break;
            }
        }
    });
    /** nút Xem tất cả **/
    $(document).on('click', '.show-all-about-visible', async function () {
        let type = $(this).data('type');
        $('#media-all-about-visible-message').addClass('show');
        switch (type) {
            case 2:
                $('#tab-image-about-visible-message').click();
                break;
            case 3:
                $('#tab-file-about-visible-message').click();
                break;
            case 5:
                $('#tab-video-about-visible-message').click();
                break;
            case 8:
                $('#tab-link-about-visible-message').click();
                break;
        }
    })
    /** Đóng xem tất cả **/
    $(document).on('click', '.back-arrow-all-media', function () {
        $('#media-all-about-visible-message').removeClass('show');
    });
    /** Xóa text search thành viên about **/
    $(document).on('click', '.clear-text-area-member-search-about', function (e) {
        $('#search-info-member-about').val("");
        $('.clear-text-area-member-search-about').css({'visibility': 'hidden', 'opacity': '0'});
        $("#data-all-member-visible-message .row-member").show();
    });
    /** Hiển thị icon xóa text search, tìm kiếm **/
    $(document).on('keyup', '#search-info-member-about', function () {
        if (($('#search-info-member-about').val()).length > 0) {
            $('.clear-text-area-member-search-about').css({'visibility': 'visible', 'opacity': '1'});
        } else {
            $('.clear-text-area-member-search-about').css({'visibility': 'hidden', 'opacity': '0'});
        }
        let keySearch = removeVietnameseStringLowerCase($(this).val());
        $("#data-all-member-visible-message .row-member").each(function () {
            removeVietnameseStringLowerCase($(this).text()).indexOf(keySearch) > -1 ? $(this).show() : $(this).hide();
        });

    });
    /** Sự kiện click next ảnh **/
    $(".arrow-img").on("click", function () {
        let length = $('.container.slider-img-about').find('.resource-slider-item-img').length;
        let $this = $(this),
            widthImg = $(".resource-slider-inset-img").outerWidth(true);

        if ($this.hasClass("prev-img")) {
            clickSlideleft($(this), length);
            resourceSliderFrameImg.animate({
                scrollLeft: "-=" + widthImg,
            });
        } else if ($this.hasClass("next-img")) {
            clickSlideRight($(this), length);
            resourceSliderFrameImg.animate({
                scrollLeft: "+=" + widthImg,
            });
        }
    });
    /** Click vào link trong about đưa tới link đó **/
    $(document).on('click', '.hover-link-file', function (e) {
        let url = $(this).attr("data-url");
        linkClickedAbout(url)
    });
    /** Mở modal thiết lập nhóm **/
    $(document).on('click', '#setting-in-group', function () {
        $('.group-all-popup').addClass('show');
    });
    /** Đóng modal thiết lập nhóm **/
    $(document).on('click', '.back-arrow-member-popup.hidden-see-all-setting-popup', function () {
        $('.group-all-popup').removeClass('show');
    })
})

/**
 * ! Ngoài Function
 */
function linkClickedAbout(url) {
    if (url) {
        document.onload = window.open(url);
    }
}

/**
 * Next and prev image
 * @type {*|jQuery|HTMLElement}
 */
let resourceSliderFrameImg = $(".resource-slider-frame-img");
let videoContainer = [], imgContainer = [];

function deferImg(method) {
    if (window.jQuery) method();
    else {
        deferImg(method);
    }
}

deferImg(function () {
    function doneResizingImg() {
        let totalScrollImg = resourceSliderFrameImg.scrollLeft();
        let itemWidthImg = $(".img-view").width();
        let differenceImg = totalScrollImg % itemWidthImg;
        if (differenceImg === 0) {
            resourceSliderFrameImg.animate({
                scrollLeft: "+=" + differenceImg,
            });
        }
    }

    $(window).on("load resize", function () {
        loadImg(); // end each
    }); // end window resize/load

    let resizeIdImg;
    $(window).resize(function () {
        clearTimeout(resizeIdImg);
        resizeIdImg = doneResizingImg;
    });
});

function loadImg() {
    $(".slider-img-about .resource-slider-item-img").each(function (i) {
        let $this = $(this),
            widthImg = $(".resource-slider-inset-img"),
            leftImg = widthImg.width() * i;
        $this.css({
            left: leftImg,
        });
    });
}

function loadVideo() {
    $(".slider-video-about .resource-slider-item").each(function (i) {
        let $this = $(this),
            widthImg = $(".resource-slider-inset"),
            leftImg = widthImg.width() * i;
        $this.css({
            left: leftImg,
        });
    });
}

/**
 * next and prev video
 * @param method
 */
function defer(method) {
    if (window.jQuery) method();
    else {
        defer(method);
    }
}

defer(function () {
    function doneResizing() {
        let totalScroll = $(".resource-slider-frame").scrollLeft();
        let itemWidth = $(".resource-slider-item").width();
        let difference = itemWidth % totalScroll;

        if (difference === 0) {
            $(".resource-slider-frame").animate({
                scrollLeft: "-=" + difference,
            });
        }
    }

    $(".arrow").on("click", function () {
        let length = $('.container.slider-video-about').find('.resource-slider-item').length;
        let $this = $(this),
            width = $(".resource-slider-inset").outerWidth(true);

        if ($this.hasClass("prev")) {
            $(".resource-slider-frame").animate({
                scrollLeft: "-=" + width,
            });
            clickSlideVideoleft($(this), length)
        } else if ($this.hasClass("next")) {
            $(".resource-slider-frame").animate({
                scrollLeft: "+=" + width,
            });
            clickSlideVideoRight($(this), length)
        }
    });
    $(window).on("load resize", function () {
        loadVideo();
    });
    let resizeId;
    $(window).resize(function () {
        clearTimeout(resizeId);
        resizeId = doneResizing;
    });
});

function updateConversation(img) {
    if (img) {
        let db = {
            member_id: idSession,
            group_id: idCurrentConversation,
            message_type: 15,
            name: $('#name-about-visible-message').text(),
            avatar: $('#avatar-about-visible-message').data('src'),
            background: "",
            key_message_error: ''
        }
        console.log('update-group-avatar', db);
        socket.emit('update-group-avatar', db);
    } else {
        let db = {
            member_id: idSession,
            group_id: idCurrentConversation,
            message_type: 14,
            name: $('#name-about-visible-message').text(),
            avatar: $('#avatar-about-visible-message').data('src'),
            background: "",
            key_message_error: ''
        }
        console.log('update-group-name', db);
        socket.emit('update-group-name', db);
    }
    let method = 'post',
        url = 'visible-message.update-conversation',
        params = null,
        data = {
            id: idCurrentConversation,
            avatar: $('#avatar-about-visible-message').data('src'),
            name: $('#name-about-visible-message').text()
        };
    axiosTemplate(method, url, params, data);
}

function clickSlideRight(r, length) {
    checkClick = checkClick + 1;
    if(length == 4 && checkClick == 1) {
        r.addClass('d-none');
        r.parent().find('.arrow-img.prev-img').removeClass('d-none');
    } else if(length == 5 && checkClick == 1){
        r.parent().find('.arrow-img.prev-img').removeClass('d-none');
    } else if(length == 5 && checkClick == 2){
        r.addClass('d-none');
    }
}

function clickSlideleft(r, length) {
    checkClick = checkClick - 1;
    if(length == 4 && checkClick == 0) {
        r.addClass('d-none');
        r.parent().find('.arrow-img.next-img').removeClass('d-none');
    } else if(length == 5 && checkClick == 1){
        r.parent().find('.arrow-img.next-img').removeClass('d-none');
    } else if(length == 5 && checkClick == 0){
        r.addClass('d-none');
    }
}

function resetAboutVisibleMessage() {
    $('#data-member-about-visible-message').html('');
    $('.count-element-about-visible-message.number-person-about').text('0');
    $('#data-image-about-visible-message').html('');
    $("#image-list-about-visible-message").find(".ans").css("display", "none");
    $('#number-img').text('0');
    $('#data-video-about-visible-message').html('');
    $("#video-list-about-visible-message").find(".ans").css("display", "none");
    $('#number-video').text('0');
    $('#data-file-about-visible-message').html('');
    $("#file-list-about-visible-message").find(".ans").css("display", "none");
    $('#number-file').text('0');
    $('#data-link-about-visible-message').html('');
    $("#link-list-about-visible-message").find(".ans").css("display", "none");
    $("#employee-list-about-visible-message").find(".ans").css("display", "none");
    $('#number-link').text('0');
    // $(".see-list-image-video-grid-see-all").addClass("d-none"); //hard code
    $('#media-all-about-visible-message').removeClass('show');
    $('.nav-link.about-visible-message-nav-link').attr('data-check', 0)
    $('#detail-about-images-visible-message').html('')
    $('#detail-about-video-visible-message').html('')
    $('#detail-about-file-visible-message').html('')
    $('#detail-about-link-visible-message').html('')
}

function checkPermisionMember(permissions,type) {
    if(permissions === 1 ) {
        if (type === 2){
            $('#layout-about-visible-message').find('.pointer.avt-img').addClass('d-none');
            $('.update-name-visible-message').addClass('d-none');
        }else{
            $('#layout-about-visible-message').find('.pointer.avt-img').removeClass('d-none');
            $('.update-name-visible-message').removeClass('d-none');
        }
    } else {
            $('#layout-about-visible-message').find('.pointer.avt-img').addClass('d-none');
            $('.update-name-visible-message').addClass('d-none');
    }
}

function clickSlideVideoleft(r, length) {
    checkClickVideo = checkClickVideo - 1;
    if(length == 4 && checkClickVideo == 0) {
        r.addClass('d-none');
        r.parent().find('.arrow.next').removeClass('d-none');
    } else if (length == 5 && checkClickVideo == 1) {
        r.parent().find('.arrow.next').removeClass('d-none');
    } else if(length == 5 && checkClickVideo == 0){
        r.addClass('d-none');
    }
}

function clickSlideVideoRight(r, length) {
    checkClickVideo = checkClickVideo + 1;
    if(length == 4 && checkClickVideo == 1) {
        r.addClass('d-none');
        r.parent().find('.arrow.prev').removeClass('d-none');
    } else if (length == 5 && checkClickVideo == 1) {
        r.parent().find('.arrow.prev').removeClass('d-none');
    } else if(length == 5 && checkClickVideo == 2){
        r.addClass('d-none');
    }
}
