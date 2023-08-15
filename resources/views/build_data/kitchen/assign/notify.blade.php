<div class="modal fade" id="modal-notify-change-status-assign-kitchen" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="min-width: 70% !important;max-width: 70% !important;"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close ml-auto" onclick="closeModalNotifyAssignKitchenData()" onkeypress="closeModalNotifyAssignKitchenData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;"><div class="swal2-icon-content">!</div></div>
            <div class="text-center" style="font-size: 1.875em; font-weight: 500">@lang('app.food-manage.change-kitchen.title-left')</div>
            <div class="modal-body pt-0" style="padding-top: 0 !important;background-color: #fff !important;">
                <h5 class="text-center font-weight-bold" id="message-change-status-assign-kitchen-data"></h5>
                <div class=" card-block">
                    <div class="table-responsive new-table">
                        <table id="table-cannot-assign-kitchen" class="table" >
                            <thead>
                            <tr>
                                <th class="text-center">@lang('app.food-manage.change-kitchen.stt')</th>
                                <th class="text-left">@lang('app.food-manage.change-kitchen.food_name')</th>
                                <th class="text-left">@lang('app.food-manage.change-kitchen.category_name')</th>
                                <th class="d-none"></th>
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
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\kitchen\assign\notify.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
