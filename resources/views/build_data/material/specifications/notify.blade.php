<div class="modal fade" id="modal-notify-change-status-speification" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="min-width: 70% !important;max-width: 70% !important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close ml-auto" onclick="closeModalNotifySpecificationData()"
                        onkeypress="closeModalNotifySpecificationData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;">
                <div class="swal2-icon-content">!</div>
            </div>
            <div class="text-center" style="font-size: 1.875em; font-weight: 500" id="title-notify-change-status-unit"></div>
            <div class="modal-body pt-0" style="padding-top: 0 !important;background-color: #fff !important;">
                <h5 class="text-center font-weight-bold" id="message-notify-change-status-unit"></h5>
                <div class="seemt-main-content">
                    <ul class="nav nav-tabs md-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#spe-disabled-tab1" role="tab"
                               aria-expanded="true">@lang('app.specifications-data.notify.material') <span class="label label-success"
                                                                      id="total-record-disabled-material">0</span></a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#spe-disabled-tab2" role="tab"
                               aria-expanded="false">@lang('app.specifications-data.notify.unit') <span class="label label-inverse"
                                                                  id="total-record-disabled-unit">0</span></a>
                            <div class="slide"></div>
                        </li>
                    </ul>
                    <div class="card-block card m-0" style="box-shadow: none">
                        <div class="tab-content m-0">
                            <div class="tab-pane active" id="spe-disabled-tab1" role="tabpanel">
                                <div class="table-responsive new-table">
                                    <table id="table-spe-disabled-material" class="table">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.specifications-data.notify.stt')</th>
                                            <th>@lang('app.specifications-data.notify.name')</th>
                                            <th class="d-none"></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="spe-disabled-tab2" role="tabpanel">
                                <div class="table-responsive new-table">
                                    <table id="table-spe-disabled-unit" class="table">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.specifications-data.notify.stt')</th>
                                            <th>@lang('app.specifications-data.notify.name')</th>
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
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\build_data\material\specifications\notify.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
