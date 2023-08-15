<style>
    .select2-results__option:hover {
        background-color: #EEEEEE;
    }

    .select2-results__option--highlighted:hover {
        background-color: #EEEEEE;
    }
    #modal-create-holiday-employee-bonus-punish-multi{
        z-index: 1050 !important;
    }
</style>
<div class="modal fade" id="modal-create-holiday-employee-bonus-punish-multi" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.employee-bonus-punish.create-reward')</h4>
                <button type="button" class="close" onclick="closeModalCreateHolidayEmployeeBonusPunish()" onkeypress="closeModalCreateHolidayEmployeeBonusPunish()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left background-body-color px-0" id="loading-modal-create-holiday-employee-bonus-punish-multi" style="overflow-x: auto">
                <div class="col-lg-12 card card-block mb-2 px-0 m-0">
                    <div class="row" id="form-header-bonus-punish">
                        <div class="col-lg-6">
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="reward-proposer-create-holiday-employee-bonus" class="js-example-basic-single select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                <option value="1">@lang('app.employee-bonus-punish.create.select-holyday.op1')</option>
                                                <option value="10">@lang('app.employee-bonus-punish.create.select-holyday.op2')</option>
                                                <option value="3">@lang('app.employee-bonus-punish.create.select-holyday.op3')</option>
                                                <option value="11">@lang('app.employee-bonus-punish.create.select-holyday.op4')</option>
                                            </select>
                                            <label>@lang('app.employee-bonus-punish.type')@include('layouts.start')</label>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input class="form-control text-center" id="time-create-holiday-employee-bonus-punish" value="{{date('m/Y')}}" data-validate="calendar" />
                                    <label>
                                        Thời gian
                                        @include('layouts.start')
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group" id="div-reward-bonus-amount">
                                <div class="form-validate-input">
                                    <input data-type="currency-edit" id="amount-create-holiday-employee-bonus-punish" class="form-control text-right" data-max="999999999" data-min="100" value="100" data-number="1"/>
                                    <label>@lang('app.employee-bonus-punish.total-amount')@include('layouts.start')</label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group d-none" id="div-reward-bonus-day">
                                <div class="form-validate-input">
                                    <input id="quantity-create-holiday-employee-bonus-punish" class="form-control text-right" data-min="1" value="1" data-max="365">
                                    <label>@lang('app.employee-bonus-punish.total-day')@include('layouts.start')</label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="proposer-create-holiday-employee-bonus-punish" data-select="1" class="js-example-basic-single select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                <option disabled selected hidden>@lang('app.component.option_default')</option>
                                            </select>
                                            <label>@lang('app.employee-bonus-punish.create.proposer')@include('layouts.start')</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea class="form__field" rows="3" cols="4" data-note-min-length="2" data-note-max-length="255" data-note="2" id="note-create-holiday-employee-bonus-punish" placeholder=""></textarea>
                                        <label for="note-create-holiday-employee-bonus-punish" class="form__label icon-validate">
                                            @lang('app.employee-bonus-punish.create.reason')
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
                <div class="row d-flex m-0">
                        <div class="col-lg-6 pl-0 edit-flex-auto-fill">
                            <div class="card-block px-0 pl-3 mr-0 flex-sub card m-0">
                                <div class="col-lg-12 px-0">
                                    <div class="table-responsive new-table">
                                        <table class="table table-bordered dataTable no-footer" id="table-holiday-employee-bonus-punish">
                                            <thead>
                                            <tr>
                                                <th>@lang('app.permission-employee.name')</th>
                                                <th>@lang('app.permission-employee.phone')</th>
                                                <th>
                                                    <div class="btn-group btn-group-sm">
                                                        <button type="button"
                                                                class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                                onclick="checkAllCreateHoliday()">
                                                            <i class="fi-rr-arrow-small-right"></i>
                                                        </button>
                                                    </div>
                                                </th>
                                                <th class="d-none"></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex edit-flex-auto-fill pr-0">
                            <div class="card card-block flex-sub w-100 px-3 mr-0 ml-0">
                                <div class="col-lg-12 px-0">
                                    <div class="table-responsive new-table">
                                        <table class="table dataTable no-footer" id="table-convert-holiday-employee-bonus-punish">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <div class="btn-group btn-group-sm">
                                                        <button type="button"
                                                                class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                                onclick="unCheckAllCreateHoliday()">
                                                            <i class="fi-rr-arrow-small-left"></i>
                                                        </button>
                                                    </div>
                                                </th>
                                                <th>@lang('app.permission-employee.name')</th>
                                                <th>@lang('app.permission-employee.phone')</th>
                                                <th class="d-none"></th>
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
                <button type="button" class="btn-renew d-none" data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại"
                        onclick="resetModalCreateHolidayEmployeeBonusPunish()"
                        onkeypress="resetModalCreateHolidayEmployeeBonusPunish()">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreateHolidayEmployeeBonusPunish()"
                     onkeypress="saveModalCreateHolidayEmployeeBonusPunish()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('..\js\treasurer\employee_bonus_punish\create_holiday.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
