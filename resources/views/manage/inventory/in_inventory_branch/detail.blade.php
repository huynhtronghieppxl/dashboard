<div class="modal fade" id="modal-detail-in-inventory-branch-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.in-inventory-branch-manage.detail.title')</h4>
                <div class="d-flex align-items-center">
                    <h5 class="m-0" id="status-detail-in-inventory-branch-manage"></h5>
                    <button type="button" class="close ml-4" onclick="closeModalDetailInInventoryBranchManage()" onkeypress="closeModalDetailInInventoryBranchManage()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body text-left background-body-color"
                 id="loading-modal-detail-in-inventory-branch-manage">
                <div class="row">
                    <div class="col-lg-8 edit-flex-auto-fill pl-0 ">
                        <div class="card card-block flex-sub my-1">
                            <h5 class="text-bold sub-title f-w-600 col-form-label-fz-15 ml-0">@lang('app.in-inventory-branch-manage.detail.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table id="table-material-detail-in-inventory-branch-manage" class="table"
                                       aria-describedby="">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.in-inventory-branch-manage.detail.stt')</th>
                                        <th>@lang('app.in-inventory-branch-manage.detail.name')</th>
                                        <th>@lang('app.in-inventory-branch-manage.detail.quantity')</th>
                                        <th>@lang('app.in-inventory-branch-manage.detail.price')</th>
                                        <th>@lang('app.in-inventory-branch-manage.detail.total-price')</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub my-1" id="list-box-detail-in-inventory-branch-manage">
                            <h5 class="text-bold sub-title f-w-600 col-form-label-fz-15">@lang('app.in-inventory-branch-manage.detail.title-right')</h5>
                            <div class="d-none" id="confirmed-detail-in-inventory-branch-manage">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-branch-manage.detail.branch')</label>
                                        <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="branch-detail-in-inventory-branch-manage"></h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-branch-manage.detail.code_in')</label>
                                        <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="code-in-detail-in-inventory-branch-manage"></h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-branch-manage.detail.inventory')</label>
                                        <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="inventory-detail-in-inventory-branch-manage"></h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-branch-manage.detail.code_out')</label>
                                        <h6 class="f-w-400 col-form-label-fz-15 text-muted class-link" id="code-out-detail-in-inventory-branch-manage"></h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-branch-manage.detail.target')</label>
                                        <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="target-detail-in-inventory-branch-manage"></h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-branch-manage.detail.delivery')</label>
                                        <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="date-detail-in-inventory-branch-manage"></h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label class="f-w-600 col-form-label-fz-15 mb-0">@lang('app.in-inventory-branch-manage.detail.employee')</label>
                                        <div class="d-flex mb-1">
                                            <img class="image-size-detail img-radius" src="/images/tms/default.jpeg" id="image-employee-create-detail-in-inventory-branch-manage" onerror="this.src='/images/tms/default.jpeg'">
                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 class-link" id="employee-create-detail-in-inventory-branch-manage" style="margin: auto 5px"></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="div-employee-confirm-detail-in-inventory-branch-manage">
                                    <div class="col-lg-6 col-form-label-fz-15 ">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-branch-manage.detail.employee-confirm')</label>
                                        <div class="d-flex mb-1">
                                            <img class="image-size-detail img-radius" src="/images/tms/default.jpeg" id="image-employee-confirm-detail-in-inventory-branch-manage" onerror="this.src='/images/tms/default.jpeg'">
                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 class-link" id="employee-confirm-detail-in-inventory-branch-manage" style="margin: auto 5px"></h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-branch-manage.detail.confirm')</label>
                                        <h6 class="f-w-400 col-form-label-fz-15 text-muted mt-2" id="confirm-detail-in-inventory-branch-manage">
                                        </h6>
                                    </div>
                                </div>
                                <div class="row d-none" id="div-cancel-detail-in-inventory-branch-manage">
                                    <div class="col-lg-6">
                                        <label class="f-w-600 col-form-label-fz-15 mb-0">@lang('app.in-inventory-branch-manage.detail.employee-cancel')</label>
                                        <div class="d-flex mb-1">
                                            <img class="image-size-detail img-radius" src="/images/tms/default.jpeg" id="image-employee-cancel-detail-in-inventory-branch-manage" onerror="this.src='/images/tms/default.jpeg'">
                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill class-link" id="employee-cancel-detail-in-inventory-branch-manage" style="margin: auto 5px"></h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-branch-manage.detail.cancel')</label>
                                        <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="cancel-detail-in-inventory-branch-manage">
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div id="waiting-detail-in-inventory-branch-manage">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-branch-manage.detail.branch')</label>
                                        <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="branch-detail-waiting-in-inventory-branch-manage"></h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-branch-manage.detail.code_out')</label>
                                        <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="code-in-detail-waiting-in-inventory-branch-manage"></h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-branch-manage.detail.inventory')</label>
                                        <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="inventory-detail-waiting-in-inventory-branch-manage"></h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-branch-manage.detail.target')</label>
                                        <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="import-branch-detail-waiting-in-inventory-branch-manage"></h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label class="f-w-600 col-form-label-fz-15 mb-0">@lang('app.in-inventory-branch-manage.detail.employee')</label>
                                        <div class="d-flex mb-1">
                                            <img class="image-size-detail img-radius" src="" id="image-employee-create-detail-waiting-in-inventory-branch-manage" onerror="this.src='/images/tms/default.jpeg'">
                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 class-link" id="employee-create-detail-waiting-in-inventory-branch-manage" style="margin: auto 5px"></h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-branch-manage.detail.create')</label>
                                        <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="date-detail-waiting-in-inventory-branch-manage"></h6>
                                    </div>
                                </div>
                                <div class="row d-none" id="cancel-reason-detail-in-inventory-branch-manage-div">
                                    <div class="col-lg-12">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-branch-manage.detail.cancel-reason')</label>
                                        <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="cancel-reason-detail-in-inventory-branch-manage">
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="note-detail-in-inventory-branch-manage-div">
                                <div class="col-lg-12" >
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-branch-manage.detail.note')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="note-detail-in-inventory-branch-manage"></h6>
                                </div>
                            </div>
                            <div class="border-dashed"></div>
                            <div class="row mt-2">
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-branch-manage.detail.total-price')</label>
                                    <label class="f-w-600 col-form-label-fz-15 f-right"
                                           id="total-price-detail-in-inventory-branch-manage"></label>
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
{{--@include('build_data.material.material.detail')--}}
@include('manage.inventory.out_inventory_branch.detail')
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/inventory/in_inventory_branch/detail.js?version=2',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
