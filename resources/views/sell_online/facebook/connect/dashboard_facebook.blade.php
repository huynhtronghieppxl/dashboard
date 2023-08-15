@extends('layouts.layout') @section('content')
    <style>
        #dashboard-facebook-main-content {
            position: fixed;
            left: 0;
            width: 100%;
            bottom: 0;
        }

        .md-tabs .nav-item {
            width: calc(100% / 4);
            text-align: center;
            max-width: max-content;
            margin: 0 -9px !important;
        }

        .nav-tabs .slide {
            background: #0072bc;
            width: calc(100% / 4);
            height: 3px;
            position: absolute;
            -webkit-transition: left 0.3s ease-out;
            transition: left 0.3s ease-out;
            bottom: 0;
        }

        /* css style by hao  */
        .edit-phone-number {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #phone-number-customer-restaurant{
            border-radius:5px;
            border: 1px solid #eee;
            transition: .3s border-color;
        }

        #phone-number-customer-restaurant:hover {
            border: 1px solid #aaa;
        }
        #icon-pencel-edit-phone-facebook, #icon-check-edit-phone-facebook, #icon-close-edit-phone-facebook {
            margin: 0px 0px 0px 10px;
        }

        .icon-sticker-chat-facebook-message{
            position: relative;
        }

        #message-facebook-group-sticker{
            background: #ffffff;
            max-width: 350px;
            max-height: 350px;
            margin: 10px;
            position: absolute;
            bottom: 62px;
            border-radius: 10px;
        }

        .sticker-message-group-item-facebook{
            width: 100%;
            height: 100%;

        }

        .group-sticker-big-item {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            overflow: hidden;
            overflow-y: auto;
            overflow-x: hidden ;
        }

        .item-sticker-image-big{
            margin: 5px 10px;
            width: 50px;
            height: 50px;

        }
        .image-sticker-big{
            width: 50px;
            height: 50px;
        }

        .group-sticker-small-item {
            display: flex;
            overflow: hidden;
            overflow-y: hidden;
            overflow-x: auto ;
        }
        .item-sticker-image-small{
            width: 30px;
            height: 30px;
            margin: 5px 10px;

        }
        .image-sticker-small{
            width: 30px;
            height: 30px;
        }

        .dashboard-facebook-filter-action-list{
            z-index: 9999;
        }
        .icon-reply-message-facebook {
            transform: rotate(45deg);
        }
        .label-danger{
            border-radius: 4px;
            font-size: 70%;
            padding: 7px;
            margin-right: 0px;
            font-weight: 400;
            color: #fff !important;
        }

        .image-facebook-outsite-content{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .content-alear-facebook-outsite{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .image-empty-outsite-booking-facebook{
            width: 100px;
            height: 100px;
        }
        .title-content-facebook-outsite{
            font-size: 23px;
        }
        .image-empty-booking-facebook{
            width: 150px;
            height: 150px;
        }
        .booking-visible-celendar{
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            height: 32px;
            width: 290px;
            font-size: 12px !important;
            background-color: var(--background-color);
            color: #505050;
            transition: all .3s ease;
            position: relative;
            bottom: -6px;
            border-radius: 8px;
            font-weight: 500;
            left: 6px;
            margin: 12px;
        }
        .booking-visible-celendar:hover{
            background: #c1bebe;
        }
        .icon-booking-celendar-order{
            margin: 10px 5px;
            font-size: 12px;
        }
        .item-empty-booking-facebook-all-list{
            position: absolute;
            right: 100px;
            top: 400px;
        }
        #group-action-tool-popup-facebook{
            background: #ffffff;
            width: 114px;
            max-height: 200px;
            margin: 10px;
            position: absolute;
            bottom: 62px;
            border-radius: 10px;
        }
        .content-icon{
            font-size: 14px;
            margin: 5px 10px;
        }
        .message-facebook-textarea{
            position: relative;
            right: 20px;
        }
        .emoji-send-facebook-message{
            position: relative;
            right: 10px;
            bottom: 5px;

        }
        .icon-item-send-message{
            font-size: 32px;
        }
        #list-media-right-bar .md-tabs .nav-item {
            width: calc(100% / 3);
            text-align: center;
            max-width: 100%;
            margin: 0 !important;
        }
        .see-detail-list-all-image-video-grid{
            display: flex;
            flex-wrap: wrap;
        }
        .see-detail-all-item-image-video-grid-img{
            position: relative;
        }
        .see-detail-all-item-image-video-grid-download{
            position: absolute;
            right: 10px;
            top: 10px;
        }

        .see-detail-all-item-video-grid-img{
            width: 100px;
            height: 100px;
            margin: 5px 7px;

        }
        .see-item-file-grid{
            position: relative;
        }
        .see-item-file-grid-download{
            position: absolute;
            right: 10px;
            top: 10px;
        }
        .group-content-file-facebook-title{
            display: flex;
            justify-content: flex-start;
            align-items: center;

        }
        .group-content-file-facebook-title:hover{
            background: #E8EAEF;
        }
        .see-item-file-grid-img{
            width: 50px;
            height: 50px;
            margin: 5px 10px;
        }
        .day-file-title-dereption{
            margin: 0px 0px 0px 100px;
        }


    </style>
    <div class="page-wrapper" id="dashboard-facebook-main-content">
        <div class="page-body">
            <!-- Header facebook message -->
            <div class="dashboard-facebook-header">
                <div class="dashboard-facebook-header-select" id="select-facebook-fanpage-messgae">
                    <div class="dashboard-facebook-header-select-info" style="display: flex; justify-content: center; align-items: center">
                        @if( Session::get(SESSION_KEY_CURRENT_PAGE_FACEBOOK_CONNECT) != null && count(Session::get(SESSION_KEY_CURRENT_PAGE_FACEBOOK_CONNECT)) > 0)
                            <img id="dashboard-facebook-header-detail-image" src="{{Session::get(SESSION_KEY_CURRENT_PAGE_FACEBOOK_CONNECT)['picture']['data']['url'] }}" alt="" />
                            <span id="dashboard-facebook-header-detail-span" style="white-space: nowrap;overflow: hidden; text-overflow: ellipsis; width: 150px" data-id="{{Session::get(SESSION_KEY_CURRENT_PAGE_FACEBOOK_CONNECT)['id']}}">{{ Session::get(SESSION_KEY_CURRENT_PAGE_FACEBOOK_CONNECT)['name'] }}</span>
                        @else
                            <img id="dashboard-facebook-header-detail-image" src="/images/tms/default.jpeg" alt="Image" />
                            <span id="dashboard-facebook-header-detail-span">Chưa có trang nào</span>
                        @endif
                    </div>
                    <i class="fa fa-angle-down"></i>
                </div>
                <!-- option -->
                <div class="dashboard-facebook-header-option d-none" id="option-fanpage-facebook-mesage">
                    <div class="dashboard-facebook-header-option-head">
                        <div class="dashboard-facebook-header-option-head-title">Chọn trang muốn xem</div>
                    </div>
                    <div class="dashboard-facebook-header-option-search">
                        <input id="dashboard-facebook-header-input-search" type="text" placeholder="Tìm kiếm" />
                        <i class="ti-search"></i>
                    </div>
                    <div class="dashboard-facebook-header-option-body">
                        <ul class="dashboard-facebook-header-option-list">
                            @if( Session::get(SESSION_KEY_ID_PAGE_FACEBOOK_CONNECT) != null && count(Session::get(SESSION_KEY_ID_PAGE_FACEBOOK_CONNECT)) > 0) @foreach(Session::get(SESSION_KEY_ID_PAGE_FACEBOOK_CONNECT) as $db)
                                <li class="dashboard-facebook-header-option-item" data-id="{{ $db['id'] }}">
                                    <div class="dashboard-facebook-header-option-item-info" style="display: flex; justify-content: center; align-items: center">
                                        <img src="{{ $db['picture']['data']['url'] }}" alt="" />
                                        <span class="dashboard-facebook-conversation-filter-name-option" style=" overflow: hidden ;display: -webkit-box;-webkit-box-orient: vertical; -webkit-line-clamp: 4; white-space: pre-wrap; width: 344px "> {{ $db['name'] }}</span>
                                    </div>
                                    <div class="dashboard-facebook-header-option-item-check">
                                        <input type="radio" name="page" class="d-none dashboard-facebook-header-option-checkbox" />
                                        <i class="fa fa-check-circle"></i>
                                    </div>
                                </li>
                            @endforeach @endif
                        </ul>
                    </div>
                    <div class="dashboard-facebook-header-option-footer">
                        <div class="dashboard-facebook-header-option-footer-all"></div>
                        <div>
                            <button type="button" class="btn btn-grd-primary" onclick="connectOnePage()">Chuyển trang</button>
                        </div>
                    </div>
                </div>
                <!-- Logout -->
                <div class="dashboard-facebook-header-select-setting">
                    <img src="https://scontent.fsgn4-1.fna.fbcdn.net/v/t39.30808-1/294102246_460159019452993_2269469935191696902_n.png?stp=cp0_dst-png_p40x40&_nc_cat=103&ccb=1-7&_nc_sid=c6021c&_nc_ohc=ejHxDeachWUAX-ZIkLj&_nc_ht=scontent.fsgn4-1.fna&oh=00_AT9ODIF2hGjbbslJ1C3ZsLZSn_wO21z9vZpOjAcUp4XS9A&oe=632DA9E6" alt="" />
                </div>
                <div class="dashboard-facebook-header-select-setting-contain d-none">
                    <div class="dashboard-facebook-header-select-setting-head">
                        <div class="dashboard-facebook-header-select-setting-info">
                            <img
                                src="https://scontent.fsgn8-1.fna.fbcdn.net/v/t1.6435-9/132045777_2022067027990823_365516879357302950_n.png?_nc_cat=1&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=4OT-FIOud54AX-393lh&_nc_ht=scontent.fsgn8-1.fna&oh=00_AT_-mZat3fEXQqhGLSjL8ZN0P5U8i1iw3NBwX3IPeNFvVA&oe=62D797F3"
                                alt=""
                            />
                            <span>Nguyễn Huy Dũng</span>
                        </div>
                        <i class="fa fa-sign-out"></i>
                    </div>
                    <div class="dashboard-facebook-header-select-setting-head-item active">
                        <div class="d-flex align-items-center w-100">
                            <i class="fa fa-shield"></i>
                            <div class="dashboard-facebook-header-select-setting-head-text">
                                <div>Tình trạng cấp quyền</div>
                                <span>Hoạt động ổn định</span>
                            </div>
                        </div>
                        <i class="fa fa-angle-right"></i>
                    </div>
                    <div class="dashboard-facebook-header-select-setting-head-item">
                        <div class="d-flex align-items-center w-100">
                            <i class="fa fa-bell-o"></i>
                            <div class="dashboard-facebook-header-select-setting-head-text">
                                <div>Cập nhật mới</div>
                            </div>
                        </div>
                        <i class="fa fa-angle-right"></i>
                    </div>
                    <div class="dashboard-facebook-header-select-setting-head-item">
                        <div class="d-flex align-items-center w-100">
                            <i class="fa fa-hdd-o"></i>
                            <div class="dashboard-facebook-header-select-setting-head-text">
                                <div>Hướng dẫn sử dụng</div>
                            </div>
                        </div>
                        <i class="fa fa-angle-right"></i>
                    </div>
                    <div class="dashboard-facebook-header-select-setting-head-item">
                        <div class="d-flex align-items-center w-100">
                            <i class="fa fa-question-circle-o"></i>
                            <div class="dashboard-facebook-header-select-setting-head-text">
                                <div>Trung tâm trợ giúp</div>
                            </div>
                        </div>
                        <i class="fa fa-angle-right"></i>
                    </div>
                    <div class="dashboard-facebook-header-select-setting-head-item">
                        <div class="d-flex align-items-center w-100">
                            <i class="fa fa-comment-o"></i>
                            <div class="dashboard-facebook-header-select-setting-head-text">
                                <div>Đóng góp ý kiến</div>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-facebook-header-select-setting-head-item">
                        <div class="d-flex align-items-center w-100">
                            <i class="fa fa-keyboard-o"></i>
                            <div class="dashboard-facebook-header-select-setting-head-text">
                                <div>Phím tắt & mẹo</div>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-facebook-header-select-setting-head-item">
                        <div class="d-flex align-items-center w-100">
                            <i class="fa fa-twitch"></i>
                            <div class="dashboard-facebook-header-select-setting-head-text">
                                <div>Xem hướng dẫn</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container -->
            <div class="dashboard-facebook-container">
                <!-- Sidebar -->
                <div class="dashboard-facebook-left">
                    <div class="dashboard-facebook-filter">
                        <div class="dashboard-facebook-filter-checkbox">
                            <div class="border-checkbox-section border-checkbox-section-custom">
                                <div class="border-checkbox-group border-checkbox-group-primary">
                                    <input class="border-checkbox show-checkbox-member-facebook" type="checkbox" id="checkbox0" />
                                    <label class="border-checkbox-label show-checkbox-member-facebook-label" for="checkbox0"></label>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-facebook-filter-search">
                            <input type="text" id="dashboard-facebook-filter-search-input" placeholder="Tìm kiếm" />
                            <i class="ti-search"></i>
                        </div>
                        <div class="dashboard-facebook-filter-action">
                            <i class="fa fa-sort" ></i>
                            <i class="ti-filter" data-original-title="Bộ lọc"></i>
                            <ul class="dashboard-facebook-filter-action-list d-none">
                                <li class="dashboard-facebook-filter-action-item">
                                    <div class="dashboard-facebook-filter-action-left">
                                        <i class="fa fa-codepen"></i>
                                        <span>Loai hội thoại</span>
                                    </div>
                                    <i class="fa fa-angle-right"></i>
                                </li>
                                <li class="dashboard-facebook-filter-action-item">
                                    <div class="dashboard-facebook-filter-action-left">
                                        <i class="fa fa-envelope-o"></i>
                                        <span>Trạng thái đọc</span>
                                    </div>
                                    <i class="fa fa-angle-right"></i>
                                </li>
                                <li class="dashboard-facebook-filter-action-item">
                                    <div class="dashboard-facebook-filter-action-left">
                                        <i class="fa fa-mail-forward"></i>
                                        <span>Trạng thái trả lời</span>
                                    </div>
                                    <i class="fa fa-angle-right"></i>
                                </li>
                                <li class="dashboard-facebook-filter-action-item">
                                    <div class="dashboard-facebook-filter-action-left">
                                        <i class="fa fa-phone"></i>
                                        <span>Số điện thoại</span>
                                    </div>
                                    <i class="fa fa-angle-right"></i>
                                </li>
                                <li class="dashboard-facebook-filter-action-item">
                                    <div class="dashboard-facebook-filter-action-left">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span>Đơn hàng</span>
                                    </div>
                                    <i class="fa fa-angle-right"></i>
                                </li>
                                <li class="dashboard-facebook-filter-action-item">
                                    <div class="dashboard-facebook-filter-action-left">
                                        <i class="fa fa-tag"></i>
                                        <span>Nhãn</span>
                                    </div>
                                    <i class="fa fa-angle-right"></i>
                                </li>
                                <li class="dashboard-facebook-filter-action-item">
                                    <div class="dashboard-facebook-filter-action-left">
                                        <i class="fa fa-edit"></i>
                                        <span>Bài viết</span>
                                    </div>
                                    <i class="fa fa-angle-right"></i>
                                </li>
                                <li class="dashboard-facebook-filter-action-item">
                                    <div class="dashboard-facebook-filter-action-left">
                                        <i class="fa fa-user"></i>
                                        <span>ID khách hàng</span>
                                    </div>
                                    <i class="fa fa-angle-right"></i>
                                </li>
                                <li class="dashboard-facebook-filter-action-item">
                                    <div class="dashboard-facebook-filter-action-left">
                                        <i class="fa fa-clock-o"></i>
                                        <span>Thời gian</span>
                                    </div>
                                    <i class="fa fa-angle-right"></i>
                                </li>
                                <li class="dashboard-facebook-filter-action-item">
                                    <div class="dashboard-facebook-filter-action-left">
                                        <i class="fa fa-users"></i>
                                        <span>Nhân viên hỗ trợ</span>
                                    </div>
                                    <i class="fa fa-angle-right"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="dashboard-facebook-conversation-filter-nav">
                        <div class="w-100">
                            <ul class="nav nav-tabs md-tabs md-3-tabs d-flex justify-content-around" role="tablist">
                                <li class="nav-item d-flex filter-message justify-content-center mt-2" data-type="1"  id="tab-list-all-messenger-filter">
                                    <a class="nav-link active" data-toggle="tab" role="tab" href="#dashboard-facebook-conversation-filter-list-tab1" onclick="dashboardFacebookConversationFilterListTab1()" aria-expanded="true">
                                        <i class="fa fa-codepen mr-1"></i>Tất cả
                                    </a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item d-flex filter-message justify-content-center mt-2" data-type="2" id="tab-list-messenger-filter">
                                    <a class="nav-link"  data-toggle="tab" role="tab" href="#dashboard-facebook-conversation-filter-list-tab2" onclick="dashboardFacebookConversationFilterListTab2()" aria-expanded="false">
                                        <i class="fa fa-envelope-o mr-1"></i>Tin nhắn
                                    </a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item d-flex filter-message justify-content-center mt-2" data-type="3" id="tab-list-comment-messenger-filter">
                                    <a class="nav-link" data-toggle="tab" role="tab" href="#dashboard-facebook-conversation-filter-list-tab3" onclick="dashboardFacebookConversationFilterListTab3()" aria-expanded="false">
                                        <i class="fa fa-commenting-o mr-1"></i>Bình luận
                                    </a>
                                    <div class="slide"></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content mt-0">
                        <ul class="dashboard-facebook-conversation-filter-list tab-pane active" role="tabpanel" id="dashboard-facebook-conversation-filter-list-tab1">
                            <li class="dashboard-facebook-conversation-filter-item item-test-1" data-id="' . $db['id'] . '">
                                <div class="border-checkbox-section border-checkbox-section-custom border-checkbox-section-custom-hide d-none">
                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                        <input class="border-checkbox border-checkbox-input-member-facebook" type="checkbox" required="" />
                                        <label class="border-checkbox-label border-checkbox-label-member-facebook"></label>
                                    </div>
                                </div>
                                <div class="dashboard-facebook-conversation-filter-avatar">
                                    <img src="https://scontent.fsgn3-1.fna.fbcdn.net/v/t39.30808-6/295416377_1302926200114917_115913191480108096_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=yTKMZekiR0YAX9vJv-1&tn=NyLKFDonsjU_1xQt&_nc_ht=scontent.fsgn3-1.fna&oh=00_AfBJcKQdNE1n1-MklF0hzeEedGsE6wiFN4kOjKxwgH4jJA&oe=63B94F7F" alt="" class="dashboard-facebook-conversation-filter-main-img" />
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/be/Facebook_Messenger_logo_2020.svg/1200px-Facebook_Messenger_logo_2020.svg.png" alt="" class="dashboard-facebook-conversation-filter-sub-img" />
                                </div>
                                <div class="dashboard-facebook-conversation-filter-time">20:22</div>
                                <div class="dashboard-facebook-conversation-filter-info">
                                    <div class="dashboard-facebook-conversation-filter-name">
                                        <div class="dashboard-facebook-conversation-filter-name-text">Nguyễn Huy Dũng</div>
                                    </div>
                                    <div class="dashboard-facebook-conversation-filter-message">
                                        <i class="fa fa-mail-reply"></i>
                                        <div class="dashboard-facebook-conversation-filter-message-main">
                                            <span class="d-none">Techres:</span>
                                            <p class="dashboard-facebook-conversation-message-snippet">vip quá</p>
                                        </div>
                                    </div>
                                    <div class="dashboard-facebook-conversation-filter-label d-none">
                                        <label for="">Trả lời tự động</label>
                                    </div>
                                    <div class="option">
                                        <div>
                                            <div class="notifycation pl-0 pr-0"><span>2</span></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="dashboard-facebook-conversation-filter-item item-test-2" data-id="' . $db['id'] . '">
                                <div class="border-checkbox-section border-checkbox-section-custom border-checkbox-section-custom-hide d-none">
                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                        <input class="border-checkbox border-checkbox-input-member-facebook" type="checkbox" required="" />
                                        <label class="border-checkbox-label border-checkbox-label-member-facebook"></label>
                                    </div>
                                </div>
                                <div class="dashboard-facebook-conversation-filter-avatar">
                                    <img src="https://scontent.fsgn13-2.fna.fbcdn.net/v/t39.30808-1/305838941_641956330987748_669261410675212782_n.jpg?stp=cp0_dst-jpg_p60x60&_nc_cat=109&ccb=1-7&_nc_sid=7206a8&_nc_ohc=sP7hgO6_vFwAX-X2gwU&_nc_ht=scontent.fsgn13-2.fna&oh=00_AfCk2XF_lIBRZIA1vs236XKiyWPjLH1oceMvISL1rKGZPA&oe=63BC0F37" alt="" class="dashboard-facebook-conversation-filter-main-img" />
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Facebook_Logo_%282019%29.png/768px-Facebook_Logo_%282019%29.png" alt="" class="dashboard-facebook-conversation-filter-sub-img" />
                                </div>
                                <div class="dashboard-facebook-conversation-filter-time">20:22</div>
                                <div class="dashboard-facebook-conversation-filter-info">
                                    <div class="dashboard-facebook-conversation-filter-name">
                                        <div class="dashboard-facebook-conversation-filter-name-text">Hao sù</div>
                                    </div>
                                    <div class="dashboard-facebook-conversation-filter-message">
                                        <i class="fa fa-mail-reply"></i>
                                        <div class="dashboard-facebook-conversation-filter-message-main">
                                            <span class="d-none">Techres:</span>
                                            <p class="dashboard-facebook-conversation-message-snippet">Sao bạn lại nói dị</p>
                                        </div>
                                    </div>
                                    <div class="dashboard-facebook-conversation-filter-label d-none">
                                        <label for="">Trả lời tự động</label>
                                    </div>
                                    <div class="option">
                                        <div>
                                            <div class="notifycation pl-0 pr-0"><span>2</span></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul class="dashboard-facebook-conversation-filter-list tab-pane" role="tabpanel" id="dashboard-facebook-conversation-filter-list-tab2">
                            <li class="dashboard-facebook-conversation-filter-item"data-id="' . $db['id'] . '">
                                <div class="border-checkbox-section border-checkbox-section-custom border-checkbox-section-custom-hide d-none">
                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                        <input class="border-checkbox border-checkbox-input-member-facebook" type="checkbox" required="" />
                                        <label class="border-checkbox-label border-checkbox-label-member-facebook"></label>
                                    </div>
                                </div>
                                <div class="dashboard-facebook-conversation-filter-avatar">
                                    <img src="https://scontent.fsgn3-1.fna.fbcdn.net/v/t39.30808-6/295416377_1302926200114917_115913191480108096_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=yTKMZekiR0YAX9vJv-1&tn=NyLKFDonsjU_1xQt&_nc_ht=scontent.fsgn3-1.fna&oh=00_AfBJcKQdNE1n1-MklF0hzeEedGsE6wiFN4kOjKxwgH4jJA&oe=63B94F7F" alt="" class="dashboard-facebook-conversation-filter-main-img" />
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/be/Facebook_Messenger_logo_2020.svg/1200px-Facebook_Messenger_logo_2020.svg.png" alt="" class="dashboard-facebook-conversation-filter-sub-img" />
                                </div>
                                <div class="dashboard-facebook-conversation-filter-time">20:22</div>
                                <div class="dashboard-facebook-conversation-filter-info">
                                    <div class="dashboard-facebook-conversation-filter-name">
                                        <div class="dashboard-facebook-conversation-filter-name-text">Nguyễn Huy Dũng</div>
                                    </div>
                                    <div class="dashboard-facebook-conversation-filter-message">
                                        <i class="fa fa-mail-reply"></i>
                                        <div class="dashboard-facebook-conversation-filter-message-main">
                                            <span class="d-none">Techres:</span>
                                            <p class="dashboard-facebook-conversation-message-snippet">vip quá</p>
                                        </div>
                                    </div>
                                    <div class="dashboard-facebook-conversation-filter-label d-none">
                                        <label for="">Trả lời tự động</label>
                                    </div>
                                    <div class="option">
                                        <div>
                                            <div class="notifycation pl-0 pr-0"><span>2</span></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="dashboard-facebook-conversation-filter-item" data-id="' . $db['id'] . '">
                                <div class="border-checkbox-section border-checkbox-section-custom border-checkbox-section-custom-hide d-none">
                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                        <input class="border-checkbox border-checkbox-input-member-facebook" type="checkbox" required="" />
                                        <label class="border-checkbox-label border-checkbox-label-member-facebook"></label>
                                    </div>
                                </div>
                                <div class="dashboard-facebook-conversation-filter-avatar">
                                    <img src="https://scontent.fsgn13-2.fna.fbcdn.net/v/t39.30808-1/305838941_641956330987748_669261410675212782_n.jpg?stp=cp0_dst-jpg_p60x60&_nc_cat=109&ccb=1-7&_nc_sid=7206a8&_nc_ohc=sP7hgO6_vFwAX-X2gwU&_nc_ht=scontent.fsgn13-2.fna&oh=00_AfCk2XF_lIBRZIA1vs236XKiyWPjLH1oceMvISL1rKGZPA&oe=63BC0F37" alt="" class="dashboard-facebook-conversation-filter-main-img" />
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Facebook_Logo_%282019%29.png/768px-Facebook_Logo_%282019%29.png" alt="" class="dashboard-facebook-conversation-filter-sub-img" />
                                </div>
                                <div class="dashboard-facebook-conversation-filter-time">20:22</div>
                                <div class="dashboard-facebook-conversation-filter-info">
                                    <div class="dashboard-facebook-conversation-filter-name">
                                        <div class="dashboard-facebook-conversation-filter-name-text">Cao tiền lùi</div>
                                    </div>
                                    <div class="dashboard-facebook-conversation-filter-message">
                                        <i class="fa fa-mail-reply"></i>
                                        <div class="dashboard-facebook-conversation-filter-message-main">
                                            <span class="d-none">Techres:</span>
                                            <p class="dashboard-facebook-conversation-message-snippet">Sao bạn lại nói dị</p>
                                        </div>
                                    </div>
                                    <div class="dashboard-facebook-conversation-filter-label d-none">
                                        <label for="">Trả lời tự động</label>
                                    </div>
                                    <div class="option">
                                        <div>
                                            <div class="notifycation pl-0 pr-0"><span>2</span></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul class="dashboard-facebook-conversation-filter-list tab-pane" role="tabpanel" id="dashboard-facebook-conversation-filter-list-tab3">
                            <li class="dashboard-facebook-conversation-filter-item" data-id="' . $db['id'] . '">
                                <div class="border-checkbox-section border-checkbox-section-custom border-checkbox-section-custom-hide d-none">
                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                        <input class="border-checkbox border-checkbox-input-member-facebook" type="checkbox" required="" />
                                        <label class="border-checkbox-label border-checkbox-label-member-facebook"></label>
                                    </div>
                                </div>
                                <div class="dashboard-facebook-conversation-filter-avatar">
                                    <img src="https://scontent.fsgn13-2.fna.fbcdn.net/v/t39.30808-1/305838941_641956330987748_669261410675212782_n.jpg?stp=cp0_dst-jpg_p60x60&_nc_cat=109&ccb=1-7&_nc_sid=7206a8&_nc_ohc=sP7hgO6_vFwAX-X2gwU&_nc_ht=scontent.fsgn13-2.fna&oh=00_AfCk2XF_lIBRZIA1vs236XKiyWPjLH1oceMvISL1rKGZPA&oe=63BC0F37" alt="" class="dashboard-facebook-conversation-filter-main-img" />
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Facebook_Logo_%282019%29.png/768px-Facebook_Logo_%282019%29.png" alt="" class="dashboard-facebook-conversation-filter-sub-img" />
                                </div>
                                <div class="dashboard-facebook-conversation-filter-time">20:22</div>
                                <div class="dashboard-facebook-conversation-filter-info">
                                    <div class="dashboard-facebook-conversation-filter-name">
                                        <div class="dashboard-facebook-conversation-filter-name-text">Hao sù</div>
                                    </div>
                                    <div class="dashboard-facebook-conversation-filter-message">
                                        <i class="fa fa-mail-reply"></i>
                                        <div class="dashboard-facebook-conversation-filter-message-main">
                                            <span class="d-none">Techres:</span>
                                            <p class="dashboard-facebook-conversation-message-snippet">Sao bạn lại nói dị</p>
                                        </div>
                                    </div>
                                    <div class="dashboard-facebook-conversation-filter-label d-none">
                                        <label for="">Trả lời tự động</label>
                                    </div>
                                    <div class="option">
                                        <div>
                                            <div class="notifycation pl-0 pr-0"><span>2</span></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="dashboard-facebook-conversation-filter-item" data-id="' . $db['id'] . '">
                                <div class="border-checkbox-section border-checkbox-section-custom border-checkbox-section-custom-hide d-none">
                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                        <input class="border-checkbox border-checkbox-input-member-facebook" type="checkbox" required="" />
                                        <label class="border-checkbox-label border-checkbox-label-member-facebook"></label>
                                    </div>
                                </div>
                                <div class="dashboard-facebook-conversation-filter-avatar">
                                    <img src="https://scontent.fsgn13-2.fna.fbcdn.net/v/t39.30808-1/305838941_641956330987748_669261410675212782_n.jpg?stp=cp0_dst-jpg_p60x60&_nc_cat=109&ccb=1-7&_nc_sid=7206a8&_nc_ohc=sP7hgO6_vFwAX-X2gwU&_nc_ht=scontent.fsgn13-2.fna&oh=00_AfCk2XF_lIBRZIA1vs236XKiyWPjLH1oceMvISL1rKGZPA&oe=63BC0F37" alt="" class="dashboard-facebook-conversation-filter-main-img" />
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Facebook_Logo_%282019%29.png/768px-Facebook_Logo_%282019%29.png" alt="" class="dashboard-facebook-conversation-filter-sub-img" />
                                </div>
                                <div class="dashboard-facebook-conversation-filter-time">20:22</div>
                                <div class="dashboard-facebook-conversation-filter-info">
                                    <div class="dashboard-facebook-conversation-filter-name">
                                        <div class="dashboard-facebook-conversation-filter-name-text">Cao tiền lùi</div>
                                    </div>
                                    <div class="dashboard-facebook-conversation-filter-message">
                                        <i class="fa fa-mail-reply"></i>
                                        <div class="dashboard-facebook-conversation-filter-message-main">
                                            <span class="d-none">Techres:</span>
                                            <p class="dashboard-facebook-conversation-message-snippet">Sao bạn lại nói dị</p>
                                        </div>
                                    </div>
                                    <div class="dashboard-facebook-conversation-filter-label d-none">
                                        <label for="">Trả lời tự động</label>
                                    </div>
                                    <div class="option">
                                        <div>
                                            <div class="notifycation pl-0 pr-0"><span>2</span></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Body chat -->
                <div class="dashboard-facebook-body d-none">
                    <div class="dashboard-facebook-body-head">
                        <div class="dashboard-facebook-body-head-left">
                            <img src="https://scontent.fsgn3-1.fna.fbcdn.net/v/t39.30808-6/295416377_1302926200114917_115913191480108096_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=yTKMZekiR0YAX9vJv-1&tn=NyLKFDonsjU_1xQt&_nc_ht=scontent.fsgn3-1.fna&oh=00_AfBJcKQdNE1n1-MklF0hzeEedGsE6wiFN4kOjKxwgH4jJA&oe=63B94F7F" alt="" />
                            <div class="dashboard-facebook-body-head-info">
                                <div class="dashboard-facebook-body-head-name">Nguyễn Huy Dũng</div>
                                <div class="dashboard-facebook-body-head-status">Đang hoạt động</div>
                            </div>
                        </div>
                        <div class="dashboard-facebook-body-head-right">
                            <i class="fa fa-envelope-o mr-1"></i>
                            <div class="dashboard-facebook-body-head-right-filter">
                                <i class="fa fa-codepen mr-1"></i>
                                <span>2</span>
                            </div>
                            <i class="ti-na"></i>
                        </div>
                    </div>
                    {{-- GHIM TIN NHẮN--}}
                    <div class="dashboard-facebook-body-pin d-none" id="dashboard-facebook-body-head-pin-mess">
                        <div class="dashboard-facebook-body-head-left">
                            <img src="https://zpsocial-f48-org.zadn.vn/b2fdc0a214b5fbeba2a4.jpg" alt="" />
                            <div class="dashboard-facebook-body-head-info">
                                <div class="dashboard-facebook-body-pin-text">TechresTest đã đăng lúc 22:20, 18/06/2022</div>
                                <div class="dashboard-facebook-body-pin-message">Alolo</div>
                            </div>
                        </div>
                        <div class="dashboard-facebook-body-head-right">
                            <i class="fa fa fa-eye ml-3"></i>
                            <i class="fa fa-list-alt ml-3"></i>
                            <i class="fa fa-refresh ml-3"></i>
                        </div>
                    </div>
                    <!-- main chat -->
                    <div class="dashboard-facebook-body-chat body-visible-message">
                        <div class="chat-body-scroll-top-btn scroll-btn d-none">
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="chat-body-scroll-top-new-message scroll-btn d-none">
                            <i class="fa fa-angle-down"></i>
                            <div class="chat-body-scroll-top-new-message-text">
                                Có tin nhắn mới
                            </div>
                        </div>

                        <div class="chat-body-message-main" id="data-message-visible-message-facebook">

                        </div>
                        <div class="chat-bubble d-none" id="typing-data-message-visible-message">
                            <div class="typing">
                                <div class="dot"></div>
                                <div class="dot"></div>
                                <div class="dot"></div>
                            </div>
                        </div>
                    </div>

                    <!-- INPUT -->
                    <div class="dashboard-facebook-body-input">
                        <div class="message-facebook message-facebook-options">
                            <ul class="message-facebook-menu">
                                <li class="icon-group-menu">
                                    <svg viewBox="0 0 24 24" height="20px" width="20px" class="b6ax4al1 m4pnbp5e aqweqrfb ahndzqod db0glzta tnag3kze"><g fill-rule="evenodd"><polygon fill="none" points="-6,30 30,30 30,-6 -6,-6 "></polygon><path class="color-icon-facebook" d="m18,11l-5,0l0,-5c0,-0.552 -0.448,-1 -1,-1c-0.5525,0 -1,0.448 -1,1l0,5l-5,0c-0.5525,0 -1,0.448 -1,1c0,0.552 0.4475,1 1,1l5,0l0,5c0,0.552 0.4475,1 1,1c0.552,0 1,-0.448 1,-1l0,-5l5,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1m-6,13c-6.6275,0 -12,-5.3725 -12,-12c0,-6.6275 5.3725,-12 12,-12c6.627,0 12,5.3725 12,12c0,6.6275 -5.373,12 -12,12" fill="#0084ff"></path></g></svg>
                                </li>
                                <li class="icon-menu-3">
                                    <label class="input-image-message-facebook-message" for="item-upload-image-facebook-message" data-toggle="tooltip" data-placement="top" data-original-title="Ảnh">
                                        <svg viewBox="0 -1 17 17" height="20px" width="20px" class="image-icon-facebook b6ax4al1 m4pnbp5e aqweqrfb ahndzqod"><g fill="none" fill-rule="evenodd"><path class="color-icon-facebook" d="M2.882 13.13C3.476 4.743 3.773.48 3.773.348L2.195.516c-.7.1-1.478.647-1.478 1.647l1.092 11.419c0 .5.2.9.4 1.3.4.2.7.4.9.4h.4c-.6-.6-.727-.951-.627-2.151z" fill="#0084ff"></path><circle fill="#0084ff" cx="8.5" cy="4.5" r="1.5"></circle><path class="color-icon-facebook" d="M14 6.2c-.2-.2-.6-.3-.8-.1l-2.8 2.4c-.2.1-.2.4 0 .6l.6.7c.2.2.2.6-.1.8-.1.1-.2.1-.4.1s-.3-.1-.4-.2L8.3 8.3c-.2-.2-.6-.3-.8-.1l-2.6 2-.4 3.1c0 .5.2 1.6.7 1.7l8.8.6c.2 0 .5 0 .7-.2.2-.2.5-.7.6-.9l.6-5.9L14 6.2z" fill="#0084ff"></path><path class="color-icon-facebook" d="M13.9 15.5l-8.2-.7c-.7-.1-1.3-.8-1.3-1.6l1-11.4C5.5 1 6.2.5 7 .5l8.2.7c.8.1 1.3.8 1.3 1.6l-1 11.4c-.1.8-.8 1.4-1.6 1.3z" fill="#0084ff" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
                                    </label>
                                    <input id="item-upload-image-facebook-message" class="d-none" type="file" multiple="" accept=".jpg,.png,.gif">
                                </li>
                                <li class="icon-menu-2 icon-sticker-chat-facebook-message" id="sticker-item-facebook-messenger">
                                    <svg class="sticker-icon-facebook x1lliihq x1k90msu x13hzchw x1qfuztq xsrhx6k" title="Emoji" height="20px" viewBox="0 0 17 16" width="20px" x="0px" y="0px"><g fill-rule="evenodd"><circle cx="5.5" cy="5.5" fill="none" r="1"></circle><circle cx="11.5" cy="4.5" fill="none" r="1"></circle><path class="color-icon-facebook" d="M5.3 9c-.2.1-.4.4-.3.7.4 1.1 1.2 1.9 2.3 2.3h.2c.2 0 .4-.1.5-.3.1-.3 0-.5-.3-.6-.8-.4-1.4-1-1.7-1.8-.1-.2-.4-.4-.7-.3z" fill="none"></path><path class="color-icon-facebook" d="M10.4 13.1c0 .9-.4 1.6-.9 2.2 4.1-1.1 6.8-5.1 6.5-9.3-.4.6-1 1.1-1.8 1.5-2 1-3.7 3.6-3.8 5.6z" fill="#0084ff"></path><path class="color-icon-facebook" d="M2.5 13.4c.1.8.6 1.6 1.3 2 .5.4 1.2.6 1.8.6h.6l.4-.1c1.6-.4 2.6-1.5 2.7-2.9.1-2.4 2.1-5.4 4.5-6.6 1.3-.7 1.9-1.6 1.9-2.8l-.2-.9c-.1-.8-.6-1.6-1.3-2-.7-.5-1.5-.7-2.4-.5L3.6 1.5C1.9 1.8.7 3.4 1 5.2l1.5 8.2zm9-8.9c.6 0 1 .4 1 1s-.4 1-1 1-1-.4-1-1 .4-1 1-1zm-3.57 6.662c.3.1.4.4.3.6-.1.3-.3.4-.5.4h-.2c-1-.4-1.9-1.3-2.3-2.3-.1-.3.1-.6.3-.7.3-.1.5 0 .6.3.4.8 1 1.4 1.8 1.7zM5.5 5.5c.6 0 1 .4 1 1s-.4 1-1 1-1-.4-1-1 .4-1 1-1z" fill="#0084ff" fill-rule="nonzero"></path></g></svg>
                                </li>
                                <li class="icon-menu-1">
                                    <svg x="0px" y="0px" viewBox="0 0 16 16" data-original-title="Gif" height="20px" width="20px" class="gif-icon-facebook b6ax4al1 m4pnbp5e aqweqrfb ahndzqod db0glzta"><path class="color-icon-facebook" d="M.783 12.705c.4.8 1.017 1.206 1.817 1.606 0 0 1.3.594 2.5.694 1 .1 1.9.1 2.9.1s1.9 0 2.9-.1 1.679-.294 2.479-.694c.8-.4 1.157-.906 1.557-1.706.018 0 .4-1.405.5-2.505.1-1.2.1-3 0-4.3-.1-1.1-.073-1.976-.473-2.676-.4-.8-.863-1.408-1.763-1.808-.6-.3-1.2-.3-2.4-.4-1.8-.1-3.8-.1-5.7 0-1 .1-1.7.1-2.5.5s-1.417 1.1-1.817 1.9c0 0-.4 1.484-.5 2.584-.1 1.2-.1 3 0 4.3.1 1 .2 1.705.5 2.505zm10.498-8.274h2.3c.4 0 .769.196.769.696 0 .5-.247.68-.747.68l-1.793.02.022 1.412 1.252-.02c.4 0 .835.204.835.704s-.442.696-.842.696H11.82l-.045 2.139c0 .4-.194.8-.694.8-.5 0-.7-.3-.7-.8l-.031-5.631c0-.4.43-.696.93-.696zm-3.285.771c0-.5.3-.8.8-.8s.8.3.8.8l-.037 5.579c0 .4-.3.8-.8.8s-.8-.4-.8-.8l.037-5.579zm-3.192-.825c.7 0 1.307.183 1.807.683.3.3.4.7.1 1-.2.4-.7.4-1 .1-.2-.1-.5-.3-.9-.3-1 0-2.011.84-2.011 2.14 0 1.3.795 2.227 1.695 2.227.4 0 .805.073 1.105-.127V8.6c0-.4.3-.8.8-.8s.8.3.8.8v1.8c0 .2.037.071-.063.271-.7.7-1.57.991-2.47.991C2.868 11.662 1.3 10.2 1.3 8s1.704-3.623 3.504-3.623z" fill="#0084ff" fill-rule="nonzero"></path></svg>
                                </li>
                            </ul>
                            <div id="group-action-tool-popup-facebook" class="group-item-tool-action-facebook-mes d-none">
                                <ul class="group-icon-tool-facebook">
                                    <li class="icon-menu-5 icon-video-chat-facebook-message" style="margin: 0px 0px 0px -12px; display: flex; justify-content: center; align-items: center" >
                                        <i class="" ></i>
                                        <label for="chat-action-video-facebook" class="mb-0">
                                            <i class="chat-footer-option-icon zmdi zmdi-movie active-icon-popup" style="font-size: 20px; color: #0084FF" data-toggle="tooltip" data-placement="top" data-original-title="Video"></i>
                                            <span class="content-icon"> Video</span>
                                        </label>
                                        <input id="chat-action-video-facebook" class="d-none" type="file" accept=".mov,.mp4,.3gp">
                                    </li>
                                    <li class="icon-menu-4 icon-file-chat-facebook-message" style="margin: 0px 0px 0px -12px; display: flex; justify-content: center; align-items: center" >
                                        <i class="zmdi zmdi-file" style="font-size: 20px; color:#0084FF "></i>
                                        <span class="content-icon">File</span>
                                    </li>
                                    <li class="icon-menu-3 icon-image-chat-facebook-message d-none" id="icon-image-chat-facebook-message-popup" style="margin: 0px 0px 0px -12px; display: flex; justify-content: center; align-items: center">
                                        <label class="input-image-message-facebook-message" for="item-upload-image-facebook-message" data-toggle="tooltip" data-placement="top" data-original-title="Ảnh">
                                            <svg viewBox="0 -1 17 17" height="20px" width="20px" class=" b6ax4al1 m4pnbp5e aqweqrfb ahndzqod"><g fill="none" fill-rule="evenodd"><path  d="M2.882 13.13C3.476 4.743 3.773.48 3.773.348L2.195.516c-.7.1-1.478.647-1.478 1.647l1.092 11.419c0 .5.2.9.4 1.3.4.2.7.4.9.4h.4c-.6-.6-.727-.951-.627-2.151z" fill="#0084ff"></path><circle fill="#0084ff" cx="8.5" cy="4.5" r="1.5"></circle><path d="M14 6.2c-.2-.2-.6-.3-.8-.1l-2.8 2.4c-.2.1-.2.4 0 .6l.6.7c.2.2.2.6-.1.8-.1.1-.2.1-.4.1s-.3-.1-.4-.2L8.3 8.3c-.2-.2-.6-.3-.8-.1l-2.6 2-.4 3.1c0 .5.2 1.6.7 1.7l8.8.6c.2 0 .5 0 .7-.2.2-.2.5-.7.6-.9l.6-5.9L14 6.2z" fill="#0084ff"></path><path d="M13.9 15.5l-8.2-.7c-.7-.1-1.3-.8-1.3-1.6l1-11.4C5.5 1 6.2.5 7 .5l8.2.7c.8.1 1.3.8 1.3 1.6l-1 11.4c-.1.8-.8 1.4-1.6 1.3z" stroke="#0084ff" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
                                        </label>
                                        <span class="content-icon">Ảnh</span>
                                        <input id="item-upload-image-facebook-message" class="d-none" type="file" multiple="" accept=".jpg,.png,.gif">
                                    </li>
                                    <li class="icon-menu-2 icon-sticker-chat-facebook-message d-none" id="icon-sticker-chat-facebook-message-popup" style="margin: 0px 0px 0px -12px;display: flex; justify-content: center; align-items: center" >
                                        <svg  class="sticker-icon-facebook x1lliihq x1k90msu x13hzchw x1qfuztq xsrhx6k" title="Emoji" height="20px" viewBox="0 0 17 16" width="20px" x="0px" y="0px"><g fill-rule="evenodd"><circle cx="5.5" cy="5.5" fill="none" r="1"></circle><circle cx="11.5" cy="4.5" fill="none" r="1"></circle><path d="M5.3 9c-.2.1-.4.4-.3.7.4 1.1 1.2 1.9 2.3 2.3h.2c.2 0 .4-.1.5-.3.1-.3 0-.5-.3-.6-.8-.4-1.4-1-1.7-1.8-.1-.2-.4-.4-.7-.3z" fill="none"></path><path d="M10.4 13.1c0 .9-.4 1.6-.9 2.2 4.1-1.1 6.8-5.1 6.5-9.3-.4.6-1 1.1-1.8 1.5-2 1-3.7 3.6-3.8 5.6z" fill="#0084ff"></path><path d="M2.5 13.4c.1.8.6 1.6 1.3 2 .5.4 1.2.6 1.8.6h.6l.4-.1c1.6-.4 2.6-1.5 2.7-2.9.1-2.4 2.1-5.4 4.5-6.6 1.3-.7 1.9-1.6 1.9-2.8l-.2-.9c-.1-.8-.6-1.6-1.3-2-.7-.5-1.5-.7-2.4-.5L3.6 1.5C1.9 1.8.7 3.4 1 5.2l1.5 8.2zm9-8.9c.6 0 1 .4 1 1s-.4 1-1 1-1-.4-1-1 .4-1 1-1zm-3.57 6.662c.3.1.4.4.3.6-.1.3-.3.4-.5.4h-.2c-1-.4-1.9-1.3-2.3-2.3-.1-.3.1-.6.3-.7.3-.1.5 0 .6.3.4.8 1 1.4 1.8 1.7zM5.5 5.5c.6 0 1 .4 1 1s-.4 1-1 1-1-.4-1-1 .4-1 1-1z" fill="#0084ff" fill-rule="nonzero"></path></g></svg>
                                        <span class="content-icon">Icon</span>
                                    </li>
                                    <li class="icon-menu-1 icon-gif-chat-facebook-message  d-none" id="icon-gif-chat-facebook-message-popup" style="display: flex; justify-content: center; align-items: center" >
                                        <svg style="margin: 0px 0px 0px -15px" x="0px" y="0px" viewBox="0 0 16 16" data-original-title="Gif" height="20px" width="20px" class=" b6ax4al1 m4pnbp5e aqweqrfb ahndzqod db0glzta"><path  d="M.783 12.705c.4.8 1.017 1.206 1.817 1.606 0 0 1.3.594 2.5.694 1 .1 1.9.1 2.9.1s1.9 0 2.9-.1 1.679-.294 2.479-.694c.8-.4 1.157-.906 1.557-1.706.018 0 .4-1.405.5-2.505.1-1.2.1-3 0-4.3-.1-1.1-.073-1.976-.473-2.676-.4-.8-.863-1.408-1.763-1.808-.6-.3-1.2-.3-2.4-.4-1.8-.1-3.8-.1-5.7 0-1 .1-1.7.1-2.5.5s-1.417 1.1-1.817 1.9c0 0-.4 1.484-.5 2.584-.1 1.2-.1 3 0 4.3.1 1 .2 1.705.5 2.505zm10.498-8.274h2.3c.4 0 .769.196.769.696 0 .5-.247.68-.747.68l-1.793.02.022 1.412 1.252-.02c.4 0 .835.204.835.704s-.442.696-.842.696H11.82l-.045 2.139c0 .4-.194.8-.694.8-.5 0-.7-.3-.7-.8l-.031-5.631c0-.4.43-.696.93-.696zm-3.285.771c0-.5.3-.8.8-.8s.8.3.8.8l-.037 5.579c0 .4-.3.8-.8.8s-.8-.4-.8-.8l.037-5.579zm-3.192-.825c.7 0 1.307.183 1.807.683.3.3.4.7.1 1-.2.4-.7.4-1 .1-.2-.1-.5-.3-.9-.3-1 0-2.011.84-2.011 2.14 0 1.3.795 2.227 1.695 2.227.4 0 .805.073 1.105-.127V8.6c0-.4.3-.8.8-.8s.8.3.8.8v1.8c0 .2.037.071-.063.271-.7.7-1.57.991-2.47.991C2.868 11.662 1.3 10.2 1.3 8s1.704-3.623 3.504-3.623z" fill="#0084ff" fill-rule="nonzero"></path></svg>
                                        <span class="content-icon">Gif</span>
                                    </li>
                                </ul>
                            </div>
                            <div id="message-facebook-group-sticker" class="message-facebook-group-sticker-class d-none">
                                <div class="sticker-message-group-item-facebook">
                                    <div class="group-sticker-big-item ">
                                        <div class="item-sticker-image-big">
                                            <img class="image-sticker-big" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="/images/tms/default.jpeg" data-src="/public/stickers/biet-doi-tha-thu/1.gif" loading="lazy" alt="Ảnh" data-type="1">
                                        </div>
                                        <div class="item-sticker-image-big sticker2">
                                            <img class="image-sticker-big" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="/images/tms/default.jpeg" data-src="/public/stickers/biet-doi-tha-thu/1.gif" loading="lazy" alt="Ảnh" data-type="2">
                                        </div>
                                        <div class="item-sticker-image-big">
                                            <img class="image-sticker-big" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="/images/tms/default.jpeg" data-src="/public/stickers/biet-doi-tha-thu/1.gif" loading="lazy" alt="Ảnh" data-type="3">
                                        </div>
                                        <div class="item-sticker-image-big">
                                            <img class="image-sticker-big" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="/images/tms/default.jpeg" data-src="/public/stickers/biet-doi-tha-thu/1.gif" loading="lazy" alt="Ảnh" data-type="4">
                                        </div>
                                        <div class="item-sticker-image-big">
                                            <img class="image-sticker-big" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="/images/tms/default.jpeg" data-src="/public/stickers/biet-doi-tha-thu/1.gif" loading="lazy" alt="Ảnh" data-type="5" >
                                        </div>
                                        <div class="item-sticker-image-big">
                                            <img class="image-sticker-big" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="/images/tms/default.jpeg" data-src="/public/stickers/biet-doi-tha-thu/1.gif" loading="lazy" alt="Ảnh" data-type="6">
                                        </div>
                                        <div class="item-sticker-image-big">
                                            <img class="image-sticker-big" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="/images/tms/default.jpeg" data-src="/public/stickers/biet-doi-tha-thu/1.gif" loading="lazy" alt="Ảnh" data-type="7">
                                        </div>
                                    </div>
                                    <div class="group-sticker-small-item ">
                                        <div class="item-sticker-image-small">
                                            <img class="image-sticker-small" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="/images/tms/default.jpeg" data-src="/public/stickers/biet-doi-tha-thu/1.gif" loading="lazy" alt="Ảnh" data-type="1">
                                        </div>
                                        <div class="item-sticker-image-small">
                                            <img class="image-sticker-small" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="/images/tms/default.jpeg" data-src="/public/stickers/biet-doi-tha-thu/1.gif" loading="lazy" alt="Ảnh" data-type="2">
                                        </div>
                                        <div class="item-sticker-image-small">
                                            <img class="image-sticker-small" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="/images/tms/default.jpeg" data-src="/public/stickers/biet-doi-tha-thu/1.gif" loading="lazy" alt="Ảnh" data-type="3">
                                        </div>
                                        <div class="item-sticker-image-small">
                                            <img class="image-sticker-small" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="/images/tms/default.jpeg" data-src="/public/stickers/biet-doi-tha-thu/1.gif" loading="lazy" alt="Ảnh" data-type="4">
                                        </div>
                                        <div class="item-sticker-image-small">
                                            <img class="image-sticker-small" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="/images/tms/default.jpeg" data-src="/public/stickers/biet-doi-tha-thu/1.gif" loading="lazy" alt="Ảnh" data-type="5">
                                        </div>
                                        <div class="item-sticker-image-small">
                                            <img class="image-sticker-small" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="/images/tms/default.jpeg" data-src="/public/stickers/biet-doi-tha-thu/1.gif" loading="lazy" alt="Ảnh" data-type="6">
                                        </div>
                                        <div class="item-sticker-image-small">
                                            <img class="image-sticker-small" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="/images/tms/default.jpeg" data-src="/public/stickers/biet-doi-tha-thu/1.gif" loading="lazy" alt="Ảnh" data-type="7">
                                        </div>
                                        <div class="item-sticker-image-small">
                                            <img class="image-sticker-small" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="/images/tms/default.jpeg" data-src="/public/stickers/biet-doi-tha-thu/1.gif" loading="lazy" alt="Ảnh" data-type="8">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="message-facebook-textarea" rows="1" contenteditable id="message-facebook" placeholder="Aa"></div>
                            <div class="submit" style="position: absolute; right: 10px;">
                                <button type="submit" disabled id="submitbutton" aria-label="submitbutton" class="submitbutton dashboard-facebook-button-send-content" style="z-index: 999999;">
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="35" height="35" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="white" d="m16.707 11.293l-4-4a1.004 1.004 0 0 0-1.414 0l-4 4a1 1 0 0 0 1.414 1.414L11 10.414V16a1 1 0 0 0 2 0v-5.586l2.293 2.293a1 1 0 0 0 1.414-1.414Z" /><path fill="currentColor" d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2Zm4.707 10.707a1 1 0 0 1-1.414 0L13 10.414V16a1 1 0 0 1-2 0v-5.586l-2.293 2.293a1 1 0 0 1-1.414-1.414l4-4a1.004 1.004 0 0 1 1.414 0l4 4a1 1 0 0 1 0 1.414Z" opacity="1" /></svg>
                                </button>
                            </div>
                            <div class="emoji-send-facebook-message">
                                <i class="fa fa-smile-o icon-item-send-message"></i>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- About chat -->
                <div class="dashboard-facebook-right d-none" id="about-chat-facebook-right-bar">
                    <div class="dashboard-facebook-right-header">
                        <div class="dashboard-facebook-right-header-avatar">
                            <img src="https://scontent.fsgn3-1.fna.fbcdn.net/v/t39.30808-6/295416377_1302926200114917_115913191480108096_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=yTKMZekiR0YAX9vJv-1&tn=NyLKFDonsjU_1xQt&_nc_ht=scontent.fsgn3-1.fna&oh=00_AfBJcKQdNE1n1-MklF0hzeEedGsE6wiFN4kOjKxwgH4jJA&oe=63B94F7F" alt="" class="dashboard-facebook-right-header-img" />
                        </div>
                        <div class="dashboard-facebook-right-header-info">
                            <div class="dashboard-facebook-right-header-name">
                                <span>Nguyễn Huy Dũng</span>
                            </div>
                            <div class="dashboard-facebook-right-header-phone">
                                <div class="edit-phone-number">
                                    <label for="phone-number-customer-restaurant" class="" id="phone-number-customer-label" >0983746378</label>
                                    <input data-phone="1" id="phone-number-customer-restaurant" class="d-none" type="text">
                                    <i class="fa fa-pencil" id="icon-pencel-edit-phone-facebook"></i>
                                    <i class="fa fa-check-circle d-none" id="icon-check-edit-phone-facebook"></i>
                                    <i class="fa fa-times-circle d-none" id="icon-close-edit-phone-facebook"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-box-about">
                        <div class="drow-box-about">
                            <div class="opener">
                                <div class="dashboard-facebook-right-option-left">
                                    <em class="fa fa-map-marker"></em>
                                    <span> Địa chỉ </span>
                                </div>
                                <i class="fa fa-plus-circle"></i>
                            </div>
                            <div class="content">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Modi deleniti expedita, nesciunt recusandae. Ea nemo laboriosam esse ducimus veritatis reprehenderit nisi, odio, ratione voluptates incidunt minus aspernatur suscipit
                                officia harum?
                            </div>
                        </div>
                        <div class="drow-box-about" onclick="bookingFacebookList($(this))">
                            <div class="opener">
                                <div class="dashboard-facebook-right-option-left">
                                    <em class="fa fa-shopping-cart"></em>
                                    <span> Đơn hàng </span>
                                </div>
                                <i class="fa fa-plus-circle"></i>
                            </div>
                            <div class="content" id="order-booking-facebook">
                                <div class="item-empty-booking-facebook">
                                    <div class="image-facebook-outsite-content">
                                        <img class="image-empty-outsite-booking-facebook" src='/images/image_facebook/calendar-bro.png' alt="">
                                    </div>
                                    <div class="content-alear-facebook-outsite">
                                        <span class="title-content-facebook-outsite">Opps!, Hiện tại chưa có đơn hàng nào.</span>
                                    </div>
                                </div>
                                <div class="customer-booking-list">
                                </div>
                                <div class="facebook-booking-list">
                                </div>
                                <div id="show-all-booking-about" class="see-all show-all-about-visible d-none" data-type="2">
                                    Xem tất cả
                                </div>
                                <div id="booking-about-celendar-button" class="booking-visible-celendar d-none">
                                    <i class="fa fa-cart-plus icon-booking-celendar-order"></i> Booking
                                </div>
                            </div>
                        </div>
                        <div class="drow-box-about">
                            <div class="opener">
                                <div class="dashboard-facebook-right-option-left">
                                    <em class="fa fa-stack-exchange"></em>
                                    <span> Ghi chú </span>
                                </div>
                                <i class="fa fa-plus-circle"></i>
                            </div>
                            <div class="content">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Modi deleniti expedita, nesciunt recusandae. Ea nemo laboriosam esse ducimus veritatis reprehenderit nisi, odio, ratione voluptates incidunt minus aspernatur suscipit officia
                                harum?
                            </div>
                        </div>
                        <div class="drow-box-about">
                            <div class="opener">
                                <div class="dashboard-facebook-right-option-left">
                                    <em class="fa fa-image"></em>
                                    <span> Ảnh </span>
                                </div>
                                <i class="fa fa-plus-circle"></i>
                            </div>
                            <div class="content">
                                <div class="item-empty-img-booking-facebook">
                                    <div class="image-facebook-outsite-content">
                                        <img class="image-empty-outsite-booking-facebook" src='/images/image_facebook/images-empty.png' alt="">
                                    </div>
                                    <div class="content-alear-facebook-outsite">
                                        <span class="title-content-facebook-outsite">Opps!, Hiện tại chưa có ảnh nào.</span>
                                    </div>
                                </div>
                                <div class="see-list-image-video-grid pb-0" id="data-image-about-visible-message">
                                    <div class="see-item-image-video-grid item-image-about-visible-messages">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-item-image-video-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                        <div class="see-item-image-video-grid-download btn-download-file-upload">
                                            <i class="fa fa-download" data-download="http://172.16.10.85:9007mufZqG3RZwxAPeEbkmefv" data-name-file="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg"></i>
                                        </div>
                                    </div>
                                    <div class="see-item-image-video-grid item-image-about-visible-messages">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-item-image-video-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="anh1.jpg" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                        <div class="see-item-image-video-grid-download btn-download-file-upload">
                                            <i class="fa fa-download" data-download="http://172.16.10.85:9007QbOc1knTcHW2DAuo-QN7n" data-name-file="anh1.jpg"></i>
                                        </div>
                                    </div>
                                    <div class="see-item-image-video-grid item-image-about-visible-messages">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-item-image-video-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="Screenshot 2023-01-02 192722.png" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                        <div class="see-item-image-video-grid-download btn-download-file-upload">
                                            <i class="fa fa-download" data-download="http://172.16.10.85:9007lW6e81YThcJ1b9jqY4i-W" data-name-file="Screenshot 2023-01-02 192722.png"></i>
                                        </div>
                                    </div>
                                    <div class="see-item-image-video-grid item-image-about-visible-messages">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-item-image-video-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="Screenshot 2022-12-31 094624.png" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                        <div class="see-item-image-video-grid-download btn-download-file-upload">
                                            <i class="fa fa-download" data-download="http://172.16.10.85:9007xe8qkyL-sQirk-Q8GmgNC" data-name-file="Screenshot 2022-12-31 094624.png"></i>
                                        </div>
                                    </div><div class="see-item-image-video-grid item-image-about-visible-messages">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-item-image-video-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="Screenshot 2023-01-02 192722.png" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                        <div class="see-item-image-video-grid-download btn-download-file-upload">
                                            <i class="fa fa-download" data-download="http://172.16.10.85:9007c5kghkyGsjwkF_pAREwJ-" data-name-file="Screenshot 2023-01-02 192722.png"></i>
                                        </div>
                                    </div><div class="see-item-image-video-grid item-image-about-visible-messages">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-item-image-video-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                        <div class="see-item-image-video-grid-download btn-download-file-upload">
                                            <i class="fa fa-download" data-download="http://172.16.10.85:9007kh0Vcg78dCSNl_KCOeuAA" data-name-file="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg"></i>
                                        </div>
                                    </div>
                                </div>
                                <div id="show-all-image-about" class="see-all show-all-about-visible" data-type="2">
                                    Xem tất cả
                                </div>
                            </div>
                        </div>
                        <div class="drow-box-about">
                            <div class="opener">
                                <div class="dashboard-facebook-right-option-left">
                                    <em class="fa fa-image"></em>
                                    <span> Video </span>
                                </div>
                                <i class="fa fa-plus-circle"></i>
                            </div>
                            <div class="content">
                                <div class="item-empty-img-booking-facebook">
                                    <div class="image-facebook-outsite-content">
                                        <img class="image-empty-outsite-booking-facebook" src='/images/image_facebook/images-empty.png' alt="">
                                    </div>
                                    <div class="content-alear-facebook-outsite">
                                        <span class="title-content-facebook-outsite">Opps!, Hiện tại chưa có video nào.</span>
                                    </div>
                                </div>
                                <div class="see-list-image-video-grid pb-0" id="data-image-about-visible-message">
                                    <div class="see-item-image-video-grid item-image-about-visible-messages">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-item-image-video-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                        <div class="see-item-image-video-grid-download btn-download-file-upload">
                                            <i class="fa fa-download" data-download="http://172.16.10.85:9007mufZqG3RZwxAPeEbkmefv" data-name-file="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg"></i>
                                        </div>
                                    </div>
                                    <div class="see-item-image-video-grid item-image-about-visible-messages">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-item-image-video-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="anh1.jpg" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                        <div class="see-item-image-video-grid-download btn-download-file-upload">
                                            <i class="fa fa-download" data-download="http://172.16.10.85:9007QbOc1knTcHW2DAuo-QN7n" data-name-file="anh1.jpg"></i>
                                        </div>
                                    </div>
                                    <div class="see-item-image-video-grid item-image-about-visible-messages">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-item-image-video-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="Screenshot 2023-01-02 192722.png" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                        <div class="see-item-image-video-grid-download btn-download-file-upload">
                                            <i class="fa fa-download" data-download="http://172.16.10.85:9007lW6e81YThcJ1b9jqY4i-W" data-name-file="Screenshot 2023-01-02 192722.png"></i>
                                        </div>
                                    </div>
                                    <div class="see-item-image-video-grid item-image-about-visible-messages">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-item-image-video-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="Screenshot 2022-12-31 094624.png" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                        <div class="see-item-image-video-grid-download btn-download-file-upload">
                                            <i class="fa fa-download" data-download="http://172.16.10.85:9007xe8qkyL-sQirk-Q8GmgNC" data-name-file="Screenshot 2022-12-31 094624.png"></i>
                                        </div>
                                    </div><div class="see-item-image-video-grid item-image-about-visible-messages">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-item-image-video-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="Screenshot 2023-01-02 192722.png" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                        <div class="see-item-image-video-grid-download btn-download-file-upload">
                                            <i class="fa fa-download" data-download="http://172.16.10.85:9007c5kghkyGsjwkF_pAREwJ-" data-name-file="Screenshot 2023-01-02 192722.png"></i>
                                        </div>
                                    </div><div class="see-item-image-video-grid item-image-about-visible-messages">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-item-image-video-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                        <div class="see-item-image-video-grid-download btn-download-file-upload">
                                            <i class="fa fa-download" data-download="http://172.16.10.85:9007kh0Vcg78dCSNl_KCOeuAA" data-name-file="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg"></i>
                                        </div>
                                    </div>
                                </div>
                                <div id="show-all-image-about" class="see-all show-all-about-visible" data-type="2">
                                    Xem tất cả
                                </div>
                            </div>
                        </div>
                        <div class="drow-box-about">
                            <div class="opener">
                                <div class="dashboard-facebook-right-option-left">
                                    <i class="zmdi zmdi-file"></i>
                                    <span> File </span>
                                </div>
                                <i class="fa fa-plus-circle"></i>
                            </div>
                            <div class="content">
                                <div class="item-empty-img-booking-facebook">
                                    <div class="image-facebook-outsite-content">
                                        <img class="image-empty-outsite-booking-facebook" src='/images/image_facebook/images-empty.png' alt="">
                                    </div>
                                    <div class="content-alear-facebook-outsite">
                                        <span class="title-content-facebook-outsite">Opps!, Hiện tại chưa có file nào.</span>
                                    </div>
                                </div>
                                <div class="see-list-file-about-visible-facebook">
                                    <div class="see-item-file-grid item-file-about-visible-facebook">
                                        <div class="group-content-file-facebook">
                                            <div class="group-content-file-facebook-title">
                                                <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-item-file-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                                <div class="title-group-file-facebook">
                                                    <div class="dereption-title-facebook">
                                                        <label for="file-input-facebook-title" class="file-label-facebook-title">
                                                            <span>Lữ 123_Lữ 123_02_01_2023.xls</span>
                                                        </label>
                                                        <input id="file-input-facebook-title" class="d-none" type="file">
                                                    </div>
                                                    <div class="file-size-title-dereption">
                                                        <span>64.67kB</span>
                                                        <span class="day-file-title-dereption"> 5 ngày</span>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="see-item-file-grid-download btn-download-file-upload">
                                                <i class="fa fa-download" data-download="http://172.16.10.85:9007mufZqG3RZwxAPeEbkmefv" data-name-file="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="see-item-file-grid item-file-about-visible-facebook">
                                        <div class="group-content-file-facebook">
                                            <div class="group-content-file-facebook-title">
                                                <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-item-file-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                                <div class="title-group-file-facebook">
                                                    <div class="dereption-title-facebook">
                                                        <label for="file-input-facebook-title" class="file-label-facebook-title">
                                                            <span>Lữ 123_Lữ 123_02_01_2023.xls</span>
                                                        </label>
                                                        <input id="file-input-facebook-title" class="d-none" type="file">
                                                    </div>
                                                    <div class="file-size-title-dereption">
                                                        <span>64.67kB</span>
                                                        <span class="day-file-title-dereption"> 5 ngày</span>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="see-item-file-grid-download btn-download-file-upload">
                                                <i class="fa fa-download" data-download="http://172.16.10.85:9007mufZqG3RZwxAPeEbkmefv" data-name-file="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="see-item-file-grid item-file-about-visible-facebook">
                                        <div class="group-content-file-facebook">
                                            <div class="group-content-file-facebook-title">
                                                <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-item-file-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                                <div class="title-group-file-facebook">
                                                    <div class="dereption-title-facebook">
                                                        <label for="file-input-facebook-title" class="file-label-facebook-title">
                                                            <span>Lữ 123_Lữ 123_02_01_2023.xls</span>
                                                        </label>
                                                        <input id="file-input-facebook-title" class="d-none" type="file">
                                                    </div>
                                                    <div class="file-size-title-dereption">
                                                        <span>64.67kB</span>
                                                        <span class="day-file-title-dereption"> 5 ngày</span>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="see-item-file-grid-download btn-download-file-upload">
                                                <i class="fa fa-download" data-download="http://172.16.10.85:9007mufZqG3RZwxAPeEbkmefv" data-name-file="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="see-item-file-grid item-file-about-visible-facebook">
                                        <div class="group-content-file-facebook">
                                            <div class="group-content-file-facebook-title">
                                                <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-item-file-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                                <div class="title-group-file-facebook">
                                                    <div class="dereption-title-facebook">
                                                        <label for="file-input-facebook-title" class="file-label-facebook-title">
                                                            <span>Lữ 123_Lữ 123_02_01_2023.xls</span>
                                                        </label>
                                                        <input id="file-input-facebook-title" class="d-none" type="file">
                                                    </div>
                                                    <div class="file-size-title-dereption">
                                                        <span>64.67kB</span>
                                                        <span class="day-file-title-dereption"> 5 ngày</span>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="see-item-file-grid-download btn-download-file-upload">
                                                <i class="fa fa-download" data-download="http://172.16.10.85:9007mufZqG3RZwxAPeEbkmefv" data-name-file="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="see-item-file-grid item-file-about-visible-facebook">
                                        <div class="group-content-file-facebook">
                                            <div class="group-content-file-facebook-title">
                                                <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-item-file-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                                <div class="title-group-file-facebook">
                                                    <div class="dereption-title-facebook">
                                                        <label for="file-input-facebook-title" class="file-label-facebook-title">
                                                            <span>Lữ 123_Lữ 123_02_01_2023.xls</span>
                                                        </label>
                                                        <input id="file-input-facebook-title" class="d-none" type="file">
                                                    </div>
                                                    <div class="file-size-title-dereption">
                                                        <span>64.67kB</span>
                                                        <span class="day-file-title-dereption"> 5 ngày</span>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="see-item-file-grid-download btn-download-file-upload">
                                                <i class="fa fa-download" data-download="http://172.16.10.85:9007mufZqG3RZwxAPeEbkmefv" data-name-file="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="show-all-image-about" class="see-all show-all-about-visible" data-type="2">
                                    Xem tất cả
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary dashboard-facebook-right-booking-btn" onclick="openModalCreateBookingTableManage()">
                        <i class="fa fa-cart-plus"></i>
                        <span class="text">Booking</span>
                    </button>
                </div>
                <!-- List booking -->
                <div class="dashboard-facebook-right d-none" id="list-booking-right-bar">
                    <div class="dashboard-facebook-right-header list-booking justify-content-center position-relative">
                        <div class="dashboard-facebook-right-header-close position-absolute">
                            <i class="fa fa-angle-double-left" onclick="closeListBookingRightBar()"></i>
                        </div>
                        <div class="dashboard-facebook-right-header-title">
                            <span>Danh sách booking</span>
                        </div>
                    </div>
                    <ul class="nav nav-tabs md-tabs pb-0" role="tablist">
                        <li class="nav-item about-visible-message-tablist">
                            <a class="nav-link active about-visible-message-nav-link remove-draw-table nav-item-booking" id="" data-toggle="tab" href="#tab-dashboard-facebook-right-waiting-booking" role="tab" aria-expanded="true" data-type="1">Đang xử lý</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item about-visible-message-tablist">
                            <a class="nav-link about-visible-message-nav-link remove-draw-table nav-item-booking" id="" data-toggle="tab" href="#tab-dashboard-facebook-right-complete-booking" role="tab" aria-expanded="false" data-type="2">Hoàn tất</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item about-visible-message-tablist">
                            <a class="nav-link about-visible-message-nav-link remove-draw-table nav-item-booking" id="" data-toggle="tab" href="#tab-dashboard-facebook-right-cancel-booking" role="tab" aria-expanded="false" data-type="3">Đã hủy</a>
                            <div class="slide"></div>
                        </li>
                    </ul>
                    <div class="tab-content mt-0">
                        <div class="tab-pane active" id="tab-dashboard-facebook-right-waiting-booking" role="tabpanel">
                            <div class="dashboard-facebook-right-container" id="dashboard-facebook-right-waiting-booking"></div>
                        </div>
                        <div class="tab-pane" id="tab-dashboard-facebook-right-complete-booking" role="tabpanel">
{{--                            <div class="item-empty-booking-facebook-all-list">--}}
{{--                                <img class="image-empty-booking-facebook" src='/images/image_facebook/calendar-bro.png'alt="">--}}
{{--                            </div>--}}
                            <div class="dashboard-facebook-right-container" id="dashboard-facebook-right-complete-booking"></div>
                        </div>
                        <div class="tab-pane" id="tab-dashboard-facebook-right-cancel-booking" role="tabpanel">
                            <div class="dashboard-facebook-right-container" id="dashboard-facebook-right-cancel-booking"></div>
                        </div>
                    </div>
                </div>
                <!-- List media -->
                <div class="dashboard-facebook-right d-none" id="list-media-right-bar">
                    <div class="dashboard-facebook-right-header list-booking justify-content-center position-relative">
                        <div class="dashboard-facebook-right-header-close position-absolute">
                            <i class="fa fa-angle-double-left" onclick="closeListMediaRightBar()"></i>
                        </div>
                        <div class="dashboard-facebook-right-header-title">
                            <span>Kho lưu trữ</span>
                        </div>
                    </div>
                    <ul class="nav nav-tabs md-tabs pb-0" role="tablist">
                        <li class="nav-item about-visible-message-tablist">
                            <a class="nav-link active about-visible-message-nav-link remove-draw-table nav-item-booking" id="" data-toggle="tab" href="#tab-dashboard-facebook-right-image-media" role="tab" aria-expanded="true" data-type="1">Kho ảnh</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item about-visible-message-tablist">
                            <a class="nav-link about-visible-message-nav-link remove-draw-table nav-item-booking" id="" data-toggle="tab" href="#tab-dashboard-facebook-right-video-media" role="tab" aria-expanded="false" data-type="2">Kho video</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item about-visible-message-tablist">
                            <a class="nav-link about-visible-message-nav-link remove-draw-table nav-item-booking" id="" data-toggle="tab" href="#tab-dashboard-facebook-right-link-media" role="tab" aria-expanded="false" data-type="3"> link</a>
                            <div class="slide"></div>
                        </li>
                    </ul>
                    <div class="tab-content mt-0">
                        <div class="tab-pane active" id="tab-dashboard-facebook-right-image-media" role="tabpanel">
                            <div class="see-detail-list-all-image-video-grid pb-0" id="data-image-about-visible-message">
                                <div class="see-detail-all-item-image-video-grid item-image-about-visible-messages">
                                    <div class="see-detail-all-item-image-video-grid-img">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-detail-all-item-video-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                        <div class="see-detail-all-item-image-video-grid-download btn-download-file-upload">
                                            <i class="fa fa-download" data-download="http://172.16.10.85:9007mufZqG3RZwxAPeEbkmefv" data-name-file="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="see-detail-all-item-image-video-grid item-image-about-visible-messages">
                                    <div class="see-detail-all-item-image-video-grid-img">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-detail-all-item-video-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                        <div class="see-detail-all-item-image-video-grid-download btn-download-file-upload">
                                            <i class="fa fa-download" data-download="http://172.16.10.85:9007mufZqG3RZwxAPeEbkmefv" data-name-file="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="see-detail-all-item-image-video-grid item-image-about-visible-messages">
                                    <div class="see-detail-all-item-image-video-grid-img">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-detail-all-item-video-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                        <div class="see-detail-all-item-image-video-grid-download btn-download-file-upload">
                                            <i class="fa fa-download" data-download="http://172.16.10.85:9007mufZqG3RZwxAPeEbkmefv" data-name-file="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="see-detail-all-item-image-video-grid item-image-about-visible-messages">
                                    <div class="see-detail-all-item-image-video-grid-img">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-detail-all-item-video-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                        <div class="see-detail-all-item-image-video-grid-download btn-download-file-upload">
                                            <i class="fa fa-download" data-download="http://172.16.10.85:9007mufZqG3RZwxAPeEbkmefv" data-name-file="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="see-detail-all-item-image-video-grid item-image-about-visible-messages">
                                    <div class="see-detail-all-item-image-video-grid-img">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-detail-all-item-video-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                        <div class="see-detail-all-item-image-video-grid-download btn-download-file-upload">
                                            <i class="fa fa-download" data-download="http://172.16.10.85:9007mufZqG3RZwxAPeEbkmefv" data-name-file="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="see-detail-all-item-image-video-grid item-image-about-visible-messages">
                                    <div class="see-detail-all-item-image-video-grid-img">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-detail-all-item-video-grid-img" src="/images/tms/default.jpeg" data-link-original="/images/tms/default.jpeg" data-name="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                        <div class="see-detail-all-item-image-video-grid-download btn-download-file-upload">
                                            <i class="fa fa-download" data-download="http://172.16.10.85:9007mufZqG3RZwxAPeEbkmefv" data-name-file="z4003386661599_2e23460a5d012d21f3a86c597d09b065.jpg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dashboard-facebook-right-container" id="dashboard-facebook-right-image-media">

                            </div>
                        </div>
                        <div class="tab-pane" id="tab-dashboard-facebook-right-video-media" role="tabpanel">
{{--                            <div class="item-empty-booking-facebook-all-list">--}}
{{--                                <img class="image-empty-booking-facebook" src='/images/image_facebook/calendar-bro.png'alt="">--}}
{{--                            </div>--}}
                            <div class="dashboard-facebook-right-container" id="dashboard-facebook-right-video-media"></div>
                        </div>
                        <div class="tab-pane" id="tab-dashboard-facebook-right-link-media" role="tabpanel">
                            <div class="dashboard-facebook-right-container" id="dashboard-facebook-right-link-media"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sell_online.facebook.connect.booking')
    @include('manage.booking_table.detail')
    @include('manage.booking_table.confirm_table')
    @include('manage.booking_table.create')
    @include('manage.booking_table.gift')
    @include('manage.booking_table.update')
    @include('manage.booking_table.gift_update')
    @include('marketing.gift.gift.detail')
    @include('manage.food.brand.detail')

