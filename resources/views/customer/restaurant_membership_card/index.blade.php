<style>
    .option-info {
        position: relative;
    }

    .option-info .option-info-title {
        position: absolute;
        color: white;
        background: #fa6342;
        top: -25px;
        left: 50%;
        padding: 4px 8px;
        border-radius: 8px 8px 0 0;
        transform: translateX(-50%);
        text-transform: uppercase;
        width: 60%;
        text-align: center;
        font-weight: 500;
    }

    .option-info .option-info-content {
        border: 2px solid #fa6342;
        border-radius: 12px;
        position: relative;
        padding: 24px;
    }
</style>
@extends('layouts.layout')
@section('content')
    {{--    plugin colors--}}
    <link rel="stylesheet" type="text/css"
          href="{{asset('files\bower_components\jquery-minicolors\css\jquery.minicolors.css')}}"/>
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card card-block page-body" id="form-list-branch-membership">
                    @if(Session::get(SESSION_KEY_SETTING_RESTAURANT)['is_enable_membership_card'] === 1)
                        <div class="d-flex justify-content-end" id="action-membership-card" style="align-items: center">
                            <input type="checkbox" checked
                                   class="js-switch" data-check="1"
                                   id="checkbox-setting-membership-card-restaurant"
                                   data-status="{{Session::get(SESSION_KEY_SETTING_RESTAURANT)['is_enable_membership_card']}}"
                                   onchange="changeAllStatusBranchMemberShipCard($(this))">
                            <div class="btn seemt-orange seemt-bg-orange seemt-btn-hover-orange"
                                 onclick="openModalEditSettingMemberShipCard()"
                                 style="padding: 10px 15px!important;display: flex;align-items: center;justify-content: center; margin-left: 10px !important;"
                                 onkeypress="openModalEditSettingMemberShipCard()">
                                <i class="fi-rr-box-alt"></i>
                                <span>Chính sách</span>
                            </div>
                        </div>
                        <div class="row mt-3" id="list-branch-membership">
                            {{-- Danh sách thương hiệu --}}
                            @foreach(Session::get(SESSION_KEY_DATA_BRAND) as $key => $item)
                                <div class="col-xl-6 col-lg-12 edit-flex-auto-fill">
                                    <div class="box-image" style="height: max-content">
                                        <figure class="box-image-banner" style="min-height: 147px">
                                            <img
                                                    src="{{Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $item['banner'] }}"
                                                    alt="" class="thumbnail-banner">

                                            @if($item['setting']['is_enable_membership_card'] === 1)
                                                <ul class="profile-controls" id="list-data-brand">
                                                    <li data-toggle="tooltip" data-original-title=""
                                                        data-placement="top">
                                                        <div
                                                                class="pointer branch-setting-detail seemt-btn-hover-blue waves-effect waves-light btn-radius-50"
                                                                data-type="{{$key}}"
                                                                data-status="{{ $item['status']}}"
                                                                data-id="{{ $item['id']}}"
                                                                data-name="{{ $item['name']}}"
                                                                data-logo="{{Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $item['logo_url'] }}"
                                                                data-banner="{{Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $item['banner'] }}"
                                                                onclick="detailMemberShipCard($(this))">
                                                            <i class="fi-rr-eye"
                                                               style="margin-top: 12px; display: contents"></i>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <ul class="profile-controls"
                                                    style="bottom: auto ; top: 8px !important;">
                                                    <li data-toggle="tooltip" data-original-title=""
                                                        data-placement="top">
                                                        <input type="checkbox"
                                                               class="js-switch"
                                                               data-id="{{ $item['id']}}" data-status="1" checked
                                                               id="brand-restaurant{{$item['id']}}"
                                                               onchange="changeStatusBranchMemberShipCard($(this))">
                                                    </li>
                                                </ul>
                                            @else
                                                <ul class="profile-controls"
                                                    style="bottom: auto ; top: 8px !important;">
                                                    <li data-toggle="tooltip" data-original-title=""
                                                        data-placement="top">
                                                        <input type="checkbox"
                                                               class="js-switch"
                                                               data-id="{{ $item['id']}}" data-status="0"
                                                               id="brand-restaurant{{$item['id']}}"
                                                               onchange="changeStatusBranchMemberShipCard($(this))">
                                                    </li>
                                                </ul>
                                            @endif
                                        </figure>
                                        <div class="col-12" style="position: absolute; bottom: 23px">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="profile-branch">
                                                        <div class="profile-branch-thumb">
                                                            <img alt="author"
                                                                 onerror="this.src='/images/tms/default.jpeg'"
                                                                 class="thumbnail-branch-logo-booking"
                                                                 src="{{Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $item['logo_url'] }}"
                                                                 style="width: 7rem;height: 7rem;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <div class="author-content"
                                                         style="width: 70%;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;margin-top: 22px;">
                                                        <a class="custom-name ' . {{ $item['name'] }}. '">{{ $item['name']}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="d-none" id="action-membership-card" style="align-items: center">
                            <input type="checkbox" checked
                                   class="js-switch"
                                   id="checkbox-setting-membership-card-restaurant"
                                   data-status="{{Session::get(SESSION_KEY_DATA_CURRENT_BRAND)['setting']['is_enable_membership_card']}}"
                                   onchange="changeAllStatusBranchMemberShipCard($(this))">
                            <button class="btn btn-grd-warning border-radius-20"
                                    style="padding: 7px 8px; margin-left: 15px"
                                    onclick="openModalEditSettingMemberShipCard()">Chính sách
                            </button>
                        </div>
                        <div class="row mt-3 d-none" id="list-branch-membership">
                            @foreach(Session::get(SESSION_KEY_DATA_BRAND) as $key => $item)
                                <div class="col-xl-6 col-lg-12 edit-flex-auto-fill">
                                    <div class="box-image" style="height: max-content">
                                        <figure class="box-image-banner" style="min-height: 147px">
                                            <img
                                                    src="{{Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $item['banner'] }}"
                                                    alt="" class="thumbnail-banner">

                                            @if($item['setting']['is_enable_membership_card'] === 1)
                                                <ul class="profile-controls" id="list-data-brand">
                                                    <li data-toggle="tooltip" data-original-title=""
                                                        data-placement="top">
                                                        <div
                                                                class="pointer branch-setting-detail seemt-btn-hover-blue waves-effect waves-light btn-radius-50"
                                                                data-type="{{$key}}"
                                                                data-status="'" data-id="{{ $item['id']   }}"
                                                                data-name="{{ $item['name']}}"
                                                                data-logo="{{Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $item['logo_url'] }}"
                                                                data-banner="{{Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $item['banner'] }}"
                                                                onclick="detailMemberShipCard($(this))">
                                                            <i class="fa fa-eye"></i>
                                                        </div>
                                                    </li>
                                                </ul>

                                                <ul class="profile-controls"
                                                    style="bottom: auto ; top: 8px !important;">
                                                    <li data-toggle="tooltip" data-original-title=""
                                                        data-placement="top">
                                                        <input type="checkbox"
                                                               class="js-switch"
                                                               data-id="{{ $item['id']}}" data-status="1" checked
                                                               id="brand-restaurant{{$item['id']}}"
                                                               onchange="changeStatusBranchMemberShipCard($(this))">
                                                    </li>
                                                </ul>

                                            @else
                                                <ul class="profile-controls"
                                                    style="bottom: auto ; top: 8px !important;">
                                                    <li data-toggle="tooltip" data-original-title=""
                                                        data-placement="top">
                                                        <input type="checkbox"
                                                               class="js-switch"
                                                               data-id="{{ $item['id']   }}" data-status="1"
                                                               id="brand-restaurant{{$item['id']}}"
                                                               onchange="changeStatusBranchMemberShipCard($(this))">
                                                    </li>
                                                </ul>
                                            @endif
                                        </figure>
                                        <div class="col-12" style="position: absolute; bottom: 23px">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="profile-branch">
                                                        <div class="profile-branch-thumb">
                                                            <img alt="author"
                                                                 onerror="this.src='/images/tms/default.jpeg'"
                                                                 class="thumbnail-branch-logo-booking"
                                                                 src="{{Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $item['logo_url'] }}"
                                                                 style="width: 7rem;height: 7rem;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <div class="author-content"
                                                         style="width: 70%;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;margin-top: 22px;">
                                                        <a class="custom-name ' . $data[$i]['name'] . '">{{ $item['name']  }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="container" id="page-body-setting-restaurant-membership-card">
                            <div class="video-option col-lg-12 mx-auto mt-5">
                                <iframe src="https://www.youtube.com/embed/QQkzmjG5WC4" frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen="" class=" w-100" style="height: 50vh"></iframe>
                            </div>

                            <div class="col-lg-12 option-info mt-5 mb-1 mx-1">
                                <p class="option-info-title">Thẻ thành viên là gì?</p>
                                <div class="option-info-content">
                                    <li>1. Tạo dựng menu quán của bạn.</li>
                                    <li>2. Bật chế độ in món bếp, rồi dò tìm kiếm máy in tìm thấy được và kết nối.</li>
                                    <li>3. Tải app Techres Order về điện thoại và đăng nhập.</li>
                                    <li>4. Có thể nhập chi phí đi chợ và các chi phí khác qua điện thoại để lưu lại các
                                        khoản chi cần thiết hàng ngày.
                                    </li>
                                    <li>5. Mở tab tổng quan trong app Techres Order để xem báo cáo doanh thu – chi phí –
                                        lợi nhuận mỗi ngày, các hóa đơn hàng ngày và số lượng món bán ra trong ngày,
                                        tháng, năm.
                                    </li>
                                </div>
                            </div>
                            <div class="row justify-content-center mx-auto mt-2 mb-2">
                                <button type="button" id="" class="btn btn-warning waves-effect waves-light"
                                        style="width: 400px;font-size: 18px;border-radius: 50px;"
                                        onclick="callApiChangeStatusRestaurantMembershipCard()"
                                        onkeypress="callApiChangeStatusRestaurantMembershipCard()">Kích hoạt thẻ thành
                                    viên
                                </button>
                            </div>
                            <div class="row justify-content-center mx-auto mt-2 mb-2 d-none">
                                <button type="button" id="" class="btn btn-warning waves-effect waves-light"
                                        style="width: 400px;font-size: 18px;border-radius: 50px;"
                                        onclick="openModalSettingPolicyMembershipCard()" onkeypress="">Chính Sách
                                </button>
                            </div>
                        </div>
                    @endif
                    <div class="tab-icon d-none" id="data-membershipcard">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-block p-b-0 d-flex">
                                    <div style="margin-left: -30px; margin-top: 4px">
                                        <div id="btn-back-list-branch" class="btn seemt-blue"
                                             style="padding: 5px 8px!important;display: flex;align-items: center;justify-content: center; margin-left: 10px !important; border: 1px solid #1362b0;">
                                            <i class="fa fa-chevron-left"></i>
                                            <span style="margin-left: -7px; font-weight: 550 !important;">QUAY LẠI</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <h5 class="sub-title mx-0">@lang('app.restaurant-membership-card.tab1')</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content p-2 mb-0">
                            <div class="tab-pane active" id="tab1-restaurant-membership-card" role="tabpanel">
                                <div class="col-sm-12 p-0">
                                    <div class="table-responsive new-table">
                                        <table id="table-list-member-ship-card" class="table ">
                                            <thead>
                                            <tr>
                                                <th>@lang('app.restaurant-membership-card.stt')</th>
                                                <th>@lang('app.restaurant-membership-card.name')</th>
                                                <th>@lang('app.restaurant-membership-card.color')</th>
                                                <th>@lang('app.restaurant-membership-card.point')</th>
                                                <th>@lang('app.restaurant-membership-card.discount')</th>
                                                <th>@lang('app.restaurant-membership-card.time')</th>
                                                <th>@lang('app.restaurant-membership-card.action')</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <!-- BUTTON BACK -->
                        <button class="button-back d-none" id="btn-back-list-branch" data-toggle="tooltip"
                                data-placement="left"
                                data-original-title="Quay lại trang trước"><i
                                    class="fa fa-arrow-left"></i>
                        </button>
                    </div>
                    @include('customer.restaurant_membership_card.setting')
                    @include('customer.restaurant_membership_card.policy')
                </div>
            </div>
        </div>
    </div>
    @include('customer.restaurant_membership_card.update_setting')
    @include('customer.restaurant_membership_card.create')
    @include('customer.restaurant_membership_card.update')

@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('files\bower_components\switchery\js\switchery.min.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{asset('js/customer/restaurant_membership_card/index.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
