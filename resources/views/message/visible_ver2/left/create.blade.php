<style>
    .modal{
        z-index: 1050 !important;
    }
    .seemt-container .select-material-box {
        border-bottom-left-radius: 0px !important;
        border-bottom-right-radius: 0px !important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12) !important  ;
    }
    .table-responsive{
        overflow-x: hidden !important;
    }
</style>
<div class="modal fade" id="modal-create-group-chat-visible-message">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center justify-content-between " >
                <h5 class="modal-title mt-0">Tạo nhóm</h5>
                <div class="change-content d-flex align-items-center justify-content-end">
                    <input type="checkbox" class="js-small create-group" checked data-switchery="true" style="display: none;" />
                    <i class="zmdi zmdi-label-alt tag-orange tag-work"></i>
                    <div class="popup-create-gr">Công việc</div>
                </div>
            </div>
            <div class="modal-body body-popup" style="background-color: #fff !important;">
                <div class="row-pop-ups w-100">
                    <label class="pointer avt-img">
                        <i class="fa fa-camera camera-icon"></i>
                        <input type="file" class="upload-avt d-none" accept="image/*" />
                    </label>
                    <img class="image-about upload-avt" src="{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}" data-src="" style="background-color: mediumvioletred;" />
                    <div class="input-name-add-group">
                        <input maxlength="70" type="text" class="input-name" placeholder="Nhập tên nhóm của bạn vào nhé !!" />
                        <div class="error"><span class="text-danger"></span></div>
                    </div>
                </div>
                <div class="row-pop-ups w-100" style="height: 55px !important;padding: 10px 0 0 0 !important;">
                    <div class="justify-content-start align-items-center table-responsive new-table">
                        <div class="select-filter-dataTable d-flex" style="position: unset">
                            <div class="form-validate-select ml-0">
                                <div class="pr-0 select-material-box">
                                    <select class="js-example-basic-single select-brand work-data">
                                        @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                            @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                <option value="{{$db['id']}}"
                                                        selected>{{$db['name']}}</option>
                                            @else
                                                <option value="{{$db['id']}}">{{$db['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-validate-select">
                                <div class="pr-0 select-material-box">
                                    <select class="js-example-basic-single select-branch">
                                        @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', ENUM_SELECTED)->all() as $db)
                                            @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])
                                                <option value="{{$db['id']}}"
                                                        selected>{{$db['name']}}</option>
                                            @else
                                                <option value="{{$db['id']}}">{{$db['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
{{--                <span class="option-work d-flex" style="margin: 0 10px 0 10px; font-size: 14px !important;">--}}
{{--                    Chọn bộ phận <i class="fa fa-exclamation-circle ml-1 mt-1" data-toggle="tooltip" data-placement="top" data-original-title="Nhân viên thuộc bộ phận được chọn sẽ tự động được thêm vào nhóm"></i>--}}
{{--                </span>--}}
{{--                <div class="option-work row-pop-ups d-none">--}}
{{--                    <div id="data-role-create-group-chat-visible-message"></div>--}}
{{--                </div>--}}
                <div class="row-pop-ups">
                    <input id="search-member-create-group"   class="input-name input-search" placeholder="Nhập tên, số điện thoại, hoặc danh sách số điện thoại" />
                    <i class="ti-search module-search"  ></i>
                </div>
                <div class="row-list-user d-flex">
                    <div class="user-list-create transition_user_active">
                        <div class="select-friend">Chọn nhân viên</div>
{{--                        <div class="user-list-create"></div>--}}
                    </div>

                    <div class="create-group-right transition-active-hiden">
                        <div class="select-friend select-friend-right"></div>
                    </div>
                </div>
            </div>
            <div class="create-group__list-check">
                <div class="error-select-user"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-inverse" onclick="closeModalCreateConversationVisibleMessage()">Đóng</button>
                <button type="button" class="btn btn-grd-primary" onclick="createConversation()">Tạo nhóm</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-employee-visible-message">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Danh sách nhân viên</h5>
                <div class="search-layout-body">
                    <input class="search-text-layout-body" type="text" placeholder="Tìm nhân viên" id="search-employee-visible-message" />
                    <a href="javascript:void(0)" class="search-button-layout-body"><i class="fa fa-search"></i></a>
                </div>
            </div>
            <div class="modal-body body-popup">
                <div class="card-block owl-carousel row" id="data-employee-visible-message" style="max-height: 50vh; overflow-y: auto;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-inverse" onclick="closeModalEmployeeVisibleMessage()">Đóng</button>
            </div>
        </div>
    </div>
</div>
