@extends('layouts.layout')
@section('content')
    <style>
        .none-hover:hover {
            background: none !important;
            z-index: -1 !important;
        }

        .select-material-box {
            min-width: 195px;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row d-flex">
                <div class="edit-flex-auto-fill col-sm-6 pr-0">
                    <div class="card flex-sub p-0 pt">
                        <div class="card-block" style="padding: 20px 20px 0">
                            <h5 class="sub-title mt-0 mx-0"
                                style="padding-bottom: 12px; margin-bottom: 10px">@lang('app.restaurant-system-supplier-data.title-list')</h5>
                        </div>
                        <div class="card-block" style="padding: 0 20px 8px 20px" id="body-system-supplier-data">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select id="select-type-supplier-restaurant-data"
                                                    class="js-example-basic-single select2-hidden-accessible">
                                                <option value="-1">@lang('app.restaurant-system-supplier-data.supplier')</option>
                                                <option value="0">@lang('app.restaurant-system-supplier-data.title-left')</option>
                                                <option value="1">@lang('app.restaurant-system-supplier-data.supplier-restaurant')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table id="table-system-supplier-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.restaurant-system-supplier-data.supplier_name')</th>
                                        <th>@lang('app.restaurant-system-supplier-data.phone')</th>
                                        <th>
                                            <div class="btn-group btn-group-sm btn-all-left">
                                                <button type="button"
                                                        class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                        onclick="checkAllSystemSupplierData($(this))"><i
                                                            class="fi-rr-arrow-small-right"></i></button>
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
                    <div class="card flex-sub p-0">
                        <div class="card-block" style="padding: 20px 20px 0">
                            <h5 class="sub-title mt-0 mx-0"
                                style="padding-bottom: 12px; margin-bottom: 10px">@lang('app.restaurant-system-supplier-data.title-right')</h5>
                        </div>
                        <div class="card-block" style="padding: 0 20px 8px 20px" id="body-restaurant-supplier-data">
                            <div class="table-responsive new-table">
                                <table id="table-restaurant-supplier-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>
                                            <div class="btn-group btn-group-sm btn-all-right" style="background: #fff">
                                                <button style="background: #fff; cursor: none; z-index: -1 !important;"
                                                        class="tabledit-edit-button btn none-hover seemt-btn-hover-gray waves-effect waves-light"></button>
                                            </div>
                                        </th>
                                        <th>@lang('app.restaurant-system-supplier-data.supplier_name')</th>
                                        <th>@lang('app.restaurant-system-supplier-data.phone')</th>
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
    @include('manage.supplier_order.detail_order')
    @include('manage.supplier_order.detail_restaurant')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\build_data\assign_supplier\restaurant\index.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
