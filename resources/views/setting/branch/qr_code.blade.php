<div class="modal fade" id="modal-qr-check-in-branch-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.branch-setting.update.tabs.qr-code.title')</h4>
            </div>
            <div class="modal-body text-left">
                <div class="card">
                    <div class="card-block">
                        <div id="code-qr-check-in-branch-manage" class="text-center"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled waves-effect" onclick="closeModalQrcodeCheckIn()"
                        onkeypress="closeModalQrcodeCheckIn()">@lang('app.component.button.close')</button>
            </div>
        </div>
    </div>
</div>
