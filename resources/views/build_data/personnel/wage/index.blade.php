@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist" id="tab-wage-data">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" id="tab-wage-data-1"
                       href="#wage-tab1" role="tab"
                       aria-expanded="true" data-index="0">@lang('app.area-data.tab1') <span
                                class="label label-success" id="total-record-enable">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" id="tab-wage-data-2" href="#wage-tab2"
                       role="tab"
                       aria-expanded="false" data-index="1">@lang('app.area-data.tab2') <span
                                class="label label-inverse" id="total-record-disable">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class=" card card-block p-b-0">
                <div class="tab-content mb-0">
                    <div class="tab-pane active" id="wage-tab1" role="tabpanel">
                        <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                            <div class="table-responsive new-table">
                                <table class="table resize-table" id="salary-table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.wage-data.stt')</th>
                                        <th>@lang('app.wage-data.name-level-table')</th>
                                        <th>@lang('app.wage-data.default-salary-table')</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="wage-tab2" role="tabpanel">
                        <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                            <div class="table-responsive new-table">
                                <table class="table resize-table" id="salary-table-cancle">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.wage-data.stt')</th>
                                        <th>@lang('app.wage-data.name-level-table')</th>
                                        <th>@lang('app.wage-data.default-salary-table')</th>
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
    @include('build_data.personnel.wage.update')
    @include('build_data.personnel.wage.create')
    @include('manage.employee.info')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/personnel/wage/index.js?version=4', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
