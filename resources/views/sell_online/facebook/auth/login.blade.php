@extends('layouts.layout') @section('content')
    <link rel="stylesheet" href="{{asset('css/css_custom/social/social.css')}}" />
    <div class="page-wrapper" id="box-view-content-auth-facebook">
        <div class="page-body">
            <div class="row social-login align-items-center" style="background: linear-gradient(90deg, #dae6fc 0%, #edf7f6 100%);">
                <div class="col-7" id="content-connect-left-auth-facebook">
                    <div class="content-banner-connect">
                        <img id="logo-body-auth-facebook" class="banner-content" src="{{asset('images/image_facebook/image-removebg-preview.png')}}" alt="Banner" />
                    </div>
                </div>
                <div class="col-5" id="content-connect-right-auth-facebook" style="background-color: #f8a136;">
                    <div class="login-title-right">
                        <a class="link-facebook-button-dashboard" href="{{route('sell_online.facebook.facebook.redirect')}}">
                            <div class="social-network-custom d-flex">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="{{asset('images/image_facebook/facebook.png')}}" alt="" />
                                </div>
                                <div class="w-100">
                                    <div class="content-btn-link-item">
                                        <div class="title-social-item-content">
                                            <div class="title-content-main">Facebook</div>
                                            <div class="title-content-sub">Liên kết với Facebook để tăng năng suất bán hàng</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection @push('scripts')
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0&appId=322799719507107&autoLogAppEvents=1" nonce="U99xxwbJ"></script>
    <script type="text/javascript" src="{{asset('js/sell_online/facebook/index.js?version=81', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
