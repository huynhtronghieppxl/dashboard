@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row d-flex">
                <div class="edit-flex-auto-fill col-sm-6 pr-0">
                    <div class="card flex-sub pr-0">
                        <div class="card-block p-b-0">
                            <h5 class="sub-title mb-4 ml-0">@lang('app.warehouse-manage.assign.title-left')</h5>
                        </div>
                        <div class="card-block p-t-0" id="body-system-supplier-data">
                            <div class="table-responsive new-table">
                                <table id="table-un-assign-branch-warehouse-manage" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.warehouse-manage.name')</th>
                                        <th>@lang('app.warehouse-manage.location')</th>
                                        <th>
                                            <div class="btn-group btn-group-sm">
                                                <button type="button"
                                                        class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                        onclick="checkAllAssignBranch($(this))"><i
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
                    <div class="card flex-sub">
                        <div class="card-block p-b-0">
                            <h5 class="sub-title mb-4 ml-0">@lang('app.warehouse-manage.assign.title-right')</h5>
                        </div>
                        <div class="card-block p-t-0" id="body-restaurant-supplier-data">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-group select2_theme validate-group"
                                         style="margin-right: 20px !important;margin-left: 10px !important;">
                                        <div class="form-validate-select">
                                            <div class="select-material-box">
                                                <select class="js-example-basic-single select2-hidden-accessible"
                                                        id="select-branch-assign-warehouse-manage">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table id="table-assign-branch-warehouse-manage" class="table">
                                    <thead>
                                    <tr>
                                        <th>
                                            <div class="btn-group btn-group-sm">
                                                <button type="button"
                                                        class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                        onclick="unCheckAllAssignBranch($(this))"><i
                                                            class="fi-rr-arrow-small-left"></i></button>
                                            </div>
                                        </th>
                                        <th>@lang('app.warehouse-manage.name')</th>
                                        <th>@lang('app.warehouse-manage.location')</th>
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
            src="{{ asset('js/manage/warehouse/assign/index.js?version=6',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
