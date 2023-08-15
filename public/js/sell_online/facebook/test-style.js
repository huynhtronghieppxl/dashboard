let dataListBookingFirst = "";
let tabNumItemBooking = 1;
let phoneNumberCustomerfacebook, dataImageUploadFacebook = [], dataVideoUploadFacebook = [];

$(function () {
    getOrderFacebookMessage ();
    $(document).on('change', '#item-upload-image-facebook-message', async function () {
        for await (const v of $(this).prop('files')) {
            dataImageUploadFacebook.push(v);
            $('.see-item-image-video-grid:eq(5)').remove();
            $('#data-image-about-visible-message').prepend(`<div class="see-item-image-video-grid item-image-about-visible-messages">
                                                                <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-item-image-video-grid-img" src="${URL.createObjectURL(v)}" data-link-original="${URL.createObjectURL(v)}" data-name="" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                                                <div class="see-item-image-video-grid-download btn-download-file-upload">
                                                                    <i class="fa fa-download" data-download="http://172.16.10.85:9007xe8qkyL-sQirk-Q8GmgNC" data-name-file="Screenshot 2022-12-31 094624.png"></i>
                                                                </div>
                                                            </div>`)
        }
        $('#data-message-visible-message-facebook').prepend(`<div class="chat-body-message-element message-right">
                                                                        <div class="chat-body-message">

                                                                            ${await countImageInputFacebook(dataImageUploadFacebook)}
                                                                            <div class="chat-body-message-footer">
                                                                                <ul class="chat-body-message-item-action-list d-none">
                                                                                    <li class="chat-body-message-item-action-item item-action-revoke">
                                                                                        <i class="chat-body-message-item-action-icon ion-refresh"></i>
                                                                                    </li>
                                                                                    <li class="chat-body-message-item-action-item item-action-reply">
                                                                                        <i class="chat-body-message-item-action-icon ion-quote"></i>
                                                                                    </li>
                                                                                    <li class="chat-body-message-item-action-item item-action-pin">
                                                                                        <i class="chat-body-message-item-action-icon ion-pin"></i>
                                                                                    </li>
                                                                                </ul>
                                                                                <span class="time-message-ago" data-time="19/09/2022 10:20:57">Vừa xong</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    `);
        $('#item-upload-image-facebook-message').val('');
        dataImageUploadFacebook = [];
    });
 /**
  * Even xử lý xem tất cả ảnh
  */
    $(document).on('click', '#show-all-image-about', function (){
        $('#about-chat-facebook-right-bar').addClass('d-none');
        $('#list-media-right-bar').removeClass('d-none');
        $('#dashboard-facebook-right-image-media').html(dataListImage);
        $('#dashboard-facebook-right-video-media').html( dataListVideo);
        $('#dashboard-facebook-right-link-media').html(dataListLink);
    });
    /**
     * Sticker messenger facebook
     */
    $(document).on('click', '.icon-sticker-chat-facebook-message', function(){
        $('.icon-sticker-chat-facebook-message').toggleClass('active')
        if( $('.icon-sticker-chat-facebook-message').hasClass('active')){
            $('.message-facebook-group-sticker-class').removeClass('d-none')
        } else {
            $('.message-facebook-group-sticker-class').addClass('d-none')
        }
    })
    $(document).on('click', '.item-sticker-image-big', async function () {
        $('.message-facebook-group-sticker-class').addClass('d-none');
        $('.icon-sticker-chat-facebook-message').removeClass('active');
        let itemImageSticker = $('.image-sticker-big').attr('src');

        $('#data-message-visible-message-facebook').prepend(`<div class="chat-body-message-element message-right">
                                                                       <div class="chat-body-message">
                                                                          <div class="chat-body-message-sticker">
                                                                            <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="${await itemImageSticker}" alt="Sticker">
                                                                          </div>
                                                                          <div class="chat-body-message-footer">
                                                                              <ul class="chat-body-message-item-action-list d-none">
                                                                                  <li class="chat-body-message-item-action-item item-action-revoke">
                                                                                      <i class="chat-body-message-item-action-icon ion-refresh"></i>
                                                                                  </li>
                                                                                  <li class="chat-body-message-item-action-item item-action-reply">
                                                                                      <i class="chat-body-message-item-action-icon ion-quote"></i>
                                                                                  </li>
                                                                                  <li class="chat-body-message-item-action-item item-action-pin">
                                                                                      <i class="chat-body-message-item-action-icon ion-pin"></i>
                                                                                  </li>
                                                                              </ul>
                                                                              <span class="time-message-ago" data-time="19/09/2022 10:23:19">10:23</span>
                                                                          </div>
                                                                      </div>
                                                                    </div>
                                                                    `);
                                                                });

    /**
     * Search page in list page messenger
     */
    $(document).on('input', '#dashboard-facebook-header-input-search', function () {
        let valueOptionSearch = removeVietnameseStringLowerCase($(this).val());
        $('.dashboard-facebook-header-option-list .dashboard-facebook-header-option-item').each(function (i, e) {
            let listNameOptionMessenger = removeVietnameseStringLowerCase($(this).find('.dashboard-facebook-conversation-filter-name-option').text());
            $(this).closest('.dashboard-facebook-header-option-list .dashboard-facebook-header-option-item')[listNameOptionMessenger.indexOf(valueOptionSearch) !== -1 ? 'show' : 'hide']();
        });
    });
    /**
     * Search messenger in list message
     */
    // $(document).on("input", '#dashboard-facebook-filter-search-input_filter input[type="search"]', function () {
    //     $("#tab-list-messenger-filter").find($("#dashboard-facebook-conversation-filter-list-tab2").find($(".dashboard-facebook-conversation-filter-name")).length);
    // });

    // $(document).on('input','#dashboard-facebook-filter-search-input',function (){
    //     let searchListMessenger = removeVietnameseStringLowerCase($(this).val()) ;
    //     $('#dashboard-facebook-conversation-filter-list-tab2.active .dashboard-facebook-conversation-filter-item').each(function (i,e){
    //         let listMessenger = removeVietnameseStringLowerCase($(this).find('.dashboard-facebook-conversation-filter-name-text').text());
    //         $(this).closest('#dashboard-facebook-conversation-filter-list-tab2.active .dashboard-facebook-conversation-filter-item')[listMessenger.indexOf(searchListMessenger) !== -1 ? 'show' : 'hide']();
    //     });
    // });
    /**
     * Search comment in list messenger
     */
    // $(document).on("input", '#dashboard-facebook-filter-search-input_filter input[type="search"]', function () {
    //     $("#tab-list-comment-messenger-filter").find($("#dashboard-facebook-conversation-filter-list-tab3").find($(".dashboard-facebook-conversation-filter-name")).length);
    // });
    // $(document).on('input','#dashboard-facebook-filter-search-input',function (){
    //     let searchListComment = removeVietnameseStringLowerCase($(this).val()) ;
    //     $('#dashboard-facebook-conversation-filter-list-tab3.active .dashboard-facebook-conversation-filter-item').each(function (i,e){
    //         let listComment = removeVietnameseStringLowerCase($(this).find('.dashboard-facebook-conversation-filter-name-text').text());
    //         $(this).closest('#dashboard-facebook-conversation-filter-list-tab3.active .dashboard-facebook-conversation-filter-item')[listComment.indexOf(searchListComment) !== -1 ? 'show' : 'hide']();
    //     });
    // });

    $(document).on('click', '.filter-message', function () {
        let typeInInventory = $(this).data("type");
        switch (typeInInventory) {
            case 1:
                console.log(123);

                break;
            case 2:
                console.log(456);
                $(document).on("input", '#dashboard-facebook-filter-search-input_filter input[type="search"]', function () {
                    $("#tab-list-messenger-filter").find($("#dashboard-facebook-conversation-filter-list-tab2").find($(".dashboard-facebook-conversation-filter-name")).length);
                });
                break;
            case 3:
                console.log(789);
                $(document).on("input", '#dashboard-facebook-filter-search-input_filter input[type="search"]', function () {
                    $("#tab-list-comment-messenger-filter").find($("#dashboard-facebook-conversation-filter-list-tab3").find($(".dashboard-facebook-conversation-filter-name")).length);
                });
                break;
        }
    });

    // /** Sự kiện bấm vào nút chọn trang **/
    // $(document).on('click', '.dashboard-facebook-header-select', function(e){
    //     if($(this).hasClass('active')){
    //         $(this).removeClass('active');
    //         $(this).parent().find('.dashboard-facebook-header-option').addClass('d-none');
    //     } else {
    //         e.stopPropagation();
    //         $(this).parent().find('.dashboard-facebook-header-option').removeClass('d-none');
    //         $(this).addClass('active');
    //     }
    // });
    // $(document).on('mouseup', function (e) {
    //     let container = $('.dashboard-facebook-header-option');
    //     if (!container.is(e.target) && container.has(e.target).length === 0 && !container.hasClass('d-none')) {
    //         container.addClass('d-none');
    //     } else {
    //         $('.dashboard-facebook-header-select').removeClass('active');
    //     }
    // });
    // /** Sự kiện bấm vào nút filter **/
    // $(document).on('click','.dashboard-facebook-filter-action .ti-filter', function(e){
    //     console.log(123)
    //     if( $(this).hasClass('active')){
    //         $(this).removeClass('active');
    //         $(this).parent().find('.dashboard-facebook-filter-action-list').addClass('d-none');
    //     } else {
    //         e.stopPropagation();
    //         $(this).parent().find('.dashboard-facebook-filter-action-list').removeClass('d-none');
    //         $(this).addClass('active');
    //     }
    // });
    // $(document).on('mouseup', function (e) {
    //     let container = $('.dashboard-facebook-filter-action-list');
    //     if (!container.is(e.target) && container.has(e.target).length === 0 && !container.hasClass('d-none')) {
    //         container.addClass('d-none');
    //     } else {
    //         $('.dashboard-facebook-filter-action .ti-filter').removeClass('active');
    //     }
    // });
    //
    // /** Sự kiện bấm vào avartar messenger **/
    // $(document).on('click', '.dashboard-facebook-header-select-setting', function(e){
    //     if( $(this).hasClass('active')){
    //         $(this).removeClass('active');
    //         $(this).parent().find('.dashboard-facebook-header-select-setting-contain').addClass('d-none');
    //     } else {
    //         e.stopPropagation();
    //         $(this).parent().find('.dashboard-facebook-header-select-setting-contain').removeClass('d-none');
    //         $(this).addClass('active');
    //     }
    // });
    // $(document).on('mouseup', function (e) {
    //     let container = $('.dashboard-facebook-header-select-setting-contain');
    //     if (!container.is(e.target) && container.has(e.target).length === 0 && !container.hasClass('d-none')) {
    //         container.addClass('d-none');
    //     } else {
    //         $('.dashboard-facebook-header-select-setting').removeClass('active');
    //     }
    // });

    $(document).on('click', '#icon-pencel-edit-phone-facebook', function () {
        $('#phone-number-customer-label').addClass('d-none');
        $('#phone-number-customer-restaurant').removeClass('d-none');
        $('#icon-pencel-edit-phone-facebook').addClass('d-none');
        $('#icon-close-edit-phone-facebook').removeClass('d-none');
        $('#icon-check-edit-phone-facebook').addClass('d-none');
        phoneNumberCustomerfacebook = $('#phone-number-customer-label').text();
        $('#phone-number-customer-restaurant').val(phoneNumberCustomerfacebook);
    });

    $(document).on('click', '#icon-close-edit-phone-facebook', function () {
        $(this).addClass('d-none');
        $('#phone-number-customer-label').removeClass('d-none');
        $('#icon-pencel-edit-phone-facebook').removeClass('d-none');
        $('#phone-number-customer-restaurant').addClass('d-none');
        $('#icon-check-edit-phone-facebook').addClass('d-none');
        $('#phone-number-customer-label').text(phoneNumberCustomerfacebook);
    });

    $(document).on('input paste change', '#phone-number-customer-restaurant', function () {
        if($(this).val() == ""){
            $('#icon-check-edit-phone-facebook').addClass('d-none');
            $('#icon-close-edit-phone-facebook').removeClass('d-none');
        } else {
            if (phoneNumberCustomerfacebook != $(this).val()) {
                $('#icon-check-edit-phone-facebook').removeClass('d-none');
                $('#icon-close-edit-phone-facebook').addClass('d-none');
            } else {
                $('#icon-check-edit-phone-facebook').addClass('d-none');
                $('#icon-close-edit-phone-facebook').removeClass('d-none');
            }
        }
    });

    $(document).on('click', '#icon-check-edit-phone-facebook', function () {
        $('#phone-number-customer-label').removeClass('d-none');
        $('#phone-number-customer-restaurant').addClass('d-none');
        $('#icon-pencel-edit-phone-facebook').removeClass('d-none');
        $('#icon-check-edit-phone-facebook').addClass('d-none');
        $('#phone-number-customer-label').text($('#phone-number-customer-restaurant').val())
    });

    /**
     * Hàm xử lý khi không có đơn hàng
     */
    $(document).on('click', '.opener', function () {
        $('#order-booking-facebook').addClass('active')
        let countDiv = $('.customer-booking-list').length;
        if (countDiv > 0) {
            $('.item-empty-booking-facebook').addClass('d-none')
            $('#show-all-booking-about').removeClass('d-none')
            $('#booking-about-celendar-button').addClass('d-none')
        }else {
            $('.item-empty-booking-facebook').removeClass('d-none')
            $('#show-all-booking-about').addClass('d-none')
            $('#booking-about-celendar-button').removeClass('d-none')
        }
    })
    /**
     * Hàm xử lý khi không có ảnh
     */
    $(document).on('click', '.dashboard-facebook-conversation-filter-item', function () {
        let countImage = $('#data-image-about-visible-message .item-image-about-visible-messages img').length;
        if (countImage > 0){
            $('.item-empty-img-booking-facebook').addClass('d-none')
        }else {
            $('.item-empty-img-booking-facebook').removeClass('d-none')
        }
    });
    /**
     * Nút mở booking đơn hàng
     */
    $(document).on('click', '#booking-about-celendar-button', function () {
        openModalCreateBookingTableManage()
    })

    /**
     * Hàm kiểm tra đơn hàng
     */
    $(document).on('click', '.nav-item-booking', function (){
        tabNumItemBooking = $(this).data('type');
        switch (tabNumItemBooking){
            case 1:
                let countNumItemListWaiting = $('#dashboard-facebook-right-waiting-booking').length;
                if (countNumItemListWaiting === 0) {
                    $('#tab-dashboard-facebook-right-waiting-booking').append(`<div class="item-empty-booking-facebook-all-list">
                                <img class="image-empty-booking-facebook" src='/images/image_facebook/calendar-bro.png' alt="">
                            </div>`);
                };
                break;
            case 2:
                let countNumItemListComplete = $('#dashboard-facebook-right-complete-booking').length;
                if (countNumItemListComplete === 0) {
                    $('#tab-dashboard-facebook-right-waiting-booking').append(`<div class="item-empty-booking-facebook-all-list">
                                <img class="image-empty-booking-facebook" src='/images/image_facebook/calendar-bro.png' alt="">
                            </div>`);
                };
                break;
            case 3:
                let countNumItemListCancel = $('#dashboard-facebook-right-cancel-booking').length;
                if (countNumItemListCancel === 0) {
                    $('#tab-dashboard-facebook-right-waiting-booking').append(`<div class="item-empty-booking-facebook-all-list">
                                <img class="image-empty-booking-facebook" src='/images/image_facebook/calendar-bro.png' alt="">
                            </div>`);
                };
                break;
        }
    });

    $('.icon-group-menu').on('click ', function(){
        if($('#message-facebook').text() != "") {
            $('.group-icon-tool-facebook').toggleClass('d-none');
        }
    });
    $(document).on('keyup', '#message-facebook', function (){
        if($(this).text() == ""){
            $('.group-icon-tool-facebook').addClass('d-none');
        }
    });
/**
 * Event thay đổi màu icon khi không focus
 */
    $(document).on('focus', '#message-facebook', function (){
        $(this).parents('.dashboard-facebook-body-input').find('svg .color-icon-facebook').attr('fill', '#0084FF');
    });

    $(document).on('focusout', '#message-facebook', function (){
        $(this).parents('.dashboard-facebook-body-input').find('svg .color-icon-facebook').attr('fill', '#E3E5E7');
    });
/**
 * Event gửi icon smile
 */
    $(document).on('click', '.emoji-send-facebook-message', async function (){
        $('#data-message-visible-message-facebook').prepend(`<div class="chat-body-message-element message-right">
                                                                       <div class="chat-body-message chat-body-message-icon" style=" min-width: 70px;">
                                                                          <div class="chat-body-message-sticker">
                                                                             <i class="fa fa-smile-o icon-item-send-message"></i>
                                                                          </div>
                                                                          <div class="chat-body-message-footer">
                                                                              <ul class="chat-body-message-item-action-list d-none">
                                                                                  <li class="chat-body-message-item-action-item item-action-revoke">
                                                                                      <i class="chat-body-message-item-action-icon ion-refresh"></i>
                                                                                  </li>
                                                                                  <li class="chat-body-message-item-action-item item-action-reply">
                                                                                      <i class="chat-body-message-item-action-icon ion-quote"></i>
                                                                                  </li>
                                                                                  <li class="chat-body-message-item-action-item item-action-pin">
                                                                                      <i class="chat-body-message-item-action-icon ion-pin"></i>
                                                                                  </li>
                                                                              </ul>
                                                                              <span class="time-message-ago" data-time="19/09/2022 10:23:19">10:23</span>
                                                                          </div>
                                                                      </div>
                                                                    </div>
                                                                    `);
    });

    $(document).on('click', '.icon-group-menu', function () {
        let checkedGroupAction = $('#group-action-tool-popup-facebook');
        checkedGroupAction.toggleClass('d-none');
    })
    $(document).on('click', '.icon-group-menu', function () {
        $('#message-facebook').focus();
        if ($('#message-facebook').text() != ''){
            $('#icon-image-chat-facebook-message-popup').removeClass('d-none')
            $('#icon-sticker-chat-facebook-message-popup').removeClass('d-none')
            $('#icon-gif-chat-facebook-message-popup').removeClass('d-none')
        }else{
            $('#icon-image-chat-facebook-message-popup').addClass('d-none')
            $('#icon-sticker-chat-facebook-message-popup').addClass('d-none')
            $('#icon-gif-chat-facebook-message-popup').addClass('d-none')
        }
    })

    /**
     * nút gửi video
     */
    $(document).on('chance', '#chat-action-video-facebook', async function () {
            let file = $(this).prop('files')[0];
            let fileReader = new FileReader();
            fileReader.onload = async function () {
                let blob = new Blob([fileReader.result], {type: file.type});
                let url = URL.createObjectURL(blob);
                let video = document.createElement('video');
                let timeupdate = function () {
                    if (snapImage()) {
                        video.removeEventListener('timeupdate', timeupdate);
                        video.pause();
                    }
                };
                video.addEventListener('loadeddata', function () {
                    if (snapImage()) {
                        video.removeEventListener('timeupdate', timeupdate);
                    }
                });
                let snapImage = async function () {
                    let canvas = document.createElement('canvas');
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                    let image = canvas.toDataURL("image/png");
                    let res = await uploadMediaTemplate(dataURLtoFile(image), 0);
                    file.thumb = res.data[0];
                    sendVideoVisibleMessageFacebook(file);
                    $('#input-video-message').replaceWith($('#input-video-message').val('').clone(true));
                    $('#data-message-visible-message-facebook').scrollTop(0);
                };
                video.addEventListener('timeupdate', timeupdate);
                video.preload = 'metadata';
                video.src = url;
                video.muted = true;
                video.playsInline = true;
                video.play();
            };
            fileReader.readAsArrayBuffer(file);
        })

})

