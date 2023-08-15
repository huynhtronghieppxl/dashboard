<style>
    .popup-wraper7.active {
        -webkit-opacity: 1;
        -moz-opacity: 1;
        -ms-opacity: 1;
        -o-opacity: 1;
        opacity: 1;
        visibility: visible;
    }

    .popup-wraper7 {
        background: rgba(0, 0, 0, 0.8) none repeat scroll 0 0;
        height: 100%;
        top: 0;
        left: 0;
        position: fixed;
        width: 100%;
        z-index: 99999;
        -webkit-opacity: 0;
        -moz-opacity: 0;
        -ms-opacity: 0;
        -o-opacity: 0;
        opacity: 0;
        visibility: hidden;
        transition: all 0.25s linear 0s;
    }

    .popup.login {
        border-radius: 8px;
        width: 350px;
    }

    .popup {
        background: #fff none repeat scroll 0 0;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        -ms-border-radius: 5px;
        -o-border-radius: 5px;
        border-radius: 5px;
        left: 50%;
        padding: 12px 20px;
        position: absolute;
        top: 40%;
        -webkit-transform: translate(-50%, -50%);
        -moz-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        -o-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        width: 650px;
    }

    .popup-closed {
        cursor: pointer;
        font-size: 15px;
        position: absolute;
        right: 18px;
        top: 15px;
        z-index: 9;
    }

    .popup-closed > i {
        line-height: initial;
    }

    [class*=" icofont-"] {
        speak: none;
        font-style: normal;
        font-weight: 400;
        font-variant: normal;
        text-transform: none;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .popup-meta {
        display: inline-block;
        width: 100%;
    }

    .popup-head {
        border-bottom: 1px solid #dedede;
        display: inline-block;
        padding-bottom: 10px;
        width: 100%;
    }

    .popup-head > h5 {
        color: #515365;
        display: inline-block;
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 0;
        margin-top: 0;
        width: 100%;
    }

    .login-frm {
        display: inline-block;
        margin-top: 20px;
        width: 100%;
    }

    .validation-auth {
        margin-top: -5px;
        padding-left: 10px;
        color: #dd4b39;
        margin-bottom: 5px;
        font-size: 12px;
    }

    .login-frm > input {
        background: #edf2f6 none repeat scroll 0 0;
        border: medium none;
        border-radius: 30px;
        font-size: 13px;
        margin: 5px 0;
        padding: 10px 15px;
        width: 100%;
    }

    .form-control.form-control-solid {
        background-color: #F3F6F9;
        border-color: #F3F6F9;
        color: #3F4254;
        transition: color 0.15s ease, background-color 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease;
    }

    .login-frm div > input {
        background: #edf2f6 none repeat scroll 0 0;
        border: medium none;
        border-radius: 30px;
        font-size: 13px;
        margin: 5px 0;
        padding: 10px 15px;
        width: 100%;
    }

    input[type=number] {
        -moz-appearance: textfield;
        padding: 0 !important;
    }

    .timeline-info > ul li a::before, .add-btn > a, .activitiez > li::before, form button, a.underline:before, .setting-row input:checked + label, .user-avatar:hover .edit-phto, .add-butn, .nav.nav-tabs.likes-btn > li a.active, a.dislike-btn, .drop > a:hover, .btn-view.btn-load-more:hover, .accordion .card h5 button[aria-expanded="true"], .f-page > figure em, .inbox-panel-head > ul > li > a, footer .widget-title h4::before, #topcontrol, .sidebar .widget-title::before, .g-post-classic > figure > i::after, .purify > a, .open-position::before, .info > a, a.main-btn, .section-heading::before, .more-branches > h4::before, .is-helpful > a, .cart-optionz > li > a:hover, .paginationz > li a:hover, .paginationz > li a.active, .shopping-cart, a.btn2:hover, .form-submit > input[type="submit"], button.submit-checkout, .delete-cart:hover, .proceed .button, .amount-area .update-cart, a.addnewforum, .attachments li.preview-btn button:hover, .new-postbox .post-btn:hover, .weather-date > span, a.learnmore, .banermeta > a:hover, .add-remove-frnd > li a:hover, .profile-controls > li > a:hover, .edit-seting:hover, .edit-phto:hover, .account-delete > div > button:hover, .radio .check-box::after, .eror::after, .eror::before, .big-font, .event-time .main-btn:hover, .group-box > button:hover, .dropcap-head > .dropcap, .checkbox .check-box::after, .checkbox .check-box::before, .main-btn2:hover, .main-btn3:hover, .jalendar .jalendar-container .jalendar-pages .add-event .close-button, .jalendar .jalendar-container .jalendar-pages .days .day.have-event span::before, .user-log > i:hover, .total > i, .login-frm .main-btn, .search-tab .nav-tabs .nav-item > a.active::after, .mh-head, .job-tgs > a:hover, .owl-prev:hover:before, .owl-next:hover:before, .help-list > a, .title2::before, .fun-box > i, .list-style > li a:hover:before, .postbox .we-video-info > button:hover, .postbox .we-video-info > button.main-btn.color, .copy-email > ul li a:hover, .post-status > ul li:hover, .tags_ > a:hover, .policy .nav-link.active::before, a.circle-btn:hover, .mega-menu > li:hover > a > span, .pit-tags > a:hover, .create-post::before, .amount-select > li:hover, .amount-select > li.active, .pay-methods > li:hover, .pay-methods > li.active, .msg-pepl-list .nav-item.unread::before, .menu .btn:hover, .menu-item-has-children ul.submenu > li a::before, .pagination > li a:hover, .pagination > li a.active, .slick-dots li button, .slick-prev:hover:before, .slick-next:hover:before, .sub-popup::before, .sub-popup::after, a.date, .welcome-area > h2::before, .page-header.theme-bg, .nav.nav-tabs.trend li a, .btn.btn-default, .prod-detail .full-postmeta .shopnow:hover, .extras > a.play-btn, .sugtd-frnd-meta .send-invitation, .user-profile .join-btn {
        background: #fa6342;
    }

    .login-frm .main-btn {
        border: medium none;
        border-radius: 30px;
        color: #fff;
        font-size: 14px;
        font-weight: 500;
        margin-top: 16px !important;
        margin-bottom: 4px;
        padding: 8px 10px;
        width: 100%;
        outline: none;
        background-color: #ffa233 !important;
    }

    .login-frm div > span.fa {
        position: absolute;
        right: 30px;
        margin-top: 15px;
    }

    .fa-fw {
        width: 1.28571429em;
        text-align: center;
    }

    .fa {
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .flex {
        display: flex;
    }

    .m-2 {
        margin: 0.5rem !important;
    }

    .rounded {
        border-radius: 0.25rem !important;
    }

    button, input, optgroup, select, textarea {
        padding: 0;
        line-height: inherit;
        color: inherit;
    }

    .d-none {
        display: none;
    }

    .form-forgot-password-icon {
        width: 100%;
        height: 100px;
        background-color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 8px 0 26px 0!important;
    }

    .form-forgot-password-icon i {
        font-size: 100px;
        color: #ffa233;
    }

    .form-forgot-password-img {
        width: 100%;
        height: 100px;
        background-color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 8px;
    }

    .form-forgot-password-img img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }

    .form-control.form-control-solid {
        background-color: #f3f6f9;
        border: 1px solid #dfdfdf;
        color: #e97f00;
        transition: color 0.15s ease, background-color 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease;
        width: calc(100% / 4);
        height: 69px;
        margin: 12px 4px;
        font-size: 35px !important;
        font-weight: 500;
    }
