    <style>
    #btn-mic-search-header {
        position: relative;
        cursor: pointer;
    }

    #btn-mic-search-header:hover {
        background: rgba(0, 0, 0, 0.3) none repeat scroll 0 0;
    }

    #btn-mic-search-header:focus {
        outline: none;
    }

    .pulse-ring {
        content: '';
        width: 27px;
        height: 27px;
        background: rgba(0, 0, 0, 0.3) none repeat scroll 0 0;
        border: 1px solid #189BFF;
        border-radius: 50%;
        position: absolute;
        top: -6px;
        left: 0px;
        animation: pulsate infinite 1.5s;
    }

    .pulse-ring.delay {
        animation-delay: 1s;
    }

    @-webkit-keyframes pulsate {
        0% {
            -webkit-transform: scale(1, 1);
            opacity: 1;
        }
        100% {
            -webkit-transform: scale(1.3, 1.3);
            opacity: 0;
        }
    }

    #select-branch-setting .select2-container--open{
        border-top-left-radius: 8px !important;
        border-top-right-radius: 8px !important;
        border-bottom-left-radius: 0px !important;
        border-bottom-right-radius: 0px !important;
        background: none;
    }
    #select-branch-setting .select2-container{
        border-top-left-radius: 8px !important;
        border-top-right-radius: 8px !important;
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
        border-color: #0072bc !important;
    }

    #select-branch-setting .select2-selection{
        padding: 4px 0 4px 5px !important;
        height: auto !important;

    }

    #select-branch-setting .select2-selection__arrow{
        top : 4px !important;
        color: #fff;
        display: none;
    }
    #select-branch-setting .select2-search__field{
        line-height: revert !important;
        min-height: 2.1rem !important;
    }
    #select-branch-setting .select2-selection__rendered{
        line-height: revert !important;
        /*min-height: 2.1rem !important;*/
        color: #fff;
        font-size: 13px !important;
    }

    #select-branch-setting .select2-container--default .select2-selection--single .select2-selection__arrow b{
        border-color: #fff transparent transparent transparent;
    }
    #select-branch-setting .select2-container--default .select2-dropdown{
        border: none !important;
        border-radius: -1px !important;
    }

    #select-branch-setting .select2-container--open::after {
        border-bottom: 10px solid #fff;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        bottom: -2px;
        content: "";
        left: 13%;
        position: absolute;
        transform: translate(-50%);
        z-index: 9;
        transition: all .2s linear;
    }

    #select-branch-setting .select2-container--default .select2-dropdown{
        min-width: 200px !important;
    }

