<div class="modal fade" id="modal-create-notification-customer" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.notification.create.title')</h4>
            </div>
            <div class="modal-body text-left">
                <div class="row d-flex">
                    <div class="col-lg-12 edit-flex-auto-fill">
                        <div class="card-block w-100 my-0">
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input id="title-create-notification-customer" class="form-control" data-validate="empty,max-length-255">
                                    <label for="title-create-notification-customer">
                                        <i class="icofont icofont-tag"></i> @lang('app.notification.create.form-title') <span class="text-danger">(*)</span>
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <label class="m-b-10 col-form-label font-weight-bold my-auto">
                                        @lang('app.notification.create.content')
                                    </label>
                                </div>
                                <div class="col-lg-9">
                                    <textarea class="form-control" id="content-create-notification-customer" cols="5" rows="5" data-validate="note"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled" onclick="closeCreateNotificationCustomer()" onkeypress="closeCreateNotificationCustomer()">
                    @lang('app.component.button.close')
                </button>
                <button type="button" class="btn btn-grd-primary" onclick="saveModalCreateNotificationCustomer()" onkeypress="saveModalCreateNotificationCustomer()" id="btn-save-modal-create-notification-customer">
                    @lang('app.component.button.save')
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/customer/notification/create.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
