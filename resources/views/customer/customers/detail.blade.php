<div class="modal fade" id="modal-detail-customers" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.customers.detail.title')</h4>
                <button type="button" class="close" onclick="closeModalDetailCustomers()" onkeypress="closeModalDetailCustomers()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-detail-customers">
                <ul class="nav nav-tabs md-tabs md-5-tabs" role="tablist">
                    <li class="nav-item nav-5">
                        <a id="first-tab-loading-modal" class="nav-link active" data-toggle="tab" href="#tab-loading-modal-detail-customers" role="tab" aria-expanded="true">
                            @lang('app.customers.detail.title-info')
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item nav-5">
                        <a class="nav-link" data-toggle="tab" href="#tab1-detail-customers" role="tab" aria-expanded="true">
                            @lang('app.customers.detail.tab1') <span class="label label-warning" id="total-record-tab1-detail-customers">0</span>
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item nav-5">
                        <a class="nav-link" data-toggle="tab" href="#tab2-detail-customers" role="tab" aria-expanded="false">
                            @lang('app.customers.detail.tab2') <span class="label label-info" id="total-record-tab2-detail-customers">0</span>
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item nav-5">
                        <a class="nav-link" data-toggle="tab" href="#tab3-detail-customers" role="tab" aria-expanded="false">
                            @lang('app.customers.detail.tab3') <span class="label label-success" id="total-record-tab3-detail-customers">0</span>
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item nav-5">
                        <a class="nav-link" data-toggle="tab" href="#tab4-detail-customers" role="tab" aria-expanded="false">
                            @lang('app.customers.detail.tab4') <span class="label label-primary" id="total-record-tab4-detail-customers">0</span>
                        </a>
                        <div class="slide"></div>
                    </li>
                </ul>
                <div class="card m-0">
                    <div class="tab-content card-block p-2 mb-0">
                        <div class="tab-pane active" id="tab-loading-modal-detail-customers" role="tabpanel">
                            <div class="row">
                                <div class="col-xl-12 col-md-12">
                                    <div class="user-card-full" id="load-user-card-full">
                                        <div class="row m-l-0 m-r-0">
                                            <div class="col-sm-5 user-profile" id="color-detail-customers">
                                                <div class="card-block text-center text-white">
                                                    <div class="mt-3">
                                                        <img id="avatar-detail-customers" onerror="imageDefaultOnLoadError($(this))" class="img-radius" alt="Avatar" style="width: 12.5rem;height: 12.5rem" />
                                                    </div>
                                                    <div class="mt-3 card-block z-depth-bottom waves-effect color-hex-code rounded text-light px-4 py-3" id="card-color-detail-membership-card" style="background-color: rgb(185, 242, 255); width: 63%;margin: 0 auto;">
                                                        <div class="row align-items-center">
                                                            <div class="col-lg-7 pl-0">
                                                                <div class="row align-items-center">
                                                                    <img src="https://is5-ssl.mzstatic.com/image/thumb/Purple112/v4/80/13/3a/80133a1a-acd7-3ee4-9290-d29edf61e1c9/AppIcon-1x_U007emarketing-0-7-0-sRGB-85-220.png/246x0w.webp" width="40px" style="border-radius: 13px;" alt="" />
                                                                    <div class="ml-2">
                                                                        @lang('app.customers.card-detail.title')
                                                                        <p>@lang('app.customers.card-detail.title2')</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-5 pr-0 text-right">
                                                                <h4 style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;" class="text-uppercase mb-0" id="card-name-detail-membership-card"></h4>
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex align-items-center mt-3">
                                                            <div class="col-lg-6 pl-0">
                                                                <p class="card-point text-uppercase text-center">@lang('app.customers.card-detail.point')</p>
                                                                <h4 class="mb-0 text-center" id="card-point-detail-membership-card"></h4>
                                                            </div>
                                                            <div class="col-sm-6 text-right pr-0">
                                                                <p class="mb-0">@lang('app.customers.detail.created')</p>
                                                                <span id="card-created-at-detail-membership-card"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="card-block">
                                                    <h6 class="sub-title m-b-0 f-w-600 col-form-label-fz-15">@lang('app.customers.detail.title-info')</h6>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.customers.detail.name')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="name-detail-customers"></h6>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.customers.detail.birthday')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="birthday-detail-customers"></h6>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.customers.detail.gender')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="gender-detail-customers"></h6>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.customers.detail.phone')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="phone-detail-customers"></h6>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.customers.detail.email')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="email-detail-customers"></h6>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.customers.detail.address')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="address-detail-customers"></h6>
                                                        </div>
                                                    </div>
                                                    <br/>
                                                    <h6 class="sub-title m-b-0 f-w-600 col-form-label-fz-15">@lang('app.customers.detail.title-card')</h6>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.customers.detail.name-card')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="name-card-detail-customers"></h6>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.customers.detail.used-amount')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="used-amount-detail-customers">0</h6>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.customers.detail.point')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="point-detail-customers">0</h6>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.customers.detail.alo-point')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="alo-point-detail-customers">0</h6>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.customers.detail.accumulate-point')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="accumulate-point-detail-customers">0</h6>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.customers.detail.promotion-point')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="promotion-point-detail-customers">0</h6>
                                                        </div>
                                                    </div>
                                                    <br/>
                                                    <h6 class="sub-title m-b-0 f-w-600 col-form-label-fz-15 m-t-10px">@lang('app.customers.detail.title-company')</h6>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.customers.detail.company-name')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="company-name-detail-customers"></h6>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.customers.detail.company-tax')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="company-tax-detail-customers"></h6>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.customers.detail.company-phone')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="company-phone-detail-customers"></h6>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.customers.detail.company-address')</p>
                                                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="company-address-detail-customers"></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab1-detail-customers" role="tabpanel">
                            <div class="col-sm-12 p-0">
                                <div class="table-responsive new-table">
                                    <table id="table-order-customers-detail" class="table">
                                        <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center">@lang('app.customers.detail.stt')</th>
                                            <th rowspan="2">@lang('app.customers.detail.code')</th>
                                            <th rowspan="2">@lang('app.customers.detail.table')</th>
                                            <th rowspan="2">@lang('app.customers.detail.employee')</th>
                                            <th rowspan="2">@lang('app.customers.detail.amount')</th>
                                            <th rowspan="2">@lang('app.customers.detail.vat')</th>
                                            <th rowspan="2">@lang('app.customers.detail.discount')</th>
                                            <th class="text-right">@lang('app.customers.detail.total-amount')</th>
                                            <th rowspan="2" class="text-center">@lang('app.customers.detail.created')</th>
                                            <th rowspan="2" class="text-center">@lang('app.customers.detail.date')</th>
                                            <th rowspan="2" class="text-center">@lang('app.customers.detail.status')</th>
                                            <th rowspan="2" class="text-center"></th>
                                            <th rowspan="2" class="d-none"></th>
                                        </tr>
                                        <tr>
                                            <th id="total-amount-detail-customers">0</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2-detail-customers" role="tabpanel">
                            <div class="col-sm-12 p-0">
                                <div class="table-responsive new-table">
                                    <table id="table-history-point-customers-detail" class="table">
                                        <thead>
                                        <tr>
                                            <th class="w-5">@lang('app.customers.detail.stt')</th>
                                            <th class="w-25">@lang('app.customers.detail.note')</th>
                                            <th class="w-15">@lang('app.customers.detail.point')</th>
                                            <th class="w-15">@lang('app.customers.detail.accumulate-point')</th>
                                            <th class="w-15">@lang('app.customers.detail.promotion-point')</th>
                                            <th class="w-15">@lang('app.customers.detail.total-point')</th>
                                            <th class="w-20">@lang('app.customers.detail.created')</th>
                                            <th class="d-none"></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3-detail-customers" role="tabpanel">
                            <div class="col-sm-12 p-0">
                                <div class="table-responsive new-table">
                                    <table id="table-history-point-order-food-customers-detail" class="table">
                                        <thead>
                                        <tr>
                                            <th class="w-5">@lang('app.customers.detail.stt')</th>
                                            <th class="w-35">@lang('app.customers.detail.note')</th>
                                            <th class="w-10">mã đơn hàng</th>
                                            <th class="w-10">@lang('app.customers.detail.accumulate-point')</th>
                                            <th class="w-20">ngày</th>
                                            <th></th>
                                            <th class="d-none"></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab4-detail-customers" role="tabpanel">
                            <div class="col-sm-12 p-0">
                                <div class="table-responsive new-table">
                                    <table id="table-history-recharge-card-customers-detail" class="table">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.customers.detail.stt')</th>
                                            <th>@lang('app.customers.detail.card-name')</th>
                                            <th>@lang('app.customers.detail.value-amount')</th>
                                            <th>@lang('app.customers.detail.bonus')</th>
                                            <th>@lang('app.customers.detail.recharge-employee')</th>
                                            <th>@lang('app.customers.detail.date-created')</th>
                                            <th>@lang('app.customers.detail.branch')</th>
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
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@include('manage.bill.detail')
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/customer/customers/detail.js?version=4', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
