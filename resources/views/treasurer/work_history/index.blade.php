@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card card-block">
                <div class="table-responsive new-table">
                    <div class="select-filter-dataTable">
                        <div class="form-validate-select">
                            <div class="pr-0 select-material-box">
                                <select class="js-example-basic-single select-brand"
                                        id="select-brand-work-history-treasurer">
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
                                <select class="js-example-basic-single select-branch"
                                        id="select-branch-work-history-treasurer">
                                </select>
                            </div>
                        </div>
                        <div class="time-filer-dataTale">
                            <div class="seemt-group-date">
                                <i class="fi-rr-calendar"></i>
                                <input class="from-date-work-history-treasurer" type="text" value="1/{{date('m/Y')}}">
                            </div>
                            <span class="input-group-addon custom-find"><i
                                        class="fi-rr-angle-double-small-right"></i></span>
                            <div class="seemt-group-date">
                                <i class="fi-rr-calendar"></i>
                                <input class="to-date-work-history-treasurer" type="text" value="{{date('d/m/Y')}}">
                            </div>
                            <button class="search-btn-work-history-treasurer"><i class="fi-rr-filter"></i></button>
                        </div>
                    </div>
                    <table id="table-work-history-treasurer" class="table">
                        <thead>
                        <tr>
                            <th rowspan="2">@lang('app.work-history-treasurer.stt')</th>
                            <th class="text-left" rowspan="2">@lang('app.work-history-treasurer.id')</th>
                            <th class="text-left" rowspan="2">@lang('app.work-history-treasurer.open-employee')</th>
                            <th class="text-left" rowspan="2">@lang('app.work-history-treasurer.close-employee')</th>
                            <th class="text-center" rowspan="2">@lang('app.work-history-treasurer.open-time')</th>
                            <th class="text-center" rowspan="2">@lang('app.work-history-treasurer.close-time')</th>
                            <th class="text-right">@lang('app.work-history-treasurer.order')</th>
                            <th class="text-right">@lang('app.work-history-treasurer.revenue')</th>
                            <th class="text-right">@lang('app.work-history-treasurer.cash-amount-shift')</th>
                            <th class="text-right">@lang('app.work-history-treasurer.real-amount')</th>
                            <th class="text-right">@lang('app.work-history-treasurer.difference-amount')</th>
                            <th rowspan="2"></th>
                            <th rowspan="2"></th>
                        </tr>
                        <tr>
                            <th id="total-order-work-history-treasurer" class="seemt-fz-14">0</th>
                            <th id="total-revenue-amount-work-history-treasurer" class="seemt-fz-14">0</th>
                            <th id="total-cash-amount-shift-work-history-treasurer" class="seemt-fz-14">0</th>
                            <th id="total-real-amount-work-history-treasurer" class="seemt-fz-14">0</th>
                            <th id="total-difference-amount-work-history-treasurer" class="seemt-fz-14">0</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('treasurer.work_history.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('..\js\treasurer\work_history\index.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
