@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            @if(Session::get(SESSION_KEY_PERMISSION_TALLEST) > 1)
                <div class="page-body" id="form-list-branch-booking">
                    <div class="card">
                        <div class="col-sm-12">
                            <div class="row mt-3" id="list-branch-take-away">
                                @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status' , 1) as $key => $item)
                                    <div class=" col-6 edit-flex-auto-fill">
                                        <div class="box-image">
                                            <figure class="box-image-banner">
                                                <img
                                                        src="{{ Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $item['banner']}}"
                                                        alt="">
                                                @if($item['setting']['is_have_take_away'] == 1)
                                                    <ul class="profile-controls">
                                                        <li>
                                                            <label title="" data-type="{{$key}}"
                                                                   class="pointer btn-detail-branch-booking d-flex justify-content-center align-items-center"
                                                                   data-toggle="tooltip"
                                                                   data-take-away="{{ $item['setting']['is_have_take_away'] }}"
                                                                   data-original-title="Chi tiết món mang về"
                                                                   onclick="detailBrand($(this))"
                                                                   value="{{ $item['id'] }}" data-id="{{ $item['id'] }}"
                                                                   data-status="{{ $item['status'] }}"
                                                                   onclick="detailMemberShipCard($(this))">
                                                                <i class="fi-rr-eye mt-0"
                                                                   style="margin-top: 6px !important;"></i>
                                                            </label>
                                                        </li>
                                                    </ul>
                                                    <ul class="profile-controls"
                                                        style="bottom: auto ; top: 8px !important;">
                                                        <li data-toggle="tooltip"
                                                            data-original-title="Bật tắt món mang về"
                                                            data-placement="top">
                                                            <input type="checkbox" class="js-switch"
                                                                   data-id="{{ $item['id'] }}" checked
                                                                   onchange="changeStatusSettingTakeAwayBrand($(this))">
                                                        </li>
                                                    </ul>
                                                @else
                                                    <ul class="profile-controls"
                                                        style="bottom: auto ; top: 8px !important;">
                                                        <li data-toggle="tooltip"
                                                            data-original-title="Bật tắt món mang về"
                                                            data-placement="top">
                                                            <input type="checkbox" class="js-switch"
                                                                   data-id="{{ $item['id'] }}"
                                                                   onchange="changeStatusSettingTakeAwayBrand($(this))">
                                                        </li>
                                                    </ul>
                                                @endif
                                            </figure>
                                            <div class="col-lg-12" style="position: absolute; bottom: 20px">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="profile-branch">
                                                            <div class="profile-branch-thumb">
                                                                <img alt="author"
                                                                     onerror="this.src='/images/tms/default.jpeg'"
                                                                     class="thumbnail-branch-logo-booking"
                                                                     src="{{ Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $item['logo_url']   }} ">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <div class="author-content">
                                                            <a class="custom-name" id="branch-setting-name"
                                                               style="">{{ $item['name'] }}</a>
                                                            <i class="fa fa-check-circle text-success pr-1"
                                                               id="branch-setting-status-on"></i>
                                                            <i class="fa fa-ban text-danger pr-1 d-none"
                                                               id="branch-setting-status-off"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div id="data-visible-take-away" class="d-none">
                <ul class="nav nav-tabs md-tabs"
                    role="tablist">
                    {{--                    <button type="button" class="come-back-btn font-weight-bold"--}}
                    {{--                            data-toggle="tooltip" data-placement="right"--}}
                    {{--                            id="btn-back-list-branch"--}}
                    {{--                            data-original-title="Quay lại"><i--}}
                    {{--                            class="fa fa-chevron-left"></i></button>--}}
                    <button type="button" id="btn-back-list-branch"
                            class="come-back-btn font-weight-bold seemt-btn-hover-gray waves-effect waves-light"
                            data-toggle="tooltip" data-placement="right" data-original-title="Quay lại"
                            style="margin: 10px 5px;">
                        <i class="fi-rr-angle-left" style="margin-top: 5px;"></i>
                    </button>
                    <li class="nav-item">
                        <a class="nav-link" data-type="0" data-toggle="tab" data-type="1"
                           href="#tab1-take-away" role="tab" aria-expanded="true">
                            @lang('app.take-away-brand.tab1')
                            <span class="label label-success" id="total-record-food">0</span>
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-type="1" data-toggle="tab" data-type="2"
                           href="#tab2-take-away" role="tab" aria-expanded="false">
                            @lang('app.take-away-brand.tab2')
                            <span class="label label-warning" id="total-record-drink">0</span>
                        </a>
                        <div class="slide"></div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-type="3" data-toggle="tab" data-type="3"
                           href="#tab4-take-away" role="tab" aria-expanded="false">
                            @lang('app.take-away-brand.tab4')
                            <span class="label label-danger" id="total-record-other">0</span>
                        </a>
                    </li>
                </ul>
                <div class="card card-block">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1-take-away" role="tabpanel">
                            <div class="table-responsive new-table">
                                @include('customer.take_away.brand.filter')
                                <table class="table" id="table-food-take-away">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.take-away-brand.stt')</th>
                                        <th>@lang('app.take-away-brand.name')</th>
                                        <th>@lang('app.take-away-brand.unit')</th>
                                        <th>@lang('app.take-away-brand.category')</th>
                                        <th>@lang('app.take-away-brand.price')</th>
                                        <th>@lang('app.take-away-brand.vat')</th>
                                        <th>@lang('app.take-away-brand.profit')</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2-take-away" role="tabpanel">
                            <div class="table-responsive new-table">
                                @include('customer.take_away.brand.filter')
                                <table class="table " id="table-drink-take-away">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.take-away-brand.stt')</th>
                                        <th>@lang('app.take-away-brand.name')</th>
                                        <th>@lang('app.take-away-brand.unit')</th>
                                        <th>@lang('app.take-away-brand.category')</th>
                                        <th>@lang('app.take-away-brand.price')</th>
                                        <th>@lang('app.take-away-brand.vat')</th>
                                        <th>@lang('app.take-away-brand.profit')</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab4-take-away" role="tabpanel">
                            <div class="table-responsive new-table">
                                @include('customer.take_away.brand.filter')
                                <table class="table " id="table-other-take-away">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.take-away-brand.stt')</th>
                                        <th>@lang('app.take-away-brand.name')</th>
                                        <th>@lang('app.take-away-brand.unit')</th>
                                        <th>@lang('app.take-away-brand.category')</th>
                                        <th>@lang('app.take-away-brand.price')</th>
                                        <th>@lang('app.take-away-brand.vat')</th>
                                        <th>@lang('app.take-away-brand.profit')</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('customer.take_away.brand.setting')
        </div>
    </div>
    @include('customer.take_away.brand.update')
    @include('manage.food.brand.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/customer/take_away/brand/index.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
