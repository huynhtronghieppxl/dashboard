<div class="modal fade" id="modal-create-reasons-cancel-food-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.reasons-cancel-food.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateReasonsCancelFoodData()" onkeypress="closeModalCreateReasonsCancelFoodData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-create-reasons-cancel-food-data">
                <div class="row">
                    <div class="card-block card m-0 col-lg-12">
                        <div class="form-group validate-group">
                            <div class="form-validate-textarea">
                                <div class="form__group pt-2">
                                    <textarea class="form__field" id="content-create-reasons-cancel-food-data" rows="5" cols="5" data-note-max-length="50" data-note="1"></textarea>
                                    <label for="content-create-reasons-cancel-food-data" class="form__label icon-validate">
                                        @lang('app.reasons-cancel-food.breadcrumb')
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="textarea-character" id="char-count">
                                    <span>0/300</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none"
                        onclick="resetModalCreateReasonsCancelFoodData()" data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại"
                        onkeypress="resetModalCreateReasonsCancelFoodData()">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveCreateReasonsCancelFoodData()" onkeypress="saveCreateReasonsCancelFoodData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\business\reasons_cancel_food\create.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
