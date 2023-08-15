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
                        <h4>@lang('app.gift.title')</h4>
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
                        <li class="breadcrumb-item">--}} {{-- <a href="{{route('customer.gift.index')}}">@lang('app.gift.breadcrumb')</a>--}} {{--</li>
                        --}} {{--
                    </ul>
                    --}} {{--
                </div>
                --}} {{--
            </div>
            --}} {{--
        </div>
        --}} {{--
    </div>
    --}}
        <div class="page-body">
            <div class="card">
                <div class="card-block mb-0">
                    <ul class="nav nav-tabs md-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab1-gift" role="tab" aria-expanded="false">@lang('app.gift.tab1') <span class="label label-success" id="total-record-enable">0</span></a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab2-gift" role="tab" aria-expanded="true">
                                @lang('app.gift.tab2')
                                <span class="label label-inverse" id="total-record-disable">0</span>
                            </a>
                            <div class="slide"></div>
                        </li>
                    </ul>
                </div>
                <!-- Tab panes -->
                <div class="col-lg-12 m-t-5">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1-gift" role="tabpanel">
                            <div class="table-responsive">
                                <table id="table-enable-gift" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.gift.stt')</th>
                                        <th>@lang('app.gift.name')</th>
                                        <th>@lang('app.gift.price')</th>
                                        <th>@lang('app.gift.description')</th>
                                        <th>@lang('app.gift.action')</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2-gift" role="tabpanel">
                            <div class="table-responsive">
                                <table id="table-disable-gift" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.gift.stt')</th>
                                        <th>@lang('app.gift.name')</th>
                                        <th>@lang('app.gift.price')</th>
                                        <th>@lang('app.gift.description')</th>
                                        <th>@lang('app.gift.action')</th>
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
    <div class="d-none">
        <span id="msg-title-status-gift">@lang('app.gift.title-status')</span>
        <span id="msg-content-status-gift">@lang('app.gift.content-status')</span>
        <span id="msg-success-status-gift">@lang('app.gift.success-status')</span>
    </div>

    @include('customer.gift.create')
    @include('customer.gift.update')

    <div id="mySidenav-321" class="sidenav">
        <a href="javascript:void(0)" id="button-service-1" class="bg-primary" onclick="openModalCreateGift()" style="width: max-content;"> <i class="fa fa-plus-square"></i>&emsp; @lang('app.component.button.create') </a>
    </div>
@endsection @push('scripts')
    @include('layouts.oldDatatable')
    <script type="text/javascript" src="{{asset('js/customer/gift/index.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
