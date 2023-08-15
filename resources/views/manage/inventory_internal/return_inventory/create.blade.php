<div class="modal fade" id="modal-create-return-inventory-internal-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.return-inventory-internal-manage.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateReturnInventoryInternalManage()" onkeypress="closeModalCreateReturnInventoryInternalManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left background-body-color"
                 id="loading-create-return-inventory-internal-manage">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill p-0">
                        <div class="card card-block w-100 my-1 mr-0">
                            <h5 class="text-bold sub-title f-w-600">@lang('app.return-inventory-internal-manage.create.title-left')</h5>
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single"
                                                    id="select-material-create-return-inventory-internal-manage">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table class="table"
                                       id="table-material-create-return-inventory-internal-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.return-inventory-internal-manage.create.stt')</th>
                                        <th>@lang('app.return-inventory-internal-manage.create.name')</th>
                                        <th>@lang('app.return-inventory-internal-manage.create.system-last-quantity')</th>
                                        <th>@lang('app.return-inventory-internal-manage.create.unit')</th>
                                        <th>@lang('app.return-inventory-internal-manage.create.quantity-material')</th>
                                        <th>@lang('app.return-inventory-internal-manage.create.note')</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block w-100 my-1">
                            <h5 class="text-bold sub-title f-w-600">@lang('app.return-inventory-internal-manage.create.title-right')</h5>
                            <div class="form-group select2_theme validate-group m-t-10">
                                <div class="form-validate-select">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="select-inventory-target-create-return-inventory-internal-manage"
                                                    class="select-not-select2 js-example-basic-single" tabindex="-1"
                                                    aria-hidden="true">
                                                <option value="2" data-value="1"
                                                        selected>@lang('app.out-inventory-manage.create.export-target-1')</option>
                                                <option data-value="0"
                                                    value="1">@lang('app.out-inventory-manage.create.export-target-2')</option>
                                                <option data-value="3"
                                                    value="3">@lang('app.out-inventory-manage.create.export-target-3')</option>
                                                <option data-value="4"
                                                    value="4">@lang('app.out-inventory-manage.create.export-target-4')</option>
                                            </select>
                                            <label class="icon-validate">
                                                @lang('app.return-inventory-internal-manage.create.object')
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
                                    <input type="text" id="delivery-create-return-inventory-internal-manage"
                                           class="input-sm form-control text-center input-datetimepicker p-1"
                                           value="{{date('d/m/Y')}}">
                                    <label for="delivery-create-return-inventory-internal-manage">
                                        @lang('app.return-inventory-internal-manage.create.delivery')
                                        @include('layouts.start')
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea class="form__field" id="note-create-return-inventory-internal-manage" data-note="1" data-note-max-length="255"
                                                  cols="5" rows="5" data-note="1"></textarea>
                                        <label for="note-create-return-inventory-internal-manage"
                                               class="form__label icon-validate">
                                            @lang('app.return-inventory-internal-manage.create.note')
                                            @include('layouts.start')
                                        </label>
                                        <div class="textarea-character" id="char-count">
                                            <span>0/255</span>
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
                <button type="button" class="btn-renew d-none" data-toggle="tooltip" data-placement="top"
                        data-original-title="Đặt lại"
                        onclick="resetModalCreateReturnInventoryInternalManage()"
                        onkeypress="resetModalCreateReturnInventoryInternalManage()">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreateReturnInventoryInternalManage()"
                     onkeypress="saveModalCreateReturnInventoryInternalManage()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="/js/manage/inventory_internal/return_inventory/create.js?version=1"></script>
@endpush
