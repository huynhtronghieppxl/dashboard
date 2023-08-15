<style>
    #modal-change-password .eye-hide-password {
        top: 20px;
        height: 18px;
        margin-top: 0 !important;
    }
</style>
<div class="modal fade" id="modal-change-password" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.profile.password-title')</h4>
                <button type="button" class="close" onclick="closeModalPassWord()" onkeypress="closeModalPassWord()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color">
                <div class="card card-block">
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input class="w-100" id="old-password-update"
                                   data-icon="icofont icofont-paper" data-empty="1" data-min-length="4" data-emoji="1"
                                   data-max-length="8" type="password">
                            <label for="cost-data-name-create">
                                @lang('app.profile.old-password')
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                            <i class="fi-rr-eye-crossed eye-hide-password"
                               onclick="viewPassProfile($(this))"></i>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input class="w-100" id="new-password-update"
                                   data-icon="icofont icofont-paper" data-empty="1" data-min-length="4" data-emoji="1"
                                   data-max-length="8" type="password">
                            <label for="cost-data-name-create">
                                @lang('app.profile.new-password')
                                @include('layouts.start')</label>
                            <div class="line"></div>
                            <span><i class="fi-rr-eye-crossed eye-hide-password"
                               onclick="viewPassProfile($(this))"></i></span>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input class="w-100" id="re-password-update"
                                   data-icon="icofont icofont-paper" data-empty="1" data-min-length="4" data-emoji="1"
                                   data-max-length="8" type="password">
                            <label for="cost-data-name-create">
                                @lang('app.profile.re-password')
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                            <i class="fi-rr-eye-crossed eye-hide-password"
                               onclick="viewPassProfile($(this))"></i>
                        </div>
                        <div class="link-href" id="error-re-password-update"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveUpdatePassword()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.update_profile')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\setting\profile\password.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
