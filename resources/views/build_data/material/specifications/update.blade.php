<div class="modal fade" id="modal-update-specifications-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.specifications-data.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateSpecificationsData()" onkeypress="closeModalUpdateSpecificationsData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-update-specifications-data">
                <div class="row card-block card m-0">
                    <div class="col-lg-12 pt-1">
                        <div class="form-group validate-group">
                            <div class="form-validate-input">
                                <input id="name-update-specifications-data" class="form-control" data-spec="1" data-empty="1" data-min-length="2" data-max-length="50">
                                <label for="name-update-specifications-data">
                                    @lang('app.specifications-data.update.name')
                                     @include('layouts.start')
                                </label>
                                <div class="line"></div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div class="form-group validate-group">
                            <div class="form-validate-input">
                                <input id="value-exchange-update-specifications-data" class="form-control" data-number="1" value="1" data-empty="1" data-value-min-value-of="0" data-max="100000">
                                <label for="value-exchange-update-specifications-data">
                                    @lang('app.specifications-data.update.value-exchange')
                                     @include('layouts.start')
                                </label>
                                <div class="line"></div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div class="form-group select2_theme validate-group">
                            <div class="form-validate-select">
                                <div class="col-lg-12 mx-0 px-0">
                                    <div class="pr-0 select-material-box">
                                        <div class="">
                                            <select id="value-name-update-specifications-data" autocomplete="off" data-select="1" class="select-not-select2 select2-hidden-accessible">
                                                <option value="" selected disabled hidden>@lang('app.supplier-data.material.create.default-opt')</option>
                                            </select>
                                        </div>
                                        <label class="icon-validate">
                                            @lang('app.specifications-data.update.value-name')
                                             @include('layouts.start')
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div class="row">
                            <div class="col-12 pb-4">
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
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalUpdateSpecificationsData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-none">
    <span id="id-update-specifications-data"></span>
    <span id="status-update-specifications-data"></span>
</div>

@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\material\specifications\update.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
