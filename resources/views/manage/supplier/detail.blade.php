<div class="modal fade" id="modal-detail-supplier-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document" style="padding-bottom: 13px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.supplier-manage.detail.title')</h4>
                <button type="button" class="close ml-4" onclick="closeModalDetailSupplierManage()" onkeypress="closeModalDetailSupplierManage()">
                    <i class="fi-rr-cross"></i>
                </button>

            </div>
            <div class="modal-body" id="loading-modal-detail-supplier-manage">
                <ul class="nav nav-tabs md-tabs md-6-tabs" role="tablist">
                    <li class="nav-item">
                        <a id="tab-Detail" class="nav-link active" data-toggle="tab" href="#supplier-manage-tab0" role="tab" aria-expanded="true">
                             @lang('app.supplier-manage.detail.info-tab')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#supplier-manage-tab-contact" role="tab" aria-expanded="true">
                             @lang('app.supplier-manage.detail.contact-tab')
                            <span class="label bg-secondary" id="total-record-tab-contact">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#supplier-manage-tab-material-using" role="tab" aria-expanded="true">
                            @lang('app.supplier-manage.detail.material-tab')
                            <span class="label label-success" id="total-record-tab-material-using">0</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#supplier-manage-tab-material" role="tab" aria-expanded="false">
                            @lang('app.supplier-manage.detail.all-material-tab')
                            <span class="label label-inverse" id="total-record-tab-material">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#supplier-manage-tab-waiting-bill" role="tab" aria-expanded="false">
                             @lang('app.supplier-manage.detail.waiting-tab')
                            <span class="label label-warning" id="total-record-tab-waiting-bill">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#supplier-manage-tab-debt" role="tab" aria-expanded="false">
                            @lang('app.supplier-manage.detail.debt-tab')
                            <span class="label label-danger" id="total-record-tab-debt">0</span>
                        </a>
                    </li>
                </ul>
                <div class="card card-block m-0">
                    <div class="tab-content">
                        <div class="tab-pane active" id="supplier-manage-tab0" role="tabpanel">
                            <div class="card-block m-0 p-0">
                                <div class="row align-items-center">
                                    <div class="col-lg-4">
                                        <div class="card-block text-white user-profile d-flex justify-content-center align-items-center">
                                            <div class="m-b-25">
                                                <img
                                                    id="avatar-detail-supplier-manage"
                                                    onerror="imageDefaultOnLoadError($(this))"
                                                    class="img-radius img-employee-custom"
                                                    style="border-radius: 50%; width: 14rem; height: 14rem;"
                                                    alt="Avatar"
                                                    src="{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <h6 class="sub-title m-b-0 f-w-600 col-form-label-fz-15">@lang('app.supplier-manage.detail.info-suplier')</h6>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-xs-12">
                                                <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-manage.detail.name')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15" id="name-detail-supplier-manage" style="word-break: break-all;"></h6>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-xs-12">
                                                <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-manage.detail.type')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15" id="type-detail-supplier-manage"></h6>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-xs-12">
                                                <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-manage.detail.create')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15" id="create-detail-supplier-manage"></h6>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-xs-12">
                                                <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-manage.detail.phone')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15" id="phone-detail-supplier-manage"></h6>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-xs-12">
                                                <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-manage.detail.address')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15" id="address-detail-supplier-manage"></h6>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-xs-12">
                                                <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-manage.detail.tax')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15" id="code-detail-supplier-manager">---</h6>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-xs-12">
                                                <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-manage.detail.email')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage text-break col-form-label-fz-15" id="email-detail-supplier-manage" style="word-break: break-all;">---</h6>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-xs-12">
                                                <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-manage.detail.website')</p>
                                                <a class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15" id="website-detail-supplier-manage" style="word-break: break-all;">---</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-manage.detail.description')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15" id="description-detail-supplier-manage" data-limit-text="100" style="word-break: break-all;">---</h6>
                                            </div>
                                        </div>
                                        <h6 class="sub-title m-b-0 f-w-600 col-form-label-fz-15 mt-3">thông tin sổ mua hàng của nhà cung cấp</h6>
                                        <div class="card-block pl-0">
                                            <div class="row">
                                                <label class="col-sm-5 f-w-600 reset-data-detail-employee-manage col-form-label-fz-15 pl-0">
                                                    @lang('app.supplier-manage.detail.done-order')
                                                    <label for="" class="text-muted col-form-label-fz-15">(<label class="col-form-label-fz-15" id="done-order-detail-supplier-manage"></label> đơn)</label>
                                                </label>
                                                <label class="col-sm-7 f-w-600 reset-data-detail-employee-manage col-form-label-fz-15 text-right" id="done-amount-detail-supplier-manage">0</label>
                                            </div>
                                            <div class="row">
                                                <label class="col-sm-5 f-w-600 reset-data-detail-employee-manage col-form-label-fz-15 pl-0">
                                                    @lang('app.supplier-manage.detail.waiting-order')
                                                    <label for="" class="text-muted col-form-label-fz-15">(<label class="col-form-label-fz-15" id="waiting-order-detail-supplier-manage"></label> đơn)</label>
                                                </label>
                                                <label class="col-sm-7 f-w-600 reset-data-detail-employee-manage col-form-label-fz-15 text-right" id="waiting-amount-detail-supplier-manage">0</label>
                                            </div>
                                            <div class="row" style="border-bottom: 1px solid;">
                                                <label class="col-sm-5 f-w-600 reset-data-detail-employee-manage col-form-label-fz-15 pl-0">
                                                    @lang('app.supplier-manage.detail.debt-order')
                                                    <label for="" class="text-muted col-form-label-fz-15">(<label class="col-form-label-fz-15" id="debt-order-detail-supplier-manage"></label> đơn)</label>
                                                </label>
                                                <label class="col-sm-7 f-w-600 reset-data-detail-employee-manage col-form-label-fz-15 text-right" id="debt-amount-detail-supplier-manage">0</label>
                                            </div>
                                            <div class="row mt-2">
                                                <label class="col-sm-5 f-w-600 reset-data-detail-employee-manage col-form-label-fz-15 pl-0">
                                                    @lang('app.supplier-manage.detail.total-order')
                                                    <label for="" class="text-muted col-form-label-fz-15">(<label class="col-form-label-fz-15" id="total-order-detail-supplier-manage"></label> đơn)</label>
                                                </label>
                                                <label class="col-sm-7 f-w-600 reset-data-detail-employee-manage col-form-label-fz-15 text-right" id="total-amount-detail-supplier-manage">0</label>
                                            </div>
                                            <div class="row">
                                                <label class="col-sm-5 f-w-600 reset-data-detail-employee-manage col-form-label-fz-15 pl-0">
                                                    @lang('app.supplier-manage.detail.return-order')
                                                    <label for="" class="text-muted col-form-label-fz-15">(<label class="col-form-label-fz-15" id="return-order-detail-supplier-manage"></label> đơn)</label>
                                                </label>
                                                <label class="col-sm-7 f-w-600 reset-data-detail-employee-manage col-form-label-fz-15 text-right" id="return-amount-detail-supplier-manage">0</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-block tab-pane" id="supplier-manage-tab-contact" role="tabpanel">
                            <div class="table-responsive new-table">
                                <table id="table-contact-detail-supplier-manage" class="table fix-size-table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.supplier-manage.detail.stt')</th>
                                        <th>@lang('app.supplier-manage.detail.name')</th>
                                        <th>@lang('app.supplier-manage.detail.phone')</th>
                                        <th>@lang('app.supplier-manage.detail.email')</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="card-block tab-pane" id="supplier-manage-tab-material-using" role="tabpanel">
                            <div class="table-responsive new-table">
                                <table id="table-material-using-supplier-manage" class="table fix-size-table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.supplier-manage.detail.stt')</th>
                                        <th>@lang('app.supplier-manage.detail.name')</th>
                                        <th>@lang('app.supplier-manage.detail.rate')</th>
                                        <th>@lang('app.supplier-manage.detail.restaurant')</th>
                                        <th>@lang('app.supplier-manage.detail.category')</th>
                                        <th>@lang('app.supplier-manage.detail.amount-tab')</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="card-block tab-pane" id="supplier-manage-tab-material" role="tabpanel">
                            <div class="table-responsive new-table">
                                <table id="table-material-supplier-manage" class="table fix-size-table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.supplier-manage.detail.stt')</th>
                                        <th>@lang('app.supplier-manage.detail.name')</th>
                                        <th>@lang('app.supplier-manage.detail.category')</th>
                                        <th>@lang('app.supplier-manage.detail.amount-tab')</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="card-block tab-pane" id="supplier-manage-tab-waiting-bill" role="tabpanel">
                            <div class="table-responsive new-table">
                                <table id="table-waiting-bill-supplier-manage" class="table fix-size-table">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">@lang('app.supplier-manage.detail.stt')</th>
                                        <th rowspan="2">@lang('app.supplier-manage.detail.code')</th>
                                        <th rowspan="2">@lang('app.supplier-manage.detail.employee')</th>
                                        <th rowspan="2">@lang('app.supplier-manage.detail.total-material')</th>
                                        <th class="text-right">@lang('app.supplier-manage.detail.total-amount')</th>
                                        <th class="text-right">@lang('app.supplier-manage.detail.return-amount')</th>
                                        <th class="text-right">@lang('app.supplier-manage.detail.payment-amount')</th>
                                        <th rowspan="2">@lang('app.supplier-manage.detail.date')</th>
                                        <th rowspan="2"></th>
                                        <th rowspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th id="total-amount-in-waiting-detail-supplier" class="seemt-fz-16">0</th>
                                        <th id="total-amount-return-waiting-detail-supplier" class="seemt-fz-16">0</th>
                                        <th id="total-amount-payment-waiting-detail-supplier" class="seemt-fz-16">0</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="card-block tab-pane" id="supplier-manage-tab-debt" role="tabpanel">
                            <div class="table-responsive new-table">
                                <table id="table-debt-supplier-manage" class="table fix-size-table">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">@lang('app.supplier-manage.detail.stt')</th>
                                        <th rowspan="2">@lang('app.supplier-manage.detail.code')</th>
                                        <th rowspan="2">@lang('app.supplier-manage.detail.employee')</th>
                                        <th rowspan="2">@lang('app.supplier-manage.detail.total-material')</th>
                                        <th class="text-right">@lang('app.supplier-manage.detail.total-amount')</th>
                                        <th class="text-right">@lang('app.supplier-manage.detail.return-amount')</th>
                                        <th class="text-right">@lang('app.supplier-manage.detail.payment-amount')</th>
                                        <th rowspan="2">@lang('app.supplier-manage.detail.date')</th>
                                        <th rowspan="2"></th>
                                        <th rowspan="2">@lang('app.supplier-manage.detail.action')</th>
                                    </tr>
                                    <tr>
                                        <th id="total-amount-in-debt-detail-supplier" class="seemt-fz-16">0</th>
                                        <th id="total-amount-return-debt-detail-supplier" class="seemt-fz-16">0</th>
                                        <th id="total-amount-payment-debt-detail-supplier" class="seemt-fz-16">0</th>
                                    </tr>
                                    </thead>
                                </table>
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
@include('manage.supplier_order.detail_order')
@include('manage.employee.detail')
@push('scripts')
    <script type="text/javascript" src="{{asset('/js/manage/supplier/detail.js?version=4',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
