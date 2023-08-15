<div class="modal fade" id="modal-setting-restaurant-membership-card" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.restaurant-membership-card.setting.title')</h4>
            </div>
            <div class="modal-body background-body-color text-left"
                 id="loading-modal-setting-restaurant-membership-card">
                <div class="card card-block">
                    <h4 class="sub-title font-weight-bold">@lang('app.restaurant-membership-card.setting.policy')</h4>
                    <div class="row" style="margin-top: 20px">
                        <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea id="membership-card-use-guide-restaurant-membership-card" class="form-control" cols="5" rows="3"></textarea>
                                        <label for="condition-setting-restaurant-membership-card" class="icon-validate">
                                            @lang('app.restaurant-membership-card.setting.membership-card-use-guide')
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea id="membership-card-policy-membership-card" class="form-control" cols="5" rows="3"></textarea>
                                        <label for="point-setting-restaurant-membership-card" class="icon-validate">
                                            @lang('app.restaurant-membership-card.setting.membership-card-policy')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <div class="checkbox-zoom zoom-primary m-auto">
                    <div class="checkbox-form-group">
                        <input id="check-setting-restaurant-membership-card"
                               name="print-kitchen-create-food-brand-manage" type="checkbox">
                        <span class="font-weight-bold">@lang('app.restaurant-membership-card.setting.validate')</span>
                    </div>
                </div>
                <div class="btn seemt-btn-hover-gray seemt-bg-gray-w200" id="btn-close-setting-restaurant-membership-card"
                     onclick="closeModalSettingMembershipCard($(this))">
                    <i class="fi-rr-cross"></i>
                    <span>@lang('app.restaurant-membership-card.setting.close')</span>
                </div>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue d-none"
                     id="btn-save-setting-restaurant-membership-card"
                     onclick="saveModalSettingMembershipCard()"
                     onkeypress="saveModalSettingMembershipCard()">
                    <i class="fi-rr-disk" style="font-size: 17.5px;vertical-align: middle;"></i>
                    <span>Đồng ý</span>
                </div>
            </div>
        </div>
    </div>
</div>
