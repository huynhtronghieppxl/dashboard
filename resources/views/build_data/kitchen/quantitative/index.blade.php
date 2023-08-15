@extends('layouts.layout')
@section('content')
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row d-flex">
                    <div class="edit-flex-auto-fill col-sm-9">
                        <div class="card card-block flex-sub"
                             data-title="@lang('app.quantitative-data-ver2.select-quantitative-food')"
                             data-intro="@lang('app.quantitative-data-ver2.add-quantitative-food')" data-step="2">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand select-brand-quantitative-data">
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
                                    <div class="form-validate-select" data-intro="Chọn món ăn muốn định lượng"
                                         data-step="1">
                                        <div class="pr-0 select-material-box">
                                            <select style="width: 168px" class="js-example-basic-single select2-hidden-accessible"
                                                    data-select="1" id="select-food">
                                                <option value="" disabled
                                                        selected>@lang('app.quantitative-data.select-form-food')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-validate-select" data-intro="Chọn định lượng cho món ăn"
                                         data-step="2">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select2-hidden-accessible"
                                                    id="select-material-food">
                                                <option value="" disabled
                                                        selected>@lang('app.quantitative-data.select-form-material')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table class="table" id="table-detail-material"
                                       data-intro="Nhập số lượng nguyên liệu cho món ăn" data-step="3">
                                    <thead>
                                    <tr>
                                        <th style="width: 8%">@lang('app.quantitative-data-ver2.stt')</th>
                                        <th>@lang('app.quantitative-data-ver2.name-material-table')</th>
                                        <th>@lang('app.quantitative-data-ver2.value-material-table')</th>
                                        <th>@lang('app.quantitative-data-ver2.unit-material-table')</th>
                                        <th>@lang('app.quantitative-data-ver2.price-material-table')</th>
                                        <th>@lang('app.quantitative-data-ver2.total-amount-material-table')
                                        </th>
                                        <th>% Hao hụt</th>
                                        <th>@lang('app.quantitative-data-ver2.total-amount-material-table')<br>(Đã bao
                                            gồm hao hụt)
                                        </th>
                                        <th style="width: 5%"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <!-- Alert card end -->
                    </div>
                    <div class="edit-flex-auto-fill col-sm-3 pl-0" data-intro="Chi tiết món ăn" data-step="4">
                        <div class="card card-block ml-2 flex-sub pl-4" id="loading-food-quantitative-v2"
                             data-title="@lang('app.quantitative-data-ver2.select-food')">
                            <h5 class="sub-title m-0 mb-3">@lang('app.quantitative-data.title')</h5>
                            <div class="form-group row flex-column">
                                <div class="m-b-10 pl-3 f-w-600 col-form-label-fz-15">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.quantitative-data-ver2.food.avatar')</p>
                                </div>
                                <div class="profile-thumb pb-3 w-100 text-center">
                                    <img id="avatar-food-in-quantitative" class="profile-image-avatar" alt=""
                                         onerror="imageDefaultOnLoadError($(this))"
                                         style="border: 3px solid #c1c1c1;width: 9rem;height: 9rem"
                                         src="{{asset('images/food_file.jpg')}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.quantitative-data-ver2.food.name')</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="name-food-in-quantitative">
                                        ---</h6>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.quantitative-data-ver2.food.unit')</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="unit-food">---</h6>
                                </div>
                                <div class="col-lg-6">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.quantitative-data-ver2.food.category')</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="category-food">---</h6>
                                </div>
                            </div>
                            <div class="form-group row border-dashed">
                                <div class="col-lg-6">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.quantitative-data-ver2.food.original-price')</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                        id="price-original-food">0</h6>
                                </div>
                                <div class="col-lg-6">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.quantitative-data-ver2.price-label')</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                        id="price-food">0</h6>
                                </div>
                            </div>
                            <div class="form-group row pt-3">
                                <label class="pl-3">
                                    <span
                                            class="m-b-10 pr-2 f-w-600 col-form-label-fz-15">@lang('app.quantitative-data-ver2.revenu')</span>
                                    <label
                                            class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                            id="revenu-food">0</label>
                                </label>
                            </div>
                            <div class="row py-2 justify-content-end">
                                <div id="save-table-quantitative" type="button"
                                     class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue d-flex align-items-center"
                                     onclick="saveTableQuantitative()" onkeypress="saveTableQuantitative()">
                                    <i class="fi-rr-disk"></i>
                                    <span> @lang('app.quantitative-data-ver2.btn-save')</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page-body start -->
        </div>
    </div>
    <div class="d-none">
        <span class="processing">@lang('app.food_data.mess.processing')</span>
        <span class="branch">@lang('app.food_data.mess.branch')</span>
        <span class="food">@lang('app.food_data.mess.food')</span>
        <span class="category_food">@lang('app.food_data.mess.category_food')</span>
        <span class="time_cooking">@lang('app.food_data.mess.time_cooking')</span>
        <span class="last_price">@lang('app.food_data.mess.last_price')</span>
        <span class="price">@lang('app.food_data.mess.price')</span>
        <span class="unit">@lang('app.food_data.mess.unit')</span>
        <span class="use_point">@lang('app.food_data.mess.use_point')</span>
        <span class="notify_0">@lang('app.food_data.mess.notify_0')</span>
        <span class="notify_1">@lang('app.food_data.mess.notify_1')</span>
        <span class="notify_10">@lang('app.food_data.mess.notify_10')</span>
        <span class="notify_1m">@lang('app.food_data.mess.notify_1m')</span>
        <span class="notify_100m">@lang('app.food_data.mess.notify_100m')</span>
        <span class="max_image">@lang('app.food_data.mess.max_image')</span>
        <span class="pic_picked">@lang('app.food_data.mess.pic_picked')</span>
        <span class="description">@lang('app.food_data.mess.description')</span>
        <span class="supplier">@lang('app.food_data.mess.supplier')</span>
        <span class="text_unit">@lang('app.food_data.mess.option_unit')</span>
        <span class="text_supplier">@lang('app.food_data.mess.option_supplier')</span>
        <span class="text_category">@lang('app.food_data.mess.option_category')</span>
    </div>
    @include('build_data.kitchen.quantitative.import_excel')
    @include('build_data.kitchen.quantitative.detail')
    @include('build_data.kitchen.quantitative.guide')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/kitchen/quantitative/index.js?version=9', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
