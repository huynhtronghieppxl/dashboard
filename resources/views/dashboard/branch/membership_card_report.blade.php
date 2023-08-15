<div class="card card-block card-inview-dashboard pt-2" id="customer-use-point-report" data-key="customer-use-point-report">
    <div class="row">
        <div class="sub-title p-0 col-lg-12 d-flex align-items-center justify-content-between pb-2">
            <h4 class="title-header-dashboard-report ml-0 mt-0 p-2 w-100">Báo cáo hạng thẻ thành viên</h4>
            <div class="d-flex align-items-center justify-content-end w-100 mr-2 icon-header-dashboard-report-select">
                <div class="select-filter-type-date" id="time-bar-filter-order-manage">
                    <div class="form-validate-select position-relative">
                        <div class="select-material-box">
                            <select id="select-type-membership-card-report" class="js-example-basic-single select2-hidden-accessible form-control" tabindex="-1" aria-hidden="true">
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
                <i class="icofont icofont-refresh d-inline fa-hover icon-header-dashboard-report" onclick="reloadCustomerUsePointReport()"></i>
            </div>
        </div>
    </div>
    <div class="card card-block statustic-card card-shadow-custom">
        <div class="card-block p-t-0 loading-customer-use-point-report">
            <div id="chart-customer-use-point-report" class="style-large-chart-dashboard"></div>
        </div>
    </div>
    <div class="card card-block statustic-card card-shadow-custom loading-point-customer-report" >
        <div class="card-block p-t-0 loading-customer-use-point-report">
            <div class="table-responsive">
                <table id="table-customer-use-point-report" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ảnh</th>
                        <th>Tên</th>
                        <th>Level</th>
                        <th>Tổng tiền nâng hạng</th>
                        <th>Số điểm đã tích</th>
                        <th>Số lần tích điểm</th>
                        <th>Số điểm sử dụng</th>
                        <th>Số lần sử dụng</th>
                        <th>Số điểm đang có</th>
                        <th>Lần cuối đến quán</th>
                        <th></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{asset('js/dashboard/branch/membership_card_report.js?version=81', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
@endpush
