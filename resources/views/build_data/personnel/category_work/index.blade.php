<style>
    .select-not-select2 {
        position: relative;
        display: inline-block;
        --color: red;
    }

    .select-not-select2:before {
        content: "";
        position: absolute;
        right: 20px;
        top: 1px;
        bottom: 1px;
        left: 40px;
        background: var(--color);
        mix-blend-mode: lighten;
    }

    select-not-select2 option {
        color: orange;
    }

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
@extends('layouts.layout')
@section('content')
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card card-block box-parent-category-work">
                    <div class="row">
                        <div class="col-sm-3 d-flex justify-content-start">
                            <div class="form-validate-select mb-0 w-100">
                                <div class="pr-0 select-material-box row">
                                    <select id="select-role-work-data" class="js-example-basic-single b-none">
                                        <option value="" disabled
                                                selected>@lang('app.component.option_default')</option>
                                    </select>
                                    <label class="col-form-label">
                                        @lang('app.work-data.role')
                                    </label>

                                </div>
                            </div>

                            <div class="select2_theme validate-group d-none">
                                <div class="form-validate-select ">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box pr-2">
                                            <select id="select-type-business-growth-report"
                                                    class="form-control border-0 select-not-select2">
                                                <option value="3" data-time="{{date('m/Y')}}"
                                                        selected>@lang('app.branch-dashboard.select.option5')</option>
                                                <option value="3"
                                                        data-time="{{date('m/Y', strtotime('-1 month'))}}">@lang('app.branch-dashboard.select.option6')</option>
                                                {{--                                    <option value="3"--}}
                                                {{--                                            data-time="{{date('m/Y', strtotime('-2 month'))}}">{{date('m/Y', strtotime('-2 month'))}}</option>--}}
                                                <option value="5"
                                                        data-time="{{date('Y')}}">@lang('app.branch-dashboard.select.option8')</option>
                                                <option value="5"
                                                        data-time="{{date('Y', strtotime('-1 year'))}}">@lang('app.branch-dashboard.select.option11')</option>
                                            </select>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9 d-flex justify-content-end align-items-center table-responsive new-table">
                            <div class="select-filter-dataTable d-flex" style="position: unset">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand category-work-data">
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
                                     onclick="openModalCreateCategoryWorkData()">
                                    <i class="fa fa-plus"
                                       style="font-size: 13px;vertical-align: middle;top:0 !important;"></i>
                                    <span class="pl-2"
                                          style="text-transform: uppercase">@lang('app.component.button.create') (F2)</span>
                                </div>
                            </div>
                            <div class="toolbar-button-datatable d-warning" id="button-service-2">
                                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue d-flex align-items-center ml-2"
                                     onclick="saveSortCategoryWorkData()">
                                    <i class="fa fa-upload"
                                       style="font-size: 13px;vertical-align: middle;top:0 !important;"></i>
                                    <span class="pl-2"
                                          style="text-transform: uppercase">@lang('app.component.button.update')</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-block pb-0 pt-0">
                        <div class="group-data-category">
                            <div class="col-md-12 row card-block" id="draggableMultiple"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('build_data.personnel.category_work.create')
    @include('build_data.personnel.category_work.update')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/personnel/category_work/index.js?version=4', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
