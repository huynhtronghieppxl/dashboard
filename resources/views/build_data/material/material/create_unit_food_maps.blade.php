<div class="modal fade" id="modal-unit-food-maps" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Danh sách đơn vị bán</h4>
                <div class="d-flex align-items-center">
                    <label class="label label-lg" id="status-text-detail"></label>
                    <button type="button" class="close ml-4" onclick="closeModalSellingUnit()" onkeypress="closeModalSellingUnit()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body" id="loading-modal-unit-food-maps">
                <div class="card-block card m-0">
                    <div class="tab-pane" id="tab2-contact-supplier-data" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select id="select-brand-create-material-unit-food-maps" data-select="1" class="js-example-basic-single select2-hidden-accessible" >
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->where('is_office',
                                            '!==',(int)Config::get('constants.type.checkbox.SELECTED'))->all() as $db)
                                            <option value="{{$db['id']}}">{{$db['name']}}</option>
                                            @endforeach
                                        </select>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-instagram d-none" id="detail-bill-liabilities"
                        onclick="detailModalDetailBillLiabilities()"
                        onkeypress="detailModalDetailBillLiabilities()">@lang('app.bill-liabilities.detail.detail')</button>
            </div>
        </div>
    </div>
</div>
@include('build_data.kitchen.material_unit_food.create')
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js/build_data/material/material/create_unit_food_maps.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
