<div class="modal fade" id="modal-notify-change-status-food-category" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="min-width: 70% !important;max-width: 70% !important;"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close ml-auto" onclick="closeModalNotifyFoodCategoryData()" onkeypress="closeModalNotifyFoodCategoryData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;"><div class="swal2-icon-content">!</div></div>
            <div class="text-center" style="font-size: 1.875em; font-weight: 500">@lang('app.category-food-data.change_status.notify')</div>
            <div class="modal-body pt-0" style="padding-top: 0 !important;background-color: #fff !important;">
                <h5 class="text-center font-weight-bold" id="message-change-status-food-category-data"></h5>
                <div class="card-block">
                    <div class="table-responsive new-table">
                        <table class="table" id="table-change-status-food-category-data">
                            <thead>
                            <tr>
                                <th>@lang('app.category-food-data.stt')</th>
                                <th>@lang('app.category-food-data.name_food')</th>
                                <th style="color: transparent">action</th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue d-none btn-change-unit-material"  >
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\food\category\notify.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
