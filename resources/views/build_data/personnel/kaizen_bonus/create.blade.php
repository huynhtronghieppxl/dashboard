<div class="modal fade" id="modal-create-kaizen-bonus-data" data-keyboard="false" data-backdrop="static" tabindex="-1"
     role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.kaizen-bonus-data.create.title')</h4>
                <button type="button" class="close ml-4" onclick="closeModalCreateKaizenBonusData()" onkeypress="closeModalCreateKaizenBonusData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color pb-0" id="loading-create-kaizen-bonus-data">
                <div class="card card-block">
                    <div class="table-responsive new-table">
                        <table class="table"
                               id="table-create-kaizen-bonus-data">
                            <thead>
                            <tr>
                                <th class="text-center">@lang('app.kaizen-bonus-data.create.stt')</th>
                                <th class="text-center">@lang('app.kaizen-bonus-data.create.name')</th>
                                <th class="text-center">@lang('app.kaizen-bonus-data.create.amount')</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreateKaizenBonusData()"
                     onkeypress="saveModalCreateKaizenBonusData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/personnel/kaizen_bonus/create.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
