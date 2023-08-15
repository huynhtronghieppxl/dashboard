<style>
    .checkbox-zoom.zoom-warning > label > .cr {
        border-radius: 50%;
    }

    .checkbox-zoom.zoom-warning > label > input:checked ~ .cr {
        background-color: #0068ff;
    }

    .checkbox-zoom.zoom-warning > label > input:checked ~ .cr i {
        color: #fff;
    }

    .checkbox-zoom.zoom-warning > label {
        margin: 10px 0;
        width: 100%;
    }

    .checkbox-zoom.zoom-warning {
        border-top: 1px solid #e9ecef;
    }

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

    .vote-option-visible-message {
        position: relative;
        display: flex;
        /*align-items: center;*/
    }

    .vote-option-visible-message > i {
        position: absolute;
        right: 7px;
        top: 7px;
        padding: 3px;
        cursor: pointer;
        border-radius: 4px;
    }

    .vote-option-visible-message > i:hover {
        background-color: #e8eaef;
    }

    .alert-empty-option-vote {
        position: absolute;
        bottom: 28%;
        left: 50px;
        z-index: 9;
        width: 80%;
        height: 40px;
        color: #fff;
        background-color: #000000c9;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
    }

    .add-vote-visible-message {
        padding: 5px;
        margin-bottom: 5px;
        border-radius: 4px;
        color: #0068ff;
        width: fit-content;
        cursor: pointer;
    }

    .add-vote-visible-message:hover {
        background-color: #e8eaef;
    }

    .vote-setting-visible-message {
        padding: 10px 0;
        color: #ffa233;
        display: flex;
        flex-direction: row;
        align-items: center;
        position: relative;
    }

    .modal-body > .vote-setting-visible-message > div {
        color: black;
        padding-left: 5px;
    }

    .modal-body > .vote-setting-visible-message > i:last-child {
        position: absolute;
        right: 5px;
        color: black;
    }

    .modal-body > div {
        margin-left: 8px;
        margin-right: 8px;
    }

    .modal-header .switch {
        position: absolute;
        right: 0;
        top: 0;
        width: 35px;
        height: 18px;
    }

    .modal-header .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .modal-header .switch input:checked + .modal-header .slider:before {
        transform: translateX(16px);
    }

    .modal-header .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
    }

    .modal-header .slider:before {
        position: absolute;
        content: "";
        height: 14px;
        width: 14px;
        left: 3px;
        bottom: 2px;
        background-color: white;
    }

    .modal-header input:checked + .modal-header .slider {
        background-color: #2ECC71;
    }

    .modal-header .slider.round {
        border-radius: 34px;
    }

    .modal-header .slider.round:before {
        border-radius: 50%;
    }

    .multiple-vote,
    .multiple-add-vote {
        position: relative;
    }

    .child-vote-setting-slide-hidden > div {
        margin-bottom: 10px;
    }

    .title-vote-visible-message {
        margin-top: 10px;
        margin-bottom: 8px;
        font-weight: 400;
    }

    .fr-settings {
        float: right;
    }

    .tooltipMenu-settings.rightSide-settings ul {
        margin: 0;
        padding: 0;
    }

    .tooltip-settings {
        display: inline-block;
        padding: 10px;
        position: relative;
        cursor: pointer;
        border-radius: 4px;
    }

    .tooltip-settings:hover {
        background-color: #e8eaef;
    }

    .tooltipMenu-settings {
        border: 1px solid #0d77b6;
    }

    .tooltipMenu-settings ul li {
        display: inline-block;
        padding: 10px 20px 10px 20px;
        font-size: 15px;
        width: 100%;
        background: #fff;
    }

    .tooltipMenu-settings ul li:hover {
        background: #e8eaef;
        cursor: pointer;
    }


    .tooltipMenu-settings {
        visibility: hidden;
        position: absolute;
        width: 350px;
        z-index: 1;
    }

    .tooltip-settings:hover .tooltipMenu-settings {
        visibility: visible;
        cursor: pointer;
    }

    .rightSide-settings {
        left: 55px;
        top: 0;
    }

    .tooltipMenu-settings::after {
        content: " ";
        position: absolute;
        border-width: 10px;
        border-style: solid;
    }

    .rightSide-settings.tooltipMenu-settings::after {
        left: -30px;
        top: 0;
        border-color: transparent;
        height: 100%;
        width: 30px;
    }

    .tooltip-settings > i {
        font-size: 18px;
        margin: 0;
        color: #72808e;
    }

    .expiry-vote > span {
        margin-left: 10px;
    }

    .display-inline {
        display: inline-block;
    }

    #modal-detail-vote-visible-message .item-vote {
        margin: 0;
        height: 30px;
        padding: 0;
        position: relative;
    }

    #modal-detail-vote-visible-message .div-vote {
        position: relative;
        background: #b3d8ff;
        height: 100%;
        border-radius: 4px;
        left: 0;
        top: 0;
    }

    #modal-detail-vote-visible-message .count-vote {
        top: calc(50% - 10px);
        position: absolute;
        display: inline-block;
        right: 8px;
        line-height: normal;
        font-weight: 600;
        text-align: left;
        font-size: 14px;
        letter-spacing: normal;
    }

    #modal-detail-vote-visible-message .item-detail-vote {
        margin: 5px 0;
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    #modal-detail-vote-visible-message .users-thumb-list img {
        width: 25px;
        height: 25px;
    }

    #modal-detail-vote-visible-message .content-vote {
        position: absolute;
        top: 4px;
        left: 4px;
    }

    .div-item-vote {
        width: calc(100% - 80px);
    }

    .icon-vote-more {
        background-color: #e3e3e3;
        padding: 5px 2px;
        border-radius: 100%;
    }

    .icon-vote-more i {
        font-size: 20px;
    }

    .vertical-middle {
        vertical-align: middle;
    }

    #list-option-detail-vote-visible-message {
        position: relative;
        max-height: 40vh;
        overflow-y: scroll
    }

    #list-option-detail-vote-visible-message::-webkit-scrollbar {
        width: 3px;
    }

    .option-detail-vote-option-visible-message {
        display: inline-block;
        width: calc(100% - 80px);
        position: relative;
    }

    .option-detail-vote-option-visible-message > input {
        border: 1px solid #e9ecef;
        border-radius: 4px;
        width: 100%;
        height: 35px;
        margin-bottom: 5px;
        padding: 0 30px 0 5px;
        color: #585858;
    }

    .option-detail-vote-option-visible-message > i {
        position: absolute;
        right: 10px;
        padding: 3px;
        cursor: pointer;
        border-radius: 4px;
        top: 7px;
    }
