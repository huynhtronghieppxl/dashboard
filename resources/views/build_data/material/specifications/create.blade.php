<style>
    .select2-container--default .select2-results__option {
         font-size: 14px !important;
    }
</style>
<div class="modal fade" id="modal-create-specifications-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.specifications-data.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateSpecificationsData()" onkeypress="closeModalCreateSpecificationsData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-create-specifications-data">
                <div class="row card-block card m-0">
                    <div class="col-lg-12 pt-1">
                        <div class="form-group validate-group">
                            <div class="form-validate-input">
                                <input id="name-create-specifications-data" class="form-control" data-spec="1" data-empty="1" data-min-length="2" data-max-length="50">
                                <label for="name-create-specifications-data">
                                    @lang('app.specifications-data.create.name')
                                     @include('layouts.start')
                                </label><div class="line"></div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div class="form-group validate-group">
                            <div class="form-validate-input ">
                                <input id="value-exchange-create-specifications-data" class="form-control" value="1" data-empty="1" data-float="1" data-value-min-value-of="0" data-max="100000" data-number="1">
                                <label for="value-exchange-create-specifications-data">
                                    @lang('app.specifications-data.create.value-exchange')
                                     @include('layouts.start')
                                </label>
                                <div class="line"></div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div class="form-group select2_theme validate-group">
                            <div class="form-validate-select ">
                                <div class="mx-0 px-0">
                                    <div class="pr-0 select-material-box">
                                        <select id="value-name-create-specifications-data" class="select-not-select2 select2-hidden-accessible" data-select="1">
                                            <option value="" selected disabled hidden>@lang('app.supplier-data.material.create.default-opt')</option>
                                        </select>
                                        <label class="icon-validate">
                                            @lang('app.specifications-data.create.value-name')
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
                <button type="button" class="btn-renew d-none"
                        onclick="resetModalCreateSpecificationsData()"
                        onkeypress="resetModalCreateSpecificationsData()" data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreateSpecificationsData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\material\specifications\create.js?version=4', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
