@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-id="1" data-toggle="tab" href="#revenue-data-tab1"
                       role="tab" aria-expanded="true">@lang('app.revenue-data.tab1') <span
                                class="label label-success" id="total-record-enable">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-id="2" data-toggle="tab" href="#revenue-data-tab2"
                       role="tab" aria-expanded="false">@lang('app.revenue-data.tab2') <span
                                class="label label-inverse" id="total-record-disable">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content m-t-5px">
                    <div class="tab-pane active" id="revenue-data-tab1" role="tabpanel">
                        <div class="table-responsive new-table">
                            <table id="table-enable-revenue-data" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.revenue-data.stt')</th>
                                    <th>@lang('app.revenue-data.name')</th>
                                    <th>@lang('app.revenue-data.action')</th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="revenue-data-tab2" role="tabpanel">
                        <div class="table-responsive new-table">
                            <table id="table-disable-revenue-data" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.revenue-data.stt')</th>
                                    <th>@lang('app.revenue-data.name')</th>
                                    <th>@lang('app.revenue-data.action')</th>
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
    @include('build_data.revenue_and_cost.revenue.create')
    @include('build_data.revenue_and_cost.revenue.update')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/revenue_and_cost/revenue/index.js?version=5', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
