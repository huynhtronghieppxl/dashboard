@extends('layouts.layout')
@section('content')
    <style>
        .branch-setting-detail > i:before {
            font-weight: 900 !important;
        }
    </style>
    <div id="index-media-restaurant-marketing">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row mt-3" id="list-branch-display-secondary">
                    {{-- Danh sách thương hiệu --}}
                    @foreach(Session::get(SESSION_KEY_DATA_BRAND) as $key => $item)
                        <div class="col-xl-6 col-lg-12 edit-flex-auto-fill">
                            <div class="box-image" style="height: max-content">
                                <figure class="box-image-banner" style="min-height: 147px">
                                    <img
                                            src="{{Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $item['banner'] }}"
                                            alt="" class="thumbnail-banner">
                                    @if($item['setting']['is_enable_sub_monitor'] === 1)
                                        <ul class="profile-controls" id="list-data-brand">
                                            <li data-toggle="tooltip" data-original-title=""
                                                data-placement="top">
                                                <div
                                                        class="pointer branch-setting-detail seemt-btn-hover-blue btn-radius-50"
                                                        data-type="{{$key}}"
                                                        data-status="{{ $item['status']}}" data-id="{{ $item['id']}}"
                                                        data-name="{{ $item['name']}}"
                                                        data-logo="{{Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $item['logo_url'] }}"
                                                        data-banner="{{Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $item['banner'] }}"
                                                        onclick="getDetailMediaDisplaySecondary($(this))">
                                                    <i class="fi-rr-eye"></i>
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
                                                       onchange="changeStatusDisplaySecondary($(this))">
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
                                                       onchange="changeStatusDisplaySecondary($(this))">
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
                <div class="card card-block d-none" id="data-table-display-secondary">
                    <div class="row">
                        <div class="col-sm-12 pt-2 pb-2 pl-0">
                            <div>
                                <button type="button" class="btn btn-inverse font-weight-bold" data-toggle="tooltip"
                                        data-placement="right" onclick="closeDataDisplaySecondary($(this))"
                                        data-original-title="Quay lại"><i class="fa fa-chevron-left"></i> Quay lại
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 p-0">
                            <h5 class="sub-title mx-0">Danh sách hình </h5>
                        </div>
                    </div>
                    <div class="table-responsive new-table">
                        <table id="restaurant-banner-adv-marketing" class="table">
                            <thead>
                            <tr>
                                <th>@lang('app.media-restaurant.stt')</th>
                                <th>@lang('app.media-restaurant.banner')</th>
                                <th>@lang('app.media-restaurant.name')</th>
                                <th></th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('marketing.display_secondary.upload_img')
        @include('marketing.display_secondary.create')
        @include('marketing.display_secondary.update_content')
    </div>
@endsection
@push('scripts')
    @include('layouts.datatable')
    <script type="text/javascript"
            src="{{ asset('js/template_custom/dataTable.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{ asset('js/marketing/display_secondary/index.js?version=2',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

