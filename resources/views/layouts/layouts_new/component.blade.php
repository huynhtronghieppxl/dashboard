<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/element.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/head.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/dataTable.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/header.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/menu_left.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/menu_sub.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/modal.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/input.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/validate.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/element.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}


    @include('layouts.head')
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>

    <style>
        .seemt-container .form-validate-checkbox {
            position: relative;
            padding-bottom: 15px;
            margin-right: 32px;
        }

        .seemt-container .checkbox-group .title-checkbox {
            font-style: normal;
            font-weight: 500;
            font-size: 12px !important;
            line-height: 14px;
            display: flex;
            align-items: center;
            letter-spacing: 0.4px;
            color: #7D7E81;
        }

        .seemt-container .checkbox-form-group {
            display: flex;
            align-items: center !important;
        }

        .seemt-container .checkbox-form-group input[type=radio] {
            margin-right: 8px;
            width: 20px;
            height: 20px;
        }

        .seemt-container .checkbox-form-group input:after {
            border: 1px solid #1462B0;
        }

        .seemt-container textarea {
            font-weight: 400;
            font-size: 16px !important;
            line-height: 19px;
            letter-spacing: 0.25px;
        }

        .seemt-container .checkbox-form-group .name-checkbox {
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 19px;
            letter-spacing: 0.25px;
            color: #28282B;
        }

        .seemt-container .revenue .paid-revenue {
            padding: 10px 10px 10px 10px;
            background: #FFFFFF;
            box-shadow: rgba(0, 0, 0, 0.19) 0 10px 20px, rgba(0, 0, 0, 0.23) 0 6px 6px;
            border-radius: 8px;
            box-sizing: border-box;
            justify-content: space-between;
        }

        .seemt-container .revenue .logo-revenue {
            width: 70px;
            height: 70px;
            padding: 13px 18.33px 18.33px 18.33px;
            border-radius: 6px;
        }

        .seemt-container .revenue .paid-revenue .content-revenue {
            padding: 11px 10px 2px 71px;
            overflow: hidden; /* Ẩn phần bị tràn */
        }

        @media screen and (max-width: 1285px) {
            .seemt-container .revenue .paid-revenue .content-revenue {
                padding: 11px 10px 2px 0;
            }
        }

        .seemt-container .revenue .logo-revenue i {
            font-size: 33.33px !important;
        }

        .seemt-container .revenue .paid-revenue .content-revenue .text-revenue label {
            font-size: 14px;
            font-weight: 500;
        }

        .seemt-container .revenue .paid-revenue .content-revenue .total-revenue label {
            font-size: 24px;
            font-weight: 500;
            line-height: 24px;
        }

        .seemt-container .revenue-month {
            padding: 20px 20px 20px 21px;
            background: #FFFFFF;
        }

        .seemt-container .revenue-month .content-revenue-month,
        .seemt-container .revenue-month .content-revenue-month-sub {
            position: relative;
        }

        .seemt-container .revenue-month .content-revenue-month:before,
        .seemt-container .revenue-month .content-revenue-month-sub:before {
            content: "";
            width: 4px;
            height: 100%;
            border-radius: 0 4px 4px 0;
            position: absolute;
            top: 0;
            left: -20px;
        }

        .seemt-container .revenue-month .content-revenue-month-sub p{
            font-weight: 500;
            font-size: 20px !important;
            line-height: 23px;
            letter-spacing: 0.15px;
        }
        .seemt-container .revenue-month .content-revenue-month .month-revenue {
            font-weight: 400;
            font-size: 12px;
            line-height: 14px;
            letter-spacing: 0.25px;
        }

        .seemt-container .revenue-month .content-revenue-month .total-revenue p,
        .seemt-container .revenue-month .content-revenue-month > p {
            font-style: normal;
            font-weight: 500;
            font-size: 24px !important;
            line-height: 28px;
        }

        .seemt-container .bit-icon {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            box-shadow: 0 0 16px rgba(0, 0, 0, 0.04);
            position: relative;
        }

        .seemt-container .bit-icon i {
            font-size: 16px;
            padding: 9.83px 10.75px;
            position: absolute;
        }

        .seemt-container .btn {
            border-radius: 6px;
            padding: 8px 16px 8px 17.33px
        }

        .seemt-container .btn > i {
            font-size: 13.33px;
        }

        .seemt-container .btn > span {
            font-style: normal;
            font-weight: 500;
            font-size: 18px !important;
            line-height: 21px;
            letter-spacing: 0.15px;
        }


        .seemt-container .status-new {
            padding: 4px 10px;
            border-radius: 20px;
        }

        .seemt-container .status-new i {
            margin-right: 4px !important;
            font-size: 13.33px;
        }

        .seemt-container .status-new > label {
            font-weight: 500;
            font-size: 14px !important;
            line-height: 16px;
            letter-spacing: 0.1px;
        }

        .seemt-container .tag {
            padding: 4px 10px;
            border-radius: 4px;
            align-items: center
        }

        .seemt-container .tag i {
            margin-right: 4px !important;
            font-size: 13.33px;
        }

        .seemt-container .tag > label {
            font-weight: 400;
            font-size: 12px;
            line-height: 14px;
            letter-spacing: 0.25px;
        }

        .seemt-container .time-line,
        .seemt-container .status-new i,
        .seemt-container .status-new > label,
        .seemt-container .tag i,
        .seemt-container .tag > label {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bell {
            cursor: pointer;
        }

        .seemt-container .filter-date i {
            font-size: 13.33px !important;
        }

        .seemt-container .filter-date .filter-form-date,
        .seemt-container .filter-date .filter-to-date {
            padding: 8px 12px 8px 13.33px;
            margin-right: 1px;
            height: 37px;
            width: 140px;
        }

        .seemt-container .filter-date input {
            font-weight: 400;
            font-size: 14px !important;
            line-height: 16px;
            letter-spacing: 0.25px;
            width: 85px;
        }

        .seemt-container .filter-month {
            padding: 8px 8px 8px 16px;
            position: relative;
            height: 37px;
            width: 125px;
            border-radius: 8px 0 0 8px;
            margin-right: 1px;
        }

        .seemt-container .filter-month .select-menu .select-btn {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .seemt-container .filter-month .select-menu .select-btn .sBtn-text {
            font-weight: 400;
            font-size: 14px !important;
            line-height: 16px;
            letter-spacing: 0.25px;
        }

        .seemt-container .filter-month .select-menu .select-btn i {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .seemt-container .filter-month .select-menu .options {
            position: absolute;
            padding: 10px 10px;
            top: 45px;
            left: 0;
            width: 100%;
            cursor: pointer;
            background: #ffffff;
            border-radius: 8px 0 0 8px;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
            display: none;
            z-index: 100;
        }

        .seemt-container .filter-month .select-menu.active .options {
            display: block;
        }

        .seemt-container .filter-month .select-menu .options .option {
            display: flex;
            height: 30px;
            padding: 0 12px;
            border-radius: 8px;
            align-items: center;
        }

        .seemt-container .filter-month .select-menu .options .option:hover {
            background: #F2F2F2;
        }

        .seemt-container .filter-month .select-menu .options .option p {
            font-size: 14px !important;
        }


        .seemt-container .icon-form-to {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px;
            margin-right: 1px;
            width: 37px;
            height: 37px;
            line-height: 18px;
        }

        .seemt-container .icon-form-to i {
            font-size: 16px !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .seemt-container .icon-filter-component {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px;
            width: 37px;
            height: 37px;
            border-radius: 0 6px 6px 0;
            cursor: pointer;
        }

        .seemt-container .icon-filter-component i {
            color: var(--blue-color);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .seemt-container .sales-revenue {
            justify-content: space-between;
            padding: 9.5px 20px 9.5px 21.33px;
            box-shadow: rgba(0, 0, 0, 0.19) 0 10px 20px, rgba(0, 0, 0, 0.23) 0 6px 6px;
        }

        .seemt-container .sales-revenue .content-sales-revenue {
            font-weight: 400;
            font-size: 14px !important;
            line-height: 16px;
            letter-spacing: 0.25px;
            margin-right: 31px;
        }

        .seemt-container .sales-revenue .content-sales-revenue i {
            font-size: 12px !important;
        }

        .seemt-container .sales-revenue .total-sales-revenue {
            font-weight: 500;
            font-size: 16px;
            line-height: 19px;
            text-align: right;
            letter-spacing: 0.25px;
        }

        .seemt-container .sub-doloremque .card-sub-doloremque {
            display: flow-root;
            border-radius: 8px;
        }

        .seemt-container .sub-doloremque .card-sub-doloremque .content-sub-doloremque {
            margin: 20px;
        }

        .seemt-container .sub-doloremque .card-sub-doloremque .revenue-month {
            margin: 6px 0 0 0;
        }

        .seemt-container .report-revenue .revenue-month {
            justify-content: space-between;
            border-radius: 8px;
        }

        .select2-container--default .select2-dropdown {
            border: none !important;
            background-color: var(--bg-color);
        }

        .select2-container--default .select2-results__option[aria-disabled=true] {
            background-color: var(--bg-color) !important;
        }

        .select2-container--default .select2-dropdown .select2-search__field {
            background-color: var(--bg-color) !important;

        }

        .select2-container--open ~ .select-material-box {
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        .seemt-container .time-line-container {
            display: inline-block;
            width: auto;
            background: #ddd;
        }

        .seemt-container .time-line-container .time-line {
            position: relative;
            width: 28px;
            height: 28px;
            border: 2px solid #FFFFFF;
            border-radius: 50%;
            padding: 5.89px;
            margin-bottom: 8px;
            cursor: pointer;
            z-index: 2;
        }

        .seemt-container .time-line-container .last-child {
            margin-bottom: 0;
        }

        .seemt-container .time-line-container .time-line i {
            font-size: 13.51px;
        }

        .seemt-container .time-line-container .time-line.active {
            background: var(--bg-orange-color);
        }

        .seemt-container .time-line-container .time-line.active i {
            color: var(--main-color);
        }

        .seemt-container .time-line-container .time-line:after {
            left: 15px;
            margin-left: -2px;
            content: '';
            position: absolute;
            top: 28px;
            height: 100%;
            width: 1px;
            border-left: 1px dashed #ffffff;
            z-index: 1;
        }

        .seemt-container .time-line-container .last-child:after {
            border-left: none;
        }


    </style>
</head>
<body>
<div class="seemt-container">
{{--    @include('layouts.layouts_new.header')--}}
    <div class="seemt-main-container">
        @include('layouts.layouts_new.menu_left')
        @include('layouts.layouts_new.menu_mini')
{{--                @include('layouts.layouts_new.content')--}}
        <div class="seemt-main container-fluid">
            <div class="seemt-main-content">
                <div class="card-block card">
                    <div class="row">
                        <div class="col-lg-6 form-group validate-group">
                            <div class="form-group validate-group">
                                <div class="form-validate-input form-left">
                                    <input id="value-create-payment-bill" class="form-control text-left" type="text"
                                           value="0"
                                           data-money="1" data-min="1" data-max="999999999">
                                    <label for="value-create-payment-bill">
                                        @lang('app.payment-bill.create.value')
                                        <span><i class="fi-rr-asterik"></i></span>
                                    </label>
                                </div>
                                <div class="link-href"></div>
                            </div>
                        </div>
                        <div class="col-lg-6 form-group validate-group">
                            <div class="form-group validate-group">
                                <div class="form-validate-input form-right">
                                    <input id="value-create-payment-bill" class="form-control text-right" type="text"
                                           value="0" data-min="1" data-max="999999999">
                                    <label for="value-create-payment-bill">
                                        @lang('app.payment-bill.create.value')
                                        <span><i class="fi-rr-asterik"></i></span>
                                    </label>
                                </div>
                                <div class="link-href"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-12 select2_theme validate-group">
                        <div class="form-validate-select">
                            <div class="col-lg-12 select-material-box">
                                <select id="select-type-create-payment-bill" data-select="1"
                                        class="js-example-basic-single select2-hidden-accessible">
                                    <option value="-2" disabled selected
                                            hidden>@lang('app.component.option_default')</option>
                                </select>
                                <label class="icon-validate">
                                    @lang('app.payment-bill.create.type')
                                    <span><i class="fi-rr-asterik"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class=" col-lg-6 form-group validate-group">
                        <div class="form-validate-checkbox">
                            <div class="checkbox-form-group">
                                <input id="accounting-create-payment-bill"
                                       name="print-kitchen-create-food-brand-manage" type="checkbox">
                                <label class="name-checkbox"
                                       for="print-kitchen-create-food-brand-manage">@lang('app.payment-bill.create.accounting')
                                    <div class="tool-tip">
                                        <i class="fa fa-exclamation-circle text-inverse pointer"
                                           data-toggle="tooltip" data-placement="top"
                                           data-original-title="@lang('app.payment-bill.accounting-title')"></i>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 form-group validate-group checkbox-group">
                        <label class="title-checkbox">Có hoạch toán</label>
                        <div class="row">
                            <div class="form-validate-checkbox">
                                <div class="checkbox-form-group">
                                    <input id="accounting-create-payment-bill"
                                           name="print-kitchen-create-food-brand-manage" type="checkbox">
                                    <label class="name-checkbox"
                                           for="print-kitchen-create-food-brand-manage">@lang('app.payment-bill.create.accounting')
                                        <div class="tool-tip">
                                            <i class="fa fa-exclamation-circle text-inverse pointer"
                                               data-toggle="tooltip" data-placement="top"
                                               data-original-title="@lang('app.payment-bill.accounting-title')"></i>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="form-validate-checkbox">
                                <div class="checkbox-form-group">
                                    <input id="accounting-create-payment-bill"
                                           name="print-kitchen-create-food-brand-manage" type="checkbox">
                                    <label class="name-checkbox"
                                           for="print-kitchen-create-food-brand-manage">@lang('app.payment-bill.create.accounting')
                                        <div class="tool-tip">
                                            <i class="fa fa-exclamation-circle text-inverse pointer"
                                               data-toggle="tooltip" data-placement="top"
                                               data-original-title="@lang('app.payment-bill.accounting-title')"></i>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="btn seemt-red seemt-bg-red seemt-btn-hover-red mr-2 mb-2" onclick="function onSubmit() {if (checkValidateSave($('.seemt-main-content')) === 1) return false;}
                            onSubmit()">
                                <i class="fi-rr-bug"></i>
                                <span>Check validate</span>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 form-group checkbox-group">
                        <label class="title-checkbox">Có hoạch toán</label>
                        <div class="row">
                            <div class="form-validate-checkbox">
                                <div class="checkbox-form-group">
                                    <input id="accounting-create-payment-bill"
                                           name="print-kitchen-create-food-brand-manage" type="radio">
                                    <label class="name-checkbox"
                                           for="print-kitchen-create-food-brand-manage">@lang('app.payment-bill.create.accounting')
                                        <div class="tool-tip">
                                            <i class="fa fa-exclamation-circle text-inverse pointer"
                                               data-toggle="tooltip" data-placement="top"
                                               data-original-title="@lang('app.payment-bill.accounting-title')"></i>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="form-validate-checkbox">
                                <div class="checkbox-form-group">
                                    <input id="accounting-create-payment-bill"
                                           name="print-kitchen-create-food-brand-manage" type="radio">
                                    <label class="name-checkbox"
                                           for="print-kitchen-create-food-brand-manage">@lang('app.payment-bill.create.accounting')
                                        <div class="tool-tip">
                                            <i class="fa fa-exclamation-circle text-inverse pointer"
                                               data-toggle="tooltip" data-placement="top"
                                               data-original-title="@lang('app.payment-bill.accounting-title')"></i>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 form-group validate-group">
                        <div class="form-validate-textarea">
                            <div class="form__group pt-2">
                                <textarea id="description-update-food-brand-manage"
                                          class="form__field"
                                          rows="3" cols="1"
                                          maxlength="300"
                                          data-note-max-length="1000"></textarea>
                                <label for="description-update-food-brand-manage"
                                       class="form__label icon-validate">
                                    @lang('app.food-brand-manage.update.description')
                                </label>
                                <div class="textarea-character" id="char-count">
                                    <span>0/300</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 form-group validate-group revenue">
                        <div class="paid-revenue d-flex">
                            <div class="logo-revenue seemt-bg-green">
                                <i class="fi-rr-stats seemt-green"></i>
                            </div>
                            <div class="content-revenue seemt-green d-flex flex-wrap">
                                <div class="text-revenue col-11 p-0 text-right">
                                    <label class="m-0 mr-1">DOANH THU ĐÃ THANH TOÁN</label>
                                </div>
                                <div class="col-1 p-0 text-center">
                                    <i class="fi-rr-exclamation"></i>
                                </div>
                                <div class="total-revenue col-12 text-right">
                                    <label class="m-0 float-right font-weight-bold">99,000,000</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 form-group validate-group revenue">
                        <div class="paid-revenue d-flex">
                            <div class="logo-revenue seemt-bg-blue">
                                <i class="fi-rr-stats seemt-blue"></i>
                            </div>
                            <div class="content-revenue seemt-blue d-flex flex-wrap">
                                <div class="text-revenue col-11 p-0 text-right">
                                    <label class="m-0 mr-1">DOANH THU ĐÃ THANH TOÁN</label>
                                </div>
                                <div class="col-1 p-0 text-center">
                                    <i class="fi-rr-exclamation"></i>
                                </div>
                                <div class="total-revenue col-12 text-right">
                                    <label class="m-0 float-right font-weight-bold">99,000,000</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 form-group validate-group revenue ">
                        <div class="paid-revenue d-flex">
                            <div class="logo-revenue seemt-bg-orange">
                                <i class="fi-rr-stats seemt-orange"></i>
                            </div>
                            <div class="content-revenue seemt-orange d-flex flex-wrap">
                                <div class="text-revenue col-11 p-0 text-right">
                                    <label class="m-0 mr-1">DOANH THU ĐÃ THANH TOÁN</label>
                                </div>
                                <div class="col-1 p-0 text-center">
                                    <i class="fi-rr-exclamation"></i>
                                </div>
                                <div class="total-revenue col-12 text-right">
                                    <label class="m-0 float-right font-weight-bold">99,000,000</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 form-group validate-group revenue ">
                        <div class="paid-revenue d-flex">
                            <div class="logo-revenue seemt-bg-red">
                                <i class="fi-rr-stats seemt-red"></i>
                            </div>
                            <div class="content-revenue seemt-red d-flex flex-wrap">
                                <div class="text-revenue col-11 p-0 text-right">
                                    <label class="m-0 mr-1">DOANH THU ĐÃ THANH TOÁN</label>
                                </div>
                                <div class="col-1 p-0 text-center">
                                    <i class="fi-rr-exclamation"></i>
                                </div>
                                <div class="total-revenue col-12 text-right">
                                    <label class="m-0 float-right font-weight-bold">99,000,000</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 form-group validate-group revenue">
                        <div class="paid-revenue d-flex">
                            <div class="logo-revenue seemt-bg-gray">
                                <i class="fi-rr-stats seemt-gray-w700"></i>
                            </div>
                            <div class="content-revenue seemt-gray-w700 d-flex flex-wrap">
                                <div class="text-revenue col-11 p-0 text-right">
                                    <label class="m-0 mr-1">DOANH THU ĐÃ THANH TOÁN</label>
                                </div>
                                <div class="col-1 p-0 text-center">
                                    <i class="fi-rr-exclamation"></i>
                                </div>
                                <div class="total-revenue col-12 text-right">
                                    <label class="m-0 float-right font-weight-bold">99,000,000</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 form-group validate-group">
                        <div class="revenue-month seemt-blue seemt-box-shadow">
                            <div class="content-revenue-month seemt-before-blue">
                                <p>DOLOREMQUE</p>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 form-group validate-group">
                        <div class="revenue-month seemt-green seemt-box-shadow">
                            <div class="content-revenue-month-sub seemt-before-green">
                                <p>SUB DOLOREMQUE</p>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 form-group validate-group">
                        <div class="revenue-month seemt-blue seemt-box-shadow">
                            <div class="content-revenue-month seemt-before-blue">
                                <div class="month-revenue">
                                    <p>THÁNG NÀY | 10/2022</p>
                                </div>
                                <div class="total-revenue">
                                    <p>78,000,000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 form-group validate-group">
                        <div class="revenue-month seemt-green seemt-box-shadow">
                            <div class="content-revenue-month seemt-before-green">
                                <div class="month-revenue">
                                    <p>THÁNG NÀY | 10/2022</p>
                                </div>
                                <div class="total-revenue">
                                    <p>78,000,000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 form-group validate-group">
                        <div class="row">
                            <div class="bell mr-2">
                                <div class="bit-icon seemt-gray-w600 seemt-bg-gray seemt-btn-hover-gray">
                                    <i class="fi-rr-bell"></i>
                                </div>
                            </div>
                            <div class="bell mr-2">
                                <div class="bit-icon seemt-green seemt-bg-green seemt-btn-hover-green">
                                    <i class="fi-rr-bell"></i>
                                </div>
                            </div>
                            <div class="bell mr-2">
                                <div class="bit-icon seemt-blue seemt-bg-blue seemt-btn-hover-blue">
                                    <i class="fi-rr-bell"></i>
                                </div>
                            </div>
                            <div class="bell mr-2">
                                <div class="bit-icon seemt-orange seemt-bg-orange seemt-btn-hover-orange">
                                    <i class="fi-rr-bell"></i>
                                </div>
                            </div>
                            <div class="bell mr-2">
                                <div class="bit-icon seemt-red seemt-bg-red seemt-btn-hover-red">
                                    <i class="fi-rr-bell"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-12 form-group validate-group">
                        <div class="row">
                            <div class="btn seemt-btn-hover-gray mr-2 mb-2">
                                <i class="fi-rr-bug"></i>
                                <span>BUTTON</span>
                            </div>
                            <div class="btn seemt-green seemt-bg-green seemt-btn-hover-green mr-2 mb-2">
                                <i class="fi-rr-bug"></i>
                                <span>BUTTON</span>
                            </div>
                            <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue mr-2 mb-2">
                                <i class="fi-rr-bug"></i>
                                <span>BUTTON</span>
                            </div>
                            <div class="btn seemt-orange seemt-bg-orange seemt-btn-hover-orange mr-2 mb-2">
                                <i class="fi-rr-bug"></i>
                                <span>BUTTON</span>
                            </div>
                            <div class="btn seemt-red seemt-bg-red seemt-btn-hover-red mr-2 mb-2">
                                <i class="fi-rr-bug"></i>
                                <span>BUTTON</span>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-12 form-group validate-group">
                        <div class="row">
                            <div class="status-new seemt-green seemt-border-green d-flex mr-2">
                                <i class="fi-rr-time-quarter-to"></i>
                                <label class="m-0">STATUS</label>
                            </div>
                            <div class="status-new seemt-blue seemt-border-blue d-flex mr-2">
                                <i class="fi-rr-time-quarter-to"></i>
                                <label class="m-0">STATUS</label>
                            </div>
                            <div class="status-new seemt-orange seemt-border-orange d-flex mr-2">
                                <i class="fi-rr-time-quarter-to"></i>
                                <label class="m-0">STATUS</label>
                            </div>
                            <div class="status-new seemt-red seemt-border-red d-flex mr-2">
                                <i class="fi-rr-time-quarter-to"></i>
                                <label class="m-0">STATUS</label>
                            </div>
                            <div class="status-new seemt-gray-w400 seemt-border-gray d-flex mr-2">
                                <i class="fi-rr-time-quarter-to"></i>
                                <label class="m-0">STATUS</label>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-12 form-group validate-group">
                        <div class="row">
                            <div class="tag seemt-green seemt-border-green d-flex mr-2">
                                <i class="fi-rr-hastag"></i>
                                <label class="m-0">Tag ...tag</label>
                            </div>
                            <div class="tag seemt-blue seemt-border-blue d-flex mr-2">
                                <i class="fi-rr-hastag"></i>
                                <label class="m-0">Tag ...tag</label>
                            </div>
                            <div class="tag seemt-orange seemt-border-orange d-flex mr-2">
                                <i class="fi-rr-hastag"></i>
                                <label class="m-0">Tag ...tag</label>
                            </div>
                            <div class="tag seemt-red seemt-border-red d-flex mr-2">
                                <i class="fi-rr-hastag"></i>
                                <label class="m-0">Tag ...tag</label>
                            </div>
                            <div class="tag seemt-gray-w400 seemt-border-gray d-flex mr-2">
                                <i class="fi-rr-hastag"></i>
                                <label class="m-0">Tag ...tag</label>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-12 form-group validate-group">
                        <div class="row">
                            <div class="filter-date d-flex align-items-center">
                                <div class="filter-month seemt-bg-gray-w200">
                                    <div class="select-menu">
                                        <div class="select-btn">
                                            <span class="sBtn-text seemt-gray-w600">Lọc tháng</span>
                                            <i class="fi-rr-angle-small-down select-arrow seemt-gray-w600"></i>
                                        </div>

                                        <ul class="options">
                                            <li class="option seemt-gray-w600">
                                                <p>Tháng 1</p>
                                            </li>
                                            <li class="option seemt-gray-w600">
                                                <p>Tháng 2</p>
                                            </li>
                                            <li class="option seemt-gray-w600">
                                                <p>Tháng 3</p>
                                            </li>
                                            <li class="option seemt-gray-w600">
                                                <p>Tháng 4</p>
                                            </li>
                                            <li class="option seemt-gray-w600">
                                                <p>Tháng 5</p>
                                            </li>
                                            <li class="option seemt-gray-w600">
                                                <p>Tháng 6</p>
                                            </li>
                                            <li class="option seemt-gray-w600">
                                                <p>Tháng 7</p>
                                            </li>
                                            <li class="option seemt-gray-w600">
                                                <p>Tháng 8</p>
                                            </li>
                                            <li class="option seemt-gray-w600">
                                                <p>Tháng 9</p>
                                            </li>
                                            <li class="option seemt-gray-w600">
                                                <p>Tháng 10</p>
                                            </li>
                                            <li class="option seemt-gray-w600">
                                                <p>Tháng 11</p>
                                            </li>
                                            <li class="option seemt-gray-w600">
                                                <p>Tháng 12</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="filter-form-date seemt-bg-gray-w200">
                                    <i class="fi-rr-calendar seemt-gray-w600 pr-2"></i>
                                    <input class="seemt-gray-w600 seemt-bg-gray-w200 seemt-border-none" type="text"
                                           id="form-date">
                                </div>
                                <div class="icon-form-to seemt-bg-gray-w200">
                                    <i class="fi-rr-angle-double-small-right seemt-gray-w600 seemt-border-none"></i>
                                </div>
                                <div class="filter-to-date seemt-bg-gray-w200">
                                    <i class="fi-rr-calendar seemt-gray-w600 pr-2"></i>
                                    <input class="seemt-gray-w600 seemt-bg-gray-w200 seemt-border-none" type="text"
                                           id="to-date">
                                </div>
                                <div class="icon-filter-component seemt-bg-blue">
                                    <i class="fi-rr-filter seemt-gray-w600  seemt-blue"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 form-group validate-group">
                        <div class="sales-revenue d-flex">
                            <div class="content-sales-revenue seemt-gray-w600">
                                <i class="fi-rr-chart-pie-alt"></i>
                                Doanh thu bán hàng
                            </div>
                            <div class="total-sales-revenue seemt-blue">
                                <p>5,500,000</p>
                            </div>
                        </div>
                    </div>
                    <div class=" col-12 form-group validate-group">
                        <div class="sub-doloremque row d-flex">
                            <div class="col-3">
                                <div class="card-sub-doloremque col-12 p-0 seemt-box-shadow">
                                    <div class="revenue-month seemt-green seemt-border-bottom">
                                        <div class="content-revenue-month-sub seemt-before-green">
                                            <p>DOLOREMQUE</p>
                                        </div>
                                    </div>
                                    <div class="content-sub-doloremque seemt-bg-green">
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card-sub-doloremque col-12 p-0 seemt-box-shadow">
                                    <div class="revenue-month seemt-green seemt-border-bottom">
                                        <div class="content-revenue-month-sub seemt-before-green">
                                            <p>DOLOREMQUE</p>
                                        </div>
                                    </div>
                                    <div class="content-sub-doloremque seemt-bg-green">
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card-sub-doloremque col-12 p-0 seemt-box-shadow">
                                    <div class="revenue-month seemt-green seemt-border-bottom">
                                        <div class="content-revenue-month-sub seemt-before-green">
                                            <p>DOLOREMQUE</p>
                                        </div>
                                    </div>
                                    <div class="content-sub-doloremque seemt-bg-green">
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card-sub-doloremque col-12 p-0 seemt-box-shadow">
                                    <div class="revenue-month seemt-green seemt-border-bottom">
                                        <div class="content-revenue-month-sub seemt-before-green">
                                            <p>DOLOREMQUE</p>
                                        </div>
                                    </div>
                                    <div class="content-sub-doloremque seemt-bg-green">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-12 form-group validate-group">
                        <div class="sub-doloremque row d-flex">
                            <div class="col-4">
                                <div class="card-sub-doloremque col-12 p-0 seemt-box-shadow">
                                    <div class="revenue-month seemt-green seemt-border-bottom">
                                        <div class="content-revenue-month-sub seemt-before-green">
                                            <p>DOLOREMQUE</p>
                                        </div>
                                    </div>
                                    <div class="content-sub-doloremque seemt-bg-green">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card-sub-doloremque col-12 p-0 seemt-box-shadow">
                                    <div class="revenue-month seemt-green seemt-border-bottom">
                                        <div class="content-revenue-month-sub seemt-before-green">
                                            <p>DOLOREMQUE</p>
                                        </div>
                                    </div>
                                    <div class="content-sub-doloremque seemt-bg-green">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card-sub-doloremque col-12 p-0 seemt-box-shadow">
                                    <div class="revenue-month seemt-green seemt-border-bottom">
                                        <div class="content-revenue-month-sub seemt-before-green">
                                            <p>DOLOREMQUE</p>
                                        </div>
                                    </div>
                                    <div class="content-sub-doloremque seemt-bg-green">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 form-group validate-group">
                        <div class="sub-doloremque row d-flex">
                            <div class="col-6">
                                <div class="card-sub-doloremque col-12 p-0 seemt-box-shadow">
                                    <div class="revenue-month seemt-green seemt-border-bottom">
                                        <div class="content-revenue-month-sub seemt-before-green">
                                            <p>DOLOREMQUE</p>
                                        </div>
                                    </div>
                                    <div class="content-sub-doloremque seemt-bg-green">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card-sub-doloremque col-12 p-0 seemt-box-shadow">
                                    <div class="revenue-month seemt-green seemt-border-bottom">
                                        <div class="content-revenue-month-sub seemt-before-green">
                                            <p>DOLOREMQUE</p>
                                        </div>
                                    </div>
                                    <div class="content-sub-doloremque seemt-bg-green">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-12 form-group validate-group">
                        <div class="sub-doloremque row d-flex">
                            <div class="col-9">
                                <div class="card-sub-doloremque col-12 p-0 seemt-box-shadow">
                                    <div class="revenue-month seemt-green seemt-border-bottom">
                                        <div class="content-revenue-month-sub seemt-before-green">
                                            <p>DOLOREMQUE</p>
                                        </div>
                                    </div>
                                    <div class="content-sub-doloremque seemt-bg-green">
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card-sub-doloremque col-12 p-0 seemt-box-shadow">
                                    <div class="revenue-month seemt-green seemt-border-bottom">
                                        <div class="content-revenue-month-sub seemt-before-green">
                                            <p>DOLOREMQUE</p>
                                        </div>
                                    </div>
                                    <div class="content-sub-doloremque seemt-bg-green">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-12 form-group validate-group">
                        <div class="sub-doloremque row d-flex">
                            <div class="col-12">
                                <div class="card-sub-doloremque col-12 p-0 seemt-box-shadow">
                                    <div class="revenue-month seemt-green seemt-border-bottom">
                                        <div class="content-revenue-month-sub seemt-before-green">
                                            <p>DOLOREMQUE</p>
                                        </div>
                                    </div>
                                    <div class="content-sub-doloremque seemt-bg-green">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-12">
                        <div class="report-revenue col-12 p-0">
                            <div
                                class="revenue-month seemt-blue seemt-border-bottom seemt-bg-white seemt-box-shadow mb-4 d-flex">
                                <div class="content-revenue-month seemt-before-blue">
                                    <p>BÁO CÁO DOANH THU, CHI PHÍ, LỢI NHUẬN 04/2023</p>
                                </div>
                                <div class="d-flex">
                                    <div class="row">
                                        <div class="filter-date d-flex align-items-center mb-2">
                                            <div class="filter-month seemt-bg-gray-w200">
                                                <div class="select-menu">
                                                    <div class="select-btn">
                                                        <span class="sBtn-text seemt-gray-w600">Lọc tháng</span>
                                                        <i class="fi-rr-angle-small-down select-arrow seemt-gray-w600"></i>
                                                    </div>

                                                    <ul class="options">
                                                        <li class="option seemt-gray-w600">
                                                            <p>Tháng 1</p>
                                                        </li>
                                                        <li class="option seemt-gray-w600">
                                                            <p>Tháng 2</p>
                                                        </li>
                                                        <li class="option seemt-gray-w600">
                                                            <p>Tháng 3</p>
                                                        </li>
                                                        <li class="option seemt-gray-w600">
                                                            <p>Tháng 4</p>
                                                        </li>
                                                        <li class="option seemt-gray-w600">
                                                            <p>Tháng 5</p>
                                                        </li>
                                                        <li class="option seemt-gray-w600">
                                                            <p>Tháng 6</p>
                                                        </li>
                                                        <li class="option seemt-gray-w600">
                                                            <p>Tháng 7</p>
                                                        </li>
                                                        <li class="option seemt-gray-w600">
                                                            <p>Tháng 8</p>
                                                        </li>
                                                        <li class="option seemt-gray-w600">
                                                            <p>Tháng 9</p>
                                                        </li>
                                                        <li class="option seemt-gray-w600">
                                                            <p>Tháng 10</p>
                                                        </li>
                                                        <li class="option seemt-gray-w600">
                                                            <p>Tháng 11</p>
                                                        </li>
                                                        <li class="option seemt-gray-w600">
                                                            <p>Tháng 12</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="filter-form-date seemt-bg-gray-w200">
                                                <i class="fi-rr-calendar seemt-gray-w600 pr-2"></i>
                                                <input class="seemt-gray-w600 seemt-bg-gray-w200 seemt-border-none"
                                                       type="text" id="form-date">
                                            </div>
                                            <div class="icon-form-to seemt-bg-gray-w200">
                                                <i class="fi-rr-angle-double-small-right seemt-gray-w600 seemt-border-none"></i>
                                            </div>
                                            <div class="filter-to-date seemt-bg-gray-w200">
                                                <i class="fi-rr-calendar seemt-gray-w600 pr-2"></i>
                                                <input class="seemt-gray-w600 seemt-bg-gray-w200 seemt-border-none"
                                                       type="text" id="to-date">
                                            </div>
                                            <div class="icon-filter-component seemt-bg-blue">
                                                <i class="fi-rr-filter seemt-gray-w600  seemt-blue"></i>
                                            </div>
                                        </div>
                                        <div class="bell ml-4">
                                            <div class="bit-icon seemt-green seemt-bg-green seemt-btn-hover-green">
                                                <i class="fi-rr-refresh"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sub-doloremque col-12 row d-flex">
                                <div class="card-sub-doloremque col-12 p-0 seemt-box-shadow">
                                    <div class="revenue-month seemt-green seemt-border-bottom">
                                        <div class="content-revenue-month-sub seemt-before-green">
                                            <p>DỮ LIỆU ƯỚC TÍNH</p>
                                        </div>
                                    </div>
                                    <div class="d-flex col-12">
                                        <div class="content-sub-doloremque col-xl-8 col-lg-7 p-0 seemt-bg-gray">
                                        </div>
                                        <div class="col-xl-4 col-lg-5 pt-4 pr-5 pl-0">
                                            <div class=" col-12 pb-4 p-0 revenue">
                                                <div class="paid-revenue d-flex">
                                                    <div class="logo-revenue seemt-bg-green mt-1">
                                                        <i class="fi-rr-stats seemt-green"></i>
                                                    </div>
                                                    <div class="content-revenue seemt-green d-flex flex-wrap">
                                                        <div class="text-revenue col-11 p-0 text-right">
                                                            <label class="m-0 mr-1">DOANH THU ĐÃ THANH TOÁN</label>
                                                        </div>
                                                        <div class="col-1 p-0 text-center">
                                                            <i class="fi-rr-exclamation"></i>
                                                        </div>
                                                        <div class="total-revenue col-12 text-right">
                                                            <label
                                                                class="m-0 float-right font-weight-bold">99,000,000</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-12 pb-4 p-0 revenue">
                                                <div class="paid-revenue d-flex">
                                                    <div class="logo-revenue seemt-bg-red mt-1">
                                                        <i class="fi-rr-chat-arrow-down seemt-red"></i>
                                                    </div>
                                                    <div class="content-revenue seemt-red d-flex flex-wrap">
                                                        <div class="text-revenue col-11 p-0 text-right">
                                                            <label class="m-0 mr-1">CHI PHÍ ƯỚC TÍNH</label>
                                                        </div>
                                                        <div class="col-1 p-0 text-center">
                                                            <i class="fi-rr-exclamation"></i>
                                                        </div>
                                                        <div class="total-revenue col-12 text-right">
                                                            <label
                                                                class="m-0 float-right font-weight-bold">99,000,000</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-12 pb-4 p-0 revenue">
                                                <div class="paid-revenue d-flex">
                                                    <div class="logo-revenue seemt-bg-orange mt-1">
                                                        <i class="fi-rr-chat-arrow-grow seemt-orange"></i>
                                                    </div>
                                                    <div class="content-revenue seemt-orange d-flex flex-wrap">
                                                        <div class="text-revenue col-11 p-0 text-right">
                                                            <label class="m-0 mr-1">LỢI NHUẬN BÁN HÀNG ƯỚC TÍNH</label>
                                                        </div>
                                                        <div class="col-1 p-0 text-center">
                                                            <i class="fi-rr-exclamation"></i>
                                                        </div>
                                                        <div class="total-revenue col-12 text-right">
                                                            <label
                                                                class="m-0 float-right font-weight-bold">99,000,000</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-12 pb-4 p-0 revenue">
                                                <div class="paid-revenue d-flex">
                                                    <div class="logo-revenue seemt-bg-orange mt-1">
                                                        <i class="fi-rr-chart-pie-alt seemt-orange"></i>
                                                    </div>
                                                    <div class="content-revenue seemt-orange d-flex flex-wrap">
                                                        <div class="text-revenue col-11 p-0 text-right">
                                                            <label class="m-0 mr-1">TỶ SUẤT LỢI NHUẬN BÁN BÀNG ƯỚC
                                                                TÍNH</label>
                                                        </div>
                                                        <div class="col-1 p-0 text-center">
                                                            <i class="fi-rr-exclamation"></i>
                                                        </div>
                                                        <div class="total-revenue col-12 text-right">
                                                            <label
                                                                class="m-0 float-right font-weight-bold">-40%</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-1 mt-4">
                        <div class="time-line-container">
                            <div class="time-line seemt-bg-gray-w200 d-flex">
                                <i class="fi-rr-chart-pie-alt seemt-gray-w400"></i>
                            </div>
                            <div class="time-line seemt-bg-gray-w200 d-flex">
                                <i class="fi-rr-chart-pie-alt seemt-gray-w400"></i>
                            </div>
                            <div class="time-line seemt-bg-gray-w200 d-flex">
                                <i class="fi-rr-chart-pie-alt seemt-gray-w400"></i>
                            </div>
                            <div class="time-line seemt-bg-gray-w200 d-flex">
                                <i class="fi-rr-chart-pie-alt seemt-gray-w400"></i>
                            </div>
                            <div class="time-line seemt-bg-gray-w200 d-flex">
                                <i class="fi-rr-chart-pie-alt seemt-gray-w400"></i>
                            </div>
                            <div class="time-line seemt-bg-gray-w200 d-flex">
                                <i class="fi-rr-chart-pie-alt seemt-gray-w400"></i>
                            </div>
                            <div class="time-line seemt-bg-gray-w200 d-flex">
                                <i class="fi-rr-chart-pie-alt seemt-gray-w400"></i>
                            </div>
                            <div class="time-line seemt-bg-gray-w200 d-flex">
                                <i class="fi-rr-chart-pie-alt seemt-gray-w400"></i>
                            </div>
                            <div class="time-line seemt-bg-gray-w200 d-flex">
                                <i class="fi-rr-chart-pie-alt seemt-gray-w400"></i>
                            </div>
                            <div class="time-line seemt-bg-gray-w200 d-flex">
                                <i class="fi-rr-chart-pie-alt seemt-gray-w400"></i>
                            </div>
                            <div class="time-line seemt-bg-gray-w200 d-flex">
                                <i class="fi-rr-chart-pie-alt seemt-gray-w400"></i>
                            </div>
                            <div class="time-line last-child seemt-bg-gray-w200 d-flex">
                                <i class="fi-rr-chart-pie-alt seemt-gray-w400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@include('layouts.script')
@stack('scripts')
<script>
    $(function () {
        // click ở ngoài mà vẫn focus vào ô input
        $('.form-left').on('click', () => {
            $('.text-left').focus();
        });
        $('.form-right').on('click', () => {
            $('.text-right').focus();
        });

        // Sự kiện Select
        $('.select-btn').click(function () {
            $('.select-menu').toggleClass('active')
        })

        $('.option').each(function () {
            $(this).click(function () {
                let selectedOption = $(this).find('p').text()
                $('.sBtn-text').text(selectedOption)
            })
        })

        //hiệu ứng click thanh time line
        $('.time-line').on('click', function () {
            $('.time-line.active').removeClass('active')
            $(this).addClass('active')
        })

        // $('#search-input-seemt').on('focus click', function () {
        //     $(this).parents('.seemt-search').addClass('active');
        // })
        //
        // $('#search-input-seemt').on('focusout', function () {
        //     $(this).parents('.seemt-search').removeClass('active');
        // })

        $('.seemt-box-profile').on('click', function () {
            $(this).find('.seemt-item-profile').toggle();
        })

        $(document).on('click', '.seemt-btn', function () {
            $('#seemt-menu-left').toggle();
            $('#seemt-menu-left-mini').toggle();

            if ($('#seemt-menu-left').is(":visible")) {
                $('.seemt-container .seemt-main').attr('style', 'margin-left: 218px;')
            } else {
                $('.seemt-container .seemt-main').attr('style', 'margin-left: 64px;')
            }
        })


        // xử lý sub
        $('.seemt-restaurant-system').on('click', function () {
            if ($(this).parent().find('.box-restaurant-system').hasClass('active')) {
                $(this).parent().find('.box-restaurant-system').removeClass('active');
            } else {
                $(this).parent().find('.box-restaurant-system').addClass('active');
            }
        })

        $('#search-input-seemt').on('input', function () {
            searchInput($('#search-input-seemt').val().toLowerCase(), $('.seemt-search-item .search-item'))
        })

        $('#search-branch').on('input', function () {
            searchInput($('#search-branch').val().toLowerCase(), $('.list-branch-header .seemt-branch-item'))
        })

        $('#description-update-food-brand-manage').on('input', function () {
            let charCount = $(this).val().length;
            let result = charCount === 0 ? '<span>0/300</span>' : `<span>${charCount}/300</span>`;
            $('#char-count').html(`${result}`)
        })


        dateFullTimePickerTemplate($('form-date'))
        dateFullTimePickerTemplate($('to-date'))
    })

    function searchInput(keySearch, valueSearch) {
        valueSearch.each(function () {
            let textRemoveVietnamese = removeVietnameseString($(this).find('a, label').text().toLowerCase())
            let text = $(this).find('a, label').text().toLowerCase()
            if (textRemoveVietnamese.includes(keySearch) || text.includes(keySearch)) {
                $(this).show()
            } else {
                $(this).hide()
            }
        })
    }
</script>
</html>
