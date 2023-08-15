@extends('layouts.layout')
@section('content')
    <style>
        .pointer-none {
            pointer-events: none;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist" id="nav-bank-data">
                <li class="nav-item">
                    <a class="nav-link" data-tab="0" data-toggle="tab" href="#bank-tab1" role="tab"
                       aria-expanded="true"> @lang('app.bank-data.tab1') <span class="label label-success"
                                                                                         id="total-record-enable">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-tab="1" data-toggle="tab" href="#bank-tab2" role="tab"
                       aria-expanded="false">@lang('app.bank-data.tab2') <span class="label label-inverse"
                                                                                         id="total-record-disable">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="col-sm-12 row pl-0 bank-is-default">
                    <div class="col-sm-6 pl-0">
                        <h5 class="ml-0"
                            style="font-size: 13px"> @lang('app.bank-data.bank-current')
                            <b
                                class="ml-1" id="name-branch"></b>:&emsp;<b class="seemt-orange"
                                                                            id="name-bank-account"
                                                                            style="font-size: 15px;font-weight: bold;">----</b>
                        </h5>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="bank-tab1" role="tabpanel">
                        <div class="col-sm-12 p-0">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand select-brand-bank-data">
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
                                </div>
                                <table id="table-enable-bank-data" class="table" data-tab="0">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.bank-data.stt')</th>
                                        <th>@lang('app.bank-data.choose')</th>
                                        <th>@lang('app.bank-data.bank')</th>
                                        <th>@lang('app.bank-data.bank-number')</th>
                                        <th>@lang('app.bank-data.bank-account')</th>
                                        <th>@lang('app.bank-data.action')</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="bank-tab2" role="tabpanel">
                        <div class="col-sm-12 p-0">
                            <div class="table-responsive new-table">
                                <table id="table-disable-bank-data" class="table" data-tab="1">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.bank-data.stt')</th>
                                        <th>@lang('app.bank-data.bank')</th>
                                        <th>@lang('app.bank-data.bank-number')</th>
                                        <th>@lang('app.bank-data.bank-account')</th>
                                        <th>@lang('app.bank-data.action')</th>
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
    </div>
    <div class="d-none">
        <span id="msg-title-status-bank-data">@lang('app.specifications-data.title-status')</span>
        <span id="msg-content-status-bank-data">@lang('app.specifications-data.content-status')</span>
        <span id="msg-success-status-bank-data">@lang('app.specifications-data.success-status')</span>
    </div>
    @include('setting.bank.create')
    @include('setting.bank.update')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\setting\bank\index.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
