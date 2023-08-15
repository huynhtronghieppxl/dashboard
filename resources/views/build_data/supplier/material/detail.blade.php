<div class="modal fade" id="modal-detail-supplier-material-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.supplier-data.material.detail.title')</h4>
                <h5 class="m-0" id="status-detail-supplier-material-data"></h5>
            </div>
            <div class="modal-body text-left" id="loading-modal-detail-supplier-material-data">
                <div class="card-block">
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-data.material.detail.name')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="supplier-material-name-Supplier-data"></h6>
                        </div>
                        <div class="col-sm-4">
                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-data.material.detail.cost-price')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="supplier-material-cost-price-Supplier-data"></h6>
                        </div>
                        <div class="col-sm-4">
                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-data.material.detail.specifications')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="supplier-material-specifications-Supplier-data"></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-data.material.detail.category')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="supplier-material-category-Supplier-data"></h6>
                        </div>
                        <div class="col-sm-4">
                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-data.material.detail.retail-price')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="supplier-material-retail-price-Supplier-data"></h6>
                        </div>
                        <div class="col-sm-4">
                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-data.material.detail.out-stock-quantity')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="supplier-material-out-stock-quantity-Supplier-data"></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-data.material.detail.unit')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="supplier-material-unit-Supplier-data"></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled waves-effect"
                        onclick="closeModalDetailSupplierMaterial()">@lang('app.component.button.close')</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\build_data\supplier\supplier_material\detail.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
