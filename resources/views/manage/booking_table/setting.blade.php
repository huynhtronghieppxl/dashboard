<div class="modal fade" id="modal-setting-booking-table-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.booking-table-manage.setting.title')</h4>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-modal-setting-booking-table-manage">
                <div class="card card-block">
                    <div class="card-block">
                        <h4 class="font-weight-bold">&emsp;@lang('app.booking-table-manage.setting.content1')</h4>
                        <h4 class="font-weight-bold">&emsp;@lang('app.booking-table-manage.setting.content2')</h4>
                        <div class="owl-carousel carousel-dot owl-theme">
                            <div class="item">
                                <img class="d-block img-fluid" src=""
                                     alt="Image">
                            </div>
                            <div class="item">
                                <img class="d-block img-fluid" src=""
                                     alt="Image">
                            </div>
                            <div class="item">
                                <img class="d-block img-fluid" src=""
                                     alt="Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="checkbox-zoom zoom-primary m-auto">
                    <label>
                        <input type="checkbox" id="check-setting-booking-table-manage">
                        <span class="cr">
                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                        </span>
                        <span class="font-weight-bold">@lang('app.booking-table-manage.setting.validate')</span>
                    </label>
                </div>
                <button type="button" class="btn btn-grd-disabled waves-effect"
                        onclick="closeModalSettingBookingManage()"
                        onkeypress="closeModalSettingBookingManage()" title="Đóng">Đóng</button>
                <button type="button" id="btn-save-setting-booking-table-manage"
                        class="btn btn-warning waves-effect waves-light d-none"
                        onclick="saveModalSettingBookingManage()"
                        onkeypress="saveModalSettingBookingManage()">@lang('app.booking-table-manage.setting.save')</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/booking_table/setting.js?version=3')}}"></script>
@endpush
