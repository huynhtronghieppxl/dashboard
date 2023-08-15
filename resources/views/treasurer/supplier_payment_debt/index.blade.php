@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist" id="nav-tab-supplier-payment-debt">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" id="tab-area-data-1" href="#area-tab1"
                       data-id="1"
                       role="tab"
                       aria-expanded="true">@lang('app.supplier-payment-debt.tab1') <span
                                class="label label-warning"
                                id="total-record-enable">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" id="tab-area-data-2" href="#area-tab2" role="tab"
                       data-id="2"
                       aria-expanded="false">@lang('app.supplier-payment-debt.tab2') <span
                                class="label label-success"
                                id="total-record-disable">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="area-tab1" role="tabpanel">
                        <div class="table-responsive new-table">
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
                                    <div class="seemt-group-date">
                                        <i class="fi-rr-calendar"></i>
                                        <input class="from-date-supplier-payment-debt-treasurer" type="text"
                                               value="1/{{date('m/Y')}}">
                                    </div>
                                    <span class="input-group-addon custom-find"><i
                                                class="fi-rr-angle-double-small-right"></i></span>
                                    <div class="seemt-group-date">
                                        <i class="fi-rr-calendar"></i>
                                        <input class="to-date-supplier-payment-debt-treasurer" type="text"
                                               value="{{date('d/m/Y')}}">
                                    </div>
                                    <button class="search-btn-supplier-payment-debt-treasurer"><i
                                                class="fi-rr-filter"></i></button>
                                </div>
                            </div>
                            <table id="table-waiting-supplier-payment-debt" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.supplier-payment-debt.detail.stt')</th>
                                    <th>@lang('app.supplier-payment-debt.detail.supplier-name')</th>
                                    <th>@lang('app.supplier-payment-debt.detail.amount')</th>
                                    <th>@lang('app.supplier-payment-debt.detail.number-order')</th>
                                    <th>@lang('app.supplier-payment-debt.detail.date-time')</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="area-tab2" role="tabpanel">
                        <div class="table-responsive new-table">
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
                                    <div class="seemt-group-date">
                                        <i class="fi-rr-calendar"></i>
                                        <input class="from-date-supplier-payment-debt-treasurer" type="text"
                                               value="1/{{date('m/Y')}}">
                                    </div>
                                    <span class="input-group-addon custom-find"><i
                                                class="fi-rr-angle-double-small-right"></i></span>
                                    <div class="seemt-group-date">
                                        <i class="fi-rr-calendar"></i>
                                        <input class="to-date-supplier-payment-debt-treasurer" type="text"
                                               value="{{date('d/m/Y')}}">
                                    </div>
                                    <button class="search-btn-supplier-payment-debt-treasurer"><i
                                                class="fi-rr-filter"></i></button>
                                </div>
                            </div>
                            <table id="table-complete-supplier-payment-debt" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.supplier-payment-debt.detail.stt')</th>
                                    <th>@lang('app.supplier-payment-debt.detail.supplier-name')</th>
                                    <th>@lang('app.supplier-payment-debt.detail.amount')</th>
                                    <th>@lang('app.supplier-payment-debt.detail.number-order')</th>
                                    <th>@lang('app.supplier-payment-debt.detail.date-time')</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('treasurer.supplier_payment_debt.detail')

@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/treasurer/supplier_payment_debt/index.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
