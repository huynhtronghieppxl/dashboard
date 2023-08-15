<head>
    <link rel="stylesheet" href="{{asset('css/css_custom/validate/form_select.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
    <link rel="stylesheet" href="{{asset('css/css_custom/validate/form_checkbox.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
    <link rel="stylesheet" href="{{asset('css/css_custom/validate/form_input.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
    <link rel="stylesheet" href="{{asset('css/css_custom/validate/form_lable.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
    <link rel="stylesheet" href="{{asset('css/css_custom/validate/form_radio.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
    <link rel="stylesheet" href="{{asset('css/css_custom/validate/form_textarea.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
    <link rel="stylesheet" href="{{asset('css/cssV2/element.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
</head>
<style>
    #styleSelector {
        position: fixed;
        right: -640px;
        width: 640px;
        background-color: #fff;
        z-index: 9999;
        transition: right 0.3s ease-in-out;
        /*margin-top: -10px;*/
    }

    #styleSelector.show {
        right: 0;
        transition: right 0.3s ease-in-out;
    }
</style>
<div id="styleSelector" class="open seemt-main-content">
    <div class="slimScrollDiv">
        <div class="card latest-update-card" style="margin-top: 0; padding-top: 10px">
            <div class="page-wrapper page-body card-block">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group col-lg-12 select2_theme validate-group pl-0">
                            <div class="form-validate-select">
                                <div class="col-lg-12 select-material-box pt-2">
                                    <select id="select-history-layout" tabindex=""
                                            class="js-example-basic-single select2-hidden-accessible">
                                        <option value="">@lang('app.history-support.all')</option>
                                        <option value="0">@lang('app.history-support.order')</option>
                                        <option value="1">@lang('app.history-support.account')</option>
                                        <option value="2">@lang('app.history-support.booking')</option>
                                        <option value="3">@lang('app.history-support.employee')</option>
                                        <option value="4">@lang('app.history-support.decentralization')</option>
                                        <option value="5">@lang('app.history-support.kitchen')</option>
                                        <option value="6">@lang('app.history-support.branch')</option>
                                        <option value="7">@lang('app.history-support.food')</option>
                                        <option value="8">@lang('app.history-support.inventory')</option>
                                    </select>
                                    <label class="icon-validate">
                                        @lang('app.history-support.reason')
                                    </label>
                                </div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group col-lg-12 select2_theme validate-group">
                            <div class="form-validate-select">
                                <div class="col-lg-12 select-material-box pt-2">
                                    <select id="select-branch-history-layout"
                                            class="js-example-basic-single select2-hidden-accessible">
                                        <option value="-1">@lang('app.component.option_default')</option>
                                        @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all() as $db)
                                            @if(Session::get(SESSION_KEY_BRANCH_ID) === $db['id'])
                                                <option value="{{$db['id']}}" selected>{{$db['name']}}</option>
                                            @else
                                                <option value="{{$db['id']}}">{{$db['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label class="icon-validate">
                                        @lang('app.history-support.branch')
                                    </label>
                                </div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px">
                    <div class="col-8">
                        <div class="time-filer-dataTale">
                            <div class="filter-date d-flex align-items-center">
                            <div class="filter-form-date seemt-bg-gray-w200">
                                <i class="fi-rr-calendar seemt-gray-w600 pr-2"></i>
                                <input class="seemt-gray-w600 seemt-bg-gray-w200 seemt-border-none" type="text"
                                       id="from-date-history-layout" value="{{ date('1/m/Y') }}">
                            </div>
                            <div class="icon-form-to seemt-bg-gray-w200">
                                <i class="fi-rr-angle-double-small-right seemt-gray-w600 seemt-border-none"></i>
                            </div>
                            <div class="filter-to-date seemt-bg-gray-w200">
                                <i class="fi-rr-calendar seemt-gray-w600 pr-2"></i>
                                <input class="seemt-gray-w600 seemt-bg-gray-w200 seemt-border-none" type="text"
                                       id="to-date-history-layout">
                            </div>
                            <div id="search-time-history-log" class="icon-filter-component seemt-bg-blue">
                                <i class="fi-rr-filter seemt-gray-w600  seemt-blue"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="seemt-search seemt-bg-gray-w200 seemt-border-radius-8">
                            <div class="seemt-box-search" style="display: flex; align-items: center;padding: 5px 6px; position: relative">
                                <input class="search-text-layout-body" type="text"
                                       placeholder="@lang('app.history-support.search')"
                                       id="search-history-layout" style="line-height: 20px !important; width: 120px;">
                                <a href="javascript:void(0)" class="search-button-layout-body" style="position: absolute; right: 0"
                                   id="btn-search-history-layout"><i class="fi-rr-search"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(Session::get(SESSION_KEY_PERMISSION_TALLEST) !== '')
                <div class="card-block" style="border-top: 1px solid #c2c2c2">
                    <div class="latest-update-box" id="data-history-log"
                         style="height: calc(100vh - 200px); overflow-y: auto; overflow-x: hidden; padding-top: 10px;flex-direction: column-reverse;display: flex;">
                        {{--History log data--}}
                    </div>
                </div>
            @else
                <div class="card-block">
                    <button type="button"
                            class="btn btn-primary waves-effect float-lg-right"
                            onclick="loginServerNode()">@lang('app.component.button.login')</button>
                </div>
            @endif
        </div>
    </div>
</div>

{{--<div id="styleSelector" class="">--}}
{{--    <div class="selector-toggle"><a href="javascript:void(0)" id="toggle-helper-modal"></a></div>--}}
{{--    <ul class="nav nav-tabs tabs remove-draw-table" role="tablist">--}}
{{--        @if(Session::get(Config::get('constants.cache_session.PERMISSION_TALLEST')) > 1)--}}
{{--            <li class="nav-item"><a class="nav-link active" data-toggle="tab"--}}
{{--                                    href="#history-layout" role="tab">Lịch sử hoạt động</a></li>--}}
{{--            <li class="nav-item"><a class="nav-link" data-toggle="tab"--}}
{{--                                    href="#support-layout" role="tab">Hỗ trợ phím tắt</a></li>--}}
{{--            <li class="nav-item"><a class="nav-link" data-toggle="tab"--}}
{{--                                    href="#setting-layout" role="tab">Cài đặt giao diện</a></li>--}}
{{--            <li class="nav-item"><a class="nav-link" data-toggle="tab"--}}
{{--                                    href="#version-layout" role="tab">Chi tiết phiên bản</a></li>--}}
{{--        @else--}}
{{--            <li class="nav-item"><a class="nav-link active" data-toggle="tab"--}}
{{--                                    href="#support-layout" role="tab">Hỗ trợ phím tắt</a></li>--}}
{{--            <li class="nav-item"><a class="nav-link" data-toggle="tab"--}}
{{--                                    href="#setting-layout" role="tab">Cài đặt giao diện</a></li>--}}
{{--        @endif--}}
{{--    </ul>--}}
{{--    <div class="tab-content tabs">--}}
{{--        @if(Session::get(Config::get('constants.cache_session.PERMISSION_TALLEST')) > 1)--}}
{{--            <div class="tab-pane active" id="history-layout" role="tabpanel">--}}
{{--                <div class="slimScrollDiv">--}}
{{--                    <div style="position: relative; overflow: hidden; width: auto; height: calc(100vh - 280px);">--}}
{{--                        <div class="card latest-update-card">--}}
{{--                            <div class="page-wrapper page-body card-block">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-5 form-group">--}}
{{--                                        <select class="js-example-basic-single" data-validate id="select-history-layout" style="z-index: 99999999">--}}
{{--                                            <option value="-1">Tất cả</option>--}}
{{--                                            <option value="0">Đơn hàng</option>--}}
{{--                                            <option value="1">Tài khoản</option>--}}
{{--                                            <option value="2">Đặt bàn</option>--}}
{{--                                            <option value="3">Nhân viên</option>--}}
{{--                                            <option value="4">Phân quyền</option>--}}
{{--                                            <option value="5">Bếp</option>--}}
{{--                                            <option value="6">Chi nhánh</option>--}}
{{--                                            <option value="7">Món ăn</option>--}}
{{--                                            <option value="8">Kho</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-7 input-group">--}}
{{--                                        <input type="text" id="from-date-history-layout"--}}
{{--                                               class="form-control text-center" style="margin-bottom: 0"--}}
{{--                                               value="{{date('d/m/Y', strtotime('-1 day'))}}">--}}
{{--                                        <span class="input-group-addon">@lang('app.component.button.to')</span>--}}
{{--                                        <input type="text" id="to-date-history-layout" style="margin-bottom: 0"--}}
{{--                                               class="form-control text-center"--}}
{{--                                               value="{{date('d/m/Y')}}">--}}
{{--                                    </div>--}}
{{--                                    <div class="col-5 m-t-15">--}}
{{--                                        <select class="js-example-basic-single" id="select-branch-history-layout"--}}
{{--                                                style="z-index: 99999999">--}}
{{--                                            @foreach(collect(Session::get(Config::get('constants.setting_session.DATA_BRANCH')))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all() as $db)--}}
{{--                                                @if(Session::get(Config::get('constants.setting_session.BRANCH_ID')) === $db['id'])--}}
{{--                                                    <option value="{{$db['id']}}" selected>{{$db['name']}}</option>--}}
{{--                                                @else--}}
{{--                                                    <option value="{{$db['id']}}">{{$db['name']}}</option>--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-7 input-group m-t-10px">--}}
{{--                                        <input type="text" id="search-history-layout"--}}
{{--                                               class="form-control"--}}
{{--                                               style="margin-bottom: 0; padding: 10px; border-radius: 20px 0 0 20px"--}}
{{--                                               placeholder="Nhập từ khóa tìm kiếm">--}}
{{--                                        <button class="input-group-addon cursor-pointer" id="btn-search-history-layout"--}}
{{--                                                style="border-radius: 0 20px 20px 0; padding: 0 15px !important;"><i--}}
{{--                                                class="fa fa-search"></i></button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                --}}{{--<div class="card-header-right">--}}
{{--                                --}}{{--<ul class="list-unstyled card-option">--}}
{{--                                --}}{{--<li><i class="fa fa-refresh reload-card"></i></li>--}}
{{--                                --}}{{--</ul>--}}
{{--                                --}}{{--</div>--}}
{{--                            </div>--}}
{{--                            @if(Session::get(Config::get('constants.cache_session.PERMISSION_TALLEST')) !== '')--}}
{{--                                <div class="card-block">--}}
{{--                                    <div class="latest-update-box" id="data-history-log"--}}
{{--                                         style="height: 550px; display: block; overflow-y: auto; overflow-x: hidden; padding-top: 20px">--}}
{{--                                        --}}{{--History log data--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @else--}}
{{--                                <div class="card-block">--}}
{{--                                    <button type="button"--}}
{{--                                            class="btn btn-primary waves-effect float-lg-right"--}}
{{--                                            onclick="loginServerNode()">@lang('app.component.button.login')</button>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                            --}}{{--<div class="card-block">--}}
{{--                            --}}{{--<div class="d-none" id="data-error-history-log">--}}
{{--                            --}}{{--<img class="center-loading loading-data error-data" style="width: 5rem"--}}
{{--                            --}}{{--src="{{asset('../files/assets/images/errorrData.jpg')}}" alt="Error Data"/>--}}
{{--                            --}}{{--</div>--}}
{{--                            --}}{{--</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane" id="support-layout" role="tabpanel">--}}
{{--                <div class="slimScrollDiv">--}}
{{--                    <div style="position: relative; overflow: hidden; width: auto; height: calc(100vh - 280px);">--}}
{{--                        <ul class="row">--}}
{{--                            <li class="theme-option col-lg-6"><p class="selector-title">Hỗ trợ</p></li>--}}
{{--                            <li class="theme-option col-lg-6 float-right"><p class="selector-title">F1</p></li>--}}
{{--                        </ul>--}}
{{--                        <ul class="row">--}}
{{--                            <li class="theme-option col-lg-6"><p class="selector-title">Chọn nhà cung cấp</p>--}}
{{--                            </li>--}}
{{--                            <li class="theme-option col-lg-6 float-right"><p class="selector-title">F2</p></li>--}}
{{--                        </ul>--}}
{{--                        <ul class="row">--}}
{{--                            <li class="theme-option col-lg-6"><p class="selector-title">Chọn nguyên liệu</p>--}}
{{--                            </li>--}}
{{--                            <li class="theme-option col-lg-6 float-right"><p class="selector-title">F3</p></li>--}}
{{--                        </ul>--}}
{{--                        <ul class="row">--}}
{{--                            <li class="theme-option col-lg-6"><p class="selector-title">Lưu lại</p></li>--}}
{{--                            <li class="theme-option col-lg-6 float-right"><p class="selector-title">F4</p></li>--}}
{{--                        </ul>--}}
{{--                        <ul class="row">--}}
{{--                            <li class="theme-option col-lg-6"><p class="selector-title">Chọn chi nhánh</p></li>--}}
{{--                            <li class="theme-option col-lg-6 float-right"><p class="selector-title">F6</p></li>--}}
{{--                        </ul>--}}
{{--                        <ul class="row">--}}
{{--                            <li class="theme-option col-lg-6"><p class="selector-title">Chuyển tới ô nhập tiếp--}}
{{--                                    theo</p></li>--}}
{{--                            <li class="theme-option col-lg-6 float-right"><p class="selector-title">--}}
{{--                                    Enter/Tab</p></li>--}}
{{--                        </ul>--}}
{{--                        <ul class="row">--}}
{{--                            <li class="theme-option col-lg-6"><p class="selector-title">Quay lại ô nhập--}}
{{--                                    trước</p></li>--}}
{{--                            <li class="theme-option col-lg-6 float-right"><p class="selector-title">Shift +--}}
{{--                                    Tab</p></li>--}}
{{--                        </ul>--}}
{{--                        <ul class="row">--}}
{{--                            <li class="theme-option col-lg-6"><p class="selector-title">Đóng cửa sổ</p></li>--}}
{{--                            <li class="theme-option col-lg-6 float-right"><p class="selector-title">ESC</p></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane" id="setting-layout" role="tabpanel">--}}
{{--                <div class="slimScrollDiv">--}}
{{--                    <div style="position: relative; overflow: hidden; width: auto; height: calc(100vh - 280px);">--}}
{{--                        <ul>--}}
{{--                            <li><p class="selector-title">Bảng điều khiển</p></li>--}}
{{--                            <li>--}}
{{--                                <div class="theme-color">--}}
{{--                                    <a href="#" class="navbar-theme" navbar-theme="theme1">--}}
{{--                                        <span class="head"></span><span class="cont"></span>--}}
{{--                                    </a>--}}
{{--                                    <a href="#" class="navbar-theme" navbar-theme="themelight1">--}}
{{--                                        <span class="head"></span><span class="cont"></span>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li><p class="selector-title">Màu Logo</p></li>--}}
{{--                            <li class="theme-option">--}}
{{--                                <div class="theme-color">--}}
{{--                                    <a href="#" class="logo-theme" logo-theme="theme1"><span--}}
{{--                                            class="head"></span><span--}}
{{--                                            class="cont"></span></a>--}}
{{--                                    <a href="#" class="logo-theme" logo-theme="theme2"><span--}}
{{--                                            class="head"></span><span--}}
{{--                                            class="cont"></span></a>--}}
{{--                                    <a href="#" class="logo-theme" logo-theme="theme3"><span--}}
{{--                                            class="head"></span><span--}}
{{--                                            class="cont"></span></a>--}}
{{--                                    <a href="#" class="logo-theme" logo-theme="theme4"><span--}}
{{--                                            class="head"></span><span--}}
{{--                                            class="cont"></span></a>--}}
{{--                                    <a href="#" class="logo-theme" logo-theme="theme5"><span--}}
{{--                                            class="head"></span><span--}}
{{--                                            class="cont"></span></a>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li><p class="selector-title">Màu Header</p></li>--}}
{{--                            <li class="theme-option">--}}
{{--                                <div class="theme-color">--}}
{{--                                    <a href="#" class="header-theme" header-theme="theme1"><span--}}
{{--                                            class="head"></span><span--}}
{{--                                            class="cont"></span></a>--}}
{{--                                    <a href="#" class="header-theme" header-theme="theme2"><span--}}
{{--                                            class="head"></span><span--}}
{{--                                            class="cont"></span></a>--}}
{{--                                    <a href="#" class="header-theme" header-theme="theme3"><span--}}
{{--                                            class="head"></span><span--}}
{{--                                            class="cont"></span></a>--}}
{{--                                    <a href="#" class="header-theme" header-theme="theme4"><span--}}
{{--                                            class="head"></span><span--}}
{{--                                            class="cont"></span></a>--}}
{{--                                    <a href="#" class="header-theme" header-theme="theme5"><span--}}
{{--                                            class="head"></span><span--}}
{{--                                            class="cont"></span></a>--}}
{{--                                    <a href="#" class="header-theme" header-theme="theme6"><span--}}
{{--                                            class="head"></span><span--}}
{{--                                            class="cont"></span></a>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li><p class="selector-title">Màu Active</p></li>--}}
{{--                            <li class="theme-option">--}}
{{--                                <div class="theme-color">--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme1">&nbsp;</a>--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme2">&nbsp;</a>--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme3">&nbsp;</a>--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme4">&nbsp;</a>--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme5">&nbsp;</a>--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme6">&nbsp;</a>--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme7">&nbsp;</a>--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme8">&nbsp;</a>--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme9">&nbsp;</a>--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme10">&nbsp;</a>--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme11">&nbsp;</a>--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme12">&nbsp;</a>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li><p class="selector-title">Màu tiêu đề</p></li>--}}
{{--                            <li class="theme-option">--}}
{{--                                <div class="theme-color">--}}
{{--                                    <a href="#" class="leftheader-theme small" lheader-theme="theme5">&nbsp;</a>--}}
{{--                                    <a href="#" class="leftheader-theme small" lheader-theme="theme1">&nbsp;</a>--}}
{{--                                    <a href="#" class="leftheader-theme small" lheader-theme="theme2">&nbsp;</a>--}}
{{--                                    <a href="#" class="leftheader-theme small" lheader-theme="theme3">&nbsp;</a>--}}
{{--                                    <a href="#" class="leftheader-theme small" lheader-theme="theme4">&nbsp;</a>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            --}}{{--<li class="theme-option"><p class="selector-title">Màu Icon</p>--}}
{{--                            --}}{{--<div class="form-radio" id="menu-effect">--}}
{{--                            --}}{{--<div class="radio radio-inverse radio-inline"--}}
{{--                            --}}{{--data-toggle="tooltip" title="Mặc định"--}}
{{--                            --}}{{--data-original-title="simple icon">--}}
{{--                            --}}{{--<label><input type="radio" name="radio" value="st6"--}}
{{--                            --}}{{--onclick="handlemenutype(this.value)" checked>--}}
{{--                            --}}{{--<i class="helper"></i>--}}
{{--                            --}}{{--<span class="micon st6"><i class="feather icon-command"></i></span>--}}
{{--                            --}}{{--</label>--}}
{{--                            --}}{{--</div>--}}
{{--                            --}}{{--<div class="radio radio-primary radio-inline"--}}
{{--                            --}}{{--data-toggle="tooltip" title="Có màu"--}}
{{--                            --}}{{--data-original-title="color icon">--}}
{{--                            --}}{{--<label><input type="radio" name="radio" value="st5"--}}
{{--                            --}}{{--onclick="handlemenutype(this.value)">--}}
{{--                            --}}{{--<i class="helper"></i>--}}
{{--                            --}}{{--<span class="micon st5"><i class="feather icon-command"></i></span>--}}
{{--                            --}}{{--</label>--}}
{{--                            --}}{{--</div>--}}
{{--                            --}}{{--</div>--}}
{{--                            --}}{{--</li>--}}
{{--                        </ul>--}}
{{--                        <div class="slimScrollBar"--}}
{{--                             style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 456.57px;"></div>--}}
{{--                        <div class="slimScrollRail"--}}
{{--                             style="width: 7px; height: 100%; position: absolute; top: 0; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane" id="version-layout" role="tabpanel">--}}
{{--                <div class="slimScrollDiv">--}}
{{--                    <div style="position: relative; overflow: hidden; width: auto; height: calc(100vh - 280px);">--}}
{{--                        <ul>--}}
{{--                            <li><p class="selector-title">Phiên--}}
{{--                                    bản: @if(isset($auth_version_dashboard)){{$auth_version_dashboard}}@else--}}
{{--                                        --- @endif</p>--}}
{{--                            </li>--}}
{{--                            <li><p class="selector-title">Nội dung</p></li>--}}
{{--                            <li>@if(isset($auth_content_dashboard)){{$auth_content_dashboard}}@else--}}
{{--                                    --- @endif</li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @else--}}
{{--            <div class="tab-pane active" id="support-layout" role="tabpanel">--}}
{{--                <div class="slimScrollDiv">--}}
{{--                    <div style="position: relative; overflow: hidden; width: auto; height: calc(100vh - 280px);">--}}
{{--                        <ul class="row">--}}
{{--                            <li class="theme-option col-lg-6"><p class="selector-title">Hỗ trợ</p></li>--}}
{{--                            <li class="theme-option col-lg-6 float-right"><p class="selector-title">F1</p></li>--}}
{{--                        </ul>--}}
{{--                        <ul class="row">--}}
{{--                            <li class="theme-option col-lg-6"><p class="selector-title">Chọn nhà cung cấp</p>--}}
{{--                            </li>--}}
{{--                            <li class="theme-option col-lg-6 float-right"><p class="selector-title">F2</p></li>--}}
{{--                        </ul>--}}
{{--                        <ul class="row">--}}
{{--                            <li class="theme-option col-lg-6"><p class="selector-title">Chọn nguyên liệu</p>--}}
{{--                            </li>--}}
{{--                            <li class="theme-option col-lg-6 float-right"><p class="selector-title">F3</p></li>--}}
{{--                        </ul>--}}
{{--                        <ul class="row">--}}
{{--                            <li class="theme-option col-lg-6"><p class="selector-title">Lưu lại</p></li>--}}
{{--                            <li class="theme-option col-lg-6 float-right"><p class="selector-title">F4</p></li>--}}
{{--                        </ul>--}}
{{--                        <ul class="row">--}}
{{--                            <li class="theme-option col-lg-6"><p class="selector-title">Chọn chi nhánh</p></li>--}}
{{--                            <li class="theme-option col-lg-6 float-right"><p class="selector-title">F6</p></li>--}}
{{--                        </ul>--}}
{{--                        <ul class="row">--}}
{{--                            <li class="theme-option col-lg-6"><p class="selector-title">Chuyển tới ô nhập tiếp--}}
{{--                                    theo</p></li>--}}
{{--                            <li class="theme-option col-lg-6 float-right"><p class="selector-title">--}}
{{--                                    Enter/Tab</p></li>--}}
{{--                        </ul>--}}
{{--                        <ul class="row">--}}
{{--                            <li class="theme-option col-lg-6"><p class="selector-title">Quay lại ô nhập--}}
{{--                                    trước</p></li>--}}
{{--                            <li class="theme-option col-lg-6 float-right"><p class="selector-title">Shift +--}}
{{--                                    Tab</p></li>--}}
{{--                        </ul>--}}
{{--                        <ul class="row">--}}
{{--                            <li class="theme-option col-lg-6"><p class="selector-title">Đóng cửa sổ</p></li>--}}
{{--                            <li class="theme-option col-lg-6 float-right"><p class="selector-title">ESC</p></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane" id="setting-layout" role="tabpanel">--}}
{{--                <div class="slimScrollDiv">--}}
{{--                    <div style="position: relative; overflow: hidden; width: auto; height: calc(100vh - 280px);">--}}
{{--                        <ul>--}}
{{--                            <li><p class="selector-title">Bảng điều khiển</p></li>--}}
{{--                            <li>--}}
{{--                                <div class="theme-color">--}}
{{--                                    <a href="#" class="navbar-theme" navbar-theme="theme1">--}}
{{--                                        <span class="head"></span><span class="cont"></span>--}}
{{--                                    </a>--}}
{{--                                    <a href="#" class="navbar-theme" navbar-theme="themelight1">--}}
{{--                                        <span class="head"></span><span class="cont"></span>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li><p class="selector-title">Màu Logo</p></li>--}}
{{--                            <li class="theme-option">--}}
{{--                                <div class="theme-color">--}}
{{--                                    <a href="#" class="logo-theme" logo-theme="theme1"><span--}}
{{--                                            class="head"></span><span--}}
{{--                                            class="cont"></span></a>--}}
{{--                                    <a href="#" class="logo-theme" logo-theme="theme2"><span--}}
{{--                                            class="head"></span><span--}}
{{--                                            class="cont"></span></a>--}}
{{--                                    <a href="#" class="logo-theme" logo-theme="theme3"><span--}}
{{--                                            class="head"></span><span--}}
{{--                                            class="cont"></span></a>--}}
{{--                                    <a href="#" class="logo-theme" logo-theme="theme4"><span--}}
{{--                                            class="head"></span><span--}}
{{--                                            class="cont"></span></a>--}}
{{--                                    <a href="#" class="logo-theme" logo-theme="theme5"><span--}}
{{--                                            class="head"></span><span--}}
{{--                                            class="cont"></span></a>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li><p class="selector-title">Màu Header</p></li>--}}
{{--                            <li class="theme-option">--}}
{{--                                <div class="theme-color">--}}
{{--                                    <a href="#" class="header-theme" header-theme="theme1"><span--}}
{{--                                            class="head"></span><span--}}
{{--                                            class="cont"></span></a>--}}
{{--                                    <a href="#" class="header-theme" header-theme="theme2"><span--}}
{{--                                            class="head"></span><span--}}
{{--                                            class="cont"></span></a>--}}
{{--                                    <a href="#" class="header-theme" header-theme="theme3"><span--}}
{{--                                            class="head"></span><span--}}
{{--                                            class="cont"></span></a>--}}
{{--                                    <a href="#" class="header-theme" header-theme="theme4"><span--}}
{{--                                            class="head"></span><span--}}
{{--                                            class="cont"></span></a>--}}
{{--                                    <a href="#" class="header-theme" header-theme="theme5"><span--}}
{{--                                            class="head"></span><span--}}
{{--                                            class="cont"></span></a>--}}
{{--                                    <a href="#" class="header-theme" header-theme="theme6"><span--}}
{{--                                            class="head"></span><span--}}
{{--                                            class="cont"></span></a>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li><p class="selector-title">Màu Active</p></li>--}}
{{--                            <li class="theme-option">--}}
{{--                                <div class="theme-color">--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme1">&nbsp;</a>--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme2">&nbsp;</a>--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme3">&nbsp;</a>--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme4">&nbsp;</a>--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme5">&nbsp;</a>--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme6">&nbsp;</a>--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme7">&nbsp;</a>--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme8">&nbsp;</a>--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme9">&nbsp;</a>--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme10">&nbsp;</a>--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme11">&nbsp;</a>--}}
{{--                                    <a href="#" class="active-item-theme small"--}}
{{--                                       active-item-theme="theme12">&nbsp;</a>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li><p class="selector-title">Màu tiêu đề</p></li>--}}
{{--                            <li class="theme-option">--}}
{{--                                <div class="theme-color">--}}
{{--                                    <a href="#" class="leftheader-theme small" lheader-theme="theme5">&nbsp;</a>--}}
{{--                                    <a href="#" class="leftheader-theme small" lheader-theme="theme1">&nbsp;</a>--}}
{{--                                    <a href="#" class="leftheader-theme small" lheader-theme="theme2">&nbsp;</a>--}}
{{--                                    <a href="#" class="leftheader-theme small" lheader-theme="theme3">&nbsp;</a>--}}
{{--                                    <a href="#" class="leftheader-theme small" lheader-theme="theme4">&nbsp;</a>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            --}}{{--<li class="theme-option"><p class="selector-title">Màu Icon</p>--}}
{{--                            --}}{{--<div class="form-radio" id="menu-effect">--}}
{{--                            --}}{{--<div class="radio radio-inverse radio-inline"--}}
{{--                            --}}{{--data-toggle="tooltip" title="Mặc định"--}}
{{--                            --}}{{--data-original-title="simple icon">--}}
{{--                            --}}{{--<label><input type="radio" name="radio" value="st6"--}}
{{--                            --}}{{--onclick="handlemenutype(this.value)" checked>--}}
{{--                            --}}{{--<i class="helper"></i>--}}
{{--                            --}}{{--<span class="micon st6"><i class="feather icon-command"></i></span>--}}
{{--                            --}}{{--</label>--}}
{{--                            --}}{{--</div>--}}
{{--                            --}}{{--<div class="radio radio-primary radio-inline"--}}
{{--                            --}}{{--data-toggle="tooltip" title="Có màu"--}}
{{--                            --}}{{--data-original-title="color icon">--}}
{{--                            --}}{{--<label><input type="radio" name="radio" value="st5"--}}
{{--                            --}}{{--onclick="handlemenutype(this.value)">--}}
{{--                            --}}{{--<i class="helper"></i>--}}
{{--                            --}}{{--<span class="micon st5"><i class="feather icon-command"></i></span>--}}
{{--                            --}}{{--</label>--}}
{{--                            --}}{{--</div>--}}
{{--                            --}}{{--</div>--}}
{{--                            --}}{{--</li>--}}
{{--                        </ul>--}}
{{--                        <div class="slimScrollBar"--}}
{{--                             style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 456.57px;"></div>--}}
{{--                        <div class="slimScrollRail"--}}
{{--                             style="width: 7px; height: 100%; position: absolute; top: 0; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--    <ul>--}}
{{--        <li class="text-center">--}}
{{--            <span class="text-center f-18 m-t-15 m-b-15 d-block">Liên hệ với chúng tôi !</span>--}}
{{--            <a href="https://www.facebook.com/ALOAPP.VN" target="_blank"--}}
{{--               class="btn btn-facebook soc-icon m-b-20"--}}
{{--               title="Facebook"><i class="feather icon-facebook"></i></a>--}}
{{--            <a href="http://techres.vn"--}}
{{--               target="_blank" class="btn btn-warning soc-icon m-l-20 m-b-20"--}}
{{--               title="Website"><i--}}
{{--                    class="fa fa-chrome"></i></a></li>--}}
{{--    </ul>--}}
{{--</div>--}}
