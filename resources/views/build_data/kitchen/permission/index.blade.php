@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-id="1" id="tab-material-kitchen-1" data-toggle="tab"
                       href="#material-kitchen-tab1" role="tab"
                       aria-expanded="true">@lang('app.permission-kitchen.tab1')</a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-id="2" id="tab-material-kitchen-2" data-toggle="tab"
                       href="#material-kitchen-tab2" role="tab"
                       aria-expanded="false">@lang('app.permission-kitchen.tab2')</a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block pt-0">
                <div class="tab-content p-t-5px m-0">
                    <div class="tab-pane active" id="material-kitchen-tab1" role="tabpanel">
                        <div class="row d-flex">
                            <div class="edit-flex-auto-fill col-sm-6 pl-0">
                                <div class="card flex-sub pr-0 pt-0 pl-0">
                                    <div class="card-block p-b-0 pl-0">
                                        <h5 class="sub-title ml-0 mt-0">@lang('app.permission-kitchen.title-left')</h5>
                                    </div>
                                    <div class="card-block p-t-0 pl-0 pr-0">
                                        <div class="table-responsive new-table">
                                            <div class="select-filter-dataTable">
                                                <div class="form-validate-select">
                                                    <div class="pr-0 select-material-box">
                                                        <select class="js-example-basic-single select-brand select-brand-permission-data">
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
                                                        <select class="js-example-basic-single select-branch select-branch-permission-data">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <table id="table-employee-kitchen-data" class="table">
                                                <thead>
                                                <tr>
                                                    <th class="text-left">@lang('app.permission-kitchen.name')</th>
                                                    <th class="text-left">@lang('app.permission-kitchen.role')</th>
                                                    <th></th>
                                                    <th>
                                                        <div class="btn-group btn-group-sm btn-all-left">
                                                            <button type="button"
                                                                    class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                                    onclick="checkAllPermissionKitChenData($(this))">
                                                                <i class="fi-rr-arrow-small-right"></i>
                                                            </button>
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
                            <div class="edit-flex-auto-fill col-sm-6 pr-0">
                                <div class="card flex-sub pr-0 pt-0 pl-0">
                                    <div class="card-block p-b-0 pl-0">
                                        <h5 class="sub-title ml-0 mt-0">@lang('app.permission-kitchen.title-right')</h5>
                                    </div>
                                    <div class="card-block p-t-0 pl-0 pr-0">
                                        <div class="table-responsive new-table">
                                            <table id="table-employee-select-kitchen-data" class="table">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        <div class="btn-group btn-group-sm btn-all-right">
                                                            <button type="button"
                                                                    class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                                    onclick="unAllPermissionKitChenData($(this))">
                                                                <i class="fi-rr-arrow-small-left"></i>
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <th class="text-left">@lang('app.permission-kitchen.name')</th>
                                                    <th class="text-left">@lang('app.permission-kitchen.role')</th>
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
                    <div class="tab-pane" id="material-kitchen-tab2" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="ml-0" style="font-size: 13px">@lang('app.permission-kitchen.title-tab2')
                                    <b class="ml-1" id="name-branch"></b>:&emsp;<b id="name-employee"
                                                                                   class="seemt-orange"></b>
                                </h5>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand select-brand-permission-data">
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
                                            <select class="js-example-basic-single select-branch select-branch-permission-data">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table id="table-employee-leader-kitchen-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.permission-kitchen.stt')</th>
                                        <th></th>
                                        <th class="text-left">@lang('app.permission-kitchen.name')</th>
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
    @include('manage.employee.info')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/kitchen/permission/index.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
