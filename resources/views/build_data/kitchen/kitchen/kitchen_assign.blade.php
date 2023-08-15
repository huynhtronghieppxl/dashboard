<div class="modal fade" id="modal-kitchen-assign-employee-kitchen-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.kitchen-data.kitchen-assign.title')</h4>
                <button type="button" class="close" onclick="closeModalKitchenAssignForEmployee()"
                        onkeypress="closeModalKitchenAssignForEmployee()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-modal-kitchen-assign">
                <div class="row d-flex">
                    <div class="col-lg-6 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub mr-0" id="body-list-employee-un-assign-kitchen">
                            <h5 class="text-bold sub-title f-w-600 col-form-label-fz-15">@lang('app.kitchen-data.kitchen-assign.title-un-assign')</h5>
                            <div class="table-responsive new-table">
                                <table id="table-un-check-employee-assign-kitchen" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.kitchen-data.kitchen-assign.name')</th>
                                        <th class="text-center">@lang('app.kitchen-data.kitchen-assign.role')</th>
                                        <th class="text-center">
                                            <div class="btn-group btn-group-sm btn-click-all-left">
                                                <button type="button"
                                                        class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light   pointer"
                                                        onclick="checkAllEmployeeData()"><i
                                                            class="fi-rr-arrow-small-right "></i></button>
                                            </div>
                                        </th>
                                        <th class="text-center d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 edit-flex-auto-fill pr-0">
                        <div class="card card-block flex-sub" id="body-list-employee-assign-kitchen">
                            <div class="row sub-title align-items-center mb-1 justify-content-between">
                                <h5 style="font-size: 18px !important; margin-right: 0px"
                                    class="text-bold f-w-600 col-form-label-fz-15 mb-0">@lang('app.kitchen-data.kitchen-assign.title-assign')</h5>
                                <p class="text-warning p-t-10"
                                   style="text-transform: initial !important;">@lang('app.kitchen-data.kitchen-assign.assign-note')</p>
                            </div>
                            <div class="table-responsive new-table">
                                <table id="table-check-employee-assign-kitchen" class="table">
                                    <thead>
                                    <tr>
                                        <th>
                                            <div class="btn-group btn-group-sm btn-click-all-right">
                                                <button type="button"
                                                        class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light   pointer"
                                                        onclick="unCheckAllEmployeeData()"><i
                                                            class="fi-rr-arrow-small-left "></i></button>
                                            </div>
                                        </th>
                                        <th>@lang('app.kitchen-data.kitchen-assign.name')</th>
                                        <th class="text-center">@lang('app.kitchen-data.kitchen-assign.role')</th>
                                        <th class="text-center d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalKitchenAssignForEmployee()"
                     onkeypress="saveModalKitchenAssignForEmployee()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js/build_data/kitchen/kitchen/kitchen_assign.js?version=4', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
