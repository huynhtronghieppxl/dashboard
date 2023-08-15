<div class="modal fade" id="modal-detail-price-adjustment" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.price-adjustment-data.detail.title')</h4>
                <h5 id="label-status-price-adjustment-detail mx-auto"></h5>
                <button type="button" class="close" onclick="closeModalDetailPriceAdjustment()" onkeypress="closeModalDetailPriceAdjustment()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left pb-0" id="loading-detail-price-adjustment">
                <div class="row m-0">
                    <div class="col-8 edit-flex-auto-fill pl-0">
                        <div class="card card-block flex-sub m-0">
                            <h5 class="sub-title ml-0">@lang('app.price-adjustment-data.create.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-detail-price-adjustment">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.price-adjustment-data.detail.stt')</th>
                                        <th>@lang('app.price-adjustment-data.detail.name')</th>
                                        <th>@lang('app.price-adjustment-data.detail.original-price')</th>
                                        <th>@lang('app.price-adjustment-data.detail.difference')</th>
                                        <th>@lang('app.price-adjustment-data.detail.price')</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 edit-flex-auto-fill p-0">
                        <div class="card card-block flex-sub m-0" id="info-detail-price-adjustment">
                            <h5 class="sub-title">@lang('app.price-adjustment-data.create.title-right')</h5>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="pb-2 f-w-600 col-form-label-fz-15">@lang('app.price-adjustment-data.detail.restaurant_brand')</p>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400 "
                                        id="branch-detail-price-adjustment"></h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="pb-2 f-w-600 col-form-label-fz-15">@lang('app.price-adjustment-data.detail.code')</p>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400 "
                                        id="code-detail-price-adjustment"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="pb-2 f-w-600 col-form-label-fz-15">@lang('app.price-adjustment-data.detail.total')</p>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400 "
                                        id="total-detail-price-adjustment"></h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="pb-2 f-w-600 col-form-label-fz-15">@lang('app.price-adjustment-data.detail.employee')</p>
                                    <h6 class="col-form-label-fz-15 class-link f-w-400 "
                                        id="employee-detail-price-adjustment"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="pb-2 f-w-600 col-form-label-fz-15">@lang('app.price-adjustment-data.detail.created')</p>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400 "
                                        id="created-detail-price-adjustment">{{date('d/m/Y')}}</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="pb-2 f-w-600 col-form-label-fz-15">@lang('app.price-adjustment-data.detail.updated')</p>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400 "
                                        id="updated-detail-price-adjustment">{{date('d/m/Y')}}</h6>
                                </div>
                            </div>
                            <div class="row border-dashed pb-2 mb-1 d-none" id="cancel-detail-price-adjustment-div">
                                <div class="col-sm-6">
                                    <p class="pb-2 f-w-600 col-form-label-fz-15">@lang('app.price-adjustment-data.detail.cancel')</p>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400 "
                                        id="cancel-detail-price-adjustment"></h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="pb-2 f-w-600 col-form-label-fz-15">@lang('app.price-adjustment-data.detail.employee-cancel')</p>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400 "
                                        id="employee-cancel-detail-price-adjustment"></h6>
                                </div>
                            </div>
                            <div class="row border-dashed pb-2 mb-1 d-none" id="confirmed-detail-price-adjustment-div">
                                <div class="col-sm-6">
                                    <p class="pb-2 f-w-600 col-form-label-fz-15">@lang('app.price-adjustment-data.detail.apply')</p>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400 "
                                        id="apply-detail-price-adjustment"></h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="pb-2 f-w-600 col-form-label-fz-15">@lang('app.price-adjustment-data.detail.employee-apply')</p>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400 "
                                        id="employee-apply-detail-price-adjustment"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="pb-2 f-w-600 col-form-label-fz-15">@lang('app.price-adjustment-data.detail.note')</p>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400 "
                                        id="note-detail-price-adjustment"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
</div>
@include('manage.food.brand.detail')
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/business/price_adjustment/detail.js?version=4', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
