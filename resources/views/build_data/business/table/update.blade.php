<div class="modal fade" id="modal-update-table-build-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.table-manage_data.title-update')</h4>
                <button type="button" class="close" onclick="closeModalUpdateTableBuildData()" onkeypress="closeModalUpdateTableBuildData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-update-table-build-data">
                <div class="card-block card m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="name-update-table-build-data" data-empty="1" data-min-length="1" data-max-length="6" data-spec="1" class="form-control" >
                            <label>
                                @lang('app.table-manage_data.name-table') @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="number-update-table-build-data" data-empty="1" data-min="1" data-max="100" data-number="1" class="form-control">
                            <label>
                                @lang('app.table-manage_data.number-table')@include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group select2_theme validate-group">
                        <div class="form-validate-select">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 pr-0 select-material-box">
                                    <select class="form-control js-example-basic-single select2-hidden-accessible" id="select-area-update-table-build-data" data-select="1">
                                    </select>
                                    <label>@lang('app.table-manage_data.add-table.area-table') @include('layouts.start')</label>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalUpdateTableBuildData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\build_data\business\table\update.js?version='.date('d-m-Y-H'), env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush


