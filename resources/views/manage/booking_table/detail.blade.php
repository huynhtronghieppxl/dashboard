<style>
    .list-gift-detail-booking-table-manage {
        overflow-x: visible;
        display: inherit;
    }

    .list-gift-detail-booking-table-manage .owl-nav {
        display: block;
    }

    .list-gift-detail-booking-table-manage .owl-dots {
        display: none;
    }

    .list-gift-detail-booking-table-manage .item {
        background: #f2f7fb none repeat scroll 0 0;
        border: 1px solid #ede9e9;
        border-radius: 3px;
        padding-bottom: 7px;
    }

    .list-gift-detail-booking-table-manage .sugtd-frnd-meta{
        display: inline-block;
        margin-top: 10px;
        text-align: center;
        width: 100%;
    }

    .list-gift-detail-booking-table-manage .sugtd-frnd-meta > a {
        color: #515365;
        display: inline-block;
        font-size: 13.5px;
        font-weight: 500;
        width: 100%;
        transition: all 0.2s linear 0s;
        height: 40.5px;
        overflow: hidden;
        text-overflow: ellipsis;
        -webkit-line-clamp: 2;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        padding: 0 3px;
    }
    .list-gift-detail-booking-table-manage .sugtd-frnd-meta > span {
        display: inline-block;
        font-size: 11px;
        width: 100%;
    }

    .list-gift-detail-booking-table-manage .add-remove-frnd {
        display: flex;
        justify-content: center;
        gap: 10px;
        list-style: outside none none;
        margin-top: 4px;
        padding: 0 14px;
        text-align: center;
        width: 100%;
    }
    .list-gift-detail-booking-table-manage .add-remove-frnd > li {
        display: inline-block;
    }
    .list-gift-detail-booking-table-manage .add-remove-frnd > li a {
        border-radius: 4px;
        color: #fff;
        display: inline-block;
        padding: 2px 5px;
        transition: all 0.2s linear 0s;
        font-size: 13px;
    }
    .list-gift-detail-booking-table-manage .add-remove-frnd > li a:hover{
        background: #fa6342;
    }
    .list-gift-detail-booking-table-manage .add-remove-frnd > li a > i {
        font-size: 13px;
    }
    .list-gift-detail-booking-table-manage .add-remove-frnd > li:last-child {
        margin-right: 0;
    }
    .list-gift-detail-booking-table-manage .add-tofrndlist > a{
        background: #0085b1 none repeat scroll 0 0;
    }

    .list-gift-detail-booking-table-manage .delete-tofrndlist > a{
        background: #f9a236 none repeat scroll 0 0;
    }
    .list-gift-detail-booking-table-manage .remove-frnd > a {
        background: #a8adcd none repeat scroll 0 0;
    }
    .list-gift-detail-booking-table-manage .owl-prev::before, .list-gift-detail-booking-table-manage .owl-next::before {
        background: #fff;
        border-radius: 50%;
        color: #fa6342;
        content: "\f0d9";
        display: inline-block;
        font-family: fontawesome;
        font-size: 18px;
        left: -15px;
        line-height: 30px;
        position: absolute;
        text-align: center;
        top: 50%;
        transform: translateY(-50%);
        width: 30px;
        box-shadow: 0 3px 7px rgb(0 0 0 / 50%);
        transition: all 0.2s linear 0s;
    }

    .list-gift-detail-booking-table-manage .owl-next::before {
        content: "\f0da";
        left: auto;
        right: -15px;
    }

    .list-gift-detail-booking-table-manage .owl-prev,.list-gift-detail-booking-table-manage .owl-next {
        left: 0;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: transparent!important;
        background: transparent!important;
    }

    .list-gift-detail-booking-table-manage .owl-prev:hover, .list-gift-detail-booking-table-manage .owl-next:hover{
        background: transparent!important;
    }

    .list-gift-detail-booking-table-manage .owl-next {
        left: auto;
        right: 0;
    }

    .list-gift-detail-booking-table-manage .owl-prev:hover:before, .list-gift-detail-booking-table-manage .owl-next:hover:before{
        background: #fa6342;
        color: #fff;
    }

    .list-gift-detail-booking-table-manage .item-gift-detail-booking-table-manage {
        border: 1px solid #c2c2c2;
        border-radius: 0;
    }

    .list-gift-detail-booking-table-manage .item-gift-active {
        border: 1px solid #f9a236;
        overflow: hidden;
        border-radius: 5px;
    }
    .gift-img-container {
        width: 100%;
        position: relative;
    }
    .gift-img-container:after {
        content: "";
        display: block;
        padding-bottom: 100%;
    }
    .gift-img-container img {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    #total-gift-detail{
        font-size: 14px!important;
    }
</style>

