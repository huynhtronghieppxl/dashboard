<div class="modal fade" id="modal-detail-customer-promotion-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.happy-timepromotion.detail.title')</h4>
            </div>
            <div class="modal-body background-body-color py-1" id="loading-modal-detail-customer-promotion">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-block">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4">@lang('app.happy-timepromotion.detail.name')</label>
                                        <div class="col-lg-8">:
                                            <label id="name-detail-happy-time-promotion"></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4">@lang('app.happy-timepromotion.detail.short-description')</label>
                                        <div class="col-lg-8">:
                                            <label id="short-description-detail-happy-time-promotion"></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4">@lang('app.happy-timepromotion.detail.description')</label>
                                        <div class="col-lg-8">:
                                            <label id="description-detail-happy-time-promotion"></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4">@lang('app.happy-timepromotion.detail.employee_create')</label>
                                        <div class="col-lg-8">:
                                            <label id="employee-create-detail-happy-time-promotion"></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4">@lang('app.happy-timepromotion.detail.min-order-total')</label>
                                        <div class="col-lg-8">:
                                            <label id="min-order-total-detail-happy-time-promotion"></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4">@lang('app.happy-timepromotion.detail.max-promotion')</label>
                                        <div class="col-lg-8">:
                                            <label id="max-promotion-detail-happy-time-promotion"></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4">@lang('app.happy-timepromotion.detail.discount')</label>
                                        <div class="col-lg-8">:
                                            <label id="discount-detail-happy-time-promotion"></label>
                                        </div>
                                    </div>
{{--                                    <div class="form-group row">--}}
{{--                                        <label class="col-lg-4">@lang('app.happy-timepromotion.detail.bonus-point')</label>--}}
{{--                                        <div class="col-lg-8">:--}}
{{--                                            <label id="bonus-point-detail-happy-time-promotion"></label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group row">--}}
{{--                                        <label class="col-lg-4">@lang('app.happy-timepromotion.detail.reusable-count')</label>--}}
{{--                                        <div class="col-lg-8">:--}}
{{--                                            <label id="reusable-count-detail-happy-time-promotion"></label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4">@lang('app.happy-timepromotion.detail.from-hour')</label>
                                        <div class="col-lg-8">:
                                            <label type="text" id="from-hour-detail-happy-time-promotion"></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4">@lang('app.happy-timepromotion.detail.to-hour')</label>
                                        <div class="col-lg-8">:
                                            <label type="text" id="to-hour-detail-happy-time-promotion"></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4">@lang('app.happy-timepromotion.detail.from-date')</label>
                                        <div class="col-lg-8">:
                                            <label type="text" id="from-date-detail-happy-time-promotion"></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4">@lang('app.happy-timepromotion.detail.to-date')</label>
                                        <div class="col-lg-8">:
                                            <label type="text" id="to-date-detail-happy-time-promotion"></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4">@lang('app.happy-timepromotion.detail.type')</label>
                                        <div class="col-lg-8">:
                                            <label id="type-detail-happy-time-promotion"></label>
                                        </div>
                                    </div>
{{--                                    <div class="form-group row">--}}
{{--                                        <label class="col-lg-4">@lang('app.happy-timepromotion.detail.apply-type')</label>--}}
{{--                                        <div class="col-lg-8">:--}}
{{--                                            <label id="apply-type-detail-happy-time-promotion"></label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="form-group row">
                                        <label class="col-lg-4">@lang('app.happy-timepromotion.detail.day-of-week')</label>
                                        <div class="col-lg-8">:
                                            <label id="day-of-week-detail-happy-time-promotion"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="list-img-detail-customer-promotion">
                            </div>
                        </div>
                    </div>
{{--                    <div class="col-lg-12">--}}
{{--                        <div class="card card-block">--}}
{{--                            <h5 class="sub-title">@lang('app.happy-timepromotion.detail.list-voucher')</h5>--}}
{{--                            <table class="table" id="table-voucher-detail">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>@lang('app.happy-timepromotion.detail.stt')</th>--}}
{{--                                    <th>@lang('app.happy-timepromotion.detail.code-voucher')</th>--}}
{{--                                    <th>@lang('app.happy-timepromotion.detail.branch-voucher')</th>--}}
{{--                                    <th>@lang('app.happy-timepromotion.detail.max-use-count')</th>--}}
{{--                                    <th>@lang('app.happy-timepromotion.detail.reusable-max-count')</th>--}}
{{--                                    <th>@lang('app.happy-timepromotion.detail.used-count')</th>--}}
{{--                                    <th>@lang('app.happy-timepromotion.detail.created-at')</th>--}}
{{--                                    <th>@lang('app.happy-timepromotion.detail.status')</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled" onclick="closeModalDetailHappyTimePromotion()"
                        onkeypress="closeModalDetailHappyTimePromotion()">
                    @lang('app.component.button.close')
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/marketing/promotion/happy_time/detail.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
