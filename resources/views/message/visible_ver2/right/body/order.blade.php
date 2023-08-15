<style>
    .order-input-visible-message .simple-pagination ul {
        margin: 0;
    }
</style>
<div class="order-input-visible-message d-none" style="left: 320px;bottom: 10px">
    <div class="filter-order-visible-message">
        <i class="ti-search icon-search-order-input-visible-message"></i>
        <input class="filter-order-input-visible-message" type="text" placeholder="Tìm đơn hàng"/>
    </div>
    <div class="body-footer-order-visible-message" style="background-color: #f2f2f2">
        <div class="body-order-visible-message row d-flex" id="data-order-visible-message"
             style="width: 100%; margin: 0">
{{--            <div class="col-6" style="padding: 0;">--}}
{{--                <div class="card widget-card-1" style="margin: 20px 5px 10px 5px">--}}
{{--                    <div class="card-block-small" style="padding: 20px 5px 5px 5px">--}}
{{--                        <i class="feather icon-shopping-cart bg-c-blue card1-icon" style="transform: rotate(0deg) scale(0.6); left: 3px; top: -25px"></i>--}}
{{--                        <span class="text-c-blue f-w-600" style="font-size: 16px !important;">DH0000000581</span>--}}
{{--                        <h4 style="margin: 0">380,000đ</h4>--}}
{{--                        <label class="label label-success" style="padding: 5px; margin: 0;position: absolute;width: max-content;top: -10px;right: 5px;">Hoàn tất</label>--}}
{{--                        <div>--}}
{{--                                         <span class="f-left m-t-10 text-muted">--}}
{{--                                              <i class="text-c-yellow f-16 feather icon-calendar m-r-10"></i>14/09/2022 21:40--}}
{{--                                         </span>--}}
{{--                            <button class="btn btn-grd-success btn-round" data-id="' . $db['id'] . '" data-code="' . $db['code'] . '" data-time="' . $db['created_at'] . '" data-amount="' . $db['total_amount_reality'] . '" data-status="' . $db['status'] . '" onclick="sendOrderMessageVisible($(this))" style="padding: 3px 10px;">Gửi đơn</button>--}}
{{--                            <button class="btn btn-grd-primary btn-round" onclick="openDetailOrderSupplierOrder($(this))" style="padding: 3px 10px;">Chi tiết</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
    <div class="footer-order-visible-message">
        <nav aria-label="..." class="pagination-review-dashboard-introduce">
            <div class="simple-pagination"></div>
        </nav>
    </div>
</div>
@push('scripts')
    <script src="{{asset('js/message/visible_v2/order.js',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
