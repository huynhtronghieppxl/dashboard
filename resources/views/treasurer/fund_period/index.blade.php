@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" id="nav-tab-fund-period" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab"
                       data-id="1"
                       href="#tab1-fund-period-treasurer" role="tab"
                       aria-expanded="true">@lang('app.fund-period-treasurer.tab1') <span
                                class="label label-warning"
                                id="total-record-waiting-fund-period-treasurer">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       data-id="2"
                       href="#tab2-fund-period-treasurer" role="tab"
                       aria-expanded="false">@lang('app.fund-period-treasurer.tab2') <span
                                class="label label-success"
                                id="total-record-done-fund-period-treasurer">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       data-id="3"
                       href="#tab3-fund-period-treasurer" role="tab"
                       aria-expanded="false">@lang('app.fund-period-treasurer.tab3') <span
                                class="label label-danger"
                                id="total-record-cancel-fund-period-treasurer">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1-fund-period-treasurer" role="tabpanel">
                        <div class="table-responsive new-table">
                            <table id="table-waiting-fund-period-treasurer"
                                   class="table">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.fund-period-treasurer.stt')</th>
                                    <th rowspan="2">@lang('app.fund-period-treasurer.name')</th>
                                    <th rowspan="2">@lang('app.fund-period-treasurer.employee')</th>
                                    <th class="text-right">@lang('app.fund-period-treasurer.open')
                                        <br>@lang('app.fund-period-treasurer.note-1')</th>
                                    <th class="text-right">@lang('app.fund-period-treasurer.in')
                                        <br>@lang('app.fund-period-treasurer.note-2')</th>
                                    <th class="text-right">@lang('app.fund-period-treasurer.out')
                                        <br>@lang('app.fund-period-treasurer.note-3')</th>
                                    <th class="text-right">@lang('app.fund-period-treasurer.close')
                                        <br>@lang('app.fund-period-treasurer.note-4')
                                    </th>
                                    <th>@lang('app.fund-period-treasurer.action')</th>
                                    <th rowspan="2" class="d-none"></th>
                                </tr>
                                <tr>
                                    <th id="total-open-waiting-fund-period-treasurer" class="text-right seemt-fz-14">0
                                    </th>
                                    <th id="total-in-waiting-fund-period-treasurer" class="text-right seemt-fz-14">0
                                    </th>
                                    <th id="total-out-waiting-fund-period-treasurer" class="text-right seemt-fz-14">0
                                    </th>
                                    <th id="total-close-waiting-fund-period-treasurer" class="text-right seemt-fz-14">
                                        0
                                    </th>
                                    <th></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-fund-period-treasurer" role="tabpanel">
                        <div class="table-responsive new-table">
                            <table id="table-done-fund-period-treasurer" class="table">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.fund-period-treasurer.stt')</th>
                                    <th rowspan="2">@lang('app.fund-period-treasurer.name')</th>
                                    <th rowspan="2">@lang('app.fund-period-treasurer.employee')</th>
                                    <th rowspan="2">@lang('app.fund-period-treasurer.confirm')</th>
                                    <th class="text-right">@lang('app.fund-period-treasurer.open')
                                        <br>@lang('app.fund-period-treasurer.note-1')</th>
                                    <th class="text-right">@lang('app.fund-period-treasurer.in')
                                        <br>@lang('app.fund-period-treasurer.note-2')</th>
                                    <th class="text-right">@lang('app.fund-period-treasurer.out')
                                        <br>@lang('app.fund-period-treasurer.note-3')</th>
                                    <th class="text-right">@lang('app.fund-period-treasurer.close')
                                        <br>@lang('app.fund-period-treasurer.note-4')</th>
                                    <th class="text-right">Số tiền thực tế
                                        <br>(5)
                                    </th>
                                    <th class="text-right">Số tiền chênh lệch
                                        <br> (5-4= 6)
                                    </th>
                                    <th rowspan="2">@lang('app.fund-period-treasurer.action')</th>
                                    <th rowspan="2" class="d-none"></th>
                                </tr>
                                <tr>
                                    <th id="total-open-done-fund-period-treasurer" class="text-right seemt-fz-14">0</th>
                                    <th id="total-in-done-fund-period-treasurer" class="text-right seemt-fz-14">0</th>
                                    <th id="total-out-done-fund-period-treasurer" class="text-right seemt-fz-14">0</th>
                                    <th id="total-close-done-fund-period-treasurer" class="text-right seemt-fz-14">0
                                    </th>
                                    <th id="total-last-close-done-fund-period-treasurer" class="text-right seemt-fz-14">
                                        0
                                    </th>
                                    <th id="total-change-last-close-done-fund-period-treasurer" class="seemt-fz-14">0
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3-fund-period-treasurer" role="tabpanel">
                        <div class="table-responsive new-table">
                            <table id="table-cancel-fund-period-treasurer" class="table">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.fund-period-treasurer.stt')</th>
                                    <th rowspan="2">@lang('app.fund-period-treasurer.name')</th>
                                    <th rowspan="2">@lang('app.fund-period-treasurer.employee')</th>
                                    <th rowspan="2">@lang('app.fund-period-treasurer.cancel')</th>
                                    <th class="text-right">@lang('app.fund-period-treasurer.open')
                                        <br>@lang('app.fund-period-treasurer.note-1')</th>
                                    <th class="text-right">@lang('app.fund-period-treasurer.in')
                                        <br>@lang('app.fund-period-treasurer.note-2')</th>
                                    <th class="text-right">@lang('app.fund-period-treasurer.out')
                                        <br>@lang('app.fund-period-treasurer.note-3')</th>
                                    <th class="text-right">@lang('app.fund-period-treasurer.close')
                                        <br>@lang('app.fund-period-treasurer.note-4')</th>
                                    <th rowspan="2" class="d-none"></th>
                                </tr>
                                <tr>
                                    <th id="total-open-cancel-fund-period-treasurer" class="text-right seemt-fz-14">0
                                    </th>
                                    <th id="total-in-cancel-fund-period-treasurer" class="text-right seemt-fz-14">0</th>
                                    <th id="total-out-cancel-fund-period-treasurer" class="text-right seemt-fz-14">0
                                    </th>
                                    <th id="total-close-cancel-fund-period-treasurer" class="text-right seemt-fz-14">0
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-fund-period-treasurer" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Xác nhận kỳ quỹ</h4>
                </div>
                <div class="modal-body text-left p-4" id="last-closing-amount-fund-period-treasurer">
                    <div class="card-block card m-0">
                        <div class="form-group validate-group">
                            <div class="form-validate-input">
                                <input type="text" id="value-last-closing-amount-fund-period-treasurer" data-money="1"
                                       data-max="999999999999" data-type="currency-edit">
                                <label for="name-create-employee-manage">
                                    Số tiền thực tế
                                    @include('layouts.start')
                                </label>
                                <div class="line"></div>
                            </div>
                            <div class="link-href"></div>
                        </div>

                        <div class="form-group validate-group">
                            <div class="form-validate-textarea">
                                <div class="form__group pt-2">
                                    <textarea class="form__field"
                                              id="description-last-closing-amount-fund-period-treasurer" cols="5"
                                              rows="5" data-note-max-length="1000"></textarea>
                                    <label for="description-create-payment-bill" class="form__label icon-validate">
                                        Lý do </label>
                                    <div class="textarea-character">
                                        <span>0/300</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn seemt-btn-hover-gray seemt-bg-gray-w200"
                         data-dismiss="modal" id="btn_close_create"
                         onclick="closeModalConfirmFundPeriodTreasurer()"
                         onkeypress="closeModalConfirmFundPeriodTreasurer()">
                        <i class="fi-rr-cross"></i>
                        <span>@lang('app.component.button.close')</span>
                    </div>
                    <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                         onclick="saveModalConfirmFundPeriodTreasurer()"
                         onkeypress="saveModalConfirmFundPeriodTreasurer()">
                        <i class="fi-rr-disk"></i>
                        <span>@lang('app.component.button.save')</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('treasurer.fund_period.detail')
    @include('treasurer.payment_bill.detail')
    @include('manage.inventory.in_inventory.detail')
    @include('treasurer.receipts_bill.detail')
    @include('manage.supplier_order.detail_order')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('..\js\treasurer\fund_period\index.js?version=1̀', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
