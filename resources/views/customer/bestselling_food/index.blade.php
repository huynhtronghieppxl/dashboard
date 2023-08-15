@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row d-flex">
                <div class="edit-flex-auto-fill col-sm-6 pr-2">
                    <div class="card flex-sub pr-0">
                        <div class="card-block p-b-0">
                            <h5 class="sub-title">@lang('app.bestselling-food-customer.title-left')</h5>
                        </div>
                        <div class="card-block p-t-0">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand">
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
                                            <select class="js-example-basic-single select-branch">
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
                                <table id="table-all-bestselling-food-customer" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.bestselling-food-customer.name')</th>
                                        <th>@lang('app.bestselling-food-customer.amount')</th>
                                        <th></th>
                                        <th>
                                            {{--                                            <i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right pointer" onclick="checkAllBestSellingFoodCustomer()"></i>--}}
                                            <div class="btn-group btn-group-sm">
                                                <button type="button"
                                                        class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                        onclick="checkAllBestSellingFoodCustomer($(this))"><i
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
                <div class="edit-flex-auto-fill col-sm-6 pl-2">
                    <div class="card flex-sub pr-0">
                        <div class="card-block p-b-0">
                            <h5 class="sub-title">@lang('app.bestselling-food-customer.title-right')</h5>
                        </div>
                        <div class="card-block p-t-0">
                            <div class="table-responsive new-table">
                                <table id="table-selected-bestselling-food-customer" class="table">
                                    <thead>
                                    <tr>
                                        <th>
                                            {{--                                                <i class="fa fa-2x fa-arrow-circle-left btn-convert-right-to-left pointer" onclick="unCheckAllBestSellingFoodCustomer()"></i>--}}
                                            <div class="btn-group btn-group-sm">
                                                <button type="button"
                                                        class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                        onclick="unCheckAllBestSellingFoodCustomer($(this))"><i
                                                            class="fi-rr-arrow-small-left"></i></button>
                                            </div>
                                        </th>
                                        <th>@lang('app.bestselling-food-customer.name')</th>
                                        <th>@lang('app.bestselling-food-customer.amount')</th>
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
    @include('manage.food.brand.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js/customer/bestselling_food/index.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{ asset('js/template_custom/validate/func.js?version=2', env('IS_DEPLOY_ON_SERVER')) }}"></script>
@endpush
