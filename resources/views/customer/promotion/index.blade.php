@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="card-block mb-0 pt-0">
                    <div class="row">
                        <div class="col-lg-12 row">
                            <div class="col-lg-9">
                                <ul class="nav nav-tabs md-tabs md-4-tabs"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#applying-tab-promotion"
                                           role="tab" aria-expanded="false">@lang('app.promotion.tab.applying')
                                            <span class="label label-success" id="total-record-applying">0</span></a>
                                        <div class="slide"></div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#pending-tab-promotion" role="tab"
                                           aria-expanded="true">@lang('app.promotion.tab.pending')
                                            <span class="label label-warning" id="total-record-pending">0</span>
                                        </a>
                                        <div class="slide"></div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#pausing-tab-promotion" role="tab"
                                           aria-expanded="false">@lang('app.promotion.tab.pausing')
                                            <span class="label label-primary" id="total-record-pausing">0</span>
                                        </a>
                                        <div class="slide"></div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#expired-tab-promotion" role="tab"
                                           aria-expanded="false">@lang('app.promotion.tab.expired')
                                            <span class="label label-inverse" id="total-record-expired">0</span></a>
                                        <div class="slide"></div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-3 row m-auto">
                                <label class="input-group m-auto">
                                    <input type="text" id="from-date-happy-time-promotion" data-validate="search"
                                           class="input-sm form-control text-center input-datetimepicker p-1"
                                           value="01/{{date('m/Y')}}">
                                    <span class="input-group-addon">@lang('app.component.button.to')</span>
                                    <input type="text" id="to-date-happy-time-promotion" data-validate="search"
                                           class="input-sm form-control text-center input-datetimepicker"
                                           value="{{date('d/m/Y')}}">
                                    <button class="input-group-addon cursor-pointer" id="search-btn-happy-time-promotion"><i
                                            class="fa fa-search p-r-0px"></i></button>
                                </label>
                            </div>
                        </div>
                        <!-- Tab panes -->
                        <div class="col-lg-12 m-t-5">
                            <div class="tab-content">
                                <div class="tab-pane active" id="applying-tab-promotion" role="tabpanel">
                                    <div class="table-responsive">
                                        <table id="table-applying-customer-promotion" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>@lang('app.promotion.stt')</th>
                                                <th>@lang('app.promotion.name')</th>
                                                <th>@lang('app.promotion.type')</th>
                                                <th>@lang('app.promotion.time')</th>
                                                <th>@lang('app.promotion.action')</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="pending-tab-promotion" role="tabpanel">
                                    <div class="table-responsive">
                                        <table id="table-pending-customer-promotion" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>@lang('app.promotion.stt')</th>
                                                <th>@lang('app.promotion.name')</th>
                                                <th>@lang('app.promotion.type')</th>
                                                <th>@lang('app.promotion.time')</th>
                                                <th>@lang('app.promotion.action')</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="pausing-tab-promotion" role="tabpanel">
                                    <div class="table-responsive">
                                        <table id="table-pausing-customer-promotion" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>@lang('app.promotion.stt')</th>
                                                <th>@lang('app.promotion.name')</th>
                                                <th>@lang('app.promotion.type')</th>
                                                <th>@lang('app.promotion.time')</th>
                                                <th>@lang('app.promotion.action')</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="expired-tab-promotion" role="tabpanel">
                                    <div class="table-responsive">
                                        <table id="table-expired-customer-promotion" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>@lang('app.promotion.stt')</th>
                                                <th>@lang('app.promotion.name')</th>
                                                <th>@lang('app.promotion.type')</th>
                                                <th>@lang('app.promotion.time')</th>
                                                <th>@lang('app.promotion.action')</th>
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
    </div>

    @include('customer.promotion.create')
    @include('customer.promotion.update')
    @include('customer.promotion.detail')
    @include('customer.promotion.voucher')
    @include('customer.promotion.assign_food')

    <div id="mySidenav-321" class="sidenav">
        <a href="javascript:void(0)" id="button-service-1" class="bg-primary" onclick="openModalCreateCustomerPromotion()" style="width: max-content">
            <i class="fa fa-plus-square"></i>&emsp; @lang('app.component.button.create')
        </a>

        <a href="javascript:void(0)" id="button-service-2" class="bg-warning" onclick="openModalAssignFoodPromotion()" style="width: max-content">
            <i class="fa fa-exchange"></i>&emsp; Gán món
        </a>
    </div>
@endsection
@push('scripts')
    @include('layouts.oldDatatable')
    <script type="text/javascript" src="{{asset('js/customer/promotion/index.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
