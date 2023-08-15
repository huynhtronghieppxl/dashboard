@extends('layouts.layout')
@section('content')
    <style>
        .search-customer-booking-table-manage,
        .search-tag-booking-table-manage {
            width: calc(100% - 30px);
            position: absolute;
            background-color: #34465d;
            z-index: 999;
            border-radius: 10px;
            max-height: 200px;
            overflow-y: auto;
            display: block;
        }

        .item-search-customer {
            display: inline-block;
            padding: 5px 10px;
            position: relative;
            width: 100%;
            cursor: default;
        }

        .item-search-customer:hover {
            background-color: #2e3c52;
        }

        .item-search-customer figure {
            display: inline-block;
            margin-bottom: 0;
            vertical-align: middle;
            width: 30px;
        }

        .item-search-customer figure img {
            border-radius: 100%;
            width: 30px;
            height: 30px;
            vertical-align: middle;
            border-style: none;
        }

        .item-search-customer .friend-meta {
            display: inline-block;
            padding-left: 10px;
            vertical-align: middle;
            width: calc(100% - 35px);
        }

        .item-search-customer .friend-meta > h4 {
            color: #fff;
            display: inline-block;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 0;
            width: 100%;
        }

        .item-search-customer .label-level {
            padding: 5px;
            position: absolute;
            right: 0;
        }

        .list-gift-create-booking-table-manage {
            overflow-x: visible;
            display: inherit;
        }

        .list-gift-create-booking-table-manage .owl-nav {
            display: block;
        }

        .list-gift-create-booking-table-manage .owl-dots {
            display: none;
        }

        .list-gift-create-booking-table-manage .item {
            background: #f2f7fb none repeat scroll 0 0;
            border: 1px solid #ede9e9;
            border-radius: 3px;
            padding-bottom: 7px;
        }

        /*.list-gift-create-booking-table-manage .active .item{*/
        /*    border: 2px solid #f8b03f;*/
        /*}*/

        .list-gift-create-booking-table-manage .sugtd-frnd-meta {
            display: inline-block;
            margin-top: 10px;
            text-align: center;
            width: 100%;
        }

        .list-gift-create-booking-table-manage .sugtd-frnd-meta > a {
            color: #515365;
            display: inline-block;
            font-size: 13.5px;
            font-weight: 500;
            width: 100%;
            transition: all 0.2s linear 0s;
            height: 40.5px;
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 2;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            padding: 0 3px;
        }

        .list-gift-create-booking-table-manage .sugtd-frnd-meta > span {
            display: inline-block;
            font-size: 11px;
            width: 100%;
        }

        .list-gift-create-booking-table-manage .add-remove-frnd {
            display: flex;
            justify-content: center;
            gap: 10px;
            list-style: outside none none;
            margin-top: 4px;
            padding: 0 14px;
            text-align: center;
            width: 100%;
        }

        .list-gift-create-booking-table-manage .add-remove-frnd > li {
            display: inline-block;
        }

        .list-gift-create-booking-table-manage .add-remove-frnd > li a {
            border-radius: 4px;
            color: #fff;
            display: inline-block;
            padding: 2px 5px;
            transition: all 0.2s linear 0s;
            font-size: 13px;
        }

        .list-gift-create-booking-table-manage .add-remove-frnd > li a:hover {
            background: #fa6342;
        }

        .list-gift-create-booking-table-manage .add-remove-frnd > li a > i {
            font-size: 13px;
        }

        .list-gift-create-booking-table-manage .add-remove-frnd > li:last-child {
            margin-right: 0;
        }

        .list-gift-create-booking-table-manage .add-tofrndlist > a {
            background: #0085b1 none repeat scroll 0 0;
        }

        .list-gift-create-booking-table-manage .delete-tofrndlist > a {
            background: #f9a236 none repeat scroll 0 0;
        }

        .list-gift-create-booking-table-manage .remove-frnd > a {
            background: #a8adcd none repeat scroll 0 0;
        }

        .list-gift-create-booking-table-manage .owl-prev::before, .list-gift-create-booking-table-manage .owl-next::before {
            background: #fff;
            border-radius: 50%;
            color: #fa6342;
            content: "\f0d9";
            display: inline-block;
            font-family: fontawesome;
            font-size: 18px;
            left: -15px;
            line-height: 30px;
            position: absolute;
            text-align: center;
            top: 50%;
            transform: translateY(-50%);
            width: 30px;
            box-shadow: 0 3px 7px rgb(0 0 0 / 50%);
            transition: all 0.2s linear 0s;
        }

        .list-gift-create-booking-table-manage .owl-next::before {
            content: "\f0da";
            left: auto;
            right: -15px;
        }

        .list-gift-create-booking-table-manage .owl-prev, .list-gift-create-booking-table-manage .owl-next {
            left: 0;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: transparent !important;
            background: transparent !important;
        }

        .list-gift-create-booking-table-manage .owl-prev:hover, .list-gift-create-booking-table-manage .owl-next:hover {
            background: transparent !important;
        }

        .list-gift-create-booking-table-manage .owl-next {
            left: auto;
            right: 0;
        }

        .list-gift-create-booking-table-manage .owl-prev:hover:before, .list-gift-create-booking-table-manage .owl-next:hover:before {
            background: #fa6342;
            color: #fff;
        }

        .list-gift-create-booking-table-manage .item-gift-create-booking-table-manage {
            border-bottom: 1px solid #c2c2c2;
            border-radius: 0;
        }

        .list-gift-create-booking-table-manage .item-gift-active {
            border: 1px solid #f9a236;
            overflow: hidden;
            border-radius: 5px;
        }

        .gift-img-container {
            width: 100%;
            position: relative;
        }

        .gift-img-container:after {
            content: "";
            display: block;
            padding-bottom: 100%;
        }

        .gift-img-container img {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        #total-gift {
            font-size: 14px !important;
        }


        .group-icon-gift {
            width: 40px;
            height: 40px;
        }

        .group-icon-gift {
            position: relative;
        }

        .group-icon-gift #icon-gift img,
        .group-icon-gift #icon-gift-update img,
        .group-icon-gift #icon-gift-detail img {
            width: 100%;
        }

        .group-icon-gift #icon-gift > label,
        .group-icon-gift #icon-gift-update > label,
        .group-icon-gift #icon-gift-detail > label {
            background-color: #fe5d70 !important;
            color: #fff;
            position: absolute;
            padding: 1px 6px;
            border-radius: 50%;
            right: -14px;
            top: -10px;
        }

        .group-gift-selected {
            min-width: 265px;
            background: #fff;
            z-index: 999999999999 !important;
            position: absolute;
            right: -12px;
            top: 45px;
            border-radius: 8px;
            box-shadow: 0 0 6px rgb(0 0 0 / 30%);
            min-height: 200px;
            max-height: 266px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .group-gift-selected::-webkit-scrollbar {
            width: 4px;
            background-color: #F5F5F5;
        }

        .group-gift-selected::-webkit-scrollbar-thumb {
            background-color: #6c757d;
        }

        .group-gift-selected #data-gift-empty-booking-table {
            text-align: center;
            margin-top: 25px
        }

        .group-gift-selected li:first-child {
            padding-top: 12px;
        }

        .group-gift-selected li {
            padding: 6px 12px;
            margin-bottom: 1px;
        }

        .group-gift-selected li:hover {
            background: #ecf1f5;
            cursor: pointer;
        }

        #booking-table-detail-gift li:last-child > div {
            border-bottom: none;
            padding-bottom: 0;
        }

        .group-gift-selected li:last-child .row-wrap {
            border-bottom: none;
        }

        .group-gift-selected .row-gift {
            display: flex;
            padding: 10px;
            align-items: center;
            position: relative;
        }

        .group-gift-selected .avatar-gift {
            position: relative;
        }

        .group-gift-selected .avatar-gift > img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .group-gift-selected .avatar-about {
            padding-left: 10px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .img-inline-name-data-table {
            width: 40px;
            height: 40px;
            border: 1px solid #e3e3e3;
            background-color: #f2f2f2;
            border-radius: 100%;
            object-fit: cover;
        }

        .group-gift-selected .name-inline-data-table {
            vertical-align: middle;
            font-weight: 600;
            max-width: 130px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .search-gift-booking-table-wrapper {
            display: flex;
            justify-content: center;
            margin: 8px 0
        }

        .search-gift-booking-table-wrapper input {
            width: 90%;
            padding: 4px 8px;
            border: 1px solid #dedede;
            border-radius: 12px;
        }
    </style>

    <style>
        .tooltip_formula {
            opacity: 0.9;
            position: relative;
        }

        /*.tooltip_formula:hover .tooltip_formula_wrapper{*/
        /*    display: block;*/
        /*}*/
        .tooltip_formula_wrapper {
            cursor: pointer;
            visibility: hidden;
            background: #333;
            position: absolute;
            top: 50%;
            right: 18px;
            transform: translateY(-50%);
            display: flex;
            width: max-content;
            color: white;
            align-items: center;
            padding: 6px;
            border-radius: 4px;
            gap: 10px;
            transition: .25s ease-in;
        }

        .tooltip_formula_wrapper:before {
            content: "";
            position: absolute;
            right: -6px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-top: 6px solid transparent;
            border-bottom: 6px solid transparent;
            border-left: 6px solid #333
        }

        .tooltip_formula:hover .tooltip_formula_wrapper {
            visibility: visible;
        }
    </style>
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <ul class="nav nav-tabs md-tabs md-7-tabs"
                    id="tabs-food-brand-manage" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" data-type="1" href="#tab1-foodbrand-manage" role="tab"
                           aria-expanded="true" data-index="0" data-column="1" data-category-type="1">
                            @lang('app.food-brand-manage.tab1')
                            <span class="label label-success" id="total-record-food">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" data-type="2" href="#tab2-foodbrand-manage" role="tab"
                           aria-expanded="false" data-index="1" data-column="1" data-category-type="2">
                            @lang('app.food-brand-manage.tab2')
                            <span class="label label-warning" id="total-record-drink">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" data-type="3" href="#tab4-foodbrand-manage" role="tab"
                           aria-expanded="false" data-index="3" data-column="1" data-category-type="3">
                            @lang('app.food-brand-manage.tab4')
                            <span class="label label-inverse" id="total-record-other">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" data-type="4" href="#tab5-foodbrand-manage" role="tab"
                           aria-expanded="false" data-index="4" data-column="2" data-category-type="4">
                            @lang('app.food-brand-manage.tab5')
                            <span class="label label-success" id="total-record-combo">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" data-type="5" href="#tab7-foodbrand-manage" role="tab"
                           aria-expanded="false" data-index="5" data-column="2" data-category-type="5">
                            @lang('app.food-brand-manage.tab7')
                            <span class="label label-info" id="total-record-addition">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" data-type="" href="#tab8-foodbrand-manage"
                           onclick="changeTabFoodBrandManage(6)" role="tab" aria-expanded="false" data-index="6"
                           data-column="2">
                            @lang('app.food-brand-manage.tab8')
                            <span class="label label-inverse" id="total-record-disable">0</span>
                        </a>
                    </li>
                </ul>
                <div class="card card-block">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1-foodbrand-manage" role="tabpanel">
                            <div class="table-responsive new-table">
                                @include('manage.food.brand.update.filter.food')
                                <table class="table table-bordered" id="table-food-food-brand-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.food-brand-manage.stt')</th>
                                        <th>@lang('app.food-brand-manage.name')</th>
                                        <th>@lang('app.food-brand-manage.category')</th>
                                        <th>@lang('app.food-brand-manage.price')</th>
                                        <th>% Giá vốn</th>
                                        <th>@lang('app.food-brand-manage.vat')</th>
                                        <th>@lang('app.food-brand-manage.profit')</th>
                                        <th style="word-wrap: break-word !important; width: 12ch !important;">
                                            @lang('app.food-brand-manage.detail.profit-rate-by-original-price')
                                            @include('manage.food.brand.tooltip.profit_rate_by_original_price')
                                        </th>
                                        <th>
                                            @lang('app.food-brand-manage.detail.profit-rate-by-price')
                                            @include('manage.food.brand.tooltip.profit_rate_by_price')
                                        </th>
                                        <th>@lang('app.food-brand-manage.quantity')</th>
                                        <th>@lang('app.food-brand-manage.action')</th>
                                        <th class="d-none"></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2-foodbrand-manage" role="tabpanel">
                            <div class="table-responsive new-table">
                                @include('manage.food.brand.update.filter.drink')
                                <table class="table table-bordered" id="table-drink-food-brand-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.food-brand-manage.stt')</th>
                                        <th>@lang('app.food-brand-manage.name')</th>
                                        <th>@lang('app.food-brand-manage.category')</th>
                                        <th>@lang('app.food-brand-manage.price')</th>
                                        <th>% Giá vốn</th>
                                        <th>@lang('app.food-brand-manage.vat')</th>
                                        <th>@lang('app.food-brand-manage.profit')</th>
                                        <th>
                                            @lang('app.food-brand-manage.detail.profit-rate-by-original-price')
                                            @include('manage.food.brand.tooltip.profit_rate_by_original_price')
                                        </th>
                                        <th>
                                            @lang('app.food-brand-manage.detail.profit-rate-by-price')
                                            @include('manage.food.brand.tooltip.profit_rate_by_price')
                                        </th>
                                        <th>@lang('app.food-brand-manage.quantity')</th>
                                        <th>@lang('app.food-brand-manage.action')</th>
                                        <th class="d-none"></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3-foodbrand-manage" role="tabpanel">
                            <div class="table-responsive new-table">
                                @include('manage.food.brand.update.filter')
                                <table class="table table-bordered"
                                       id="table-sea-food-food-brand-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.food-brand-manage.stt')</th>
                                        <th>@lang('app.food-brand-manage.name')</th>
                                        <th>@lang('app.food-brand-manage.category')</th>
                                        <th>@lang('app.food-brand-manage.price')</th>
                                        <th>% Giá vốn</th>
                                        <th>@lang('app.food-brand-manage.vat')</th>
                                        <th>@lang('app.food-brand-manage.profit')</th>
                                        <th>
                                            @lang('app.food-brand-manage.detail.profit-rate-by-original-price')
                                            @include('manage.food.brand.tooltip.profit_rate_by_original_price')
                                        </th>
                                        <th>
                                            @lang('app.food-brand-manage.detail.profit-rate-by-price')
                                            @include('manage.food.brand.tooltip.profit_rate_by_price')
                                        </th>
                                        <th>@lang('app.food-brand-manage.quantity')</th>
                                        <th>@lang('app.food-brand-manage.action')</th>
                                        <th class="d-none"></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab4-foodbrand-manage" role="tabpanel">
                            <div class="table-responsive new-table">
                                @include('manage.food.brand.update.filter.other')
                                <table class="table table-bordered" id="table-other-food-brand-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.food-brand-manage.stt')</th>
                                        <th>@lang('app.food-brand-manage.name')</th>
                                        <th>@lang('app.food-brand-manage.category')</th>
                                        <th>@lang('app.food-brand-manage.price')</th>
                                        <th>% Giá vốn</th>
                                        <th>@lang('app.food-brand-manage.vat')</th>
                                        <th>@lang('app.food-brand-manage.profit')</th>
                                        <th>
                                            @lang('app.food-brand-manage.detail.profit-rate-by-original-price')
                                            @include('manage.food.brand.tooltip.profit_rate_by_original_price')
                                        </th>
                                        <th>
                                            @lang('app.food-brand-manage.detail.profit-rate-by-price')
                                            @include('manage.food.brand.tooltip.profit_rate_by_price')
                                        </th>
                                        <th>@lang('app.food-brand-manage.quantity')</th>
                                        <th>@lang('app.food-brand-manage.action')</th>
                                        <th class="d-none"></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab5-foodbrand-manage" role="tabpanel">
                            <div class="table-responsive new-table">
                                @include('manage.food.brand.update.filter.food')
                                <table class="table table-bordered" id="table-combo-food-brand-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.food-brand-manage.stt')</th>
                                        <th>@lang('app.food-brand-manage.name')</th>
                                        <th>@lang('app.food-brand-manage.category')</th>
                                        <th>@lang('app.food-brand-manage.price')</th>
                                        <th>% Giá vốn</th>
                                        <th>@lang('app.food-brand-manage.vat')</th>
                                        <th>@lang('app.food-brand-manage.profit')</th>
                                        <th>
                                            @lang('app.food-brand-manage.detail.profit-rate-by-original-price')
                                            @include('manage.food.brand.tooltip.profit_rate_by_original_price')
                                        </th>
                                        <th>
                                            @lang('app.food-brand-manage.detail.profit-rate-by-price')
                                            @include('manage.food.brand.tooltip.profit_rate_by_price')
                                        </th>
                                        <th>@lang('app.food-brand-manage.action')</th>
                                        <th class="d-none"></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab7-foodbrand-manage" role="tabpanel">
                            <div class="table-responsive new-table">
                                @include('manage.food.brand.update.filter.food')
                                <table class="table table-bordered" id="table-addition-food-brand-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.food-brand-manage.stt')</th>
                                        <th>@lang('app.food-brand-manage.name')</th>
                                        <th>@lang('app.food-brand-manage.category')</th>
                                        <th>@lang('app.food-brand-manage.price')</th>
                                        <th>% Giá vốn</th>
                                        <th>@lang('app.food-brand-manage.vat')</th>
                                        <th>@lang('app.food-brand-manage.profit')</th>
                                        <th>
                                            @lang('app.food-brand-manage.detail.profit-rate-by-original-price')
                                            @include('manage.food.brand.tooltip.profit_rate_by_original_price')
                                        </th>
                                        <th>
                                            @lang('app.food-brand-manage.detail.profit-rate-by-price')
                                            @include('manage.food.brand.tooltip.profit_rate_by_price')
                                        </th>
                                        <th>@lang('app.food-brand-manage.quantity')</th>
                                        <th>@lang('app.food-brand-manage.action')</th>
                                        <th class="d-none"></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab8-foodbrand-manage" role="tabpanel">
                            <div class="table-responsive new-table">
                                @include('manage.food.brand.update.filter.food')
                                <table class="table table-bordered" id="table-disable-food-brand-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.food-brand-manage.stt')</th>
                                        <th>@lang('app.food-brand-manage.name')</th>
                                        <th>@lang('app.food-brand-manage.category')</th>
                                        <th>@lang('app.food-brand-manage.price')</th>
                                        <th>% Giá vốn</th>
                                        <th>@lang('app.food-brand-manage.vat')</th>
                                        <th>@lang('app.food-brand-manage.profit')</th>
                                        <th>
                                            @lang('app.food-brand-manage.detail.profit-rate-by-original-price')
                                            @include('manage.food.brand.tooltip.profit_rate_by_original_price')
                                        </th>
                                        <th>
                                            @lang('app.food-brand-manage.detail.profit-rate-by-price')
                                            @include('manage.food.brand.tooltip.profit_rate_by_price')
                                        </th>
                                        <th>@lang('app.food-brand-manage.quantity')</th>
                                        <th>@lang('app.food-brand-manage.action')</th>
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
    @include('manage.food.brand.setup_vat')
    @include('manage.food.brand.create')
    @include('manage.booking_table.update')
    @include('manage.booking_table.detail')
    @include('manage.food.brand.detail')
    @include('manage.food.brand.create_quantity')
    @include('manage.food.brand.update')
    @include('manage.food.brand.update.addtion')
    @include('manage.food.brand.update.combo')
    @include('manage.food.brand.upload_image')
    @include('manage.food.brand.assign_branch')
    @include('manage.food.brand.combo')
    @include('manage.food.brand.import_excel')
    @include('build_data.kitchen.quantitative.detail')
    @include('build_data.kitchen.quantitative.guide')

@endsection
@push('scripts')
    @include('layouts.datatable')
    <script type="text/javascript"
            src="{{asset('/js/template_custom/dataTable.js?version=6',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{asset('/js/manage/food/brand/index.js?version=8',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
