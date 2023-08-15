<div class="modal fade" id="modal-update-food-one-get-one-campaign" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Gán món ăn</h4>
                <button type="button" class="close" onclick="closeModalUpdateFoodOneGetOneCampaign()" onkeypress="closeModalUpdateFoodOneGetOneCampaign()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-modal-update-take-away">
                <div class="row d-flex">
                    <div class="col-lg-5 edit-flex-auto-fill px-0" >
                        <div class="card card-block flex-sub" id="loading-list-food-all-one-get-one-campign">
                            <h5 class="text-bold sub-title mx-0 col-form-label">@lang('app.one-get-one-campaign.create.food-table')</h5>
                            <div class="table-responsive new-table">
                                <table id="table-all-food-update-one-get-one" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.one-get-one-campaign.create.name-food')</th>
                                        <th class="text-center">
                                        </th>
                                        <th class="text-center d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 edit-flex-auto-fill pr-0" >
                        <div class="card card-block flex-sub mx-0" id="loading-list-food-select-one-get-one-campign">
                            <h5 class="text-bold sub-title mx-0 col-form-label">@lang('app.one-get-one-campaign.create.food-gift-list')</h5>
                            <div class="table-responsive new-table">
                                <table id="table-selected-food-update-one-get-one" class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center m-auto">
                                            </th>
                                            <th>@lang('app.one-get-one-campaign.create.name-food')</th>
                                            <th>@lang('app.one-get-one-campaign.create.food-gift')</th>
                                            <th class="text-center d-none"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div id="btn_save_create"
                        class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveFoodOneGetOneCampaign()"
                        onkeypress="saveFoodOneGetOneCampaign()">
                        <i class="fi-rr-disk"></i>
                        <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/marketing/campaign/one_get_one/add_food.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
