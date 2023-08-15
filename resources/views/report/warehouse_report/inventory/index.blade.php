@extends('layouts.layout')
@section('content')
    <style>
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

        .search-btn-inventory-report {
            width: 35px !important;
            height: 35px !important;
            background-color: #F1F2F5;
        }

        .fi-rr-filter {
            height: 100%;
            display: flex !important;
            align-items: center;
            justify-content: center;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/dataTable.css') }}"/>
    <div class="page-wrapper">
        <!-- Page-body start -->
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" id="tabs-form-inventory" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-type="1" data-toggle="tab" href="#tab1-inventory-report"
                       data-table="#table-material-inventory-report"
                       role="tab" aria-expanded="true">@lang('app.inventory-report.tab1')
                        {{--                        <span class="label label-success" id="total-record-material-inventory-report">0</span>--}}
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-type="2" data-toggle="tab"
                       href="#tab2-inventory-report" data-table="#table-good-inventory-report"
                       role="tab" aria-expanded="false">@lang('app.inventory-report.tab2')
                        {{--                        <span class="label label-warning" id="total-record-goods">0</span>--}}
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-type="3" data-toggle="tab"
                       href="#tab3-inventory-report" data-table="#table-internal-inventory-report"
                       role="tab" aria-expanded="false">@lang('app.inventory-report.tab3')
                        {{--                        <span class="label label-primary" id="total-record-internal">0</span>--}}
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-type="12" data-toggle="tab"
                       href="#tab4-inventory-report" data-table="#table-other-inventory-report"
                       role="tab" aria-expanded="false">@lang('app.inventory-report.tab4')
                        {{--                        <span class="label label-inverse" id="total-record-other">0</span>--}}
                    </a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card-block card">
                <div class="row">
                    <!-- Tab panes -->
                    <div class="col-lg-12">
                        <div class="tab-content m-t-5px">
                            <div class="tab-pane active" id="tab1-inventory-report" role="tabpanel">
                                <div class="table-responsive new-table">
                                    <div class="select-filter-dataTable">
                                        <div class="form-validate-select">
                                            <div class="pr-0 select-material-box">
                                                <select
                                                        class="js-example-basic-single select-brand select-brand-material-data">
                                                    @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                        @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                            <option value="{{$db['id']}}"
                                                                    selected>{{$db['name']}}</option>
                                                        @else
                                                            <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-validate-select ml-2">
                                            <div class="pr-0 select-material-box">
                                                <select
                                                        class="js-example-basic-single select-branch select-branch-report">
                                                    @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', ENUM_SELECTED)->all() as $db)
                                                        @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])
                                                            <option value="{{$db['id']}}"
                                                                    selected>{{$db['name']}}</option>
                                                        @else
                                                            <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="select-custom-report">
                                            <div class="select-option">
                                                <select
                                                        class="js-example-basic-single select-target-payment-bill form-control custom-form-search"
                                                        data-validate="search"
                                                        id="select-material-from-inventory-report">
                                                    <option disabled selected
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                            </div>
                                            <div class="select-option">
                                                <select
                                                        class="js-example-basic-single select-target-payment-bill form-control custom-form-search"
                                                        data-validate="search" id="select-material-to-inventory-report">
                                                    <option disabled selected
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                            </div>
                                            <div class="search-btn-inventory-report seemt-blue seemt-bg-blue seemt-btn-hover-blue m-0 p-0">
                                                <i
                                                        class="fi-rr-filter"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table " id="table-material-inventory-report">
                                        <thead>
                                        <tr>
                                            <th
                                                    rowspan="2">@lang('app.inventory-report.stt')</th>
                                            <th
                                                    rowspan="2">@lang('app.inventory-report.name')</th>
                                            <th
                                                    rowspan="2">@lang('app.inventory-report.category')</th>
                                            <th
                                                    colspan="1">@lang('app.inventory-report.open')
                                            </th>
                                            <th
                                                    colspan="1">@lang('app.inventory-report.import')
                                            </th>
                                            <th
                                                    colspan="1">@lang('app.inventory-report.export')
                                            </th>
                                            <th
                                                    colspan="1">@lang('app.inventory-report.return')
                                            </th>
                                            <th
                                                    colspan="1">@lang('app.inventory-report.cancel')
                                            </th>
                                            {{--                                                <th--}}
                                            {{--                                                    colspan="1">@lang('app.inventory-report.wastage')--}}
                                            {{--                                                    </th>--}}
                                            <th
                                                    colspan="1">@lang('app.inventory-report.after')
                                            </th>
                                            <th
                                                    colspan="1">@lang('app.inventory-report.check')
                                            </th>
                                            <th
                                                    colspan="1">@lang('app.inventory-report.diff')
                                            </th>
                                            <th
                                                    class="d-none" rowspan="2">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="1">
                                                <label class="seemt-fz-14" id="total-amount-open-material">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-before-material">0</label> </p>--}}
                                            </th>
                                            <th colspan="1">
                                                <label class="seemt-fz-14" id="total-amount-import-material">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-import-material">0</label> </p>--}}
                                            </th>
                                            <th colspan="1">
                                                <label class="seemt-fz-14" id="total-amount-export-material">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-export-material">0</label> </p>--}}
                                            </th>
                                            <th colspan="1">
                                                <label class="seemt-fz-14" id="total-amount-return-material">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-return-material">0</label> </p>--}}
                                            </th>
                                            <th colspan="1">
                                                <label class="seemt-fz-14" id="total-amount-cancel-material">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-cancel-material">0</label> </p>--}}
                                            </th>
                                            {{--                                                <th colspan="1" >--}}
                                            {{--                                                    <label class=seemt-fz-14 id="total-amount-wastage-material">0</label>--}}
                                            {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-wastage-material">0</label> </p></th>--}}
                                            <th colspan="1">
                                                <label class="seemt-fz-14" id="total-amount-after-material">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-after-material">0</label> </p>--}}
                                            </th>
                                            <th colspan="1">
                                                <label class="seemt-fz-14" id="total-amount-check-material">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-check-material">0</label> </p>--}}
                                            </th>
                                            <th colspan="1">
                                                <label class="seemt-fz-14" id="total-amount-diff-material">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-diff-material">0</label> </p>--}}
                                            </th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2-inventory-report" role="tabpanel">
                                <div class="table-responsive new-table">
                                    <div class="select-filter-dataTable">
                                        <div class="form-validate-select">
                                            <div class="pr-0 select-material-box">
                                                <select
                                                        class="js-example-basic-single select-brand select-brand-material-data">
                                                    @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                        @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                            <option value="{{$db['id']}}"
                                                                    selected>{{$db['name']}}</option>
                                                        @else
                                                            <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-validate-select ml-2">
                                            <div class="pr-0 select-material-box">
                                                <select
                                                        class="js-example-basic-single select-branch select-branch-report">
                                                    @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', ENUM_SELECTED)->all() as $db)
                                                        @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])
                                                            <option value="{{$db['id']}}"
                                                                    selected>{{$db['name']}}</option>
                                                        @else
                                                            <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="select-custom-report">
                                            <div class="select-option">
                                                <select
                                                        class="js-example-basic-single select-target-payment-bill form-control custom-form-search"
                                                        data-validate="search" id="select-good-from-inventory-report">
                                                    <option disabled selected
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                            </div>
                                            <div class="select-option">
                                                <select
                                                        class="js-example-basic-single select-target-payment-bill form-control custom-form-search"
                                                        data-validate="search" id="select-good-to-inventory-report">
                                                    <option disabled selected
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                            </div>
                                            <div class="search-btn-inventory-report seemt-blue seemt-bg-blue seemt-btn-hover-blue m-0 p-0">
                                                <i
                                                        class="fi-rr-filter"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table " id="table-goods-inventory-report">
                                        <thead>
                                        <tr>
                                            <th
                                                    rowspan="2">@lang('app.inventory-report.stt')</th>
                                            <th
                                                    rowspan="2">@lang('app.inventory-report.name')</th>
                                            {{--                                                <th--}}
                                            {{--                                                    rowspan="2">@lang('app.inventory-report.unit')</th>--}}
                                            <th
                                                    rowspan="2">@lang('app.inventory-report.category')</th>
                                            <th
                                            >@lang('app.inventory-report.open')
                                            </th>
                                            <th
                                            >@lang('app.inventory-report.import')
                                            </th>
                                            <th
                                            >@lang('app.inventory-report.export')
                                            </th>
                                            <th
                                            >@lang('app.inventory-report.return')
                                            </th>
                                            <th
                                            >@lang('app.inventory-report.cancel')
                                            </th>
                                            {{--                                                <th--}}
                                            {{--                                                    >@lang('app.inventory-report.wastage')--}}
                                            {{--                                                    </th>--}}
                                            <th
                                            >@lang('app.inventory-report.after')
                                            </th>
                                            <th
                                            >@lang('app.inventory-report.check')
                                            </th>
                                            <th
                                            >@lang('app.inventory-report.diff')
                                            </th>
                                            <th
                                                    class="d-none" rowspan="2">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-open-goods">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-open-goods">0</label> </p>--}}
                                            </th>
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-import-goods">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-import-goods">0</label> </p>--}}
                                            </th>
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-export-goods">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-export-goods">0</label> </p>--}}
                                            </th>
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-return-goods">0</label>
                                                {{--                                                    <p class="number-order" ><label  id="total-quantity-return-goods">0</label> </p>--}}
                                            </th>
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-cancel-goods">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-cancel-goods">0</label> </p>--}}
                                            </th>
                                            {{--                                                <th >--}}
                                            {{--                                                    <label class=seemt-fz-14 id="total-amount-wastage-goods">0</label>--}}
                                            {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-wastage-goods">0</label> </p>--}}
                                            {{--                                                </th>--}}
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-after-goods">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-after-goods">0</label> </p>--}}
                                            </th>
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-check-goods">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-check-goods">0</label> </p>--}}
                                            </th>
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-diff-goods">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-diff-goods">0</label> </p>--}}
                                            </th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab3-inventory-report" role="tabpanel">
                                <div class="table-responsive new-table">
                                    <div class="select-filter-dataTable">
                                        <div class="form-validate-select">
                                            <div class="pr-0 select-material-box">
                                                <select
                                                        class="js-example-basic-single select-brand select-brand-material-data">
                                                    @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                        @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                            <option value="{{$db['id']}}"
                                                                    selected>{{$db['name']}}</option>
                                                        @else
                                                            <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-validate-select ml-2">
                                            <div class="pr-0 select-material-box">
                                                <select
                                                        class="js-example-basic-single select-branch select-branch-report">
                                                    @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', ENUM_SELECTED)->all() as $db)
                                                        @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])
                                                            <option value="{{$db['id']}}"
                                                                    selected>{{$db['name']}}</option>
                                                        @else
                                                            <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="select-custom-report">
                                            <div class="select-option">
                                                <select
                                                        class="js-example-basic-single select-target-payment-bill form-control custom-form-search"
                                                        data-validate="search"
                                                        id="select-internal-from-inventory-report">
                                                    <option disabled selected
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                            </div>
                                            <div class="select-option">
                                                <select
                                                        class="js-example-basic-single select-target-payment-bill form-control custom-form-search"
                                                        data-validate="search" id="select-internal-to-inventory-report">
                                                    <option disabled selected
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                            </div>
                                            <div class="search-btn-inventory-report seemt-blue seemt-bg-blue seemt-btn-hover-blue m-0 p-0">
                                                <i
                                                        class="fi-rr-filter"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table" id="table-internal-inventory-report">
                                        <thead>
                                        <tr>
                                            <th
                                                    rowspan="2">@lang('app.inventory-report.stt')</th>
                                            <th
                                                    rowspan="2">@lang('app.inventory-report.name')</th>
                                            {{--                                                <th--}}
                                            {{--                                                    rowspan="2">@lang('app.inventory-report.unit')</th>--}}
                                            <th
                                                    rowspan="2">@lang('app.inventory-report.category')</th>
                                            <th
                                            >@lang('app.inventory-report.open')
                                            </th>
                                            <th
                                            >@lang('app.inventory-report.import')
                                            </th>
                                            <th
                                            >@lang('app.inventory-report.export')
                                            </th>
                                            <th
                                            >@lang('app.inventory-report.return')
                                            </th>
                                            <th
                                            >@lang('app.inventory-report.cancel')
                                            </th>
                                            {{--                                                <th--}}
                                            {{--                                                    >@lang('app.inventory-report.wastage')--}}
                                            {{--                                                    </th>--}}
                                            <th
                                            >@lang('app.inventory-report.after')
                                            </th>
                                            <th
                                            >@lang('app.inventory-report.check')
                                            </th>
                                            <th
                                            >@lang('app.inventory-report.diff')
                                            </th>
                                            <th
                                                    class="d-none" rowspan="2">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-open-internal">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-open-internal">0</label> </p>--}}
                                            </th>
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-import-internal">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-import-internal">0</label> </p>--}}
                                            </th>
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-export-internal">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-export-internal">0</label> </p>--}}
                                            </th>
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-return-internal">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-return-internal">0</label> </p>--}}
                                            </th>
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-cancel-internal">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-cancel-internal">0</label> </p>--}}
                                            </th>
                                            {{--                                                <th >--}}
                                            {{--                                                     <label class=seemt-fz-14 id="total-amount-wastage-internal">0</label>--}}
                                            {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-wastage-internal">0</label> </p>--}}
                                            {{--                                                </th>--}}
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-after-internal">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-after-internal">0</label> </p>--}}
                                            </th>
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-check-internal">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-check-internal">0</label> </p>--}}
                                            </th>
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-diff-internal">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-diff-internal">0</label> </p>--}}
                                            </th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab4-inventory-report" role="tabpanel">
                                <div class="table-responsive new-table">
                                    <div class="select-filter-dataTable">
                                        <div class="form-validate-select">
                                            <div class="pr-0 select-material-box">
                                                <select
                                                        class="js-example-basic-single select-brand select-brand-material-data">
                                                    @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                        @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                            <option value="{{$db['id']}}"
                                                                    selected>{{$db['name']}}</option>
                                                        @else
                                                            <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-validate-select ml-2">
                                            <div class="pr-0 select-material-box">
                                                <select
                                                        class="js-example-basic-single select-branch select-branch-report">
                                                    @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', ENUM_SELECTED)->all() as $db)
                                                        @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])
                                                            <option value="{{$db['id']}}"
                                                                    selected>{{$db['name']}}</option>
                                                        @else
                                                            <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="select-custom-report">
                                            <div class="select-option">
                                                <select
                                                        class="js-example-basic-single select-target-payment-bill form-control custom-form-search"
                                                        data-validate="search" id="select-other-from-inventory-report">
                                                    <option disabled selected
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                            </div>
                                            <div class="select-option">
                                                <select
                                                        class="js-example-basic-single select-target-payment-bill form-control custom-form-search"
                                                        data-validate="search" id="select-other-to-inventory-report">
                                                    <option disabled selected
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                            </div>
                                            <div class="search-btn-inventory-report seemt-blue seemt-bg-blue seemt-btn-hover-blue m-0 p-0">
                                                <i
                                                        class="fi-rr-filter"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table " id="table-other-inventory-report">
                                        <thead>
                                        <tr>
                                            <th
                                                    rowspan="2">@lang('app.inventory-report.stt')</th>
                                            <th
                                                    rowspan="2">@lang('app.inventory-report.name')</th>
                                            {{--                                                <th--}}
                                            {{--                                                    rowspan="2">@lang('app.inventory-report.unit')</th>--}}
                                            <th
                                                    rowspan="2">@lang('app.inventory-report.category')</th>
                                            <th
                                            >@lang('app.inventory-report.open')
                                            </th>
                                            <th
                                            >@lang('app.inventory-report.import')
                                            </th>
                                            <th
                                            >@lang('app.inventory-report.export')
                                            </th>
                                            <th
                                            >@lang('app.inventory-report.return')
                                            </th>
                                            <th
                                            >@lang('app.inventory-report.cancel')
                                            </th>
                                            {{--                                                <th--}}
                                            {{--                                                    >@lang('app.inventory-report.wastage')--}}
                                            {{--                                                    </th>--}}
                                            <th
                                            >@lang('app.inventory-report.after')
                                            </th>
                                            <th
                                            >@lang('app.inventory-report.check')
                                            </th>
                                            <th
                                            >@lang('app.inventory-report.diff')
                                            </th>
                                            <th
                                                    class="d-none" rowspan="2">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-open-other">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-open-other">0</label> </p>--}}
                                            </th>
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-import-other">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-import-other">0</label> </p>--}}
                                            </th>
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-export-other">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-export-other">0</label> </p>--}}
                                            </th>
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-return-other">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-return-other">0</label> </p>--}}
                                            </th>
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-cancel-other">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-cancel-other">0</label> </p>--}}
                                            </th>
                                            {{--                                                <th >--}}
                                            {{--                                                    <label class=seemt-fz-14 id="total-amount-wastage-other">0</label>--}}
                                            {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-wastage-other">0</label> </p>--}}
                                            {{--                                                </th>--}}
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-after-other">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-after-other">0</label> </p>--}}
                                            </th>
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-check-other">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-check-other">0</label> </p>--}}
                                            </th>
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-diff-other">0</label>
                                                {{--                                                    <p class="number-order" ><label class=seemt-fz-14 id="total-quantity-diff-other">0</label> </p>--}}
                                            </th>
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
        <!-- Page-body end -->
    </div>
    @include('report.inventory.excel')
@endsection
@push('scripts')
    @include('layouts.datatable')
    <script type="text/javascript" src="{{ asset('js\template_custom\dataTable.js?version=')}}"></script>
    <script type="text/javascript"
            src="{{ asset('../js/report/warehouse_report/inventory/index.js?version=1')}}"></script>
@endpush
