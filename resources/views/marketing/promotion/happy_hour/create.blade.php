<div class="modal fade" id="modal-create-happy-hour-promotion" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tạo gói khuyến mãi</h4>
            </div>
            <div class="modal-body" id="loading-modal-create-happy-hour-promotion">
                <div class="card card-block">
                    <div class="form-group validate-group col-lg-12 px-0">
                        <div class="form-validate-input">
                            <input type="text" id="discount-create-happy-hour-promotion" class="form-control"
                                   data-percent="1" value="0" >
                            <label for="discount-create-happy-hour-promotion">Chiết khấu</label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group select2_theme validate-group">
                        <div class="form-validate-select ">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 pr-0 select-material-box">
                                    <select id="condition-create-happy-hour-promotion"
                                            class="js-example-tags col-sm-12 select2-hidden-accessible" multiple=""
                                            tabindex="-1" aria-hidden="true"></select>
                                    <label>
                                        <i class="typcn typcn-document-text"></i>Nhập điều kiện </label>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew" onclick="reloadModalCreateHappyHourPromotion()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>

                <button type="button" class="btn btn-grd-disabled" onclick="closeModalCreateHappyHourPromotion()"
                        onkeypress="closeModalCreateHappyHourPromotion()">@lang('app.component.button.close')
                </button>
                <button type="button" class="btn btn-primary" onclick="saveModalCreateHappyHourPromotion()"
                        onkeypress="saveModalCreateHappyHourPromotion()">@lang('app.component.button.save')
                </button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/marketing/promotion/happy_hour/create.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
