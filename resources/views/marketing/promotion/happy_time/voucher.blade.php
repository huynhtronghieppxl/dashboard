<div class="modal fade" id="modal-voucher-customer-promotion" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.promotion.voucher.title')</h4>
            </div>
            <div class="modal-body background-body-color" id="loading-modal-voucher-customer-promotion">
                <div class="card card-block">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.promotion.voucher.code')</label>
                        <div class="col-lg-8">
                            <input type="text" id="code-voucher-promotion" class="form-control" data-not-empty
                                   placeholder="@lang('app.promotion.voucher.code-place-holder')">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.promotion.voucher.branch')</label>
                        <div class="col-lg-8">
                            <select class="js-example-basic-single" multiple id="branch-voucher-promotion">
                                <option value="-123">@lang('app.promotion.voucher.all-branch')</option>
                                @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all() as $db)
                                    @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])
                                        <option value="{{$db['id']}}" data-take-away="{{$db['is_have_take_away']}}" data-booking="{{$db['is_enable_booking']}}" selected>{{$db['name']}}</option>
                                    @else
                                        <option value="{{$db['id']}}" data-take-away="{{$db['is_have_take_away']}}" data-booking="{{$db['is_enable_booking']}}">{{$db['name']}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.promotion.voucher.max-use')</label>
                        <div class="col-lg-2">
                            <div class="checkbox-zoom zoom-primary">
                                <label>
                                    <input type="checkbox"
                                           id="checkbox-max-use-voucher-promotion">
                                    <span class="cr">
                                                    <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                </span>
                                    <span>@lang('app.promotion.voucher.limit')</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6 d-none row p-0 m-0"
                             id="div-checkbox-max-use-voucher-promotion">
                            <label class="col-lg-8 col-form-label font-weight-bold my-auto text-right">@lang('app.promotion.voucher.count')</label>
                            <div class="col-lg-4">
                                <input id="max-use-voucher-promotion"
                                       class="form-control text-right"
                                       data-type="currency-edit" value="1">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.promotion.voucher.reusable')</label>
                        <div class="col-lg-2">
                            <div class="checkbox-zoom zoom-primary">
                                <label>
                                    <input type="checkbox"
                                           id="checkbox-reusable-voucher-promotion">
                                    <span class="cr">
                                                    <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                </span>
                                    <span>@lang('app.promotion.voucher.limit')</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6 d-none row p-0 m-0"
                             id="div-checkbox-reusable-voucher-promotion">
                            <label class="col-lg-8 col-form-label font-weight-bold my-auto text-right">@lang('app.promotion.voucher.count')</label>
                            <div class="col-lg-4">
                                <input id="reusable-voucher-promotion"
                                       class="form-control text-right"
                                       data-type="currency-edit" value="1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled" onclick="closeModalVoucherCustomerPromotion()"
                        onkeypress="closeModalVoucherCustomerPromotion()">
                    @lang('app.component.button.close')
                </button>
                <button type="button" class="btn btn-primary" onclick="saveModalVoucherCustomerPromotion()"
                        onkeypress="saveModalVoucherCustomerPromotion()">
                    @lang('app.component.button.save')
                </button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/customer/promotion/voucher.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
