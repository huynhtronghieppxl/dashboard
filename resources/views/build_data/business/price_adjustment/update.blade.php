<div class="modal fade" id="modal-update-price-adjustment" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.price-adjustment-data.update.title')</h4>
                <h5 id="label-status-price-adjustment-update mx-auto"></h5>
                <button type="button" class="close" onclick="closeModalUpdatePriceAdjustment()" onkeypress="closeModalUpdatePriceAdjustment()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left pb-0" id="loading-update-price-adjustment">
                <div class="row m-0">
                    <div class="col-lg-8 edit-flex-auto-fill p-0">
                        <div class="card card-block flex-sub m-0">
                                <div class="table-responsive new-table" style="margin-top: 10px !important;">
                                    <div class="select-filter-dataTable">
                                        <div class="form-validate-select">
                                            <div class="pr-0 select-material-box">
                                                <select id="select-food-update-price-adjustment" class="js-example-basic-single select2-hidden-accessible">
                                                    <option disabled selected hidden>Chọn món ăn</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table" id="table-update-price-adjustment">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.price-adjustment-data.update.name')</th>
                                            <th>@lang('app.price-adjustment-data.update.original-price')</th>
                                            <th>@lang('app.price-adjustment-data.update.difference')</th>
                                            <th>@lang('app.price-adjustment-data.update.price')</th>
                                            <th>@lang('app.price-adjustment-data.update.close')</th>
                                            <th class="d-none"></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill pr-0">
                        <div class="card card-block flex-sub m-0" id="info-update-price-adjustment">
                                <h5 class="sub-title">@lang('app.price-adjustment-data.update.title-right')</h5>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="col-form-label-fz-15 f-w-600">@lang('app.price-adjustment-data.update.restaurant-branch')</p>
                                        <h6 class="text-muted col-form-label-fz-15 f-w-400 "
                                            id="restaurant-branch-update-price-adjustment">---</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="col-form-label-fz-15 f-w-600">@lang('app.price-adjustment-data.update.code')</p>
                                        <h6 class="text-muted col-form-label-fz-15 f-w-400 "
                                            id="code-update-price-adjustment">---</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="col-form-label-fz-15 f-w-600">@lang('app.price-adjustment-data.update.employee')</p>
                                        <h6 class="class-link col-form-label-fz-15 f-w-400 "
                                            id="employee-update-price-adjustment">---</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="col-form-label-fz-15 f-w-600">@lang('app.price-adjustment-data.update.created')</p>
                                        <h6 class="text-muted col-form-label-fz-15 f-w-400 "
                                            id="created-update-price-adjustment">{{date('d/m/Y')}}</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="col-form-label-fz-15 f-w-600">@lang('app.price-adjustment-data.update.updated')</p>
                                        <h6 class="text-muted col-form-label-fz-15 f-w-400 pb-2 "
                                            id="updated-update-price-adjustment">{{date('d/m/Y')}}</h6>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group pt-1 validate-group">
                                            <div class="form-validate-textarea">
                                                <div class="form__group">
                                                    <textarea class="form__field" rows="5" cols="6" id="note-update-price-adjustment" data-note="1" data-note-max-length="255"></textarea>
                                                    <label for="note-update-price-adjustment" class="form__label icon-validate">
                                                        @lang('app.price-adjustment-data.update.note')
                                                        @include('layouts.start')
                                                    </label>
                                                    <div class="textarea-character" id="char-count">
                                                        <span>0/300</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-btn-hover-red seemt-bg-red mr-2"
                     onclick="cancelPriceAdjustment()">
                    <i class="fi-rr-trash"></i>
                    <span>@lang('app.component.button.cancel')</span>
                </div>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue mr-2"
                     id="btn-update-price-adjustment"
                     onclick="saveModalUpdatePriceAdjustment()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/business/price_adjustment/update.js?version=5', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
