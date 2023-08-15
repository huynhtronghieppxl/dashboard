<div class="modal fade" id="modal-update-gift-marketing" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.gift-marketing.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateGiftMarketing()" onkeypress="closeModalUpdateGiftMarketing()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color" id="loading-update-gift-marketing">
                <div class="row">
                    <div class="col-6 edit-flex-auto-fill">
                        <div class="card card-block flex-sub">
                            <div class="cover-profile">
                                <div class="profile-bg-img bg-white-border box-image bg-white" id="branch-cover-image">
                                    <figure class="box-image-banner-branch">
                                        <div class="edit-pp ">
                                            <label class="fileContainer pointer">
                                                <i class="fa fa-camera"></i>
                                                <input type="file" accept="image/*"
                                                       id="upload-gift-banner-update-gift-marketing">
                                            </label>
                                        </div>
                                        <img onerror="imageDefaultOnLoadError($(this))"
                                             id="thumbnail-gift-banner-update-gift-marketing"
                                             src="{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}" alt="">
                                    </figure>
                                </div>
                            </div>
                            <div class="form-group select2_theme validate-group m-t-10">
                                <div class="form-validate-select ">
                                    <div class="col-lg-12 pr-0 select-material-box mt-2">
                                        <select id="select-branch-update-gift-marketing" multiple=""
                                                class="js-example-basic-single select2-hidden-accessible"
                                                data-select = "1" tabindex="-1" aria-hidden="true">
{{--                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->where('is_office', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))->all() as $db)--}}
{{--                                                <option value="{{$db['id']}}">{{$db['name']}}</option>--}}
{{--                                            @endforeach--}}
                                        </select>
                                        <label class="icon-validate">
                                            @lang('app.gift-marketing.update.branch')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input class="form-control" id="name-update-gift-marketing"
                                           data-empty="1" data-max-length="50">
                                    <label class="d-flex align-items-center">
                                        @lang('app.gift-marketing.update.name')
                                        @include('layouts.start')
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="select-type-update-gift-marketing"
                                                    class="form-control js-example-basic-single select2-hidden-accessible"
                                                    data-select="1" tabindex="-1" aria-hidden="true">
                                                <option value="0"
                                                        selected>@lang('app.gift-marketing.update.opt-food')</option>
                                                <option value="1">@lang('app.gift-marketing.update.opt-point')</option>
                                            </select>
                                            <label>
                                                @lang('app.gift-marketing.update.type')
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="row" id="div-value-food-update-gift-marketing">
                                <div class="col-12 form-group select2_theme validate-group px-0">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="value-food-update-gift-marketing"
                                                        class="form-control js-example-basic-single select2-hidden-accessible"
                                                        tabindex="-1" aria-hidden="true">
                                                    <option disabled selected
                                                            >@lang('app.component.option_default')</option>
                                                </select>
                                                <label>
                                                    @lang('app.gift-marketing.update.value-food')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <div class="col-12 table-responsive new-table px-0 mb-2">
                                    <table class="table" id="table-food-update-gift-marketing">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.gift-marketing.update.stt')</th>
                                            <th>@lang('app.gift-marketing.update.name-food')</th>
                                            <th>@lang('app.gift-marketing.update.quantity-food')</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group d-none validate-group" id="div-value-point-update-gift-marketing">
                                <div class="form-validate-input">
                                    <input class="form-control" id="value-point-update-gift-marketing" value="1"
                                           data-number="1" data-min="1" data-max="999999"
                                           data-type="currency-edit">
                                    <label>
                                        @lang('app.gift-marketing.update.value-point')
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group m-t-5">
                                <div class="form-validate-input">
                                    <input class="form-control" id="day-update-gift-marketing" value="1"
                                           data-number="1" data-min="1" data-max="365"
                                           data-type="currency-edit">
                                    <label>
                                        @lang('app.gift-marketing.update.day')
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="row p-0">
                                <div class="col-6 form-group" id="type-day-update-gift-marketing">
                                    <div class="form-group checkbox-group">
                                        <label class="title-checkbox">@lang('app.gift-marketing.update.type-day')</label>
                                        <div class="row">
                                                <div class="form-validate-checkbox mr-0 w-50">
                                                    <div class="checkbox-form-group">
                                                        <input type="radio" id="type-day-update-by-week" name="day-update" value="0" checked>
                                                        <label for="type-day-update-by-week" class="name-checkbox">
                                                            <i class="helper"></i>@lang('app.gift-marketing.update.type-day-all')
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-validate-checkbox mr-0 w-50">
                                                    <div class="checkbox-form-group">
                                                        <input type="radio" id="type-day-update-by-day" name="day-update" value="1">
                                                        <label for="type-day-update-by-day" class="name-checkbox">
                                                            <i class="helper"></i>@lang('app.gift-marketing.update.type-day-select')
                                                        </label>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group select2_theme validate-group pr-0"
                                     id="div-type-day-update-gift-marketing">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="day-of-week-update-gift-marketing" multiple=""
                                                    class="js-example-basic-single select2-hidden-accessible"
                                                    data-select="1" tabindex="-1" aria-hidden="true">
                                                <option value="0">@lang('app.component.day-of-week.sunday')</option>
                                                <option value="1">@lang('app.component.day-of-week.monday')</option>
                                                <option value="2">@lang('app.component.day-of-week.tuesday')</option>
                                                <option value="3">@lang('app.component.day-of-week.wednesday')</option>
                                                <option value="4">@lang('app.component.day-of-week.thursday')</option>
                                                <option value="5">@lang('app.component.day-of-week.friday')</option>
                                                <option value="6">@lang('app.component.day-of-week.saturday')</option>
                                            </select>
                                            <label class="icon-validate">
                                                @lang('app.gift-marketing.update.day-of-week')
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                            </div>
                            <div class="row p-0">
                                <div class="col-6 form-group" id="type-hour-update-gift-marketing">
                                    <div class="form-group checkbox-group">
                                        <label class="title-checkbox">@lang('app.gift-marketing.update.type-hour')</label>
                                        <div class="row">
                                                <div class="form-validate-checkbox mr-0 w-50">
                                                    <div class="checkbox-form-group">
                                                        <input type="radio" id="type-day-update-all-day" name="hour-update" value="0" checked>
                                                        <label for="type-day-update-all-day" class="name-checkbox">
                                                            <i class="helper"></i>@lang('app.gift-marketing.update.type-hour-all')
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-validate-checkbox mr-0 w-50">
                                                    <div class="checkbox-form-group">
                                                        <input type="radio" id="type-day-update-hour" name="hour-update" value="1">
                                                        <label for="type-day-update-hour" class="name-checkbox">
                                                            <i class="helper"></i>@lang('app.gift-marketing.update.type-hour-select')
                                                        </label>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 row d-none pr-0" id="div-type-hour-update-gift-marketing">
                                    <div class="col-6 pl-0 form-group validate-group">
                                        <div class="form-validate-input">
                                            <input class="form-control" id="from-hour-update-gift-marketing" value="0">
                                            <label>
                                                @lang('app.gift-marketing.update.from-hour')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                    <div class="col-6 pr-0 form-group validate-group">
                                        <div class="form-validate-input">
                                            <input class="form-control" id="to-hour-update-gift-marketing" value="23"
                                                   >
                                            <label>
                                                @lang('app.gift-marketing.update.to-hour')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 edit-flex-auto-fill">
                        <div class="card card-block flex-sub">
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                <textarea class="form__field" id="description-update-gift-marketing" cols="5"
                                          rows="10"></textarea>
                                        <label for="description-update-gift-marketing"
                                               class="form__label icon-validate">@lang('app.gift-marketing.update.description')</label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                <textarea class="form__field" id="content-update-gift-marketing" cols="5"
                                          rows="10"></textarea>
                                        <label for="content-update-gift-marketing"
                                               class="form__label icon-validate">@lang('app.gift-marketing.update.content')</label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                <textarea class="form__field" id="use-guide-update-gift-marketing" cols="5"
                                          rows="10"></textarea>
                                        <label for="use-guide-update-gift-marketing"
                                               class="form__label icon-validate">@lang('app.gift-marketing.update.use-guide')</label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                <textarea class="form__field" id="term-update-gift-marketing" cols="5"
                                          rows="10"></textarea>
                                        <label for="term-update-gift-marketing"
                                               class="form__label icon-validate">@lang('app.gift-marketing.update.term')</label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn btn-grd-primary "
                        onclick="saveModalUpdateGiftMarketing()"
                        onkeypress="saveModalUpdateGiftMarketing()">
                        <i class="fi-rr-disk"></i>
                        <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\marketing\gift\gift\update.js?version=7',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

