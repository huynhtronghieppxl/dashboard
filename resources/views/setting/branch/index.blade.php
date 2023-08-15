@extends('layouts.layout')
@section('content')
    <style>
        #map-canvas {
            height: 100%;
            margin: 0;
            padding: 0
        }

        canvas[resize] {
            width: 100%;
            height: 100%;
        }

        .controls {
            margin-top: 16px;
            border: 1px solid transparent;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 32px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        #pac-input {
            bacground-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 400px;
        }

        #type-selector label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }

    </style>
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row" id="list-branch-setting"></div>
                <div class="row d-none" id="div-branch-setting">
                    <div class="col-lg-12">
                        <div class="cover-profile">
                            <div class="profile-bg-img bg-white-border box-image" id="branch-cover-image"
                                 style="background-color: white;">
                                <figure class="box-image-banner-branch">
                                    <img onerror="imageDefaultOnLoadError($(this))" id="thumbnail-branch-banner"
                                         src="{{asset('/images/tms/default-banner-error.png', env('IS_DEPLOY_ON_SERVER'))}}"
                                         alt="">
                                    <ul class="profile-controls">
                                        <li data-toggle="tooltip"
                                            data-placement="top"
                                            data-original-title="@lang('app.sweet_alert.button.back')">
                                            <a class="btn-p-0 pointer bg-inverse" id="btn-back-list-branch">
                                                <i class="fi-rr-undo"></i>
                                            </a>
                                        </li>
                                        <li data-toggle="tooltip"
                                            data-placement="top"
                                            data-original-title="@lang('app.branch-setting.tab1.title')">
                                            <a class="pointer nav-link btn-p-0"
                                               data-status="0"
                                               data-type="1"
                                               aria-expanded="true" onclick="activeTab($(this))">
                                                <i class="fi-rr-home"></i>
                                            </a>
                                        </li>
                                        <li data-toggle="tooltip"
                                            data-placement="top"
                                            data-original-title="@lang('app.branch-setting.tab2.title')">
                                            <a class="nav-link pointer btn-p-0"
                                               data-type="2" data-status="1" onclick="activeTab($(this))">
                                                <i class="fi-rr-settings"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </figure>
                                <div class="col-lg-12 profile-section" style="position: absolute; bottom: 20px">
                                    <div class="row">
                                        <div class="col-lg-2 col-sm-2">
                                            <div class="profile-branch">
                                                <div class="profile-branch-thumb">
                                                    <img onerror="imageDefaultOnLoadError($(this))" alt="author"
                                                         id="thumbnail-branch-logo">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-10 col-sm-10">
                                            <div class="author-content"
                                                 style="cursor: pointer;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;width: 70%;background: #e8e3e3bd none repeat scroll 0 0 !important;">
                                                <a class="custom-name" id="branch-detail-setting-name"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card-block p-0">
                            <div class="active" id="branch-setting-tab-1"
                                 aria-expanded="true">
                                @include('setting.branch.info')
                            </div>
                            <div class="" id="branch-setting-tab-2"
                                 aria-expanded="true">
                                @include('setting.branch.setting')
                            </div>
                            <div class="" id="branch-setting-tab-3"
                                 aria-expanded="true">
                                @include('setting.branch.image')
                            </div>
                            <div class="" id="branch-setting-tab-4"
                                 aria-expanded="true">
                                @include('setting.branch.media')
                            </div>
                        </div>
                    </div>
                </div>
                <div id="image-viewer">
                    <span class="close"><i class="fa fa-times"></i></span>
                    <img class="modal-content" id="full-image">
                </div>
            </div>
        </div>
    </div>
    @include('setting.branch.upload_img')
    @include('setting.branch.qr_code')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_kivDJr-HorR-NapGDs97CYG3uY0TxXU&libraries=geometry,places&v=weekly"></script>
    <script type="text/javascript" src="{{asset('/js/setting/branch/index.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
