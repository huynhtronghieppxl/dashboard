@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-id="1" data-toggle="tab" href="#cost-data-tab1"
                       role="tab" aria-expanded="true">@lang('app.cost-data.tab1') <span
                                class="label label-success" id="total-record-enable">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-id="2" data-toggle="tab" href="#cost-data-tab2"
                       role="tab" aria-expanded="false">@lang('app.cost-data.tab2') <span
                                class="label label-inverse" id="total-record-disable">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content m-t-5px">
                    <div class="tab-pane active" id="cost-data-tab1" role="tabpanel">
                        <div class="table-responsive new-table">
                            <table id="table-enable-cost-data" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.cost-data.table.STT')</th>
                                    <th>@lang('app.cost-data.table.name-cost')</th>
                                    <th>@lang('app.cost-data.table.action')</th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="cost-data-tab2" role="tabpanel">
                        <div class="table-responsive new-table">
                            <table id="table-disable-cost-data" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.cost-data.table.STT')</th>
                                    <th>@lang('app.cost-data.table.name-cost')</th>
                                    <th>@lang('app.cost-data.table.action')</th>
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
    {{-- Cost Data--}}
    <div class="d-none">
        <div id="create-cost-data">@lang('app.cost-data.create.msg-sucess')</div>
        <div id="remove-success-cost-data">@lang('app.cost-data.update.msg-remove-success')</div>
        <div id="update-success-cost-data">@lang('app.cost-data.update.msg-update-success')</div>
        <div id="update-failed-cost-data">@lang('app.cost-data.update.msg-update-failed')</div>
        <div id="check-type-cost-data">@lang('app.cost-data.create.check-type')</div>
        <div id="check-name-cost-data">@lang('app.cost-data.create.check-name')</div>
    </div>
    @include('build_data.revenue_and_cost.cost.create')
    @include('build_data.revenue_and_cost.cost.update')
    @include('build_data.revenue_and_cost.cost.notify')
    @include('treasurer.payment_bill.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/revenue_and_cost/cost/index.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
