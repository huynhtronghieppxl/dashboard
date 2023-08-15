<div class="modal fade" id="modal-update-content-display-secondary" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Cập nhật nội dung hiển thị</h4>
                <button type="button" class="close ml-4" onclick="closeModalUpdateDisplaySecPos()" onkeypress="closeModalUpdateDisplaySecPos()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-update-content-display-secondary">
                <div class="card-block card m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input id="content-update-display-secondary-pos" class="form-control" data-emoji="1"
                                   data-empty="1" data-min-length="2" data-max-length="100" data-spec="1">
                            <label for="content-update-display-secondary-pos">
                                @lang('app.media-restaurant.create.name-two')
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew " data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại"
                        onclick="resetModalUpdateDisplaySecPos()"
                        onkeypress="resetModalUpdateDisplaySecPos()">
                    <i class="fa fa-eraser"></i>
                </button>

                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveUpdateDisplaySecPos()"
                     onkeypress="saveUpdateDisplaySecPos()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/marketing/display_secondary/update_content.js?version=2',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
