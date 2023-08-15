<style>
#modal-profile-user-visible-message .body-profile-user-visible-message {
    margin: 0;
}

#modal-profile-user-visible-message #background-profile-user-visible-message {
    width: 100%;
    height: 125px;
    object-fit: cover;
}
#modal-profile-user-visible-message #box-view-profile-user-visible-message {
    display: flex;
    justify-content: center;
}

#modal-profile-user-visible-message #avatar-profile-user-visible-message {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 50%;
    position: absolute;
    top: 83px;
    border: 2px solid #fff;
}

#modal-profile-user-visible-message .infor-profile-user-visible-message {
    position: relative;
    top: 38px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

#modal-profile-user-visible-message .name-contain-profile {
    display: flex;
    justify-content: center;
    align-items: center;
    width: auto;
    max-width: 200px;
    position: relative;
}

#modal-profile-user-visible-message .name-profile-user-visible-message {
    color: #fa6342;
    display: inline-block;
    font-size: 16px !important;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: auto;
    max-width: 200px;
    margin: 0 auto;
    padding: 5px;
    border-radius: 5px;
    font-weight: 500;
}

#modal-profile-user-visible-message .update-profile-user-visible-message {
    background-color: #d8d8d8ba;
    border-radius: 100%;
    position: absolute;
    height: 24px;
    padding: 5px 6px;
    margin: 3px;
    position: absolute;
    right: -26px;
    display: flex;
    align-items: center;
}

#modal-profile-user-visible-message .save-profile-user-visible-message {
    background-color: #d8d8d8ba;
    border-radius: 100%;
    position: absolute;
    top: 4px;
    right: -34px;
    height: 27px;
    padding: 0 5px;
    margin: 3px;
    display: flex;
    justify-content: center;
    align-items: center;
}

#modal-profile-user-visible-message .header-modal-profile {
    height: 40px;
    display: flex;
    align-items: center;
}

#modal-profile-user-visible-message .title-head-modal-profile {
    font-size: 16px !important;
    font-weight: 500;
    padding-left: 12px;
}

#modal-profile-user-visible-message .action-body-profile-user-visible-message {
    display: flex;
    justify-content: center;
    height: 40px;
    align-items: center;
}

#modal-profile-user-visible-message .action-body-profile-user-visible-message span{
    padding: 0px 50px 0px 50px;
    font-size: 14px !important;
    font-weight: 500;
}

#modal-profile-user-visible-message .title-content-profile{
    padding: 10px 0px 5px 10px;
    font-size: 14px !important;
    font-weight: 500;
}

#modal-profile-user-visible-message .content-left-infor p{
    font-size: 14px !important;
    color: #989898;
    padding: 5px 0px 5px 10px;
}

#modal-profile-user-visible-message .content-right-infor p{
    font-size: 14px !important;
    padding: 5px 0px 5px 35px;
}

#modal-profile-user-visible-message .image-list-grid{
    width: 80px;
    height: 80px;
    margin: auto;
    overflow: hidden;
    border-radius: 4px;
    position: relative;
}

#modal-profile-user-visible-message .image-list-grid img{
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 4px;
}

#modal-profile-user-visible-message .status-contact-profile-user-visible-message{
    padding: 5px;
}

#modal-profile-user-visible-message .nav-option-footer-profile-user-visible-message{
    padding: 8px 0px 8px 5px;
    font-size: 14px !important;
    cursor: pointer;
}

#modal-profile-user-visible-message .action-profile-user-option-icon{
    border-radius: 50%;
    cursor: pointer;
    font-size: 18px !important;
    color: #989898;
    margin-right: 8px;
    width: 22px;
    height: 22px;
}

#modal-profile-user-visible-message #close-modal-profile-user-visible-message {
    position: absolute;
    right: 10px;
    padding: 3px;
    cursor: pointer;
    border-radius: 4px;
}


