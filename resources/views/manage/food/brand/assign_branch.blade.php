<div class="modal fade" id="modal-change-food-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <div class="col-lg-9">
                    <h4 class="modal-title">@lang('app.food-brand-manage.assign_branch.title')</h4>
                </div>
                <div class="col-lg-3">
                    <select id="change_branch_food" name="branch_id"
                            class="form-control form-control-inverse select-border-default m-t-10px">
                        @if(Session::get(SESSION_KEY_PERMISSION_TALLEST) > 1)
                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all() as $db)
                                @if(Session::get(SESSION_KEY_BRANCH_ID) === $db['id'])
                                    <option value="{{$db['id']}}" selected>{{$db['name']}}</option>
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
            <div class="modal-body background-body-color text-left" id="loading-modal-change-kitchen-food-manage">
                <div class="card">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs md-tabs md-5-tabs"
                                id="tabs-food-assign-manage" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" data-type="1"
                                       href="#tab1-food-data" role="tab" aria-expanded="true">
                                        @lang('app.food-data.tab1')
                                        <span class="label label-success" id="total-record-assign-food">0</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" data-type="2" href="#tab2-food-data"
                                       role="tab" aria-expanded="false">
                                        @lang('app.food-data.tab2')
                                        <span class="label label-warning" id="total-record-assign-drink">0</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" data-type="4" href="#tab3-food-data"
                                       role="tab" aria-expanded="false">
                                        @lang('app.food-data.tab3')
                                        <span class="label label-primary" id="total-record-sea-assign-food">0</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" data-type="3" href="#tab4-food-data"
                                       role="tab" aria-expanded="false">
                                        @lang('app.food-data.tab4')
                                        <span class="label label-danger" id="total-record-assign-other">0</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <div class="card-block">
                                        <select id="data-kitchen-food-manage" class="js-example-basic-single">
                                            <option value="" disabled selected>@lang('app.food-brand-manage.assign_branch.null-option')</option>
                                        </select>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- Tab panes -->
                        <div class="col-lg-12">
                            <div class="tab-content">
                                <div class="card-block tab-pane active" id="tab1-food-data" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="table-kitchen-food-assign-manage">
                                            <thead>
                                            <tr>
                                                <th>@lang('app.food-manage.change-kitchen.stt')</th>
                                                <th>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" onclick="checkAllChangeFoodManage($(this))" id="check-all-kitchen-food-assign-manage" data-type="1"/>
                                                            <span class="cr">
                                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </th>
                                                <th>@lang('app.food-manage.change-kitchen.avatar')</th>
                                                <th>@lang('app.food-manage.change-kitchen.name')</th>
                                                <th>
                                                    @lang('app.food-brand-manage.assign_branch.type_food')
                                                </th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane card-block" id="tab2-food-data" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="table-drink-food-assign-data">
                                            <thead>
                                            <tr>
                                                <th>@lang('app.food-manage.change-kitchen.stt')</th>
                                                <th>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" onclick="checkAllChangeFoodManage($(this))" id="check-all-drink-food-assign-manage" data-type="2"/>
                                                            <span class="cr">
                                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </th>
                                                <th>@lang('app.food-manage.change-kitchen.avatar')</th>
                                                <th>@lang('app.food-manage.change-kitchen.name')</th>
                                                <th>
                                                    @lang('app.food-brand-manage.assign_branch.type_food')
                                                </th>
                                            </tr>
                                            </thead>

                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane card-block" id="tab3-food-data" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered"
                                               id="table-sea-food-food-assign-data">
                                            <thead>
                                            <tr>
                                                <th>@lang('app.food-manage.change-kitchen.stt')</th>
                                                <th>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" onclick="checkAllChangeFoodManage($(this))" id="check-all-sea-food-assign-manage" data-type="3"/>
                                                            <span class="cr">
                                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </th>
                                                <th>@lang('app.food-manage.change-kitchen.avatar')</th>
                                                <th>@lang('app.food-manage.change-kitchen.name')</th>
                                                <th>
                                                    @lang('app.food-brand-manage.assign_branch.type_food')
                                                </th>
                                            </thead>

                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane card-block" id="tab4-food-data" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="table-other-food-assign-data">
                                            <thead>
                                            <tr>
                                                <th>@lang('app.food-manage.change-kitchen.stt')</th>
                                                <th>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" onclick="checkAllChangeFoodManage($(this))" id="check-all-other-food-assign-manage" data-type="4"/>
                                                            <span class="cr">
                                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </th>
                                                <th>@lang('app.food-manage.change-kitchen.avatar')</th>
                                                <th>@lang('app.food-manage.change-kitchen.name')</th>
                                                <th>
                                                    @lang('app.food-brand-manage.assign_branch.type_food')
                                                </th>
                                            </tr>
                                            </thead>

                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane card-block" id="tab5-food-manage" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="table-combo-food-data">
                                            <thead>
                                            <tr>
                                                <th>@lang('app.food-manage.change-kitchen.stt')</th>
                                                <th>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" onclick="checkAllChangeFoodManage($(this))" id="check-all-kitchen-food-assign-manage"/>
                                                            <span class="cr">
                                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </th>
                                                <th>@lang('app.food-manage.change-kitchen.avatar')</th>
                                                <th>@lang('app.food-manage.change-kitchen.name')</th>
                                                <th>
                                                    @lang('app.food-brand-manage.assign_branch.type_food')
                                                </th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled waves-effect" onclick="closeModalChangeFoodManage()"
                        onkeypress="closeModalChangeFoodManage()"
                        title="@lang('app.component.title-button.close')">@lang('app.component.button.close')</button>
                <button type="button" class="btn btn-primary waves-effect" onclick="saveAssignBranchFood()"
                        onkeypress="saveAssignBranchFood()"
                        title="@lang('app.component.title-button.save')">@lang('app.component.button.save')</button>
                <button type="button" class="btn btn-warning waves-effect" onclick="saveAssignBranchFoodAndSave()"
                        onkeypress="saveAssignBranchFoodAndSave()"
                        title="@lang('app.component.title-button.save')">@lang('app.food-brand-manage.assign_branch.save_and_create')
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/unveil/1.3.0/jquery.unveil.js"></script>
    <script type="text/javascript"
            src="{{asset('js/manage/food/brand/assign_branch.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
