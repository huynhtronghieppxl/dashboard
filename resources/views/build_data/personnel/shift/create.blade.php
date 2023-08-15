<div class="modal fade" id="modal-create-shift-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.shift-data.title-create')</h4>
                <button type="button" class="close" onclick="closeModalCreateShiftData()" onkeypress="closeModalCreateShiftData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left overflow-visible" id="loading-create-shift-data">
                <div class="card-block card m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input type="text" class="form-control reset-element element-focus-create"
                                   id="shift-data-name" name="working-name" autocomplete="off" data-empty="1"
                                   data-spec="1" data-max-length="50" data-min-length="2">
                            <label for="shift-data-name">
                                @lang('app.shift-data.name')
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input class="form-control text-center element-focus-create" value="{{date('H:i')}}"
                                   id="from-hour-shift-data" data-empty="1" pattern="[0-9:]*">
                            <label for="form-hour-shift-data">
                                @lang('app.shift-data.fromhour')
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input class="form-control text-center element-focus-create" value="{{date('H:i')}}"
                                   data-empty="1" id="to-hour-shift-data">
                            <label for="to-hour-shift-data">
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
                <button type="button" class="btn-renew d-none" onclick="reloadModalCreateShiftData() "
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalCreateShiftData()"
                     onkeypress="saveModalCreateShiftData()"
                     aria-invalid="btn-create-employee-manage">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/personnel/shift/create.js?version=4', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
