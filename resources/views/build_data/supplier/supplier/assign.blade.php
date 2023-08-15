<style>
    .btn-seemt-right{
        width: 35px !important;
        height: 35px !important;
        border-radius: 50% !important;
        background-color: #F1F2F5;
        padding-left: 10px;
        color: #606060;
        font-weight: 900;
    }
</style>
<div class="modal fade" id="modal-assign-system-supplier-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pl-1">@lang('app.supplier-data.material.assign.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateSupplierMaterialData()" onkeypress="closeModalUpdateSupplierMaterialData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left py-0" id="loading-modal-detail-supplier-data">
                <div class="row">
                    <div class="edit-flex-auto-fill col-lg-4 col-sm-12 px-0">
                        <div class="card card-block flex-sub mr-0" id="table-restaurant-material-body">
                            <div class="pb-0">
                                <h5 class="sub-title ml-0 f-w-600">@lang('app.supplier-data.material.assign.sub-title-1')</h5>
                            </div>
                            <div class="table-responsive new-table">
                                <table id="table-restaurant-material-data" class="table">
                                    <thead>
                                    <tr>
                                        <th  >@lang('app.supplier-data.material.assign.name')</th>
                                        <th  >@lang('app.supplier-data.material.unit')</th>
                                        <th class="text-center">
                                            <div class="btn-group btn-group-sm" id="btn-check-all-material-supplier-data">
                                                <button type="button"  class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" onclick="checkAllSupplierMaterialData()">
                                                    <i class="fi-rr-arrow-small-right"  ></i>
                                                </button>
                                            </div>
                                        </th>
                                        <th class="text-center d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="edit-flex-auto-fill col-lg-8 col-sm-12 pr-0">
                        <div class="card card-block flex-sub" id="table-supplier-material-body">
                            <div class="pb-0 row">
                                <h5 class="col-lg-12 sub-title pl-0 ml-0 f-w-600">@lang('app.supplier-data.material.assign.sub-title-2')</h5>
                            </div>
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select2-hidden-accessible" id="select-supplier-in-supplier-material-data" data-select="1">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <table id="table-supplier-material-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>
                                            <div class="btn-group btn-group-sm">
                                                <button type="button" id="btn-uncheck-all-material-supplier-data" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light d-none" onclick="unCheckAllSupplierMaterialData()">
                                                    <i class="fi-rr-arrow-small-left" ></i>
                                                </button>
                                            </div>
                                        </th>
                                        <th>@lang('app.supplier-data.material.assign.name')</th>
                                        <th>@lang('app.supplier-data.material.assign.cost-price')</th>
                                        <th>@lang('app.supplier-data.material.assign.retail-price')</th>
                                        <th>@lang('app.supplier-data.material.assign.out-stock-quantity')</th>
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
            <div class="modal-footer ">
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="assignRestaurantMaterialData()" onkeypress="assignRestaurantMaterialData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/supplier/supplier/assign.js?version=8', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
