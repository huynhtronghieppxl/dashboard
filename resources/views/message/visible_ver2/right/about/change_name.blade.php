
<style>

    .modal-body > input[type="text"] {
        font-size: 14px !important;
    }

    .modal-body > .question-vote-visible-message > input,
    .votes-group-visible-message > .vote-option-visible-message > input {
        border: 1px solid #e9ecef;
        border-radius: 4px;
        width: 100%;
        height: 35px;
        margin-bottom: 5px;
        padding: 0 30px 0 5px;
        color: #585858;
    }
    .modal-body > .question-vote-visible-message > input:focus,
    .votes-group-visible-message > .vote-option-visible-message > input:focus {
        border: 1px solid #0068ff;
    }
</style>
<div class="modal fade show" id="modal-change-name-group-chat-visible-message">
    <div class="modal-dialog modal-md">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Đổi tên nhóm</h5>
            </div>
            <div class="modal-body">
                <div class="question-vote-visible-message">
                    <div class="title-vote-visible-message">Bạn có chắc muốn đổi tên nhóm , khi xác nhận tên nhóm mới sẽ hiển thị với tất cả thành viên
                    </div>
                    <input type="text" id="change-name-group"  id="title-vote-visible-message">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-inverse" onclick="closeModalChangeNameVisibleMessage()">Đóng</button>
                <button id="confirm-change-name-group" type="button" class="btn btn-grd-primary"  onclick="saveModalChangeNameVisibleMessage()">Xác nhận</button>
            </div>
        </div>
    </div>
</div>