async function countImageInputFacebook(data) {
    switch (data.length) {
        case 1:
            return `<div class="chat-body-message-image" data-number-img="${data.length}">
                        <div class="wrapper one-image">
                            <div class="gallery">
                                <div class="gallery__item gallery__item--1">
                                    <a href="javascript:void(0)" class="gallery__link">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${URL.createObjectURL(data[0])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                    </a>
                                </div>
                            </div>
                        </div>
                   </div>`;
        case 2:
            return `<div class="chat-body-message-image" data-number-img="${data.length}">
                    <div class="wrapper two-image">
                        <div class="gallery">
                            <div class="gallery__item gallery__item--1">
                                <a href="javascript:void(0)" class="gallery__link">
                                  <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" data-name="" src="${URL.createObjectURL(data[0])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--2">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${URL.createObjectURL(data[1])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>`;
        case 3:
            return `<div class="chat-body-message-image" data-number-img="${data.length}">
                                <div class="wrapper three-image">
                                    <div class="gallery">
                                        <div class="gallery__item gallery__item--1">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="${URL.createObjectURL(data[0])}" class="gallery__image" loading="lazy">
                                            </a>
                                        </div>
                                        <div class="gallery__item gallery__item--2">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="${URL.createObjectURL(data[1])}" class="gallery__image" loading="lazy">
                                            </a>
                                        </div>
                                        <div class="gallery__item gallery__item--3">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="${URL.createObjectURL(data[2])}" class="gallery__image" loading="lazy">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
        case 4:
            return `<div class="chat-body-message-image" data-number-img="${data.length}">
                    <div class="wrapper four-image">
                        <div class="gallery">
                            <div class="gallery__item gallery__item--1">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${URL.createObjectURL(data[0])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--2">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${URL.createObjectURL(data[1])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--3">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${URL.createObjectURL(data[2])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--4">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${URL.createObjectURL(data[3])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>`;
        case 5:
            return `<div class="chat-body-message-image" data-number-img="${data.length}">
                     <div class="wrapper five-image">
                        <div class="gallery">
                             <div class="gallery__item gallery__item--1">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${URL.createObjectURL(data[0])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--2">
                                <a href="javascript:void(0)" class="gallery__link">
                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${URL.createObjectURL(data[1])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--3">
                                <a href="javascript:void(0)" class="gallery__link">
                                     <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${URL.createObjectURL(data[2])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--4">
                                <a href="javascript:void(0)" class="gallery__link">
                                     <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${URL.createObjectURL(data[3])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                </a>
                            </div>
                            <div class="gallery__item gallery__item--5">
                                <a href="javascript:void(0)" class="gallery__link">
                                     <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${URL.createObjectURL(data[4])}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>`;
        default:
            let item = '', srcImg = '';
            let srcOfImg = [];
            jQuery.each(data, function (i, v) {
                srcImg = URL.createObjectURL(v);
                item += `<div data-src="${srcImg}"></div>`;
                srcOfImg.push(srcImg);
            });

            return `<div class="chat-body-message-image" data-number-img="${data.length}">
                        <div class="wrapper five-image">
                            <div class="gallery">
                                <div class="gallery__item gallery__item--1">
                                   <a href="javascript:void(0)" class="gallery__link">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${srcOfImg[0]}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                  </a>
                                </div>
                                <div class="gallery__item gallery__item--2">
                                    <a href="javascript:void(0)" class="gallery__link">
                                       <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${srcOfImg[1]}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                    </a>
                                </div>
                                <div class="gallery__item gallery__item--3">
                                    <a href="javascript:void(0)" class="gallery__link">
                                       <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${srcOfImg[2]}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                    </a>
                                </div>
                                <div class="gallery__item gallery__item--4">
                                    <a href="javascript:void(0)" class="gallery__link">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${srcOfImg[3]}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                    </a>
                                </div>
                                <div class="gallery__item gallery__item--5">
                                    <a href="javascript:void(0)" class="gallery__link">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  data-name="" src="${srcOfImg[4]}" alt="Hình ảnh" class="gallery__image"  loading="lazy"/>
                                        <div class="more-photos"><span>+${data.length - 5}<span></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                         <div class="sub-item-image d-none">
                              ${item}
                         </div>
                     </div>`;
    }
}

/**
 * Function đơn hàng booking
 */

async function getOrderFacebookMessage () {
    let method = 'get',
        url = 'message-facebook.booking-facebook',
        params = {
            phone: $('#phone-number-customer-label').text()
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataListBookingFirst = res.data[0];
    $('.customer-booking-list').html(dataListBookingFirst);
}

function closeListMediaRightBar() {
    $('#about-chat-facebook-right-bar').removeClass('d-none');
    $('#list-media-right-bar').addClass('d-none');
}


function clearDataBeforeClick() {
    $('#about-chat-facebook-right-bar').removeClass('d-none');
    $('#list-media-right-bar').addClass('d-none');
}

async function sendVideoVisibleMessageFacebook(data) {
    let key = 'key-identification-' + moment().format('x');
    if (checkIdEmpty(idCurrentConversation, idSession)) return false;
    $('#data-message-visible-message-facebook').prepend(`<div class="chat-body-message-element message-right" id="" data-position="" data-id="" data-random-key="" data-identification="${key}" data-type="" data-name="" data-sender="">
                <div class="chat-body-message">
                    <div class="chat-body-message-video">
                        <div class="chat-message-video-content">
                            <video class="video-after-img d-none" controls>
                                <source src="${URL.createObjectURL(data)}"/>
                            </video>
                            <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  src="${domainSession + data.thumb}" data-video="${URL.createObjectURL(data)}" loading="lazy">
                            <i class="play-video-to-link-btn" onclick="viewVideo($(this))">
                                <svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" height="50px" width="50px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" fill="#000" xml:space="preserve">
                                    <path class="stroke-solid" fill="none" stroke=""
                                            d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
                                                                    C97.3,23.7,75.7,2.3,49.9,2.5"/>
                                    <path class="icon" fill="#fff" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z" />
                                </svg>
                            </i>
                        </div>
                    </div>
                        ${footerMessage(idSession, moment().format('DD/MM/YYYY HH:mm:ss'))}
                </div>
        </div>`);
    let res = await uploadMediaTemplate(data, 0);
    let file = [{
        "link_thumb": data.thumb,
        "link_thumb_video": data.thumb,
        "type": 1,
        "width": 300,
        "height": 300,
        "ratio": 1,
        "link_original": res.data[0],
        "name_file": data.name,
        "size": data.size
    }]
    if (typeCurrentConversation === 3) {
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            group_id_tms_supplier: idCurrentConversation,
            code: '',
            files: file,
            message_type: 5,
            app_name: 'tms',
            key_message_error: key
        };
        socket.emit('chat-video-tms-supplier', data);
    } else {
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            files: file,
            message_type: 5,
            key_message_error: key
        };
        socket.emit('chat-video', data);
    }
    return false;
    for await(const v of dataMediaVideoCurrent) {
        let key = 'key-identification-' + moment().format('x');
        if (checkIdEmpty(idCurrentConversation, idSession)) return false;
        $('#data-message-visible-message-facebook').prepend(`<div class="chat-body-message-element message-right" id="" data-position="" data-id="" data-random-key="" data-identification="${key}" data-type="" data-name="" data-sender="">
                <div class="chat-body-message">
                    <div class="chat-body-message-video">
                        <div class="chat-message-video-content">
                            <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  src="${imageThumbLink}" data-video="${URL.createObjectURL(v)}" loading="lazy">
                            <i class="play-video-to-link-btn" onclick="viewVideo($(this))">
                                <svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" height="50px" width="50px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" fill="#000" xml:space="preserve">
                                    <path class="stroke-solid" fill="none" stroke=""
                                            d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
                                                                    C97.3,23.7,75.7,2.3,49.9,2.5"/>
                                    <path class="icon" fill="#fff" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z" />
                                </svg>
                            </i>
                        </div>
                    </div>
                        ${footerMessage(idSession, moment().format('DD/MM/YYYY HH:mm:ss'))}
                </div>
        </div>`);
        let res = await uploadMediaTemplate(v, 0);
        let file = [{
            "link_thumb": res.data[1],
            "link_thumb_video": res.data[1],
            "type": 1,
            "width": 300,
            "height": 300,
            "ratio": 1,
            "link_original": res.data[0],
            "name_file": v.name,
            "size": v.size
        }]
        dataMediaVideoCurrent = [];
        if (typeCurrentConversation === 3) {
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                group_id_tms_supplier: idCurrentConversation,
                code: '',
                files: file,
                message_type: 5,
                app_name: 'tms',
                key_message_error: key
            };
            socket.emit('chat-video-tms-supplier', data);
        } else {
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                files: file,
                message_type: 5,
                key_message_error: key
            };
            socket.emit('chat-video', data);
        }
    }
}
