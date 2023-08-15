<div class="modal fade" id="modal-detail-happy-hour-promotion-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.happy-hour-promotion.detail.title')</h4>
            </div>
            <div class="modal-body background-body-color py-1" id="loading-modal-detail-customer-happy-hour-promotion">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-block">
                            <div class="form-group">
                                <label type="text" id="note-detail-happy-hour-promotion"></label>
                            </div>
                            <div class="row" id="list-img-detail-customer-happy-hour-promotion">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled" onclick="closeModalDetailHappyHourPromotion()"
                        onkeypress="closeModalDetailHappyHourPromotion()">
                    @lang('app.component.button.close')
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/marketing/promotion/happy_hour/detail.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
