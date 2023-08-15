<div class="modal fade" id="modal-payment-detail-work-history" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.work-history-treasurer.payment-detail.title')</h4>
                <div class="d-flex">
                    <div class="float-right">
                        <label class="open-employee-detail-work-history-treasurer reset-text font-weight-bold"></label>
                        <label>  -  </label>
                        <label class="open-time-detail-work-history-treasurer reset-text font-weight-bold"></label>
                        <label>  -  </label>
                        <label class="close-time-detail-work-history-treasurer reset-text font-weight-bold"></label>
                    </div>
                    <button type="button" class="close ml-4" onclick="closeModalPaymentDetailWorkHistory()" onkeypress="closeModalPaymentDetailWorkHistory()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body" id="loading-modal-payment-detail-work-history-treasurer">
                <ul class="nav nav-tabs md-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab"
                           href="#tab1-payment-detail-work-history-treasurer" role="tab"
                           aria-expanded="true">@lang('app.work-history-treasurer.payment-detail.tab1')
                            <span class="label label-success" id="total-record-cash-payment-detail-work-history-treasurer">0</span></a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab"
                           href="#tab2-payment-detail-work-history-treasurer" role="tab"
                           id="tab-table-out"
                           aria-expanded="false">@lang('app.work-history-treasurer.payment-detail.tab2')
                            <span class="label label-warning" id="total-record-transfer-payment-detail-work-history-treasurer">0</span></a>
                        <div class="slide"></div>
                    </li>
                </ul>
                <div class="m-0 card">
                    <div class="tab-content card-block">
                        <div class="tab-pane active" id="tab1-payment-detail-work-history-treasurer"
                             role="tabpanel" aria-expanded="true">
                            <div class="table-responsive new-table">
                                <table class="table" id="table-cash-payment-detail-work-history-treasurer">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center">@lang('app.work-history-treasurer.payment-detail.stt')</th>
                                            <th rowspan="2" class="text-left">@lang('app.work-history-treasurer.payment-detail.code')</th>
                                            <th rowspan="2" class="text-left">@lang('app.work-history-treasurer.payment-detail.employee')</th>
                                            <th rowspan="2" class="text-left">@lang('app.work-history-treasurer.payment-detail.target')</th>
                                            <th rowspan="2" class="text-left">@lang('app.work-history-treasurer.payment-detail.reason')</th>
                                            <th class="text-right">@lang('app.work-history-treasurer.payment-detail.amount')</th>
                                            <th rowspan="2" class="text-center">@lang('app.work-history-treasurer.payment-detail.time')</th>
                                            <th rowspan="2" class="text-center"></th>
                                        </tr>
                                        <tr>
                                            <th class="text-right seemt-fz-14"
                                                id="total-cash-payment-detail-work-history-treasurer">0
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2-payment-detail-work-history-treasurer"
                             role="tabpanel" aria-expanded="true">
                            <div class="table-responsive new-table">
                                <table class="table" id="table-transfer-payment-detail-work-history-treasurer">
                                    <thead>
                                        <tr>
                                            <th  rowspan="2" class="text-center">@lang('app.work-history-treasurer.payment-detail.stt')</th>
                                            <th  rowspan="2" class="text-left">@lang('app.work-history-treasurer.payment-detail.code')</th>
                                            <th  rowspan="2" class="text-left">@lang('app.work-history-treasurer.payment-detail.employee')</th>
                                            <th  rowspan="2" class="text-left">@lang('app.work-history-treasurer.payment-detail.target')</th>
                                            <th  rowspan="2" class="text-left">@lang('app.work-history-treasurer.payment-detail.reason')</th>
                                            <th  class="text-right">@lang('app.work-history-treasurer.payment-detail.amount')</th>
                                            <th  rowspan="2" class="text-center">@lang('app.work-history-treasurer.payment-detail.time')</th>
                                            <th  rowspan="2" class="text-center"></th>
                                        </tr>
                                        <tr>
                                            <th class="text-right seemt-fz-14"
                                                id="total-transfer-payment-detail-work-history-treasurer">0
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\js\treasurer\work_history\payment_detail.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
