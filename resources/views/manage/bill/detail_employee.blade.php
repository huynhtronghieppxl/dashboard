<div class="modal fade" id="modal-bill-detail-employee-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg-big" role="document">
        <div class="modal-content" id="loading-modal-detail-employee-manage">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.employee-manage.detail.title')</h4>
                <div class="d-flex align-items-center">
                    <h5 class="m-0 reset-data-detail-employee-manage" id="status-detail-employee-manage"></h5>
                    <button type="button" class="close ml-4" onclick="closeModalDetailEmployeeManageInBillDetail()" onkeypress="closeModalDetailEmployeeManageInBillDetail()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body background-body-color text-left">
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="card user-card-full">
                            <div class="row m-l-0 m-r-0">
                                <div class="col-sm-3 user-profile" id="color-detail-employee-manage">
                                    <div class="card-block text-center text-white">
                                        <div class="m-b-25" style="width: 16rem; height: 16rem">
                                            <img id="avatar-detail-employee-manage" onerror="imageDefaultOnLoadError($(this))" class="img-radius" alt="Avatar" style="width: 100%; height: 100%">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="card-block">
                                        <h6 class="sub-title m-b-0">@lang('app.employee-manage.detail.title-info')</h6>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="m-b-10 f-w-600">@lang('app.employee-manage.detail.name')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage"
                                                    id="name-detail-employee-manage"></h6>
                                            </div>
                                            <div class="col-sm-4">
                                                <p class="m-b-10 f-w-600">@lang('app.employee-manage.detail.birthday')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage"
                                                    id="birthday-detail-employee-manage"></h6>
                                            </div>
                                            <div class="col-sm-4">
                                                <p class="m-b-10 f-w-600">@lang('app.employee-manage.detail.gender')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage"
                                                    id="gender-detail-employee-manage"></h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="m-b-10 f-w-600">@lang('app.employee-manage.detail.phone')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage"
                                                    id="phone-detail-employee-manage"></h6>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="m-b-10 f-w-600">@lang('app.employee-manage.detail.email')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage"
                                                    id="email-detail-employee-manage"></h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="m-b-10 f-w-600">@lang('app.employee-manage.detail.birth-place')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage"
                                                    id="birth-place-detail-employee-manage"></h6>
                                            </div>
                                            <div class="col-sm-4">
                                                <p class="m-b-10 f-w-600">@lang('app.employee-manage.detail.passport')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage"
                                                    id="passport-detail-employee-manage"></h6>
                                            </div>
                                            <div class="col-sm-4">
                                                <p class="m-b-10 f-w-600">@lang('app.employee-manage.detail.address')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage"
                                                    id="address-detail-employee-manage"></h6>
                                            </div>
                                        </div>
                                        <h6 class="sub-title m-b-0 m-t-10px">@lang('app.employee-manage.detail.title-restaurant')</h6>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="m-b-10 f-w-600">@lang('app.employee-manage.detail.branch')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage"
                                                    id="branch-detail-employee-manage"></h6>
                                            </div>
                                            <div class="col-sm-4">
                                                <p class="m-b-10 f-w-600">@lang('app.employee-manage.detail.branch')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage"
                                                    id="branch-detail-employee-manage"></h6>
                                            </div>
                                            <div class="col-sm-4">
                                                <p class="m-b-10 f-w-600">@lang('app.employee-manage.detail.rank')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage"
                                                    id="rank-detail-employee-manage"></h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="m-b-10 f-w-600">@lang('app.employee-manage.detail.work')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage"
                                                    id="work-detail-employee-manage"></h6>
                                            </div>
                                            <div class="col-sm-4">
                                                <p class="m-b-10 f-w-600">@lang('app.employee-manage.detail.point')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage"
                                                    id="point-detail-employee-manage"></h6>
                                            </div>
                                            <div class="col-sm-4">
                                                <p class="m-b-10 f-w-600">@lang('app.employee-manage.detail.salary')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage"
                                                    id="salary-detail-employee-manage"></h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="m-b-10 f-w-600">@lang('app.employee-manage.detail.area')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage"
                                                    id="area-detail-employee-manage"></h6>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="m-b-10 f-w-600">@lang('app.employee-manage.detail.area-control')</p>
                                                <h6 class="text-muted f-w-400 reset-data-detail-employee-manage"
                                                    id="area-control-detail-employee-manage"></h6>
                                            </div>
                                        </div>
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
                    <div class="col-lg-12">
                        <div class="card card-block">
                            <ul class="nav nav-tabs md-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab1-employee-manage-detail" role="tab" aria-expanded="true">@lang('app.employee-manage.detail.tab1')
                                        <span class="label label-warning" id="total-record-bonus-punish-employee-manage">0</span></a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab2-employee-manage-detail" role="tab" aria-expanded="false">@lang('app.employee-manage.detail.tab2')
                                        <span class="label label-success" id="total-record-bill-employee-manage">0</span></a>
                                    <div class="slide"></div>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1-employee-manage-detail"
                                     role="tabpanel" aria-expanded="true">
                                    <div class="card">
                                        <div class="table-responsive">
                                            <table class="table table-bordered"
                                                   id="table-employee-manage-detail-tab1">
                                                <thead>
                                                <tr>
                                                    <th>@lang('app.employee-manage.detail.stt')</th>
                                                    <th>@lang('app.employee-manage.detail.type')</th>
                                                    <th>@lang('app.employee-manage.detail.bonus')</th>
                                                    <th>@lang('app.employee-manage.detail.punish')</th>
                                                    <th>@lang('app.employee-manage.detail.create')</th>
                                                    <th>@lang('app.employee-manage.detail.action')</th>
                                                </tr>
                                                <tr>
                                                    <th>@lang('app.employee-manage.detail.total')</th>
                                                    <th></th>
                                                    <th id="total-bonus-detail-employee-manage">0
                                                    </th>
                                                    <th id="total-punish-detail-employee-manage">0
                                                    </th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab2-employee-manage-detail"
                                     role="tabpanel" aria-expanded="false">
                                    <div class="card">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="table-employee-manage-detail-tab2">
                                                <thead>
                                                <tr>
                                                    <th>@lang('app.employee-manage.detail.stt')</th>
                                                    <th>@lang('app.employee-manage.detail.code')</th>
                                                    <th>@lang('app.employee-manage.detail.amount')</th>
                                                    <th>@lang('app.employee-manage.detail.create')</th>
                                                    <th>@lang('app.employee-manage.detail.action')</th>
                                                </tr>
                                                <tr>
                                                    <th>@lang('app.employee-manage.detail.total')</th>
                                                    <th></th>
                                                    <th id="total-amount-bill-detail-employee-manage">0</th>
                                                    <th></th>
                                                    <th></th>
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
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@include('treasurer.employee_bonus_punish.detail')
@push('scripts')
    <script type="text/javascript" src="{{asset('/js/manage/employee/detail.js?version=1' ,env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
