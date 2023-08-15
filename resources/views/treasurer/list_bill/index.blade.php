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
                                    @foreach (collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                        @if ($db['is_office'] === 0)
                                            @if (Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                <option value="{{ $db['id'] }}" selected>{{ $db['name'] }}</option>
                                            @else
                                                <option value="{{ $db['id'] }}">{{ $db['name'] }}</option>
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
                        <div class="time-filer-dataTale">
                            <div class="seemt-group-date">
                                <i class="fi-rr-calendar"></i>
                                <input id="from-date-list-bill-treasurer" type="text" value="01/{{ date('m/Y') }}">
                            </div>
                            <span class="input-group-addon custom-find"><i
                                    class="fi-rr-angle-double-small-right"></i></span>
                            <div class="seemt-group-date">
                                <i class="fi-rr-calendar"></i>
                                <input id="to-date-list-bill-treasurer" type="text" value="{{ date('d/m/Y') }}">
                            </div>
                            <button id="search-btn-list-bill-treasurer"><i class="fi-rr-filter"></i></button>
                        </div>
                        <div class="form-validate-select">
                            <div class="pr-0 select-material-box">
                                <select class="js-example-basic-single" id="filter-status-order">
                                    <option value="-1" selected>Trạng thái</option>
                                    <option value="1">Có tính phí dịch vụ</option>
                                    <option value="0">Không tính phí dịch vụ</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <table id="table-order" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-left" rowspan="2">@lang('app.list-bill-treasurer.stt')</th>
                                <th class="text-left" rowspan="2">@lang('app.list-bill-treasurer.code')</th>
                                <th class="text-left" rowspan="2">@lang('app.list-bill-treasurer.name-table')</th>
                                <th class="text-left" rowspan="2">@lang('app.list-bill-treasurer.employee-table')</th>
                                <th class="text-left" rowspan="2">@lang('app.list-bill-treasurer.customer')</th>
                                <th class="text-right">@lang('app.list-bill-treasurer.amount-table')</th>
                                <th class="text-right">@lang('app.list-bill-treasurer.vat-table')</th>
                                <th class="text-right">@lang('app.list-bill-treasurer.discount-table')</th>
                                @if (Session::get('SESSION_KEY_LEVEL') > 3)
                                    <th class="text-right point-table-list-bill">@lang('app.list-bill-treasurer.point-table')</th>
                                @else
                                    <th class="text-right point-table-list-bill d-none">@lang('app.list-bill-treasurer.point-table')</th>
                                @endif
                                <th>Số khách</th>
                                <th class="text-right">@lang('app.list-bill-treasurer.total-amount-table')</th>
                                <th class="text-center" rowspan="2">@lang('app.list-bill-treasurer.payment-date-table')</th>
                                <th rowspan="2">@lang('app.list-bill-treasurer.bill-status-table')</th>
                                <th rowspan="2">Có tính chi phí dịch vụ</th>
                                <th rowspan="2">@lang('app.list-bill-treasurer.action-table')</th>
                                <th class="d-none" rowspan="1"></th>
                            </tr>
                            <tr>
                                <th id="amount" class="seemt-fz-14">0</th>
                                <th id="total-vat" class="seemt-fz-14">0</th>
                                <th id="total-discount" class="seemt-fz-14">0</th>
                                @if (Session::get('SESSION_KEY_LEVEL') > 3)
                                    <th id="total-point" class="seemt-fz-14">0</th>
                                @else
                                    <th class="d-none" id="total-point" class="seemt-fz-14">0</th>
                                @endif
                                <th id="total-slot-customer" class="seemt-fz-14"></th>
                                <th id="total-amount" class="seemt-fz-14">0</th>
                                <th colspan="2" class="d-none"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- modal detail --}}
    @include('manage.bill.detail')
    {{-- modal detail --}}
@endsection
@push('scripts')
    <script type="text/javascript"
        src="{{ asset('..\js\treasurer\list_bill\index.js?version=3', env('IS_DEPLOY_ON_SERVER')) }}"></script>
@endpush
