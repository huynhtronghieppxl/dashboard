<div class="modal fade" id="modal-select-multiple-material" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">DANH SÁCH NGUYÊN LIỆU</h4>
                <button type="button" class="close" onclick="closeModalSelectMultipleMaterial()" onkeypress="closeModalSelectMultipleMaterial()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-select-multiple-material">
                <div class="row d-flex">
                    <div class="col-lg-12 edit-flex-auto-fill pl-0">
                        <div class="card card-block w-100 mr-0">
                            <div class="table-responsive new-table">
                                <table class="table"
                                       id="table-material-by-inventory-supplier-order">
                                    <thead>
                                    <tr>
                                        <th>
                                            <div class="form-validate-checkbox">
                                                <div class="checkbox-form-group" style="justify-content: flex-start">
                                                    <input type="checkbox" style="top: 4px" id="check-all-apply-material"/>
                                                </div>
                                            </div>
                                        </th>
                                        <th>@lang('app.supplier-order.detail-restaurant.name')</th>
                                        <th>@lang('app.supplier-order.detail-restaurant.price')</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalAddMultiMaterialSupplierOrder()"
                     onkeypress="saveModalAddMultiMaterialSupplierOrder()">
                    <i class="fi-rr-disk"></i>
                    <span>Thêm nguyên liệu</span></div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="/js/manage/supplier_order/select_multi_material.js?version=1"></script>
@endpush
