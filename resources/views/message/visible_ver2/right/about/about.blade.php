<div class="right-model right-model-about-chat">
    <div class="scroll-box-about">
        <div class="chater-info">
            <div class="image-about-visible-message">
                <img id="avatar-about-visible-message" src="{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}" data-src="" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="/images/tms/default.jpeg" alt="avatar" />
                <label class="pointer avt-img d-none">
                    <i class="fa fa-camera camera-ic"></i>
                    <input type="file" class="d-none" id="upload-avatar-about-visible-message" accept="image/*" />
                </label>
            </div>
            <div class="name-user">
                <div class="name-user-contain">
                    <div class="name-about-custom-style" id="name-about-visible-message" data-name="">
                        --- --- ---
                    </div>
                    <span class="update-name-visible-message d-none"><i class="ti-pencil"></i></span>
                    <span class="save-name-visible-message d-none"><i class="ion-ios-checkmark"></i></span>
                </div>
            </div>
            <div class="action-control-about">
                <div class="d-flex">
                    <div class="action-content disabled" disabled id="un-notify-in-group">
                        <i class="icon-bell"></i>
                        <span>Tắt thông báo</span>
                    </div>
                    <div class="action-content disabled" disabled id="pin-message-in-group">
                        <i class="icon-pin"></i>
                        <span>Ghim hội thoại</span>
                    </div>
                    <div class="action-content" id="add-user-in-group">
                        <i class="icon-user-follow icon-add-member-visible-message add-user-about-visible-message" data-toggle="tooltip" data-placement="top" title="Thêm thành viên nhóm"></i>
                        <span>Thêm thành viên</span>
                    </div>
                    <div class="action-content">
                        <i class="icon-settings" id="setting-in-group"></i>
                        <span>Quản lí nhóm</span>
                    </div>
                </div>
            </div>
            <div class="content-about">
                <div class="zoneQA" id="list-employee-detail">
                    <div class="ques">
                        <div class="ques-title">
                            Thành viên nhóm
{{--                            (<span class="count-element-about-visible-message number-person-about">0</span>)--}}
                        </div>
                        <div class="hidden-general-info">
                            <i class="fa fa-sort-down"></i>
                        </div>
                    </div>
                    <div class="ans">
                        <div class="scrollbox-member">
                            <div class="body-all-member" id="data-member-about-visible-message"></div>
                        </div>
                        <div class="see-list-image-video-grid-see-all employee d-none">
                            <div id="see-all-member-about" class="see-list-image-video-grid-see-all-text">Xem tất cả</div>
                        </div>
                    </div>
                </div>
                <div class="zoneQA">
                    <div class="ques">Bảng tin nhóm</div>
                    <div class="ans">
                        <div onclick="openNewFeedDetailVisibleMessage()" style="color: #353c4e; width: 100%; cursor: pointer; padding: 10px;display: flex; align-items: center"><i class="fa fa-bullhorn mr-1"></i> Ghim, bình chọn</div>
                    </div>
                </div>
                <div class="zoneQA" id="image-list-about-visible-message">
                    <div class="ques about-list-image">
                        <div class="ques-title">Ảnh
{{--                            (<span class="count-element-about-visible-message" id="number-img">0</span>)--}}
                        </div>
                        <div class="hidden-general-info">
                            <i class="fa fa-sort-down"></i>
                        </div>
                    </div>
                    <div class="ans">
                        <div class="slide-to-top-max-width-custom" style="width: 100%;">
                            <div class="see-list-image-video-grid pb-0" id="data-image-about-visible-message"></div>
                            <div class="see-list-image-video-grid-see-all image  pt-0 pb-0">
                                <div id="show-all-image-item-about" data-type="2" class="see-list-image-video-grid-see-all-text show-all-about-visible" data-type="2">Xem tất cả</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="zoneQA" id="video-list-about-visible-message">
                    <div class="ques">
                        <div class="ques-title">Video
{{--                            (<span class="count-element-about-visible-message" id="number-video">0</span>)--}}
                        </div>
                        <div class="hidden-general-info">
                            <i class="fa fa-sort-down"></i>
                        </div>
                    </div>
                    <div class="ans">
                        <div class="slide-to-top-max-width" style="width: 100%;">
                            <div class="see-list-image-video-grid pb-0" id="data-video-about-visible-message"></div>
                            <div class="see-list-image-video-grid-see-all video d-none pt-0 pb-0">
                                <div id="show-all-video-item-about" class="see-list-image-video-grid-see-all-text show-all-about-visible" data-type="5">Xem tất cả</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="zoneQA" id="file-list-about-visible-message">
                    <div class="ques">
                        <div class="ques-title">Files
{{--                            (<span class="count-element-about-visible-message" id="number-file">0</span>)--}}
                        </div>
                        <div class="hidden-general-info">
                            <i class="fa fa-sort-down"></i>
                        </div>
                    </div>
                    <div class="ans">
                        <div id="data-file-about-visible-message"></div>
                        <div class="see-list-image-video-grid-see-all file d-none">
                            <div id="show-all-file-about" class="see-list-image-video-grid-see-all-text show-all-about-visible" data-type="3">Xem tất cả</div>
                        </div>
                    </div>
                </div>
                <div class="zoneQA" id="link-list-about-visible-message">
                    <div class="ques">
                        <div class="ques-title">Links
{{--                            (<span class="count-element-about-visible-message" id="number-link">0</span>)--}}
                        </div>
                        <div class="hidden-general-info">
                            <i class="fa fa-sort-down"></i>
                        </div>
                    </div>
                    <div class="ans">
                        <div id="data-link-about-visible-message"></div>
                        <div class="see-list-image-video-grid-see-all link d-none">
                            <div id="show-all-link-item-about" class="see-list-image-video-grid-see-all-text show-all-about-visible" data-type="8">Xem tất cả</div>
                        </div>
                    </div>
                </div>
                <div class="zoneQA">
                    <div class="ques">
                        <div class="ques-title">Thiết lập</div>
                        <div class="hidden-general-info">
                            <i class="fa fa-sort-down"></i>
                        </div>
                    </div>
                    <div class="ans">
                        <div onclick="leaveGroupUser($(this))" class="delete-chat-visible-message" id="remove-group-about"> Rời nhóm</div>
                        <div class="remove-group-chat delete-chat-visible-message" id="out-group-about"> Giải tán nhóm</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
