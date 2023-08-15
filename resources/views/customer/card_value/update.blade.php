<div class="modal fade" id="modal-update-card-value" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.card-value-customer.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateCardValue()" onkeypress="closeModalUpdateCardValue()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-update-card-value-customer">
                <div class="card card-block m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="name-update-card-value" class="form-control" type="text" data-empty="1" data-max-length="50" data-min-length="2">
                            <label for="name-update-card-value">
                                @lang('app.card-value-customer.update.name')
                                @include('layouts.start')
                            </label>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="amount-update-card-value" class="form-control" type="text" data-empty="1" data-number="1" value="10000" data-max="500000000" data-min="10000" data-type="currency-edit">
                            <label for="amount-update-card-value">
                                @lang('app.card-value-customer.update.amount')
                                @include('layouts.start')
                            </label>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="bonus-update-card-value" class="form-control" type="text" data-number="1"  data-empty="1" data-max="999999999" value="0" data-type="currency-edit">
                            <label for="bonus-update-card-value">
                                @lang('app.card-value-customer.update.bonus')
                            </label>
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div id="btn-update-card-value"  type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalUpdateCardValue()" onkeypress="saveModalUpdateCardValue()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/customer/card_value/update.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
