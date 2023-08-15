<style>
    .search-customer-booking-table-manage,
    .search-tag-booking-table-manage{
        width: calc(100% - 30px);
        position: absolute;
        background-color: #ffffff;
        z-index: 999;
        border-radius: 10px;
        max-height: 200px;
        overflow-y: auto;
        display: block;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    .item-search-customer {
        display: inline-block;
        padding: 5px 10px;
        position: relative;
        width: 100%;
        cursor: default;
    }

    .item-search-customer:hover {
        background-color: var(--gray-200-color);
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
        color: #696A6C;
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

    .list-gift-create-booking-table-manage {
        overflow-x: visible;
        display: inherit;
    }

    .list-gift-create-booking-table-manage .owl-nav {
        display: block;
    }

    .list-gift-create-booking-table-manage .owl-dots {
        display: none;
    }

    .list-gift-create-booking-table-manage .item {
        background: #f2f7fb none repeat scroll 0 0;
        border: 1px solid #ede9e9;
        border-radius: 3px;
        padding-bottom: 7px;
    }

    .list-gift-create-booking-table-manage .sugtd-frnd-meta{
        display: inline-block;
        margin-top: 10px;
        text-align: center;
        width: 100%;
    }

    .list-gift-create-booking-table-manage .sugtd-frnd-meta > a {
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
    .list-gift-create-booking-table-manage .sugtd-frnd-meta > span {
        display: inline-block;
        font-size: 11px;
        width: 100%;
    }

    .list-gift-create-booking-table-manage .add-remove-frnd {
        display: flex;
        justify-content: center;
        gap: 10px;
        list-style: outside none none;
        margin-top: 4px;
        padding: 0 14px;
        text-align: center;
        width: 100%;
    }
    .list-gift-create-booking-table-manage .add-remove-frnd > li {
        display: inline-block;
    }
    .list-gift-create-booking-table-manage .add-remove-frnd > li a {
        border-radius: 4px;
        color: #fff;
        display: inline-block;
        padding: 2px 5px;
        transition: all 0.2s linear 0s;
        font-size: 13px;
    }
    .list-gift-create-booking-table-manage .add-remove-frnd > li a:hover{
        background: #fa6342;
    }
    .list-gift-create-booking-table-manage .add-remove-frnd > li a > i {
        font-size: 13px;
    }
    .list-gift-create-booking-table-manage .add-remove-frnd > li:last-child {
        margin-right: 0;
    }
    .list-gift-create-booking-table-manage .add-tofrndlist > a{
        background: #0085b1 none repeat scroll 0 0;
    }

    .list-gift-create-booking-table-manage .delete-tofrndlist > a{
        background: #f9a236 none repeat scroll 0 0;
    }
    .list-gift-create-booking-table-manage .remove-frnd > a {
        background: #a8adcd none repeat scroll 0 0;
    }
    .list-gift-create-booking-table-manage .owl-prev::before, .list-gift-create-booking-table-manage .owl-next::before {
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

    .list-gift-create-booking-table-manage .owl-next::before {
        content: "\f0da";
        left: auto;
        right: -15px;
    }

    .list-gift-create-booking-table-manage .owl-prev,.list-gift-create-booking-table-manage .owl-next {
        left: 0;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: transparent!important;
        background: transparent!important;
    }

    .list-gift-create-booking-table-manage .owl-prev:hover, .list-gift-create-booking-table-manage .owl-next:hover{
        background: transparent!important;
    }

    .list-gift-create-booking-table-manage .owl-next {
        left: auto;
        right: 0;
    }

    .list-gift-create-booking-table-manage .owl-prev:hover:before, .list-gift-create-booking-table-manage .owl-next:hover:before{
        background: #fa6342;
        color: #fff;
    }

    .list-gift-create-booking-table-manage .item-gift-create-booking-table-manage {
        border-bottom: 1px solid #c2c2c2;
        border-radius: 0;
    }

    .list-gift-create-booking-table-manage .item-gift-active {
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
    #total-gift{
        font-size: 14px!important;
    }


    .group-icon-gift{
        width: 40px;
        height: 40px;
    }

    .group-icon-gift {
        position: relative;
    }

    .group-icon-gift #icon-gift img,
    .group-icon-gift #icon-gift-update img,
    .group-icon-gift #icon-gift-detail img
    {
        width : 100%;
    }
    .group-icon-gift #icon-gift > label,
    .group-icon-gift #icon-gift-update > label,
    .group-icon-gift #icon-gift-detail > label
    {
        background-color: #fe5d70 !important;
        color: #fff;
        position: absolute;
        padding: 1px 6px;
        border-radius: 50%;
        right: -14px;
        top: -10px;
    }

    .group-gift-selected {
        min-width: 265px;
        background: #fff;
        z-index: 999999999999 !important;
        position: absolute;
        right: -12px;
        top: 45px;
        border-radius: 8px;
        box-shadow: 0 0 6px rgb(0 0 0 / 30%);
        min-height: 200px;
        max-height: 266px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .group-gift-selected::-webkit-scrollbar{
        width: 4px;
        background-color: #F5F5F5;
    }

    .group-gift-selected::-webkit-scrollbar-thumb{
        background-color: #6c757d;
    }

    .group-gift-selected #data-gift-empty-booking-table{
        text-align: center;
        margin-top: 25px
    }

    .group-gift-selected li:first-child{
        padding-top: 12px;
    }

    .group-gift-selected li{
        padding: 6px 12px;
        margin-bottom: 1px;
    }

    .group-gift-selected li:hover{
        background: #ecf1f5;
        cursor: pointer;
    }

    #booking-table-detail-gift li:last-child > div{
        border-bottom: none;
        padding-bottom: 0;
    }


    .group-gift-selected li:last-child .row-wrap{
        border-bottom: none;
    }

    .group-gift-selected .row-gift{
        display: flex;
        padding: 10px;
        align-items: center;
        position: relative;
    }

    .group-gift-selected .avatar-gift{
        position: relative;
    }

    .group-gift-selected .avatar-gift > img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .group-gift-selected .avatar-about {
        padding-left: 10px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    .img-inline-name-data-table {
        width: 40px;
        height: 40px;
        border: 1px solid #e3e3e3;
        background-color: #f2f2f2;
        border-radius: 100%;
        object-fit: cover;
    }
    .group-gift-selected .name-inline-data-table {
        vertical-align: middle;
        font-weight: 600;
        max-width: 130px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .search-gift-booking-table-wrapper{
        display: flex;
        justify-content: center;
        margin: 8px 0
    }
    .search-gift-booking-table-wrapper input{
        width: 90%;
        padding: 4px 8px;
        border: 1px solid #dedede;
        border-radius: 12px;
    }
    .table-responsive .select-filter-dataTable{
        margin-top: -8px !important;
    }

</style>
<div class="modal fade" id="modal-create-booking-table-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.booking-table-manage.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateBookingTableManage()" onkeypress="closeModalCreateBookingTableManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left py-0" id="loading-modal-create-booking-table-manage">
                <div class="row d-flex">
                    <div class="col-lg-6 edit-flex-auto-fill px-0">
                        <div class="card card-block w-100">
                            @if(session::get(SESSION_KEY_LEVEL) > 3)

                                <div class="row align-items-center">
                                    <div class="col-lg-11 p-0">
                                        <h5 class="f-w-600 sub-title mx-0 col-form-label-fz-15">@lang('app.booking-table-manage.create.title-left')</h5>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="group-icon-gift">
                                            <div id="icon-gift">
                                                <img src="/images/tms/gift.gif" alt="hình lỗi" data-toggle="tooltip" data-placement="top"
                                                     data-original-title="Chọn quà tặng" >
                                                <label id="total-gift-create-booking-table">0</label>
                                            </div>
                                            <ul class="group-gift-selected  d-none" id="booking-table-create-gift">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row align-items-center">
                                    <div class="col-lg-12 p-0">
                                        <h5 class="f-w-600 sub-title mx-0 col-form-label-fz-15">@lang('app.booking-table-manage.create.title-left')</h5>
                                    </div>
                                </div>
                            @endif

                            <div class="table-responsive new-table m-t-10">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box" style="width: 100px !important;">
                                            <select class="js-example-basic-single select2-hidden-accessible"
                                                    id="select-category-create-booking-table-manage" >
                                                <option value="-1"
                                                        selected>@lang('app.booking-table-manage.create.type')</option>
                                                <option
                                                    value="6">@lang('app.booking-table-manage.create.combo')</option>
                                                <option
                                                    value="1">@lang('app.booking-table-manage.create.food')</option>
                                                <option
                                                    value="2">@lang('app.booking-table-manage.create.drink')</option>
                                                <option
                                                    value="3">@lang('app.booking-table-manage.create.other')</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select2-hidden-accessible"
                                                    id="select-food-create-booking-table-manage">
                                                <option disabled selected
                                                        hidden>@lang('app.booking-table-manage.create.select-food')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table class="table" id="table-food-create-booking-table-manage">
                                    <thead>
                                    <tr>
                                        <th class="text-left">@lang('app.booking-table-manage.create.name')</th>
                                        <th class="text-center">@lang('app.booking-table-manage.create.quantity')</th>
                                        <th class="text-right">@lang('app.booking-table-manage.create.price')</th>
                                        <th class="text-right">@lang('app.booking-table-manage.create.total-amount')</th>
                                        <th class="text-center"></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 edit-flex-auto-fill pl-0">
                        <div class="card card-block flex-sub mx-0" id="boxlist-create-booking-table-manage">
                            <h5 class="f-w-600 sub-title mx-0 col-form-label-fz-15">@lang('app.booking-table-manage.create.title-right')</h5>
                            <div class="row m-b-10 validate-group border-dashed">
                                <div class="col-sm-6">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.create.branch')</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                        id="select-branch-create-booking-table-manage"></h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.create.type')</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15">@lang('app.booking-table-manage.create.type-marketer')</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 form-group validate-group pl-0">
                                    <div class="form-validate-input">
                                        <input type="text" id="date-create-booking-table-manage"
                                               class="input-sm form-control text-center input-datetimepicker p-1"
                                               value="{{date('d/m/Y')}}">
                                        <label for="date-create-booking-table-manage">
                                            @lang('app.booking-table-manage.create.time')
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6 form-group validate-group pr-0">
                                    <div class="form-validate-input">
                                        <input type="text" id="hour-create-booking-table-manage"
                                               class="input-sm form-control text-center input-datetimepicker p-1"
                                               data-booking-before-open-order="{{ Session::get(SESSION_KEY_SETTING_RESTAURANT)['number_minute_allow_booking_before_open_order']}}"
                                               value="{{ date("H:i", strtotime('+1 minute', time() + (Session::get(SESSION_KEY_SETTING_RESTAURANT)['number_minute_allow_booking_before_open_order'] * 60))) }}">
                                        <label for="hour-create-booking-table-manage">
                                            @lang('app.booking-table-manage.create.hour')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 form-group validate-group pr-0 pl-0" style="margin-bottom: 0px !important;">
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input form-left">
                                            <input id="customer-phone-create-booking-table-manage" class="form-control" type="text" data-empty="1" data-phone="1" autocomplete="off">
                                            <label for="customer-phone-create-booking-table-manage">
                                                @lang('app.booking-table-manage.create.customer-phone')
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                    </div>
                                    <div class="link-href">
                                        <ul class="search-customer-booking-table-manage d-none"
                                            id="data-search-customer-booking-table-manage"></ul>
                                    </div>
                                </div>
                                <div class="col-lg-4 form-group validate-group pr-0" style="margin-bottom: 0px !important;">
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input form-left">
                                            <input id="full-name-create-customer-booking-table-manage"
                                                   class="form-control" type="text" data-empty="1" data-min-length="1"
                                                   data-spec="1" data-max-length="50" style="line-height: 20px">
                                            <label for="full-name-create-customer-booking-table-manage">
                                                Họ và tên
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 form-group validate-group pr-0" style="margin-bottom: 0px !important;">
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input form-left">
                                            <input id="number-create-booking-table-manage" class="form-control" data-type="currency-edit"
                                                   value="1" data-number="1" data-min="1" data-max="999">
                                            <label for="number-create-booking-table-manage">
                                                @lang('app.booking-table-manage.number-people')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(Session::get(SESSION_KEY_LEVEL) > 3)
                                <div class="form-group validate-group">
                                    <div class="form-validate-select">
                                        <div class="col-lg-12 select-material-box pt-0">
                                            <select id="hashtag-create-customer-booking-table-manage" multiple
                                                    class="js-example-basic-single select2-hidden-accessible">
                                            </select>
                                            <label class="icon-validate pt-2">
                                                Thẻ tag
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-6 form-group validate-group pl-0">
                                    <div class="form-validate-input">
                                        <input id="deposit-amount-create-table-manage" data-type="currency-edit"
                                               class="form-control text-right" value="0" data-money-allow="0" data-money-min="100" data-max="500000000">
                                        <label for="deposit-amount-create-table-manage">
                                            @lang('app.booking-table-manage.create.deposit-amount')
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group select2_theme validate-group pr-0">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="deposit-amount-payment-method-create-booking-table-manage"
                                                        class="js-example-basic-single col-sm- select2-hidden-accessible">
                                                    <option
                                                        value="1">@lang('app.booking-table-manage.create.opt-cash')</option>
                                                </select>
                                                <label>
                                                   @lang('app.booking-table-manage.create.deposit-amount-type')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group">
                                        <textarea class="form__field" id="note-create-booking-table-manage" cols="5" rows="3" data-note-max-length="255"></textarea>
                                        <label for="note-create-booking-table-manage" class="form__label icon-validate">
                                            @lang('app.booking-table-manage.create.note')
                                        </label>
                                        <div class="textarea-character">
                                            <span>0/300</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group">
                                        <textarea class="form__field" id="other-requirements-create-booking-table-manage" cols="5" rows="3" data-note-max-length="255"></textarea>
                                        <label for="other-requirements-create-booking-table-manage" class="form__label icon-validate">
                                            @lang('app.booking-table-manage.create.orther-requirements')
                                        </label>
                                        <div class="textarea-character">
                                            <span>0/300</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="w-100">
                                    <span
                                        class="m-b-10 pr-2 f-w-600 col-form-label-fz-15">@lang('app.booking-table-manage.update.total-final')</span>
                                    <label id="total-create-booking-table-manage"
                                           class="text-muted f-w-400 col-form-label-fz-15">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none" onclick="reloadModalCreateBookingTable()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalCreateBookingTableManage()" onkeypress="saveModalCreateBookingTableManage()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.title-button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
<select id="select-all-create-booking" class="d-none"></select>
<select id="select-food-create-booking" class="d-none"></select>
<select id="select-drink-create-booking" class="d-none"></select>
<select id="select-other-create-booking" class="d-none"></select>
<select id="select-combo-create-booking" class="d-none"></select>

@include('manage.booking_table.customer')

@push('scripts')
    <script type="text/javascript" src="/js/manage/booking_table/create.js?version=2"></script>
@endpush
