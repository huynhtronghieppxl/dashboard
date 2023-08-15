@extends('layouts.layout')
@section('content')
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row">
                    <div class="col-xl-12 filter-bar m-t-5px">
                        <nav class="navbar navbar-light bg-faded m-b-30 p-10">
                            <div class="card-block p-t-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search here...">
                                    <span class="input-group-addon" id="basic-addon1"><i
                                            class="icofont icofont-search"></i></span>
                                </div>
                            </div>
                            <div class="nav-item nav-grid">
                                <span class="m-r-15">View Mode: </span>
                                <button type="button" class="btn btn-sm btn-primary waves-effect waves-light m-r-10"
                                        data-toggle="tooltip" data-placement="top" title=""
                                        data-original-title="list view">
                                    <i class="icofont icofont-listine-dots"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-primary waves-effect waves-light"
                                        data-toggle="tooltip" data-placement="top" title=""
                                        data-original-title="grid view">
                                    <i class="icofont icofont-table"></i>
                                </button>
                            </div>
                        </nav>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card card-border-default">
                                    <div class="card-header">
                                        <h5 class="card-title sub-title-2 font-weight-bold w-100">AhaMove </h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <img class="card-img-top"
                                                     src="{{asset('..\images\logo\BrandingLogomoi-01-1.png')}}"
                                                     alt="Card image cap">
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="task-detail">A collection of textile samples lay spread out on
                                                    the table One morning, when Gregor Samsa woke from troubled.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="task-board">
                                            <button class="btn btn-primary waves-effect waves-light"
                                                    type="button" onclick="openModalConnectAhamove()">Kết nối
                                            </button>
                                            <button class="btn btn-grd-disabled waves-light b-none txt-muted"
                                                    type="button">Chi tiết
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card card-border-success">
                                    <div class="card-header">
                                        <h5 class="card-title sub-title-2 font-weight-bold w-100">Grab Express </h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <img class="card-img-top"
                                                     src="{{asset('..\images\logo\Grab-Express.png')}}"
                                                     alt="Card image cap">
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="task-detail">A collection of textile samples lay spread out on
                                                    the table One morning, when Gregor Samsa woke from troubled.</p>
                                                <p class="task-due"><strong> Lưu ý : </strong><strong
                                                        class="label label-danger">Grab Express không cung cấp bảng giá
                                                        dịch vụ trước</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="task-board">
                                            {{--                                            <button class="btn btn-success waves-effect waves-light"--}}
                                            {{--                                                    type="button">Đã kết nối--}}
                                            {{--                                            </button>--}}
                                            <div class="dropdown-secondary dropdown">
                                                <button
                                                    class="btn btn-success dropdown-toggle waves-effect waves-light"
                                                    type="button" id="dropdown1" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">Đã kết nối
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown1"
                                                     data-dropdown-in="fadeIn" data-dropdown-out="fadeOut"
                                                     x-placement="bottom-start"
                                                     style="position: absolute; transform: translate3d(0, 24px, 0); top: 0; left: 0; will-change: transform;">
                                                    <div class="dropdown-item waves-light waves-effect"><i
                                                            class="icofont icofont-close-line"></i> Hủy kết nối
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-grd-disabled waves-light b-none txt-muted"
                                                    type="button">Chi tiết
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card card-border-success">
                                    <div class="card-header">
                                        <h5 class="card-title sub-title-2 font-weight-bold w-100">GHN Express </h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <img class="card-img-top"
                                                     src="{{asset('..\images\logo\ghn_express_color_577e0a6fea0b478eac8e6301f72a5acc_grande.png')}}"
                                                     alt="Card image cap">
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="task-detail">A collection of textile samples lay spread out on
                                                    the table One morning, when Gregor Samsa woke from troubled.</p>
                                                <p class="task-due"><strong> Lưu ý : </strong><strong
                                                        class="label label-danger">GHN Express không cung cấp bảng giá
                                                        dịch vụ trước</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="task-board">
                                            <div class="dropdown-secondary dropdown">
                                                <button
                                                    class="btn btn-success dropdown-toggle waves-effect waves-light"
                                                    type="button" id="dropdown1" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">Đã kết nối
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown1"
                                                     data-dropdown-in="fadeIn" data-dropdown-out="fadeOut"
                                                     x-placement="bottom-start"
                                                     style="position: absolute; transform: translate3d(0, 24px, 0); top: 0; left: 0; will-change: transform;">
                                                    <div class="dropdown-item waves-light waves-effect"><i
                                                            class="icofont icofont-close-line"></i> Hủy kết nối
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-grd-disabled waves-light b-none txt-muted"
                                                    type="button">Chi tiết
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card card-border-success">
                                    <div class="card-header">
                                        <h5 class="card-title sub-title-2 font-weight-bold w-100">J&T Express </h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <img class="card-img-top"
                                                     src="{{asset('..\images\logo\origin_2020-08-15-159745523036946logo J&T.png')}}"
                                                     alt="Card image cap">
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="task-detail">A collection of textile samples lay spread out on
                                                    the table One morning, when Gregor Samsa woke from troubled.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="task-board">
                                            <div class="dropdown-secondary dropdown">
                                                <button
                                                    class="btn btn-success dropdown-toggle waves-effect waves-light"
                                                    type="button" id="dropdown1" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">Đã kết nối
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown1"
                                                     data-dropdown-in="fadeIn" data-dropdown-out="fadeOut"
                                                     x-placement="bottom-start"
                                                     style="position: absolute; transform: translate3d(0, 24px, 0); top: 0; left: 0; will-change: transform;">
                                                    <div class="dropdown-item waves-light waves-effect"><i
                                                            class="icofont icofont-close-line"></i> Hủy kết nối
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-grd-disabled waves-light b-none txt-muted"
                                                    type="button">Chi tiết
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card card-border-success">
                                    <div class="card-header">
                                        <h5 class="card-title sub-title-2 font-weight-bold w-100">Viettel Post </h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <img class="card-img-top"
                                                     src="{{asset('..\images\logo\logo-viettel-1.png')}}"
                                                     alt="Card image cap">
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="task-detail">A collection of textile samples lay spread out on
                                                    the table One morning, when Gregor Samsa woke from troubled.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="task-board">
                                            <div class="dropdown-secondary dropdown">
                                                <button
                                                    class="btn btn-success dropdown-toggle waves-effect waves-light"
                                                    type="button" id="dropdown1" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">Đã kết nối
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown1"
                                                     data-dropdown-in="fadeIn" data-dropdown-out="fadeOut"
                                                     x-placement="bottom-start"
                                                     style="position: absolute; transform: translate3d(0, 24px, 0); top: 0; left: 0; will-change: transform;">
                                                    <div class="dropdown-item waves-light waves-effect"><i
                                                            class="icofont icofont-close-line"></i> Hủy kết nối
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-grd-disabled waves-light b-none txt-muted"
                                                    type="button">Chi tiết
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card card-border-success">
                                    <div class="card-header">
                                        <h5 class="card-title sub-title-2 font-weight-bold w-100">DHL Express </h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <img class="card-img-top"
                                                     src="{{asset('..\images\logo\dhl-logo-512x512.png')}}"
                                                     alt="Card image cap">
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="task-detail">A collection of textile samples lay spread out on
                                                    the table One morning, when Gregor Samsa woke from troubled.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="task-board">
                                            <div class="dropdown-secondary dropdown">
                                                <button
                                                    class="btn btn-success dropdown-toggle waves-effect waves-light"
                                                    type="button" id="dropdown1" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">Đã kết nối
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown1"
                                                     data-dropdown-in="fadeIn" data-dropdown-out="fadeOut"
                                                     x-placement="bottom-start"
                                                     style="position: absolute; transform: translate3d(0, 24px, 0); top: 0; left: 0; will-change: transform;">
                                                    <div class="dropdown-item waves-light waves-effect"><i
                                                            class="icofont icofont-close-line"></i> Hủy kết nối
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-grd-disabled waves-light b-none txt-muted"
                                                    type="button">Chi tiết
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('transport.partner.ahamove')
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\js\transport\partner\register.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
