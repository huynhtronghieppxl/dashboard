{{-- Danh sách thành viên --}}
<div class="member-all-popup">
    <div class="m-member-all-popup">
        <div class="header-see-member-popup">
            <div class="back-arrow-member-popup hidden-see-all-member-popup">
                <i class="fa fa-angle-double-left"></i>
            </div>
            <div class="title-see-member-popup">Thành viên (<span class="number-person-about">0</span>)</div>
            <i class="zmdi zmdi-accounts-add icon-add-member-visible-message"></i>
        </div>
        <div class="scroll-box-member-popup">
            <div class="search-area-info-member-about-visible-message" id="search-member-about-visible-message">
                <div class="wrap-card-search-area-member-about">
                    <a href="javascript:void(0)">
                        <i class="fa fa-search"></i>
                    </a>
                    <input type="text" placeholder="Tìm kiếm theo tên, bộ phận...." class="input-search-member-about" id="search-info-member-about" />
                    <a class="clear-text-area-member-search-about" href="javascript:void(0)">
                        <i class="ion-close-circled"></i>
                    </a>
                </div>
            </div>
            <div class="body-all-member-popup" id="data-all-member-visible-message"></div>
        </div>
    </div>
</div>
{{-- DAnh sách media --}}
<div class="media-all-visible-message" id="media-all-about-visible-message">
    <div class="m-all-media">
        <div class="header-see-all-media">
            <div class="pointer-arrow-hidden-media" id="hidden-see-all-media">
                <div class="back-arrow-all-media">
                    <i class="fa fa-angle-double-left"></i>
                </div>
            </div>
            <div class="title-see-all-media">Kho lưu trữ</div>
        </div>
        <ul class="nav nav-tabs md-tabs" role="tablist">
            <li class="nav-item about-visible-message-tablist">
                <a class="nav-link about-visible-message-nav-link remove-draw-table" id="tab-image-about-visible-message" data-toggle="tab" href="#tab-image" role="tab" aria-expanded="true" data-type="2" data-check="0" style="font-size: 13px !important;">Ảnh</a>
                <div class="slide"></div>
            </li>
            <li class="nav-item about-visible-message-tablist">
                <a class="nav-link about-visible-message-nav-link remove-draw-table" id="tab-video-about-visible-message" data-toggle="tab" href="#tab-video" role="tab" aria-expanded="false" data-type="5" data-check="0" style="font-size: 13px !important;">Video</a>
                <div class="slide"></div>
            </li>
            <li class="nav-item about-visible-message-tablist">
                <a class="nav-link about-visible-message-nav-link remove-draw-table" id="tab-file-about-visible-message" data-toggle="tab" href="#tab-file" role="tab" aria-expanded="false" data-type="3" data-check="0" style="font-size: 13px !important;">File</a>
                <div class="slide"></div>
            </li>
            <li class="nav-item about-visible-message-tablist">
                <a class="nav-link about-visible-message-nav-link remove-draw-table" id="tab-link-about-visible-message" data-toggle="tab" href="#tab-link" role="tab" aria-expanded="false" data-type="8" data-check="0" style="font-size: 13px !important;">Link</a>
                <div class="slide"></div>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab-image" role="tabpanel">
                <p class="m-0">@include('message.visible_ver2.right.about.image')</p>
            </div>
            <div class="tab-pane" id="tab-video" role="tabpanel">
                <p class="m-0">@include('message.visible_ver2.right.about.video')</p>
            </div>
            <div class="tab-pane" id="tab-file" role="tabpanel">
                <p class="m-0">@include('message.visible_ver2.right.about.file')</p>
            </div>
            <div class="tab-pane" id="tab-link" role="tabpanel">
                <p class="m-0">@include('message.visible_ver2.right.about.link')</p>
            </div>
        </div>
    </div>
