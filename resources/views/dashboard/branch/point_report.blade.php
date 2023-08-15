<style>
    .module-action-report {
        position: absolute;
        top: 10px;
        right: 10px
    }

    #box-select-option-type-point .select2-selection--single {
        padding: 2px 4px 30px 20px !important;
    }

    #box-select-option-type-point .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 2px !important;
    }

    .module-action-report .btn-reload {
        cursor: pointer;
        background: #fff;
        border: medium none;
        border-radius: 100%;
        color: transparent;
        display: block;
        height: 30px;
        margin: 0 auto 0;
        width: 30px;
        transition: all 0.2s linear 0s;
        box-shadow: 0px 5px 10px rgb(0 0 0 / 20%);
        outline: none;
    }

    .module-action-report .btn-reload:before {
        color: #333;
        content: "\f01e";
        font-family: fontawesome;
        opacity: 1;
        position: absolute;
        transform: translate(-50%, -50%) rotate(0deg);
        z-index: 111;
        transition: all 0.2s linear 0s;
        margin: 7px;
    }


    .module-action-report .btn-reload:hover::before {
        color: #fff;
        transform: translate(-50%, -50%) rotate(360deg);
    }

    .module-action-report .btn-reload:hover {
        background: #f9a237;
    }

    #chart-customer-use-point-report {
        background: #ffffff !important;
        height: 60vh !important;
    }

    .border-right-supplier{
        right: 0px !important;
        height: auto !important;
        border-right: 1px solid #e9ecef;
        position: absolute;
        top: 12px !important;
        bottom: 12px !important;
    }
</style>


