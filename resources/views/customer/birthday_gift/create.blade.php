<div class="modal fade" id="modal-create-birthday-gift" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.birthday-gift.create.title-left')</h4>
                <button type="button" class="close" onclick="closeModalCreateBirthdayGift()" onkeypress="closeModalCreateBirthdayGift()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-create-birthday-gift">
                <div class="row">
                    <div class="col-lg-4 edit-flex-auto-fill pr-1">
                        <div class="flex-sub card-block my-2">
                            <h6 class="b-b-default font-weight-bold pb-3 mb-3">@lang('app.birthday-gift.create.image')</h6>
                            <div class="custom-box-logo w-75 mx-auto position-relative">
                                <img class="user-img img-radius" id="thumbnail-create-birthday-gift-logo" src="{{ asset('/images/cover.jpg')}}" style="object-fit: cover;" data-link="">
                                <input type="file" class="d-none" id="upload-create-birthday-logo" accept="image/*">
                                <label class="btn-image-upload mx-auto my-2 birthday-btn-absolute" for="upload-create-birthday-logo" data-toggle="tooltip" data-placement="right" data-original-title="Chọn ảnh"><i class="icofont icofont-camera"></i></label>
                            </div>
                            <br>
                            <h6 class="b-b-default font-weight-bold pb-3 mb-3">@lang('app.birthday-gift.create.icon')</h6>
                            <div id="icon-create-birthday-gift"></div>
                        </div>
                    </div>
                    <div class="col-xl-8 edit-flex-auto-fill pl-1">
                        <div class="flex-sub  card-block my-2">
                            <h6 class="b-b-default font-weight-bold pb-3 mb-3">@lang('app.birthday-gift.create.info')</h6>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">@lang('app.birthday-gift.create.title')</label>
                                <div class="col-sm-9">
                                    <input id="title-create-birthday-gift" class="form-control" data-validate="empty,max-length-255" data-icon="icofont-tag" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">@lang('app.birthday-gift.create.message')</label>
                                <div class="col-sm-9">
                                    <input id="message-create-birthday-gift" class="form-control" data-validate="empty,max-length-255" data-icon="icofont-ui-message" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <label class="m-b-10 col-form-label font-weight-bold my-auto">@lang('app.birthday-gift.create.content')</label>
                                </div>
                                <div class="col-lg-9">
                                                <textarea class="w-100" id="content-create-birthday-gift" data-validate="note"
                                                          cols="5"
                                                          rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select ">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="item-create-birthday-gift" class="select-not-select2 select2-hidden-accessible" data-validate="select, empty" multiple="" tabindex="-1" aria-hidden="true"></select>
                                            <label class="icon-validate"><i class="icofont icofont-gift"></i>@lang('app.birthday-gift.create.item')</label>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" id="submit-img" onclick="saveModalCreateBirthdayGift()"
                     onkeypress="saveModalCreateBirthdayGift()">
                    <i class="fi-rr-document"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-none">
    <span id="msg-branch-create-birthday-gift">@lang('app.birthday-gift.create.msg-branch')</span>
    <span id="msg-title-create-birthday-gift">@lang('app.birthday-gift.create.msg-title')</span>
    <span id="msg-content-create-birthday-gift">@lang('app.birthday-gift.create.msg-content')</span>
    <span id="msg-message-create-birthday-gift">@lang('app.birthday-gift.create.msg-message')</span>
    <span id="msg-img-create-birthday-gift">@lang('app.birthday-gift.create.msg-img')</span>
    <span id="msg-icon-create-birthday-gift">@lang('app.birthday-gift.create.msg-icon')</span>
    <span id="msg-item-create-birthday-gift">@lang('app.birthday-gift.create.msg-item')</span>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/customer/birthday_gift/create.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
