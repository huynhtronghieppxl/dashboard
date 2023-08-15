<div class="modal fade" id="modal-create-checklist-goods-internal-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.checklist-goods-internal-manage.create.title-day')</h4>
                <button type="button" class="close" onclick="closeModalCreateCheckListGoodsInternalManage()" onkeypress="closeModalCreateCheckListGoodsInternalManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left background-body-color"
                 id="loading-modal-create-checklist-goods-internal-manage">
                <div class="row">
                    <div class="col-lg-8 edit-flex-auto-fill px-0">
                        <div class="card card-block w-100 my-1 mr-0">
                            <h5 class="text-bold sub-title f-w-600">@lang('app.checklist-goods-internal-manage.create.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table"
                                       id="table-material-create-checklist-goods-internal-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.checklist-goods-internal-manage.create.name')</th>
                                        <th>@lang('app.checklist-goods-internal-manage.create.remain-quantity')</th>
                                        <th>@lang('app.checklist-goods-internal-manage.create.quantity')</th>
                                        <th>@lang('app.checklist-goods-internal-manage.create.deficiency')</th>
                                        <th>@lang('app.checklist-goods-internal-manage.create.note')</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block w-100 my-1" id="boxlist-create-checklist-goods-internal-manage">
                            <h5 class="text-bold sub-title f-w-600">@lang('app.checklist-goods-internal-manage.create.title-right')</h5>
                            <div class="form-group select2_theme mb-2 m-t-10">
                                <div class="form-validate-select">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="select-inventory-create-checklist-goods-internal-manage"
                                                    class="select-not-select2 select2-hidden-accessible" tabindex="-1"
                                                    aria-hidden="true">
                                                <option value="1"
                                                        selected>@lang('app.checklist-goods-internal-manage.create.title1')</option>
                                                <option
                                                    value="2">@lang('app.checklist-goods-internal-manage.create.title2')</option>
                                            </select>
                                            <label class="icon-validate">
                                                @lang('app.checklist-goods-internal-manage.create.inventory')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label">@lang('app.checklist-goods-internal-manage.create.checklist-date')
                                        : <label class="f-w-400"
                                                 id="checklist-date-create-checklist-goods-internal-manage">---</label></label>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label">@lang('app.checklist-goods-internal-manage.create.date')
                                        :
                                        <label
                                            id="date-create-checklist-goods-internal-manage">{{date('d/m/Y')}}</label></label>
                                </div>
                            </div>
                            <div class="form-group validate-group m-t-10">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2 mb-2">
                                        <textarea class="form__field" rows="5" cols="6"   data-note-max-length="255"
                                                  id="note-create-checklist-goods-internal-manage"></textarea>
                                        <label for="note-create-checklist-goods-internal-manage"
                                               class="form__label icon-validate">@lang('app.checklist-goods-internal-manage.create.note')
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
                        onclick="resetModalCreateCheckListGoodsInternalManage()"
                        onkeypress="resetModalCreateCheckListGoodsInternalManage()">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                        onclick="saveModalCreateCheckListGoodsInternalManage()"
                        onkeypress="saveModalCreateCheckListGoodsInternalManage()">
                        <i class="fi-rr-disk"></i>
                        <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/inventory/checklist_goods_internal/create.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
