<div class="modal fade" id="modal-create-customer-message-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.message.create.title')</h4>
            </div>
            <div class="modal-body">
                <div class="card-block">
                    <div class="form-group select2_theme validate-group">
                        <div class="form-validate-select ">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 pr-0 select-material-box">
                                    <select id="branch-create-customer-message-data" data-icon="icofont-gift"
                                            data-validate="select, empty"
                                            class="js-example-basic-single select-not-select2 select2-hidden-accessible"
                                            tabindex="-1" aria-hidden="true">
                                        @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all() as $db)
                                            @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])
                                                <option value="{{$db['id']}}"
                                                        data-take-away="{{$db['is_have_take_away']}}"
                                                        data-booking="{{$db['is_enable_booking']}}"
                                                        selected>{{$db['name']}}</option>
                                            @else
                                                <option value="{{$db['id']}}"
                                                        data-take-away="{{$db['is_have_take_away']}}"
                                                        data-booking="{{$db['is_enable_booking']}}">{{$db['name']}}</option>
                                            @endif @endforeach
                                    </select>
                                    <label class="icon-validate"><i
                                            class="icofont icofont-gift"></i>@lang('app.message.create.branch')</label>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>

                    <div class="form-group select2_theme validate-group">
                        <div class="form-validate-select ">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 pr-0 select-material-box">
                                    <select id="create-type-customer-message-data"
                                            class="js-example-basic-single select-not-select2 select2-hidden-accessible"
                                            data-icon="icofont-gift"
                                            data-validate="select, empty" tabindex="-1" aria-hidden="true">
                                        <option value="2">@lang('app.message.create.birthday-message')</option>
                                        <option value="1">@lang('app.message.create.after-eat-message')</option>
                                        <option value="3">@lang('app.message.create.register-membership-message')</option>
                                        <option value="4">@lang('app.message.create.membership-level-up-message')</option>
                                        <option value="5">@lang('app.message.create.up-point-message')</option>
                                    </select>
                                    <label class="icon-validate"><i
                                            class="icofont icofont-gift"></i>@lang('app.message.create.type')</label>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label
                                class="m-b-10 col-form-label font-weight-bold my-auto">@lang('app.message.create.content')</label>
                        </div>
                        <div class="col-lg-9">
                            <textarea class="w-100" id="content-create-customer-message-data" data-validate="note"
                                      cols="5" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 font-weight-bold">@lang('app.message.create.code')</label>
                        <div class="col-lg-9 d-flex" >
                            <div class="col-4" id="div-restaurant-greeting">
                                <button type="button" class="btn btn-grd-disabled border-radius-20"
                                        onclick="append_restaurant_name()">@lang('app.message.create.name-restaurant-company')
                                </button>
                            </div>
                            <div class="col-4 d-none" id="div-branch-greeting">
                                <button type="button" class="btn btn-grd-disabled border-radius-20"
                                        onclick="append_branch_name()">@lang('app.message.create.name-branch')
                                </button>
                            </div>
                            <div class="col-4" id="div-customer-greeting">
                                <button type="button" class="btn btn-grd-disabled border-radius-20"
                                        onclick="append_customer_name()">@lang('app.message.create.name-customer')
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <div class="col-lg-12">
                            <span class="cursor-pointer font-italic" onclick="open_modal_more_information()"
                                  style="color: #095a9b;">@lang('app.message.create.learn-more')</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled" onclick="closeModalCreateCustomerMessage()"
                        onkeypress="closeModalCreateCustomerMessage()">
                    @lang('app.component.button.close')
                </button>
                <button type="button" class="btn btn-grd-primary" id="save-create-customer-message"
                        onclick="saveModalCreateCustomerMessageData()"
                        onkeypress="saveModalCreateCustomerMessageData()">
                    @lang('app.component.button.save')
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-create-more-information" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.message.create.more.more-information')</h4>
            </div>
            <div class="modal-body" id="loading-modal-create-more-information">
                <div class="card-block">
                    <div class="form-group row">
                        <label class="col-lg-3 font-weight-bold">@lang('app.message.create.more.message-syntax')</label>
                        <div class="col-lg-9">
                            <span>
                                @lang('app.message.create.text.group') <b class = "font-italic">@lang('app.message.create.text.branch-syntax')</b> @lang('app.message.create.text.thanks-message') <b
                                    class = "font-italic">@lang('app.message.create.text.branch-syntax')</b> @lang('app.message.create.text.message-content-1')
                                <b class = "font-italic">@lang('app.message.create.text.customer-syntax')</b> @lang('app.message.create.text.message-content-2')
                            </span>
                            <br/>
                            <br/>
                            <span>@lang('app.message.create.text.thanks-message-1') <b class = "font-italic">@lang('app.message.create.text.customer-syntax')</b> @lang('app.message.create.text.message-content-3')</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 font-weight-bold">@lang('app.message.create.more.message-results')</label>
                        <div class="col-lg-9">
                            <span>
                                @lang('app.message.create.text.group') @lang('app.message.create.text.my-branch-syntax')</b> @lang('app.message.create.text.thanks-message') <b
                                    class = "font-italic">@lang('app.message.create.text.customer-name')</b> @lang('app.message.create.text.message-content-1')
                                <b class = "font-italic">@lang('app.message.create.text.my-branch-syntax')</b> @lang('app.message.create.text.message-content-2')
                            </span>
                            <br/>
                            <br/>
                            <span>@lang('app.message.create.text.thanks-message-1') <b class = "font-italic">@lang('app.message.create.text.customer-name')</b> @lang('app.message.create.text.message-content-3')</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled" onclick="close_modal_create_more_information()">
                    @lang('app.component.button.close')
                </button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/customer/message/create.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
