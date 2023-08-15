<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal-detail-addtion-food-brand-manage">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" id="content-modal">
            <div id="detail">
                <div class="modal-header">
                    <h4 class="modal-title py-2">@lang('app.food-brand-manage.detail.title')</h4>
                    <button type="button" class="close ml-4" onclick="closeModalDetailAddtionFoodBrandManage()" onkeypress="closeModalDetailAddtionFoodBrandManage()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
                <div class="modal-body text-left" id="loading-modal-detail-addtion-food-brand-manage">
                    <ul class="nav nav-tabs md-tabs md-6-tabs" role="tablist">
                        @if(( Session::get(SESSION_KEY_LEVEL) > 3))
                            <li class="nav-item">
                                <a id="detail-addtion-food-brand-manage-info" class="nav-link active"
                                   data-toggle="tab" onclick="openModalDetailAddtionFoodInfo()"
                                   href="javascript:void(0)" role="tab" aria-expanded="true">
                                    @lang('app.booking-table-manage.detail.title-left')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="detail-addtion-food-brand-manage-quantitative" class="nav-link"
                                   data-toggle="tab" onclick="openModalDetailAddtionFoodQuantity()"
                                   href="javascript:void(0)" role="tab" aria-expanded="true">
                                    @lang('app.food-brand-manage.detail.list-quantity.title')
                                    <span class="label label-warning" id="total-addtion-record-tab2">0</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                    <div class="card m-0">
                        <div class="card-block tab-content">
                            <div id="info-detail-addtion-food-brand-manage" role="tabpanel">
                                <div class="card-block">
                                    <div class="user-card-full">
                                        <div class="row m-l-0 m-r-0 align-items-center ">
                                            <div
                                                class="col-lg-3 user-profile d-flex justify-content-center align-items-center"
                                                id="color-detail-addtion-employee-manage">
                                                <div class="card-block text-center text-white">
                                                    <div class="m-b-25">
                                                        <img onerror="imageDefaultOnLoadError($(this))"
                                                             id="avatar-detail-addtion-food-brand-manage"
                                                             src="{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}" class="img-data-detail"
                                                             style="height: 14rem; border-radius: 50%;width: 14rem !important;"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="card-block">
                                                    <h6 class="sub-title m-b-0 f-w-600 col-form-label-fz-15">
                                                        @lang('app.food-brand-manage.detail.food-info')
                                                    </h6>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.name')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-addtion-employee-manage"
                                                                id="name-detail-addtion-food-brand-manage"></h6>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.code')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-addtion-employee-manage"
                                                                id="code-detail-addtion-food-brand-manage"></h6>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.unit')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-addtion-employee-manage"
                                                                id="unit-detail-addtion-food-brand-manage"></h6>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.category')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-addtion-employee-manage"
                                                                id="category-detail-addtion-food-brand-manage"></h6>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.type-food')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-addtion-employee-manage"
                                                                id="type-food-detail-addtion-food-brand-manage"></h6>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.print-order')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-addtion-employee-manage"
                                                                id="print-detail-addtion-food-brand-manage"></h6>
                                                        </div>
{{--                                                        <div class="col-sm-3">--}}
{{--                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.bbq')</p>--}}
{{--                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-addtion-employee-manage"--}}
{{--                                                                id="bbq-detail-addtion-food-brand-manage"></h6>--}}
{{--                                                        </div>--}}
                                                        <div class="col-sm-3">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.sell-by')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-addtion-employee-manage"
                                                                id="sell-by-detail-addtion-food-brand-manage"></h6>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.take-away')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-addtion-employee-manage"
                                                                id="take-away-detail-addtion-food-brand-manage"></h6>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.time-complete')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-addtion-employee-manage"
                                                                id="time-detail-addtion-food-brand-manage"></h6>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.like-food')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-addtion-employee-manage"
                                                                id="like-food-detail-addtion-food-brand-manage"></h6>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.description')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 word-break-datatable reset-data-detail-addtion-employee-manage"
                                                                id="descript-detail-addtion-food-brand-manage"></h6>
                                                        </div>
                                                    </div>
                                                    <h6 class="sub-title m-b-0 f-w-600 col-form-label-fz-15 pt-3">
                                                        @lang('app.food-brand-manage.detail.food-price')
                                                    </h6>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.original-price')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-addtion-employee-manage"
                                                                id="original-price-detail-addtion-food-brand-manage">
                                                                </h6>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.price')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-addtion-employee-manage"
                                                                id="price-detail-addtion-food-brand-manage"></h6>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.vat')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-addtion-employee-manage"
                                                                id="vat-detail-addtion-food-brand-manage"></h6>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.profit')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-addtion-employee-manage"
                                                                id="profit-price-detail-addtion-food-brand-manage">
                                                                </h6>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.profit-rate-by-original-price')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-addtion-employee-manage"
                                                                id="profit-rate-by-original-price-detail-addtion-food-brand-manage">
                                                                </h6>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.profit-rate-by-price')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-addtion-employee-manage"
                                                                id="profit-rate-by-price-detail-addtion-food-brand-manage">
                                                                </h6>
                                                        </div>
                                                    </div>
                                                    @if( Session::get(SESSION_KEY_LEVEL) >= 8)
                                                        <h6 class="sub-title m-b-0 f-w-600 col-form-label-fz-15 pt-3">
                                                            @lang('app.food-brand-manage.detail.food-aloline')
                                                        </h6>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.allow-point-purchase')</p>
                                                                <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-addtion-employee-manage"
                                                                    id="allow-point-purchase-detail-addtion-food-brand-manage">
                                                                    </h6>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.point')</p>
                                                                <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-addtion-employee-manage"
                                                                    id="point-detail-addtion-food-brand-manage"></h6>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.review')</p>
                                                                <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-addtion-employee-manage"
                                                                    id="review-detail-addtion-food-brand-manage">
                                                                    </h6>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.point-to-purchase')</p>
                                                                <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-addtion-employee-manage"
                                                                    id="point-to-purchase-detail-addtion-food-brand-manage">
                                                                    </h6>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="quantitative-detail-addtion-food-brand-manage" class="d-none" role="tabpanel">
                                <div class="table-responsive new-table">
                                    <table class="table table-bordered"
                                           id="table-quantitative-detail-addtion-food-brand-manage">
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
                                            <th id="total-amount-quantity-material-food-brand-manage" class="seemt-fz-16">0</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn-return-detail" type="button" class="btn btn-info waves-effect d-none"
                            onclick="returnFirtDetail()">Quay lại
                    </button>
{{--                    <button type="button" class="btn btn-grd-disabled"--}}
{{--                            onclick="closeModalDetailAddtionFoodBrandManage()">@lang('app.component.button.close')</button>--}}

                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/food/brand/detail/addtion.js?version=8',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
