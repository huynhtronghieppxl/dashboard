<style>
    #modal-call-visible-message {
        background: transparent
    }

    #modal-call-visible-message .modal-content {
        /*height: 60vh;*/
        /*max-height: 500px;*/
        height: 450px;
        width: 300px;
    }

    .background-image-call-visible-message,.background-image-call-visible-message-me,.background-image-call-visible-message-you {
        margin: 10px;
        height: calc(100% - 20px);
        filter: blur(10px);
        width: calc(100% - 20px);
    }

    .background-div-call-visible-message {
        position: absolute;
        margin: auto;
        width: 100%;
        text-align: center;
        background-color: #000000bd;
        height: 100%;
        border-radius: 5px;
        border: 1px solid #000000;
    }

    .header-call-visible-message,.header-call-visible-message-you {
        position: absolute;
        width: 100%;
        height: 30px;
        top: 0;
        background-color: #0000008c;
        color: #afafaf;
        text-align: center;
        padding-top: 3px;
        font-weight: bold;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .body-call-visible-message{
        position: absolute;
        width: 100%;
        height: calc(100% - 70px);
        top: 30px;
        text-align: center;
    }.body-call-visible-message-you {
        position: absolute;
        width: 100%;
        height: calc(100% - 70px);
        top: 30px;
        text-align: center;
    }
    .body-call-visible-message img{
        height: 100px;
        width: 100px;
        filter: none;
        border-radius: 100%;
        /*margin-top: calc(50% - 65px);*/
        margin-top: 74px;
    }
   .body-call-visible-message video{
        height: 100%;
        width: 100%;
        filter: none;
        position: absolute;

    }
    .body-call-visible-message-you img, .body-call-visible-message-you video{
        height: 100px;
        width: 100px;
        filter: none;
        border-radius: 100%;
        border: 3px solid #7f7f7f;
        margin-top: calc(50% - 65px);
    }

    .calling-animation {
        animation: calling 1.5s ease-out infinite;
    }

    @keyframes calling {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.1);
        }
        20% {
            box-shadow: 0 0 0 10px rgba(255, 255, 255, 0.1),
            0 0 0 30px rgba(255, 255, 255, 0.1);
        }
        40% {
            box-shadow: 0 0 0 20px rgba(255, 255, 255, 0.1),
            0 0 0 40px rgba(255, 255, 255, 0.1),
            0 0 0 5px rgba(255, 255, 255, 0.1);
        }
        60% {
            box-shadow: 0 0 0 30px rgba(255, 255, 255, 0.1),
            0 0 0 50px rgba(255, 255, 255, 0.1),
            0 0 0 10px rgba(255, 255, 255, 0.1);
        }
        80% {
            box-shadow: 0 0 0 40px rgba(255, 255, 255, 0.1),
            0 0 0 60px rgba(255, 255, 255, 0.1),
            0 0 0 20px rgba(255, 255, 255, 0.1);
        }
        100% {
            box-shadow: 0 0 0 50px rgba(255, 255, 255, 0.1),
            0 0 0 70px rgba(255, 255, 255, 0.1),
            0 0 0 30px rgba(255, 255, 255, 0.1);
        }
    }

    .body-call-visible-message span ,.body-call-visible-message-you span{
        display: block;
        position: absolute;
        color: #86ff8e;
        top: 250px;
        right: 35%;
        font-weight: bold;
    }

    .footer-call-visible-message, .footer-call-visible-message-you{
        position: absolute;
        width: 100%;
        height: 40px;
        background-color: #000000;
        bottom: 0;
        text-align: center;
        border-radius: 0 0 5px 5px;
    }

    .btn-end, .btn-end-video {
        padding: 8px 9px;
        border-radius: 100%;
        background-color: #ff3e3e;
        border: 1px solid #4e4e4e;
        cursor: pointer;
        margin: 3px;
        color: #fff;
    }

    .btn-action {
        border-radius: 100%;
        border: 1px;
        color: #8c8c8c;
        background-color: #484848c4;
        cursor: pointer;
        padding: 4px 7px;
    }

    .btn-setting {
        outline: none;
        border-radius: 100%;
        /*border: 1px;*/
        background-color: #484848c4;
        position: absolute;
        bottom: 6px;
        right: 6px;
        padding: 3px 5px;
        color: #fff;
    }

    .connect-call {
        position: absolute;
        bottom: 10px;
        margin-left: calc(50% - 75px);
    }

    .connect-call .btn-accept,.connect-call .btn-accept-video-you  {
        border-radius: 100%;
        border: 1px solid #4e4e4e;
        cursor: pointer;
        color: #fff;
        background-color: #51d473;
        padding: 8px 11px;
    }

    .connect-call button {
        margin: 0 20px;
    }

    .re-connect-call {
        position: absolute;
        bottom: 10px;
        margin-left: calc(50% - 75px);
    }

    .re-connect-call .btn-re-connect {
        border-radius: 100%;
        border: 1px solid #4e4e4e;
        cursor: pointer;
        color: #fff;
        background-color: #51d473;
        padding: 4px 10px;
    }

    .re-connect-call button {
        margin: 0 20px;
    }

    .counter-animation {
        width: 105px;
        height: 109px;
        position: absolute;
        top: 80px;
        left: 97px;
    }
    .video-call-image-visible-message{
        position: absolute;
        height: 70px !important;
        width: 70px !important;
        /*top: -60%;*/
        /*right: 44%; */
        top: 0px;
        left: 322px;
        margin: auto;
        width: 70px;
        z-index: 1;
    }

    .video-call-local-visibel-message{
        right: 0;
        position: absolute;
        height: 100%;
        width: 100%;
        border: none;
        bakground-color:#111111;
    }
    .status-call-video{
        position: absolute;
        margin: auto;
        right: 42% !important;
        top: 40%;
        color: var(--text-link) !important;
    }
    .video-call-you{
      right: 0;
      background-color: #111111;
    }
    .video-call-accept-visible-message{
        z-index: 2;
        right: 0;
        height: 96px !important;
        width: 132px !important;
    }
    .start-call-video-call-visible-message{
        right:0;
    }
    .time-call-visible-message{
        z-index: 2;
        left: 15px;
        /*position: absolute;*/
    }
    .img-res-accept-video{
        margin-top: 50px !important;
    }
    .video-call-local-visibel-message{
        background-color: #111111;
    }

    .btn-setting:focus {
        outline: none;
    }

    .footer-call-visible-message .btn-mic-call-visible-message .zmdi-mic{
        padding: 0px 2px;
    }

    .footer-call-visible-message .btn-mic-call-visible-message .zmdi-mic-off{
        padding: 0px 0.85px;
    }
