@extends('layouts.layout')
@section('content')
<div class="page-wrapper">
    <div class="page-body">
        <div class="row d-flex">
            <div class="edit-flex-auto-fill col-sm-6 pr-0">
                <div class="card flex-sub pr-0">
                    <div class="card-block p-b-0">
                        <h5 class="sub-title mb-4 ml-0">@lang('app.branch-system-supplier-data.title-left')</h5>
                    </div>
                    <div class="card-block p-t-0 mt-1" id="body-brand-supplier-data">
                        <div class="table-responsive new-table">
                            <table id="table-brand-supplier-data" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.branch-system-supplier-data.supplier_name')</th>
                                    <th>@lang('app.branch-system-supplier-data.phone')</th>
                                    <th>
                                        <i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right"
                                           onclick="checkAllBranchSupplierData($(this))"></i>
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
                        <h5 class="sub-title mb-4 ml-0">@lang('app.branch-system-supplier-data.title-right')</h5>
                    </div>
                    <div class="card-block p-t-0" id="body-branch-supplier-data">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select id="select-branch-assign-supplier-data" data-select="1" class="js-example-basic-single select2-hidden-accessible">
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->where('is_office', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))->all() as $db)--}}
                                            <option value="{{$db['id']}}">{{$db['name']}}</option>
                                            @endforeach
                                        </select>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                            <table id="table-branch-supplier-data" class="table">
                                <thead>
                                <tr>
                                    <th>
                                        <i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right"
                                           onclick="unCheckAllBranchSupplierData($(this))"></i>
                                    </th>
                                    <th>@lang('app.branch-system-supplier-data.supplier_name')</th>
                                    <th>@lang('app.branch-system-supplier-data.phone')</th>
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
    @include('build_data.assign_supplier.branch.assign')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\build_data\assign_supplier\branch\index.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
