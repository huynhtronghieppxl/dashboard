<div class="modal fade" id="modal-create-table-build-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" id="content-edit-table">
            <div id="create">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('app.table-manage_data.add-table.title-add')</h4>
                    <button type="button" class="close" onclick="closeModalCreateTableBuildData()" onkeypress="closeModalCreateTableBuildData()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
                <div class="modal-body" id="loading-modal-create-table-build-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-block card m-0">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input form-left">
                                        <input id="name-create-table-build-data" class="form-control" data-empty="1" data-min-length="1" data-max-length="6" data-spec="1">
                                        <label for="name-create-table-build-data">
                                            @lang('app.table-manage_data.name-table')@include('layouts.start')
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <div class="form-group validate-group">
                                    <div class="form-validate-input form-left">
                                        <input id="number-create-table-build-data" class="form-control" value="1" data-type="currency-edit" data-empty="1" data-min="1" data-max="100" data-number="1">
                                        <label for="number-create-table-build-data">
                                            @lang('app.table-manage_data.number-table')@include('layouts.start')
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <div class="form-group row d-none">
                                    <label>@lang('app.table-manage_data.add-table.area-table')</label>
                                    <select class="form-control js-example-basic-single"
                                            id="select-area-create-table-build-data"
                                            data-select="1">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-renew d-none" onclick="reloadModalCreateTableBuildData()"
                            data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                        <i class="fa fa-eraser"></i>
                    </button>
                    <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalCreateTableBuildData()">
                        <i class="fi-rr-disk"></i>
                        <span>@lang('app.component.button.save')</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\business\table\create.js?version=3'.date('d-m-Y-H'), env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

