<div class="modal fade" id="modal-confirm-booking-table-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.booking-table-manage.confirm.title')</h4>
                <button type="button" class="close" onclick="closeModalTableBookingTableManage()" onkeypress="closeModalTableBookingTableManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-modal-confirm-booking-table-manage">
                <div class="row d-flex">
                    <div class="col-lg-7 edit-flex-auto-fill pr-0">
                        <div class="card card-block w-100 pr-0 mr-0">
                            <h5 class="text-bold sub-title">@lang('app.booking-table-manage.confirm.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-food-confirm-booking-table-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.booking-table-manage.confirm.stt')</th>
                                        <th>@lang('app.booking-table-manage.confirm.avatar')</th>
                                        <th>@lang('app.booking-table-manage.confirm.name')</th>
                                        <th>@lang('app.booking-table-manage.confirm.quantity')</th>
                                        <th>@lang('app.booking-table-manage.confirm.price')</th>
                                        <th>@lang('app.booking-table-manage.confirm.total-amount')</th>
                                        <th>@lang('app.booking-table-manage.confirm.action')</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 edit-flex-auto-fill pl-0">
                        <div class="card card-block flex-sub" id="boxlist-confirm-booking-table-manage">
                            <h5 class="text-bold sub-title">@lang('app.booking-table-manage.confirm.title-right')</h5>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.confirm.customer-name')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="customer-name-confirm-booking-table-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.confirm.customer-phone')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="customer-phone-confirm-booking-table-manage"></h6>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.confirm.branch')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="branch-confirm-booking-table-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.confirm.type')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="type-confirm-booking-table-manage"></h6>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.confirm.employee')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="employee-confirm-booking-table-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.confirm.create')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="create-confirm-booking-table-manage"></h6>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.confirm.booking')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="booking-confirm-booking-table-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.confirm.number')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="number-confirm-booking-table-manage"></h6>
                                </div>
                            </div>
                            <div class="form-group row select2_theme">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.confirm.area')
                                        @include('layouts.start')</label>
                                    <div class="form-validate-select select-material-box" style="height: 44px;">
                                        <select id="area-confirm-booking-table-manage" data-select="1"
                                                 class="js-example-basic-single col-sm- select2-hidden-accessible"></select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.confirm.table')
                                        @include('layouts.start')</label>
                                    <div class="form-group select2_theme validate-group">
                                        <div class="form-validate-select mb-0">
                                            <div class="col-lg-12 mx-0 px-0">
                                                <div class="pr-0 select-material-box validate-error">
                                                    <select id="table-confirm-booking-table-manage"
                                                            class="js-example-basic-single select2-hidden-accessible" multiple="" data-select="1" >
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5 class="text-bold sub-title">@lang('app.booking-table-manage.confirm.price-title')</h5>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.confirm.receive-deposit-time')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="receive-deposit-time-confirm-booking-table-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.confirm.deposit-amount')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="deposit-amount-confirm-booking-table-manage"></h6>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.confirm.return-deposit-time')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="return-deposit-time-confirm-booking-table-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.confirm.return-deposit-amount')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="return-deposit-amount-confirm-booking-table-manage"></h6>
                                </div>
                            </div>
                            <div class="form-group row border-dashed">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.confirm.note')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="note-confirm-booking-table-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.confirm.orther-requirements')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="orther-requirements-confirm-booking-table-manage"></h6>
                                </div>
                            </div>
                            <div class="form-group row pt-3">
                                <div class="col-lg-6 pl-3">
                                    <span class="m-b-10 pr-2 f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.confirm.total-final')</span>
                                    <label class="text-muted f-w-400 col-form-label-fz-15" id="total-final-confirm-booking-table-manage"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalTableBookingTableManage()"
                     title="@lang('app.component.button.save')"
                     onkeypress="saveModalTableBookingTableManage()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/booking_table/confirm.js?version=3')}}"></script>
@endpush
