<div class="modal fade" id="modal-create-content-display-secondary-pos" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" id="content-edit-table">
            <div id="create">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('app.media-restaurant.create.title')</h4>
                </div>
                <div class="modal-body" id="loading-modal-create-table-build-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-block">
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input id="content-create-display-secondary-pos" class="form-control" data-empty="1" data-min-length="2" data-max-length="255" data-spec="1">
                                        <label for="content-create-display-secondary-pos">
                                            <i class="icofont icofont-tag"></i>@lang('app.media-restaurant.create.name') <span class="text-danger">(*)</span>
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-renew d-none" onclick="reloadModalCreateDisplaySecPos()"
                            data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                        <i class="fa fa-eraser"></i>
                    </button>
                    <button type="button" class="btn btn-grd-disabled waves-effect"
                            onclick="closeModalCreateDisplaySecPos()">@lang('app.component.button.close') </button>
                    <button type="button" class="btn btn-grd-primary waves-effect waves-light"
                            onclick="saveModalCreateDisplaySecPos()">@lang('app.component.button.save')</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/marketing/display_secondary/create.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

