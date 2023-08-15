@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" id="nav-cards-customer" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-tab="1" data-toggle="tab" href="#tab-waiting-confirm-card"
                       role="tab" aria-expanded="true">Chờ duyệt
                        <span class="label label-warning" id="total-record-waiting-confirm-card">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-tab="2" data-toggle="tab" href="#tab-confirm-card" role="tab"
                       aria-expanded="true">Đã duyệt
                        <span class="label label-success" id="total-record-confirm-card">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-tab="3" data-toggle="tab" href="#tab-cancel-card" role="tab"
                       aria-expanded="true">Đã hủy
                        <span class="label label-danger" id="total-record-tab-cancel-card">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-waiting-confirm-card" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
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
                                <div class="time-filer-dataTale">
                                    <div class="seemt-group-date">
                                        <i class="fi-rr-calendar"></i>
                                        <input class="from-date-cards-customer" type="text" value="01/{{date('m/Y')}}">
                                    </div>
                                    <span class="input-group-addon custom-find"><i
                                                class="fi-rr-angle-double-small-right"></i></span>
                                    <div class="seemt-group-date">
                                        <i class="fi-rr-calendar"></i>
                                        <input class="to-date-cards-customer" type="text" value="{{date('d/m/Y')}}">
                                    </div>
                                    <button class="search-btn-cards-customer"><i class="fi-rr-filter"></i></button>
                                </div>
                            </div>
                            <table id="table-waiting-confirm-card" class="table ">
                                <thead>
                                <tr>
                                    <th>@lang('app.cards.stt')</th>
                                    <th>@lang('app.cards.customer')</th>
                                    {{--                                        <th>@lang('app.cards.card')</th>--}}
                                    <th>@lang('app.cards.phone')</th>
                                    <th>@lang('app.cards.value')</th>
                                    <th>@lang('app.cards.bonus')</th>
                                    <th>@lang('app.cards.amount')</th>
                                    <th>@lang('app.cards.employee')</th>
                                    <th>@lang('app.cards.date')</th>
                                    <th>@lang('app.cards.branch')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-confirm-card" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
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
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-status-card-customer"
                                                data-validate="">
                                            <option value="-1" selected>Tất cả trạng thái</option>
                                            <option value="0">Chưa nạp</option>
                                            <option value="1">Đã nạp</option>
                                        </select>
                                        {{--                                        <div class="line"></div>--}}
                                    </div>
                                </div>
                                <div class="time-filer-dataTale">
                                    <div class="seemt-group-date">
                                        <i class="fi-rr-calendar"></i>
                                        <input class="from-date-cards-customer" type="text" value="01/{{date('m/Y')}}">
                                    </div>
                                    <span class="input-group-addon custom-find"><i
                                                class="fi-rr-angle-double-small-right"></i></span>
                                    <div class="seemt-group-date">
                                        <i class="fi-rr-calendar"></i>
                                        <input class="to-date-cards-customer" type="text" value="{{date('d/m/Y')}}">
                                    </div>
                                    <button class="search-btn-cards-customer"><i class="fi-rr-filter"></i></button>
                                </div>
                            </div>
                            <table id="table-confirm-card" class="table ">
                                <thead>
                                <tr>
                                    <th>@lang('app.cards.stt')</th>
                                    <th>@lang('app.cards.customer')</th>
                                    <th>@lang('app.cards.phone')</th>
                                    <th>@lang('app.cards.value')</th>
                                    <th>@lang('app.cards.bonus')</th>
                                    <th>@lang('app.cards.amount')</th>
                                    <th>@lang('app.cards.employee')</th>
                                    <th>@lang('app.cards.date')</th>
                                    <th>@lang('app.cards.branch')</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-cancel-card" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
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
                                <div class="time-filer-dataTale">
                                    <div class="seemt-group-date">
                                        <i class="fi-rr-calendar"></i>
                                        <input class="from-date-cards-customer" type="text" value="01/{{date('m/Y')}}">
                                    </div>
                                    <span class="input-group-addon custom-find"><i
                                                class="fi-rr-angle-double-small-right"></i></span>
                                    <div class="seemt-group-date">
                                        <i class="fi-rr-calendar"></i>
                                        <input class="to-date-cards-customer" type="text" value="{{date('d/m/Y')}}">
                                    </div>
                                    <button class="search-btn-cards-customer"><i class="fi-rr-filter"></i></button>
                                </div>
                            </div>
                            <table id="table-cancel-card" class="table ">
                                <thead>
                                <tr>
                                    <th>@lang('app.cards.stt')</th>
                                    <th>@lang('app.cards.customer')</th>
                                    {{--                                    <th>@lang('app.cards.card')</th>--}}
                                    <th>Số điện thoại</th>
                                    <th>@lang('app.cards.value')</th>
                                    <th>@lang('app.cards.bonus')</th>
                                    <th>@lang('app.cards.amount')</th>
                                    <th>@lang('app.cards.employee')</th>
                                    <th>@lang('app.cards.date')</th>
                                    <th>@lang('app.cards.branch')</th>
                                    <th></th>
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
    @include('customer.cards.create')
    @include('customer.cards.update')
    @include('customer.cards.detail')
    @include('customer.cards.qr_code')

@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/customer/cards/index.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
