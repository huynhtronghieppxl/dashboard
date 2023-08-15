<div class="card card-block d-none" id="layout-voucher-promotion">
    <div class="row">
        <div class="col-lg-10 pl-0">
            <ul class="nav nav-tabs md-tabs md-4-tabs"
                role="tablist">
                <button type="button" class="come-back-btn font-weight-bold"
                        data-toggle="tooltip" data-placement="right"
                        onclick="btnBackPomotion()"
                        data-original-title="Quay lại"><i
                        class="fa fa-chevron-left"></i></button>
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#applying-tab-voucher-promotion"
                       role="tab"
                       aria-expanded="false">@lang('app.voucher-promotion.tab.applying')
                        <span class="label label-success"
                              id="total-record-applying-voucher-promotion">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#pending-tab-voucher-promotion" role="tab"
                       aria-expanded="true">@lang('app.voucher-promotion.tab.pending')
                        <span class="label label-warning"
                              id="total-record-pending-voucher-promotion">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#pausing-tab-voucher-promotion" role="tab"
                       aria-expanded="false">@lang('app.voucher-promotion.tab.pausing')
                        <span class="label label-primary"
                              id="total-record-pausing-voucher-promotion">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#expired-tab-voucher-promotion" role="tab"
                       aria-expanded="false">@lang('app.voucher-promotion.tab.expired')
                        <span class="label label-inverse"
                              id="total-record-expired-voucher-promotion">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
        </div>
        <div class="col-lg-2 row m-auto">
            <label class="input-group m-auto">
                <input type="text" id="from-date-voucher-promotion" data-validate="search"
                       class="input-sm form-control text-center input-datetimepicker p-1"
                       value="01/{{date('m/Y')}}">
                <span class="input-group-addon">@lang('app.component.button.to')</span>
                <input type="text" id="to-date-voucher-promotion" data-validate="search"
                       class="input-sm form-control text-center input-datetimepicker"
                       value="{{date('d/m/Y')}}">
                <button class="input-group-addon cursor-pointer" id="search-btn-voucher-promotion"><i
                        class="fa fa-search p-r-0px"></i></button>
            </label>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="applying-tab-voucher-promotion" role="tabpanel">
            <div class="table-responsive">
                <table id="table-applying-voucher-promotion" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>@lang('app.voucher-promotion.stt')</th>
                        <th>@lang('app.voucher-promotion.name')</th>
                        <th>@lang('app.voucher-promotion.hour')</th>
                        <th>@lang('app.voucher-promotion.time')</th>
                        <th>@lang('app.voucher-promotion.date')</th>
                        <th>@lang('app.voucher-promotion.count')</th>
                        <th>@lang('app.voucher-promotion.action')</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="pending-tab-voucher-promotion" role="tabpanel">
            <div class="table-responsive">
                <table id="table-pending-voucher-promotion" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>@lang('app.voucher-promotion.stt')</th>
                        <th>@lang('app.voucher-promotion.name')</th>
                        <th>@lang('app.voucher-promotion.hour')</th>
                        <th>@lang('app.voucher-promotion.time')</th>
                        <th>@lang('app.voucher-promotion.date')</th>
                        <th>@lang('app.voucher-promotion.count')</th>
                        <th>@lang('app.voucher-promotion.action')</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="pausing-tab-voucher-promotion" role="tabpanel">
            <div class="table-responsive">
                <table id="table-pausing-voucher-promotion" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>@lang('app.voucher-promotion.stt')</th>
                        <th>@lang('app.voucher-promotion.name')</th>
                        <th>@lang('app.voucher-promotion.hour')</th>
                        <th>@lang('app.voucher-promotion.time')</th>
                        <th>@lang('app.voucher-promotion.date')</th>
                        <th>@lang('app.voucher-promotion.count')</th>
                        <th>@lang('app.voucher-promotion.action')</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="expired-tab-voucher-promotion" role="tabpanel">
            <div class="table-responsive">
                <table id="table-expired-voucher-promotion" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>@lang('app.voucher-promotion.stt')</th>
                        <th>@lang('app.voucher-promotion.name')</th>
                        <th>@lang('app.voucher-promotion.hour')</th>
                        <th>@lang('app.voucher-promotion.time')</th>
                        <th>@lang('app.voucher-promotion.date')</th>
                        <th>@lang('app.voucher-promotion.count')</th>
                        <th>@lang('app.voucher-promotion.action')</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@include('marketing.promotion.voucher.create')
@push('scripts')
    @include('layouts.oldDatatable')
    <script type="text/javascript" src="{{asset('js/marketing/promotion/voucher/index.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
