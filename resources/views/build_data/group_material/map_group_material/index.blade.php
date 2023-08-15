@extends('layouts.layout')

@section('content')
    <div class="page-wrapper">
        {{--<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Nguyên liệu thương hiệu</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="/"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('build_data.group-material.map-material-data')}}">Nguyên liệu thương hiệu</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>--}}
        <div class="page-body">
            <div class="row d-flex">
                <div class="edit-flex-auto-fill col-sm-6 pr-0">
                    <div class="card card-block flex-sub pr-0">
                        <div class="card-block p-b-0">
                            <div class="row">
                                <h5 class="col-lg-7 sub-title mx-0">@lang('app.group-material.map-material-data.title-left')</h5>
                                {{-- <div class="col-lg-4 pr-0">
                                    <select id="select-supplier-brand-data" class="js-example-basic-single"></select>
                                </div> --}}
                            </div>
                        </div>
                        <div class="card-block p-t-0">
                            <div class="table-responsive">
                                <table id="table-not-map-group-material-data" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.group-material.map-material-data.table-restaurant.name')</th>
                                        <th>@lang('app.group-material.map-material-data.table-restaurant.supplier')</th>
                                        <th>@lang('app.group-material.map-material-data.table-restaurant.add')</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="edit-flex-auto-fill col-sm-6">
                    <div class="card card-block flex-sub">
                        <div class="card-block p-b-0 row">
                            <div class="col-lg-4">
                                <h5 class="sub-title mx-0">@lang('app.group-material.map-material-data.title-right')</h5>
                            </div>
                            <div class="col-lg-4">
                                <select id="select-category-map-group-material-data" class="js-example-basic-single">
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-primary waves-effect float-right mx-1"
                                        onclick="saveMapmaterialGroup()">@lang('app.component.button.update')</button>
                            </div>
                        </div>
                        <div class="card-block p-t-0">
                            <div class="table-responsive">
                                <table id="table-map-material-data" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>@lang('app.group-material.map-material-data.table-brand.remove')</th>
                                            <th>@lang('app.group-material.map-material-data.table-brand.name')</th>
                                            <th>@lang('app.group-material.map-material-data.table-brand.supplier')</th>
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
@endsection

@push('scripts')
    @include('layouts.oldDatatable')
    <script type="text/javascript" src="{{ asset('js\build_data\group_material\map_group_material\index.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
