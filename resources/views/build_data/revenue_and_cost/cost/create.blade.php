<div class="modal fade" id="modal-create-cost-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" id="modal-content-create">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.cost-data.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateCostData()" onkeypress="closeModalCreateCostData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-block card m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input type="text" class="form-control" id="cost-data-name-create" data-empty="1"
                                   data-min-length="2" data-max-length="50" data-spec="1">
                            <label for="name-create-kitchen-data">
                                @lang('app.cost-data.create.create-name') @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none"
                        onclick="resetModalCreateCostData()" data-toggle="tooltip" data-placement="top"
                        data-original-title="Đặt lại"
                        onkeypress="resetModalCreateCostData()">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveCreateCostData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/revenue_and_cost/cost/create.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush


