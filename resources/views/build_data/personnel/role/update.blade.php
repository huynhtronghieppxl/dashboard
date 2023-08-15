
<div class="modal fade seemt-main-content" id="modal-update-role-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.role-data.update.title')</h4>
                <button type="button" class="close ml-4" onclick="closeModalUpdateRoleData()" onkeypress="closeModalUpdateRoleData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-update-employee-manage">
                <div class="row">
                    <div class="col-12">
                        <div class="card-block card m-0">
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input class="form-control" id="name-update-role-data" data-empty="1" data-length-text="1" data-max-length="30" data-min-length="2" data-spec="1">
                                    <label for="name-update-role-data " class="d-flex">
                                         @lang('app.role-data.update.name')  @include('layouts.start')
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>

                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="select-role-update-role-data" class="select-not-select2 select2-hidden-accessible" data-select="1" tabindex="-1" aria-hidden="true">
                                                <option value="" disabled selected hidden>@lang('app.component.option_default')</option>
                                            </select>
                                            <label class="icon-validate">
                                                @lang('app.role-data.update.role-manage')@include('layouts.start')
                                            </label>

                                        </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea class="form__field" id="description-update-role-data" data-note-max-length="255" rows="5" cols="5" placeholder=""></textarea>
                                        <label for="description-update-role-data" class="form__label icon-validate">
                                             @lang('app.role-data.update.description') </label>
                                        <div class="textarea-character" id="char-count">
                                            <span>0/300</span>
                                        </div>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select ">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="select-group-update-role-data" class="col-lg-12 js-example-basic-single select2-hidden-accessible" data-select="1" tabindex="-1" aria-hidden="true">
                                                <option value="" disabled selected hidden>@lang('app.component.option_default')</option>
                                                <option value="1">@lang('app.role-data.update.role-office')</option>
                                                <option value="2">@lang('app.role-data.update.role-business')</option>
                                                <option value="3">@lang('app.role-data.update.role-production')</option>
                                                    <option value="4">@lang('app.role-data.create.role-marketing')</option>
                                            </select>
                                            <label class="icon-validate">
                                                 @lang('app.role-data.update.role-group')
{{--                                                @include('layouts.start')--}}
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
            <div class="modal-footer">

                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalUpdateRoleData()" onkeypress="saveModalUpdateRoleData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/personnel/role/update.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
