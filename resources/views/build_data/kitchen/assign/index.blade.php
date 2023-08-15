@extends('layouts.layout')
@section('content')
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row">
                    <div class="col-lg-4 d-flex">
                        <div class="card card-block flex-sub">
                            <h4 class="sub-title f-w-600">@lang('app.food-manage.change-kitchen.title-right')</h4>
                            <div class="form-group select2_theme validate-group m-t-10">
                                <div class="form-validate-select ">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="current-kitchen-food-manage"
                                                    class="js-example-basic-single select2-hidden-accessible">
                                                <option value="">@lang('app.component.option_default')</option>
                                            </select>
                                            <label>
                                                @lang('app.food-manage.change-kitchen.current-kitchen')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="target-kitchen-food-manage"
                                                    class="js-example-basic-single select2-hidden-accessible">
                                                <option value="">@lang('app.component.option_default')</option>
                                            </select>
                                            <label>
                                                @lang('app.food-manage.change-kitchen.target-kitchen')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group row">
                                <div class=" col-lg-12 form-group checkbox-group">
                                    <label class="title-checkbox">@lang('app.food-manage.change-kitchen.type')</label>
                                    <div class="row" id="type-kitchen-food-manage">
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" name="type" value="0" checked/>
                                                <label class="name-checkbox"
                                                       for="print-kitchen-create-food-brand-manage">  @lang('app.food-manage.change-kitchen.false')
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" name="type" value="1">
                                                <label class="name-checkbox"
                                                       for="print-kitchen-create-food-brand-manage">   @lang('app.food-manage.change-kitchen.true')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label id="type-false-kitchen-employee-manage"
                                       class="font-italic font-weight-bold text-warning">@lang('app.food-manage.change-kitchen.type-false')</label>
                                <label id="type-true-kitchen-employee-manage"
                                       class="d-none font-italic font-weight-bold text-warning">@lang('app.food-manage.change-kitchen.type-true')</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 d-flex">
                        <div class="card card-block flex-sub">
                            <h4 class="sub-title f-w-600">@lang('app.food-manage.change-kitchen.title-left')</h4>
                            <div class="table-responsive new-table m-t-10">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand">
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
                                <table class="table" id="table-kitchen-food-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.food-manage.change-kitchen.stt')</th>
                                        <th>
                                            <div class="form-validate-checkbox p-0 m-0">
                                                <div class="checkbox-form-group">
                                                    <input type="checkbox"
                                                           onclick="checkAllChangeKitchenFoodManage($(this))"
                                                           id="check-all-kitchen-food-manage">
                                                </div>
                                            </div>
                                        </th>
                                        <th>@lang('app.food-manage.change-kitchen.name')</th>
                                        <th>@lang('app.food-manage.change-kitchen.category')</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page-body start -->
        </div>
    </div>
    @include('build_data.kitchen.assign.notify')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/kitchen/assign/index.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
