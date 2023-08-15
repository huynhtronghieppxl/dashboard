<style>
    .select2-container--default .select2-results__option {
        font-size: 14px !important;
    }
</style>
<div class="modal fade" id="modal-create-material-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document" id="tab-size">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title title-h5-create-material" id="">@lang('app.material-data.create.title')</h5>
                <h5 class="modal-title d-none title-h5-create-unit" id="">@lang('app.unit-data.create.title')</h5>
                <h5 class="modal-title d-none title-h5-create-specifications" id="">@lang('app.specifications-data.create.title')</h5>
                <h5 class="modal-title d-none title-h5-create-map" id="">@lang('app.material-data.create.map')</h5>
                <button type="button" class="close" onclick="closeModalCreateMaterialData()" onkeypress="closeModalCreateMaterialData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="modal-body-create-material" style="scroll-behavior: smooth;">
                <div class="card-block card m-0" id="tab-info-create-material">
                    <div id="tab-info-create-material-top">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input id="name-create-material-data" class="form-control" type="text"
                                               data-spec="1" data-empty="1" data-min-length="2" data-max-length="50"/>
                                        <label for="name-create-material-data">
                                            @lang('app.material-data.create.name')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input id="code-create-material-data" class="form-control" type="text"
                                               data-empty="1" data-spec="1" data-min-length="2" data-max-length="50"/>
                                        <label for="code-create-material-data">
                                            @lang('app.material-data.create.code')
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
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="sub-inventory-create-material-data"
                                                        class="sub-inventory-create-material-data js-example-basic-single select2-hidden-accessible"
                                                        data-select="1">
                                                    <option value="-1" disabled selected
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                                <label class="icon-validate" style="display: flex">
                                                    <div>@lang('app.material-data.create.sub-inventory')</div>
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
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="pr-0 select-material-box">
                                                <select id="category-create-material-data"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1">
                                                    <option value="-1" disabled selected
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.material-data.create.category')
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
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="pr-0 select-material-box">
                                                <select id="unit-create-material-data"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1">
                                                    <option value="-1" disabled selected
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.material-data.create.unit')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="link-href">
                                    <span class="text text-warning">
                                        @lang('app.material-data.link-href.title-unit')
                                        <a href="javascript:void(0)" class="text text-primary"
                                        onclick="openModalBodyCreate(1)">@lang('app.material-data.link-href.link')</a>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select mb-0">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="pr-0 select-material-box">
                                                <select id="specifications-create-material-data"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1">
                                                    <option value="-1"
                                                            selected="">@lang('app.component.option-null')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.material-data.create.specifications')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="link-href">
                                    <span class="text text-warning">
                                        @lang('app.material-data.link-href.title-specifications') <a
                                            href="javascript:void(0)" class="text text-primary"
                                            onclick="openModalBodyCreate(2)">@lang('app.material-data.link-href.link')</a>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input id="loss-create-material-data" class="form-control input-tooltip"
                                               value="0"
                                               data-tooltip="1" data-float="1" data-type="currency-edit"
                                               data-max="99.9"  />
                                        <label for="loss-create-material-data">
                                            @lang('app.material-data.create.loss')
                                            @include('layouts.start')
                                        </label>
                                        <div class="tool-tip">
                                            <i class="fi-rr-exclamation tooltip_formula text-inverse pointer" data-toggle="tooltip"
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
                                        <input id="min-create-material-data" class="form-control input-tooltip"
                                               data-type="currency-edit" value="0" data-min="0" data-max="100000"
                                               data-float="1"/>
                                        <label for="min-create-material-data">
                                            @lang('app.material-data.create.min')
                                            @include('layouts.start')
                                        </label>
                                        <div class="tool-tip">
                                            <i class="fi-rr-exclamation tooltip_formula text-inverse pointer" data-toggle="tooltip"
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
                                <div class="form-group mb-0 validate-group">
                                    <div class="form-validate-input mb-0">
                                        <input value="100" id="price-create-material-data" class="form-control"
                                               data-type="currency-edit" data-money="1" data-min="100"
                                               data-max="100000000"/>
                                        <label for="price-create-material-data">
                                            @lang('app.material-data.create.price')
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
                                        <textarea class="form__field" id="des-create-material-data" data-note-max-length="255" cols="5"
                                                  rows="3"></textarea>
                                            <label for="des-create-material-data" class="form__label icon-validate">
                                                @lang('app.material-data.create.des')
                                            </label>
                                            <div class="textarea-character">
                                                <span>0/300</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h5 class="sub-title mb-1 ml-0">Danh sách đơn vị bán</h5>
                            <div class="table-responsive new-table">
                                <table id="table-selling-unit" class="table">
                                    <thead>
                                    <tr>
                                        <th>Đơn vị bán</th>
                                        <th>Giá trị chuyển đổi</th>
                                        <th class="text-left sorting_disabled text-left">Mô tả</th>
                                        <th class="text-right ">Giá vốn</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-block card d-none" id="tab-select-create-material">
                    <div class="row pb-4">
                        <p class="text text-warning">
                            * @lang('app.material-data.note.supplier-material')
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group select2_theme validate-group px-0">
                            <div class="form-validate-select">
                                <div class="mx-0 px-0">
                                    <div class="pr-0 select-material-box">
                                        <select id="supplier-create-material-data"
                                                class="js-example-basic-single select2-hidden-accessible"
                                                data-select="1">
                                            <option disabled="" selected=""
                                                    value="">@lang('app.component.option_default')</option>
                                        </select>
                                        <label for="supplier-create-material-data">
                                            @lang('app.material-data.create.supplier') @include('layouts.start')
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div class="col-lg-12 form-group select2_theme validate-group px-0"
                             style="margin-bottom: 0px !important;">
                            <div class="form-validate-select">
                                <div class="mx-0 px-0">
                                    <div class="pr-0 select-material-box">
                                        <select id="material-supplier-create-material-data"
                                                class="js-example-basic-single select2-hidden-accessible"
                                                data-select="1">
                                            <option disabled="" selected=""
                                                    value="">@lang('app.component.option-null')</option>
                                        </select>
                                        <label for="material-supplier-create-material-data">
                                            @lang('app.material-data.breadcrumb') @include('layouts.start')
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div id="not-supplier-create-material" class="col-12 px-0 d-none">
                            <span class="text text-warning">
                            * @lang('app.material-data.note.no-supplier-material')
                            </span>
                        </div>
                        <div class="form-group validate-group mt-3 px-0 col-lg-12 d-none"
                             id="rate-supplier-create-material-data-form" style="margin-bottom: 0px !important;">
                            <div class="form-validate-input mb-0">
                                <input id="rate-supplier-create-material-data" class="form-control disabled" disabled
                                       type="text"
                                       data-empty="1" data-percent="1" data-type="currency-edit" data-max="999999"
                                       value="1"/>
                                <label for="rate-supplier-create-material-data">
                                    @lang('app.material-data.create.rate-supplier')
                                </label>
                            </div>
                            <div class="link-href">
                            </div>
                        </div>
                        <div class="col-12 px-0 mt-1 d-none" id="text-rate-supplier-create-material-data-form">
                            <div class="form-group w-100">
                                <label
                                    class="my-auto font-weight-bold">@lang('app.material-data.create.text-rate-supplier')</label>
                                <div id="text-rate-supplier-create-material-data"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('build_data.material.material.create.create_specification')
            @include('build_data.material.material.create.create_unit')
            <div class="modal-footer modal-footer-custom">
                <button type="button" class="btn-renew d-none" onclick="reloadModalCreateMaterial()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-orange seemt-btn-hover-orange seemt-bg-orange"
                     id="btn-prev-create-material"
                     onclick="prevModalCreateMaterial()">
                    <i class="fi-rr-undo"></i>
                    <span>@lang('app.component.button.previous')</span>
                </div>
                <div class="btn seemt-orange seemt-btn-hover-orange seemt-bg-orange"
                     id="btn-next-create-material"
                     onclick="nextModalCreateMaterial()">
                    <i class="fi-rr-undo"></i>
                    <span>@lang('app.material-data.create.map')</span>
                </div>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     id="btn-save-create-material"
                     onclick="saveModalCreateMaterial($(this))">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     id="btn-save-create-material"
                     onclick="saveModalCreateMaterial($(this), 1)">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save-next')</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-none">
{{--Material inventory--}}
    <span id="opt4-sub-inventory-create-material-data">
        <option value="4" selected>@lang('app.material-data.create.opt4')</option>
    </span>
    <span id="opt5-sub-inventory-create-material-data"><option value="5">@lang('app.material-data.create.opt5')</option></span>
    <span id="opt14-sub-inventory-create-material-data"><option
            value="14">@lang('app.material-data.create.opt14')</option></span>

