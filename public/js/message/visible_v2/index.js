let pageConversation = 1, currentLengthConversation = 20, pageConversationSupplier = 1, pageFileConversation = 1;
let currentLengthConversationSupplier = 20, pageMessageConversation = 1, currentLengthMessageConversation = 20,
    currentLengthFileDetailConversation = 5;
let checkLoadDataConversation = 0, checkLoadDataMessageConversation = 0, checkLoadDataFileConversation = 0;
let dataEmployee, supplierCurrentConversation, dataMessageLayout;
let dataMemberConversation = [];
let dataConversationTMS = "", dataConversationSupplier = "";
let getTotalItemFile = "", numberWatchedConversationMessage = 0;
let isFirstGetMessage=0
$(function () {
    dataConversation();
    // dataConversationOfSupplier();
    dateTimePickerNormalTemplate($('#date-remind-time'));
    dateFullTimePickerTemplate($('#hours-remind-time'));
    $(".filter-left").on("click", async function (e) {
        if ($(this).data("id") === 0) {
            pageConversation = 1;
            $('#data-conversation-visible-message-restaurant').html(dataConversationTMS);
            if (dataConversationTMS.length === 0) {
                await dataConversation();
            }
        } else {
            pageConversationSupplier = 1;
            $('#data-conversation-visible-message-supplier').html(dataConversationSupplier);
            if (dataConversationSupplier.length === 0) {
                await dataConversationOfSupplier();
            }
        }
    });
    /** Sự kiện mở danh sách tin nhắn nhắc đến mình **/
    $(document).on('click', '#tag-name-message', function () {
        $('.message-tag-name-modal').addClass('show');
    });
    $(document).on('click', '.hidden-message-tag-name-modal', function () {
        $('.message-tag-name-modal').removeClass('show');
    });
    /** Sự kiện mở modal nhắc hẹn **/
    $(document).on('click', '.icon-remind-time', function () {
        $('#modal-remind-time-visible').modal('show');
    });
    /** Sự kiện scroll load thêm cuộc trò chuyện **/
    $('.data-conversation-visible-message').on('scroll', async function () {
        if ($(this).innerHeight() + $(this).scrollTop() + 300 >= $(this)[0].scrollHeight) {
            if ((parseInt($('.filter-left.active-mess').data('id')) === 0)) {
                if (currentLengthConversation === 20) {
                    await dataConversation();
                }
            } else {
                if (currentLengthConversationSupplier === 20) {
                    await dataConversationOfSupplier();
                }
            }
        }
    });
    /** Sự kiện scroll load thêm tin nhắn **/
    // $('#data-message-visible-message').on('scroll', function () {
    //     if ($(this).innerHeight() - $(this).scrollTop() + 500 >= $(this)[0].scrollHeight) {
    //         if (currentLengthMessageConversation === 20) {
    //             dataMessageConversation(-1, $('.chat-body-message-element:last').data('id'), -1);
    //         }
    //     }
    // });
    /** Sự kiện scroll load thêm ảnh **/
    $('#detail-about-images-visible-message').on('scroll', function () {
        let type = $('.nav-link.about-visible-message-nav-link.active').data('type');
        if ($(this).innerHeight() + $(this).scrollTop() + 300 >= $(this)[0].scrollHeight) {
            if (currentLengthFileDetailConversation === 1) {
                dataFileDetailConversation(type);
            }
        }
    });
    
    /** Sự kiện khóa nút đóng menu khi ở layout chat **/
    if (window.location.pathname === '/visible-message') {
        $('.header-right-container').find('.main-menu-1 span').addClass('d-none');
        $('.header-right-container').find('#load-more').addClass('d-none');
        $('#icon-input-show-box-list-coversation-message').addClass('d-none');
    }
    /** Sự kiện focus input join room **/
    $(document).on('focus', '.dx-htmleditor-content', function () {
        // joinRoomForConnection();
        $('.item-conversation-visible-message[data-id="' + getCookieShared('id-current-for-conversation') + '"]').find('.notifycation.pl-0.pr-0').addClass('d-none');
        $('.item-conversation-visible-message[data-id="' + getCookieShared('id-current-for-conversation') + '"]').find('.notifycation.pl-0.pr-0').text('')
        $(this).removeClass('out-focus');
    });
    $(document).on('focusout', '.dx-htmleditor-content', function () {
        // leaveRoomForConnection();
        $(this).addClass('out-focus');
    });
    /** Sự kiện chuyển tab join room **/
    $(window).blur(function(e) {
        $('.dx-htmleditor-content').blur();
        // joinRoomForConnection();
    });
    $(window).focus(function(e) {
        // leaveRoomForConnection();
    });
    /** Sự kiện mở modal ghim **/
    $(document).on('click', '#pin-message-item', function () {
        $('.pin-message-list-dropdown').toggleClass('active');

    })

    $('#modal-remind-time-visible .js-example-basic-single').select2({
        dropdownParent: $('#remind-select-message'),
    });

});
/** Hàm lấy dữ liệu cuộc trò chuyện **/
async function dataConversation() {
    if (checkLoadDataConversation === 1) return false;
    checkLoadDataConversation = 1;
    axios({
        method: 'get',
        url: 'visible-message.data-conversation',
        params: {
            type: $('#type-filter-conversation').data('id'),
            keyword: $('.search-text-filter-header').val(),
            page: pageConversation
        },
    }).then(function (res) {
        console.log(res)
        $('#div-empty-conversation').remove();
        pageConversation++;
        currentLengthConversation = res.data[1].data.length;
        checkLoadDataConversation = 0;
        dataConversationTMS += res.data[0];
        $('#data-conversation-visible-message-restaurant').append(res.data[0]);
        $('.number-message-not-seen').html(res.data[2]);
    }).catch(function (e) {
        console.log(e)
    })
}
/** Hàm lấy dữ liệu cuộc trò chuyện supplier **/
async function dataConversationOfSupplier() {
    axios({
        method: 'get',
        url: 'visible-message-supplier.data-conversation',
        params: {
            keyword: $('.search-text-filter-header').val(),
            page: pageConversationSupplier
        },
    }).then(function (res) {
        console.log(res.data[2], "sdfsfsfsdfsd spliert")
        $('#div-empty-conversation').remove();
        pageConversationSupplier++;
        currentLengthConversationSupplier = res.data[1].data.total_record;
        dataConversationSupplier = res.data[0];
        $('#data-conversation-visible-message-supplier').html(res.data[0]);
        $('.number-message-not-seen-supplier').html(res.data[2]);
    }).catch(function (e) {
        console.log(e)
    })
}

