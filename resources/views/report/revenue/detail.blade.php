<div class="modal fade" id="modal-detail-revenue-report" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css">
        <link rel="stylesheet" href="{{ asset('css/dataTable.css') }}"/>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.revenue-report.detail.title')
                    <span class="span-covert-size-parent date-detail"></span></h4>
                <button type="button" class="close" onclick="closeModalDetailRevenueReport()" onkeypress="closeModalDetailRevenueReport()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color" id="loading-modal-detail-revenue-report">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill">
                        <div class="card card-block flex-sub m-0">
                            <div class="table-responsive new-table">
                                <table id="table-detail-revenue-report" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.revenue-report.detail.stt')</th>
                                        <th>@lang('app.revenue-report.detail.code')</th>
                                        <th>@lang('app.revenue-report.detail.employee')</th>
                                        <th>@lang('app.revenue-report.detail.target')</th>
                                        <th>@lang('app.revenue-report.detail.date')</th>
                                        <th>@lang('app.revenue-report.detail.amount')</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill pl-0">
                        <div class="card card-block flex-sub m-0">
                                <h5 class="text-bold sub-title mx-0">@lang('app.revenue-report.detail.title-right')</h5>
                                <div class="row form-group mb-1 px-0">
                                    <div class="col-lg-6">
                                        <label class="f-w-600 mb-1 col-form-label-fz-15">@lang('app.revenue-report.detail.name')</label>
                                        <div class="col-form-label-fz-15 text-muted f-w-400" id="name-detail-revenue-report"></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="f-w-600 mb-1 col-form-label-fz-15">@lang('app.revenue-report.detail.time')</label>
                                        <div class="col-form-label-fz-15 text-muted f-w-400" id="time-detail-revenue-report"></div>
                                    </div>
                                </div>
                                <div class="row form-group mb-2 px-0 pb-2 border-dashed">
                                    <div class="col-lg-6">
                                        <label class="f-w-600 mb-1 col-form-label-fz-15">@lang('app.revenue-report.detail.type')</label>
                                        <div class="col-form-label-fz-15 text-muted f-w-400" id="type-detail-revenue-report"></div>
                                    </div>
                                </div>
                                <div class="row form-group mb-1 px-0">
                                    <div class="col-lg-6">
                                        <label class="f-w-600 mb-1 col-form-label-fz-15">@lang('app.revenue-report.detail.total-amount')</label>
                                        <div class="col-form-label-fz-15 text-muted f-w-400" id="amount-detail-revenue-report"></div>
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
@include('treasurer.receipts_bill.detail')
@push('scripts')
    @include('layouts.datatable')
    <script type="text/javascript" src="{{ asset('js\template_custom\dataTable.js?version=1')}}"></script>
    <script type="text/javascript" src="{{ asset('..\js\report\revenue\detail.js?version=5')}}"></script>
@endpush

