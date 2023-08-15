@extends('layouts.layout') @section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card card-block">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs md-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="enable-message-customer" data-toggle="tab" href="#unit-tab1" role="tab" aria-expanded="true">
                                    @lang('app.message.tab1')
                                    <span class="label label-success" id="total-record-enable-message-customer"></span>
                                </a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" id="disable-message-customer" href="#unit-tab2" role="tab" aria-expanded="false">
                                    @lang('app.message.tab2')
                                    <span class="label label-inverse" id="total-record-disable-message-customer"></span>
                                </a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item"></li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content pt-2 mb-0">
                    <div class="tab-pane active" id="unit-tab1" role="tabpanel">
                        <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                            <div class="table-responsive">
                                <table id="table-enable-customer-message" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.message.stt')</th>
                                        <th>@lang('app.message.branch')</th>
                                        <th>@lang('app.message.type')</th>
                                        <th>@lang('app.message.content')</th>
                                        <th>@lang('app.message.status')</th>
                                        <th>@lang('app.message.action')</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="unit-tab2" role="tabpanel">
                        <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                            <div class="table-responsive">
                                <table id="table-disable-customer-message" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.message.stt')</th>
                                        <th>@lang('app.message.branch')</th>
                                        <th>@lang('app.message.type')</th>
                                        <th>@lang('app.message.content')</th>
                                        <th>@lang('app.message.status')</th>
                                        <th>@lang('app.message.action')</th>
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
        <span id="id-tab-active-message-customer">1</span>
        <span id="msg-title-status-message-customer">@lang('app.message.title-status')</span>
        <span id="msg-content-status-message-customer">@lang('app.message.content-status')</span>
        <span id="msg-detele-message-customer">@lang('app.message.delete-greeting')</span>
        <span id="msg-succes-detele-message-customer">@lang('app.message.success-delete')</span>
    </div>

    @include('customer.message.create')
    @include('customer.message.update')


    <div id="mySidenav-321" class="sidenav">
        <a href="javascript:void(0)" id="button-service-1" class="bg-primary" onclick="openModalCreateCustomerMessage()" style="width: max-content;"> <i class="fa fa-plus-square"></i>&emsp; @lang('app.component.button.create') </a>
    </div>
@endsection @push('scripts')
    @include('layouts.oldDatatable')
    <script type="text/javascript" src="{{asset('js/customer/message/index.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
