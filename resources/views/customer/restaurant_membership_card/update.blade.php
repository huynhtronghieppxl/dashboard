<div class="modal fade" id="modal-update-membership-card" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-custom" id="load-modal-content-update">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.restaurant-membership-card.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateMemberShipCard()" onkeypress="closeModalUpdateMemberShipCard()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-update-membership-card">
                <div class="row card card-block">
                    <div class="col-12 p-0 row align-items-center justify-content-center mx-0">
                        <div class="col-lg-5 z-depth-bottom waves-effect color-hex-code rounded text-light px-4 py-3"
                             id="card-color-update-membership-card" style="border-radius: 15px !important;">
                            <div class="row align-items-center">
                                <div class="col-lg-7 pl-0">
                                    <div class="row align-items-center">
                                        <img
                                            src="https://is5-ssl.mzstatic.com/image/thumb/Purple112/v4/80/13/3a/80133a1a-acd7-3ee4-9290-d29edf61e1c9/AppIcon-1x_U007emarketing-0-7-0-sRGB-85-220.png/246x0w.webp"
                                            width="40px" style="border-radius: 13px" alt="">
                                        <div class="ml-2">
                                            AloLine
                                            <p>aloline.vn</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5 pl-0 text-right">
                                    <h4 style="width: 120px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden" class="text-uppercase mb-0" id="card-name-update-membership-card"></h4>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center mt-3">
                                <div class="col-lg-6 pl-0">
                                    <p class="card-point text-uppercase mr-0">@lang('app.restaurant-membership-card.update.point')
                                    </p>
                                    <h4 class="mb-0" id="card-point-update-membership-card"></h4>
                                </div>
                                <div class="col-sm-6 text-right pr-0">
                                    <p class="mb-0">@lang('app.restaurant-membership-card.update.create')
                                    </p>
                                    <span id="card-create-update-membership-card"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="card-block">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600 seemt-fz-14">@lang('app.restaurant-membership-card.update.detail-card')</h6>
                                <div class="row">
                                    <div class="form-group validate-group w-100">
                                        <div class="form-validate-input">
                                            <input id="name-update-membership-card" class="form-control" type="text"
                                                   data-empty="1" data-max-length="50">
                                            <label for="name-update-membership-card">
                                               @lang('app.restaurant-membership-card.update.name-card')
                                               @include('layouts.start')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                    <div class="form-group validate-group w-100">
                                        <div class="form-validate-input form-left">
                                            <input type="text" id="color-update-membership-card" class="form-control demo minicolors-input" data-control="hue" value="#ff6161" style="padding-left: 44px !important;">
                                            <label for="show-card-point-membership-card">
                                                @lang('app.restaurant-membership-card.create.color')
                                            </label>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>

                                    <div class="form-group validate-group w-100">
                                        <div class="form-validate-input">
                                            <input class="form-control text-right" data-type="currency-edit"
                                                   id="point-update-membership-card" data-max="999999999" data-money="1" value="0" data-min="1">
                                            <label for="point-update-membership-card">
                                                @lang('app.restaurant-membership-card.update.point-card')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>

                                    <div class="form-group validate-group w-100">
                                        <div class="form-validate-input">
                                            <input class="form-control text-right" data-type="currency-edit"
                                                   id="percent-update-membership-card"
                                                   data-percent="1">
                                            <label for="percent-update-membership-card">
                                                @lang('app.restaurant-membership-card.update.discount')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                    <div class="form-group validate-group d-none w-100"
                                         id="div-month-update-membership-card">
                                        <div class="form-validate-input">
                                            <input id="month-update-membership-card" class="form-control" type="text"
                                                   value="1"  data-empty="1" data-min="1" data-max="100"
                                                   data-type="currency-edit">
                                            <label for="month-update-membership-card">
                                             @lang('app.restaurant-membership-card.update.duration')
                                              @include('layouts.start')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div  id="save-modal-update-update-membership-card"  type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalUpdateMemberShipCard()" onkeypress="saveModalUpdateMemberShipCard()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.title-button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/customer/restaurant_membership_card/update.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
