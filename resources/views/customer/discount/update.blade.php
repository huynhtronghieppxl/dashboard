<div class="modal fade" id="modal-update-discount" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.discount-customer.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateGift()" onkeypress="closeModalUpdateGift()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-create-discount-customer">
                <div class="card-block">
{{--                    <div class="form-group row">--}}
{{--                        <div class="col-lg-3">--}}
{{--                            <label class="m-b-10 col-form-label font-weight-bold my-auto">@lang('app.discount-customer.update.amount')</label>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-9">--}}
{{--                            <label class="input-group">--}}
{{--                                <input type="text" id="from-date-in-inventory-manage" class="input-sm form-control text-center p-1" data-max-length="15" data-money="1" placeholder="0" name="start" />--}}
{{--                                <span class="input-group-addon d-flex justify-content-center">@lang('app.component.button.to')</span>--}}
{{--                                <input type="text" id="to-date-in-inventory-manage" class="input-sm form-control text-center p-1" name="end" data-empty="1" data-money="1" placeholder="0" />--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input type="text" id="from-date-in-inventory-manage" class="input-sm form-control text-center p-1" placeholder="0" name="start" data-max-length="15" data-money="1" value="0" autocomplete="off">
                            <span class="input-group-addon d-flex justify-content-center">@lang('app.component.button.to')</span>
                            <input type="text" id="to-date-in-inventory-manage" class="input-sm form-control text-center p-1" name="end" data-empty="1" data-money="1" placeholder="0" autocomplete="off">
                            <label><i class="typcn typcn-document-text"></i>@lang('app.discount-customer.update.amount') <span class="text-danger">(*)</span> </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
{{--                    <div class="form-group row">--}}
{{--                        <div class="col-lg-3">--}}
{{--                            <label class="m-b-10 col-form-label font-weight-bold my-auto">@lang('app.discount-customer.update.gift')</label>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-9">--}}
{{--                            <select id="select-material-update-discount" class="js-example-basic-single col-sm-12" data-empty="1" data-select="1">--}}
{{--<!--                                <option>Thịt gà kho (20,000)</option>--}}
{{--                                <option>Bia tươi (30,000)</option>-->--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="form-group select2_theme validate-group">
                        <div class="form-validate-select ">
                            <div class="col-lg-12 pr-0 select-material-box">
                                <select id="select-material-update-discount" class="js-example-basic-single col-sm-12 select2-hidden-accessible" data-select="1" data-empty="1" >
                                    <option value="" disabled="" selected="">@lang('app.component.option_default')</option>
                                    <option>Thịt gà kho (20,000)</option>
                                    <option>Bia tươi (30,000)</option>
                                </select>
                                <label><i class="typcn typcn-document-text"></i>@lang('app.discount-customer.update.gift') <span class="text-danger">(*)</span></label>
                                <div class="line"></div>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalUpdateGift()"
                     onkeypress="saveModalUpdateGift()">
                    <i class="fi-rr-document"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/customer/discount/update.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
