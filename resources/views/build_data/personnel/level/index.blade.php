@extends('layouts.layout')
@section('content')
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row d-flex">
                    <div class="col-sm-5 edit-flex-auto-fill pr-1">
                        <div class="card flex-sub">
                            <div class="card-block p-0">
                                <h5 class="sub-title d-flex mt-0 mx-0"
                                    style="padding-bottom: 12px; margin-bottom: 10px">@lang('app.level-data.title-left')
                                    <i class="fi-rr-exclamation pointer ml-1"
                                       data-toggle="tooltip" data-placement="top"
                                       data-original-title="@lang('app.level-data.content')"></i>
                                </h5>
                            </div>
                            <div class="card-block p-t-0">
                                <div class="table-responsive new-table">
                                    <table id="table-role-level-data" class="table leveler">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.level-data.stt')</th>
                                            <th>@lang('app.level-data.name-role')</th>
                                            <th class="d-none"></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7 edit-flex-auto-fill pl-1">
                        <div class="card flex-sub " id="loading-table-level-data">
                            <div class="card-block p-0">
                                <h5 class="sub-title mt-0 mx-0"
                                    style="padding-bottom: 12px; margin-bottom: 10px">@lang('app.level-data.title-right')</h5>
                            </div>
                            <div class="card-block p-t-0">
                                <div class="table-responsive new-table">
                                    <div class="select-filter-dataTable">
                                        <div class="form-validate-select" style="margin-right: 18px;">
                                            <div class="pr-0 select-material-box">
                                                <select class="js-example-basic-single select-brand level-data">
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
                                    </div>
                                    <table id="table-level-data" class="table">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.level-data.stt')</th>
                                            <th>@lang('app.level-data.name')</th>
                                            <th>@lang('app.level-data.table')</th>
                                            <th>@lang('app.level-data.value')</th>
                                            <th>@lang('app.level-data.action')</th>
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
    @include('build_data.personnel.level.create')
    @include('build_data.personnel.level.update')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/personnel/level/index.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
