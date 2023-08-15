@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <!-- Page-body start -->
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist" id="nav-tab-list-supplier">
                <li class="nav-item">
                    <a class="nav-link" data-type="0" id="tab-supplier-data-use" data-toggle="tab"
                       href="#supplier-data-tab1"
                       role="tab" aria-expanded="true">@lang('app.supplier-data.supplier.tab1') <span
                                class="label label-success" id="total-record-enable">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-type="1" data-toggle="tab" id="tab-supplier-data-not-use"
                       href="#supplier-data-tab2"
                       role="tab" aria-expanded="true">@lang('app.supplier-data.supplier.tab2') <span
                                class="label label-danger" id="total-record-not-use-supplier">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-type="2" data-toggle="tab" id="tab-supplier-data-dis-enable"
                       href="#supplier-data-tab3"
                       role="tab" aria-expanded="false">@lang('app.supplier-data.supplier.tab3')<span
                                class="label label-inverse ml-2" id="total-record-disable">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="supplier-data-tab1" role="tabpanel">
                        <div class="col-sm-12 p-0">
                            <div class="table-responsive new-table">
                                <table id="table-enable-supplier-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.supplier-data.supplier.STT')</th>
                                        <th>@lang('app.supplier-data.supplier.name')</th>
                                        <th>@lang('app.supplier-data.supplier.phone')</th>
                                        <th>@lang('app.supplier-data.supplier.action')</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="supplier-data-tab2" role="tabpanel">
                        <div class="col-sm-12 p-0">
                            <div class="table-responsive new-table">
                                <table id="table-supplier-not-active-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.supplier-data.supplier.STT')</th>
                                        <th>@lang('app.supplier-data.supplier.name')</th>
                                        <th>@lang('app.supplier-data.supplier.phone')</th>
                                        <th>@lang('app.supplier-data.supplier.action')</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="supplier-data-tab3" role="tabpanel">
                        <div class="col-sm-12 p-0">
                            <div class="table-responsive new-table">
                                <table id="table-disable-supplier-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.supplier-data.supplier.STT')</th>
                                        <th>@lang('app.supplier-data.supplier.name')</th>
                                        <th>@lang('app.supplier-data.supplier.phone')</th>
                                        <th>@lang('app.supplier-data.supplier.action')</th>
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
    {{--Modal create--}}
    @include('build_data.supplier.supplier.create')
    {{--Modal update--}}
    @include('build_data.supplier.supplier.update')
    {{--Modal detail--}}
    @include('manage.supplier.detail')
    {{--Modal detail inventory--}}
    @include('manage.inventory.in_inventory.detail')
    @include('build_data.material.material.detail')
    {{--Modal contact--}}
    @include('build_data.supplier.supplier.contact.contact')
    {{--Chi tiết PMH--}}
    @include('manage.supplier_order.detail_order')
    {{--    Gán nguyên liệu--}}
    @include('build_data.supplier.supplier.assign')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/supplier/supplier/index.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush


