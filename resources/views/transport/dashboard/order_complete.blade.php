<div class="card card-block card-shadow-custom-dashboard card-inview-dashboard" id="card-revenue-dashboard"
     data-key="revenue-cost-profit-report">
    <h4 class="m-b-20 p-b-5 b-b-default f-w-600">
        <div class="row">
            <div class="col-lg-8">
                <h4 class="font-weight-bold">Báo cáo đơn hàng thành công</h4>
            </div>
            <div class="col-lg-4 text-right">
                <select name="select"
                        class="form-control form-control-inverse width-50 d-inline"
                        id="select-type-revenue-cost-profit-report">
                    <option value="3" data-time="{{date('m/Y')}}"
                            selected>@lang('app.branch-dashboard.select.option5')</option>
                    <option value="3"
                            data-time="{{date('m/Y', strtotime('-1 month'))}}">@lang('app.branch-dashboard.select.option6')</option>
                    <option value="5" data-time="{{date('Y')}}">@lang('app.branch-dashboard.select.option8')</option>
                    <option value="5"
                            data-time="{{date('Y', strtotime('-1 year'))}}">@lang('app.branch-dashboard.select.option11')</option>
                </select>&emsp;
                <label><i class="zmdi zmdi-refresh-sync d-inline fa-hover"
                          onclick="reloadOrderCompleteTransportDashboard()"></i></label>
            </div>
        </div>
    </h4>
    <div class="card-block chart-container">
        <div id="chart-order-complete-transport-dashboard"
             class="count-loading-chart style-large-chart-dashboard"></div>
    </div>
    <div class="sub-title p-b-0 m-b-0"></div>
    <div class="padding-edit-5-10 d-flex">
                    <span><i class="ion-arrow-graph-up-right text-success px-2"></i> <b
                            class="reset-fz-chart">Grab Express</b></span>
        <span><i class="ion-arrow-graph-up-right text-warning px-2"></i> <b
                class="reset-fz-chart">AhaMove</b></span>
        <span><i class="ion-arrow-graph-up-right text-danger px-2"></i> <b
                class="reset-fz-chart">J&T Express</b></span>
    </div>
</div>
@push('scripts')
    <script src="{{asset('js/transport/dashboard/order_complete.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"
            type="text/javascript"></script>
@endpush
