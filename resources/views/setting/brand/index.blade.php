@extends('layouts.layout')
@section('content')
    <div class="page-body">
        <div class="row mt-3" id="list-brand-setting"></div>
        <div class="row d-none" id="brand-profile-setting">
            <div class="col-lg-12">
                <div class="cover-profile">
                    <div class="profile-bg-img bg-white-border box-image"
                         style="background-color: white;">
                        <figure class="box-image-banner-branch" style="min-height: 180px">
                            <div class="edit-pp">
                                <label class="fileContainer">
                                    <i class="fa fa-camera"></i>
                                    <input type="file" id="upload-brand-banner">
                                </label>
                            </div>
                            <img onerror="bannerDefaultOnLoadError($(this))" id="thumbnail-brand-banner"
                                 src="{{asset('/images/tms/NoImageFound.png', env('IS_DEPLOY_ON_SERVER'))}}" alt=""
                                 data-banner="">
                            <ul class="profile-controls"
                                style="background: #e8e3e3bd none repeat scroll 0 0 !important;">
                                {{--                                <a class="nav-link btn-p-0" data-toggle="tab" style="cursor: pointer"--}}
                                {{--                                   id="btn-back-list-brand"--}}
                                {{--                                   role="tab">Quay lại--}}
                                {{--                                </a>--}}
                                {{--                                <a class="nav-link active btn-p-0" data-toggle="tab"--}}
                                {{--                                   data-status="0"--}}
                                {{--                                   href="#brand-setting-tab1" data-type="0"--}}
                                {{--                                   role="tab" onclick="activeTab($(this))">@lang('app.brand-setting.tab1.title')--}}
                                {{--                                </a>--}}
                                {{--                                <a class="nav-link btn-p-0" data-toggle="tab"--}}
                                {{--                                   data-status="1"--}}
                                {{--                                   href="#brand-setting-tab3" data-type="0"--}}
                                {{--                                   role="tab" onclick="activeTab($(this))">@lang('app.brand-setting.procedure.title')--}}
                                {{--                                </a>--}}
                                {{--                                <a class="nav-link btn-p-0" data-toggle="tab" href="#brand-setting-tab2"--}}
                                {{--                                   data-status="2"--}}
                                {{--                                   data-type="1"--}}
                                {{--                                   role="tab" onclick="activeTab($(this))">@lang('app.brand-setting.tab2.title')--}}
                                {{--                                </a>--}}
                                <li data-toggle="tooltip"
                                    data-placement="top"
                                    data-original-title="@lang('app.sweet_alert.button.back')">
                                    <a class="btn-p-0 bg-inverse text-black seemt-bg-gray" id="btn-back-list-brand"
                                       style="cursor: pointer">
                                        <i class="fi-rr-undo"></i>
                                    </a>
                                </li>
                                <li data-toggle="tooltip"
                                    data-placement="top"
                                    data-original-title="@lang('app.brand-setting.tab1.title')">
                                    <a class="nav-link btn-p-0" data-toggle="tab"
                                       data-status="0"
                                       href="#brand-setting-tab1" data-type="0"
                                       role="tab" onclick="activeTab($(this))">
                                        <i class="fi-rr-home"></i>
                                    </a>
                                </li>

                                <li data-toggle="tooltip"
                                    data-placement="top"
                                    data-original-title="@lang('app.brand-setting.procedure.title')">
                                    <a class="nav-link btn-p-0" data-toggle="tab"
                                       data-status="1"
                                       href="#brand-setting-tab3" data-type="0"
                                       role="tab" onclick="activeTab($(this))">
                                        <i class="fi-rr-list"></i>
                                    </a>
                                </li>

                                <li data-toggle="tooltip"
                                    data-placement="top"
                                    data-original-title="@lang('app.brand-setting.tab2.title')">
                                    <a class="nav-link btn-p-0 btn-warning" data-toggle="tab" href="#brand-setting-tab2"
                                       data-status="2"
                                       data-type="1"
                                       role="tab" onclick="activeTab($(this))">
                                        <i class="fi-rr-settings"></i>
                                    </a>
                                </li>
                                {{--                                <li data-toggle="tooltip"--}}
                                {{--                                    data-placement="top"--}}
                                {{--                                    data-original-title="@lang('app.sweet_alert.button.save')">--}}
                                {{--                                    <a class="btn-p-0 bg-primary" onclick="saveUpdateInfoBrand()" style="cursor: pointer"--}}
                                {{--                                       id="btn-save-update-brand-setting"><i--}}
                                {{--                                            class="typcn typcn-download-outline"></i></a>--}}
                                {{--                                </li>--}}
                            </ul>
                        </figure>
                        <div class="col-lg-12 profile-section" style="position: absolute; bottom: 20px">
                            <div class="row">
                                <div class="col-lg-2 col-sm-2">
                                    <div class="profile-branch">
                                        <div class="profile-branch-thumb">
                                            <img onerror="imageDefaultOnLoadError($(this))" alt="author"
                                                 src="{{asset('/images/tms/NoImageFound.png', env('IS_DEPLOY_ON_SERVER'))}}"
                                                 id="thumbnail-brand-logo"
                                                 data-logo="">
                                            <div class="edit-branch pointer">
                                                <label class="fileContainer pointer">
                                                    <i class="fa fa-camera"></i>
                                                    <input type="file" class="d-none" id="upload-brand-logo"
                                                           accept="image/*">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-sm-10">
                                    <div class="author-content" style="background-color: rgba(255,255,255,0.8)">
                                        <a class="custom-name" id="brand-detail-setting-name"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="tab-content p-0">
                    <div class="tab-pane active" id="brand-setting-tab1"
                         role="tabpanel" aria-expanded="true">
                        @include('setting.brand.info')
                    </div>
                    <div class="tab-pane" id="brand-setting-tab2" role="tabpanel" aria-expanded="true">
                        @include('setting.brand.setting')
                    </div>
                    <div class="tab-pane" id="brand-setting-tab3" role="tabpanel" aria-expanded="true">
                        @include('setting.brand.paradigm')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
{{--    @include('layouts.oldDatatable')--}}
    <script type="text/javascript"
            src="{{ asset('js/setting/brand/index.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{ asset('js\setting\brand\media.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{asset('js/setting/brand/detail.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{asset('js/setting/brand/detail_procedure.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
