<div class="modal fade" id="modal-update-cost-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" id="modal-cost-data-detail-content">
            <div class="modal-header">
                <h4 class="modal-title text-center"
                    id="exampleModalLabel">@lang('app.cost-data.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateCostData()" onkeypress="closeModalUpdateCostData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-block card m-0">
                    <div class="row">
                        <div class="form-group validate-group col-12 px-0">
                            <div class="form-validate-input form-left">
                                <input type="text" class="form-control" id="cost-data-name-update" data-min-length="2" data-max-length="50" data-spec="1" data-empty="1">
                                <label for="name-create-kitchen-data">
                                    @lang('app.cost-data.update.update-name') @include('layouts.start')
                                </label>
                                <div class="line"></div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveUpdateCostData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/revenue_and_cost/cost/update.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
