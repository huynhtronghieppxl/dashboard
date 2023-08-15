<div class="modal fade" id="modal-setting-policy-membership-card" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chính sách</h4>
                <button id="btn-close-setting-restaurant-membership-card" type="button" class="close" onclick="closeModalSettingPolicyMembershipCard()" onkeypress="closeModalSettingPolicyMembershipCard()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left"
                 id="loading-modal-setting-policy-membership-card">
                <div class="card card-block">
                    <div class="row">
                        <div class="col-lg-6 mt-2">
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea class="form__field" id="use-guide-membership-card" cols="5" rows="10"></textarea>
                                        <label for="use-guide-membership-card"
                                               class="form__label icon-validate">Hướng dẫn sử dụng @include('layouts.start')</label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-2">
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea class="form__field" id="term-setting-membership-card" cols="5" rows="10"></textarea>
                                        <label for="term-setting-membership-card"
                                               class="form__label icon-validate">Quy định @include('layouts.start')</label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-sm-4 form-group">
                            <div class="form-validate-input">
                                <input value="1" id="percent-amount-setting-restaurant-membership-card" class="form-control border-0"
                                       data-percent="1" data-min="1" data-tooltip="1" data-empty="1" data-placement="top"
                                       data-original-title="@lang('app.restaurant-membership-card.tooltip.percent-point')">
                                <label class="title-form-setting col-form-label">@lang('app.restaurant-membership-card.percent-point') (%)</label>
                                <div class="line"></div>
                                <div class="tool-tip">
                                    <i class="fi-rr-exclamation pointer"  style="color:#E96012 !important"
                                       data-toggle="tooltip" data-placement="top"
                                       data-original-title="@lang('app.restaurant-membership-card.tooltip.percent-point')">
                                    </i>
                                </div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <div class="form-validate-input">
                                <input value="1" id="percent-amount-alo-point-in-each-bill" class="form-control border-0 border-right percent-amount-alo-point-in-each-bill"
                                       data-percent="1" data-min="1" data-tooltip="1" data-empty="1" data-placement="top"
                                       data-original-title="@lang('app.restaurant-membership-card.tooltip.percent-bill')">
                                <label class="col-lg-12 col-form-label">@lang('app.restaurant-membership-card.percent-bill')</label>
                                <div class="line"></div>
                                <div class="tool-tip">
                                    <i class="fi-rr-exclamation pointer"  style="color:#E96012 !important"
                                       data-toggle="tooltip" data-placement="top"
                                       data-original-title="@lang('app.restaurant-membership-card.tooltip.percent-bill')">
                                    </i>
                                </div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <div class="form-validate-input">
                                <input id="alo-point-allow-use-in-each-bill" class="form-control border-0 border-right"
                                       data-min="100" value="0" data-tooltip="1" data-placement="top" data-max="999999999"
                                       data-original-title="@lang('app.restaurant-membership-card.tooltip.percent-money-bill')">
                                <label class="col-lg-12 col-form-label">@lang('app.restaurant-membership-card.percent-money-bill')</label>
                                <div class="line"></div>
                                <div class="tool-tip">
                                    <i class="fi-rr-exclamation pointer" style="color:#E96012 !important"
                                       data-toggle="tooltip" data-placement="top"
                                       data-original-title="@lang('app.restaurant-membership-card.tooltip.percent-money-bill')">
                                    </i>
                                </div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div id="btn-save-setting-restaurant-membership-card" class="btn seemt-orange seemt-bg-orange seemt-btn-hover-orange"
                     onclick="saveModalSettingPolicyMembershipCardRestaurant()"
                     onkeypress="saveModalSettingPolicyMembershipCardRestaurant()">
                    <i class="fi-rr-disk"></i>
                    <span>Kích Hoạt</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{ asset('js\customer\restaurant_membership_card\policy.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
