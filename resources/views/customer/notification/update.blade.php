<div class="modal fade" id="modal-update-notification-customer" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.notification.update.title')</h4>
            </div>
            <div class="modal-body text-left">
                <div class="row d-flex">
                    <div class="col-lg-12 edit-flex-auto-fill">
                        <div class="card-block w-100 my-0">
                            <div class="form-group row">
                                <label class="col-sm-3"> @lang('app.notification.update.form-title')</label>
                                <div class="col-sm-9">
                                    <input id="title-update-notification-customer" class="form-control" type="text" data-validate="empty,max-length-255" data-icon=" icofont-tag" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <label class="m-b-10 col-form-label font-weight-bold my-auto">
                                        @lang('app.notification.create.content')
                                    </label>
                                </div>
                                <div class="col-lg-9">
                                    <textarea class="form-control" id="content-update-notification-customer" cols="5" rows="5" data-validate="note"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled" onclick="closeUpdateNotificationCustomer()" onkeypress="closeUpdateNotificationCustomer()">
                    @lang('app.component.button.close')
                </button>
                <button type="button" class="btn btn-grd-primary" onclick="saveModalUpdateNotificationCustomer()" onkeypress="saveModalUpdateNotificationCustomer()" id="btn-save-modal-update-notification-customer">
                    @lang('app.component.button.save')
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/customer/notification/update.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
