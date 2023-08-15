<div class="modal fade" id="modal-update-after-payment-campaign-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.message.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateCustomerMessage()" onkeypress="closeModalUpdateCustomerMessage()" fdprocessedid="mobvaa">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-update-after-payment-campaign-data">
                <div class="card card-block">
                    <div class="form-group validate-group">
                        <div class="form-validate-textarea">
                            <div class="form__group pt-2">
                                <textarea id="content-update-after-payment-campaign-data" class="form__field" rows="5" cols="5" data-note-max-length="500"></textarea>
                                <label for="des-update-material-data" class="form__label icon-validate"> @lang('app.message.update.content')</label>
                                <div class="textarea-character" id="char-count">
                                    <span>0/500</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row align-items-center col-lg-12">
                        <label class="font-weight-bold seemt-fz-14">@lang('app.message.update.add-target'): </label>
                        <div class="col-lg-12 row">
                            <div class="col-lg-4">
                                <button type="button"
                                        class="btn seemt-orange seemt-bg-orange seemt-btn-hover-orange seemt-fz-14 w-100"
                                        onMouseOver="this.style.background='#f9a236'; this.style.transform='scale(1.1)'"
                                        onMouseOut="this.style.background='#fff'; this.style.transform='scale(1)'"
                                        onclick="appendUpdateRestaurantName()">@lang('app.message.update.name-restaurant-company')
                                </button>
                            </div>
                            <div class="col-lg-4">
                                <button type="button"
                                        class="btn seemt-orange seemt-bg-orange seemt-btn-hover-orange seemt-fz-14 w-100"
                                        onMouseOver="this.style.background='#f9a236'; this.style.transform='scale(1.1)'"
                                        onMouseOut="this.style.background='#fff'; this.style.transform='scale(1)'"
                                        onclick="appendUpdateCustomerName()">@lang('app.message.update.name-customer')
                                </button>
                            </div>
                            <div class="col-lg-4" id="div-update-greeting-restaurant">
                                <button type="button"
                                        class="btn seemt-orange seemt-bg-orange seemt-btn-hover-orange seemt-fz-14 w-100"
                                        onMouseOver="this.style.background='#f9a236'; this.style.transform='scale(1.1)'"
                                        onMouseOut="this.style.background='#fff'; this.style.transform='scale(1)'"
                                        onclick="appendUpdateBranchName()">@lang('app.message.update.name-branch')
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mt-3 align-items-center">
                        <div class="col-lg-12">
                            <span class="cursor-pointer" onclick="openModalUpdateMoreInformation()"
                                  style="font-style: italic; color: #095a9b">@lang('app.message.update.learn-more')</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalUpdateCustomerMessageData()"
                        onkeypress="saveModalUpdateCustomerMessageData()">
                        <i class="fi-rr-disk"></i>
                        <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-update-more-information" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.message.update.more.more-information')</h4>
                <button type="button" class="close" onclick="closeModalUpdateMoreInformation()" onkeypress="closeModalUpdateMoreInformation()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-update-more-information">
                <div class="card card-block">
                    <div class="form-group row">
                        <label class="col-lg-3 font-weight-bold">@lang('app.message.update.more.message-syntax')</label>
                        <div class="col-lg-9">
                            <span>@lang('app.message.update.text.group')  <b style="font-style: italic">@lang('app.message.update.text.branch-syntax')</b> @lang('app.message.update.text.thanks-message') <b
                                    style="font-style: italic">@lang('app.message.update.text.customer-syntax')</b> @lang('app.message.update.text.message-content-1') <b
                                    style="font-style: italic">@lang('app.message.update.text.branch-syntax')</b> @lang('app.message.update.text.message-content-2')</span>
                            <br>
                            <br>
                            <span>@lang('app.message.update.text.thanks-message-1')  <b style="font-style: italic">@lang('app.message.update.text.customer-syntax')</b> @lang('app.message.update.text.message-content-3')</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 font-weight-bold">@lang('app.message.update.more.message-results')</label>
                        <div class="col-lg-9">
                            <span>@lang('app.message.update.text.group') <b
                                    style="font-style: italic">@lang('app.message.update.text.my-branch-syntax')</b> @lang('app.message.update.text.thanks-message') <b
                                    style="font-style: italic">@lang('app.message.update.text.customer-name')</b> @lang('app.message.update.text.message-content-1') <b
                                    style="font-style: italic">@lang('app.message.update.text.my-branch-syntax')</b> @lang('app.message.update.text.message-content-2')</span>
                            <br>
                            <br>
                            <span>@lang('app.message.update.text.thanks-message-1')  <b style="font-style: italic">@lang('app.message.update.text.customer-name')</b> @lang('app.message.update.text.message-content-3')</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/marketing/campaign/after_payment/update.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
