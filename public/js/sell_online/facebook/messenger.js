let id_user_from;
let dataListBookingWaiting = "", dataListBookingComplete = "", dataListBookingCancel = "";
let dataListImage = "", dataListVideo = "", dataListLink = "";
let dataMessageFacebook= "";

let htmlDivAccountInactive = `<div class="position-relative content text-center">
                                <div class="">
                                    <div id="" class="popup popup-template">
                                        <div class="" style="">
                                            <div class="container w-100 mt-4" style="font-weight: 800;">Người này hiện không có trên Messenger</div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
let htmlReply = `<div class="position-relative d-table content">
                    <div class="d-table-cell align-middle">
                    <div class="emoji_popup">
                        <button type="button" id="btn_open_emoji" class="" data-toggle="tooltip" data-placement="top" data-tip="true" data-for="emoji_icon" currentitem="false" data-original-title="" title="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-smile">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                                <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                <line x1="15" y1="9" x2="15.01" y2="9"></line>
                            </svg>
                        </button>
                    </div>
                    </div>
                    <div class="d-table-cell align-middle reply-editor-wrapper" id="reply-editor-wrapper">
                        <input type="text" class="reply-editor" id="reply-messager" placeholder="Nhập nội dung tin nhắn, #trả lời nhanh, @gửi ảnh nhanh..." style="overflow: hidden; height: 16px;"></input></div>
                    <div class="d-table-cell align-middle text-nowrap buttons-control">
                    <div class="reply-button-action">
                        <div class="dropdown dropup">
                            <span class="plus-icon" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg class="reply-box-outside-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.25 10C19.25 15.1086 15.1086 19.25 10 19.25C4.89137 19.25 0.75 15.1086 0.75 10C0.75 4.89137 4.89137 0.75 10 0.75C15.1086 0.75 19.25 4.89137 19.25 10Z" stroke="#90949C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M9.99992 5V15" stroke="#90949C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M5 9.99994H15" stroke="#90949C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="d-flex align-items-center dropdown-item">
                                <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="path-1-inside-1" fill="white">
                                        <path d="M18 4V15C18 15.5523 17.5523 16 17 16H3C2.44772 16 2 15.5523 2 15V4"></path>
                                    </mask>
                                    <path d="M19 4C19 3.44772 18.5523 3 18 3C17.4477 3 17 3.44772 17 4H19ZM3 4C3 3.44772 2.55228 3 2 3C1.44772 3 1 3.44772 1 4H3ZM17 4V15H19V4H17ZM17 15H3V17H17V15ZM3 15V4H1V15H3ZM3 15H1C1 16.1046 1.89543 17 3 17V15ZM17 15V17C18.1046 17 19 16.1046 19 15H17Z" fill="#F34F0F" mask="url(#path-1-inside-1)"></path>
                                    <path d="M1 0.5H19C19.2761 0.5 19.5 0.723858 19.5 1V3.54545C19.5 3.8216 19.2761 4.04545 19 4.04545H1C0.723858 4.04545 0.5 3.8216 0.5 3.54545V1C0.5 0.723858 0.723857 0.5 1 0.5Z" stroke="#F34F0F" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M8 10H12" stroke="#F34F0F" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <span>Gửi sản phẩm (Alt+S)</span>
                                </a>
                                <a class="d-flex align-items-center dropdown-item">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="0.5" y="0.5" width="19" height="19" rx="3.5" fill="white" stroke="#FF9224"></rect>
                                    <circle cx="5.5" cy="7.5" r="1.5" fill="#FF9224"></circle>
                                    <circle cx="14.5" cy="7.5" r="1.5" fill="#FF9224"></circle>
                                    <path d="M15.4704 13.1732C15.7419 13.3121 15.8144 13.6675 15.5968 13.881C15.0013 14.4654 14.2618 14.9525 13.42 15.3122C12.3762 15.7582 11.2076 15.9945 10.0187 15.9999C8.82984 16.0053 7.65781 15.7796 6.60748 15.3431C5.75968 14.9908 5.01251 14.51 4.40813 13.9304C4.18837 13.7197 4.25679 13.3639 4.52642 13.2225C4.72251 13.1196 4.9621 13.1678 5.11808 13.3249C5.65086 13.8618 6.3236 14.3054 7.09323 14.6253C7.99215 14.9989 8.99521 15.192 10.0127 15.1873C11.0302 15.1827 12.0303 14.9805 12.9236 14.5988C13.6875 14.2724 14.3529 13.8235 14.8774 13.2827C15.0322 13.1231 15.2724 13.0719 15.4704 13.1732Z" fill="#FF9224"></path>
                                </svg>
                                <span>Nhãn dán</span>
                                </a>
                                <a class="d-flex align-items-center dropdown-item">
                                <svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17 9.18182C17 15.5455 9 21 9 21C9 21 1 15.5455 1 9.18182C1 7.01187 1.84285 4.93079 3.34315 3.3964C4.84344 1.86201 6.87827 1 9 1C11.1217 1 13.1566 1.86201 14.6569 3.3964C16.1571 4.93079 17 7.01187 17 9.18182Z" stroke="#0084FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M9 12.5C10.933 12.5 12.5 10.933 12.5 9C12.5 7.067 10.933 5.5 9 5.5C7.067 5.5 5.5 7.067 5.5 9C5.5 10.933 7.067 12.5 9 12.5Z" stroke="#0084FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <span style="margin-left: 12px;">Xin địa chỉ khách hàng</span>
                                </a>
                                <a class="d-flex align-items-center dropdown-item">
                                <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <rect width="21" height="21" fill="url(#pattern0)"></rect>
                                    <defs>
                                        <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                            <use xlink:href="#image0" transform="scale(0.03125)"></use>
                                        </pattern>
                                        <image id="image0" width="32" height="32" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAEG0lEQVRYCdWW/U9TVxjHyZZs+9H9uD9gyX5ZbGWiZjPhh4F1fb/lKnTl3lveGa0MqxO1KhJBtjlBo/5EMpOFuZDNl6AZOgMY5sucpshA6XgtS+k7bWnoC7Q8y9NxsNi63BpotpM8Pben5z7fz3nOOc/TrKz/c9u5U/+mRMkyEhW3X0JpN2V8LVIl+33zV2cf/3jlhklbXjcsodgvMwoho7huj8cbAQBYWlqCPQajSUpx6oxBYAQmJqedCIDN5fYEC4oqRjIGIFOx5x6ZBieW9WFxcRH21TfaMnYeJBTTeLunf4gABINB6Lj0U0CmYqszEgWMwL37j0YJgNfrha7rN8NSijm07gAUpXlHVVQ+hmHHFovFwGazQfu3HX6Jkv103QGkFNt+o/v2U7L6ubk5mJmZAcOB4w6pintvXQHkcu59Nacz49Ujzel0gtVqhd2aKrtCwW1IZTRNv7EmYLIC7mfTkyELEcd+YWEBXC43cGW1zxitfiiVFTKfjSp3lU5i9HALV2A2yVrahNKWCaGk2bJsU0Jx8+RzO3lVkNuwAV+QU8zH1fr6gUTxdJ6j0Sh03+ozK+iSp7kc91aWQHRkc472YkBybR6kXaG4iS6FYeuJ2LJF4YOqXqdAZDzY0NDwmoIuGZj+y+pORzTV3GONpx7KKFacJRAZc7fprviIOParAWKQY/jTni06fFFVWNaFuT+VQ75jeG4wX3x9+sIUb4Ate5958grqwz29/V6+QqnmYfjtdjuMj09AUXG1SyxWv80rAlv2DvtZfWvQ7/en8st7LBQKxa/qyIgZ6g83BeQ0p84oAMkVmC8GB4egtKLOlBbA7Ows79W+OJGEH8XRMAollYaRtABcLteLfnl9DwQC8TRNxDFhnT3fHt2lrjiWFgAeoHQb1goiTPqmljNLBYXl12mafj0tAHRAig9fkEgkkgTQd+cusGW1l+OZkE8eILcAAfAgpdPm5+eTAO703wMNW9P5SgBYcrH08mnhcHjV3uMCBp78AVW6Az4ZxX74SgDoxO12x/+E/hsEZjw8Mzif2K1fekFBa+0yJZcXF8cPvlugqfkmRBxh73A44ik1sSQTIIyQz+dbESbvTU1ZoFirn14RJwBbay57EmtB/neRhGKEtcDsylXsn/2h82qUOEvsEQavKBr+L0j8LfH54e+PoaxynykJILu4c3x7axS2ty0C9tuaSSX8p8diJNhhPFdUXP3bqdYL4V/vPgCLxfJSoURRfB4dG4Oevn6o1H0RVtIVHyUDaDrHn5ff1eI4nmMw2wU7jrZhOZZQzG6mtPYao91j0XA6Kx9jyz8fxWsnVrDZq8TjW5BnfFcoP23bXDcML7NsdYdjY/6RkqSX12pAkH80b+MnJ04KxU0tKU10vDSetdZK8L/k52/FhZPmis5B+AAAAABJRU5ErkJggg=="></image>
                                    </defs>
                                </svg>
                                <span>Gửi icon “Thích”</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="reply-button-action">
                        <div class="dropdown">
                            <span class="plus-icon" type="button">
                                <span data-tip="true" data-for="library_image_icon" currentitem="false">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-top: 4px; margin-left: 5px;">
                                    <path d="M19 17C19 17.5304 18.8104 18.0391 18.4728 18.4142C18.1352 18.7893 17.6774 19 17.2 19H2.8C2.32261 19 1.86477 18.7893 1.52721 18.4142C1.18964 18.0391 1 17.5304 1 17V3C1 2.46957 1.18964 1.96086 1.52721 1.58579C1.86477 1.21071 2.32261 1 2.8 1H7.3L9.1 4H17.2C17.6774 4 18.1352 4.21071 18.4728 4.58579C18.8104 4.96086 19 5.46957 19 6V17Z" stroke="#90949C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M10 7.66667V14.3333" stroke="#90949C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M7 11H13" stroke="#90949C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="reply-button-action">
                        <div class="dropdown">
                            <span class="plus-icon" type="button">
                                <span data-tip="true" data-for="image_icon" currentitem="false">
                                <svg class="reply-box-outside-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.22222 0.75H17.7778C18.5909 0.75 19.25 1.40914 19.25 2.22222V17.7778C19.25 18.5909 18.5909 19.25 17.7778 19.25H2.22222C1.40914 19.25 0.75 18.5909 0.75 17.7778V2.22222C0.75 1.40914 1.40914 0.75 2.22222 0.75Z" stroke="#90949C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M5.9875 8.42188C7.23014 8.42188 8.2375 7.41452 8.2375 6.17188C8.2375 4.92923 7.23014 3.92188 5.9875 3.92188C4.74486 3.92188 3.7375 4.92923 3.7375 6.17188C3.7375 7.41452 4.74486 8.42188 5.9875 8.42188Z" stroke="#90949C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M19.0625 15.6972L13.0778 9.4375L1.8 19.2" stroke="#90949C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                </span>
                            </span>
                        </div>
                        <input type="file" class="display-none" accept="*" multiple="">
                    </div>
                    <div class="reply-button-action quick-message-button-new dropdown">
                        <div class="abbbb">
                            <span type="button" id="btn-template-message" class="btn-template-message" data-toggle="tooltip dropdown" data-placement="top" data-tip="true" data-for="_quickmes_icon" data-delay="{&quot;show&quot;:&quot;200&quot;, &quot;hide&quot;:&quot;0&quot;}" currentitem="false" style="height: unset;">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="reply-box-outside-icon">
                                <path d="M4.44444 14.8056C4.24553 14.8056 4.05477 14.8846 3.91411 15.0252L0.75 18.1893V2.22222C0.75 1.83176 0.905109 1.4573 1.1812 1.1812C1.4573 0.905109 1.83176 0.75 2.22222 0.75H17.7778C18.1682 0.75 18.5427 0.905108 18.8188 1.1812C19.0949 1.4573 19.25 1.83176 19.25 2.22222V13.3333C19.25 13.7238 19.0949 14.0983 18.8188 14.3744C18.5427 14.6504 18.1682 14.8056 17.7778 14.8056H4.44444Z" stroke="#90949C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                    </div>
                    <div class="position-absolute message-template-instance-popup d-none">
                    <div id="quickMesTemplate" class="popup popup-template">
                        <div class="keybinding-header" style="padding-right: 12px;">
                            <div class="select-type-quick-mes d-flex align-items-center undefined" style="border-bottom: 1px solid rgb(196, 196, 196);"><span class="stqm-title">Chọn điều kiện tìm kiếm:</span><span class="active stqm-type-btn">Từ khóa và nội dung</span><span class=" stqm-type-btn">Từ khóa</span></div>
                        </div>
                        <div class="d-flex justify-content-between tooltip-content">
                            <div class="d-flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sun">
                                <circle cx="12" cy="12" r="5"></circle>
                                <line x1="12" y1="1" x2="12" y2="3"></line>
                                <line x1="12" y1="21" x2="12" y2="23"></line>
                                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                <line x1="1" y1="12" x2="3" y2="12"></line>
                                <line x1="21" y1="12" x2="23" y2="12"></line>
                                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                                </svg>
                                <div class="text">
                                Sử dụng phím điều hướng
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up">
                                    <line x1="12" y1="19" x2="12" y2="5"></line>
                                    <polyline points="5 12 12 5 19 12"></polyline>
                                </svg>
                                hoặc
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-down">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <polyline points="19 12 12 19 5 12"></polyline>
                                </svg>
                                để chọn và nhấn Enter để sử dụng
                                </div>
                            </div>
                            <svg class="close-svg" width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.7279 4.24255L4.24262 12.7278" stroke="#F6C037" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M4.24268 4.24255L12.728 12.7278" stroke="#F6C037" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                    </div>
                    </div>
                    </div>`;
$(function () {
    if (window.location.pathname === '/message-facebook') {
        $('.header-right-container').find('.main-menu-1 span').addClass('d-none');
        $('.header-right-container').find('#load-more').addClass('d-none');
        $('#icon-input-show-box-list-coversation-message').addClass('d-none');
        $('#nav-header-menu').addClass('d-none');
    }

    checkPageConnect();

    // selectPostConnect();
    // addLoading('message-facebook.get-page-selected', '.card-header');

    $('.show-list-page').click(function (e) {
        e.stopPropagation();
    });
    $('.empty-customer-address-v3').click(function () {
        $(this).addClass('d-none');
        $('#default-customer-address-component').removeClass('d-none');
    });

    // Đóng địa chỉ
    $('#unedit-customer-address-btn').click(function () {
        $('#default-customer-address-component').addClass('d-none');
        $('#wrapper-customer-address-component-v3 .empty-customer-address-v3').removeClass('d-none');
    });

    //  Hiện form ghi chú
    $('#customer-note-component .customer-note , #btn-cancel-note').click(function () {
        $('.body-create-or-edit-note-v3').hasClass('d-none') ? $('.body-create-or-edit-note-v3').removeClass('d-none') : $('.body-create-or-edit-note-v3').addClass('d-none');
    });

    // Hiện List hình ảnh
    $('.conversation-file-menu').click(function () {
        $('.conversation-file-content').hasClass('d-none') ? $('.conversation-file-content').removeClass('d-none') : $('.conversation-file-content').addClass('d-none')
    });

    // Hiển thị form đơn hàng
    $('.order-customer-overview').click(function () {
        $('#order-popup-wrapper').attr('style', 'display:block !important');
    });

    // Ràng buộc tự động active page đầu
    // $('.dashboard-facebook-header-option-list li:eq(0)').addClass('active');
    getPageMessage();

    /** Choose page connect **/
    $(document).on('click', '.dashboard-facebook-header-option-item', async function(){
        $(this).addClass('active').siblings().removeClass('active');
        if($(this).hasClass('active')){
            $(this).find('.dashboard-facebook-header-option-checkbox').prop('checked', true);
        } else {
            $(this).find('.dashboard-facebook-header-option-checkbox').prop('checked', false);
        }
    });



    $(document).on('click','.border-checkbox-label-member-facebook', function(){
        $(this).toggleClass('active');
        if($(this).hasClass('active')){
            $(this).parent().find('.border-checkbox-input-member-facebook').prop('checked', true);
        } else {
            $(this).parent().find('.border-checkbox-input-member-facebook').prop('checked', false);
        }
    });

    $('.show-checkbox-member-facebook-label').on('click', function(){
        $(this).toggleClass('active');
        if($(this).hasClass('active')){
            $('.border-checkbox-section-custom-hide').removeClass('d-none');
        } else {
            $('.border-checkbox-section-custom-hide').addClass('d-none');
        }
    });

    /** New code auth hoa **/
    $(document).on('click', '#show-all-booking-about', function (){
        $('#about-chat-facebook-right-bar').addClass('d-none');
        $('#list-booking-right-bar').removeClass('d-none');
        $('#dashboard-facebook-right-waiting-booking').html(dataListBookingWaiting);
        $('#dashboard-facebook-right-complete-booking').html(dataListBookingComplete);
        $('#dashboard-facebook-right-cancel-booking').html(dataListBookingCancel);
    });

    /** Sự kiện bấm vào 1 cuộc trò chuyện **/
    $(document).on('click', '.dashboard-facebook-conversation-filter-item', async function (){
        let conversation = $('.conversation-unread');
        $('.conversation-active').removeClass('conversation-active');
        conversation.removeClass('conversation-unread');
        if (parseInt(conversation.data('type-unread')) === 1) {
            $(this).addClass('conversation-unread');
        }
        let id = $(this).data('id');
        $(this).addClass('conversation-active');
        $(this).addClass('conversation-unread');
        $('.dashboard-facebook-body').removeClass('d-none');
        $('#about-chat-facebook-right-bar').removeClass('d-none');
        $('.dashboard-facebook-body-head-name').text($(this).find('.dashboard-facebook-conversation-filter-name-text').text());
        $('.dashboard-facebook-right-header-name span').text($(this).find('.dashboard-facebook-conversation-filter-name-text').text());
        $('.dashboard-facebook-body-head-left img').attr('src', $(this).find('.dashboard-facebook-conversation-filter-main-img').attr('src'));
        $('.dashboard-facebook-right-header-img').attr('src', $(this).find('.dashboard-facebook-conversation-filter-main-img').attr('src'));
        $('#data-message-visible-message-facebook').html('');
        clearDataBeforeClick();
        await bookingFacebookList();
        await getMessengerPage(id);
        await getOrderFacebookMessage();

    });
    /** Sự kiện bấm vào nút chọn trang **/
    $(document).on('click', '.dashboard-facebook-header-select', function(e){
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).parent().find('.dashboard-facebook-header-option').addClass('d-none');
        } else {
            e.stopPropagation();
            $(this).parent().find('.dashboard-facebook-header-option').removeClass('d-none');
            $(this).addClass('active');
        }
    });
    $(document).on('mouseup', function (e) {
        let container = $('.dashboard-facebook-header-option');
        if (!container.is(e.target) && container.has(e.target).length === 0 && !container.hasClass('d-none')) {
            container.addClass('d-none');
        } else {
            $('.dashboard-facebook-header-select').removeClass('active');
        }
    });
    /** Sự kiện bấm vào nút filter **/
    $(document).on('click','.dashboard-facebook-filter-action .ti-filter', function(e){
        console.log(123)
        if( $(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).parent().find('.dashboard-facebook-filter-action-list').addClass('d-none');
        } else {
            e.stopPropagation();
            $(this).parent().find('.dashboard-facebook-filter-action-list').removeClass('d-none');
            $(this).addClass('active');
        }
    });
    $(document).on('mouseup', function (e) {
        let container = $('.dashboard-facebook-filter-action-list');
        if (!container.is(e.target) && container.has(e.target).length === 0 && !container.hasClass('d-none')) {
            container.addClass('d-none');
        } else {
            $('.dashboard-facebook-filter-action .ti-filter').removeClass('active');
        }
    });

    /** Sự kiện bấm vào avartar messenger **/
    $(document).on('click', '.dashboard-facebook-header-select-setting', function(e){
        if( $(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).parent().find('.dashboard-facebook-header-select-setting-contain').addClass('d-none');
        } else {
            e.stopPropagation();
            $(this).parent().find('.dashboard-facebook-header-select-setting-contain').removeClass('d-none');
            $(this).addClass('active');
        }
    });
    $(document).on('mouseup', function (e) {
        let container = $('.dashboard-facebook-header-select-setting-contain');
        if (!container.is(e.target) && container.has(e.target).length === 0 && !container.hasClass('d-none')) {
            container.addClass('d-none');
        } else {
            $('.dashboard-facebook-header-select-setting').removeClass('active');
        }
    });
});

/**
 * Ràng buộc auto chọn mục đầu khi đổi tab TẤT CẢ/TIN NHẮN/BÌNH LUẬN
 */
async function dashboardFacebookConversationFilterListTab1(){
    $('#dashboard-facebook-conversation-filter-list-tab1 .dashboard-facebook-conversation-filter-item :eq(0)').click();
}

async function dashboardFacebookConversationFilterListTab2(){
    $('#dashboard-facebook-conversation-filter-list-tab2 .dashboard-facebook-conversation-filter-item :eq(0)').click();
}

async function dashboardFacebookConversationFilterListTab3(){
    $('#dashboard-facebook-conversation-filter-list-tab3 .dashboard-facebook-conversation-filter-item :eq(0)').click();
}

async function getPageMessage() {
    let method = 'get',
        url = 'message-facebook.page',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    console.log(res, "getPageMessage");
    $('#page-selected-message-facebook').html(res.data[0]);
    $('#list-page-message-facebook').html(res.data[1]);
    await getUserMessageFacebook();
}

function addAdress() {
    let address = $('#inputAddress').val(),
        district = $('#inputDistrict').val(),
        city = $('#inputState').val();
    $('#address_show').text(address + ', ' + district + ', ' + city);
    $('#close_collapsed').trigger('click');
    $('.profile-user').animate({scrollTop: 0});
}

async function getSenderPage() {
    let method = 'get',
        url = 'message-facebook.get-page-selected',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#avatar-fanpage').attr('src', res.data[0].avatar);
    $('#name-fanpage').text(res.data[0].name);
    $('#list-page-choose').html(res.data[1]);
}

async function getAllPageReturn() {
    let method = 'get',
        url = 'message-facebook.get-all-page-return',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#list-page-choose').html(res.data[0]);
}

/**
 * Loại bỏ
 */
async function getReturnSenders() {
    let method = 'get',
        url = 'message-facebook.get-sender-page',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#list-message').html(res.data[0]);
    $('.conversation-item:first-child').trigger('click');
}

// async function selectPostConnect(r) {
//     let id = '112921918140955';
//     let method = 'get',
//         url = 'message-facebook.get-post-page',
//         params = {id: id},
//         data = null;
//     let res = await axiosTemplate(method, url, params, data, [$('#data-message-visible-message-facebook')]);
//     $('#dashboard-facebook-conversation-filter-list-tab3').html(res['data'][0])
//     $('#dashboard-facebook-conversation-filter-list-tab1').append(res['data'][0])
// }

async function selectPostDetailConnect(){
    $('#data-message-visible-message-facebook').html('<div class="chat-body-message-post">\n' +
        '                                <div class="chat-body-message-post-header">\n' +
        '                                    <div class="chat-body-message-post-header-page px-3">\n' +
        '                                        <img\n' +
        '                                            src="https://scontent.fsgn8-1.fna.fbcdn.net/v/t1.6435-9/132045777_2022067027990823_365516879357302950_n.png?_nc_cat=1&amp;ccb=1-7&amp;_nc_sid=09cbfe&amp;_nc_ohc=4OT-FIOud54AX-393lh&amp;_nc_ht=scontent.fsgn8-1.fna&amp;oh=00_AT_-mZat3fEXQqhGLSjL8ZN0P5U8i1iw3NBwX3IPeNFvVA&amp;oe=62D797F3"\n' +
        '                                            alt="" class="customize-img">\n' +
        '                                        <div class="chat-body-message-post-header-detail-time">\n' +
        '                                            <h6>Bánh cuốn <span><i class="chat-body-message-post-header-detail-date">1 ngày .  </i><i class="fa fa-firefox" data-toggle="tooltip" data-placement="bottom" data-original-title="Công khai"></i></span></h6>\n' +
        '                                        </div>\n' +
        '\n' +
        '                                        <div class=" dropdown">\n' +
        '                                            <button\n' +
        '                                                class="chat-body-message-post-header-detail-setting btn dropdown-toggle"\n' +
        '                                                type="button"\n' +
        '                                                id="dropdownMenuButton" data-toggle="dropdown"\n' +
        '                                                aria-expanded="false">\n' +
        '                                                <i class="fa fa-ellipsis-h"></i>\n' +
        '                                            </button>\n' +
        '                                            <div class="dropdown-menu chat-body-message-custom-dropdown" aria-labelledby="dropdownMenuButton">\n' +
        '                                                <a class="dropdown-item" href="#"><i class="fa fa-commenting-o"></i>Ai có thể bình luận về bài viết của bạn?</a>\n' +
        '                                                <a class="dropdown-item" href="#"><i class="fa fa-pencil"></i>Chỉnh sửa bài viết</a>\n' +
        '                                                <a class="dropdown-item" href="#"><i class="fa fa-trash-o"></i>Xóa bài viết</a>\n' +
        '                                                <a class="dropdown-item" href="#"><i class="fa fa-bell-slash-o"></i>Tắt thông báo về bài viết này</a>\n' +
        '                                                <a class="dropdown-item" href="#"><i class="fa fa-wikipedia-w"></i>Tắt bản dịch</a>\n' +
        '                                                <a class="dropdown-item" href="#"><i class="fa fa-pencil-square-o"></i>Chỉnh sửa ngày</a>\n' +
        '                                            </div>\n' +
        '                                        </div>\n' +
        '                                    </div>\n' +
        '                                    <div class="chat-body-message-post-header-content px-3">\n' +
        '                                        <p class="chat-body-message-">Bánh cuốn trôi tất cả mọi thứ</p>\n' +
        '                                    </div>\n' +
        '                                    <div class="chat-body-message-post-header-page-interactive px-3">\n' +
        '                                        <div class="chat-body-message-post-header-page-interactive-reaction">\n' +
        '                                            <i class="fa fa-thumbs-up" data-toggle="tooltip" data-placement="bottom" data-original-title="Bánh cuốn"></i>\n' +
        '                                            <i class="fa fa-heart-o" data-toggle="tooltip" data-placement="bottom" data-original-title="Nguyễn Phạm Hùng Phi"></i>\n' +
        '                                            <a href="#" data-toggle="tooltip" data-placement="bottom" data-original-title="Nguyễn Phạm Hùng Phi">Bạn và 1 người khác</a>\n' +
        '                                        </div>\n' +
        '                                        <div class="chat-body-message-post-header-page-interactive-comment">\n' +
        '                                            <a href="#" data-toggle="tooltip" data-placement="bottom" data-original-title="Bánh cuốn">7 bình luận</a>\n' +
        '                                        </div>\n' +
        '                                    </div>\n' +
        '                                    <div class="chat-body-message-post-header-page-action mx-3">\n' +
        '                                        <div class="row px-3">\n' +
        '                                            <button class="chat-body-message-post-header-page-action-button col-3"><i\n' +
        '                                                    class="fa fa-thumbs-up"></i> Thích\n' +
        '                                            </button>\n' +
        '                                            <button class="chat-body-message-post-header-page-action-button col-3"><i\n' +
        '                                                    class="fa fa-comment"></i> Bình luận\n' +
        '                                            </button>\n' +
        '                                            <button class="chat-body-message-post-header-page-action-button col-3"><i\n' +
        '                                                    class="fa fa-share"></i> Chia sẻ\n' +
        '                                            </button>\n' +
        '                                            <div class="dropdown col-1">\n' +
        '                                                <button class="btn dropdown-toggle" type="button"\n' +
        '                                                        id="dropdownMenuButton" data-toggle="dropdown"\n' +
        '                                                        aria-expanded="false">\n' +
        '                                                    <img src="https://scontent.fsgn8-1.fna.fbcdn.net/v/t1.6435-9/132045777_2022067027990823_365516879357302950_n.png?_nc_cat=1&amp;ccb=1-7&amp;_nc_sid=09cbfe&amp;_nc_ohc=4OT-FIOud54AX-393lh&amp;_nc_ht=scontent.fsgn8-1.fna&amp;oh=00_AT_-mZat3fEXQqhGLSjL8ZN0P5U8i1iw3NBwX3IPeNFvVA&amp;oe=62D797F3" alt="">\n' +
        '                                                </button>\n' +
        '                                                <div class="dropdown-menu chat-body-message-login-dropdown" aria-labelledby="dropdownMenuButton">\n' +
        '                                                    <h4 class="px-2">Chọn cách tương tác</h4>\n' +
        '                                                    <p class="px-2">Bạn có thể tương tác dưới tên trang cá nhân hoặc Trang mình quản lý</p>\n' +
        '                                                    <a class="dropdown-item" href="#"><img src="https://scontent.fsgn8-1.fna.fbcdn.net/v/t1.6435-9/132045777_2022067027990823_365516879357302950_n.png?_nc_cat=1&amp;ccb=1-7&amp;_nc_sid=09cbfe&amp;_nc_ohc=4OT-FIOud54AX-393lh&amp;_nc_ht=scontent.fsgn8-1.fna&amp;oh=00_AT_-mZat3fEXQqhGLSjL8ZN0P5U8i1iw3NBwX3IPeNFvVA&amp;oe=62D797F3" alt=""> Bánh cuốn</a>\n' +
        '                                                    <a class="dropdown-item" href="#"><img src="https://scontent.fsgn8-1.fna.fbcdn.net/v/t1.6435-9/132045777_2022067027990823_365516879357302950_n.png?_nc_cat=1&amp;ccb=1-7&amp;_nc_sid=09cbfe&amp;_nc_ohc=4OT-FIOud54AX-393lh&amp;_nc_ht=scontent.fsgn8-1.fna&amp;oh=00_AT_-mZat3fEXQqhGLSjL8ZN0P5U8i1iw3NBwX3IPeNFvVA&amp;oe=62D797F3" alt=""> Trang nè</a>\n' +
        '                                                </div>\n' +
        '                                            </div>\n' +
        '                                        </div>\n' +
        '                                    </div>\n' +
        '                                </div>\n' +
        '                                <div class="chat-body-message-post-main-comment">\n' +
        '                                    <div class="chat-body-message-post-main-comment-suitable">\n' +
        '                                        <div class=" dropdown">\n' +
        '                                            <button\n' +
        '                                                class="btn dropdown-toggle"\n' +
        '                                                type="button"\n' +
        '                                                id="dropdownMenuButton" data-toggle="dropdown"\n' +
        '                                                aria-expanded="false">\n' +
        '                                                Phù hợp nhất\n' +
        '                                            </button>\n' +
        '                                            <div class="dropdown-menu chat-body-message-post-main-comment-filter" aria-labelledby="dropdownMenuButton">\n' +
        '                                                <div class="chat-body-message-post-main-comment-dropdown">\n' +
        '                                                    <h4>Phù hợp nhất</h4>\n' +
        '                                                    <p>Hiển thị bình luận của bạn bè và những bình luận có nhiều tương tác nhất trước tiên.</p>\n' +
        '                                                </div>\n' +
        '                                                <div class="chat-body-message-post-main-comment-dropdown">\n' +
        '                                                    <h4>Trang này đã ẩn</h4>\n' +
        '                                                    <p>Hiển thị bình luận đã ẩn của bạn trong ngữ cảnh gốc của bài viết. Chỉ những người quản lý Trang mới nhìn thấy nội dung này.</p>\n' +
        '                                                </div>\n' +
        '                                                <div class="chat-body-message-post-main-comment-dropdown">\n' +
        '                                                    <h4>Mới nhất</h4>\n' +
        '                                                    <p>Hienr thị các bình luận mới nhất trước tiên. Một số bình luận đã được lọc ra.</p>\n' +
        '                                                </div>\n' +
        '                                                <div class="chat-body-message-post-main-comment-dropdown">\n' +
        '                                                    <h4>Tất cả bình luận</h4>\n' +
        '                                                    <p>Hiển thị tất cả bình luận, bao gồm cả nội dung có thể là spam. Những bình luận phù hợp nhất sẽ hiển thị đầu tiên.</p>\n' +
        '                                                </div>\n' +
        '                                            </div>\n' +
        '                                        </div>\n' +
        '                                    </div>\n' +
        '                                    <div class="chat-body-message-post-main-input d-flex">\n' +
        '                                        <img src="https://scontent.fsgn8-1.fna.fbcdn.net/v/t1.6435-9/132045777_2022067027990823_365516879357302950_n.png?_nc_cat=1&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=4OT-FIOud54AX-393lh&_nc_ht=scontent.fsgn8-1.fna&oh=00_AT_-mZat3fEXQqhGLSjL8ZN0P5U8i1iw3NBwX3IPeNFvVA&oe=62D797F3" alt="">\n' +
        '                                        <div class="chat-body-message-form-controll-comment d-flex">\n' +
        '                                            <div contenteditable="" class="comment-facebook-textarea" rows="1" id="message-facebook" placeholder="Bình luận với vai trò Bánh Cuốn" style="overflow-y:auto;">\n' +
        '                                            </div>\n' +
        '                                            <div class="chat-body-message-post-main-input-emoji">\n' +
        '                                                <i class="fa fa-smile-o" data-toggle="tooltip" data-placement="bottom" data-original-title="Chèn một biểu tượng cảm xúc"></i>\n' +
        '                                                <i class="fa fa-camera" data-toggle="tooltip" data-placement="bottom" data-original-title="Đính kèm một ảnh hoặc video"></i>\n' +
        '                                                <i class="fa fa-file" data-toggle="tooltip" data-placement="bottom" data-original-title="Bình luận bằng file GIF"></i>\n' +
        '                                                <i class="fa fa-sticky-note" data-toggle="tooltip" data-placement="bottom" data-original-title="Bình luận bằng nhãn dán"></i>\n' +
        '                                            </div>\n' +
        '                                        </div>\n' +
        '                                    </div>\n' +
        '                                    <div class="chat-body-message-comment-user px-3 pt-3 d-flex">\n' +
        '                                        <img src="https://scontent.fsgn8-1.fna.fbcdn.net/v/t1.6435-9/132045777_2022067027990823_365516879357302950_n.png?_nc_cat=1&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=4OT-FIOud54AX-393lh&_nc_ht=scontent.fsgn8-1.fna&oh=00_AT_-mZat3fEXQqhGLSjL8ZN0P5U8i1iw3NBwX3IPeNFvVA&oe=62D797F3" alt="">\n' +
        '                                        <div>\n' +
        '                                            <div class="chat-body-message-comment-detail">\n' +
        '                                                <p class="chat-body-message-comment-detail-name-user"><i class="fa fa-paperclip"></i> Tác giả</p>\n' +
        '                                                <p class="chat-body-message-comment-detail-name-page">Bánh cuốn</p>\n' +
        '                                                <p class="chat-body-message-comment-detail-content">Ngày nắng cớ sao lại đêm dài</p>\n' +
        '                                            </div>\n' +
        '                                            <div class="d-flex chat-body-message-comment-control-action">\n' +
        '                                                <p>Thích</p>\n' +
        '                                                <p>Phản hồi</p>\n' +
        '                                                <p data-toggle="tooltip" data-placement="bottom" data-original-title="Thứ bảy, 29 Tháng 4, 2002 lúc 15:25">1 ngày</p>\n' +
        '                                            </div>\n' +
        '                                        </div>\n' +
        '                                    </div>\n' +
        '                                    <div class="chat-body-message-comment-user px-3 pt-3 d-flex">\n' +
        '                                        <img src="https://scontent.fsgn8-1.fna.fbcdn.net/v/t1.6435-9/132045777_2022067027990823_365516879357302950_n.png?_nc_cat=1&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=4OT-FIOud54AX-393lh&_nc_ht=scontent.fsgn8-1.fna&oh=00_AT_-mZat3fEXQqhGLSjL8ZN0P5U8i1iw3NBwX3IPeNFvVA&oe=62D797F3" alt="">\n' +
        '                                        <div>\n' +
        '                                            <div class="chat-body-message-comment-detail">\n' +
        '                                                <p class="chat-body-message-comment-detail-name-page">Nguyễn Phạm Hùng Phi</p>\n' +
        '                                                <p class="chat-body-message-comment-detail-content">Tôi không có người yêu bởi vì tôi thích con trai</p>\n' +
        '                                            </div>\n' +
        '                                            <div class="d-flex chat-body-message-comment-control-action">\n' +
        '                                                <p>Thích</p>\n' +
        '                                                <p>Phản hồi</p>\n' +
        '                                                <p class="chat-body-message-comment-btn-rep">Send message</p>\n' +
        '                                                <p data-toggle="tooltip" data-placement="bottom" data-original-title="Thứ năm, 4 Tháng 11, 2002 lúc 17:25">2 ngày</p>\n' +
        '                                            </div>\n' +
        '                                        </div>\n' +
        '                                    </div>\n' +
        '                                    <h4 class="chat-body-message-comment-title-show-more px-3 pt-2">Xem thêm 5 bình luận</h4>\n' +
        '                                </div>\n' +
        '\n' +
        '                            </div>');
}

async function selectPageConnect(id) {
    let method = 'get',
        url = 'facebook.auth.select-page',
        params = {id: id},
        data = null;
    await axiosTemplate(method, url, params, data);
    window.location.href = "/message-facebook";
}

async function sendMessage() {
    $('.message-list-viewer').append(`<div class="dialogue-message" id="dialogue-message-page">
                                        <div role="presentation" class="clear-fix d-flex">
                                            <div class="d-block dialogue-line-content me">
                                                <div class="d-flex float-right">
                                                    <div class="content">
                                                        <div class="clear-fix content-item content-text message" data-tip="true" data-for="_info_message_60f32bf76d4c42000173acbd" currentitem="false" style="float: right; opacity: 1;">
                                                            <div>
                                                                <span class="dialogue-text-content">${$('#reply-messager').val()}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`);
    let id = id_user_from;
    let method = 'post',
        url = 'message-facebook.send-message',
        params = {
            id: id,
            message: $('#reply-messager').val(),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#reply-messager').val('');
}

async function typingOn() {
    let id = id_user_from;
    let method = 'post',
        url = 'message-facebook.typing-on',
        params = {
            id: id,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
}

function listen(){
    axios.interceptors.request.use((config) => {
        if(config.url.charAt(0) === 'webhooks'){
            console.log(11111);
            console.log(config);
        }
    }, (error) => {
        return Promise.reject(error);
    });

    axios.interceptors.response.use((response) => {
        return response;
    }, (error) => {
        // trigger 'loading=false' event here
        return Promise.reject(error);
    });
};

/** Function booking auth Truong Viet Hoa **/
async function bookingFacebookList() {
    let method = 'get',
        url = 'message-facebook.booking',
        params = {
            branch: $('#change_branch').val(),
            phone: $('#phone-number-customer-label').text()
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    console.log(res,8785646)
    dataListBookingWaiting = res.data[0];
    dataListBookingComplete = res.data[1];
    dataListBookingCancel = res.data[2];
    $('.facebook-booking-list').html(res.data[1]);
}


async function getMessengerPage(id) {
    console.log(dataMessageFacebook, id)
    dataMessageFacebook.map((items) => {
        if(items.id == id){
            console.log(items['messages'],123)
            items.messages['data'].map((item) => {
                console.log(item,456);
                if(item['from']['id'] == $('#dashboard-facebook-header-detail-span').data('id')){
                    $('#data-message-visible-message-facebook').append(`<div class="chat-body-message-element message-right">
                                                                                          <div class="chat-body-message">
                                                                                              <div class="chat-body-message-text">${item['message']}</div>
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
                                                                                                  <div class="chat-body-message-status-send d-none">
                                                                                                      <i class="chat-body-message-sending-icon fa fa-check-circle-o"></i>
                                                                                                      <i class="chat-body-message-send-icon fa fa-check-circle d-none"></i>
                                                                                                  </div>
                                                                                                  <div class="reacts-list-content">
                                                                                                      <div class="reacts-list d-none">
                                                                                                          <div class="react-icon-list" data-love="0" data-smile="0" data-like="0" data-angry="0" data-sad="0" data-wow="0"></div>
                                                                                                          <div class="total-reacts">0</div>
                                                                                                      </div>
                                                                                                  </div>
                                                                                                  <span class="time-message-ago">${moment(item['created_time']).format("DD/MM/YYYY")}</span>
                                                                                              </div>
                                                                                          </div>
                                                                                      </div>`);
                    console.log(item['message'],789);
                } else {
                    $('#data-message-visible-message-facebook').append(`<div class="chat-body-message-element message-left">
                                                                                          <div class="chat-body-message">
                                                                                              <div class="chat-body-message-text">${item['message']}</div>
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
                                                                                                  <div class="chat-body-message-status-send d-none">
                                                                                                      <i class="chat-body-message-sending-icon fa fa-check-circle-o"></i>
                                                                                                      <i class="chat-body-message-send-icon fa fa-check-circle d-none"></i>
                                                                                                  </div>
                                                                                                  <div class="reacts-list-content">
                                                                                                      <div class="reacts-list d-none">
                                                                                                          <div class="react-icon-list" data-love="0" data-smile="0" data-like="0" data-angry="0" data-sad="0" data-wow="0"></div>
                                                                                                          <div class="total-reacts">0</div>
                                                                                                      </div>
                                                                                                  </div>
                                                                                                  <span class="time-message-ago">${moment(item['created_time']).format("DD/MM/YYYY")}</span>
                                                                                              </div>
                                                                                          </div>
                                                                                      </div>`);
                    console.log(item['message'],78910);
                }
            });
        }
    });
}

async function getUserMessageFacebook() {
    let method = 'get',
        id = $('.dashboard-facebook-header-option-list').find('.dashboard-facebook-header-option-item.active').data('id'),
        url = 'message-facebook.user',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#dashboard-facebook-conversation-filter-list-tab1').html(res.data[0]);
    $('#dashboard-facebook-conversation-filter-list-tab2').html(res.data[0]);
    dataMessageFacebook = res.data[2]['data'];
}

async function connectOnePage() {
    $('#dashboard-facebook-conversation-filter-list-tab1').html('');
    let idPage = $('.dashboard-facebook-header-option-item.active').data('id');
    let method = 'post',
        url = 'config-facebook.select-one-page',
        params = {
            id: idPage
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('.dashboard-facebook-header-select-info')]);
    $('#dashboard-facebook-header-detail-image').attr('src', res.data['picture']['data']['url']);
    $('#dashboard-facebook-header-detail-span').text(res.data['name']);
    $('.dashboard-facebook-header-select').removeClass('active');
    $('.dashboard-facebook-header-option').addClass('d-none');
    await getUserMessageFacebook();
}

function checkPageConnect() {
    let idSelect = $('#dashboard-facebook-header-detail-span').data('id');
    $('.dashboard-facebook-header-option-item').each(function(){
        if($(this).data('id') == idSelect){
            $(this).addClass('active');
            $(this).find('.dashboard-facebook-header-option-checkbox').prop('checked', true);
        } else {
            $(this).removeClass('active');
            $(this).find('.dashboard-facebook-header-option-checkbox').prop('checked', false);
        }
    });
}

function clearDataBeforeClick() {
    $('#about-chat-facebook-right-bar').removeClass('d-none');
    $('#list-booking-right-bar').addClass('d-none');
}

function closeListBookingRightBar() {
    $('#about-chat-facebook-right-bar').removeClass('d-none');
    $('#list-booking-right-bar').addClass('d-none');
}

$.ajax({
    url: 'https://developer.techres.vn/webhooks',
    type: 'GET',
    success: function(response) {
        console.log(response, 98989342259);
    }
});
