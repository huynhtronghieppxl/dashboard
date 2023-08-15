<div class="card card-block card-shadow-custom-dashboard card-inview-dashboard" data-key="supplier-report">
    <h4 class="m-b-20 p-b-5 b-b-default f-w-600">
        <div class="row">
            <div class="col-lg-8">
                <h4 class="font-weight-bold">@lang('app.restaurant-dashboard.supplier-report.title')</h4>
            </div>
            <div class="col-lg-4 text-right">
                <select class="form-control form-control-inverse width-50 d-inline"
                        id="select-type-supplier-report">
                    <option value="1"
                            data-time="{{date('d/m/Y')}}">@lang('app.restaurant-dashboard.select.option1')</option>
                    <option value="1"
                            data-time="{{date('d/m/Y', strtotime('yesterday'))}}">@lang('app.restaurant-dashboard.select.option2')</option>
                    <option value="2"
                            data-time="{{date('W/Y')}}">@lang('app.restaurant-dashboard.select.option3')</option>
                    <option value="3" data-time="{{date('m/Y')}}"
                            selected>@lang('app.restaurant-dashboard.select.option5')</option>
                    <option value="3"
                            data-time="{{date('m/Y', strtotime('-1 month'))}}">@lang('app.restaurant-dashboard.select.option6')</option>
                    <option value="4"
                            data-time="{{date('m/Y')}}">@lang('app.restaurant-dashboard.select.option7')</option>
                    <option value="5"
                            data-time="{{date('Y')}}">@lang('app.restaurant-dashboard.select.option8')</option>
                    <option value="6"
                            data-time="{{date('Y')}}">@lang('app.restaurant-dashboard.select.option9')</option>
                    <option value="7"
                            data-time="{{substr(Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['created_at'], 6, 4)}}">@lang('app.restaurant-dashboard.select.option10')</option>
                </select>&emsp;
                <label><i class="zmdi zmdi-refresh-sync d-inline fa-hover"
                          onclick="reloadSupplierReport()"></i></label>
            </div>
        </div>
    </h4>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-block statustic-card card-shadow-custom w-100">
                <div class="card-block p-t-0 loading-supplier-report">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-radio">
                                <form>
                                    <div class="radio radio-inline">
                                        <label>
                                            <input type="radio" id="show-vertical-supplier-report" name="radio" checked>
                                            <i class="helper"></i>@lang('app.component.chart.vertical-chart')
                                        </label>
                                    </div>
                                    <div class="radio radio-inline">
                                        <label>
                                            <input type="radio" id="show-horizontal-supplier-report" name="radio">
                                            <i class="helper"></i>@lang('app.component.chart.horizontal-chart')
                                        </label>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-4 text-center">
                            <h5 class="text-center text-inverse font-weight-bold">@lang('app.component.chart.total')
                                <span class="font-weight-bold"
                                      id="total-supplier-report">0</span> @lang('app.component.unit-money.vnd')
                            </h5>
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox-fade fade-in-primary float-right">
                                <label>
                                    <input type="checkbox" id="label-chart-supplier-report" checked>
                                    <span class="cr"><i
                                                class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                    <span>@lang('app.component.chart.check-detail')</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-4"></div>
                        <div class="col-4 text-center">
                            <select class="form-control width-50 js-example-basic-single"
                                    id="select-supplier-report">
                                <option value="1">Nhà cung cấp 1</option>
                                <option value="1">Nhà cung cấp 2</option>
                            </select>&emsp;
                        </div>
                    </div>
                    <div id="chart-vertical-supplier-report" class="vertical-chart style-large-chart-dashboard"></div>
                    <div id="chart-horizontal-supplier-report" class="d-none style-large-chart-dashboard"></div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--<div class="font-18 font-weight-bold row" style="margin-bottom: 30px">--}}
{{--<div class="col-lg-4 m-auto">--}}
{{--<div style="border: 2px solid #4c4c4c"></div>--}}
{{--</div>--}}
{{--<div class="col-lg-4 text-center" style="color: #4c4c4c">@lang('app.restaurant-dashboard.supplier-report.last-title')</div>--}}
{{--<div class="col-lg-4 m-auto">--}}
{{--<div style="border: 2px solid #4c4c4c"></div>--}}
{{--</div>--}}
{{--</div>--}}
@push('scripts')
    <script src="{{asset('js/dashboard/restaurant/supplier_report.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"
            type="text/javascript"></script>
@endpush
