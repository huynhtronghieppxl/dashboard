<div class="modal fade" id="modal-update-birthday-gift" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.birthday-gift.update.title-left')</h4>
                <button type="button" class="close" onclick="closeModalUpdateBirthdayGift()" onkeypress="closeModalUpdateBirthdayGift()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-update-birthday-gift">
                <div class="row">
                    <div class="col-lg-4 edit-flex-auto-fill pr-1">
                        <div class="flex-sub card-block my-2">
                            <h6 class="m-b-20 p-b-5 b-b-default f-w-600">@lang('app.birthday-gift.update.image')</h6>
                            <div class="custom-box-logo w-75 mx-auto position-relative" id="load-image">
                                <img class="user-img img-radius" id="thumbnail-update-birthday-gift-logo" onerror="imageDefaultOnLoadError($(this))" src="{{ asset('/images/cover.jpg')}}" style="object-fit: cover;" data-link="" />
                                <input type="file" class="d-none" id="upload-update-birthday-logo" accept="image/*" />
                                <label class="btn-image-upload mx-auto my-2 birthday-btn-absolute" for="upload-update-birthday-logo" data-toggle="tooltip" data-placement="right" data-original-title="Chọn ảnh">
                                    <i class="icofont icofont-camera"></i>
                                </label>
                            </div>
                            <br />
                            <h6 class="m-b-20 p-b-5 b-b-default f-w-600">@lang('app.birthday-gift.update.icon')</h6>
                            <div id="icon-update-birthday-gift"></div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card-block">
                            <div class="row m-l-0 m-r-0">
                                <div class="col-sm-12">
                                    <div class="card-block">
                                        <div class="form-group row">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">@lang('app.birthday-gift.update.branch')</label>
                                                <div class="col-sm-9 input-group">
                                                    <select id="branch-update-birthday-gift" class="" multiple data-icon="icofont-location-pin" data-validate="select, empty">
                                                        @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all() as $db)
                                                            @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])
                                                                <option value="{{$db['id']}}" data-take-away="{{$db['is_have_take_away']}}" data-booking="{{$db['is_enable_booking']}}" selected>{{$db['name']}}</option>
                                                            @else
                                                                <option value="{{$db['id']}}" data-take-away="{{$db['is_have_take_away']}}" data-booking="{{$db['is_enable_booking']}}">{{$db['name']}}</option>
                                                            @endif @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">@lang('app.birthday-gift.update.title')</label>
                                            <div class="col-sm-9">
                                                <input id="title-update-birthday-gift" class="form-control" data-validate="empty,max-length-255" data-icon="icofont-tag" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">@lang('app.birthday-gift.update.message')</label>
                                            <div class="col-sm-9">
                                                <input id="message-update-birthday-gift" class="form-control" data-validate="empty,max-length-255" data-icon="icofont-ui-message" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-2">
                                                <p class="m-b-10 col-form-label font-weight-bold my-auto">@lang('app.birthday-gift.update.content')</p>
                                            </div>
                                            <div class="col-lg-10">
                                                <textarea class="w-100" id="content-update-birthday-gift" data-validate="note" cols="5" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">@lang('app.birthday-gift.update.item')</label>
                                            <div class="col-sm-9 input-group">
                                                <select id="item-update-birthday-gift" class="" multiple data-icon="icofont-gift" data-validate="select, empty"></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" id="submit-img" onclick="saveModalUpdateBirthdayGift()"
                     onkeypress="saveModalUpdateBirthdayGift()">
                    <i class="fi-rr-document"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-none">
    <span id="msg-branch-update-birthday-gift">@lang('app.birthday-gift.update.msg-branch')</span>
    <span id="msg-title-update-birthday-gift">@lang('app.birthday-gift.update.msg-title')</span>
    <span id="msg-content-update-birthday-gift">@lang('app.birthday-gift.update.msg-content')</span>
    <span id="msg-message-update-birthday-gift">@lang('app.birthday-gift.update.msg-message')</span>
    <span id="msg-img-update-birthday-gift">@lang('app.birthday-gift.update.msg-img')</span>
    <span id="msg-icon-update-birthday-gift">@lang('app.birthday-gift.update.msg-icon')</span>
    <span id="msg-item-update-birthday-gift">@lang('app.birthday-gift.update.msg-item')</span>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/customer/birthday_gift/update.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
