
<div class="modal fade seemt-main-content" id="modal-create-role-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header"   >
                <h4 class="modal-title">@lang('app.role-data.create.title')</h4>
                <button type="button" class="close ml-4" onclick="closeModalCreateRoleData()" onkeypress="closeModalCreateRoleData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left background-body-color overflow-hidden" id="loading-modal-create-role-data">
                <div class="row ">
                    <div class="col-lg-8 col-md-6 edit-flex-auto-fill flex-column" id="left-modal-update-role-data">
                        <div class="card card-block custom-div-part flex-sub px-3 mb-0 ml-0" style="margin-bottom: 3px !important;">
                            <div class="col-lg-12 sub-title d-flex justify-content-between">
                                <label
                                    class="col-lg-8  w-100 float-left px-0">@lang('app.permission-role-data.title-permission')
                                </label>
                                <div class="col-lg-4">
                                    <div class="search-layout-body" id="div-search-permission-create-role-data">
                                        <input class="search-text-layout-body" type="text"
                                               placeholder="Tìm kiếm quyền"
                                               id="search-permission-create-role-data">
                                        <a href="javascript:void(0)" class="search-button-layout-body"><i
                                                class="fa fa-search"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="permission-create-role-data">
                            {{-- Data --}}
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 edit-flex-auto-fill pl-0">
                        <div class="card col-sm-12 card-block ">
                            <h5 class="sub-title mb-3">@lang('app.role-data.create.title-right')</h5>
                            <div>
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input class="form-control" id="name-create-role-data" data-empty="1" data-max-length="30" data-min-length="2" data-spec="1">
                                        <label for="name-create-role-data" class="d-flex">
                                             @lang('app.role-data.create.name')@include('layouts.start')
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-role-create-role-data" data-select="1" class="select-not-select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.role-data.create.role-manage') @include('layouts.start')
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <div class="form-group validate-group">
                                    <div class="form-validate-textarea">
                                        <div class="form__group pt-2">
                                            <textarea class="form__field" id="description-create-role-data" data-note-max-length="255" rows="5" cols="5" placeholder=""></textarea>
                                            <label for="description-create-role-data" class="form__label icon-validate">
                                                @lang('app.role-data.create.description') </label>
                                            <div class="textarea-character" id="char-count">
                                                <span>0/300</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-group-create-role-data" class="col-lg-12 js-example-basic-single select2-hidden-accessible" data-icon="icofont-group" data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="-2" selected disabled>@lang('app.component.option_default')</option>
                                                    <option value="1">@lang('app.role-data.create.role-office')</option>
                                                    <option value="2">@lang('app.role-data.create.role-business')</option>
                                                    <option value="3">@lang('app.role-data.create.role-production')</option>
                                                        <option value="4">@lang('app.role-data.create.role-marketing')</option>
                                                </select>
                                                <label class="icon-validate">
                                                     @lang('app.role-data.create.role-group')@include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none" onclick="reloadModalCreateRoleData()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreateRoleData()"
                     onkeypress="saveModalCreateRoleData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/personnel/role/create.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
