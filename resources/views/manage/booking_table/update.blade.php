<style>
    #select2-select-category-update-booking-table-manage-container{
        width: 100px !important;
    }
    .col-form-label-fz-15{
        margin-bottom: 5px !important;
    }

    .swal2-content {
        z-index: 999;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        background: none !important;
        font-size: 14px !important;
        font-family: 'Roboto';
    }
</style>
<div class="modal fade" id="modal-update-booking-table-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.booking-table-manage.update.title')</h4>
                <div class="d-flex align-items-center">
                    <h5 id="status-update-booking-table-manage" class="py-2 reset-html"></h5>
                    <button type="button" class="close" onclick="closeModalUpdateBookingTableManage()"
                            onkeypress="closeModalUpdateBookingTableManage()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-modal-update-booking-table-manage">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill px-0">
                        <div class="card card-block w-100">
                            @if(Session::get(SESSION_KEY_LEVEL) > 0)
                            <div class="row align-items-center">
                                <div class="col-lg-11 p-0">
                                    <h5 class="f-w-600 col-form-label-fz-15 sub-title mx-0">@lang('app.booking-table-manage.update.title-left')</h5>
                                </div>
                                <div class="col-lg-1">
                                    <div class="group-icon-gift">
                                        <div id="icon-gift-update">
                                            <img src="/images/tms/gift.gif" alt="hình lỗi" data-toggle="tooltip" data-placement="top"
                                                 data-original-title="Sửa quà tặng" >
                                            <label id="total-gift-update-booking-table">0</label>
                                        </div>
                                        <ul class="group-gift-selected  d-none" id="booking-table-update-gift">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @else
                                <div class="row align-items-center">
                                    <div class="col-lg-12 p-0">
                                        <h5 class="f-w-600 col-form-label-fz-15 sub-title mx-0">@lang('app.booking-table-manage.update.title-left')</h5>
                                    </div>
                                </div>
                            @endif
                            <div class="table-responsive new-table m-t-10">
                                <table class="table " id="table-food-update-booking-table-manage">
                                    <div class="select-filter-dataTable">
                                        <div class="form-validate-select ">
                                            <div class="col-lg-12 mx-0 px-0">
                                                <div class="col-lg-12 pr-0 select-material-box">
                                                    <select id="select-category-update-booking-table-manage" class="js-example-basic-single select2-hidden-accessible">
                                                        <option value="-1" selected>@lang('app.booking-table-manage.update.type')</option>
                                                        <option value="1">@lang('app.booking-table-manage.update.food')</option>
                                                        <option value="2">@lang('app.booking-table-manage.update.drink')</option>
                                                        <option value="3">@lang('app.booking-table-manage.update.other')</option>
                                                        <option value="6">@lang('app.booking-table-manage.update.combo')</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-validate-select ">
                                            <div class="col-lg-12 mx-0 px-0">
                                                <div class="col-lg-12 pr-0 select-material-box">
                                                    <select id="select-food-update-booking-table-manage" class="js-example-basic-single select2-hidden-accessible">
                                                        <option disabled selected hidden>@lang('app.booking-table-manage.create.select-food')</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <thead>
                                        <tr>
                                            <th class=" w-40">@lang('app.booking-table-manage.update.name')</th>
                                            <th class="text-center w-10">@lang('app.booking-table-manage.update.quantity')</th>
                                            <th class="text-center w-15">@lang('app.booking-table-manage.update.price')</th>
                                            <th class="text-center w-15">@lang('app.booking-table-manage.update.total-amount')</th>
                                            <th class="text-center w-10"></th>
                                            <th class="d-none"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill pl-0" id="information-update-booking-table-manage">
                        <div class="card card-block flex-sub mx-0">
                            <h5 class="f-w-600 sub-title mx-0 col-form-label-fz-15"
                                id="boxlist-update-booking-table-manage">@lang('app.booking-table-manage.update.title-right')</h5>
                            <div class="row mt-2">
                                <div class="col-lg-12 mx-0 px-0">
                                    <div class="col-lg-12 pr-0 select-material-box" style="padding: 6px 0">
                                        <select id="branch-update-booking-table-manage"
                                                class="js-example-basic-single select2-hidden-accessible"
                                                tabindex="-1" aria-hidden="true">
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', ENUM_SELECTED)->all() as $db)
                                                <option value="{{$db['id']}}">{{$db['name']}}
                                            @endforeach
                                        </select>
                                        <label class="icon-validate">
                                            @lang('app.employee-manage.create.branch')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.update.type')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="type-update-booking-table-manage"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.update.customer-name')</label>
                                    <h6  id="customer-name-update-booking-table-manage"
                                         class="f-w-400 text-muted col-form-label-fz-15"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.update.customer-phone')</label>
                                    <h6  id="customer-phone-update-booking-table-manage"
                                         class="f-w-400 text-muted col-form-label-fz-15"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.update.employee')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="employee-update-booking-table-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.update.create')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="create-update-booking-table-manage"></h6>
                                </div>
                            </div>
                            <div class="d-none" id="div-table-text">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.update.area')</label>
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15" id="area-update-booking-table-manage"></h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.update.table')</label>
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15" id="table-update-booking-table-manage"></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="d-none" id="div-table-update">
                                <div class="form-group row py-2" style="margin-bottom: 0 !important;">
                                    <div class="col-lg-12 pr-0 select-material-box">
                                        <select id="area-select-update-booking-table-manage"
                                                class="js-example-basic-single"></select>
                                        <label class="" for="area-select-update-booking-table-manage">@lang('app.booking-table-manage.update.area')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row py-2" style="margin-bottom: 0 !important;">
                                    <div class="col-lg-12 pr-0 select-material-box">
                                        <select  id="table-select-update-booking-table-manage"
                                                class="js-example-basic-single" multiple data-select="1"></select>
                                        <label style="margin-bottom: 0; top: -12px;" for="table-select-update-booking-table-manage">@lang('app.booking-table-manage.update.table')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <h5 class="text-bold sub-title">@lang('app.booking-table-manage.update.price-title')</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.update.receive-deposit-time')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="receive-deposit-time-update-booking-table-manage"></h6>
                                </div>
                                <div class="col-lg-6 d-none">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">Tiền cọc</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="deposit-received-update-booking-table-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.update.return-deposit-time')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="return-deposit-time-update-booking-table-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.update.return-deposit-amount')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15"  id="return-deposit-amount-update-booking-table-manage"></h6>
                                </div>

                            </div>
                            <div class="border-dashed mb-4"></div>
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input id="number-update-booking-table-manage" data-number="1"  data-min="1" data-max="999" class="form-control text-right" >
                                    <label for="number-update-booking-table-manage">
                                        @lang('app.booking-table-manage.update.number')</label>
                                </div>
                            </div>
                            @if(Session::get(SESSION_KEY_LEVEL) > 0)
                            <div class="form-group validate-group">
                                <div class="select-material-box">
                                    <select id="hash-update-tag-booking-table-manage" class="js-example-basic-single " multiple></select>
                                    <label for="hash-update-tag-booking-table-manage">
                                        @lang('app.booking-table-manage.update.tag')
                                       </label>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-6 form-group validate-group pl-0">
                                    <div class="form-validate-input">
                                        <input type="text" id="booking-update-booking-table-manage"
                                               class="input-sm form-control text-center input-datetimepicker p-1" >
                                        <label for="booking-update-booking-table-manage">
                                            @lang('app.booking-table-manage.create.time')
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6 form-group validate-group pr-0">
                                    <div class="form-validate-input">
                                        <input type="text" id="booking-time-update-booking-table-manage"
                                               class="input-sm form-control text-center input-datetimepicker p-1" autocomplete="off"
                                               >
                                        <label for="booking-time-update-booking-table-manage">
                                            @lang('app.booking-table-manage.create.hour')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 form-group validate-group pl-0">
                                    <div class="form-validate-input">
                                        <input id="deposit-amount-update-booking-table-manage" disabled data-type="currency-edit" class="form-control text-right" value="0" data-money="1" data-max="500000000">
                                        <label class="" style="max-width: 100%; pointer-events: unset">
                                            <label>Tiền cọc</label>
                                            <i style="font-size: 14px;margin: 0 0 3px 10px; cursor: pointer" class="fi-rr-pencil edit-deposit-amount-btn" onclick="editDepositAmountBookingTable()" data-toggle="tooltip" data-placement="top"
                                               data-original-title="Chỉnh sửa cọc"></i>
                                            <i style="font-size: 14px;margin: 0 0 3px 10px; cursor: pointer" class="fi-rr-disk d-none save-deposit-amount-btn" onclick="saveUpdateDepositBookingTableManage()" data-toggle="tooltip" data-placement="top"
                                               data-original-title="Lưu lại"></i>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group select2_theme validate-group pr-0">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="deposit-amount-payment-method-update-booking-table-manage"
                                                        class="js-example-basic-single col-sm- select2-hidden-accessible">
                                                    <option
                                                        value="1" selected>@lang('app.booking-table-manage.update.opt-cash')</option>
                                                </select>
                                                <label>
                                                    @lang('app.booking-table-manage.update.deposit-amount-type')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea class="form__field" id="note-update-booking-table-manage" cols="5" rows="3" data-note-max-length="255"></textarea>
                                        <label for="note-update-booking-table-manage" class="form__label icon-validate">
                                            @lang('app.booking-table-manage.update.note')
                                        </label>
                                        <div class="textarea-character"><span>0/255</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group border-dashed pb-3 mb-0">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea class="form__field" id="orther-requirements-update-booking-table-manage" cols="5" rows="3" data-note-max-length="255"></textarea>
                                        <label for="orther-requirements-update-booking-table-manage" class="form__label icon-validate">
                                            @lang('app.booking-table-manage.update.orther-requirements')
                                        </label>
                                        <div class="textarea-character"><span>0/255</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="w-100">
                                    <span
                                        class="m-b-10 pr-2 f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.update.total-final'):</span>
                                    <label id="total-final-update-booking-table-manage"
                                        class="text-muted f-w-400 text-muted col-form-label-fz-15 col-form-label-fz-15">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-green seemt-btn-hover-green seemt-bg-green d-none"
                     id="btn-confirm-deposit-modal-update-booking-table-manage"
                     onclick="confirmDepositBookingTableManage()">
                    <i class="fi-rr-check"></i>
                    <span>@lang('app.booking-table-manage.update.confirm-deposit-btn')</span>
                </div>
                <div class="btn seemt-red seemt-btn-hover-red seemt-bg-red d-none"
                     id="btn-return-deposit-modal-update-booking-table-manage"
                     onclick="returnDepositBookingTableManage()">
                    <i class="fi-rr-undo"></i>
                    <span>@lang('app.booking-table-manage.update.return-deposit-btn')</span>
                </div>
                <div class="btn seemt-red seemt-btn-hover-red seemt-bg-red"
                     id="btn-cancel-modal-update-booking-table-manage"
                     onclick="cancelBookingTableManage()">
                    <i class="fi-rr-trash"></i>
                    <span>@lang('app.booking-table-manage.update.cancel-btn')</span>
                </div>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     id="btn-save-modal-update-booking-table-manage"
                     onclick="saveModalUpdateBookingTableManage()"
                     onkeypress="saveModalUpdateBookingTableManage()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-cancel-booking-table-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.booking-table-manage.cancel.title')</h4>
                <button type="button" class="close" onclick="closeCancelBookingTableManage()" onkeypress="closeCancelBookingTableManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-detail-booking-table-manage">
                <div class="card card-block m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-textarea">
                            <div class="form__group pt-2">
                                <textarea class="form__field" id="reason-cancel-booking-table-manage" cols="5" rows="5" data-note="1" data-note-max-length="255"></textarea>
                                <label for="reason-cancel-booking-table-manage" class="form__label icon-validate">
                                    Lý do huỷ
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
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveCancelBookingTableManage()"
                     onkeypress="saveCancelBookingTableManage()"
                     title="@lang('app.component.button.save')"
                     id="btn-save-cancel-modal-update-booking-table-manage">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-update-deposit-booking-table-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-update-reposit-title"></h4>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-detail-booking-table-manage">
                <div class="row d-flex">
                    <div class="col-lg-12 edit-flex-auto-fill">
                        <div class="card card-block w-100 my-0">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label-fz-15 my-auto font-weight-bold">Tiền cọc</label>
                                <div class="col-sm-9">
                                    <input id="update-deposit-amount-booking-table-manage"
                                           data-type="currency-edit"
                                           class="form-control text-right" value="100"
                                           data-money="1" data-min="100"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-sm-3 col-form-label-fz-15 my-auto font-weight-bold">@lang('app.booking-table-manage.update.deposit-amount-type')</label>
                                <div class="col-sm-9">
                                    <select id="deposit-amount-payment-method-update-deposit-booking-table-manage"
                                            class="js-example-basic-single">
                                        <option value="1"
                                                selected>@lang('app.booking-table-manage.update.opt-cash')</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled waves-effect"
                        onclick="closeUpdateDepositBookingTableManage()"
                        onkeypress="closeUpdateDepositBookingTableManage()" title="@lang('app.component.button.close')">
                    @lang('app.component.button.close')
                </button>
                <button type="button" class="btn btn-primary waves-effect"
                        onclick="saveUpdateDepositBookingTableManage()"
                        onkeypress="saveUpdateDepositBookingTableManage()" title="@lang('app.component.button.save')"
                        id="btn-save-cancel-modal-update-booking-table-manage">
                    @lang('app.component.button.save')
                </button>
            </div>
        </div>
    </div>
</div>
<select id="select-all-update-booking" class="d-none"></select>
<select id="select-food-update-booking" class="d-none"></select>
<select id="select-drink-update-booking" class="d-none"></select>
<select id="select-other-update-booking" class="d-none"></select>
<select id="select-combo-update-booking" class="d-none"></select>
@push('scripts')
    <script type="text/javascript" src="/js/manage/booking_table/update.js?version=2"></script>
{{--    <script type="text/javascript" src="/js/marketing/gift/gift/detail.js?version=1"></script>--}}
{{--    <script type="text/javascript" src="/js/manage/booking_table/gift.js?version=3"></script>--}}
@endpush
