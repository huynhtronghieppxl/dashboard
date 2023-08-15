@extends('layouts.layout')
@section('content')
    <style>
        /*.seemt-main-content .new-table .time-filer-dataTale span {*/
        /*    height: 100%;*/
        /*    display: flex;*/
        /*    align-items: center;*/
        /*    justify-content: center;*/
        /*}*/

        .seemt-main-content .new-table .select-custom-report span {
            vertical-align: text-top;
        }

        .select-custom-report {
            display: flex;
            align-items: center !important;
            height: 32px;
        }

        .select-option {
            margin: 0 4px;
            background: var(--bg-color);
            border-radius: 5px;
        }

        .search-btn-inventory-kitchen-report,
        .search-btn-inventory-bar-report {
            width: 32px !important;
            height: 32px !important;
            background-color: #F1F2F5;
            border-radius: 5px;
            cursor: pointer;
        }


        .fi-rr-filter {
            height: 100%;
            display: flex !important;
            align-items: center;
            justify-content: center;
        }
    </style>
    <div class="page-wrapper">
        <!-- Page-body start -->
        <div class="page-body" id="div-checklist-inventory-internal-report">
            <ul class="nav nav-tabs md-tabs" id="tabs-form-inventory-internal" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-id="1" data-toggle="tab"
                       href="#tab1-inventory-internal-report"
                       role="tab" aria-expanded="true">@lang('app.inventory-internal-report.tab1')
                        {{--                                            <span--}}
                        {{--                                                class="label label-success" id="total-record-kitchen">0</span>--}}
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-id="2" data-toggle="tab"
                       href="#tab2-inventory-internal-report"
                       role="tab" aria-expanded="false">@lang('app.inventory-internal-report.tab2')
                        {{--                                            <span--}}
                        {{--                                                class="label label-warning" id="total-record-bar">0</span>--}}
                    </a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card">
                <div class="card-block mb-0 pt-0">
                    <div class="row">
                        <!-- Tab panes -->
                        <div class="col-lg-12">
                            <div class="tab-content m-t-5px">
                                <div class="tab-pane active" id="tab1-inventory-internal-report" role="tabpanel">
                                    <div class="table-responsive new-table">
                                        <div class="select-filter-dataTable">
                                            <div class="form-validate-select">
                                                <div class="pr-0 select-material-box">
                                                    <select class="js-example-basic-single select-brand select-brand-material-data">
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
                                            <div class="form-validate-select ml-2">
                                                <div class="pr-0 select-material-box">
                                                    <select class="js-example-basic-single select-branch select-branch-report">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="select-custom-report">
                                                <div class="select-option notification-filter">
                                                    <select
                                                            class="js-example-basic-single form-control custom-form-search"
                                                            id="select-from-inventory-internal-kitchen-report">
                                                        <option disabled selected
                                                                hidden>@lang('app.component.option_default')</option>
                                                    </select>
                                                </div>
                                                <div class="select-option">
                                                    <select
                                                            class="js-example-basic-single form-control custom-form-search"
                                                            id="select-to-inventory-internal-kitchen-report">
                                                        <option disabled selected
                                                                hidden>@lang('app.component.option_default')</option>
                                                    </select>
                                                </div>
                                                <div class="search-btn-inventory-kitchen-report seemt-blue seemt-bg-blue seemt-btn-hover-blue">
                                                    <i
                                                            class="fi-rr-filter"></i></div>
                                            </div>
                                        </div>

                                        <table class="table" id="table-kitchen-inventory-internal-report">
                                            <thead>
                                            <tr>
                                                <th rowspan="2"
                                                    class="text-center">@lang('app.inventory-internal-report.stt')</th>
                                                <th rowspan="2"
                                                    class="text-left">@lang('app.inventory-internal-report.name')</th>
                                                {{--                                                <th rowspan="2" class="text-center">@lang('app.inventory-internal-report.unit')</th>--}}
                                                <th rowspan="2"
                                                    class="text-left">@lang('app.inventory-internal-report.category')</th>
                                                <th class="text-right">@lang('app.inventory-internal-report.open')</th>
                                                <th class="text-right">@lang('app.inventory-internal-report.import')</th>
                                                <th class="text-right">@lang('app.inventory-internal-report.export')</th>
                                                <th class="text-right">@lang('app.inventory-internal-report.cancel')</th>
                                                <th class="text-right">@lang('app.inventory-internal-report.wastage')</th>
                                                <th class="text-right">@lang('app.inventory-internal-report.after')</th>
                                                <th class="text-right">@lang('app.inventory-internal-report.check')</th>
                                                <th class="text-right">@lang('app.inventory-internal-report.diff')</th>
                                                <th rowspan="2"></th>
                                            </tr>
                                            <tr>
                                                <th class="seemt-fz-14" id="total-quantity-open-kitchen">0</th>
                                                <th class="seemt-fz-14" id="total-quantity-import-kitchen">0</th>
                                                <th class="seemt-fz-14" id="total-quantity-export-kitchen">0</th>
                                                <th class="seemt-fz-14" id="total-quantity-cancel-kitchen">0</th>
                                                <th class="seemt-fz-14" id="total-quantity-wastage-kitchen">0</th>
                                                <th class="seemt-fz-14" id="total-quantity-after-kitchen">0</th>
                                                <th class="seemt-fz-14" id="total-quantity-check-kitchen">0</th>
                                                <th class="seemt-fz-14" id="total-quantity-diff-kitchen">0</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab2-inventory-internal-report" role="tabpanel">
                                    <div class="table-responsive new-table">
                                        <div class="select-filter-dataTable">
                                            <div class="form-validate-select">
                                                <div class="pr-0 select-material-box">
                                                    <select class="js-example-basic-single select-brand select-brand-material-data">
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
                                            <div class="form-validate-select ml-2">
                                                <div class="pr-0 select-material-box">
                                                    <select
                                                            class="js-example-basic-single select-branch select-branch-report">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="select-custom-report">
                                                <div class="select-option">
                                                    <select
                                                            class="js-example-basic-single form-control custom-form-search"
                                                            id="select-from-inventory-internal-bar-report">
                                                        <option disabled selected
                                                                hidden>@lang('app.component.option_default')</option>
                                                    </select>
                                                </div>
                                                <div class="select-option">
                                                    <select
                                                            class="js-example-basic-single form-control custom-form-search"
                                                            id="select-to-inventory-internal-bar-report">
                                                        <option disabled selected
                                                                hidden>@lang('app.component.option_default')</option>
                                                    </select>
                                                </div>
                                                <div class="search-btn-inventory-bar-report seemt-blue seemt-bg-blue seemt-btn-hover-blue">
                                                    <i
                                                            class="fi-rr-filter"></i></div>
                                            </div>
                                        </div>
                                        <table class="table" id="table-bar-inventory-internal-report">
                                            <thead>
                                            <tr>
                                                <th rowspan="2"
                                                    class="text-center">@lang('app.inventory-internal-report.stt')</th>
                                                <th rowspan="2"
                                                    class="text-center">@lang('app.inventory-internal-report.name')</th>
                                                {{--                                                <th rowspan="2" class="text-center">@lang('app.inventory-internal-report.unit')</th>--}}
                                                <th rowspan="2"
                                                    class="text-center">@lang('app.inventory-internal-report.category')</th>
                                                <th class="text-right">@lang('app.inventory-internal-report.open')</th>
                                                <th class="text-right">@lang('app.inventory-internal-report.import')</th>
                                                <th class="text-right">@lang('app.inventory-internal-report.export')</th>
                                                <th class="text-right">@lang('app.inventory-internal-report.cancel')</th>
                                                <th class="text-right">@lang('app.inventory-internal-report.wastage')</th>
                                                <th class="text-right">@lang('app.inventory-internal-report.after')</th>
                                                <th class="text-right">@lang('app.inventory-internal-report.check')</th>
                                                <th class="text-right">@lang('app.inventory-internal-report.diff')</th>
                                                <th rowspan="2"></th>
                                            </tr>
                                            <tr>
                                                <th class="seemt-fz-14" id="total-quantity-open-bar">0</th>
                                                <th class="seemt-fz-14" id="total-quantity-import-bar">0</th>
                                                <th class="seemt-fz-14" id="total-quantity-export-bar">0</th>
                                                <th class="seemt-fz-14" id="total-quantity-cancel-bar">0</th>
                                                <th class="seemt-fz-14" id="total-quantity-wastage-bar">0</th>
                                                <th class="seemt-fz-14" id="total-quantity-after-bar">0</th>
                                                <th class="seemt-fz-14" id="total-quantity-check-bar">0</th>
                                                <th class="seemt-fz-14" id="total-quantity-diff-bar">0</th>
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
        </div>
        <!-- Page-body end -->
    </div>
    @include('report.inventory_internal.excel')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('..\js\report\inventory_internal\index.js?version=5')}}"></script>
@endpush
