<style>
    #chart-off-menu-dishes-report {
        background: #ffffff !important;
        height: 60vh !important;
    }
</style>
<div class="report-revenue card-inview-dashboard" id="dishes-report" data-key="dishes-report">
    <div class="revenue-month seemt-blue seemt-border-bottom seemt-bg-white d-flex">
        <div class="content-revenue-month seemt-before-blue">
            <p>Món ngoài Menu</p>
        </div>

        <div class="d-flex" id="select-type-order-report">
            <div class="checkbox-zoom zoom-primary d-flex align-items-center">
                <label class="mr-2 title-detail-checkbox mb-0 mt-1" style="vertical-align: sub">Xem Chi tiết</label>
                <label class="focus-validate mb-0">
                    <input type="checkbox" name="check-food" class="js-switch" id="detail-value-dishes-report">
                </label>
            </div>
            <div class="select-filter-type-date" id="time-bar-filter-order-manage">
                <div class="form-validate-select position-relative">
                    <div class="select-material-box">
                        <select id="select-off-menu-dishes-report" class="js-example-basic-single select2-hidden-accessible form-control" tabindex="-1" aria-hidden="true">
                            <option value="1" data-time="{{date('d/m/Y')}}">@lang('app.branch-dashboard.select.option1')</option>
                            <option value="1" data-time="{{date('d/m/Y', strtotime('yesterday'))}}">@lang('app.branch-dashboard.select.option2')</option>
                            <option value="2" data-time="{{date('W/Y')}}">@lang('app.branch-dashboard.select.option3')</option>
                            <option value="3" data-time="{{date('m/Y')}}" selected="">@lang('app.branch-dashboard.select.option5')</option>
                            <option value="3" data-time="{{date('m/Y', strtotime('-1 month'))}}">@lang('app.branch-dashboard.select.option6')</option>
                            <option value="4" data-time="{{date('m/Y')}}">@lang('app.branch-dashboard.select.option7')</option>
                            <option value="5" data-time="{{date('Y')}}">@lang('app.branch-dashboard.select.option8')</option>
                            <option value="5" data-time="{{date('Y', strtotime('-1 year'))}}">@lang('app.branch-dashboard.select.option11')</option>
                            <option value="6" data-time="{{date('Y')}}">@lang('app.branch-dashboard.select.option9')</option>
                            <option value="8" data-time="{{substr(Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['created_at'], 6, 4)}}">@lang('app.branch-dashboard.select.option10')</option>
                        </select>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
            <div style="margin-left: 10px">
                <div class="select-filter-type-date">
                    <div class="select-material-box">
                        <select id="select-sort-off-menu-dishes-report"
                                class="form-control js-example-basic-single select2-hidden-accessible">
                            <option
                                value="1">Giá bán
                            </option>
                            <option
                                value="2">Số lượng
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="bell ml-4">
                <div class="bit-icon seemt-green seemt-bg-green seemt-btn-hover-green" onclick="reloadOfDishesMenuReport()">
                    <i class="fi-rr-refresh"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="revenue-content">
        <div class="content-revenue-month-sub">
            <div class="row m-0 content-revenue-month-group">
                <div class="col-lg-12 seemt-border-radius-6 content-revenue-month-chart-report">
                    <div id="chart-off-menu-dishes-report" class="count-loading-chart h-100 w-100"></div>
                    <div id="chart-off-menu-dishes-report-empty" class="d-flex align-center justify-content-center d-none">
                        <img src="{{asset('images/tms/empty.png')}}" style="width: 200px; height: auto; object-fit: contain;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{asset('js/dashboard/branch/off_menu_dishes_report.js?version=82', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
@endpush
