<div class="modal fade" id="modal-create-booking-bonus-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.booking-bonus-data.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateBookingBonusData()" onkeypress="closeModalCreateBookingBonusData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-create-booking-bonus-data">
                <div class="card-block card m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input id="name-create-booking-bonus-data" class="form-control currency text-left" data-empty="1" data-min-length="2" data-spec="1" data-max-length="50" data-check="0">
                            <label for="name-create-booking-bonus-data"> @lang('app.booking-bonus-data.create.name')@include('layouts.start')  </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input type="text" id="amount-create-booking-bonus-data" class="form-control text-right" value="0" data-min="100" data-max="999999999" data-type="currency-edit"/>
                            <label for="amount-create-booking-bonus-data">
                                @lang('app.booking-bonus-data.create.amount')
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group" style="margin-bottom: 0 !important;">
                        <div class="form-validate-input">
                            <input type="text" id="bonus-create-booking-bonus-data" class="form-control text-right" value="0" data-percent="1" data-min="1" data-type="currency-edit"/>
                            <label for="bonus-create-booking-bonus-data">@lang('app.booking-bonus-data.create.bonus-percent')
                                @include('layouts.start')</label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class=" form-group validate-group text-right" style="margin-top:10px !important;">
                        @lang('app.booking-bonus-data.create.to-bill'): <span id="total-create-booking-bonus-data">1</span>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-textarea">
                            <div class="form__group pt-2">
                                <textarea id="description-create-booking-bonus-data" class="form__field" cols="5" rows="5" data-note-max-length="2000" spellcheck="false"></textarea>
                                <label for="description-create-booking-bonus-data" class="form__label icon-validate">
                                   @lang('app.booking-bonus-data.create.description')
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
            <div class="modal-footer">
                <button type="button" class="btn-renew" onclick="reloadModalCreateBookingBonusData()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreateBookingBonusData()"
                     onkeypress="saveModalCreateBookingBonusData()" aria-invalid="btn-create-employee-manage">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/personnel/booking_bonus/create.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
