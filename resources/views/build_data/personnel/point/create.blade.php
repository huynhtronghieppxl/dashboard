<div class="modal fade" id="modal-create-point-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.point-data.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreatePointData()" onkeypress="closeModalCreatePointData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-create-point-data">
                <div class="card-block card m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input id="point-create-point-data" class="form-control text-right" data-type="currency-edit" value="1" data-min="1" data-max="999999999"/>
                            <label for="point-create-point-data">@lang('app.point-data.create.point') </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input id="salary-create-point-data" class="form-control text-right" value="0" data-min="100" data-money="1" data-max="999999999"/>
                            <label for="salary-create-point-data">@lang('app.point-data.create.salary') </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew" onclick="reloadModalCreatePointData()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreatePointData()"
                     onkeypress="saveModalCreatePointData()" aria-invalid="btn-create-employee-manage">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/personnel/point/create.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
