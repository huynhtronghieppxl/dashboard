<div class="modal fade" id="modal-create-employee-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 1300px">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.employee-manage.create.title')</h4>
                <div class="col-md-4 mt-3 p-0 ml-auto">
                    <div class="d-flex align-items-baseline justify-content-end" style="margin-right: 15px">
                        <label class="f-w-600 col-form-label-fz-15 mr-3">Ngày bắt đầu làm việc: </label>
                        <h6 class="f-w-400 text-muted col-form-label-fz-15"
                            id="inventory-create-request-out-inventory-manage">{{ date("d/m/Y") }}
                        </h6>
                    </div>
                </div>
                <button type="button" class="close" onclick="closeModalCreateEmployeeManage()"
                        onkeypress="closeModalCreateEmployeeManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            @if(Session::get(SESSION_KEY_LEVEL) > 1)
                <div class="modal-body text-left" id="loading-modal-create-employee-manage">
                    <div class="card-block card m-0" style="display: flex !important; flex-direction: row !important;">

                        <div class="col-md-4 pr-0 pl-0">
                            {{--                            Tên--}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input type="text" id="name-create-employee-manage" data-spec="1"
                                               class="form-control" data-empty="1" data-min-length="2"
                                               data-max-length="50">
                                        <label for="name-create-employee-manage">
                                            @lang('app.employee-manage.create.name')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{--                            SĐT--}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input id="phone-create-employee-manage" class="form-control" data-empty="1"
                                               data-phone="1">
                                        <label for="phone-create-employee-manage">
                                            @lang('app.employee-manage.create.phone')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{--                            Ngày sinh--}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input class="form-control text-center" id="birthday-create-employee-manage"
                                               value="{{date('d/m/Y')}}" data-calender="1" data-empty="1">
                                        <label for="birthday-create-employee-manage">
                                            @lang('app.employee-manage.create.birthday')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{--                            Giới tính --}}
                            <div class="col-md-12">
                                <div class="form-group checkbox-group">
                                    <label class="title-checkbox">@lang('app.employee-manage.create.gender')</label>
                                    <div class="row" id="gender-create-employee-manage">
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" name="gender" value="1" checked/>
                                                <label class="name-checkbox"
                                                       for="print-kitchen-create-food-brand-manage">@lang('app.employee-manage.create.male')
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" name="gender" value="0"/>
                                                <label class="name-checkbox"
                                                       for="print-kitchen-create-food-brand-manage">@lang('app.employee-manage.create.female')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                            CMND--}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input id="passport-create-employee-manage" class="form-control" data-number="1"
                                               data-max-length="12" data-min-length="9">
                                        <label for="passport-create-employee-manage">
                                            @lang('app.employee-manage.create.passport')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{--                            Email--}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input id="email-create-employee-manage" class="form-control"
                                               data-max-length="255"
                                               data-mail="1">
                                        <label for="email-create-employee-manage">
                                            @lang('app.employee-manage.create.email')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{--                            Nơi sinh--}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input id="birthday-place-create-employee-manage" type="text"
                                               class="form-control"
                                               data-max-length="255" data-birthday-place="1">
                                        <label for="birthday-place-create-employee-manage">
                                            @lang('app.employee-manage.create.birth-place')
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 pr-0 pl-0">
                            {{--                            Tỉnh/Thành phố--}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-city-create-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.create.city')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                            Quận/huyện--}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group disabled" id="select-district">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-district-create-employee-manage" disabled
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.create.district')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                            Phường/xã--}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group disabled" id="select-ward">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-ward-create-employee-manage" disabled
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.create.ward')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                            Đường--}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input ">
                                        <input type="text" id="address-create-employee-manage" class="form-control"
                                               data-max-length="255" data-min-length="2" data-empty="1">
                                        <label for="address-create-employee-manage">
                                            @lang('app.employee-manage.create.street')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{--                        thương hiệu --}}
                            @if(in_array('RESTAURANT_MANAGER', Session::get(SESSION_JAVA_ACCOUNT)['permissions']) || in_array('EMPLOYEE_MANAGER', Session::get(SESSION_JAVA_ACCOUNT)['permissions']) )
                                <div class="col-md-12">
                                    <div class="form-group select2_theme validate-group">
                                        <div class="form-validate-select ">
                                            <div class="col-lg-12 mx-0 px-0">
                                                <div class="col-lg-12 pr-0 select-material-box">
                                                    <select id="select-brand-create-employee-manage" data-select="1"
                                                            class="js-example-basic-single select2-hidden-accessible">
                                                        @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all() as $db)
                                                            @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                                <option selected
                                                                        value="{{$db['id']}}">{{$db['name']}}</option>
                                                            @else
                                                                <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <label class="icon-validate">
                                                        @lang('app.component.excel.text2')
                                                        @include('layouts.start')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{--                            Chi nhánh--}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group"
                                     id="select-branch-create-employee-manage-div">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-branch-create-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        tabindex="-1" aria-hidden="true">
                                                    <option value="" disabled
                                                            selected>@lang('app.component.option_default')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.create.branch')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--                            Quyền hoạt động trên chi nhánh--}}
                            <div class="col-md-12">

                                @if(count(array_intersect(Session::get(SESSION_PERMISSION), ['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ACCOUNTANT_ACCESS', 'EMPLOYEE_MANAGER', 'SETTING_MANAGER'])) > 0)
                                    <span class="d-none" id="check-permission-create-employee-manage">1</span>
                                @else
                                    <span class="d-none" id="check-permission-create-employee-manage">0</span>
                                @endif
                                <div class="form-group select2_theme validate-group"
                                     id="check-employee-permission-branch">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select
                                                        id="select-branch-enjoys-permission-employee-create-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1"
                                                        multiple="">
                                                    @if(count(array_intersect(Session::get(SESSION_PERMISSION), ['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ACCOUNTANT_ACCESS', 'EMPLOYEE_MANAGER', 'SETTING_MANAGER'])) > 0))
                                                    @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all() as $db)
                                                        @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])
                                                            <option value="{{$db['id']}}"
                                                                    selected>{{$db['name']}}</option>
                                                        @else
                                                            <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                        @endif
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.create.branch-enjoys-permission-employee')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="link-href">
                                    <span
                                            class="text-warning">@lang('app.employee-manage.create.sub-title-employee-to-branch')</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 pr-0 pl-0">
                            {{--                            bậc lương --}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-salary-create-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.create.salary')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                            Ca làm việc--}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-work-create-employee-manage"
                                                        class="select-parent-modal js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.create.work')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                            Khối bộ phận--}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-group-create-role-data"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="1"
                                                            selected>@lang('app.role-data.create.role-office')</option>
                                                    <option
                                                            value="2">@lang('app.role-data.create.role-business')</option>
                                                    <option
                                                            value="3">@lang('app.role-data.create.role-production')</option>
                                                    <option
                                                            value="4">@lang('app.role-data.create.role-marketing')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.role-data.create.role-group')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                            Bộ phận--}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-role-create-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.create.role')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--  Hạng--}}
                            @if(Session::get(SESSION_KEY_LEVEL) > 2)
                                <div class="col-md-12">
                                    <div class="form-group select2_theme validate-group disabled d-none" id="test">
                                        <div class="form-validate-select ">
                                            <div class="col-lg-12 mx-0 px-0">
                                                <div class="col-lg-12 pr-0 select-material-box">
                                                    <select id="select-rank-create-employee-manage"
                                                            class="js-example-basic-single d-none select2-hidden-accessible"
                                                            tabindex="-1" aria-hidden="true" style="">
                                                        <option value="-2" selected disabled
                                                                hidden>@lang('app.component.option-null')</option>
                                                    </select>
                                                    <label class="icon-validate">
                                                        @lang('app.employee-manage.create.rank')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{--                            Khu vực--}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-area-create-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.create.area')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(Session::get(SESSION_KEY_LEVEL) > 1)
                                {{--                                Quản lý khu vực--}}
                                <div class="col-md-12">
                                    <div class="form-group select2_theme validate-group">
                                        <div class="form-validate-select ">
                                            <div class="col-lg-12 mx-0 px-0">
                                                <div class="col-lg-12 pr-0 select-material-box">
                                                    <select id="select-area-control-create-employee-manage"
                                                            class="js-example-basic-single select2-hidden-accessible"
                                                            multiple="" tabindex="-1" aria-hidden="true">
                                                    </select>
                                                    <label class="icon-validate">
                                                        @lang('app.employee-manage.create.area-control')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="link-href">
                                            <span
                                                    class="text-warning">@lang('app.employee-manage.create.warning')</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            @else
                <div class="modal-body text-left" id="loading-modal-create-employee-manage">
                    <div class="card-block card m-0" style="display: flex !important; flex-direction: row !important;">
                        <div class="col-md-4 pr-0 pl-0">
                            {{--                            Tên--}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input type="text" id="name-create-employee-manage" data-spec="1"
                                               class="form-control" data-empty="1" data-min-length="2"
                                               data-max-length="50">
                                        <label for="name-create-employee-manage">
                                            @lang('app.employee-manage.create.name')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{--                            SĐT--}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input id="phone-create-employee-manage" class="form-control" data-empty="1"
                                               data-phone="1">
                                        <label for="phone-create-employee-manage">
                                            @lang('app.employee-manage.create.phone')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{--                            Ngày sinh--}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input class="form-control text-center" id="birthday-create-employee-manage"
                                               value="{{date('d/m/Y')}}" data-calender="1" data-empty="1">
                                        <label for="birthday-create-employee-manage">
                                            @lang('app.employee-manage.create.birthday')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{--                            Giới tính--}}
                            <div class="col-md-12">
                                <div class="form-group checkbox-group">
                                    <label class="title-checkbox">@lang('app.employee-manage.create.gender')</label>
                                    <div class="row" id="gender-create-employee-manage">
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" name="gender" value="1" checked/>
                                                <label class="name-checkbox"
                                                       for="print-kitchen-create-food-brand-manage">@lang('app.employee-manage.create.male')
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" name="gender" value="0"/>
                                                <label class="name-checkbox"
                                                       for="print-kitchen-create-food-brand-manage">@lang('app.employee-manage.create.female')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{--                            CMND--}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input id="passport-create-employee-manage" class="form-control" data-number="1"
                                               data-max-length="12" data-min-length="9">
                                        <label for="passport-create-employee-manage">
                                            @lang('app.employee-manage.create.passport')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{--                            Email--}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input id="email-create-employee-manage" class="form-control"
                                               data-max-length="255"
                                               data-mail="1">
                                        <label for="email-create-employee-manage">
                                            @lang('app.employee-manage.create.email')
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 pr-0 pl-0">
                            {{--                            Nơi sống--}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input id="birthday-place-create-employee-manage" type="text"
                                               class="form-control"
                                               data-max-length="255" data-birthday-place="1">
                                        <label for="birthday-place-create-employee-manage">
                                            @lang('app.employee-manage.create.birth-place')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{--                            Tỉnh/ thành phố--}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-city-create-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.create.city')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                            Quận/huyện--}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group disabled" id="select-district">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-district-create-employee-manage" disabled
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.create.district')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                            Phường/xã--}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group disabled" id="select-ward">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-ward-create-employee-manage" disabled
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.create.ward')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                            Đường--}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input ">
                                        <input type="text" id="address-create-employee-manage" class="form-control"
                                               data-max-length="255" data-min-length="2" data-empty="1">
                                        <label for="address-create-employee-manage">
                                            @lang('app.employee-manage.create.street')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{--                            Ca làm việc--}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-work-create-employee-manage"
                                                        class="select-parent-modal js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.create.work')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(Session::get('SESSION_KEY_LEVEL') > 0)
                                {{-- HAVE RIGHTS ACTIVE ON BRANCH --}}
                                <div class="col-md-12">
                                    @if(count(array_intersect(Session::get(SESSION_PERMISSION), ['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ACCOUNTANT_ACCESS', 'EMPLOYEE_MANAGER', 'SETTING_MANAGER'])) > 0)
                                        <span class="d-none" id="check-permission-create-employee-manage">1</span>
                                    @else
                                        <span class="d-none" id="check-permission-create-employee-manage">0</span>
                                    @endif
                                    <div class="form-group select2_theme validate-group"
                                         id="check-employee-permission-branch">
                                        <div class="form-validate-select ">
                                            <div class="col-lg-12 mx-0 px-0">
                                                <div class="col-lg-12 pr-0 select-material-box">
                                                    <select
                                                        id="select-branch-enjoys-permission-employee-create-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1"
                                                        multiple="">
                                                        @if(count(array_intersect(Session::get(SESSION_PERMISSION), ['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ACCOUNTANT_ACCESS', 'EMPLOYEE_MANAGER', 'SETTING_MANAGER'])) > 0))
                                                        @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all() as $db)
                                                            @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])
                                                                <option value="{{$db['id']}}"
                                                                        selected>{{$db['name']}}</option>
                                                            @else
                                                                <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                            @endif
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    <label class="icon-validate">
                                                        @lang('app.employee-manage.create.branch-enjoys-permission-employee')
                                                        @include('layouts.start')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="link-href">
                                    <span
                                        class="text-warning">@lang('app.employee-manage.create.sub-title-employee-to-branch')</span>
                                        </div>
                                    </div>
                                </div>

                            @endif
                        </div>

                        <div class="col-md-4 pr-0 pl-0">
                            {{-- BRAND --}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-brand-create-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible">
                                                    @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all() as $db)
                                                        @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                            <option selected
                                                                    value="{{$db['id']}}">{{$db['name']}}</option>
                                                        @else
                                                            <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.component.excel.text2')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- BRANCH --}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-branch-create-employee-manage"
                                                    class="js-example-basic-single select2-hidden-accessible"
                                                    tabindex="-1" data-select="1" aria-hidden="true">
                                                    <option
                                                            value="{{Session::get(SESSION_JAVA_ACCOUNT)['branch_id']}}"
                                                            selected>{{Session::get(SESSION_JAVA_ACCOUNT)['branch_name']}}</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.create.branch')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- GROUP ROLE --}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-group-create-role-data"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="1"
                                                            selected>@lang('app.role-data.create.role-office')</option>
                                                    <option
                                                            value="2">@lang('app.role-data.create.role-business')</option>
                                                    <option
                                                            value="3">@lang('app.role-data.create.role-production')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.role-data.create.role-group')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- ROLE --}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-role-create-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.create.role')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- AREA --}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-area-create-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.create.area')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endif
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none" onclick="reloadModalCreateEmployeeManage()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreateEmployeeManage()"
                     onkeypress="saveModalCreateEmployeeManage()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-none">
    <span id="current-date-employee-birthday">{{date('d/m/Y')}}</span>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/employee/create.js?version=13',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
