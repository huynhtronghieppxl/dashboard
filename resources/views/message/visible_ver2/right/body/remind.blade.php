<div class="modal fade" id="modal-remind-time-visible" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document" id="tab-size">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title title-h5-create-material">Tạo nhắc hẹn</h5>
            </div>
            <div class="modal-body text-left" id="modal-body-remind-time-visible">
                <div class="">
                    <div class="row">
                        <div class="contain-remind-time-visible">
                            <div class="contain-remind-time-visible-text">Nhập nội dung</div>
                            <div type="text" class="input-remind-time-visible" contenteditable id="input-remind-time-visible" placeholder="Nhập nội dung hoặc gắn link"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="contain-remind-time-visible">
                            <div class="contain-remind-time-visible-text">Chọn thời gian</div>
                            <div type="text" class="contain-remind-time-visible-select" id="contain-remind-time-visible-select">
                                <div class="contain-remind-time-visible-option active">15 phút nữa</div>
                                <div class="contain-remind-time-visible-option">30 phút nữa</div>
                                <div class="contain-remind-time-visible-option">9:00 ngày mai</div>
                                <div class="contain-remind-time-visible-option">Khác</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="contain-remind-time-visible">
                            <div class="contain-remind-time-visible-text">Chọn ngày nhắc hẹn</div>
                            <div class="row w-100 ml-0 mr-0 mt-3">
                                <div class="col-6 form-group validate-group pl-0">
                                    <div class="form-validate-input">
                                        <input type="text" id="date-remind-time" class="input-sm form-control text-center input-datetimepicker p-1" value="05/10/2022">
                                        <label for="date-create-booking-table-manage">
                                            <i class="icofont icofont-ui-calendar"></i>
                                            Ngày nhắc hẹn
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <div class="col-6 form-group validate-group pr-0">
                                    <div class="form-validate-input">
                                        <input type="text" id="hours-remind-time" class="input-sm form-control text-center input-datetimepicker p-1" value="16:17">
                                        <label for="hour-create-booking-table-manage">
                                            <i class="icofont icofont-ui-alarm"></i>
                                            Giờ nhắc hẹn
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="contain-remind-time-visible">
                            <div class="contain-remind-time-visible-text">Chọn kiểu lặp lại</div>
                            <div class="col-lg-12 form-group select2_theme validate-group p-0 pt-2">
                                <div class="form-validate-select ">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="remind-select-message" class="js-example-basic-single col-sm- select2-hidden-accessible">
                                                <option value="1">Hằng ngày</option>
                                                <option value="2">Hằng tuần</option>
                                                <option value="3">Hằng tháng</option>
                                            </select>
                                            <label>
                                                <i class="typcn typcn-document-text"></i>@lang('app.booking-table-manage.create.deposit-amount-type')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-custom">
                <button id="btn-close-create-material" type="button" class="btn btn-grd-disabled" onclick="closeModalRemindTime()">@lang('app.component.button.close')</button>
                <button id="btn-save-create-material" type="button" class="btn btn-grd-primary" onclick="">@lang('app.component.button.save')</button>
            </div>
        </div>
    </div>
</div>


@push('scripts')
{{--    <script type="text/javascript" src="{{ asset('js\build_data\material\material\create.js?version=11',env('IS_DEPLOY_ON_SERVER'))}}"></script>--}}
@endpush
