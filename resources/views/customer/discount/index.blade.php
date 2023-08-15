@extends('layouts.layout') @section('content')
    <div class="page-wrapper">
        {{--
        <div class="page-header">
            --}} {{--
        <div class="row align-items-end">
            --}} {{--
            <div class="col-lg-8">
                --}} {{--
                <div class="page-header-title">
                    --}} {{--
                    <div class="d-inline">
                        --}} {{--
                        <h4>@lang('app.discount-customer.title')</h4>
                        --}} {{--
                    </div>
                    --}} {{--
                </div>
                --}} {{--
            </div>
            --}} {{--
            <div class="col-lg-4">
                --}} {{--
                <div class="page-header-breadcrumb">
                    --}} {{--
                    <ul class="breadcrumb-title">
                        --}} {{--
                        <li class="breadcrumb-item">
                            --}} {{-- <a href="/"> <i class="feather icon-home"></i> </a>--}} {{--
                        </li>
                        --}} {{--
                        <li class="breadcrumb-item"><a--}} {{-- {{--</li>
                        --}} {{--
                    </ul>
                    --}} {{--
                </div>
                --}} {{--
            </div>
            --}} {{--
        </div>
        --}}
    </div>
    <div class="page-body">
        <div class="card card-block">
            <ul class="nav nav-tabs md-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" id="tab-discount-customer-1" href="#cards-tab1" role="tab" aria-expanded="true">
                        @lang('app.discount-customer.tab1') <span class="label label-success" id="total-record-enable">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" id="tab-discount-customer-2" href="#cards-tab2" role="tab" aria-expanded="false">
                        @lang('app.discount-customer.tab2') <span class="label label-inverse" id="total-record-disable">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item"></li>
            </ul>
            <div class="tab-content m-t-5px">
                <div class="tab-pane active" id="cards-tab1" role="tabpanel">
                    <div class="table-responsive">
                        <table id="table-enable-discount-customer" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>@lang('app.discount-customer.stt')</th>
                                <th>@lang('app.discount-customer.amount')</th>
                                <th>@lang('app.discount-customer.gift')</th>
                                <th>@lang('app.discount-customer.value')</th>
                                <th>@lang('app.discount-customer.action')</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="cards-tab2" role="tabpanel">
                    <div class="table-responsive">
                        <table id="table-disable-discount-customer" class="table">
                            <thead>
                            <tr>
                                <th>@lang('app.discount-customer.stt')</th>
                                <th>@lang('app.discount-customer.amount')</th>
                                <th>@lang('app.discount-customer.gift')</th>
                                <th>@lang('app.discount-customer.value')</th>
                                <th>@lang('app.discount-customer.action')</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    @include('customer.discount.create')
    @include('customer.discount.update')

    <div id="mySidenav-321" class="sidenav">
        <a href="javascript:void(0)" id="button-service-1" class="bg-primary" onclick="openModalCreateDiscount()" style="width: max-content;"> <i class="fa fa-plus-square"></i>&emsp; @lang('app.component.button.create') </a>
    </div>
@endsection @push('scripts')
    @include('layouts.oldDatatable')
    <script type="text/javascript" src="{{asset('js/customer/discount/index.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
