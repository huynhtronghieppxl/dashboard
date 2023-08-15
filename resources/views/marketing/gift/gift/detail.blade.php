<style>
    #modal-detail-gift-marketing h6 p {
        font-size:  15px !important;
    }
</style>
<div class="modal fade" id="modal-detail-gift-marketing" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.gift-marketing.detail.title')</h4>
                <button type="button" class="close" onclick="closeModalDetailGiftMarketing()" onkeypress="closeModalDetailGiftMarketing()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color" id="loading-detail-gift-marketing">
                <div class="cover-profile">
                    <div class="profile-bg-img bg-white-border box-image bg-white" id="branch-cover-image">
                        <figure class="box-image-banner-branch">
                            <img onerror="this.src='/images/tms/default.jpeg'"
                                 id="thumbnail-gift-banner-detail-gift-marketing" src="{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}"
                                 alt="">
                        </figure>
                    </div>
                </div>
                <div class="card card-block">
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.gift-marketing.detail.name')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                id="name-detail-gift-marketing"></h6>
                        </div>
                        <div class="col-sm-4">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.gift-marketing.update.type')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                id="type-detail-gift-marketing"></h6>
                        </div>
                        <div class="col-sm-4 point-detail-gift-marketing">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.gift-marketing.update.value-point')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                id="point-detail-gift-marketing"></h6>
                        </div>
                        <div class="col-sm-4">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.gift-marketing.update.branch')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                id="branch-detail-gift-marketing"></h6>
                        </div>
                        <div class="col-sm-4">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.gift-marketing.update.day')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                id="expire-day-detail-gift-marketing"></h6>
                        </div>
                        <div class="col-sm-4">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">Vào các ngày</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                id="day-of-weeks-detail-gift-marketing"></h6>
                        </div>
                        <div class="col-sm-4">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.gift-marketing.update.type-hour')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                id="hour-create-detail-gift-marketing"></h6>
                        </div>
                        <div class="col-sm-4">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.gift-marketing.update.type-day')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                id="day-create-detail-gift-marketing"></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.gift-marketing.update.content')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                id="content-detail-gift-marketing"></h6>
                        </div>
                        <div class="col-sm-4">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.gift-marketing.update.use-guide')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                id="use-guide-detail-gift-marketing"></h6>
                        </div>
                        <div class="col-sm-4">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.gift-marketing.update.term')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                id="term-detail-gift-marketing"></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.gift-marketing.update.description')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                id="description-detail-gift-marketing"></h6>
                        </div>
                    </div>
                    <div class="col-12 d-none px-0 mb-2 table-food-detail-gift-marketing" >
                        <div class="table-responsive new-table">
                            <h5 class="text-bold sub-title f-w-600">Danh sách món tặng</h5>
                            <table class="table" id="table-food-detail-gift-marketing">
                                <thead>
                                <tr>
                                    <th>@lang('app.gift-marketing.detail.stt')</th>
                                    <th>@lang('app.gift-marketing.detail.name-food')</th>
                                    <th>@lang('app.gift-marketing.detail.quantity-food')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

@include('manage.food.brand.detail')
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\marketing\gift\gift\detail.js?version=3',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

