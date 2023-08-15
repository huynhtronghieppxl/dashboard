@extends('layouts.layout')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/dataTable.css') }}"/>
    <div id="index-media-restaurant-marketing">
        <div class="page-wrapper">
            <div class="page-body">
                <ul class="nav nav-tabs md-tabs" role="tablist" id="tab-media-restaurant">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#upload-video-adv-restaurant" role="tab"
                           data-type="0"
                           aria-expanded="false">@lang('app.media-restaurant.tab1')
                            <span class="label label-info" id="total-record-banner-adv">0</span>
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#upload-video-restaurant" role="tab" data-type="1"
                           aria-expanded="false">@lang('app.media-restaurant.tab2')
                            <span class="label label-success" id="total-record-video-adv">0</span>
                        </a>
                        <div class="slide"></div>
                    </li>
                </ul>
                <div class="card card-block">
                    <div class="tab-content">
                        <div class="tab-pane active" id="upload-video-adv-restaurant" role="tabpanel">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    @include('marketing.brand')
                                    {{--                                    <div class="form-validate-select" style="min-width: 190px">--}}
                                    {{--                                        <div class="pr-0 select-material-box">--}}
                                    {{--                                            <select class="js-example-basic-single select-brand select-brand-campaign-marketing">--}}
                                    {{--                                                @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)--}}
                                    {{--                                                    @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])--}}
                                    {{--                                                        <option value="{{$db['id']}}"--}}
                                    {{--                                                                selected>{{$db['name']}}</option>--}}
                                    {{--                                                    @else--}}
                                    {{--                                                        <option value="{{$db['id']}}">{{$db['name']}}</option>--}}
                                    {{--                                                    @endif--}}
                                    {{--                                                @endforeach--}}
                                    {{--                                            </select>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                </div>
                                <table id="restaurant-banner-adv-marketing" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.media-restaurant.stt')</th>
                                        <th>@lang('app.media-restaurant.banner')</th>
                                        <th>@lang('app.media-restaurant.name')</th>
                                        <th>@lang('app.media-restaurant.is_running')</th>
                                        <th></th>
                                        {{--                                        <th><div class="tool-tip">--}}
                                        {{--                                                <i class="fa fa-exclamation-circle text-inverse pointer" data-toggle="tooltip" data-placement="top" data-original-title="Chọn ảnh để hiển thị trên trang chủ Aloline"></i></div></th>--}}
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="upload-video-restaurant" role="tabpanel">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    @include('marketing.brand')
                                    {{--                                    <div class="form-validate-select" style="min-width: 190px">--}}
                                    {{--                                        <div class="pr-0 select-material-box">--}}
                                    {{--                                            <select class="js-example-basic-single select-brand select-brand-campaign-marketing">--}}
                                    {{--                                                @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)--}}
                                    {{--                                                    @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])--}}
                                    {{--                                                        <option value="{{$db['id']}}"--}}
                                    {{--                                                                selected>{{$db['name']}}</option>--}}
                                    {{--                                                    @else--}}
                                    {{--                                                        <option value="{{$db['id']}}">{{$db['name']}}</option>--}}
                                    {{--                                                    @endif--}}
                                    {{--                                                @endforeach--}}
                                    {{--                                            </select>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                </div>
                                <table id="restaurant-video-adv-marketing" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.media-restaurant.stt')</th>
                                        <th>@lang('app.media-restaurant.video')</th>
                                        <th>@lang('app.media-restaurant.name')</th>
                                        <th>@lang('app.media-restaurant.is_running')</th>
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
        </div>
        @include('marketing.media_restaurant.create_image')
        @include('marketing.media_restaurant.create_video')
        @include('marketing.media_restaurant.detail_video')
    </div>
@endsection
@push('scripts')
    @include('layouts.datatable')
    <script type="text/javascript"
            src="{{ asset('js\template_custom\dataTable.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{ asset('js\marketing\media_restaurant\index.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

