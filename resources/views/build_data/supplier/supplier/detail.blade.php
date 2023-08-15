<div class="modal fade" id="modal-detail-supplier-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.supplier-data.supplier.detail.title')</h4>
                <div class="d-flex">
                    <h5 id="status-detail-supplier-data"></h5>
                    <button type="button" class="close ml-4" onclick="closeModalDetailSupplierData()" onkeypress="closeModalDetailSupplierData()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-modal-detail-supplier-data">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card m-3">
                            <ul class="nav nav-tabs md-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab0-detail-supplier-data"
                                       role="tab"
                                       aria-expanded="true">@lang('app.supplier-data.supplier.detail.tab0.title') </a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab1-detail-supplier-data"
                                       role="tab"
                                       aria-expanded="true">@lang('app.supplier-data.supplier.detail.tab1.title') <span
                                            class="label label-primary" id="total-record-contact-supplier-data"></span></a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab2-detail-supplier-data" role="tab"
                                       aria-expanded="false">@lang('app.supplier-data.supplier.detail.tab2.title') <span
                                                class="label label-warning"
                                                id="total-record-liabilities-supplier-data"></span></a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab3-detail-supplier-data" role="tab"
                                       aria-expanded="false">@lang('app.supplier-data.supplier.detail.tab3.title') <span
                                                class="label label-success" id="total-record-material-supplier-data"></span></a>
                                    <div class="slide"></div>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content card-block">
                                <div class="tab-pane active" id="tab0-detail-supplier-data" role="tabpanel" aria-expanded="true">
                                    <div class="card m-3">
                                        <div class="card-block row">
                                            <div class="col-sm-12 col-lg-6 row">
                                                <div class="col-lg-12 form-group row">
                                                    <label class="col-sm-4 ">@lang('app.supplier-data.supplier.detail.name')</label>
                                                    <div class="col-sm-8">
                                                        :&emsp;<label id="name-detail-supplier-data"></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 form-group row">
                                                    <label class="col-sm-4">@lang('app.supplier-data.supplier.detail.prefix')</label>
                                                    <div class="col-sm-8">
                                                        :&emsp;<label id="prefix-detail-supplier-data"></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 form-group row">
                                                    <label class="col-sm-4">@lang('app.supplier-data.supplier.detail.phone')</label>
                                                    <div class="col-sm-8">
                                                        :&emsp;<label id="phone-detail-supplier-data"></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 form-group row">
                                                    <label class="col-sm-4">@lang('app.supplier-data.supplier.detail.address')</label>
                                                    <div class="col-sm-8">
                                                        :&emsp;<label id="address-detail-supplier-data"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-6 row">
                                                <div class="col-lg-12 form-group row">
                                                    <label class="col-sm-4">@lang('app.supplier-data.supplier.detail.website')</label>
                                                    <div class="col-sm-8">
                                                        :&emsp;<label id="website-detail-supplier-data"></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 form-group row">
                                                    <label class="col-sm-4">@lang('app.supplier-data.supplier.detail.email')</label>
                                                    <div class="col-sm-8">
                                                        :&emsp;<label id="email-detail-supplier-data"></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 form-group row">
                                                    <label class="col-sm-4">@lang('app.supplier-data.supplier.detail.tax')</label>
                                                    <div class="col-sm-8">
                                                        :&emsp;<label id="tax-detail-supplier-data"></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 form-group row">
                                                    <label class="col-sm-4">@lang('app.supplier-data.supplier.detail.description')</label>
                                                    <div class="col-sm-8">
                                                        :&emsp;<label id="description-detail-supplier-data"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab1-detail-supplier-data" role="tabpanel"
                                     aria-expanded="true">
                                    <div class="table-reponsive new-table">
                                        <table id="table-contact-detail-supplier-data" class="table">
                                            <thead>
                                            <tr>
                                                <th class="text-center " >@lang('app.supplier-data.supplier.detail.tab1.stt')</th>
                                                <th>@lang('app.supplier-data.supplier.detail.tab1.name')</th>
                                                <th>@lang('app.supplier-data.supplier.detail.tab1.phone')</th>
                                                <th>@lang('app.supplier-data.supplier.detail.tab1.email')</th>
                                                <th>@lang('app.supplier-data.supplier.detail.tab1.role')</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab2-detail-supplier-data" role="tabpanel"
                                     aria-expanded="false">
                                    <div class="table-responsive new-table">
                                        <table id="table-liabilities-detail-supplier-data" class="table">
                                            <thead>
                                            <tr>
                                                <th>@lang('app.supplier-data.supplier.detail.tab2.stt')</th>
                                                <th>@lang('app.supplier-data.supplier.detail.tab2.code')</th>
                                                <th>@lang('app.supplier-data.supplier.detail.tab2.employee')</th>
                                                <th>@lang('app.supplier-data.supplier.detail.tab2.date')</th>
                                                <th>@lang('app.supplier-data.supplier.detail.tab2.liabilities')</th>
                                                <th>@lang('app.supplier-data.supplier.detail.tab2.action')</th>
                                            </tr>
                                            <tr>
                                                <th colspan="2">@lang('app.supplier-data.supplier.detail.tab2.total')</th>
                                                <th></th>
                                                <th></th>
                                                <th id="total-liabilities-supplier-data">0</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab3-detail-supplier-data" role="tabpanel"
                                     aria-expanded="false">
                                    <div class="table-reponsive new-table">
                                        <table id="table-material-detail-supplier-data" class="table">
                                            <thead>
                                            <tr>
                                                <th>@lang('app.supplier-data.supplier.detail.tab3.stt')</th>
                                                <th>@lang('app.supplier-data.supplier.detail.tab3.name')</th>
                                                <th>@lang('app.supplier-data.supplier.detail.tab3.category')</th>
                                                <th>@lang('app.supplier-data.supplier.detail.tab3.unit')</th>
                                                <th>@lang('app.supplier-data.supplier.detail.tab3.price')</th>
                                                <th>@lang('app.supplier-data.supplier.detail.tab3.action')</th>
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
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/supplier/supplier/detail.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
