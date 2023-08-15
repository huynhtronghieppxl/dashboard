<div class="modal fade" id="modal-create-supplier-material-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="text-transform: none">@lang('app.supplier-data.material.create.title')</h4>
            </div>
            <div class="modal-body text-left" id="loading-modal-create-supplier-material">
                <div class="card-block w-100 border-table">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input id="name-create-supplier-material-data" class="form-control" type="text" data-empty="1" data-min-length="2" data-max-length="50" data-spec="1">
                                    <label for="name-create-supplier-material-data">
                                        <i class="icofont icofont-tag"></i>@lang('app.supplier-data.material.create.name') <span class="text-danger">(*)</span>
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input id="code-create-supplier-material-data" class="form-control" type="text" data-empty="1" data-min-length="2" data-max-length="50">
                                    <label for="code-create-supplier-material-data">
                                        <i class="icofont icofont-list"></i>@lang('app.supplier-data.material.create.code') <span class="text-danger">(*)</span>
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input id="cost-price-create-supplier-material-data" value="0" class="form-control text-right" data-type="currency-edit" data-money="1" data-max="100000000">
                                    <label for="cost-price-create-supplier-material-data">
                                        <i class="icofont icofont-money-bag"></i>@lang('app.supplier-data.material.create.cost-price') <span class="text-danger">(*)</span></label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="pr-0 select-material-box">
                                            <select id="category-create-supplier-material-data" data-select="1" data-empty="1" class="js-example-basic-single select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                <option value="" selected disabled hidden>@lang('app.supplier-data.material.create.default-opt')</option>
                                            </select>
                                            <label class="icon-validate">
                                                <i class="icofont icofont-settings-alt"></i>@lang('app.supplier-data.material.create.category') <span class="text-danger">(*)</span></label>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input id="retail-price-create-supplier-material-data" value="0" class="form-control text-right" data-type="currency-edit" data-money="1" data-max="100000000">
                                    <label for="retail-price-create-supplier-material-data">
                                        <i class="icofont icofont-money-bag"></i>@lang('app.supplier-data.material.create.retail-price') <span class="text-danger">(*)</span></label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select ">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="unit-create-supplier-material-data" data-select="1" data-empty="1" class="js-example-basic-single select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                <option value="" selected disabled hidden>@lang('app.supplier-data.material.create.default-opt')</option>
                                            </select>
                                            <label class="icon-validate">
                                                <i class="icofont icofont-cubes"></i>@lang('app.supplier-data.material.create.unit') <span class="text-danger">(*)</span></label>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input id="wastage-rate-create-supplier-material-data" class="form-control text-right input-tooltip" type="text" value="0" data-placement="top" data-original-title="@lang('app.supplier-data.material.create.exp-wastage-rate-percent')" data-float="1" data-max="100" data-tooltip="1">
                                    <label for="wastage-rate-create-supplier-material-data">
                                        <i class="icofont icofont icofont-law-alt-1"></i>@lang('app.supplier-data.material.create.wastage-rate') (@lang('app.supplier-data.material.create.wastage-rate-percent')) </label>
                                    <div class="line"></div>
                                    <div class="tool-tip">
                                        <i class="fa fa-exclamation-circle text-inverse pointer" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.supplier-data.material.create.exp-wastage-rate-percent')"></i>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="pr-0 select-material-box">
                                            <select id="specifications-create-supplier-material-data" data-select="1" data-empty="1" class="js-example-basic-single select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                <option value="" selected disabled hidden>@lang('app.supplier-data.material.create.null-opt')</option>
                                            </select>
                                            <label class="icon-validate">
                                                <i class="icofont icofont-cube"></i>@lang('app.supplier-data.material.create.specifications') <span class="text-danger">(*)</span></label>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input id="out-stock-quantity-create-supplier-material-data" value="0" class="form-control text-right" data-max="100000" data-type="currency-edit" data-min="0">
                                    <label for="out-stock-quantity-create-supplier-material-data">
                                        <i class="icofont icofont-law-alt-1"></i>@lang('app.supplier-data.material.create.out-stock-quantity') </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none"
                        onclick="resetModalCreateSupplierMaterial()"
                        onkeypress="resetModalCreateSupplierMaterial()">
                    <i class="fa fa-eraser"></i>
                </button>
                <button type="button" class="btn btn-grd-disabled waves-effect" onclick="closeModalCreateSupplierMaterial()">    @lang('app.component.button.close')</button>
                <button type="button" style="text-transform: none" class="btn btn-grd-primary waves-effect" onclick="saveModalCreateSupplierMaterial()"> @lang('app.component.button.save')</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\supplier\supplier_material\create.js?version=4', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
