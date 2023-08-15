<div class="modal fade" id="modal-create-work-category-work-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.category-work-data.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateCategoryWorkData()" onkeypress="closeModalCreateCategoryWorkData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left " id="loading-modal-create-category-work-data">
                <div class="card-block card m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input id="name-create-category-work-data" class="form-control" data-min-length="2" data-max-length="255" data-empty="1">
                            <label for="name-create-category-work-data">
                                 @lang('app.category-work-data.create.name')  @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew" onclick="reloadModalCreateCategoryWorkData()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreateCategoryWorkData()"
                     onkeypress="saveModalCreateCategoryWorkData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/personnel/work/create_category_work.js?version=5', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
