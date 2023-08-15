<style>
    .search-customer-booking-table-manage {
        width: calc(100% - 20px);
        position: absolute;
        background-color: #34465d;
        z-index: 999;
        border-radius: 10px;
        max-height: 200px;
        overflow-y: auto;
        overflow-x: hidden;
        display: block;
    }

    .search-customer-booking-table-manage::-webkit-scrollbar{
        width: 4px;
        background-color: #F5F5F5;
    }

    .search-customer-booking-table-manage::-webkit-scrollbar-thumb{
        background-color: #6c757d;
    }

    .item-search-customer {
        display: inline-block;
        padding: 5px 10px;
        position: relative;
        width: 100%;
        cursor: default;
    }

    .item-search-customer:hover {
        background-color: #2e3c52;
    }

    .item-search-customer figure {
        display: inline-block;
        margin-bottom: 0;
        vertical-align: middle;
        width: 30px;
    }

    .item-search-customer figure img {
        border-radius: 100%;
        width: 30px;
        height: 30px;
        vertical-align: middle;
        border-style: none;
    }

    .item-search-customer .friend-meta {
        display: inline-block;
        padding-left: 10px;
        vertical-align: middle;
        width: calc(100% - 35px);
    }

    .item-search-customer .friend-meta > h4 {
        color: #fff;
        display: inline-block;
        font-size: 13px;
        font-weight: 500;
        margin-bottom: 0;
        width: 100%;
    }

    .item-search-customer .label-level {
        padding: 5px;
        position: absolute;
        right: 0;
    }
</style>
<div class="modal fade" id="modal-create-cards" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.cards.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateCards()" onkeypress="closeModalCreateCards()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-create-cards">
                <div class="card card-block ">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-validate-select ">
                                <div class="col-lg-12 mx-0 px-0">
                                    <div class="col-lg-12 pr-0 select-material-box">
                                        <select id="phone-customer-create-cards"
                                                class="js-data-example-ajax js-example-language col-sm- select2-hidden-accessible" data-select="1">
                                            <option
                                                value="" selected disabled>Chọn khách hàng</option>
                                        </select>
                                        <label>
                                           Số điện thoại
                                           @include('layouts.start')
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select ">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="select-method-create-card-manage" data-select="1"
                                                    class="js-example-basic-single">
                                                <option value="" selected disabled>Vui lòng chọn</option>
                                                <option value="1">Tiền mặt</option>
                                                <option value="2">Cà thẻ</option>
                                                <option value="6">Chuyển khoản</option>
                                            </select>
                                            <label class="icon-validate">
                                               Phương thức
                                                @include('layouts.start')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3">
                        <div class="form-group row align-items-center">
                            <div class="col-lg-12 my-auto pl-0">
                                <label class="f-w-600 mb-0" style="font-size: 17px!important;">@lang('app.cards.create.customer') :
                                    <span class="my-auto pl-2 text-muted" id="name-customer-create-cards" style="font-size: 17px!important;"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 pl-0">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <div class="row custom-card" id="choose-card-create-cards"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none" onclick="reloadModalCreateCards()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalCreateCards()" onkeypress="saveModalCreateCards()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/customer/cards/create.js?version=6', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
