<div class="modal fade" id="modal-update-restaurant-supplier-order" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.supplier-order.update-restaurant.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateRestaurantSupplierOrder()" onkeypress="closeModalUpdateRestaurantSupplierOrder()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-update-restaurant-supplier-order">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill pl-0">
                        <div class="card card-block w-100 mr-0">
                            <h5 class="text-bold sub-title f-w-600 col-form-label-fz-15">@lang('app.supplier-order.update-restaurant.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table"
                                       id="table-material-update-restaurant-supplier-order">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.supplier-order.update-restaurant.stt')</th>
                                        <th class="text-left">@lang('app.supplier-order.update-restaurant.name')</th>
                                        <th>@lang('app.supplier-order.update-restaurant.quantity')</th>
                                        <th class="text-right">@lang('app.supplier-order.update-restaurant.price')</th>
                                        <th class="text-right">@lang('app.supplier-order.update-restaurant.total-price')</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub" id="boxlist-update-restaurant-supplier-order">
                            <h5 class="text-bold sub-title f-w-600 col-form-label-fz-15">@lang('app.supplier-order.update-restaurant.title-right')</h5>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.update-restaurant.branch')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="branch-update-restaurant-supplier-order"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.update-restaurant.supplier')</label>
                                    <div class="d-flex mb-1">
                                        <img class="image-size-detail img-radius" src="/images/tms/default.jpeg" id="image-supplier-update-restaurant-supplier-order" onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill" id="supplier-update-restaurant-supplier-order" style="margin: auto 5px"></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.update-restaurant.employee')</label>
                                    <div class="d-flex mb-1">
                                        <img class="image-size-detail img-radius" src="/images/tms/default.jpeg" id="image-employee-update-restaurant-supplier-order" onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill class-link" id="employee-update-restaurant-supplier-order" style="margin: auto 5px"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
{{--                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.update-restaurant.date')</label>--}}
                                    <label class="f-w-600 col-form-label-fz-15">Ngày tạo</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="create-update-restaurant-supplier-order">{{date('d/m/Y')}} {{date('H:m')}}</h6>
                                </div>
                            </div>
{{--                            <div class="form-group row">--}}
{{--                                <div class="col-lg-6">--}}
{{--                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.update-restaurant.date')</label>--}}
{{--                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="date-update-restaurant-supplier-order">{{date('d/m/Y')}} {{date('H:m')}}</h6>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="border-dashed"></div>
                            <div class="row mt-2">
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.update-restaurant.total-price')</label>
                                    <label class="f-w-600 col-form-label-fz-15 f-right"
                                           id="total-amount-update-restaurant-supplier-order">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-red seemt-bg-red seemt-btn-hover-red" onclick="cancelRestaurantSupplierOrder()"
                        onkeypress="cancelRestaurantSupplierOrder()">
                        <i class="fi-rr-trash"></i>
                        <span>@lang('app.component.button.cancel-vote')</span>
                </div>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalUpdateRestaurantSupplierOrder()"
                        onkeypress="saveModalUpdateRestaurantSupplierOrder()">
                        <i class="fi-rr-disk"></i>
                        <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="/js/manage/supplier_order/update_restaurant.js?version=1"></script>
@endpush
