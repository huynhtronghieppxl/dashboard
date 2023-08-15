@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist" id="nav-tab-checklist-goods-internal-manage">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       href="#tab1-checklist-goods-internal-manage"
                       role="tab"
                       data-id="1"
                       aria-expanded="true">@lang('app.checklist-goods-internal-manage.tab1')
                        <span
                                class="label label-success" id="total-record-pending">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab2-checklist-goods-internal-manage"
                       role="tab"
                       data-id="2"
                       aria-expanded="false">@lang('app.checklist-goods-internal-manage.tab2')
                        <span
                                class="label label-warning" id="total-record-waiting">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab3-checklist-goods-internal-manage"
                       role="tab"
                       data-id="3"
                       aria-expanded="false">@lang('app.checklist-goods-internal-manage.tab3')
                        <span
                                class="label label-primary"
                                id="total-record-complete">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab4-checklist-goods-internal-manage"
                       id="tab-cancel-checklist-goods"
                       role="tab"
                       data-id="4"
                       aria-expanded="false">@lang('app.checklist-goods-internal-manage.tab4')
                        <span
                                class="label label-danger" id="total-record-cancel">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1-checklist-goods-internal-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.checklist_goods_internal.filter')
                            <table class="table"
                                   id="table-pending-checklist-goods-internal-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.checklist-goods-internal-manage.stt')</th>
                                    <th>@lang('app.checklist-goods-internal-manage.id')</th>
                                    <th>@lang('app.checklist-goods-internal-manage.employee')</th>
                                    <th>@lang('app.checklist-goods-internal-manage.inventory')</th>
                                    <th>@lang('app.checklist-goods-internal-manage.time')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-checklist-goods-internal-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.checklist_goods_internal.filter')
                            <table class="table"
                                   id="table-waiting-checklist-goods-internal-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.checklist-goods-internal-manage.stt')</th>
                                    <th>@lang('app.checklist-goods-internal-manage.id')</th>
                                    <th>@lang('app.checklist-goods-internal-manage.employee')</th>
                                    <th>@lang('app.checklist-goods-internal-manage.inventory')</th>
                                    <th>@lang('app.checklist-goods-internal-manage.time')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3-checklist-goods-internal-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.checklist_goods_internal.filter')
                            <table class="table"
                                   id="table-complete-checklist-goods-internal-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.checklist-goods-internal-manage.stt')</th>
                                    <th>@lang('app.checklist-goods-internal-manage.id')</th>
                                    <th>@lang('app.checklist-goods-internal-manage.employee')</th>
                                    <th>@lang('app.checklist-goods-internal-manage.employee-confirm')</th>
                                    <th>@lang('app.checklist-goods-internal-manage.inventory')</th>
                                    <th>@lang('app.checklist-goods-internal-manage.time')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab4-checklist-goods-internal-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.checklist_goods_internal.filter')
                            <table class="table"
                                   id="table-cancel-checklist-goods-internal-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.checklist-goods-internal-manage.stt')</th>
                                    <th>@lang('app.checklist-goods-internal-manage.id')</th>
                                    <th>@lang('app.checklist-goods-internal-manage.employee')</th>
                                    <th>@lang('app.checklist-goods-internal-manage.employee-cancel')</th>
                                    <th>@lang('app.checklist-goods-internal-manage.inventory')</th>
                                    <th>@lang('app.checklist-goods-internal-manage.time')</th>
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


    @include('manage.inventory.checklist_goods_internal.create')
    @include('manage.inventory.checklist_goods_internal.create_period')
    @include('manage.inventory.checklist_goods_internal.update')
    @include('manage.inventory.checklist_goods_internal.update_treasurer')
    @include('manage.inventory.checklist_goods_internal.update_period')
    @include('manage.inventory.checklist_goods_internal.detail')
    @include('manage.inventory.checklist_goods_internal.detail_treasurer')
    @include('manage.inventory.checklist_goods_internal.detail_period')
    @include('manage.employee.info')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/inventory/checklist_goods_internal/index.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
