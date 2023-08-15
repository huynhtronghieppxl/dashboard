<div class="modal fade" id="modal-combo-food-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.food-manage.combo.title') "<span class="font-1-em" id="name-combo-food-manage"></span>"</h4>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-modal-combo-food-manage">
                <div class="row">
                    <div class="col-sm-6  edit-flex-auto-fill">
                        <div class="card flex-sub">
                            <div class="card-block">
                                <h5 class="sub-title">@lang('app.food-manage.combo.title-left')</h5>
                            </div>
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table id="table-all-combo-food-manage" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>@lang('app.food-manage.combo.stt')</th>
                                                <th>@lang('app.food-manage.combo.avatar')</th>
                                                <th>@lang('app.food-manage.combo.name')</th>
                                                <th>@lang('app.food-manage.combo.category')</th>
                                                <th>@lang('app.food-manage.combo.amount')</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 edit-flex-auto-fill">
                        <div class="card flex-sub">
                            <div class="card-block">
                                <h5 class="sub-title">@lang('app.food-manage.combo.title-right')</h5>
                            </div>
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table id="table-selected-combo-food-manage" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>@lang('app.food-manage.combo.avatar')</th>
                                                <th>@lang('app.food-manage.combo.name')</th>
                                                <th>@lang('app.food-manage.combo.category')</th>
                                                <th>@lang('app.food-manage.combo.amount')</th>
                                                <th>Số lượng</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled waves-effect" onclick="closeModalComboFoodManage()"
                        onkeypress="closeModalComboFoodManage()"
                        title="@lang('app.component.title-button.close')">@lang('app.component.button.close')</button>
                <button type="button" class="btn btn-grd-primary waves-effect" onclick="saveModalComboFoodManage()"
                        onkeypress="saveModalComboFoodManage()"
                        title="@lang('app.component.title-button.save')">@lang('app.component.button.save')</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/food/brand/combo.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
