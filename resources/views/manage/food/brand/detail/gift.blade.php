<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal-detail-gift-food-brand-manage">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" id="content-modal">
            <div id="detail">
                quà tặng
                <div class="modal-header">
                    <div class="col-lg-3">
                        <h4 class="modal-title py-2">@lang('app.food-brand-manage.detail.title')</h4>
                    </div>
                    <div class="col-lg-9">
                        <div class="d-flex align-items-center justify-content-end" id="group-btn-detail-gift-food-brand-manage">
                            <button type="button" id="detail-fund-period-treasurer-info" class="btn btn-grd-disabled active ml-2 mr-2" onclick="openModalDetailFundPeriodTreasurerInfo()">
                                @lang('app.booking-table-manage.detail.title-left')
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-body text-left" id="loading-modal-detail-gift-food-brand-manage">
                    <div class="row">
                        <div class="col-lg-12" >
                            <div class="card-block">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="supplier-manage-tab0" role="tabpanel">
                                        <div class="card-block col-xl-12 col-md-12">
                                            <div class="user-card-full">
                                                <div class="row m-l-0 m-r-0">
                                                    <div class="col-lg-4 col-md-6 col-12 user-profile d-flex justify-content-center align-items-center" id="color-detail-gift-employee-manage">
                                                        <div class="card-block text-center text-white">
                                                            <div class="m-b-25 block-img-employee">
                                                                <img onerror="imageDefaultOnLoadError($(this))" src="{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}" id="avatar-detail-gift-food-brand-manage" src="" class="img-data-detail-gift" style="object-fit:cover;"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="card-block">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <p class="m-b-10 f-w-600">@lang('app.food-brand-manage.detail.name')</p>
                                                                    <h6 class="text-muted f-w-400 reset-data-detail-gift-employee-manage"
                                                                        id="name-detail-gift-food-brand-manage"></h6>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <p class="m-b-10 f-w-600">@lang('app.food-brand-manage.detail.price')</p>
                                                                    <h6 class="text-muted f-w-400 reset-data-detail-gift-employee-manage"
                                                                        id="price-detail-gift-food-brand-manage"></h6>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <p class="m-b-10 f-w-600">@lang('app.food-brand-manage.detail.code')</p>
                                                                    <h6 class="text-muted f-w-400 reset-data-detail-gift-employee-manage"
                                                                        id="code-detail-gift-food-brand-manage"></h6>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <p class="m-b-10 f-w-600">@lang('app.food-brand-manage.detail.category')</p>
                                                                    <h6 class="text-muted f-w-400 reset-data-detail-gift-employee-manage"
                                                                        id="category-detail-gift-food-brand-manage"></h6>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <p class="m-b-10 f-w-600">@lang('app.food-brand-manage.detail.type-food')</p>
                                                                    <h6 class="text-muted f-w-400 reset-data-detail-gift-employee-manage"
                                                                        id="type-food-detail-gift-food-brand-manage"></h6>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <p class="m-b-10 f-w-600">@lang('app.food-brand-manage.detail.take-away')</p>
                                                                    <h6 class="text-muted f-w-400 reset-data-detail-gift-employee-manage"
                                                                        id="take-away-detail-gift-food-brand-manage"></h6>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <p class="m-b-10 f-w-600">@lang('app.food-brand-manage.detail.time-complete')</p>
                                                                    <h6 class="text-muted f-w-400 reset-data-detail-gift-employee-manage"
                                                                        id="time-detail-gift-food-brand-manage"></h6>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <p class="m-b-10 f-w-600">@lang('app.food-brand-manage.detail.bbq')</p>
                                                                    <h6 class="text-muted f-w-400 reset-data-detail-gift-employee-manage"
                                                                        id="bbq-detail-gift-food-brand-manage"></h6>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <p class="m-b-10 f-w-600">@lang('app.food-brand-manage.detail.unit')</p>
                                                                    <h6 class="text-muted f-w-400 reset-data-detail-gift-employee-manage"
                                                                        id="unit-detail-gift-food-brand-manage"></h6>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <p class="m-b-10 f-w-600">@lang('app.food-brand-manage.detail.sell-by')</p>
                                                                    <h6 class="text-muted f-w-400 reset-data-detail-gift-employee-manage"
                                                                        id="sell-by-detail-gift-food-brand-manage"></h6>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <p class="m-b-10 f-w-600">@lang('app.food-brand-manage.detail.print-order')</p>
                                                                    <h6 class="text-muted f-w-400 reset-data-detail-gift-employee-manage"
                                                                        id="print-detail-gift-food-brand-manage"></h6>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <p class="m-b-10 f-w-600">@lang('app.food-brand-manage.detail.review')</p>
                                                                    <h6 class="text-muted f-w-400 reset-data-detail-gift-employee-manage"
                                                                        id="review-detail-gift-food-brand-manage" ></h6>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <p class="m-b-10 f-w-600">@lang('app.food-brand-manage.detail.allow-point-purchase')</p>
                                                                    <h6 class="text-muted f-w-400 reset-data-detail-gift-employee-manage"
                                                                        id="point-to-purchase-detail-gift-food-brand-manage"></h6>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <p class="m-b-10 f-w-600">@lang('app.food-brand-manage.detail.point')</p>
                                                                    <h6 class="text-muted f-w-400 reset-data-detail-gift-employee-manage"
                                                                        id="point-detail-gift-food-brand-manage" ></h6>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <p class="m-b-10 f-w-600">@lang('app.food-brand-manage.detail.description')</p>
                                                                    <h6 class="text-muted f-w-400 reset-data-detail-gift-employee-manage"
                                                                        id="descript-detail-gift-food-brand-manage"></h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="supplier-manage-tab1" role="tabpanel">
                                        {{--  table addition  --}}
                                        <div class="col-12" >
                                            <table class="table table-bordered" id="table-addition-detail-gift-food-brand-manage">
                                                <thead>
                                                <tr>
                                                    <th>@lang('app.food-brand-manage.detail.stt')</th>
                                                    <th>@lang('app.food-brand-manage.detail.table-name')</th>
                                                    <th>@lang('app.food-brand-manage.detail.table-action')</th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="supplier-manage-tab2" role="tabpanel">
                                        {{--  table quantity  --}}
                                        <div class="col-12">
                                            <table class="table table-bordered" id="table-quantity-detail-gift-food-brand-manage">
                                                <thead>
                                                <tr>
                                                    <th>@lang('app.food-brand-manage.detail.list-quantity.stt')</th>
                                                    <th>@lang('app.food-brand-manage.detail.list-quantity.name')</th>
                                                    <th>@lang('app.food-brand-manage.detail.list-quantity.quantity')</th>
                                                    <th>@lang('app.food-brand-manage.detail.list-quantity.unit')</th>
                                                    <th>@lang('app.food-brand-manage.detail.list-quantity.material_category_name')</th>
                                                    <th>@lang('app.food-brand-manage.detail.list-quantity.price')</th>
                                                    <th>@lang('app.food-brand-manage.detail.list-quantity.total')</th>
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
                <div class="modal-footer">
                    <button id="btn-return-detail-gift" type="button" class="btn btn-info waves-effect d-none" onclick="returnFirtDetail()" title="@lang('app.component.title-button.close')">Quay lại</button>
                    <button type="button" class="btn btn-grd-disabled" onclick="()" title="@lang('app.component.title-button.close')">@lang('app.component.button.close')</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/food/brand/detail/gift.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
