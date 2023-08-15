<div class="modal fade" id="modal-create-note-food-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.note-food-data.create.title')</h4>
                <button type="button" class="close ml-4" onclick="closeModalCreateNoteFoodData()" onkeypress="closeModalCreateNoteFoodData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-create-note-food-data">
                <div class="card-block card m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input id="name-create-note-food-data" class="form-control" data-emoji="1" data-min-length="2" data-max-length="50" data-empty="1" >
                            <label for="name-create-note-food-data">
                                @lang('app.note-food-data.create.name')
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 edit-flex-auto-fill px-0">
                            <div class="flex-sub">
                                <div class="card-block p-0">
                                    <h5 class="sub-title mt-0 mx-0" style="padding-bottom: 12px; margin-bottom: 10px">@lang('app.note-food-data.create.title-left')</h5>
                                </div>
                                <div class="card-block pt-0 pl-0">
                                    <div class="table-responsive new-table">
                                        <div class="select-filter-dataTable pr-3">
                                            <div class="form-validate-select">
                                                <div class="pr-0 select-material-box">
                                                    <select class="js-example-basic-single select-category-name-note-food">
                                                        <option value="-1" selected="">@lang('app.note-food-data.mess.option_category')</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <table id="table-dis-select-note-food-data" class="table">
                                            <thead>
                                            <tr>
                                                <th>@lang('app.note-food-data.create.food')</th>
                                                <th>@lang('app.note-food-data.create.category')</th>
                                                <th class="text-center m-auto">
                                                    <div class="btn-group btn-group-sm">
                                                        <button type="button"
                                                                class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                                onclick="selectAllNoteFoodData($(this))"
                                                                style="margin: -7.9px 0 !important; margin-left: -5px">
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
                        <div class="col-lg-6 edit-flex-auto-fill px-0">
                            <div class="flex-sub">
                                <div class="card-block p-0">
                                    <h5 class="sub-title mt-0 mx-0" style="padding-bottom: 12px; margin-bottom: 10px">@lang('app.note-food-data.create.title-right')</h5>
                                </div>
                                <div class="card-block pt-0 pr-0">
                                    <div class="table-responsive new-table">
                                        <table id="table-select-note-food-data" class="table">
                                            <thead>
                                            <tr>
                                                <th class="text-center m-auto">
                                                    <div class="btn-group btn-group-sm">
                                                        <button type="button"
                                                                class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                                onclick="unSelectAllNoteFoodData($(this))"
                                                                style="margin: -7.9px 0 !important; margin-left: -5px">
                                                            <i class="fi-rr-arrow-small-left"></i>
                                                        </button>
                                                    </div>
                                                </th>
                                                <th>@lang('app.note-food-data.create.food')</th>
                                                <th>@lang('app.note-food-data.create.category')</th>
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
                <button type="button" class="btn-renew d-none"
                        onclick="resetModalCreateNoteFoodData()"
                        onkeypress="resetModalCreateNoteFoodData()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreateNoteFoodData()"
                     onkeypress="saveModalCreateNoteFoodData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/food/note/create.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
