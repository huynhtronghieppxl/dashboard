<div class="modal fade" id="modal-update-employee-bonus-punish" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.employee-bonus-punish.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateEmployeeBonusPunish()" onkeypress="closeModalUpdateEmployeeBonusPunish()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-update-employee-bonus-punish">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-block card m-0">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label">@lang('app.employee-bonus-punish.update.branch')</label>
                                    <div class="f-w-400">
                                        <label id="branch-update-employee-bonus-punish">---</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label">@lang('app.employee-bonus-punish.update.time')</label>
                                    <div class="f-w-400">
                                        <label id="time-update-employee-bonus-punish">{{date('d/m/Y')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row validate-group border-dashed pb-2">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600  col-form-label">@lang('app.employee-bonus-punish.update.proposer')</label>
                                    <div class="f-w-400">
                                        <label id="proposer-update-employee-bonus-punish"
                                               style="max-width: 170px;overflow-wrap: break-word">---</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label">@lang('app.employee-bonus-punish.update.employee')</label>
                                    <div class="f-w-400">
                                        <label id="employee-update-employee-bonus-punish" class="w-100"
                                               style="overflow-wrap: break-word">---</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input data-type="currency-edit" id="amount-update-employee-bonus-punish"
                                           class="form-control text-right" value="0" data-min="100"
                                           data-max="999999999"/>
                                    <label>
                                        @lang('app.employee-bonus-punish.update.amount')
                                        @include('layouts.start')
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="type-update-employee-bonus-punish"
                                                    class="js-example-basic-single select2-hidden-accessible"
                                                    tabindex="-1" aria-hidden="true">
                                                <option disabled selected
                                                        hidden>@lang('app.component.option_default')</option>
                                            </select>
                                            <label>
                                                @lang('app.employee-bonus-punish.update.type')
                                                @include('layouts.start')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea class="form__field" rows="5" cols="6"
                                                  id="note-update-employee-bonus-punish" placeholder=""
                                                  data-note="1"></textarea>
                                        <label for="note-update-employee-bonus-punish"
                                               class="form__label icon-validate">
                                            @lang('app.employee-bonus-punish.update.reason')
                                            @include('layouts.start')
                                        </label>
                                        <div class="textarea-character" id="char-count">
                                            <span>0/300</span>
                                        </div>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalUpdateEmployeeBonusPunish()"
                     onkeypress="saveModalUpdateEmployeeBonusPunish()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
<select class="d-none" id="data-select-punish-update">
    <option value="2"
            data-punish="0">@lang('app.employee-bonus-punish.update.uniform')</option>
    <option value="01"
            data-punish="1">@lang('app.employee-bonus-punish.update.other-punish')</option>
</select>
<select class="d-none" id="data-select-reward-update">
    <option value="1"
            data-punish="0">@lang('app.employee-bonus-punish.update.support')</option>
    <option value="00"
            data-punish="0">@lang('app.employee-bonus-punish.update.other-punish-reward')</option>
</select>

@push('scripts')
    <script type="text/javascript"
            src="{{ asset('..\js\treasurer\employee_bonus_punish\update.js?version=3',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