{{--Goods inventory--}}
    <span id="opt8-sub-inventory-create-material-data"><option value="8"
                                                               selected>@lang('app.material-data.create.opt8')</option></span>
    <span id="opt9-sub-inventory-create-material-data"><option value="9">@lang('app.material-data.create.opt9')</option></span>
    <span id="opt10-sub-inventory-create-material-data"><option
            value="10">@lang('app.material-data.create.opt10')</option></span>
    <span id="opt15-sub-inventory-create-material-data"><option
            value="15">@lang('app.material-data.create.opt15')</option></span>

{{--Internal inventory--}}
    <span id="opt11-sub-inventory-create-material-data"><option value="11"
                                                               selected>@lang('app.material-data.create.opt11')</option></span>
    <span id="opt16-sub-inventory-create-material-data"><option value="16"
     selected>@lang('app.material-data.create.opt16')</option></span>

{{--Orther Invetory--}}
    <span id="opt6-sub-inventory-create-material-data"><option
            value="6">@lang('app.material-data.create.opt6')</option></span>
    <span id="opt13-sub-inventory-create-material-data"><option
            value="13">@lang('app.material-data.create.opt13')</option></span>
    <span id="opt17-sub-inventory-create-material-data"><option
            value="17">@lang('app.material-data.create.opt17')</option></span>
    <span id="opt18-sub-inventory-create-material-data"><option
            value="18">@lang('app.material-data.create.opt18')</option></span>
    <span id="opt19-sub-inventory-create-material-data"><option
            value="19">@lang('app.material-data.create.opt19')</option></span>
    <span id="opt20-sub-inventory-create-material-data"><option
            value="20">@lang('app.material-data.create.opt20')</option></span>
    <span id="opt21-sub-inventory-create-material-data"><option
            value="21">@lang('app.material-data.create.opt21')</option></span>
    <span id="opt22-sub-inventory-create-material-data"><option
            value="22">@lang('app.material-data.create.opt22')</option></span>
    <span id="opt23-sub-inventory-create-material-data"><option
            value="23">@lang('app.material-data.create.opt23')</option></span>
</div>

@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\material\material\create.js?version=16', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
