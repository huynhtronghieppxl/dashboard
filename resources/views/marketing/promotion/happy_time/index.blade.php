<div class="card card-block d-none" id="layout-happy-time-promotion">
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
                    <a class="nav-link active" data-toggle="tab" href="#applying-tab-promotion"
                       role="tab"
                       aria-expanded="false">@lang('app.happy-time-promotion.tab.applying')
                        <span class="label label-success" id="total-record-applying">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#pending-tab-promotion" role="tab"
                       aria-expanded="true">@lang('app.happy-time-promotion.tab.pending')
                        <span class="label label-warning" id="total-record-pending">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#pausing-tab-promotion" role="tab"
                       aria-expanded="false">@lang('app.happy-time-promotion.tab.pausing')
                        <span class="label label-primary" id="total-record-pausing">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#expired-tab-promotion" role="tab"
                       aria-expanded="false">@lang('app.happy-time-promotion.tab.expired')
                        <span class="label label-inverse" id="total-record-expired">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
        </div>
        <div class="col-lg-2 row m-auto">
            <label class="input-group m-auto">
                <input type="text" id="from-date-happy-time-promotion" data-validate="search"
                       class="input-sm form-control text-center input-datetimepicker p-1"
                       value="01/{{date('m/Y')}}">
                <span class="input-group-addon">@lang('app.component.button.to')</span>
                <input type="text" id="to-date-happy-time-promotion" data-validate="search"
                       class="input-sm form-control text-center input-datetimepicker"
                       value="{{date('d/m/Y')}}">
                <button class="input-group-addon cursor-pointer" id="search-btn-happy-time-promotion"><i
                        class="fa fa-search p-r-0px"></i></button>
            </label>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="applying-tab-promotion" role="tabpanel">
            <div class="table-responsive">
                <table id="table-applying-happy-time-promotion" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>@lang('app.happy-time-promotion.stt')</th>
                        <th>@lang('app.happy-time-promotion.name')</th>
                        <th>@lang('app.happy-time-promotion.type')</th>
                        <th>@lang('app.happy-time-promotion.time')</th>
                        <th>@lang('app.happy-time-promotion.action')</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="pending-tab-promotion" role="tabpanel">
            <div class="table-responsive">
                <table id="table-pending-happy-time-promotion" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>@lang('app.happy-time-promotion.stt')</th>
                        <th>@lang('app.happy-time-promotion.name')</th>
                        <th>@lang('app.happy-time-promotion.type')</th>
                        <th>@lang('app.happy-time-promotion.time')</th>
                        <th>@lang('app.happy-time-promotion.action')</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="pausing-tab-promotion" role="tabpanel">
            <div class="table-responsive">
                <table id="table-pausing-happy-time-promotion" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>@lang('app.happy-time-promotion.stt')</th>
                        <th>@lang('app.happy-time-promotion.name')</th>
                        <th>@lang('app.happy-time-promotion.type')</th>
                        <th>@lang('app.happy-time-promotion.time')</th>
                        <th>@lang('app.happy-time-promotion.action')</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="expired-tab-promotion" role="tabpanel">
            <div class="table-responsive">
                <table id="table-expired-happy-time-promotion" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>@lang('app.happy-time-promotion.stt')</th>
                        <th>@lang('app.happy-time-promotion.name')</th>
                        <th>@lang('app.happy-time-promotion.type')</th>
                        <th>@lang('app.happy-time-promotion.time')</th>
                        <th>@lang('app.happy-time-promotion.action')</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('marketing.promotion.happy_time.create')
@include('marketing.promotion.happy_time.update')
@include('marketing.promotion.happy_time.detail')
@include('marketing.promotion.happy_time.voucher')
@include('marketing.promotion.happy_time.assign_food')
@push('scripts')
    @include('layouts.oldDatatable')
    <script type="text/javascript" src="{{asset('js/marketing/promotion/happy_time/index.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
