<div class="modal fade seemt-main-content" data-keyboard="false" data-backdrop="static" id="modal-detail-food-brand-manage">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" id="content-modal">
            <div id="detail">
                <div class="modal-header">
                    <h4 class="modal-title py-2">@lang('app.food-brand-manage.detail.title')</h4>
                    <button type="button" class="close" onclick="closeModalDetailFoodManage()" onkeypress="closeModalDetailFoodManage()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
                <div class="modal-body text-left" id="loading-modal-detail-food-brand-manage">
{{--                    <div class="row">--}}
{{--                        <div class="col-lg-12">--}}
                            <ul class="nav nav-tabs md-tabs md-8-tabs" role="tablist">
                                <li class="nav-item">
                                    <a id="detail-info-food-branch-manager" class="nav-link active" data-toggle="tab" onclick="openModalDetailFoodInfo()" href="javascript:void(0)" role="tab" aria-expanded="true">
                                        @lang('app.booking-table-manage.detail.title-left')
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="detail-list-addition-food-branch-manager" class="nav-link" data-toggle="tab" onclick="openModalDetailFoodAddition()" href="javascript:void(0)" role="tab" aria-expanded="true">
                                        @lang('app.food-brand-manage.detail.list-addition')
                                        <span class="label label-info" id="total-record-tab1">0</span>
                                    </a>
                                </li>
                                @if(( Session::get(SESSION_KEY_LEVEL) > 3))
                                    <li class="nav-item">
                                        <a id="detail-list-quantity-food-branch-manager" class="nav-link" data-toggle="tab" onclick="openModalDetailFoodQuantity()" href="javascript:void(0)" role="tab" aria-expanded="true">
                                            @lang('app.food-brand-manage.detail.list-quantity.title')
                                            <span class="label label-warning" id="total-record-tab2">0</span>
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a id="detail-price-by-area-food-branch-manager" class="nav-link" data-toggle="tab" onclick="openModalDetailFoodPriceArea()" href="javascript:void(0)" role="tab" aria-expanded="true">
                                        @lang('app.food-branch-manage.price-by-area-branch-manager')
                                        <span class="label label-success" id="total-record-tab4">0</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="card-block card m-0">
                                <div class="tab-content">
                                    <div id="info-detail-food-brand-manage" role="tabpanel">
                                        <div class="    col-xl-12 col-md-12 ">
                                            <div class="user-card-full">
                                                <div class="row m-l-0 m-r-0 align-items-center">
                                                    <div
                                                        class="col-lg-3 user-profile d-flex justify-content-center align-items-center"
                                                        id="color-detail-employee-manage">
                                                        <div class="card-block text-center text-white p-0">
                                                            <div class="m-b-25">
                                                                <img onerror="imageDefaultOnLoadError($(this))" src="{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}" id="avatar-detail-food-brand-manage" src="" class="img-data-detail" style="height: 14rem; border-radius: 50%;width: 14rem !important;"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <div class="mx-4">
                                                            <h6 class="sub-title m-b-0 f-w-600 col-form-label-fz-15">
                                                                @lang('app.food-brand-manage.detail.food-info')
                                                            </h6>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.name')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                                                        id="name-detail-food-brand-manage">---</h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.code')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                                                        id="code-detail-food-brand-manage">---</h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.unit')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                                                        id="unit-detail-food-brand-manage">---</h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.category')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                                                        id="category-detail-food-brand-manage">---</h6>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.type-food')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                                                        id="type-food-detail-food-brand-manage">---</h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.print-order')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                                                        id="print-detail-food-brand-manage">---</h6>
                                                                </div>
{{--                                                                <div class="col-sm-3">--}}
{{--                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.bbq')</p>--}}
{{--                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"--}}
{{--                                                                        id="bbq-detail-food-brand-manage">---</h6>--}}
{{--                                                                </div>--}}
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.take-away')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                                                        id="take-away-detail-food-brand-manage">---</h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.sell-by')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                                                        id="sell-by-detail-food-brand-manage">---</h6>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.time-complete')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                                                        id="time-detail-food-brand-manage">---</h6>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.description')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15 word-break-datatable"
                                                                        id="descript-detail-food-brand-manage">---</h6>
                                                                </div>
                                                            </div>
                                                            <h6 class="sub-title m-b-0 f-w-600 col-form-label-fz-15 pt-3">
                                                                @lang('app.food-brand-manage.detail.food-price')
                                                            </h6>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.original-price')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                                                        id="orginal-price-detail-food-brand-manage">---</h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.price')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                                                        id="price-detail-food-brand-manage">---</h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.vat')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                                                        id="vat-detail-food-brand-manage">---</h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.profit')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                                                        id="profit-price-detail-food-brand-manage">---</h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.profit-rate-by-original-price')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                                                        id="profit-rate-by-original-price-detail-food-brand-manage">---</h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.profit-rate-by-price')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                                                        id="profit-rate-by-price-detail-food-brand-manage">---</h6>
                                                                </div>
                                                            </div>
                                                            @if(Session::get(SESSION_KEY_LEVEL) >= 8)
                                                                <h6 class="sub-title m-b-0 f-w-600 col-form-label-fz-15 pt-3">
                                                                    @lang('app.food-brand-manage.detail.food-aloline')
                                                                </h6>
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.allow-point-purchase')</p>
                                                                        <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                                                            id="allow-point-purchase-detail-food-brand-manage">---</h6>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.point')</p>
                                                                        <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                                                            id="point-detail-food-brand-manage">---</h6>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.review')</p>
                                                                        <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                                                            id="review-detail-food-brand-manage">---</h6>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.point-to-purchase')</p>
                                                                        <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                                                            id="point-to-purchase-detail-food-brand-manage">---</h6>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="addtion-detail-food-brand-manage" class="d-none" role="tabpanel">
                                        <div class="table-responsive new-table">
                                            <table class="table table-bordered" id="table-addition-detail-food-brand-manage">
                                                <thead>
                                                <tr>
                                                    <th>@lang('app.food-brand-manage.detail.stt')</th>
                                                    <th>@lang('app.food-brand-manage.detail.table-name')</th>
                                                    <th>@lang('app.food-brand-manage.detail.table-price')</th>
                                                    <th></th>
                                                    <th class="d-none"></th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="quantity-detail-food-brand-manage" class="d-none" role="tabpanel">
                                        <div class="table-responsive new-table">
                                            <table class="table table-bordered" id="table-quantity-detail-food-brand-manage">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2">@lang('app.food-brand-manage.detail.list-quantity.stt')</th>
                                                        <th rowspan="2">@lang('app.food-brand-manage.detail.list-quantity.name')</th>
                                                        <th rowspan="2">@lang('app.food-brand-manage.detail.list-quantity.material_category_name')</th>
                                                        <th rowspan="2">@lang('app.food-brand-manage.detail.list-quantity.unit-order')</th>
                                                        <th rowspan="2">@lang('app.food-brand-manage.detail.list-quantity.price')</th>
                                                        <th rowspan="2">@lang('app.food-brand-manage.detail.list-quantity.quantity') </th>
                                                        <th rowspan="2">@lang('app.food-brand-manage.detail.list-quantity.total') </th>
                                                        <th rowspan="2">@lang('app.food-brand-manage.detail.list-quantity.loss')</th>
                                                        <th class="text-right">@lang('app.food-brand-manage.detail.list-quantity.total_vat')<br/>(Đã bao gồm hao hụt)</th>
                                                        <th rowspan="2"></th>
                                                        <th class="d-none" rowspan="2"></th>
                                                    </tr>
                                                    <tr>
                                                        <th id="total-amount-loss-included-detail-food-brand-manage" class="seemt-fz-14">0</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="price-area-detail-food-branch-manage" class="d-none" role="tabpanel">
                                    <div class="table-responsive new-table">
                                        <table class="table table-bordered" id="table-price-area-detail-food-branch-manage">
                                            <thead>
                                            <tr>
                                                <th style="color: transparent;">@lang('app.food-manage.update-area.title-left')</th>
                                                <th>@lang('app.food-manage.update-area.name')</th>
                                                <th>@lang('app.food-manage.update-area.amount')</th>
                                                <th style="color: transparent;">@lang('app.food-manage.update-area.title-right')</th>
                                                <th class="d-none"></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn-return-detail" type="button" class="btn btn-info waves-effect d-none"
                        onclick="returnFirtDetail()" title="">Quay lại
                </button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/food/brand/detail/food.js?version=12',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
