<div class="modal fade" id="modal-assign-customer-tag-for-customers" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.card-tag.assign-customer.title')</h4>
                <button type="button" class="close" onclick="closeModalAssignCustomerTagForCustomers()" onkeypress="closeModalAssignCustomerTagForCustomers()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-assign-customer-tag-for-customers">
                <div class="row">
                    <div class="col-lg-6 edit-flex-auto-fill">
                        <div class="flex-sub">
                            <div class="card card-block">
                                <h5 class="sub-title mb-4 ml-0">kHÁCH HÀNG CHƯA ĐƯỢC GÁN THẺ TAG</h5>
                                <div class="table-responsive new-table">
                                    <table id="table-assign-customer-tag-for-customers" class="table">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.card-tag.assign-customer.name')</th>
                                            <th>@lang('app.card-tag.assign-customer.phone')</th>
                                            <th>@lang('app.card-tag.assign-customer.gender')</th>
                                            <th></th>
                                            <th class="d-none"></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 edit-flex-auto-fill">
                        <div class="flex-sub">
                            <div class="card card-block">
                                <h5 class="sub-title mb-4 ml-0">kHÁCH HÀNG ĐÃ GÁN THẺ TAG</h5>
                                <div class="table-responsive new-table">
                                    <table id="table-selected-take-away" class="table">
                                        <thead>
                                        <tr>
                                            <th class="text-center m-auto">
                                            </th>
                                            <th>@lang('app.card-tag.assign-customer.name')</th>
                                            <th>@lang('app.card-tag.assign-customer.phone')</th>
                                            <th>@lang('app.card-tag.assign-customer.gender')</th>
                                            <th></th>
                                            <th class="d-none"></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalAssignCustomerTagForCustomers()" onkeypress="saveModalAssignCustomerTagForCustomers()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>

    </div>

</div>

@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/customer/customers/assign_customer.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
