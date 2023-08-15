<style>
    #popup-template-layout.popup-wraper5.active {
        -moz-opacity: 1;
        opacity: 1;
        visibility: visible;
    }

    #popup-template-layout.popup-wraper5 {
        background: rgba(0, 0, 0, 0.8) none repeat scroll 0 0;
        height: 100%;
        left: 0;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 99999;
        -moz-opacity: 0;
        opacity: 0;
        visibility: hidden;
        transition: all 0.25s linear 0s;
    }

    #popup-template-layout .popup {
        background: #fff none repeat scroll 0 0;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        left: 50%;
        padding: 20px;
        position: absolute;
        top: 50%;
        -webkit-transform: translate(-50%, -50%);
        -moz-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        -o-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        width: 650px;
    }

    #popup-template-layout .popup-meta {
        display: inline-block;
        width: 100%;
    }

    #popup-template-layout .sec-heading {
        display: inline-block;
        margin-bottom: 50px;
        width: 100%;
    }

    #popup-template-layout .sec-heading.style9 > span {
        font-size: 12px;
        text-transform: capitalize;
    }

    #popup-template-layout .product-carousel .owl-nav .owl-prev::before,
    #popup-template-layout .product-carousel .owl-nav .owl-next::before,
    #popup-template-layout .product-caro .owl-prev:hover:before,
    #popup-template-layout .product-caro .owl-next:hover:before,
    #popup-template-layout .log-reg-area form .forgot-pwd,
    #popup-template-layout .log-reg-area form .already-have,
    #popup-template-layout .log-reg-area > p a,
    #popup-template-layout .timeline-info > ul li a.active,
    #popup-template-layout .timeline-info > ul li a:hover,
    #popup-template-layout .dropdowns > a.more-mesg,
    #popup-template-layout .activity-meta > h6 a,
    #popup-template-layout .activity-meta > span a:hover,
    #popup-template-layout .description > p a,
    #popup-template-layout .we-comment > p a,
    #popup-template-layout .sidebar .widget li:hover > a,
    #popup-template-layout .sidebar .widget li:hover > i,
    #popup-template-layout .friend-meta > a,
    #popup-template-layout .user-setting > a:hover,
    #popup-template-layout .we-comet li a.showmore,
    #popup-template-layout .twiter-feed > li p a,
    #popup-template-layout .tutor-links > li i,
    #popup-template-layout .tutor-links > li:hover,
    #popup-template-layout .pepl-info > span,
    #popup-template-layout .frnds .nav-tabs .nav-item a.active,
    #popup-template-layout #work > div a,
    #popup-template-layout .basics > li i,
    #popup-template-layout .education > li i,
    #popup-template-layout .groups > span i,
    #popup-template-layout a.forgot-pwd,
    #popup-template-layout .friend-meta > h4 a:hover,
    #popup-template-layout .x_title > h2,
    #popup-template-layout .post-meta .detail > span,
    #popup-template-layout .add-btn > a:hover,
    #popup-template-layout .top-area > ul.main-menu > li > ul li a:hover,
    #popup-template-layout .dropdowns.active > a i,
    #popup-template-layout .form-group input.form-file ~ .control-label,
    #popup-template-layout .form-group input.has-value ~ .control-label,
    #popup-template-layout .form-group input:focus ~ .control-label,
    #popup-template-layout .form-group input:valid ~ .control-label,
    #popup-template-layout .form-group select ~ .control-label,
    #popup-template-layout .form-group textarea.form-file ~ .control-label,
    #popup-template-layout .form-group textarea.has-value ~ .control-label,
    #popup-template-layout .form-group textarea:focus ~ .control-label,
    #popup-template-layout .form-group textarea:valid ~ .control-label,
    #popup-template-layout .flaged > h3,
    #popup-template-layout .invition .friend-meta a.invite:hover,
    #popup-template-layout .more-optns > ul li:hover,
    #popup-template-layout .post-title > h4 a:hover,
    #popup-template-layout .post-title .p-date a:hover, #popup-template-layout .l-post .l-post-meta > h4 a:hover, #popup-template-layout .read:hover, #popup-template-layout .tags > a:hover, #popup-template-layout .comment-titles > span, #popup-template-layout .help-list > ul li a:hover i, #popup-template-layout .carrer-title > span a, #popup-template-layout .open-position > h4 a:hover, #popup-template-layout .option-set.icon-style > li > a.selected, #popup-template-layout .category-box > i, #popup-template-layout .branches-box > ul li i, #popup-template-layout .help-topic-result > h2 a:hover, #popup-template-layout .product-name > h5 a:hover, #popup-template-layout .full-postmeta .shopnow, #popup-template-layout .prices.style2 ins span, #popup-template-layout .single-btn > li > a.active, #popup-template-layout .total-box > ul > li.final-total, #popup-template-layout .logout-meta > p a, #popup-template-layout .forum-list table tbody tr td i, #popup-template-layout .widget ul.recent-topics > li > i, #popup-template-layout .date-n-reply > a, #popup-template-layout .topic-data > span, #popup-template-layout .help-list > ul li a:hover, #popup-template-layout .employer-info h2, #popup-template-layout .job-detail > ul li i, #popup-template-layout .company-intro > a, #popup-template-layout .user-setting > ul li a:hover i, #popup-template-layout .your-page ul.page-publishes > li span:hover i, #popup-template-layout .drops-menu > li > a:hover .mesg-meta h6, #popup-template-layout .we-comment > h5:hover, #popup-template-layout .inline-itms > a:hover, #popup-template-layout .mesg-meta figure span, #popup-template-layout .like-dislike > li a:hover, #popup-template-layout .we-video-info > ul li .users-thumb-list > span strong, #popup-template-layout .we-video-info > ul li .users-thumb-list > span a, #popup-template-layout .add-del-friends > a:hover, #popup-template-layout .story-box:hover .story-thumb > i, #popup-template-layout .sugtd-frnd-meta > span > a, #popup-template-layout .sugtd-frnd-meta > a:hover, #popup-template-layout .create-post > a, #popup-template-layout .mesg-meta > h6 > a:hover, #popup-template-layout .profile-menu > li > a:hover, #popup-template-layout .profile-menu > li > a.active, #popup-template-layout .friend-name > ins > a, #popup-template-layout .more-post-optns > ul > li:hover, #popup-template-layout .more-post-optns > ul > li:hover i, #popup-template-layout .origin-name > a, #popup-template-layout .breadcrumb > .breadcrumb-item, #popup-template-layout .nav-tabs--left .nav-link.active, #popup-template-layout .nav-tabs--left .nav-link.active:hover, #popup-template-layout .set-title > span a, #popup-template-layout .onoff-options .setting-row > p > a, #popup-template-layout .checkbox > p a, #popup-template-layout .notifi-seting > p a, #popup-template-layout .page-likes .tab-content .tab-pane > a, #popup-template-layout .personal-head > p a, #popup-template-layout .f-title i, #popup-template-layout .more-opotnz > ul li a:hover, #popup-template-layout .frnd-name > a:hover, #popup-template-layout .option-list ul li a:hover, #popup-template-layout .option-list ul li i, #popup-template-layout .smal-box .fileContainer > i, #popup-template-layout .from-gallery > i, #popup-template-layout .over-photo > a:hover i, #popup-template-layout .featurepost > h5 > i, #popup-template-layout .widget .fav-community > li a, #popup-template-layout .radio input:checked ~ .check-box::before, #popup-template-layout .suggestd > li .sug-like:hover i, #popup-template-layout .gen-metabox > p > a, #popup-template-layout .widget .invitepage > li > a i, #popup-template-layout .see-all, #popup-template-layout .event-title > h4 a:hover, #popup-template-layout .event-date, #popup-template-layout .location-map > p, #popup-template-layout .event-title > span i, #popup-template-layout .typography > a, #popup-template-layout .main-btn2, #popup-template-layout .main-btn, #popup-template-layout a.main-btn2, #popup-template-layout blockquote p strong, #popup-template-layout .dob-meta > h6 a, #popup-template-layout .recent-jobs li > span a, #popup-template-layout .recent-jobs li h6 span, #popup-template-layout .position-meta > span, #popup-template-layout .invite-location > span, #popup-template-layout .invite-figure > h6 > a, #popup-template-layout .user-add > div > i, #popup-template-layout .logout-form > p > a, #popup-template-layout .logout-form > a, #popup-template-layout .login-frm > a, #popup-template-layout .c-form.search .radio > a, #popup-template-layout .frnd-meta > a, #popup-template-layout .notifi-meta > span > i, #popup-template-layout .card-body a, #popup-template-layout .search-meta > span i, #popup-template-layout .pit-frnz-meta > a:hover, #popup-template-layout .pit-groups-meta > a:hover, #popup-template-layout .pit-pages-meta > a:hover, #popup-template-layout .related-searches > li > a:hover, #popup-template-layout .wiki-box > h4 > a, #popup-template-layout .wiki-box > p > a, #popup-template-layout .p-info > a, #popup-template-layout .widget .reg-comp-meta > ul > li a, #popup-template-layout .re-links-meta > h6 > a:hover, #popup-template-layout .pitnik-video-help > i, #popup-template-layout h3.resutl-found > span, #popup-template-layout .related-links > li > a:hover, #popup-template-layout .attachments > ul .add-loc > i, #popup-template-layout .colla-apps > li a:hover, #popup-template-layout .add-location-post > span, #popup-template-layout footer .widget .colla-apps > li a:hover, #popup-template-layout .list-style > li a:hover, #popup-template-layout .page-meta > a:hover, #popup-template-layout .add-pitrest > a, #popup-template-layout .pitrest-pst-hding:hover, #popup-template-layout .fa.fa-heart.like, #popup-template-layout .log-out > li:last-child a, #popup-template-layout .log-out > li:last-child a i, #popup-template-layout .loc-cate > ul.loc > li i, #popup-template-layout .loc-cate > ul > li a, #popup-template-layout .loc-cate > ul > li::before, #popup-template-layout .job-price > ins, #popup-template-layout .users-thumb-list > span > a, #popup-template-layout .we-video-info > ul li span:hover, #popup-template-layout .we-video-info .heart:hover, #popup-template-layout .job-search-form > a, #popup-template-layout .user-figure > a, #popup-template-layout .user-info > li span, #popup-template-layout .main-color, #popup-template-layout .pit-points > i, #popup-template-layout .menu-list > li > a > i, #popup-template-layout .post-up-time > li a, #popup-template-layout .number > span.active i, #popup-template-layout .number > input.active, #popup-template-layout .pit-uzr > a:hover, #popup-template-layout .pit-post-deta > h4 > a:hover, #popup-template-layout .view-pst-style > li.active > a, #popup-template-layout .pit-opt > li.save, #popup-template-layout .Rpt-meta > span, #popup-template-layout .pitred-links > ul > li a:hover, #popup-template-layout .smilez > li > span, #popup-template-layout .sidebar .comnity-data > ul > li, #popup-template-layout .comnty-avatar > a:hover, #popup-template-layout .usr-fig > a:hover, #popup-template-layout .post-up-time > li .usr-fig > a:hover, #popup-template-layout .feature-title > h2 > a:hover, #popup-template-layout .feature-title > h4 > a:hover, #popup-template-layout .feature-title > h6 > a:hover, #popup-template-layout .nave-area > li > a > i, #popup-template-layout .nave-area > li > a:hover, #popup-template-layout .save-post.save, #popup-template-layout .tube-title > h6 > a:hover, #popup-template-layout .chanle-name > a, #popup-template-layout .channl-author > em, #popup-template-layout .pit-tags > span, #popup-template-layout .tube-pst-meta > h5 a:hover, #popup-template-layout .addnsend > a i, #popup-template-layout .follow-me:hover, #popup-template-layout .follow-me:hover i, #popup-template-layout .contribute:hover, #popup-template-layout .contribute:hover i, #popup-template-layout .links-tab li.nav-item > a.active, #popup-template-layout .post-meta > h6 > a:hover, #popup-template-layout .fixed-sidebar .left-menu-full > ul li a.closd-f-menu, #popup-template-layout .fixed-sidebar .left-menu-full > ul li a:hover, #popup-template-layout .help-box > span, #popup-template-layout .post-meta .detail > a:hover, #popup-template-layout .sugested-photos > h5 a, #popup-template-layout .our-moto > p > span, #popup-template-layout .sound-right .send-mesg, #popup-template-layout .title-block .align-left h5 > i, #popup-template-layout .audio-user-name > h6 a:hover, #popup-template-layout .add-send > ul > li a, #popup-template-layout .add-send .send-mesg, #popup-template-layout .audio-title:hover, #popup-template-layout .sound-post-box > h4, #popup-template-layout .singer-info > span, #popup-template-layout .playlist-box > ul > li:hover, #popup-template-layout .song-title > h6 > a:hover, #popup-template-layout .song-title > a:hover, #popup-template-layout .playlist-box > h4 i, #popup-template-layout .prise, #popup-template-layout .location-area > span > i, #popup-template-layout .classic-pst-meta > h4 a:hover, #popup-template-layout .total-area > ul li.order-total > i, #popup-template-layout .classi-pst-meta > span ins, #popup-template-layout .classi-pst-meta > h6 a:hover, #popup-template-layout .classi-pst .user-fig a, #popup-template-layout .msg-pepl-list .nav-item.unread > a > div h6, #popup-template-layout .chater-info > h6, #popup-template-layout .text-box > p a, #popup-template-layout .description > h2 a:hover, #popup-template-layout span.ttl, #popup-template-layout .filter-meta > input, #popup-template-layout .pagination.borderd > li a:hover, #popup-template-layout .pricings > h1 span, #popup-template-layout .count i, #popup-template-layout .testi-meta > span i, #popup-template-layout .sec-heading.style9 > h2 span, #popup-template-layout .sec-heading.style9 > span i, #popup-template-layout .blog-title > a:hover, #popup-template-layout .serv-box > i, #popup-template-layout .heading-2 span, #popup-template-layout .team > h5 span, #popup-template-layout .popup-closed:hover, #popup-template-layout .text-caro-meta > span, #popup-template-layout .text-caro-meta > h1 > a span, #popup-template-layout .sub-popup > h4 span, #popup-template-layout .testi-meta::before, #popup-template-layout .user > a, #popup-template-layout .your-page > figure > span, #popup-template-layout .left-menu > li a:hover, #popup-template-layout .folw-detail ins, #popup-template-layout .profile-menu > li > a > i, #popup-template-layout .rate .qeemat, #popup-template-layout .cart-prod > li > p > span, #popup-template-layout .total-line > ul li > b, #popup-template-layout .full-postmeta > h4 > span, #popup-template-layout .cat-heading > a, #popup-template-layout .total-line > ul li > span > i, #popup-template-layout .extras > a.play-btn:hover, #popup-template-layout .single-btn > li > a, #popup-template-layout .widget .grouppage-info > li {
        color: #fa6342;
    }

    #popup-template-layout .timeline-info > ul li a::before, #popup-template-layout .add-btn > a, #popup-template-layout .activitiez > li::before, #popup-template-layout form button, #popup-template-layout a.underline:before, #popup-template-layout .setting-row input:checked + label, #popup-template-layout .user-avatar:hover .edit-phto, #popup-template-layout .add-butn, #popup-template-layout .nav.nav-tabs.likes-btn > li a.active, #popup-template-layout a.dislike-btn, #popup-template-layout .drop > a:hover, #popup-template-layout .btn-view.btn-load-more:hover, #popup-template-layout .accordion .card h5 button[aria-expanded="true"], #popup-template-layout .f-page > figure em, #popup-template-layout .inbox-panel-head > ul > li > a, #popup-template-layout footer .widget-title h4::before, #popup-template-layout #topcontrol, #popup-template-layout .sidebar .widget-title::before, #popup-template-layout .g-post-classic > figure > i::after, #popup-template-layout .purify > a, #popup-template-layout .open-position::before, #popup-template-layout .info > a, #popup-template-layout a.main-btn, #popup-template-layout .section-heading::before, #popup-template-layout .more-branches > h4::before, #popup-template-layout .is-helpful > a, #popup-template-layout .cart-optionz > li > a:hover, #popup-template-layout .paginationz > li a:hover, #popup-template-layout .paginationz > li a.active, #popup-template-layout .shopping-cart, #popup-template-layout a.btn2:hover, #popup-template-layout .form-submit > input[type="submit"], #popup-template-layout button.submit-checkout, #popup-template-layout .delete-cart:hover, #popup-template-layout .proceed .button, #popup-template-layout .amount-area .update-cart, #popup-template-layout a.addnewforum, #popup-template-layout .attachments li.preview-btn button:hover, #popup-template-layout .new-postbox .post-btn:hover, #popup-template-layout .weather-date > span, #popup-template-layout a.learnmore, #popup-template-layout .banermeta > a:hover, #popup-template-layout .add-remove-frnd > li a:hover, #popup-template-layout .profile-controls > li > a:hover, #popup-template-layout .edit-seting:hover, #popup-template-layout .edit-phto:hover, #popup-template-layout .account-delete > div > button:hover, #popup-template-layout .radio .check-box::after, #popup-template-layout .eror::after, #popup-template-layout .eror::before, #popup-template-layout .big-font, #popup-template-layout .event-time .main-btn:hover, #popup-template-layout .group-box > button:hover, #popup-template-layout .dropcap-head > .dropcap, #popup-template-layout .checkbox .check-box::after, #popup-template-layout .checkbox .check-box::before, #popup-template-layout .main-btn2:hover, #popup-template-layout .main-btn3:hover, #popup-template-layout .jalendar .jalendar-container .jalendar-pages .add-event .close-button, #popup-template-layout .jalendar .jalendar-container .jalendar-pages .days .day.have-event span::before, #popup-template-layout .user-log > i:hover, #popup-template-layout .total > i, #popup-template-layout .login-frm .main-btn, #popup-template-layout .search-tab .nav-tabs .nav-item > a.active::after, #popup-template-layout .mh-head, #popup-template-layout .job-tgs > a:hover, #popup-template-layout .owl-prev:hover:before, #popup-template-layout .owl-next:hover:before, #popup-template-layout .help-list > a, #popup-template-layout .title2::before, #popup-template-layout .fun-box > i, #popup-template-layout .list-style > li a:hover:before, #popup-template-layout .postbox .we-video-info > button:hover, #popup-template-layout .postbox .we-video-info > button.main-btn.color, #popup-template-layout .copy-email > ul li a:hover, #popup-template-layout .post-status > ul li:hover, #popup-template-layout .tags_ > a:hover, #popup-template-layout .policy .nav-link.active::before, #popup-template-layout a.circle-btn:hover, #popup-template-layout .mega-menu > li:hover > a > span, #popup-template-layout .pit-tags > a:hover, #popup-template-layout .create-post::before, #popup-template-layout .amount-select > li:hover, #popup-template-layout .amount-select > li.active, #popup-template-layout .pay-methods > li:hover, #popup-template-layout .pay-methods > li.active, #popup-template-layout .msg-pepl-list .nav-item.unread::before, #popup-template-layout .menu .btn:hover, #popup-template-layout .menu-item-has-children ul.submenu > li a::before, #popup-template-layout .pagination > li a:hover, #popup-template-layout .pagination > li a.active, #popup-template-layout .slick-dots li button, #popup-template-layout .slick-prev:hover:before, #popup-template-layout .slick-next:hover:before, #popup-template-layout .sub-popup::before, #popup-template-layout .sub-popup::after, #popup-template-layout a.date, #popup-template-layout .welcome-area > h2::before, #popup-template-layout .page-header.theme-bg, #popup-template-layout .nav.nav-tabs.trend li a, #popup-template-layout .btn.btn-default, #popup-template-layout .prod-detail .full-postmeta .shopnow:hover, #popup-template-layout .extras > a.play-btn, #popup-template-layout .sugtd-frnd-meta .send-invitation, #popup-template-layout .user-profile .join-btn {
        background: #fa6342;
    }

    #popup-template-layout .sec-heading.style9 > span i {
        font-size: 15px;
        margin-right: 5px;
    }

    #popup-template-layout .fa {
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    #popup-template-layout .sec-heading.style9 > h2 {
        font-size: 32px;
        font-weight: bold;
        text-transform: uppercase;
        color: #0e304c;
    }

    #popup-template-layout .price-box {
        background: #fff none repeat scroll 0 0;
        box-shadow: 0 10px 20px rgba(0 0 0 0.2);
        display: inline-block;
        text-align: center;
        width: 100%;
    }

    #popup-template-layout .price-box > span {
        color: #fff;
        display: inline-block;
        width: 100%;
        text-transform: capitalize;
        font-weight: 500;
    }

    #popup-template-layout .bg-red {
        background: #e44a3c;
    }

    #popup-template-layout .pricings {
        display: inline-block;
        padding: 30px 10px;
        width: 100%;
    }

    #popup-template-layout .pricings > h1 {
        color: #0e304c;
        display: inline-block;
        font-size: 45px;
        position: relative;
        width: 100%;
    }

    #popup-template-layout .price-features {
        display: inline-block;
        list-style: outside none none;
        margin-bottom: 20px;
        padding-left: 0;
        text-align: left;
        width: 100%;
    }

    #popup-template-layout .price-features > li {
        display: inline-block;
        font-size: 14px;
        margin-bottom: 15px;
        width: 100%;
    }

    #popup-template-layout .price-features > li > i {
        color: red;
        font-size: 10px;
        margin-right: 10px;
    }

    #popup-template-layout [class*=" ti-"], [class^=ti-] {
        font-family: themify;
        speak: none;
        font-style: normal;
        font-weight: 400;
        font-variant: normal;
        text-transform: none;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    #popup-template-layout .pricings .main-btn {
        width: 100%;
    }

    #popup-template-layout a.main-btn, a.main-btn3 {
        border-color: transparent;
    }

    #popup-template-layout a.main-btn, a.main-btn2, a.main-btn3 {
        -webkit-border-radius: 30px;
        -moz-border-radius: 30px;
        -ms-border-radius: 30px;
        -o-border-radius: 30px;
        border-radius: 30px;
        color: #fff;
        font-size: 13px;
        font-weight: 500;
        padding: 10px 26px;
        display: inline-block;
        transition: all 0.2s linear 0s;
        box-shadow: 4px 7px 12px 0 rgba(250 99 66 0.2);
    }

    #popup-template-layout [data-ripple] {
        position: relative;
    }

    #popup-template-layout .sec-heading.style9 > h2 {
        font-size: 32px;
        font-weight: bold;
        text-transform: uppercase;
        color: #0e304c;
    }

    #popup-template-layout .bg-purple {
        background: #7750f8;
    }

    #popup-template-layout .bg-blue {
        background: #23d2e2;
    }

    #popup-template-layout .bg-green {
        background: #38bff1;
    }

    #popup-template-layout .main-btn:hover {
        background: #888da8;
    }
    #popup-template-layout .button-focus-happy-hour {
        background-color: #0ac282 !important;
    }

</style>

<div class="popup-wraper5" id="popup-template-layout">
    <div class="popup" style="width: 90vw">
        <div class="popup-meta">
            <div class="row">
                <div class="offset-lg-1 col-lg-10">
                    <div class="sec-heading style9 text-center">
                        <span><i class="fa fa-trophy"></i> Nguyen123.vn</span>
                        <h2>ĐẶT TIỆC TẤT NHIÊN</h2>
                        <h2><span>ƯU ĐÃI TỤT QUẦN</span></h2>
                    </div>
                </div>
                <div class="col-12 row" style="max-height: 60vh; overflow-y: auto; padding-right: 0 !important;" id="list-gift-happy-hour-promotion">

                </div>
            </div>
            <a class="main-btn float-right" href="javascript:void(0)" onclick="closeModalGiftHappyHourPromotion()" title=""
               style="margin-top: 10px" data-ripple="">Đóng</a>
            <a class="main-btn float-right" href="javascript:void(0)" title="" style="margin-top: 10px" data-ripple=""
               onclick="saveGiftHappyHourPromotion()">Đăng ký</a>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/marketing/promotion/happy_hour/gift.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
