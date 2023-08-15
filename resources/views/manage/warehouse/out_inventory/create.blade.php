<div class="modal fade" id="modal-create-out-inventory-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.out-inventory-manage.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateOutInventoryManage()" onkeypress="closeModalCreateOutInventoryManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left background-body-color" id="loading-create-out-inventory-manage">
                <div class="row d-flex">
                    <div class="col-lg-9 edit-flex-auto-fill pl-0">
                        <div class="card-block card w-100 my-1">
                            <div class="row mb-2 justify-content-center">
                                <ul class="nav nav-tabs md-tabs col-lg-9" id="tab-create-out-inventory-manage" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active remove-draw-table tab-out-inventory" data-toggle="tab"
                                           href="#tab1-create-out-inventory-manage"
                                           role="tab"
                                           aria-expanded="false" data-type="1">@lang('app.out-inventory-manage.create.opt1')
                                            <span
                                                class="label label-success"
                                                id="total-record-material-create-out-inventory-manage">0</span></a>
                                        <div class="slide"></div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link remove-draw-table tab-out-inventory" data-toggle="tab"
                                           href="#tab2-create-out-inventory-manage"
                                           role="tab"
                                           aria-expanded="false" data-type="2">@lang('app.out-inventory-manage.create.opt2')
                                            <span
                                                class="label label-warning"
                                                id="total-record-goods-create-out-inventory-manage">0</span></a>
                                        <div class="slide"></div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link remove-draw-table tab-out-inventory" data-toggle="tab"
                                           href="#tab3-create-out-inventory-manage"
                                           role="tab"
                                           aria-expanded="false" data-type="3">@lang('app.out-inventory-manage.create.opt3')
                                            <span
                                                class="label label-primary"
                                                id="total-record-internal-create-out-inventory-manage">0</span></a>
                                        <div class="slide"></div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link remove-draw-table tab-out-inventory" data-toggle="tab"
                                           href="#tab4-create-out-inventory-manage"
                                           role="tab" aria-expanded="false"
                                           data-type="4">@lang('app.out-inventory-manage.create.opt4') <span
                                                class="label label-inverse"
                                                id="total-record-other-create-out-inventory-manage">0</span></a>
                                        <div class="slide"></div>
                                    </li>
                                </ul>
                                <div class="col-3 text-right pr-0">
                                    <h5> <i class="fa fa-exclamation-triangle text-danger pointer" data-toggle="tooltip" data-placement="top" data-original-title="Cảnh báo: Nguyên liệu tồn kho bằng 0 không cho phép xuất kho"></i> Tồn kho = 0</h5>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1-create-out-inventory-manage" role="tabpanel">
                                    <div class="table-responsive new-table">
                                        <div class="select-filter-dataTable">
                                            <div class="form-validate-select">
                                                <div class="pr-0 select-material-box">
                                                    <select class="js-example-basic-single"
                                                            id="select-material-create-out-inventory-manage"
                                                            data-validate="">
                                                    </select>
                                                    <div class="line"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <table class="table" id="table-material-create-out-inventory-manage">
                                            <thead>
                                            <tr>
                                                <th>@lang('app.out-inventory-manage.create.stt')</th>
                                                <th>@lang('app.out-inventory-manage.create.name')</th>
                                                <th>@lang('app.out-inventory-manage.create.remain-quantity')</th>
                                                <th>@lang('app.out-inventory-manage.create.unit')</th>
                                                <th>@lang('app.out-inventory-manage.create.quantity')</th>
                                                <th></th>
                                                <th class="text-center d-none"></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab2-create-out-inventory-manage" role="tabpanel">
                                    <div class="table-responsive new-table">
                                        <div class="select-filter-dataTable">
                                            <div class="form-validate-select">
                                                <div class="pr-0 select-material-box">
                                                    <select class="js-example-basic-single"
                                                            id="select-goods-create-out-inventory-manage"
                                                            data-validate="">
                                                    </select>
                                                    <div class="line"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <table class="table" id="table-goods-create-out-inventory-manage">
                                            <thead>
                                            <tr>
                                                <th>@lang('app.out-inventory-manage.create.stt')</th>
                                                <th>@lang('app.out-inventory-manage.create.name')</th>
                                                <th>@lang('app.out-inventory-manage.create.remain-quantity')</th>
                                                <th>@lang('app.out-inventory-manage.create.unit')</th>
                                                <th>@lang('app.out-inventory-manage.create.quantity')</th>
                                                <th></th>
                                                <th class="text-center d-none"></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab3-create-out-inventory-manage" role="tabpanel">
                                    <div class="table-responsive new-table">
                                        <div class="select-filter-dataTable">
                                            <div class="form-validate-select">
                                                <div class="pr-0 select-material-box">
                                                    <select class="js-example-basic-single"
                                                            id="select-internal-create-out-inventory-manage"
                                                            data-validate="">
                                                    </select>
                                                    <div class="line"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <table class="table" id="table-internal-create-out-inventory-manage">
                                            <thead>
                                            <tr>
                                                <th>@lang('app.out-inventory-manage.create.stt')</th>
                                                <th>@lang('app.out-inventory-manage.create.name')</th>
                                                <th>@lang('app.out-inventory-manage.create.remain-quantity')</th>
                                                <th>@lang('app.out-inventory-manage.create.unit')</th>
                                                <th>@lang('app.out-inventory-manage.create.quantity')</th>
                                                <th></th>
                                                <th class="text-center d-none"></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab4-create-out-inventory-manage" role="tabpanel">
                                    <div class="table-responsive new-table">
                                        <div class="select-filter-dataTable">
                                            <div class="form-validate-select">
                                                <div class="pr-0 select-material-box">
                                                    <select class="js-example-basic-single"
                                                            id="select-other-create-out-inventory-manage"
                                                            data-validate="">
                                                    </select>
                                                    <div class="line"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <table class="table" id="table-other-create-out-inventory-manage">
                                            <thead>
                                            <tr>
                                                <th>@lang('app.out-inventory-manage.create.stt')</th>
                                                <th>@lang('app.out-inventory-manage.create.name')</th>
                                                <th>@lang('app.out-inventory-manage.create.remain-quantity')</th>
                                                <th>@lang('app.out-inventory-manage.create.unit')</th>
                                                <th>@lang('app.out-inventory-manage.create.quantity')</th>
                                                <th></th>
                                                <th class="text-center d-none"></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 edit-flex-auto-fill px-0">
                        <div class="card-block card flex-sub my-1">
                            <h5 class="text-bold sub-title col-form-label-fz-15 f-w-600">@lang('app.out-inventory-manage.create.title-right')</h5>
                            <div class="form-group validate-group m-t-10">
                                <div class="form-validate-input">
                                    <input type="text" id="date-create-out-inventory-manage"
                                           class="input-sm form-control text-center input-datetimepicker p-1"
                                           value="{{date('d/m/Y')}}">
                                    <label>
                                        <i class="icofont icofont-ui-calendar"></i>@lang('app.out-inventory-manage.create.delivery')
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select ">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="select-inventory-target-create-out-inventory-manage"
                                                    class="select-not-select2 select2-hidden-accessible" tabindex="-1"
                                                    aria-hidden="true">
                                                <option value="2"
                                                        selected>@lang('app.out-inventory-manage.create.export-target-1')</option>
                                                <option
                                                    value="1">@lang('app.out-inventory-manage.create.export-target-2')</option>
                                                <option
                                                    value="3">@lang('app.out-inventory-manage.create.export-target-3')</option>
                                                <option
                                                    value="4">@lang('app.out-inventory-manage.create.export-target-4')</option>
                                            </select>
                                            <label>
                                                <i class="icofont icofont icofont-user-alt-3"></i>@lang('app.out-inventory-manage.create.inventory-target')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group m-t-10">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2 mb-2">
                                        <textarea class="form__field" rows="5" cols="6" data-note-max-length="255"                                                  id="note-create-out-inventory-manage"></textarea>
                                        <label for="note-create-out-inventory-manage"
                                               class="form__label icon-validate"><i class="fa fa-pencil-square-o pr-1"></i>@lang('app.out-inventory-manage.create.note')
                                        </label>
                                        <div class="textarea-character">
                                            <span>0/300</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none"
                        onclick="resetModalCreateOutInventoryManage()"
                        onkeypress="resetModalCreateOutInventoryManage()">
                    <i class="fa fa-eraser"></i>
                </button>
                <button type="button"
                        class="btn btn-grd-primary" onclick="saveModalCreateOutInventoryManage()"
                        title="@lang('app.out-inventory-manage.create.title-save')"
                        onkeypress="saveModalCreateOutInventoryManage()">@lang('app.component.button.save')
                </button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('..\js\manage\inventory\out_inventory\create.js?version=6')}}"></script>

@endpush
