<div class="modal fade" id="modal-import-quantitative-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-lg-8">
                    <h3 class="modal-title text-bold font-weight-bold">Thêm định lượng món ăn</h3>
                </div>
                <div class="col-lg-4" >
                    <div class="form-group select2_theme mb-0">
                            <div class="col-lg-12 pr-0 select-material-box">
                                <select class="js-example-basic-single select2-hidden-accessible" id="branch-import-quantitative-data" data-select="1">
                                    <option value="" disabled selected>@lang('app.quantitative-data.select-branch')</option>
                                    @if(Session::get(SESSION_KEY_PERMISSION_TALLEST) > 1)
                                        @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all() as $db)
                                            @if(Session::get(SESSION_KEY_BRANCH_ID) === $db['id'])
                                                <option value="{{$db['id']}}" selected>{{$db['name']}}</option>
                                            @else
                                                <option value="{{$db['id']}}">{{$db['name']}}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value="{{Session::get(SESSION_JAVA_ACCOUNT)['branch_id']}}" selected>{{Session::get(SESSION_JAVA_ACCOUNT)['branch_name']}}</option>
                                    @endif
                                </select>
                                <div class="line"></div>
                            </div>
                        <div class="link-href"></div>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="tab-content tabs-left-content px-3 d-flex">
                    <div id="tab1-import-quantitative-data" class="tab d-flex flex-column w-100">
                         Chọn dữ liệu định lượng món ăn đã chuẩn bị sẵn để nhập vào
                        <div class="d-flex py-2">
                            <div class="file-upload-js input-group mr-1">
                                <input type="file" name="files-upload" id="files-upload-quantitative-data" class="files-upload d-none">
                                <span class="form-control file-upload-name-js"><span style="color: grey !important;">Chưa có tệp được chọn</span></span>
                                <label for="files-upload-quantitative-data" class="btn btn-grd-disabled mb-0">Chọn</label>
                            </div>
                            <button class="btn btn-grd-warning float-right border-radius-20" onclick="checkModalImportQuantitativeData()">Kiểm tra dữ liệu</button>
                        </div>
                        <label>@lang('app.food_data.inport.title-download')&nbsp;<a
                                class="text-primary text-decoration-underline"
                                href="{{asset('js/build_data/kitchen/quantitative/Mẫu thêm mới định lượng món.xlsx')}}"
                                download>@lang('app.food_data.inport.btn-download')</a></label>
                    </div>
                    <div class="tab d-none" id="tab2-import-quantitative-data">
                        <div class="form-group row">
                            <div class="table-responsive">
                                <div class="col-lg-12">
                                    <table class="table table-bordered" id="edit-review-quantitative-import">
                                        <thead>
                                        <tr>
                                            <th>Mã món</th>
                                            <th>Mã nguyên liệu</th>
                                            <th>Số lượng</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled waves-effect " onclick="closeModalImportQuantitativeData()" onkeypress="closeModalImportQuantitativeData()" title="@lang('app.component.title-button.close')">@lang('app.component.button.close')</button>
                <button type="button" class="btn btn-grd-primary waves-effect waves-light d-none" id="previous-import-quantitative-data" onclick="previousModalImportQuantitativeData()" onkeypress="previousModalImportQuantitativeData()" title="@lang('app.component.title-button.previous')">@lang('app.component.button.previous')<span class="icofont icofont-arrow-left"></span></button>
                <button type="button" class="btn btn-grd-primary waves-effect waves-light" id="next-import-quantitative-data" onclick="nextModalImportQuantitativeData()" onkeypress="nextModalImportQuantitativeData()" title="@lang('app.component.title-button.next')">@lang('app.component.button.next')<span class="icofont icofont-arrow-right"></span></button>
                <button type="button" class="btn btn-grd-primary waves-effect waves-light d-none" id="save-import-quantitative-data" onclick="saveModalImportQuantitativeData()" onkeypress="saveModalImportQuantitativeData()" title="@lang('app.component.title-button.save')">@lang('app.component.button.save')<span class="icofont icofont-arrow-right"></span></button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/kitchen/quantitative/import_excel.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
