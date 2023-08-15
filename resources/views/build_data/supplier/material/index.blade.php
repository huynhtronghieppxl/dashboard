@extends('layouts.layout')
@section('content')
<div class="page-wrapper">
    <div class="page-body">
        <div class="card card-block">
            <div class="col-lg-12 d-flex px-0">
                <div class="col-lg-8 pl-0">
                    <ul class="nav nav-tabs md-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" data-id="1" data-toggle="tab"
                               href="#supplier-material-supplier-data-enable-tab"
                               role="tab" aria-expanded="true">@lang('app.supplier-data.material.enable_tab')
                                <span class="label label-success" id="total-record-enable">0</span></a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-id="2" data-toggle="tab"
                               href="#supplier-material-supplier-data-disable-tab"
                               role="tab" aria-expanded="false">@lang('app.supplier-data.material.disable_tab')
                                <span class="label label-inverse" id="total-record-disable">0</span></a>
                            <div class="slide"></div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="supplier-material-supplier-data-enable-tab" role="tabpanel">
                    <div class="table-responsive new-table">
                        <div class="select-filter-dataTable">
                            <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select2-hidden-accessible supplier-material-supplier-data" data-select="1" >
                                            <option value="" disabled selected>@lang('app.quantitative-data-ver2.select-default')</option>
                                        </select>
                                        <div class="line"></div>
                                    </div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <table id="table-enable-material-supplier-data" class="table">
                            <thead>
                            <tr>
                                <th>@lang('app.supplier-data.material.stt')</th>
                                <th>@lang('app.supplier-data.material.name')</th>
                                <th>@lang('app.supplier-data.material.sub-inventory')</th>
                                <th>@lang('app.supplier-data.material.price')</th>
                                <th>@lang('app.supplier-data.material.action')</th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="supplier-material-supplier-data-disable-tab" role="tabpanel">
                    <div class="table-responsive new-table">
                        <div class="select-filter-dataTable">
                            <div class="form-validate-select">
                                <div class="pr-0 select-material-box">
                                    <select class="js-example-basic-single select2-hidden-accessible supplier-material-supplier-data" data-select="1" >
                                        <option value="" disabled selected>@lang('app.quantitative-data-ver2.select-default')</option>
                                    </select>
                                    <div class="line"></div>
                                </div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <table id="table-disable-material-supplier-data" class="table">
                            <thead>
                            <tr>
                                <th>@lang('app.supplier-data.material.stt')</th>
                                <th>@lang('app.supplier-data.material.name')</th>
                                <th>@lang('app.supplier-data.material.sub-inventory')</th>
                                <th>@lang('app.supplier-data.material.price')</th>
                                <th>@lang('app.supplier-data.material.action')</th>
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
<div class="d-none">
    <span id="id-tab-active-material-data"></span>
    <span id="msg-title-status-material-data">@lang('app.supplier-data.material.title-status')</span>
    <span id="msg-content-status-material-data">@lang('app.supplier-data.material.content-status')</span>
</div>
@include('build_data.supplier.material.create')
@include('build_data.supplier.material.assign')
@include('build_data.supplier.material.detail')
@include('build_data.supplier.material.update')
@include('manage.supplier_order.detail_order')
@endsection

@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\build_data\supplier\supplier_material\index.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
