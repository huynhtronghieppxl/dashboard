@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">

            <div class="row d-flex">
                <div class="edit-flex-auto-fill col-sm-6 pr-0">
                    <div class="card flex-sub">
                        <div style="height:40px ">
                        </div>
                        <div class="p-b-0">
                            <h5 class="sub-title mb-2 ml-0">@lang('app.price-by-area-data.title-left')</h5>
                        </div>
                        <div class="">
                            <div class="table-responsive new-table">
                                <table id="table-branch-food" class="table">
                                    <thead>
                                    <tr>
                                        <th class="">@lang('app.price-by-area-data.name')</th>
                                        <th>@lang('app.price-by-area-data.category')</th>
                                        <th class="d-none">@lang('app.price-by-area-data.price')</th>
                                        <th>@lang('app.price-by-area-data.price')</th>
                                        <th>
                                            <div class="btn-group btn-group-sm" style="margin-right: 3px !important;">
                                                <button type="button"
                                                        class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                        onclick="checkAllBranchFoodData($(this))"><i
                                                            class="fi-rr-arrow-small-right"></i></button>
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
                <div class="edit-flex-auto-fill col-sm-6" id="body-price-by-area-data">
                    <div class="card flex-sub">
                        <div style="margin-bottom: 8px !important;">
                            <div class="row">
                                <div class="col-sm-12 d-flex justify-content-end align-items-center table-responsive new-table"
                                     style="overflow: hidden !important;">
                                    <div class="select-filter-dataTable d-flex" style="position: unset">
                                        <div class="form-validate-select">
                                            <div class="pr-0 select-material-box">
                                                <select class="js-example-basic-single select-brand category-work-data">
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
                                                <select class="js-example-basic-single select-branch">
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="p-b-0">
                            <h5 class="sub-title mb-2 ml-0">@lang('app.price-by-area-data.title-right')</h5>
                        </div>
                        <div class="table-responsive new-table">
                            <div id="select-filter-dataTable-select-area" class="select-filter-dataTable"
                                 style="right: 0 !important;">
                                <div class="form-validate-select" style="width: 120px !important;">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single" id="select-area-table-build-data">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="table-price-by-area-data" class="table">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="btn-group btn-group-sm">
                                            <button type="button"
                                                    class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                    onclick="unCheckAllBranchFoodData($(this))"><i
                                                        class="fi-rr-arrow-small-left"></i></button>
                                        </div>
                                    </th>
                                    <th class="text-left">@lang('app.price-by-area-data.name')</th>
                                    <th>@lang('app.price-by-area-data.category')</th>
                                    <th>@lang('app.price-by-area-data.price')</th>
                                    <th>@lang('app.price-by-area-data.amount')</th>
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
    @include('manage.food.brand.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\build_data\business\price_by_area\index.js?version=7', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
