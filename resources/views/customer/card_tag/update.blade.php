<div class="modal fade" id="modal-update-card-tag" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.card-tag.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateCardTag()" onkeypress="closeModalUpdateCardTag()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-update-card-tag">
                <div class="card card-block m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="name-update-card-tag" class="form-control" type="text" data-empty="1" data-min-length="2" data-max-length="50">
                            <label for="name-update-card-tag">
                                @lang('app.card-tag.create.name')
                                @include('layouts.start')
                            </label>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left card-tag-color-update-validate-group">
                            <input id="card-tag-color-update-validate" hidden type="text" data-empty="1" class="form-control" value="#000">
                            <input type="text" id="card-tag-color-update" class="form-control demo minicolors-input" data-control="hue" value="#ff6161" style="padding-left: 40px !important;">
                            <label for="card-tag-color">
                                @lang('app.card-tag.update.color')
                                @include('layouts.start')
                            </label>
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalUpdateCardTag()" onkeypress="saveModalUpdateCardTag()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.title-button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/customer/card_tag/update.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush


