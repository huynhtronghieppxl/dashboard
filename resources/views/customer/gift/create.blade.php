<div class="modal fade" id="modal-create-gift" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.gift.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateGift()" onkeypress="closeModalCreateGift()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-create-gift">
                <div class="card-block">
                    <div class="form-group select2_theme validate-group">
                        <div class="form-validate-select ">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 pr-0 select-material-box">
                                    <select data-icon=" icofont-location-pin form-group " data-validte="select,empty" id="branch-create-gift" class="col-sm-12 js-example-basic-single select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                        @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all() as $db)--}}
                                            @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])
                                                <option  value="{{$db['id']}}" data-take-away="{{$db['is_have_take_away']}}" data-booking="{{$db['is_enable_booking']}}" selected>{{$db['name']}}</option>
                                            @else
                                                <option value="{{$db['id']}}" data-take-away="{{$db['is_have_take_away']}}" data-booking="{{$db['is_enable_booking']}}">{{$db['name']}}</option>
                                            @endif @endforeach
                                    </select>
                                    <label class="icon-validate"><i class="icofont icofont-location-pin form-group "></i>@lang('app.gift.create.branch')</label>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div><div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group"><div class="form-validate-input">
                            <input id="name-create-gift" class="form-control" data-validate="empty, max-length-255, not">
                            <label for="name-create-gift"><i class="icofont fa-exchange"></i>@lang('app.gift.create.name') <span class="text-danger">(*)</span></label>
                            <div class="line"></div></div><div class="link-href"></div></div>

                    <div class="form-group validate-group"><div class="form-validate-input">
                            <input id="price-create-gift" class="form-control" value="0" data-validate="empty" data-type="currency-edit">
                            <label for="price-create-gift"><i class="icofont icofont-money-bag"></i>@lang('app.gift.create.price') <span class="text-danger">(*)</span></label>
                            <div class="line"></div></div><div class="link-href"></div></div>
                    <div class="form-group row">
                        <div class="col-lg-2">
                            <p class="m-b-10 col-form-label font-weight-bold my-auto">@lang('app.gift.create.description')</p>
                        </div>
                        <div class="col-lg-10">
                            <textarea class="w-100" id="description-create-gift" cols="5" rows="3" data-validate="note"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalCreateGift()"
                     onkeypress="saveModalCreateGift()">
                    <i class="fi-rr-document"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/customer/gift/create.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
