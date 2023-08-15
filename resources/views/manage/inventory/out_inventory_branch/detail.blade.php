<div class="modal fade" id="modal-detail-out-inventory-internal-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.out-inventory-internal-manage.detail.title')</h4>
                <div class="d-flex align-items-center">
                    <h5 class="m-0" id="status-detail-out-inventory-internal-manage"></h5>
                    <button type="button" class="close ml-4" onclick="closeModalDetailOutInventoryInternalManage()" onkeypress="closeModalDetailOutInventoryInternalManage()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body text-left background-body-color"
                 id="loading-modal-detail-out-inventory-internal-manage">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill pl-0">
                        <div class="card card-block w-100 my-1">
                            <h5 class="f-w-600 text-bold sub-title ml-0">@lang('app.out-inventory-internal-manage.detail.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table id="table-material-detail-out-inventory-internal-manage" class="table " aria-describedby="">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.out-inventory-internal-manage.detail.stt')</th>
                                        <th>@lang('app.out-inventory-internal-manage.detail.name')</th>
                                        <th>@lang('app.out-inventory-internal-manage.detail.quantity')</th>
{{--                                        <th>@lang('app.out-inventory-internal-manage.detail.unit')</th>--}}
                                        <th>@lang('app.out-inventory-internal-manage.detail.price')</th>
                                        <th>@lang('app.out-inventory-internal-manage.detail.total-price')</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0 my-0">
                        <div class="card card-block flex-sub my-1" id="box-list-detail-out-inventory-internal-manage">
                            <h5 class="f-w-600 text-bold sub-title">@lang('app.out-inventory-internal-manage.detail.title-right')</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class=" col-form-label-fz-15 f-w-600">@lang('app.out-inventory-internal-manage.detail.branch')</label>
                                    <h6 class=" col-form-label-fz-15 f-w-400 text-muted" id="branch-detail-out-inventory-internal-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class=" col-form-label-fz-15 f-w-600">@lang('app.out-inventory-internal-manage.detail.code')</label>
                                    <h6 class=" col-form-label-fz-15 f-w-400 text-muted" id="code-detail-out-inventory-internal-manage"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class=" col-form-label-fz-15 f-w-600">@lang('app.out-inventory-internal-manage.detail.inventory')</label>
                                    <h6 class=" col-form-label-fz-15 f-w-400 text-muted" id="inventory-detail-out-inventory-internal-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class=" col-form-label-fz-15 f-w-600">@lang('app.out-inventory-internal-manage.detail.target')</label>
                                    <h6 class=" col-form-label-fz-15 f-w-400 text-muted" id="target-detail-out-inventory-internal-manage"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class=" col-form-label-fz-15 f-w-600">@lang('app.out-inventory-internal-manage.detail.delivery')</label>
                                    <h6 class=" col-form-label-fz-15 f-w-400 text-muted" id="date-detail-out-inventory-internal-manage"></h6>
                                </div>
                            </div>
                            {{--người tạo--}}
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class=" col-form-label-fz-15 f-w-600">@lang('app.out-inventory-internal-manage.detail.employee')</label><br>
                                    <div class="d-flex mb-1">
                                        <img src="" id="image-employee-create-detail-out-inventory-branch" onerror="this.src='/images/tms/default.jpeg'" class="img-radius" alt="" style="width: 2rem;height: 2rem"/>
                                        <label class="f-w-400 text-muted col-form-label-fz-15 mb-0 mt-1 ml-1 class-link" id="employee-detail-out-inventory-internal-manage"></label><br>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class=" col-form-label-fz-15 f-w-600">@lang('app.out-inventory-internal-manage.detail.create')</label>
                                    <h6 class=" col-form-label-fz-15 f-w-400 text-muted mt-2" id="create-detail-out-inventory-internal-manage"></h6>
                                </div>
                            </div>
                            {{--người xác nhận--}}
                            <div class="row d-none" id="confirmed-detail-out-inventory-internal-manage-div">
                                <div class="col-lg-6">
                                    <label id="employee-confirmed-detail-out-inventory-internal-manage-label" class=" col-form-label-fz-15 f-w-600">@lang('app.out-inventory-internal-manage.detail.employee-confirm')</label><br>
                                    <div class="d-flex mb-1">
                                        <img src="" id="image-employee-confirm-detail-out-inventory-branch" onerror="this.src='/images/tms/default.jpeg'" class="img-radius" alt="" style="width: 2rem;height: 2rem"/>
                                        <label class="f-w-400 text-muted col-form-label-fz-15 mb-0 mt-1 ml-1 class-link" id="employee-confirmed-detail-out-inventory-internal-manage"></label><br>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label id="confirmed-detail-out-inventory-internal-manage-label" class=" col-form-label-fz-15 f-w-600">@lang('app.out-inventory-internal-manage.detail.confirm')</label>
                                    <h6 class=" col-form-label-fz-15 f-w-400 text-muted mt-2" id="confirmed-detail-out-inventory-internal-manage"></h6>
                                </div>
                            </div>
                            {{--người hủy--}}
                            <div class="row d-none" id="cancel-detail-out-inventory-internal-manage-div">
                                <div class="col-lg-6">
                                    <label class=" col-form-label-fz-15 f-w-600">@lang('app.out-inventory-internal-manage.detail.employee-cancel')</label><br>
                                    <div class="d-flex mb-1">
                                        <img src="" id="image-employee-cancel-detail-out-inventory-branch" onerror="this.src='/images/tms/default.jpeg'" class="img-radius" alt="" style="width: 2rem;height: 2rem"/>
                                        <label class="f-w-400 text-muted col-form-label-fz-15 mb-0 mt-1 ml-1 class-link" id="employee-cancel-detail-out-inventory-internal-manage"></label><br>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label id="cancel-detail-out-inventory-internal-manage-label" class=" col-form-label-fz-15 f-w-600">@lang('app.out-inventory-internal-manage.detail.cancel')</label>
                                    <h6 class=" col-form-label-fz-15 f-w-400 text-muted mt-2" id="cancel-detail-out-inventory-internal-manage"></h6>
                                </div>
                            </div>
                            <div class="row d-none" id="cancel-reason-detail-out-inventory-branch-manage-div">
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.out-inventory-branch-manage.detail.cancel-reason')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="cancel-reason-detail-out-inventory-branch-manage">
                                    </h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class=" col-form-label-fz-15 f-w-600">@lang('app.out-inventory-internal-manage.detail.note')</label>
                                    <h6 class=" col-form-label-fz-15 f-w-400 text-muted" id="note-detail-out-inventory-internal-manage"></h6>
                                </div>
                            </div>
                            <div class="border-dashed"></div>
                            <div class="row justify-content-between py-2">
                                <label class="f-w-600 col-form-label-fz-15">@lang('app.out-inventory-internal-manage.detail.total')</label>
                                <h6 class="f-w-600 col-form-label-fz-15" id="total-detail-out-inventory-internal-manage">0</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@include('build_data.material.material.detail')
@push('scripts')
    <script type="text/javascript" src="{{asset('/js/manage/inventory/out_inventory_branch/detail.js?version=3',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
