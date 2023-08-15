<div class="chat-contain" id="chat-popup-layout">
    <div class="chat-form d-none" data-id="${idCurrentConversation}">
        <div class="chat-header">
            <div class="chat-header-info">
                <div class="chat-header-info-avatar" data-toggle="tooltip" data-placement="top" data-original-title="Chức năng">
                    <div class="chat-header-avatar">
                        <img class="chat-avatar-image" src="" alt=""/>
                        <span class="chat-status online-status"></span>
                    </div>
                    <div class="header-chat-display">
                        <p class="header-chat-display-name"><b>${name}</b></p>
                    </div>
                    <div class="header-chat-display-option">
                        <i class="header-chat-display-icon icofont icofont-caret-down active-icon-popup"></i>
                    </div>
                </div>
            </div>
            <div class="list-infor-action-setting-popup-message d-none">
                <ul class="list-infor-detail-popup-message">
                    <div class="main-list-infor-detail-popup-message">
                        <li class="nav-option-footer-popup disabled" id="open-all-message-setting-popup">
                            <i class="chat-footer-option-icon fa fa-commenting-o active-icon-popup"></i>
                            Mở trong tin nhắn
                        </li>
                        <li class="nav-option-footer-popup disabled" id="settup-message-setting-popup">
                            <i class="chat-footer-option-icon fa fa-cog active-icon-popup"></i>
                            Cài đặt
                        </li>
                        <div class="line m-1" style="background-color: #dfdfdf;height: 1px;"></div>
                        <li class="nav-option-footer-popup disabled" id="list-branch-message-setting-popup">
                            <i class="chat-footer-option-icon fa fa-list-ul active-icon-popup"></i>
                            Danh sách chi nhánh
                        </li>
                        <li class="nav-option-footer-popup" id="member-message-setting-popup" onclick="openModalListMemberPopupMessage()">
                            <i class="chat-footer-option-icon fa fa-users active-icon-popup"></i>
                            Thành viên
                        </li>
                        <li class="nav-option-footer-popup" id="member-message-setting-popup" onclick="openModalListVotePopupMessage()">
                            <i class="chat-footer-option-icon fa fa-users active-icon-popup"></i>
                            Danh sách tin nhắn bình chọn
                        </li>
                        <li class="nav-option-footer-popup disabled" id="detail-order-message-setting-popup">
                            <i class="chat-footer-option-icon fa fa-list-alt active-icon-popup"></i>
                            Thông tin đơn hàng
                        </li>
                        <div class="line m-1" style="background-color: #dfdfdf;height: 1px;"></div>
                        <li class="nav-option-footer-popup disabled" id="order-unpaid-message-setting-popup">
                            <i class="chat-footer-option-icon fa fa-folder active-icon-popup"></i>
                            Đơn hàng chưa được xử lí
                        </li>
                        <li class="nav-option-footer-popup disabled" id="unpaid-month-message-setting-popup">
                            <i class="chat-footer-option-icon fa fa-credit-card active-icon-popup"></i>
                            Công nợ tháng này
                        </li>
                    </div>
                    <div id="get-member-list-popup-message" class="d-none">
                        <div class="title-list-action-back-popup-message d-flex p-1">
                            <div class="button-back-list-infor-action-setting-popup-message">
                                <i class="chat-footer-option-icon fa fa-arrow-left"></i></div>
                            <h4 class="modal-title text-dark">Thành viên (<span class="number-person-about">0</span>)</h4>
                        </div>
                        <div class="member-all-popup">
                            <div class="m-member-all-popup">
                                <div class="scroll-box-member-popup">
                                    <div class="search-area-info-member-about-visible-message"
                                         id="search-member-about-visible-message">
                                        <div class="wrap-card-search-area-member-about">
                                            <a href="javascript:void(0)" style="margin: 0px 5px 0 12px;">
                                                <i class="fa fa-search"></i>
                                            </a>
                                            <input type="text" placeholder="Tìm kiếm theo tên, bộ phận...."
                                                   class="input-search-member-about" id="search-info-member-about"/>
                                            <a class="clear-text-area-member-search-about" href="javascript:void(0)">
                                                <i class="ion-close-circled"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="body-all-member" id="data-all-member-visible-message"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="get-vote-list-popup-message" class="d-none">
                        <div class="title-list-action-back-popup-message d-flex p-1">
                            <div class="button-back-list-infor-action-setting-popup-message">
                                <i class="chat-footer-option-icon fa fa-arrow-left"></i></div>
                            <h4 class="modal-title text-dark">Danh sách bình chọn (<span class="number-vote-about">0</span>)</h4>
                        </div>
                        <div class="member-all-popup">
                            <div class="m-member-all-popup">
                                <div class="scroll-box-member-popup">
                                    <div class="body-all-member" id="data-all-vote-visible-message"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="get-pinned-list-popup-message" class="d-none"></div>
                </ul>
            </div>
            <div class="chat-box-tools">
                <div class="box-tools-flex">
                    <div class="chat-box-tools-link" onclick="openModalListPinnedPopupMessage()">
                        <i class="icofont icofont-tack-pin icon-font-size-22 active-icon-popup" data-toggle="tooltip"
                           data-placement="top" data-original-title="Tin nhắn đã ghim"></i>
                        <div id="number-count-pinned-popup-message" class="badge bg-c-pink text-center d-none">0</div>
                    </div>
                    <div class="chat-box-tools-link" id="start-call-popup">
                        <i class="fa fa-phone icon-font-size-22 active-icon-popup" data-toggle="tooltip"
                           data-placement="top" data-original-title="Bắt đầu gọi thoại"></i>
                    </div>
                    <div class="chat-box-tools-link">
                        <i class="fa fa-video-camera icon-font-size-22 active-icon-popup" data-toggle="tooltip"
                           data-placement="top" data-original-title="Bắt đầu gọi video"></i>
                    </div>
                    <div class="chat-box-tools-link icon-font-size close-popup" style="color: #b5b5be;">
                        <i class="icofont icofont-close icon-font-size-22 active-icon-popup" data-toggle="tooltip"
                           data-placement="top" data-original-title="Đóng đoạn chat"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat-body body-visible-message" style="">
            <div class="" id="chat-body-message-popup"></div>
            <div class="action-scroll-back-current-message-popup d-none">
                <i class="icon-scroll-back-current-message-popup fa fa-angle-down"></i>
            </div>
        </div>
        <div class="layout-preview-input-popup-message d-none">
            <span class="icon-close-thumbnail-link-popup-message"><i
                    class="fa icon-close-thumbnail-link-popup-message fa-times-circle"></i></span>
            <div class="layout-thumbnail-preview-popup-message d-flex">
                <div class="img-class-popup-message"><img id="image-thumbnail-preview-popup"
                                                          class="img-thumbnail-input-popup-message" src="" alt=""/>
                </div>
                <div class="text-input-thumbnail-popup-message">
                    <div id="title-thumbnail-preview-popup" class="title-thumbnail-video-popup-message"></div>
                    <span id="link-thumbnail-preview-popup" src=""></span>
                    <div id="text-link-thumbnail-preview-popup" class="footer-text-input-thumbnail-popup-message"></div>
                </div>
            </div>
        </div>
        <div class="layout-reply-input-popup-message d-none" data-id="" data-random-key="">
            <span class="icon-close-thumbnail-reply-popup-message"><i
                    class="fa icon-close-thumbnail-image-close-reply-popup fa-times-circle"></i></span>
            <div class="layout-thumbnail-reply-popup-message">
                <div id="image-id-reply-popup-message" class="img-class-reply-popup-message"></div>
                <div class="text-input-thumbnail-reply-popup-message">
                    <i class="fa fa-mail-reply icon-reply-thumbnail-reply-popup-message"></i>
                    <span class="text-name-reply-popup">Trả lời</span>
                    <span id="name-reply-name-popup" class="name-reply-popup-message"></span>
                    <br/>
                    <span class="footer-text-input-thumbnail-reply-popup-message"></span>
                </div>
            </div>
        </div>
        <div class="chat-footer-popup">
            <div class="chat-footer-popup-action d-flex align-items-center">
                <div class="chat-footer-other-action">
                    <i class="chat-footer-option-icon icofont icofont-plus-circle active-icon-popup"
                       data-toggle="tooltip" data-placement="top" data-original-title="Thêm"></i>
                    <ul class="list-option-footer-popup d-none">
                        <li class="item-option-footer-popup">
                            <div class="chat-footer-option-images" id="item-option-footer-popup-image">
                                <label for="" class="mb-0">
                                    <i class="chat-footer-option-icon fa fa-photo active-icon-popup"
                                       data-toggle="tooltip" data-placement="top" data-original-title="Ảnh"></i>
                                </label>
                                <span> Chọn hình ảnh</span>
                            </div>
                            <input type="file" name="file" id="chat-footer-option-image" multiple class="d-none"
                                   accept=".jpg,.png,.gif"/>
                        </li>
                        <li class="item-option-footer-popup">
                            <label for="chat-footer-option-video" class="mb-0">
                                <i class="chat-footer-option-icon fa fa-video-camera active-icon-popup" data-toggle="tooltip" data-placement="top" data-original-title="Video"></i>
                                <span> Video</span>
                            </label>
                            <input id="chat-footer-option-video" class="d-none" type="file" accept=".mov,.mp4,.3gp">
                        </li>
                        <li class="item-option-footer-popup" id="in-layout-input-sticker-icon-message-popup">
                            <i class="chat-footer-option-icon fa fa-github-alt active-icon-popup"></i><span> Chọn nhãn dán</span>
                        </li>
                        <li class="item-option-footer-popup">
                            <div class="chat-footer-option-file" id="item-option-footer-popup-file">
                                <label for="" class="mb-0">
                                    <i class="chat-footer-option-icon fa fa-folder active-icon-popup"
                                       data-toggle="tooltip" data-placement="top" data-original-title="File"></i>
                                </label>
                                <span> Chọn tập tin</span>
                            </div>
                            <input type="file" name="file" id="chat-footer-option-file" class="d-none"/>
                        </li>
                        <li class="item-option-footer-popup out-layout-chat-footer-option-cart"><i
                                class="chat-footer-option-icon feather icon-shopping-cart active-icon-popup fa fa-shopping-cart"></i><span> Đơn hàng</span>
                        </li>
                        <li class="item-option-footer-popup" id="item-option-footer-popup-audio"><i
                                class="chat-footer-option-icon fa fa-microphone active-icon-popup"></i><span> Ghi âm</span>
                        </li>
                    </ul>
                </div>
                <div class="chat-footer-other-action-list d-flex align-items-center">
                    <div class="chat-footer-option-sticker d-flex" id="out-layout-chat-footer-option-sticker">
                        <i
                            class="chat-footer-option-icon fa fa-github-alt active-icon-popup"
                            id="input-sticker-icon-message-popup"
                            style="font-size: 22px !important; top: -1px;"
                            data-toggle="tooltip"
                            data-placement="top"
                            data-original-title="Sticker"
                        ></i>
                        <div class="sticker-input-visible-message d-none">
                            <div class="body-footer-sticker-visible-message">
                                <div class="body-sticker-visible-message d-flex"
                                     id="data-sticker-visible-message"></div>
                            </div>
                            <div class="footer-sticker-visible-message">
                                <ul class="list-sticker-visible-message suggested-frnd-caro"
                                    id="data-category-sticker-popup-message"></ul>
                            </div>
                        </div>
                    </div>
                    <div class="chat-footer-option-file d-flex" id="out-layout-chat-footer-option-file">
                        <label for="chat-footer-option-file" class="mb-0">
                            <i id="out-layout-chat-footer-option-file-i"
                               class="chat-footer-option-icon fa fa-folder active-icon-popup" data-toggle="tooltip"
                               data-placement="top" data-original-title="File" style="top:1px;"></i>
                            <input type="file" name="file" id="chat-footer-option-file" class="d-none"/>
                        </label>
                    </div>
                    <div class="chat-footer-option-cart d-flex out-layout-chat-footer-option-cart">
                        <i
                            class="chat-footer-option-icon feather icon-shopping-cart active-icon-popup"
                            id="icon-shopping-cart-popup-message"
                            style="top: -2px;"
                            data-toggle="tooltip"
                            data-placement="top"
                            data-original-title="Đơn hàng"
                        ></i>
                        <div class="box-cart-restaurant-popup-message d-none">
                            <div class="header-cart-restaurant-popup-message d-flex p-1">
                                <i class="fa fa-shopping-cart icon-cart-title-popup-message"></i>
                                <h4 class="modal-title">Đơn hàng</h4>
                            </div>
                            <div class="filter-cart-restaurant-popup-message p-1" id="">
                                <div class="wrap-card-search-area-cart-about">
                                    <a href="javascript:void(0)" style="margin: 0px 5px 0 12px;">
                                        <i class="fa fa-search search-cart-restaurant-popup-message"></i>
                                    </a>
                                    <input class="text-filter-cart-restaurant-popup-message"
                                           id="text-filter-cart-restaurant-popup-message" type="text"
                                           placeholder="Tìm đơn hàng"/>
                                    <a class="clear-text-area-cart-search-about" href="javascript:void(0)">
                                        <i class="ion-close-circled"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="body-cart-restaurant-popup-message"></div>
                            <div class="footer-order-visible-message">
                                <nav aria-label="..." class="pagination-review-dashboard-introduce">
                                    <div class="simple-pagination"></div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chat-footer-message">
                <div contenteditable placeholder="Aa" class="chat-footer-message-input"></div>
                <emoji-picker class="d-none light" locale="vi" style="position: absolute;right: 10px;bottom: 30px;z-index: 99;"></emoji-picker>
                <i id="emoji-button-input-popup-message" class="chat-footer-message-animation chat-footer-option-icon fa fa-smile-o icon-smile-visible-input active-icon-popup"
                    data-toggle="tooltip" data-placement="top" data-original-title="Biểu cảm"></i>
            </div>
            <div class="layout-audio-visible-message d-none">
                <div class="check-voice-layout-audio-popup-message">
                    <button class="record_btn" id="button"
                            style="background-color: black; border: none; outline: none; border-radius: 50%;">
                        <div id="recorder" class="recorder-visible-message" data-toggle="tooltip" data-placement="top"
                             data-original-title="Nhấn vào để ghi âm">
                            <div id="record-message-popup-message" class="record-item-visible-message">
                                <i class="fa fa-microphone record-microphone-popup-message"></i>
                            </div>
                        </div>
                    </button>
                    <span id="timer" class="time-record-visible-message">00:00</span>
                </div>
                <div class="icon-send-off-record">
                    <i class="icofont icofont-refresh d-none" id="reset-record-popup-message" data-toggle="tooltip"
                       data-placement="top" data-original-title="Reset"></i>
                    <i class="fa fa-microphone-slash icon-stop-record-visible-message"
                       id="turn-off-record-popup-message" data-toggle="tooltip" data-placement="top"
                       data-original-title="Hủy audio"></i>
                    <i id="send-audio-input-popup-message"
                       class="icofont ion-android-send send-audio-visible-message d-none" data-toggle="tooltip"
                       data-placement="top" data-original-title="Gửi audio"
                       style="padding: 3px 5px 3px 8px; !important;"></i>
                </div>
            </div>
            <div class="chat-footer-send">
                <button class="chat-footer-send-button" id="chat-footer-like">
                    <i class="chat-footer-option-icon icofont icofont-like active-icon-popup" data-toggle="tooltip"
                       data-placement="top" data-original-title="Like"></i>
                </button>
                <button class="chat-footer-send-button d-none" id="chat-footer-send">
                    <i class="chat-footer-option-icon icofont ion-android-send active-icon-popup" data-toggle="tooltip"
                       data-placement="top" data-original-title="Gửi"
                       style="padding: 3px 5px 3px 8px; !important;"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- Queue -->
    <div class="chat-queue">
        <ul class="chat-queue-list" id="chat-queue-list"></ul>
    </div>
</div>