</div>
{{-- Layout ghim tin nhắn--}}
<div class="media-all-visible-message media-all-about-pinned-visible-message" id="pin-layout-visible-message">
    <div class="m-all-media">
        <div class="header-see-all-media">
            <div class="pointer-arrow-hidden-media" id="hidden-see-all-media">
                <div class="back-arrow-all-media">
                    <i class="fa fa-angle-double-left"></i>
                </div>
            </div>
            <div class="title-see-all-media">Bảng Tin Nhóm</div>
        </div>
        <ul class="nav nav-tabs nav-tabs-visible-message md-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active " id="tab-pinned-about-visible-message" data-toggle="tab" href="#layout-pin-detail-about-visible-message" role="tab" aria-expanded="false" style="font-size: 13px!important;">Tin ghim</a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-note-about-visible-message" data-toggle="tab" href="#layout-vote-detail-about-visible-message" role="tab" aria-expanded="false" style="font-size: 13px!important;">Bình chọn</a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-remind-about-visible-message" data-toggle="tab" href="#layout-remind-detail-about-visible-message" role="tab" aria-expanded="false" style="font-size: 13px!important;">Nhắc hẹn</a>
                <div class="slide"></div>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="layout-pin-detail-about-visible-message" role="tabpanel">
                <div class="pin-details-content-about-visible-message"></div>
            </div>
            <div class="tab-pane" id="layout-vote-detail-about-visible-message" role="tabpanel">
                <div class="vote-details-content-about-visible-message"></div>
            </div>
            <div class="tab-pane" id="layout-remind-detail-about-visible-message" role="tabpanel">
                <div class="remind-details-content-about-visible-message">
                    <div class="body-message-remind w-100">
                        <div class="div-body-message-remind">
                            <div class="contain-body-message-remind">
                                <div class="contain-body-message-remind-calendar">
                                    <p class="contain-body-message-remind-calendar-month">Tháng 10</p>
                                    <p class="contain-body-message-remind-calendar-day">Thứ 3</p>
                                    <p class="contain-body-message-remind-calendar-num">18</p>
                                    <p class="contain-body-message-remind-calendar-year">2022</p>
                                </div>
                                <div class="contain-body-message-remind-info">
                                    <p class="contain-body-message-remind-info-title">Build 23H</p>
                                    <div class="contain-body-message-remind-info-time">
                                        <i class="contain-body-message-remind-info-time-icon ti-alarm-clock"></i>
                                        <div class="contain-body-message-remind-info-time-title">Hôm nay lúc</div>
                                        <div class="contain-body-message-remind-info-time-number">21:00</div>
                                    </div>
                                    <div class="contain-body-message-remind-info-time">
                                        <i class="contain-body-message-remind-info-time-icon ti-loop"></i>
                                        <div class="contain-body-message-remind-info-time-title-loop">Nhắc theo ngày</div>
                                    </div>
                                    <div class="contain-body-message-remind-info-member">
                                        <div class="contain-body-message-remind-info-member-title">Thành viên tham gia</div>
                                        <div class="contain-body-message-remind-info-member-number">4</div>
                                    </div>
                                </div>
                            </div>
                            <div class="contain-footer-message-remind">
                                <button id="btn-close-create-specifications" style="width: 48%;" type="button" class="btn btn-grd-disabled">Từ chối</button>
                                <button type="button" class="btn btn-grd-primary" style="width: 48%;">Tham gia</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Layout tin nhắn đưc tag tên --}}
<div class="message-tag-name-modal" id="message-tag-name-modal">
    <div class="m-member-all-popup">
        <div class="header-see-member-popup">
            <div class="back-arrow-member-popup hidden-message-tag-name-modal">
                <i class="fa fa-angle-double-left"></i>
            </div>
            <div class="title-message-tag-name-modal">Danh sách tin nhắn (<span class="number-message-tag-name-modal">0</span>)</div>
        </div>
        <div class="scroll-box-member-popup">
            <div class="body-all-member-popup" id="data-all-message-tag-name"></div>
        </div>
    </div>
