<div class="modal fade" id="modal-create-customer-booking-table-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.booking-table-manage.create.title-customer')</h4>
            </div>
            <div class="modal-body text-left"
                 id="loading-modal-create-customer-booking-table-manage">
                <div class="card-block">
                    <div class="form-group row">
                        <label class="col-sm-4 font-weight-bold my-auto col-form-label">@lang('app.booking-table-manage.create.phone-customer')</label>
                        <div class="col-sm-8">
                            <input id="phone-create-customer-booking-table-manage" data-phone="1" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 font-weight-bold my-auto col-form-label">@lang('app.booking-table-manage.create.customer-last-name')</label>
                        <div class="col-sm-8">
                            <input id="last-name-create-customer-booking-table-manage" data-min-length="2"  data-max-length="25"  class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 font-weight-bold my-auto col-form-label">@lang('app.booking-table-manage.create.customer-first-name')</label>
                        <div class="col-sm-8">
                            <input id="first-name-create-customer-booking-table-manage" data-min-length="2"  data-max-length="25" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 font-weight-bold my-auto col-form-label">@lang('app.booking-table-manage.create.birthday-customer')</label>
                        <div class="col-sm-8">
                            <input type="text" id="birthday-create-customer-booking-table-manage"
                                   class="input-sm form-control text-center input-datetimepicker p-1"
                                   value="{{date('d/m/Y')}}" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 font-weight-bold col-form-label">@lang('app.booking-table-manage.create.address-customer')</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="address-create-customer-booking-table-manage"
                                      cols="5" rows="5" data-note="1"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-grd-disabled waves-effect" onclick="closeModalCreateCustomerBookingTableManage()"
                        onkeypress="closeModalCreateCustomerBookingTableManage()">@lang('app.component.button.close')</button>
                <button id="btn-save-modal-create-customer-booking-table-manage"
                        type="button"
                        class="btn btn-grd-primary waves-effect waves-light"
                        onclick="saveModalCreateCustomerBookingTableManage()"
                        onkeypress="saveModalCreateCustomerBookingTableManage()">@lang('app.component.button.save')</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/booking_table/customer.js?version=4')}}"></script>
@endpush
