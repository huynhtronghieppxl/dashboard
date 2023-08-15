<div class="modal fade" id="modal-detail-permission-template" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title" id="title-modal-detail-permission-template"></h4>
            </div>
            <div class="modal-body background-body-color text-left">
                <div class="row card-block">
                    <label style="white-space: pre-line" id="content-modal-detail-permission-template"></label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-grd-disabled waves-effect " onclick="closeModalDetailPermissionTemplate()"
                        onkeypress="closeModalDetailPermissionTemplate()">@lang('app.component.button.close')</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/template_custom/permission.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