</style>
<div class="modal fade show" id="modal-profile-user-visible-message">
    <div class="modal-dialog" style="display: flex;justify-content: center;">
        <div class="modal-content" style="width: 350px;border-radius: 1%;">
            <div class="header-modal-profile">
                <p class="title-head-modal-profile">Thông tin tài khoản</p>
                <i class="ti-close" id="close-modal-profile-user-visible-message" onclick="closeModalProfileUserVisibleMessage($(this))"></i>
            </div>
            <div class="modal-body" style="padding: 0;height: 500px;">
                <div class="body-profile-user-visible-message" style="overflow: auto;">
                    <div class="main-head-profile-user-visible-message" style="height: 200px;">
                        <img id="background-profile-user-visible-message" src="http://172.16.2.255:1488/public/resource/TMS/KAIZEN/748/1359/3021/2022/10/5-10-2022/image/original/web-1664976822-croppie-img-mainimg.jpeg" data-src="/public/resource/TMS/KAIZEN/748/1359/3021/2022/10/5-10-2022/image/original/web-1664976822-croppie-img-mainimg.jpeg" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" alt="avatar">
                        <div id="box-view-profile-user-visible-message">
                            <img id="avatar-profile-user-visible-message" src="http://172.16.2.255:1488/public/resource/TMS/KAIZEN/748/1359/3021/2022/10/5-10-2022/image/original/web-1664976822-croppie-img-mainimg.jpeg" data-src="/public/resource/TMS/KAIZEN/748/1359/3021/2022/10/5-10-2022/image/original/web-1664976822-croppie-img-mainimg.jpeg" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" alt="avatar">
                            <div class="infor-profile-user-visible-message">
                                <div class="name-contain-profile">
                                    <div class="name-profile-user-visible-message" id="" data-name="">Hoàng Nhật Hiệu</div>
                                    <span class="update-profile-user-visible-message"><i class="ti-pencil"></i></span>
                                    <span class="save-profile-user-visible-message d-none"><i class="ion-ios-checkmark"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="action-body-profile-user-visible-message mb-3">
                        <span class="">Kết bạn</span>
                        <span class="">Nhắn tin</span>
                    </div>
                    <div class="content-profile-user-visible-message">
                        <p class="title-content-profile">Thông tin cá nhân</p>
                        <div class="content-profile d-flex">
                            <div class="content-left-infor">
                                <p>Điện thoại</p>
                                <p>Giới tính</p>
                                <p>Ngày sinh</p>
                            </div>
                            <div class="content-right-infor">
                                <p>0362767747</p>
                                <p>Nam</p>
                                <p>09 tháng 12, 2012</p>
                            </div>
                        </div>
                    </div>
                    <div class="content-profile-user-visible-message mb-3">
                        <p class="title-content-profile">Hình ảnh</p>
                        <div class="content-profile d-flex" style="padding: 5px;">
                            <div class="image-list-grid">
                                <img src='{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}' class="see-item-image-video-grid-img">
                            </div>
                            <div class="image-list-grid">
                                <img src="{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}" class="see-item-image-video-grid-img">
                            </div>
                            <div class="image-list-grid">
                                <img src='{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}' class="see-item-image-video-grid-img">
                            </div>
                            <div class="image-list-grid">
                                <img src="{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}" class="see-item-image-video-grid-img">
                            </div>
                        </div>
                    </div>
                    <div class="content-profile-user-visible-message">
                        <ul class="status-contact-profile-user-visible-message">
                            <li class="nav-option-footer-profile-user-visible-message"><i class="action-profile-user-option-icon fa fa-commenting-o"></i> Nhắn tin</li>
                            <li class="nav-option-footer-profile-user-visible-message"><i class="action-profile-user-option-icon fa fa-cog"></i> Chia sẻ danh thiếp</li>
                            <li class="nav-option-footer-profile-user-visible-message"><i class="action-profile-user-option-icon fa fa-list-ul"></i> Chặn tin nhắn</li>
                            <li class="nav-option-footer-profile-user-visible-message"><i class="action-profile-user-option-icon fa fa-users"></i> Báo xấu</li>
                            <li class="nav-option-footer-profile-user-visible-message"><i class="action-profile-user-option-icon fa fa-list-alt"></i> Xóa khỏi danh sách bạn bè</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
