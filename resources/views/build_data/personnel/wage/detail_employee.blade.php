<div class="modal fade" id="modal-detail-employee-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg-big" role="document">
        <div class="modal-content" id="loading-modal-detail-employee-manage">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.employee-manage.detail.title')</h4>
                <h5 id="status-detail-employee-manage" class="reset-data-detail-employee-manage float-right" style="margin-left: auto"></h5>
                <button type="button" class="close" onclick="closeModalDetailEmployeeManage()" onkeypress="closeModalDetailEmployeeManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left">
                <ul class="nav nav-tabs md-tabs md-6-tabs" role="tablist">
                    <li class="nav-item">
                        <a id="detail-employee-manage-info" class="nav-link" data-toggle="tab"
                           onclick="openModalDetailEmployeeInfo()" href="javascript:void(0)"
                           role="tab"
                           aria-expanded="true">@lang('app.employee-manage.detail.tab0')
                        </a>
                        <div class="slide"></div>
                    </li>
                    @if(Session::get(SESSION_KEY_LEVEL) > 3)
                        <li class="nav-item">
                            <a id="detail-employee-manage-bonus" class="nav-link" data-toggle="tab"
                               onclick="openModalDetailEmployeeBonus()" href="javascript:void(0)"
                               role="tab"
                               aria-expanded="true">@lang('app.employee-manage.detail.tab1')
                                <span class="label label-warning" id="total-record-bonus-punish-employee-manage">0</span>
                            </a>
                            <div class="slide"></div>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a id="detail-employee-manage-receipts" class="nav-link" data-toggle="tab"
                           onclick="openModalDetailEmployeeReceipts()" href="javascript:void(0)"
                           role="tab"
                           aria-expanded="true">@lang('app.employee-manage.detail.tab2')
                            <span class="label label-warning" id="total-record-bill-employee-manage">0</span>
                        </a>
                        <div class="slide"></div>
                    </li>
                </ul>
                <div class="card-block card m-0">
                    <div class="tab-content">
                        <div id="tab0-employee-manage-detail">
                            <div class="card-block col-xl-12 col-md-12">
                                <div class="user-card-full">
                                    <div class="row m-l-0 m-r-0">
                                        <div class="col-lg-4 user-profile d-flex justify-content-center align-items-center" id="color-detail-employee-manage">
                                            <div class="card-block text-center text-white">
                                                <div class="m-b-25 group-image-detail">
                                                    <img id="avatar-detail-employee-manage" onerror="imageDefaultOnLoadError($(this))" class="img-radius img-employee-custom w-100" alt="Avatar">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="card-block" id="boxlist-detail-employee-manage">
                                                <h6 class="sub-title m-b-0 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.title-info')</h6>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.name')</p>
                                                        <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15"
                                                            id="name-detail-employee-manage"></h6>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.birthday')</p>
                                                        <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15"
                                                            id="birthday-detail-employee-manage"></h6>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.gender')</p>
                                                        <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15"
                                                            id="gender-detail-employee-manage"></h6>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.phone')</p>
                                                        <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15"
                                                            id="phone-detail-employee-manage"></h6>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.passport')</p>
                                                        <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15"
                                                            id="passport-detail-employee-manage"></h6>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.email')</p>
                                                        <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15"
                                                            id="email-detail-employee-manage"></h6>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.birth-place')</p>
                                                        <h6 class="text-muted f-w-400 reset-data-detail-employee-manage text-break col-form-label-fz-15"
                                                            id="birth-place-detail-employee-manage" style="word-break: break-all;" ></h6>
                                                    </div>
                                                    <div class="col-lg-8 col-md-6 col-sm-12">
                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.address')</p>
                                                        <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15"
                                                            id="address-detail-employee-manage"></h6>
                                                    </div>
                                                </div>
                                                <h6 class="sub-title m-b-0 m-t-10px f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.title-restaurant')</h6>
                                                @if(Session::get(SESSION_KEY_LEVEL) > 3)
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.branch')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15"
                                                                id="branch-detail-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.role')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15"
                                                                id="role-detail-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.group-role')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15"
                                                                id="group-role-detail-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12 d-none" id="show-rank-detail-employee-manage">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.rank')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15"
                                                                id="rank-detail-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.work')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15"
                                                                id="work-detail-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.point')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15"
                                                                id="point-detail-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.salary')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15"
                                                                id="salary-detail-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.area')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15"
                                                                id="area-detail-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.area-control')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15"
                                                                id="area-control-detail-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.date-work')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15"
                                                                id="date-work-detail-employee-manage"></h6>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.role')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15"
                                                                id="role-detail-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.group-role')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15"
                                                                id="group-role-detail-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12 d-none" id="show-rank-detail-employee-manage">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.rank')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15"
                                                                id="rank-detail-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.work')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15"
                                                                id="work-detail-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.date-work')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15"
                                                                id="date-work-detail-employee-manage"></h6>
                                                        </div>
                                                    </div>
                                                @endif
                                                <ul class="social-link list-unstyled m-t-40 m-b-10">
                                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title=""
                                                           data-original-title="facebook"><i
                                                                class="feather icon-facebook facebook"
                                                                aria-hidden="true"></i></a></li>
                                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title=""
                                                           data-original-title="twitter"><i class="feather icon-twitter twitter"
                                                                                            aria-hidden="true"></i></a></li>
                                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title=""
                                                           data-original-title="instagram"><i
                                                                class="feather icon-instagram instagram"
                                                                aria-hidden="true"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-none" id="tab1-employee-manage-detail"
                             role="tabpanel" aria-expanded="true">
                            <div class="table-responsive new-table">
                                <table class="table "
                                       id="table-employee-manage-detail-tab1">
                                    <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center">@lang('app.employee-manage.detail.stt')</th>
                                        <th rowspan="2" class="text-center">@lang('app.employee-manage.detail.type')</th>
                                        <th>@lang('app.employee-manage.detail.bonus')</th>
                                        <th>@lang('app.employee-manage.detail.punish')</th>
                                        <th rowspan="2" class="text-center">@lang('app.employee-manage.detail.create')</th>
                                        <th rowspan="2" class="text-center"></th>
                                    </tr>
                                    <tr>
                                        <th id="total-bonus-detail-employee-manage">0
                                        </th>
                                        <th id="total-punish-detail-employee-manage">0
                                        </th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="d-none" id="tab2-employee-manage-detail"
                             role="tabpanel" aria-expanded="false">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    @include('manage.employee.filter_detail')
                                </div>
                                <table class="table "
                                       id="table-employee-manage-detail-tab2">
                                    <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center">@lang('app.employee-manage.detail.stt')</th>
                                        <th rowspan="2" class="text-center">@lang('app.employee-manage.detail.code')</th>
                                        <th>@lang('app.employee-manage.detail.amount')</th>
                                        <th rowspan="2" class="text-center">@lang('app.employee-manage.detail.create')</th>
                                        <th rowspan="2" class="text-center"></th>
                                    </tr>
                                    <tr>
                                        <th
                                            id="total-amount-bill-detail-employee-manage">0
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@include('treasurer.employee_bonus_punish.detail')
@include('manage.bill.detail')
@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/personnel/wage/detail_employee.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
