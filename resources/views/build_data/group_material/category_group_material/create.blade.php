<div class="modal fade" id="modal-create-category-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.group-material.catergory-group-material.create.title')</h4>
            </div>
            <div class="modal-body background-body-color text-left">
                <div class="col-lg-12">
                    <div class="card card-block mb-0">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">@lang('app.group-material.catergory-group-material.create.branch')</label>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single form-control"
                                        id="select-branch-create-category-group-material" data-select-not-empty>
                                    @if(Session::get(SESSION_KEY_PERMISSION_TALLEST) > 1)
                                        @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all() as $db)
                                            @if(Session::get(SESSION_KEY_BRANCH_ID) === $db['id'])
                                                <option value="{{$db['id']}}"
                                                        selected>{{$db['name']}}</option>
                                            @else
                                                <option value="{{$db['id']}}">{{$db['name']}}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option
                                            value="{{Session::get(SESSION_JAVA_ACCOUNT)['branch_id']}}"
                                            selected>{{Session::get(SESSION_JAVA_ACCOUNT)['branch_name']}}</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                class="col-sm-3 col-form-label font-weight-bold my-auto">@lang('app.group-material.catergory-group-material.create.name')</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name-category-group-material"
                                       data-not-empty>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                class="col-sm-3 col-form-label font-weight-bold my-auto">@lang('app.group-material.catergory-group-material.create.note')</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="note-category-group-material" cols="5" rows="5"
                                          data-validate="note"></textarea>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled waves-effect mx-1" onclick="closeModalCreateCategoryMaterial()"
                        onkeypress="closeModalCreateKitchenData()" title="@lang('app.component.title-button.close')">
                    @lang('app.component.button.close')
                </button>
                <button type="button" id="save-create-btn-kitchen-data" class="btn btn-primary waves-effect mx-1"
                        onclick="createCategoryGroupMaterial()" onkeypress="createCategoryGroupMaterial()"
                        title="@lang('app.component.title-button.save')">
                    @lang('app.component.button.save')
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/group_material/category_group_material/create.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
