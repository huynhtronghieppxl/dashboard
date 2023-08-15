<div class="modal image-manage-modal fade" id="modal-album-photo" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document" style="height: 86%">
        <div class="modal-content">
            <div class="image-management-container">
                <div class="modal-body d-flex image-management-wrapper">
                    <button type="button" class="close-btn close" aria-label="Close" onclick="closeMoalAlbumPhoto()">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 14px; left: 13px;">
                            <path d="M1 0.833313L13 12.8333" stroke="#4F4F4F" stroke-width="2"></path>
                            <path d="M13 0.833313L1 12.8333" stroke="#4F4F4F" stroke-width="2"></path>
                        </svg>
                    </button>
                    <div class="driver-left-col react-draggable" style="position: relative; user-select: auto; width: 284px; height: 100%; display: inline-block; top: 0; left: 0; cursor: auto; transform: translate(0px, 0); max-width: 450px; max-height: 9.0072e+15px; min-width: 284px; box-sizing: border-box; flex-shrink: 0;">
                        <div class="image-management-nav">
                            <div class="image-management-title">
                                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="25" cy="25" r="25" fill="#F4FAFF"></circle>
                                    <path opacity="0.5" d="M35.5211 34.2596L14.6941 37.2004C13.0576 37.4315 11.5297 36.2817 11.2986 34.6453L9.19804 19.7688C8.96698 18.1324 10.1168 16.6044 11.7532 16.3734L32.5803 13.4325C34.2167 13.2015 35.7446 14.3513 35.9757 15.9877L38.0763 30.8642C38.3073 32.5006 37.1575 34.0285 35.5211 34.2596Z" fill="#0088FF" fill-opacity="0.55"></path>
                                    <path d="M37.488 35.5129L16.5901 33.1268C15.2225 32.9706 14.2295 31.7216 14.3857 30.354L16.09 15.4269C16.2462 14.0593 17.4952 13.0663 18.8628 13.2224L39.7607 15.6085C41.1283 15.7647 42.1213 17.0137 41.9652 18.3813L40.2608 33.3084C40.1046 34.676 38.8556 35.669 37.488 35.5129Z" fill="white" stroke="#0088FF"></path>
                                    <path d="M35.1483 22.8956C36.3848 23.0368 37.5018 22.1488 37.643 20.9122C37.7842 19.6756 36.8962 18.5586 35.6596 18.4174C34.423 18.2762 33.306 19.1642 33.1648 20.4008C33.0237 21.6374 33.9117 22.7544 35.1483 22.8956Z" fill="#0FD186"></path>
                                    <path d="M33.7236 26.7161L28.1232 32.2604L37.9301 33.3802L33.7236 26.7161Z" fill="#87E8C3"></path>
                                    <path d="M25.3316 21.196L16.8153 30.9693L31.4255 32.6375L25.3316 21.196Z" fill="#0FD186"></path>
                                </svg>
                                <span>Kho hình ảnh</span>
                            </div>
                            <div class="wrap-btn">
                                <input type="file" id="input file" accept=".gif, .jpg, .png, .jpeg" multiple="" style="display: none;">
                                <div data-tip="true" data-for="disable-uploaded">
                                    <div class="button-add-folder-or-image2 undefined">
                                        <div class="btn-add-folder-or-image-dropdown " data-tip="true" data-for="button-add-folder-or-image-tooltip">
                                            <div class="div-current-add-folder-or-image ">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 2V22" stroke="#0084FF" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M2 12H22" stroke="#0084FF" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                <span>Thêm mới</span>
                                            </div>
                                            <div class="list-btn-add-folder-or-image d-none "><span class="caret-down"></span></div>
                                        </div>
                                        {{-- <div class="drop-btn-add-folder-or-image ">
                                            <div class="" data-tip="true" data-for="disable-uploaded">
                                                <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M23 17C23 17.5304 22.7893 18.0391 22.4142 18.4142C22.0391 18.7893 21.5304 19 21 19H3C2.46957 19 1.96086 18.7893 1.58579 18.4142C1.21071 18.0391 1 17.5304 1 17V6C1 5.46957 1.21071 4.96086 1.58579 4.58579C1.96086 4.21071 2.46957 4 3 4H7L9 1H15L17 4H21C21.5304 4 22.0391 4.21071 22.4142 4.58579C22.7893 4.96086 23 5.46957 23 6V17Z" stroke="#4F4F4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M12 15C14.2091 15 16 13.2091 16 11C16 8.79086 14.2091 7 12 7C9.79086 7 8 8.79086 8 11C8 13.2091 9.79086 15 12 15Z" stroke="#4F4F4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                <span>Tải ảnh lên</span>
                                            </div>
                                            <div class="">
                                                <svg width="21" height="19" viewBox="0 0 21 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M20 16.2C20 16.7039 19.7998 17.1872 19.4435 17.5435C19.0872 17.8998 18.6039 18.1 18.1 18.1H2.9C2.39609 18.1 1.91282 17.8998 1.5565 17.5435C1.20018 17.1872 1 16.7039 1 16.2V2.9C1 2.39609 1.20018 1.91282 1.5565 1.5565C1.91282 1.20018 2.39609 1 2.9 1H7.65L9.55 3.85H18.1C18.6039 3.85 19.0872 4.05018 19.4435 4.4065C19.7998 4.76282 20 5.24609 20 5.75V16.2Z" stroke="#4F4F4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M10.5 8.6001V14.3001" stroke="#4F4F4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M7.65039 11.4502H13.3504" stroke="#4F4F4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                <span>Tạo thư mục mới</span>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="image-management-menu list-overflow-y-auto">
                                <div class="wrap-menu-icon image-uploaded activated">
                                    <div class="scale-wrap-icon cursor-default d-flex align-items-center">
                                        <svg class=" filled-arrow" width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.103027 10.0293L5.05081 5.4719L-0.000783809 1.0299L0.103027 10.0293Z" fill="#4F4F4F"></path>
                                        </svg>
                                    </div>
                                    <span class="icon image-uploaded">
                                        <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16 14L12 10L8 14" stroke="#0084FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12 10V19" stroke="#0084FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M20.39 16.39C21.3653 15.8583 22.1358 15.0169 22.5799 13.9986C23.0239 12.9804 23.1162 11.8432 22.8422 10.7667C22.5682 9.69015 21.9435 8.73551 21.0667 8.05345C20.1898 7.37138 19.1109 7.00073 18 7H16.74C16.4373 5.82924 15.8732 4.74233 15.0899 3.82099C14.3067 2.89965 13.3248 2.16785 12.2181 1.68061C11.1113 1.19336 9.90854 0.963358 8.70011 1.00788C7.49167 1.05241 6.30906 1.3703 5.24117 1.93766C4.17328 2.50503 3.2479 3.3071 2.53461 4.28358C1.82132 5.26006 1.33868 6.38554 1.12297 7.57539C0.90726 8.76525 0.964096 9.98853 1.2892 11.1533C1.61431 12.318 2.19923 13.3939 2.99999 14.3" stroke="#0084FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                    <span>Ảnh đã tải lên</span>
                                </div>
                                <div class="folder-children1 d-none"></div>
                                <div class="wrap-menu-icon image-fb-uploaded ">
                                    <span class="icon image-fb-uploaded">
                                        <svg width="24" height="24" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M20.25 2.25H16.875C15.3832 2.25 13.9524 2.84263 12.8975 3.89752C11.8426 4.95242 11.25 6.38316 11.25 7.875V11.25H7.875V15.75H11.25V24.75H15.75V15.75H19.125L20.25 11.25H15.75V7.875C15.75 7.57663 15.8685 7.29048 16.0795 7.07951C16.2905 6.86853 16.5766 6.75 16.875 6.75H20.25V2.25Z" stroke="#4F4F4F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                    <span>Ảnh trên trang Facebook</span>
                                </div>
                                <div class="wrap-menu-icon image-recent-upload ">
                                    <span class="icon image-recent-upload">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#4F4F4F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12 6V12L16 14" stroke="#4F4F4F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                    <span>Ảnh gửi đi gần đây</span>
                                </div>
                                <div class="image-management-menu-footer">
                                    <div class="d-flex image-info">
                                        <div class="image-storage-info">
                                            <div class="wrap-menu-icon image-storage">
                                                <span class="icon image-storage">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 22px; height: 22px;">
                                                        <path d="M13.3334 1.33333H2.66671C1.93033 1.33333 1.33337 1.93028 1.33337 2.66666V5.33333C1.33337 6.06971 1.93033 6.66666 2.66671 6.66666H13.3334C14.0698 6.66666 14.6667 6.06971 14.6667 5.33333V2.66666C14.6667 1.93028 14.0698 1.33333 13.3334 1.33333Z" stroke="#4F4F4F" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M13.3334 9.33333H2.66671C1.93033 9.33333 1.33337 9.93028 1.33337 10.6667V13.3333C1.33337 14.0697 1.93033 14.6667 2.66671 14.6667H13.3334C14.0698 14.6667 14.6667 14.0697 14.6667 13.3333V10.6667C14.6667 9.93028 14.0698 9.33333 13.3334 9.33333Z" stroke="#4F4F4F" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M4 4H4.00667" stroke="#4F4F4F" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M4 12H4.00667" stroke="#4F4F4F" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </span>
                                                <span>Bộ nhớ</span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="0.002270098775625229" aria-valuemin="0" aria-valuemax="100" style="width: 0.0022701%;"></div>
                                            </div>
                                            <div class="text-progress">Đã sử dụng 0 MB/ 1GB</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="" style="position: absolute; user-select: none; width: 10px; height: 100%; top: 0; right: -5px; cursor: col-resize;"></div>
                        </div>
                    </div>
                    <div class="image-management-content" style="width: calc(100% - 285px);">
                        <div class="image-management-header">
                            <div class="header-left">
                                <span class="search-icon" style="opacity: 1;">
                                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.16667 15.8333C12.8486 15.8333 15.8333 12.8486 15.8333 9.16667C15.8333 5.48477 12.8486 2.5 9.16667 2.5C5.48477 2.5 2.5 5.48477 2.5 9.16667C2.5 12.8486 5.48477 15.8333 9.16667 15.8333Z" stroke="#0088FF" stroke-opacity="0.75" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M20 20L14 14" stroke="#0088FF" stroke-opacity="0.75" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                                <input type="text" placeholder="Tìm hình ảnh và thư mục trong thư viện" value="" style="opacity: 1;">
                            </div>
                            <div class="header-right"></div>
                        </div>
                        <div class="image-management-body tab1 ">
                            <div class="folder-path-wrapper undefined">
                                <div class="folder-path d-flex align-items-center"><span class="folder-path-item">Ảnh đã tải lên</span></div>
                            </div>
                            <div class="wrap-folder-n-image list-overflow-y-auto tab1" data-selector="scrollbar">
                                <div class="image-management-list-wrapper">
                                    <div class="imb-title image-management-list-title">
                                        <div class="title-image">Ảnh</div>
                                        <div class="d-flex checkbox-list2">
                                            <div class="checkbox-base item-checkbox"><input type="checkbox" class="checkbox-base" name="check" readonly=""><label class="checkbox-base"></label></div>
                                            <div class="checkbox-text2">Chọn tất cả hình ảnh</div>
                                        </div>
                                    </div>
                                    <div class="image-management-list image-management-list2">
                                        <div class="image-list image-list2">
                                            <div class="image tab1 ">
                                                <img src="https://social.dktcdn.net/facebook/cafe-hd/mukbang_1626943419387.jpg" alt="facebook-img">
                                                <div class="image-name" data-tip="true" data-for="image-0" currentitem="false">
                                                    <span>mukbang&nbsp;</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('js\sell_online\facebook\album-photo.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
