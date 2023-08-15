<div class="modal fade" id="modal-update-area-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_update">@lang('app.area-data.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateAreaData()" onkeypress="closeModalUpdateAreaData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-update-area-data">
                <div class="card card-block mb-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="name-update-area" class="form-control" type="text" data-empty="1" data-max-length="20" data-min-length="2" data-spec="1"/>
                            <label for="name-update-area">
                                @lang('app.area-data.update.name') @include('layouts.start')
                            </label>
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveUpdateAreaData()"
                     onkeypress="saveUpdateAreaData()">
                    <i class="fi-rr-document"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/business/area/update.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush


