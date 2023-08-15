<div class="modal fade" id="modal-update-point-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.point-data.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdatePointData()" onkeypress="closeModalUpdatePointData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-update-point-data">
                <div class="card-block card m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input id="point-update-point-data" class="form-control text-right" data-min="1" data-max="999999999"/>
                            <label for="point-update-point-data">@lang('app.point-data.update.point') </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input id="salary-update-point-data" class="form-control text-right" data-min="100" data-money="1" value="0" data-max="999999999"/>
                            <label for="salary-update-point-data">@lang('app.point-data.update.salary') </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalUpdatePointData()" onkeypress="saveModalUpdatePointData()" aria-invalid="btn-create-employee-manage">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
<span class="d-none" id="id-update-point-data"></span>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/personnel/point/update.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
