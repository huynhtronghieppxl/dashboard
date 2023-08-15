<div class="modal fade" id="modal-detail-fund-period-treasurer" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center w-100 justify-content-between">
                    <h4 class="modal-title text-center">@lang('app.fund-period-treasurer.detail.title')</h4>
                    <div class="d-flex align-items-center">
                        <label class="label label-lg" id="status-detail-fund-period-treasurer"></label>
                        <button type="button" class="close" onclick="closeModalDetailFundPeriodTreasurer()"
                                onkeypress="closeModalDetailFundPeriodTreasurer()">
                            <i class="fi-rr-cross"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-body" id="loading-modal-detail-fund-period-treasurer">
                <ul class="nav nav-tabs md-tabs md-6-tabs" role="tablist">
                    <li class="nav-item">
                        <a id="detail-fund-period-treasurer-info" class="nav-link active" data-toggle="tab"
                           onclick="openModalDetailFundPeriodTreasurerInfo()" href="javascript:void(0)"
                           role="tab"
                           aria-expanded="true">@lang('app.fund-period-treasurer.detail.title-right')
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a id="detail-fund-period-treasurer-payment" class="nav-link" data-toggle="tab"
                           href="javascript:void(0)" onclick="openModalDetailFundPeriodTreasurerPayment()"
                           role="tab"
                           aria-expanded="true">@lang('app.fund-period-treasurer.detail.tab1')
                            <span class="label label-warning" id="total-record-tab1-detail">0</span>
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a id="detail-fund-period-treasurer-receipts" class="nav-link" data-toggle="tab"
                           href="javascript:void(0)" onclick="openModalDetailFundPeriodTreasurerReceipts()"
                           role="tab"
                           aria-expanded="true">@lang('app.fund-period-treasurer.detail.tab2')
                            <span class="label label-success" id="total-record-tab2-detail">0</span></a>
                        <div class="slide"></div>
                    </li>
                </ul>
                <div class="card-block card m-0 pt-0 flex-sub">
                    <div id="tab1-detail-fund-period-treasurer" role="tabpanel">
                        <div class="card-block">
                            <h6 class="sub-title m-b-0 f-w-600 col-form-label-fz-15">
                                THÔNG TIN KỲ</h6>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <p class="mt-1 mb-1 f-w-600 col-form-label-fz-15">@lang('app.fund-period-treasurer.detail.name')</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                        id="name-detail-fund-period-treasurer">---</h6>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <p class="mt-1 mb-1 f-w-600 col-form-label-fz-15">@lang('app.fund-period-treasurer.detail.from')</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                        id="from-detail-fund-period-treasurer">{{date('d/m/Y')}}</h6>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <p class="mt-1 mb-1 f-w-600 col-form-label-fz-15">@lang('app.fund-period-treasurer.detail.to')</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                        id="to-detail-fund-period-treasurer">{{date('d/m/Y')}}</h6>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <p class="mt-1 mb-1 f-w-600 col-form-label-fz-15">Ngày tạo</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                        id="created-at-detail-fund-period-treasurer">{{date('d/m/Y')}}</h6>
                                </div>
                                {{--                            </div>--}}
                                {{--                            <div class="row">--}}
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <p class="mt-1 mb-1 f-w-600 col-form-label-fz-15">Ngày duyệt</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                        id="ngay-duyet">{{date('d/m/Y')}}</h6>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <p class="mt-1 mb-1 f-w-600 col-form-label-fz-15">Ghi chú</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                        id="note-detail-fund-period-treasurer">---</h6>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <p class="mt-1 mb-1 f-w-600 col-form-label-fz-15">@lang('app.fund-period-treasurer.detail.employee-create')</p>
                                    <div class="d-flex mb-1 align-items-center">
                                        <img class="image-size-detail img-radius" src="/images/tms/default.jpeg"
                                             id="employee-avatar-detail-fund-period"
                                             onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 ml-1"
                                            id="employee-detail-fund-period-treasurer">---</h6>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <p class="mt-1 mb-1 f-w-600 col-form-label-fz-15"
                                       id="label-employee-complete-detail-fund-period-treasurer">@lang('app.fund-period-treasurer.detail.employee-complete')</p>
                                    <p class="mt-1 mb-1 f-w-600 col-form-label-fz-15 d-none"
                                       id="label-employee-cancel-detail-fund-period-treasurer">@lang('app.fund-period-treasurer.detail.employee-cancel')</p>
                                    <div class="d-flex mb-1 align-items-center">
                                        <img class="image-size-detail img-radius" src="/images/tms/default.jpeg"
                                             id="complete-employee-avatar-detail-fund-period"
                                             onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 ml-1"
                                            id="employee-complete-detail-fund-period-treasurer">---</h6>
                                    </div>
                                </div>
                            </div>
                            {{--                            <h6 class="sub-title m-b-0 f-w-600 col-form-lable-fz-15 pt-3">--}}
                            {{--                                THÔNG TIN NGƯỜI</h6>--}}
                            <h6 class="sub-title m-b-0 f-w-600 col-form-label-fz-15 pt-3">
                                THÔNG TIN SỐ TIỀN</h6>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <p class="mt-1 mb-1 f-w-600 col-form-label-fz-15">@lang('app.fund-period-treasurer.detail.order')</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                        id="order-detail-fund-period-treasurer">0</h6>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <p class="mt-1 mb-1 f-w-600 col-form-label-fz-15">@lang('app.fund-period-treasurer.detail.open') @lang('app.fund-period-treasurer.detail.note-1')</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                        id="open-detail-fund-period-treasurer">0</h6>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <p class="mt-1 mb-1 f-w-600 col-form-label-fz-15">@lang('app.fund-period-treasurer.detail.in') @lang('app.fund-period-treasurer.detail.note-2')</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                        id="in-detail-fund-period-treasurer">0</h6>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <p class="mt-1 mb-1 f-w-600 col-form-label-fz-15">@lang('app.fund-period-treasurer.detail.out') @lang('app.fund-period-treasurer.detail.note-3')</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                        id="out-to-purchase-detail-fund-period-treasurer">0</h6>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <p class="mt-1 mb-1 f-w-600 col-form-label-fz-15">@lang('app.fund-period-treasurer.detail.close') @lang('app.fund-period-treasurer.detail.note-4')</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                        id="closing-to-purchase-detail-fund-period-treasurer">0</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                        phiếu chi--}}
                    <div class="d-none" id="tab2-detail-fund-period-treasurer" role="tabpanel">
                        <div class="col-sm-12 pl-0 pr-0 pt-0">
                            <div class="table-responsive new-table">
                                <table id="table-payment-detail-fund-period-treasurer" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">@lang('app.fund-period-treasurer.detail.stt')</th>
                                        <th rowspan="2">@lang('app.fund-period-treasurer.detail.code')</th>
                                        <th rowspan="2">@lang('app.fund-period-treasurer.detail.employee')</th>
                                        <th rowspan="2">@lang('app.fund-period-treasurer.detail.target')</th>
                                        <th rowspan="2">@lang('app.fund-period-treasurer.detail.reason')</th>
                                        <th rowspan="2">@lang('app.fund-period-treasurer.detail.date')</th>
                                        <th>@lang('app.fund-period-treasurer.detail.amount')</th>
                                        <th rowspan="2">@lang('app.fund-period-treasurer.detail.action')</th>
                                    </tr>
                                    <tr>
                                        <th id="total-payment-detail-fund-period-treasurer" class="seemt-fz-16"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{--                        phiếu thu--}}
                    <div class="d-none" id="tab3-detail-fund-period-treasurer" role="tabpanel">
                        <div class="col-sm-12 pt-0 pl-0 pr-0">
                            <div class="table-responsive new-table">
                                <table id="table-receipt-detail-fund-period-treasurer" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">@lang('app.fund-period-treasurer.detail.stt')</th>
                                        <th rowspan="2">@lang('app.fund-period-treasurer.detail.code')</th>
                                        <th rowspan="2">@lang('app.fund-period-treasurer.detail.employee')</th>
                                        <th rowspan="2">@lang('app.fund-period-treasurer.detail.target1')</th>
                                        <th rowspan="2">@lang('app.fund-period-treasurer.detail.reason1')</th>
                                        <th rowspan="2">@lang('app.fund-period-treasurer.detail.date1')</th>
                                        <th>@lang('app.fund-period-treasurer.detail.amount')</th>
                                        <th rowspan="2">@lang('app.fund-period-treasurer.detail.action')</th>
                                    </tr>
                                    <tr>
                                        <th id="total-receipt-detail-fund-period-treasurer" class="seemt-fz-16"></th>
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
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\js\treasurer\fund_period\detail.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
