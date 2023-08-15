<div class="modal fade" id="modal-detail-branch" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg-big" role="document">
        <div class="modal-content" id="loading-modal-history-manage">
            <div class="card-block bg-white-border ">
                <div class="sub-title">@lang('app.restaurant-membership-card.detail.title')</div>
                <div class="card-block-left-right row">
                    <div class="w-100">
                        <div class="row card-block-left-right">
                            <div class="col-lg-12 form-group select-level-create-restaurant">
                                <label
                                    class="font-weight-bold col-form-label">@lang('app.restaurant-membership-card.detail.level')</label>
                                <form class="flex-wr-unset">
                                    <div class="radio radiofill radio-primary radio-inline"
                                         style="width: calc(100% / 1) !important;">
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" name="radio-level" value="1" checked>
                                                <label class="name-checkbox">
                                                    @lang('app.restaurant-membership-card.detail.level1')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="radio radiofill radio-info radio-inline"
                                         style="width: calc(100% / 1) !important;">
{{--                                        <label>--}}
{{--                                            <input type="radio" name="radio-level" value="2">--}}
{{--                                            <i class="helper"></i>@lang('app.restaurant-membership-card.detail.level2')--}}
{{--                                        </label>--}}
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" name="radio-level" value="2">
                                                <label class="name-checkbox">
                                                    @lang('app.restaurant-membership-card.detail.level2')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="radio radiofill radio-danger radio-inline"
                                         style="width: calc(100% / 1) !important;">
{{--                                        <label>--}}
{{--                                            <input type="radio" name="radio-level" value="3">--}}
{{--                                            <i class="helper"></i>@lang('app.restaurant-membership-card.detail.level3')--}}
{{--                                        </label>--}}
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" name="radio-level" value="3">
                                                <label class="name-checkbox">
                                                    @lang('app.restaurant-membership-card.detail.level3')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="radio radiofill radio-success radio-inline"
                                         style="width: calc(100% / 1) !important;">
{{--                                        <label>--}}
{{--                                            <input type="radio" name="radio-level" value="4">--}}
{{--                                            <i class="helper"></i>@lang('app.restaurant-membership-card.detail.level4')--}}
{{--                                        </label>--}}
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" name="radio-level" value="4">
                                                <label class="name-checkbox">
                                                    @lang('app.restaurant-membership-card.detail.level4')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="radio radiofill radio-secondary radio-inline"
                                         style="width: calc(100% / 1) !important;">
{{--                                        <label>--}}
{{--                                            <input type="radio" name="radio-level" value="5">--}}
{{--                                            <i class="helper"></i>@lang('app.restaurant-membership-card.detail.level5')--}}
{{--                                        </label>--}}
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" name="radio-level" value="5">
                                                <label class="name-checkbox">
                                                    @lang('app.restaurant-membership-card.detail.level5')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="radio radiofill radio-warning radio-inline"
                                         style="width: calc(100% / 1) !important;">
{{--                                        <label>--}}
{{--                                            <input type="radio" name="radio-level" value="6">--}}
{{--                                            <i class="helper"></i>@lang('app.restaurant-membership-card.detail.level6')--}}
{{--                                        </label>--}}
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" name="radio-level" value="6">
                                                <label class="name-checkbox">
                                                    @lang('app.restaurant-membership-card.detail.level6')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="radio radiofill radio-success radio-inline"
                                         style="width: calc(100% / 1) !important;">
{{--                                        <label>--}}
{{--                                            <input type="radio" name="radio-level" value="7">--}}
{{--                                            <i class="helper"></i>@lang('app.restaurant-membership-card.detail.level7')--}}
{{--                                        </label>--}}
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" name="radio-level" value="7">
                                                <label class="name-checkbox">
                                                    @lang('app.restaurant-membership-card.detail.level7')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="radio radiofill radio-danger radio-inline"
                                         style="width: calc(100% / 1) !important;">
{{--                                        <label>--}}
{{--                                            <input type="radio" name="radio-level" value="8">--}}
{{--                                            <i class="helper"></i>@lang('app.restaurant-membership-card.detail.level8')--}}
{{--                                        </label>--}}
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" name="radio-level" value="8">
                                                <label class="name-checkbox">
                                                    @lang('app.restaurant-membership-card.detail.level8')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="radio radiofill radio-info radio-inline"
                                         style="width: calc(100% / 1) !important;">
{{--                                        <label>--}}
{{--                                            <input type="radio" name="radio-level" value="9">--}}
{{--                                            <i class="helper"></i>@lang('app.restaurant-membership-card.detail.level9')--}}
{{--                                        </label>--}}
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" name="radio-level" value="9">
                                                <label class="name-checkbox">
                                                    @lang('app.restaurant-membership-card.detail.level9')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                    <div class="radio radiofill radio-warning radio-inline"--}}
                                    {{--                                         style="width: calc(100% / 1) !important;">--}}
                                    {{--                                        <label>--}}
                                    {{--                                            <input type="radio" name="radio-level" value="10">--}}
                                    {{--                                            <i class="helper"></i>@lang('app.restaurant-membership-card.detail.level10')--}}
                                    {{--                                        </label>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="radio radiofill radio-success radio-inline"--}}
                                    {{--                                         style="width: calc(100% / 1) !important;">--}}
                                    {{--                                        <label>--}}
                                    {{--                                            <input type="radio" name="radio-level" value="11">--}}
                                    {{--                                            <i class="helper"></i>@lang('app.restaurant-membership-card.detail.level11')--}}
                                    {{--                                        </label>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="radio radiofill radio-primary radio-inline"--}}
                                    {{--                                         style="width: calc(100% / 1) !important;">--}}
                                    {{--                                        <label>--}}
                                    {{--                                            <input type="radio" name="radio-level" value="12">--}}
                                    {{--                                            <i class="helper"></i>@lang('app.restaurant-membership-card.detail.level12')--}}
                                    {{--                                        </label>--}}
                                    {{--                                    </div>--}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-btn-hover-gray seemt-bg-gray-w200"
                     data-dismiss="modal" id="btn_close_create"
                     onclick="closeModalHistory()">
                    <i class="fi-rr-cross"></i>
                    <span>@lang('app.component.button.close')</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/setting/brand/index.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
