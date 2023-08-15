<div class="modal fade" id="modal-add-member-group-chat-visible-message">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title ml-0 mt-0 mr-0">Thêm thành viên vào nhóm</h5>
            </div>
            <div class="modal-body body-popup">
                <div class="modal-body-search-input">
                    <input class="input-name input-search"
                           placeholder="Nhập tên, số điện thoại, hoặc danh sách số điện thoại"/>
                    <i class="ti-search module-search" ></i>
                </div>
                <div class=" row-list-user d-flex">
                    <div class="user-list-create-member">
                        <div class="select-friend">Chọn nhân viên</div>
                        <div class="add-member">

                        </div>
                    </div>
                    <div class="create-add-member transition-active-hiden" id="add-member-user-group">
                        <div class="select-friend select-friend-right-about"></div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-inverse"
                        onclick="closeModalAddMemberConversationVisibleMessage()">Đóng
                </button>
                <button type="button" class="btn btn-grd-primary"
                        onclick="saveModalAddMemberConversationVisibleMessage()">Thêm
                </button>
            </div>
        </div>
    </div>
</div>
