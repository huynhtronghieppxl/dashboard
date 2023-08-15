<div class="modal fade" id="modal-detail-material-data" data-keyboard="false" data-backdrop="static" style="z-index: 999999999 !important;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id='content-material-update'>
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.material-data.detail.title')</h4>
                <div class="d-flex align-items-center">
                    <h5 class="m-0" id="status-detail-material-data"></h5>
                    <button type="button" class="close ml-4" onclick="closeModalDetailMaterialData()" onkeypress="closeModalDetailMaterialData()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body text-left" id="loading-modal-detail-material">
                <div class="card-block card m-0">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.material-data.detail.name')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                id="name-detail-material-data"></h6>
                        </div>
                        <div class="col-lg-4 col-md-6 ">
                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.material-data.detail.category')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                id="type-detail-material-data"></h6>
                        </div>
                        <div class="col-lg-4 col-md-6 ">
                            <p class="mb-1 f-w-600 col-form-label-fz-15">Danh mục nguyên liệu</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                id="category-detail-material-data"></h6>
                        </div>
                        <div class="col-lg-4 col-md-6 ">
                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.material-data.detail.unit')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                id="unit-detail-material-data"></h6>
                        </div>
                        <div class="col-lg-4 col-md-6 ">
                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.material-data.detail.specifications')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                id="specifications-detail-material-data"></h6>
                        </div>
                        <div class="col-lg-4 col-md-6 ">
                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.material-data.detail.code')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15" style="word-break: break-all;"
                                id="code-detail-material-data"></h6>
                        </div>
                        <div class="col-lg-4 col-md-6 ">
                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.material-data.detail.price')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                id="price-detail-material-data"></h6>
                        </div>
                        <div class="col-lg-4 col-md-6 ">
                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.material-data.detail.min')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                id="min-detail-material-data"></h6>
                        </div>
                        <div class="col-lg-4 col-md-6 ">
                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.material-data.detail.loss')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                id="loss-detail-material-data"></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.material-data.detail.des')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                id="des-detail-material-data"></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h5 class="sub-title mb-1 ml-0">Danh sách đơn vị bán</h5>
                            <div class="table-responsive new-table">
                                <table id="table-selling-unit-detail" class="table">
                                    <thead>
                                    <tr>
                                        <th>Đơn vị bán</th>
                                        <th>Giá trị chuyển đổi</th>
                                        <th class="text-right ">Giá vốn</th>
                                        <th class="text-left sorting_disabled text-left">Mô tả</th>
                                    </tr>
                                    </thead>
                                </table>
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
    <script type="text/javascript" src="{{ asset('js\build_data\material\material\detail.js?version=6', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
