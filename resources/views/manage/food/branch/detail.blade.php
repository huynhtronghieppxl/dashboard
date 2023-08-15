<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal-detail-food-branch-manage">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" id="content-modal">
            <div id="detail">
                <div class="modal-header">
                    <h4 class="modal-title py-2">@lang('app.food-branch-manage.detail.title')</h4>
                    <div class="d-flex align-items-center">
                        <h5 class="m-0" id="status-detail-food-branch-manage"></h5>
                        <button type="button" class="close ml-4" onclick="closeModalDetailFoodManage()" onkeypress="closeModalDetailFoodManage()">
                            <i class="fi-rr-cross"></i>
                        </button>
                    </div>
                </div>
                <div class="modal-body background-body-color text-left" id="loading-modal-detail-food-branch-manage">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-10">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-4 d-flex">
                                    <div class="card card-block flex-sub">
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-4 col-lg-4 col-form-label">@lang('app.food-branch-manage.detail.branch')</label>
                                            <div class="col-sm-12 col-md-8 col-lg-8">
                                                <span id="branch-detail-food-branch-manage"
                                                      class="float-right reset-text"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-4 col-lg-4 col-form-label ">@lang('app.food-branch-manage.detail.name')</label>
                                            <div class="col-sm-12 col-md-8 col-lg-8">
                                                <label id="name-detail-food-branch-manage"
                                                       class="float-right reset-text"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-4 col-lg-4 col-form-label">@lang('app.food-branch-manage.detail.code')</label>
                                            <div class="col-sm-12 col-md-8 col-lg-8">
                                                <label id="code-detail-food-branch-manage"
                                                       class="float-right reset-text"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-4 col-lg-4 col-form-label">@lang('app.food-branch-manage.detail.category')</label>
                                            <div class="col-sm-12 col-md-8 col-lg-8">
                                                <label id="category-detail-food-branch-manage"
                                                       class="float-right reset-text"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-4 col-lg-4 col-form-label">@lang('app.food-branch-manage.detail.bbq')</label>
                                            <div class="col-sm-12 col-md-8 col-lg-8">
                                                <label id="bbq-detail-food-branch-manage"
                                                       class="float-right reset-text"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Select form -->
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4 d-flex">
                                    <div class="card card-block flex-sub">
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-4 col-lg-4 col-form-label">@lang('app.food-branch-manage.detail.point')</label>
                                            <div class="col-sm-12 col-md-8 col-lg-8">
                                                <label id="point-detail-food-branch-manage"
                                                       class="float-right reset-text"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-4 col-lg-4 col-form-label">@lang('app.food-branch-manage.detail.sell-by')</label>
                                            <div class="col-sm-12 col-md-8 col-lg-8">
                                                <label id="sell-by-detail-food-branch-manage"
                                                       class="float-right reset-text"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-4 col-lg-4 col-form-label">@lang('app.food-branch-manage.detail.print-order')</label>
                                            <div class="col-sm-12 col-md-8 col-lg-8">
                                                <label id="print-detail-food-branch-manage"
                                                       class="float-right reset-text"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-4 col-lg-4 col-form-label">@lang('app.food-branch-manage.detail.time-complete')</label>
                                            <div class="col-sm-12 col-md-8 col-lg-8">
                                                <label id="time-detail-food-branch-manage"
                                                       class="float-right reset-text"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-4 col-lg-4 col-form-label">@lang('app.food-branch-manage.detail.unit')</label>
                                            <div class="col-sm-12 col-md-8 col-lg-8">
                                                <label id="unit-detail-food-branch-manage"
                                                       class="float-right reset-text"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-4 col-lg-4 col-form-label">@lang('app.food-branch-manage.detail.type-food')</label>
                                            <div class="col-sm-12 col-md-8 col-lg-8">
                                                <label id="type-food-detail-food-branch-manage"
                                                       class="float-right reset-text"></label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4 d-flex">
                                    <div class="card card-block flex-sub ">
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-4 col-lg-4 col-form-label">@lang('app.food-branch-manage.detail.review')</label>
                                            <div class="col-sm-12 col-md-8 col-lg-8">
                                                <label id="review-detail-food-branch-manage"
                                                       class="float-right reset-text"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-4 col-lg-4 col-form-label">@lang('app.food-branch-manage.detail.take-away')</label>
                                            <div class="col-sm-12 col-md-8 col-lg-8">
                                                <label id="take-away-detail-food-branch-manage"
                                                       class="float-right reset-text"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-4 col-lg-4 col-form-label">@lang('app.food-branch-manage.detail.allow-point-purchase')</label>
                                            <div class="col-sm-12 col-md-8 col-lg-8">
                                                <label id="allow-point-detail-food-branch-manage"
                                                       class="float-right reset-text"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-4 col-lg-4 col-form-label">@lang('app.food-branch-manage.detail.price')</label>
                                            <div class="col-sm-12 col-md-8 col-lg-8">
                                                <label id="price-detail-food-branch-manage"
                                                       class="float-right reset-text"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-4 col-lg-4 col-form-label">@lang('app.food-branch-manage.detail.point-to-purchase')</label>
                                            <div class="col-sm-12 col-md-8 col-lg-8">
                                                <label id="point-to-purchase-detail-food-branch-manage"
                                                       class="float-right reset-text"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-4 col-lg-4 col-form-label">@lang('app.food-branch-manage.detail.description')</label>
                                            <div class="col-sm-12 col-md-8 col-lg-8">
                                                <label id="descript-detail-food-branch-manage"
                                                       class="float-right reset-text"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-2">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-block">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                                    <label>
                                                        @lang('app.food-branch-manage.detail.avatar')
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                                    <img id="avatar-detail-food-branch-manage" src="" class="img-data-detail" style="object-fit:cover;"/>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-none" id="addition-foods-detail-food-branch-manage">
                        <div class="card card-block form-group row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h5 class="sub-title">@lang('app.food-branch-manage.detail.list-addition')</h5>
                                <table class="table" id="table-addition-detail-food-branch-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.food-branch-manage.detail.stt')</th>
                                        <th>@lang('app.food-branch-manage.detail.table-name')</th>
                                        <th>@lang('app.food-branch-manage.detail.table-action')</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-none" id="foods-in-combo-detail-food-branch-manage">
                        <div class="card card-block form-group row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h5 class="sub-title">@lang('app.food-branch-manage.detail.list-food-combo')</h5>
                                <table class="table" id="table-foods-in-combo-detail-food-branch-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.food-branch-manage.detail.stt')</th>
                                        <th>@lang('app.food-branch-manage.detail.table-name')</th>
                                        <th>@lang('app.food-branch-manage.detail.table-quantity')</th>
                                        <th>@lang('app.food-branch-manage.detail.table-action')</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/food/branch/detail.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
