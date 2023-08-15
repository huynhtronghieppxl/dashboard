<style>
    .reset-discount-price{
        display: inline-block;
    }
</style>
<div class="modal fade" id="modal-return-order-supplier-order" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.supplier-order.return-order.title')</h4>
                <button type="button" class="close" onclick="closeModalReturnOrderSupplierOrder()" onkeypress="closeModalReturnOrderSupplierOrder()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-return-order-supplier-order">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill pl-0">
                        <div class="card card-block w-100">
                            <h5 class="text-bold sub-title col-form-label-fz-15 f-w-600">@lang('app.supplier-order.return-order.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table"
                                       id="table-material-return-order-supplier-order">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.supplier-order.return-order.stt')</th>
                                        <th>@lang('app.supplier-order.return-order.name')</th>
                                        <th>@lang('app.supplier-order.return-order.quantity')</th>
                                        <th>@lang('app.supplier-order.return-order.return-quantity')</th>
                                        <th>@lang('app.supplier-order.return-order.price')</th>
                                        <th>@lang('app.supplier-order.return-order.total-price')</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub" id="box-list-return-order-supplier-order">
                            <h5 class="text-bold sub-title col-form-label-fz-15 f-w-600">@lang('app.supplier-order.return-order.title-right')</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="col-form-label-fz-15 f-w-600 col-form-label ">@lang('app.supplier-order.return-order.branch')</label>
                                    <h6 class="col-form-label-fz-15 f-w-400 text-muted " id="branch-return-order-supplier-order"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="col-form-label-fz-15 f-w-600 col-form-label ">@lang('app.supplier-order.return-order.code')</label>
                                    <h6 class="col-form-label-fz-15 f-w-400 text-muted " id="code-return-order-supplier-order"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="col-form-label-fz-15 f-w-600 col-form-label">@lang('app.supplier-order.return-order.supplier')</label>
                                    <div class="d-flex mb-1">
                                        <img src="" id="image-supplier-return-order-supplier-order" onerror="this.src='/images/tms/default.jpeg'" class="img-radius" alt="" style="width: 2rem;height: 2rem"/>
                                        <label class="f-w-400 text-muted col-form-label-fz-15 mb-0 mt-1 ml-1" id="supplier-return-order-supplier-order"></label>
                                    </div>
                                </div>
{{--                                <div class="col-lg-6">--}}
{{--                                    <label--}}
{{--                                        class="col-form-label-fz-15 f-w-600 col-form-label">@lang('app.supplier-order.return-order.expected_delivery')</label>--}}
{{--                                    <h6 class="col-form-label-fz-15 f-w-400 text-muted" id="time-return-order-supplier-order">{{date('d/m/Y')}}</h6>--}}
{{--                                </div>--}}
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="col-form-label-fz-15 f-w-600 col-form-label">@lang('app.supplier-order.return-order.employee')</label>
                                    <div class="d-flex mb-1">
                                        <img src="" id="image-employee-return-order-supplier-order" onerror="this.src='/images/tms/default.jpeg'" class="img-radius" alt="" style="width: 2rem;height: 2rem"/>
                                        <label class="f-w-400 text-muted col-form-label-fz-15 mb-0 mt-1 ml-1" id="employee-return-order-supplier-order"></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="col-form-label-fz-15 f-w-600 col-form-label">@lang('app.supplier-order.return-order.time')</label>
                                    <h6 class="col-form-label-fz-15 f-w-400 text-muted" id="create-return-order-supplier-order">{{date('d/m/Y')}} {{date('H:m')}}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="col-form-label-fz-15 f-w-600 col-form-label">@lang('app.supplier-order.return-order.employee-received')</label>
                                    <div class="d-flex mb-1">
                                        <img src="" id="image-employee-received-return-order-supplier-order" onerror="this.src='/images/tms/default.jpeg'" class="img-radius" alt="" style="width: 2rem;height: 2rem"/>
                                        <label class="f-w-400 text-muted col-form-label-fz-15 mb-0 mt-1 ml-1 class-link" id="employee-received-return-order-supplier-order"></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="col-form-label-fz-15 f-w-600 col-form-label">@lang('app.supplier-order.return-order.date')</label>
                                    <h6 class="col-form-label-fz-15 f-w-400 text-muted" id="date-return-order-supplier-order">{{date('d/m/Y')}} {{date('H:m')}}</h6>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <label
                                        class="col-form-label-fz-15 f-w-600 col-form-label">@lang('app.supplier-order.return-order.employee-delivery')</label>
                                    <h6 class="col-form-label-fz-15 f-w-400 text-muted" id="employee-delivery-return-order-supplier-order"></h6>
                                </div>
                                <div class="col-lg-6" id="signature-delivery-return-order-supplier-order-div">
                                    <label
                                        class="col-form-label-fz-15 f-w-600 col-form-label">@lang('app.supplier-order.return-order.signature-delivery')</label>
                                    <div>
                                        <img id="signature-delivery-return-order-supplier-order"
                                             onerror="this.src='/images/tms/default.jpeg'" src=""
                                             style="width: auto;height: 100px;border: 2px solid #c2c2c2;"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-lg-12">
                                    <div class="col-form-label-fz-15 form-group validate-group">
                                        <div class="col-form-label-fz-15 form-validate-textarea">
                                            <div class="col-form-label-fz-15 form__group pt-2">
                                            <textarea class="col-form-label-fz-15 form__field" id="note-return-order-supplier-order" cols="5" data-note-max-length="255"
                                                      rows="5" data-note="1"></textarea>
                                                <label for="note-return-order-supplier-order"
                                                       class="col-form-label-fz-15 form__label icon-validate">
                                                    <i class="col-form-label-fz-15 fa fa-pencil-square-o pr-2"></i>
                                                    @lang('app.supplier-order.return-order.note')
{{--                                                    <span class="text-danger">(*)</span>--}}
                                                    @include('layouts.start')
                                                </label>
                                                <div class="line"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-dashed"></div>
                            <div class="row mt-2">
                                <div class="col-lg-12">
                                    <label
                                        class="col-form-label-fz-15 f-w-600 col-form-label">@lang('app.supplier-order.return-order.total-price')</label>
                                    <label class="col-form-label-fz-15 f-w-600 f-right" id="amount-return-order-supplier-order">0</label>
                                </div>
                                <div class="col-lg-12">
                                    <label
                                        class="col-form-label-fz-15 f-w-600 col-form-label">@lang('app.supplier-order.return-order.discount') <div class="reset-discount-price">(<span class="col-form-label-fz-15 f-w-400" id="discount-percent-return-order-supplier-order"></span>)</div></label>
                                    <label class="col-form-label-fz-15 f-w-400 text-muted f-right" id="discount-return-order-supplier-order">0</label>
                                </div>
                                <div class="col-lg-12 border-dashed">
                                    <label
                                        class="col-form-label-fz-15 f-w-600 col-form-label">@lang('app.supplier-order.return-order.vat') <div class="reset-discount-price">(<span class="col-form-label-fz-15 f-w-400" id="vat-percent-return-order-supplier-order"></span>)</div></label>
                                    <label class="col-form-label-fz-15 f-w-400 text-muted f-right" id="vat-return-order-supplier-order">0</label>
                                </div>
                                <div class="col-lg-12">
                                    <label
                                        class="col-form-label-fz-15 f-w-600 col-form-label col-form-label-fz-15">@lang('app.supplier-order.return-order.total-amount')</label>
                                    <label class="col-form-label-fz-15 f-w-600 f-right col-form-label-fz-15"
                                           id="total-amount-return-order-supplier-order">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-grd-primary waves-effect" onclick="saveModalReturnSupplierOrder()"
                        onkeypress="saveModalReturnSupplierOrder()">@lang('app.component.button.save')</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js/manage/warehouse/supplier_order/return_order.js?version=2')}}"></script>
@endpush
