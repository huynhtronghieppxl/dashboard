@extends('layouts.layout')
<link rel="icon" href="{{ asset('images/tms/favicon2.png') }}" type="image/png"/>
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row d-flex">
                <div class="edit-flex-auto-fill col-sm-4 pr-0">
                    <div class="card flex-sub">
                        <div class="p-b-0 row">
                            <div class="col-lg-12">
                                <h5 class="sub-title mx-0 mt-0"
                                    style="padding-bottom: 12px;">@lang('app.brand-material-data.title-left')</h5>
                            </div>
                        </div>
                        <div class="p-t-0 mt-1" id="body-restaurant-supplier-material-data">
                            <div class="table-responsive new-table">
                                <table id="table-restaurant-supplier-material-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.brand-material-data.table-restaurant.name')</th>
                                        <th>@lang('app.brand-material-data.table-restaurant.supplier')</th>
                                        <th class="text-left">
                                            <div class="btn-group btn-group-sm">
                                                <button type="button"
                                                        class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                        id="btn-check-all-System-supplier-data"
                                                        onclick="checkAllSystemSupplierMaterialData($(this))"
                                                        style="margin: -7.9px 0 !important; margin-left: 2px !important;">
                                                    <i class="fi-rr-arrow-small-right" style="top: 0px !important;"></i>
                                                </button>
                                            </div>
                                        </th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="edit-flex-auto-fill col-sm-8">
                    <div class="card flex-sub">
                        <div class="p-b-0 row">
                            <div class="col-lg-12">
                                <h5 class="sub-title mx-0 mt-0" style="padding-bottom: 12px"
                                    ;>@lang('app.brand-material-data.title-right')</h5>
                            </div>
                        </div>
                        <div class="mt-1 p-t-0" id="body-brand-supplier-material-data">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="pr-0 select-material-box">
                                        <select id="select-brand-assign-supplier-material-data" data-select="1"
                                                class="js-example-basic-single select2-hidden-accessible select-brand">

                                            @foreach(Session::get(SESSION_KEY_DATA_BRAND) as $db)
                                                <option value="{{$db['id']}}">{{$db['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <table id="table-brand-supplier-material-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>
                                        </th>
                                        <th>@lang('app.brand-material-data.table-brand.name')</th>
                                        <th>@lang('app.brand-material-data.table-brand.unit')</th>
                                        <th>@lang('app.brand-material-data.table-brand.category')</th>
                                        <th>@lang('app.brand-material-data.table-restaurant.supplier')</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('manage.supplier_order.detail_order')
        @include('manage.supplier_order.detail_restaurant')
    </div>
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\build_data\assign_supplier_material\brand\index.js?version=4', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
