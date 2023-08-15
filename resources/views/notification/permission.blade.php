<div class="modal fade" id="modal-permission-notification" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.Notification.detail.title')</h4>
            </div>
            <div class="modal-body text-left" id="loading-modal-detail-notificat">
                dsfsđffdsfdsfds
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary waves-effect button-radius" id="notify-active" onclick="onNotifycation()">Bật thông báo</button>
            </div>
        </div>
    </div>
</div>
{{--@push('scripts')--}}
{{--    <script type="text/javascript" src="{{ asset('../js/notification/config.js',env('IS_DEPLOY_ON_SERVER'))  }}"></script>--}}
{{--@endpush--}}

