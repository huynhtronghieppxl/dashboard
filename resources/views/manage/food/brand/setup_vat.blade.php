<div class="modal fade" id="modal-setup-vat-food-brand-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.food-brand-manage.setup-vat.title')</h4>
                <button type="button" class="close ml-4" onclick="closeModalSetupVatFoodBrandManage()" onkeypress="closeModalSetupVatFoodBrandManage()">
                    <i class="fi-rr-cross"></i>
                </button>

            </div>
            <div class="modal-body" id="loading-modal-change-setup-food-brand-manage">
                <div class="card-block card m-0 flex-sub">
                    <div class="table-responsive new-table">
                        <div class="select-filter-dataTable">
                            <div class="form-validate-select">
                                <div class="pr-0 select-material-box">
                                    <select class="js-example-basic-single" data-select="1" id="vat-setup-vat-food-brand-manage">
                                        <option value="" disabled selected hidden>@lang('app.component.option-null')</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered" id="table-setup-food-brand-manage">
                            <thead>
                                <tr>
                                    <th>
                                        <label>
                                            <div class="form-validate-checkbox mt-2">
                                                <div class="checkbox-form-group">
                                                    <input onclick="checkAllSetupVatFoodBrandManage($(this))" id="check-all-setup-vat-food-manage" name="check-all-vat-food-brand-manage" type="checkbox">
                                                    <label class="name-checkbox" for="print-kitchen-create-food-brand-manage">
                                                    </label>
                                                </div>
                                            </div>
                                        </label><br>
                                        <label class="number-order m-0 p-0">
                                            (<label id="total-check-vat-food-manage">0</label>/<label id="total-all-check-vat-food-manage">0</label>)
                                        </label>
                                    </th>
                                    <th>@lang('app.food-brand-manage.setup-vat.name')</th>
                                    <th>@lang('app.food-brand-manage.setup-vat.category')</th>
                                    <th>@lang('app.food-brand-manage.setup-vat.vat')</th>
                                    <th class="d-none"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveSetupVatFoodBrandManage()"
                     onkeypress="saveSetupVatFoodBrandManage()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/food/brand/setup_vat.js?version=9',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
