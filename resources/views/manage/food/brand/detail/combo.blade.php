<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal-detail-combo-food-brand-manage">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" id="content-modal">
            <div id="detail">
                <div class="modal-header">
                        <h4 class="modal-title py-2">@lang('app.food-brand-manage.detail.title')</h4>
                        <button type="button" class="close ml-4" onclick="closeModalDetailComboFoodBrandManage()" onkeypress="closeModalDetailComboFoodBrandManage()">
                            <i class="fi-rr-cross"></i>
                        </button>
                </div>
                <div class="modal-body text-left" id="loading-modal-detail-combo-food-brand-manage">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs md-tabs md-6-tabs" role="tablist">
                                <li class="nav-item">
                                    <a id="detail-info-food-manage" class="nav-link active" data-toggle="tab" onclick="openModalDetailComboFoodInfo()" href="javascript:void(0)" role="tab" aria-expanded="true">
                                        @lang('app.booking-table-manage.detail.title-left')
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="detail-list-food-combo-food-manage" class="nav-link" data-toggle="tab" onclick="openModalDetailFoodInCombo()" href="javascript:void(0)" role="tab" aria-expanded="true">
                                        @lang('app.food-brand-manage.detail.list-food-combo')
                                        <span class="label label-success" id="total-record-combo-food-brand-manage">0</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="detail-price-by-area-food-manage" class="nav-link" data-toggle="tab" onclick="openModalDetailComboFoodPriceArea()" href="javascript:void(0)" role="tab" aria-expanded="true">
                                        @lang('app.food-brand-manage.detail.list-price-area')
                                        <span class="label label-warning" id="total-record-price-by-area">0</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="card-block card pt-0 m-0">
                                <div class="tab-content">
                                    <div id="info-detail-combo-food-brand-manage" role="tabpanel">
                                        <div class="card-block col-xl-12 col-md-12">
                                            <div class="user-card-full">
                                                <div class="row m-l-0 m-r-0">
                                                    <div class="col-lg-3 user-profile d-flex justify-content-center align-items-center" id="color-detail-combo-employee-manage">
                                                        <div class="card-block text-center text-white">
                                                            <div class="m-b-25">
                                                                <img onerror="imageDefaultOnLoadError($(this))" src="{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}" id="avatar-detail-combo-food-brand-manage" src="" class="img-data-detail" style="height: 14rem; border-radius: 50%;width: 14rem !important;"/>
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
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-combo-employee-manage" id="name-detail-combo-food-brand-manage">---</h6>
                                                                </div>

                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.code')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-combo-employee-manage" id="code-detail-combo-food-brand-manage">---</h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.unit')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-combo-employee-manage" id="unit-detail-combo-food-brand-manage">---</h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.category')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-combo-employee-manage" id="category-detail-combo-food-brand-manage">---</h6>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.type-food')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-combo-employee-manage" id="type-food-detail-combo-food-brand-manage">---</h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.print-order')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-combo-employee-manage" id="print-detail-combo-food-brand-manage">---</h6>
                                                                </div>
{{--                                                                <div class="col-sm-3">--}}
{{--                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.bbq')</p>--}}
{{--                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-combo-employee-manage" id="bbq-detail-combo-food-brand-manage">---</h6>--}}
{{--                                                                </div>--}}
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.sell-by')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-combo-employee-manage" id="sell-by-detail-combo-food-brand-manage">---</h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.take-away')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-combo-employee-manage" id="take-away-detail-combo-food-brand-manage">---</h6>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.time-complete')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-combo-employee-manage" id="time-detail-combo-food-brand-manage">---</h6>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.description')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-combo-employee-manage word-break-datatable" id="descript-detail-combo-food-brand-manage">---</h6>
                                                                </div>
                                                            </div>
                                                            <h6 class="sub-title m-b-0 f-w-600 col-form-label-fz-15 pt-3">
                                                                @lang('app.food-brand-manage.detail.food-price')
                                                            </h6>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.original-price')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-combo-employee-manage" id="original-price-detail-combo-food-brand-manage">---</h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.price')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-combo-employee-manage" id="price-detail-combo-food-brand-manage">---</h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.vat')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-combo-employee-manage" id="vat-detail-combo-food-brand-manage">---</h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.profit')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-combo-employee-manage" id="profit-detail-combo-food-brand-manage">---</h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.profit-rate-by-original-price')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-combo-employee-manage" id="profit-rate-by-original-price-detail-combo-food-brand-manage">---</h6>
                                                                </div><div class="col-sm-3">
                                                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.profit-rate-by-price')</p>
                                                                    <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-combo-employee-manage" id="profit-rate-by-price-detail-combo-food-brand-manage">---</h6>
                                                                </div>
                                                            </div>

                                                            @if(Session::get(SESSION_KEY_LEVEL) >= 8)
                                                                <h6 class="sub-title m-b-0 f-w-600 col-form-label-fz-15 pt-3">
                                                                    @lang('app.food-brand-manage.detail.food-aloline')
                                                                </h6>
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.allow-point-purchase')</p>
                                                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-combo-employee-manage" id="allow-point-purchase-detail-combo-food-brand-manage">---</h6>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.point')</p>
                                                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-combo-employee-manage" id="point-detail-combo-food-brand-manage">---</h6>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.review')</p>
                                                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-combo-employee-manage" id="review-detail-combo-food-brand-manage">---</h6>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-brand-manage.detail.point-to-purchase')</p>
                                                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-combo-employee-manage" id="point-to-purchase-detail-combo-food-brand-manage">---</h6>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="table-food-combo-food-brand-manage" class="d-none" role="tabpanel">
                                        <div class="table-responsive new-table">
                                            <table class="table table-bordered" id="table-foods-in-combo-detail-combo-food-brand-manage">
                                                <thead>
                                                <tr>
                                                    <th>@lang('app.food-brand-manage.detail.stt')</th>
                                                    <th style="color: transparent;"></th>
                                                    <th>@lang('app.food-brand-manage.detail.table-name')</th>
                                                    <th>@lang('app.food-brand-manage.detail.table-quantity')</th>
                                                    <th></th>
                                                    <th class="d-none"></th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="price-area-detail-combo-food-branch-manage" class="d-none" role="tabpanel">
                                        <div class="table-responsive new-table">
                                            <table class="table table-bordered" id="table-price-area-detail-combo-food-branch-manage">
                                                <thead>
                                                <tr>
                                                    <th>@lang('app.food-brand-manage.detail.name-area')</th>
                                                    <th>@lang('app.food-brand-manage.detail.amount-area')</th>
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
                    <button id="btn-return-detail" type="button" class="btn btn-info waves-effect d-none" onclick="returnFirtDetail()" title="@lang('app.component.title-button.close')">Quay lại</button>


                 </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/food/brand/detail/combo.js?version=7',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
