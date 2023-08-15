<style>
    #working-form-employee-manage ~ .bootstrap-datetimepicker-widget.dropdown-menu {
        margin: 1.6rem 0;
    }
</style>
<div class="modal fade" id="modal-update-employee-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 1300px">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.employee-manage.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateEmployeeManage()"
                        onkeypress="closeModalUpdateEmployeeManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            @if (session::get('SESSION_KEY_LEVEL') > 1)
                <div class="modal-body text-left" id="loading-modal-update-employee-manage">
                    <div class="card-block card m-0" style="display: flex !important; flex-direction: row !important;">
                        <div class="col-md-4 pr-0 pl-0">
                            {{-- Tên--}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input id="name-update-employee-manage" class="form-control" data-empty="1"
                                               data-spec="1" data-min-length="2" data-max-length="50"/>
                                        <label for="name-update-employee-manage">
                                            @lang('app.employee-manage.update.name')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{-- Số điện thoại --}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input id="phone-update-employee-manage" class="form-control" data-empty="1"
                                               data-phone="1"/>
                                        <label for="phone-update-employee-manage">
                                            @lang('app.employee-manage.update.phone')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{-- Ngày bắt đầu làm --}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input class="form-control text-center" id="working-form-employee-manage"
                                               value="29/08/2022" data-empty="1"/>
                                        <label for="working-form-employee-manage">
                                            Ngày bắt đầu làm việc
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{-- Ngày sinh --}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input class="form-control text-center" id="birthday-update-employee-manage"
                                               value="29/08/2022" data-empty="1"/>
                                        <label for="birthday-update-employee-manage">
                                            @lang('app.employee-manage.update.birthday')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{-- Giới tính --}}
                            <div class="col-md-12">
                                <div class="form-group checkbox-group">
                                    <label class="title-checkbox">@lang('app.employee-manage.update.gender')</label>
                                    <div class="row" id="gender-update-employee-manage">
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" name="gender" value="1" checked/>
                                                <label class="name-checkbox"
                                                       for="print-kitchen-create-food-brand-manage">@lang('app.employee-manage.update.male')
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" name="gender" value="0"/>
                                                <label class="name-checkbox"
                                                       for="print-kitchen-create-food-brand-manage">@lang('app.employee-manage.update.female')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Số chứng minh --}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input id="passport-update-employee-manage" class="form-control"
                                               data-number="1" data-max-length="12" data-min-length="9"/>
                                        <label for="passport-update-employee-manage">
                                            @lang('app.employee-manage.update.passport')
                                        </label>
                                    </div>
                                </div>

                            </div>
                            {{-- Email --}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input id="email-update-employee-manage" class="form-control" data-mail="1"
                                               data-max-length="255"/>
                                        <label for="email-update-employee-manage">
                                            @lang('app.employee-manage.update.email')
                                        </label>
                                    </div>
                                </div>

                            </div>
                            {{-- Nơi sinh --}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input id="birthday-place-update-employee-manage" type="text"
                                               class="form-control" data-max-length="255"/>
                                        <label for="birthday-place-update-employee-manage">
                                            @lang('app.employee-manage.update.birth-place')
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-4 pr-0 pl-0">
                            {{-- Tỉnh/Thành phố--}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-city-update-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')
                                                    </option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.update.city')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Quận--}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-district-update-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')
                                                    </option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.update.district')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Xã--}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-ward-update-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')
                                                    </option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.update.ward')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Đường--}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input ">
                                        <input type="text" id="address-update-employee-manage"
                                               class="form-control" data-max-length="255" data-min-length="2"
                                               data-empty="1">
                                        <label for="address-update-employee-manage">
                                            @lang('app.employee-manage.update.street')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{-- thương hiệu --}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-brand-update-employee-manage" data-select="1"
                                                        class="js-example-basic-single select2-hidden-accessible">
                                                    @foreach (collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', (int) Config::get('constants.type.checkbox.SELECTED'))->all() as $db)
                                                        @if (Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                            <option selected value="{{ $db['id'] }}">
                                                                {{ $db['name'] }}</option>
                                                        @else
                                                            <option value="{{ $db['id'] }}">{{ $db['name'] }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <label class="icon-validate">
                                                    Thương hiệu
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Chi nhánh --}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group"
                                     id="select-branch-update-employee-manage-div">
                                    <div class="form-validate-select">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-branch-update-employee-manage" data-select="1"
                                                        class="form-control js-example-basic-single select2-hidden-accessible">

                                                    <option value="" disabled
                                                            selected>@lang('app.component.option_default')</option>
                                                </select>

                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.update.branch')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Quyền--}}
                            <div class="col-md-12">
                                @if(count(array_intersect(Session::get(SESSION_PERMISSION), ['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ACCOUNTANT_ACCESS', 'EMPLOYEE_MANAGER', 'SETTING_MANAGER'])) > 0)
                                    <span class="d-none" id="check-permission-update-employee-manage">1</span>
                                @else
                                    <span class="d-none" id="check-permission-update-employee-manage">0</span>
                                @endif
                                <div class="form-group select2_theme validate-group"
                                     id="check-update-employee-permission-branch">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select
                                                        id="select-branch-enjoys-permission-employee-update-employee-manage"
                                                        data-select="1"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        multiple>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.update.branch-enjoys-permission-employee')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="link-href">
                                        <span class="text-warning">@lang('app.employee-manage.update.sub-title-employee-to-branch')</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 pr-0 pl-0">
                            {{-- Bậc lương --}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-salary-update-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')
                                                    </option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.update.salary')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{-- Ca làm việc --}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-work-update-employee-manage"
                                                        class="select-parent-modal js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')
                                                    </option>
                                                </select>

                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.update.work')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Khối bộ phận --}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-group-role-update-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="1">@lang('app.role-data.create.role-office')</option>
                                                    <option value="2">@lang('app.role-data.create.role-business')</option>
                                                    <option value="3">@lang('app.role-data.create.role-production')</option>
                                                    <option value="4">@lang('app.role-data.create.role-marketing')</option>
                                                </select>

                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.detail.group-role')
                                                     @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            {{-- Bộ phận --}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-role-update-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')
                                                    </option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.update.role')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{-- Thứ hạng --}}
                            @if(Session::get(SESSION_KEY_LEVEL) > 2)
                                <div class="col-md-12">
                                    <div class="form-group select2_theme validate-group disabled d-none"
                                         id="show-select-rank-update-employee-manage">
                                        <div class="form-validate-select">
                                            <div class="col-lg-12 mx-0 px-0">
                                                <div class="col-lg-12 pr-0 select-material-box">
                                                    <select id="select-rank-update-employee-manage" disabled
                                                            class="js-example-basic-single select2-hidden-accessible"
                                                            tabindex="-1" aria-hidden="true">
                                                        <option value="" disabled="" selected="">
                                                            @lang('app.component.option-null')</option>
                                                    </select>
                                                    <label class="icon-validate">
                                                        @lang('app.employee-manage.update.rank')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endif
                            {{-- Khu vực --}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-area-update-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')
                                                    </option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.update.area')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Quản lý khu vực --}}
                            <div class="col-md-12" >
                                <div class="form-group select2_theme validate-group"
                                     style="margin-bottom: 0px !important;">
                                    <div class="form-validate-select">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-area-control-update-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        multiple="" tabindex="-1" aria-hidden="true"> </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.update.area-control')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <span class="text-warning">* Nhân viên quản lý khu vực sẽ hưởng doanh số trên khu vực
                                    đó. Nếu cho nhân viên quản lý khu vực đã có quản lý thì sẽ thay thế quản lý hiện tại
                                    !</span>
                            </div>
                        </div>
                    </div>

                </div>
            @else
                <div class="modal-body text-left" id="loading-modal-update-employee-manage">
                    <div class="card-block card m-0" style="display: flex !important; flex-direction: row !important;">

                        <div class="col-md-4 pr-0 pl-0">
                            {{-- tên --}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input id="name-update-employee-manage" class="form-control" data-empty="1"
                                               data-spec="1" data-min-length="2" data-max-length="50"/>
                                        <label for="name-update-employee-manage">
                                            @lang('app.employee-manage.update.name')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{-- Số điện thoại --}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input id="phone-update-employee-manage" class="form-control" data-empty="1"
                                               data-phone="1"/>
                                        <label for="phone-update-employee-manage">
                                            @lang('app.employee-manage.update.phone')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{-- Ngay sinh --}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input class="form-control text-center" id="birthday-update-employee-manage"
                                               value="29/08/2022" data-empty="1"/>
                                        <label for="birthday-update-employee-manage">
                                            @lang('app.employee-manage.update.birthday')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{-- Giới tính--}}
                            <div class="col-md-12">
                                <div class="form-group checkbox-group">
                                    <label class="title-checkbox">@lang('app.employee-manage.update.gender')</label>
                                    <div class="row" id="gender-update-employee-manage">
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" name="gender" value="1" checked/>
                                                <label class="name-checkbox"
                                                       for="print-kitchen-create-food-brand-manage">@lang('app.employee-manage.update.male')
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" name="gender" value="0"/>
                                                <label class="name-checkbox"
                                                       for="print-kitchen-create-food-brand-manage">@lang('app.employee-manage.update.female')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- CCCD --}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input id="passport-update-employee-manage" class="form-control"
                                               data-number="1" data-max-length="12"/>
                                        <label for="passport-update-employee-manage">
                                            @lang('app.employee-manage.update.passport')
                                        </label>
                                    </div>
                                </div>

                            </div>
                            {{-- Email --}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input id="email-update-employee-manage" class="form-control" data-mail="1"
                                               data-max-length="255"/>
                                        <label for="email-update-employee-manage">
                                            @lang('app.employee-manage.update.email')
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-4 pr-0 pl-0">
                            {{-- Nơi sinh --}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input id="birthday-place-update-employee-manage" type="text"
                                               class="form-control" data-max-length="255"/>
                                        <label for="birthday-place-update-employee-manage">
                                            @lang('app.employee-manage.update.birth-place')
                                        </label>
                                    </div>
                                </div>

                            </div>
                            {{-- Tỉnh/thành phố--}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-city-update-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')
                                                    </option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.update.city')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Quận--}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-district-update-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')
                                                    </option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.update.district')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Xã--}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-ward-update-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')
                                                    </option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.update.ward')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Đường--}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input ">
                                        <input type="text" id="address-update-employee-manage"
                                               class="form-control" data-max-length="255" data-min-length="2"
                                               data-empty="1">
                                        <label for="address-update-employee-manage">
                                            @lang('app.employee-manage.update.street')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{-- Ngày bắt đầu làm --}}
                            <div class="col-md-12">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input class="form-control text-center" id="working-form-employee-manage"
                                               value="29/08/2022" data-empty="1"/>
                                        <label for="working-form-employee-manage">
                                            Ngày bắt đầu làm việc
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if(Session::get('SESSION_KEY_LEVEL') > 0)
                                {{-- Quyền hoạt động trên chi nhánh --}}
                                <div class="col-md-12">
                                    @if(count(array_intersect(Session::get(SESSION_PERMISSION), ['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ACCOUNTANT_ACCESS', 'EMPLOYEE_MANAGER', 'SETTING_MANAGER'])) > 0)
                                        <span class="d-none" id="check-permission-update-employee-manage">1</span>
                                    @else
                                        <span class="d-none" id="check-permission-update-employee-manage">0</span>
                                    @endif
                                    <div class="form-group select2_theme validate-group"
                                         id="check-update-employee-permission-branch">
                                        <div class="form-validate-select ">
                                            <div class="col-lg-12 mx-0 px-0">
                                                <div class="col-lg-12 pr-0 select-material-box">
                                                    <select
                                                        id="select-branch-enjoys-permission-employee-update-employee-manage"
                                                        data-select="1"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        multiple>
                                                    </select>
                                                    <label class="icon-validate">
                                                        @lang('app.employee-manage.update.branch-enjoys-permission-employee')
                                                        @include('layouts.start')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="link-href">
                                            <span class="text-warning">@lang('app.employee-manage.update.sub-title-employee-to-branch')</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-4 pr-0 pl-0">
                            {{-- thương hiệu --}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-brand-update-employee-manage" data-select="1"
                                                        class="js-example-basic-single select2-hidden-accessible">
                                                    @foreach (collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', (int) Config::get('constants.type.checkbox.SELECTED'))->all() as $db)
                                                        @if (Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                            <option selected value="{{ $db['id'] }}">
                                                                {{ $db['name'] }}</option>
                                                        @else
                                                            <option value="{{ $db['id'] }}">{{ $db['name'] }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <label class="icon-validate">
                                                    Thương hiệu
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- chi nhánh--}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-branch-update-employee-manage" data-select="1"
                                                        class="form-control js-example-basic-single select2-hidden-accessible">
                                                    @if (Session::get(SESSION_KEY_LEVEL) > 1)
                                                        @foreach (collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int) Config::get('constants.type.checkbox.SELECTED'))->all() as $db)
                                                            @if (Session::get(SESSION_KEY_BRANCH_ID) === $db['id'])
                                                                <option value="{{ $db['id'] }}" selected>
                                                                    {{ $db['name'] }}</option>
                                                            @else
                                                                <option value="{{ $db['id'] }}">
                                                                    {{ $db['name'] }}</option>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <option
                                                                value="{{ Session::get(SESSION_JAVA_ACCOUNT)['branch_id'] }}"
                                                                selected>
                                                            {{ Session::get(SESSION_JAVA_ACCOUNT)['branch_name'] }}
                                                        </option>
                                                    @endif
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.update.branch')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{-- Khối bộ phận --}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-group-role-update-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="1">@lang('app.role-data.create.role-office')</option>
                                                    <option value="2">@lang('app.role-data.create.role-business')</option>
                                                    <option value="3">@lang('app.role-data.create.role-production')</option>
                                                </select>

                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.detail.group-role')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{-- Bộ phận --}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-role-update-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')
                                                    </option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.update.role')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{-- Khu vực --}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-area-update-employee-manage"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')
                                                    </option>
                                                </select>

                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.update.area')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Ca làm việc--}}
                            <div class="col-md-12">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-work-update-employee-manage"
                                                        class="select-parent-modal js-example-basic-single select2-hidden-accessible"
                                                        data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled
                                                            hidden>@lang('app.component.option_default')
                                                    </option>
                                                </select>

                                                <label class="icon-validate">
                                                    @lang('app.employee-manage.update.work')
                                                    @include('layouts.start')
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
{{--                <button type="button" class="btn btn-grd-success d-none" id="employee-off"--}}
{{--                        onclick="changeStatusWorkingEmployee()">--}}
{{--                    @lang('app.employee-manage.update.employee-back-to-work')--}}
{{--                </button>--}}
                <div class="btn seemt-orange seemt-bg-orange seemt-btn-hover-orange d-none" id="employee-off"
                     onclick="changeStatusWorkingEmployee()">
                    <i class="fi-rr-user-add"></i>
                    <span> @lang('app.employee-manage.update.employee-back-to-work')</span>
                </div>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalUpdateEmployeeManage()" onkeypress="saveModalUpdateEmployeeManage()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/employee/update.js?version=16',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
