<div class="modal fade" id="modal-update-gift" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.gift.update.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateGift()" onkeypress="closeModalCreateGift()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-update-gift">
                <div class="card-block">
{{--                    <div class="form-group row">--}}
{{--                        <label class="col-sm-3 col-form-label">@lang('app.gift.update.branch')</label>--}}
{{--                        <div class="col-sm-9">--}}
{{--                            <select data-icon=" icofont-location-pin" id="branch-update-gift" class="col-sm-12 " data-validate="select, empty">--}}

{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="form-group select2_theme validate-group">
                        <div class="form-validate-select ">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 pr-0 select-material-box">
                                    <select data-icon=" icofont-location-pin" id="branch-update-gift" class="col-sm-12 select-not-select2 select2-hidden-accessible" data-validate="select, empty" tabindex="-1" aria-hidden="true">
                                        @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all() as $db)
                                            @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])
                                                <option value="{{$db['id']}}" data-take-away="{{$db['is_have_take_away']}}" data-booking="{{$db['is_enable_booking']}}" selected>{{$db['name']}}</option>
                                            @else
                                                <option value="{{$db['id']}}" data-take-away="{{$db['is_have_take_away']}}" data-booking="{{$db['is_enable_booking']}}">{{$db['name']}}</option>
                                            @endif @endforeach
                                    </select>
                                    <label class="icon-validate">
                                        <i class="icofont  icofont-location-pin"></i>@lang('app.gift.update.branch') </label>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>

{{--                    <div class="form-group row">--}}
{{--                        <label class="col-sm-3 col-form-label">@lang('app.gift.update.name')</label>--}}
{{--                        <div class="col-sm-9">--}}
{{--                            <input id="name-update-gift" class="form-control " data-validate="empty, max-length-255" data-type="currency-edit" data-icon="fa-exchange" />--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="form-group validate-group">
                        <div class="form-validate-input ">
                            <input id="name-update-gift" class="form-control" data-validate="empty, max-length-255" data-type="currency-edit">
                            <label for="name-update-gift">
                                <i class="icofont fa-exchange"></i>@lang('app.gift.update.name') <span class="text-danger">(*)</span>
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>

{{--                    <div class="form-group row">--}}
{{--                        <label class="col-sm-3 col-form-label">@lang('app.gift.update.price')</label>--}}
{{--                        <div class="col-sm-9">--}}
{{--                            <input id="price-update-gift" class="form-control" data-validate="empty, min-value-100, max-value-999999999" data-type="currency-edit" data-icon="icofont-money-bag" />--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="form-group validate-group">
                        <div class="form-validate-input ">
                            <input id="price-update-gift" class="form-control" data-validate="empty, min-value-100, max-value-999999999" data-type="currency-edit">
                            <label for="price-update-gift">
                                <i class="icofont icofont-money-bag"></i>@lang('app.gift.update.price') <span class="text-danger">(*)</span>
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-2">
                            <p class="m-b-10 col-form-label font-weight-bold my-auto">@lang('app.gift.update.description')</p>
                        </div>
                        <div class="col-lg-10">
                            <textarea class="w-100" id="description-update-gift" cols="5" rows="3" data-validate="note"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalUpdateGift()"
                     onkeypress="saveModalUpdateGift()">
                    <i class="fi-rr-document"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/customer/gift/update.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
