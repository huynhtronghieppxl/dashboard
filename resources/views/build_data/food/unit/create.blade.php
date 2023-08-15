<div class="modal fade" id="modal-create-unit-food-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.unit-food-data.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateUnitFoodData()" onkeypress="closeModalCreateUnitFoodData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-create-unit-food-data">
                <div class="card-block card m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input id="name-create-unit-food-data" class="form-control" data-spec="1"   type="text" data-empty="1" data-min-length="2" data-max-length="50" style="line-height: 22px">
                            <label for="name-create-unit-food-data">
                                @lang('app.unit-food-data.create.name')
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none" data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại"
                        onclick="resetModalCreateUnitFoodData()"
                        onkeypress="resetModalCreateUnitFoodData()">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreateUnitFoodData()"
                     onkeypress="saveModalCreateUnitFoodData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\food\unit\create.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
