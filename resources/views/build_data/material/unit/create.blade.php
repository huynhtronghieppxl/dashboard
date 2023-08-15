<div class="modal fade" id="modal-create-unit-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title create-unit-data">@lang('app.unit-data.create.title')</h4>
                <h4 class="modal-title d-none create-specifications-data">@lang('app.specifications-data.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateUnitData()"
                        onkeypress="closeModalCreateUnitData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left create-unit-data" id="create-unit-data">
                <div class="row d-flex" >
                    <div class=" col-lg-12 edit-flex-auto-fill px-0 ">
                        <div class="card-block card m-0 col-lg-12 ">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group validate-group ">
                                        <div class="form-validate-input form-left">
                                            <input id="name-create-unit-data" class="form-control" type="text" data-spec="1"
                                                   data-empty="1" data-min-length="2" data-max-length="50">
                                            <label for="value-create-payment-bill">
                                                @lang('app.unit-data.create.name')
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                        <div class="link-href"></div>
                                    </div >

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group validate-group ">
                                        <div class="form-validate-input form-left">
                                            <input id="code-create-unit-data" class="form-control" type="text" data-empty="1"
                                                   data-spec="1" data-min-length="2" data-max-length="50">
                                            <label for="value-create-payment-bill">
                                                @lang('app.unit-data.create.code')
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group validate-group">
                                        <div class="form-validate-textarea">
                                            <div class="form__group pt-2">
                                        <textarea class="form__field" id="description-create-unit-data"
                                                  data-note-max-length="255" cols="5" rows="1"></textarea>
                                                <label for="description-update-food-brand-manage"
                                                       class="form__label icon-validate">
                                                    @lang('app.unit-data.create.description')
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

                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-lg-6 d-flex pr-0">
                        <div class=" card card-block flex-sub ml-0 mr-0">
                            <h4 class="sub-title f-w-600">Danh sách quy cách</h4>
                            <div class="table-responsive new-table">
                                <table id="table-create-unit-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.unit-data.specification')</th>
                                        <th style="width: 5% !important;"> <div class="btn-group btn-group-sm">
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" onclick="checkAllSpecifications()"><i class="fi-rr-arrow-small-right"></i></button>
                                            </div></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex">
                        <div class=" card card-block flex-sub ml-0 mr-0">
                            <h4 class="sub-title f-w-600">Danh sách quy cách đã chọn</h4>
                            <div class="table-responsive new-table">
                                <table id="table-create-unit-data-selected" class="table">
                                    <thead>
                                    <tr>
                                        <th> <div class="btn-group btn-group-sm">
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" onclick="unCheckAllSpecifications()"><i class="fi-rr-arrow-small-left"></i></button>
                                            </div></th>
                                        <th>@lang('app.unit-data.specification')</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body text-left d-none create-specifications-data" id="create-specifications-data">
                <div class="card-block card m-0">

                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="name-create-specifications-data" class="form-control" data-empty="1"
                                   data-max-length="50">
                            <label for="name-create-specifications-data">
                                @lang('app.specifications-data.create.name')
                                @include('layouts.start')
                            </label>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="value-exchange-create-specifications-data" class="form-control"
                                   data-float="1" value="1" data-value-min-value-of="0" data-max="100000">
                            <label for="value-exchange-create-specifications-data">
                                @lang('app.specifications-data.create.value-exchange')
                                @include('layouts.start')
                            </label>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-select">
                            <div class="col-lg-12 select-material-box">
                                <select id="value-name-create-specifications-data"
                                        class="col-sm-12 js-example-basic-single select2-hidden-accessible"
                                        data-select="1"></select>
                                <label class="icon-validate">
                                    @lang('app.specifications-data.create.value-name')
                                    @include('layouts.start')
                                </label>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group row pt-2">
                        <div class="col-md-6">
                            <p class="text text-warning">
                                <span>*@lang('app.specifications-data.note.note-vd')</span><br>
                                <span>@lang('app.specifications-data.note.note-name')</span><br>
                                <span>@lang('app.specifications-data.note.note-value')</span><br>
                                <span>@lang('app.specifications-data.note.note-unit')</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none"
                        onclick="resetModalCreateUnitData()"
                        onkeypress="resetModalCreateUnitData()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div id="btn-create-specifications"
                     class=" btn seemt-orange seemt-bg-orange seemt-btn-hover-orange"
                     onclick="openCreateSpecificationsData()">
                    <i class="fi-rr-add"></i>
                    <span>Thêm quy cách</span>
                </div>
                <div id="btn-prev-create-specifications"
                     class="d-none btn seemt-orange seemt-bg-orange seemt-btn-hover-orange"
                     onclick="prevCreateSpecifications()">
                    <i class="fi-rr-undo"></i>
                    <span>@lang('app.component.button.previous')</span>
                </div>
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreateUnitData()" onkeypress="saveModalCreateUnitData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>

        </div>
    </div>
</div>
    @push('scripts')
        <script type="text/javascript" src="{{ asset('js\build_data\material\unit\create.js?version=8', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
