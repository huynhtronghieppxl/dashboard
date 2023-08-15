@extends('layouts.layout')
<link rel="icon" href="{{ asset('images/tms/favicon2.png') }}" type="image/png"/>
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row d-flex">
                <div class="col-sm-4 edit-flex-auto-fill pr-0">
                    <div class="card flex-sub">
                        <div class="card-block p-0" id="body-supplier-material-data">
                            <h5 class="sub-title mt-0"
                                style="margin-bottom: 10px; padding-bottom: 12px">@lang('app.restaurant-material-data.title-left')</h5>
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select id="select-restaurant-supplier-material-data"
                                                    class="js-example-basic-single select2-hidden-accessible">
                                                <option disabled selected
                                                        hidden>@lang('app.component.option_default')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table id="table-supplier-material-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.restaurant-material-data.table-system.title1')</th>
                                        <th>@lang('app.restaurant-material-data.table-system.title2')</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 edit-flex-auto-fill">
                    <div class="card flex-sub">
                        <div class="card-block p-0" id="body-restaurant-supplier-material-data">
                            <h5 class="sub-title mt-0"
                                style="margin-bottom: 10px; padding-bottom: 12px">@lang('app.restaurant-material-data.title-right')</h5>
                            <div class="table-responsive new-table">
                                <table id="table-restaurant-supplier-material-data" class="table">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>@lang('app.restaurant-material-data.table-brand.title2')</th>
                                        <th>@lang('app.restaurant-material-data.table-brand.title5')</th>
                                        <th class="text-center form-group text-center">@lang('app.restaurant-material-data.table-brand.title3')</th>
                                        <th class="text-center form-group rounded">@lang('app.restaurant-material-data.table-brand.title4')</th>
                                        <th>@lang('app.restaurant-material-data.table-brand.title5')</th>
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
    </div>
    @include('manage.supplier_order.detail_order')
    @include('manage.supplier_order.detail_restaurant')
@endsection

@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\build_data\assign_supplier_material\restaurant\index.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