</div>
{{-- Quản lý nhóm--}}
<div class="group-all-popup">
    <div class="m-member-all-popup">
        <div class="header-see-member-popup">
            <div class="back-arrow-member-popup hidden-see-all-setting-popup">
                <i class="fa fa-angle-double-left"></i>
            </div>
            <div class="title-see-member-popup">Quản lý nhóm, thành viên </div>
            <i class="zmdi zmdi-accounts-add" style="opacity: 0"></i>
        </div>
        <div class="scroll-box-member-popup">
            <div class="body-all-member-popup" id="data-all-setting-visible-message">
                <div class="body-all-setting-popup-title">Cho phép các thành viên trong nhóm</div>
                <div class="body-all-setting-popup-accept-member-list">
                    <div class="body-all-setting-popup-accept-member-item">
                        <div class="body-all-setting-popup-accept-member-item-title">Thay đổi tên và ảnh đại diện nhóm</div>
                        <input type="checkbox" class="check-on-off-checkbox">
                    </div>
                    <div class="body-all-setting-popup-accept-member-item">
                        <div class="body-all-setting-popup-accept-member-item-title">Ghim tin nhắn, ghi chứ, bình chọn lên đầu hội thoại</div>
                        <input type="checkbox" class="check-on-off-checkbox">
                    </div>
                    <div class="body-all-setting-popup-accept-member-item">
                        <div class="body-all-setting-popup-accept-member-item-title">Tạo mới ghi chú, nhắc hẹn</div>
                        <input type="checkbox" class="check-on-off-checkbox">
                    </div>
                    <div class="body-all-setting-popup-accept-member-item">
                        <div class="body-all-setting-popup-accept-member-item-title">Tạo mới bình chọn</div>
                        <input type="checkbox" class="check-on-off-checkbox">
                    </div>
                </div>

                <div class="body-all-setting-popup-accept-member-list">
                    <div class="body-all-setting-popup-accept-member-item">
                        <div class="body-all-setting-popup-accept-member-item-title d-flex">Chế độ phê duyệt thành viên mới <i class="fa fa-question-circle-o ml-1 mt-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Khi bật, thành viên mới phải cần trưởng nhóm phê duyệt"></i></div>
                        <input type="checkbox" class="check-on-off-checkbox">
                    </div>
                    <div class="body-all-setting-popup-accept-member-item">
                        <div class="body-all-setting-popup-accept-member-item-title d-flex">Đánh dấu tin nhắn từ trưởng/phó nhóm <i class="fa fa-question-circle-o ml-1 mt-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Khi bật, tin nhắn từ trưởng nhóm sẽ có biểu tượng chìa khoa"></i></div>
                        <input type="checkbox" class="check-on-off-checkbox">
                    </div>
                    <div class="body-all-setting-popup-accept-member-item">
                        <div class="body-all-setting-popup-accept-member-item-title" style="position: relative">Cho phép thành viên mới đọc tin nhắn gần nhất <i style="position: absolute; top: 25px; left: 35px" class="fa fa-question-circle-o" data-toggle="tooltip" data-placement="top" title="" data-original-title="Khi bật, thành viên mới được phép xem tin nhắn trước khi họ tham gia"></i></div>
                        <input type="checkbox" class="check-on-off-checkbox">
                    </div>
{{--                    <div class="body-all-setting-popup-accept-member-item">--}}
{{--                        <div class="body-all-setting-popup-accept-member-item-title">Cho phép dùng link tham gia nhóm <i class="fa fa-question-circle-o"></i></div>--}}
{{--                        <input type="checkbox" class="check-on-off-checkbox">--}}
{{--                    </div>--}}
{{--                    <div class="body-all-setting-popup-accept-member-item">--}}
{{--                        --}}
{{--                    </div>--}}
                </div>

                <div class="body-all-setting-popup-accept-member-list">
                    <div class="body-all-setting-popup-accept-member-item">
                        <i class="fa fa-user-times mr-2"></i>
                        <div class="body-all-setting-popup-accept-member-item-title">Chặn khỏi nhóm</div>
                    </div>
                    <div class="body-all-setting-popup-accept-member-item">
                        <i class="fa fa-key mr-2"></i>
                        <div class="body-all-setting-popup-accept-member-item-title">Trưởng và phó nhóm</div>
                    </div>
                </div>
                <div class="button-dissolution-group">
                    <button class="button-dissolution-group-btn"> Giải tán nhóm</button>
                </div>
            </div>
        </div>
    </div>
</div>
