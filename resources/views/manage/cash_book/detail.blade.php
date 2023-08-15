<div class="modal fade" id="modal-detail-cash-book-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.cash-book-manage.detail.title')</h4>
                <div class="d-flex align-items-center">
                    <h5 class="m-0" id="status-detail-cash-book-manage"></h5>
                    <button type="button" class="close ml-4" onclick="closeModalDetailCashBookManage()" onkeypress="closeModalDetailCashBookManage()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body background-body-color" id="loading-modal-detail-cash-book-manage">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill">
                        <div class="card card-block mb-0 flex-sub">
                            <div class="card card-block tab-icon">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <ul class="nav nav-tabs md-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab"
                                                   href="#tab1-detail-cash-book-manage" role="tab"
                                                   onclick="changeTabDetailCashBook(1)"
                                                   aria-expanded="true">@lang('app.cash-book-manage.detail.tab1')
                                                    <span
                                                            class="label label-warning"
                                                            id="total-record-tab1-detail">0</span>
                                                </a>
                                                <div class="slide"></div>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab"
                                                   href="#tab2-detail-cash-book-manage" role="tab"
                                                   onclick="changeTabDetailCashBook(0)"
                                                   aria-expanded="false">@lang('app.cash-book-manage.detail.tab2') <span
                                                            class="label label-success"
                                                            id="total-record-tab2-detail">0</span>
                                                </a>
                                                <div class="slide"></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content card p-2 mb-0">
                                    <div class="tab-pane active" id="tab1-detail-cash-book-manage" role="tabpanel">
                                        <div class="col-sm-12 p-0">
                                            <div class="table-responsive">
                                                <table id="table-payment-detail-cash-book-manage"
                                                       class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('app.cash-book-manage.detail.stt')</th>
                                                        <th>@lang('app.cash-book-manage.detail.code')</th>
                                                        <th>@lang('app.cash-book-manage.detail.employee')</th>
                                                        <th>@lang('app.cash-book-manage.detail.target')</th>
                                                        <th>@lang('app.cash-book-manage.detail.reason')</th>
                                                        <th>@lang('app.cash-book-manage.detail.date')</th>
                                                        <th>@lang('app.cash-book-manage.detail.amount')</th>
                                                        <th>@lang('app.cash-book-manage.detail.status')</th>
                                                        <th>@lang('app.cash-book-manage.detail.action')</th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="2">@lang('app.cash-book-manage.detail.total')</th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th
                                                            id="total-payment-detail-cash-book-manage"></th>
                                                        <th colspan="2"></th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab2-detail-cash-book-manage" role="tabpanel">
                                        <div class="col-sm-12 p-0">
                                            <div class="table-responsive">
                                                <table id="table-receipt-detail-cash-book-manage"
                                                       class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('app.cash-book-manage.detail.stt')</th>
                                                        <th>@lang('app.cash-book-manage.detail.code')</th>
                                                        <th>@lang('app.cash-book-manage.detail.employee')</th>
                                                        <th>@lang('app.cash-book-manage.detail.target')</th>
                                                        <th>@lang('app.cash-book-manage.detail.reason')</th>
                                                        <th>@lang('app.cash-book-manage.detail.date')</th>
                                                        <th>@lang('app.cash-book-manage.detail.amount')</th>
                                                        <th>@lang('app.cash-book-manage.detail.status')</th>
                                                        <th>@lang('app.cash-book-manage.detail.action')</th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="2">@lang('app.cash-book-manage.detail.total')</th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th
                                                            id="total-receipt-detail-cash-book-manage"></th>
                                                        <th colspan="2"></th>
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
                    <div class="col-lg-4 edit-flex-auto-fill">
                        <div class="card card-block mb-0 flex-sub">
                            <div class="col-md-12">
                                <h5 class="sub-title">@lang('app.cash-book-manage.detail.title-right')</h5>
                                <div class="form-group row">
                                    <label class="col-sm-4">@lang('app.cash-book-manage.detail.name')</label>
                                    <div class="col-sm-8">: <span class="font-1-em"
                                                                  id="name-detail-cash-book-manage"></span></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">@lang('app.cash-book-manage.detail.from')</label>
                                    <div class="col-sm-8">: <span class="font-1-em"
                                                                  id="from-detail-cash-book-manage"></span></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">@lang('app.cash-book-manage.detail.to')</label>
                                    <div class="col-sm-8">: <span class="font-1-em"
                                                                  id="to-detail-cash-book-manage"></span></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">@lang('app.cash-book-manage.detail.employee-create')</label>
                                    <div class="col-sm-8">: <span class="font-1-em"
                                                                  id="employee-detail-cash-book-manage"></span></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">@lang('app.cash-book-manage.detail.employee-complete')</label>
                                    <div class="col-sm-8">: <span class="font-1-em"
                                                                  id="employee-complete-detail-cash-book-manage"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">@lang('app.cash-book-manage.detail.open')</label>
                                    <div class="col-sm-8">: <span class="font-1-em"
                                                                  id="open-detail-cash-book-manage"></span></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">@lang('app.cash-book-manage.detail.in')</label>
                                    <div class="col-sm-8">: <span class="font-1-em"
                                                                  id="in-detail-cash-book-manage"></span></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">@lang('app.cash-book-manage.detail.out')</label>
                                    <div class="col-sm-8">: <span class="font-1-em"
                                                                  id="out-detail-cash-book-manage"></span></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">@lang('app.cash-book-manage.detail.order')</label>
                                    <div class="col-sm-8">: <span class="font-1-em"
                                                                  id="order-detail-cash-book-manage"></span></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">@lang('app.cash-book-manage.detail.close')</label>
                                    <div class="col-sm-8">: <span class="font-1-em"
                                                                  id="closing-detail-cash-book-manage"></span></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">@lang('app.cash-book-manage.detail.change')</label>
                                    <div class="col-sm-8">: <span class="font-1-em"
                                                                  id="changing-detail-cash-book-manage"></span></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">@lang('app.cash-book-manage.detail.note')</label>
                                    <div class="col-sm-8">
                                            <textarea class="form-control" id="note-detail-cash-book-manage"
                                                      cols="5"
                                                      rows="5" disabled></textarea>
                                    </div>
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
@include('treasurer.payment_bill.detail')
@include('treasurer.receipts_bill.detail')
@push('scripts')
    <script type="text/javascript" src="{{asset('/js/manage/cash_book/detail.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
