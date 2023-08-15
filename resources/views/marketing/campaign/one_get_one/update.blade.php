<div class="modal fade" id="modal-update-one-get-one-campaign" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.one-get-one-campaign.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateOneGetOneCampaign()" onkeypress="closeModalUpdateOneGetOneCampaign()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-update-one-get-one-campaign">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 edit-flex-auto-fill px-0">
                        <div class="card card-block  flex-sub">
                            <div class="form-group cover-profile">
                                <div class="profile-bg-img bg-white-border box-image bg-white" id="branch-cover-image"
                                     style="height: auto">
                                    <figure class="box-image-banner-branch" style="height: auto !important;">
                                        <div class="edit-pp ">
                                            <label class="fileContainer pointer">
                                                <i class="fa fa-camera"></i>
                                                <input type="file" accept="image/*"
                                                       id="upload-update-banner-one-get-one-campaign">
                                            </label>
                                        </div>
                                        <img id="thumbnail-update-one-get-one-campaign"
                                             src="{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}" alt="" style="height: 210px">
                                    </figure>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6 validate-group pl-0">
                                    <div class="form-validate-input ">
                                        <input type="text" id="from-hour-update-one-get-one-campaign" class="input-sm form-control text-center input-datetimepicker p-1" value="{{date('H')}}" data-validate="" autocomplete="off">
                                        <label>@lang('app.one-get-one-campaign.update.from-hour') </label>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <div class="form-group col-6 validate-group pr-0">
                                    <div class="form-validate-input ">
                                        <input type="text" id="to-hour-update-one-get-one-campaign" class="input-sm form-control text-center input-datetimepicker p-1" value="{{date('H')}}" data-validate="" autocomplete="off">
                                        <label> @lang('app.one-get-one-campaign.update.to-hour') </label>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6 validate-group pl-0 mb-0">
                                    <div class="form-validate-input ">
                                        <input type="text" id="from-date-update-one-get-one-campaign" class="input-sm form-control text-center input-datetimepicker p-1" value="{{date('d/m/Y')}}" data-validate="calendar" autocomplete="off">
                                        <label>@lang('app.one-get-one-campaign.update.from-date') </label>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <div class="form-group col-6 validate-group pr-0 mb-0">
                                    <div class="form-validate-input ">
                                        <input type="text" id="to-date-update-one-get-one-campaign" class="input-sm form-control text-center input-datetimepicker p-1" value="{{date('d/m/Y')}}" data-validate="calendar" autocomplete="off">
                                        <label>@lang('app.one-get-one-campaign.update.to-date') </label>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                            </div>
                            <div class="form-group row validate-group">
                                <label
                                    class="col-lg-12 col-form-label font-weight-bold my-auto">@lang('app.one-get-one-campaign.update.day-of-week'):</label>
                            </div>
                            <div class="row" id="day-of-week-update-one-get-one-campaign">
                                <div class="col-sm-3 form-validate-checkbox row">
                                    <div class="checkbox-form-group">
                                        <input type="checkbox" id="update-one-get-one-campaign-monday" name="day-of-week" value="1">
                                        <label for="update-one-get-one-campaign-monday" class="name-checkbox">@lang('app.one-get-one-campaign.update.option-day-of-week.monday')</label>
                                    </div>
                                </div>
                                <div class="col-sm-3 form-validate-checkbox row">
                                    <div class="checkbox-form-group">
                                        <input type="checkbox" id="update-one-get-one-campaign-tuesday" name="day-of-week" value="2">
                                        <label for="update-one-get-one-campaign-tuesday" class="name-checkbox">@lang('app.one-get-one-campaign.update.option-day-of-week.tuesday')</label>
                                    </div>
                                </div>
                                <div class="col-sm-3 form-validate-checkbox row">
                                    <div class="checkbox-form-group">
                                        <input type="checkbox" id="update-one-get-one-campaign-wednesday" name="day-of-week" value="3">
                                        <label for="update-one-get-one-campaign-wednesday" class="name-checkbox">@lang('app.one-get-one-campaign.update.option-day-of-week.wednesday')</label>
                                    </div>
                                </div>
                                <div class="col-sm-3 form-validate-checkbox row">
                                    <div class="checkbox-form-group">
                                        <input type="checkbox" id="update-one-get-one-campaign-thursday" name="day-of-week" value="4">
                                        <label for="update-one-get-one-campaign-thursday" class="name-checkbox">@lang('app.one-get-one-campaign.update.option-day-of-week.thursday')</label>
                                    </div>
                                </div>
                                <div class="col-sm-3 form-validate-checkbox row">
                                    <div class="checkbox-form-group">
                                        <input type="checkbox" id="update-one-get-one-campaign-friday" name="day-of-week" value="5">
                                        <label for="update-one-get-one-campaign-friday" class="name-checkbox">@lang('app.one-get-one-campaign.update.option-day-of-week.friday')</label>
                                    </div>
                                </div>
                                <div class="col-sm-3 form-validate-checkbox row">
                                    <div class="checkbox-form-group">
                                        <input type="checkbox" id="update-one-get-one-campaign-saturday" name="day-of-week" value="6">
                                        <label for="update-one-get-one-campaign-saturday" class="name-checkbox">@lang('app.one-get-one-campaign.update.option-day-of-week.saturday')</label>
                                    </div>
                                </div>
                                <div class="col-sm-3 form-validate-checkbox row">
                                    <div class="checkbox-form-group">
                                        <input type="checkbox" id="update-one-get-one-campaign-sunday" name="day-of-week" value="0">
                                        <label for="update-one-get-one-campaign-sunday" class="name-checkbox">@lang('app.one-get-one-campaign.update.option-day-of-week.sunday')</label>
                                    </div>
                                </div>
                                <div class="col-sm-3 form-validate-checkbox row">
                                    <div class="checkbox-form-group">
                                        <input type="checkbox" id="update-one-get-one-campaign-all-day" name="all-day" value="all-day">
                                        <label for="update-one-get-one-campaign-all-day" class="name-checkbox">@lang('app.one-get-one-campaign.update.all-day')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 edit-flex-auto-fill">
                        <div class="card card-block flex-sub mx-0">
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input type="text" id="name-update-one-get-one-campaign" class="form-control"  data-empty = "1" data-max-length = "100">
                                    <label>
                                        @lang('app.one-get-one-campaign.update.name')
                                        @include('layouts.start')
                                    </label>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select ">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="branches-update-one-get-one-campaign" class="js-example-basic-single select2-hidden-accessible" data-select = "1" multiple="" tabindex="-1" aria-hidden="true">
                                                @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all() as $db)
                                                    <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                @endforeach
                                            </select>
                                            <label>
                                                @lang('app.one-get-one-campaign.update.branches')
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea id="detail-update-one-get-one-campaign"
                                                  class="form-control" rows="5"></textarea>
                                        <label for="detail-update-one-get-one-campaign" class="icon-validate">
                                            </i>@lang('app.one-get-one-campaign.update.detail')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveUpdateOneGetOneCampaign()"
                        onkeypress="saveUpdateOneGetOneCampaign()">
                        <i class="fi-rr-disk"></i>
                        <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/marketing/campaign/one_get_one/update.js?version=2',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
