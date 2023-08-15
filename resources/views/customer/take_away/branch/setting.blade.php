<div class="modal fade" id="modal-setting-take-away">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.take-away-branch.setting.title')</h4>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-modal-setting-take-away">
                <div class="card card-block">
                    <h4 class="sub-title">@lang('app.take-away-branch.setting.video')</h4>
                    <video width="100%" controls>
                        <source src="http://techslides.com/demos/sample-videos/small.mp4" type="video/mp4">
                    </video>
                </div>
            </div>
            <div class="modal-footer">
{{--                <div class="checkbox-zoom zoom-primary m-auto">--}}
{{--                    <label>--}}
{{--                        <input type="checkbox" id="check-setting-take-away">--}}
{{--                        <span class="cr">--}}
{{--                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>--}}
{{--                        </span>--}}
{{--                        <span class="font-weight-bold">@lang('app.take-away-branch.setting.validate')</span>--}}
{{--                    </label>--}}
{{--                </div>--}}
                <div class="form-validate-checkbox m-auto">
                    <div class="checkbox-form-group">
                        <input type="checkbox" id="check-setting-take-away">
                        <span class="font-weight-bold">@lang('app.take-away-branch.setting.validate')</span>
                    </div>
                </div>
{{--                <button type="button" id="btn-save-setting-take-away"--}}
{{--                        class="btn btn-warning waves-effect waves-light d-none" onclick="saveModalSettingTakeAway()"--}}
{{--                        onkeypress="saveModalSettingTakeAway()">@lang('app.take-away-branch.setting.save')</button>--}}
                <div id="btn-save-setting-take-away" type="button" class="btn seemt-orange seemt-bg-orange seemt-btn-hover-orange d-none" onclick="saveModalSettingTakeAway()" onkeypress="saveModalSettingTakeAway()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.take-away-branch.setting.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/customer/take_away/branch/setting.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
