<link rel="stylesheet" href="{{asset('css/css_custom/message/visible_ver2/slider.css')}}">
<div id="modal-see-all-images-visible-message">
    <div class="modal-show-grid-images">
        <div class="modal-show-grid-image-header">
            <div class="modal-show-grid-image-name-group" id="name-conversation-slider-visible-message"></div>
            <i class="modal-show-grid-image-toolbar-icon ti-close" id="close-modal-preview-image"></i>
        </div>
        <div class="modal-show-grid-image-thumbnail d-none">
            <div class="column modal-show-grid-images-column">

            </div>
        </div>
        <div class="modal-show-grid-image-preview d-flex">
            <div class="modal-show-grid-image-preview-images">
                <div id="data-image-carousel-visible-message" class="modal-show-img-center-preview">
                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="modal-show-grid-image-preview-image" src="" id="image-view-conversation-slider-visible-message"/>
                    <div class="play-btn-video-slide" onclick="viewVideoSlide($(this))">
                        <i class="fa fa-play"></i>
                    </div>
                </div>
                <a class="modal-show-grid-image-preview-left-button" href="">
                    <i class="modal-show-grid-image-preview-button-icon ti-angle-left"></i>
                </a>
                <a class="modal-show-grid-image-preview-right-button" href="">
                    <i class="modal-show-grid-image-preview-button-icon ti-angle-right"></i>
                </a>
            </div>
            <div class="modal-show-grid-image-preview-right">
                <div class="timeline-slider">
                    <div class="timeline-slider__track">
                        <div class="timeline-slider__track__progress hover-track"></div>
                    </div>
                    <div class="timeline-slider__pivot timeline-slider__pivot--left"></div>
                    <div class="timeline-slider__pivot timeline-slider__pivot--right"></div>
                    <div class="timeline-slider__handle">
                        <div class="timeline-slider__tooltip"></div>
                    </div>
                </div>
                <div class="slide-wrapper-carousel">
                    {{--                    <span class="slide-carousel-time">Hôm nay</span>--}}
                    <div class="slider-about-scroll-message pr-1" id="slider-image-about-detail-visible-message">

                    </div>
                </div>
            </div>
        </div>
        <div class="modal-show-grid-image-toolbar">
            <div class="modal-show-grid-image-sender">
                <img onerror="imageDefaultOnLoadError($(this))" class="modal-show-grid-image-sender-avatar" id="avatar-sender-conversation-slider-visible-message" src=""/>
                <div class="modal-show-grid-image-sender-info">
                    <div class="modal-show-grid-image-sender-name" id="name-sender-conversation-slider-visible-message"></div>
                    <div class="modal-show-grid-image-sender-time">
                        <p class="modal-show-grid-image-sender-hour" id="time-conversation-slider-visible-message"></p>
                    </div>
                </div>
            </div>
            <div class="modal-show-grid-image-toolbar-action">
                <i class="modal-show-grid-image-toolbar-icon ti-download" id="downloadImage" title="Tải về"></i>
                <i class="modal-show-grid-image-toolbar-icon fa fa-rotate-left" title="Xoay trái"></i>
                <i class="modal-show-grid-image-toolbar-icon fa fa-rotate-right" title="Xoay phải"></i>
                <i class="modal-show-grid-image-toolbar-icon ti-zoom-in" title="Phóng to"></i>
                <i class="modal-show-grid-image-toolbar-icon ti-zoom-out" title="Thu nhỏ"></i>
            </div>
            <i class="modal-show-grid-image-toolbar-icon fa fa-columns"></i>
        </div>
    </div>
</div>

