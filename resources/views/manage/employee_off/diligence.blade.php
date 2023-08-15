<div class="modal fade" id="modal-diligence-employee-off-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document" id="tab-size">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('app.employee-off-manage.months-diligence.employee-months')
                    <span class="font-1-rem" id="employee-name-diligence-employee-off-manage"></span>
                </h5>
                <button id="btn-close-create-material" type="button" class="close" onclick="closeModalDiligenceEmployeeManage()" onkeypress="closeModalDiligenceEmployeeManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left background-body-color pb-0">
                <div class="card-block card m-0">
                    <div class="table-responsive new-table">
                        <table class="table"
                               id="table-diligence-employee-off-manage">
                            <thead>
                            <tr>
                                <th class="text-center" style="padding-left: 20px;">@lang('app.employee-off-manage.months-diligence.months')</th>
                                <th class="text-center" style="padding-left: 20px;">@lang('app.employee-off-manage.months-diligence.has-diligence')</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-custom"></div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\manage\employee_off\diligence.js?version=1')}}"></script>
@endpush
