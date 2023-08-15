<div class="modal fade" id="modal-create-price-adjustment-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" id="body-detail">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.price-adjustment-data.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreatePriceAdjustment()" onkeypress="closeModalCreatePriceAdjustment()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left pb-0"
                 id="loading-modal-create-price-adjustment-data">
                <div class="row">
                    <div class="col-lg-8 edit-flex-auto-fill p-0">
                        <div class="card card-block flex-sub mr-0">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select id="select-food-price-adjustment"
                                                    class="js-example-basic-single select2-hidden-accessible">
                                                <option disabled selected hidden>Chọn món ăn</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table class="table" id="modal-table-price-adjustment">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.price-adjustment-data.create.name')</th>
                                        <th>@lang('app.price-adjustment-data.create.original-price')</th>
                                        <th>@lang('app.price-adjustment-data.create.difference')</th>
                                        <th>@lang('app.price-adjustment-data.create.price') </th>
                                        <th>@lang('app.price-adjustment-data.create.close')</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill p-0">
                        <div class="card card-block flex-sub">
                            <h5 class="sub-title">@lang('app.price-adjustment-data.create.title-right')</h5>
                            <div class="form-group select2_theme validate-group pt-4">
                                <div class="form-validate-select">
                                    <div class="mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="select-restaurant-brand-price-adjustment" data-select="1"
                                                    class="form-control js-example-basic-single form-control-inverse select-border-default m-t-10px select2-hidden-accessible">
{{--                                                @if(Session::get(SESSION_KEY_PERMISSION_TALLEST) > 1)--}}
                                                    @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                        @if($db['is_office'] === 0)
                                                            @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                                <option value="{{$db['id']}}"
                                                                        selected>{{$db['name']}}</option>
                                                            @else
                                                                <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                            @endif
                                                        @endif
                                                    @endforeach
{{--                                                @else--}}
{{--                                                    <option--}}
{{--                                                        value="{{Session::get(SESSION_JAVA_ACCOUNT)['restaurant_brand_id']}}"--}}
{{--                                                        selected>{{Session::get(SESSION_JAVA_ACCOUNT)['restaurant_brand_name']}}</option>--}}
{{--                                                @endif--}}
                                            </select>
                                            <label class="icon-validate">
                                               @lang('app.price-adjustment-data.create.restaurant_brand')
                                                @include('layouts.start')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea class="form__field" rows="10" cols="6" data-note="1" id="note-price-adjustment"
                                                  data-note-max-length="255"></textarea>
                                        <label for="note-price-adjustment" class="form__label icon-validate">
                                            @lang('app.price-adjustment-data.create.note')
                                            @include('layouts.start')
                                        </label>
                                        <div class="textarea-character" id="char-count">
                                            <span>0/300</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none"
                        onclick="resetModalCreatePriceAdjustment()"
                        onkeypress="resetModalCreatePriceAdjustment()">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreatePriceAdjustment()"
                     onkeypress="saveModalCreatePriceAdjustment()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')

    <script type="text/javascript"
            src="{{asset('js/build_data/business/price_adjustment/create.js?version=8', env('IS_DEPLOY_ON_SERVER'))}}"></script>

@endpush
