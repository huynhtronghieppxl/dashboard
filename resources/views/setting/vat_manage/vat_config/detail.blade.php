<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal-detail-food-vat-setting">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.vat-setting.detail.title')</h4>
                <button type="button" class="close" onclick="closeModalDetailVatSetting()" onkeypress="closeModalDetailVatSetting()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-detail-food-vat-setting">
                <div class="card card-block">
                    <div class="table-responsive new-table">
                        <table class="table" id="table-addition-price-area-detail-food-branch-manage">
                            <thead>
                            <tr>
                                <th>@lang('app.vat-setting.detail.stt')</th>
                                <th>@lang('app.vat-setting.detail.name')</th>
                                <th>@lang('app.vat-setting.detail.category')</th>
                                <th>@lang('app.vat-setting.detail.unit')</th>
                                <th></th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\setting\vat_manage\vat_config\detail.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