<div class="modal fade" id="modal-detail-booking-table-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.booking-table-manage.detail.title')</h4>
                <div class="d-flex align-items-center">
                    <h5 id="status-detail-booking-table-manage" class="py-2 reset-html"></h5>
                    <button type="button" class="close ml-4" onclick="closeModalDetailBookingTableManage()" onkeypress="closeModalDetailBookingTableManage()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body background-body-color text-left py-0" id="loading-detail-booking-table-manage">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill px-0">
                        <div class="card card-block w-100">
                            <div class="row align-items-center">
                                @if(SESSION::get(SESSION_KEY_LEVEL) > 3)
                                    <div class="col-lg-11 p-0">
                                        <h5 class="text-bold sub-title">@lang('app.booking-table-manage.detail.title-left')</h5>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="group-icon-gift">
                                            <div id="icon-gift-detail">
                                                <img src="/images/tms/gift.gif" alt="hình lỗi" data-toggle="tooltip" data-placement="top"
                                                     data-original-title="Xem quà tặng" >
                                                <label id="total-gift-detail-booking-table">0</label>
                                            </div>
                                            <ul class="group-gift-selected d-none" id="booking-table-detail-gift" style="min-width: 200px">

                                            </ul>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-12">
                                        <h5 class="text-bold sub-title">@lang('app.booking-table-manage.detail.title-left')</h5>
                                    </div>
                                @endif
                            </div>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-food-detail-booking-table-manage">
                                    <thead>
                                        <tr>
                                            <th>@lang('app.booking-table-manage.detail.stt')</th>
                                            <th>@lang('app.booking-table-manage.detail.name')</th>
                                            <th>@lang('app.booking-table-manage.detail.quantity')</th>
                                            <th>@lang('app.booking-table-manage.detail.price')</th>
                                            <th>@lang('app.booking-table-manage.detail.total-amount')</th>
                                            <th>@lang('app.booking-table-manage.detail.action')</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
{{--                            <h5 class="f-w-600 sub-title mx-0">@lang('app.booking-table-manage.update.applicable-gift') : <span id="total-gift-detail"></span></h5>--}}
{{--                            <div class="list-gift-detail-booking-table-manage owl-one owl-carousel owl-theme pt-3" id="list-gift-detail-booking-table-manage">--}}
{{--                            </div>--}}
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill pl-0">
                        <div class="card card-block flex-sub mx-0" id="boxlist-detail-booking-table-manage">
                            <h5 class="f-w-600 sub-title">@lang('app.booking-table-manage.detail.title-right')</h5>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.detail.customer-name')</label>
                                    <div>
                                        <label class="f-w-400 text-muted col-form-label-fz-15" id="customer-name-detail-booking-table-manage"></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.detail.customer-phone')</label>
                                    <div>
                                        <label class="f-w-400 text-muted col-form-label-fz-15" id="customer-phone-detail-booking-table-manage"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600  col-form-label">@lang('app.booking-table-manage.detail.branch')</label>
                                    <div >
                                        <label class="f-w-400 text-muted col-form-label-fz-15" id="branch-detail-booking-table-manage"></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.detail.type')</label>
                                    <div>
                                        <label class="f-w-400 text-muted col-form-label-fz-15" id="type-detail-booking-table-manage"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.detail.order')</label>
                                    <div>
                                         <label class="f-w-400 text-muted col-form-label-fz-15" id="order-detail-booking-table-manage"></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.detail.employee')</label>
                                    <div>
                                         <label class="f-w-400 text-muted col-form-label-fz-15" id="employee-detail-booking-table-manage"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.detail.create')</label>
                                    <div>
                                        <label class="f-w-400 text-muted col-form-label-fz-15" id="create-detail-booking-table-manage"></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.detail.booking')</label>
                                    <div>
                                        <label class="f-w-400 text-muted col-form-label-fz-15" id="booking-detail-booking-table-manage"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.detail.area')</label>
                                    <div>
                                        <label class="f-w-400 text-muted col-form-label-fz-15" id="area-detail-booking-table-manage"></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.detail.table')</label>
                                    <div>
                                        <label class="f-w-400 text-muted col-form-label-fz-15" id="table-detail-booking-table-manage"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.detail.number')</label>
                                    <div>
                                        <label class="f-w-400 text-muted col-form-label-fz-15" id="number-detail-booking-table-manage"></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">Thẻ tag</label>
                                    <div>
                                        <label class="f-w-400 text-muted col-form-label-fz-15" id="tag-detail-booking-table-manage"></label>
                                    </div>
                                </div>
                            </div>
                            <h5 class="f-w-600 sub-title">@lang('app.booking-table-manage.detail.price-title')</h5>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.detail.deposit-amount')</label>
                                    <div>
                                        <label class="f-w-400 text-muted col-form-label-fz-15" id="deposit-amount-detail-booking-table-manage"></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.detail.receive-deposit-time')</label>
                                    <div>
                                        <label class="f-w-400 text-muted col-form-label-fz-15" id="receive-deposit-time-detail-booking-table-manage"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.detail.return-deposit-amount')</label>
                                    <div>
                                        <label class="f-w-400 text-muted col-form-label-fz-15" id="return-deposit-amount-detail-booking-table-manage"></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.detail.return-deposit-time')</label>
                                    <div>
                                        <label class="f-w-400 text-muted col-form-label-fz-15" id="return-deposit-time-detail-booking-table-manage"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row d-none mt-3" id="div-cancel-reason-detail-booking-table-manage">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.detail.cancel-reason')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="cancel-reason-detail-booking-table-manage"></h6>
                                </div>
                            </div>
                            <div class="row border-dashed">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.detail.note')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="note-detail-booking-table-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.detail.orther-requirements')</label>
                                    <h6 class="f-w-400 text-muted col-form-label-fz-15" id="other-requirements-detail-booking-table-manage"></h6>
                                </div>
                            </div>
                            <div class="form-group row pt-3">
                                <label class="w-100 pl-3">
                                    <span class="m-b-10 pr-2 f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.detail.total-final')</span>
                                    <label class="text-muted f-w-400 col-form-label-fz-15" id="total-final-detail-booking-table-manage"></label>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="/js/manage/booking_table/detail.js?version=2"></script>
@endpush
