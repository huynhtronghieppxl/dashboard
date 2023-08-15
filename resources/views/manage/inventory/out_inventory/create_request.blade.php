<div class="modal fade" id="modal-create-request-out-inventory-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.out-inventory-manage.create-request.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateRequestOutInventoryManage()" onkeypress="closeModalCreateRequestOutInventoryManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left background-body-color" id="loading-create-request-out-inventory-manage">
                <div class="row d-flex">
                    <div class="col-lg-9 edit-flex-auto-fill pl-0">
                        <div class="card card-block flex-sub my-1 mr-0">
                            <h5 class="text-bold sub-title col-form-label-fz-15 f-w-600 ml-0">@lang('app.out-inventory-manage.create-request.title-left')</h5>
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single"
                                                    id="select-export-create-request-out-inventory-manage">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table class="table" id="table-material-create-request-out-inventory-manage">
                                    <thead>
                                    <tr>
                                        <th class="text-center">@lang('app.out-inventory-manage.create-request.stt')</th>
                                        <th class="col-name-material">@lang('app.out-inventory-manage.create-request.name')</th>
                                        <th>@lang('app.out-inventory-manage.create-request.remain-quantity')</th>
                                        <th>@lang('app.out-inventory-manage.create-request.quantity-request')</th>
                                        <th>@lang('app.out-inventory-manage.create-request.quantity')</th>
                                        <th></th>
                                        <th class="text-center d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub my-1">
                            <h5 class="text-bold sub-title col-form-label-fz-15 f-w-600">@lang('app.out-inventory-manage.create-request.title-right')</h5>
                            <div class="form-group row">
{{--                                <div class="col-lg-6">--}}
{{--                                    <label--}}
{{--                                        class="f-w-600 col-form-label-fz-15">@lang('app.out-inventory-manage.create-request.inventory')</label>--}}
{{--                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="inventory-create-request-out-inventory-manage">---</h6>--}}
{{--                                </div>--}}
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.out-inventory-manage.create-request.inventory-target')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15"
                                        id="inventory-target-create-request-out-inventory-manage">---</h6>
                                </div>
                            </div>
                            <div class="border-dashed"></div>
                            <div class="form-group validate-group m-t-15">
                                <div class="form-validate-input">
                                    <input type="text" id="date-create-request-out-inventory-manage"
                                           class="input-sm form-control text-center input-datetimepicker p-1"
                                           value="{{date('d/m/Y')}}">
                                    <label>
                                       </i>@lang('app.out-inventory-manage.create-request.delivery')
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-groupvalidate-group">
                                <div class="form-validate-checkbox">
                                    <div class="checkbox-form-group">
                                        <input type="checkbox" id="check-create-request-out-inventory-manage"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               data-trigger="hover"
                                               data-original-title="@lang('app.out-inventory-manage.create-request.check')">
                                        <label class="name-checkbox" for="print-kitchen-create-food-brand-manage">@lang('app.out-inventory-manage.create-request.check')                                      <div class="tool-tip">
                                             </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group validate-group m-t-10">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2 mb-2">
                                        <textarea class="form__field" rows="5" cols="6"   data-note-max-length="255"
                                                  id="note-create-request-out-inventory-manage"  ></textarea>
                                        <label for="note-create-request-out-inventory-manage"
                                               class="form__label icon-validate"></i>@lang('app.out-inventory-manage.create-request.note')
                                        </label>
                                        <div class="textarea-character" id="char-count">
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
                        onclick="resetDataCreateRequestOutInventoryManage()" data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại"
                        onkeypress="resetDataCreateRequestOutInventoryManage()">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreateRequestOutInventoryManage()"
                       title="@lang('app.out-inventory-manage.create-request.title-save')"
                      onkeypress="saveModalCreateRequestOutInventoryManage()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/inventory/out_inventory/create_request.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
