<style>
    #new_header .topbar {
        z-index: 9997 !important;
    }

    #modal-update-material-data {
        z-index: 9998 !important;
    }

    #modal-detail-material-data {
        z-index: 1000000 !important;
    }
</style>
<div class="modal fade" id="modal-update-material-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title title-h5-update-material">@lang('app.material-data.update.title')</h5>
                <h5 class="modal-title d-none title-h5-create-unit" id="">@lang('app.unit-data.create.title')</h5>
                <h5 class="modal-title d-none title-h5-create-specifications"
                    id="">@lang('app.specifications-data.create.title')</h5>
                <h5 id="status-update-material-data"></h5>
                <button type="button" class="close" onclick="closeModalUpdateMaterialData()"
                        onkeypress="closeModalUpdateMaterialData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="modal-body-update-material">
                <div class="card-block card m-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input id="name-update-material-data" class="form-control" type="text" data-spec="1"
                                           data-empty="1" data-min-length="2" data-max-length="50">
                                    <label for="name-update-material-data">
                                        @lang('app.material-data.update.name')
                                        @include('layouts.start')
                                    </label>
                                </div>
                                <div class="link-href"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select">
                                    <div class="mx-0 px-0">
                                        <div class="pr-0 select-material-box">
                                            <select id="sub-inventory-update-material-data"
                                                    class="sub-inventory-update-material-data js-example-basic-single select2-hidden-accessible"
                                                    data-select="1">
                                                <option disabled selected
                                                        hidden>@lang('app.component.option_default')</option>
                                            </select>
                                            <label class="icon-validate">
                                                @lang('app.material-data.update.sub-inventory')
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select">
                                    <div class="mx-0 px-0">
                                        <div class="pr-0 select-material-box">
                                            <select id="category-update-material-data"
                                                    class="js-example-basic-single select2-hidden-accessible"
                                                    data-select="1">
                                                <option disabled selected
                                                        hidden>@lang('app.component.option_default')</option>
                                            </select>
                                            <label class="icon-validate">
                                                <div class="d-inline">@lang('app.material-data.update.category')</div>
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select mb-0">
                                    <div class="mx-0 px-0">
                                        <div class="pr-0 select-material-box">
                                            <select id="unit-update-material-data"
                                                    class="js-example-basic-single select2-hidden-accessible"
                                                    data-select="1">
                                                <option disabled selected
                                                        hidden>@lang('app.component.option_default')</option>
                                            </select>
                                            <label class="icon-validate">
                                                @lang('app.material-data.update.unit')
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href d-flex" style="justify-content: space-between">
                                    <span class="text text-warning">@lang('app.material-data.link-href.title-unit') <a
                                            href="javascript:void(0)" class="text text-primary"
                                            onclick="openModalBodyCreate(3)">@lang('app.material-data.link-href.link')</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select mb-0">
                                    <div class="mx-0 px-0">
                                        <div class="pr-0 select-material-box">
                                            <select id="specifications-update-material-data"
                                                    class="js-example-basic-single select2-hidden-accessible"
                                                    data-select="1">
                                                <option disabled selected
                                                        hidden>@lang('app.component.option_default')</option>
                                            </select>
                                            <label class="icon-validate">
                                                @lang('app.material-data.update.specifications')
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href">
                                    <span class="text text-warning">@lang('app.material-data.link-href.title-specifications') <a
                                            href="javascript:void(0)" class="text text-primary"
                                            onclick="openModalBodyCreate(4)">@lang('app.material-data.link-href.link')</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input id="loss-update-material-data" class="form-control input-tooltip"
                                           data-type="currency-edit" value="0" data-tooltip="1" data-float="1"
                                           data-max="100">
                                    <label for="loss-update-material-data">
                                        @lang('app.material-data.update.loss')
                                        @include('layouts.start')
                                    </label>
                                    <div class="tool-tip">
                                        <i class="fi-rr-exclamation tooltip_formula text-inverse pointer"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           data-original-title="@lang('app.material-data.update.loss-title')"></i>
                                    </div>

                                </div>
                                <div class="link-href">
                                    <span class="text text-warning">
                                        @lang('app.material-data.link-href.title-loss') <a
                                            href="javascript:void(0)" class="text text-primary"
                                            onclick="openModalCalcCreateMaterialData()">@lang('app.material-data.link-href.link')</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input id="min-update-material-data" class="form-control input-tooltip"
                                           data-type="currency-edit" value="1" data-max="100000" data-float="1">
                                    <label for="min-update-material-data">
                                        @lang('app.material-data.update.min')
                                        @include('layouts.start')
                                    </label>
                                    <div class="tool-tip">
                                        <i class="fi-rr-exclamation tooltip_formula text-inverse pointer"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           data-original-title="@lang('app.material-data.update.min-title')"></i>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group validate-group">
                                <div class="form-validate-input mb-0">
                                    <input id="price-update-material-data" class="form-control" value="0"
                                           data-type="currency-edit" value="100" data-min="100"
                                           data-max="100000000">
                                    <label for="price-update-material-data">
                                        @lang('app.material-data.update.price')
                                        @include('layouts.start')
                                    </label>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <span class="text text-warning">* @lang('app.material-data.note.price')</span>
                            @if(Session::get(SESSION_KEY_SETTING_RESTAURANT)['is_enable_office_branch'] !== 0)
                                <div class="form-validate-checkbox mt-2">
                                    <div class="checkbox-form-group">
                                        <input id="is-office-create-material-data" name="is-office-create-material-data" type="checkbox">
                                        <label class="name-checkbox" for="is-office-create-material-data">@lang('app.material-data.update.material-office-text')<div class="tool-tip">
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea class="form__field" id="des-update-material-data" cols="5"
                                                  data-note-max-length="255"
                                                  rows="3"></textarea>
                                        <label for="des-update-material-data" class="form__label icon-validate">
                                            @lang('app.material-data.update.des')
                                        </label>
                                        <div class="textarea-character">
                                            <span>0/300</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h5 class="sub-title mb-1 ml-0">@lang('app.material-data.update.unit_sells')</h5>
                            <div class="table-responsive new-table">
                                <table id="table-update-selling-unit" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.material-data.update.unit_sell')</th>
                                        <th>@lang('app.material-data.update.value_change')</th>
                                        <th>@lang('app.material-data.update.cost')</th>
                                        <th>@lang('app.material-data.update.description')</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('build_data.material.material.create.create_specification')
            @include('build_data.material.material.create.create_unit')
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none" onclick="reloadModalCreateUnitUpdateMaterial($(this))"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>

                <div class="btn seemt-orange seemt-btn-hover-orange seemt-bg-orange d-none"
                     id="btn-prev-update-material" onclick="prevModalUpdateMaterial()">
                    <i class="fi-rr-undo"></i>
                    <span>@lang('app.component.button.previous')</span>
                </div>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     id="btn-save-update-material"
                     onclick="saveModalUpdateMaterialData($(this))">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-none">
    <input id="code-update-material-data">
    <input id="id-update-material-data"/>
    <input id="status-id-update-material-data"/>
    <span id="msg-price-min-update-material-data">@lang('app.material-data.update.msg-price-min')</span>
    <span id="msg-price-max-update-material-data">@lang('app.material-data.update.msg-price-max')</span>
    <span id="msg-min-min-update-material-data">@lang('app.material-data.update.msg-min-min')</span>
    <span id="msg-min-max-update-material-data">@lang('app.material-data.update.msg-min-max')</span>
    <span id="msg-loss-min-update-material-data">@lang('app.material-data.update.msg-loss-min')</span>
    <span id="msg-loss-max-update-material-data">@lang('app.material-data.update.msg-loss-max')</span>
    <span id="msg-name-category-update-material-data">@lang('app.material-data.update.msg-name-category')</span>
    <span id="msg-name-unit-update-material-data">@lang('app.material-data.update.msg-name-unit')</span>
    <span id="msg-name-update-material-data">@lang('app.material-data.update.msg-name-material')</span>


    <span id="msg-specifications-update-material-data">@lang('app.material-data.update.msg-name-specifications')</span>
    <span id="opt1-sub-inventory-update-material-data"><option value="4">@lang('app.material-data.update.opt1')</option></span>
    <span id="opt2-sub-inventory-update-material-data"><option value="5">@lang('app.material-data.update.opt2')</option></span>
    <span id="opt5-sub-inventory-update-material-data"><option value="8">@lang('app.material-data.update.opt5')</option></span>
    <span id="opt6-sub-inventory-update-material-data"><option value="9">@lang('app.material-data.update.opt6')</option></span>
    <span id="opt7-sub-inventory-update-material-data"><option
            value="10">@lang('app.material-data.update.opt7')</option></span>
    <span id="opt8-sub-inventory-update-material-data"><option
            value="11">@lang('app.material-data.update.opt8')</option></span>
    <span id="opt3-sub-inventory-update-material-data"><option value="6">@lang('app.material-data.update.opt3')</option></span>
    <span id="opt9-sub-inventory-update-material-data"><option
            value="13">@lang('app.material-data.update.opt9')</option></span>
</div>
@include('build_data.material.material.update_unit')
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\material\material\update.js?version=5', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
