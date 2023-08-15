@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-id="1" data-toggle="tab" href="#surcharge-tab1"
                       role="tab" aria-expanded="true">@lang('app.surcharge-data.tab1')
                        <span class="label label-success" id="total-record-enable">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-id="2" data-toggle="tab" href="#surcharge-tab2"
                       role="tab" aria-expanded="false">@lang('app.surcharge-data.tab2')
                        <span class="label label-inverse" id="total-record-disable">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="surcharge-tab1" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand select-brand-surcharge-data">
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
                            <table id="table-enable-surcharge-data" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.surcharge-data.stt')</th>
                                    <th>@lang('app.surcharge-data.name')</th>
                                    <th>@lang('app.surcharge-data.price')</th>
                                    <th>@lang('app.surcharge-data.vat')</th>
                                    <th>@lang('app.surcharge-data.created')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="surcharge-tab2" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand select-brand-surcharge-data">
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
                            <table id="table-disable-surcharge-data" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.surcharge-data.stt')</th>
                                    <th>@lang('app.surcharge-data.name')</th>
                                    {{--                                    <th>@lang('app.surcharge-data.description')</th>--}}
                                    <th>@lang('app.surcharge-data.price')</th>
                                    <th>@lang('app.surcharge-data.vat')</th>
                                    <th>@lang('app.surcharge-data.created')</th>
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
    @include('build_data.business.surcharge.create')
    @include('build_data.business.surcharge.update')
    @include('build_data.business.surcharge.detail')

@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/business/surcharge/index.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