</style>

<div class="modal fade show" id="modal-call-visible-message">
    <div class="modal-dialog" style="width: max-content">
        <div class="modal-content">
            <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="background-image-call-visible-message" src="{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}"/>
            <div class="background-div-call-visible-message"></div>
            <div class="header-call-visible-message">Huỳnh Trọng Hiệp</div>
            <div class="body-call-visible-message">
                <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="countdown-animation"  src="{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}"/>
                <svg class="counter-animation">
                    <circle cx="146" cy="52" r="48" id="pink-halo" fill="none" stroke="#12F972" stroke-width="3"
                            stroke-dasharray="0, 361" transform="rotate(-90,100,100)"/>
                </svg>
                <audio id="audio-call-visible-message" class="d-none" controls autoplay> </audio>
                <video id="video-call-visible-message" class="d-none video-call-local-visibel-message"  autoplay=”autoplay” playsinline muted></video>
                <video id="video-call-remote" class="video-call-you d-none" playsinline autoplay=”autoplay”></video>
                <span class="status-call">Đang kết nối ...</span>
                <span class="time-call-visible-message count-time d-none">00:00</span>
                <div class="connect-call d-none">
                    <button class="btn-accept"><i class="zmdi zmdi-phone"></i></button>
                    <button id="main-class" class="btn-end"><i class="zmdi zmdi-phone-end"></i></button>
                </div>
                <div class="re-connect-call d-none">
                    <button class="btn-re-connect"><i class="zmdi zmdi-phone-missed"></i></button>
                    <button class="btn-end"><i class="zmdi zmdi-phone-ring"></i></button>
                </div>
                <span class="on-off-mic d-none">Đối phương đang tắt mic</span>
                <span class="on-off-camera d-none">Đối phương đang tắt camera</span>

            </div>
            <div class="footer-call-visible-message">
                <button class="btn-action btn-camera-call-visible-message" data-toggle="tooltip" data-placement="top"
                        data-original-title="Mở camera"><i class="zmdi zmdi-videocam"></i></button>
                <button class="btn-end btn-cancel-call-visible-message"><i class="zmdi zmdi-phone-end"></i></button>
                <button class="btn-action btn-mic-call-visible-message" data-toggle="tooltip" data-placement="top"
                        data-original-title="Tắt micro" style="outline: none;"><i class="zmdi zmdi-mic"></i>
                </button>
            </div>
            <button class="btn-setting"><i class="zmdi zmdi-settings"></i></button>
        </div>
    </div>
