<div class="modal fade" id="modal-update-take-away" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.take-away-branch.create.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateTakeAway()" onkeypress="closeModalUpdateTakeAway()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-modal-update-take-away">
                <div class="row">
                    <div class="col-lg-6 edit-flex-auto-fill">
                        <div class="card flex-sub">
                            <div class="card-block">
                                <h5 class="sub-title mb-4 ml-0">@lang('app.take-away-branch.create.title2')</h5>
                                <div class="table-responsive new-table">
                                    <table id="table-all-take-away" class="table ">
                                        <thead>
                                            <tr>
                                                <th class="">@lang('app.take-away-branch.create.name')</th>
                                                <th>@lang('app.take-away-branch.create.amount')</th>
                                                <th class="text-center m-auto">
{{--                                                    <i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right"  onclick="checkAllFoodTakeAwayBranch($(this))"></i>--}}
                                                    <div class="btn-group btn-group-sm">
                                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="checkAllFoodTakeAwayBranch($(this))"><i class="fi-rr-arrow-small-right"></i></button>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 edit-flex-auto-fill">
                        <div class="card flex-sub">
                            <div class="card-block">
                                <h5 class="sub-title mb-4 ml-0">@lang('app.take-away-branch.create.title3')</h5>
                                <div class="table-responsive new-table">
                                    <table id="table-selected-take-away" class="table ">
                                        <thead>
                                            <tr>
                                                <th class="text-center m-auto">
{{--                                                    <i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right"  onclick="unCheckAllFoodTakeAwayBranch($(this))"></i>--}}
                                                    <div class="btn-group btn-group-sm">
                                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="unCheckAllFoodTakeAwayBranch($(this))"><i class="fi-rr-arrow-small-left"></i></button>
                                                    </div>
                                                </th>
                                                <th class="t">@lang('app.take-away-branch.create.name')</th>
                                                <th>@lang('app.take-away-branch.create.amount')</th>
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
                <div id="btn_save_create" type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalUpdateTakeAway()" onkeypress="saveModalUpdateTakeAway()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/customer/take_away/branch/update.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
