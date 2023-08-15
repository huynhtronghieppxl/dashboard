<div class="modal fade" id="modal-detail-unit-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" id='content-material-update'>
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.unit-data.detail.title')</h4>
                <h5 class="m-0" id="status-detail-material-data"></h5>
                <button type="button" class="close" onclick="closeModalDetailUnitData()" onkeypress="closeModalDetailUnitData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-detail-unit-data">
                <div class="card-block card m-0">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-1 f-w-700 col-form-label-fz-15">@lang('app.unit-data.detail.name')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="name-detail-unit-data" style="word-break: break-all;">---</h6>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1 f-w-700 col-form-label-fz-15">@lang('app.unit-data.detail.code')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="code-detail-unit-data" style="word-break: break-all;">---</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="mb-1 f-w-700 col-form-label-fz-15">@lang('app.unit-data.detail.specifications')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="specifications-detail-unit-data">---</h6>
                        </div>
                        <div class="col-md-12">
                            <p class="mb-1 f-w-700 col-form-label-fz-15">@lang('app.unit-data.detail.description')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="des-detail-unit-data">---</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\material\unit\detail.js?version=7', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
