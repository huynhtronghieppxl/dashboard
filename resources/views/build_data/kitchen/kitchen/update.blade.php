<div class="modal fade" id="modal-update-kitchen-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.kitchen-data.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateKitchenData()"
                        onkeypress="closeModalUpdateKitchenData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body mb-0" id="loading-modal-update-kitchen-data">
                <div class="card card-block m-0">
                    <div class="" id="update-kitchen-modal">
                        <div class="form-group validate-group">
                            <div class="form-validate-input">
                                <input type="text" id="name-update-kitchen-data"
                                       class="form-control" data-empty="1" data-min-length="2" data-spec="1"
                                       data-max-length="50">
                                <label for="name-update-kitchen-data">
                                    @lang('app.kitchen-data.update.name')
                                    @include('layouts.start')
                                </label>
                                <div class="line"></div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div class="form-group validate-group m-t-10">
                            <div class="form-validate-textarea">
                                <div class="form__group pt-2 mb-2">
                                    <textarea class="form__field" rows="5" cols="5" id="description-update-kitchen-data"
                                              spellcheck="false" data-note-max-length="1000"></textarea>
                                    <label for="description-update-kitchen-data"
                                           class="form__label icon-validate">@lang('app.kitchen-data.update.description')</label>
                                    <div class="textarea-character" id="char-count">
                                        <span>0/300</span>
                                    </div>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="type-kitchen-update-kitchen-data">
                            <div class="form-group" id="type-kitchen-create-kitchen-data">
                                <div class=" form-group checkbox-group">
                                    <label class="title-checkbox">@lang('app.kitchen-data.update.type')</label>
                                    <div class="row">
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" value="0" disabled class="" name="inventory"
                                                       style="cursor: not-allowed;"/>
                                                <label class="name-checkbox"
                                                       for="print-kitchen-create-food-brand-manage">@lang('app.kitchen-data.update.type-bar')
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="radio" class="" disabled value="1" name="inventory"
                                                       style="cursor: not-allowed;"/>
                                                <label class="name-checkbox"
                                                       for="print-kitchen-create-food-brand-manage">@lang('app.kitchen-data.update.type-kitchen')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-checkbox">
                            <div class="checkbox-form-group">
                                <input type="checkbox" id="check-update-setting-printer">
                                <label class="name-checkbox"
                                       for="check-update-setting-printer">@lang('app.kitchen-data.setting-print')</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-none" id="update-setting-printer">
                        <div class="form-group select2_theme validate-group" id="select-print-machine-cashier">
                            <div class="form-validate-select">
                                <div class="col-lg-12 mx-0 px-0">
                                    <div class="col-lg-12 pr-0 select-material-box">
                                        <select class="select-type-print-update-kitchen-data js-example-basic-single select2-hidden-accessible"
                                                data-select="1" tabindex="-1" aria-hidden="true">
                                            <option value="-1" disabled selected>Vui lòng chọn</option>
                                            <option value="0">Máy in LAN/WIFI</option>
                                            <option value="1">Máy in IMIN</option>
                                            <option value="2">Máy in SUNMI</option>
                                        </select>
                                        <label class="icon-validate">@lang('app.kitchen-data.update.type-printer')@include('layouts.start')</label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div class="form-group select2_theme validate-group" id="select-print-machine-not-cashier">
                            <div class="form-validate-select">
                                <div class="col-lg-12 mx-0 px-0">
                                    <div class="col-lg-12 pr-0 select-material-box">
                                        <select class="select-type-print-update-kitchen-data js-example-basic-single select2-hidden-accessible"
                                                data-select="1" tabindex="-1" aria-hidden="true">
                                            <option value="-1" disabled selected>Vui lòng chọn</option>
                                            <option value="0">Máy in LAN/WIFI</option>
                                        </select>
                                        <label class="icon-validate">@lang('app.kitchen-data.update.type-printer')@include('layouts.start')</label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div class="d-none" id="inputs-type-print-machine-update-kitchen-data">
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input type="text" style="padding-right: 86px !important;" class="form-control"
                                           id="printer-name-update-kitchen-data"
                                           data-min-length="2" data-max-length="50" data-empty="1"/>
                                    <label class="icon-validate">@lang('app.kitchen-data.update.printer-name')@include('layouts.start')</label>
                                    <div class="line"></div>
                                    <div class="tool-tip" style="height: 0; top: 20px; right: 16px"><i
                                                class="fi-rr-exclamation pointer"
                                                data-toggle="tooltip" data-placement="top"
                                                data-original-title="Tên cập nhật máy in"></i></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input type="text" class="form-control input-tooltip"
                                           id="printer-ip-update-kitchen-data" data-max-length="20" data-tooltip="1"
                                           data-original-title="IP cập nhật máy in" data-empty="1" data-ip="1"/>
                                    <label class="icon-validate">@lang('app.kitchen-data.update.printer-ip')@include('layouts.start')</label>
                                    <div class="line"></div>
                                    <div class="tool-tip" style="height: 0; top: 20px; right: 16px"><i
                                                class="fi-rr-exclamation pointer"
                                                data-toggle="tooltip" data-placement="top"
                                                data-original-title="IP cập nhật máy in"></i></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group" id="type-update-kitchen-data">
                                <div class="form-validate-input d-none">
                                    <input
                                            type="text"
                                            class="form-control input-tooltip"
                                            id="printer-port-update-kitchen-data"
                                            data-empty="1" data-number="1" data-max-length="5" value="9100"/>
                                    <label class="icon-validate">@lang('app.kitchen-data.update.printer-port')@include('layouts.start')</label>
                                    <div class="line"></div>
                                    <div class="tool-tip" style="height: 0; top: 20px; right: 16px"><i
                                                class="fi-rr-exclamation pointer"
                                                data-toggle="tooltip" data-placement="top"
                                                data-original-title="Port cập nhật máy in"></i></div>
                                </div>
                                <div class="col-lg-12 row px-0" style="align-items: center">
                                    <label class="f-w-600 col-form-label-fz-15 pr-4">@lang('app.kitchen-data.update.printer-port')
                                        :</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15">@lang('app.kitchen-data.update.port-printer')</h6>
                                </div>
                            </div>
                        </div>
                        <div class=" form-group checkbox-group" id="select-paper-status-update-kitchen-data">
                            <label class="title-checkbox">@lang('app.kitchen-data.create.printer-paper-size')</label>
                            <div class="row" id="form-paper-status-kitchen-data">
                                <div class="form-validate-checkbox">
                                    <div class="checkbox-form-group">
                                        <input type="radio" name="size" class="" value="80" checked/>
                                        <label class="name-checkbox"
                                               for="print-kitchen-update-food-brand-manage"> @lang('app.kitchen-data.create.printer-paper-size-two')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-none" id="form-paper-stamp-kitchen-data">
                                <div class="form-validate-checkbox w-50 mr-0">
                                    <div class="checkbox-form-group">
                                        <input type="radio" name="size-stamp" class="" value="50" checked
                                               id="print-size-50-kitchen-update"/>
                                        <label class="name-checkbox" for="print-size-50-kitchen-update"> 50mm </label>
                                    </div>
                                </div>
                                <div class="form-validate-checkbox w-50 mr-0">
                                    <div class="checkbox-form-group">
                                        <input type="radio" name="size-stamp" class="" value="30"
                                               id="print-size-30-kitchen-update"/>
                                        <label class="name-checkbox" for="print-size-30-kitchen-update"> 30mm </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" form-group checkbox-group" id="select-printer-status-update-kitchen-data">
                            <label class="title-checkbox">@lang('app.kitchen-data.create.is-have-printer') </label>
                            <div class="row">
                                <div class="form-validate-checkbox w-50 mr-0">
                                    <div class="checkbox-form-group">
                                        <input type="radio" name="status" value="0" class="" data-icon=""/>
                                        <label class="name-checkbox"
                                               for="print-kitchen-create-food-brand-manage">@lang('app.kitchen-data.create.is-have-printer-off')
                                        </label>
                                    </div>
                                </div>
                                <div class="form-validate-checkbox w-50 mr-0">
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
                                    <input type="checkbox" id="status-update-is-each-print-kitchen-data">
                                    <label class="name-checkbox"
                                           for="status-update-is-each-print-kitchen-data">@lang('app.kitchen-data.update.is_print_each_food')</label>
                                </div>
                                <div class="tool-tip" style="top: 0; right: -17px;"><i class="fi-rr-exclamation pointer"
                                                                                       data-toggle="tooltip"
                                                                                       data-placement="top"
                                                                                       data-original-title="@lang('app.kitchen-data.update.is_print_each_food_note')"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div id="save-update-btn-kitchen-data" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalUpdateKitchenData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-none">
    <span id="msg-update-kitchen-data">@lang('app.kitchen-data.msg.name')</span>
    <span id="id-update-kitchen-data"></span>
    <span id="status-update-kitchen-data"></span>
    <span id="branch-id-update-kitchen-data"></span>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/kitchen/kitchen/update.js?version=8', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
