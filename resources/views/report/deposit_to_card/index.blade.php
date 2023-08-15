@extends('layouts.layout')
@section('content')
    <style>
        #chart-recharge-card-report-vertical {
            height: calc(100vh - 200px);
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('files\assets\pages\timeline\style.css?version=')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card" id="content-detail">
                @include('report.filter')
                <div class="row scroll-containers">
                    <div class="col-lg-12">
                        <div class="col-lg-12 selections">
                            <div class="card-block row pt-0">
                                <div class="col-lg-12 mt-4">
                                    <div class="row justify-content-end" id="detail-value-recharge-card-report-box">
                                        <div class="form-validate-checkbox d-flex flex-row-reverse p-0 mr-0">
                                            <div class="checkbox-form-group">
                                                <input type="checkbox" value="" id="detail-value-recharge-card-report"
                                                       required="">
                                                <label class="name-checkbox" style="line-height: 21px"
                                                       for="detail-value-point-report"> Xem Chi tiết </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="chart-recharge-card-report-vertical"
                                         class="mt-0 vertical-chart count-loading-chart">
                                        <div id="chart-recharge-card-vertical-main-empty"
                                             class="empty-datatable-custom center-loading d-none">
                                            <img style="width: 200px"
                                                 src="{{asset('/images/tms/empty.png', env('IS_DEPLOY_ON_SERVER'))}}">
                                        </div>
                                        <div id="chart-recharge-card-vertical-main" style="height: 100%; width: 98%"
                                             class="mt-0 vertical-chart count-loading-chart center-loading">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 selections">
                            <div class="card-body">
                                <div class="table-responsive new-table" id="table-recharge-card">
                                    <table id="table-recharge-card-report" class="table">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.branch-dashboard.employee-report.stt')</th>
                                            <th>@lang('app.branch-dashboard.employee-report.avatar')</th>
                                            <th>@lang('app.branch-dashboard.employee-report.name')</th>
                                            <th>Level</th>
                                            <th>Tổng tiền đã nạp</th>
                                            <th>Số tiền đã nạp</th>
                                            <th>Tổng tiền sử dụng</th>
                                            <th>Số tiền sử dụng</th>
                                            <th>Số tiền còn lại</th>
                                            <th></th>
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
    </div>
    @include('customer.customers.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js/report/deposit_to_card/index.js?version=1', env('IS_DEPLOY_ON_SERVER')) }}"></script>
@endpush
