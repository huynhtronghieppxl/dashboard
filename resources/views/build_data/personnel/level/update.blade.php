<div class="modal fade" id="modal-update-level-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.level-data.update.title')</h4>
                <button type="button" class="close ml-4" onclick="closeModalUpdateLevelData()" onkeypress="closeModalUpdateLevelData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-update-level-data">
                <div class="card-block card m-0">
                    <div class="form-group select2_theme validate-group">
                        <div class="form-validate-select ">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 pr-0 select-material-box">
                                    <select id="select-role-update-level-data" class="col-sm-12 js-example-basic-single select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                        <option value="" disabled selected hidden>@lang('app.component.option_default')</option>
                                    </select>
                                    <label class="icon-validate">
                                        @lang('app.level-data.update.role') </label>
                                </div>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input ">
                            <input id="name-update-level-data" class="form-control" data-empty="1" data-max-length="50" data-min-length="2" data-spec="1">
                            <label for="name-update-level-data">
                                 @lang('app.level-data.update.name')  @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input ">
                            <input id="table-update-level-data" class="form-control text-right" value="0" data-min="1" data-max="999" data-type="currency-edit" data-number="1">
                            <label for="table-update-level-data">
                               @lang('app.level-data.update.table') </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input ">
                            <input id="value-update-level-data" class="form-control text-right" value="0" data-min="100" data-max="999999999" data-type="currency-edit">
                            <label for="value-update-level-data">
                               @lang('app.level-data.update.value') </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-textarea">
                            <div class="form__group pt-2">
                                <textarea id="description-update-level-data" class="form__field" cols="5" rows="4" placeholder="" data-note-max-length="2000"></textarea>
                                <label for="description-update-level-data" class="form__label icon-validate">
                                    @lang('app.level-data.update.description') </label>
                                <div class="textarea-character" id="char-count">
                                    <span>0/300</span>
                                </div>
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalUpdateLevelData()"
                     onkeypress="saveModalUpdateLevelData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
<span class="d-none" id="id-update-level-data"></span>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/personnel/level/update.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
