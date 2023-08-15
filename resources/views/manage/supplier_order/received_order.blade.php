<div class="modal fade" id="modal-received-order-supplier-order" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.supplier-order.received-order.title')</h4>
                <button type="button" class="close" onclick="closeModalReceivedOrderSupplierOrder()" onkeypress="closeModalReceivedOrderSupplierOrder()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-received-order-supplier-order">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill pl-0">
                        <div class="card card-block w-100 mr-0">
                            <h5 class="text-bold sub-title col-form-label-fz-15 f-w-600">@lang('app.supplier-order.received-order.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table"
                                       id="table-material-received-order-supplier-order">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.supplier-order.received-order.stt')</th>
                                        <th>@lang('app.supplier-order.received-order.name')</th>
                                        <th>@lang('app.supplier-order.received-order.quantity')</th>
                                        <th>@lang('app.supplier-order.received-order.accept-quantity')</th>
                                        <th>@lang('app.supplier-order.received-order.price')</th>
                                        <th>@lang('app.supplier-order.received-order.price-reality')</th>
                                        <th>@lang('app.supplier-order.received-order.total-price')</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub col-form-label-fz-15 f-w-600" id="box-list-received-order-supplier-order">
                            <h5 class="text-bold sub-title">@lang('app.supplier-order.received-order.title-right')</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.received-order.branch')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="branch-received-order-supplier-order"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.received-order.code')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="code-received-order-supplier-order"></h6>
                                </div>
                            </div>
                            <div class="row pb-2">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.received-order.employee')</label><br>
                                <div class="d-flex mb-1">
                                    <img src="" id="image-employee-received-order-supplier-order" onerror="this.src='/images/tms/default.jpeg'" class="img-radius" alt="Avatar" style="width: 2rem;height: 2rem"/>
                                    <label class="f-w-400 text-muted col-form-label-fz-15 m-1" id="employee-received-order-supplier-order"></label>
                                </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.received-order.supplier')</label><br>
                                <div class="d-flex mb-1">
                                    <img src="" id="image-supplier-received-order-supplier-order" onerror="this.src='/images/tms/default.jpeg'" class="img-radius" alt="Avatar" style="width: 2rem;height: 2rem"/>
                                    <label class="f-w-400 text-muted col-form-label-fz-15 m-1" id="supplier-received-order-supplier-order"></label>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.received-order.delivery-expected')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="date-received-order-supplier-order">{{date('d/m/Y')}} {{date('H:m')}}</h6>
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <div class="form-group">
                                        <div class="form-validate-input">
                                            <input type="text" id="date-received-supplier-order"
                                                   class="input-sm form-control text-center input-datetimepicker p-1"
                                                   value="{{date('d/m/Y')}}">
                                            <label>
                                                @lang('app.supplier-order.received-order.received')
                                            </label>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-dashed"></div>
                            <div class="row m-t-2">
                                <div class="col-lg-12 mt-1">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.received-order.total-price')</label>
                                    <span class="f-w-400 col-form-label-fz-15 f-right"
                                          id="amount-received-order-supplier-order">0</span>
                                </div>
                            </div>
                            <div class="border-dashed"></div>
                            <div class="row m-t-15">
                                <div class="col-lg-12">
                                    <div class="form-group select2_theme validate-group">
                                        <div class="form-validate-select">
                                            <div class="col-lg-12 mx-0 px-0">
                                                <div class="col-lg-12 pr-0 select-material-box">
                                                    <select id="select-type-discount-employee-manage"
                                                            class="js-example-basic-single select2-hidden-accessible"
                                                            tabindex="-1" aria-hidden="true">
                                                        <option value="0" >Giá tiền</option>
                                                        <option value="1" selected>Phần trăm</option>
                                                    </select>
                                                    <label class="icon-validate"> Giá tiền (VNĐ) </label>
                                                    <div class="line"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input">
                                            <input type="text" id="discount-received-order-supplier-order" value="0"
                                                   class="form-control" data-number="1" data-max="100">
                                            <label>
                                                Phần trăm (%)
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                        <div class="link-href float-right">
                                            <span>Giảm giá:</span>
                                            <span id="text-discount-received-order-supplier-order">0</span>
                                        </div>
                                    </div>
                                    <div class="form-group validate-group d-none">
                                        <div class="form-validate-input">
                                            <input type="text" id="discount-price-received-order-supplier-order" value="0"
                                                   class="form-control" data-max="999999999" data-number="1">
                                            <label> Giảm giá  </label>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input">
                                            <input type="text" id="vat-received-order-supplier-order"
                                                   class="form-control" value="0" data-max="100" data-number="1">
                                            <label> @lang('app.supplier-order.received-order.vat') (%) </label>
                                            <div class="line"></div>
                                        </div>
                                        <div class="link-href float-right">
                                            <span>@lang('app.supplier-order.received-order.vat'):</span>
                                            <span id="text-vat-received-order-supplier-order">0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-dashed mt-1"></div>
                            <div class="row mt-2">
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.received-order.total-amount')</label>
                                    <label class="f-w-600 col-form-label-fz-15 f-right"
                                           id="total-amount-received-order-supplier-order">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalReceivedOrderSupplierOrder()"
                        onkeypress="saveModalReceivedOrderSupplierOrder()">
                        <i class="fi-rr-disk"></i>
                        <span>@lang('app.supplier-order.received-order.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="/js/manage/supplier_order/received_order.js?version=7"></script>
@endpush
