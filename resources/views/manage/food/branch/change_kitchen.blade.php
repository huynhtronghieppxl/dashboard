<div class="modal fade" id="modal-change-kitchen-food-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.food-manage.change-kitchen.title')</h4>
                <button type="button" class="close" onclick="closeModalChangeKitchenFoodManage()" onkeypress="closeModalChangeKitchenFoodManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-modal-change-kitchen-food-manage">
                <div class="row">
                    <div class="col-lg-4 d-flex">
                        <div class="card card-block flex-sub">
                            <h4 class="sub-title">@lang('app.food-manage.change-kitchen.title-right')</h4>
                            <div class="form-group select2_theme validate-group m-t-10">
                                <div class="form-validate-select ">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="current-kitchen-food-manage" class="js-example-basic-single select2-hidden-accessible">
                                                <option value="">@lang('app.component.option_default')</option>
                                            </select>
                                            <label>
                                                <i class="typcn typcn-document-text"></i>
                                                @lang('app.food-manage.change-kitchen.current-kitchen')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select ">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="target-kitchen-food-manage" class="js-example-basic-single select2-hidden-accessible">
                                                <option value="">@lang('app.component.option_default')</option>
                                            </select>
                                            <label>
                                                <i class="typcn typcn-document-text"></i>
                                                @lang('app.food-manage.change-kitchen.target-kitchen')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">@lang('app.food-manage.change-kitchen.type')</label>
                                <div class="col-md-8">
                                    <div class="form-radio">
                                        <div class="row col-lg-12" id="type-kitchen-food-manage">
                                            <div class="radio radio-inline col-lg-6">
                                                <label>
                                                    <input type="radio" name="type" value="0" checked>
                                                    <i class="helper"></i>@lang('app.food-manage.change-kitchen.false')
                                                </label>
                                            </div>
                                            <div class="radio radio-inline col-lg-6">
                                                <label>
                                                    <input type="radio" name="type" value="1">
                                                    <i class="helper"></i>@lang('app.food-manage.change-kitchen.true')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label id="type-false-kitchen-employee-manage"
                                       class="font-italic font-weight-bold text-warning">@lang('app.food-manage.change-kitchen.type-false')</label>
                                <label id="type-true-kitchen-employee-manage"
                                       class="d-none font-italic font-weight-bold text-warning">@lang('app.food-manage.change-kitchen.type-true')</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 d-flex">
                        <div class="card card-block flex-sub">
                            <h4 class="sub-title">@lang('app.food-manage.change-kitchen.title-left')</h4>
                            <div class="table-responsive new-table m-t-10">
                                <table class="table table-bordered" id="table-kitchen-food-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.food-manage.change-kitchen.stt')</th>
                                        <th>
                                            <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                    <input type="checkbox" onclick="checkAllChangeKitchenFoodManage($(this))" id="check-all-kitchen-food-manage"/>
                                                    <span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                                </label>
                                            </div>
                                        </th>
                                        <th>@lang('app.food-manage.change-kitchen.name')</th>
                                        <th>@lang('app.food-manage.change-kitchen.category')</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalChangeKitchenFoodManage()"
                     onkeypress="saveModalChangeKitchenFoodManage()">
                    <i class="fi-rr-document"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/food/branch/change_kitchen.js?version=4',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
