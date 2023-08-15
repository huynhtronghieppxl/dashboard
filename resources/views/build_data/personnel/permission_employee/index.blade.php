@extends('layouts.layout')
@section('content')
    <style>
        .sortable-moves span i {
            font-size: 25px !important;
            margin-right: 5px;
        }

        #permission-employee-data {
            height: calc(100vh - 230px);
            overflow: auto;
        }

        #save-permission-employee-data {
            padding: 10px 15px;
            border-radius: 6px;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-6 col-md-4 pr-2 edit-flex-auto-fill">
                    <div class="card w-100 flex-sub">
                        <div class="card-block p-0">
                            <div class="scroll-x-hidden">
                                <label
                                        class="col-lg-12 sub-title w-100 float-left mt-0 mx-0 px-0"
                                        style="padding-bottom: 12px; margin-bottom: 10px">@lang('app.permission-employee.employee')</label>
                                <div class="table-responsive new-table">
                                    <table class="table pointer table-hover"
                                           id="table-employee-permission-data">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.permission-employee.stt')</th>
                                            <th>@lang('app.permission-employee.name')</th>
                                            <th>@lang('app.permission-employee.role')</th>
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
                <div class="col-6 col-md-8 pl-0">
                    <div class="card custom-div-part flex-sub pt-0">
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
                            <div class="sub-title p-0 d-flex justify-content-between">
                                <label class="sub-title border-0 m-0 pt-0 px-0"
                                       style="padding-bottom: 11px">@lang('app.permission-role-data.title-permission')</label>
                                <div class=" d-flex align-items-center">
                                    <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue d-flex"
                                         style="padding: 4px 15px !important;text-transform: uppercase;transform: translateY(-7px)"
                                         id="save-permission-employee-data"
                                         onclick="savePermissionEmployeeData()">
                                        <i class="fi-rr-disk mt-1"></i>
                                        <span>@lang('app.component.button.save')</span>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-12" style="padding-top: 10px; padding-bottom: 4px">
                            <div class="search-layout-body" id="div-search-permission-employee-data">
                                <input class="search-text-layout-body" type="text" placeholder="Tìm kiếm quyền"
                                       id="search-permission-employee-data">
                                <a href="javascript:void(0)" class="search-button-layout-body"><i
                                            class="fi-rr-search"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="permission-employee-data">
                        {{--                             Data--}}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div id="mySidenav-321" class="sidenav">
        <a href="javascript:void(0)" id="button-service-1" class="bg-primary d-none right-none max-content"
           onclick="savePermissionEmployeeData()">@lang('app.component.button.save')</a><br>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/personnel/permission_employee/index.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush





