<div class="modal fade" id="modal-material-unit-order-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title material-unit-order-data">@lang('app.unit-order-data.detail-material.title')</h4>
                <button type="button" class="close" onclick="closeModalMaterialUnitOrderData()"
                        onkeypress="closeModalMaterialUnitOrderData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left material-unit-order-data">
                <div class="card-block card m-0">
                    <div class="table-responsive new-table">
                        <table id="table-material-unit-order-data" class="table">
                            <thead>
                            <tr>
                                <th>@lang('app.unit-order-data.detail-material.stt')</th>
                                <th>@lang('app.unit-order-data.detail-material.name-material')</th>
                                <th>@lang('app.unit-order-data.detail-material.name')</th>
                                <th>@lang('app.unit-order-data.detail-material.specifications-material')</th>
                                <th>@lang('app.unit-order-data.detail-material.change-unit-material')</th>
                                <th></th>
                                <th class="d-none key_search"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@include('build_data.material.material.detail')
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\material\unit_order\material.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
