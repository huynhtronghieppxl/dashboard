<div class="modal fade" id="modal-detail-request-supplier-order" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.supplier-order.detail-request.title')</h4>
                <div class="d-flex">
                    <h5 id="status-detail-order-request-manage"></h5>
                    <button type="button" class="close ml-4" onclick="closeModalDetailRequestSupplierOrder()" onkeypress="closeModalDetailRequestSupplierOrder()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body text-left background-body-color" id="loading-detail-request-supplier-order">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill pl-0">
                        <div class="card card-block w-100">
                            <h5 class="text-bold sub-title col-form-label-fz-15 f-w-600">@lang('app.supplier-order.detail-request.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-material-detail-request-supplier-order">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.supplier-order.detail-request.stt')</th>
                                        <th>@lang('app.supplier-order.detail-request.name')</th>
                                        <th>@lang('app.supplier-order.detail-request.remain-quantity')</th>
                                        <th>@lang('app.supplier-order.detail-request.quantity')</th>
                                        <th>@lang('app.supplier-order.detail-request.price')</th>
                                        <th>@lang('app.supplier-order.detail-request.total-price')</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub" id="box-list-detail-request-supplier-order">
                            <h5 class="text-bold sub-title col-form-label-fz-15 f-w-600 ">@lang('app.supplier-order.detail-request.title-right')</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-request.branch')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="branch-detail-request-supplier-order"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-request.inventory')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="inventory-detail-request-supplier-order"></h6>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-request.employee')</label>
                                    <div class="d-flex mb-1">
                                        <img class="image-size-detail img-radius" src="/images/tms/default.jpeg" id="image-employee-detail-request-order-supplier-order" onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill class-link" id="employee-detail-request-supplier-order" style="margin: auto 5px"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-request.request-date-create')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="create-detail-request-supplier-order">{{date('d/m/Y')}} {{date('H:m')}}</h6>
                                </div>
                            </div>
{{--                            <div class="row">--}}
{{--                                <div class="col-lg-12">--}}
{{--                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-request.date')</label>--}}
{{--                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="date-detail-request-supplier-order">{{date('d/m/Y')}} {{date('H:m')}}</h6>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="row d-none" id="div-reason-detail-request-supplier-order">
                                <div class="col-lg-12">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-request.reason')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="reason-detail-request-supplier-order"></h6>
                                </div>
                            </div>
                            <div class="border-dashed"></div>
                            <div class="row mt-2">
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-request.total-price')
                                        </label>
                                    <label class="f-w-600 col-form-label-fz-15 f-right"
                                           id="total-price-detail-request-supplier-order">0</label>
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
@include('build_data.material.material.detail')
@push('scripts')
    <script type="text/javascript" src="/js/manage/supplier_order/detail_request.js?version=2"></script>
@endpush
