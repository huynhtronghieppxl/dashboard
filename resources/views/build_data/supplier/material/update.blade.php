<div class="modal fade" id="modal-update-supplier-material-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="text-transform: none">@lang('app.supplier-data.material.update.title')</h4>
            </div>
            <div class="modal-body text-left pt-4" id="loading-modal-update-supplier-material">
                <div class="card-block w-100 border-table">
                    <div class="row">
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input id="name-update-supplier-material-data" class="form-control" type="text" data-empty="1"   data-min-length="2" data-max-length="50">
                                    <label for="name-update-supplier-material-data">
                                        <i class="icofont icofont-tag"></i>@lang('app.supplier-data.material.create.name') <span class="text-danger">(*)</span>
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input id="cost-price-update-supplier-material-data" value="0" class="form-control text-right" data-type="currency-edit" placeholder="0" data-max="100000000"  data-money="1">
                                    <label for="cost-price-update-supplier-material-data">
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
                                <div class="form-validate-select ">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="category-update-supplier-material-data" data-select=”1” data-empty="1" class="js-example-basic-single select2-hidden-accessible">
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
                                    <input id="retail-price-update-supplier-material-data" value="0" class="form-control text-right" data-type="currency-edit" placeholder="0" data-money="1"  data-max="100000000">
                                    <label for="retail-price-update-supplier-material-data">
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
                                            <select id="unit-update-supplier-material-data" data-select=”1” data-empty="1" class="js-example-basic-single select2-hidden-accessible" data-icon="icofont-cubes">
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
                                    <input id="wastage-rate-update-supplier-material-data" class="form-control text-right input-tooltip" type="text" value="0" data-placement="top" data-original-title="@lang('app.supplier-data.material.update.exp-wastage-rate-percent')" data-float="1" data-max="100" data-tooltip="1">
                                    <label for="wastage-rate-update-supplier-material-data">
                                        <i class="icofont icofont icofont-law-alt-1"></i>@lang('app.supplier-data.material.update.wastage-rate') (@lang('app.supplier-data.material.update.wastage-rate-percent')) </label>
                                    <div class="line"></div>
                                    <div class="tool-tip">
                                        <i class="fa fa-exclamation-circle text-inverse pointer" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.supplier-data.material.update.exp-wastage-rate-percent')"></i>
                                    </div>
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
                                            <select id="specifications-update-supplier-material-data" data-select=”1” data-empty="1" class="js-example-basic-single select2-hidden-accessible">
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
                                    <input id="out-stock-quantity-update-supplier-material-data" value="0" class="form-control text-right" placeholder="0" data-min="0" data-max="100000">
                                    <label for="out-stock-quantity-update-supplier-material-data">
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
                <button type="button" class="btn btn-grd-disabled waves-effect" onclick="closeModalUpdateSupplierMaterial()">@lang('app.component.button.close')</button>
                <button type="button" style="text-transform: none" class="btn btn-grd-primary waves-effect" onclick="saveModalUpdateSupplierMaterial()">@lang('app.component.button.save')</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\supplier\supplier_material\update.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
