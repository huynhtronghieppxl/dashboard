<div class="modal fade" id="modal-history-bill" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg-big" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.bill-manage.history.title')</h4>
                <button type="button" class="close" onclick="closeModalHistory()" onkeypress="closeModalHistory()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-block m-0">
                    <div class="table-responsive new-table">
                        <table class="table" id="table-history-bill-manage">
                            <thead>
                            <tr>
                                <th>@lang('app.bill-manage.history.stt')</th>
                                <th>@lang('app.bill-manage.history.time')</th>
                                <th class="text-left">@lang('app.bill-manage.history.employee')</th>
                                <th class="text-left">Nội dung</th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/bill/history.js?version=3',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
