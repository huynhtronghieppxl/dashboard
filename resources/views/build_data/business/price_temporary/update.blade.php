<div class="modal fade" id="modal-update-price-temporary" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document" id="size-modal-create-payment-bill">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.price-temporary.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdatePriceTemporary()"
                        onkeypress="closeModalUpdatePriceTemporary()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color pb-0" id="loading-create-payment-bill">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill pl-0">
                        <div class="card card-block w-100">
                            <h5 class="text-bold sub-title mx-0 f-w-600">@lang('app.price-temporary.update.food-table')</h5>
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single"
                                                    id="select-category-food-update-price-temporary">
                                                <option value="-1" selected>@lang('app.component.option-all')</option>
                                                <option value="1">@lang('app.price-temporary.update.food')</option>
                                                <option value="2">@lang('app.price-temporary.update.drink')</option>
                                                <option value="3">@lang('app.price-temporary.update.other')</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single"
                                                    id="select-food-update-price-temporary">
                                                <option disabled selected
                                                        hidden>@lang('app.component.option_default')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table class="table fix-size-table" id="table-food-update-price-temporary">
                                    <thead>
                                    <tr>
                                        <th class="">STT</th>
                                        <th class="">@lang('app.price-temporary.update.avatar')</th>
                                        <th class="">@lang('app.price-temporary.update.name')</th>
                                        <th class="">Giá bán</th>
                                        <th class="">Giá thời vụ</th>
                                        <th class=""></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill p-0">
                        <div class="card card-block flex-sub">
                            <div class="form-group row">
                                <h5 class="sub-title w-100 f-w-600 text-bold">@lang('app.price-temporary.update.infomation')</h5>
                                <label class="mt-2 text-danger">
                                    @lang('app.price-temporary.update.note')
                                </label>
                            </div>
                            <div class="row">
                                <div class="form-group validate-group mt-2 col-lg-6 pl-0">
                                    <div class="form-validate-input d-flex">
                                        <input type="text" id="date-in-price-temporary"
                                               class="input-sm form-control  input-datetimepicker p-1"
                                               data-date="1" autocomplete="off" value="{{date('d/m/Y')}}">
                                        <label for="date-in-price-temporary">
                                            @lang('app.price-temporary.update.start-date') @include('layouts.start')
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <div class="form-group validate-group mt-2 col-lg-6 pr-0">
                                    <div class="form-validate-input d-flex">
                                        <input class="form-control  input-sm p-1 "
                                               id="check-in-update-time-price-temporary" type="text" placeholder="00:00"
                                               autocomplete="off"/>
                                        <label for="date-in-price-temporary">Giờ bắt đầu @include('layouts.start')
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group validate-group col-lg-6 pl-0">
                                    <div class="form-validate-input d-flex">
                                        <input type="text" id="date-out-price-temporary"
                                               class="input-sm form-control  input-datetimepicker p-1"
                                               data-date="1" autocomplete="off" value="{{date('d/m/Y')}}">
                                        <label for="date-out-price-temporary">
                                            @lang('app.price-temporary.update.end-date')
                                            @include('layouts.start')
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <div class="form-group validate-group col-lg-6 pr-0 ">
                                    <div class="form-validate-input d-flex">
                                        <input class="form-control  input-sm p-1 "
                                               id="check-out-update-time-price-temporary" type="text"
                                               placeholder="00:00"
                                               autocomplete="off"/>
                                        <label for="date-out-price-temporary">
                                            Giờ kết thúc @include('layouts.start')
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                            </div>
                            <div class="form-group checkbox-group">
                                <div class="row">
                                    <div class="form-validate-checkbox radio-update-price-temporary col-lg-6 m-0 pl-0">
                                        <div class="checkbox-form-group">
                                            <input type="radio" name="gender" value="1" data-type="1" checked="">
                                            <label class="name-checkbox" for="print-kitchen-create-food-brand-manage">Tăng
                                                giá
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-validate-checkbox radio-update-price-temporary col-lg-6 m-0">
                                        <div class="checkbox-form-group">
                                            <input type="radio" name="gender" value="2" data-type="2">
                                            <label class="name-checkbox" for="print-kitchen-create-food-brand-manage">Giảm
                                                giá
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select">
                                        <div class="mx-0 px-0">
                                            <div class="pr-0 select-material-box" id="select-update-price-temporary">
                                                <select id="select-format-update-temporary-price"
                                                        class="js-example-basic-single select2-hidden-accessible">
                                                    <option
                                                            value="1">@lang('app.price-temporary.update.by-price')</option>
                                                    <option
                                                            value="2">@lang('app.price-temporary.update.by-percent')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    </i>@lang('app.price-temporary.update.format')@include('layouts.start')
                                                </label>
                                                <div class="line"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input type="text" id="price-temporary-food" class="disabled" disabled
                                           data-min="100" data-type="currency-edit"
                                           data-max="999999999">
                                    <label for="price-temporary-food">
                                        Giá tiền
                                        @include('layouts.start') </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>

                            </div>
                            <div class=" form-group validate-group d-none">
                                <div class="form-validate-input">
                                    <input type="text" id="percent-temporary-food" class="" value="0"
                                           data-percent="1" data-min="0" data-number="1">
                                    <label for="percent-temporary-food">
                                        Phần trăm @include('layouts.start')</label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none"
                        onclick="resetModalUpdatePriceTemporary()" data-toggle="tooltip" data-placement="top"
                        data-original-title="Đặt lại"
                        onkeypress="resetModalUpdatePriceTemporary()">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-orange seemt-bg-orange seemt-btn-hover-orange"
                     onclick="saveModalUpdatePriceTemporary()"
                     onkeypress="saveModalUpdatePriceTemporary()">
                    <i class="fi-rr-disk"></i>
                    <span>Áp dụng</span>
                </div>
            </div>
        </div>
    </div>
</div>
<select id="select-all-create-booking" class="d-none"></select>
<select id="select-food-create-booking" class="d-none"></select>
<select id="select-drink-create-booking" class="d-none"></select>
<select id="select-other-create-booking" class="d-none"></select>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js\build_data\business\price_temporary\update.js?version=5', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

