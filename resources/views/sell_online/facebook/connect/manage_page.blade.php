@extends('layouts.layout') @section('content')
    <link rel="stylesheet" href="{{asset('css/css_custom/social/social.css')}}" />
    <div class="page-wrapper" id="manage-page-connect">
        <div class="page-body">
            <div class="manage-page-container">
                <div class="manage-page-body mt-1">
                    <div class="modal-content">
                        <div class="modal-header d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                <h5 class="modal-title mt-0">Danh sách trang</h5>
                                <h5 id="count-all-page-collect" class="d-none"></h5>
                            </div>
                            <span class="manage-page-body-add-connect"><i class="ion-plus"></i> Thêm trang kết nối</span>
                        </div>
                        <div class="modal-body text-left card-item-menu" id="main-contain-list-page">
                            <div class="card-block-big-item-menu d-flex">
                                <div class="item-card-menu-list col-lg-8 pl-0 pr-3" id="list-page-facebook">
{{--                                    <div class="card-item-list-category d-flex align-items-center" data-id="123">--}}
{{--                                        <div class="img-logo-card-item">--}}
{{--                                            <img class="manage-page-card-item-img" src="//graph.facebook.com/105832737844796/picture?type=large" />--}}
{{--                                        </div>--}}
{{--                                        <div class="title-information-card-item">--}}
{{--                                            <div class="content-title-01 d-flex align-items-center">--}}
{{--                                                <p class="manage-page-card-item-content-title">Công ty/Nhà hàng TNHH Thương mại Dịch vụ Thương mại</p>--}}
{{--                                                <div class="checked-icon-box d-none">--}}
{{--                                                    <input type="checkbox" class="check-card-item" />--}}
{{--                                                    <label for="check-card-item"></label>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="title-02-card-item">--}}
{{--                                                <p class="manage-page-card-item-content-title-name">Hào Nguyễn</p>--}}
{{--                                            </div>--}}
{{--                                            <div class="title-03-card-item">--}}
{{--                                                <p class="manage-page-card-item-content-title-email"><a style="color: #007bff;" href="hfaonguyen@gmail.com" target="_blank">hfaonguyen@gmail.com</a></p>--}}
{{--                                                <p class="manage-page-card-item-content-title-status">Chưa kết nối</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <label class="checkbox-control-page-item">--}}
{{--                                            <input type="checkbox" class="checkbox-control-page-item-input" />--}}
{{--                                        </label>--}}
{{--                                    </div>--}}

{{--                                    <div class="card-item-list-category d-flex align-items-center" data-id="456">--}}
{{--                                        <div class="img-logo-card-item">--}}
{{--                                            <img class="manage-page-card-item-img" src="//graph.facebook.com/105832737844796/picture?type=large" />--}}
{{--                                        </div>--}}
{{--                                        <div class="title-information-card-item">--}}
{{--                                            <div class="content-title-01 d-flex align-items-center">--}}
{{--                                                <p class="manage-page-card-item-content-title">Gà một con</p>--}}
{{--                                                <div class="checked-icon-box d-none">--}}
{{--                                                    <input type="checkbox" class="check-card-item" />--}}
{{--                                                    <label for="check-card-item"></label>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="title-02-card-item">--}}
{{--                                                <p class="manage-page-card-item-content-title-name">Hào Nguyễn</p>--}}
{{--                                            </div>--}}
{{--                                            <div class="title-03-card-item">--}}
{{--                                                <p class="manage-page-card-item-content-title-email">hfaonguyen@gmail.com</p>--}}
{{--                                                <p class="manage-page-card-item-content-title-status">Chưa kết nối</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <label class="checkbox-control-page-item">--}}
{{--                                            <input type="checkbox" class="checkbox-control-page-item-input" />--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="item-card-menu-list-check col-lg-4 pr-5">
                                    <div class="item-card-menu-list-check-title">Danh sách trang đã chọn</div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <div class="collect-all-option d-flex"></div>
                            <div>
                                <button id="btn-close-create-specifications" type="button" class="btn btn-grd-disabled" disabled onclick="" onkeypress="">Gỡ kết nối</button>
                                <button id="btn-close-create-connect-page-choosen" type="button" class="btn btn-grd-primary" disabled onclick="connectPage()">Truy cập màn hình</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection @push('scripts')
    <script type="text/javascript" src="{{asset('js/sell_online/facebook/config.js?version=81', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
