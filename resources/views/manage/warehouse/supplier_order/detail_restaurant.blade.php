<div class="modal fade" id="modal-detail-restaurant-supplier-order" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.supplier-order.detail-restaurant.title')</h4>
                <button type="button" class="close" onclick="closeModalDetailRestaurantSupplierOrder()" onkeypress="closeModalDetailRestaurantSupplierOrder()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-detail-restaurant-supplier-order">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill pl-0">
                        <div class="card card-block w-100">
                            <h5 class="text-bold sub-title col-form-label-fz-15 f-w-600">@lang('app.supplier-order.detail-restaurant.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table"
                                       id="table-material-detail-restaurant-supplier-order">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.supplier-order.detail-restaurant.stt')</th>
                                        <th class="text-center">@lang('app.supplier-order.detail-restaurant.name')</th>
                                        <th>@lang('app.supplier-order.detail-restaurant.quantity')</th>
                                        <th>@lang('app.supplier-order.detail-restaurant.price')</th>
                                        <th>@lang('app.supplier-order.detail-restaurant.total-price')</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub" id="boxlist-detail-restaurant-supplier-order">
                            <h5 class="text-bold sub-title f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-restaurant.title-right')</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-restaurant.branch')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="branch-detail-restaurant-supplier-order"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15 mb-0">@lang('app.supplier-order.detail-restaurant.supplier')</label>
                                    <div class="d-flex mb-1">
                                        <img class="image-size-detail img-radius" src="/images/tms/default.jpeg" id="image-supplier-detail-restaurant-supplier-order" onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill" id="supplier-detail-restaurant-supplier-order" style="margin: auto 5px"></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15 mb-0">@lang('app.supplier-order.detail-restaurant.employee')</label>
                                    <div class="d-flex mb-1">
                                        <img class="image-size-detail img-radius" src="/images/tms/default.jpeg" id="image-employee-detail-restaurant-supplier-order" onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill class-link" id="employee-detail-restaurant-supplier-order" style="margin: auto 5px"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-restaurant.date')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="create-detail-restaurant-supplier-order">{{date('d/m/Y')}} {{date('H:m')}}</h6>
                                </div>
                            </div>
{{--                            <div class="form-group row">--}}
{{--                                <div class="col-lg-6">--}}
{{--                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-restaurant.date')</label>--}}
{{--                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="date-detail-restaurant-supplier-order">{{date('d/m/Y')}} {{date('H:m')}}</h6>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="border-dashed"></div>
                            <div class="row mt-2">
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15 ">@lang('app.supplier-order.detail-restaurant.total-price')
                                    </label>
                                    <label class="f-w-600 col-form-label-fz-15 f-right"
                                           id="total-amount-detail-restaurant-supplier-order">0</label>
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
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js/manage/warehouse/supplier_order/detail_restaurant.js?version=1')}}"></script>
@endpush
