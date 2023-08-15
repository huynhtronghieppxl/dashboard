<div class="modal fade" id="modal-create-checklist-goods-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.checklist-goods-manage.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateCheckListGoodsManage()" onkeypress="closeModalCreateCheckListGoodsManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left background-body-color" id="loading-modal-create-checklist-goods-manage">
                <div class="row">
                    <div class="col-lg-8 edit-flex-auto-fill pr-0">
                        <div class="card card-block flex-sub w-100 my-1 mr-0" id="box-list-one-create-checklist-goods-manage">
                            <h5 class="sub-title">@lang('app.checklist-goods-manage.create.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-material-create-checklist-goods-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.checklist-goods-manage.confirm.stt')</th>
                                        <th>@lang('app.checklist-goods-manage.confirm.name')</th>
                                        <th>@lang('app.checklist-goods-manage.confirm.system')</th>
                                        <th>@lang('app.checklist-goods-manage.confirm.confirm')</th>
                                        <th>@lang('app.checklist-goods-manage.confirm.difference')</th>
                                        <th>@lang('app.checklist-goods-manage.confirm.note')</th>
                                        <th></th>
                                        <th class="text-center d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill pl-0">
                        <div class="card card-block flex-sub w-100 my-1" id="box-list-create-checklist-goods-manage">
                            <h5 class="sub-title">@lang('app.checklist-goods-manage.create.title-right')</h5>
                            <div class="form-group select2_theme validate-group m-t-10">
                                <div class="form-validate-select">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="select-inventory-create-checklist-goods-manage"
                                                    class="select-not-select2 select2-hidden-accessible" tabindex="-1"
                                                    aria-hidden="true">
                                                <option value="1"
                                                        selected>@lang('app.checklist-goods-manage.create.title1')</option>
                                                <option
                                                    value="2">@lang('app.checklist-goods-manage.create.title2')</option>
                                                <option
                                                    value="3">@lang('app.checklist-goods-manage.create.title3')</option>
                                                <option
                                                    value="12">@lang('app.checklist-goods-manage.create.title4')</option>
                                            </select>
                                            <label class="icon-validate">
                                                @lang('app.checklist-goods-manage.create.inventory')
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
                                        class="f-w-600">@lang('app.checklist-goods-manage.create.checklist-date')</label>
                                    <label class="f-w-400" id="checklist-date-create-checklist-goods-manage"></label>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600">@lang('app.checklist-goods-manage.create.date')</label>
                                    <label class="f-w-400"
                                           id="date-create-checklist-goods-manage">{{date('d/m/Y')}}</label>
                                </div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea class="form__field" id="note-create-checklist-goods-manage" cols="5" rows="3" data-note-max-length="255"></textarea>
                                        <label for="note-create-checklist-goods-manage" class="form__label icon-validate">
                                            @lang('app.checklist-goods-manage.create.note')
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
                <button type="button" class="btn-renew d-none" onclick="resetModalCreateCheckListGoodsManage()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalCreateCheckListGoodsManage()" onkeypress="saveModalCreateCheckListGoodsManage()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>

            </div>
        </div>
    </div>
</div>
@include('manage.inventory.checklist_goods.unfinished_order')
@include('manage.inventory.out_inventory_branch.detail')
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/inventory/checklist_goods/create.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
