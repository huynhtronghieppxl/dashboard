<div id="header-visible-message">
    <div class="mesg-area-head d-flex justify-content-between align-items-center">
        <div class="active-user d-flex align-items-center">
            <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}" src="{{asset('images/friend-avatar3.jpg',env('IS_DEPLOY_ON_SERVER'))}}" alt="avatar" />
            <div class="header-chat-info">
                <h6 class="header-chat-name">Nhóm 1</h6>
                <div class="header-info-visible-message" id="header-info-group-visible-message">
                    <i class="fa fa-user header-info-group-visible-message-icon" style="font-size: 17px;"></i>
                    <span class="header-chat-number_employee"></span>
                </div>
                <div id="role-name-visible-message"></div>
            </div>
        </div>
        <ul class="live-calls">
            <li class="tag-name-message" id="pin-message-item"><i class="fi-rr-thumbtack icon-font-size-22" data-toggle="tooltip" data-placement="top" data-original-title="Tin nhắn đã ghim"></i></li>
            <li class="tag-name-message" id="tag-name-message" onclick="getTagNameMessage($(this))"><i class="fi-rr-bell" data-toggle="tooltip" data-placement="top" data-original-title="Tin nhắn nhắc tới bạn"></i></li>
            <li class="audio-call" id="start-call"><i class="fi-rr-phone-call" data-toggle="tooltip" data-placement="top" data-original-title="Gọi audio"></i></li>
            <li class="video-call" id="start-video-call"><i class="fi-rr-camera" data-toggle="tooltip" data-placement="top" data-original-title="Gọi video "></i></li>
            <li>
                <div class="active-btn-info">
                    <i class="fi-rr-angle-double-small-right icon-close-about"></i>
                    <i class="fi-rr-angle-double-small-left icon-open-about d-none"></i>
                </div>
            </li>
        </ul>
        <div class="pin-message-list-dropdown">
            <div class="pin-details-content-item-visible-message position-relative" data-id="" data-random-key="">
                <div class="pin-details-content-item-header">
                    <img class="pin-details-content-image-header" onerror="imageDefaultOnLoadError($(this))" loading="lazy" src="" />
                    <span class="name-user-pined-content">
                        <div class="pin-details-content-item-bottom d-flex">
                            <div class="name-pinner"></div>
                            <span class="date-pinned-message"></span>
                        </div>
                        <i class="ion-chatboxes icon-type-pinned">Tin ghim</i>
                    </span>
                </div>
                <div class="full-message-pinned body-visible-message">
                    <div class="image-pin-contain">
                        <div class="pin-details-content-item-body">
                            <img class="pin-details-content-image-body" onerror="imageDefaultOnLoadError($(this))" loading="lazy" src="" />
                            <div class="name-content-pinned-body">
                                <span class="name-user-pined-body-content"></span>
                                <div class="content-pined-visible-message">
                                    <div class="chat-body-message"></div>


{{--                                    <div class="content-pined-visible-message-img">--}}
{{--                                        <div class="wrapper five-image">--}}
{{--                                            <div class="gallery">--}}
{{--                                                <div class="gallery__item gallery__item--1">--}}
{{--                                                    <a href="javascript:void(0)" class="gallery__link">--}}
{{--                                                        <img--}}
{{--                                                            onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"--}}
{{--                                                            src="http://172.16.2.255:1488/public/resource/TMS/FOOD/748/1359/3026/2022/10/7-10-2022/image/original/web-1665118309-Anh-gai-xinh-Viet-Nam-mu-hong.jpg"--}}
{{--                                                            class="gallery__image"--}}
{{--                                                            loading="lazy"--}}
{{--                                                        />--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="gallery__item gallery__item--2">--}}
{{--                                                    <a href="javascript:void(0)" class="gallery__link">--}}
{{--                                                        <img--}}
{{--                                                            onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"--}}
{{--                                                            src="http://172.16.2.255:1488/public/resource/TMS/FOOD/748/1359/3026/2022/10/7-10-2022/image/original/web-1665118310-Anh-gai-xinh-Viet-Nam-ngau-lanh-lung.jpg"--}}
{{--                                                            class="gallery__image"--}}
{{--                                                            loading="lazy"--}}
{{--                                                        />--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="gallery__item gallery__item--3">--}}
{{--                                                    <a href="javascript:void(0)" class="gallery__link">--}}
{{--                                                        <img--}}
{{--                                                            onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"--}}
{{--                                                            src="http://172.16.2.255:1488/public/resource/TMS/FOOD/748/1359/3026/2022/10/7-10-2022/image/original/web-1665118311-dssddsfsdf.jpg"--}}
{{--                                                            class="gallery__image"--}}
{{--                                                            loading="lazy"--}}
{{--                                                        />--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="gallery__item gallery__item--4">--}}
{{--                                                    <a href="javascript:void(0)" class="gallery__link">--}}
{{--                                                        <img--}}
{{--                                                            onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"--}}
{{--                                                            src="http://172.16.2.255:1488/public/resource/TMS/FOOD/748/1359/3026/2022/10/7-10-2022/image/original/web-1665118312-Girl-xinh-Viet-Nam-dep.jpg"--}}
{{--                                                            class="gallery__image"--}}
{{--                                                            loading="lazy"--}}
{{--                                                        />--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="gallery__item gallery__item--5">--}}
{{--                                                    <a href="javascript:void(0)" class="gallery__link">--}}
{{--                                                        <img--}}
{{--                                                            onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"--}}
{{--                                                            src="http://172.16.2.255:1488/public/resource/TMS/FOOD/748/1359/3026/2022/10/7-10-2022/image/original/web-1665118313-Hinh-anh-gai-xinh-Viet-Nam-ao-dai-trang.jpg"--}}
{{--                                                            class="gallery__image"--}}
{{--                                                            loading="lazy"--}}
{{--                                                        />--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
