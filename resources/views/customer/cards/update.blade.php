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
<div class="modal fade" id="modal-update-cards" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Chỉnh sửa</h4>
                <button type="button" class="close" onclick="closeModalUpdateCards()" onkeypress="closeModalUpdateCards()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-update-cards">
                <div class="card card-block">
                    <div class="row d-flex align-items-center">
                        <div class="col-sm-6">
                            <div class="form-group row align-items-center " style="margin-bottom: 0 !important;">
                                <div class="col-lg-6  px-0">
                                    <label class="f-w-600 mb-0" style="font-size:16px;">@lang('app.cards.create.customer') :</label>
                                </div>
                                <div class="col-lg-6 input-group pl-0">
                                    <label class="my-auto pl-0 text-muted" style="font-size:16px;color: #E96012 !important;"
                                           id="name-customer-update-cards"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-validate-select ">
                                <div class="col-lg-12 mx-0 px-0">
                                    <div class="col-lg-12 pr-0 select-material-box">
                                        <select id="phone-customer-update-cards"
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
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalUpdateCards()" onkeypress="saveModalUpdateCards()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/customer/cards/update.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