<div class="report-revenue card-inview-dashboard" id="customer-use-point-report" data-key="customer-use-point-report">
    <div class="revenue-month seemt-blue seemt-border-bottom seemt-bg-white d-flex">
        <div class="content-revenue-month seemt-before-blue">
            <p>Báo cáo điểm</p>
        </div>
        <div class="d-flex">
            <div class="d-flex mr-3">
                <div class="form-group select2_theme validate-group"
                     style=" width: 194px; margin-left: 16px">
                    <div class="form-validate-select position-relative">
                        <div class="select-material-box">
                            <select class="js-example-basic-single form-control"
                                    id="select-option-type-point-filter-report" tabindex="-1" aria-hidden="true">
                                <option value="0">Điểm tích luỹ</option>
                                <option value="1">Điểm khuyến mãi</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group select2_theme validate-group"
                     style=" width: 194px; margin-left: 16px">
                    <div class="form-validate-select position-relative">
                        <div class="select-material-box">
                            <select class="js-example-basic-single form-control"
                                    id="select-option-type-sort-filter-report" tabindex="-1" aria-hidden="true">
                                <option value="0" checked>Theo tất cả</option>
                                <option value="7">Theo level</option>
                                <option value="2">Theo tổng điểm đã nhận</option>
                                <option value="3">Theo số điểm đã nhận</option>
                                <option value="4">Theo tổng điểm sử dụng</option>
                                <option value="5">Theo số điểm sử dụng</option>
                                <option value="6">Theo số điểm còn lại</option>
                            </select>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex" id="select-type-point-report">
                @include('dashboard.branch.filter')
                <div class="bell ml-4">
                    <div class="bit-icon seemt-green seemt-bg-green seemt-btn-hover-green"
                         onclick="reloadPointReport()">
                        <i class="fi-rr-refresh"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="revenue-content mb-0">
        <div class="revenue-content-sub mb-0">
            <div class="content-revenue-month-sub">
                <div class="checkbox-zoom zoom-primary d-flex justify-content-end">
                    <label class="mr-2 title-detail-checkbox">Xem Chi tiết</label>
                    <label class="focus-validate">
                        <input type="checkbox" name="type-point" id="detail-value-point-report" class="js-switch">
                    </label>
                </div>
                <div class="row m-0 content-revenue-month-group">
                    <div class="col-lg-12 seemt-border-radius-6 content-revenue-month-chart-report">
                        <div id="chart-customer-use-point-report" class="count-loading-chart h-100 w-100"></div>
                        <div id="chart-customer-use-point-report-empty"
                             class="style-large-chart-dashboard d-flex align-center justify-content-center d-none">
                            <img src="{{asset('images/tms/empty.png')}}"
                                 style="width: 200px; height: auto; object-fit: contain;" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-revenue-month-sub">
                <div class="row m-0 content-revenue-month-group">
                    <div class="col-lg-12 seemt-border-radius-6 content-revenue-month-chart-report">
                        <div class="table-responsive new-table">
                            <table id="table-point-report" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th rowspan="2">STT</th>
                                    <th rowspan="3">Ảnh</th>
                                    <th rowspan="3" class="text-left">Tên</th>
                                    <th rowspan="3" class="text-left">Level</th>
                                    <th class="text-center" colspan="3" style="position: relative">
                                        Thời gian bắt đầu đến hiện tại
                                        <div  class="border-right-supplier"></div>
                                    </th>
                                    <th id="time-filter" class="text-center" colspan="2"></th>
                                    <th rowspan="3"></th>
                                </tr>
                                <tr>
                                    <th class="text-right">Tổng điểm đã nhận</th>
                                    <th class="text-right">Tổng điểm sử dụng</th>
                                    <th class="text-right" style="position: relative">
                                        Số điểm còn lại
                                        <div  class="border-right-supplier"></div>
                                    </th>
                                    <th class="text-right">Số điểm đã nhận</th>
                                    <th class="text-right">Số điểm sử dụng</th>
                                </tr>
                                <tr>
                                    <th>Tổng</th>
                                    <th class="seemt-fz-14" id="total-receive">0</th>
                                    <th class="seemt-fz-14" id="total-used">0</th>
                                    <th  style="position: relative">
                                        <label class="seemt-fz-14 m-0" id="total-remaining"> 0 </label>
                                        <div  class="border-right-supplier"></div>
                                    </th>
                                    <th class="seemt-fz-14" id="total-number-receive">0</th>
                                    <th class="seemt-fz-14" id="total-number-used">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="card card-block card-shadow-custom-dashboard card-inview-dashboard d-none" id="customer-use-point-report"
     data-key="customer-use-point-report">
    <div class="row">
        <div class="sub-title p-0 col-lg-12 d-flex align-items-center justify-content-between pb-2">
            <h4 class="title-header-dashboard-report ml-0 mt-0 p-2 w-100">Báo cáo điểm
                <label class="title-header-dashboard-report" id="text-label-type-point-report"></label>
            </h4>
            <div class="d-flex align-items-center justify-content-end w-100 mr-2 icon-header-dashboard-report-select"
                 id="select-type-point-report">
                @include('dashboard.branch.filter')
                <i class="icofont icofont-refresh d-inline fa-hover icon-header-dashboard-report"
                   onclick="reloadPointReport()"></i>
            </div>
        </div>
    </div>
    <div class="card card-block statustic-card card-shadow-custom">
        <div class="card-block p-t-0 loading-customer-use-point-report">
            <div class="row">
                <div class="col-sm-2 text-right">
                    <div class="form-validate-select position-relative">
                        <div class="select-material-box" id="box-select-option-type-point">
                            <select class="js-example-basic-single form-control"
                                    id="select-option-type-point-filter-report" tabindex="-1" aria-hidden="true">
                                {{--                                <option value="-1" checked>Tất cả loại điểm</option>--}}
                                <option value="1">Điểm tích luỹ</option>
                                <option value="2">Điểm khuyến mãi</option>
                            </select>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 text-right">
                    <div class="form-validate-select position-relative">
                        <div class="select-material-box" id="box-select-option-type-point">
                            <select class="js-example-basic-single form-control"
                                    id="select-option-type-sort-filter-report" tabindex="-1" aria-hidden="true">
                                <option value="0" checked>Theo tất cả</option>
                                <option value="7">Theo level</option>
                                <option value="2">Theo tổng điểm đã nhận</option>
                                <option value="3">Theo số điểm đã nhận</option>
                                <option value="4">Theo tổng điểm sử dụng</option>
                                <option value="5">Theo số điểm sử dụng</option>
                                <option value="6">Theo số điểm còn lại</option>
                            </select>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 text-right">
                    <div class="checkbox-zoom zoom-primary">
                        <label class="focus-validate">
                            <input type="checkbox" value="" name="type-point" id="detail-value-point-report">
                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                            <span>Xem Chi tiết</span>
                        </label>
                    </div>
                </div>
            </div>
            {{--            <div class="form-radio" id="type-point-report">--}}
            {{--                <form>--}}
            {{--                    <div class="radio" style="display: inline-block; margin: 0">--}}
            {{--                        <label>--}}
            {{--                            <input type="radio" name="radio" value="2" checked>--}}
            {{--                            <i class="helper"></i>@lang('app.branch-dashboard.customer-use-point-report.opt2')--}}
            {{--                        </label>--}}
            {{--                    </div>--}}
            {{--                    <div class="radio" style="display: inline-block; margin: 0">--}}
            {{--                        <label>--}}
            {{--                            <input type="radio" name="radio" value="3">--}}
            {{--                            <i class="helper"></i>@lang('app.branch-dashboard.customer-use-point-report.opt3')--}}
            {{--                        </label>--}}
            {{--                    </div>--}}
            {{--                </form>--}}
            {{--            </div>--}}
            <div id="chart-customer-use-point-report" class="style-large-chart-dashboard"></div>
            <div id="chart-customer-use-point-report-empty"
                 class="style-large-chart-dashboard d-flex align-center justify-content-center d-none">
                <img src="{{asset('images/tms/empty.png')}}" style="width: 200px; height: auto; object-fit: contain;"
                     alt="">
            </div>
        </div>
    </div>
    <div class="card card-block statustic-card card-shadow-custom loading-point-customer-report">
        <div class="card-block p-t-0 loading-customer-use-point-report">
            <div class="table-responsive new-table">
                <table id="table-point-report" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ảnh</th>
                        <th>Tên</th>
                        <th>Level</th>
                        <th>Tổng điểm đã nhận</th>
                        <th>Số điểm đã nhận</th>
                        <th>Tổng điểm sử dụng</th>
                        <th>Số điểm sử dụng</th>
                        <th>Số điểm còn lại</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>Tổng</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th id="total-top-up-point">0</th>
                        <th id="top-up-point">0</th>
                        <th id="top-up-used">0</th>
                        <th id="total-top-up-used">0</th>
                        <th id="total-top-up-remaining">0</th>
                        <th></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $('#select-type-point-report').on('change', function () {
            $(this).parents('.module-action-report').find('.input-group.w-max').addClass('d-none');
            switch ($(this).val()) {
                case '2':
                    $(this).parents('.module-action-report').find('.div-type-day-module-action-report').removeClass('d-none');
                    break;
                case '3':
                    $(this).parents('.module-action-report').find('.div-type-month-module-action-report').removeClass('d-none');
                    break;
                case '4':
                    $(this).parents('.module-action-report').find('.div-type-year-module-action-report').removeClass('d-none');
                    break;
            }
        })
    </script>
    <script src="{{asset('js/dashboard/branch/point_report.js?version=81', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
@endpush