</style>

<div class="popup-wraper7 seemt-main-content" id="popup-forgot-password-auth" style="z-index: 99">
    <div class="popup login">
        <span class="popup-closed"><i class="icofont icofont-ui-close"></i></span>
        <div class="popup-meta">
            <div class="popup-head">
                <h5>Quên mật khẩu ?</h5>
            </div>
            <div class="login-frm" id="form-forgot-password-step-one">
                <div class="form-forgot-password-icon">
                    <i class="icofont icofont-ui-lock"></i>
                </div>
                <div class="validation-auth validation-auth-forgot-password-server text-center d-none"></div>
                <input class="restaurant" type="text" placeholder="Tên Công ty/Nhà hàng" autocomplete="off">
                <input class="user-name" type="text" placeholder="Tên tài khoản" autocomplete="off">
                <div class="validation-auth validation-auth-user-name d-none">Vui lòng nhập đầy đủ thông tin</div>
                <button data-ripple="" type="submit" class="main-btn" style="margin-top: 5px">Gửi</button>
            </div>
            <div class="login-frm d-none" id="form-forgot-password-step-two">
                <div class="mb-6 text-center">
                    <div class="form-forgot-password-img">
                        <img src="https://developer.supplier.vn/images/supplier/message.gif" alt="">
                    </div>
                    <span>Mã OTP đã được gửi về số điện thoại (<span id="time-step-two-forgot-password">60</span>)</span><br>
                    <a href="javascript:void(0)" id="send-step-two-forgot-password" class="d-none" style="color: #fa6342;">Gửi lại</a>
                    <div id="otp-forgot-password" class="flex justify-center">
                        <input class="m-2 text-center form-control form-control-solid rounded focus:border-blue-400 focus:shadow-outline" type="number" id="first" maxlength="1" autocomplete="off">
                        <input class="m-2 text-center form-control form-control-solid rounded focus:border-blue-400 focus:shadow-outline" type="number" id="second" maxlength="1" autocomplete="off">
                        <input class="m-2 text-center form-control form-control-solid rounded focus:border-blue-400 focus:shadow-outline" type="number" id="third" maxlength="1" autocomplete="off">
                        <input class="m-2 text-center form-control form-control-solid rounded focus:border-blue-400 focus:shadow-outline" type="number" id="fourth" maxlength="1" autocomplete="off">
                    </div>
                    <label class="label label-danger text-center alert-caplock-password d-none">@lang('modules.employee.caplock')</label>
                    <div>
                        <input class="password pwd-frm" type="password" placeholder="Mật khẩu" data-min-length="4" data-max-length="50">
                        <span class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                    </div>
                    <div class="validation-auth validation-auth-password d-none">Vui lòng nhập mật khẩu (4-8 ký tự)
                    </div>
                    <div>
                        <input class="verify-password pwd-frm" type="password" placeholder="Nhập lại mật khẩu" data-min-length="4" data-max-length="50" >
                        <span class="fa fa-fw fa-eye-slash field-icon toggle-verify-password"></span>
                    </div>
                    <div class="validation-auth validation-auth-verify-password d-none">Nhập lại mật khẩu không khớp
                    </div>
                    <div class="validation-auth validation-auth-two-forgot-password-server d-none"></div>
                    <button data-ripple="" type="submit" class="main-btn" style="margin-top: 5px">Gửi</button>
                </div>
            </div>
        </div>
    </div>
</div>
