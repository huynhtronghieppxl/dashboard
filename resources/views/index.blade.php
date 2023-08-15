@extends('layouts.layout')
@section('content')
    <head>
        <style>
            /*.star {*/
            /*    margin-bottom: 12px;*/
            /*}*/

            /*.name-lever {*/
            /*    margin-left: 5px;*/
            /*}*/
        </style>
    </head>
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row m-0">
                    <div class="card col-lg-8 edit-flex-auto-fill" style="height: calc(100vh - 100px);">
                        <div>
                            <div class=" card-block">
                                <div class="user-profile-introduce">
                                    <figure>
                                        <img onerror="this.onerror=null; this.src='/images/tms/default_background.jpeg'"
                                             id="background-restaurant-dashboard-introduce"
                                             src="/images/tms/default_background.jpeg"
                                             alt="" style="height: 250px; object-fit: cover;">
                                        <div class="pit-rate">
                                            <ol id="rate-restaurant-dashboard-introduce">
                                                <li class="star"><i class="fa fa-star"></i></li>
                                                <li class="star"><i class="fa fa-star"></i></li>
                                                <li class="star"><i class="fa fa-star"></i></li>
                                                <li class="star"><i class="fa fa-star"></i></li>
                                                <li class="star"><i class="fa fa-star"></i></li>
                                            </ol>
                                            <span class="name-lever" style="font-size: 24px !important;">0/5</span>
                                        </div>

                                    </figure>
                                    <div class="profile-section px-0">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="profile-author">
                                                    <div class="profile-author-thumb">
                                                        <img
                                                                onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"
                                                                id="avatar-restaurant-dashboard-introduce" alt="author"
                                                                onclick="modalImageIndex()"
                                                                src="/images/tms/default.jpeg">
                                                    </div>
                                                    <div class="author-content">
                                                        <a id="name-restaurant-dashboard-introduce"
                                                           class="h4 author-name"
                                                           href="javascript:void(0)">TECHRES</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 mt-3" style="text-align: right"
                                                 id="loading-flow-detail1">
                                                <ol class="folw-detail">
                                                    <li>
                                                        <div>
                                                            <span>@lang('app.overview.member')</span>
                                                            <ins id="customer-restaurant-dashboard-introduce"></ins>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div>
                                                            <span>@lang('app.overview.rating')</span>
                                                            <ins id="count-rate-restaurant-dashboard-introduce"></ins>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div>
                                                            <span>@lang('app.overview.accumulate-points')</span>
                                                            <ins id="accumulate-point-restaurant-dashboard-introduce">
                                                            </ins>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div><span>@lang('app.overview.use-point')</span>
                                                            <ins id="use-point-restaurant-dashboard-introduce"></ins>
                                                        </div>
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-block">
                                <div id="chart-restaurant-membership-card-dashboard-introduce"
                                     style="height: 400px"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill">
                        <div class="card card-review-restaurant flex-sub">
                            <aside class="sidebar static right">
                                <div class="widget">
                                    <h4 class="widget-title p-2 pt-3"
                                        style="font-size: 16px!important; border-bottom: 1px solid #f3e7e7; padding-bottom: 20px!important">@lang('app.overview.customer-feed-back')</h4>
                                    @if(isset(Session::get(SESSION_KEY_DATA_ALOLINE_CUSTOMER)['id']))
                                        <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue d-none"
                                             id="disable-login-aloline-dashboard-introduce"
                                             style="position: absolute;right: 10px;top: 20px; display: flex;width: max-content;"
                                             onclick="openModalLoginDashboardIntroduce()">
                                            <span style="padding-right: 12px">@lang('app.overview.login')<img
                                                        style="width: 55%;height: 15px;margin-left: 4px;margin-bottom: 5px;"
                                                        src="{{asset('images\logo\aloline.png')}}" alt=""/></span>
                                        </div>

                                        <i class="ion-gear-b mr-2" style="font-size: 15px;"></i>
                                        <div class="dropdown-primary dropdown"
                                             id="enable-login-aloline-dashboard-introduce"
                                             style="position: absolute; right: 20px; top: 20px">
                                            <div class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <img style="width: 38px; height: 38px; object-fit: cover"
                                                     data-toggle="tooltip" data-placement="bottom"
                                                     data-original-title=""
                                                     src="{{Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . Session::get(SESSION_KEY_DATA_ALOLINE_CUSTOMER)['avatar']}}"
                                                     class="img-radius mr-2" alt="Avatar" id="current-avatar">
                                                {{--                                                <i class="feather icon-chevron-down cursor-pointer"--}}
                                                {{--                                                   style="font-size: 16px;"></i>--}}
                                            </div>
                                            <ul class="show-notification profile-notification dropdown-menu cursor-pointer"
                                                data-dropdown-in="fadeIn" data-dropdown-out="fadeOut"
                                                style="width: max-content; min-width: 10px">
                                                <li id="logout" onclick="location.href='logout';"
                                                    style="padding: 0 5px; display: flex; align-items: center">
                                                    <i class="feather icon-log-out"></i>@lang('app.overview.logout')
                                                </li>
                                            </ul>
                                        </div>
                                        <ul class="px-0 media-list"
                                            style="padding: 5px; margin-bottom: 10px; max-height: 72vh"
                                            id="list-feedback-dashboard-introduce">
                                            <li class="media"
                                                style="padding-bottom: 10px; margin-top: 5px; border-bottom: 2px solid #f2f2f2">
                                                <div class="media-left">
                                                    <a href="javascript:void(0)">
                                                        <img class="media-object img-radius comment-img"
                                                             src="..\files\assets\images\avatar-1.jpg"
                                                             alt="Generic placeholder image">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="media-heading">Sortino media<span
                                                                class="f-12 text-muted m-l-5">Just now</span></h6>
                                                    <div class="stars-example-css review-star d-flex mb-1">
                                                        <i class="icofont icofont-star"></i>
                                                        <i class="icofont icofont-star"></i>
                                                        <i class="icofont icofont-star"></i>
                                                        <i class="icofont icofont-star"></i>
                                                        <i class="icofont icofont-star"></i>
                                                    </div>
                                                    <p class="m-b-0">
                                                        Cras sit amet nibh libero, in gravida nulla. Nulla
                                                        vel
                                                        metus scelerisque ante sollicitudin commodo. Cras purus odio,
                                                        vestibulum in vulputate at, tempus viverra turpis.</p>
                                                    <div>
                                                        <span><a href="javascript:void(0)"
                                                                 class="m-r-10 f-12 edit-text-introduce">@lang('app.overview.comment')</a></span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <nav aria-label="..." class="pagination-review-dashboard-introduce">
                                            <div class="simple-pagination"></div>
                                        </nav>
                                    @else
                                        <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                                             id="disable-login-aloline-dashboard-introduce"
                                             style="position: absolute;right: 10px;top: 15px;"
                                             onclick="openModalLoginDashboardIntroduce()">
                                            <span>@lang('app.overview.login')</span>
                                        </div>
                                        <div class="dropdown-primary dropdown d-none"
                                             id="enable-login-aloline-dashboard-introduce"
                                             style="position: absolute; right: 9px; top: 14px; display: flex">
                                            <i class="ion-gear-b mr-2 open-custom-search-review-restaurant-dashboard-introduce"
                                               style="font-size: 16px; cursor: pointer"></i>
                                            <div class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"
                                                 style="display: inline-block">
                                                <img style="width: 38px; height: 38px; object-fit: cover"
                                                     data-toggle="tooltip" data-placement="bottom"
                                                     data-original-title="{{Session::get(SESSION_KEY_DATA_RESTAURANT)['customer_partner']['name']}}"
                                                     onerror="this.src='/images/tms/default.jpeg'"
                                                     src="{{Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . Session::get(SESSION_KEY_DATA_RESTAURANT)['customer_partner']['avatar']}}"
                                                     class="img-radius mr-2" alt="Avatar" id="current-avatar">
                                                {{--                                                <i class="feather icon-chevron-down cursor-pointer"--}}
                                                {{--                                                   style="font-size: 16px;"></i>--}}
                                            </div>
                                            <ul class="show-notification profile-notification dropdown-menu cursor-pointer"
                                                data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                <li id="logout" onclick="logoutAlolineRestaurantDashboardIntroduce()"
                                                    style="padding: 0 5px">
                                                    <i class="feather icon-log-out"></i>@lang('app.overview.logout')
                                                </li>
                                            </ul>
                                        </div>
                                        <ul class="px-0 media-list"
                                            style="padding: 5px; margin-bottom: 10px; max-height: 72vh; overflow-y: auto"
                                            id="list-feedback-dashboard-introduce">
                                        </ul>
                                        <nav aria-label="..." class="pagination-review-dashboard-introduce">
                                            <div class="simple-pagination"></div>
                                        </nav>
                                    @endif
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-login-dashboard-introduce" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('app.overview.aloline-account')</h4>
                    <div>
                        <button type="button" class="close ml-2" onclick="closeModalLoginDashboardIntroduce()"
                                onkeypress="closeModalLoginDashboardIntroduce()">
                            <i class="fi-rr-cross"></i>
                        </button>
                        <div class="search-layout-body float-right">
                            <input class="search-text-layout-body" type="text"
                                   placeholder="@lang('app.overview.search-note')"
                                   id="search-customer-dashboard-introduce" style="width: 300px">
                            <a href="javascript:void(0)" style="padding-right: 10px"
                               id="btn-search-customer-dashboard-introduce"><i class="fi-rr-search"></i></a>
                        </div>

                    </div>
                </div>
                <div class="modal-body background-body-color text-left" id="loading-modal-detail-bill-manage"
                     style="overflow: hidden !important;">
                    <div class="card card-block mt-0">
                        <div class="row" id="data-customer-dashboard-introduce"
                             style="max-height: 68vh; overflow: auto;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn seemt-orange seemt-bg-orange seemt-btn-hover-orange"
                         onclick="saveModalCreateHolidayEmployeeBonusPunish()"
                         onkeypress="saveModalCreateHolidayEmployeeBonusPunish()">
                        <i class="fi-rr-user-add"></i>
                        <a target="_blank" href="https://aloline.vn/auth/register" class="seemt-btn-hover-orange">
                            @lang('app.overview.register')
                            Aloline
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-custom-search-dashboard-introduce" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('app.overview.review-filter')</h4>
                </div>
                <div class="modal-body text-left">
                    <div class="card card-block m-0">
                        <div class="form-group row" id="search-rate-review-restaurant">
                            <label class="col-sm-4 col-form-label">@lang('app.overview.rating')</label>
                            <div class="col-sm-8">
                                <form>
                                    <div class="form-validate-checkbox">
                                        <div class="checkbox-form-group">
                                            <input type="radio" name="radio" checked value="-1"
                                                   class="value-default">
                                            <label class="name-checkbox">
                                                Tất cả
                                            </label>
                                        </div>
                                    </div>
                                    {{--                                        <div class="radio radio-inline">--}}
                                    {{--                                            <label>--}}
                                    {{--                                                <input type="radio" name="radio" value="0">--}}
                                    {{--                                                <i class="helper"></i>@lang('app.overview.under-1star')--}}
                                    {{--                                            </label>--}}
                                    {{--                                        </div>--}}
                                    <div class="form-validate-checkbox">
                                        <div class="checkbox-form-group">
                                            <input type="radio" name="radio" value="0">
                                            <label class="name-checkbox">
                                                @lang('app.overview.under-1star')
                                            </label>
                                        </div>
                                    </div>
                                    {{--                                        <div class="radio radio-inline">--}}
                                    {{--                                            <label>--}}
                                    {{--                                                <input type="radio" name="radio" value="1">--}}
                                    {{--                                                <i class="helper"></i>@lang('app.overview.1star-2star')--}}
                                    {{--                                            </label>--}}
                                    {{--                                        </div>--}}
                                    <div class="form-validate-checkbox">
                                        <div class="checkbox-form-group">
                                            <input type="radio" name="radio" value="1">
                                            <label class="name-checkbox">
                                                @lang('app.overview.1star-2star')
                                            </label>
                                        </div>
                                    </div>
                                    {{--                                        <div class="radio radio-inline">--}}
                                    {{--                                            <label>--}}
                                    {{--                                                <input type="radio" name="radio" value="2">--}}
                                    {{--                                                <i class="helper"></i>@lang('app.overview.2star-3star')--}}
                                    {{--                                            </label>--}}
                                    {{--                                        </div>--}}
                                    <div class="form-validate-checkbox">
                                        <div class="checkbox-form-group">
                                            <input type="radio" name="radio" value="2">
                                            <label class="name-checkbox">
                                                @lang('app.overview.2star-3star')
                                            </label>
                                        </div>
                                    </div>
                                    {{--                                        <div class="radio radio-inline">--}}
                                    {{--                                            <label>--}}
                                    {{--                                                <input type="radio" name="radio" value="3">--}}
                                    {{--                                                <i class="helper"></i>@lang('app.overview.3star-4star')--}}
                                    {{--                                            </label>--}}
                                    {{--                                        </div>--}}
                                    <div class="form-validate-checkbox">
                                        <div class="checkbox-form-group">
                                            <input type="radio" name="radio" value="3">
                                            <label class="name-checkbox">
                                                @lang('app.overview.3star-4star')
                                            </label>
                                        </div>
                                    </div>
                                    {{--                                        <div class="radio radio-inline">--}}
                                    {{--                                            <label>--}}
                                    {{--                                                <input type="radio" name="radio" value="4">--}}
                                    {{--                                                <i class="helper"></i>@lang('app.overview.5star-6star')--}}
                                    {{--                                            </label>--}}
                                    {{--                                        </div>--}}
                                    <div class="form-validate-checkbox">
                                        <div class="checkbox-form-group">
                                            <input type="radio" name="radio" value="4">
                                            <label class="name-checkbox">
                                                @lang('app.overview.4star-5star')
                                            </label>
                                        </div>
                                    </div>
                                    {{--                                        <div class="radio radio-inline">--}}
                                    {{--                                            <label>--}}
                                    {{--                                                <input type="radio" name="radio" value="5">--}}
                                    {{--                                                <i class="helper"></i>@lang('app.overview.5star')--}}
                                    {{--                                            </label>--}}
                                    {{--                                        </div>--}}
                                    <div class="form-validate-checkbox">
                                        <div class="checkbox-form-group">
                                            <input type="radio" name="radio" value="5">
                                            <label class="name-checkbox">
                                                @lang('app.overview.5star')
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">@lang('app.overview.feed-back')</label>
                            <div class="col-sm-8">
                                <div id="search-reply-review-restaurant">
                                    <form>
                                        {{--                                                <input type="radio" name="radio" checked="checked" value="-1"--}}
                                        {{--                                                       class="value-default">--}}
                                        {{--                                                <i class="helper"></i>@lang('app.overview.all')--}}
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" name="radio" checked="checked" value="-1">
                                                <label class="name-checkbox">
                                                    @lang('app.overview.all')
                                                </label>
                                            </div>
                                        </div>

                                        {{--                                                <input type="radio" name="radio" value="1">--}}
                                        {{--                                                <i class="helper"></i>@lang('app.overview.responded')--}}
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" name="radio" value="1">
                                                <label class="name-checkbox">
                                                    @lang('app.overview.responded')
                                                </label>
                                            </div>
                                        </div>

                                        {{--                                                <input type="radio" name="radio" value="0">--}}
                                        {{--                                                <i class="helper"></i>@lang('app.overview.not-response-yet')--}}
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" name="radio" value="0">
                                                <label class="name-checkbox">
                                                    @lang('app.overview.not-response-yet')
                                                </label>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class=" col-form-label col-sm-4">@lang('app.overview.day-search')</label>
                            {{--                            <div class="col-sm-8">--}}
                            <div class="checkbox-zoom zoom-primary">
                                {{--                                    <label>--}}
                                {{--                                        <input type="checkbox" id="check-time-search-review">--}}
                                {{--                                        <span class="cr"><i--}}
                                {{--                                                class="cr-icon icofont icofont-ui-check txt-primary"></i></span>--}}
                                {{--                                    </label>--}}
                                <div class="form-validate-checkbox">
                                    <div class="checkbox-form-group">
                                        <input type="checkbox" id="check-time-search-review">
                                    </div>
                                </div>
                            </div>
                            {{--                            </div>--}}

                        </div>
                        <div class="d-none time-search-review">
                            <label class="input-group m-auto">
                                <input type="text" id="from-date-search-review-restaurant"
                                       data-validate="search"
                                       class="input-sm form-control text-center input-datetimepicker p-1"
                                       name="start" value="{{date('d/m/Y')}}">
                                <span class="input-group-addon">@lang('app.component.button.to')</span>
                                <input type="text" id="to-date-search-review-restaurant" data-validate="search"
                                       class="input-sm form-control text-center input-datetimepicker"
                                       name="end" value="{{date('d/m/Y')}}">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-end" style="justify-content: center">
                    <div class="btn seemt-red seemt-bg-red seemt-btn-hover-red" id="close-search-modal">
                        {{--                        <i class="fi-rr-disk"></i>--}}
                        <span>Đóng</span>
                    </div>
                    <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" id="search-review">
                        {{--                        <i class="fi-rr-disk"></i>--}}
                        <span>Lọc</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        // chỉ định element thực hiện sự kiện
        $('#search-review').click();
        $('#search-review').focus();
        $('#search-review').select();
        // lắng nghe khi đối tượng được thực hiện sự kiện thì làm tác vụ
        $('#disable-login-aloline-dashboard-introduce').on('input', function () {
            $('.disable-login-aloline-dashboard-introduce').val();
            $(this).val();
        })
    </script>
    <!-- c3 chart js -->
    <script src="{{asset('files\bower_components\c3\js\c3.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <!-- Chart js -->
    <script type="text/javascript"
            src="{{asset('files\bower_components\chart.js\js\Chart.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <!-- c3 chart js -->
    <script src="{{asset('files\bower_components\c3\js\c3.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script
            src="{{asset('files\assets\pages\chart\c3\c3-custom-chart.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <!-- Chartlist charts -->
    <script
            src="{{asset('files\bower_components\chartist\js\chartist.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script
            src="{{asset('files\assets\pages\chart\chartlist\js\chartist-plugin-threshold.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <!-- NVD3 chart -->
    <script src="{{asset('files\bower_components\d3\js\d3.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('files\bower_components\nvd3\js\nv.d3.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script
            src="{{asset('files\assets\pages\chart\nv-chart\js\stream_layers.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <!-- gauge js -->
    <script
            src="{{asset('files\assets\pages\widget\gauge\gauge.min.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script
            src="{{asset('files\assets\pages\widget\amchart\amcharts.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('files\assets\pages\widget\amchart\serial.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('files\assets\pages\widget\amchart\gauge.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('files\assets\pages\widget\amchart\pie.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('files\assets\pages\widget\amchart\light.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('js/dashboard/introduce/index.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"
            type="text/javascript"></script>
@endpush
