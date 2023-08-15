<div class="modal fade" id="modal-detail-order-supplier-order" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.supplier-order.detail-order.title')</h4>
                <button type="button" class="close" onclick="closeModalDetailOrderSupplierOrder()" onkeypress="closeModalDetailOrderSupplierOrder()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-detail-order-supplier-order">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill pl-0">
                        <div class="card card-block my-1 w-100 mr-0">
                            <h5 class="text-bold sub-title col-form-label-fz-15 f-w-600">@lang('app.supplier-order.detail-order.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table"
                                       id="table-material-detail-order-supplier-order"
                                       aria-describedby="table-material-detail-order-supplier-order">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.supplier-order.detail-order.stt')</th>
                                        <th>@lang('app.supplier-order.detail-order.name')</th>
                                        <th class="text-left">@lang('app.supplier-order.detail-order.quantity')</th>
                                        <th class="text-right">@lang('app.supplier-order.detail-order.price')</th>
                                        <th class="text-right">@lang('app.supplier-order.detail-order.total-price')</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub my-1" id="box-list-detail-order-supplier-order"
                             style="margin-bottom: 20px; !important;">
                            <h5 class="text-bold sub-title col-form-label-fz-15 f-w-600">@lang('app.supplier-order.detail-order.title-right')</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-order.branch')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="branch-detail-order-supplier-order"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-order.code')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="code-detail-order-supplier-order"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-order.supplier')</label><br>
                                    <div class="d-flex mb-1">
                                        <img src="" id="image-supplier-detail-order-supplier-order" onerror="this.src='/images/tms/default.jpeg'" class="img-radius" alt="" style="width: 2rem;height: 2rem"/>
                                        <label class="f-w-400 text-muted col-form-label-fz-15 mb-0 mt-1 ml-1" id="supplier-detail-order-supplier-order"></label>
                                    </div>
                                </div>
{{--                                <div class="col-lg-6">--}}
{{--                                    <label--}}
{{--                                        class="f-w-600 col-form-label-fz-15 mb-1">@lang('app.supplier-order.detail-order.delivery-expected')</label>--}}
{{--                                    <h6 class="f-w-400 text-muted col-form-label-fz-15 mt-2" id="time-detail-order-supplier-order">{{date('d/m/Y')}}</h6>--}}
{{--                                </div>--}}
                            </div>
                            <div class="row d-none" id="div-employee-detail-order-supplier-order">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-order.employee')</label>
                                    <div class="d-flex mb-1">
                                        <img src="" id="image-employee-detail-order-supplier-order" onerror="this.src='/images/tms/default.jpeg'" class="img-radius" alt="" style="width: 2rem;height: 2rem"/>
                                        <label class="f-w-400 text-muted col-form-label-fz-15 mb-0 mt-1 ml-1 class-link" id="employee-detail-order-supplier-order"></label><br>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15 mb-1">@lang('app.supplier-order.detail-order.create')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15 mt-2" id="create-detail-order-supplier-order"></h6>
                                </div>
                            </div>
                            <div class="row d-none" id="div-supplier-system-detail-order-supplier-order">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-order.employee')
                                    </label>
                                    <div class="d-flex mb-1">
                                        <img src="" id="image-supplier-system-detail-order-supplier-order" onerror="this.src='/images/tms/default.jpeg'" class="img-radius" alt="" style="width: 2rem;height: 2rem"/>
                                        <label class="f-w-400 text-muted col-form-label-fz-15 mb-0 mt-1 ml-1 class-link" id="supplier-system-detail-order-supplier-order"></label><br>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15 mb-1">@lang('app.supplier-order.detail-order.create')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15 mt-2" id="supplier-system-create-detail-order-supplier-order"></h6>
                                </div>
                            </div>
                            <div class="row d-none" id="div-received-detail-order-supplier-order">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-order.employee-received')</label>
                                <div class="d-flex mb-1">
                                    <img src="" id="image-employee-received-detail-order-supplier-order" onerror="this.src='/images/tms/default.jpeg'" class="img-radius" alt="" style="width: 2rem;height: 2rem"/>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15 mb-0 mt-2 ml-1 class-link" id="employee-received-detail-order-supplier-order"></h6>
                                </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-order.date')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15 mt-2" id="date-detail-order-supplier-order">{{date('d/m/Y')}} {{date('H:m')}}</h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-order.employee-delivery')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="employee-delivery-detail-order-supplier-order"></h6>
                                </div>
                                <div class="col-lg-6" id="signature-delivery-detail-order-supplier-order-div">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-order.signature-delivery')</label>
                                    <div>
                                        <img alt="" onerror="this.src='/images/tms/default.jpeg'"
                                             id="signature-delivery-detail-order-supplier-order" src=""
                                             style="width: auto;height: 100px;border: 2px solid #c2c2c2;"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-none" id="div-cancel-detail-order-supplier-order">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-order.employee-cancel')</label><br>
                                <div class="d-flex mb-1">
                                    <img src="" id="image-employee-cancel-detail-order-supplier-order" onerror="this.src='/images/tms/default.jpeg'" class="img-radius d-none" alt="" style="width: 2rem;height: 2rem"/>
                                    <label class="f-w-400 text-muted col-form-label-fz-15 mb-0 mt-1 ml-1" id="employee-cancel-detail-order-supplier-order"></label>
                                </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-order.date-cancel')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15 mt-2" id="date-cancel-detail-order-supplier-order"></h6>
                                </div>
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-order.reason')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="reason-detail-order-supplier-order"></h6>
                                </div>
                            </div>
                            <div class="border-dashed mt-2"></div>
                            <div class="row mt-2 mb-2">
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-order.total-price')</label>
                                    <label class="f-w-600 col-form-label-fz-15 f-right mt-1" id="amount-detail-order-supplier-order">0</label>
                                </div>
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-order.return-amount')</label>
                                    <label class="f-w-600 col-form-label-fz-15 f-right"
                                           id="total-return-detail-order-supplier-order">0</label>
                                </div>
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-order.amount')</label>
                                    <label class="f-w-600 col-form-label-fz-15 f-right mt-1"
                                           id="total-amount-detail-order-supplier-order">0</label>
                                </div>
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-order.discount')</label>
                                    <label class="f-w-400 text-muted col-form-label-fz-15 f-right mt-1" id="discount-detail-order-supplier-order">0</label> <span class="col-form-label-fz-15 f-w-400" id="discount-percent-detail-order-supplier-order"></span>
                                </div>
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-order.vat')</label>
                                    <label class="f-w-400 text-muted col-form-label-fz-15 f-right mt-1" id="vat-detail-order-supplier-order">0</label> <span class="col-form-label-fz-15 f-w-400" id="vat-percent-detail-order-supplier-order"></span>
                                </div>
                            </div>
                            <div class="border-dashed"></div>
                            <div class="row">
                                <div class="col-lg-12 mt-2">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-order.payment-amount')</label>
                                    <label class="f-w-600 col-form-label-fz-15 f-right"
                                           id="total-payment-detail-order-supplier-order">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@include('manage.employee.info')
@include('build_data.material.material.detail')
@push('scripts')
    <script type="text/javascript"
            src="/js/manage/supplier_order/detail_order.js?version=14"></script>
@endpush
