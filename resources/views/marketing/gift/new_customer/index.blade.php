@extends('layouts.layout')
@section('content')
    <style>
        .btn-convert-gift-left-to-right {
            display: flex;
            padding: 4px 2px;
            align-items: center;
            justify-content: center;
            width: 24px;
            border-radius: 100% !important;
        }

        #table-unselected-new-customer-gift p,
        #table-selected-new-customer-gift p {
            font-size: 16px !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/dataTable.css') }}"/>
    <div class="page-body">
        <div class="row d-flex">
            <div class="edit-flex-auto-fill col-sm-6 pr-0">
                <div class="card flex-sub pr-0">
                    <div class="card-block p-b-0">
                        <h5 class="sub-title mb-4 ml-0">@lang('app.new-customer-gift.title-left')</h5>
                    </div>
                    <div class="card-block p-t-0">
                        <div class="table-responsive new-table">
                            <table id="table-unselected-new-customer-gift" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>@lang('app.new-customer-gift.name')</th>
                                    <th>Loại</th>
                                    <th>@lang('app.new-customer-gift.description')</th>
                                    <th>
                                        {{--                                            <i class="fi-rr-arrow-right btn-convert-gift-left-to-right btn seemt-btn-hover-gray seemt-bg-gray-w200"--}}
                                        {{--                                               onclick="checkAllNewCustomerGift($(this))"></i>--}}
                                        <div class="btn-group btn-group-sm">
                                            <button type="button"
                                                    class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                    onclick="checkAllNewCustomerGift($(this))">
                                                <i class="fi-rr-arrow-small-right"></i>
                                            </button>
                                        </div>
                                    </th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="edit-flex-auto-fill col-sm-6">
                <div class="card flex-sub">
                    <div class="card-block p-b-0">
                        <h5 class="sub-title mb-4 ml-0">@lang('app.new-customer-gift.title-right')</h5>
                    </div>
                    <div class="card-block p-t-0">
                        <div class="table-responsive new-table">
                            <table id="table-selected-new-customer-gift" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>
                                        {{--                                            <i class="fi-rr-arrow-left btn-convert-gift-left-to-right btn seemt-btn-hover-gray seemt-bg-gray-w200"--}}
                                        {{--                                               onclick="unCheckAllNewCustomerGift($(this))"></i>--}}
                                        <div class="btn-group btn-group-sm">
                                            <button type="button"
                                                    class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                    onclick="unCheckAllNewCustomerGift($(this))">
                                                <i class="fi-rr-arrow-small-left"></i>
                                            </button>
                                        </div>
                                    </th>
                                    <th>@lang('app.new-customer-gift.name')</th>
                                    <th>Loại</th>
                                    <th>@lang('app.new-customer-gift.description')</th>
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

@endsection
@push('scripts')
    @include('layouts.datatable')
    <script type="text/javascript"
            src="{{ asset('js/template_custom/dataTable.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{ asset('js/marketing/gift/new_customer/index.js?version=2',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
