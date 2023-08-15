<div class="page-wrapper item-campaign d-none" id="div-layout-one-get-one-campaign">
    <div class="page-body">
        <ul class="nav nav-tabs md-tabs md-4-tabs align-items-center" role="tablist">
            <button type="button" class="btn seemt-blue font-weight-bold m-2" style="height: 33px"
                    onclick="backLayoutCampaign()"><i
                        class="fa fa-chevron-left"></i> Quay lại
            </button>
            <li class="nav-item">
                <a class="nav-link active" data-type="0" data-toggle="tab" href="#applying-tab-one-get-one-marketing"
                   role="tab"
                   aria-expanded="false">@lang('app.one-get-one-campaign.tab.active')
                    <span class="label label-success"
                          id="total-record-applying-one-get-one-marketing">0</span></a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" data-type="2" href="#expired-tab-one-get-one-marketing"
                   role="tab"
                   aria-expanded="false">@lang('app.one-get-one-campaign.tab.expired')
                    <span class="label label-inverse"
                          id="total-record-expired-one-get-one-marketing">0</span></a>
                <div class="slide"></div>
            </li>
        </ul>
        <div class="card card-block">
            <div class="row">
                <!-- Tab panes -->
                <div class="col-lg-12">
                    <div class="tab-content">
                        <div class="tab-pane active" id="applying-tab-one-get-one-marketing" role="tabpanel">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable d-flex">
                                    @include('marketing.brand')
                                    <div class="time-filer-dataTale">
                                        <div class="seemt-group-date">
                                            <i class="fi-rr-calendar"></i>
                                            <input type="text" style="padding-left: 32px !important;"
                                                   class="input-sm form-control text-center input-datetimepicker p-1 from-date-one-get-one-campaign"
                                                   value="01/{{date('m/Y')}}">
                                        </div>
                                        <span class="input-group-addon custom-find"><i
                                                    class="fi-rr-angle-double-small-right"></i></span>
                                        <div class="seemt-group-date">
                                            <i class="fi-rr-calendar"></i>
                                            <input type="text"
                                                   class="input-sm form-control text-center input-datetimepicker to-date-one-get-one-campaign"
                                                   value="{{date('d/m/Y')}}">
                                        </div>
                                        <button
                                                class="input-group-addon cursor-pointer search-btn-one-get-one-campaign">
                                            <i
                                                    class="fi-rr-filter"></i></button>
                                    </div>
                                </div>
                                <table id="table-active-one-get-one-marketing" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.one-get-one-campaign.stt')</th>
                                        <th>@lang('app.one-get-one-campaign.name')</th>
                                        <th>@lang('app.one-get-one-campaign.hour')</th>
                                        <th>@lang('app.one-get-one-campaign.week')</th>
                                        <th>@lang('app.one-get-one-campaign.date')</th>
                                        <th>Trạng thái</th>
                                        <th>@lang('app.one-get-one-campaign.action')</th>
                                        <th class="text-center d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="expired-tab-one-get-one-marketing" role="tabpanel">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    @include('marketing.brand')
                                    <div class="time-filer-dataTale">
                                        <div class="seemt-group-date">
                                            <i class="fi-rr-calendar"></i>
                                            <input type="text" id="from-date-one-get-one-campaign"
                                                   style="padding-left: 32px !important;"
                                                   class="input-sm form-control text-center input-datetimepicker p-1 from-date-one-get-one-campaign"
                                                   value="01/{{date('m/Y')}}">
                                        </div>
                                        <span class="input-group-addon custom-find"><i
                                                    class="fi-rr-angle-double-small-right"></i></span>
                                        <div class="seemt-group-date">
                                            <i class="fi-rr-calendar"></i>
                                            <input type="text" id="to-date-one-get-one-campaign"
                                                   class="input-sm form-control text-center input-datetimepicker to-date-one-get-one-campaign"
                                                   value="{{date('d/m/Y')}}">
                                        </div>
                                        <button
                                                class="input-group-addon cursor-pointer search-btn-one-get-one-campaign">
                                            <i
                                                    class="fi-rr-filter"></i></button>
                                    </div>
                                </div>
                                <table id="table-expired-one-get-one-marketing" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.one-get-one-campaign.stt')</th>
                                        <th>@lang('app.one-get-one-campaign.name')</th>
                                        <th>@lang('app.one-get-one-campaign.hour')</th>
                                        <th>@lang('app.one-get-one-campaign.week')</th>
                                        <th>@lang('app.one-get-one-campaign.date')</th>
{{--                                        <th>@lang('app.one-get-one-campaign.action')</th>--}}
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
    </div>
</div>

@include('marketing.campaign.one_get_one.create')
@include('marketing.campaign.one_get_one.update')
@include('marketing.campaign.one_get_one.add_food')
@include('marketing.campaign.one_get_one.detail')
@push('scripts')
    <script type="text/javascript" src="{{asset('js/marketing/campaign/one_get_one/index.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
