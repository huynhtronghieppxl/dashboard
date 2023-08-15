@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <!-- Page-body start -->
        <div class="page-body">
            <div class="card card-block">
                <div class="tab-content mb-0">
                    <div class="tab-pane active" id="material-tab2" role="tabpanel">
                        <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                            <div class="col-sm-12 row pl-0">
                                <div class="col-sm-6 pl-0">
                                    <h5 class="ml-0"
                                        style="font-size: 13px"> @lang('app.permission-sales.tab2.employee-current-permission-sales')
                                        <b
                                                class="ml-1" id="name-branch"></b>:&emsp;<b class="seemt-orange"
                                                                                            id="name-employee"
                                                                                            style="font-size: 15px;font-weight: bold;">----</b>
                                    </h5>
                                </div>
                            </div>
                            <div class="card-block pl-0">
                                <div class="table-responsive new-table">
                                    <div class="select-filter-dataTable">
                                        <div class="form-validate-select">
                                            <div class="pr-0 select-material-box">
                                                <select class="js-example-basic-single select-brand select-brand-permission-sales">
                                                    @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                        @if($db['is_office'] === 0)
                                                            @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                                <option value="{{$db['id']}}"
                                                                        selected>{{$db['name']}}</option>
                                                            @else
                                                                <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-validate-select">
                                            <div class="pr-0 select-material-box">
                                                <select class="js-example-basic-single select-branch select-branch-permission-sales">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="table-All-employee-branch-data" class="table">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.permission-sales.tab2.stt')</th>
                                            <th>@lang('app.permission-sales.tab2.choose')</th>
                                            <th class="text-left">@lang('app.permission-sales.tab2.name')</th>
                                            <th>@lang('app.permission-sales.tab2.uer')</th>
                                            <th>@lang('app.permission-sales.tab2.gender')</th>
                                            <th>@lang('app.permission-sales.tab2.phone')</th>
                                            <th>@lang('app.permission-sales.tab2.branch')</th>
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
        <!-- Page-body end -->
    </div>
    <div class="d-none">
        <span id="id-tab-active-material-branch-data">1</span>
    </div>
    @include('build_data.business.permission_sales.Update_areas')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/business/permission_sales/index.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
