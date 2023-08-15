@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-id="1" data-toggle="tab" href="#price-adjustment-tab1"
                       role="tab" aria-expanded="true">@lang('app.price-adjustment-data.tab1') <span
                                class="label label-warning" id="total-record-waiting">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-id="2" data-toggle="tab" href="#price-adjustment-tab2"
                       role="tab" aria-expanded="true">@lang('app.price-adjustment-data.tab2') <span
                                class="label label-success" id="total-record-apply">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-id="3" data-toggle="tab" href="#price-adjustment-tab3"
                       role="tab" aria-expanded="true">@lang('app.price-adjustment-data.tab3') <span
                                class="label label-danger" id="total-record-cancel">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content card-block mb-0 p-0">
                    <div class="tab-pane active" id="price-adjustment-tab1" role="tabpanel">
                        <div class="col-lg-12 p-0">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand select-brand-price-adjustment">
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
                                <table id="table-waiting-price-adjustment-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.price-adjustment-data.stt')</th>
                                        <th>@lang('app.price-adjustment-data.code')</th>
                                        <th class="text-left">@lang('app.price-adjustment-data.employee')</th>
                                        <th>@lang('app.price-adjustment-data.created')</th>
                                        <th>@lang('app.price-adjustment-data.updated')</th>
                                        <th>@lang('app.price-adjustment-data.food')</th>
                                        <th>@lang('app.price-adjustment-data.action')</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="price-adjustment-tab2" role="tabpanel">
                        <div class="col-lg-12 p-0">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand select-brand-price-adjustment">
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
                                <table id="table-apply-price-adjustment-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.price-adjustment-data.stt')</th>
                                        <th>@lang('app.price-adjustment-data.code')</th>
                                        <th class="text-left">@lang('app.price-adjustment-data.employee')</th>
                                        <th>@lang('app.price-adjustment-data.created')</th>
                                        <th>@lang('app.price-adjustment-data.updated')</th>
                                        <th>@lang('app.price-adjustment-data.apply')</th>
                                        <th>@lang('app.price-adjustment-data.food')</th>
                                        <th>@lang('app.price-adjustment-data.action')</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="price-adjustment-tab3" role="tabpanel">
                        <div class="col-lg-12 p-0">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand select-brand-price-adjustment">
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
                                <table id="table-cancel-price-adjustment-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.price-adjustment-data.stt')</th>
                                        <th>@lang('app.price-adjustment-data.code')</th>
                                        <th class="text-left">@lang('app.price-adjustment-data.employee')</th>
                                        <th>@lang('app.price-adjustment-data.created')</th>
                                        <th>@lang('app.price-adjustment-data.updated')</th>
                                        <th>@lang('app.price-adjustment-data.food')</th>
                                        <th>@lang('app.price-adjustment-data.action')</th>
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
    {{--  Modal detail --}}
    @include('build_data.business.price_adjustment.create')
    @include('build_data.business.price_adjustment.update')
    @include('build_data.business.price_adjustment.detail')
    @include('manage.employee.info')
@endsection

@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/business/price_adjustment/index.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
