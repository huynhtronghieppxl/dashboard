@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
{{--        <div class="page-header">--}}
{{--            <div class="row align-items-end">--}}
{{--                <div class="col-lg-8">--}}
{{--                    <div class="page-header-title">--}}
{{--                        <div class="d-inline">--}}
{{--                            <h4>@lang('app.notification.title')</h4>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-4">--}}
{{--                    <div class="page-header-breadcrumb">--}}
{{--                        <ul class="breadcrumb-title">--}}
{{--                            <li class="breadcrumb-item">--}}
{{--                                <a href="/"><i class="feather icon-home"></i></a>--}}
{{--                            </li>--}}
{{--                            <li class="breadcrumb-item">--}}
{{--                                <a href="{{route('customer.notification.index')}}">@lang('app.notification.breadcrumb')</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="page-body">
            <div class="card mb-0">
                <div class="card-block">
                    <div class="col-sm-12 col-md-12 col-xl-12 pt-3 px-0">
                        <div class="table-responsive">
                            <table id="table-customer-notification" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>@lang('app.notification.table.stt')</th>
                                        <th>@lang('app.notification.table.title')</th>
                                        <th>@lang('app.notification.table.content')</th>
{{--                                        <th>@lang('app.notification.table.created_at')</th>--}}
                                        <th>@lang('app.notification.table.action')</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('customer.notification.create')
    @include('customer.notification.update')
    @include('customer.notification.send_notify')

    <div id="mySidenav-321" class="sidenav">
        <a href="javascript:void(0)" id="button-service-1" class="bg-primary" onclick="openModalCreateNotificationCustomer()" style="width: max-content">
            <i class="fa fa-plus-square"></i>&emsp; @lang('app.component.button.create')
        </a>
    </div>

@endsection

@push('scripts')
    @include('layouts.oldDatatable')
    <script type="text/javascript" src="{{asset('js/customer/notification/index.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
