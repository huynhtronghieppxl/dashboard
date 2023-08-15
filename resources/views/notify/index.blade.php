@extends('layouts.layout')
@section('content')
    <div class="page-wrapper container-fluid" style="padding-left: 15%;padding-right: 15%;">
        <div class="card-block">
            <div class="page-body invoice-list-page" style="height:100vh;">
                <div class="row">
                    <div class="col-12 filter-bar">
                        <!-- Navigation start -->
                        <nav class="navbar navbar-light bg-faded m-b-30 p-10">
                            <ul class="nav navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="javascript:void(0)">@lang('app.notify.filter'): <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="bydate"
                                       data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false"><i
                                            class="icofont icofont-clock-time"></i>@lang('app.notify.custom')</a>
                                    <div class="dropdown-menu" aria-labelledby="bydate" id="filter-time-notify">
                                        <a class="dropdown-item active" href="javascript:void(0)" data-from=""
                                           data-to="">Tất cả</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)" data-from="{{date('d/m/Y')}}"
                                           data-to="{{date('d/m/Y')}}">@lang('app.notify.today')</a>
                                        <a class="dropdown-item" href="javascript:void(0)" data-from="{{date('d/m/Y')}}"
                                           data-to="{{date('d/m/Y')}}">@lang('app.notify.yesterday')</a>
                                        <a class="dropdown-item" href="javascript:void(0)" data-from="{{date('d/m/Y')}}"
                                           data-to="{{date('d/m/Y')}}">@lang('app.notify.this-week')</a>
                                        <a class="dropdown-item" href="javascript:void(0)"
                                           data-from="{{date('d/m/Y', strtotime('first day of month'))}}"
                                           data-to="{{date('d/m/Y')}}">@lang('app.notify.this-month')</a>
                                    </div>
                                </li>
                                <!-- end of by date dropdown -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="bystatus"
                                       data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false"><i
                                            class="icofont icofont-chart-histogram-alt"></i> @lang('app.notify.status')</a>
                                    <div class="dropdown-menu" aria-labelledby="bystatus" id="filter-status-notify">
                                        <a class="dropdown-item active" href="javascript:void(0)" data-status="-1">@lang('app.notify.all')</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)" data-status="0">@lang('app.notify.unread')</a>
                                        <a class="dropdown-item" href="javascript:void(0)" data-status="1">@lang('app.notify.read')</a>
                                    </div>
                                </li>
                                <!-- end of by status dropdown -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="bypriority"
                                       data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false"><i
                                            class="icofont icofont-sub-listing"></i> @lang('app.notify.type')</a>
                                    <div class="dropdown-menu" aria-labelledby="bypriority" id="filter-type-notify">
                                        <a class="dropdown-item active" href="javascript:void(0)" data-type="-1">@lang('app.notify.all')</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)">@lang('app.notify.account')</a>
                                        <a class="dropdown-item" href="javascript:void(0)">@lang('app.notify.order')</a>
                                        <a class="dropdown-item" href="javascript:void(0)">@lang('app.notify.food')</a>
                                        <a class="dropdown-item" href="javascript:void(0)">@lang('app.notify.booking')</a>
                                    </div>
                                </li>
                            </ul>
                            <div class="nav-item d-none">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="search-notify"
                                           placeholder="@lang('app.notify.search')">
                                    <span class="input-group-addon"><i
                                            class="icofont icofont-search"></i></span>
                                </div>
                            </div>
                            <!-- end of by priority dropdown -->
                        </nav>
                        <div class="card">
                            <div class="card-block" id="list-item-notify">
                                Data
                            </div>
                        </div>
                        <nav aria-label="...">
                            <div class="simple-pagination"></div>
                        </nav>
                    </div>
                </div>
{{--                <div class="row justify-content-between align-items-center ">--}}
{{--                    <h2 class="pb-3" style="border-bottom: 5px solid #f9a236;">Notifications <i class="mr-2 fa fa-bell"></i></h2>--}}
{{--                    <div class="col-lg-8 text-right row justify-content-end">--}}
{{--                        <div class="form-validate-select col-lg-3">--}}
{{--                            <div class="pr-0 select-material-box">--}}
{{--                                <select class="form-control js-example-basic-single select2-hidden-accessible">--}}
{{--                                    <option value="">Liên quan</option>--}}
{{--                                    <option value="">Tài khoản</option>--}}
{{--                                    <option value="">Đơn hàng</option>--}}
{{--                                    <option value="">Món ăn</option>--}}
{{--                                    <option value="">Booking</option>--}}
{{--                                </select>--}}
{{--                                <div class="line"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-validate-select col-lg-3">--}}
{{--                            <div class="pr-0 select-material-box">--}}
{{--                                <select class="form-control js-example-basic-single select2-hidden-accessible">--}}
{{--                                    <option value="">Trạng thái</option>--}}
{{--                                    <option value="">Chưa đọc</option>--}}
{{--                                    <option value="">Đã đọc</option>--}}
{{--                                </select>--}}
{{--                                <div class="line"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-validate-select col-lg-3">--}}
{{--                            <div class="pr-0 select-material-box">--}}
{{--                                <select class="form-control js-example-basic-single select2-hidden-accessible">--}}
{{--                                    <option value="">Thời gian</option>--}}
{{--                                    <option value="">Hôm nay</option>--}}
{{--                                    <option value="">Hôm qua</option>--}}
{{--                                    <option value="">Tuần nay</option>--}}
{{--                                    <option value="">Tháng nay</option>--}}
{{--                                </select>--}}
{{--                                <div class="line"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row rounded pb-2 pt-1 mt-2 align-items-center notification-item-page" style="height:80px;background: #fff">--}}
{{--                    <div class="col-md-1 d-flex justify-content-center">--}}
{{--                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxnj4SxLZVRypqE02NAOIPKNIFvY_A4RLbbUXx-gV5uGE81DPOcWSUPftZ8oBxeG-Mmv8&usqp=CAU"--}}
{{--                             alt="user-noti" style="width: 50px;--}}
{{--                        border-radius: 50%">--}}
{{--                    </div>--}}
{{--                    <div class="col-md-9">--}}
{{--                       <span class="f-w-600" style="font-size: 16px !important;">Van Truong</span> vừa thao tác chỉnh sửa--}}
{{--                        <p style="font-size: 14px !important;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, magni?</p>--}}
{{--                        <div>--}}
{{--                            9:45 AM--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="mark-readed-notification cursor-pointer">--}}
{{--                        <i class="fa fa-times"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row rounded pb-2 pt-1 mt-2 align-items-center notification-item-page" style="height:80px;background: #fff">--}}
{{--                    <div class="col-md-1 d-flex justify-content-center">--}}
{{--                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxnj4SxLZVRypqE02NAOIPKNIFvY_A4RLbbUXx-gV5uGE81DPOcWSUPftZ8oBxeG-Mmv8&usqp=CAU"--}}
{{--                             alt="user-noti" style="width: 50px;--}}
{{--                        border-radius: 50%">--}}
{{--                    </div>--}}
{{--                    <div class="col-md-9">--}}
{{--                        <span class="f-w-600" style="font-size: 16px !important;">Van Truong</span> vừa thao tác chỉnh sửa--}}
{{--                        <p style="font-size: 14px !important;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, magni?</p>--}}
{{--                        <div>--}}
{{--                            9:45 AM--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="mark-readed-notification cursor-pointer">--}}
{{--                        <i class="fa fa-times"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row rounded pb-2 pt-1 mt-2 align-items-center notification-item-page" style="height:80px;background: #fff">--}}
{{--                    <div class="col-md-1 d-flex justify-content-center">--}}
{{--                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxnj4SxLZVRypqE02NAOIPKNIFvY_A4RLbbUXx-gV5uGE81DPOcWSUPftZ8oBxeG-Mmv8&usqp=CAU"--}}
{{--                             alt="user-noti" style="width: 50px;--}}
{{--                        border-radius: 50%">--}}
{{--                    </div>--}}
{{--                    <div class="col-md-9">--}}
{{--                        <span class="f-w-600" style="font-size: 16px !important;">Van Truong</span> vừa thao tác chỉnh sửa--}}
{{--                        <p style="font-size: 14px !important;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, magni?</p>--}}
{{--                        <div>--}}
{{--                            9:45 AM--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="mark-readed-notification cursor-pointer">--}}
{{--                        <i class="fa fa-times"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row rounded pb-2 pt-1 mt-2 align-items-center notification-item-page" style="height:80px;background: #fff">--}}
{{--                    <div class="col-md-1 d-flex justify-content-center">--}}
{{--                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxnj4SxLZVRypqE02NAOIPKNIFvY_A4RLbbUXx-gV5uGE81DPOcWSUPftZ8oBxeG-Mmv8&usqp=CAU"--}}
{{--                             alt="user-noti" style="width: 50px;--}}
{{--                        border-radius: 50%">--}}
{{--                    </div>--}}
{{--                    <div class="col-md-9">--}}
{{--                        <span class="f-w-600" style="font-size: 16px !important;">Van Truong</span> vừa thao tác chỉnh sửa--}}
{{--                        <p style="font-size: 14px !important;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, magni?</p>--}}
{{--                        <div>--}}
{{--                            9:45 AM--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="mark-readed-notification cursor-pointer">--}}
{{--                        <i class="fa fa-times"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @include('layouts.oldDatatable')
    <script type="text/javascript"
            src="{{ asset('js/notification/index.js?version=1', env('IS_DEPLOY_ON_SERVER')}}"></script>
@endpush
