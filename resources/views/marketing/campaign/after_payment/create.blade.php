<div class="modal fade" id="modal-create-after-payment-campaign-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.message.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateCustomerMessage()" onkeypress="closeModalCreateCustomerMessage()" fdprocessedid="mobvaa">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-block">
                    <div class="form-group select2_theme validate-group" id="branch-after-payment-select">
                        <div class="form-validate-select ">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 pr-0 select-material-box">
                                    <select data-icon="icofont-gift"
                                            data-select = "1" data-empty = "1"
                                            class="select-branch branch-create-after-payment-campaign-data js-example-basic-single select-not-select2 select2-hidden-accessible">
{{--                                        @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all() as $db)--}}
{{--                                            @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])--}}
{{--                                                <option value="{{$db['id']}}"--}}
{{--                                                        data-take-away="{{$db['is_have_take_away']}}"--}}
{{--                                                        data-booking="{{$db['is_enable_booking']}}" selected>{{$db['name']}}</option>--}}
{{--                                            @else--}}
{{--                                                <option value="{{$db['id']}}"--}}
{{--                                                        data-take-away="{{$db['is_have_take_away']}}"--}}
{{--                                                        data-booking="{{$db['is_enable_booking']}}">{{$db['name']}}</option>--}}
{{--                                            @endif @endforeach--}}
                                    </select>
                                    <label class="icon-validate">@lang('app.message.create.branch')</label>
                                </div>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group select2_theme validate-group" id="all-branch-after-payment-select">
                        <div class="form-validate-select ">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 pr-0 select-material-box">
                                    <select data-icon="icofont-gift"
                                            data-select = "1" data-empty = "1"
                                            class="branch-create-after-payment-campaign-data js-example-basic-single select-not-select2 select2-hidden-accessible">
                                        <option value="-1">@lang('app.message.create.all-branch')</option>
                                    </select>
                                    <label class="icon-validate">@lang('app.message.create.branch')</label>
                                </div>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group select2_theme validate-group">
                        <div class="form-group select2_theme validate-group">
                            <div class="form-validate-select ">
                                <div class="col-lg-12 mx-0 px-0">
                                    <div class="col-lg-12 pr-0 select-material-box">
                                        <select id="create-type-after-payment-campaign-data" data-select="1" data-empty="1" class="js-example-basic-single select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                            <option value="2">@lang('app.message.create.birthday-message')</option>
                                            <option value="1">@lang('app.message.create.after-eat-message')</option>
                                            <option value="3">@lang('app.message.create.register-membership-message')</option>
                                            <option value="4">@lang('app.message.create.membership-level-up-message')</option>
                                            <option value="5">@lang('app.message.create.up-point-message')</option>
                                        </select>
                                        <label class="icon-validate">@lang('app.supplier-data.material.create.category') </label>
                                    </div>
                                </div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="row">
                        <div class="form-group validate-group col-lg-12 px-0">
                            <div class="form-validate-textarea">
                                <div class="form__group pt-2 mb-2">
                                    <textarea class="form__field p-3" id="content-create-after-payment-campaign-data" cols="5" rows="8" data-note-max-length="500"></textarea>
                                    <label for="content-update-device-manage-special-properties" class="form__label icon-validate">
                                       @lang('app.message.create.content')</label>
                                    <div class="textarea-character" id="char-count">
                                        <span>0/500</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 ">
                            <label class="font-weight-bold seemt-fz-14">Thêm đối tượng </label>
                            <div class="row col-lg-12">
                                <div class="col-lg-4 mt-2" id="div-restaurant-greeting">
                                    <button type="button" class="btn seemt-orange seemt-bg-orange seemt-btn-hover-orange seemt-fz-14 w-100"
                                            onMouseOver="this.style.background='#f9a236'; this.style.transform='scale(1.1)'"
                                            onMouseOut="this.style.background='#fff'; this.style.transform='scale(1)'"
                                            onclick="appendCreateRestaurantName()">@lang('app.message.create.name-restaurant-company')
                                    </button>
                                </div>
                                <div class="col-lg-4 mt-2" id="div-customer-greeting">
                                    <button type="button" class="btn seemt-orange seemt-bg-orange seemt-btn-hover-orange seemt-fz-14 w-100"
                                            onMouseOver="this.style.background='#f9a236'; this.style.transform='scale(1.1)'"
                                            onMouseOut="this.style.background='#fff'; this.style.transform='scale(1)'"
                                            onclick="appendCreateCustomerName()">@lang('app.message.create.name-customer')
                                    </button>
                                </div>
                                <div class="col-lg-4 mt-2 d-none" id="div-branch-greeting">
                                    <button type="button" class="btn seemt-orange seemt-bg-orange seemt-btn-hover-orange seemt-fz-14 w-100"
                                            onMouseOver="this.style.background='#f9a236'; this.style.transform='scale(1.1)'"
                                            onMouseOut="this.style.background='#fff'; this.style.transform='scale(1)'"
                                            onclick="appendCreateBranchName()">@lang('app.message.create.name-branch')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <div class="col-lg-12">
                            <span class="cursor-pointer" onclick="openModalMoreInformation()"
                                  style="font-style: italic; color: #095a9b;">@lang('app.message.create.learn-more')</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" id="save-create-after-payment-campaign"
                        onclick="saveModalCreateAfterMessageData()"
                        onkeypress="saveModalCreateAfterMessageData()">
                        <i class="fi-rr-disk"></i>
                        <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-create-more-information" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.message.create.more.more-information')</h4>
                <button type="button" class="close" onclick="closeModalCreateMoreInformation()" onkeypress="closeModalCreateMoreInformation()" fdprocessedid="mobvaa">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-create-more-information">
                <div class="card card-block">
                    <div class="form-group row">
                        <label class="col-lg-3 font-weight-bold">@lang('app.message.create.more.message-syntax')</label>
                        <div class="col-lg-9">
                            <span>
                                @lang('app.message.create.text.group') <b style="font-style: italic;">@lang('app.message.create.text.branch-syntax')</b> @lang('app.message.create.text.thanks-message') <b
                                    style="font-style: italic;">@lang('app.message.create.text.branch-syntax')</b> @lang('app.message.create.text.message-content-1')
                                <b style="font-style: italic;">@lang('app.message.create.text.customer-syntax')</b> @lang('app.message.create.text.message-content-2')
                            </span>
                            <br/>
                            <br/>
                            <span>@lang('app.message.create.text.thanks-message-1') <b style="font-style: italic;">@lang('app.message.create.text.customer-syntax')</b> @lang('app.message.create.text.message-content-3')</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 font-weight-bold">@lang('app.message.create.more.message-results')</label>
                        <div class="col-lg-9">
                            <span>
                                @lang('app.message.create.text.group') <b style="font-style: italic;">@lang('app.message.create.text.my-branch-syntax')</b> @lang('app.message.create.text.thanks-message') <b
                                    style="font-style: italic;">@lang('app.message.create.text.customer-name')</b> @lang('app.message.create.text.message-content-1')
                                <b style="font-style: italic;">@lang('app.message.create.text.my-branch-syntax')</b> @lang('app.message.create.text.message-content-2')
                            </span>
                            <br/>
                            <br/>
                            <span>@lang('app.message.create.text.thanks-message-1') <b style="font-style: italic;">@lang('app.message.create.text.customer-name')</b> @lang('app.message.create.text.message-content-3')</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/marketing/campaign/after_payment/create.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
