@extends('layouts.layout')
@section('content')
    <div class="page-wrapper" id="div-layout-campaign">
        <div class="page-body">
            <div class="row simple-cards users-card card-block">
                <div class="col-3 edit-flex-auto-fill">
                    <div class="card flex-sub">
                        <div class="card-block text-center" style="height: 250px">
                            <img src="{{asset('images/image_campaign_marketing/ic_guitinnhan.png',env('IS_DEPLOY_ON_SERVER'))}}"
                                 style="height: 100px">
                            <h4 class="m-t-15">Gửi tin nhắn hàng loạt</h4>
                            <p class="m-b-10">Soạn tin nhắn gửi tới hàng loạt khách hàng để chăm sóc sau bán, giữ chân
                                khách hàng</p>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue seemt-fz-14"
                                    style="font-weight: 500" data-type="0" onclick="openLayoutCampaign(0)">Xem chi
                                tiết
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-3 edit-flex-auto-fill">
                    <div class="card flex-sub">
                        <div class="card-block text-center" style="height: 250px">
                            <img src="{{asset('images/image_campaign_marketing/ic_guithongbao.png',env('IS_DEPLOY_ON_SERVER'))}}"
                                 style="height: 100px">
                            <h4 class="m-t-15">Gửi tin nhắn chăm sóc khách hàng</h4>
                            <p class="m-b-10">Soạn tin nhắn gửi tới hàng loạt khách hàng để chăm sóc sau bán, giữ chân
                                khách hàng</p>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue seemt-fz-14"
                                    style="font-weight: 500" data-type="1" onclick="openLayoutCampaign(1)">Xem chi
                                tiết
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-3 edit-flex-auto-fill">
                    <div class="card flex-sub">
                        <div class="card-block text-center" style="height: 250px">
                            <img src="{{asset('images/image_campaign_marketing/ic_sinhnhat.png',env('IS_DEPLOY_ON_SERVER'))}}"
                                 style="height: 100px">
                            <h4 class="m-t-15">Chúc mừng sinh nhật</h4>
                            <p class="m-b-10">Tự động gửi lời chúc mừng sinh nhật kèm Voucher quà tặng vào sinh nhật
                                khách hàng</p>

                        </div>
                        <div class="card-footer text-center">
                            <button class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue seemt-fz-14 disabled"
                                    data-type="2" onclick="openLayoutCampaign(2)" disabled>Xem chi
                                tiết
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-3 edit-flex-auto-fill">
                    <div class="card flex-sub">
                        <div class="card-block text-center" style="height: 250px">
                            <img src="{{asset('images/image_campaign_marketing/ic_khaitruongcosomoi.png',env('IS_DEPLOY_ON_SERVER'))}}"
                                 style="height: 100px">
                            <h4 class="m-t-15">Mua 1 tặng 1</h4>
                            <p class="m-b-10">Gửi tin nhắn kèm khuyến mãi cho khách hàng khi khai trương cơ sở mới</p>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue seemt-fz-14" data-type="7"
                                    style="font-weight: 500"
                                    onclick="openLayoutCampaign(7)">Xem chi tiết
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-3 mt-3 edit-flex-auto-fill">
                    <div class="card flex-sub">
                        <div class="card-block text-center" style="height: 250px">
                            <img src="{{asset('images/image_campaign_marketing/ic_thuthapykien.png',env('IS_DEPLOY_ON_SERVER'))}}"
                                 style="height: 100px">
                            <h4 class="m-t-15">Thu thập ý kiến đánh giá</h4>
                            <p class="m-b-10">Gửi tin nhắn khảo sát ý kiến khách hàng kèm quà tặng</p>

                        </div>
                        <div class="card-footer text-center">
                            <button class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue seemt-fz-14 disabled"
                                    style="font-weight: 500"
                                    onclick="openLayoutCampaign(3)" disabled>Xem chi tiết
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-3 mt-3 edit-flex-auto-fill">
                    <div class="card flex-sub">
                        <div class="card-block text-center" style="height: 250px">
                            <img src="{{asset('images/image_campaign_marketing/ic_thongbaothanghang.png',env('IS_DEPLOY_ON_SERVER'))}}"
                                 style="height: 100px">
                            <h4 class="m-t-15">Gửi thông báo thăng hạng</h4>
                            <p class="m-b-10">Gửi tin nhắn kèm khuyến mãi cho khách hàng khi thăng hạng</p>

                        </div>
                        <div class="card-footer text-center">
                            <button class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue seemt-fz-14 disabled"
                                    style="font-weight: 500"
                                    onclick="openLayoutCampaign(4)" disabled>Xem chi tiết
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-3 mt-3 edit-flex-auto-fill">
                    <div class="card flex-sub">
                        <div class="card-block text-center" style="height: 250px">
                            <img src="{{asset('images/image_campaign_marketing/ic_goiykhquaylai.png',env('IS_DEPLOY_ON_SERVER'))}}"
                                 style="height: 100px">
                            <h4 class="m-t-15">Gợi nhớ khách hàng trở lại mua hàng</h4>
                            <p class="m-b-10">Gửi tin nhắn kèm khuyến mãi cho khách hàng chưa trở lại mua hàng sau một
                                thời gian</p>

                        </div>
                        <div class="card-footer text-center">
                            <button class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue seemt-fz-14 disabled"
                                    style="font-weight: 500"
                                    onclick="openLayoutCampaign(5)" disabled>Xem chi tiết
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-3 mt-3 edit-flex-auto-fill">
                    <div class="card flex-sub">
                        <div class="card-block text-center" style="height: 250px">
                            <img src="{{asset('images/image_campaign_marketing/ic_khaitruongcosomoi.png',env('IS_DEPLOY_ON_SERVER'))}}"
                                 style="height: 100px">
                            <h4 class="m-t-15">Khai trương cơ sở mới</h4>
                            <p class="m-b-10">Gửi tin nhắn kèm khuyến mãi cho khách hàng khi khai trương cơ sở mới</p>

                        </div>
                        <div class="card-footer text-center">
                            <button class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue seemt-fz-14 disabled"
                                    style="font-weight: 500"
                                    onclick="openLayoutCampaign(6)" disabled>Xem chi tiết
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-3 mt-3 edit-flex-auto-fill" id="box-campaign-gift-beer">
                    <div class="card flex-sub">
                        <div class="card-block text-center" style="height: 250px">
                            <img src="{{asset('images/image_campaign_marketing/ic_khaitruongcosomoi.png',env('IS_DEPLOY_ON_SERVER'))}}"
                                 style="height: 100px">
                            <h4 class="m-t-15">Tặng bia</h4>
                            <p class="m-b-10">Thiết lập loại bia, điều kiện áp dụng và tời gian reset kho bia của chương
                                trình tặng bia hằng ngày cho khách hàng</p>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue seemt-fz-14"
                                    style="font-weight: 500" id="btn-detail-campaign-gitf-beer"
                                    onclick="openLayoutCampaign(8)" data-type="8">Xem chi tiết
                            </button>
                            {{--                            <button class="btn btn-grd-success btn-sm btn-round" id="btn-change-status-campaign-gitf-beer"--}}
                            {{--                                    onclick="openLayoutCampaign(8)" ><i class="fa fa-lock"></i>Tạm ngưng--}}
                            {{--                            </button>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('marketing.campaign.send_message.index')
    @include('marketing.campaign.after_payment.index')
    @include('marketing.campaign.one_get_one.index')
    @include('marketing.campaign.beer_store.index')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/marketing/campaign/index.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
