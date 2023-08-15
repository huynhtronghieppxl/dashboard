<style>
    #new_header .topbar {
        z-index: 9997 !important;
    }
    #modal-update-wage-data {
        z-index: 9998 !important;
    }
</style>
<div class="modal fade" id="modal-update-wage-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_modal_update">@lang('app.wage-data.title-edit')</h4>
                <button type="button" class="close" onclick="closeModalUpdateWageData()" onkeypress="closeModalUpdateWageData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-update-wage-data">
                    <div class="card-block card m-0">
                        <div class="form-group validate-group">
                            <div class="form-validate-input form-left">
                                <input type="text" class="form-control" id="levelsalary" name="level_salary" data-min-length="2" data-max-length="50" data-spec="1" data-empty="1">
                                <label for="levelsalary">
                                    @lang('app.wage-data.name-salary-table') @include('layouts.start')
                                </label>
                                <div class="line"></div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div class="form-group validate-group">
                            <div class="form-validate-input form-left">
                                <input type="text" class="form-control currency" id="exchangemoney" data-type="currency-edit" name="exchange_money" data-min="100" data-max="999999999" data-money="1" value="0">
                                <label for="exchangemoney">
                                    @lang('app.wage-data.exchange-money') @include('layouts.start')</label>
                                <div class="line"></div>
                            </div>
                            <div class="link-href"></div>
                        </div>

                    </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalUpdateWageData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>


            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{asset('js/build_data/personnel/wage/update.js?version=5', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

