<style>
    #table-cash-fund-treasurer tbody .active-row-focus {
        background: none !important;
    }

    .time-bonus-punish-index {
        padding-left: 0 !important;
    }
</style>
@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card card-block">
                <div class="table-responsive new-table new-table-row-group">
                    <div class="select-filter-dataTable">
                        <div class="form-validate-select">
                            <div class="pr-0 select-material-box">
                                <select class="js-example-basic-single select-brand">
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
                        <div class="form-validate-select">
                            <div class="pr-0 select-material-box">
                                <select class="js-example-basic-single select-branch">
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
                        <div class="time-filer-dataTale">
                            <input class="time-bonus-punish-index" type="text" value="{{date('m/Y')}}">
                            <button onclick="loadData()"><i class="fi-rr-filter"></i></button>
                        </div>
                    </div>
                    <table id="table-cash-fund-treasurer" class="table ">
                        <thead>
                        <tr>
                            {{--                            <th rowspan="2">@lang('app.cash-fund-treasurer.stt')</th>--}}
                            <th rowspan="2">@lang('app.cash-fund-treasurer.date')</th>
                            <th rowspan="2">@lang('app.cash-fund-treasurer.type')</th>
                            <th rowspan="2">@lang('app.cash-fund-treasurer.object')</th>
                            <th class="text-right">@lang('app.cash-fund-treasurer.amount')</th>
                            <th class="text-right">@lang('app.cash-fund-treasurer.total-revenue')</th>
                            <th class="text-right">@lang('app.cash-fund-treasurer.total-cost')</th>
                            <th class="text-right">@lang('app.cash-fund-treasurer.accumulate')</th>
                            <th class="d-none" rowspan="2"></th>
                        </tr>
                        <tr>
                            <th id="total-amount" class="seemt-fz-14">0</th>
                            <th id="total-revenue" class="seemt-fz-14">0</th>
                            <th id="total-cost" class="seemt-fz-14">0</th>
                            <th id="total-accumulate" class="seemt-fz-14">0</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('..\js\treasurer\cash_fund\index.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
