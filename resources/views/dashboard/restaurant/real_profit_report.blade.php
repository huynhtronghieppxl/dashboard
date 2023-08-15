{{--<div class="card card-block card-shadow-custom-dashboard card-inview-dashboard" id="real-profit-report"--}}
{{--     data-key="real-profit-report">--}}
{{--    <h4 class="m-b-20 p-b-5 b-b-default f-w-600">--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-9">--}}
{{--                <h4 class="font-weight-bold">@lang('app.restaurant-dashboard.real-profit-report.title')</h4>--}}
{{--            </div>--}}
{{--            <div class="col-lg-3 text-right row justify-content-end">--}}
{{--                <div class="select2_theme validate-group">--}}
{{--                    <div class="form-validate-select ">--}}
{{--                        <div class="col-lg-12 mx-0 px-0">--}}
{{--                            <div class="col-lg-12 pr-0 select-material-box pr-2">--}}
{{--                                <select id="select-type-real-profit-report"--}}
{{--                                        class="form-control border-0 select-not-select2">--}}
{{--                                    <option value="1"--}}
{{--                                            data-time="{{date('d/m/Y')}}">@lang('app.branch-dashboard.select.option1')</option>--}}
{{--                                    <option value="1"--}}
{{--                                            data-time="{{date('d/m/Y', strtotime('yesterday'))}}">@lang('app.branch-dashboard.select.option2')</option>--}}
{{--                                    <option value="2"--}}
{{--                                            data-time="{{date('W/Y')}}">@lang('app.branch-dashboard.select.option3')</option>--}}

{{--                                    <option value="3" data-time="{{date('m/Y')}}"--}}
{{--                                            selected>@lang('app.branch-dashboard.select.option5')</option>--}}
{{--                                    <option value="3"--}}
{{--                                            data-time="{{date('m/Y', strtotime('-1 month'))}}">@lang('app.branch-dashboard.select.option6')</option>--}}
{{--                                    <option value="4"--}}
{{--                                            data-time="{{date('m/Y')}}">@lang('app.branch-dashboard.select.option7')</option>--}}
{{--                                    <option value="5"--}}
{{--                                            data-time="{{date('Y')}}">@lang('app.branch-dashboard.select.option8')</option>--}}
{{--                                    <option value="5"--}}
{{--                                            data-time="{{date('Y', strtotime('-1 year'))}}">@lang('app.branch-dashboard.select.option11')</option>--}}
{{--                                    <option value="6"--}}
{{--                                            data-time="{{date('Y')}}">@lang('app.branch-dashboard.select.option9')</option>--}}
{{--                                    <option value="7">@lang('app.branch-dashboard.select.option10')</option>--}}
{{--                                </select>--}}
{{--                                <div class="line"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="pl-3 pt-1">--}}
{{--                    <i class="zmdi zmdi-refresh-sync d-inline fa-hover" onclick="reloadRealProfitReport()"></i>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </h4>--}}
{{--    <div class="row">--}}
{{--        <div class="col-3 loading-real-profit-report">--}}
{{--            <div class="card bg-c-green update-card">--}}
{{--                <div class="card-block">--}}
{{--                    <div class="align-items-end">--}}
{{--                        <h4 class="text-white float-right p-r-20" id="total-real-profit-report">0</h4>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card-footer">--}}
{{--                    <h4>@lang('app.restaurant-dashboard.real-profit-report.total')</h4>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-1 m-auto text-center"><i class="fa fa-pause fa-rotate-90"></i></div>--}}
{{--        <div class="col-4 loading-real-profit-report">--}}
{{--            <div class="card bg-c-lite-green update-card">--}}
{{--                <div class="card-block">--}}
{{--                    <div class="align-items-end">--}}
{{--                        <h4 class="text-white float-right p-r-20" id="profit-real-profit-report">0</h4>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card-footer">--}}
{{--                    <h4>@lang('app.restaurant-dashboard.real-profit-report.office')</h4>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-1 m-auto text-center"><i class="fa fa-2x fa-minus"></i></div>--}}
{{--        <div class="col-3 loading-real-profit-report">--}}
{{--            <div class="card bg-c-pink update-card">--}}
{{--                <div class="card-block">--}}
{{--                    <div class="align-items-end">--}}
{{--                        <h4 class="text-white float-right p-r-20" id="debt-real-profit-report">0</h4>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card-footer">--}}
{{--                    <h4>@lang('app.restaurant-dashboard.real-profit-report.debt')</h4>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@push('scripts')--}}
{{--    <script src="{{asset('js/dashboard/restaurant/real_profit_report.js?version=')}}"--}}
{{--            type="text/javascript"></script>--}}
{{--@endpush--}}
