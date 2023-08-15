<style>
    #index-layout-beer-store-campaign thead tr th input {
        z-index: 0 !important;
    }

    #policy-beer-campaign-btn {
        color: #E96012 !important;
    }

    #box-list-campaign-beer-store #policy-beer-campaign-btn:hover {
        color: #fff !important;
    }
</style>
<div id="index-layout-beer-store-campaign">
    <div class="page-wrapper item-campaign d-none" id="div-layout-store-campaign-campaign">
        <div class="page-body">
            <div class="card card-block" id="box-list-campaign-beer-store">
                <div class="col-lg-12 row justify-content-between align-items-center mb-2 pr-0">
                    <div class="nav-tabs">
                        <button type="button" class="btn btn-inverse font-weight-bold mr-2" style="height: 33px"
                                onclick="backLayoutCampaign()">
                            <i class="fa fa-chevron-left"></i> Quay lại
                        </button>
                    </div>
                    <div class="mr-1">
                        <button class="btn seemt-red seemt-bg-red seemt-btn-hover-red seemt-fz-14 d-none"
                                id="btn-change-status-disable" onclick="ChangeStatusRunningBeerStore()"
                                style="padding: 8px 10px 8px 10px !important; border-radius: 6px;">Tắt chương trình
                        </button>
                        <button class="btn seemt-green seemt-bg-green seemt-btn-hover-green seemt-fz-14 d-none"
                                id="btn-change-status-enable" onclick="ChangeStatusRunningBeerStore()"
                                style="padding: 8px 10px 8px 10px !important; border-radius: 6px;">Bật chương trình
                        </button>
                    </div>
                </div>

                <div class="table-responsive new-table">
                    <div class="select-filter-dataTable">
                        @include('marketing.brand')
{{--                        <div class="time-filer-dataTale" data-toggle="tooltip" data-placement="top"--}}
{{--                             data-original-title="Ngày Reset" trigger="hover">--}}
{{--                            <div class="seemt-group-date">--}}
{{--                                <i class="fi-rr-calendar"></i>--}}
{{--                                <input type="text" id="from-date-beer-stort-campaign"--}}
{{--                                       class="input-sm form-control text-left input-datetimepicker"--}}
{{--                                       value="{{ date('d/m') }}" autocomplete="off">--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                    <table class="table" id="table-beer-store-campaign">
                        <thead>
                        <tr>
                            <th rowspan="2" class="text-center"></th>
                            <th>Giá trị bill tối thiểu</th>
                            <th>Giá trị bill tối thiểu</th>
                            <th>Giá trị bill tối thiểu</th>
                            <th>Giá trị bill tối thiểu</th>
                            <th>Giá trị bill tối thiểu</th>
                            <th>Giá trị bill tối thiểu</th>
                            <th>Giá trị bill tối thiểu</th>
                            <th rowspan="2"></th>
                        </tr>
                        <tr id="min-bill-value">
                            <th>
                                <div class="form-group m-0 ml-2">
                                    <div class="input-group border-group">
                                        <input id="first-amount-beer-store" class="form-control text-center border-0"
                                               value="0"
                                               data-type="currency-edit" placeholder="Số tiền"
                                               style="padding: 8px 10px 5px 15px !important; width:100%!important;"
                                               autocomplete="off"
                                               data-max="999999999">
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                            </th>
                            <th>
                                <div class="form-group m-0 ml-2">
                                    <div class="input-group border-group">
                                        <input id="second-amount-beer-store" class="form-control text-center border-0"
                                               value="0"
                                               data-type="currency-edit" placeholder="Số tiền"
                                               style="padding: 8px 10px 5px 15px !important; width:100%!important;"
                                               autocomplete="off"
                                               data-max="999999999">
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                            </th>
                            <th>
                                <div class="form-group m-0 ml-2">
                                    <div class="input-group border-group">
                                        <input id="third-amount-beer-store" class="form-control text-center border-0"
                                               value="0"
                                               data-type="currency-edit" placeholder="Số tiền"
                                               style="padding: 8px 10px 5px 15px !important; width:100%!important;"
                                               autocomplete="off"
                                               data-max="999999999">
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                            </th>
                            <th>
                                <div class="form-group m-0 ml-2">
                                    <div class="input-group border-group">
                                        <input id="fourth-amount-beer-store" class="form-control text-center border-0"
                                               value="0"
                                               data-type="currency-edit" placeholder="Số tiền"
                                               style="padding: 8px 10px 5px 15px !important; width:100%!important;"
                                               autocomplete="off"
                                               data-max="999999999">
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                            </th>
                            <th>
                                <div class="form-group m-0 ml-2">
                                    <div class="input-group border-group">
                                        <input id="fifth-amount-beer-store" class="form-control text-center border-0"
                                               value="0"
                                               data-type="currency-edit"
                                               style="padding: 8px 10px 5px 15px !important; width:100%!important;"
                                               autocomplete="off"
                                               data-max="999999999">
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                            </th>
                            <th>
                                <div class="form-group m-0 ml-2">
                                    <div class="input-group border-group">
                                        <input id="six-amount-beer-store" class="form-control text-center border-0"
                                               value="0"
                                               data-type="currency-edit"
                                               style="padding: 8px 10px 5px 15px !important; width:100%!important;"
                                               autocomplete="off"
                                               data-max="999999999">
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                            </th>
                            <th>
                                <div class="form-group m-0 ml-2">
                                    <div class="input-group border-group">
                                        <input id="seven-amount-beer-store" class="form-control text-center border-0"
                                               value="0"
                                               data-type="currency-edit"
                                               style="padding: 8px 10px 5px 15px !important; width:100%!important;"
                                               autocomplete="off"
                                               data-max="999999999">
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center">Thời gian</th>
                            <th class="text-center">Số bia được sử dụng</th>
                            <th class="text-center">Số bia được sử dụng</th>
                            <th class="text-center">Số bia được sử dụng</th>
                            <th class="text-center">Số bia được sử dụng</th>
                            <th class="text-center">Số bia được sử dụng</th>
                            <th class="text-center">Số bia được sử dụng</th>
                            <th class="text-center">Số bia được sử dụng</th>
                            <th>Áp dụng</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            {{--            <div class="card-block" id="body-beer-store-disabled">--}}
            {{--                <div class="col-lg-12">--}}
            {{--                    <button type="button" class="come-back-btn pointer font-weight-bold"--}}
            {{--                            data-toggle="tooltip" data-placement="right"--}}
            {{--                            onclick="backLayoutCampaign()"--}}
            {{--                            data-original-title="Quay lại"><i--}}
            {{--                            class="fa fa-chevron-left"></i>--}}
            {{--                    </button>--}}
            {{--                </div>--}}
            {{--                <div class="row justify-content-center" style="margin-top: 5%">--}}
            {{--                    <div class="col-lg-12 text-center">--}}
            {{--                        <h2 class="mt-3">CHƯƠNG TRÌNH TẶNG BIA KHÔNG HOẠT ĐỘNG</h2>--}}
            {{--                        <p class="mb-5" style="font-size: 16px !important;"><button onclick="ChangeStatusRunningBeerStore()" class="btn btn-primary">MỞ CHƯƠNG TRÌNH</button></p>--}}
            {{--                        <img src="/images/tms/beer.png" alt="" height="300" width="500" style="object-fit:cover" />--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
    </div>
</div>
@include('marketing.campaign.beer_store.policy')
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/marketing/campaign/beer_store/index.js?version=6',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript" src="{{ asset('js/marketing/campaign/beer_store/update.js?version=4',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
