@extends('layouts.layout')
@section('content')
    <div class="page-body">
        <div class="card card-block">
            <ul class="nav nav-tabs md-tabs md-7-tabs" id="tabs-food-branch-manage" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       data-type="1" href="#tab1-food-branch-manage" role="tab"
                       aria-expanded="true"
                       data-index="0" data-column="1">
                        @lang('app.food-branch-manage.tab1')
                        <span class="label label-success" id="total-record-food">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-type="2"
                       href="#tab2-food-branch-manage" role="tab" aria-expanded="false"
                       data-index="1" data-column="1">
                        @lang('app.food-branch-manage.tab2')
                        <span class="label label-warning" id="total-record-drink">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-type="4"
                       href="#tab3-food-branch-manage" role="tab" aria-expanded="false"
                       data-index="2" data-column="1">
                        @lang('app.food-branch-manage.tab3')
                        <span class="label label-primary" id="total-record-sea-food">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-type="3"
                       href="#tab4-food-branch-manage" role="tab" aria-expanded="false"
                       data-index="3" data-column="1">
                        @lang('app.food-branch-manage.tab4')
                        <span class="label label-inverse" id="total-record-other">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-type=""
                       href="#tab5-food-branch-manage"
                       role="tab" aria-expanded="false" data-index="4" data-column="2">
                        @lang('app.food-branch-manage.tab5')
                        <span class="label label-success" id="total-record-combo">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-type=""
                       href="#tab7-food-branch-manage"
                       role="tab" aria-expanded="false" data-index="5" data-column="2">
                        @lang('app.food-branch-manage.tab7')
                        <span class="label label-info" id="total-record-addition">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-type=""
                       href="#tab8-food-branch-manage"
                       role="tab" aria-expanded="false" data-index="6" data-column="2">
                        @lang('app.food-branch-manage.tab8')
                        <span class="label label-inverse" id="total-record-disable">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab1-food-branch-manage" role="tabpanel">
                    <div class="table-responsive new-table">
                        @include('manage.food.branch.filter')
                        <table class="table table-bordered" id="table-food-food-branch-manage">
                            <thead>
                            <tr>
                                <th>@lang('app.food-branch-manage.stt')</th>
                                <th>@lang('app.food-branch-manage.name')</th>
                                <th>@lang('app.food-branch-manage.unit')</th>
                                <th>@lang('app.food-branch-manage.category')</th>
                                <th>@lang('app.food-branch-manage.price')</th>
                                <th>% Giá vốn</th>
                                <th>@lang('app.food-branch-manage.temporary-price')</th>
                                <th>@lang('app.food-branch-manage.profit')</th>
                                <th>@lang('app.food-branch-manage.quantity')</th>
                                <th>@lang('app.food-branch-manage.kitchen')</th>
                                <th>@lang('app.food-branch-manage.action')</th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="tab2-food-branch-manage" role="tabpanel">
                    <div class="table-responsive new-table">
                        @include('manage.food.branch.filter')
                        <table class="table table-bordered" id="table-drink-food-branch-manage">
                            <thead>
                            <tr>
                                <th>@lang('app.food-branch-manage.stt')</th>
                                <th class="text-left">@lang('app.food-branch-manage.name')</th>
                                <th>@lang('app.food-branch-manage.unit')</th>
                                <th>@lang('app.food-branch-manage.category')</th>
                                <th>@lang('app.food-branch-manage.price')</th>
                                <th>% Giá vốn</th>
                                <th>@lang('app.food-branch-manage.temporary-price')</th>
                                <th>@lang('app.food-branch-manage.profit')</th>
                                <th>@lang('app.food-branch-manage.quantity')</th>
                                <th>@lang('app.food-branch-manage.kitchen')</th>
                                <th>@lang('app.food-branch-manage.action')</th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="tab3-food-branch-manage" role="tabpanel">
                    <div class="table-responsive new-table">
                        @include('manage.food.branch.filter')
                        <table class="table table-bordered"
                               id="table-sea-food-food-branch-manage">
                            <thead>
                            <tr>
                                <th>@lang('app.food-branch-manage.stt')</th>
                                <th class="text-left">@lang('app.food-branch-manage.name')</th>
                                <th>@lang('app.food-branch-manage.unit')</th>
                                <th>@lang('app.food-branch-manage.category')</th>
                                <th>@lang('app.food-branch-manage.price')</th>
                                <th>% Giá vốn</th>
                                <th>@lang('app.food-branch-manage.temporary-price')</th>
                                <th>@lang('app.food-branch-manage.profit')</th>
                                <th>@lang('app.food-branch-manage.quantity')</th>
                                <th>@lang('app.food-branch-manage.kitchen')</th>
                                <th>@lang('app.food-branch-manage.action')</th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="tab4-food-branch-manage" role="tabpanel">
                    <div class="table-responsive new-table">
                        @include('manage.food.branch.filter')
                        <table class="table table-bordered" id="table-other-food-branch-manage">
                            <thead>
                            <tr>
                                <th>@lang('app.food-branch-manage.stt')</th>
                                <th class="text-left">@lang('app.food-branch-manage.name')</th>
                                <th>@lang('app.food-branch-manage.unit')</th>
                                <th>@lang('app.food-branch-manage.category')</th>
                                <th>@lang('app.food-branch-manage.price')</th>
                                <th>% Giá vốn</th>
                                <th>@lang('app.food-branch-manage.temporary-price')</th>
                                <th>@lang('app.food-branch-manage.profit')</th>
                                <th>@lang('app.food-branch-manage.quantity')</th>
                                <th>@lang('app.food-branch-manage.kitchen')</th>
                                <th>@lang('app.food-branch-manage.action')</th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="tab5-food-branch-manage" role="tabpanel">
                    <div class="table-responsive new-table">
                        <div class="select-filter-dataTable">
                            <div class="form-validate-select">
                                <div class="pr-0 select-material-box">
                                    <select class="js-example-basic-single select-category-food-branch-manage"
                                            data-validate="">
                                        <option value="" disabled selected hidden>@lang('app.component.option-null')</option>
                                    </select>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered" id="table-combo-food-branch-manage">
                            <thead>
                            <tr>
                                <th>@lang('app.food-branch-manage.stt')</th>
                                <th class="text-left">@lang('app.food-branch-manage.name')</th>
                                <th>@lang('app.food-branch-manage.category')</th>
                                <th>@lang('app.food-branch-manage.price')</th>
                                <th>% Giá vốn</th>
                                <th>@lang('app.food-branch-manage.temporary-price')</th>
                                <th>@lang('app.food-branch-manage.profit')</th>
                                <th>@lang('app.food-branch-manage.action')</th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="tab7-food-branch-manage" role="tabpanel">
                    <div class="table-responsive new-table">
                        @include('manage.food.branch.filter')
                        <table class="table table-bordered"
                               id="table-addition-food-branch-manage">
                            <thead>
                            <tr>
                                <th>@lang('app.food-branch-manage.stt')</th>
                                <th class="text-left">@lang('app.food-branch-manage.name')</th>
                                <th>@lang('app.food-branch-manage.unit')</th>
                                <th>@lang('app.food-branch-manage.category')</th>
                                <th>@lang('app.food-branch-manage.price')</th>
                                <th>% Giá vốn</th>
                                <th>@lang('app.food-branch-manage.temporary-price')</th>
                                <th>@lang('app.food-branch-manage.profit')</th>
                                <th>@lang('app.food-branch-manage.quantity')</th>
                                <th>@lang('app.food-branch-manage.kitchen')</th>
                                <th>@lang('app.food-branch-manage.action')</th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="tab8-food-branch-manage" role="tabpanel">
                    <div class="table-responsive new-table">
                        @include('manage.food.branch.filter')
                        <table class="table table-bordered" id="table-disable-food-branch-manage">
                            <thead>
                            <tr>
                                <th>@lang('app.food-branch-manage.stt')</th>
                                <th class="text-left">@lang('app.food-branch-manage.name')</th>
                                <th>@lang('app.food-branch-manage.unit')</th>
                                <th>@lang('app.food-branch-manage.category')</th>
                                <th>@lang('app.food-branch-manage.price')</th>
                                <th>% Giá vốn</th>
                                <th>@lang('app.food-branch-manage.temporary-price')</th>
                                <th>@lang('app.food-branch-manage.profit')</th>
                                <th>@lang('app.food-branch-manage.quantity')</th>
                                <th>@lang('app.food-branch-manage.kitchen')</th>
                                <th>@lang('app.food-branch-manage.action')</th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('manage.food.branch.change_kitchen')
    @include('manage.food.brand.detail')
    @include('manage.food.branch.food_area')
    <div class="d-none">
        <span id="processing">@lang('app.food-branch-manage.mess.processing')</span>
        <span id="branch">@lang('app.food-branch-manage.mess.branch')</span>
        <span id="food">@lang('app.food-branch-manage.mess.food')</span>
        <span id="category_food">@lang('app.food-branch-manage.mess.category_food')</span>
        <span id="time_cooking">@lang('app.food-branch-manage.mess.time_cooking')</span>
        <span id="last_price">@lang('app.food-branch-manage.mess.last_price')</span>
        <span id="price">@lang('app.food-branch-manage.mess.price')</span>
        <span id="unit">@lang('app.food-branch-manage.mess.unit')</span>
        <span id="use_point">@lang('app.food-branch-manage.mess.use_point')</span>
        <span id="notify_1m">@lang('app.food-branch-manage.mess.notify_1m')</span>
        <span id="notify_100m">@lang('app.food-branch-manage.mess.notify_100m')</span>
        <span id="max_image">@lang('app.food-branch-manage.mess.max_image')</span>
        <span id="not_type">@lang('app.food-branch-manage.mess.not_type')</span>
        <span id="check_branch">@lang('app.food-branch-manage.mess.check_branch')</span>
        <span id="error_file">@lang('app.food-branch-manage.mess.error_file')</span>
        <span id="text_fail_food">@lang('app.food-branch-manage.mess.text_fail_food')</span>
        <span id="check_file">@lang('app.food-branch-manage.mess.check_file')</span>
        <span id="error_file">@lang('app.food-branch-manage.mess.error_file')</span>
        <span id="type_food_text">@lang('app.food-branch-manage.option_type')</span>
        <span id="error-food">@lang('app.food-branch-manage.inport.error-food')</span>
        <span id="success-food">@lang('app.food-branch-manage.inport.success-food')</span>
        <span id="notify-on-update-status-component">@lang('app.component.sweet_alert.status.change-status-on')</span>
        <span id="notify-off-update-status-component">@lang('app.component.sweet_alert.status.change-status-off')</span>
    </div>
    @include('manage.food.branch.update')
@endsection
@push('scripts')
    <script type="text/javascript" src="{{asset('/js/manage/food/branch/index.js?version=6',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