async function dataMessageConversation(idReply, from, to) {
    if (checkLoadDataMessageConversation === 0) {
        checkLoadDataMessageConversation = 1;
        $('#loading-data-message-visible-message').remove();
        $('#data-message-visible-message').append(`<div class="preloader3 loader-block" id="loading-data-message-visible-message">
                                                    <div class="circ1"></div>
                                                    <div class="circ2"></div>
                                                    <div class="circ3"></div>
                                                    <div class="circ4"></div>
                                                </div>`);
        let x1 = moment();
        axios({
            method: 'get',
            url: 'visible-message.message-conversation',
            params: {
                id: idCurrentConversation,
                page: pageMessageConversation,
                type: typeCurrentConversation,
                id_reply: idReply,
                from: from,
                to: to
            },
            data: null,
        }).then(function (res) {
            checkLoadDataMessageConversation = 0;
            $('#loading-data-message-visible-message').remove();
            pageMessageConversation++;
            currentLengthMessageConversation = res.data[1].data.list.length;
            $('#data-message-visible-message').append(res.data[0]);
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover'
            });
            dataMessageLayout = res.data[0];
        }).catch(function (e) {
            checkLoadDataMessageConversation = 0;
            checkLoadDataMessageConversation = 0;
            console.log(e)
        })
    }
}

