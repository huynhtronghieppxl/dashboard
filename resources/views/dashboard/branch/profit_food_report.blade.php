{{--<div class="card card-block card-shadow-custom-dashboard card-inview-dashboard" id="profit-food-report" data-key="profit-food-report">--}}
{{--    <h4 class="m-b-20 p-b-5 b-b-default f-w-600">--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-9">--}}
{{--                <h4 class="font-weight-bold">@lang('app.branch-dashboard.profit-food-report.title')</h4>--}}
{{--            </div>--}}
{{--            <div class="col-lg-3 text-right row justify-content-end">--}}
{{--                <div class="select2_theme validate-group">--}}
{{--                    <div class="form-validate-select ">--}}
{{--                        <div class="col-lg-12 mx-0 px-0">--}}
{{--                            <div class="col-lg-12 pr-0 select-material-box pr-2">--}}
{{--                                <select id="select-type-profit-food-report" class="form-control border-0 select-not-select2">--}}
{{--                                    <option value="1" data-time="{{date('d/m/Y')}}">@lang('app.branch-dashboard.select.option1')</option>--}}
{{--                                    <option value="1" data-time="{{date('d/m/Y', strtotime('yesterday'))}}">@lang('app.branch-dashboard.select.option2')</option>--}}
{{--                                    <option value="2" data-time="{{date('W/Y')}}">@lang('app.branch-dashboard.select.option3')</option>--}}

{{--                                    <option value="3" data-time="{{date('m/Y')}}" selected>@lang('app.branch-dashboard.select.option5')</option>--}}
{{--                                    <option value="3" data-time="{{date('m/Y', strtotime('-1 month'))}}">@lang('app.branch-dashboard.select.option6')</option>--}}
{{--                                    <option value="4" data-time="{{date('m/Y')}}">@lang('app.branch-dashboard.select.option7')</option>--}}
{{--                                    <option value="5" data-time="{{date('Y')}}">@lang('app.branch-dashboard.select.option8')</option>--}}
{{--                                    <option value="5" data-time="{{date('Y', strtotime('-1 year'))}}">@lang('app.branch-dashboard.select.option11')</option>--}}
{{--                                    <option value="6" data-time="{{date('Y')}}">@lang('app.branch-dashboard.select.option9')</option>--}}
{{--                                    <option value="7" data-time="{{substr(Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['created_at'], 6, 4)}}">@lang('app.branch-dashboard.select.option10')</option>--}}
{{--                                </select>--}}
{{--                                <div class="line"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="pl-3 pt-1">--}}
{{--                    <i class="zmdi zmdi-refresh-sync d-inline fa-hover" onclick="reloadProfitFoodReport()"></i>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </h4>--}}
{{--    <div class="card card-block statustic-card card-shadow-custom">--}}
{{--        <h4 class="sub-title-2 font-weight-bold">@lang('app.branch-dashboard.food-drink-report.title-food')</h4>--}}
{{--        <div class="card-block p-t-0 loading-profit-food-report">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-12 text-center">--}}
{{--                    <h5 class="text-center text-inverse font-weight-bold mb-0" style="font-size: 15px!important">--}}
{{--                        <span class="font-weight-bold total-revenue-order-report" style="color: #fa6342;font-size: 20px!important" id="total-food-profit-food-report">0</span> @lang('app.component.unit-money.vnd')</h5>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div style="overflow-x: auto">--}}
{{--                <div id="chart-vertical-food-profit-food-report" class="vertical-chart style-large-chart-dashboard"></div>--}}
{{--            </div>--}}
{{--            <div id="chart-horizontal-food-profit-food-report" class="d-none style-large-chart-dashboard"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="card card-block statustic-card card-shadow-custom">--}}
{{--        <h4 class="sub-title-2 font-weight-bold">@lang('app.branch-dashboard.food-drink-report.title-drink')</h4>--}}
{{--        <div class="card-block p-t-0 loading-profit-food-report">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-4">--}}
{{--                    <div class="form-radio">--}}
{{--                        <form>--}}
{{--                            <div class="radio radio-inline">--}}
{{--                                <label>--}}
{{--                                    <input type="radio" id="show-vertical-drink-profit-food-report" name="radio" checked>--}}
{{--                                    <i class="helper"></i>@lang('app.component.chart.vertical-chart')--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="radio radio-inline">--}}
{{--                                <label>--}}
{{--                                    <input type="radio" id="show-horizontal-drink-profit-food-report" name="radio">--}}
{{--                                    <i class="helper"></i>@lang('app.component.chart.horizontal-chart')--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-4 text-center">--}}
{{--                    <h5 class="text-center text-inverse font-weight-bold">@lang('app.component.chart.total')--}}
{{--                        <span class="font-weight-bold"--}}
{{--                              id="total-drink-profit-food-report">0</span> @lang('app.component.unit-money.vnd')--}}
{{--                    </h5>--}}
{{--                </div>--}}
{{--                <div class="col-sm-4">--}}
{{--                    <div class="checkbox-fade fade-in-primary float-right">--}}
{{--                        <label>--}}
{{--                            <input type="checkbox" id="label-chart-drink-profit-food-report" checked>--}}
{{--                            <span class="cr"><i--}}
{{--                                        class="cr-icon icofont icofont-ui-check txt-primary"></i></span>--}}
{{--                            <span>@lang('app.component.chart.check-detail')</span>--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div style="overflow-x: auto">--}}
{{--                <div id="chart-vertical-drink-profit-food-report" class="vertical-chart style-large-chart-dashboard"></div>--}}
{{--            </div>--}}
{{--            <div id="chart-horizontal-drink-profit-food-report" class="d-none style-large-chart-dashboard"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="font-18 font-weight-bold row" style="margin-bottom: 30px">--}}
{{--<div class="col-lg-4 m-auto">--}}
{{--<div style="border: 2px solid #4c4c4c"></div>--}}
{{--</div>--}}
{{--<div class="col-lg-4 text-center" style="color: #4c4c4c">@lang('app.branch-dashboard.profit-food-report.last-title')</div>--}}
{{--<div class="col-lg-4 m-auto">--}}
{{--<div style="border: 2px solid #4c4c4c"></div>--}}
{{--</div>--}}
{{--</div>--}}
{{--@push('scripts')--}}
{{--    <script src="{{asset('js/dashboard/branch/profit_food_report.js?version=')}}"--}}
{{--            type="text/javascript"></script>--}}
{{--@endpush--}}
