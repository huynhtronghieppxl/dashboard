<div class="modal fade" id="modal-detail-kitchen-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.kitchen-data.detail.kitchen-detail')</h4>
                <button type="button" class="close" onclick="closeModalDetailKitchenData()"
                        onkeypress="closeModalDetailKitchenData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-detail-kitchen-data">
                <ul class="nav nav-tabs md-tabs" role="tablist" id="nav-tabs-kitchen">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" id="info-kitchen-tab"
                           href="#info-kitchen-data-tab" role="tab" aria-expanded="true" data-id="1">
                            Thông tin
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-id="2" data-toggle="tab" id="disable-kitchen-tab"
                           href="#food-kitchen-data-tab" role="tab" aria-expanded="false">
                            Món ăn
                            <span class="label label-success" id="total-record-food-kitchen-data">0</span>
                        </a>
                        <div class="slide"></div>
                    </li>
                </ul>
                <div class="card card-block m-0">
                    <div class="tab-content mb-0">
                        <div class="tab-pane active" id="info-kitchen-data-tab" role="tabpanel">
                            <div class=" card-block">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.kitchen-data.create.name')</p>
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                            id="name-detail-kitchen-data">---</h6>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.kitchen-data.update.type')</p>
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                            id="type-detail-kitchen-data">---</h6>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.kitchen-data.update.printer-paper-size')</p>
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                            id="printer-paper-size-detail-kitchen-data">---</h6>
                                    </div>

                                    <div class="col-sm-4">
                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.kitchen-data.update.printer-name')</p>
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                            id="printer-name-detail-kitchen-data">---</h6>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.kitchen-data.update.printer-ip')</p>
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                            id="printer-IP-detail-kitchen-data">---</h6>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.kitchen-data.update.printer-port')</p>
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                            id="printer-port-detail-kitchen-data">---</h6>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.kitchen-data.detail.create_at')</p>
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                            id="create-at-detail-kitchen-data">---</h6>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.kitchen-data.detail.update_at')</p>
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                            id="update-at-detail-kitchen-data">---</h6>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.kitchen-data.update.description')</p>
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                            id="description-detail-kitchen-data">---</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="food-kitchen-data-tab" role="tabpanel">
                            <div class="card card-block">
                                <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                                    <div class="table-responsive new-table">
                                        <table id="table-food-kitchen-data" class="table">
                                            <thead>
                                            <tr>
                                                <th>@lang('app.kitchen-data.table.stt')</th>
                                                <th>@lang('app.kitchen-data.table.name')</th>
                                                <th>Giá</th>
                                                <th>@lang('app.kitchen-data.table.action')</th>
                                                <th class="d-none"></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
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
@include('manage.food.brand.detail')
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js/build_data/kitchen/kitchen/detail.js?version=4', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
