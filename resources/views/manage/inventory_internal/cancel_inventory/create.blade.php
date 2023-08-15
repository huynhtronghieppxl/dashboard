<div class="modal fade" id="modal-create-cancel-inventory-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.cancel-inventory-internal-manage.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateCancelInventoryManage()" onkeypress="closeModalCreateCancelInventoryManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left background-body-color" id="loading-create-cancel-inventory-manage">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill p-0">
                        <div class="card card-block w-100 my-1 mr-0">
                            <div class="f-w-600 sub-title row mb-2 justify-content-center">
                                <div class="col-12 pl-0">
                                    <h5 class="text-bold f-w-600" style="font-size: 20px;">@lang('app.cancel-inventory-internal-manage.create.title-left')</h5>
                                </div>
                            </div>
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single"
                                                    id="select-material-create-cancel-inventory-manage">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table class="table" id="table-material-create-cancel-inventory-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.cancel-inventory-internal-manage.create.stt')</th>
                                        <th>@lang('app.cancel-inventory-internal-manage.create.name')</th>
                                        <th>@lang('app.cancel-inventory-internal-manage.create.remain-quantity')</th>
                                        <th>@lang('app.cancel-inventory-internal-manage.create.unit')</th>
                                        <th>@lang('app.cancel-inventory-internal-manage.create.quantity')</th>
                                        <th>@lang('app.cancel-inventory-internal-manage.create.reason')</th>
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
                            <h5 class="text-bold sub-title f-w-600">@lang('app.cancel-inventory-internal-manage.create.title-right')</h5>
                            <div class="form-group select2_theme validate-group m-t-10">
                                <div class="form-validate-select">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="select-object-cancel-inventory-manage"
                                                    class="js-example-basic-single select2-hidden-accessible"
                                                    tabindex="-1" aria-hidden="true">
                                                <option data-value="0" value="1"
                                                        selected>@lang('app.out-inventory-manage.create.export-target-2')</option>
                                                <option data-value="1"
                                                        value="2">@lang('app.out-inventory-manage.create.export-target-1')</option>
                                            </select>
                                            <label class="icon-validate">
                                                @lang('app.return-inventory-manage.create.object')
                                                @include('layouts.start')</label>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input type="text" id="delivery-create-cancel-inventory-manage"
                                           class="form-control text-center input-datetimepicker p-1"
                                           value="{{date('d/m/Y')}}"/>
                                    <label for="delivery-create-cancel-inventory-manage">
                                        @lang('app.cancel-inventory-internal-manage.create.delivery')
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea class="form__field" id="note-create-cancel-inventory-manage" cols="5" data-note="1" data-note-max-length="255"
                                                  rows="5" data-note="1"></textarea>
                                        <label for="note-create-cancel-inventory-manage"
                                               class="form__label icon-validate">
                                            @lang('app.cancel-inventory-manage.create.note')
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
                <button type="button" class="btn-renew d-none" data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại"
                        onclick="resetModalCreateCancelInventoryManage()"
                        onkeypress="resetModalCreateCancelInventoryManage()">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreateCancelInventoryManage()"
                     onkeypress="saveModalCreateCancelInventoryManage()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="/js/manage/inventory_internal/cancel_inventory/create.js?version=10"></script>
@endpush