@endsection
@push('scripts')
    <script type="text/javascript" src="{{asset('js/sell_online/facebook/messenger.js?version=81', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript" src="{{asset('js/sell_online/facebook/chat-manage.js?version=81', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript" src="{{asset('js/sell_online/facebook/input.js?version=81', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript" src="{{asset('js/sell_online/facebook/test-style.js?version=81', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="/path/to/jquery.mCustomScrollbar.concat.min.js"></script>
    <script>
        (function (timer) {
            window.addEventListener("load", function () {
                var el = document.querySelector(".dashboard-facebook-body-chat");
                el.addEventListener("scroll", function (e) {
                    (function (el) {
                        el.classList.add("scroll");
                        clearTimeout(timer);
                        timer = setTimeout(function () {
                            el.classList.remove("scroll");
                        }, 1000);
                    })(el);
                });
            });
        })();
        $(function(){
            $(document).on('click', '.item-test-1', function(){
                $('#data-message-visible-message-facebook').html(` <div class="chat-body-message-element message-right">
                                                                                          <div class="chat-body-message">
                                                                                              <div class="chat-body-message-text">Xin chào! Mình có thể giúp gì cho bạn</div>
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
                                                                                                  <span class="time-message-ago">Vừa xong</span>
                                                                                              </div>
                                                                                          </div>
                                                                                      </div>
                                                                                  <!-- Tin nhắn text -->
                                                                                  <div class="chat-body-message-element message-right">
                                                                                      <div class="chat-body-message">
                                                                                          <div class="chat-body-message-image">
                                                                                              <div class="gallery__item">
                                                                                                  <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" data-name="" src="blob:http://127.0.0.1:8000/6fd8171c-f3af-4d2a-8ad9-667a7c3d6b5b" alt="Hình ảnh" class="gallery__image" loading="lazy" />
                                                                                              </div>
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
                                                                                              <span class="time-message-ago" data-time="19/09/2022 10:18:33">10:18</span>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>
                                                                                  <!-- Tin nhắn ảnh -->
                                                                                  <div class="chat-body-message-element message-right">
                                                                                      <div class="chat-body-message">
                                                                                          <div class="chat-body-message-image">
                                                                                              <div class="wrapper five-image">
                                                                                                  <div class="gallery">
                                                                                                      <div class="gallery__item gallery__item--1">
                                                                                                          <a href="javascript:void(0)" class="gallery__link">
                                                                                                              <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" data-name="" src="blob:http://127.0.0.1:8000/68f9d459-6772-424e-ac97-42c9e775cf86" alt="Hình ảnh" class="gallery__image" loading="lazy" />
                                                                                                          </a>
                                                                                                      </div>
                                                                                                      <div class="gallery__item gallery__item--2">
                                                                                                          <a href="javascript:void(0)" class="gallery__link">
                                                                                                              <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" data-name="" src="blob:http://127.0.0.1:8000/4889a708-bf4d-4750-99be-24ae393afc31" alt="Hình ảnh" class="gallery__image" loading="lazy" />
                                                                                                          </a>
                                                                                                      </div>
                                                                                                      <div class="gallery__item gallery__item--3">
                                                                                                          <a href="javascript:void(0)" class="gallery__link">
                                                                                                              <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" data-name="" src="blob:http://127.0.0.1:8000/56d3802e-78b8-4517-a498-f3f19238b10e" alt="Hình ảnh" class="gallery__image" loading="lazy" />
                                                                                                          </a>
                                                                                                      </div>
                                                                                                      <div class="gallery__item gallery__item--4">
                                                                                                          <a href="javascript:void(0)" class="gallery__link">
                                                                                                              <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" data-name="" src="blob:http://127.0.0.1:8000/8d9a2af8-50fe-4c20-9601-364688897867" alt="Hình ảnh" class="gallery__image" loading="lazy" />
                                                                                                          </a>
                                                                                                      </div>
                                                                                                      <div class="gallery__item gallery__item--5">
                                                                                                          <a href="javascript:void(0)" class="gallery__link">
                                                                                                              <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" data-name="" src="blob:http://127.0.0.1:8000/a4788156-dc6f-4899-b0fe-55874144086c" alt="Hình ảnh" class="gallery__image" loading="lazy" />
                                                                                                              <div class="more-photos">
                                                                                                                  <span> + 1<span></span></span>
                                                                                                              </div>
                                                                                                          </a>
                                                                                                      </div>
                                                                                                  </div>
                                                                                              </div>
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
                                                                                              <span class="time-message-ago" data-time="19/09/2022 10:20:57">10:20</span>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>
                                                                                  <!-- Tin nhắn nhiều ảnh -->
                                                                                  <div class="chat-body-message-element message-right">
                                                                                      <div class="chat-body-message">
                                                                                          <div class="chat-body-message-sticker">
                                                                                              <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="http://172.16.2.255:1488/public/stickers/emo-cat/19.gif" alt="Sticker" />
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
                                                                                  <!-- Tin nhắn sticker -->
                                                                                  <div class="notify-message-container">
                                                                                      <div class="line"></div>
                                                                                      <div class="notify-message-content" style="padding: 0 10px; background-color: #39393966; color: #fff;">
                                                                                          <span class="notify-message-text-date">22:19 17/09/2022</span>
                                                                                      </div>
                                                                                      <div class="line"></div>
                                                                                  </div>`)
                $('#dashboard-facebook-body-head-pin-mess').addClass('d-none');
            });

            $(document).on('click', '.item-test-2', function(){
                $('.body-visible-message').addClass('column-flex');
                $('#dashboard-facebook-body-head-pin-mess').removeClass('d-none');
                $('#data-message-visible-message-facebook').html(` <div class="section-comment-message">
                            <div class="section-comment-message-main chat-of-me">
                                <div class="section-comment-message-main-contain">
                                    <img
                                        src="https://scontent.fsgn4-1.fna.fbcdn.net/v/t39.30808-1/294102246_460159019452993_2269469935191696902_n.png?stp=cp0_dst-png_p40x40&_nc_cat=103&ccb=1-7&_nc_sid=c6021c&_nc_ohc=ejHxDeachWUAX-ZIkLj&_nc_ht=scontent.fsgn4-1.fna&oh=00_AT9ODIF2hGjbbslJ1C3ZsLZSn_wO21z9vZpOjAcUp4XS9A&oe=632DA9E6"
                                        alt=""
                                        class="section-comment-message-avatar-main"
                                    />
                                    <div class="section-comment-message-info">
                                        <div class="section-comment-message-info-name">TechresTest</div>
                                        <div class="section-comment-message-info-text">Bạn ib để biết thêm chi tiết</div>
                                        <ul class="section-comment-message-info-tool">
                                            <li class="section-comment-message-info-tool-item" data-toggle="tooltip" data-placement="top" data-original-title="Phản hồi">
                                                <i class="fa fa-reply"></i>
                                            </li>
                                            <li class="section-comment-message-info-tool-item" data-toggle="tooltip" data-placement="top" data-original-title="Thích">
                                                <i class="icofont icofont-like"></i>
                                            </li>
                                            <li class="section-comment-message-info-tool-item" data-toggle="tooltip" data-placement="top" data-original-title="Ẩn bình luận">
                                                <i class="fa fa-eye-slash"></i>
                                            </li>
                                            <li class="section-comment-message-info-tool-item" data-toggle="tooltip" data-placement="top" data-original-title="Xóa bình luận">
                                                <i class="fa fa-trash"></i>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="section-comment-message-reply">
                                <img src="https://scontent.fsgn3-1.fna.fbcdn.net/v/t39.30808-6/295416377_1302926200114917_115913191480108096_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=yTKMZekiR0YAX9vJv-1&tn=NyLKFDonsjU_1xQt&_nc_ht=scontent.fsgn3-1.fna&oh=00_AfBJcKQdNE1n1-MklF0hzeEedGsE6wiFN4kOjKxwgH4jJA&oe=63B94F7F" alt="" class="section-comment-message-avatar-reply" />
                                <div class="section-comment-message-info" style="background:#E2F1FA ">
                                    <div class="section-comment-message-info-name">Nguyễn Huy Dũng</div>
                                    <div class="section-comment-message-info-text">Dạ. E ib r ạ</div>
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
                                      <span class="time-message-ago">Vừa xong</span>
                                  </div>
                                </div>
                            </div>
                            <div class="section-comment-message-reply">
                                <img
                                    src="https://scontent.fsgn3-1.fna.fbcdn.net/v/t39.30808-6/295416377_1302926200114917_115913191480108096_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=yTKMZekiR0YAX9vJv-1&tn=NyLKFDonsjU_1xQt&_nc_ht=scontent.fsgn3-1.fna&oh=00_AfBJcKQdNE1n1-MklF0hzeEedGsE6wiFN4kOjKxwgH4jJA&oe=63B94F7F"
                                    alt=""
                                    class="section-comment-message-avatar-reply"
                                />
                                <div class="section-comment-message-image-info" >
                                    <div class="group-comment-image-facebook-chat" style="width: 130px; height: 130px; border-radius: 5px">
                                        <div class="comment-body-chat-header-facebook" >
                                           <div class="section-comment-message-info-name">Nguyễn Huy Dũng</div>
                                        </div>
                                        <div class="body-image-comment-chat-facebook" style="display:flex; justify-content: center; align-items: center;">
                                            <img src="/images/tms/default.jpeg" alt="" class="section-comment-message-image-reply" style=" width: 65%; height: auto; border-radius: 4px;" />
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
                                      <span class="time-message-ago">18:30</span>
                                  </div>
                                    </div>
                                </div>
                            </div>
                        </div>`);
            });

        })

        //    dropdown
        $(document).on('click', '.opener', function(){
            $(this).parent().find('.content').toggleClass('content-active');
            $(this).find('.fa.fa-plus-circle').toggleClass('rotate');
        });

        $(document).on('click', '.section-comment-message-info-tool-item', function(){
            $('.section-comment-message-main').append(`<div class="section-comment-message-info-reply-input">
                                                    <input type="text" placeholder="Nhập tin nhắn..." value="@TechresTest "/>
                                                    <div class="section-comment-message-info-reply-input-tool">
                                                        <i class="fa fa-smile-o"></i>
                                                        <i class="fa fa-camera"></i>
                                                    </div>
                                                </div>`)
        });

    </script>
@endpush
