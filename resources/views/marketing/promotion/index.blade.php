@extends('layouts.layout')
@section('content')
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row mt-3" id="list-promotion-landing">
                    <div class="col-xl-6 col-lg-12 edit-flex-auto-fill">
                        <div class="box-image" style="height: max-content">
                            <figure class="box-image-banner">
                                <img src="{{asset('images/banner_default.jpg',env('IS_DEPLOY_ON_SERVER'))}}"
                                     alt="" class="thumbnail-banner">
                                <ul class="profile-controls">
                                    <li data-toggle="tooltip" data-original-title="" data-placement="top">
                                        <div class="pointer branch-setting-detail bg-primary btn-radius-50"
                                             onclick="openHappyTimePromotion()">
                                            <i class="fa fa-eye"></i>
                                        </div>
                                    </li>
                                </ul>
                            </figure>
                            <div class="col-12" style="position: absolute; bottom: 20px">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="profile-branch">
                                            <div class="profile-branch-thumb">
                                                <img alt="author" onerror="this.src='/images/tms/default.jpeg'"
                                                     class="thumbnail-branch-logo-booking"
                                                     src="{{asset('images/techres_logo.jpg',env('IS_DEPLOY_ON_SERVER'))}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="author-content">
                                            <a class="custom-name">Happy Time</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12 edit-flex-auto-fill">
                        <div class="box-image" style="height: max-content">
                            <figure class="box-image-banner">
                                <img src="{{asset('images/abc.jpeg',env('IS_DEPLOY_ON_SERVER'))}}"
                                     alt="" class="thumbnail-banner">
                                <ul class="profile-controls">
                                    <li data-toggle="tooltip" data-original-title="" data-placement="top">
                                        <div class="pointer branch-setting-detail bg-primary btn-radius-50"
                                             onclick="openVoucherPromotion()">
                                            <i class="fa fa-eye"></i>
                                        </div>
                                    </li>
                                </ul>
                            </figure>
                            <div class="col-12" style="position: absolute; bottom: 20px">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="profile-branch">
                                            <div class="profile-branch-thumb">
                                                <img alt="author" onerror="this.src='/images/tms/default.jpeg'"
                                                     class="thumbnail-branch-logo-booking"
                                                     src="{{asset('images/techres_logo.jpg',env('IS_DEPLOY_ON_SERVER'))}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="author-content">
                                            <a class="custom-name">Voucher</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12 edit-flex-auto-fill">
                        <div class="box-image" style="height: max-content">
                            <figure class="box-image-banner">
                                <img src="{{asset('images/happy-hour.webp',env('IS_DEPLOY_ON_SERVER'))}}"
                                     alt="" class="thumbnail-banner">
                                <ul class="profile-controls">
                                    <li data-toggle="tooltip" data-original-title="" data-placement="top">
                                        <div class="pointer branch-setting-detail bg-primary btn-radius-50"
                                             onclick="openHappyHourPromotion()">
                                            <i class="fa fa-eye"></i>
                                        </div>
                                    </li>
                                </ul>
                            </figure>
                            <div class="col-12" style="position: absolute; bottom: 20px">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="profile-branch">
                                            <div class="profile-branch-thumb">
                                                <img alt="author" onerror="this.src='/images/tms/default.jpeg'"
                                                     class="thumbnail-branch-logo-booking"
                                                     src="{{asset('images/techres_logo.jpg',env('IS_DEPLOY_ON_SERVER'))}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="author-content">
                                            <a class="custom-name">Happy Hour</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('marketing.promotion.happy_time.index')
                @include('marketing.promotion.voucher.index')
                @include('marketing.promotion.happy_hour.index')
            </div>
        </div>
    </div>
    <div id="mySidenav-321" class="sidenav">
        <a href="javascript:void(0)" id="button-service-1" class="bg-primary"
           onclick="openModalButtonOnePromotion()" style="width: max-content">
            <i class="fa fa-plus-square"></i>&emsp; @lang('app.component.button.create')
        </a>
        <a href="javascript:void(0)" id="button-service-2" class="bg-warning"
           onclick="openModalAssignFoodHappyTimePromotion()" style="width: max-content">
            <i class="fa fa-exchange"></i>&emsp; Gán món
        </a>
    </div>
@endsection
@push('scripts')
    @include('layouts.oldDatatable')
    <script type="text/javascript" src="{{asset('js/marketing/promotion/index.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
