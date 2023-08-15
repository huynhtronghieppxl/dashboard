@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card card-block">
                <div class="table-responsive new-table">
                    <div class="select-filter-dataTable">
                        <div class="form-validate-select">
                            <div class="pr-0 select-material-box">
                                <select class="js-example-basic-single select-brand select-brand-report">
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
                        <div class="form-validate-select ml-3">
                            <div class="pr-0 select-material-box">
                                <select class="js-example-basic-single select-branch select-branch-report">
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
                        <div class="form-validate-select">
                            <div class="pr-0 select-material-box">
                                <select class="js-example-basic-single" id="select-supplier-inventory-supplier-report">
                                    <option value="-1"
                                            selected>@lang('app.inventory-supplier-report.option.all-supplier')</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-validate-select">
                            <div class="pr-0 select-material-box">
                                <select class="js-example-basic-single" id="select-inventory-inventory-supplier-report">
                                    <option value="-1"
                                            selected>@lang('app.inventory-supplier-report.option.all-inventory')</option>
                                    <option value="1">@lang('app.inventory-supplier-report.option.material')</option>
                                    <option value="2">@lang('app.inventory-supplier-report.option.goods')</option>
                                    <option value="3">@lang('app.inventory-supplier-report.option.internal')</option>
                                    <option value="12">@lang('app.inventory-supplier-report.option.other')</option>
                                </select>
                            </div>
                        </div>
                        {{--                        <div class="time-filer-dataTale">--}}
                        {{--                            <input id="from-date-inventory-supplier-report" type="text" value="{{date('d/m/Y')}}">--}}
                        {{--                            <span class="input-group-addon custom-find">@lang('app.component.button.to')</span>--}}
                        {{--                            <input id="to-date-inventory-supplier-report" type="text" value="{{date('d/m/Y')}}">--}}
                        {{--                            <button id="search-btn-inventory-supplier-report"><i class="fa fa-search"></i></button>--}}
                        {{--                        </div>--}}
                        <div class="time-filer-dataTale">
                            <div class="seemt-group-date">
                                <i class="fi-rr-calendar"></i>
                                <input id="from-date-inventory-supplier-report" type="text" value="01/{{date('m/Y')}}">
                            </div>
                            <span class="input-group-addon custom-find"><i
                                        class="fi-rr-angle-double-small-right"></i></span>
                            <div class="seemt-group-date">
                                <i class="fi-rr-calendar"></i>
                                <input id="to-date-inventory-supplier-report" type="text" value="{{date('d/m/Y')}}">
                            </div>
                            <button id="search-btn-inventory-supplier-report"><i class="fi-rr-filter"></i></button>
                        </div>
                    </div>
                    <table class="table" id="table-inventory-supplier-report">
                        <thead>
                        <tr>
                            <th rowspan="2">@lang('app.inventory-supplier-report.stt')</th>
                            <th rowspan="2">@lang('app.inventory-supplier-report.name')</th>
                            <th rowspan="2">@lang('app.inventory-supplier-report.category')</th>
                            <th rowspan="2">@lang('app.inventory-supplier-report.inventory')</th>
                            <th rowspan="2">@lang('app.inventory-supplier-report.accept-quantity')</th>
                            <th rowspan="2">@lang('app.inventory-supplier-report.small-quantity')</th>
                            <th>@lang('app.inventory-supplier-report.amount')</th>
                            <th rowspan="2"></th>
                            <th class="d-none" rowspan="2"></th>
                        </tr>
                        <tr>
                            <th class="seemt-fz-14" id="total-amount-inventory-supplier">0</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('report.inventory_supplier.excel')
    @include('build_data.material.material.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('..\js\report\inventory_supplier\index.js?version=2')}}"></script>
@endpush
