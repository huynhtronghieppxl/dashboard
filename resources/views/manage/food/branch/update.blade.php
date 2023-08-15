<div class="modal fade" id="modal-update-food-branch-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content card-shadow-custom" id="loading-modal-update-food-manage">
            <div class="modal-header">
                <h4 class="modal-title py-2">@lang('app.food-manage.update.title')</h4>
                <div class="d-flex align-items-center">
                    <h5 class="py-2 reset-data-popup" id="update-food-manage"></h5>
                    <button type="button" class="close ml-4" onclick="closeModalCreateFoodAdditionManage()" onkeypress="closeModalCreateFoodAdditionManage()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body text-left" id="box-list-update-food-branch-manage">
                <div class="card-block" id="form-update-food">
                    <div class="mt-0">
                        <div class="row mx-1">
                            <div class="form-group col-lg-3 mb-0">
                                <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-manage.update.name')</p>
                                <h6 class="text-muted f-w-400 col-form-label-fz-15  reset-data-detail-employee-manage"
                                    id="name-update-food-branch-manage"></h6>
                            </div>
                            <div class="form-group col-lg-3 mb-0">
                                <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-manage.update.unit')</p>
                                <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-employee-manage"
                                    id="unit-update-food-branch-manage"></h6>
                            </div>
                            <div class="form-group col-lg-3 mb-0">
                                <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-manage.update.category')</p>
                                <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-employee-manage"
                                    id="category-update-food-branch-manage"></h6>
                            </div>
                            @if(Session::get(SESSION_KEY_LEVEL) > 3)
                                <div class="form-group col-lg-3 mb-0">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.food-manage.update.point')</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15  reset-data-detail-employee-manage"
                                        id="point-update-food-branch-manage"></h6>
                                </div>
                            @endif
                        </div>
                        <div class="border-dashed"></div>
                        <div class="row pt-3">
                            <div class="form-group col-lg-6 validate-group">
                                <div class="form-validate-input ">
                                    <input id="original-price-update-food-branch-manage" type="text"
                                           class="form-control text-right" data-max="999999999">
                                    <label>
                                        <i class="typcn typcn-document-text"></i>
                                        @lang('app.food-manage.update.original-price')
                                    </label>

                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group col-lg-6 validate-group">
                                <div class="form-validate-input">
                                    <input id="price-update-food-branch-manage" type="text"
                                           class="form-control text-right" data-money="1" data-max="999999999">
                                    <label>
                                        <i class="typcn typcn-document-text"></i>
                                        @lang('app.food-manage.update.price')
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group row col-lg-12" id="take-away-update-food-branch-manage" style="margin-bottom: 0px !important;">
                                <label
                                    class="col-lg-4 col-form-label">@lang('app.food-branch-manage.create.take-away')</label>
                                <div class="col-lg-12">
                                    <div class="form-radio">
                                        <form class="row">
                                            <div class="radio radio-inline col-sm-4">
                                                <label>
                                                    <input type="radio" name='take' value="0" checked>
                                                    <i class="helper"></i>@lang('app.food-branch-manage.create.option-no-take-away')
                                                </label>
                                            </div>
                                            <div class="radio radio-inline col-sm-4">
                                                <label>
                                                    <input type="radio" name='take' value="1">
                                                    <i class="helper"></i>@lang('app.food-branch-manage.create.option-take-away')
                                                </label>
                                            </div>
                                            <div class="radio radio-inline col-sm-4">
                                                <label>
                                                    <input type="radio" name='take' value="2">
                                                    <i class="helper"></i>@lang('app.food-branch-manage.create.option-take-all')
                                                </label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-block d-none" id="form-update-food-combo">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="card card-block mt-0">
                                <div class="form-group row mx-1 d-none">
                                    <table class="table table-bordered"
                                           id="update-table-food-update-combo-food-manage">
                                        <thead>
                                        <tr>
                                            <th>Tên chi nhánh</th>
                                            <th>Bếp</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group row">
                                <label
                                    class="col-lg-4 col-form-label">@lang('app.food-manage.update.name')</label>
                                <div class="col-lg-8 col-form-label">
                                    <input id="name-combo-update-food-manage" type="text"
                                           class="form-control text-left" data-not-empty>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-lg-4 col-form-label">@lang('app.food-manage.update.code')</label>
                                <div class="col-lg-8 col-form-label">
                                    <label id="code-combo-update-food-manage"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-lg-4 col-form-label">@lang('app.food-manage.update.description')</label>
                                <div class="col-lg-8">
                                            <textarea id="description-combo-update-food-manage" class="form-control"
                                                      rows="7"
                                                      cols="5" data-validate="note"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group row">
                                <label
                                    class="col-lg-4 col-form-label">@lang('app.food-manage.update.price')</label>
                                <div class="col-lg-8">
                                    <input id="price-combo-update-food-manage" type="text"
                                           class="form-control text-right"
                                           data-type="currency-edit" placeholder="0"
                                           data-validate="price">
                                </div>
                            </div>
                            @if(Session::get('KEY_TMS') == 1)
                                <div class="form-group row">
                                    <label
                                        class="col-lg-4 col-form-label">@lang('app.food-manage.update.point')</label>
                                    <div class="col-lg-8 col-form-label">
                                        <label id="point-combo-update-food-manage"
                                               class="float-right">0</label>
                                    </div>
                                </div>
                            @endif
                            <div
                                class="form-group row hidden-item class-food-update-food-manage class-combo-update-food-manage class-addition-update-food-manage d-none">
                                <label
                                    class="col-lg-4 col-form-label">@lang('app.food-manage.update.point-method')</label>
                                <div class="col-lg-8">
                                    <select id="point-method-combo-update-food-manage"
                                            class="js-example-basic-single">
                                        <option value="0"
                                                selected>@lang('app.food-manage.update.option-bill-point-method')</option>
                                        <option
                                            value="1">@lang('app.food-manage.update.option-order-point-method')</option>
                                    </select>
                                </div>
                            </div>
                            @if(Session::get('KEY_TMS') == 1)
                                <div
                                    class="form-group row hidden-item class-food-update-food-manage class-combo-update-food-manage class-addition-update-food-manage d-none">
                                    <label
                                        class="col-lg-4 col-form-label">@lang('app.food-manage.update.party')</label>
                                    <div class="col-lg-8">
                                        <select id="party-combo-update-food-manage"
                                                class="js-example-basic-single">
                                            <option value="1"
                                                    selected>@lang('app.food-manage.update.option-yes-party')</option>
                                            <option
                                                value="0">@lang('app.food-manage.update.option-no-party')</option>
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row">
                                <label
                                    class="col-lg-4 col-form-label">@lang('app.food-manage.update.take-away')</label>
                                <div class="col-lg-8">
                                    <select id="take-away-combo-update-food-manage"
                                            class="js-example-basic-single">
                                        <option value="0"
                                                selected>@lang('app.food-manage.update.option-no-take-away')</option>
                                        <option
                                            value="1">@lang('app.food-manage.update.option-take-away')</option>
                                        <option
                                            value="-1">@lang('app.food-manage.update.option-take-all')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    class="col-lg-4 col-form-label">@lang('app.food-manage.update.category')</label>
                                <div class="col-lg-8">
                                    <label id="category-combo-update-food-manage"
                                           class="reset-data-popup"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalUpdateFoodManage()"
                     onkeypress="saveModalUpdateFoodManage()">
                    <i class="fi-rr-document"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/food/branch/update.js?version=3',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
