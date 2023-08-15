@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row d-flex">
                <div class="edit-flex-auto-fill col-sm-6 pr-0" id="body-list-food-data">
                    <div class="card flex-sub p-0">
                        <div class="card-block p-b-0" style="padding: 20px 20px 0;">
                            <h5 class="sub-title mt-0 mx-0"
                                style="padding-bottom: 12px; margin-bottom: 10px;">@lang('app.food-data.gift.title-left')</h5>
                        </div>
                        <div class="card-block p-t-0" style="padding: 20px 20px 8px 20px">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand select-brand-gift-food">
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
                                    <div class="form-validate-select" style="width: 152px !important;">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single"
                                                    data-validate="" id="select-category-gift-food-brand-manage">
                                                <option value="" disabled selected
                                                        hidden>@lang('app.component.option-null')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table id="table-food-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.food-data.gift.table.name')</th>
                                        <th>@lang('app.food-data.gift.table.category')</th>
                                        <th class=""></th>
                                        <th>
                                            {{--                                            <i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right pointer"--}}
                                            {{--                                               onclick="checkAllFoodGiftData($(this))"></i>--}}
                                            <div class="btn-group btn-group-sm">
                                                <button type="button"
                                                        class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                        onclick="checkAllFoodGiftData($(this))"><i
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
                <div class="edit-flex-auto-fill col-sm-6" id="body-list-food-gift-data">
                    <div class="card flex-sub p-0">
                        <div class="card-block p-b-0" style="padding: 20px 20px 0;">
                            <h5 class="sub-title mt-0 mx-0"
                                style="padding-bottom: 12px; margin-bottom: 10px;">@lang('app.food-data.gift.title-right')</h5>
                        </div>
                        <div class="card-block p-t-0" style="padding: 20px 20px 8px 20px" id="body-brand-supplier-data">
                            <div class="table-responsive new-table">
                                <table id="table-gift-food-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>
                                            {{--                                            <i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right pointer"--}}
                                            {{--                                               onclick="unCheckAllFoodGiftData($(this))"></i>--}}
                                            <div class="btn-group btn-group-sm">
                                                <button type="button"
                                                        class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                        onclick="unCheckAllFoodGiftData($(this))"><i
                                                            class="fi-rr-arrow-small-left"></i></button>
                                            </div>
                                        </th>
                                        <th>@lang('app.food-data.gift.table.name')</th>
                                        <th>@lang('app.food-data.gift.table.category')</th>
                                        <th class=""></th>
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
            src="{{ asset('js\build_data\food\gift\index.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