async function dataDetailConversation() {
    let x1 = moment();
    axios({
        method: 'get',
        url: 'visible-message.detail-conversation',
        params: {
            id: idCurrentConversation,
            type: typeCurrentConversation,
        },
        data: null,
    }).then(function (res) {
        getTotalItemFile = res;
        /**
         * Ghim
         */
        //hardcode
        $('#pin-visible-message').removeClass('d-none')
        $('#pin-visible-message').html('<div class="pin-visible-message-line"></div>' +
            '<img class="pin-visible-message-img" src="https://beta.api.gateway.overate-vntech.com/short/90zOh5sifviKyFgXnci2n" alt="">' +
            '<div class="pin-visible-message-info ml-1">\n' +
            '        <div class="pin-visible-message-name">Ngọc Lâm</div>\n' +
            '        <div class="pin-visible-message-text">Ngọc Lâm đã gởi 1  hình ảnh </div>\n' +
            '    </div>' +
            '<div class="detail-pin-visible-message">\n' +
            '        <span class="detail-pin-visible-message-text">Mở bảng tin ghim</span>\n' +
            '        <i class="detail-pin-visible-message-icon fa fa-sort-down"></i>\n' +
            '    </div>'

        )
        sizeBodyMessageThumbnail()
        // showMessagePinnedDetailConversation(res.data[0].data.message_pinned);
        /**
         * Tag
         */
        // dataMemberConversationTag = res.data[0].data.members.sort((a, b) => a.full_name.split(' ').at(-1) - b.full_name.split(' ').at(-1));
        // console.log('Thời gian Axios dataDetailConversation:', dataMemberConversationTag);
        dataMemberConversationTag = [{
            member_id: 1,
            full_name: "Ngoc Lam123",
            avatar:"https://beta.api.gateway.overate-vntech.com/short/90zOh5sifviKyFgXnci2n"

        },{
            member_id: 2,
            full_name: "Ngoc Lam321",
            avatar:"https://beta.api.gateway.overate-vntech.com/short/90zOh5sifviKyFgXnci2n"

        },{
            member_id: 3,
            full_name: "Ngoc Lam",
            avatar:"https://beta.api.gateway.overate-vntech.com/short/90zOh5sifviKyFgXnci2n"

        }]
        dataMemberConversationTag.unshift({
            "avatar": "/images/chat/@_mention.png",
            "member_id": -1,
            "full_name": "All"
        });
        dataMemberConversationTagCurrent=dataMemberConversationTag
        renderDataTagVisibleMessage(dataMemberConversationTagCurrent);
        // if (res.data[0].data.conversation_type == 0) {
        //     $('#setting-about-visible-message').removeClass('d-none');
        //     if (res.data[0].data.admin_id !== idSession) {
        //         $('#remove-group-about').removeClass('d-none');
        //         $('#out-group-about').addClass('d-none');
        //     }
        //
        // } else if (res.data[0].data.conversation_type == 1) {
        //     if (res.data[0].data.admin_id === idSession) {
        //         $('#setting-about-visible-message').removeClass('d-none');
        //         // $('#remove-group-about').addClass('d-none');
        //     }
        // } else {
        //     $('.dx-popup-content').addClass('d-none');
        //     $('#setting-about-visible-message').addClass('d-none');
        // }
        $('#layout-about-visible-message').attr('data-log', '1');
        // $('.number-person-about').text(res.data[0]['data'].number_employee);
        // $('#member-about-visible-message').attr('data-employee', res.data[0]['data'].number_employee);
        // $('.header-chat-number_employee').text(res.data[0]['data'].number_employee + ' thành viên');
        // $('.dx-overlay-content.dx-popup-normal.dx-popup-draggable.dx-resizable').prepend(`<div class="header-tag-name-contain">
        //                                                                                             <img src="/images/chat/@_mention.png" alt="" class="header-tag-name-contain-img" />
        //                                                                                             <div class="header-tag-name-contain-info">
        //                                                                                                 <div class="header-tag-name-contain-text">Bấm ⇧ hoặc ⇩ và Enter để chọn người cần nhắc tên</div>
        //                                                                                             </div>
        //                                                                                         </div>`);
        /**
         * Thành viên
         */
        // dataMemberConversation = res.data[0].data.members;
        // (res.data[0]['data'].number_employee > 5) ? $('#employee-list-about-visible-message .see-list-image-video-grid-see-all.employee').removeClass('d-none') : $('#employee-list-about-visible-message .see-list-image-video-grid-see-all.employee').addClass('d-none');
        // if (res.data[0]['data'].number_employee > 0) {
        //     $('#member-about-visible-message').find('.slide-to-top').css('display', 'inline-block');
        //     $('#member-about-visible-message').find('.slide-to-top').removeClass('d-none');
        //     $('#member-about-visible-message').find('.hidden-general-info').removeClass('rotate-icon-drop-down-info-visible-about');
        // } else {
        //     $('#member-about-visible-message').find('.slide-to-top').css('display', 'none');
        //     $('#member-about-visible-message').find('.slide-to-top').addClass('d-none');
        //     $('#member-about-visible-message').find('.hidden-general-info').removeClass('rotate-icon-drop-down-info-visible-about');
        // }
        // $('#data-all-member-visible-message').html(res.data[1]);
        // if (res.data[0]['data'].number_employee > 5) {
        //     $("#employee-list-about-visible-message").find(".ans").css("display", "block");
        //     $('#data-member-about-visible-message').html($('#data-all-member-visible-message .row-member:eq(0)')[0].outerHTML + $('#data-all-member-visible-message .row-member:eq(1)')[0].outerHTML + $('#data-all-member-visible-message .row-member:eq(2)')[0].outerHTML + $('#data-all-member-visible-message .row-member:eq(3)')[0].outerHTML + $('#data-all-member-visible-message .row-member:eq(4)')[0].outerHTML);
        // } else {
        //     $("#employee-list-about-visible-message").find(".ans").css("display", "block");
        //     $('#data-member-about-visible-message').html(res.data[1]);
        // }
        $('#data-member-about-visible-message').html(res.data[1]); // hardcode
        // dataMemberConversation.map(function (item) {
        //     checkPermisionMember(item.permissions, res.data[0].data.conversation_type)
        // });
        // if (res.data[0].data.admin_id === idSession && typeCurrentConversation !== 2) {
        //     $('.update-name-visible-message').removeClass('d-none')
        //     $('.avt-img').removeClass('d-none')
        // }
        /** Load data image detail **/
        // $('#number-img').text(res.data[0]['data'].total_record_image);
        $('#data-image-about-visible-message').html(res.data[2]);
        loadImg();
        // if ($('#data-image-about-visible-message .see-item-image-video-grid').length === 0) {
        //     $('.see-list-image-video-grid-see-all.image').addClass('d-none');
        //     $('#data-image-about-visible-message').html(`<div class="empty-content" style="max-height: 200px; width: 100%; margin-top: 5%">
        //                             <div class="text-center text-empty-notify">
        //                                 Chưa có ảnh được chia sẻ trong cuộc hội thoại này
        //                             </div>
        //                             <label for="input-image-message-about" class="btn-send-image-detail">
        //                                 <i class="fa fa-image"></i>
        //                                 <span>Thêm ảnh</span>
        //                                 <input id="input-image-message-about" type="file" class="d-none" multiple="" accept=".jpg,.png,.gif">
        //                             </label>
        //                          </div>`)
        //     $(".see-list-image-video-grid-see-all.image").addClass("d-none");
        //     $("#image-list-about-visible-message").find(".ans").css("display", "block");
        // } else {
        //     $("#image-list-about-visible-message").find(".ans").css("display", "block");
        //     if ($("#data-image-about-visible-message .see-item-image-video-grid").length >= 6) {
        //         $(".see-list-image-video-grid-see-all.image").removeClass("d-none");
        //         $("#data-image-about-visible-message").removeClass("pb-2");
        //         $("#data-image-about-visible-message").addClass("pb-0");
        //     } else {
        //         $("#data-image-about-visible-message").removeClass("pb-0");
        //         $("#data-image-about-visible-message").addClass("pb-2");
        //         $(".see-list-image-video-grid-see-all.image").addClass("d-none");
        //     }
        // }
        /** Load data video detail **/
        // $('#number-video').text(res.data[0]['data'].total_record_video);
        $('#data-video-about-visible-message').html(res.data[3]);
        loadVideo();
        // if ($('#data-video-about-visible-message .see-item-image-video-grid').length === 0) {
        //     $('#data-video-about-visible-message').html(`<div class="empty-content" style="max-height: 200px; width: 100%; margin-top: 5%">
        //                                 <div class="text-center text-empty-notify">
        //                                     Chưa có video được chia sẻ trong cuộc hội thoại này
        //                                 </div>
        //                                 <label for="input-video-message-about" class="btn-send-image-detail">
        //                                     <i class="fa fa-camera"></i>
        //                                     <span>Thêm video</span>
        //                                     <input id="input-video-message-about" type="file" class="d-none" accept=".mov,.mp4,.3gp">
        //                                 </label>
        //                              </div>`)
        //     $(".see-list-image-video-grid-see-all.video").addClass("d-none");
        //     $("#video-list-about-visible-message").find(".ans").css("display", "block");
        // } else {
        //     $("#video-list-about-visible-message").find(".ans").css("display", "block");
        //     if ($("#data-video-about-visible-message .see-item-image-video-grid").length >= 6) {
        //         $("#data-video-about-visible-message").removeClass("pb-2");
        //         $("#data-video-about-visible-message").addClass("pb-0");
        //         $(".see-list-image-video-grid-see-all.video").removeClass("d-none");
        //     } else {
        //         $("#data-video-about-visible-message").removeClass("pb-0");
        //         $("#data-video-about-visible-message").addClass("pb-2");
        //         $(".see-list-image-video-grid-see-all.video").addClass("d-none");
        //     }
        // }
        /** Load data file detail **/
        // $('#number-file').text(res.data[0]['data'].total_record_file);
        $('#data-file-about-visible-message').html(res.data[4]);
        // if ($("#data-file-about-visible-message .hover-link-file").length === 0) {
        //     $("#data-file-about-visible-message").html(`<div class="empty-content" style="max-height: 200px; width: 100%; margin-top: 5%; padding: 10px 10px 0">
        //                                <div class="text-center text-empty-notify">
        //                                     Chưa có tài liệu được chia sẻ trong cuộc hội thoại này
        //                                 </div>
        //                                 <label for="input-file-message-about" class="btn-send-image-detail">
        //                                     <i class="fa fa-file"></i>
        //                                     <span>Thêm file</span>
        //                                 </label>
        //                                 <input id="input-file-message-about" class="d-none" type="file">
        //                              </div>`);
        //     $("#file-list-about-visible-message").find(".ans").css("display", "block");
        // } else {
        //     $("#file-list-about-visible-message").find(".ans").css("display", "block");
        //     if ($("#data-file-about-visible-message .hover-link-file").length >= 5) {
        //         $(".see-list-image-video-grid-see-all.file").removeClass("d-none");
        //         $("#data-file-about-visible-message").html(
        //             $("#data-file-about-visible-message").find(".hover-link-file:eq(0)")[0].outerHTML +
        //             $("#data-file-about-visible-message").find(".hover-link-file:eq(1)")[0].outerHTML +
        //             $("#data-file-about-visible-message").find(".hover-link-file:eq(2)")[0].outerHTML +
        //             $("#data-file-about-visible-message").find(".hover-link-file:eq(3)")[0].outerHTML +
        //             $("#data-file-about-visible-message").find(".hover-link-file:eq(4)")[0].outerHTML
        //         );
        //     } else {
        //         $(".see-list-image-video-grid-see-all.file").addClass("d-none");
        //     }
        // }
        /** Load data link detail **/
        // $('#number-link').text(res.data[0]['data'].total_record_link);
        $('#data-link-about-visible-message').html(res.data[5]);
        // if ($("#data-link-about-visible-message .hover-link-file").length === 0) {
        //     $("#data-link-about-visible-message").html(`<div class="empty-content" style="max-height: 200px; width: 100%; margin-top: 5%; padding: 10px 10px 0">
        //                                 <div class="text-center text-empty-notify">
        //                                     Chưa có đường dẫn được chia sẻ trong cuộc hội thoại này
        //                                 </div>
        //                          </div>`);
        //     $("#link-list-about-visible-message").find(".ans").css("display", "block");
        // } else {
        //     $("#link-list-about-visible-message").find(".ans").css("display", "block");
        //     if ($("#data-link-about-visible-message .hover-link-file").length >= 5) {
        //         $(".see-list-image-video-grid-see-all.link").removeClass("d-none");
        //         $("#data-link-about-visible-message").html(
        //             $("#data-link-about-visible-message").find(".hover-link-file:eq(0)")[0].outerHTML +
        //             $("#data-link-about-visible-message").find(".hover-link-file:eq(1)")[0].outerHTML +
        //             $("#data-link-about-visible-message").find(".hover-link-file:eq(2)")[0].outerHTML +
        //             $("#data-link-about-visible-message").find(".hover-link-file:eq(3)")[0].outerHTML +
        //             $("#data-link-about-visible-message").find(".hover-link-file:eq(4)")[0].outerHTML
        //         );
        //     } else {
        //         $(".see-list-image-video-grid-see-all.link").addClass("d-none");
        //     }
        //     $('[data-toggle="tooltip"]').tooltip({
        //         trigger: 'hover',
        //         container: 'body',
        //         html: true
        //     });
        // }
    }).catch(function (e) {
        console.log(e);
        let dataTagName = [];
        renderDataTagVisibleMessage(dataTagName);
    })
}
/** Function lấy danh sách tất cả file **/
async function dataFileDetailConversation(type, page) {
    if (checkLoadDataFileConversation === 1) return false;
    checkLoadDataFileConversation = 1;
    let method = 'GET',
        url = 'visible-message.detail-file-conversation',
        params = {
            page: page,
            type: type,
            id: idCurrentConversation
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    page++;
    // currentLengthFileDetailConversation = res.data[1].data.list.length;
    checkLoadDataFileConversation = 0;
    switch (type) {
        case 2:
            $('#detail-about-images-visible-message').html(res.data[0]);
            break;
        case 3:
            $('#detail-about-file-visible-message').html(res.data[0]);
            break;
        case 5:
            $('#detail-about-video-visible-message').html(res.data[0]);
            break;
        case 8:
            $('#detail-about-link-visible-message').html(res.data[0]);
            break;
    }
    return res.data[0];
}

async function showMessagePinnedDetailConversation(data) {
    if (data._id !== undefined) {
        $('#pin-visible-message').removeClass('d-none');
        $('.pin-visible-message-img').addClass('d-none');
        $('.pin-visible-message-name').text(data.sender.full_name);
        sizeBodyMessageThumbnail();
        switch (data.message_pinned.message_type) {
            case 1: //text
                break;
            case 2: //image
                $('.pin-visible-message-img').removeClass('d-none');
                $('.pin-visible-message-img').attr('src', domainSession + data.message_pinned.files[0].link_thumb);
                $('.pin-visible-message-text').text(data.message_pinned.sender.full_name + ': ' + 'Đã gửi ' + data.message_pinned.files.length + ' hình ảnh');
                break;
            case 3: //file
                $('.pin-visible-message-img').removeClass('d-none');
                $('.pin-visible-message-img').attr('src', '/images/message/file.png');
                $('.pin-visible-message-text').text(data.message_pinned.sender.full_name + ': ' + 'Đã gửi ' + data.message_pinned.files.length + ' file');
                break;
            case 4: //sticker
                $('.pin-visible-message-img').removeClass('d-none');
                $('.pin-visible-message-img').attr('src', domainSession + data.message_pinned.message);
                $('.pin-visible-message-text').text(data.message_pinned.sender.full_name + ': ' + 'Đã gửi sticker');
                break;
            case 5: //video
                $('.pin-visible-message-img').removeClass('d-none');
                $('.pin-visible-message-img').attr('src', '/images/message/video.png');
                $('.pin-visible-message-text').text(data.message_pinned.sender.full_name + ': ' + 'Đã gửi video');
                break;
            case 6: //audio
                $('.pin-visible-message-img').removeClass('d-none');
                $('.pin-visible-message-img').attr('src', '/images/message/record.png');
                $('.pin-visible-message-text').text(data.message_pinned.sender.full_name + ': ' + 'Đã gửi đoạn ghi âm');
                break;
            case 7://reply
                for await (const v of data.message_pinned.list_tag_name) {
                    data.message_pinned.message = data.message_pinned.message.replace(v.key_tag_name, `<span class="tag-name">@${v.full_name}</span>`);
                }
                $('.pin-visible-message-text').html(data.message_pinned.sender.full_name + ': ' + data.message_pinned.message);
                break;
            case 8: //link
                for await (const v of data.message_pinned.list_tag_name) {
                    data.message_pinned.message = data.message_pinned.message.replace(v.key_tag_name, `<span class="tag-name">@${v.full_name}</span>`);
                }
                $('.pin-visible-message-text').html(data.message_pinned.sender.full_name + ': ' + 'Link -> ' + data.message_pinned.message);
                break;
            default:
                $('.pin-visible-message-text').text(data.message_pinned.sender.full_name + ': ' + data.message_pinned.message);
        }
    }
}
//
// async function showCurrentPinnedMessage(r) {
//     let method = 'GET',
//         url = 'visible-message.detail-pinned-conversation',
//         params = {
//             id: idCurrentConversation,
//             page: 1,
//             limit: limitPinDetailAboutVisibleMessage,
//             type: typeCurrentConversation
//         },
//         data = null;
//     let res = await axiosTemplate(method, url, params, data);
//     $('#content-current-pinned-visible').html(res.data[2]);
//     $('#pin-visible-message-custom').find('.item-action-revoke-pin').addClass('d-none');
//     $('#pin-visible-message-custom').find('.seen-message-old').addClass('d-none');
// }

async function getTagNameMessage(r) {
    if ($('#message-tag-name-modal').hasClass('show')) return false;
    let method = 'GET',
        url = 'visible-message.tag-my-name',
        params = {
            conversation_type: r.data('type'),
            group_id: r.data('id')
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#data-all-message-tag-name').html(res.data[0]);
    $('.number-message-tag-name-modal').text(res.data[1].data.total_record);
}

function closeModalRemindTime() {
    $('#modal-remind-time-visible').modal('hide');
}

function closeModalPinnedCurrentMessage() {
    $('#pin-visible-message-custom').modal('hide');
    $('#content-current-pinned-visible').html('');
}

