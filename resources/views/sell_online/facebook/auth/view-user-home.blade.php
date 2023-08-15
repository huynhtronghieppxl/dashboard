@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>@lang('app.facebook_auth.title')</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="/"> <i class="feather icon-home"></i> </a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="">@lang('app.facebook_auth.breadcrumb')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12 py-5" id="facebook">
                            <div class="mx-auto text-center">
                                <img src="http://themes.techres.vn/images/web/logos/techres_sologan_main_blue_color.png"
                                     width="20%"><br>
                                <h4 class="py-3" id="fb-title">@lang('app.facebook_auth.connectFacebookPage')</h4>
                            </div>
                            <div class="col-lg-10 mx-auto text-center p-3">
                                <div class="col-sm-3 float-left">
                                    <div class="card rounded-card user-card">
                                        <div class="card-block">
                                            <div class="img-hover">
                                                <img class="img-fluid img-radius" src="..\files\assets\images\user-card\img-round1.jpg" alt="round-img">
                                                <div class="img-overlay img-radius">
                                                                <span>
                                                                    <a href="#" class="btn btn-sm btn-primary" data-popup="lightbox"><i class="icofont icofont-plus"></i></a>
                                                                    <a href="" class="btn btn-sm btn-primary"><i class="icofont icofont-link-alt"></i></a>
                                                                </span>
                                                </div>
                                            </div>
                                            <div class="user-content">
                                                <h4 class="">Cedric Kelly</h4>
                                                <p class="m-b-0 text-muted">Network engineer</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9 float-right">
                                    <div id="list-page" class="card">
                                        <div class="row p-3">
                                            <div id="avatar-page" class="col-sm-2">
                                                <img class="media-object img-radius img-60" src="">
                                            </div>
                                            <div class="col-sm-7">
                                                <div id="name-page" class="row">
                                                    <a class="float-left font-weight-bold font-18">Page 1 </a>
                                                </div>
                                                <div id="category-page" class="row">
                                                    <span class="float-left"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 m-auto">
                                                <button class="btn btn-primary m-auto" onclick="">
                                                    @lang('app.facebook_auth.connect')
                                                </button>
                                            </div>
                                        </div> <div class="row p-3">
                                            <div id="avatar-page" class="col-sm-2">
                                                <img class="media-object img-radius img-60" src="">
                                            </div>
                                            <div class="col-sm-7">
                                                <div id="name-page" class="row">
                                                    <a class="float-left font-weight-bold font-18">Page 2</a>
                                                </div>
                                                <div id="category-page" class="row">
                                                    <span class="float-left"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 m-auto">
                                                <button class="btn btn-primary m-auto" onclick="{{route('sell_online.facebook.facebook.auth.view-profile-page')}}">
                                                    @lang('app.facebook_auth.connect')
                                                </button>
                                            </div>
                                        </div> <div class="row p-3">
                                            <div id="avatar-page" class="col-sm-2">
                                                <img class="media-object img-radius img-60" src="">
                                            </div>
                                            <div class="col-sm-7">
                                                <div id="name-page" class="row">
                                                    <a class="float-left font-weight-bold font-18">Page 3</a>
                                                </div>
                                                <div id="category-page" class="row">
                                                    <span class="float-left"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 m-auto">
                                                <button class="btn btn-primary m-auto" onclick="{{route('sell_online.facebook.facebook.auth.view-profile-page')}}">
                                                    @lang('app.facebook_auth.connect')
                                                </button>
                                            </div>
                                        </div> <div class="row p-3">
                                            <div id="avatar-page" class="col-sm-2">
                                                <img class="media-object img-radius img-60" src="">
                                            </div>
                                            <div class="col-sm-7">
                                                <div id="name-page" class="row">
                                                    <a class="float-left font-weight-bold font-18">Page 4</a>
                                                </div>
                                                <div id="category-page" class="row">
                                                    <span class="float-left"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 m-auto">
                                                <button class="btn btn-primary m-auto" onclick="{{route('sell_online.facebook.facebook.auth.view-profile-page')}}">
                                                    @lang('app.facebook_auth.connect')
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js\sell_online\facebook\index.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

