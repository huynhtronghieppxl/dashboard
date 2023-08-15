@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-id="1" data-toggle="tab" id="tab-area-data-1"
                       href="#area-tab1"
                       role="tab"
                       aria-expanded="true">@lang('app.area-data.tab1') <span class="label label-success"
                                                                              id="total-record-enable">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-id="2" data-toggle="tab" id="tab-area-data-2" href="#area-tab2"
                       role="tab"
                       aria-expanded="false">@lang('app.area-data.tab2') <span class="label label-inverse"
                                                                               id="total-record-disable">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block py-0">
                <div class="tab-content">
                    <div class="tab-pane active" id="area-tab1" role="tabpanel">
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
                                <div class="form-validate-select" style="min-width: 120px !important;">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-area-table-build-data"
                                                id=""
                                                data-validate="">
                                            <option disabled selected
                                                    hidden>@lang('app.component.option_default')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="table-enable-table-build-data" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.table-manage_data.STT')</th>
                                    <th>@lang('app.table-manage_data.name-table')</th>
                                    <th>@lang('app.table-manage_data.number-table')</th>
                                    <th>@lang('app.table-manage_data.action-table')</th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                    <div class="tab-pane" id="area-tab2" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select" style="min-width: 120px !important;">
                                    <div class="pr-0 select-material-box">
                                        <select
                                                class="js-example-basic-single select2-hidden-accessible select-area-table-build-data">
                                            <option disabled selected
                                                    hidden>@lang('app.component.option_default')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="table-disable-table-build-data" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.table-manage_data.STT')</th>
                                    <th>@lang('app.table-manage_data.name-table')</th>
                                    <th>@lang('app.table-manage_data.number-table')</th>
                                    <th>@lang('app.table-manage_data.action-table')</th>
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
    @include('build_data.business.table.create')
    @include('build_data.business.table.update')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\build_data\business\table\index.js?version=2'.date('d-m-Y-H'), env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