</div>
{{--<div class="modal fade show" id="modal-call-video-visible-message-you">--}}
{{--    <div class="modal-dialog" style="width: max-content">--}}
{{--        <div class="modal-content">--}}
{{--            <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="background-image-call-visible-message-you" src="/images/tms/default.jpeg"/>--}}
{{--            <div class="background-div-call-visible-message"></div>--}}
{{--            <div class="header-call-visible-message-you">Huỳnh Trọng Hiệp</div>--}}
{{--            <div class="body-call-visible-message-you">--}}
{{--                <video id="video-call-visible-message-you" class="d-none"></video>--}}
{{--                <video playsinline autoplay  id="call-video-you"></video>--}}
{{--                <svg class="counter-animation">--}}
{{--                    <circle cx="146" cy="52" r="48" id="pink-halo" fill="none" stroke="#12F972" stroke-width="3" stroke-dasharray="0, 361" transform="rotate(-90,100,100)"/>--}}
{{--                </svg>--}}
{{--                <svg class="counter-animation">--}}
{{--                    <circle cx="146" cy="52" r="48" id="pink-halo" fill="none" stroke="#12F972" stroke-width="3"--}}
{{--                            stroke-dasharray="0, 361" transform="rotate(-90,100,100)"/>--}}
{{--                </svg>--}}

{{--                <span class="status-call">Đang kết nối ...</span>--}}
{{--                <span class="count-time d-none">00:00</span>--}}
{{--                <div class="connect-call d-none">--}}
{{--                    <button class="btn-accept-video-you" id="answerButton"><i class="zmdi zmdi-phone"></i></button>--}}
{{--                    <button class="btn-end" id="hangupButton"><i class="zmdi zmdi-phone-end"></i></button>--}}
{{--                </div>--}}
{{--                <div class="re-connect-call d-none">--}}
{{--                    <button class="btn-re-connect" id="answerButton"><i class="zmdi zmdi-phone-missed"></i></button>--}}
{{--                    <button class="btn-end" ><i class="zmdi zmdi-phone-ring"></i></button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="footer-call-visible-message-you">--}}
{{--                <button class="btn-action btn-camera-call-visible-message" data-toggle="tooltip" data-placement="top"--}}
{{--                        data-original-title="Mở camera"><i class="zmdi zmdi-videocam"></i></button>--}}
{{--                <button class="btn-end btn-cancel-call-visible-message"><i class="zmdi zmdi-phone-end"></i></button>--}}
{{--                <button class="btn-action btn-mic-call-visible-message" data-toggle="tooltip" data-placement="top"--}}
{{--                        data-original-title="Tắt micro" style="padding: 2px 8px;"><i class="zmdi zmdi-mic-off"></i>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <button class="btn-setting"><i class="zmdi zmdi-settings"></i></button>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@push('scripts')
    <script src="{{asset('js/message/visible_v2/call.js?version=2',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('js/message/visible_v2/listen_socket_call.js?version=2',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
