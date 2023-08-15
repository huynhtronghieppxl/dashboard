@extends('layouts.layout')
@section('content')
    <style>
        #select-material-type-material-data, #select-other-type-material-data {
            position: unset !important;
            width: 200px !important;
        }

        #select-goods-type-material-data {
            position: unset !important;
            width: 100px !important;
        }

        #select-internal-type-material-data {
            position: unset !important;
            width: 150px !important;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs md-5-tabs" role="tablist" id="nav-material-data">
                <li class="nav-item">
                    <a class="nav-link active" data-tab="0" id="tab-material-data-1" data-toggle="tab"
                       href="#material-tab1"
                       role="tab" onclick="changeActiveTabMaterialData(1)"
                       aria-expanded="true">@lang('app.material-data.tab1') <span
                                class="label label-success" id="total-record-material">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-tab="1" id="tab-material-data-2" data-toggle="tab" href="#material-tab2"
                       role="tab" onclick="changeActiveTabMaterialData(2)"
                       aria-expanded="false">@lang('app.material-data.tab2') <span
                                class="label label-warning" id="total-record-goods">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-tab="2" id="tab-material-data-3" data-toggle="tab" href="#material-tab3"
                       role="tab" onclick="changeActiveTabMaterialData(3)"
                       aria-expanded="false">@lang('app.material-data.tab3') <span
                                class="label label-primary" id="total-record-material-internal">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-tab="3" id="tab-material-data-12" data-toggle="tab" href="#material-tab4"
                       role="tab" onclick="changeActiveTabMaterialData(12)"
                       aria-expanded="false">@lang('app.material-data.tab4') <span
                                class="label label-danger" id="total-record-other">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-tab="4" id="tab-material-data-4" data-toggle="tab" href="#material-tab5"
                       role="tab" onclick="changeActiveTabMaterialData(4)"
                       aria-expanded="false">@lang('app.material-data.tab5') <span
                                class="label label-inverse" id="total-record-off">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block pt-10 pb-0">
                <div class="tab-content">
                    <div class="tab-pane active" id="material-tab1" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single" id="select-material-type-material-data">
                                            <option value="" selected>Tất cả</option>
                                            <option value="@lang('app.material-data.create.opt4')">@lang('app.material-data.create.opt4')</option>
                                            <option value="@lang('app.material-data.create.opt5')">@lang('app.material-data.create.opt5')</option>
                                            <option value="@lang('app.material-data.create.opt15')">@lang('app.material-data.create.opt15')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="table-material-material-data" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.material-data.stt')</th>
                                    <th>@lang('app.material-data.name')</th>
                                    <th>@lang('app.material-data.is_office_material')</th>
                                    <th>@lang('app.material-data.material_inventory')</th>
                                    <th>@lang('app.material-data.category')</th>
                                    <th>@lang('app.material-data.price')</th>
                                    <th>@lang('app.material-data.action')</th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="material-tab2" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single" id="select-goods-type-material-data">
                                            <option value="" selected>Tất cả</option>
                                            <option value="@lang('app.material-data.create.opt8')">@lang('app.material-data.create.opt8')</option>
                                            <option value="@lang('app.material-data.create.opt9')">@lang('app.material-data.create.opt9')</option>
                                            <option value="@lang('app.material-data.create.opt10')">@lang('app.material-data.create.opt10')</option>
                                            <option value="@lang('app.material-data.create.opt15')">@lang('app.material-data.create.opt15')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="table-goods-material-data" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.material-data.stt')</th>
                                    <th>@lang('app.material-data.name')</th>
                                    <th>@lang('app.material-data.is_office_material')</th>
                                    <th>@lang('app.material-data.goods_inventory')</th>
                                    <th>@lang('app.material-data.category')</th>
                                    <th>@lang('app.material-data.price')</th>
                                    <th>@lang('app.material-data.action')</th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="material-tab3" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single" id="select-internal-type-material-data">
                                            <option value="" selected>Tất cả</option>
                                            <option value="@lang('app.material-data.create.opt11')">@lang('app.material-data.create.opt11')</option>
                                            <option value="@lang('app.material-data.create.opt16')">@lang('app.material-data.create.opt16')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="table-internal-material-data" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.material-data.stt')</th>
                                    <th>@lang('app.material-data.name')</th>
                                    <th>@lang('app.material-data.is_office_material')</th>
                                    <th>@lang('app.material-data.internal_inventory')</th>
                                    <th>@lang('app.material-data.category')</th>
                                    <th>@lang('app.material-data.price')</th>
                                    <th>@lang('app.material-data.action')</th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="material-tab4" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single" id="select-other-type-material-data">
                                            <option value="" selected>Tất cả</option>
                                            <option value="@lang('app.material-data.create.opt6')">@lang('app.material-data.create.opt6')</option>
                                            <option value="@lang('app.material-data.create.opt17')">@lang('app.material-data.create.opt17')</option>
                                            <option value="@lang('app.material-data.create.opt18')">@lang('app.material-data.create.opt18')</option>
                                            <option value="@lang('app.material-data.create.opt19')">@lang('app.material-data.create.opt19')</option>
                                            <option value="@lang('app.material-data.create.opt20')">@lang('app.material-data.create.opt20')</option>
                                            <option value="@lang('app.material-data.create.opt21')">@lang('app.material-data.create.opt21')</option>
                                            <option value="@lang('app.material-data.create.opt22')">@lang('app.material-data.create.opt22')</option>
                                            <option value="@lang('app.material-data.create.opt23')">@lang('app.material-data.create.opt23')</option>
                                            <option value="@lang('app.material-data.create.opt13')">@lang('app.material-data.create.opt13')</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="table-other-material-data" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.material-data.stt')</th>
                                    <th>@lang('app.material-data.name')</th>
                                    <th>@lang('app.material-data.is_office_material')</th>
                                    <th>@lang('app.material-data.other_inventory')</th>
                                    <th>@lang('app.material-data.category')</th>
                                    <th>@lang('app.material-data.price')</th>
                                    <th>@lang('app.material-data.action')</th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="material-tab5" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                            </div>
                            <table id="table-off-material-data" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.material-data.stt')</th>
                                    <th>@lang('app.material-data.name')</th>
                                    <th>@lang('app.material-data.is_office_material')</th>
                                    <th>@lang('app.material-data.inventory')</th>
                                    <th>@lang('app.material-data.sub-inventory')</th>
                                    <th>@lang('app.material-data.category')</th>
                                    <th>@lang('app.material-data.price')</th>
                                    <th>@lang('app.material-data.action')</th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Page-body end -->
    </div>
    @include('build_data.material.material.create')
    @include('build_data.material.material.update')
    @include('build_data.material.material.detail')
    @include('build_data.material.material.create_calc')
    @include('build_data.material.material.create_unit_food_maps')
    @include('build_data.material.material.notify')
    @include('manage.supplier_order.detail_order')
    @include('manage.supplier_order.detail_restaurant')
    @include('manage.supplier_order.detail_request')
    @include('manage.food.brand.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\build_data\material\material\index.js?version=11', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
