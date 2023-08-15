<div class="modal fade" id="modal-detail-happy-time-promotion-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.happy-time-promotion.detail.title')</h4>
            </div>
            <div class="modal-body py-1" id="loading-modal-detail-customer-happy-time-promotion">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-block">
                            <div class="row">
                                <div class="col-3">
                                    <p class="m-b-10 f-w-600 col-form-lable-fz-15">@lang('app.happy-time-promotion.detail.name')</p>
                                    <h6 class="text-muted f-w-400 col-form-lable-fz-15 reset-data-detail-payment-bill"
                                        id="name-detail-happy-time-promotion">---</h6>
                                </div>
                                <div class="col-3">
                                    <p class="m-b-10 f-w-600 col-form-lable-fz-15">@lang('app.happy-time-promotion.detail.employee_create')</p>
                                    <h6 class="text-muted f-w-400 col-form-lable-fz-15 reset-data-detail-payment-bill"
                                        id="employee-create-detail-happy-time-promotion">---</h6>
                                </div>
                                <div class="col-3">
                                    <p class="m-b-10 f-w-600 col-form-lable-fz-15">@lang('app.happy-time-promotion.detail.short-description')</p>
                                    <h6 class="text-muted f-w-400 col-form-lable-fz-15 reset-data-detail-payment-bill"
                                        id="short-description-detail-happy-time-promotion">---</h6>
                                </div>
                                <div class="col-3">
                                    <p class="m-b-10 f-w-600 col-form-lable-fz-15">@lang('app.happy-time-promotion.detail.type')</p>
                                    <h6 class="text-muted f-w-400 col-form-lable-fz-15 reset-data-detail-payment-bill"
                                        id="type-detail-happy-time-promotion">---</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <p class="m-b-10 f-w-600 col-form-lable-fz-15">@lang('app.happy-time-promotion.detail.from-hour')</p>
                                    <h6 class="text-muted f-w-400 col-form-lable-fz-15 reset-data-detail-payment-bill"
                                        id="from-hour-detail-happy-time-promotion">---</h6>
                                </div>

                                <div class="col-3">
                                    <p class="m-b-10 f-w-600 col-form-lable-fz-15">@lang('app.happy-time-promotion.detail.to-hour')</p>
                                    <h6 class="text-muted f-w-400 col-form-lable-fz-15 reset-data-detail-payment-bill"
                                        id="to-hour-detail-happy-time-promotion">---</h6>
                                </div>
                                <div class="col-3">
                                    <p class="m-b-10 f-w-600 col-form-lable-fz-15">@lang('app.happy-time-promotion.detail.description')</p>
                                    <h6 class="text-muted f-w-400 col-form-lable-fz-15 reset-data-detail-payment-bill"
                                        id="description-detail-happy-time-promotion">---</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <p class="m-b-10 f-w-600 col-form-lable-fz-15">@lang('app.happy-time-promotion.detail.from-date')</p>
                                    <h6 class="text-muted f-w-400 col-form-lable-fz-15 reset-data-detail-payment-bill"
                                        id="from-date-detail-happy-time-promotion">---</h6>
                                </div>
                                <div class="col-3">
                                    <p class="m-b-10 f-w-600 col-form-lable-fz-15">@lang('app.happy-time-promotion.detail.to-date')</p>
                                    <h6 class="text-muted f-w-400 col-form-lable-fz-15 reset-data-detail-payment-bill"
                                        id="to-date-detail-happy-time-promotion">---</h6>
                                </div>
                                <div class="col-3">
                                    <p class="m-b-10 f-w-600 col-form-lable-fz-15">@lang('app.happy-time-promotion.detail.day-of-week')</p>
                                    <h6 class="text-muted f-w-400 col-form-lable-fz-15 reset-data-detail-payment-bill"
                                        id="discount-detail-happy-time-promotion">---</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <p class="m-b-10 f-w-600 col-form-lable-fz-15">@lang('app.happy-time-promotion.detail.min-order-total')</p>
                                    <h6 class="text-muted f-w-400 col-form-lable-fz-15 reset-data-detail-payment-bill"
                                        id="min-order-total-detail-happy-time-promotion">---</h6>
                                </div>
                                <div class="col-3">
                                    <p class="m-b-10 f-w-600 col-form-lable-fz-15">@lang('app.happy-time-promotion.detail.max-promotion')</p>
                                    <h6 class="text-muted f-w-400 col-form-lable-fz-15 reset-data-detail-payment-bill"
                                        id="max-promotion-detail-happy-time-promotion">---</h6>
                                </div>
                                <div class="col-3">
                                    <p class="m-b-10 f-w-600 col-form-lable-fz-15">@lang('app.happy-time-promotion.detail.discount')</p>
                                    <h6 class="text-muted f-w-400 col-form-lable-fz-15 reset-data-detail-payment-bill"
                                        id="max-promotion-detail-happy-time-promotion">---</h6>
                                </div>
                            </div>
                            <div class="row" id="list-img-detail-customer-happy-time-promotion">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled" onclick="closeModalDetailHappyTimePromotion()"
                        onkeypress="closeModalDetailHappyTimePromotion()">
                    @lang('app.component.button.close')
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/marketing/promotion/happy_time/detail.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
