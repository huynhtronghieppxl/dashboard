<div class="card card-block card-inview-dashboard pt-2" id="debt-report" data-key="debt-report">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="sub-title p-0 col-lg-12 d-flex align-items-center justify-content-between pb-2">
                    <h4 class="title-header-dashboard-report ml-0 mt-0 p-2 w-100">@lang('app.branch-dashboard.debt-report.title')
                        <label class="title-header-dashboard-report" id="text-label-type-debt-report"></label>
                    </h4>
                    <div class="d-flex align-items-center justify-content-end w-100 mr-2 icon-header-dashboard-report-select">
                        <div class="time-input-filter-time-bar custom-date mr-1 d-none" id="select-time-debt-day-report">
                            <input class="from-date-filter-time-bar custom-date from-date-filter-input p-1" type="text" value="{{date('d/m/Y')}}" />
                            <span class="input-group-addon text-primary custom-find mt-0">Đến</span>
                            <input class="to-date-filter-time-bar custom-date from-date-filter-input p-1" type="text" value="{{date('d/m/Y')}}" />
                            <div class="line-filter-time-bar"></div>
                            <button class="search-date-filter-time-bar"><i class="fa fa-search"></i></button>
                        </div>
                        <div class="time-input-filter-time-bar custom-date mr-1 d-none" id="select-time-debt-month-report">
                            <input class="from-month-filter-time-bar custom-date from-date-filter-input p-1" type="text" value="{{date('m/Y')}}" />
                            <span class="input-group-addon text-primary custom-find mt-0">Đến</span>
                            <input class="to-month-filter-time-bar custom-date from-date-filter-input p-1" type="text" value="{{date('m/Y')}}" />
                            <div class="line-filter-time-bar"></div>
                            <button class="search-date-filter-time-bar"><i class="fa fa-search"></i></button>
                        </div>
                        <div class="time-input-filter-time-bar custom-date mr-1 d-none" id="select-time-debt-year-report">
                            <input class="from-year-filter-time-bar custom-date from-date-filter-input p-1" type="text" value="{{date('Y')}}" />
                            <span class="input-group-addon text-primary custom-find mt-0">Đến</span>
                            <input class="to-year-filter-time-bar custom-date from-date-filter-input p-1" type="text" value="{{date('Y')}}" />
                            <div class="line-filter-time-bar"></div>
                            <button class="search-date-filter-time-bar"><i class="fa fa-search"></i></button>
                        </div>
                        <div class="select-filter-type-date" id="time-bar-filter-order-manage">
                            <div class="form-validate-select position-relative">
                                <div class="select-material-box">
                                    <select id="select-type-debt-report" class="js-example-basic-single select2-hidden-accessible form-control" tabindex="-1" aria-hidden="true">
                                        {{--                                            <option value="1"--}}
                                        {{--                                                    data-time="{{date('d/m/Y')}}">@lang('app.branch-dashboard.select.option1')</option>--}}
                                        {{--                                            <option value="1"--}}
                                        {{--                                                    data-time="{{date('d/m/Y', strtotime('yesterday'))}}">@lang('app.branch-dashboard.select.option2')</option>--}}
                                        {{--                                            <option value="2"--}}
                                        {{--                                                    data-time="{{date('W/Y')}}">@lang('app.branch-dashboard.select.option3')</option>--}}
                                        {{--                                            <option value="3" data-time="{{date('m/Y')}}"--}}
                                        {{--                                                    selected>@lang('app.branch-dashboard.select.option5')</option>--}}
                                        <option value="3"
                                                data-time="{{date('m/Y', strtotime('-1 month'))}}">@lang('app.branch-dashboard.select.option6')</option>
                                        <option value="4"
                                                data-time="{{date('m/Y')}}">@lang('app.branch-dashboard.select.option7')</option>
                                        <option value="5"
                                                data-time="{{date('Y')}}">@lang('app.branch-dashboard.select.option8')</option>
                                        <option value="5"
                                                data-time="{{date('Y', strtotime('-1 year'))}}">@lang('app.branch-dashboard.select.option11')</option>
                                        <option value="6"
                                                data-time="{{date('Y')}}">@lang('app.branch-dashboard.select.option9')</option>
                                        <option value="13">
                                            @lang('app.branch-dashboard.select.option12')</option>
                                        <option value="15">
                                            @lang('app.branch-dashboard.select.option13')</option>
                                        <option value="16">
                                            @lang('app.branch-dashboard.select.option14')</option>
                                        <option value="7"
                                                data-time="{{substr(Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['created_at'], 6, 4)}}">@lang('app.branch-dashboard.select.option10')</option>
                                    </select>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                        <i class="icofont icofont-refresh d-inline fa-hover icon-header-dashboard-report" onclick="reloadDebtReport()"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 mt-2">
            <div class="row pb-4 d-none">
                <div class="col-lg-12 edit-flex-auto-fill row m-0 p-0">
                    <div class="col-md-6 loading-det-report">
                        <div class="card statustic-progress-card card-shadow-custom">
                            <div class="card-header">
                                <h5>@lang('app.branch-dashboard.debt-report.order')</h5>
                            </div>
                            <div class="card-block">
                                <div class="row align-items-center">
                                    <div class="col text-right">
                                        <h4 id="total-amount-order-debt-report">0</h4>
                                    </div>
                                </div>
                                <div class="progress m-t-15">
                                    <div class="progress-bar bg-c-green w-100"></div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row text-center b-t-default">
                                    <div class="col-12 m-t-15">
                                        <p class="text-muted m-b-0">@lang('app.branch-dashboard.debt-report.quantity')</p>
                                        <h5 id="total-quantity-order-debt-report">0</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 loading-det-report">
                        <div class="card statustic-progress-card card-shadow-custom">
                            <div class="card-header">
                                <h5>@lang('app.branch-dashboard.debt-report.return')</h5>
                            </div>
                            <div class="card-block">
                                <div class="row align-items-center">
                                    <div class="col text-right">
                                        <h4 id="total-amount-return-debt-report">0</h4>
                                    </div>
                                </div>
                                <div class="progress m-t-15">
                                    <div class="progress-bar bg-dark w-100"></div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row text-center b-t-default">
                                    <div class="col-12 m-t-15">
                                        <p class="text-muted m-b-0">@lang('app.branch-dashboard.debt-report.quantity')</p>
                                        <h5 id="total-quantity-return-debt-report">0</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 loading-det-report">
                        <div class="card statustic-progress-card card-shadow-custom">
                            <div class="card-header">
                                <h5>@lang('app.branch-dashboard.debt-report.paid')</h5>
                            </div>
                            <div class="card-block">
                                <div class="row align-items-center">
                                    <div class="col text-right">
                                        <h4 id="total-amount-paid-debt-report">0</h4>
                                    </div>
                                </div>
                                <div class="progress m-t-15">
                                    <div class="progress-bar bg-c-blue w-100"></div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row text-center b-t-default">
                                    <div class="col-12 m-t-15">
                                        <p class="text-muted m-b-0">@lang('app.branch-dashboard.debt-report.quantity')</p>
                                        <h5 id="total-quantity-paid-debt-report">0</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 loading-det-report">
                        <div class="card statustic-progress-card card-shadow-custom">
                            <div class="card-header">
                                <div class="row m-0 p-0">
                                    <h5>@lang('app.branch-dashboard.debt-report.waiting')
                                        <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="top"
                                           data-original-title="@lang('app.branch-dashboard.debt-report.note-confirm') {{date('m/Y')}}"></i>
                                    </h5>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row align-items-center">
                                    <div class="col text-right">
                                        <h4 id="total-amount-waiting-debt-report">0</h4>
                                    </div>
                                </div>
                                <div class="progress m-t-15">
                                    <div class="progress-bar bg-warning w-100"></div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row text-center b-t-default">
                                    <div class="col-12 m-t-15">
                                        <p class="text-muted m-b-0">@lang('app.branch-dashboard.debt-report.quantity')</p>
                                        <h5 id="total-quantity-waiting-debt-report">0</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="table-responsive new-table">
                    <table id="table-supplier-debt-dashboard-report" class="table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã nhà cung cấp</th>
                                <th>Tên nhà cung cấp</th>
                                <th>Nợ đầu kỳ</th>
                                <th>Tăng trong kỳ</th>
                                <th>Giảm trong kỳ</th>
                                <th>Nợ cuối kỳ</th>
                                <th></th>
                                <th class="d-none"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('dashboard.branch.detail.supplier_debt')
@push('scripts')
    <script src="{{asset('js/dashboard/branch/debt_report.js?version=81')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('js\dashboard\branch\detail\supplier_debt.js?version=81', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
