<style>
    .minicolors-swatch{
        margin-top: -9px;
    }
</style>
<div class="modal fade" id="modal-create-card-tag" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.card-tag.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateCardTag()" onkeypress="closeModalCreateCardTag()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left " id="loading-modal-create-card-tag">
                <div class="card card-block m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="name-create-card-tag" class="form-control" type="text" data-empty="1" data-min-length="2"  data-max-length="50">
                            <label for="name-create-card-tag">
                                @lang('app.card-tag.create.name')
                                @include('layouts.start')
                            </label>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left card-tag-color-validate-group">
                            <input id="card-tag-color-validate" hidden type="text" data-empty="1" class="form-control" value="#000">
                            <input id="card-tag-color" class="form-control demo minicolors-input" data-control="hue" value="#ffa223" style="padding-left: 40px !important;">
                            <label for="card-tag-color">
                                @lang('app.card-tag.create.color')
                                @include('layouts.start')
                            </label>
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="reload-create-card-tag" class="btn-renew d-none" onclick="reloadModalCreateCardTag()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div id="btn-create-card-value"  type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalCreateCardTag()" onkeypress="saveModalCreateCardTag()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.title-button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/customer/card_tag/create.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
