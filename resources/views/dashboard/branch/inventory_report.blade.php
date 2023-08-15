<div class="report-revenue card-inview-dashboard" id="inventory-report" data-key="inventory-report">
    <div class="revenue-month seemt-blue seemt-border-bottom seemt-bg-white d-flex">
        <div class="content-revenue-month seemt-before-blue">
            <p>@lang('app.branch-dashboard.inventory-report.title')</p>
        </div>
        <div class="content-revenue seemt-orange d-flex">
            <div class="text-revenue p-0 text-left">
                <label class="m-0 seemt-blue mr-1 seemt-fz-16" style="font-weight: 500;white-space: nowrap">Tổng cộng:</label>
            </div>
            <div class="total-revenue">
                <label class="m-0 float-right font-weight-bold seemt-blue seemt-fz-16" id="total-all-in-inventory-report">0</label>
            </div>
        </div>
        <div class="d-flex" id="select-type-inventory-report">
            @include('dashboard.branch.filter')
            <div class="bell ml-4">
                <div class="bit-icon seemt-green seemt-bg-green seemt-btn-hover-green" onclick="reloadInventoryReport()">
                    <i class="fi-rr-refresh"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="revenue-content">
        <div class="row m-0">
            <div class="revenue-content-sub card-report col-lg-3 mb-1">
                <div class="revenue-content-group-sub">
                    <div class="revenue-month seemt-green seemt-border-bottom">
                        <div class="card-report-title seemt-before-green">
                            <p class="seemt-fz-16" style="font-size: 20px !important;">@lang('app.branch-dashboard.inventory-report.tab1')</p>
                            <label class="seemt-green" id="total-material-in-inventory-report">0</label>
                        </div>
                    </div>
                    <div class="content-revenue-card-report">
                        <div class="card-report-item-content">
                            <div class="card-report-item-content-group-content">
                                <div class="card-report-item">
                                    <div class="row m-0 card-report-item-title">
                                        <i class="fi-rr-chart-pie-alt"></i>
                                        <span>Nguyên liệu chính</span>
                                    </div>
                                    <div class="row m-0 card-report-item-value">
                                        <span class="seemt-blue" id="total-main-material-in-inventory-report">0</span>
                                    </div>
                                </div>
                                <div class="card-report-item">
                                    <div class="row m-0 card-report-item-title">
                                        <i class="fi-rr-chart-pie-alt"></i>
                                        <span>Nguyên liệu phụ (gia vị)</span>
                                    </div>
                                    <div class="row m-0 card-report-item-value">
                                        <span class="seemt-blue" id="total-sub-material-in-inventory-report">0</span>
                                    </div>
                                </div>
                                <div class="card-report-item">
                                    <div class="row m-0 card-report-item-title">
                                        <i class="fi-rr-chart-pie-alt"></i>
                                        <span>Khác</span>
                                    </div>
                                    <div class="row m-0 card-report-item-value">
                                        <span class="seemt-blue" id="total-sub-material-in-inventory-report-other">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="revenue-content-sub card-report col-lg-3 mb-1">
                <div class="revenue-content-group-sub">
                    <div class="revenue-month seemt-green seemt-border-bottom">
                        <div class="card-report-title seemt-before-green">
                            <p class="seemt-green  seemt-fz-16" style="font-size: 20px !important;">Kho nội bộ</p>
                            <label class="seemt-green" id="total-internal-in-inventory-report">0</label>
                        </div>
                    </div>
                    <div class="content-revenue-card-report">
                        <div class="card-report-item-content">
                            <div class="card-report-item-content-group-content">
                                <div class="card-report-item">
                                    <div class="row m-0 card-report-item-title">
                                        <i class="fi-rr-chart-pie-alt"></i>
                                        <span>Thức ăn nội bộ</span>
                                    </div>
                                    <div class="row m-0 card-report-item-value">
                                        <span class="seemt-blue" id="total-internal-internal-in-inventory-report">0</span>
                                    </div>
                                </div>
                                <div class="card-report-item">
                                    <div class="row m-0 card-report-item-title">
                                        <i class="fi-rr-chart-pie-alt"></i>
                                        <span>Khác</span>
                                    </div>
                                    <div class="row m-0 card-report-item-value">
                                        <span class="seemt-blue" id="total-sub-material-in-inventory-report-internal-other">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="revenue-content-sub card-report col-lg-3 mb-1">
                <div class="revenue-content-group-sub">
                    <div class="revenue-month seemt-green seemt-border-bottom">
                        <div class="card-report-title seemt-before-green">
                            <p class="seemt-green seemt-fz-16" style="font-size: 20px !important;">Kho hàng hoá</p>
                            <label class="seemt-green" id="total-goods-in-inventory-report">0</label>
                        </div>
                    </div>
                    <div class="content-revenue-card-report">
                        <div class="card-report-item-content">
                            <div class="card-report-item-content-group-content">
                                <div class="card-report-item">
                                    <div class="row m-0 card-report-item-title">
                                        <i class="fi-rr-chart-pie-alt"></i>
                                        <span>Thức ăn</span>
                                    </div>
                                    <div class="row m-0 card-report-item-value">
                                        <span class="seemt-blue" id="total-food-goods-in-inventory-report">0</span>
                                    </div>
                                </div>
                                <div class="card-report-item">
                                    <div class="row m-0 card-report-item-title">
                                        <i class="fi-rr-chart-pie-alt"></i>
                                        <span>Đồ uống</span>
                                    </div>
                                    <div class="row m-0 card-report-item-value">
                                        <span class="seemt-blue" id="total-drink-goods-in-inventory-report">0</span>
                                    </div>
                                </div>
                                <div class="card-report-item">
                                    <div class="row m-0 card-report-item-title">
                                        <i class="fi-rr-chart-pie-alt"></i>
                                        <span>Vật dụng</span>
                                    </div>
                                    <div class="row m-0 card-report-item-value">
                                        <span class="seemt-blue" id="total-produce-goods-in-inventory-report">0</span>
                                    </div>
                                </div>
                                <div class="card-report-item">
                                    <div class="row m-0 card-report-item-title">
                                        <i class="fi-rr-chart-pie-alt"></i>
                                        <span>Khác</span>
                                    </div>
                                    <div class="row m-0 card-report-item-value">
                                        <span class="seemt-blue" id="total-sub-material-in-inventory-report-goods-other">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="revenue-content-sub card-report col-lg-3 mb-1" >
                <div class="revenue-content-group-sub">
                    <div class="revenue-month seemt-green seemt-border-bottom">
                        <div class="card-report-title seemt-before-green">
                            <p class="seemt-green  seemt-fz-16" style="font-size: 20px !important;">Kho khác</p>
                            <label class="seemt-green" id="total-other-in-inventory-report">0</label>
                        </div>
                    </div>
                    <div class="content-revenue-card-report">
                        <div class="card-report-item-content">
                            <div class="card-report-item-content-group-content">
                                <div class="card-report-item">
                                    <div class="row m-0 card-report-item-title">
                                        <i class="fi-rr-chart-pie-alt"></i>
                                        <span>Nguyên liệu gián tiếp</span>
                                    </div>
                                    <div class="row m-0 card-report-item-value">
                                        <span class="seemt-blue" id="total-indirect-other-in-inventory-report">0</span>
                                    </div>
                                </div>
                                <div class="card-report-item">
                                    <div class="row m-0 card-report-item-title">
                                        <i class="fi-rr-chart-pie-alt"></i>
                                        <span>Văn phòng phẩm</span>
                                    </div>
                                    <div class="row m-0 card-report-item-value">
                                        <span class="seemt-blue" id="total-stationery-other-in-inventory-report">0</span>
                                    </div>
                                </div>
                                <div class="card-report-item">
                                    <div class="row m-0 card-report-item-title">
                                        <i class="fi-rr-chart-pie-alt"></i>
                                        <span>Hóa chất, chất tẩy rửa</span>
                                    </div>
                                    <div class="row m-0 card-report-item-value">
                                        <span class="seemt-blue" id="total-chemistry-other-in-inventory-report">0</span>
                                    </div>
                                </div>
                                <div class="card-report-item">
                                    <div class="row m-0 card-report-item-title">
                                        <i class="fi-rr-chart-pie-alt"></i>
                                        <span>Dụng cụ</span>
                                    </div>
                                    <div class="row m-0 card-report-item-value">
                                        <span class="seemt-blue" id="total-tool-other-in-inventory-report">0</span>
                                    </div>
                                </div>
                                <div class="card-report-item">
                                    <div class="row m-0 card-report-item-title">
                                        <i class="fi-rr-chart-pie-alt"></i>
                                        <span>Đá lạnh</span>
                                    </div>
                                    <div class="row m-0 card-report-item-value">
                                        <span class="seemt-blue" id="total-ice-other-in-inventory-report">0</span>
                                    </div>
                                </div>
                                <div class="card-report-item">
                                    <div class="row m-0 card-report-item-title">
                                        <i class="fi-rr-chart-pie-alt"></i>
                                        <span>Chất đốt</span>
                                    </div>
                                    <div class="row m-0 card-report-item-value">
                                        <span class="seemt-blue" id="total-fuel-other-in-inventory-report">0</span>
                                    </div>
                                </div>
                                <div class="card-report-item">
                                    <div class="row m-0 card-report-item-title">
                                        <i class="fi-rr-chart-pie-alt"></i>
                                        <span>Bao bì thực phẩm</span>
                                    </div>
                                    <div class="row m-0 card-report-item-value">
                                        <span class="seemt-blue" id="total-other-food-packaging-in-inventory-report">0</span>
                                    </div>
                                </div>
                                <div class="card-report-item">
                                    <div class="row m-0 card-report-item-title">
                                        <i class="fi-rr-chart-pie-alt"></i>
                                        <span>Vật dụng trang trí</span>
                                    </div>
                                    <div class="row m-0 card-report-item-value">
                                        <span class="seemt-blue" id="total-other-decorative-items-in-inventory-report">0</span>
                                    </div>
                                </div>
                                <div class="card-report-item">
                                    <div class="row m-0 card-report-item-title">
                                        <i class="fi-rr-chart-pie-alt"></i>
                                        <span>Khác</span>
                                    </div>
                                    <div class="row m-0 card-report-item-value">
                                        <span class="seemt-blue" id="total-other-other-in-inventory-report">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--        <div class="row">--}}
{{--            <div class="col-lg-4 edit-flex-auto-fill loading-in-inventory-report">--}}
{{--                <div class="card-block flex-sub m-auto">--}}
{{--                    <div class="statustic-progress-card card-shadow-custom m-auto w-100">--}}
{{--                        <div class="card-header">--}}
{{--                            <h3 class="font-weight-bold">@lang('app.branch-dashboard.inventory-report.total')</h3>--}}
{{--                        </div>--}}
{{--                        <div class="card-block">--}}
{{--                            <div class="row align-items-center">--}}
{{--                                <div class="col text-right">--}}
{{--                                    <h4 class="font-weight-bold" id="total-all-in-inventory-report">0</h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="progress m-t-15">--}}
{{--                                <div class="progress-bar bg-facebook w-100"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-8 edit-flex-auto-fill row">--}}
{{--                <div class="col-md-6 loading-in-inventory-report">--}}
{{--                    <div class="card statustic-progress-card card-shadow-custom">--}}
{{--                        <div class="card-header">--}}
{{--                            <h5>@lang('app.branch-dashboard.inventory-report.tab1')</h5>--}}
{{--                        </div>--}}
{{--                        <div class="card-block">--}}
{{--                            <div class="row align-items-center">--}}
{{--                                <div class="col text-right">--}}
{{--                                    <h4 id="total-material-in-inventory-report">0</h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="progress m-t-15">--}}
{{--                                <div class="progress-bar bg-c-green w-100"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="card-footer">--}}
{{--                            <div class="row text-center b-t-default">--}}
{{--                                <div class="col-4 b-r-default m-t-15">--}}
{{--                                    <h5 id="total-main-material-in-inventory-report">0</h5>--}}
{{--                                    <p class="text-muted m-b-0">@lang('app.branch-dashboard.inventory-report.main-material')</p>--}}
{{--                                </div>--}}
{{--                                <div class="col-4 b-r-default m-t-15">--}}
{{--                                    <h5 id="total-sub-material-in-inventory-report">0</h5>--}}
{{--                                    <p class="text-muted m-b-0">@lang('app.branch-dashboard.inventory-report.sub-material')</p>--}}
{{--                                </div>--}}
{{--                                <div class="col-4 b-r-default m-t-15">--}}
{{--                                    <h5 id="total-sub-material-in-inventory-report">0</h5>--}}
{{--                                    <p class="text-muted m-b-0">Khác</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 loading-in-inventory-report">--}}
{{--                    <div class="paid-revenue statustic-progress-card card-shadow-custom">--}}
{{--                        <div class="card-header">--}}
{{--                            <h5>@lang('app.branch-dashboard.inventory-report.tab2')</h5>--}}
{{--                        </div>--}}
{{--                        <div class="card-block">--}}
{{--                            <div class="row align-items-center">--}}
{{--                                <div class="col text-right">--}}
{{--                                    <h4 id="total-goods-in-inventory-report">0</h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="progress m-t-15">--}}
{{--                                <div class="progress-bar bg-c-yellow w-100"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="card-footer">--}}
{{--                            <div class="row text-center b-t-default">--}}
{{--                                <div class="col-3 b-r-default m-t-15">--}}
{{--                                    <h5 id="total-food-goods-in-inventory-report">0</h5>--}}
{{--                                    <p class="text-muted m-b-0">@lang('app.branch-dashboard.inventory-report.food')</p>--}}
{{--                                </div>--}}
{{--                                <div class="col-3 b-r-default m-t-15">--}}
{{--                                    <h5 id="total-drink-goods-in-inventory-report">0</h5>--}}
{{--                                    <p class="text-muted m-b-0">@lang('app.branch-dashboard.inventory-report.drink')</p>--}}
{{--                                </div>--}}
{{--                                <div class="col-3 b-r-default m-t-15">--}}
{{--                                    <h5 id="total-produce-goods-in-inventory-report">0</h5>--}}
{{--                                    <p class="text-muted m-b-0">@lang('app.branch-dashboard.inventory-report.produce')</p>--}}
{{--                                </div>--}}
{{--                                <div class="col-3 b-r-default m-t-15">--}}
{{--                                    <h5 id="total-sub-material-in-inventory-report">0</h5>--}}
{{--                                    <p class="text-muted m-b-0">Khác</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 loading-in-inventory-report">--}}
{{--                    <div class="paid-revenue statustic-progress-card card-shadow-custom">--}}
{{--                        <div class="card-header">--}}
{{--                            <h5>@lang('app.branch-dashboard.inventory-report.tab3')</h5>--}}
{{--                        </div>--}}
{{--                        <div class="card-block">--}}
{{--                            <div class="row align-items-center">--}}
{{--                                <div class="col text-right">--}}
{{--                                    <h4 id="total-internal-in-inventory-report">0</h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="progress m-t-15">--}}
{{--                                <div class="progress-bar bg-c-blue w-100"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="card-footer">--}}
{{--                            <div class="row text-center b-t-default">--}}
{{--                                <div class="col-6 b-r-default m-t-15">--}}
{{--                                    <h5 id="total-internal-internal-in-inventory-report">0</h5>--}}
{{--                                    <p class="text-muted m-b-0">@lang('app.branch-dashboard.inventory-report.internal')</p>--}}
{{--                                </div>--}}
{{--                                <div class="col-6 b-r-default m-t-15">--}}
{{--                                    <h5 id="total-sub-material-in-inventory-report">0</h5>--}}
{{--                                    <p class="text-muted m-b-0">Khác</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 loading-in-inventory-report">--}}
{{--                    <div class="paid-revenue statustic-progress-card card-shadow-custom">--}}
{{--                        <div class="card-header">--}}
{{--                            <h5>@lang('app.branch-dashboard.inventory-report.tab4')</h5>--}}
{{--                        </div>--}}
{{--                        <div class="card-block">--}}
{{--                            <div class="row align-items-center">--}}
{{--                                <div class="col text-right">--}}
{{--                                    <h4 id="total-other-in-inventory-report">0</h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="progress m-t-15">--}}
{{--                                <div class="progress-bar bg-dark w-100"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="card-footer">--}}
{{--                            <div class="row text-center b-t-default">--}}
{{--                                <div class="col-4 b-r-default m-t-15">--}}
{{--                                    <h5 id="total-indirect-other-in-inventory-report">0</h5>--}}
{{--                                    <p class="text-muted m-b-0">@lang('app.branch-dashboard.inventory-report.indirect')</p>--}}
{{--                                </div>--}}
{{--                                <div class="col-4 b-r-default m-t-15">--}}
{{--                                    <h5 id="total-other-other-in-inventory-report">0</h5>--}}
{{--                                    <p class="text-muted m-b-0">@lang('app.branch-dashboard.inventory-report.other')</p>--}}
{{--                                </div>--}}
{{--                                <div class="col-4 b-r-default m-t-15">--}}
{{--                                    <h5 id="total-sub-material-in-inventory-report">0</h5>--}}
{{--                                    <p class="text-muted m-b-0">Khác</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>























{{--<div class="card card-block card-shadow-custom-dashboard card-inview-dashboard" id="inventory-report"--}}
{{--     data-key="inventory-report">--}}
{{--    <div class="row">--}}
{{--        <div class="p-0 col-lg-12 d-flex align-items-center justify-content-between pb-2">--}}
{{--            <h4 class="m-b-20 p-b-5 b-b-default f-w-600 title-header-dashboard-report ml-0 mt-0 p-2 w-100">@lang('app.branch-dashboard.inventory-report.title')--}}
{{--                <label class="title-header-dashboard-report" id="text-label-type-revenue-cost-profit-report"></label>--}}
{{--            </h4>--}}
{{--            <div class="d-flex align-items-center justify-content-end w-100 mr-2 icon-header-dashboard-report-select" id="select-type-inventory-report">--}}
{{--                @include('dashboard.branch.filter')--}}
{{--                <i class="icofont icofont-refresh d-inline fa-hover icon-header-dashboard-report" onclick="reloadInventoryReport()"></i>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="row">--}}
{{--        <div class="col-lg-4 edit-flex-auto-fill loading-in-inventory-report">--}}
{{--            <div class="card-block flex-sub m-auto">--}}
{{--                <div class="statustic-progress-card card-shadow-custom m-auto w-100">--}}
{{--                    <div class="card-header">--}}
{{--                        <h3 class="font-weight-bold">@lang('app.branch-dashboard.inventory-report.total')</h3>--}}
{{--                    </div>--}}
{{--                    <div class="card-block">--}}
{{--                        <div class="row align-items-center">--}}
{{--                            <div class="col text-right">--}}
{{--                                <h4 class="font-weight-bold" id="total-all-in-inventory-report">0</h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="progress m-t-15">--}}
{{--                            <div class="progress-bar bg-facebook w-100"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-8 edit-flex-auto-fill row">--}}
{{--            <div class="col-md-6 loading-in-inventory-report">--}}
{{--                <div class="card statustic-progress-card card-shadow-custom">--}}
{{--                    <div class="card-header">--}}
{{--                        <h5>@lang('app.branch-dashboard.inventory-report.tab1')</h5>--}}
{{--                    </div>--}}
{{--                    <div class="card-block">--}}
{{--                        <div class="row align-items-center">--}}
{{--                            <div class="col text-right">--}}
{{--                                <h4 id="total-material-in-inventory-report">0</h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="progress m-t-15">--}}
{{--                            <div class="progress-bar bg-c-green w-100"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <div class="row text-center b-t-default">--}}
{{--                            <div class="col-4 b-r-default m-t-15">--}}
{{--                                <h5 id="total-main-material-in-inventory-report">0</h5>--}}
{{--                                <p class="text-muted m-b-0">@lang('app.branch-dashboard.inventory-report.main-material')</p>--}}
{{--                            </div>--}}
{{--                            <div class="col-4 b-r-default m-t-15">--}}
{{--                                <h5 id="total-sub-material-in-inventory-report">0</h5>--}}
{{--                                <p class="text-muted m-b-0">@lang('app.branch-dashboard.inventory-report.sub-material')</p>--}}
{{--                            </div>--}}
{{--                            <div class="col-4 b-r-default m-t-15">--}}
{{--                                <h5 id="total-sub-material-in-inventory-report">0</h5>--}}
{{--                                <p class="text-muted m-b-0">Khác</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-6 loading-in-inventory-report">--}}
{{--                <div class="card statustic-progress-card card-shadow-custom">--}}
{{--                    <div class="card-header">--}}
{{--                        <h5>@lang('app.branch-dashboard.inventory-report.tab2')</h5>--}}
{{--                    </div>--}}
{{--                    <div class="card-block">--}}
{{--                        <div class="row align-items-center">--}}
{{--                            <div class="col text-right">--}}
{{--                                <h4 id="total-goods-in-inventory-report">0</h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="progress m-t-15">--}}
{{--                            <div class="progress-bar bg-c-yellow w-100"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <div class="row text-center b-t-default">--}}
{{--                            <div class="col-3 b-r-default m-t-15">--}}
{{--                                <h5 id="total-food-goods-in-inventory-report">0</h5>--}}
{{--                                <p class="text-muted m-b-0">@lang('app.branch-dashboard.inventory-report.food')</p>--}}
{{--                            </div>--}}
{{--                            <div class="col-3 b-r-default m-t-15">--}}
{{--                                <h5 id="total-drink-goods-in-inventory-report">0</h5>--}}
{{--                                <p class="text-muted m-b-0">@lang('app.branch-dashboard.inventory-report.drink')</p>--}}
{{--                            </div>--}}
{{--                            <div class="col-3 b-r-default m-t-15">--}}
{{--                                <h5 id="total-produce-goods-in-inventory-report">0</h5>--}}
{{--                                <p class="text-muted m-b-0">@lang('app.branch-dashboard.inventory-report.produce')</p>--}}
{{--                            </div>--}}
{{--                            <div class="col-3 b-r-default m-t-15">--}}
{{--                                <h5 id="total-sub-material-in-inventory-report">0</h5>--}}
{{--                                <p class="text-muted m-b-0">Khác</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-6 loading-in-inventory-report">--}}
{{--                <div class="card statustic-progress-card card-shadow-custom">--}}
{{--                    <div class="card-header">--}}
{{--                        <h5>@lang('app.branch-dashboard.inventory-report.tab3')</h5>--}}
{{--                    </div>--}}
{{--                    <div class="card-block">--}}
{{--                        <div class="row align-items-center">--}}
{{--                            <div class="col text-right">--}}
{{--                                <h4 id="total-internal-in-inventory-report">0</h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="progress m-t-15">--}}
{{--                            <div class="progress-bar bg-c-blue w-100"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <div class="row text-center b-t-default">--}}
{{--                            <div class="col-6 b-r-default m-t-15">--}}
{{--                                <h5 id="total-internal-internal-in-inventory-report">0</h5>--}}
{{--                                <p class="text-muted m-b-0">@lang('app.branch-dashboard.inventory-report.internal')</p>--}}
{{--                            </div>--}}
{{--                            <div class="col-6 b-r-default m-t-15">--}}
{{--                                <h5 id="total-sub-material-in-inventory-report">0</h5>--}}
{{--                                <p class="text-muted m-b-0">Khác</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-6 loading-in-inventory-report">--}}
{{--                <div class="card statustic-progress-card card-shadow-custom">--}}
{{--                    <div class="card-header">--}}
{{--                        <h5>@lang('app.branch-dashboard.inventory-report.tab4')</h5>--}}
{{--                    </div>--}}
{{--                    <div class="card-block">--}}
{{--                        <div class="row align-items-center">--}}
{{--                            <div class="col text-right">--}}
{{--                                <h4 id="total-other-in-inventory-report">0</h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="progress m-t-15">--}}
{{--                            <div class="progress-bar bg-dark w-100"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <div class="row text-center b-t-default">--}}
{{--                            <div class="col-4 b-r-default m-t-15">--}}
{{--                                <h5 id="total-indirect-other-in-inventory-report">0</h5>--}}
{{--                                <p class="text-muted m-b-0">@lang('app.branch-dashboard.inventory-report.indirect')</p>--}}
{{--                            </div>--}}
{{--                            <div class="col-4 b-r-default m-t-15">--}}
{{--                                <h5 id="total-other-other-in-inventory-report">0</h5>--}}
{{--                                <p class="text-muted m-b-0">@lang('app.branch-dashboard.inventory-report.other')</p>--}}
{{--                            </div>--}}
{{--                            <div class="col-4 b-r-default m-t-15">--}}
{{--                                <h5 id="total-sub-material-in-inventory-report">0</h5>--}}
{{--                                <p class="text-muted m-b-0">Khác</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@push('scripts')
    <script src="{{asset('js/dashboard/branch/inventory_report.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"
            type="text/javascript"></script>
@endpush
