@extends('layouts.layout')
@section('content')
    <style>
        #chart-price-change-histories-container {
            position: relative;
            overflow: hidden;
            height: 100vh;
        }

        input#search-input-seemt::placeholder {
            color: var(--gray-600-color);
            font-size: 12px;
        }

        .seemt-container .form-validate-input {
            padding: 6px 16px !important;
        }

        .seemt-container .select2-container {
            max-height: 32px !important;
            min-height: 20px !important;
        }

        .seemt-container .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding-bottom: 6px !important;
        }

        /*.seemt-container .select-material-box {*/
        /*    min-height: 40px !important;*/
        /*}*/

        .seemt-container .form-validate-input {
            height: 32px !important;
        }

        .chart-item {
            width: 100%;
            height: 100%;
        }

        .card .card-block .sub-title {
            font-size: 14px !important;
            width: 100%;
        }

        @keyframes scroll {
            0% {
                transform: translateX(0); /* bắt đầu chạy từ vị trí ban đầu */
            }
            100% {
                transform: translateX(-100%); /* chạy đến cuối và quay lại vị trí ban đầu */
            }
        }

        .card-shadow-custom-2 {
            width: 100%;
            white-space: nowrap;
            overflow: hidden;
            box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;
            border-radius: 8px;
        }

        .card .card-block .sub-title:hover {
            /*animation: scroll 10s linear infinite alternate;*/
            cursor: pointer;
        }

        svg {
            margin-right: 5px;
        }

        #body-price-change-histories-report svg path {
            fill: #6E7079;
        }

        #value-material-price-change-histories::placeholder {
            color: var(--gray-600-color);
        }
    </style>
    <head>
        <link rel="stylesheet" type="text/css" href="{{asset('files\assets\pages\timeline\style.css?version=')}}">
    </head>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card" id="body-price-change-histories-report">
                <div class="card-block" style="min-height: calc(100vh - 56px);">
                    <div class="d-flex flex-wrap justify-content-end align-content-between">
                        <div class="form-validate-input mr-auto mb-2 " style="border-radius: 30px">
                            <div class="seemt-search">
                                <div class="seemt-box-search" style="display: flex; align-items: center;">
                                    <i class="fi-rr-search"></i>
                                    <input class="ml-1" placeholder="Tìm kiếm"
                                           id="value-material-price-change-histories"
                                           style="line-height: 12px !important;">
                                </div>
                            </div>
                        </div>
                        <div class="form-validate-select mb-2" style="margin-left: 10px">
                            <div class="pr-0 select-material-box">
                                <select id="inventory-report-price-change-histories"
                                        class="js-example-basic-single b-none">
                                    <option selected value="-1">Tất cả kho</option>
                                    <option value="1">@lang('app.checklist-goods-manage.create.title1')</option>
                                    <option value="2">@lang('app.checklist-goods-manage.create.title2')</option>
                                    <option value="3">@lang('app.checklist-goods-manage.create.title3')</option>
                                    <option value="12">@lang('app.checklist-goods-manage.create.title4')</option>
                                </select>
                                <div class="line"></div>
                            </div>
                        </div>
                        <div class="form-validate-select mb-2" style="margin-left: 10px">
                            <div class="pr-0 select-material-box">
                                <select id="supplier-report-price-change-histories"
                                        class="js-example-basic-single b-none">
                                    <option selected value="-1">Tất cả NCC</option>
                                </select>
                                <div class="line"></div>
                            </div>
                        </div>
                        <div class="form-validate-select mb-2" style="margin-left: 10px">
                            <div class="pr-0 select-material-box">
                                <select id="view-mode-price-change-histories"
                                        class="js-example-basic-single b-none">
                                    <option value="col-lg-4">Thu nhỏ</option>
                                    <option value="col-lg-12">Phóng to</option>
                                </select>
                                <div class="line"></div>
                            </div>
                        </div>
                        <div class="form-validate-select mb-2" style="margin-left: 10px">
                            <div class="select-material-box">
                                <select id="view-max-item-price-change-histories"
                                        class="js-example-basic-single b-none">
                                    <option value="999">Xem tất cả nguyên liệu</option>
                                    <option value="3">3 nguyên liệu</option>
                                    <option value="6">6 nguyên liệu</option>
                                    <option value="9">9 nguyên liệu</option>
                                    <option value="12">12 nguyên liệu</option>
                                    <option value="15">15 nguyên liệu</option>
                                    <option value="18">18 nguyên liệu</option>
                                    <option value="21">21 nguyên liệu</option>

                                </select>
                                <div class="line"></div>
                            </div>
                        </div>
                        @include('report.select-brand-branch')
                    </div>
                    <div class="card-content row" id="list-material-chart-line">
                    </div>
                    <nav aria-label="..." class="pagination-review-dashboard-introduce pt-3">
                        <div class="simple-pagination light-theme"></div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://fastly.jsdelivr.net/npm/echarts@5.4.0/dist/echarts.min.js"></script>
    <script type="text/javascript" src="{{ asset('..\js\report\price_change_histories\index.js?version=3')}}"></script>
@endpush
