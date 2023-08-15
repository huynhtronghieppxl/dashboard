@extends('layouts.layout')
@section('content')
    <div class="page-body">
        <div class="card card-block">
            <div class="table-responsive new-table">
                <table id="table-inventory-material-data" class="table">
                    <thead>
                    <tr>
                        <th rowspan="2">@lang('app.inventory-material-data.stt')</th>
                        <th rowspan="2">@lang('app.inventory-material-data.name')</th>
                        <th rowspan="2">@lang('app.inventory-material-data.unit')</th>
                        <th rowspan="2">@lang('app.inventory-material-data.inventory')</th>
                        <th>@lang('app.inventory-material-data.branch')</th>
                        <th>@lang('app.inventory-material-data.internal-period')</th>
                        <th>@lang('app.inventory-material-data.internal-day')</th>
                        <th rowspan="2"></th>
                        <th class="d-none"></th>
                    </tr>
                    <tr>
                        <th>
                            <div class="checkbox-fade fade-in-primary m-auto">
                                <label>
                                    <input type="checkbox" id="check-all-branch-inventory-material-data" data-col="4"/>
                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                </label>
                            </div>
                        </th>
                        <th>
                            <div class="checkbox-fade fade-in-primary m-auto">
                                <label>
                                    <input type="checkbox" id="check-all-internal-period-inventory-material-data"
                                           data-col="5"/>
                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                </label>
                            </div>
                        </th>
                        <th>
                            <div class="checkbox-fade fade-in-primary m-auto">
                                <label>
                                    <input type="checkbox" id="check-all-internal-day-inventory-material-data"
                                           data-col="6"/>
                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                </label>
                            </div>
                        </th>
                        <th class="d-none"></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\build_data\material\inventory_material\index.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript" src="{{ asset('js\build_data\material\material\detail.js?version=7', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
