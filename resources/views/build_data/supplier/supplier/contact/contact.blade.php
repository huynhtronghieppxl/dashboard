<div class="modal fade" id="modal-contact-supplier-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.supplier-data.supplier.contact.title')</h4>
                <div class="d-flex align-items-center">
                    <label class="label label-lg" id="status-text-detail"></label>
                    <button type="button" class="close ml-4" onclick="closeModalContactSupplierData()" onkeypress="closeModalContactSupplierData()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body" id="loading-modal-contact-supplier-data">
                <div class="card card-block m-0">
                    <div class="table-responsive new-table">
                        <div class="select-filter-dataTable mr-1">
                            <div class="form-validate-select">
                                <div class="pr-0 select-material-box">
                                    <select class="js-example-basic-single"
                                            id="select-contact-supplier">
                                        <option value="-1"
                                                selected>@lang('app.supplier-data.supplier.contact.status')</option>
                                        <option value="1">@lang('app.supplier-data.supplier.contact.tab1')</option>
                                        <option value="0">@lang('app.supplier-data.supplier.contact.tab2')</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table class="table" id="table-contact-supplier">
                            <thead>
                            <tr>
                                <th>@lang('app.supplier-data.supplier.contact.table-contact.stt')</th>
                                <th>@lang('app.supplier-data.supplier.contact.table-contact.name-contact')</th>
                                <th>@lang('app.supplier-data.supplier.contact.table-contact.phone-contact')</th>
                                <th>@lang('app.supplier-data.supplier.contact.table-contact.email')</th>
                                <th>@lang('app.supplier-data.supplier.contact.table-contact.role')</th>
                                <th>@lang('app.supplier-data.supplier.contact.status')</th>
                                <th></th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-instagram d-none" id="detail-bill-liabilities"
                        onclick="detailModalDetailBillLiabilities()"
                        onkeypress="detailModalDetailBillLiabilities()">@lang('app.bill-liabilities.detail.detail')</button>
            </div>
        </div>
    </div>
</div>
@include('build_data.supplier.supplier.contact.create')
@include('build_data.supplier.supplier.contact.update')

@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/supplier/supplier/contact/contact.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
