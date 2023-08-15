<div class="modal fade" id="modal-update-customer-message-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.message.update.title')</h4>
            </div>
            <div class="modal-body" id="loading-modal-update-customer-message-data">
                <div class="card-block">
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label
                                class="m-b-10 col-form-label font-weight-bold my-auto">@lang('app.message.update.content')</label>
                        </div>
                        <div class="col-lg-9">
                            <textarea class="w-100" id="content-update-customer-message-data" data-validate="note"
                                      cols="15" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 font-weight-bold"></label>
                        <div class="col-lg-9 d-flex">
                            <div class="col-4">
                                <button type="button"
                                        class="btn btn-grd-disabled border-radius-20"
                                        onclick="append_update_restaurant_name()">@lang('app.message.update.name-restaurant-company')
                                </button>
                            </div>
                            <div class="col-4" id="div-update-greeting-restaurant">
                                <button type="button"
                                        class="btn btn-grd-disabled border-radius-20"
                                        onclick="append_update_branch_name()">@lang('app.message.update.name-branch')
                                </button>
                            </div>
                            <div class="col-4">
                                <button type="button"
                                        class="btn btn-grd-disabled border-radius-20"
                                        onclick="append_update_customer_name()">@lang('app.message.update.name-customer')
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <div class="col-lg-12">
                            <span class="cursor-pointer font-italic" onclick="open_modal_update_more_information()"
                                  style="color: #095a9b">@lang('app.message.update.learn-more')</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled" onclick="closeModalUpdateCustomerMessage()"
                        onkeypress="closeModalUpdateCustomerMessage()">
                    @lang('app.component.button.close')
                </button>
                <button type="button" class="btn btn-grd-primary" onclick="saveModalUpdateCustomerMessageData()"
                        onkeypress="saveModalUpdateCustomerMessageData()">
                    @lang('app.component.button.save')
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-update-more-information" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.message.update.more.more-information')</h4>
            </div>
            <div class="modal-body" id="loading-modal-update-more-information">
                <div class="card-block">
                    <div class="form-group row">
                        <label class="col-lg-3 font-weight-bold">@lang('app.message.update.more.message-syntax')</label>
                        <div class="col-lg-9">
                            <span>@lang('app.message.update.text.group')  <b class="font-italic">@lang('app.message.update.text.branch-syntax')</b> @lang('app.message.update.text.thanks-message') <b
                                    class="font-italic">@lang('app.message.update.text.customer-syntax')</b> @lang('app.message.update.text.message-content-1') <b
                                    class="font-italic">@lang('app.message.update.text.branch-syntax')</b> @lang('app.message.update.text.message-content-2')</span>
                            <br>
                            <br>
                            <span>@lang('app.message.update.text.thanks-message-1')  <b class="font-italic">@lang('app.message.update.text.customer-syntax')</b> @lang('app.message.update.text.message-content-3')</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 font-weight-bold">@lang('app.message.update.more.message-results')</label>
                        <div class="col-lg-9">
                            <span>@lang('app.message.update.text.group') <b
                                    class="font-italic">@lang('app.message.update.text.my-branch-syntax')</b> @lang('app.message.update.text.thanks-message') <b
                                    class="font-italic">@lang('app.message.update.text.customer-name')</b> @lang('app.message.update.text.message-content-1') <b
                                    class="font-italic">@lang('app.message.update.text.my-branch-syntax')</b> @lang('app.message.update.text.message-content-2')</span>
                            <br>
                            <br>
                            <span>@lang('app.message.update.text.thanks-message-1')  <b class="font-italic">@lang('app.message.update.text.customer-name')</b> @lang('app.message.update.text.message-content-3')</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled" onclick="close_modal_update_more_information()">
                    @lang('app.component.button.close')
                </button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/customer/message/update.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
