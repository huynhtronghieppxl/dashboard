<style>
    #div-layout-after-payment-campaign .new-table .select-filter-dataTable {
        margin-right: -15px !important;
    }
</style>
<div class="page-wrapper item-campaign d-none" id="div-layout-after-payment-campaign">
    <div class="page-body">
        <ul class="nav nav-tabs md-tabs align-items-center" role="tablist">
            <button type="button" class="btn btn-inverse font-weight-bold mr-2" style="height: 33px"
                    onclick="backLayoutCampaign()">
                <i class="fa fa-chevron-left"></i> Quay lại
            </button>
            <li class="nav-item">
                <a class="nav-link active" data-type="0" id="pending-after-payment-campaign" data-toggle="tab"
                   href="#unit-tab-pending" role="tab" aria-expanded="true">
                  Chờ duyệt
                    <span class="label label-success" id="total-record-pending-after-payment-campaign">0</span>
                </a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-type="0" id="approved-after-payment-campaign" data-toggle="tab"
                   href="#unit-tab-approved" role="tab" aria-expanded="true">
                   Đã duyệt
                    <span class="label label-success" id="total-record-approved-after-payment-campaign">0</span>
                </a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-type="0" id="enable-after-payment-campaign" data-toggle="tab"
                   href="#unit-tab-enable" role="tab" aria-expanded="true">
                    @lang('app.message.tab1')
                    <span class="label label-success" id="total-record-enable-after-payment-campaign">0</span>
                </a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-type="1" data-toggle="tab" id="disable-after-payment-campaign"
                   href="#unit-tab-disable"
                   role="tab" aria-expanded="false">
                    @lang('app.message.tab2')
                    <span class="label label-inverse"
                          id="total-record-disable-after-payment-campaign">0</span>
                </a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-type="1" data-toggle="tab" id="reason-after-payment-campaign"
                   href="#unit-tab-reason"
                   role="tab" aria-expanded="false">
                    TỪ CHỐI
                    <span class="label label-inverse"
                          id="total-record-reason-after-payment-campaign">0</span>
                </a>
                <div class="slide"></div>
            </li>
        </ul>
        <div class="card card-block">
            <div class="tab-content">
                <div class="tab-pane active" id="unit-tab-pending" role="tabpanel">
                    <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                @include('marketing.brand')
                            </div>
                            <table id="table-pending-after-payment-campaign" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.message.stt')</th>
                                    <th>@lang('app.message.brand')</th>
                                    <th>@lang('app.message.type')</th>
                                    <th>@lang('app.message.content')</th>
                                    <th>@lang('app.message.action')</th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="unit-tab-approved" role="tabpanel">
                    <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                @include('marketing.brand')
                            </div>
                            <table id="table-approved-after-payment-campaign" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.message.stt')</th>
                                    <th>@lang('app.message.brand')</th>
                                    <th>@lang('app.message.type')</th>
                                    <th>@lang('app.message.content')</th>
                                    <th>@lang('app.message.action')</th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="unit-tab-enable" role="tabpanel">
                    <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                @include('marketing.brand')
                            </div>
                            <table id="table-enable-after-payment-campaign" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.message.stt')</th>
                                    <th>@lang('app.message.brand')</th>
                                    <th>@lang('app.message.type')</th>
                                    <th>@lang('app.message.content')</th>
                                    <th>@lang('app.message.action')</th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="unit-tab-disable" role="tabpanel">
                    <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                @include('marketing.brand')
                            </div>
                            <table id="table-disable-after-payment-campaign" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.message.stt')</th>
                                    <th>@lang('app.message.brand')</th>
                                    <th>@lang('app.message.type')</th>
                                    <th>@lang('app.message.content')</th>
                                    <th>@lang('app.message.action')</th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="unit-tab-reason" role="tabpanel">
                    <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                @include('marketing.brand')
                            </div>
                            <table id="table-reason-after-payment-campaign" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.message.stt')</th>
                                    <th>@lang('app.message.brand')</th>
                                    <th>@lang('app.message.type')</th>
                                    <th>@lang('app.message.content')</th>
                                    <th>Lý do huỷ</th>
                                    <th>@lang('app.message.action')</th>
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
</div>
<div class="d-none">
    <span id="id-tab-active-after-payment-campaign">1</span>
    <span id="msg-title-status-after-payment-campaign">@lang('app.message.title-status')</span>
    <span id="msg-content-status-after-payment-campaign">@lang('app.message.content-status')</span>
    <span id="msg-detele-after-payment-campaign">@lang('app.message.delete-greeting')</span>
    <span id="msg-succes-detele-after-payment-campaign">@lang('app.message.success-delete')</span>
</div>

@include('marketing.campaign.after_payment.create')
@include('marketing.campaign.after_payment.update')
@include('marketing.campaign.after_payment.detail')

@push('scripts')
    <script type="text/javascript" src="{{asset('js/marketing/campaign/after_payment/index.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
