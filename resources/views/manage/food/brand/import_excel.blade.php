<div class="modal fade" data-keyboard="false" data-backdrop="static" id="import-food-data-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="content-modal">
            <div class="modal-header">
                <div class="col-lg-8">
                    <h3 class="modal-title text-bold font-weight-bold">Thêm món ăn</h3>
                </div>
            </div>
            <div class="modal-body background-body-color text-left">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-block">
                            <div class="tab-content tabs-left-content card-block">
                                <div id="tab1" class="tab">
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            Chọn dữ liệu món ăn đã chuẩn bị sẵn để nhập vào
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-8">
                                            <label class="file-upload-js input-group">
                                                <input type="file" name="files-upload" id="files-upload-food-data" class="files-upload d-none" >
                                                <span class="form-control file-upload-name-js"><span class="text-default">Chưa có tệp được chọn</span></span>
                                                <button class="btn btn-grd-disabled file-upload-submit-js">Chọn</button>
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <button class="btn btn-grd-disabled float-right" id="check_file">Kiểm tra dữ liệu</button>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            @lang('app.food_data.inport.title-download')&nbsp;
                                            <a class="text-primary text-decoration-underline" href="/file/template">@lang('app.food_data.inport.btn-download')</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab d-none" id="tab2">
                                    <div class="form-group row">
                                        <div class="table-responsive">
                                            <div class="col-lg-12">
                                                <table class="table table-bordered table-tabs-edit-excel" id="edit-review-food-import">
                                                    <thead>
                                                    <tr>
                                                        <th>Mã món</th>
                                                        <th>Tên món</th>
                                                        <th>Giá</th>
                                                        <th>Đơn vị</th>
                                                        <th>Điểm quy đổi</th>
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
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled waves-effect" onclick="closeModalImportFoodManage()" title="@lang('app.component.title-button.close')">Đóng</button>
                <button type="button" class="btn btn-primary waves-effect waves-light previous-tab d-none">Quay lại</button>
                <button type="button" class="btn btn-primary waves-effect waves-light next-tab d-none" onclick="savefood()"> Thêm món</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/food/brand/import_exel.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
