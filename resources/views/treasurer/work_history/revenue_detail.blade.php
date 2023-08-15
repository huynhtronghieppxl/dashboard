<div class="modal fade" id="modal-revenue-detail-work-history" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.work-history-treasurer.revenue-detail.title')</h4>
                <div class="d-flex">
                    <div class="float-right">
                        <label class="open-employee-detail-work-history-treasurer reset-text font-weight-bold"></label>
                        <label> - </label>
                        <label class="open-time-detail-work-history-treasurer reset-text font-weight-bold"></label>
                        <label> - </label>
                        <label class="close-time-detail-work-history-treasurer reset-text font-weight-bold"></label>
                    </div>
                    <button type="button" class="close ml-4" onclick="closeModalRevenueDetailWorkHistory()" onkeypress="closeModalRevenueDetailWorkHistory()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body" id="loading-modal-revenue-detail-work-history-treasurer">
                <ul class="nav nav-tabs md-tabs md-5-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab"
                           href="#tab1-revenue-detail-work-history-treasurer" role="tab"
                           aria-expanded="true">@lang('app.work-history-treasurer.revenue-detail.tab1')
                            <span class="label label-success" id="total-record-cash-revenue-detail-work-history-treasurer">0</span></a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab"
                           href="#tab2-revenue-detail-work-history-treasurer"
                           role="tab"
                           aria-expanded="false">@lang('app.work-history-treasurer.revenue-detail.tab2')
                            <span class="label label-primary" id="total-record-bank-revenue-detail-work-history-treasurer">0</span></a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab"
                           href="#tab3-revenue-detail-work-history-treasurer" role="tab"
                           id="tab-table-out"
                           aria-expanded="false">@lang('app.work-history-treasurer.revenue-detail.tab3')
                            <span class="label label-warning" id="total-record-transfer-revenue-detail-work-history-treasurer">0</span></a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab"
                           href="#tab4-revenue-detail-work-history-treasurer" role="tab"
                           id="tab-table-out"
                           aria-expanded="false">@lang('app.work-history-treasurer.revenue-detail.tab4')
                            <span class="label label-danger" id="total-record-point-revenue-detail-work-history-treasurer">0</span></a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-none" data-toggle="tab"
                           href="#tab5-revenue-detail-work-history-treasurer" role="tab"
                           id="tab-table-out"
                           aria-expanded="false">@lang('app.work-history-treasurer.revenue-detail.tab5')
                            <span class="label label-inverse" id="total-record-unknow-revenue-detail-work-history-treasurer">0</span></a>
                        <div class="slide"></div>
                    </li>
                </ul>
                <div class="m-0 card">
                    <div class="tab-content card-block">
                        <div class="tab-pane active" id="tab1-revenue-detail-work-history-treasurer"
                             role="tabpanel" aria-expanded="true">
                            <div class="table-responsive new-table">
                                <table class="table" id="table-cash-revenue-detail-work-history-treasurer">
                                    <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center">@lang('app.work-history-treasurer.revenue-detail.stt')</th>
                                        <th rowspan="2" class="text-left">@lang('app.work-history-treasurer.revenue-detail.code')</th>
                                        <th rowspan="2" class="text-left">@lang('app.work-history-treasurer.revenue-detail.table')</th>
                                        <th rowspan="2" class="text-left">@lang('app.work-history-treasurer.revenue-detail.employee')</th>
                                        <th class="text-right">@lang('app.work-history-treasurer.revenue-detail.amount')</th>
                                        <th rowspan="2" class="text-center">@lang('app.work-history-treasurer.revenue-detail.time')</th>
                                        <th rowspan="2" class="text-center"></th>
                                        <th rowspan="2" class="text-center"></th>
                                    </tr>
                                    <tr>
                                        <th  class="text-right seemt-fz-14" id="total-cash-revenue-detail-work-history-treasurer">0</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2-revenue-detail-work-history-treasurer"
                             role="tabpanel" aria-expanded="true">
                            <div class="table-responsive new-table">
                                <table class="table" id="table-bank-revenue-detail-work-history-treasurer">
                                    <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center">@lang('app.work-history-treasurer.revenue-detail.stt')</th>
                                        <th rowspan="2" class="text-left">@lang('app.work-history-treasurer.revenue-detail.code')</th>
                                        <th rowspan="2" class="text-left">@lang('app.work-history-treasurer.revenue-detail.table')</th>
                                        <th rowspan="2" class="text-left">@lang('app.work-history-treasurer.revenue-detail.employee')</th>
                                        <th class="text-right">@lang('app.work-history-treasurer.revenue-detail.amount')</th>
                                        <th rowspan="2" class="text-center">@lang('app.work-history-treasurer.revenue-detail.time')</th>
                                        <th rowspan="2" class="text-center"></th>
                                        <th rowspan="2" class="text-center"></th>

                                    </tr>
                                    <tr>
                                        <th class="text-right seemt-fz-14" id="total-bank-revenue-detail-work-history-treasurer">0</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3-revenue-detail-work-history-treasurer"
                             role="tabpanel" aria-expanded="true">
                            <div class="table-responsive new-table">
                                <table class="table" id="table-transfer-revenue-detail-work-history-treasurer">
                                    <thead>
                                    <tr>
                                        <th  rowspan="2" class="text-center">@lang('app.work-history-treasurer.revenue-detail.stt')</th>
                                        <th  rowspan="2" class="text-left">@lang('app.work-history-treasurer.revenue-detail.code')</th>
                                        <th  rowspan="2" class="text-left">@lang('app.work-history-treasurer.revenue-detail.table')</th>
                                        <th  rowspan="2" class="text-left">@lang('app.work-history-treasurer.revenue-detail.employee')</th>
                                        <th class="text-right">@lang('app.work-history-treasurer.revenue-detail.amount')</th>
                                        <th  rowspan="2" class="text-center">@lang('app.work-history-treasurer.revenue-detail.time')</th>
                                        <th  rowspan="2" class="text-center"></th>
                                        <th rowspan="2" class="text-center"></th>

                                    </tr>
                                    <tr>
                                        <th class="text-right seemt-fz-14" id="total-transfer-revenue-detail-work-history-treasurer">0</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab4-revenue-detail-work-history-treasurer"
                             role="tabpanel" aria-expanded="true">
                            <div class="table-responsive new-table">
                                <table class="table" id="table-point-revenue-detail-work-history-treasurer">
                                    <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center">@lang('app.work-history-treasurer.revenue-detail.stt')</th>
                                        <th rowspan="2" class="text-left">@lang('app.work-history-treasurer.revenue-detail.code')</th>
                                        <th rowspan="2" class="text-left">@lang('app.work-history-treasurer.revenue-detail.table')</th>
                                        <th rowspan="2" class="text-left">@lang('app.work-history-treasurer.revenue-detail.employee')</th>
                                        <th class="text-right">@lang('app.work-history-treasurer.revenue-detail.amount')</th>
                                        <th rowspan="2" class="text-center">@lang('app.work-history-treasurer.revenue-detail.time')</th>
                                        <th rowspan="2" class="text-center"></th>
                                        <th rowspan="2" class="text-center"></th>

                                    </tr>
                                    <tr>
                                        <th class="text-right seemt-fz-14"
                                            id="total-point-revenue-detail-work-history-treasurer">0
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab5-revenue-detail-work-history-treasurer"
                             role="tabpanel" aria-expanded="true">
                            <div class="table-responsive new-table">
                                <table class="table"
                                       id="table-unknow-revenue-detail-work-history-treasurer">
                                    <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center">@lang('app.work-history-treasurer.revenue-detail.stt')</th>
                                        <th rowspan="2" class="text-left">@lang('app.work-history-treasurer.revenue-detail.code')</th>
                                        <th rowspan="2" class="text-left">@lang('app.work-history-treasurer.revenue-detail.table')</th>
                                        <th rowspan="2" class="text-left">@lang('app.work-history-treasurer.revenue-detail.employee')</th>
                                        <th class="text-right">@lang('app.work-history-treasurer.revenue-detail.amount')</th>
                                        <th rowspan="2" class="text-center">@lang('app.work-history-treasurer.revenue-detail.time')</th>
                                        <th rowspan="2" class="text-center"></th>
                                        <th rowspan="2" class="text-center"></th>

                                    </tr>
                                    <tr>
                                        <th class="text-right seemt-fz-14" id="total-unknow-revenue-detail-work-history-treasurer">0</th>
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
    <script type="text/javascript"
            src="{{ asset('..\js\treasurer\work_history\revenue_detail.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
