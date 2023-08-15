<div class="modal fade" id="modal-update-food-area-branch-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom" id="loading-modal-update-food-manage">
            <div class="modal-header">
                <h4 class="modal-title py-2">@lang('app.food-manage.update-area.title')</h4>
                <div class="d-flex align-items-center">
                    <h5 class="py-2 reset-data-popup" id="update-food-manage"></h5>
                    <button type="button" class="close ml-4" onclick="closeModalUpdateFoodAreaBranchManage()" onkeypress="closeModalUpdateFoodAreaBranchManage()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body text-left background-body-color" id="loading-update-food-area-branch-manage">
                <div class="row d-flex">
                    <div class="edit-flex-auto-fill col-sm-4 pr-0">
                        <div class="card flex-sub pr-0">
                            <div class="card-block p-b-0">
                                <h5 class="sub-title mb-4 ml-0">@lang('app.food-manage.update-area.title-left')</h5>
                            </div>
                            <div class="card-block p-t-0">
                                <div class="table-responsive new-table">
                                    <table id="table-area-not-assign" class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.food-manage.update-area.name')</th>
                                            <th>
                                                <i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right pointer"
                                                   onclick="checkAllAreaFood()"></i>
                                            </th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="edit-flex-auto-fill col-sm-8">
                        <div class="card flex-sub">
                            <div class="card-block p-b-0">
                                <h5 class="sub-title mb-4 ml-0">@lang('app.food-manage.update-area.title-right')</h5>
                            </div>
                            <div class="card-block p-t-0">
                                <div class="table-responsive new-table">
                                    <table id="table-area-assign" class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th><i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right pointer"
                                                   onclick="unCheckAllAreaFood()"></i></th>
                                            <th>@lang('app.food-manage.update-area.apply')</th>
                                            <th>@lang('app.food-manage.update-area.name')</th>
                                            <th>@lang('app.food-manage.update-area.amount')</th>
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
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalUpdateFoodAreaBranchManage()"
                     onkeypress="saveModalUpdateFoodAreaBranchManage()">
                    <i class="fi-rr-document"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/food/branch/food_area.js?version=2',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
