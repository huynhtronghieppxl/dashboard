<div class="modal fade" id="modal-create-level-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.level-data.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateLevelData()" onkeypress="closeModalCreateLevelData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-create-level-data">
                <div class="card-block card m-0">
                    <div class="form-group select2_theme validate-group">
                        <div class="form-validate-select ">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 pr-0 select-material-box">
                                    <select id="select-role-create-level-data" class="col-sm-12 js-example-basic-single select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                    </select>
                                    <label class="icon-validate">
                                       @lang('app.level-data.create.role') </label>
                                </div>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input id="name-create-level-data" class="form-control" data-min-length="2" data-max-length="50" data-spec="1" data-empty="1">
                            <label for="name-create-level-data">
                               @lang('app.level-data.create.name') @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input id="table-create-level-data" class="form-control text-right" value="1" data-min="1" data-max="999" data-empty="1" data-type="currency-edit" data-number="1">
                            <label for="table-create-level-data">
                                 @lang('app.level-data.create.table') @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input id="value-create-level-data" class="form-control text-right" value="100" data-min="100" data-max="999999999" data-empty="1" data-type="currency-edit">
                            <label for="value-create-level-data">
                                @lang('app.level-data.create.value') @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-textarea">
                            <div class="form__group pt-2">
                                <textarea id="description-create-level-data" class="form__field" cols="5" rows="4" placeholder="" data-note-max-length="2000"></textarea>
                                <label for="description-create-level-data" class="form__label icon-validate">
                                    @lang('app.level-data.create.description') </label>
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
                <button type="button" class="btn-renew d-none" onclick="reloadModalCreateLevelData()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreateLevelData()"
                     onkeypress="saveModalCreateLevelData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/personnel/level/create.js?version=5', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
