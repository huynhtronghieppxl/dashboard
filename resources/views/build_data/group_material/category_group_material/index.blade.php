@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        {{-- <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>@lang('app.area-data.title')</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="/"> <i class="feather icon-home"></i> </a>
                            </li>
                            <li class="breadcrumb-item"><a
                                        href="">@lang('app.area-data.breadcrumb')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-block">
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-12">--}}
{{--                                <ul class="nav nav-tabs md-tabs" role="tablist">--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link active" data-toggle="tab" id="tab-area-data-1" href="#area-tab1" role="tab"--}}
{{--                                           aria-expanded="true" >@lang('app.area-data.tab1') <span class="label label-success" id="total-record-enable">0</span></a>--}}
{{--                                        <div class="slide"></div>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link" data-toggle="tab" id="tab-area-data-2" href="#area-tab2" role="tab"--}}
{{--                                           aria-expanded="false">@lang('app.area-data.tab2') <span class="label label-inverse" id="total-record-disable">0</span></a>--}}
{{--                                        <div class="slide"></div>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="tab-content p-2 mb-0">
                            <div class="tab-pane active" id="area-tab1" role="tabpanel">
                                <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                                    <div class="table-responsive">
                                        <table id="table-category-material-data" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>@lang('app.group-material.catergory-group-material.table.stt')</th>
                                                    <th>@lang('app.group-material.catergory-group-material.table.name')</th>
                                                    <th>@lang('app.group-material.catergory-group-material.table.note')</th>
                                                    <th>@lang('app.group-material.catergory-group-material.table.date')</th>
                                                    <th></th>
                                                    <th class="d-none"></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
{{--                            <div class="tab-pane" id="area-tab2" role="tabpanel">--}}
{{--                                <div class="col-sm-12 col-md-12 col-xl-12 p-0">--}}
{{--                                    <div class="table-responsive">--}}
{{--                                        <table id="table-disable-area-data" class="table table-bordered">--}}
{{--                                            <thead>--}}
{{--                                                <tr>--}}
{{--                                                    <th>@lang('app.area-data.stt-table')</th>--}}
{{--                                                    <th>@lang('app.area-data.name-table')</th>--}}
{{--                                                    <th>@lang('app.area-data.table-number')</th>--}}
{{--                                                    <th>@lang('app.area-data.function-table')</th>--}}
{{--                                                    <th class="d-none"></th>--}}
{{--                                                </tr>--}}
{{--                                            </thead>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-none">
        <span id="msg-title-status-area">@lang('app.area-data.title-status')</span>
        <span id="msg-content-status-area">@lang('app.area-data.content-status')</span>
        <span id="msg-success-status-area">@lang('app.area-data.success-status')</span>
    </div>

    <div id="mySidenav-321" class="sidenav">
        <a href="javascript:void(0)" id="button-service-2" class="bg-primary" onclick="openModalCreateCategoryMaterial()" style="width: max-content"><i
                class="fa fa-plus-square"></i>&emsp; @lang('app.component.button.create')</a> <br>
    </div>
    @include('build_data.group_material.category_group_material.create')
    @include('build_data.group_material.category_group_material.update')

@endsection
@push('scripts')
    @include('layouts.oldDatatable')
    <script type="text/javascript" src="{{asset('js/build_data/group_material/category_group_material/index.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