</style>
<div class="modal fade show" id="modal-vote-visible-message">
    <div class="modal-dialog modal-md">
        <div class="alert-empty-option-vote d-none">
            Phải có ít nhất 2 lựa chọn
        </div>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tạo bình chọn</h5>
                <div class="tooltip-settings"><i class="fa fa-cog"></i>
                    <div class="tooltipMenu-settings rightSide-settings" id="setting-vote-visible-message">
                        <ul>
                            <li>
                                <div class="expiry-vote">
                                    <div>Thời hạn bình chọn</div>
                                    <span>Không giới hạn thời gian</span>
                                </div>
                            </li>
                            <li>
                                <div class="multiple-vote">
                                    <div>Cho phép chọn nhiều phương án</div>
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="multiple-add-vote">
                                    <div>Cho phép thêm phương án</div>
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="question-vote-visible-message">
                    <div class="title-vote-visible-message">Chủ đề bình chọn</div>
                    <input type="text" placeholder="Đặt câu hỏi bình chọn" id="title-vote-visible-message">
                </div>
                <div class="title-vote-visible-message">Các lựa chọn</div>
                <div class="votes-group-visible-message" id="list-votes-visible-message">
                    <div class="vote-option-visible-message flex-column">
                        <input class="empty-input-vote" type="text" placeholder="Nhập lựa chọn">
                        <p class="option-exist-vote mb-1 seemt-red d-none">Lựa chọn được thêm đã tồn tại</p>
                    </div>
                    <div class="vote-option-visible-message flex-column">
                        <input class="empty-input-vote" type="text" placeholder="Nhập lựa chọn">
                        <p class="option-exist-vote mb-1 seemt-red d-none">Lựa chọn được thêm đã tồn tại</p>
                    </div>
                </div>
                <div class="add-vote-visible-message pl-0" id="add-vote-visible-message">
                    + Thêm phương án
                </div>
                <div class="checkbox-zoom zoom-warning">
                    <label>
                        <input type="checkbox" id="pin-vote-visible-message">
                        <span class="cr">
                            <i class="cr-icon icofont icofont-ui-check txt-warning"></i>
                        </span>
                        <span>Ghim lên đầu trò chuyện</span>
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-inverse" onclick="closeModalVoteVisibleMessage()">Đóng</button>
                <button type="button" class="btn btn-grd-primary disabled" disabled onclick="saveModalVoteVisibleMessage()">Tạo bình chọn</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade show" id="modal-detail-vote-visible-message" style="background: transparent">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bình chọn</h5>
            </div>
            <div class="modal-body">
                <div class="title-message-vote" id="title-detail-vote-visible-message"></div>
                <div class="member-message-vote"><span id="user-detail-vote-visible-message"></span></div>
                <div style="text-align: center;font-size: 11px;color: #959595;" id="user-create-detail-vote-visible-message"></div>
                <div id="list-option-detail-vote-visible-message">

                </div>
                <div class="add-vote-visible-message" id="add-detail-vote-visible-message">
                    + Thêm phương án
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-inverse" onclick="closeModalDetailVoteVisibleMessage()">Đóng
                </button>
                <button type="button" class="btn btn-grd-primary d-none" onclick="saveModalDetailVoteVisibleMessage()">
                    Xác nhận
                </button>
            </div>
        </div>
    </div>
</div>
