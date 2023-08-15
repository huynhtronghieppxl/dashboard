<div class="modal fade" id="modal-create-employee-bonus-punish" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.employee-bonus-punish.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateEmployeeBonusPunish()" onkeypress="closeModalCreateEmployeeBonusPunish()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-create-employee-bonus-punish">
                <div class="row m-0">
                    <div class="col-lg-12 p-0">
                        <div class="card-block card m-0">
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input type="text" id="time-create-employee-bonus-punish"
                                           class="input-sm form-control text-center input-datetimepicker p-1"
                                           value="{{date('m/Y')}}" data-validate="calendar"/>
                                    <label>
                                        @lang('app.employee-bonus-punish.create.time') @include('layouts.start')
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select">
                                    <div class="col-lg-12 select-material-box">
                                        <select id="proposer-create-employee-bonus-punish"
                                                class="js-example-basic-single select2-hidden-accessible"
                                                data-select="1" tabindex="-1" aria-hidden="true">
                                            <option value="-1" disabled selected
                                                    hidden>@lang('app.component.option_default')</option>
                                        </select>
                                        <label class="icon-validate">
                                            @lang('app.employee-bonus-punish.create.proposer')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select">
                                    <div class="col-lg-12 select-material-box">
                                        <select id="employee-create-employee-bonus-punish" data-select="1"
                                                class="js-example-basic-single select2-hidden-accessible">
                                            <option value="-2" disabled selected
                                                    hidden>@lang('app.component.option_default')</option>
                                        </select>
                                        <label class="icon-validate">
                                            @lang('app.employee-bonus-punish.create.employee')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input data-type="currency-edit" id="amount-create-employee-bonus-punish"
                                           class="form-control text-right" value="100"
                                           data-min="100" data-max="999999999" data-number="1"/>
                                    <label>Số tiền @include('layouts.start')</label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="type-create-employee-bonus-punish"
                                                    class="js-example-basic-single select2-hidden-accessible"
                                                    data-select="1" tabindex="-1" aria-hidden="true">
                                                <option value="1"
                                                        data-punish="0">@lang('app.employee-bonus-punish.create.support') </option>
                                                <option value="0"
                                                        data-punish="0">@lang('app.employee-bonus-punish.create.other-punish-reward') </option>
                                                <option value="0"
                                                        data-punish="1">@lang('app.employee-bonus-punish.create.other-punish') </option>
                                                <option value="2"
                                                        data-punish="0">@lang('app.employee-bonus-punish.create.uniform') </option>
                                            </select>
                                            <label>
                                                Loại
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
                                <textarea class="form__field" rows="5" cols="6" data-note-min-length="2" data-note-max-length="255"
                                          id="note-create-employee-bonus-punish" placeholder="" data-note="1"></textarea>
                                        <label for="note-create-employee-bonus-punish"
                                               class="form__label icon-validate">
                                            @lang('app.employee-bonus-punish.create.reason')
                                            @include('layouts.start')
                                        </label>
                                        <div class="textarea-character" id="char-count">
                                            <span>0/300</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none" data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại"
                        onclick="resetModalCreateEmployeeBonusPunish()"
                        onkeypress="resetModalCreateEmployeeBonusPunish()">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreateEmployeeBonusPunish()"
                     onkeypress="saveModalCreateEmployeeBonusPunish()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js/treasurer/employee_bonus_punish/create.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
