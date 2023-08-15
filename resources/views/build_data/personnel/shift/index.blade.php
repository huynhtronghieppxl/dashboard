@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist" id="tab-shift-data">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" id="tab-shift-data-1"
                       href="#shift-tab1" role="tab"
                       aria-expanded="true" data-index="0">@lang('app.area-data.tab1') <span
                                class="label label-success" id="total-record-enable">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" id="tab-shift-data-2" href="#shift-tab2"
                       role="tab"
                       aria-expanded="false" data-index="1">@lang('app.area-data.tab2') <span
                                class="label label-inverse" id="total-record-disable">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content mb-0">
                    <div class="tab-pane active" id="shift-tab1" role="tabpanel">
                        <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand shift-data">
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
                                </div>
                                <table id="table-enable-shift-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.shift-data.stt')</th>
                                        <th>@lang('app.shift-data.name-table')</th>
                                        <th>@lang('app.shift-data.timeinterval-table')</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="shift-tab2" role="tabpanel">
                        <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand shift-data">
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
                                </div>
                                <table id="table-disable-shift-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.shift-data.stt')</th>
                                        <th>@lang('app.shift-data.name-table')</th>
                                        <th>@lang('app.shift-data.timeinterval-table')</th>
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
    </div>

    @include('build_data.personnel.shift.create')
    @include('build_data.personnel.shift.update')
    @include('manage.employee.info')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/personnel/shift/index.js?version=5', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
