<style>
    .custom-card-membership{
        transform: scale(1.1);
        margin-right: calc(3%);
        box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22) !important;
    }
    .z-depth-bottom{
        padding: 15px 12px;
    }
    .minicolors-swatch{
        margin-top: -9px;
    }
    .seemt-container .btn > i {
        font-size: 13.33px;
        vertical-align: text-bottom;
    }
</style>
<div class="modal fade" id="modal-create-membership-card" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="load-modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.restaurant-membership-card.create.title')</h4>
                <button id="closeModal" type="button" class="close" onclick="closeModalCreateMemberShipCard()" onkeypress="closeModalCreateMemberShipCard()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-membership-card">
                <div class="card card-block">
                    <div id="tab1-membership-card">
                        <div class="row" id="content-template-membership-card">
                            {{--Content API--}}
                        </div>
                    </div>
                    <div id="tab2-membership-card" class="d-none">
                        <div class="row">
                            <div class="col-12 p-0 d-flex justify-content-center align-items-center">
                                <div class="col-lg-5 p-0 z-depth-bottom waves-effect color-hex-code rounded text-light w-100 px-4 py-3" id="show-card-color-membership-card">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 pl-0">
                                            <div class="row align-items-center">
                                                <img
                                                    src="https://is5-ssl.mzstatic.com/image/thumb/Purple112/v4/80/13/3a/80133a1a-acd7-3ee4-9290-d29edf61e1c9/AppIcon-1x_U007emarketing-0-7-0-sRGB-85-220.png/246x0w.webp"
                                                    width="40px" style="border-radius: 13px" alt="">
                                                <div class="ml-2">
                                                    @lang('app.customers.card-detail.title')
                                                    <p>@lang('app.customers.card-detail.title2')</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 pr-0 text-right pl-0">
                                            <h4 style="width: 120px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden" class="text-uppercase mb-0 show-card-name-membership-card" ></h4>
                                        </div>
                                    </div>
                                    <div class="row d-flex align-items-center mt-3">
                                        <div class="col-lg-6 pl-0">
                                            <p class="card-point text-uppercase mr-0">@lang('app.restaurant-membership-card.update.point')
                                            </p>
                                            <h4 class="mb-0 show-card-point"></h4>
                                        </div>
                                        <div class="col-sm-6 text-right pr-0">
                                            <p class="mb-0">@lang('app.restaurant-membership-card.update.create')
                                            </p>
                                            <span class="show-card-create-membership-card"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="card-block">
                                        <h6 class="m-b-20 p-b-5 b-b-default f-w-600 seemt-fz-14">@lang('app.restaurant-membership-card.create.detail-card')</h6>
                                        <div class="row">
                                            <div class="form-group validate-group w-100">
                                                <div class="form-validate-input form-left">
                                                    <input id="show-card-name-membership-card" class="form-control" type="text" data-empty="1" data-max-length="50">
                                                    <label for="show-card-name-membership-card">
                                                        @lang('app.restaurant-membership-card.create.name-card')
                                                        @include('layouts.start')
                                                    </label>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                            <div class="form-group validate-group w-100">
                                                <div class="form-validate-input form-left">
                                                    <input type="text" id="card-color-membership-card" class="form-control demo minicolors-input" data-control="hue" value="#ff6161" style="padding-left: 44px !important;">
                                                    <label for="show-card-point-membership-card">
                                                        @lang('app.restaurant-membership-card.create.color')
                                                    </label>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                            <div class="form-group validate-group w-100">
                                                <div class="form-validate-input">
                                                    <input class="form-control text-right" data-type="currency-edit" id="show-card-point-membership-card" data-max="999999999" data-money="1" value="0">
                                                    <label for="show-card-point-membership-card">
                                                        @lang('app.restaurant-membership-card.create.point-card')</label>
                                                    <div class="line"></div>
                                                </div><div class="link-href"></div>
                                            </div>
                                            <div class="form-group validate-group w-100">
                                                <div class="form-validate-input">
                                                    <input class="form-control text-right" data-type="currency-edit" id="show-card-percent-membership-card" data-percent="1">
                                                    <label for="show-card-percent-membership-card">
                                                        @lang('app.restaurant-membership-card.create.discount')</label>
                                                    <div class="line"></div>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                            <div class="form-group validate-group d-none w-100" id="div-show-card-month-membership-card">
                                                <div class="form-validate-input">
                                                    <input id="show-card-month-membership-card" class="form-control" type="text" value="1" data-empty="1" data-min="1"  data-type="currency-edit">
                                                    <label for="show-card-month-membership-card">
                                                        @lang('app.restaurant-membership-card.create.duration')
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
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none" onclick="reloadModalCreateMemberShipCard()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div id="back-modal-create-membership-card" type="button" class="btn seemt-orange seemt-bg-orange seemt-btn-hover-orange d-none" onclick="backModalCreateMemberShipCard()" onkeypress="backModalCreateMemberShipCard()">
                    <i class="fi-rr-arrow-left"></i>
                    <span>@lang('app.component.button.previous')</span>
                </div>
                <div  id="next-modal-create-membership-card" type="button" class="btn seemt-orange seemt-bg-orange seemt-btn-hover-orange" onclick="nextModalCreateMemberShipCard()" onkeypress="nextModalCreateMemberShipCard()">
                    <i class="fi-rr-arrow-right"></i>
                    <span>@lang('app.component.button.next')</span>
                </div>
                <div id="save-modal-create-membership-card"  type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue d-none" onclick="saveModalCreateMemberShipCard()" onkeypress="saveModalCreateMemberShipCard()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.title-button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
<span class="d-none" id="id-template-selected-membership-card"></span>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/customer/restaurant_membership_card/create.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

