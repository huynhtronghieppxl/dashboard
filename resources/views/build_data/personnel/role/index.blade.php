@extends('layouts.layout')
@section('content')
    <style>
        .fa-square:before {
            display: block;
            width: 20px !important;
        }

        .fa-check-square:before {
            display: block;
            width: 20px !important;
        }

        #permission-role-data {
            height: calc(100vh - 230px);
            overflow: auto;
        }

        #save-permission-role-data {
            padding: 10px 15px;
            border-radius: 6px;
        }

    </style>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row d-flex">
                <div class="col-5 edit-flex-auto-fill">
                    <div class="card w-100 flex-sub">
                        <div class="card-block p-0">
                            <div class="scroll-x-hidden">
                                <h5 class="col-lg-12 sub-title pl-0 w-100 float-left mt-0 mx-0"
                                    style="padding-bottom: 12px; margin-bottom: 10px;">@lang('app.permission-role-data.title-role')</h5>
                                <div class="table-responsive new-table">
                                    <div class="select-filter-dataTable">
                                        <div class="form-validate-select" style="margin-right: 15px !important;">
                                            <div class="pr-0 select-material-box">
                                                <select class="js-example-basic-single select-role-group-data">
                                                    <option value="-1" selected>@lang('app.role-data.group')</option>
                                                    <option value="1">@lang('app.role-data.update.role-office')</option>
                                                    <option
                                                            value="2">@lang('app.role-data.update.role-business')</option>
                                                    <option
                                                            value="3">@lang('app.role-data.update.role-production')</option>
                                                    <option
                                                            value="4">@lang('app.role-data.update.role-marketing')</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table pointer table-hover"
                                           id="table-role-data">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.role-data.stt')</th>
                                            <th>@lang('app.role-data.name')</th>
                                            <th>@lang('app.role-data.group')</th>
                                            <th>@lang('app.role-data.action')</th>
                                            <th class="d-none"></th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-7 pl-0 edit-flex-auto-fill flex-column">
                    <div class="card custom-div-part flex-sub mb-0 pt-0">
                        <div class="card-block p-0">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable d-flex" style="right: 162px">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand select-brand-permission-employee-data">
                                                @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                    @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                        <option value="{{$db['id']}}"
                                                                selected>{{$db['name']}}</option>
                                                    @else
                                                        <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-branch select-branch-permission-employee-data">
                                                @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', ENUM_SELECTED)->all() as $db)
                                                    @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])
                                                        <option value="{{$db['id']}}"
                                                                selected>{{$db['name']}}</option>
                                                    @else
                                                        <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sub-title pb-0 d-flex justify-content-between align-items-center"
                                 style="padding-bottom: 5px !important;">
                                <h5 class="mb-0 sub-title border-0 m-0">@lang('app.permission-role-data.title-permission')</h5>
                                <div class="d-flex align-items-center">
                                    <div id="save-permission-role-data"
                                         class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue d-flex"
                                         style="padding: 4px 15px !important;text-transform: uppercase"
                                         onclick="savePermissionRoleData()">
                                        <i class="fi-rr-disk mt-1"></i>
                                        <span>@lang('app.component.button.save')</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" style="padding-top: 12px;padding-bottom: 9px">
                            <div class="search-layout-body" id="div-search-permission-role-data">
                                <input class="search-text-layout-body" type="text"
                                       placeholder="Tìm kiếm quyền" id="search-permission-role-data">
                                <a href="javascript:void(0)" class="search-button-layout-body"><i
                                            class="fi-rr-search"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="permission-role-data">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('build_data.personnel.role.create')
    @include('build_data.personnel.role.update')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/personnel/role/index.js?version=4', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
