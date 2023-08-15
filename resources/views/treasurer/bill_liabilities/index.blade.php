@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card card-block">
                <div class="table-responsive new-table">
                    <div class="select-filter-dataTable">
                        <div class="form-validate-select">
                            <div class="pr-0 select-material-box">
                                <select class="js-example-basic-single select-brand">
{{--                                    @foreach (collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)--}}
{{--                                        @if (Session::get(SESSION_KEY_BRAND_ID) == $db['id'])--}}
{{--                                            <option value="{{ $db['id'] }}" selected>{{ $db['name'] }}</option>--}}
{{--                                        @else--}}
{{--                                            <option value="{{ $db['id'] }}">{{ $db['name'] }}</option>--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
                                    <option value="-1" selected>Toàn thương hiệu</option>
                                    @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                        <option value="{{$db['id']}}">{{$db['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-validate-select d-none" id="select-branch-order-bill-liabilities">
                            <div class="pr-0 select-material-box">
                                <select class="js-example-basic-single select-branch">
{{--                                    @foreach (collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', ENUM_SELECTED)->all() as $db)--}}
{{--                                        @if (Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])--}}
{{--                                            <option value="{{ $db['id'] }}" selected>{{ $db['name'] }}</option>--}}
{{--                                        @else--}}
{{--                                            <option value="{{ $db['id'] }}">{{ $db['name'] }}</option>--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
                                </select>
                            </div>
                        </div>
                        <div class="time-filer-dataTale">
                            <div class="seemt-group-date">
                                <i class="fi-rr-calendar"></i>
                                <input id="from-date-bill-liabilities" type="text" value="{{ date('d/m/Y') }}">
                            </div>
                            <span class="input-group-addon custom-find seemt-gray-w600"><i
                                        class="fi-rr-angle-double-small-right"></i></span>
                            <div class="seemt-group-date">
                                <i class="fi-rr-calendar"></i>
                                <input id="to-date-bill-liabilities" type="text" value="{{ date('d/m/Y') }}">
                            </div>
                            <button id="search-btn-payment-bill"><i class="fi-rr-filter"></i></button>
                        </div>
                    </div>
                    <table id="table-supplier-bill-liabilities" class="table fix-size-table">
                        <thead>
                        <tr>
                            <th rowspan="2">@lang('app.bill-liabilities.stt')</th>
                            <th rowspan="2">@lang('app.bill-liabilities.name')</th>
                            <th class="text-right">@lang('app.bill-liabilities.session')</th>
                            <th class="text-right">@lang('app.bill-liabilities.done')</th>
                            <th class="text-right">
                                <div class="col-lg-12 ml-3">@lang('app.bill-liabilities.confirm')
                                    <label class="mb-0 ml-auto">
                                        <div class="tool-box">
                                            <div data-toolbar="user-options">
                                                <i class="fi-rr-exclamation" style="vertical-align: sub"
                                                   data-toggle="tooltip" data-placement="top"
                                                   data-original-title="@lang('app.bill-liabilities.confirm') {{ date('m/Y') }}"></i>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </label>
                                </div>
                            <th class="text-right">
                                <div class="col-lg-12 ml-3">@lang('app.bill-liabilities.payment')
                                    <label class="mb-0 ml-auto">
                                        <div class="tool-box">
                                            <div data-toolbar="user-options">
                                                <i class="fi-rr-exclamation" style="vertical-align: sub"
                                                   data-toggle="tooltip" data-placement="top"
                                                   data-original-title="@lang('app.bill-liabilities.note-payment') {{ date('m/Y', strtotime('-1 month')) }}"></i>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </label>
                                </div>
                            <th rowspan="2">@lang('app.bill-liabilities.action')</th>
                            <th class="d-none" rowspan="2"></th>
                        </tr>
                        <tr>
                            <th>
                                <label id="total-amount-session-bill-liabilities" class="seemt-fz-14">0</label><br>
                                <label class="number-order-header seemt-fz-14"
                                       id="total-record-session-bill-liabilities">0</label>
                            </th>
                            <th>
                                <label id="total-amount-done-bill-liabilities" class="seemt-fz-14">0</label><br>
                                <label class="number-order-header seemt-fz-14"
                                       id="total-record-done-bill-liabilities">0</label>
                            </th>
                            <th>
                                <label id="total-amount-confirm-bill-liabilities" class="seemt-fz-14">0</label><br>
                                <label class="number-order-header seemt-fz-14"
                                       id="total-record-confirm-bill-liabilities">0</label>
                            </th>
                            <th>
                                <label id="total-amount-payment-bill-liabilities" class="seemt-fz-14">0</label><br>
                                <label class="number-order-header seemt-fz-14"
                                       id="total-record-payment-bill-liabilities">0</label>
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('treasurer.bill_liabilities.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\treasurer\bill_liabilities\index.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
