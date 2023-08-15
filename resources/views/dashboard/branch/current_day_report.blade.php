<style>
    .text-revenue > label {
        text-transform: uppercase;
    }

    .fi {
        font-size: 45px !important;
        color: #E96012;
    }

    .left {
        position: absolute;
        top: 45%;
        left: -12px;
    }

    .right {
        position: absolute;
        top: 45%;
        right: -12px;
    }

    .report-revenue {
        padding-bottom: 0 !important;
    }

    /*.report-revenue .revenue-content {*/
    /*    padding: 20px 20px 0 20px !important;*/
    /*}*/

</style>
<div class="report-revenue card-inview-dashboard" data-key="current-day-report" id="current-day-report">
    <div class="revenue-month seemt-blue seemt-border-bottom seemt-bg-white d-flex">
        <div class="content-revenue-month seemt-before-blue">
            <p>BÁO CÁO HOẠT ĐỘNG TRONG NGÀY</p>
            <label class="title-header-dashboard-report" id="current-day-report-date">
                @if(Session::get(SESSION_KEY_HOUR_TO_TAKE_REPORT) < date('H'))
                    {{date('d/m/Y')}}
                @else
                    {{date('d/m/Y', strtotime('yesterday'))}}
                @endif
            </label>
        </div>
        <div class="d-flex">
            <div class="bell ml-4">
                <div class="bit-icon seemt-green seemt-bg-green seemt-btn-hover-green"
                     onclick="reloadCurrentDayReport()">
                    <i class="fi-rr-refresh"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="revenue-content">
        <div class="revenue-content-sub">
            <div class="revenue-month seemt-green seemt-border-bottom">
                <div class="title-revenue-month-sub seemt-before-green">
                    <p id="title-card1"></p>
                </div>
            </div>
            <div class="content-revenue-month-sub">
                <div class="row m-0 content-revenue-month-group">
                    <div class="col-lg-7 col-md-6 col-sm-12 seemt-border-radius-6 content-revenue-month-chart-report">
                        <div id="chart-brand-card1" class="count-loading-chart w-100"></div>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12 pr-0">
                        <div class="revenue seemt-report-item">
                            <div class="paid-revenue d-flex justify-content-between">
                                <div class="logo-revenue seemt-bg-green mt-1">
                                    <i class="fi-rr-stats seemt-green"></i>
                                </div>
                                <div class="content-revenue seemt-green d-flex flex-wrap">
                                    <div class="text-revenue col-12 p-0 text-right">
                                        <label class="m-0">DOANH THU ĐÃ THANH TOÁN</label>
                                    </div>
                                    {{--                                    <div class="col-1 p-0 text-center">--}}
                                    {{--                                        <i class="fi-rr-exclamation"></i>--}}
                                    {{--                                    </div>--}}
                                    <div class="total-revenue col-12 pr-0 text-right">
                                        <label class="m-0 float-right font-weight-bold" id="done-card1">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="revenue seemt-report-item">
                            <div class="paid-revenue d-flex justify-content-between">
                                <div class="logo-revenue  seemt-bg-blue mt-1">
                                    <i class="fi-rr-chat-arrow-down seemt-blue"></i>
                                </div>
                                <div class="content-revenue seemt-blue d-flex flex-wrap">
                                    <div class="text-revenue col-12 p-0 text-right">
                                        <label class="m-0 seemt-blue">DOANH THU ĐANG PHỤC VỤ</label>
                                    </div>
                                    {{--                                    <div class="col-1 p-0 text-center">--}}
                                    {{--                                        <i class="fi-rr-exclamation"></i>--}}
                                    {{--                                    </div>--}}
                                    <div class="total-revenue col-12  pr-0 seemt-orange text-right">
                                        <label class="m-0 float-right font-weight-bold seemt-blue"
                                               id="waiting-card1">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="revenue seemt-report-item">
                            <div class="paid-revenue d-flex justify-content-between">
                                <div class="logo-revenue seemt-bg-orange mt-1">
                                    <i class="fi-rr-chat-arrow-grow seemt-orange"></i>
                                </div>
                                <div class="content-revenue seemt-orange d-flex flex-wrap">
                                    <div class="text-revenue col-12 p-0 text-right">
                                        <label class="m-0 seemt-orange">DOANH THU ƯỚC TÍNH</label>
                                    </div>
                                    <div class="total-revenue col-12 pr-0 text-right">
                                        <label class="m-0 float-right font-weight-bold seemt-orange"
                                               id="total-card1">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="revenue seemt-report-item">
                            <div class="paid-revenue d-flex justify-content-between">
                                <div class="logo-revenue seemt-bg-red mt-1">
                                    <i class="fi-rr-user seemt-red"></i>
                                </div>
                                <div class="content-revenue seemt-red d-flex flex-wrap">
                                    <div class="text-revenue col-12 p-0 text-right">
                                        <label class="m-0 seemt-red">KHÁCH HÀNG ĐÃ PHỤC VỤ</label>
                                    </div>
                                    <div class="total-revenue col-12 pr-0 text-right">
                                        <label class="m-0 float-right font-weight-bold seemt-red"
                                               id="total-customer-service-complete">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="position-relative">
            <div class="row" id="chart-data-card1" style="display: flex; flex-wrap: nowrap; scroll-behavior: smooth; overflow-x: hidden">
            </div>

            <span class="fi fi-rr-caret-left left d-none pointer   " id="scroll-to-left" onclick="scrollRight()"></span>
            <span class="fi fi-rr-caret-right right pointer d-none  " id="scroll-to-right" onclick="scrollLeftA()"></span>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{asset('js/dashboard/branch/current_day_report.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"
            type="text/javascript"></script>
@endpush
