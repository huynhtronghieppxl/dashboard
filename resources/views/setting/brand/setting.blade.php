<style>
    .hide-long-text {
        min-width: revert;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        width: 100%;
    }
</style>
<div class="card box-shadow-div mt-2"
     id="branch-config-setting">
    <div class="row">
        <div class="col-lg-6 text-left">
            <h2 class="sub-title">@lang('app.setting.setting-brand.title')</h2>
        </div>
        <div class="col-lg-6 text-right d-flex justify-content-end">
            <div class="layout-index-button-new">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveUpdateSettingBrand()">
                    <i class="fi-rr-disk" style="font-size: 17.5px;vertical-align: middle;"></i>
                    <span>Cập nhật</span>
                </div>
            </div>
        </div>
    </div>
    <div class=" row m-t-20">
        <div class="col-sm-12 form-group validate-group">
            <div class="form-validate-input">
                <input id="report-time" class="input-sm form-control input-datetimepicker border-0 p-1" value="15"
                       data-max="23" data-min="0" data-spec="1" data-empty="1">
                <label>
                    <div class="hide-long-text">
                        Khung giờ chốt báo cáo
                    </div>
                    @include('layouts.start')
                </label>
                <div class="line"></div>
            </div>
            <div class="link-href"></div>
        </div>
    </div>
    @if(Session::get(SESSION_KEY_LEVEL) >= 8)
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4 form-group">
                <div class="form-validate-input">
                    <input value="0" id="percent-amount-setting-brand-membership-card" class="form-control border-0"
                           data-percent="1" data-tooltip="1" data-empty="1" data-placement="top"
                           data-max="100" data-min="0"
                           data-original-title="Số điểm khuyến mãi tối đa được sử dụng trên mỗi Bill (%)">
                    <label>
                        <div class="hide-long-text">
                            Số điểm khuyến mãi tối đa được sử dụng trên mỗi Bill (%)
                        </div>
                    </label>
                    <div class="line"></div>
                    <div class="tool-tip"><i
                            class="fi-rr-exclamation text-inverse pointer"
                            data-toggle="tooltip" data-placement="top"
                            data-original-title="@lang('app.restaurant-membership-card.tooltip.percent-point')"></i>
                    </div>
                </div>
                <div class="link-href"></div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 form-group">
                <div class="form-validate-input">
                    <input value="0" id="percent-amount-brand-alo-point-in-each-bill"
                           class="form-control border-0 border-right" data-float="1" data-type="currency-edit"
                           data-percent="1" data-tooltip="1" data-empty="1" data-placement="top"
                           data-max="100" data-min="0"
                           data-original-title="Số điểm tích luỹ tối đa được sử dụng trên mỗi Bill (VNĐ)">
                    <label class="">
                        <div class="hide-long-text">
                            Số điểm value tối đa được sử dụng trên mỗi Bill(%)
                        </div>
                    </label>
                    <div class="line"></div>
                    <div class="tool-tip"><i
                            class="fi-rr-exclamation text-inverse pointer"
                            data-toggle="tooltip" data-placement="top"
                            data-original-title="@lang('app.restaurant-membership-card.tooltip.percent-bill')"></i>
                    </div>
                </div>
                <div class="link-href"></div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 form-group">
                <div class="form-validate-input">
                    <input value="0" id="percent-amount-accumulate-point-brand-allow-use-in-each-bill"
                           class="form-control border-0 border-right"
                           data-empty="1" data-type="currency-edit"
                           data-max="100" data-min="0"
                           data-percent="1">
                    <label>
                        <div class="hide-long-text">
                            Số điểm tích luỹ tối đa được sử dụng trên mỗi Bill (%)
                        </div>
                    </label>
                    <div class="line"></div>
                    <div class="tool-tip"><i
                            class="fi-rr-exclamation text-inverse pointer"
                            data-toggle="tooltip" data-placement="top"
                            data-original-title="@lang('app.restaurant-membership-card.tooltip.percent-bill')"></i>
                    </div>
                </div>
                <div class="link-href"></div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 form-group">
                <div class="form-validate-input">
                    <input value="0" id="promotion-point-brand-allow-use-in-each-bill" class="form-control border-0"
                           data-empty="1" data-type="currency-edit" data-min="0" data-max="999999">
                    <label class="">
                        <div class="hide-long-text">
                            Số điểm khuyến mãi tối đa được sử dụng trên mỗi Bill
                        </div>
                    </label>
                    <div class="line"></div>
                    {{--                <div class="tool-tip">--}}
                    {{--                    <i class="fa fa-exclamation-circle text-inverse pointer"--}}
                    {{--                       data-toggle="tooltip"--}}
                    {{--                       data-placement="top"--}}
                    {{--                       data-original-title="@lang('app.restaurant-membership-card.tooltip.percent-point')">--}}
                    {{--                    </i>--}}
                    {{--                </div>--}}
                </div>
                <div class="link-href"></div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 form-group">
                <div class="form-validate-input">
                    <input id="alo-point-brand-allow-use-in-each-bill" class="form-control border-0 border-right"
                           value="0" data-money-min="100" data-money-allow="0" data-max="999999999">
                    <label class="">
                        <div class="hide-long-text">
                            Số điểm value tối đa được sử dụng trên mỗi Bill (VNĐ)
                        </div>
                    </label>
                    <div class="line"></div>
                    <div class="tool-tip">
                        <i class="fi-rr-exclamation text-inverse pointer"
                           data-toggle="tooltip"
                           data-placement="top"
                           data-original-title="@lang('app.restaurant-membership-card.tooltip.percent-money-bill')">
                        </i>
                    </div>
                </div>
                <div class="link-href"></div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 form-group">
                <div class="form-validate-input">
                    <input id="accumulate-point-brand-allow-use-in-each-bill" class="form-control border-0 border-right"
                           value="0" data-min="0" data-max="999999">
                    <label>
                        <div class="hide-long-text">
                            Số điểm tích luỹ tối đa được sử dụng trên mỗi Bill
                        </div>
                    </label>
                    <div class="line"></div>
                    <div class="tool-tip"><i
                            class="fi-rr-exclamation text-inverse pointer"
                            data-toggle="tooltip" data-placement="top"
                            data-original-title="@lang('app.restaurant-membership-card.tooltip.percent-money-bill')"></i>
                    </div>
                </div>
                <div class="link-href"></div>
            </div>
        </div>
    @endif
    <div class="card box-shadow-div px-0" id="branch-general-configuration-update">
        @if(Session::get(SESSION_KEY_LEVEL) >= 5)
            <h2 class="sub-title">@lang('app.setting.setting-brand.setting-employee')</h2>
            <div class="row m-t-20">
                <div class="col-lg-4">
                    <div class="form-group setting-form-group validate-group">
                        <div class="form-validate-input ">
                            <input class="form-control border-right text-right input-tooltip" id="late-time-brand"
                                   data-max="999" data-money-min="100"  data-tooltip="1" data-empty="1" data-placement="top"
                                   data-original-title="@lang('app.setting.setting-employees.exp-late-time')">
                            <label>
                                <div class="hide-long-text">
                                    @lang('app.setting.setting-brand.late-time-brand')
                                </div>
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                            {{--                            <div class="tool-tip">--}}
                            {{--                                <i class="fa fa-exclamation-circle text-inverse pointer" data-toggle="tooltip"--}}
                            {{--                                   data-placement="top"--}}
                            {{--                                   data-original-title="@lang('app.setting.setting-employees.exp-late-time')"></i>--}}
                            {{--                            </div>--}}
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group setting-form-group validate-group">
                        <div class="form-validate-input ">
                            <input class="form-control border-right text-right input-tooltip" id="monthly-off-brand"
                                   data-max="31" data-min="0" data-empty="1" data-tooltip="1" data-placement="top"
                                   data-original-title="@lang('app.setting.setting-employees.exp-off-month')">
                            <label>
                                <div class="hide-long-text">
                                    @lang('app.setting.setting-brand.monthly-off-brand')
                                </div>
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                            {{--                            <div class="tool-tip">--}}
                            {{--                                <i class="fa fa-exclamation-circle text-inverse pointer" data-toggle="tooltip"--}}
                            {{--                                   data-placement="top"--}}
                            {{--                                   data-original-title="@lang('app.setting.setting-employees.exp-off-month')"></i>--}}
                            {{--                            </div>--}}
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group setting-form-group validate-group">
                        <div class="form-validate-input ">
                            <input class="form-control border-right text-right input-tooltip" id="punish-late-brand"
                                   data-max="999999999" value="0" data-monmey-min="100" data-money-allow="0" data-tooltip="1" data-empty="1" data-placement="top"
                                   data-original-title="@lang('app.setting.setting-employees.exp-punish-time-late')">
                            <label>
                                <div class="hide-long-text">
                                    @lang('app.setting.setting-brand.punish-late-brand')
                                </div>
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                            {{--                            <div class="tool-tip">--}}
                            {{--                                <i class="fa fa-exclamation-circle text-inverse pointer" data-toggle="tooltip"--}}
                            {{--                                   data-placement="top"--}}
                            {{--                                   data-original-title="@lang('app.setting.setting-employees.exp-punish-time-late')"></i>--}}
                            {{--                            </div>--}}
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group setting-form-group validate-group">
                        <div class="form-validate-input ">
                            <input class="form-control border-right text-right input-tooltip" id="punish-checkout-brand"
                                   value="0" data-tooltip="1" data-money-min="100" data-money-allow="0" data-max="999999999" data-empty="1" data-placement="top"
                                   data-original-title="@lang('app.setting.setting-employees.punish-tooltip-checkout')">
                            <label>
                                <div class="hide-long-text">
                                    @lang('app.setting.setting-brand.punish-checkout-brand')
                                </div>
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                            {{--                            <div class="tool-tip">--}}
                            {{--                                <i class="fa fa-exclamation-circle text-inverse pointer" data-toggle="tooltip"--}}
                            {{--                                   data-placement="top"--}}
                            {{--                                   data-original-title="@lang('app.setting.setting-employees.punish-tooltip-checkout')"></i>--}}
                            {{--                            </div>--}}
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group setting-form-group validate-group d-none">
                        <div class="form-validate-input ">
                            <input class="form-control border-right text-right input-tooltip" id="bonus-brand"
                                   data-max="999999999" data-money-min="100" data-money-allow="0" data-tooltip="1" data-empty="1" data-placement="top"
                                   data-original-title="@lang('app.setting.setting-employees.exp-bonus-working')">
                            <label>
                                <div class="hide-long-text">
                                    @lang('app.setting.setting-brand.bonus-brand')
                                </div>
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                            {{--                            <div class="tool-tip">--}}
                            {{--                                <i class="fa fa-exclamation-circle text-inverse pointer" data-toggle="tooltip"--}}
                            {{--                                   data-placement="top"--}}
                            {{--                                   data-original-title="@lang('app.setting.setting-employees.exp-bonus-working')"></i>--}}
                            {{--                            </div>--}}
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group setting-form-group validate-group">
                        <div class="form-validate-input ">
                            <input class="form-control border-right text-right input-tooltip" id="yearly-off-brand"
                                   data-max="366" data-min="0" data-tooltip="1" data-empty="1" data-placement="top" value="0"
                                   data-original-title="@lang('app.setting.setting-employees.exp-off-month')">
                            <label>
                                <div class="hide-long-text">
                                    @lang('app.setting.setting-brand.yearly-off-brand')
                                </div>
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                            {{--                            <div class="tool-tip">--}}
                            {{--                                <i class="fa fa-exclamation-circle text-inverse pointer" data-toggle="tooltip"--}}
                            {{--                                   data-placement="top"--}}
                            {{--                                   data-original-title="@lang('app.setting.setting-employees.exp-off-month')"></i>--}}
                            {{--                            </div>--}}
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group setting-form-group validate-group">
                        <div class="form-validate-input ">
                            <input class="form-control border-right text-right input-tooltip" id="advance-salary-brand"
                                   data-percent="1" data-tooltip="1" data-empty="1" data-placement="top" value="0"
                                   data-min="0" data-max="100"
                                   data-original-title="@lang('app.setting.setting-employees.exp-percent-salary-advance')">
                            <label>
                                <div class="hide-long-text">
                                    @lang('app.setting.setting-brand.advance-salary-brand')
                                </div>
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                            {{--                            <div class="tool-tip">--}}
                            {{--                                <i class="fa fa-exclamation-circle text-inverse pointer" data-toggle="tooltip"--}}
                            {{--                                   data-placement="top"--}}
                            {{--                                   data-original-title="@lang('app.setting.setting-employees.exp-percent-salary-advance')"></i>--}}
                            {{--                            </div>--}}
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="card box-shadow-div px-0" id="branch-general-configuration-update">
        <h2 class="sub-title">@lang('app.setting.setting-brand.bill')</h2>
        <div class="row setting-form-group m-t-20">
{{--            <div class="form-group col-sm-4 validate-group">--}}
{{--                <div class="checkbox-form-group">--}}
{{--                    <input type="checkbox" value="" id="temporary-bill-brand" data-tooltip="1"--}}
{{--                           data-original-title="@lang('app.setting.setting-brand.exp-temp-bill')" required="">--}}
{{--                    <label class="name-checkbox"--}}
{{--                           for="temporary-bill-brand">--}}
{{--                        @lang('app.setting.setting-brand.temp-bill')--}}
{{--                    </label>--}}
{{--                    <div class="tool-tip"><i class="fi-rr-exclamation text-inverse pointer" data-toggle="tooltip"--}}
{{--                                             data-placement="top"--}}
{{--                                             data-original-title="@lang('app.setting.setting-brand.temp-bill')"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="form-group col-sm-4 validate-group">
                <div class="checkbox-form-group">
                    <input type="checkbox" value="" id="hidden-amount-brand" data-tooltip="1"
                           data-original-title="@lang('app.setting.setting-brand.exp-hide-total-amount')"
                           required="">
                    <label class="name-checkbox"
                           for="hidden-amount-brand">
                        @lang('app.setting.setting-brand.hide-total-amount')
                    </label>
                    <div class="tool-tip"><i class="fi-rr-exclamation text-inverse pointer" data-toggle="tooltip"
                                             data-placement="top"
                                             data-original-title="@lang('app.setting.setting-brand.exp-hide-total-amount')"></i>
                    </div>
                </div>
            </div>
            @if(Session::get(SESSION_KEY_LEVEL) >= 6)
                <div class="form-group col-sm-4 validate-group">
                    <div class="form-validate-checkbox">
                        <div class="checkbox-form-group">
                            <input type="checkbox" value="" id="customer-slot-brand" data-tooltip="1"
                                   data-original-title="Nhập số lượng khách khi thanh toán" required="">
                            <label class="name-checkbox"
                                   for="customer-slot-brand">
                                Nhập số lượng khách
                            </label>
                            <div class="tool-tip"><i class="fi-rr-exclamation text-inverse pointer"
                                                     data-toggle="tooltip"
                                                     data-placement="top"
                                                     data-original-title="Nhập số lượng khách khi thanh toán"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
{{--        </div>--}}
{{--        <div class=" row setting-form-group">--}}

            <div class="form-group col-sm-4 validate-group mb-0">
                <div class="form-validate-checkbox">
                    {{--                    <i class="icofont icofont-disc"></i>--}}

                    {{--                    <div class="checkbox-zoom zoom-primary">--}}
                    {{--                        <label>--}}
                    {{--                            <input type="checkbox" value="" id="enable-booking" data-tooltip="1"--}}
                    {{--                                   data-original-title="@lang('app.setting.setting-brand.exp-put-table')" required="">--}}
                    {{--                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>--}}
                    {{--                        </label>--}}
                    {{--                    </div>--}}

                    {{--                    <label for=" $(this).attr(id) ">--}}
                    {{--                        <i class="icofont  $(this).attr(data-icon) "></i>--}}
                    {{--                        @lang('app.setting.setting-brand.put-table')--}}
                    {{--                    </label>--}}
                    {{--                    <div class="line"></div>--}}
                    {{--                    <div class="tool-tip"><i class="fa fa-exclamation-circle text-inverse pointer" data-toggle="tooltip"--}}
                    {{--                                             data-placement="top"--}}
                    {{--                                             data-original-title="@lang('app.setting.setting-brand.exp-put-table')"></i>--}}
                    {{--                    </div>--}}
                    <div class="checkbox-form-group">
                        <input type="checkbox" value="" id="enable-booking" data-tooltip="1"
                               data-original-title="@lang('app.setting.setting-brand.exp-put-table')" required="">
                        <label class="name-checkbox"
                               for="enable-booking">
                            @lang('app.setting.setting-brand.put-table')
                        </label>
                        <div class="tool-tip"><i class="fi-rr-exclamation text-inverse pointer" data-toggle="tooltip"
                                                 data-placement="top"
                                                 data-original-title="@lang('app.setting.setting-brand.exp-put-table')"></i>
                        </div>
                    </div>
                </div>
            </div>
            @if(Session::get(SESSION_KEY_LEVEL) >= 8)
                @if(Session::get(SESSION_KEY_SETTING_CURRENT_BRAND)['is_enable_membership_card'] === 1)
                    <div class="form-group col-sm-4 validate-group mb-0">
                        {{--                    <div class="form-validate-checkbox">--}}
                        {{--                        <i class="icofont icofont-disc"></i>--}}

                        {{--                        <div class="checkbox-zoom zoom-primary">--}}
                        {{--                            <label>--}}
                        {{--                                <input type="checkbox" checked="" value="" id="is_enable_member_ship_card"--}}
                        {{--                                       data-tooltip="1"--}}
                        {{--                                       data-original-title="@lang('app.setting.setting-brand.exp-card-member')"--}}
                        {{--                                       required="">--}}
                        {{--                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>--}}
                        {{--                            </label>--}}
                        {{--                        </div>--}}

                        {{--                        <label for=" $(this).attr(id) ">--}}
                        {{--                            <i class="icofont  $(this).attr(data-icon) "></i>--}}
                        {{--                            @lang('app.setting.setting-brand.card-member')--}}
                        {{--                        </label>--}}
                        {{--                        <div class="line"></div>--}}
                        {{--                        <div class="tool-tip"><i class="fa fa-exclamation-circle text-inverse pointer"--}}
                        {{--                                                 data-toggle="tooltip"--}}
                        {{--                                                 data-placement="top"--}}
                        {{--                                                 data-original-title="@lang('app.setting.setting-brand.exp-card-member')"></i>--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                        <div class="checkbox-form-group">
                            <input type="checkbox" checked="" value="" id="is_enable_member_ship_card"
                                   data-tooltip="1"
                                   data-original-title="@lang('app.setting.setting-brand.exp-card-member')"
                                   required="">
                            <label class="name-checkbox"
                                   for="is_enable_member_ship_card">
                                @lang('app.setting.setting-brand.card-member')
                            </label>
                            <div class="tool-tip"><i class="fi-rr-exclamation text-inverse pointer" data-toggle="tooltip"
                                                     data-placement="top"
                                                     data-original-title="@lang('app.setting.setting-brand.exp-card-member')"></i>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="form-group col-sm-4 validate-group mb-0">
                        <div class="checkbox-form-group">
                            <input type="checkbox" value="" id="is_enable_member_ship_card" data-tooltip="1"
                                   data-original-title="@lang('app.setting.setting-brand.exp-card-member')"
                                   required="">
                            <label class="name-checkbox"
                                   for="logo-bill-brand">
                                @lang('app.setting.setting-brand.card-member')
                            </label>
                            <div class="tool-tip"><i class="fi-rr-exclamation text-inverse pointer" data-toggle="tooltip"
                                                     data-placement="top"
                                                     data-original-title="@lang('app.setting.setting-brand.exp-card-member')"></i>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            <div class="form-group col-sm-4 validate-group mb-0">
                <div class="checkbox-form-group">
                    <input type="checkbox" value="" id="logo-bill-brand" data-tooltip="1"
                           data-original-title="@lang('app.setting.setting-brand.exp-bill-logo')" required="">
                    <label class="name-checkbox"
                           for="logo-bill-brand">
                        @lang('app.setting.setting-brand.bill-logo')
                    </label>
                    <div class="tool-tip"><i class="fi-rr-exclamation text-inverse pointer" data-toggle="tooltip"
                                             data-placement="top"
                                             data-original-title="@lang('app.setting.setting-brand.exp-bill-logo')"></i>
                    </div>
                </div>
            </div>

{{--        </div>--}}
{{--        <div class=" row setting-form-group ">--}}
{{--            @if(Session::get(SESSION_KEY_LEVEL) >= 5)--}}
{{--            <div class="form-group col-sm-4 validate-group">--}}
{{--                <div class="checkbox-form-group">--}}
{{--                    <input type="checkbox" value="" id="take-away" data-tooltip="1"--}}
{{--                           data-original-title="@lang('app.setting.setting-brand.exp-dish-home')">--}}
{{--                    <label class="name-checkbox"--}}
{{--                           for="logo-bill-brand">--}}
{{--                        @lang('app.setting.setting-brand.dish-home')--}}
{{--                    </label>--}}
{{--                    <div class="tool-tip"><i class="fi-rr-exclamation text-inverse pointer" data-toggle="tooltip"--}}
{{--                                             data-placement="top"--}}
{{--                                             data-original-title="@lang('app.setting.setting-brand.exp-dish-home')"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @endif--}}
            <div class="form-group col-sm-4 d-none">
                <div class="checkbox-form-group">
                    <label class="col-lg-4 col-form-label"> @lang('app.setting.setting-brand.bill-app')</label>
                    <input type="checkbox" value="" id="bill-pos-brand" data-tooltip="1"
                           data-original-title="@lang('app.setting.setting-brand.exp-bill-app')">
                    <label class="name-checkbox"
                           for="logo-bill-brand">
                        @lang('app.setting.setting-brand.dish-home')
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="card box-shadow-div px-0" id="branch-general-configuration-update">
        <h2 class="sub-title">THIẾT LẬP KHÁC</h2>
        <div class="row setting-form-group m-t-20">
            <div class="col-sm-12 col-md-6 col-lg-4 form-group">
                <div class="form-validate-input">
                    <input id="zalo-oaid-setting-brand" class="form-control border-0">
                    <label>
                        <div class="hide-long-text">
                            Zalo OA ID
                        </div>
                    </label>
                    <div class="line"></div>
                    <div class="tool-tip"><i
                            class="fi-rr-exclamation text-inverse pointer"
                            data-toggle="tooltip" data-placement="top"
                            data-original-title="Liên kết tin nhắn với zalo"></i>
                    </div>
                </div>
                <div class="link-href"></div>
            </div>
        </div>
    </div>
</div>
