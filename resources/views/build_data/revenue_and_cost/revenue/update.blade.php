<div class="modal fade" id="modal-revenue-data-detail" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" id="modal-revenue-data-detail-content">
            <div class="modal-header">
                <h4 class="modal-title text-center"
                    id="exampleModalLabel">@lang('app.revenue-data.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateRevenueData()" onkeypress="closeModalUpdateRevenueData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="card-block card m-0">
                        <div class="form-group validate-group">
                            <div class="form-validate-input form-left">
                                <input type="text" class="form-control" id="name-update-revenue-data" data-min-length="2" data-max-length="50" data-spec="1" data-empty="1">
                                <label for="name-create-kitchen-data">
                                    @lang('app.revenue-data.update.update-name') @include('layouts.start')
                                </label>
                                <div class="line"></div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-none">
                <input id="revenue-data-id-update"/>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"

                     onclick="saveModalUpdateRevenueData()"
                     id="revenue-data-edit-save">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/revenue_and_cost/revenue/update.js?version=8', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
