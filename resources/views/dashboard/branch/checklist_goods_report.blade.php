<div class="card card-block card-shadow-custom-dashboard card-inview-dashboard" id="checklist-goods-report" data-key="checklist-goods-report">
    <h4 class="m-b-20 p-b-5 b-b-default f-w-600">
        <div class="row">
            <div class="col-lg-8">
                <h4 class="font-weight-bold">@lang('app.branch-dashboard.checklist-goods-report.title')</h4>
            </div>
            <div class="col-lg-4 text-right">
                <select name="select"
                        class="form-control form-control-inverse width-50 d-inline"
                        id="select-checklist-goods-report">
                    <option value="2" data-time="{{date('W/Y')}}">@lang('app.branch-dashboard.select.option3')</option>
                    <option value="3" data-time="{{date('m/Y')}}" selected>@lang('app.branch-dashboard.select.option5')</option>
                    <option value="3" data-time="{{date('m/Y', strtotime('-1 month'))}}">@lang('app.branch-dashboard.select.option6')</option>
                    <option value="4" data-time="{{date('m/Y')}}">@lang('app.branch-dashboard.select.option7')</option>
                    <option value="5" data-time="{{date('Y')}}">@lang('app.branch-dashboard.select.option8')</option>
                    <option value="6" data-time="{{date('Y')}}">@lang('app.branch-dashboard.select.option9')</option>
                    <option value="7" data-time="{{substr(Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['created_at'], 6, 4)}}">@lang('app.branch-dashboard.select.option10')</option>
                </select>
                <label><i class="zmdi zmdi-refresh-sync d-inline fa-hover"
                          onclick="reloadChecklistGoodsReport()"></i></label>
            </div>
        </div>
    </h4>
    <div class="card card-block statustic-card card-shadow-custom">
        <h4 class="sub-title font-weight-bold">@lang('app.branch-dashboard.checklist-goods-report.title1')</h4>
        <div class="card-block row">
            <div class="col-md-4">
                <div class="card statustic-progress-card card-shadow-custom">
                    <div class="card-header">
                        <h5>@lang('app.branch-dashboard.checklist-goods-report.material-in')</h5>
                    </div>
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col text-right">
                                <h4 id="total-material-out-checklist-goods-report">0</h4>
                            </div>
                        </div>
                        <div class="progress m-t-15">
                            <div class="progress-bar bg-c-green w-100"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row text-center b-t-default">
                            <div class="col-6 b-r-default m-t-15">
                                <h5 id="total-main-material-out-checklist-goods-report">0</h5>
                                <p class="text-muted m-b-0">@lang('app.branch-dashboard.checklist-goods-report.material-in-before')</p>
                            </div>
                            <div class="col-6 m-t-15">
                                <h5 id="total-sub-material-out-checklist-goods-report">0</h5>
                                <p class="text-muted m-b-0">@lang('app.branch-dashboard.checklist-goods-report.material-in-checklist-goods')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card statustic-progress-card card-shadow-custom">
                    <div class="card-header">
                        <h5>@lang('app.branch-dashboard.checklist-goods-report.material-out')</h5>
                    </div>
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col text-right">
                                <h4 id="total-goods-out-checklist-goods-report">0</h4>
                            </div>
                        </div>
                        <div class="progress m-t-15">
                            <div class="progress-bar bg-c-yellow w-100"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row text-center b-t-default">
                            <div class="col-1"></div>
                            <div class="col-2 b-r-default m-t-15">
                                <h5 id="total-food-goods-out-checklist-goods-report">0</h5>
                                <p class="text-muted m-b-0">@lang('app.branch-dashboard.checklist-goods-report.material-out-checklist-goods')</p>
                            </div>
                            <div class="col-2 b-r-default m-t-15">
                                <h5 id="total-drink-goods-out-checklist-goods-report">0</h5>
                                <p class="text-muted m-b-0">@lang('app.branch-dashboard.checklist-goods-report.material-out-quantitative')</p>
                            </div>
                            <div class="col-2 b-r-default m-t-15">
                                <h5 id="total-produce-goods-out-checklist-goods-report">0</h5>
                                <p class="text-muted m-b-0">@lang('app.branch-dashboard.checklist-goods-report.material-out-loss')</p>
                            </div>
                            <div class="col-2 b-r-default m-t-15">
                                <h5 id="total-produce-goods-out-checklist-goods-report">0</h5>
                                <p class="text-muted m-b-0">@lang('app.branch-dashboard.checklist-goods-report.material-out-return')</p>
                            </div>
                            <div class="col-2 m-t-15">
                                <h5 id="total-produce-goods-out-checklist-goods-report">0</h5>
                                <p class="text-muted m-b-0">@lang('app.branch-dashboard.checklist-goods-report.material-out-cancel')</p>
                            </div>
                            <div class="col-1"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card statustic-progress-card card-shadow-custom">
                    <div class="card-header">
                        <h5>@lang('app.branch-dashboard.checklist-goods-report.material-system')</h5>
                    </div>
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col text-right">
                                <h4 id="total-internal-out-checklist-goods-report">0</h4>
                            </div>
                        </div>
                        <div class="progress m-t-15">
                            <div class="progress-bar bg-c-blue w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card statustic-progress-card card-shadow-custom">
                    <div class="card-header">
                        <h5>@lang('app.branch-dashboard.checklist-goods-report.material-checklist-goods')</h5>
                    </div>
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col text-right">
                                <h4 id="total-other-out-checklist-goods-report">0</h4>
                            </div>
                        </div>
                        <div class="progress m-t-15">
                            <div class="progress-bar bg-dark w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card statustic-progress-card card-shadow-custom">
                    <div class="card-header">
                        <h5>@lang('app.branch-dashboard.checklist-goods-report.material-difference')</h5>
                    </div>
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col text-right">
                                <h4 id="total-other-out-checklist-goods-report">0</h4>
                            </div>
                        </div>
                        <div class="progress m-t-15">
                            <div class="progress-bar bg-danger w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-block statustic-card card-shadow-custom">
        <h4 class="sub-title font-weight-bold">@lang('app.branch-dashboard.checklist-goods-report.title-goods-checklist-goods')</h4>
        <div class="card-block row">
            <div class="col-md-4">
                <div class="card statustic-progress-card card-shadow-custom">
                    <div class="card-header">
                        <h5>@lang('app.branch-dashboard.checklist-goods-report.goods-in')</h5>
                    </div>
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col text-right">
                                <h4 id="total-material-out-checklist-goods-report">0</h4>
                            </div>
                        </div>
                        <div class="progress m-t-15">
                            <div class="progress-bar bg-c-green w-100"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row text-center b-t-default">
                            <div class="col-6 b-r-default m-t-15">
                                <h5 id="total-main-material-out-checklist-goods-report">0</h5>
                                <p class="text-muted m-b-0">@lang('app.branch-dashboard.checklist-goods-report.goods-in-before')</p>
                            </div>
                            <div class="col-6 m-t-15">
                                <h5 id="total-sub-material-out-checklist-goods-report">0</h5>
                                <p class="text-muted m-b-0">@lang('app.branch-dashboard.checklist-goods-report.goods-in-checklist-goods')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card statustic-progress-card card-shadow-custom">
                    <div class="card-header">
                        <h5>@lang('app.branch-dashboard.checklist-goods-report.goods-out')</h5>
                    </div>
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col text-right">
                                <h4 id="total-goods-out-checklist-goods-report">0</h4>
                            </div>
                        </div>
                        <div class="progress m-t-15">
                            <div class="progress-bar bg-c-yellow w-100"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row text-center b-t-default">
                            <div class="col-1"></div>
                            <div class="col-2 b-r-default m-t-15">
                                <h5 id="total-food-goods-out-checklist-goods-report">0</h5>
                                <p class="text-muted m-b-0">@lang('app.branch-dashboard.checklist-goods-report.goods-out-checklist-goods')</p>
                            </div>
                            <div class="col-2 b-r-default m-t-15">
                                <h5 id="total-drink-goods-out-checklist-goods-report">0</h5>
                                <p class="text-muted m-b-0">@lang('app.branch-dashboard.checklist-goods-report.goods-out-quantitative')</p>
                            </div>
                            <div class="col-2 b-r-default m-t-15">
                                <h5 id="total-produce-goods-out-checklist-goods-report">0</h5>
                                <p class="text-muted m-b-0">@lang('app.branch-dashboard.checklist-goods-report.goods-out-loss')</p>
                            </div>
                            <div class="col-2 b-r-default m-t-15">
                                <h5 id="total-produce-goods-out-checklist-goods-report">0</h5>
                                <p class="text-muted m-b-0">@lang('app.branch-dashboard.checklist-goods-report.goods-out-return')</p>
                            </div>
                            <div class="col-2 m-t-15">
                                <h5 id="total-produce-goods-out-checklist-goods-report">0</h5>
                                <p class="text-muted m-b-0">@lang('app.branch-dashboard.checklist-goods-report.goods-out-cancel')</p>
                            </div>
                            <div class="col-1"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card statustic-progress-card card-shadow-custom">
                    <div class="card-header">
                        <h5>@lang('app.branch-dashboard.checklist-goods-report.goods-system')</h5>
                    </div>
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col text-right">
                                <h4 id="total-internal-out-checklist-goods-report">0</h4>
                            </div>
                        </div>
                        <div class="progress m-t-15">
                            <div class="progress-bar bg-c-blue w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card statustic-progress-card card-shadow-custom">
                    <div class="card-header">
                        <h5>@lang('app.branch-dashboard.checklist-goods-report.goods-checklist-goods')</h5>
                    </div>
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col text-right">
                                <h4 id="total-other-out-checklist-goods-report">0</h4>
                            </div>
                        </div>
                        <div class="progress m-t-15">
                            <div class="progress-bar bg-dark w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card statustic-progress-card card-shadow-custom">
                    <div class="card-header">
                        <h5>@lang('app.branch-dashboard.checklist-goods-report.goods-difference')</h5>
                    </div>
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col text-right">
                                <h4 id="total-other-out-checklist-goods-report">0</h4>
                            </div>
                        </div>
                        <div class="progress m-t-15">
                            <div class="progress-bar bg-danger w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{asset('js/dashboard/branch/checklist_goods_report.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"
            type="text/javascript"></script>
@endpush
