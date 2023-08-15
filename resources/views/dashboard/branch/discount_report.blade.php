<style>
    #chart-vertical-discount-report {
        background: #ffffff !important;
        height: 60vh !important;
    }
</style>
<div class="report-revenue card-inview-dashboard" id="discount-report" data-key="discount-report">
    <div class="revenue-month seemt-blue seemt-border-bottom seemt-bg-white d-flex">
        <div class="content-revenue-month seemt-before-blue">
            <p>@lang('app.branch-dashboard.discount-report.title')</p>
        </div>
        <div class="d-flex" id="select-type-discount-report">
            <div class="checkbox-zoom zoom-primary d-flex align-items-center">
                <label class="mr-2 title-detail-checkbox mb-0 mt-1" style="vertical-align: sub">Xem Chi tiết</label>
                <label class="focus-validate mb-0">
                    <input type="checkbox" name="check-food" class="js-switch" id="detail-value-discount-report">
                </label>
            </div>
            @include('dashboard.branch.filter')
            <div class="bell ml-4">
                <div class="bit-icon seemt-green seemt-bg-green seemt-btn-hover-green" onclick="reloadDiscountReport()">
                    <i class="fi-rr-refresh"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="revenue-content">
        <div class="content-revenue-month-sub">
            <div class="row m-0 content-revenue-month-group">
                <div class="col-lg-12 seemt-border-radius-6 content-revenue-month-chart-report">
                    <div id="chart-vertical-discount-report" class="count-loading-chart h-100 w-100"></div>
                    <div id="chart-vertical-discount-report-empty" class="d-flex align-center justify-content-center d-none">
                        <img src="{{asset('images/tms/empty.png')}}" style="width: 200px; height: auto; object-fit: contain;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




















{{--<div class="card card-block card-shadow-custom-dashboard card-inview-dashboard" id="discount-report" data-key="discount-report">--}}
{{--    <div class="row">--}}
{{--        <div class="sub-title p-0 col-lg-12 d-flex align-items-center justify-content-between pb-2">--}}
{{--            <h4 class="title-header-dashboard-report ml-0 mt-0 p-2 w-100">@lang('app.branch-dashboard.discount-report.title')--}}
{{--                <label class="title-header-dashboard-report" id="text-label-type-discount-report"></label>--}}
{{--            </h4>--}}
{{--            <div class="d-flex align-items-center justify-content-end w-100 mr-2 icon-header-dashboard-report-select" >--}}
{{--                @include('dashboard.branch.filter')--}}
{{--                <i class="icofont icofont-refresh d-inline fa-hover icon-header-dashboard-report" onclick="reloadDiscountReport()"></i>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="card-block p-t-0 loading-discount-report">--}}
{{--        <div class="row">--}}
{{--            <div class="col-sm-12 text-center">--}}
{{--                <h5 class="text-center text-inverse font-weight-bold mb-0" style="font-size: 15px!important"><span class="font-weight-bold" style="color: #fa6342;font-size: 20px!important" id="total-discount-report">0</span> @lang('app.component.unit-money.vnd')</h5>--}}
{{--            </div>--}}
{{--            <div  class="col-sm-12 text-right">--}}
{{--                <div class="checkbox-zoom zoom-primary">--}}
{{--                    <label class="focus-validate">--}}
{{--                        <input type="checkbox" value="" id="detail-value-discount-report">--}}
{{--                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>--}}
{{--                        <span>Xem Chi tiết</span>--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <div id="chart-vertical-discount-report" class="style-large-chart-dashboard"></div>--}}
{{--            <div id="chart-vertical-discount-report-empty" class="style-large-chart-dashboard d-flex align-center justify-content-center d-none">--}}
{{--                <img src="{{asset('images/tms/empty.png')}}" style="width: 200px; height: auto; object-fit: contain;" alt="">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="font-18 font-weight-bold row" style="margin-bottom: 30px">--}}
{{--<div class="col-lg-4 m-auto">--}}
{{--<div style="border: 2px solid #4c4c4c"></div>--}}
{{--</div>--}}
{{--<div class="col-lg-4 text-center" style="color: #4c4c4c">@lang('app.branch-dashboard.discount-report.last-title')</div>--}}
{{--<div class="col-lg-4 m-auto">--}}
{{--<div style="border: 2px solid #4c4c4c"></div>--}}
{{--</div>--}}
{{--</div>--}}
@push('scripts')
    <script src="{{asset('js/dashboard/branch/discount_report.js?version=81', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
@endpush
