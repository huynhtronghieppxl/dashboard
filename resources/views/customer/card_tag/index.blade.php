@extends('layouts.layout')
@section('content')
    <link rel="stylesheet" type="text/css"
          href="{{asset('files\bower_components\jquery-minicolors\css\jquery.minicolors.css')}}"/>
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs md-2-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab"
                       href="#tab1-card-tag" role="tab"
                       aria-expanded="false">@lang('app.card-tag.enable') <span
                                class="label label-success"
                                id="total-record-card-tag-enable">0</span></a>
                    <div class="slide slide-5"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       href="#tab2-card-tag" role="tab"
                       aria-expanded="true">@lang('app.card-tag.disable')
                        <span class="label label-warning"
                              id="total-record-card-tag-disable">0</span></a>
                    <div class="slide slide-5"></div>
                </li>
            </ul>
            <div class="card card-block m-0">
                <div class="tab-content pl-2 pr-2 pb-2 mb-0 mt-0">
                    <div class="tab-pane active" id="tab1-card-tag" role="tabpanel">
                        <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                            <div class="table-responsive new-table">
                                <table id="table-card-tag" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.card-tag.stt')</th>
                                        <th>@lang('app.card-tag.name-tag')</th>
                                        <th>@lang('app.card-tag.color-tag')</th>
                                        <th>@lang('app.card-tag.quantity-customer')</th>
                                        <th>@lang('app.card-tag.action')</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-card-tag" role="tabpanel">
                        <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                            <div class="table-responsive new-table">
                                <table id="table-disable-card-tag" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.card-tag.stt')</th>
                                        <th>@lang('app.card-tag.name-tag')</th>
                                        <th>@lang('app.card-tag.color-tag')</th>
                                        <th>@lang('app.card-tag.quantity-customer')</th>
                                        <th>@lang('app.card-tag.action')</th>
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
    </div>
    @include('customer.card_tag.create')
    @include('customer.card_tag.update')
    @include('customer.card_tag.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/customer/card_tag/index.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
