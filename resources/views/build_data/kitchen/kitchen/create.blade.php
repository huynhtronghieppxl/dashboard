<div class="modal fade" id="modal-create-kitchen-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.kitchen-data.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateKitchenData()"
                        onkeypress="closeModalCreateKitchenData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left">
                <div class="card card-block m-0">
                    <div id="create-kitchen-modal">
                        <div class="form-group validate-group">
                            <div class="form-validate-input">
                                <input type="text" id="name-create-kitchen-data"
                                       class="form-control" data-empty="1" data-min-length="2" data-spec="1"
                                       data-max-length="50">
                                <label for="name-create-employee-manage">
                                    @lang('app.kitchen-data.create.name')
                                    @include('layouts.start')
                                </label>
                                <div class="line"></div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div class="form-group validate-group m-t-10">
                            <div class="form-validate-textarea">
                                <div class="form__group pt-2 mb-2">
                                    <textarea class="form__field" rows="5" cols="5" id="description-create-kitchen-data"
                                              spellcheck="false" data-note-max-length="1000"></textarea>
                                    <label for="description-create-kitchen-data"
                                           class="form__label icon-validate">@lang('app.kitchen-data.create.description')</label>
                                    <div class="textarea-character" id="char-count">
                                        <span>0/300</span>
                                    </div>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="type-kitchen-create-kitchen-data">
                            <div class=" form-group checkbox-group">
                                <label class="title-checkbox">@lang('app.kitchen-data.create.type')</label>
                                <div class="row">
                                    <div class="form-validate-checkbox">
                                        <div class="checkbox-form-group">
                                            <input type="radio" value="0" class="" name="kitchen" checked/>
                                            <label class="name-checkbox"
                                                   for="print-kitchen-create-food-brand-manage"> @lang('app.kitchen-data.create.type-bar')
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-validate-checkbox">
                                        <div class="checkbox-form-group">
                                            <input type="radio" class="" value="1" name="kitchen"/>
                                            <label class="name-checkbox"
                                                   for="print-kitchen-create-food-brand-manage">@lang('app.kitchen-data.create.type-kitchen')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-checkbox">
                            <div class="checkbox-form-group">
                                <input type="checkbox" id="setting-printer">
                                <label class="name-checkbox"
                                       for="setting-printer">@lang('app.kitchen-data.setting-print')</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-none" id="select-type-print-machine">
                        <div class="form-group select2_theme validate-group">
                            <div class="form-validate-select ">
                                <div class="col-lg-12 mx-0 px-0">
                                    <div class="col-lg-12 pr-0 select-material-box">
                                        <select id="select-type-print-create-kitchen-data"
                                                class="js-example-basic-single select2-hidden-accessible"
                                                data-select="1" tabindex="-1" aria-hidden="true">
                                            <option value disabled selected>Vui lòng chọn</option>
                                            <option value="0">Máy in LAN/WIFI</option>
                                            <option value="1">Máy in IMIN</option>
                                            <option value="2">Máy in SUNMI</option>
                                        </select>
                                        <label class="icon-validate">
                                            Loại máy in
                                            @include('layouts.start')
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div class="d-none" id="input-info-print-kitchen-data">
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input type="text" id="printer-name-create-kitchen-data"
                                           style="padding-right: 100px !important;"
                                           class="form-control" data-empty="1" data-min-length="2"
                                           data-max-length="50">
                                    <label for="printer-name-create-kitchen-data">
                                        @lang('app.kitchen-data.create.printer-name')
                                        @include('layouts.start')
                                    </label>
                                    <div class="line"></div>
                                    <div class="tool-tip" style="top: 20px; right: 16px; height: 0"><i
                                                class="fi-rr-exclamation pointer" data-toggle="tooltip"
                                                data-placement="top"
                                                data-original-title="Tên tạo máy in"></i></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input type="text" class="form-control input-tooltip"
                                           style="padding-right: 100px !important;" id="printer-ip-create-kitchen-data"
                                           data-tooltip="1" data-ip="1" data-empty="1" data-max-length="20">
                                    <label for="printer-ip-create-kitchen-data">
                                        @lang('app.kitchen-data.create.printer-ip')
                                        @include('layouts.start')
                                    </label>
                                    <div class="line"></div>
                                    <div class="tool-tip" style="top: 20px; right: 16px; height: 0"><i
                                                class="fi-rr-exclamation pointer" data-toggle="tooltip"
                                                data-placement="top"
                                                data-original-title="ip tạo máy in"></i></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group row align-items-baseline">
                                <label class="f-w-600 col-form-label-fz-15 pr-4">@lang('app.kitchen-data.create.printer-port')
                                    :</label>
                                <h6 class="f-w-400 text-muted col-form-label-fz-15">@lang('app.kitchen-data.create.port-printer')</h6>
                            </div>
                        </div>
                    </div>
                    <div class="d-none" id="box-setting-printer">
                        <div class=" form-group checkbox-group" id="size-create-print-kitchen-data">
                            <label class="title-checkbox">@lang('app.kitchen-data.create.printer-paper-size')</label>
                            <div class="row">
                                <div class="form-validate-checkbox">
                                    <div class="checkbox-form-group">
                                        <input type="radio" name="size" class="" value="80" checked/>
                                        <label class="name-checkbox"
                                               for="print-kitchen-create-food-brand-manage"> @lang('app.kitchen-data.create.printer-paper-size-two')
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class=" form-group checkbox-group" id="status-create-print-kitchen-data">
                            <label class="title-checkbox">@lang('app.kitchen-data.create.is-have-printer') </label>
                            <div class="row">
                                <div class="form-validate-checkbox">
                                    <div class="checkbox-form-group">
                                        <input type="radio" name="status" value="0" class="" data-icon=""/>
                                        <label class="name-checkbox"
                                               for="print-kitchen-create-food-brand-manage">@lang('app.kitchen-data.create.is-have-printer-off')
                                        </label>
                                    </div>
                                </div>
                                <div class="form-validate-checkbox">
                                    <div class="checkbox-form-group">
                                        <input type="radio" name="status" class="" value="1"/>
                                        <label class="name-checkbox"
                                               for="print-kitchen-create-food-brand-manage"> @lang('app.kitchen-data.create.is-have-printer-on')
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group validate-group">
                            <div class="form-validate-checkbox">
                                <div class="checkbox-form-group">
                                    <input type="checkbox" id="status-create-is-each-print-kitchen-data"
                                           data-tooltip="1" data-toggle="tooltip"
                                           data-placement="top" @lang('app.kitchen-data.create.is_print_each_food_note') />
                                    <label class="name-checkbox"
                                           for="status-create-is-each-print-kitchen-data">@lang('app.kitchen-data.create.is_print_each_food')</label>
                                </div>
                                <div class="tool-tip" style="top: 0; right: -17px"><i class="fi-rr-exclamation pointer"
                                                                                      data-toggle="tooltip"
                                                                                      data-placement="top"
                                                                                      data-original-title="Muốn in từng món trên 1 bill hay không ?"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none" data-toggle="tooltip" data-placement="top"
                        data-original-title="Đặt lại"
                        onclick="resetModalCreateKitchenData()"
                        onkeypress="resetModalCreateKitchenData()">
                    <i class="fa fa-eraser"></i>
                </button>
                <div id="save-create-btn-kitchen-data" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreateKitchenData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/kitchen/kitchen/create.js?version=6', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
