<div class="modal fade" id="modal-create-wage-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.wage-data.title-create')</h4>
                <button type="button" class="close" onclick="closeModalCreateWageData()" onkeypress="closeModalCreateWageData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-create-wage-data">
                <div class="card-block card m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input id="level-name-wage-data" class="form-control currency text-left" data-empty="1" data-min-length="2" data-spec="1" data-max-length="50" data-check="0">
                            <label for="level-name-wage-data">
                                @lang('app.wage-data.name-salary-table') @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input type="text" class="form-control currency" data-type="currency-edit" id="exchange-money-wage-data" name="exchange_money" value="100" data-empty="1" data-min="100" data-max="999999999" data-money="1">
                            <label for="exchange-money-wage-data">
                                @lang('app.wage-data.exchange-money') @include('layouts.start')</label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none" onclick="reloadModalCreateWageData()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveCreateWageData()"
                     onkeypress="saveCreateWageData()"
                     aria-invalid="btn-create-employee-manage">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="{{asset('js/build_data/personnel/wage/create.js?version=4', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush


