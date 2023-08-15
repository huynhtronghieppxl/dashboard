@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs md-5-tabs" role="tablist" id="nav-tab-checklist-good">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab1-checklist-goods-manage"
                       role="tab"
                       data-id="1"
                       aria-expanded="true">@lang('app.checklist-goods-manage.tab1') <span
                                class="label label-success" id="total-record-material">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab2-checklist-goods-manage"
                       role="tab"
                       data-id="2"
                       aria-expanded="false">@lang('app.checklist-goods-manage.tab2') <span
                                class="label label-warning" id="total-record-goods">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab3-checklist-goods-manage"
                       role="tab"
                       data-id="3"
                       aria-expanded="false">@lang('app.checklist-goods-manage.tab3') <span
                                class="label label-primary"
                                id="total-record-internal">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab4-checklist-goods-manage"
                       id="tab-cancel-checklist-goods"
                       data-id="12"
                       role="tab" aria-expanded="false">@lang('app.checklist-goods-manage.tab4')
                        <span
                                class="label label-inverse" id="total-record-other">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab5-checklist-goods-manage"
                       id="tab-cancel-checklist-goods"
                       data-id="5"
                       role="tab" aria-expanded="false">@lang('app.checklist-goods-manage.tab5')
                        <span
                                class="label label-danger" id="total-record-cancel">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1-checklist-goods-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.checklist_goods.filter')
                            <table class="table" id="table-material-checklist-goods-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.checklist-goods-manage.stt')</th>
                                    <th>@lang('app.checklist-goods-manage.id')</th>
                                    <th>@lang('app.checklist-goods-manage.employee')</th>
                                    <th>@lang('app.checklist-goods-manage.employee-confirm')</th>
                                    <th>@lang('app.checklist-goods-manage.date')</th>
                                    <th>@lang('app.checklist-goods-manage.status')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-checklist-goods-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.checklist_goods.filter')
                            <table class="table" id="table-goods-checklist-goods-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.checklist-goods-manage.stt')</th>
                                    <th>@lang('app.checklist-goods-manage.id')</th>
                                    <th>@lang('app.checklist-goods-manage.employee')</th>
                                    <th>@lang('app.checklist-goods-manage.employee-confirm')</th>
                                    <th>@lang('app.checklist-goods-manage.date')</th>
                                    <th>@lang('app.checklist-goods-manage.status')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3-checklist-goods-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.checklist_goods.filter')
                            <table class="table" id="table-internal-checklist-goods-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.checklist-goods-manage.stt')</th>
                                    <th>@lang('app.checklist-goods-manage.id')</th>
                                    <th>@lang('app.checklist-goods-manage.employee')</th>
                                    <th>@lang('app.checklist-goods-manage.employee-confirm')</th>
                                    <th>@lang('app.checklist-goods-manage.date')</th>
                                    <th>@lang('app.checklist-goods-manage.status')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab4-checklist-goods-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.checklist_goods.filter')
                            <table class="table"
                                   id="table-other-checklist-goods-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.checklist-goods-manage.stt')</th>
                                    <th>@lang('app.checklist-goods-manage.id')</th>
                                    <th>@lang('app.checklist-goods-manage.employee')</th>
                                    <th>@lang('app.checklist-goods-manage.employee-confirm')</th>
                                    <th>@lang('app.checklist-goods-manage.date')</th>
                                    <th>@lang('app.checklist-goods-manage.status')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab5-checklist-goods-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.checklist_goods.filter')
                            <table class="table"
                                   id="table-cancel-checklist-goods-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.checklist-goods-manage.stt')</th>
                                    <th>@lang('app.checklist-goods-manage.id')</th>
                                    <th>@lang('app.checklist-goods-manage.employee')</th>
                                    <th>@lang('app.checklist-goods-manage.employee-cancel')</th>
                                    <th>@lang('app.checklist-goods-manage.date')</th>
                                    {{--                                        <th>@lang('app.checklist-goods-manage.status')</th>--}}
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
    @include('manage.inventory.checklist_goods.create')
    @include('manage.inventory.checklist_goods.detail')
    @include('manage.inventory.checklist_goods.confirm')
    @include('manage.employee.info')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/inventory/checklist_goods/index.js?version=2',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
