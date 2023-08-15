<div class="modal fade" id="modal-calc-create-material-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document" id="tab-size">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('app.material-data.create_calc.title')</h5>
                <button type="button" class="close" onclick="closeModalCalcCreateMaterialData()" onkeypress="closeModalCalcCreateMaterialData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left">
                <div class="card-block card m-0">
                    <div class="col-lg-12">
                        <div class="event-detailmeta">
                            <h4 style="color: #535165; text-align: center; font-size: 22px;">@lang('app.material-data.create_calc.title2')</h4>
                            <p style="color: #959ab5; font-size: 14px !important;text-align: center;">
                                @lang('app.material-data.create_calc.content')
                            </p>
                            <div class="text-center my-2 f-w-600">
                                <div class="row align-items-center justify-content-center py-2" style="color: #fa6342; border: 1px solid #ccc; font-size: 22px;border-style: dashed; border-radius: 11px">
                                    <div class="col-lg-3 px-0">
                                            @lang('app.material-data.create_calc.loss') (%) = </div>
                                    <div class="col-lg-3 px-0">
                                            <label class="mb-0" style="border-bottom: 1px solid #d2d2d2; display: block; font-size: 22px">
                                                @lang('app.material-data.create_calc.quantity-buy') - @lang('app.material-data.create_calc.quantity-receive')</label>
                                            <label class="mb-0" style="font-size: 23px">@lang('app.material-data.create_calc.quantity-buy')</label></div>
                                    <div class="col-lg-2 px-0">
                                            x 100%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 pl-5 ml-5" id="add-input-calc-quantity-loss">
                        <div class="row mb-2">
                            <p class="f-w-600 pr-2" style="color: #959ab5;">@lang('app.material-data.create_calc.type-loss'):</p>
                            <a href="javascript:void(0)" id="btn-add-input-calc-quantity-loss" class="text text-primary">@lang('app.material-data.create_calc.add')</a>
                        </div>
                        <div class="row col-lg-12 d-none" id="title-calc-loss-material">
                            <div class="col-md-4 text-center">
                                <label class="font-weight-bold">@lang('app.material-data.create_calc.quantity-buy')</label>
                            </div>
                            <div class="col-md-4 text-center">
                                <label class="font-weight-bold">@lang('app.material-data.create_calc.quantity-receive')</label>
                            </div>
                            <div class="col-md-2">
                                <p class="font-weight-bold">@lang('app.material-data.create_calc.loss') (%)</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="text-average-all-create-material-data f-w-600 col-form-label ml-0">@lang('app.material-data.create_calc.loss-average') (%)=
                            <span class="text" style="font-size: 25px; color: #fa6342" id="loss-average-all-create-material-data">
                                    0
                            </span>
                        </h5>
                        <p style="color: #959ab5; font-size: 24px">
                            @lang('app.material-data.create_calc.example')
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-custom">
                <button type="button" class="btn-renew d-none" onclick="resetModalCalcCreateMaterialData()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                        <i class="fa fa-eraser"></i>
                </button>

                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue d-none"
                     id="btn-confirm-create-calc-material"
                     onclick="confirmModalCalcCreateMaterialData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\material\material\create_calc.js?version=15', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
