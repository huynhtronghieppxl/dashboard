<div class="modal fade" id="modal-create-material-unit-food-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title ">@lang('app.material-unit-food.create.title')</h4>
            </div>
            <div class="modal-body text-left create-unit-data" id="create-material-unit-food-data">
                <div class="row">
                    <div class="col-lg-12 px-0">
                        <div class="card-block">
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select mb-0">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="pr-0 select-material-box">
                                            <select id="unit-create-material-unit-food-data" data-select="1" >
                                                <option value="" disabled selected>@lang('app.material-unit-food.create.opt-default')</option>
                                            </select>
                                            <label class="icon-validate">
                                                    <i class="icofont icofont-cube"></i>
                                                @lang('app.material-unit-food.create.unit')<span class="text-danger">(*)</span>
                                                </label>
                                                <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select mb-0">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="pr-0 select-material-box">
                                            <select id="specifications-create-material-unit-food-data"
                                                    class="js-example-basic-single select2-hidden-accessible"
                                                    data-select="1">
                                                <option value="-1"
                                                        selected="">@lang('app.component.option-null')</option>
                                            </select>
                                            <label class="icon-validate">
                                                <i class="icofont icofont-cubes"></i>
                                                @lang('app.material-data.create.specifications')
                                                <span class="text-danger">(*)</span>
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input id="value-exchange-material-unit-food" class="form-control" type="text" data-empty="1" data-min-value-of="0" data-type="currency-edit">
                                    <label for="code-create-unit-data">
                                        <i class="icofont icofont-file-alt mr-0"></i>
                                        @lang('app.material-unit-food.create.value')
                                        <span class="text-danger">(*)</span>
                                    </label>
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
                        onclick="resetModalCreateMaterialUnitFoodData()"
                        onkeypress="resetModalCreateMaterialUnitFoodData()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <button type="button" class="btn btn-grd-disabled " onclick="closeModalCreateMaterialUnitFoodData()" onkeypress="closeModalCreateMaterialUnitFoodData()">@lang('app.component.button.close')</button>
                <button type="button" class="btn btn-grd-primary" onclick="saveModalCreateMaterialUnitFoodData()" onkeypress="saveModalCreateMaterialUnitFoodData()">@lang('app.component.button.save')</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\kitchen\material_unit_food\create.js?version=7',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
