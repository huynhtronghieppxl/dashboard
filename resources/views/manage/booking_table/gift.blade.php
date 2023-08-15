
<div class="modal fade" id="modal-gift-booking-table-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.booking-table-manage.gift.title')</h4>
            </div>
            <div class="modal-body text-left" id="loading-modal-gift-booking-table-manage">
                <div class="card-block w-100">
                    <div class="table-responsive new-table">
                        <table class="table" id="table-food-gift-booking-table-manage">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>@lang('app.booking-table-manage.gift.name')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-grd-disabled waves-effect" onclick="closeModalGiftBooking()" title="@lang('app.component.button.close')"
                        onkeypress="closeModalGiftBooking()">@lang('app.component.button.close')</button>
                <button type="button"
                        class="btn btn-grd-primary waves-effect waves-light"
                        onclick="saveGiftBooking()" title="@lang('app.component.button.save')"
                        onkeypress="saveGiftBooking()">@lang('app.component.button.save')</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/booking_table/gift.js?version=1')}}"></script>
@endpush
