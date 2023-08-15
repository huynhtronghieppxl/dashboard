@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist" id="nav-banner-advertisement">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab"
                       href="#tab-active-draft"
                       role="tab" data-tab="0"
                       aria-expanded="true">Chờ gửi <span
                                class="label label-warning"
                                id="total-record-draft">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-active-pending"
                       role="tab" data-tab="1"
                       aria-expanded="false">Chờ duyệt<span
                                class="label label-info"
                                id="total-record-pending">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-active-approved"
                       role="tab" data-tab="2"
                       aria-expanded="false">Đã duyệt<span
                                class="label label-success"
                                id="total-record-approved">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-active-rejected"
                       role="tab" data-tab="3"
                       aria-expanded="false">Từ chối<span
                                class="label label-inverse"
                                id="total-record-rejected">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-active-draft" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand select-brand-banner">
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                @if($db['is_office'] === 0)
                                                    @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                        <option value="{{$db['id']}}"
                                                                selected>{{$db['name']}}</option>
                                                    @else
                                                        <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered" id="table-draft-banner-advertisement">
                                <thead>
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th class="text-center">Banner</th>
                                    <th class="text-left">Tên Banner</th>
                                    <th class="text-left">Loại</th>
                                    <th class="text-center"></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-active-pending" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand select-brand-banner">
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                @if($db['is_office'] === 0)
                                                    @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                        <option value="{{$db['id']}}"
                                                                selected>{{$db['name']}}</option>
                                                    @else
                                                        <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered" id="table-pendding-banner-advertisement">
                                <thead>
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th class="text-center">Banner</th>
                                    <th>Tên Banner</th>
                                    <th class="text-left">Loại</th>
                                    <th class="text-center">Ngày gửi yêu cầu</th>
                                    <th class="text-center"></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-active-approved" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand select-brand-banner">
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                @if($db['is_office'] === 0)
                                                    @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                        <option value="{{$db['id']}}"
                                                                selected>{{$db['name']}}</option>
                                                    @else
                                                        <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered" id="table-approved-banner-advertisement">
                                <thead>
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th class="text-center">Banner</th>
                                    <th>Tên Banner</th>
                                    <th class="text-left">Loại</th>
                                    <th class="text-center">Ngày duyệt</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center"></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-active-rejected" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand select-brand-banner">
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                @if($db['is_office'] === 0)
                                                    @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                        <option value="{{$db['id']}}"
                                                                selected>{{$db['name']}}</option>
                                                    @else
                                                        <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered" id="table-rejected-banner-advertisement">
                                <thead>
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th class="text-center">Banner</th>
                                    <th>Tên Banner</th>
                                    <th class="text-left">Loại</th>
                                    <th class="text-center">Ngày từ chối</th>
                                    <th class="text-center"></th>
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
    @include('customer.banner.create')
    @include('customer.banner.update')
    @include('customer.banner.detail')
    <div class="modal fade" id="modal-review-set-banner">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body text-left" id="loading-review-modal-review-set-banner">
                    <div class="box-video-setting-ads">
                        <video src="" autoplay controls id="video-review-set-banner"
                               class="custom-thumbnail-video-detail my-3"></video>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-grd-disabled waves-effect btn-modal"
                            onclick="closeModalReviewBannerAdvertisement()">@lang('app.component.title-button.close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('js/advertisement/banner/index.js?version='.date('d/m/Y H').')', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{asset('js/customer/banner/index.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
