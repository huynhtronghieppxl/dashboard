<style>
    #value-food-create-gift-marketing option:after {
        content: attr(data-text);
        color: red;
        font-weight: 500;
        text-align: right;
    }
</style>
<div class="modal fade" id="modal-create-gift-marketing" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.gift-marketing.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateGiftMarketing()" onkeypress="closeModalCreateGiftMarketing()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color" id="loading-create-gift-marketing">
                <div class="row">
                    <div class="col-6 edit-flex-auto-fill pl-0">
                        <div class="card card-block flex-sub">
                            <div class="cover-profile">
                                <div class="profile-bg-img bg-white-border box-image bg-white" id="branch-cover-image">
                                    <figure class="box-image-banner-branch">
                                        <div class="edit-pp">
                                            <label class="fileContainer pointer">
                                                <i class="fa fa-camera"></i>
                                                <input type="file" accept="image/*" id="upload-gift-banner-create-gift-marketing" />
                                            </label>
                                        </div>
                                        <img id="thumbnail-gift-banner-create-gift-marketing" onerror="imageDefaultOnLoadError($(this))" src="{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}" alt="" />
                                    </figure>
                                </div>
                            </div>
                            <div class="form-group select2_theme validate-group m-t-10">
                                <div class="form-validate-select">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="select-branch-create-gift-marketing" multiple="" class="js-example-basic-single select2-hidden-accessible" data-select="1" tabindex="-1" aria-hidden="true"> </select>
                                            <label class="icon-validate">
                                                @lang('app.gift-marketing.create.branch') @include('layouts.start')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input type="text" class="form-control" id="name-create-gift-marketing" data-empty="1" data-max-length="50" />
                                    <label class="d-flex align-items-center">
                                        @lang('app.gift-marketing.create.name') @include('layouts.start')
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="select-type-create-gift-marketing" class="form-control js-example-basic-single select2-hidden-accessible" data-select="1">
                                                <option value="0" selected>@lang('app.gift-marketing.create.opt-food')</option>
                                                <option value="1">@lang('app.gift-marketing.create.opt-point')</option>
                                            </select>
                                            <label>
                                                @lang('app.gift-marketing.create.type') @include('layouts.start')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="row" id="div-value-food-create-gift-marketing">
                                <div class="col-12 form-group select2_theme validate-group px-0">
                                    <div class="form-validate-select">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="value-food-create-gift-marketing" class="form-control js-example-basic-single select2-hidden-accessible"> </select>
                                                <label>
                                                    @lang('app.gift-marketing.create.value-food')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <div class="col-12 table-responsive new-table">
                                    <table class="table" id="table-food-create-gift-marketing">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.gift-marketing.create.stt')</th>
                                            <th>@lang('app.gift-marketing.create.name-food')</th>
                                            <th>@lang('app.gift-marketing.create.quantity-food')</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group validate-group d-none" id="div-value-point-create-gift-marketing">
                                <div class="form-validate-input">
                                    <input class="form-control" id="value-point-create-gift-marketing" data-min="1" data-max="999999" />
                                    <label>
                                        @lang('app.gift-marketing.create.value-point')
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group mt-3">
                                <div class="form-validate-input">
                                    <input class="form-control" id="day-create-gift-marketing" value="1" data-number="1" data-min="1" data-max="365" data-type="currency-edit" />
                                    <label>
                                        @lang('app.gift-marketing.create.day')
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="row p-0">
                                <div class="col-6 form-group" id="type-day-create-gift-marketing">
                                    <div class="form-group checkbox-group">
                                        <label class="title-checkbox">@lang('app.gift-marketing.create.type-day')</label>
                                        <div class="row">
                                            <div class="form-validate-checkbox mr-0 w-50">
                                                <div class="checkbox-form-group">
                                                    <input type="radio" id="type-day-create-by-week" name="day-create" value="0" checked />
                                                    <label class="name-checkbox" for="type-day-create-by-week"> <i class="helper"></i>@lang('app.gift-marketing.create.type-day-all') </label>
                                                </div>
                                            </div>
                                            <div class="form-validate-checkbox mr-0 w-50">
                                                <div class="checkbox-form-group">
                                                    <input type="radio" id="type-day-create-by-day" name="day-create" value="1" />
                                                    <label class="name-checkbox" for="type-day-create-by-day"> <i class="helper"></i>@lang('app.gift-marketing.create.type-day-select') </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group select2_theme validate-group d-none pr-0" id="div-type-day-create-gift-marketing">
                                    <div class="form-validate-select">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="day-of-week-create-gift-marketing" multiple="" class="js-example-basic-single select2-hidden-accessible" data-select="1" tabindex="-1" aria-hidden="true">
                                                    <option value="0">@lang('app.component.day-of-week.sunday')</option>
                                                    <option value="1">@lang('app.component.day-of-week.monday')</option>
                                                    <option value="2">@lang('app.component.day-of-week.tuesday')</option>
                                                    <option value="3">@lang('app.component.day-of-week.wednesday')</option>
                                                    <option value="4">@lang('app.component.day-of-week.thursday')</option>
                                                    <option value="5">@lang('app.component.day-of-week.friday')</option>
                                                    <option value="6">@lang('app.component.day-of-week.saturday')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.gift-marketing.create.day-of-week') @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                            </div>
                            <div class="row p-0">
                                <div class="col-6 form-group" id="type-hour-create-gift-marketing">
                                    <div class="form-group checkbox-group">
                                        <label class="title-checkbox">@lang('app.gift-marketing.create.type-hour')</label>
                                    </div>
                                    <div class="row">
                                        <div class="form-validate-checkbox mr-0 w-50">
                                            <div class="checkbox-form-group">
                                                <input type="radio" id="type-hour-create-all-day" name="hour-create" value="0" checked />
                                                <label for="type-hour-create-all-day" class="name-checkbox"> <i class="helper"></i>@lang('app.gift-marketing.create.type-hour-all') </label>
                                            </div>
                                        </div>
                                        <div class="form-validate-checkbox mr-0 w-50">
                                            <div class="checkbox-form-group">
                                                <input type="radio" id="type-hour-create-hour" name="hour-create" value="1" />
                                                <label for="type-hour-create-hour" class="name-checkbox"> <i class="helper"></i>@lang('app.gift-marketing.create.type-hour-select') </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 row pr-0" id="div-type-hour-create-gift-marketing">
                                    <div class="col-6 form-group validate-group pl-0">
                                        <div class="form-validate-input">
                                            <input class="form-control" id="from-hour-create-gift-marketing" value="00" />
                                            <label>
                                                @lang('app.gift-marketing.create.from-hour')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                    <div class="col-6 form-group validate-group pr-0">
                                        <div class="form-validate-input">
                                            <input class="form-control" id="to-hour-create-gift-marketing" value="23" />
                                            <label>
                                                @lang('app.gift-marketing.create.to-hour')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 edit-flex-auto-fill p-0">
                        <div class="card card-block flex-sub">
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea class="form__field" id="description-create-gift-marketing" cols="5" rows="10"></textarea>
                                        <label for="description-create-gift-marketing" class="form__label icon-validate">@lang('app.gift-marketing.create.description')</label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea class="form__field" id="content-create-gift-marketing" cols="5" rows="10" style="font-size:14px;"></textarea>
                                        <label for="content-create-gift-marketing" class="form__label icon-validate">@lang('app.gift-marketing.create.content')</label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea class="form__field" id="use-guide-create-gift-marketing" cols="5" rows="10" style="font-size:14px;"></textarea>
                                        <label for="use-guide-create-gift-marketing" class="form__label icon-validate">@lang('app.gift-marketing.create.use-guide')</label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea class="form__field" id="term-create-gift-marketing" cols="5" rows="10" style="font-size:14px;"></textarea>
                                        <label for="term-create-gift-marketing" class="form__label icon-validate">@lang('app.gift-marketing.create.term')</label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew" onclick="reloadModalCreateGiftMarketing()" data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalCreateGiftMarketing()" onkeypress="saveModalCreateGiftMarketing()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\marketing\gift\gift\create.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
