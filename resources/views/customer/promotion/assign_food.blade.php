<div class="modal fade" id="modal-assign-food-happy-time-promotion" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.happy-time-promotion.assign-food.title')</h4>
            </div>
            <div class="modal-body " id="loading-modal-assign-food-happy-time-promotion">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill pr-1">
                        <div class="card card-block w-100">
                            <h5 class="text-bold sub-title mx-0">Danh sách món ăn</h5>
                            <div class="row">
                                <div class="col-lg-3 form-group">
                                    <select id="select-category-food-assign-food-happy-time-promotion" data-select="1"
                                            class="js-example-basic-single">
                                        <option value="-1" selected>@lang('app.component.option-all')</option>
                                        <option value="1">@lang('app.booking-table-manage.create.food')</option>
                                        <option value="2">@lang('app.booking-table-manage.create.drink')</option>
                                        <option value="4">@lang('app.booking-table-manage.create.sea-food')</option>
                                        <option value="3">@lang('app.booking-table-manage.create.other')</option>
                                    </select>
                                </div>
                                <div class="col-lg-9 form-group">
                                    <select id="select-food-assign-food-happy-time-promotion"
                                            class="js-example-basic-single"></select>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table fix-size-table" id="table-food-assign-food-happy-time-promotion">
                                    <thead>
                                    <tr>
                                        <th class="text-center w-10">@lang('app.booking-table-manage.create.avatar')</th>
                                        <th class="text-center w-40">@lang('app.booking-table-manage.create.name')</th>
                                        <th class="text-center w-15">@lang('app.booking-table-manage.create.price')</th>
                                        <th class="text-center w-10"></th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <div class="sub-title"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill pl-1">
                        <div class="card card-block flex-sub">
                            <h5 class="text-bold sub-title mx-0">@lang('app.happy-time-promotion.assign-food.promotion-infomation')</h5>
{{--                            <div class="form-group row">--}}
{{--                                <label class="col-sm-4 my-auto font-weight-bold">Chi nhánh</label>--}}
{{--                                <div class="col-sm-8">--}}
{{--                                    <select id="select-branch-assign-food" class="js-example-basic-single" data-select="1">--}}
{{--                                        @if(Session::get(SESSION_KEY_PERMISSION_TALLEST) > 1)--}}
{{--                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all() as $db)--}}
{{--                                                <option value="{{$db['id']}}">{{$db['name']}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        @else--}}
{{--                                            <option value="{{Session::get(SESSION_JAVA_ACCOUNT)['branch_id']}}"--}}
{{--                                                    selected>{{Session::get(SESSION_JAVA_ACCOUNT)['branch_name']}}</option>--}}
{{--                                        @endif--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select ">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="select-branch-assign-food" class="js-example-basic-single" multiple="" data-select="1">
                                                @if(Session::get(SESSION_KEY_PERMISSION_TALLEST) > 1)--}}
                                                    @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all() as $db)
                                                        <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                    @endforeach
                                                @else
                                                    <option value="{{Session::get(SESSION_JAVA_ACCOUNT)['branch_id']}}"
                                                            selected>{{Session::get(SESSION_JAVA_ACCOUNT)['branch_name']}}</option>
                                                @endif
                                            </select>
                                            <label>
                                                <i class="typcn typcn-document-text"></i>Chi nhánh </label>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 my-auto font-weight-bold">@lang('app.happy-time-promotion.assign-food.name')</label>
                                <div class="col-sm-8">
                                    <select id="select-promotion-assign-food" class="js-example-basic-single" data-select="1"></select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600  col-form-label">@lang('app.happy-time-promotion.assign-food.status')</label>
                                    <div class="f-w-400">
                                        <label id="status-assign-food-happy-time-promotion"></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label">@lang('app.happy-time-promotion.assign-food.employee_create')</label>
                                    <div class="f-w-400">
                                        <label id="employee-create-assign-food-happy-time-promotion"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600  col-form-label">@lang('app.happy-time-promotion.assign-food.min-order-total')</label>
                                    <div class="f-w-400">
                                        <label id="min-order-total-assign-food-happy-time-promotion"></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label">@lang('app.happy-time-promotion.assign-food.discount')</label>
                                    <div class="f-w-400">
                                        <label id="discount-assign-food-happy-time-promotion"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label">@lang('app.happy-time-promotion.assign-food.max-promotion')</label>
                                    <div class="f-w-400">
                                        <label id="max-promotion-assign-food-happy-time-promotion"></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label">@lang('app.happy-time-promotion.assign-food.from-time')</label>
                                    <div class="f-w-400">
                                        <label id="from-time-assign-food-happy-time-promotion"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600  col-form-label">@lang('app.happy-time-promotion.assign-food.to-time')</label>
                                    <div class="f-w-400">
                                        <label id="to-time-assign-food-happy-time-promotion"></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label">@lang('app.happy-time-promotion.assign-food.type')</label>
                                    <div class="f-w-400">
                                        <label id="type-assign-food-happy-time-promotion"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label">@lang('app.happy-time-promotion.assign-food.day-of-week')</label>
                                    <div class="f-w-400">
                                        <label id="day-of-week-assign-food-happy-time-promotion"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label font-weight-bold">@lang('app.happy-time-promotion.assign-food.short-description')</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="short-description-assign-food-happy-time-promotion"
                                              cols="5" rows="5" data-note="1" disabled></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label font-weight-bold">@lang('app.happy-time-promotion.assign-food.description')</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="description-assign-food-happy-time-promotion"
                                              cols="5" rows="5" data-note="1" disabled></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled" onclick="closeModalAssignFoodHappyTimePromotion()">
                    @lang('app.component.button.close')
                </button>
                <button type="button" class="btn btn-primary" onclick="saveAssignFoodHappyTimePromotion()">
                    @lang('app.component.button.save')
                </button>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script type="text/javascript" src="{{asset('js/marketing/promotion/happy_time/assign_food.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
