<style>
    .data-search-bank-number-bank-manage{
        width: calc(100% - 30px);
        position: absolute;
        background-color: #ffffff;
        z-index: 999;
        border-radius: 10px;
        max-height: 200px;
        overflow-y: auto;
        display: block;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        outline: none;
    }

    #btn-bank-number-create-bank-search {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        padding: 5px 10px;
        border: none;
        background: transparent;
        cursor: pointer;
        border-left: 1px solid #ccc;
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
</style>
<div class="modal fade" id="modal-create-bank-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.bank-data.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateBankData()" onkeypress="closeModalCreateBankData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-create-bank-data">
                <div class="card-block card m-0">
                    <div class="form-group select2_theme validate-group">
                        <div class="form-validate-select">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 pr-0 select-material-box">
                                    <select data-icon="icofont icofont-options" data-select="1"
                                            class="js-example-basic-single select2-hidden-accessible"
                                            id="bank-create-bank-data">
                                        <option value="-1" disabled selected
                                                hidden>@lang('app.component.option_default')</option>
                                    </select>
                                    <label class="icon-validate">
                                        @lang('app.bank-data.create.bank')
                                        @include('layouts.start')
                                    </label>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left ">
                            <input id="bank-number-create-bank-manage" class="form-control" type="text" data-empty="1" data-number="1" data-min-length="6" data-max-length="18" autocomplete="off">
                            <label for="bank-number-create-bank-manage">
                                @lang('app.bank-data.create.bank_number')
                                @include('layouts.start')
                            </label>
                            <button id="btn-bank-number-create-bank-search" class="disabled" disabled ><i class="fi-rr-search" style="font-size: 16px !important;"></i></button>
                        </div>
                    </div>
                    <div class="link-href">
                        <ul class="data-search-bank-number-bank-manage d-none"
                            id="data-search-bank-number-bank-manage"></ul>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="account-name-create-bank-table-setting"
                                   class="form-control" type="text" data-empty="1" data-min-length="2"
                                   data-spec="1" data-max-length="50" style="line-height: 20px">
                            <label for="account-name-create-bank-table-setting">
                                @lang('app.bank-data.create.bank_account')
                                @include('layouts.start')
                            </label>
                        </div>
                    </div>
                    <div class="form-validate-checkbox mt-2">
                        <div class="checkbox-form-group">
                            <input id="is-default-create-bank-data" name="is-default-create-bank-data disabled" type="checkbox">
                            <label class="name-checkbox" for="is_default-create-bank-data">@lang('app.bank-data.create.is_default_text')<div class="tool-tip">
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none" onclick="reloadModalCreateCategoryFoodData()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreateBankData()"
                     onkeypress="saveModalCreateBankData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.title-button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\setting\bank\create.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
