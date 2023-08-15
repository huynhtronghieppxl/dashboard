@extends('auth.layout') @section('content')
    <style>
        .toggle-verify-password {
            position: absolute;
            right: 10px;
            margin-top: -25px;
            z-index: 9;
        }

        video {
            width: 100%;
            height: 100vh;
            object-fit: cover;
            z-index: 1;
        }

        .bg-video-wrap {
            position: relative;
            overflow: hidden;
            width: 100%;
            height: 100vh;
        }

        .toggle-sound {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: #ec407a;
            width: 55px;
            height: 55px;
            line-height: 55px;
            text-align: center;
            color: #fff;
            border-radius: 50%;
            cursor: pointer;
            z-index: 99;
            animation: pulse 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
            box-shadow: 0 0 0 0 #f06292;
        }

        .toggle-sound.sound-mute {
            box-shadow: none;
        }

        @-webkit-keyframes pulse {
            to {
                box-shadow: 0 0 0 45px rgba(232, 76, 61, 0);
            }
        }

        @-moz-keyframes pulse {
            to {
                box-shadow: 0 0 0 45px rgba(232, 76, 61, 0);
            }
        }

        @-ms-keyframes pulse {
            to {
                box-shadow: 0 0 0 45px rgba(232, 76, 61, 0);
            }
        }

        @keyframes pulse {
            to {
                box-shadow: 0 0 0 45px rgba(232, 76, 61, 0);
            }
        }

        .sound {
            width: 97%;
            height: 100%;
            position: absolute;
            cursor: pointer;
            display: inline-block;
            left: 0;
            top: 0;
            margin-left: -15%;
        }

        .sound--icon {
            color: inherit;
            line-height: inherit !important;
            font-size: 1.6rem !important;
            display: block !important;
            margin: auto;
            text-align: left;
            padding-left: 20px;
        }

        .sound--wave {
            position: absolute;
            border: 2px solid transparent;
            border-right: 2px solid #fff;
            border-radius: 50%;
            transition: all 200ms;
            margin: auto;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }

        .sound--wave_one {
            width: 45%;
            height: 40%;
        }

        .sound--wave_two {
            width: 70%;
            height: 62%;
        }

        .sound--wave_three {
            width: 95%;
            height: 75%;
        }

        .sound-mute .sound--wave {
            border-radius: 0;
            width: 35%;
            height: 35%;
            border-width: 0 2px 0 0;
            left: 5px;
        }

        .sound-mute .sound--wave_one {
            transform: rotate(45deg) translate3d(0, -50%, 0);
        }

        .sound-mute .sound--wave_two {
            transform: rotate(-45deg) translate3d(0, 50%, 0);
        }

        .sound-mute .sound--wave_three {
            opacity: 0;
            transform: translateX(-46%);
            height: 20%;
        }

        .box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            padding: 40px;
            background: rgba(0, 0, 0, 0.4);
            box-sizing: border-box;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.5);
            border-radius: 10px;
        }

        .box h2 {
            margin: 0 0 30px;
            padding: 0;
            color: #fff;
            text-align: center;
        }

        .box .inputBox {
            position: relative;
        }

        .box .inputBox input {
            width: 100%;
            padding: 10px 0;
            font-size: 16px;
            color: #fff;
            letter-spacing: 1px;
            margin-bottom: 30px;
            border: none;
            border-bottom: 1px solid #fff;
            outline: none;
            background: transparent;
        }

        .box .inputBox label {
            top: -19px;
            left: 0;
            color: #03a9f4;
            font-size: 12px;
            position: absolute;
            padding: 10px 0;
            pointer-events: none;
            transition: 0.5s;
            animation: LabelOnLoad 1s forwards 0s ease;
        }

        @keyframes LabelOnLoad {
            0% {
                transform: rotate(0) translateY(-19px);
                opacity: 0;
            }
            100% {
                transform: rotate(0) translateY(0);
                opacity: 1;
            }
        }

        .box .inputBox input:focus ~ label,
        .box .inputBox input:valid ~ label {
            top: -19px;
            left: 0;
            color: #03a9f4;
            font-size: 12px;
        }

        .box input[type="submit"] {
            background: transparent;
            border: none;
            outline: none;
            color: #fff;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
        }

        .box input[type="submit"]:hover {
            background-color: rgba(3, 169, 244, 0.7);
        }
    </style>
    <div class="unmuted toggle-sound sound-mute" href="#">
        <div class="tooltip--left sound" data-tooltip="Turn On/Off Sound">
            <div class="sound--icon fa fa-volume-off"></div>
            <div class="sound--wave sound--wave_one"></div>
            <div class="sound--wave sound--wave_two"></div>
            <div class="sound--wave sound--wave_three"></div>
        </div>
    </div>
    <audio id="audio-login">
        <source src="{{asset('/audio/forest-lullaby-110624.mp3')}}" type="audio/mp3" />
    </audio>
    <div class="bg-video-wrap">
        <video src="{{asset('/images/tms/pexels-george-morina-5821366.mp4')}}" loop muted autoplay></video>
        <div class="wrapper wrapper-full-page" style="position: absolute; width: 100%;">
            <div class="full-page login-page" filter-color="black">
                <div class="content" style="width: 100%;">
                    <div id="form-login-dashboard" style="width: 25%; min-width: 350px !important; margin: auto;">
                        <form method="post" action="/login" id="login-form" style="display: block; padding: 35px;">
                            {{ csrf_field() }}
                            <div class="card card-login card-hidden text-center">
                                <div class="card-header text-center" data-background-color="yellow">
                                    <h4 class="card-title">@lang('modules.employee.name')</h4>
                                </div>
                                <p class="text-center txt_alert" style="color: red !important; display: none;"></p>
                                <label class="label label-danger text-center alert-caplock-password d-none">@lang('modules.employee.caplock')</label>
                                <div class="card-content">
                                    <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">home</i>
                                    </span>
                                        <div class="form-group label-floating">
                                            <label class="control-label">@lang('modules.employee.restaurant_name')</label>
                                            <input type="text" class="form-control restaurant_name" data-emoji="1" data-min-length="2" data-max-length="50" autocomplete="off" name="restaurant_name" />
                                        </div>
                                    </div>
                                    <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">face</i>
                                    </span>
                                        <div class="form-group label-floating">
                                            <label class="control-label">@lang('modules.employee.username')</label>
                                            <input type="text" class="form-control username" data-spec="1" data-max-length="10" autocomplete="off" name="username" />
                                        </div>
                                    </div>
                                    <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">lock_outline</i>
                                    </span>
                                        <div class="form-group label-floating">
                                            <label class="control-label">@lang('modules.employee.password')</label>
                                            <input type="password" class="form-control password" data-emoji="1" data-max-length="8" autocomplete="off" name="password" />
                                            <input type="hidden" class="form-control device_uid" autocomplete="off" name="device_uid" />
                                            <span class="fa fa-fw fa-eye-slash field-icon toggle-verify-password pointer"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer text-center">
                                    <button type="button" class="btn btn-rose btn-simple btn-wd btn-lg btn_login" style="background: #ffa233; color: #fff; border-radius: 25px;width: 90%; padding: 12px 36px !important; font-size: 12px !important;">@lang('modules.employee.login')</button>
                                    <br/>
                                    <div id="btn-forgot-password">
                                        <i class="material-icons cursor-pointer" style="color: #bfbfbf;">help_outline</i><br />
                                        <a href="javascript:void(1)" class="control-label" style="color: #0a6aa1; font-size: 13px; font-weight: bold; margin-top: 12px; display: block;">QUÊN MẬT KHẨU</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('auth.forgot_password') @endsection @section("scripts")
    <script>
        $(".toggle-sound").click(function () {
            $(this).toggleClass("sound-mute");
            if ($(this).hasClass("sound-mute")) {
                $("#audio-login")[0].pause();
            } else {
                $("#audio-login")[0].play();
            }
        });
    </script>
    <script type="text/javascript" src="{{asset('js\auth\login.js?version=81', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript" src="{{asset('js\auth\forgot_password.js?version=81', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-messaging.js"></script>
    <!-- Firebase -->
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase.js"></script>
    <script type="text/javascript" src="{{asset('js\auth\config_firebase.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endsection
