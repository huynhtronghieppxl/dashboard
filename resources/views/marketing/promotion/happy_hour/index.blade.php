<div class="card card-block d-none" id="layout-happy-hour-promotion">
    <ul class="nav nav-tabs md-tabs"
        role="tablist">
        <button type="button" class="come-back-btn font-weight-bold"
                data-toggle="tooltip" data-placement="right"
                onclick="btnBackPomotion()"
                data-original-title="Quay lại"><i
                class="fa fa-chevron-left"></i></button>
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tab1-happy-hour-promotion"
               role="tab"
               aria-expanded="false">@lang('app.happy-hour-promotion.tab1')
                <span class="label label-success" id="total-record-register">0</span></a>
            <div class="slide"></div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab2-happy-hour-promotion" role="tab"
               aria-expanded="true">@lang('app.happy-hour-promotion.tab2')
                <span class="label label-warning" id="total-record-not-register">0</span>
            </a>
            <div class="slide"></div>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1-happy-hour-promotion" role="tabpanel">
            <div class="table-responsive">
                <table id="table-register-happy-hour-promotion" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>@lang('app.happy-hour-promotion.stt')</th>
                        <th>@lang('app.happy-hour-promotion.phone')</th>
                        <th>@lang('app.happy-hour-promotion.name')</th>
                        <th>@lang('app.happy-hour-promotion.create')</th>
                        <th>@lang('app.happy-hour-promotion.action')</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="tab2-happy-hour-promotion" role="tabpanel">
            <div class="table-responsive">
                <table id="table-not-register-happy-hour-promotion" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>@lang('app.happy-hour-promotion.stt')</th>
                        <th>@lang('app.happy-hour-promotion.phone')</th>
                        <th>@lang('app.happy-hour-promotion.name')</th>
                        <th>@lang('app.happy-hour-promotion.create')</th>
                        <th>@lang('app.happy-hour-promotion.action')</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@include('marketing.promotion.happy_hour.create')
@include('marketing.promotion.happy_hour.gift')
@include('marketing.promotion.happy_hour.detail')
@push('scripts')
    @include('layouts.oldDatatable')
    <script type="text/javascript" src="{{asset('js/marketing/promotion/happy_hour/index.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
