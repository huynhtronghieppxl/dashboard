@extends('layouts.layout')
@section('content')
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row d-flex">
                    <div class="col-sm-12 edit-flex-auto-fill">
                        <div class="card card-block flex-sub m-0" id="loading-table-point-data">
                            <div class="p-b-0">
                                <h4 class="sub-title">@lang('app.point-data.title-right')</h4>
                            </div>
                            <div class=" pt-0">
                                <div class="table-responsive new-table">
                                    <div class="select-filter-dataTable ">
                                        <div class="form-validate-select" style="margin-right: 20px !important;">
                                            <div class="pr-0 select-material-box">
                                                <select class="js-example-basic-single select-role-point-data"
                                                        data-validate="">
                                                    <option value="" disabled selected
                                                            hidden>@lang('app.component.option-null')</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="table-point-data" class="table">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.point-data.stt')</th>
                                            <th>@lang('app.point-data.target')</th>
                                            <th>@lang('app.point-data.money')</th>
                                            <th></th>
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
    </div>
    @include('build_data.personnel.point.create')
    @include('build_data.personnel.point.update')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\build_data\personnel\point\index.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
