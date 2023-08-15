<div class="modal fade" id="modal-update-shift-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.shift-data.title-update')</h4>
                <button type="button" class="close" onclick="closeModalUpdateShiftData()" onkeypress="closeModalUpdateShiftData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left overflow-visible" id="loading-modal-create-employee-manage">
                <div class="card-block card m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input type="text" class="form-control element-focus-edit disabled-element text-center" id="shift-data-update-name" data-empty="1" data-spec="1" data-max-length="50" data-min-length="2">
                            <label for="shift-data-update-name">
                                @lang('app.shift-data.name')
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input class="form-control text-center element-focus-edit disabled-element" id="from-hour-update-shift-data" data-empty="1">
                            <label for="from-hour-update-shift-data">
                                @lang('app.shift-data.fromhour')
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input class="form-control text-center element-focus-edit disabled-element" id="to-hour-update-shift-data" data-empty="1">
                            <label for="to-hour-update-shift-data">
                                @lang('app.shift-data.tohour')
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveUpdateShiftData()"
                     onkeypress="saveUpdateShiftData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/personnel/shift/update.js?version=4', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
