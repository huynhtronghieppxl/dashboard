<div class="modal fade" id="modal-update-request-supplier-order" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.supplier-order.update-request.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateRequestSupplierOrder()" onkeypress="closeModalUpdateRequestSupplierOrder()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left background-body-color" id="loading-update-request-supplier-order">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill pl-0">
                        <div class="card card-block flex-sub w-100 my-1">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single"
                                                    id="select-material-update-request-supplier-order">
                                            </select>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table" id="table-material-update-request-supplier-order">
                                    <thead>
                                        <tr>
                                            <th>@lang('app.supplier-order.update-request.stt')</th>
                                            <th class="text-center">@lang('app.supplier-order.update-request.name')</th>
                                            <th>@lang('app.supplier-order.update-request.remain-quantity')</th>
                                            <th>@lang('app.supplier-order.update-request.quantity')</th>
                                            <th>@lang('app.supplier-order.update-request.supplier') <i class="fa fa-exclamation-circle text-inverse pointer" data-toggle="tooltip" data-placement="top" data-original-title="NCC (Giá nguyên liệu)"></i></th>
                                            <th>@lang('app.supplier-order.update-request.price')</th>
                                            <th>@lang('app.supplier-order.update-request.total-price')</th>
                                            <th></th>
                                            <th class="d-none"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub w-100 my-1" id="box-list-update-request-supplier-order">
                            <h5 class="text-bold sub-title f-w-600 col-form-label-fz-15">@lang('app.supplier-order.update-request.title-right')</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.update-request.branch')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="branch-update-request-supplier-order"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.update-request.inventory')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="inventory-update-request-supplier-order"></h6>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.update-request.employee')</label>
                                    <div class="d-flex mb-1">
                                        <img class="image-size-detail img-radius" src="" id="image-supplier-update-request-order-supplier-order" onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill class-link" id="employee-update-request-supplier-order" style="margin: auto 5px"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.update-request.create')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="create-update-request-supplier-order"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-validate-checkbox">
                                        <i class="icofont icofont-disc"></i>
                                        <div class="checkbox-zoom zoom-primary">
                                            <label>
                                                <input type="checkbox" id="send-update-request-supplier-order"
                                                       checked=""
                                                       required="">
                                                <span class="cr">
                                                    <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                </span>
                                                <span></span>
                                            </label>
                                        </div>
                                        <label for="$(this).attr(id)">
                                            <i class="icofont $(this).attr(data-icon)"></i>
                                            @lang('app.supplier-order.update-request.send')
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="text hidden-item col-lg-12 p-1 text-warning text-left">(*) @lang('app.supplier-order.update-request.sub-title')</label>
                            </div>
                            <div class="border-dashed"></div>
                            <div class="row mt-2">
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.update-request.total-price')
                                    </label>
                                    <label class="f-w-600 col-form-label-fz-15 f-right"
                                           id="total-amount-update-request-supplier-order"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-grd-danger" onclick="cancelRequestSupplierOrder()"
                        onkeypress="cancelRequestSupplierOrder()">@lang('app.component.button.cancel-vote')
                </button>
                <button type="button"
                        class="btn btn-grd-primary" onclick="saveModalUpdateRequestSupplierOrder()"
                        onkeypress="saveModalUpdateRequestSupplierOrder()">@lang('app.component.button.save')
                </button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/manage/warehouse/supplier_order/update_request.js?version=6')}}"></script>
@endpush
