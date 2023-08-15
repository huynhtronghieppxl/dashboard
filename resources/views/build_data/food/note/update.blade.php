<div class="modal fade" id="modal-update-note-food-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.note-food-data.update.title')</h4>
                <button type="button" class="close ml-4" onclick="closeModalUpdateNoteFoodData()" onkeypress="closeModalUpdateNoteFoodData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-update-note-food-data">
                <div class="card-block card m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="name-update-note-food-data" class="form-control"  data-empty="1" data-max-length="50" data-min-length="2">
                            <label for="name-update-note-food-data">
                                @lang('app.note-food-data.update.name')
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 edit-flex-auto-fill pl-0">
                            <div class="flex-sub">
                                <div class="card-block p-0">
                                    <h5 class="sub-title mt-0 mx-0" style="padding-bottom: 12px; margin-bottom: 10px">@lang('app.note-food-data.update.title-left')</h5>
                                </div>
                                <div class="card-block pt-0 pl-0">
                                    <div class="table-responsive new-table">
                                        <div class="select-filter-dataTable pr-3">
                                            <div class="form-validate-select">
                                                <div class="pr-0 select-material-box">
                                                    <select class="js-example-basic-single select-category-name-note-food-update">
                                                        <option value="-1" selected="">Danh mục</option>
                                                    </select>
                                                    <div class="line"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <table id="table-dis-select-update-note-food-data" class="table">
                                            <thead>
                                            <tr>
                                                <th>@lang('app.note-food-data.update.food')</th>
                                                <th>@lang('app.note-food-data.update.category')</th>
                                                <th class="text-center m-auto">
                                                    <div class="btn-group btn-group-sm">
                                                        <button type="button"
                                                                class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                                onclick="selectAllUpdateNoteFoodData()">
                                                            <i class="fi-rr-arrow-small-right"></i>
                                                        </button>
                                                    </div>
                                                </th>
                                                <th class="d-none"></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 edit-flex-auto-fill pr-0">
                            <div class="flex-sub">
                                <div class="card-block p-0">
                                    <h5 class="sub-title mt-0 mx-0" style="padding-bottom: 12px; margin-bottom: 10px">@lang('app.note-food-data.update.title-right')</h5>
                                </div>
                                <div class="card-block p-0">
                                    <div class="table-responsive new-table">
                                        <table id="table-select-update-note-food-data" class="table">
                                            <thead>
                                            <tr>
                                                <th class="text-center m-auto">
                                                    <div class="btn-group btn-group-sm">
                                                        <button type="button"
                                                                class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                                onclick="unSelectAllUpdateNoteFoodData()">
                                                            <i class="fi-rr-arrow-small-left"></i>
                                                        </button>
                                                    </div>
                                                </th>
                                                <th>@lang('app.note-food-data.update.food')</th>
                                                <th>@lang('app.note-food-data.update.category')</th>
                                                <th class="d-none"></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalUpdateNoteFoodData()"
                     onkeypress="saveModalUpdateNoteFoodData()"
                     title="@lang('app.component.title-button.save')">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/food/note/update.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
