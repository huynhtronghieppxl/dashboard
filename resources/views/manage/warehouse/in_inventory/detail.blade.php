<div class="modal fade" id="modal-detail-in-inventory-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.in-inventory-manage.detail.title')</h4>
                <div class="d-flex align-items-center">
                    <h5 id="status-detail-in-inventory-manage"></h5>
                    <button type="button" class="close" onclick="closeModalCreateSupplierData()" onkeypress="closeModalCreateSupplierData()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body text-left background-body-color" id="loading-modal-detail-in-inventory-manage">
                <div id="body-detail-in-inventory-manage">
                    <div class="row d-flex">
                        <div class="col-lg-8 edit-flex-auto-fill">
                            <div class="flex-sub card card-block w-100 my-1">
                                <h5 class="text-bold sub-title col-form-label-fz-15 f-w-600">@lang('app.in-inventory-manage.detail.title-left')</h5>
                                <div class="table-responsive new-table">
                                    <table id="table-material-detail-in-inventory-manage"
                                           class="table">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.in-inventory-manage.detail.stt')</th>
                                            <th class="text-center">@lang('app.in-inventory-manage.detail.name')</th>
                                            <th>@lang('app.in-inventory-manage.detail.quantity')</th>
                                            <th>@lang('app.in-inventory-manage.detail.price')</th>
                                            <th>@lang('app.in-inventory-manage.detail.total-price')</th>
                                            <th></th>
                                            <th class="d-none"></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 edit-flex-auto-fill pl-0">
                            <div class="flex-sub card card-block w-100 my-1" id="box-list-detail-in-inventory-manage">
                                <h5 class="text-bold sub-title col-form-label-fz-15 f-w-600">@lang('app.in-inventory-manage.detail.title-right')</h5>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15 col-form-label">@lang('app.in-inventory-manage.detail.branch')</label>
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15" id="branch-detail-in-inventory-manage"></h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15 col-form-label">@lang('app.in-inventory-manage.detail.code')</label>
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15" id="code-detail-in-inventory-manage"></h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15 col-form-label">@lang('app.in-inventory-manage.detail.supplier')</label>
                                        <div class="d-flex mb-1">
                                            <img class="image-size-detail img-radius" src="" id="image-supplier-detail-in-inventory-manage" onerror="this.src='/images/tms/default.jpeg'">
                                            <h6 class="f-w-400 text-muted col-form-label-fz-15" id="supplier-detail-in-inventory-manage" style="margin: auto 5px"></h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15 col-form-label">@lang('app.in-inventory-manage.detail.inventory')</label>
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15 mt-2" id="inventory-detail-in-inventory-manage"></h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15 col-form-label">@lang('app.in-inventory-manage.detail.employee-create')</label>
                                        <div class="d-flex mb-1">
                                            <img class="image-size-detail img-radius" src="" id="image-employee-detail-in-inventory" onerror="this.src='/images/tms/default.jpeg'">
                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill class-link" id="employee-detail-in-inventory-manage" style="margin: auto 5px"></h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15 col-form-label">@lang('app.in-inventory-manage.detail.create')</label>
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15 mt-2" id="create-detail-in-inventory-manage"></h6>
                                    </div>
                                    <div class="col-lg-12">
                                        <label
                                            class="f-w-600 col-form-label-fz-15 col-form-label">@lang('app.in-inventory-manage.detail.delivery')</label>
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15" id="date-detail-in-inventory-manage"></h6>
                                    </div>
                                </div>
                                <div class="border-dashed"></div>
                                <div class="row mt-2">
                                    <div class="col-lg-12">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-manage.detail.total-price')
                                        </label>
                                        <label class="f-w-600 col-form-label-fz-15 f-right"
                                               id="total-sum-price-detail-in-inventory-manage">0</label>
                                    </div>
                                    <div class="col-lg-12">
                                        <label
                                            class="f-w-600 col-form-label-fz-15 col-form-label">@lang('app.in-inventory-manage.detail.discount')</label> <span class="f-w-400 col-form-label-fz-15" id="discount-percent-detail-in-inventory-manage">0</span>
                                        <label class="f-w-400 text-muted col-form-label-fz-15 f-right"
                                               id="discount-detail-in-inventory-manage">0</label>
                                    </div>
                                    <div class="col-lg-12">
                                        <label
                                            class="f-w-600 col-form-label-fz-15 col-form-label">@lang('app.in-inventory-manage.detail.vat')</label> <span class="f-w-400 col-form-label-fz-15" id="vat-percent-detail-in-inventory-manage">(0%)</span>
                                        <label class="f-w-400 text-muted col-form-label-fz-15 f-right" id="vat-detail-in-inventory-manage">0</label>
                                    </div>
                                </div>
                                <div class="border-dashed"></div>
                                <div class="row mt-2">
                                    <div class="col-lg-12">
                                        <label
                                            class="f-w-600 col-form-label-fz-15 ">@lang('app.in-inventory-manage.detail.total-final')
                                        </label>
                                        <label class="f-w-600 col-form-label-fz-15 f-right"
                                               id="total-final-detail-in-inventory-manage">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-grd-disabled" onclick="closeModalDetailInInventoryManage()"
                        onkeypress="closeModalDetailInInventoryManage()">@lang('app.component.button.close')</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{ asset('..\js\manage\inventory\in_inventory\detail.js?version=4')}}"></script>
@endpush
