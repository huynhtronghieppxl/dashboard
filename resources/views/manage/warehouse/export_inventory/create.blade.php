<div class="modal fade" id="modal-create-export-inventory-warehouse" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">THÊM MỚI PHIẾU XUẤT KHO TỔNG</h4>
                <button type="button" class="close" onclick="closeModalCreateExportInventoryWarehouse()" onkeypress="closeModalCreateExportInventoryWarehouse()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left background-body-color" id="loading-create-export-inventory-warehouse">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill pl-0">
                        <div class="card card-block flex-sub my-1">
                            <div class="f-w-600 sub-title row mb-2 justify-content-center">
                                <div class="col-9 pl-0">
                                    <h5 class="text-bold f-w-600">@lang('app.out-inventory-internal-manage.create.title-left')</h5>
                                </div>
                                <div class="col-3 text-right pr-0">
                                    <h5> <i class="fa fa-exclamation-triangle text-danger pointer" data-toggle="tooltip" data-placement="top" data-original-title="Cảnh báo: Nguyên liệu tồn kho bằng 0 không cho phép xuất kho"></i> Tồn kho = 0</h5>
                                </div>
                            </div>
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single"
                                                    id="select-cate-type-parent-create-export-inventory-warehouse"
                                                    data-validate="">
                                                <option value="1"
                                                        selected>@lang('app.out-inventory-internal-manage.create.opt1')</option>
                                                <option
                                                    value="2">@lang('app.out-inventory-internal-manage.create.opt2')</option>
                                                <option
                                                    value="3">@lang('app.out-inventory-internal-manage.create.opt3')</option>
                                                <option
                                                    value="12">@lang('app.out-inventory-internal-manage.create.opt4')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single"
                                                    id="select-material-create-export-inventory-warehouse"
                                                    data-validate="">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table class="table" id="table-material-create-export-inventory-warehouse">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.out-inventory-internal-manage.create.stt')</th>
                                        <th>@lang('app.out-inventory-internal-manage.create.name')</th>
                                        <th>@lang('app.out-inventory-internal-manage.create.remain-quantity')</th>
                                        <th>@lang('app.out-inventory-internal-manage.create.unit')</th>
                                        <th>@lang('app.out-inventory-internal-manage.create.quantity')</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub my-1">
                            <h5 class="text-bold sub-title f-w-600 ml-0">@lang('app.out-inventory-internal-manage.create.title-right')</h5>
                            <div class="form-group select2_theme validate-group m-t-10">
                                <div class="form-validate-select">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="select-target-branch-create-export-inventory-warehouse"
                                                    data-select="1"
                                                    class="select-not-select2 select2-hidden-accessible" tabindex="-1"
                                                    aria-hidden="true">
                                            </select>
                                            <label class="icon-validate">@lang('app.out-inventory-internal-manage.create.target-branch')
                                                @include('layouts.start')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input type="text" id="date-create-export-inventory-warehouse"
                                           class="input-sm form-control text-center input-datetimepicker p-1"
                                           value="{{date('d/m/Y')}}" data-empty="1"/>
                                    <label for="date-create-export-inventory-warehouse">@lang('app.out-inventory-internal-manage.create.delivery')
                                        @include('layouts.start')
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea class="form__field" id="note-create-export-inventory-warehouse" data-note-max-length="255"
                                                  cols="5" rows="5"></textarea>
                                        <label for="note-create-export-inventory-warehouse"
                                               class="form__label icon-validate">@lang('app.out-inventory-internal-manage.create.note')
                                        </label>
                                        <div class="textarea-character" id="char-count">
                                            <span>0/300</span>
                                        </div>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none"
                        onclick="resetModalCreateExportInventoryWarehouse()"
                        onkeypress="resetModalCreateExportInventoryWarehouse()">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreateExportInventoryWarehouse()"
                     onkeypress="saveModalCreateExportInventoryWarehouse()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="/js/manage/warehouse/export_inventory/create.js?version=1"></script>
@endpush
