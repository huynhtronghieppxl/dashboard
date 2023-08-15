<div class="modal fade" id="modal-deposit-detail-work-history" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.work-history-treasurer.deposit-detail.title')</h4>
                <button type="button" class="close" onclick="closeModalDepositDetailWorkHistory()" onkeypress="closeModalDepositDetailWorkHistory()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-deposit-detail-work-history-treasurer">
                <ul class="nav nav-tabs md-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab"
                           href="#tab1-deposit-detail-work-history-treasurer" role="tab"
                           aria-expanded="true">@lang('app.work-history-treasurer.deposit-detail.tab1')
                            <span class="label label-success" id="total-record-cash-deposit-detail-work-history-treasurer">0</span></a>
                        <div class="slide"></div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab"
                           href="#tab2-deposit-detail-work-history-treasurer"
                           role="tab"
                           aria-expanded="false">@lang('app.work-history-treasurer.revenue-detail.tab2')
                            <span class="label label-primary" id="gettotal-record-bank-revenue-detail-work-history-treasurer">0</span></a>
                        <div class="slide"></div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab"
                           href="#tab3-deposit-detail-work-history-treasurer" role="tab"
                           id="tab-table-out"
                           aria-expanded="false">@lang('app.work-history-treasurer.deposit-detail.tab3')
                            <span class="label label-warning" id="total-record-transfer-deposit-detail-work-history-treasurer">0</span></a>
                        <div class="slide"></div>
                    </li>

                </ul>
                <div class="card m-0">
                    <div class="tab-content card-block">
                        <div class="tab-pane active" id="tab1-deposit-detail-work-history-treasurer"
                             role="tabpanel" aria-expanded="true">
                            <div class="table-responsive new-table">
                                <table class="table table-bordered" id="table-cash-deposit-detail-work-history-treasurer">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center">@lang('app.work-history-treasurer.deposit-detail.stt')</th>
                                            <th rowspan="2" class="text-left">@lang('app.work-history-treasurer.deposit-detail.code')</th>
                                            <th rowspan="2" class="text-left">@lang('app.work-history-treasurer.deposit-detail.customer')</th>
                                            <th class="text-right">@lang('app.work-history-treasurer.deposit-detail.amount')</th>
                                            <th rowspan="2" class="text-center">@lang('app.work-history-treasurer.deposit-detail.time')</th>
                                        </tr>
                                        <tr>
                                            <th class="text-right seemt-fz-14"
                                                id="total-cash-deposit-detail-work-history-treasurer">0
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2-deposit-detail-work-history-treasurer"
                             role="tabpanel" aria-expanded="true">
                            <div class="table-responsive new-table">
                                <table class="table table-bordered" id="table-bank-deposit-detail-work-history-treasurer">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center">@lang('app.work-history-treasurer.deposit-detail.stt')</th>
                                            <th rowspan="2" class="text-left">@lang('app.work-history-treasurer.deposit-detail.code')</th>
                                            <th rowspan="2" class="text-left">@lang('app.work-history-treasurer.deposit-detail.customer')</th>
                                            <th class="text-right">@lang('app.work-history-treasurer.deposit-detail.amount')</th>
                                            <th rowspan="2" class="text-center">@lang('app.work-history-treasurer.deposit-detail.time')</th>
                                        </tr>
                                        <tr>
                                            <th class="text-right seemt-fz-14"
                                                id="total-bank-deposit-detail-work-history-treasurer">0
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3-deposit-detail-work-history-treasurer"
                             role="tabpanel" aria-expanded="true">
                            <div class="table-responsive new-table">
                                <table class="table" id="table-transfer-deposit-detail-work-history-treasurer">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center">@lang('app.work-history-treasurer.deposit-detail.stt')</th>
                                            <th rowspan="2" class="text-left">@lang('app.work-history-treasurer.deposit-detail.code')</th>
                                            <th rowspan="2" class="text-left">@lang('app.work-history-treasurer.deposit-detail.customer')</th>
                                            <th class="text-right">@lang('app.work-history-treasurer.deposit-detail.amount')</th>
                                            <th rowspan="2" class="text-center">@lang('app.work-history-treasurer.deposit-detail.time')</th>
                                        </tr>
                                        <tr>
                                            <th class="text-right seemt-fz-14"
                                                id="total-transfer-deposit-detail-work-history-treasurer">0
                                            </th>
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
    <script type="text/javascript" src="{{ asset('..\js\treasurer\work_history\deposit_detail.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
