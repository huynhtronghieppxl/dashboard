<div class="modal fade" id="modal-create-inventory-warehouse-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.warehouse-manage.create.title')</h4>
                <button type="button" class="close ml-4" onclick="closeModalCreateInventoryWarehouseManage()" onkeypress="closeModalCreateInventoryWarehouseManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left background-body-color" id="loading-modal-create-inventory-warehouse-manage">
                <div class="row">
                    <div class="col-lg-8 edit-flex-auto-fill pl-0">
                        <div class="card card-block flex-sub w-100 my-1" id="box-list-one-create-inventory-warehouse-manage">
                            <h5 class="sub-title">@lang('app.warehouse-manage.create.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-material-create-inventory-warehouse-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.warehouse-manage.confirm.stt')</th>
                                        <th class="text-left">@lang('app.warehouse-manage.confirm.name')</th>
                                        <th>@lang('app.warehouse-manage.system')</th>
                                        <th>@lang('app.warehouse-manage.confirm.confirm')</th>
                                        <th>@lang('app.warehouse-manage.confirm.difference')</th>
                                        <th>@lang('app.warehouse-manage.confirm.note')</th>
                                        <th></th>
                                        <th class="text-center d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub w-100 my-1" id="box-list-create-inventory-warehouse-manage">
                            <h5 class="sub-title">@lang('app.warehouse-manage.create.title-right')</h5>
                            <div class="form-group select2_theme validate-group m-t-10">
                                <div class="form-validate-select">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="select-inventory-create-inventory-warehouse-manage"
                                                    class="select-not-select2 select2-hidden-accessible" tabindex="-1"
                                                    aria-hidden="true">
                                                <option value="1"
                                                        selected>@lang('app.warehouse-manage.create.title1')</option>
                                                <option
                                                    value="2">@lang('app.warehouse-manage.create.title2')</option>
                                                <option
                                                    value="3">@lang('app.warehouse-manage.create.title3')</option>
                                                <option
                                                    value="12">@lang('app.warehouse-manage.create.title4')</option>
                                            </select>
                                            <label class="icon-validate">
                                                @lang('app.warehouse-manage.create.inventory')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600">@lang('app.warehouse-manage.create.checklist-date')</label>
                                    <label class="f-w-400" id="checklist-date-create-inventory-warehouse-manage"></label>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600">@lang('app.warehouse-manage.create.date')</label>
                                    <label class="f-w-400"
                                           id="date-create-inventory-warehouse-manage">{{date('d/m/Y')}}</label>
                                </div>
                            </div>

                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea class="form__field" id="note-create-inventory-warehouse-manage" data-note-max-length="255" cols="5" rows="3"></textarea>
                                        <label for="note-create-inventory-warehouse-manage" class="form__label icon-validate">
                                            @lang('app.warehouse-manage.create.note')
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


{{--                <div type="button" class="btn seemt-btn-hover-gray seemt-bg-gray-w200" onclick="closeModalCreateInventoryWarehouseManage()" onkeypress="closeModalCreateInventoryWarehouseManage()">--}}
{{--                    <i class="fi-rr-cross"></i>--}}
{{--                    <span>@lang('app.component.button.close')</span>--}}
{{--                </div>--}}
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalCreateInventoryWarehouseManage()" onkeypress="saveModalCreateInventoryWarehouseManage()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>

            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="/js/manage/warehouse/inventory/create.js?version=5"></script>
@endpush
