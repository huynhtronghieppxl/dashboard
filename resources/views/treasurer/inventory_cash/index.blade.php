@extends('layouts.layout')
@section('content')
    <head></head>
    <div class="page-wrapper">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>@lang('app.inventory-cash.title')</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="/"> <i class="feather icon-home"></i> </a>
                            </li>
                            <li class="breadcrumb-item"><a href="">@lang('app.inventory-cash.breadcrumb')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="card card-block">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-xl-6">
                        <div class="row card-block">
                            <div class="col-sm-12 col-md-12 col-xl-12 text-center"><h4>Danh sách thanh toán tiền
                                    mặt</h4></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-xl-12 text-center">
                                {{--Datatables start--}}
                                <div class="table-responsive">
                                    <table id="table-bill-liabilities1" class="table table-bordered nowrap table-ajax-reload mb-0">
                                        <thead>
                                        <tr>
                                            <th>---</th>
                                            <th>---</th>
                                            <th>---</th>
                                            <th>---</th>
                                        </tr>
                                        {{--                                    <tr>--}}
                                        {{--                                        <th class="text-left" colspan="10">@lang('app.payment-bill.total-table')<label--}}
                                        {{--                                                class="m-0" id="payment-bill-total-pending"></label></th>--}}
                                        {{--                                    </tr>--}}
                                        </thead>

                                    </table>
                                </div>
                                {{--end- datatable--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-xl-6">
                        <div class="row card-block">
                            <div class="col-sm-12 col-md-12 col-xl-12 text-center"><h4>Danh sách thanh toán thẻ</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-xl-12 text-center">
                                {{--Datatables start--}}
                                <div class="table-responsive">
                                    <table id="table-bill-liabilities1" class="table table-bordered nowrap table-ajax-reload mb-0">
                                        <thead>
                                        <tr>
                                            {{--                                        <th></th>--}}
                                            <th>---</th>
                                            <th>---</th>
                                            <th>---</th>
                                            <th>---</th>
                                        </tr>
                                        {{--                                    <tr>--}}
                                        {{--                                        <th class="text-left" colspan="10">@lang('app.payment-bill.total-table')<label--}}
                                        {{--                                                class="m-0" id="payment-bill-total-pending"></label></th>--}}
                                        {{--                                    </tr>--}}
                                        </thead>

                                    </table>
                                </div>
                                {{--end- datatable--}}
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
@push('scripts')
    @include('layouts.oldDatatable')
    {{--    <script type="text/javascript" src="..\js\treasurer\bill_liabilities\index.js"></script>--}}
    <script>
        alert('Layout đang tiến hành');
        function test_function(id) {
            let _element = $('.chat-single-box[data-id="' + id + '"]');
            // $('.chat-single-box[data-id="' + id + '"]').find('.chat-body').animate({
            //         scrollTop: $(".message-scrooler .messages").last().offset().top + $(".message-scrooler .messages").last().offset().left *$(".message-scrooler .messages").last().offset().top
            //     },'slow');
            $('.chat-single-box[data-id="' + id + '"]').find('.chat-body').scrollTop($(".message-scrooler .messages:last").offset().top)
        }
    </script>
@endpush
