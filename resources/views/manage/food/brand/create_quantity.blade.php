<div class="modal fade" id="modal-create-quantity-food-mange" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                 <h4 class="modal-title" id="material-count-2">@lang('app.food-manage.create-quantity.title-update')</h4>
                <button type="button" class="close ml-4" onclick="closeModalCreateQuantityFoodManage()" onkeypress="closeModalCreateQuantityFoodManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-modal-create-quantity-food-manage">
                <div class="row d-flex">
                    <div class="edit-flex-auto-fill col-sm-9">
                        <div class="card card-block flex-sub"
                             data-title="@lang('app.quantitative-data-ver2.select-quantitative-food')"
                             data-intro="@lang('app.quantitative-data-ver2.add-quantitative-food')" data-step="2">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select" data-intro="Chọn định lượng cho món ăn"
                                         data-step="2">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select2-hidden-accessible"
                                                    id="select-material-food">
                                                <option value="" disabled
                                                        selected>@lang('app.quantitative-data.select-form-material')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table class="table" id="table-detail-material"
                                       data-intro="Nhập số lượng nguyên liệu cho món ăn" data-step="3">
                                    <thead>
                                    <tr>
                                        <th style="width: 8%">@lang('app.quantitative-data-ver2.stt')</th>
                                        <th>@lang('app.quantitative-data-ver2.name-material-table')</th>
                                        <th>@lang('app.quantitative-data-ver2.value-material-table')</th>
                                        <th>@lang('app.quantitative-data-ver2.unit-material-table')</th>
                                        <th>@lang('app.quantitative-data-ver2.price-material-table')</th>
                                        <th>@lang('app.quantitative-data-ver2.total-amount-material-table')
                                        </th>
                                        <th>% Hao hụt</th>
                                        <th>@lang('app.quantitative-data-ver2.total-amount-material-table')<br>(Đã bao
                                            gồm hao hụt)
                                        </th>
                                        <th style="width: 5%"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <!-- Alert card end -->
                    </div>
                    <div class="edit-flex-auto-fill col-sm-3 pl-0" data-intro="Chi tiết món ăn" data-step="4">
                        <div class="card card-block ml-2 flex-sub pl-4" id="loading-food-quantitative-v2"
                             data-title="@lang('app.quantitative-data-ver2.select-food')">
                            <h5 class="sub-title m-0 mb-3">@lang('app.quantitative-data.title')</h5>
                            <div class="form-group row flex-column">
                                <div class="m-b-10 pl-3 f-w-600 col-form-label-fz-15">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.quantitative-data-ver2.food.avatar')</p>
                                </div>
                                <div class="profile-thumb pb-3 w-100 text-center">
                                    <img id="avatar-food-in-quantitative" class="profile-image-avatar" alt=""
                                         onerror="imageDefaultOnLoadError($(this))"
                                         style="border: 3px solid #c1c1c1;width: 9rem;height: 9rem"
                                         src="{{asset('images/food_file.jpg',env('IS_DEPLOY_ON_SERVER'))}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.quantitative-data-ver2.food.name')</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="name-food-in-quantitative">
                                        ---</h6>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.quantitative-data-ver2.food.unit')</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="unit-food">---</h6>
                                </div>
                                <div class="col-lg-6">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.quantitative-data-ver2.food.category')</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="category-food">---</h6>
                                </div>
                            </div>
                            <div class="form-group row border-dashed">
                                <div class="col-lg-6">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.quantitative-data-ver2.food.original-price')</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                        id="price-original-food">0</h6>
                                </div>
                                <div class="col-lg-6">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.quantitative-data-ver2.price-label')</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                        id="price-food">0</h6>
                                </div>
                            </div>
                            <div class="form-group row pt-3">
                                <label class="pl-3">
                                    <span
                                        class="m-b-10 pr-2 f-w-600 col-form-label-fz-15">@lang('app.quantitative-data-ver2.revenu')</span>
                                    <label
                                        class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                        id="revenu-food">0</label>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveCreateQuantityFoodManage()"
                     onkeypress="saveCreateQuantityFoodManage()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/food/brand/create_quantity.js?version=13',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
