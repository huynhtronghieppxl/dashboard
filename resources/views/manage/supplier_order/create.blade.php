<style>

</style>
<div class="modal fade" id="modal-create-supplier-order" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.supplier-order.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateSupplierOrder()" onkeypress="closeModalCreateSupplierOrder()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left background-body-color" id="loading-create-supplier-order">
                <div class="row d-flex">
                    <div class="col-lg-9 edit-flex-auto-fill" style="flex-direction: column">
                        <ul class="nav nav-tabs md-tabs" role="tablist" id="tab-inventory-supplier-order">
                            <li class="nav-item">
                                <a class="nav-link active remove-draw-table" data-toggle="tab" data-type="0"
                                   href="#tab1-create-supplier-order"
                                   data-id="1"
                                   role="tab"
                                   aria-expanded="false">@lang('app.supplier-order.create.opt1') <span
                                        class="label label-warning"
                                        id="total-record-material-create-supplier-order">0</span></a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link remove-draw-table" data-toggle="tab" data-type="1"
                                   href="#tab2-create-supplier-order"
                                   data-id="2"
                                   role="tab"
                                   aria-expanded="false">@lang('app.supplier-order.create.opt2') <span
                                        class="label label-primary"
                                        id="total-record-goods-create-supplier-order">0</span></a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link remove-draw-table" data-toggle="tab" data-type="2"
                                   href="#tab3-create-supplier-order"
                                   data-id="3"
                                   role="tab"
                                   aria-expanded="false">@lang('app.supplier-order.create.opt3') <span
                                        class="label label-success"
                                        id="total-record-internal-create-supplier-order">0</span></a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link remove-draw-table" data-toggle="tab" data-type="3"
                                   href="#tab4-create-supplier-order"
                                   data-id="12"
                                   role="tab" aria-expanded="false">@lang('app.supplier-order.create.opt4')
                                    <span
                                        class="label label-danger"
                                        id="total-record-other-create-supplier-order">0</span></a>
                                <div class="slide"></div>
                            </li>
                        </ul>
                        <div class="card flex-sub m-0">
                            <div class="tab-content">
                                <div class="card-block tab-pane active" id="tab1-create-supplier-order" role="tabpanel">
                                    <div class="table-responsive new-table">
                                        <div class="select-filter-dataTable">
                                            <div class="form-validate-select">
                                                <div class="pr-0 select-material-box">
                                                    <select class="js-example-basic-single"
                                                            id="select-material-create-supplier-order">
                                                        <option>Chọn nguyên liệu</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <button style="width: 145px;height: 32px;margin-left: 10px;border-radius: 4px;padding: 6px 0" onclick="openModalSelectMultipleMaterial(1)"><i class="fi-rr-list-check d-inline-block mr-2 seemt-green"></i> Chọn nhanh</button>
                                        </div>
                                        <table class="table" id="table-material-create-supplier-order">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 5%">@lang('app.supplier-order.create.stt')</th>
                                                    <th class="text-left" style="width: 20%">@lang('app.supplier-order.create.name')</th>
                                                    <th class="text-center">@lang('app.supplier-order.create.remain-quantity')</th>
                                                    <th class="text-center" style="width: 20%">@lang('app.supplier-order.create.quantity')</th>
                                                    <th class="text-center" style="width: 20%"><span class="d-inline-block">Đơn vị cung cấp</span> <i class="fi-rr-exclamation pointer d-inline-block" style="transform: translateY(-2px);" data-toggle="tooltip" data-placement="top" data-original-title="NCC (Giá nguyên liệu)"></i></th>
                                                    <th class="text-right" style="width: 10%">@lang('app.supplier-order.create.price')</th>
                                                    <th class="text-right" style="width: 8%">@lang('app.supplier-order.create.total-price')</th>
                                                    <th class="text-center" style="width: 8%"></th>
                                                    <th class="key_search d-none"></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-block tab-pane" id="tab2-create-supplier-order" role="tabpanel">
                                    <div class="table-responsive new-table">
                                        <div class="select-filter-dataTable">
                                            <div class="form-validate-select">
                                                <div class="pr-0 select-material-box">
                                                    <select class="js-example-basic-single"
                                                            id="select-goods-create-supplier-order">
                                                    </select>
                                                </div>
                                            </div>
                                            <button style="width: 145px;height: 32px;margin-left: 10px;border-radius: 4px;padding: 6px 0" onclick="openModalSelectMultipleMaterial(2)"><i class="fi-rr-list-check d-inline-block mr-2 seemt-green"></i> Chọn nhanh</button>
                                        </div>
                                        <table class="table" id="table-goods-create-supplier-order">
                                            <thead>
                                            <tr>
                                                <th class="text-center" style="width: 5%">@lang('app.supplier-order.create.stt')</th>
                                                <th class="text-left" style="width: 20%">@lang('app.supplier-order.create.name')</th>
                                                <th class="text-center">@lang('app.supplier-order.create.remain-quantity')</th>
                                                <th class="text-center" style="width: 20%">@lang('app.supplier-order.create.quantity')</th>
                                                <th class="text-center" style="width: 20%"><span class="d-inline-block">Đơn vị cung cấp</span> <i class="fi-rr-exclamation pointer d-inline-block" style="transform: translateY(-2px);" data-toggle="tooltip" data-placement="top" data-original-title="NCC (Giá nguyên liệu)"></i></th>
                                                <th class="text-right" style="width: 10%">@lang('app.supplier-order.create.price')</th>
                                                <th class="text-right" style="width: 8%">@lang('app.supplier-order.create.total-price')</th>
                                                <th class="text-center" style="width: 8%"></th>
                                                <th class="key_search d-none"></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-block tab-pane" id="tab3-create-supplier-order" role="tabpanel">
                                    <div class="table-responsive new-table">
                                        <div class="select-filter-dataTable">
                                            <div class="form-validate-select">
                                                <div class="pr-0 select-material-box">
                                                    <select class="js-example-basic-single"
                                                            id="select-internal-create-supplier-order">
                                                    </select>
                                                </div>
                                            </div>
                                            <button style="width: 145px;height: 32px;margin-left: 10px;border-radius: 4px;padding: 6px 0" onclick="openModalSelectMultipleMaterial(3)"><i class="fi-rr-list-check d-inline-block mr-2 seemt-green"></i> Chọn nhanh</button>
                                        </div>
                                        <table class="table" id="table-internal-create-supplier-order">
                                            <thead>
                                            <tr>
                                                <th class="text-center" style="width: 5%">@lang('app.supplier-order.create.stt')</th>
                                                <th class="text-left" style="width: 20%">@lang('app.supplier-order.create.name')</th>
                                                <th class="text-center">@lang('app.supplier-order.create.remain-quantity')</th>
                                                <th class="text-center" style="width: 20%">@lang('app.supplier-order.create.quantity')</th>
                                                <th class="text-center" style="width: 20%"><span class="d-inline-block">Đơn vị cung cấp</span> <i class="fi-rr-exclamation pointer d-inline-block" style="transform: translateY(-2px);" data-toggle="tooltip" data-placement="top" data-original-title="NCC (Giá nguyên liệu)"></i></th>
                                                <th class="text-right" style="width: 10%">@lang('app.supplier-order.create.price')</th>
                                                <th class="text-right" style="width: 8%">@lang('app.supplier-order.create.total-price')</th>
                                                <th class="text-center" style="width: 8%"></th>
                                                <th class="key_search d-none"></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-block tab-pane" id="tab4-create-supplier-order" role="tabpanel">
                                    <div class="table-responsive new-table">
                                        <div class="select-filter-dataTable">
                                            <div class="form-validate-select">
                                                <div class="pr-0 select-material-box">
                                                    <select class="js-example-basic-single"
                                                            id="select-other-create-supplier-order">
                                                    </select>
                                                </div>
                                            </div>
                                            <button style="width: 145px;height: 32px;margin-left: 10px;border-radius: 4px;padding: 6px 0" onclick="openModalSelectMultipleMaterial(12)"><i class="fi-rr-list-check d-inline-block mr-2 seemt-green"></i> Chọn nhanh</button>
                                        </div>
                                        <table class="table" id="table-other-create-supplier-order">
                                            <thead>
                                            <tr>
                                                <th class="text-center" style="width: 5%">@lang('app.supplier-order.create.stt')</th>
                                                <th class="text-left" style="width: 20%">@lang('app.supplier-order.create.name')</th>
                                                <th class="text-center">@lang('app.supplier-order.create.remain-quantity')</th>
                                                <th class="text-center" style="width: 20%">@lang('app.supplier-order.create.quantity')</th>
                                                <th class="text-center" style="width: 20%"><span class="d-inline-block">Đơn vị cung cấp</span> <i class="fi-rr-exclamation pointer d-inline-block" style="transform: translateY(-2px);" data-toggle="tooltip" data-placement="top" data-original-title="NCC (Giá nguyên liệu)"></i></th>
                                                <th class="text-right" style="width: 10%">@lang('app.supplier-order.create.price')</th>
                                                <th class="text-right" style="width: 8%">@lang('app.supplier-order.create.total-price')</th>
                                                <th class="text-center" style="width: 8%"></th>
                                                <th class="key_search d-none"></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub my-1">
                            <h5 class="text-bold sub-title mr-0 ml-0 col-form-label-fz-15 f-w-600">@lang('app.supplier-order.create.title-right')</h5>
                            <div class="form-group row d-none">
                                <label
                                    class="col-sm-4 col-form-label">@lang('app.supplier-order.create.branch')</label>
                                <div class="col-sm-8">
                                    <select id="select-branch-create-supplier-order"
                                            class="js-example-basic-single" data-icon="">
                                        @if(Session::get(SESSION_KEY_PERMISSION_TALLEST) > 1)
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->where('is_office',(int)Config::get('constants.type.checkbox.DIS_SELECTED') )->all() as $db)
                                                @if(Session::get(SESSION_KEY_BRANCH_ID) === $db['id'])
                                                    <option value="{{$db['id']}}" selected>{{$db['name']}}</option>
                                                @else
                                                    <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option
                                                value="{{Session::get(SESSION_JAVA_ACCOUNT)['branch_id']}}"
                                                selected>{{Session::get(SESSION_JAVA_ACCOUNT)['branch_name']}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row d-none">
                                <label
                                    class="col-sm-4 col-form-label">@lang('app.supplier-order.create.inventory')</label>
                                <div class="col-sm-8">
                                    <select id="select-inventory-create-supplier-order"
                                            class="js-example-basic-single">
                                        <option value="1" selected>@lang('app.supplier-order.create.opt1')</option>
                                        <option value="2">@lang('app.supplier-order.create.opt2')</option>
                                        <option value="3">@lang('app.supplier-order.create.opt3')</option>
                                        <option value="12">@lang('app.supplier-order.create.opt4')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group validate-group m-t-10">
                                <div class="form-validate-input">
                                    <input type="text" id="date-create-supplier-order"
                                           class="input-sm form-control text-center input-datetimepicker p-1"
                                           value="{{date('d/m/Y')}}">
                                    <label> @lang('app.supplier-order.create.date') </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group row">
                                <div class="pl-0 col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.create.total-material')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="total-material-create-supplier-order">0</h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.create.total-internal')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="total-internal-create-supplier-order">0</h6>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="pl-0 col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.create.total-goods')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="total-goods-create-supplier-order">0</h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.create.total-other')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="total-other-create-supplier-order">0</h6>
                                </div>
                            </div>
                            <div class="border-dashed"></div>
                            <div class="row mt-2">
                                <div class="pl-0 col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.create.total')</label>
                                    <label class="f-w-600 col-form-label-fz-15 f-right"
                                           id="total-create-supplier-order">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none" onclick="resetModalCreateSupplierOrder()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalCreateSupplierOrder()"
                        onkeypress="saveModalCreateSupplierOrder()">
                        <i class="fi-rr-disk"></i>
                        <span>@lang('app.component.button.send')</span></div>
                <div class="btn seemt-orange seemt-bg-orange seemt-btn-hover-orange" onclick="saveNewModalCreateSupplierOrder()"
                        onkeypress="saveNewModalCreateSupplierOrder()">
                        <i class="fi-rr-paper-plane"></i>
                        <span>@lang('app.component.button.send-and-create')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@include('manage.supplier_order.select_multi_material')
@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/supplier_order/create.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
