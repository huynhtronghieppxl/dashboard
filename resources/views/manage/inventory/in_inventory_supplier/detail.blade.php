<div class="modal fade" id="modal-detail-in-inventory-supplier" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title">Chi tiết phiếu nhập kho từ NCC</h4>
                <div class="d-flex align-items-center">
                    <h5 class="m-0" id="status-detail-in-inventory-supplier"></h5>
                    <button type="button" class="close ml-4" onclick="closeModalDetailInInventorySupplier()" onkeypress="closeModalDetailInInventorySupplier()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body text-left background-body-color" id="loading-modal-detail-in-inventory-supplier">
                <div id="body-detail-in-inventory-supplier">
                    <div class="row d-flex">
                        <div class="col-lg-8 edit-flex-auto-fill">
                            <div class="flex-sub card card-block w-100 my-1">
                                <h5 class="text-bold sub-title col-form-label-fz-15 f-w-600">@lang('app.in-inventory-supplier.detail.title-left')</h5>
                                <div class="table-responsive new-table">
                                    <table id="table-material-detail-in-inventory-supplier"
                                           class="table">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.in-inventory-supplier.detail.stt')</th>
                                            <th class="text-center">@lang('app.in-inventory-supplier.detail.name')</th>
                                            <th>@lang('app.in-inventory-supplier.detail.quantity')</th>
                                            <th>@lang('app.in-inventory-supplier.detail.price')</th>
                                            <th>@lang('app.in-inventory-supplier.detail.total-price')</th>
                                            <th></th>
                                            <th class="d-none"></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 edit-flex-auto-fill pl-0">
                            <div class="flex-sub card card-block w-100 my-1" id="box-list-detail-in-inventory-supplier">
                                <h5 class="text-bold sub-title col-form-label-fz-15 f-w-600">@lang('app.in-inventory-supplier.detail.title-right')</h5>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15 col-form-label">@lang('app.in-inventory-supplier.detail.branch')</label>
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15" id="branch-detail-in-inventory-supplier"></h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15 col-form-label">@lang('app.in-inventory-supplier.detail.code')</label>
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15" id="code-detail-in-inventory-supplier"></h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15 col-form-label">@lang('app.in-inventory-supplier.detail.supplier')</label>
                                        <div class="d-flex mb-1">
                                            <img class="image-size-detail img-radius" src="" id="image-supplier-detail-in-inventory-supplier" onerror="this.src='/images/tms/default.jpeg'">
                                            <h6 class="f-w-400 text-muted col-form-label-fz-15" id="supplier-detail-in-inventory-supplier" style="margin: auto 5px"></h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15 col-form-label">@lang('app.in-inventory-supplier.detail.inventory')</label>
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15 mt-2" id="inventory-detail-in-inventory-supplier"></h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15 col-form-label">@lang('app.in-inventory-supplier.detail.employee-create')</label>
                                        <div class="d-flex mb-1">
                                            <img class="image-size-detail img-radius" src="" id="image-employee-detail-in-inventory" onerror="this.src='/images/tms/default.jpeg'">
                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill class-link" id="employee-detail-in-inventory-supplier" style="margin: auto 5px"></h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15 col-form-label">@lang('app.in-inventory-supplier.detail.create')</label>
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15 mt-2" id="create-detail-in-inventory-supplier"></h6>
                                    </div>
                                    <div class="col-lg-12">
                                        <label
                                            class="f-w-600 col-form-label-fz-15 col-form-label">@lang('app.in-inventory-supplier.detail.delivery')</label>
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15" id="date-detail-in-inventory-supplier"></h6>
                                    </div>
                                </div>
                                <div class="border-dashed"></div>
                                <div class="row mt-2">
                                    <div class="col-lg-12">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-supplier.detail.total-price')
                                        </label>
                                        <label class="f-w-600 col-form-label-fz-15 f-right"
                                               id="total-sum-price-detail-in-inventory-supplier">0</label>
                                    </div>
                                    <div class="col-lg-12">
                                        <label
                                            class="f-w-600 col-form-label-fz-15 col-form-label">@lang('app.in-inventory-supplier.detail.discount')</label> <span class="f-w-400 col-form-label-fz-15" id="discount-percent-detail-in-inventory-supplier">0</span>
                                        <label class="f-w-400 text-muted col-form-label-fz-15 f-right"
                                               id="discount-detail-in-inventory-supplier">0</label>
                                    </div>
                                    <div class="col-lg-12">
                                        <label
                                            class="f-w-600 col-form-label-fz-15 col-form-label">@lang('app.in-inventory-supplier.detail.vat')</label> <span class="f-w-400 col-form-label-fz-15" id="vat-percent-detail-in-inventory-supplier">(0%)</span>
                                        <label class="f-w-400 text-muted col-form-label-fz-15 f-right" id="vat-detail-in-inventory-supplier">0</label>
                                    </div>
                                </div>
                                <div class="border-dashed"></div>
                                <div class="row mt-2">
                                    <div class="col-lg-12">
                                        <label
                                            class="f-w-600 col-form-label-fz-15 ">@lang('app.in-inventory-supplier.detail.total-final')
                                        </label>
                                        <label class="f-w-600 col-form-label-fz-15 f-right"
                                               id="total-final-detail-in-inventory-supplier">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('/js/manage/inventory/in_inventory_supplier/detail.js?version=4',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
