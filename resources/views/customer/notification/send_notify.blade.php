<div class="modal fade" id="modal-send-notification-customer" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.notification.send.title')</h4>
            </div>
            <div class="modal-body text-left">
                <div class="row d-flex">
                    <div class="col-lg-12 edit-flex-auto-fill">
                        <div class="card-block w-100 my-0">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="row">
                                        <div class="custom-box-logo w-75 mx-auto position-relative">
                                            <img class="user-img img-radius" id="thumbnail-upload-img-send-notification-customer" src="{{ asset('/images/cover.jpg')}}" style="object-fit: cover;" data-link="" />
                                            <input type="file" class="d-none" id="upload-img-send-notification-customer" accept="image/*" />
                                            <label class="btn-image-upload mx-auto my-2 birthday-btn-absolute" for="upload-img-send-notification-customer" data-toggle="tooltip" data-placement="right" data-original-title="Chọn ảnh">
                                                <i class="icofont icofont-camera"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-lg-7">
                                        <div class="form-group row">
                                            <label class="col-12 col-form-label font-weight-bold"> @lang('app.notification.send.customers')</label>

                                            <div class="col-12">
                                                <div class="row form-radio pl-3" id="restaurant-membership-card-id-send-cuddtomer">
                                                    <form>
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" value="-1" checked name="restaurant-membership-card-type" />
                                                                <i class="helper"></i>@lang('app.notification.send.send-all')
                                                            </label>
                                                        </div>
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" value="1" name="restaurant-membership-card-type" />
                                                                <i class="helper"></i>@lang('app.notification.send.send-to-a-specified-object')
                                                            </label>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row d-none" id="select-restaurant-membership-card-id" >
                                            <label class="col-sm-3 col-form-label"> @lang('app.notification.send.please-chose')</label>
                                            <div class="col-sm-9 input-group">
                                                <select id="restaurant-membership-card-id" class="" multiple data-icon="icofont-options">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-grd-disabled" onclick="closeSendNotificationCustomer()" onkeypress="closeSendNotificationCustomer()">
                        @lang('app.component.button.close')
                    </button>
                    <button type="button" class="btn btn-grd-primary" id="btn-send-notification-customer">
                        @lang('app.notification.button.send')
                    </button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script type="text/javascript" src="{{asset('js/customer/notification/send_notify.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    @endpush
</div>
