@extends('layouts.layout')
@section('content')
    <style>
        .seemt-container .btn {
            border-radius: 6px;
            padding: 7px 16px 7px 17.33px !important;
        }
        .d-warning{
            opacity: 0.5;
            pointer-events: none;
            transition: all 0.2s linear 0s
        }
    </style>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card card-block">
                <div class="row">
                    <div class="col-sm-3 d-flex justify-content-start">
                        <div class="form-validate-select mb-0 w-100">
                            <div class="pr-0 select-material-box row">
                                <select id="select-role-work-data-employee"
                                        class="js-example-basic-single b-none">
                                    <option value="" selected disabled>@lang('app.component.option_default')</option>
                                </select>
                                <label class="col-form-label">
                                    @lang('app.work-data.role')
                                </label>
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9 d-flex justify-content-end align-items-center table-responsive new-table">
                        <div class="select-filter-dataTable d-flex" style="position: unset">
                            <div class="form-validate-select">
                                <div class="pr-0 select-material-box">
                                    <select class="js-example-basic-single select-brand work-data">
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
                        </div>
                        <div class="toolbar-button-datatable">
                            <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue d-flex align-items-center ml-2"
                                 onclick="openModalCreateWorkData()">
                                <i class="fa fa-plus"
                                   style="font-size: 13px;vertical-align: middle;top:0 !important;"></i>
                                <span class="pl-2"
                                      style="text-transform: uppercase">@lang('app.component.button.create')</span>
                            </div>
                        </div>
                        <div class="toolbar-button-datatable">
                            <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue d-flex align-items-center ml-2"
                                 onclick="ExportExcelWord()">
                                <i class="fa fa-download"
                                   style="font-size: 13px;vertical-align: middle;top:0 !important;"></i>
                                <span class="pl-2"
                                      style="text-transform: uppercase">@lang('app.component.excel.export')</span>
                            </div>
                        </div>
                        <div class="toolbar-button-datatable d-warning" id="button-service-3">
                            <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue d-flex align-items-center ml-2"
                                 onclick="saveSortWorkData()">
                                <i class="fa fa-upload"
                                   style="font-size: 13px;vertical-align: middle;top:0 !important;"></i>
                                <span class="ml-2"
                                      style="text-transform: uppercase">@lang('app.component.button.update')</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- bộ phận-->
                <div class="pb-0 pt-0">
                    <div id="data-work-data">
                        {{-- Data --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('build_data.personnel.work.create')
    @include('build_data.personnel.work.update')
    @include('build_data.personnel.work.detail')
    @include('build_data.personnel.work.excel')
    @include('build_data.personnel.work.create_category_work')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/personnel/work/index.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush


