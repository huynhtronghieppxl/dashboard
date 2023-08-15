<style>
    @import 'https://fonts.googleapis.com/icon?family=Material+Icons|Roboto';
</style>
<div id="layout-body-size-body" class="input-visible-message">
    <div class="message-writing-box">
        <div class="layout-action-input-visible-message d-flex">
            <i id="icon-sticker-input" class="fa fa-github-alt icon-sticker-footer-visible-message"
               data-toggle="tooltip" data-placement="top" data-original-title="Sticker" ></i>
            <label class="input-image-message-visible-message" for="input-image-message" data-toggle="tooltip"
                   data-placement="top"
                   data-original-title="Ảnh">
                <i class="fa fa-photo" id="icon-image-send-visible-message" ></i>
            </label>
            <input id="input-image-message" class="d-none" type="file" multiple
                   accept=".jpg,.png,.gif"/>
            <label class="input-video-message-visible-message" for="input-video-message" data-toggle="tooltip"
                   data-placement="top"
                   data-original-title="Video">
                <i class="fa fa-video-camera"></i>
            </label>
            <input data-image="" id="input-video-message" class="d-none" type="file" accept=".mov,.mp4,.3gp"/>

            <label class="input-file-message-visible-message" for="input-file-message" data-toggle="tooltip"
                   data-placement="top"
                   data-original-title="File">
                <i class="fa fa-folder"></i>
            </label>
            <input id="input-file-message" class="d-none" type="file" />
            <i class="fa fa-microphone record-visible-message" data-toggle="tooltip" data-placement="top"
               data-original-title="Ghi âm"></i>
            <i class="fa fa-signal vote-visible-message" data-toggle="tooltip" data-placement="top"
               data-original-title="Bình chọn" ></i>
            <input id="input-audio-message" class="d-none" type="file" multiple
                   accept="audio/mp3,audio/*;capture=microphone"/>
            <i class="fa fa-exclamation  notify-visible-message" data-toggle="tooltip" data-placement="top" id="send-notify-important-message"
               data-original-title="Quan trọng"></i>
            <i class="icon-remind-time fa fa-clock-o disabled" disabled="disabled" data-toggle="tooltip" data-placement="top"
               data-original-title="Nhắc hẹn"></i>
            <i id="show-order-message" class="d-none feather icon-shopping-cart" data-toggle="tooltip"
               data-placement="top"
               data-original-title="Đơn hàng"></i>
            <i class="ti-more-alt invite-more item-invite" data-toggle="tooltip" data-placement="top"
               data-original-title="Thêm">
            </i>
            <ul class="d-none show-notification-input-visible-message" data-dropdown-in="fadeIn"
                data-dropdown-out="fadeOut">
                <li class=" option-sticker-visible-message">
                    <i class="fa fa-github-alt icon-sticker-footer-visible-message"></i>Sticker
                </li>
                <li class="option-image-visible-message">
                    <i class="fa fa-photo"></i>Ảnh
                </li>
                <li class="option-video-visible-message">
                    <i class="icofont icofont-video-clapper"></i>Video
                </li>
                <li class="option-file-visible-message">
                    <i class="icofont icofont-ui-file"></i>File
                </li>
                <li class="option-vote-visible-message">
                    <i class="fa fa-bar-chart-o"></i>Bình chọn
                </li>
                <li class="option-record-visible-message">
                    <i class="fa fa-microphone"></i>Ghi âm
                </li>
                <li class="option-tag-name-visible-message">
                    <i class="icofont item-mention icofont-ui-email"></i>Tag tên
                </li>
                <li class="option-order-visible-message">
                    <i class="feather icon-shopping-cart bg-c-blue card1-icon"></i>Đơn hàng
                </li>
            </ul>
        </div>
        <div class="layout-preview-input-visible-message d-none">
            <span class="icon-close-thumbnail-link-visible-message"><i
                    class="fa icon-close-thumbnail-link-visible-message fa-times-circle"></i></span>
            <div class="layout-thumbnail-preview-visible-message ">
                <div class="img-class-visible-message"><img id="image-thumbnail-preview"
                                                            class="img-thumbnail-input-visible-message" src="" alt=""/>
                </div>
                <div class="text-input-thumbnail-visible-message">
                    <div id="title-thumbnail-preview" class="title-thumbnail-video-visible-message"></div>
                    <span id="link-thumbnail-preview"></span>
                    <div id="text-link-thumbnail-preview" class="footer-text-input-thumbnail-visible-message">
                    </div>
                </div>
            </div>
        </div>
        <div class="layout-reply-input-visible-message d-none" data-id="">
            <span class="icon-close-thumbnail-reply-visible-message"><i
                    class="fa icon-close-thumbnail-image-close-reply fa-times-circle"></i></span>
            <div class="layout-thumbnail-reply-visible-message">
                <div id="image-id-reply-visible-message" class="img-class-reply-visible-message">
                </div>
                <div class="text-input-thumbnail-reply-visible-message d-flex align-items-center">
                    <i class="fa fa-mail-reply icon-reply-thumbnail-reply-visible-message mr-1"></i>
                    <span class="text-name-reply mr-1">Trả lời</span>
                    <span id="name-reply-name" class="name-reply-visible-message mr-1"></span>
                    <br/>
                    <span class="footer-text-input-thumbnail-reply-visible-message"></span>
                </div>
            </div>
        </div>
        <div class="layout-send-notify-visible-message d-none">
            <div class="content d-flex">
                <i class="fa fa-exclamation align-items-center mr-1"></i> Quan trọng <i class="fa fa-times-circle" id="close-send-notify-important-messager"></i>
            </div>
        </div>
        <div class="layout-input-visible-message" style="min-height: 59.9688px">
            <div id="input-message-visible-message" class="input-chat-visible-message"></div>
            <div class="action">
                <emoji-picker class="d-none light" locale="vi"
                              style="position: absolute;right: 10px;bottom: 30px;z-index: 99;"></emoji-picker>
                <div id="emoji-mart"  style="position: absolute;right: 10px;bottom: 50px;z-index: 99;" class="d-none">
                </div>
                <i id="emoji-button-input-visible-message" class="fa fa-smile-o icon-smile-visible-input"
                   data-toggle="tooltip" data-placement="top"
                   data-original-title="Biểu cảm">
                </i>
                <i class="fa fa-thumbs-o-up icon-like-input-visible-message " id="like-input-visible-message"
                   data-toggle="tooltip" data-placement="top"
                   data-original-title="Like">
                </i>
                <i id="button-send-message-visible-message"
                   class="ion-android-send icon-send-visible-message d-none"></i>
            </div>
        </div>
        <div class="layout-audio-visible-message d-none" style="min-height: 59.9688px">
            <div>
                <button class="record_btn" id="button"
                        style="background-color: black;border: none;outline: none;border-radius:50%">
                    <div id="recorder " class="recorder-visible-message"  data-toggle="tooltip" data-placement="top"
                         data-original-title="Nhấn vào để ghi âm">
                        <div id="record-message-visible-message" class="record-item-visible-message">
                            <i class="fa fa-microphone record-microphone-visible-message align-items-center justify-content-center"></i>
                        </div>
                    </div>
                </button>
                <span id="timer" class="time-record-visible-message">00:00</span>
            </div>

            <div class="icon-send-off-record d-flex align-items-center justify-content-center">
                <i class="fa fa-microphone-slash icon-stop-record-visible-message d-none"
                   id="turn-off-record-visible-message" data-toggle="tooltip" data-placement="top"
                   data-original-title="Hủy audio"></i>
                <i id="send-audio-input-visible-message" class="icofont ion-android-send send-audio-visible-message d-none"
                   data-toggle="tooltip" data-placement="top" data-original-title="Gửi audio"></i>
            </div>
        </div>
        <div class="layout-media-input-visible-message d-none">
            <div class="count count-image d-none"><span id="count-image-input-visible-message">0</span> ảnh được chọn
            </div>
            <div class="count count-video d-none"><span id="count-video-input-visible-message">0</span> video được chọn
            </div>
            <div class="count count-file d-none"><span id="count-file-input-visible-message">0</span> file được chọn
            </div>
            <div class="list-media"></div>
        </div>
    </div>
</div>
