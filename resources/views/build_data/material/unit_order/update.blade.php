<div class="modal fade" id="modal-update-unit-order-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title update-unit-order-data">@lang('app.unit-order-data.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateUnitOrderData()"
                        onkeypress="closeModalUpdateUnitOrderData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left update-unit-order-data">
                <div class="card-block card m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="name-update-unit-order-data" class="form-control" type="text" data-spec="1"
                                   data-empty="1" data-min-length="2" data-max-length="50">
                            <label for="value-update-payment-bill">
                                @lang('app.unit-order-data.update.name')
                                @include('layouts.start')
                            </label>
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveUpdateUnitOrderData()" onkeypress="saveUpdateUnitOrderData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\material\unit_order\update.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
