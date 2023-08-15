@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body d-none" id="body-e-invoice-treasurer">
            <ul class="nav nav-tabs md-tabs" role="tablist"
                id="nav-tab-e-invoice">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab"
                       href="#tab-waiting-export-e-invoice-manage" role="tab"
                       data-id="1"
                       onclick="changeTabInvoice(1)"
                       aria-expanded="true">@lang('app.e-invoice.tab1') <span
                                class="label label-primary"
                                id="total-record-tab-waiting-export-e-invoice-manage">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       href="#tab-waiting-confirm-e-invoice-manage" role="tab"
                       data-id="2"
                       onclick="changeTabInvoice(2)"
                       aria-expanded="true">@lang('app.e-invoice.tab2') <span
                                class="label label-info"
                                id="total-record-tab-waiting-payment-payment-treasurer">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       href="#tab-done-e-invoice-manage" role="tab"
                       data-id="3"
                       onclick="changeTabInvoice(3)"
                       aria-expanded="false">@lang('app.e-invoice.tab3') <span
                                class="label label-success"
                                id="total-record-tab-done-payment-treasurer">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       href="#tab-cancel-e-invoice-manage" role="tab"
                       data-id="4"
                       onclick="changeTabInvoice(4)"
                       aria-expanded="false">@lang('app.e-invoice.tab4') <span
                                class="label label-danger"
                                id="total-record-tab-cancel-payment-treasurer">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       href="#tab-updated-e-invoice-manage" role="tab"
                       data-id="5"
                       onclick="changeTabInvoice(5)"
                       aria-expanded="false">@lang('app.e-invoice.tab5') <span
                                class="label label-warning"
                                id="total-record-tab-updated-invoice-manage">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-waiting-export-e-invoice-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand select-brand-e-invoice-manage">
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
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-branch select-branch-e-invoice-manage">
                                        </select>
                                    </div>
                                </div>
                                @include('manage.e_invoice.filter')
                            </div>
                            <table id="table-waiting-export-e-invoice" class="table">
                                <thead>
                                <tr>
                                    <th class="text-center" rowspan="2">@lang('app.e-invoice.stt')</th>
                                    <th class="text-left" rowspan="2">@lang('app.e-invoice.code')</th>
                                    <th class="text-right">@lang('app.e-invoice.total')</th>
                                    <th class="text-right">@lang('app.e-invoice.vat')</th>
                                    <th class="text-right">@lang('app.e-invoice.discount')</th>
                                    <th class="text-right">@lang('app.e-invoice.payment')</th>
                                    <th class="text-center" rowspan="2">@lang('app.e-invoice.payment-date')</th>
                                    <th class="text-center" rowspan="2"></th>
                                    {{--                                    <th rowspan="2" class="d-none"></th>--}}
                                </tr>
                                <tr>
                                    <th class="text-right seemt-fz-14 total-amount-e-invoice">0</th>
                                    <th class="text-right seemt-fz-14 total-vat-amount-e-invoice">0</th>
                                    <th class="text-right seemt-fz-14 total-discount-amount-e-invoice">0</th>
                                    <th class="text-right seemt-fz-14 total-payment-amount-e-invoice">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-waiting-confirm-e-invoice-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand select-brand-e-invoice-manage">
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
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-branch select-branch-e-invoice-manage">
                                        </select>
                                    </div>
                                </div>
                                @include('manage.e_invoice.filter')
                            </div>
                            <table id="table-waiting-confirm-e-invoice" class="table">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.e-invoice.stt')</th>
                                    <th class="text-left" rowspan="2">@lang('app.e-invoice.code')</th>
                                    <th class="text-right">@lang('app.e-invoice.total')</th>
                                    <th class="text-right">@lang('app.e-invoice.vat')</th>
                                    <th class="text-right">@lang('app.e-invoice.discount')</th>
                                    <th class="text-right">@lang('app.e-invoice.payment')</th>
                                    <th class="text-left" rowspan="2">@lang('app.e-invoice.partner-type')</th>
                                    <th class="text-center" rowspan="2">@lang('app.e-invoice.pendding-date')</th>
                                    <th rowspan="2"></th>
                                    {{--                                    <th rowspan="2" class="d-none"></th>--}}
                                </tr>
                                <tr>
                                    <th class="text-right seemt-fz-14 total-amount-e-invoice">0</th>
                                    <th class="text-right seemt-fz-14 total-vat-amount-e-invoice">0</th>
                                    <th class="text-right seemt-fz-14 total-discount-amount-e-invoice">0</th>
                                    <th class="text-right seemt-fz-14 total-payment-amount-e-invoice">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-done-e-invoice-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand select-brand-e-invoice-manage">
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
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-branch select-branch-e-invoice-manage">
                                        </select>
                                    </div>
                                </div>
                                @include('manage.e_invoice.filter')
                            </div>
                            <table id="table-done-export-e-invoice" class="table">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.e-invoice.stt')</th>
                                    <th class="text-left" rowspan="2">@lang('app.e-invoice.code')</th>
                                    <th class="text-right">@lang('app.e-invoice.total')</th>
                                    <th class="text-right">@lang('app.e-invoice.vat')</th>
                                    <th class="text-right">@lang('app.e-invoice.discount')</th>
                                    <th class="text-right">@lang('app.e-invoice.payment')</th>
                                    <th class="text-center" rowspan="2">@lang('app.e-invoice.partner-type')</th>
                                    <th class="text-center" rowspan="2">@lang('app.e-invoice.approved-date')</th>
                                    <th rowspan="2"></th>
                                    {{--                                    <th rowspan="2" class="d-none"></th>--}}
                                </tr>
                                <tr>
                                    <th class="text-right seemt-fz-14 total-amount-e-invoice">0</th>
                                    <th class="text-right seemt-fz-14 total-vat-amount-e-invoice">0</th>
                                    <th class="text-right seemt-fz-14 total-discount-amount-e-invoice">0</th>
                                    <th class="text-right seemt-fz-14 total-payment-amount-e-invoice">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-cancel-e-invoice-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand select-brand-e-invoice-manage">
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
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-branch select-branch-e-invoice-manage">
                                        </select>
                                    </div>
                                </div>
                                @include('manage.e_invoice.filter')
                            </div>
                            <table id="table-cancel-export-e-invoice" class="table">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.e-invoice.stt')</th>
                                    <th class="text-left" rowspan="2">@lang('app.e-invoice.code')</th>
                                    <th class="text-right">@lang('app.e-invoice.total')</th>
                                    <th class="text-right">@lang('app.e-invoice.vat')</th>
                                    <th class="text-right">@lang('app.e-invoice.discount')</th>
                                    <th class="text-right">@lang('app.e-invoice.payment')</th>
                                    <th class="text-left" rowspan="2">@lang('app.e-invoice.partner-type')</th>
                                    <th class="text-center" rowspan="2">@lang('app.e-invoice.cancel-date')</th>
                                    <th rowspan="2"></th>
                                    {{--                                    <th rowspan="2" class="d-none"></th>--}}
                                </tr>
                                <tr>
                                    <th class="text-right seemt-fz-14 total-amount-e-invoice">0</th>
                                    <th class="text-right seemt-fz-14 total-vat-amount-e-invoice">0</th>
                                    <th class="text-right seemt-fz-14 total-discount-amount-e-invoice">0</th>
                                    <th class="text-right seemt-fz-14 total-payment-amount-e-invoice">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-updated-e-invoice-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand select-brand-e-invoice-manage">
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
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-branch select-branch-e-invoice-manage">
                                        </select>
                                    </div>
                                </div>
                                @include('manage.e_invoice.filter')
                            </div>
                            <table id="table-updated-export-e-invoice" class="table">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.e-invoice.stt')</th>
                                    <th class="text-left" rowspan="2">@lang('app.e-invoice.code')</th>
                                    <th class="text-right">@lang('app.e-invoice.total')</th>
                                    <th class="text-right">@lang('app.e-invoice.vat')</th>
                                    <th class="text-right">@lang('app.e-invoice.discount')</th>
                                    <th class="text-right">@lang('app.e-invoice.payment')</th>
                                    <th class="text-left" rowspan="2">@lang('app.e-invoice.partner-type')</th>
                                    <th class="text-center" rowspan="2">@lang('app.e-invoice.update-date')</th>
                                    <th rowspan="2"></th>
                                    {{--                                    <th rowspan="2" class="d-none"></th>--}}
                                </tr>
                                <tr>
                                    <th class="text-right seemt-fz-14 total-amount-e-invoice">0</th>
                                    <th class="text-right seemt-fz-14 total-vat-amount-e-invoice">0</th>
                                    <th class="text-right seemt-fz-14 total-discount-amount-e-invoice">0</th>
                                    <th class="text-right seemt-fz-14 total-payment-amount-e-invoice">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body d-none" id="body-e-invoice-disabled">
            <div class="card card-block">
                <div class="row justify-content-center" style="margin-top: 2%">
                    <div class="col-lg-6 text-center">
                        <h2 class="mt-3">@lang('app.e-invoice.no-partner') </h2>
                        <p class="mb-5" style="font-size: 16px !important;">@lang('app.e-invoice.setting-partner') <a
                                    class="class-link" href="/partner-invoice">@lang('app.e-invoice.here')</a></p>
                        <div class="col-sm-12" style="position: relative">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable d-flex" style="margin-top: -40px !important; right: 50%; transform: translateX(50%)">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand">
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
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-branch">
                                            </select>
                                        </div>
                                    </div>
                                    @include('manage.e_invoice.filter')
                                </div>
                                <div class="dataTables_wrapper d-flex d-none">
                                    <div id="table-enable-area-data_filter" class="dataTables_filter">
                                        <label><i class="fi-rr-search"></i>
                                            <input type="search" class="" placeholder="Tìm kiếm"
                                                   aria-controls="table-enable-area-data">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <img src="{{asset('/images/partner.png',env('IS_DEPLOY_ON_SERVER'))}}" alt="" height="300"
                             width="500" onerror="this.src='/images/tms/default-banner-error.jpeg'" style="object-fit:cover"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('manage.e_invoice.create')
    @include('manage.e_invoice.update')
    @include('manage.e_invoice.detail')
    @include('manage.bill.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/e_invoice/index.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
