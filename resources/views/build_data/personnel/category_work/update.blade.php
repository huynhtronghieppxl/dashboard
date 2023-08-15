<div class="modal fade" id="modal-update-category-work-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.category-work-data.update.title')</h4>
                <button type="button" class="close ml-4" onclick="closeModalUpdateCategoryWorkData()" onkeypress="closeModalUpdateCategoryWorkData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-update-category-work-data">
                <div class="card-block card m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input id="name-update-category-work-data" class="form-control" data-empty="1" data-spec-all="1" data-max-length="50" data-min-length="2">
                            <label for="name-update-category-work-data">
                               @lang('app.category-work-data.update.name')@include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" id="save-update-category-work-data"
                     onclick="saveModalUpdateCategoryWorkData()"
                     onkeypress="saveModalUpdateCategoryWorkData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/personnel/category_work/update.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
