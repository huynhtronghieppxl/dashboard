<div class="modal fade" id="modal-detail-card-tag" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.card-tag.detail.title')</h4>
                <button type="button" class="close" onclick="closeModalDetailCardTag()" onkeypress="closeModalDetailCardTag()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left background-body-color" id="loading-modal-detail-card-tag">
                <div id="body-detail-in-inventory-manage">
                    <div class="row d-flex">
                        <div class="col-lg-8 edit-flex-auto-fill">
                            <div class="card card-block w-100 mr-0">
                                <h5 class="text-bold sub-title">@lang('app.card-tag.detail.title-left')</h5>
                                <div class="table-responsive new-table">
                                    <table id="table-customer-detail-in-card-tag"
                                           class="table">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.card-tag.detail.customer.stt')</th>
                                            <th>@lang('app.card-tag.detail.customer.name-customer')</th>
                                            <th>@lang('app.card-tag.detail.customer.gender-customer')</th>
                                            <th>@lang('app.card-tag.detail.customer.phone-customer')</th>
                                            <th class="d-none"></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 edit-flex-auto-fill px-0">
                            <div class="flex-sub card card-block" id="boxlist-detail-card-tag">
                                <h5 class="text-bold sub-title">@lang('app.card-tag.detail.title-right')</h5>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label">@lang('app.card-tag.detail.name')</label>
                                        <h6 class="col-form-label-fz-15 text-muted f-w-400" id="name-detail-card-tag"></h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label">@lang('app.card-tag.detail.color')</label>
                                        <h6 class="col-form-label-fz-15 text-muted f-w-400 position-relative" id="color-detail-card-tag"></h6>
                                    </div>
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
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/customer/card_tag/detail.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
