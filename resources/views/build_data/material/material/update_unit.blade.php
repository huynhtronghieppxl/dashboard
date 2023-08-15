<div class="modal fade" id="modal-update-unit-food-maps" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Chuyển đổi đơn vị</h4>
                <div class="d-flex align-items-center">
                    <label class="label label-lg" id="status-text-detail"></label>
                    <button type="button" class="close ml-4" onclick="closeModalUpdateUnitMaterial()" onkeypress="closeModalUpdateUnitMaterial()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body" id="loading-modal-unit-food-maps">
                <div class="row" style="
                    border: 1px dashed;
                    padding: 8px 12px;
                    border-radius: 11px;
                    ">
                    <div class="col-lg-4" style="
                        border-right: 1px dashed;
                    ">
                        <div class="col-sm-12 mb-3 pl-0">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15 mr-3">Đơn vị cũ</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 mb-0" id="name-unit-update-brand-manage">---</h6>
                        </div>
                        <div class="col-sm-12 mb-3 pl-0">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15 mr-3">Quy cách cũ</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 mb-0" id="name-unit-specification-update-brand-manage">---</h6>
                        </div>
                    </div>
                    <div class="col-lg-4" style="
                                    display: flex;
                                    border-right: 1px dashed;
                                    flex-direction: column;
                                    justify-content: center;
                                    width: 100%;
                                ">
                                                        <div class="form-group validate-group" style="
                                    margin: 0px !important;
">
                            <div class="form-validate-input">
                                <input class="form-control" id="value-exchange-rate-material-data" data-type="currency-edit" value="1" data-float="1" data-value-min-value-of="0" data-max="100000">
                                <label for="value-exchange-update-specifications-material-data">
                                    Tỉ lệ chuyển đổi
                                    @include('layouts.start')
                                </label>
                                <div class="line"></div>
                            </div>
                            <div class="link-href"></div>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="col-sm-12 mb-3 row mb-4">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15 mr-3">Đơn vị mới :  </p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 mb-0" id="name-unit-new-update-brand-manage">---</h6>
                        </div>
                        <div class="form-group select2_theme validate-group" style="margin-bottom: 0px !important;">
                            <div class="form-validate-select mb-0">
                                <div class="mx-0 px-0">
                                    <div class="pr-0 select-material-box">
                                        <select id="value-name-update-unit-specifications-foods-maps-material-data" class="js-example-basic-single select2-hidden-accessible" data-select="1" tabindex="-1" aria-hidden="true">
                                        </select>
                                        <label class="icon-validate">
                                            Quy cách
                                            @include('layouts.start')
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-1 px-0">
                        <p class="m-b-10 f-w-600 col-form-label-fz-15 px-0">Mô tả</p>
                    </div>
                    <div class="col-11 row justify-content-center">
                        <h2 class="">
                            <span style="font-size: 30px !important;" id="note-value-exchange-update-spe-material-data">---</span>
                            <span style="font-size: 30px !important;" id="note-ratio-exchange-update-spe-material-data">1</span>
                            <span style="font-size: 30px !important;" id="new-unit-exchange-update-spe-material-data">---</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     id="detail-bill-liabilities"
                     onclick="saveModalUpdateUnitFoodMapsMaterial()"
                     onkeypress="saveModalUpdateUnitFoodMapsMaterial()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@include('build_data.kitchen.material_unit_food.create')
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js/build_data/material/material/update_unit.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
