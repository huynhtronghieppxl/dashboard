<div id="index-layout-send-message-campaign">
    <div class="page-wrapper item-campaign d-none" id="div-layout-send-message-campaign">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs align-items-center" role="tablist">
                <button type="button" class="btn btn-inverse font-weight-bold mr-2 d-flex" style="height: 33px"
                        onclick="backLayoutCampaign()">
                    <i class="fa fa-chevron-left"></i> Quay lại
                </button>
                <li class="nav-item">
                    <a class="nav-link active" data-type="0" data-toggle="tab" href="#tab3-send-message-campaign"
                       role="tab" aria-expanded="true">
                        Chờ duyêt
                        <span class="label label-warning" id="total-record-waiting-allow">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link " data-type="0" data-toggle="tab" href="#tab1-send-message-campaign"
                       role="tab" aria-expanded="true">
                        @lang('app.send-message-campaign.tab1')
                        <span class="label label-warning" id="total-record-not-send">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-type="1" data-toggle="tab" href="#tab2-send-message-campaign"
                       role="tab"
                       aria-expanded="false">@lang('app.send-message-campaign.tab2') <span
                                class="label label-success" id="total-record-send">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-type="1" data-toggle="tab" href="#tab4-send-message-campaign"
                       role="tab"
                       aria-expanded="false">Từ chối<span
                            class="label label-success" id="total-record-cancel">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab3-send-message-campaign" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                @include('marketing.brand')
                            </div>
                            <table class="table" id="table-waiting-allow-message-campaign">
                                <thead>
                                <tr>
                                    <th>@lang('app.send-message-campaign.stt')</th>
                                    <th>@lang('app.send-message-campaign.title')</th>
                                    <th class="text-left">@lang('app.send-message-campaign.gift-attach')</th>
                                    <th>@lang('app.send-message-campaign.receiver')</th>
                                    <th>@lang('app.send-message-campaign.time')</th>
                                    <th></th>
                                    <th class="text-center d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane " id="tab1-send-message-campaign" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                @include('marketing.brand')
                            </div>
                            <table class="table" id="table-not-send-send-message-campaign">
                                <thead>
                                <tr>
                                    <th>@lang('app.send-message-campaign.stt')</th>
                                    <th>@lang('app.send-message-campaign.title')</th>
                                    <th class="text-left">@lang('app.send-message-campaign.gift-attach')</th>
                                    <th>@lang('app.send-message-campaign.receiver')</th>
                                    <th>@lang('app.send-message-campaign.time')</th>
                                    <th></th>
                                    <th class="text-center d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-send-message-campaign" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                @include('marketing.brand')
                            </div>
                            <table class="table" id="table-send-send-message-campaign">
                                <thead>
                                <tr>
                                    <th>@lang('app.send-message-campaign.stt')</th>
                                    <th>@lang('app.send-message-campaign.title')</th>
                                    <th class="text-left">@lang('app.send-message-campaign.gift-attach')</th>
                                    <th>@lang('app.send-message-campaign.receiver')</th>
                                    <th>@lang('app.send-message-campaign.time')</th>
                                    <th></th>
                                    <th class="text-center d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab4-send-message-campaign" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                @include('marketing.brand')
                            </div>
                            <table class="table" id="table-admin-cancel-message-campaign">
                                <thead>
                                <tr>
                                    <th>@lang('app.send-message-campaign.stt')</th>
                                    <th>@lang('app.send-message-campaign.title')</th>
                                    <th class="text-left">@lang('app.send-message-campaign.gift-attach')</th>
                                    <th>@lang('app.send-message-campaign.receiver')</th>
                                    <th>@lang('app.send-message-campaign.time')</th>
                                    <th>Lý do từ chối</th>
                                    <th></th>
                                    <th class="text-center d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('marketing.campaign.send_message.create')
    @include('marketing.campaign.send_message.update')
    @include('marketing.campaign.send_message.detail')
    @include('marketing.gift.gift.detail')
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/marketing/campaign/send_message/index.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