</style>
<div id="new_header">
    <div class="theme-layout">
        <div class="topbar stick">
            <div class="logo">
                <a href="/"><img src="{{asset('images/tms/logo_header2.png')}}" alt=""
                                 onerror="this.onerror=null;this.src='images/tms/default.jpeg'"></a>
                <a class="logo-reponsive" href="/"><img src="{{asset('images/tms/logo.png', env('IS_DEPLOY_ON_SERVER'))}}" alt=""
                                                        onerror="this.onerror=null;this.src='images/tms/default.jpeg'"></a>
            </div>
            <div class="top-area">

                <div class="top-search ">
                    <form method="post" class="mb-0">
                        <input type="text" placeholder="Tìm kiếm chức năng" id="input-search-header" autocomplete="off">
                        <button id="btn-mic-search-header" data-ripple>
                            <div class="pulse-ring d-none"></div>
                            <i class="icofont icofont-mic"></i>
                            <i class="icofont icofont-mic-mute d-none" data-toggle="tooltip" data-placement="bottom"
                               data-original-title="Cho phép micro để sử dụng tính năng này"></i>
                        </button>
                                                <button data-ripple><i class="ti-search"></i></button>
                    </form>
                    @include('layouts.header_search')
                </div>
                <div class="page-name">
                    <span data-toggle="tooltip" data-placement="right"
                          data-original-title="<?php echo $active_nav ?>"><?php echo $active_nav ?></span>
                </div>
                <ul class="setting-area d-flex align-items-center">
                    <li class="menu-bars-header">
                        <a href="javascript:void(0)" title="Menu" data-ripple=""><em
                                class="fa fa-bars"></em></a>
                    </li>
                    <li><a href="/" title="Home" data-ripple=""><em class="fa fa-home"></em></a></li>
                    <li id="header-notify-hidden">
                        <a class="has-active" href="javascript:void(0)" title="Notification" data-ripple="">
                            <em class="fa fa-bell"></em><em class="em bg-purple d-none"
                                                            id="count-notify-not-seen-header">0</em>
                        </a>
                        <div class="dropdowns message-header-list">
                            <span>Thông báo</span>
                            {{--                    <li>--}}
                            {{--                        <a href="javascript:void(0)">--}}
                            {{--                            <figure>--}}
                            {{--                                <img src="{{asset('images/tms/default.jpeg')}}" alt="">--}}
                            {{--                                <span class="status f-online"></span>--}}
                            {{--                            </figure>--}}
                            {{--                            <div class="mesg-meta">--}}
                            {{--                                <h6>sarah Loren</h6>--}}
                            {{--                                <span>commented on your new profile status</span>--}}
                            {{--                                <i>2 min ago</i>--}}
                            {{--                            </div>--}}
                            {{--                        </a>--}}
                            {{--                    </li>--}}
                            <ul class="message-header-list-body" id="list-notify-header"></ul>
                            <a href="javascript:void(0)" class="more-mesg" onclick="location.href='notify-view';">Xem
                                tất cả</a>
                        </div>
                    </li>
                    @if(Session::get(SESSION_KEY_LEVEL) > 3)
                    <li id="icon-input-show-box-list-coversation-message" >
                        <div class="box-load-not-connect d-none">
                            <div class="loader-not-connect">
                                <div class="spin"></div>
                            </div>
                        </div>
                        <a class="link-input-show-box-list-coversation-message has-active" href="javascript:void(0)"
                           title="Messages" data-ripple=""><em
                                class="fa fa-commenting"></em><em
                                class="em bg-blue d-none new-notify-unread-message">0</em></a>
                        <div class="dropdowns message-header-list">
                            <div class="message-header-list-head">
                                <nav class="navbar-expand-lg">
                                    <div class="navbar-collapse">
                                        <ul class="navbar-nav-popup">
                                            <div class="left-tool-popup">
                                                <nav class="nav nav-tabs md-tabs" role="tablist">
                                                    <a data-toggle="tab" href="#message-header-list-body-restaurant"
                                                       role="tab" aria-expanded="false"
                                                       class="remove-draw-table filter-left-popup title-filter-all active-mess-popup active"
                                                       data-id="0">Nội bộ
                                                        <div id="set-number-count-message-not-seen-restaurant"
                                                             class="d-none" style="display: flex"> (<p
                                                                id="number-count-message-not-seen-restaurant" class="">
                                                                0</p>)
                                                        </div>
                                                    </a>
                                                    <a data-toggle="tab" href="#message-header-list-body-supplier"
                                                       role="tab" aria-expanded="false"
                                                       class="remove-draw-table filter-left-popup title-filter-not-read"
                                                       data-id="1">Nhà Cung Cấp
                                                        <div id="set-number-count-message-not-seen-supplier"
                                                             class="d-none" style="display: flex"> (<p
                                                                id="number-count-message-not-seen-supplier" class="">
                                                                0</p>)
                                                        </div>
                                                    </a>
                                                    <a data-toggle="tab" href="#message-header-list-body-admin"
                                                       role="tab" aria-expanded="false"
                                                       class="remove-draw-table filter-left-popup title-filter-not-read"
                                                       data-id="1">Hệ thống
                                                        <div id="set-number-count-message-not-seen-admin" class="d-none"
                                                             style="display: flex"> (<p
                                                                id="number-count-message-not-seen-admin" class="">0</p>)
                                                        </div>
                                                    </a>
                                                </nav>
                                            </div>
                                        </ul>
                                    </div>
                                </nav>
                                <div class="setting-notification-new-message active"
                                     id="setting-notification-new-message">
                                    <i
                                        class="fa fa-bell"
                                        id="on-setting-notification-new-message"
                                        style="font-size: 15px !important;"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-original-title="Tắt thông báo"
                                        aria-hidden="true"
                                    ></i>
                                    <i
                                        class="fa fa-bell-slash d-none"
                                        id="off-setting-notification-new-message"
                                        style="font-size: 15px !important;"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-original-title="Bật lại thông báo"
                                        aria-hidden="true"
                                    ></i>
                                </div>
                            </div>
                            <div class="tab-content mt-0">
                                <ul class="message-header-list-body tab-pane active"
                                    id="message-header-list-body-restaurant" role="tabpanel"></ul>
                                <ul class="message-header-list-body tab-pane" id="message-header-list-body-supplier"
                                    role="tabpanel"></ul>
                                <ul class="message-header-list-body tab-pane" id="message-header-list-body-admin"
                                    role="tabpanel">
                                    <img src="/images/tms/tuvan.png" alt="">
                                    <li class="btn-connect-admin">
                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block">Kết nối
                                            với quản trị viên</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="message-header-list-footer">
                                <a href="{{route('message.visible-message.index')}}"
                                   class="message-header-list-footer-view-all">Xem tất cả</a>
                            </div>
                        </div>
                    </li>
                    @endif
                    <li>
                        <a href="{{route('help.help.index')}}" title="Help" data-ripple=""><em
                                class="fa fa-question-circle"></em></a>
                    </li>
{{--                    <li class="restaurant-name" style="color:#fff">--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <img class="brand-select-img" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="{{ Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . Session::get(SESSION_KEY_DATA_RESTAURANT)['logo'] }}" alt="">--}}
{{--                            <div style="--}}
{{--                            font-size: 12px;--}}
{{--                            font-weight: 400;--}}
{{--                            margin-left: 5px !important;">--}}
{{--                                <p class="ml-1" style="--}}
{{--                            max-width: 76px;--}}
{{--                            overflow: hidden;--}}
{{--                            text-overflow: ellipsis;--}}
{{--                            font-size: 12px !important;">{{ Session::get(SESSION_KEY_DATA_RESTAURANT)['name'] }}</p>--}}
{{--                                <p style=" color: #f9a236;" class="package-name-restaurant">--}}
{{--                                    @if(Session::get(SESSION_KEY_DATA_SETTING)['service_restaurant_level_id'] > 0)--}}
{{--                                        <span style="font-size: 10px !important;">Gói Quản Trị ( Level {{ Session::get(SESSION_KEY_DATA_SETTING)['service_restaurant_level_id'] }} )</span>--}}
{{--                                    @else--}}
{{--                                        <span style="font-size: 10px !important;">Gói Quản Trị ( Level 9 )</span>--}}
{{--                                    @endif--}}
{{--                                </p>--}}

{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </li>--}}
{{--                    @if(Session::get(SESSION_KEY_LEVEL) > 3)--}}
{{--                       --}}
{{--                    @else--}}
{{--                        <li class="brand-container d-none" id="select-brand-setting">--}}
{{--                            <a class="brand-select has-active" href="javascript:void(0)" data-ripple="" id="restaurant-branch-id-selected">--}}
{{--                                <span class="d-none" data-value="-1"></span>--}}
{{--                                <img class="brand-select-img" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="/images/tms/default.jpeg" alt=""><span class="brand-select-name"></span></a>--}}
{{--                            <div class="dropdowns brand">--}}
{{--                                <ul class="dropdown-meganav-select-list dropdown-meganav-select-list-brand"> <?php echo $listBrand ?></ul>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li class="brand-container d-none" id="select-branch-setting">--}}
{{--                            <a class="brand-select has-active" href="javascript:void(0)" data-ripple=""><input class="d-none" id="change_branch" value="-1">--}}
{{--                                <img class="brand-select-img" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="/images/tms/default.jpeg" alt=""><span class="brand-select-name"></span></a>--}}
{{--                            <div class="dropdowns brand">--}}
{{--                                <ul class="dropdown-meganav-select-list dropdown-meganav-select-list-branch"> <?php echo $listBranch ?></ul>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    @endif--}}
                    <li class="brand-container" id="select-brand-setting">
                        <?php echo $brandView ?>
                        <div class="dropdowns brand">
                            <ul class="dropdown-meganav-select-list dropdown-meganav-select-list-brand">
                                <li class="mb-1 py-2 pl-1 col-form-label-fz-15 f-w-600" style="border-bottom: 1px solid #ccc">Thương Hiệu</li>
                                <?php echo $listBrand ?>
                                <?php echo $listBrandIsOffice ?>
                            </ul>
                        </div>
                    </li>
{{--                    <li class="brand-container" id="select-branch-setting">--}}
{{--                        <?php echo $branchView ?>--}}
{{--                        <div class="dropdowns brand">--}}
{{--                            <ul class="dropdown-meganav-select-list dropdown-meganav-select-list-branch"> <?php echo $listBranch ?></ul>--}}
{{--                        </div>--}}
{{--                    </li>--}}
                    <li class="brand-container" id="select-branch-setting">
{{--                        <?php echo $branchView ?>--}}
{{--                        <div class="dropdowns brand">--}}
{{--                            --}}
{{--                        </div>--}}
                        <select class="brand-container d-none js-example-basic-single" id="change_branch">
                            <?php echo $listBranch ?>
                        </select>
                    </li>
                </ul>
                <div class="header-right-container">
{{--                    <div class="main-menu-1">--}}
{{--                        <span>--}}
{{--                            <em class="fa fa-braille menu-active"></em>--}}
{{--                        </span>--}}
{{--                    </div>--}}
                    <div class="user-img-1">
                        <div class="info-user">
                            <div class="info-user-name">{{ Session::get(SESSION_JAVA_ACCOUNT)['name'] }}</div>
                            <div class="info-user-role">{{ Session::get(SESSION_JAVA_ACCOUNT)['employee_role_name'] }}</div>
                        </div>
                        <img onerror="this.src='/images/tms/default.jpeg'"
                             src="{{ Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA). Session::get(SESSION_JAVA_ACCOUNT)['avatar'] }}"
                             alt="">
                        <div class="user-setting">
                            <ul class="log-out">
                                <li onclick="location.href='profile';"><a href="javascript:void(0)"><em
                                            class="ti-user"></em> Thông tin</a></li>
                                <li onclick="logoutFunction()"><a href="javascript:void(0)"><em
                                            class="ti-power-off"></em> @lang('modules.menu.logout')</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mx-2">
                        <a href="/upgrade-package" style="color: #fff" data-toggle="tooltip" data-placement="bottom"
                           data-original-title="Nâng cấp gói"><em
                                class="icofont icofont-brand-designbump" style="font-size: 24px"></em></a>
                    </div>
                    <span class="main-menu-1 selector-toggle-li" data-ripple="">
                        <em class="fa fa-clock-o" style="font-size: 21px!important"></em>
                    </span>
                    <button id="load-more" onclick="loadData()" data-toggle="tooltip" data-placement="bottom"
                            data-original-title="Tải lại">
                        <em class="icofont icofont-refresh"></em>
                    </button>
                </div>
            </div>
            @if(Session::get(SESSION_KEY_LEVEL) > 3)
                @include('layouts.nav_level_admin')
            @else
                @include('layouts.nav_sale_solution')
            @endif
        </div>
    </div>
    <div id="permission-session" data="{{ json_encode(Session::get(SESSION_PERMISSION), true) }}" class="d-none"></div>
</div>
@push('scripts')
    <script src="{{asset('js/layout/notify.js')}}"></script>
    <script>
        $(function () {
            startSearch()
            navigator.permissions.query({name: 'microphone'}).then(function (result) {
                if (result.state == 'denied') {
                    // await navigator.mediaDevices.getUserMedia({audio: true})
                    $('#btn-mic-search-header .icofont.icofont-mic-mute').removeClass('d-none')
                    $('#btn-mic-search-header .icofont.icofont-mic').addClass('d-none')
                }
            });

            /**
             * Kiểm tra cookie và lưu lại trạng thái setting thông báo tin nhắn sau lần đầu load trang
             */
            let currentCookieSettingNotificationChat = $.cookie('settingNotificationChat');
            $('#setting-notification-new-message').removeClass('active');
            $('#setting-notification-new-message').addClass(currentCookieSettingNotificationChat);
            if (currentCookieSettingNotificationChat == 'active') {
                $('#on-setting-notification-new-message').removeClass('d-none')
                $('#off-setting-notification-new-message').addClass('d-none')
            } else {
                $('#on-setting-notification-new-message').addClass('d-none')
                $('#off-setting-notification-new-message').removeClass('d-none')
            }

            // $('.nav-list').slideToggle(0);
            $('.dropdown-meganav-select-list-brand > li > a').on('click', function () {
                let title = 'Nhắc',
                    content = 'Bạn muốn thay đổi Thương hiệu, hệ thống sẽ được tải lại !',
                    icon = 'warning';
                sweetAlertComponent(title, content, icon).then(async (result) => {
                    if (result.value) {
                        $(this).parents('.brand-container').find('.brand-select-img').attr('src', $(this).children('img').attr('src'));
                        $(this).parents('.brand-container').find('.brand-select-name').text($(this).text());
                        $(this).parents('.dropdowns').removeClass('active');
                        $('#restaurant-branch-id-selected span').data('value', $(this).data('id'));
                        $('.wavy-wraper').removeClass('d-none');
                        updateSessionBrand($(this).data('id'));
                    }
                })
            })
            $('#select-branch-setting select').on('change', function () {
                // console.log($(this).data('id'));
                // $('.dropdown-meganav-select-list-branch > li').removeClass('active');
                // $(this).parent().addClass('active')
                // $(this).parents('.brand-container').find('.brand-select-img').attr('src', $(this).children('img').attr('src'));
                // $(this).parents('.brand-container').find('.brand-select-name').text($(this).text());
                // $(this).parents('.dropdowns').removeClass('active');
                // $('#change_branch').val($(this).data('id'));
                loadData();
                updateSessionBranch($(this).val())
            })
            // $('#select-branch-setting a').on('click', function () {
            //     $('#select-branch-list-active').select2('close');
            //     $('#select-branch-list-active').select2('open');
            // })
            //
            // $('#select-branch-list-active').on('change', function () {
            //     $(this).parents('.brand-container').find('.brand-select-img').attr('src', $(this).children('img').attr('src'));
            //     $(this).parents('.brand-container').find('.brand-select-name').text($(this).text());
            //     $(this).parents('.dropdowns').removeClass('active');
            //     $(this).parents('.brand-container').find('.brand-select').removeClass('active');
            //     $('#change_branch').val($(this).val());
            //     loadData();
            //     updateSessionBranch($(this).val())
            // })
            /**
             * Bắt sự kiện nhấn mở popup thanh menu header và kiểm tra nếu đang ở trang message visible hay không
             */
            $('#new_header .top-area .has-active').on("click", function (event) {
                // dataConversationPopup();
                if ($(this).hasClass('active')) {
                    $(this).parents().siblings().find('.dropdowns').removeClass('active');
                    $(this).removeClass('active');
                    $(this).parent().find('.dropdowns').removeClass('active');
                } else {
                    $('.top-area .has-active').not(this).removeClass('active');
                    $(this).parents().siblings().find('.dropdowns').removeClass('active');
                    $(this).addClass('active');
                    $(this).parent().find('.dropdowns').addClass('active');
                }
                if (window.location.pathname === '/visible-message') {
                    $('#icon-input-show-box-list-coversation-message a').addClass('disabled');
                    $('#icon-input-show-box-list-coversation-message a').removeClass('active');
                    $('#icon-input-show-box-list-coversation-message .dropdowns').removeClass('active');
                } else {
                    $('#icon-input-show-box-list-coversation-message a').removeClass('disabled');
                    $('#chat-popup-tms').removeClass('d-none');
                }
                event.stopPropagation();
            });

            $(document).on('click', '#new_header .dropdowns', function (event) {
                event.stopPropagation();
            })

            $(window).on("click", function () {
                $(".top-area .has-active").removeClass('active');
                $('.dropdowns').removeClass('active');
            });
            $('#new_header .main-menu-1 > span').on('click', function () {
                $('.nav-list').slideToggle(300);
                $('#new_header .main-menu-1 > span em').toggleClass('menu-active');
                $('#content-body-techres').toggleClass('menu-active-content');
            });
            $('#new_header .user-img-1').on('click', function () {
                $('.user-setting').toggleClass("active");
            });

            $(document).mouseup(function (e) {
                if ($('.user-setting.active').is(e.target) || $('.user-img-1, .user-img-1 h5, .user-img-1 img').is(e.target)) return;
                $('.user-setting').removeClass("active");
            })

            $('.theme-layout').on("click", function () {
                $(this).removeClass('active');
                $(".side-panel").removeClass('active');
            });
            if ($('.brand-select').last().hasClass('d-none')) {
                $('.brand-container').first().attr('style', 'width: 60%!important')
                $('.brand-container').last().attr('style', 'display: none')
                $('#new_header .top-area > ul').attr('style', 'width: 30%!important')
                $('#new_header .page-name').attr('style', 'width: 17%!important')
                $('#new_header .dropdowns.brand').attr('style', 'right: -45px')
                $('#new_header .top-area > ul > li .brand-select').attr('style', 'max-width: fit-content!important')
            }

            /**
             * Bật tắt icon setting thông báo tin nhắn popup
             */
            $(document).on('click', '#setting-notification-new-message', function () {
                $(this).toggleClass('active')
                if ($(this).hasClass('active')) {
                    $.cookie('settingNotificationChat', 'active');
                    $('#on-setting-notification-new-message').removeClass('d-none')
                    $('#off-setting-notification-new-message').addClass('d-none')
                } else {
                    $.cookie('settingNotificationChat', '');
                    $('#on-setting-notification-new-message').addClass('d-none')
                    $('#off-setting-notification-new-message').removeClass('d-none')
                }
            })

            /**
             * Nút chuyển menu
             */
            if ($('#permission-session').attr('data').includes("OWNER") || $('#permission-session').attr('data').includes("BUILD_RESTAURANT_DATA")) {
                $(document).on('click', '#more_menu', function () {
                    $(this).css('display', 'none')
                    $('#compact_menu').css('display', 'inline-block')
                    if ($(window).width() < 1190 && $(window).width() > 1045) {
                        $('#new_header .nav-list > li').not(this).each(function () {
                            $('#new_header .nav-list > li:first-child').css('display', 'none')
                            $('#new_header .nav-list > li:nth-child(9)').css('display', 'inline-block')
                        })
                    }
                    if ($(window).width() <= 1045 && $(window).width() > 940) {
                        $('#new_header .nav-list > li').not(this).each(function () {
                            $('#new_header .nav-list > li:first-child').css('display', 'none')
                            $('#new_header .nav-list > li:nth-child(2)').css('display', 'none')
                            $('#new_header .nav-list > li:nth-child(9)').css('display', 'inline-block')
                            $('#new_header .nav-list > li:nth-child(8)').css('display', 'inline-block')
                        })
                    }
                    if ($(window).width() <= 940) {
                        $('#new_header .nav-list > li').not(this).each(function () {
                            $('#new_header .nav-list > li:first-child').css('display', 'none')
                            $('#new_header .nav-list > li:nth-child(2)').css('display', 'none')
                            $('#new_header .nav-list > li:nth-child(3)').css('display', 'none')
                            $('#new_header .nav-list > li:nth-child(9)').css('display', 'inline-block')
                            $('#new_header .nav-list > li:nth-child(8)').css('display', 'inline-block')
                            $('#new_header .nav-list > li:nth-child(7)').css('display', 'inline-block')
                        })
                    }

                })
                $(document).on('click', '#compact_menu', function () {
                    $(this).css('display', 'none')
                    $('#more_menu').css('display', 'inline-block')
                    if ($(window).width() < 1190 && $(window).width() > 1045) {
                        $('#new_header .nav-list > li').not(this).each(function () {
                            $('#new_header .nav-list > li:first-child').css('display', 'inline-block')
                            $('#new_header .nav-list > li:nth-child(9)').css('display', 'none')
                        })
                    }
                    if ($(window).width() <= 1045 && $(window).width() > 940) {
                        $('#new_header .nav-list > li').not(this).each(function () {
                            $('#new_header .nav-list > li:first-child').css('display', 'inline-block')
                            $('#new_header .nav-list > li:nth-child(2)').css('display', 'inline-block')
                            $('#new_header .nav-list > li:nth-child(9)').css('display', 'none')
                            $('#new_header .nav-list > li:nth-child(8)').css('display', 'none')
                        })
                    }
                    if ($(window).width() <= 940) {
                        $('#new_header .nav-list > li').not(this).each(function () {
                            $('#new_header .nav-list > li:first-child').css('display', 'inline-block')
                            $('#new_header .nav-list > li:nth-child(2)').css('display', 'inline-block')
                            $('#new_header .nav-list > li:nth-child(3)').css('display', 'inline-block')
                            $('#new_header .nav-list > li:nth-child(9)').css('display', 'none')
                            $('#new_header .nav-list > li:nth-child(8)').css('display', 'none')
                            $('#new_header .nav-list > li:nth-child(7)').css('display', 'none')
                        })
                    }

                })
                $(window).on('resize', function () {
                    if ($(window).width() > 940) {
                        $('#new_header .nav-list > li:nth-child(7)').removeAttr('style')
                    }
                    if ($(window).width() > 975) {
                        $('#new_header .nav-list > li:nth-child(8)').removeAttr('style')
                    }
                    if ($(window).width() > 1100) {
                        $('#new_header .nav-list > li').removeAttr('style')
                    }
                })
            } else {
                if ($(window).width() > 1045) {
                    $('#more_menu').css('display', 'none');
                }
                if ($(window).width() <= 940) {
                    $('#new_header .nav-list > li').not(this).each(function () {
                        $('#new_header .nav-list > li:first-child').css('display', 'inline-block')
                        $('#new_header .nav-list > li:nth-child(2)').css('display', 'inline-block')
                        $('#new_header .nav-list > li:nth-child(8)').css('display', 'none')
                        $('#new_header .nav-list > li:nth-child(7)').css('display', 'none')
                    })
                }


                $(document).on('click', '#more_menu', function () {
                    $(this).css('display', 'none')
                    $('#compact_menu').css('display', 'inline-block')
                    if ($(window).width() <= 1045 && $(window).width() > 940) {
                        $('#new_header .nav-list > li').not(this).each(function () {
                            $('#new_header .nav-list > li:first-child').css('display', 'none')
                            $('#new_header .nav-list > li:nth-child(8)').css('display', 'inline-block')
                        })
                    }
                    if ($(window).width() <= 940) {
                        $('#new_header .nav-list > li').not(this).each(function () {
                            $('#new_header .nav-list > li:first-child').css('display', 'none')
                            $('#new_header .nav-list > li:nth-child(2)').css('display', 'none')
                            $('#new_header .nav-list > li:nth-child(8)').css('display', 'inline-block')
                            $('#new_header .nav-list > li:nth-child(7)').css('display', 'inline-block')
                        })
                    }
                })

                $(document).on('click', '#compact_menu', function () {
                    $(this).css('display', 'none')
                    $('#more_menu').css('display', 'inline-block')
                    if ($(window).width() <= 1045 && $(window).width() > 940) {
                        $('#new_header .nav-list > li').not(this).each(function () {
                            $('#new_header .nav-list > li:first-child').css('display', 'inline-block')
                            $('#new_header .nav-list > li:nth-child(8)').css('display', 'none')
                        })
                    }
                    if ($(window).width() <= 940) {
                        $('#new_header .nav-list > li').not(this).each(function () {
                            $('#new_header .nav-list > li:first-child').css('display', 'inline-block')
                            $('#new_header .nav-list > li:nth-child(2)').css('display', 'inline-block')
                            $('#new_header .nav-list > li:nth-child(8)').css('display', 'none')
                            $('#new_header .nav-list > li:nth-child(7)').css('display', 'none')
                        })
                    }
                })

                $(window).on('resize', function () {
                    if (window.matchMedia("(max-width: 1190px)").matches) {
                        $('#more_menu').css('display', 'none');
                        $('#new_header .nav-list > li').removeAttr('style')
                    }
                    if (window.matchMedia("(max-width: 1045px)").matches) {
                        $('#more_menu').css('display', 'inline-block')
                    }
                    if (window.matchMedia("(min-width: 1045px)").matches) {
                        $('#more_menu').css('display', 'none');
                        $('#compact_menu').css('display', 'none');
                    }
                })
            }

            /**
             * Nút chuyển chi nhánh
             */
            $('#change_branch').select2({
                dropdownParent: $('#select-branch-setting'),
                templateResult: function (idioma) {
                    let span = '';
                    if(!idioma.disabled){
                        span = $(`<span class="d-flex align-items-center" style="font-size: 13px"><img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="media-object mr-3" src='${$(idioma.element).data('image')}' style="width: 22px; height: 22px ; border-radius: 100%" />${idioma.text}</span>`);
                    }else {
                        span = $(`<span>${idioma.text}</span>`);
                        span = $(`<span>${idioma.text}</span>`);
                    }
                    return span;
                },
                templateSelection: function (idioma) {
                    return $(`<a class="brand-select has-active" href="javascript:void(0)" data-ripple="" id="restaurant-branch-id-selected">
                              <span class="d-none" data-value="${idioma.id}"></span>
                              <img class="brand-select-img" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="${$(idioma.element).data('image')}" alt=""><span class="brand-select-name">${idioma.text}</span></a>`)
                }
            });
        })

        function startSearch() {
            const search = document.querySelector("#new_header");
            const input = search.querySelector("#input-search-header");
            const label = search.querySelector("label");
            const btnListen = search.querySelector("#btn-mic-search-header");
            let listening = false;
            var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;

            /*
             * Sự kiện thu âm sau khi bấm nút ghi âm
             */
            btnListen.addEventListener("click", function () {
                navigator.mediaDevices.getUserMedia({audio: true})
                    .then(function (stream) {
                        navigator.permissions.query({
                            name: 'microphone'
                        }).then(function (result) {
                            if (result.state == 'denied') {
                                $('#btn-mic-search-header .icofont.icofont-mic-mute').removeClass('d-none')
                                $('#btn-mic-search-header .icofont.icofont-mic').addClass('d-none')
                            }
                            if (result.state == 'granted') {
                                if (!listening) {
                                    const recognition = new SpeechRecognition();
                                    recognition.onstart = function () {
                                        $('.pulse-ring').removeClass('d-none')
                                        $('#input-search-header').attr('placeholder', 'Đang lắng nghe ...')
                                        btnListen.classList.add("active");
                                        listening = true;
                                    };

                                    recognition.onspeechend = function () {
                                        $('.pulse-ring').addClass('d-none')
                                        $('#input-search-header').attr('placeholder', 'Tìm kiếm chức năng')
                                        recognition.stop();
                                        btnListen.classList.remove("active");
                                        listening = false;
                                    };

                                    recognition.onerror = function () {
                                        $('.pulse-ring').addClass('d-none')
                                        $('#input-search-header').attr('placeholder', 'Tìm kiếm chức năng')
                                        btnListen.classList.remove("active");
                                        listening = false;
                                    };

                                    recognition.onresult = function (event) {
                                        const transcript = event.results[0][0].transcript;
                                        const confidence = event.results[0][0].confidence;

                                        let i = 0;
                                        let placeholder = "";

                                        function type() {
                                            if (i <= transcript.length) {
                                                placeholder += transcript.charAt(i);
                                                document.getElementById("input-search-header").value = placeholder;
                                                i++;
                                                setTimeout(type, 150);
                                            } else {
                                                return false;
                                            }
                                        }

                                        type();

                                        input.focus();
                                        $('#input-search-header').attr('placeholder', 'Tìm kiếm chức năng')
                                        $('.pulse-ring').addClass('d-none')
                                        if (transcript.length > 0) {
                                            label.classList.add("a11y-hidden");
                                        }
                                    };
                                    recognition.start();
                                }
                            }
                        })
                    }).catch(function () {
                    $('#btn-mic-search-header .icofont.icofont-mic-mute').removeClass('d-none')
                    $('#btn-mic-search-header .icofont.icofont-mic').addClass('d-none')
                });
            });
        }
    </script>
@endpush
