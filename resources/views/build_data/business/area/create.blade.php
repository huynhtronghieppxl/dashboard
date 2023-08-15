<div class="modal fade" id="modal-create-area-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="title_create">@lang('app.area-data.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateAreaData()" onkeypress="closeModalCreateAreaData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-create-area-data">
                <div class="card card-block mb-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="name-create-area" class="form-control" type="text" data-empty="1" data-max-length="20" data-min-length="2" data-spec="1"/>
                            <label for="name-create-area">
                                @lang('app.area-data.create.name') @include('layouts.start')
                            </label>
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none" onclick="reloadModalCreateAreaData()"
                                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                                    <i class="fa fa-eraser"></i>
                                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveCreateAreaData()"
                     onkeypress="saveCreateAreaData()">
                    <i class="fi-rr-document"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/business/area/create.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

