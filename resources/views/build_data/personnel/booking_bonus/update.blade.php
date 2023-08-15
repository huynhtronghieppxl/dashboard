<div class="modal fade" id="modal-update-booking-bonus-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.booking-bonus-data.update.title')</h4>
                <button type="button" class="close ml-4" onclick="closeModalUpdateBookingBonusData()" onkeypress="closeModalUpdateBookingBonusData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-update-booking-bonus-data">
                <div class="card-block card m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input type="text" class="form-control" id="name-update-booking-bonus-data" data-empty="1" data-max-length="50" data-min-length="2"/>
                            <label for="name-update-booking-bonus-data"> @lang('app.booking-bonus-data.update.name')
                                @include('layouts.start') </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>

                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input type="text" id="amount-update-booking-bonus-data" class="form-control text-right" data-min="100" data-max="999999999" data-type="currency-edit"/>
                            <label for="amount-update-booking-bonus-data">
                                @lang('app.booking-bonus-data.update.amount')
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group" style="margin-bottom: 0 !important;">
                        <div class="form-validate-input">
                            <input type="text" id="bonus-update-booking-bonus-data" class="form-control text-right" value="0" data-percent="1" />
                            <label for="bonus-update-booking-bonus-data"> @lang('app.booking-bonus-data.update.bonus-percent')
                                @include('layouts.start') </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class=" form-group validate-group text-right" style="margin-top: 10px !important;">
                        <span class="f-w-600">@lang('app.booking-bonus-data.update.to-bill'): </span>
                        <span class="font-1-rem" id="total-update-booking-bonus-data"></span>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-textarea">
                            <div class="form__group pt-2">
                                <textarea id="description-update-booking-bonus-data" class="form__field" cols="5" rows="5" data-note-max-length="2000" spellcheck="false"></textarea>
                                <label for="description-update-booking-bonus-data" class="form__label icon-validate"> @lang('app.booking-bonus-data.update.description') </label>
                                <div class="textarea-character" id="char-count">
                                    <span>0/300</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalUpdateBookingBonusData()"
                     onkeypress="saveModalUpdateBookingBonusData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/personnel/booking_bonus/update.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
