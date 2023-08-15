<div class="modal fade" id="modal-assign-brand-supplier-for-branches" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.branch-system-supplier-data.branches-modal.title')</h4>
            </div>
            <div class="modal-body" id="loading-modal-assign-brand-supplier-for-branches">
                <div class="card-block">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <div class="row list" id="choose-branches-for-assign-supplier" data-branch="{{Session::get(SESSION_KEY_BRANCH_ID)}}">
                                <div class="custom-card-value list-item p-2 custom-card-value-focus-2" data-id="-1">
                                    <a class="m-auto">@lang('app.branch-system-supplier-data.branches-modal.all-branch')</a>
                                </div>
                                @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all() as $data)
                                    <div class="custom-card-value list-item p-2" data-id="{{$data['id']}}">
                                        <a class="m-auto">{{$data['name']}}</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled" onclick="closeModalSaveBrandSupplierForBranches()" onkeypress="closeModalSaveBrandSupplierForBranches()">@lang('app.component.button.close')</button>
                <button type="button" class="btn btn-grd-primary" onclick="saveBrandSupplierForBranches()" onkeypress="saveBrandSupplierForBranches()">@lang('app.component.button.save')</button>
            </div>
        </div>
    </div>
</div>
