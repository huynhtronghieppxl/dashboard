@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        {{-- <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>@lang('app.facebook_auth.title')</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="/"> <i class="feather icon-home"></i> </a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="">@lang('app.facebook_auth.breadcrumb')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="page-body">
            <div id="app" style="height: 100%;">
                <div style="height: 100%; position: relative; overflow: hidden;">
                   <div class="top-bar d-flex justify-content-between align-items-center top-bar-body">
                      <div class="top-bar_list d-flex align-items-center" style="height: 72px;">
                         <div class=" d-flex justify-content-between align-items-center top-bar-setting" style="width: 100%;">
                            <div class="align-items-center top_bar_auto_order_redirect pad-left">
                               <h1>
                                  <a style="cursor: pointer;">
                                     <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.5 15L7.5 10L12.5 5" stroke="#4F4F4F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                     </svg>
                                     <span>Danh sách kịch bản livestream</span>
                                  </a>
                               </h1>
                               <div class="current"><h4>Thêm mới kịch bản</h4></div>
                               <div class="progress-side">
                                  <div class="div-box-process tlc"></div>
                                  <div class="div-box-process mdh"></div>
                                  <div class="div-box-process cb"></div>
                                  <div class="div-box-process auto-rep"></div>
                                  <div class="div-box-process noti-rep"></div>
                                  <div class="div-box-process submit-auto"></div>
                                  <div class="d-flex progress-title"><span>Thiết lập chung</span><span>Tạo từ khóa</span><span>Tạo cú pháp</span><span>Trả lời tự động</span><span>Thông báo</span><span>Kích hoạt</span></div>
                                  <div class="d-flex progress-value">
                                     <div class="fix fix-1">
                                        <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                           <circle cx="14.5" cy="14" r="13.5" fill="#0088FF" stroke="white"></circle>
                                           <path d="M7.15625 12.8497L12.8189 18.5124L21.8437 9.48755" stroke="white" stroke-width="2"></path>
                                        </svg>
                                     </div>
                                     <div class="progress-line progress-line-1 activated"></div>
                                     <div class="fix fix-2">
                                        <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                           <circle cx="14.5" cy="14" r="13.5" fill="#0088FF" fill-opacity="0.1" stroke="#2F80ED"></circle>
                                           <path d="M17.9375 19H11.2451V17.8584L14.5605 14.2422C15.0391 13.709 15.3786 13.2646 15.5791 12.9092C15.7842 12.5492 15.8867 12.1891 15.8867 11.8291C15.8867 11.3551 15.7523 10.9723 15.4834 10.6807C15.2191 10.389 14.8613 10.2432 14.4102 10.2432C13.8724 10.2432 13.4554 10.4072 13.1592 10.7354C12.863 11.0635 12.7148 11.5124 12.7148 12.082H11.0537C11.0537 11.4759 11.1904 10.9313 11.4639 10.4482C11.7419 9.96061 12.1361 9.58236 12.6465 9.31348C13.1615 9.0446 13.7539 8.91016 14.4238 8.91016C15.39 8.91016 16.151 9.15397 16.707 9.6416C17.2676 10.1247 17.5479 10.7946 17.5479 11.6514C17.5479 12.1481 17.4066 12.6699 17.124 13.2168C16.846 13.7591 16.388 14.3766 15.75 15.0693L13.3164 17.6738H17.9375V19Z" fill="#0088FF"></path>
                                        </svg>
                                     </div>
                                     <div class="progress-line progress-line-2 "></div>
                                     <div class="fix fix-3">
                                        <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                           <circle cx="14.7668" cy="14.9614" r="14" fill="#E0E0E0" fill-opacity="1" stroke=""></circle>
                                           <path d="M13.4329 14.2261H14.4446C14.955 14.2215 15.3583 14.0894 15.6545 13.8296C15.9553 13.5698 16.1057 13.1938 16.1057 12.7017C16.1057 12.2277 15.9804 11.8608 15.7297 11.6011C15.4836 11.3368 15.1054 11.2046 14.595 11.2046C14.1484 11.2046 13.7815 11.3345 13.4944 11.5942C13.2073 11.8494 13.0637 12.1844 13.0637 12.5991H11.4026C11.4026 12.0887 11.537 11.6239 11.8059 11.2046C12.0793 10.7853 12.4576 10.4595 12.9407 10.2271C13.4283 9.99007 13.9729 9.87158 14.5745 9.87158C15.568 9.87158 16.3472 10.1222 16.9124 10.6235C17.482 11.1203 17.7668 11.813 17.7668 12.7017C17.7668 13.1483 17.6233 13.5698 17.3362 13.9663C17.0536 14.3582 16.6868 14.6545 16.2356 14.855C16.7825 15.0418 17.1972 15.3358 17.4797 15.7368C17.7668 16.1379 17.9104 16.6164 17.9104 17.1724C17.9104 18.0656 17.6028 18.7765 16.9875 19.3052C16.3769 19.8338 15.5725 20.0981 14.5745 20.0981C13.6174 20.0981 12.8336 19.8429 12.2229 19.3325C11.6122 18.8221 11.3069 18.1431 11.3069 17.2954H12.968C12.968 17.7329 13.1139 18.0884 13.4055 18.3618C13.7017 18.6353 14.0982 18.772 14.595 18.772C15.1099 18.772 15.5155 18.6353 15.8118 18.3618C16.108 18.0884 16.2561 17.6919 16.2561 17.1724C16.2561 16.6483 16.1012 16.245 15.7913 15.9624C15.4814 15.6799 15.0211 15.5386 14.4104 15.5386H13.4329V14.2261Z" fill="#4F4F4F"></path>
                                        </svg>
                                     </div>
                                     <div class="progress-line progress-line-3 "></div>
                                     <div class="fix fix-4">
                                        <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                           <circle cx="14.812" cy="14.9614" r="14" fill="#E0E0E0" fill-opacity="1" stroke=""></circle>
                                           <path d="M16.1763 16.4136H17.4136V17.7466H16.1763V19.9614H14.5151V17.7466H10.2153L10.1675 16.7349L14.4604 10.0083H16.1763V16.4136ZM11.9106 16.4136H14.5151V12.2573L14.3921 12.4761L11.9106 16.4136Z" fill="#4F4F4F"></path>
                                        </svg>
                                     </div>
                                     <div class="progress-line progress-line-4 "></div>
                                     <div class="fix fix-5">
                                        <svg width="28" height="29" viewBox="0 0 28 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                           <circle cx="14" cy="14.9421" r="14" fill="#E0E0E0" fill-opacity="1" stroke=""></circle>
                                           <path d="M11.1895 15.0066L11.7295 9.98901H17.0752V11.4246H13.1104L12.8369 13.8035C13.2972 13.5391 13.8167 13.407 14.3955 13.407C15.3434 13.407 16.0794 13.71 16.6035 14.3162C17.1322 14.9223 17.3965 15.738 17.3965 16.7634C17.3965 17.7751 17.1048 18.5818 16.5215 19.1833C15.9382 19.7804 15.1383 20.0789 14.1221 20.0789C13.2106 20.0789 12.4541 19.8214 11.8525 19.3064C11.2555 18.7869 10.932 18.1033 10.8818 17.2556H12.4883C12.5521 17.7387 12.7253 18.1101 13.0078 18.3699C13.2904 18.6251 13.6595 18.7527 14.1152 18.7527C14.6257 18.7527 15.0221 18.5704 15.3047 18.2058C15.5918 17.8412 15.7354 17.3445 15.7354 16.7156C15.7354 16.1095 15.5781 15.6309 15.2637 15.28C14.9492 14.9246 14.5163 14.7468 13.9648 14.7468C13.6641 14.7468 13.4089 14.7878 13.1992 14.8699C12.9896 14.9473 12.7617 15.1023 12.5156 15.3347L11.1895 15.0066Z" fill="#4F4F4F"></path>
                                        </svg>
                                     </div>
                                     <div class="progress-line progress-line-5 "></div>
                                     <div class="fix fix-6">
                                        <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                           <circle cx="14.5" cy="14" r="14" fill="#E0E0E0" fill-opacity="1" stroke=""></circle>
                                           <path d="M16.4131 8.99902V10.373H16.208C15.2783 10.3867 14.5355 10.6419 13.9795 11.1387C13.4235 11.6354 13.0931 12.3395 12.9883 13.251C13.5215 12.6904 14.2028 12.4102 15.0322 12.4102C15.9118 12.4102 16.6045 12.7201 17.1104 13.3398C17.6208 13.9596 17.876 14.7594 17.876 15.7393C17.876 16.751 17.5775 17.5713 16.9805 18.2002C16.388 18.8245 15.6087 19.1367 14.6426 19.1367C13.6491 19.1367 12.8424 18.7699 12.2227 18.0361C11.6074 17.3024 11.2998 16.3408 11.2998 15.1514V14.584C11.2998 12.8385 11.7236 11.4714 12.5713 10.4824C13.4235 9.49349 14.6471 8.99902 16.2422 8.99902H16.4131ZM14.6289 13.75C14.2643 13.75 13.9294 13.8525 13.624 14.0576C13.3232 14.2627 13.1022 14.5361 12.9609 14.8779V15.3838C12.9609 16.1221 13.1159 16.71 13.4258 17.1475C13.7357 17.5804 14.1367 17.7969 14.6289 17.7969C15.1211 17.7969 15.5107 17.6123 15.7979 17.2432C16.085 16.874 16.2285 16.3887 16.2285 15.7871C16.2285 15.1855 16.0827 14.6956 15.791 14.3174C15.4993 13.9391 15.112 13.75 14.6289 13.75Z" fill="#4F4F4F"></path>
                                        </svg>
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                      <div class="user user-avatar-for-tooltip" style="cursor: pointer; display: none;"><a><img src="https://graph.facebook.com/520662328341312/picture" alt=""><span class="status active"></span></a></div>
                   </div>
                   <div class="modal_version2_container">
                      <iframe id="print-order-iframe" title="title-print-order-iframe" class="d-none"></iframe><iframe id="print-comment-livestream-iframe" title="title-print-comment-livestream-iframe" class="d-none"></iframe>
                      <div></div>
                   </div>
                   <div class="wrapper">
                      <div class="page-content ">
                         <div class="auto_order_setting">
                            <div class="div-auto-reply" id="auto_order_scroll_general">
                               <div class="tab-content d-flex auto_order_margin">
                                  <div class="tab tab-left">
                                     <div class="order_title">
                                        <h2>1. Chọn trang livestream và đặt tên kịch bản</h2>
                                     </div>
                                     <div class="list-setting" id="div_tour_step1">
                                        <div class="padding">
                                           <div class="item ">
                                              <label class="lbl-title">Chọn trang livestream</label>
                                              <div class="form-group " id="page_current_setting_tour">
                                                 <ul class="ul-list-page d-flex " style="position: relative;">
                                                    <li data-toggle="dropdown">
                                                       <img src="//graph.facebook.com/104163647950733/picture?type=large" alt=""><span>Sim Số Đây</span>
                                                       <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check svg-first">
                                                          <polyline points="20 11 11 17 4 12"></polyline>
                                                       </svg>
                                                    </li>
                                                    <ul class="dropdown-menu ul-list-page-menu ul-list-page-autoreply" tabindex="-1" style="top: 2px;">
                                                       <div style="position: relative; overflow: hidden; width: 100%; height: auto; min-height: 30px; max-height: 250px;">
                                                          <div style="position: relative; overflow: scroll; margin-right: -10px; margin-bottom: -10px; min-height: 40px; max-height: 260px;">
                                                             <li class="listDropPage" tabindex="-1">
                                                                <img src="//graph.facebook.com/104163647950733/picture?type=large" alt=""><span>Sim Số Đây</span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0084ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                                                   <polyline points="20 6 9 17 4 12"></polyline>
                                                                </svg>
                                                             </li>
                                                             <li class="listDropPage" tabindex="-1"><img src="//graph.facebook.com/563066984185906/picture?type=large" alt=""><span>Tiền Seri Ngày Tháng Năm Sinh</span></li>
                                                          </div>
                                                          <div style="position: absolute; height: 6px; right: 2px; bottom: 2px; left: 2px; border-radius: 3px;">
                                                             <div style="position: relative; display: block; height: 100%; cursor: pointer; border-radius: inherit; background-color: rgba(0, 0, 0, 0.2);"></div>
                                                          </div>
                                                          <div style="position: absolute; width: 6px; right: 2px; bottom: 2px; top: 2px; border-radius: 3px;">
                                                             <div style="position: relative; display: block; width: 100%; cursor: pointer; border-radius: inherit; background-color: rgba(0, 0, 0, 0.2);"></div>
                                                          </div>
                                                       </div>
                                                    </ul>
                                                 </ul>
                                              </div>
                                           </div>
                                           <div class="item">
                                              <label class="lbl-title">Lựa chọn video livestream áp dụng cho kịch bản này</label>
                                              <div class="list-page-livestream">
                                                 <div class="d-flex item-livestream">
                                                    <div class="radio-button-side"><input type="radio" name="one" id="radio-next" checked=""><label for="radio-next" class="lbl_current_item">Sử dụng cho video livestream sắp tới</label></div>
                                                 </div>
                                              </div>
                                              <div class="list-page-livestream">
                                                 <div class="d-flex item-livestream" style="position: relative;">
                                                    <div class="radio-button-side"><input type="radio" name="one" id="radio-next1"><label for="radio-next1" class="lbl_current_item">Sử dụng cho video livestream đã kết thúc</label></div>
                                                 </div>
                                              </div>
                                           </div>
                                           <div class="item">
                                              <label class="lbl-title">Tên kịch bản</label>
                                              <div class="form-group  d-flex ">
                                                 <div class="taginput "><input id="inp_setting_name_tour" class="taginput-input input_name_auto_setting" type="text" placeholder="Nhập tên kịch bản tạo đơn hàng tự động" tabindex="1" value="Livestream ngày 21/7 page Sim Số Đây"></div>
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                                  <div id="general_tip1" class="tab-tip" style="opacity: 1;">
                                     <div>
                                        <span>
                                           <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                              <path d="M11 15.5455C13.5104 15.5455 15.5455 13.5104 15.5455 11C15.5455 8.48966 13.5104 6.45459 11 6.45459C8.48966 6.45459 6.45459 8.48966 6.45459 11C6.45459 13.5104 8.48966 15.5455 11 15.5455Z" stroke="#0088FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M11 1V2.81818" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M11 19.1818V20.9999" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M3.92749 3.92725L5.2184 5.21816" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M16.7817 16.7819L18.0726 18.0728" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M1 11H2.81818" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M19.182 11H21.0002" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M3.92749 18.0728L5.2184 16.7819" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M16.7817 5.21816L18.0726 3.92725" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                           </svg>
                                        </span>
                                        <div class="wrapper-1 tip-content"><span class="text">Tại thời điểm tạo kịch bản, nếu trang đang có video livestream, bạn có hai cách sử dụng như sau:</span></div>
                                     </div>
                                     <div class="d-flex tip-content">
                                        <div class="left-side">
                                           <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                              <circle cx="10" cy="10" r="10" fill="#0088FF"></circle>
                                              <path d="M10.8687 14H9.33252V6.57959L7.06641 7.354V6.05273L10.6719 4.72607H10.8687V14Z" fill="white"></path>
                                           </svg>
                                        </div>
                                        <div class="wrapper-2"><span class="content">Chọn một video livestream: Sau khi lưu lại, kịch bản sẽ được áp dụng ngay lập tức cho video đó.</span></div>
                                     </div>
                                     <div class="d-flex tip-content">
                                        <div class="left-side">
                                           <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                              <circle cx="10" cy="10" r="10" fill="#0088FF"></circle>
                                              <path d="M12.9062 14H6.69189V12.9399L9.77051 9.58203C10.2148 9.08691 10.5301 8.67432 10.7163 8.34424C10.9067 8.00993 11.002 7.67562 11.002 7.34131C11.002 6.9012 10.8771 6.54574 10.6274 6.2749C10.382 6.00407 10.0498 5.86865 9.63086 5.86865C9.13151 5.86865 8.7443 6.021 8.46924 6.32568C8.19417 6.63037 8.05664 7.0472 8.05664 7.57617H6.51416C6.51416 7.01335 6.64111 6.50765 6.89502 6.05908C7.15316 5.60628 7.51921 5.25505 7.99316 5.00537C8.47135 4.7557 9.02148 4.63086 9.64355 4.63086C10.5407 4.63086 11.2474 4.85726 11.7637 5.31006C12.2842 5.75863 12.5444 6.3807 12.5444 7.17627C12.5444 7.63753 12.4132 8.12207 12.1509 8.62988C11.8927 9.13346 11.4674 9.70687 10.875 10.3501L8.61523 12.7686H12.9062V14Z" fill="white"></path>
                                           </svg>
                                        </div>
                                        <div class="wrapper-2"><span class="content">Sử dụng cho livestream sắp tới: Kịch bản sẽ được lưu lại ở trạng thái “ Chưa sử dụng “, và sẽ tự động áp dụng cho video livestream tiếp theo của trang</span></div>
                                     </div>
                                     <div class="d-flex">
                                        <div class="wrapper-2 note"><span class="content">Lưu ý: Mặc định, tại thời điểm tạo kịch bản mà trang không có video livestream nào, kịch bản sẽ được áp dụng cho video livestream tiếp theo</span></div>
                                     </div>
                                     <div class="d-flex tip-content">
                                        <div class="left-side">
                                           <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                              <circle cx="10" cy="10" r="10" fill="#0088FF"></circle>
                                              <path d="M8.47559 8.67432H9.41504C9.889 8.67008 10.2635 8.54736 10.5386 8.30615C10.8179 8.06494 10.9575 7.71582 10.9575 7.25879C10.9575 6.81868 10.8411 6.47803 10.6084 6.23682C10.3799 5.99137 10.0286 5.86865 9.55469 5.86865C9.13997 5.86865 8.79932 5.98926 8.53271 6.23047C8.26611 6.46745 8.13281 6.77848 8.13281 7.16357H6.59033C6.59033 6.68962 6.71517 6.25798 6.96484 5.86865C7.21875 5.47933 7.56999 5.17676 8.01855 4.96094C8.47135 4.74089 8.97705 4.63086 9.53564 4.63086C10.4582 4.63086 11.1818 4.86361 11.7065 5.3291C12.2355 5.79036 12.5 6.43359 12.5 7.25879C12.5 7.6735 12.3667 8.06494 12.1001 8.43311C11.8377 8.79704 11.4971 9.0721 11.0781 9.2583C11.5859 9.4318 11.971 9.70475 12.2334 10.0771C12.5 10.4495 12.6333 10.8939 12.6333 11.4102C12.6333 12.2396 12.3477 12.8997 11.7764 13.3906C11.2093 13.8815 10.4624 14.127 9.53564 14.127C8.64697 14.127 7.91911 13.89 7.35205 13.416C6.78499 12.9421 6.50146 12.3115 6.50146 11.5244H8.04395C8.04395 11.9307 8.17936 12.2607 8.4502 12.5146C8.72526 12.7686 9.09342 12.8955 9.55469 12.8955C10.0329 12.8955 10.4095 12.7686 10.6846 12.5146C10.9596 12.2607 11.0972 11.8926 11.0972 11.4102C11.0972 10.9235 10.9533 10.549 10.6655 10.2866C10.3778 10.0243 9.95036 9.89307 9.3833 9.89307H8.47559V8.67432Z" fill="white"></path>
                                           </svg>
                                        </div>
                                        <div class="wrapper-2"><span class="content">Sử dụng cho livestream đã kết thúc: Sau khi lưu lại và kích hoạt, kịch bản sẽ thực hiện tự động tạo đơn hàng cho các bình luận của video livestream từ lúc bắt đầu livestream đến thời điểm kịch bản áp dụng</span></div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                            <div class="div-auto-reply" id="auto_order_scroll_key_variant">
                               <div class="tab-content d-flex auto_order_margin">
                                  <div class="tab variant-details">
                                     <div class="order_title">
                                        <h2>2. Tạo từ khóa đặt hàng tương ứng với sản phẩm</h2>
                                     </div>
                                     <div class="list_conditions_setting">
                                        <div class="list_conditions_setting">
                                           <div class="d-flex content-container">
                                              <div class="left">
                                                 <div class="content-2">
                                                    <span style="line-height: 25px;">Bước 1: Chọn sản phẩm muốn bán</span>
                                                    <p style="line-height: 25px;">Bước 2: Tạo từ khóa đặt hàng cho sản phẩm</p>
                                                    <p style="font-style: italic; color: rgb(132, 132, 132); margin-top: 50px;">Ví dụ: Bạn muốn bán sản phẩm “SON MAC” thì cần chọn sản phẩm đó, sau đó tạo từ khóa đặt hàng tương ứng là “MAC”. Khi khách hàng xem livestream để lại bình luận có chứa từ “ MAC”, hệ thống sẽ tự động tạo đơn hàng với sản phẩm là “SON MAC”</p>
                                                 </div>
                                                 <div class="add-btn">
                                                    <button class=" btn btn-primary" type="button">
                                                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                                          <line x1="12" y1="5" x2="12" y2="19"></line>
                                                          <line x1="5" y1="12" x2="19" y2="12"></line>
                                                       </svg>
                                                       <span class="text">Thêm mẫu từ khóa đặt hàng</span>
                                                    </button>
                                                 </div>
                                              </div>
                                              <div class="right"><img src="https://image.flaticon.com/icons/png/256/2942/2942807.png" alt="no-cont-variant"></div>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                                  <div id="general_tip2" class="tab-tip" style="opacity: 0;">
                                     <div>
                                        <span>
                                           <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                              <path d="M11 15.5455C13.5104 15.5455 15.5455 13.5104 15.5455 11C15.5455 8.48966 13.5104 6.45459 11 6.45459C8.48966 6.45459 6.45459 8.48966 6.45459 11C6.45459 13.5104 8.48966 15.5455 11 15.5455Z" stroke="#0088FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M11 1V2.81818" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M11 19.1818V20.9999" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M3.92749 3.92725L5.2184 5.21816" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M16.7817 16.7819L18.0726 18.0728" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M1 11H2.81818" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M19.182 11H21.0002" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M3.92749 18.0728L5.2184 16.7819" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M16.7817 5.21816L18.0726 3.92725" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                           </svg>
                                        </span>
                                        <span class="title">Từ khóa đặt hàng</span>
                                     </div>
                                     <div class="d-flex tip-content">
                                        <div class="left-side" style="width: 40px;">&nbsp;&nbsp;&nbsp;</div>
                                        <div class="wrapper-2">
                                           <span class="content">Hệ thống không phân biệt các từ khóa viết hoa, viết thường, có dấu, không dấu.</span>
                                           <p>Ví dụ: với từ khóa "VÁY XANH", những bình luận như "Váy xanh", "Vayxanh", "VAY xanh" đều được coi là đúng cú pháp</p>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                            <div class="div-auto-reply" id="auto_order_scroll_conditions">
                                {{-- dfjklsdsfjklsdfjkl --}}
                               <div class="tab-content d-flex auto_order_margin">
                                  <div class="tab condition-setting">
                                     <div class="order_title">
                                        <h2>3. Tạo cú pháp để tạo đơn tự động</h2>
                                     </div>
                                     <div class="list-setting">
                                        <div class="padding">
                                            <div class="item item-condition-title"><span>Cú pháp đặt hàng bao gồm: </span></div>
                                                <div class="item item-condition">
                                                    <div class="checkboxabc"><input type="checkbox" name="check" readonly="" checked=""><label style="cursor: not-allowed; opacity: 0.7;"></label><span style="cursor: not-allowed;">Từ khóa đặt hàng</span></div>
                                                </div>
                                                <div class="item item-condition">
                                                    <div class="checkboxabc"><input type="checkbox" name="check" readonly=""><label></label><span>Số điện thoại</span></div>
                                                </div>
                                                <div class="item item-condition-title"><span>Lựa chọn thời điểm để lên đơn tự động</span></div>
                                                <div class="item item-condition">
                                                    <div class="item-radio">
                                                        <input type="radio" readonly="">
                                                        <label class="lbl_current_item " data-tip="" data-for="tip-condision-1">
                                                            <div>Ngay sau khi khách hàng bình luận đúng cú pháp đặt đơn (Chỉ tạo 1 đơn hàng)</div>
                                                            <div class="new-icon-livestream-option">NEW</div>
                                                        </label>
                                                        <p class="p_note ">Gộp các bình luận đúng cú pháp và chỉ tạo 1 đơn hàng duy nhất</p>
                                                    </div>
                                                </div>
                                                <div class="item item-condition">
                                                    <div class="item-radio">
                                                        <input type="radio" readonly=""><label class="lbl_current_item " data-tip="" data-for="tip-condision-1">Ngay sau khi khách hàng bình luận đúng cú pháp đặt đơn</label>
                                                        <p class="p_note ">Mỗi bình luận đúng cú pháp tạo 1 đơn hàng</p>
                                                    </div>
                                                </div>
                                                <div class="item item-condition">
                                                    <div class="item-radio">
                                                        <input type="radio" readonly="" checked=""><label class="lbl_current_item">Sau khi livestream kết thúc</label>
                                                        <p class="p_note">Gộp các bình luận đúng cú pháp của 1 khách hàng để tạo 1 đơn hàng</p>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                  <div id="general_tip3" class="tab-tip" style="opacity: 0;">
                                     <div>
                                        <span>
                                           <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                              <path d="M11 15.5455C13.5104 15.5455 15.5455 13.5104 15.5455 11C15.5455 8.48966 13.5104 6.45459 11 6.45459C8.48966 6.45459 6.45459 8.48966 6.45459 11C6.45459 13.5104 8.48966 15.5455 11 15.5455Z" stroke="#0088FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M11 1V2.81818" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M11 19.1818V20.9999" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M3.92749 3.92725L5.2184 5.21816" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M16.7817 16.7819L18.0726 18.0728" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M1 11H2.81818" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M19.182 11H21.0002" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M3.92749 18.0728L5.2184 16.7819" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M16.7817 5.21816L18.0726 3.92725" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                           </svg>
                                        </span>
                                        <span class="title">Xem trước cú pháp</span>
                                     </div>
                                     <div class="d-flex tip-content">
                                        <div class="left-side" style="width: 23px;">&nbsp;&nbsp;&nbsp;</div>
                                        <div class="wrapper-2">
                                           <span class="content">Cú pháp để khách hàng có thể đặt đơn theo thiết lập của bạn với từ khóa "VÁY XANH" sẽ là:<br></span>
                                           <p style="margin: 10px 0;"><span style="color: rgb(0, 132, 255); font-weight: 500;">VÁY XANH</span><br></p>
                                           <p><span>Ví dụ về một số bình luận của khách hàng:</span></p>
                                           <div class="d-flex" style="margin: 5px 0;">
                                              <div>
                                                 <svg width="14" height="10" viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-bottom: 5px;">
                                                    <path d="M13 1L4.75 9.25L1 5.5" stroke="#0FD186" stroke-linecap="round" stroke-linejoin="round"></path>
                                                 </svg>
                                              </div>
                                              <div style="margin-left: 10px;"><span>VÁY XANH:</span><span style="color: rgb(15, 209, 134);">Đúng cú pháp, đơn hàng được tạo</span></div>
                                           </div>
                                           <div class="d-flex">
                                              <div style="margin-top: -5px;">
                                                 <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" style="vertical-align: -webkit-baseline-middle;">
                                                    <path d="M11 1L1 11" stroke="#E3404A" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M1 1L11 11" stroke="#E3404A" stroke-linecap="round" stroke-linejoin="round"></path>
                                                 </svg>
                                              </div>
                                              <div style="margin-left: 10px;"><span>VÁY 098xxxxxxx:</span><span style="color: rgb(227, 64, 74);">Sai cú pháp do sai từ khóa</span></div>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>

                               {{-- hjkssdfjkdfshjkdẹkl --}}
                            </div>
                            <div id="auto_order_scroll_auto_reply" class="div-auto-reply ">
                               {{-- <div class="tab-content d-flex auto_order_margin">
                                  <div class="tab autoOrder-reply-setting ">
                                     <div class="order_title">
                                        <h2>
                                           4. Kịch bản trả lời tự động<i class="fa fa-2x fa-question-circle-o" aria-hidden="true" data-tip="true" data-for="infoDivAutoReply" currentitem="false"></i>
                                        </h2>
                                     </div>
                                     <div class="d-flex list-setting valid-reply-status">
                                        <span style="font-weight: 500; color: rgb(33, 43, 53); width: calc(100% - 40px);">Gửi trả lời tự động khi khách hàng bình luận đúng cú pháp và đơn hàng được tạo</span>
                                        <span class="action-btn">
                                           <button type="button" class="btn btn-toggle ">
                                              <div class="handle"></div>
                                           </button>
                                        </span>
                                     </div>
                                     <div class="list-setting" style="display: none;">
                                        <div class="all-item">
                                           <label style="color: rgb(79, 79, 79);">Soạn nội dung trả lời bình luận</label>
                                           <div class="gallery_reply_template">
                                              <div>Gợi ý từ thư viện nội dung:</div>
                                              <div class="dropdown">
                                                 <button class="dropdown-toggle" type="button" data-toggle="dropdown">
                                                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                       <path d="M12.5 3.75L5.625 10.625L2.5 7.5" stroke="#0084FF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    Mẫu 1<span class="caret"></span>
                                                 </button>
                                                 <ul class="dropdown-menu">
                                                    <li class="li_even">
                                                       <span>Xin chào , shop cảm ơn bạn đã đặt hàng, bạn vui lòng kiểm tra tin nhắn của shop và xác nhận đơn hàng nhé.</span>
                                                       <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                          <path d="M12.5 3.75L5.625 10.625L2.5 7.5" stroke="#0084FF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                       </svg>
                                                    </li>
                                                    <li class="li_odd"><span>Xin chào , shop đã chốt sản phẩm này cho bạn rồi ạ, bạn vui lòng kiểm tra tin nhắn của shop và xác nhận đơn hàng nhé.</span></li>
                                                    <li class="li_even"><span>Cảm ơn quý khách  đã đặt hàng, quý khách vui lòng kiểm tra tin nhắn để xác nhận lại đơn hàng ạ.</span></li>
                                                    <li class="li_odd"><span>Chúc mừng quý khách  đã đặt thành công đơn hàng, để xác nhận đơn hàng quý khách vui lòng kiểm tra phần tin nhắn của shop ạ.</span></li>
                                                 </ul>
                                              </div>
                                           </div>
                                           <div class="div_text_content"><textarea class="textarea_content txt-content" name="txt_comment" maxlength="1000" placeholder="Nhập nội dung bình luận phản hồi" id="txt_comment" style="height: 180px;">Xin chào , shop cảm ơn bạn đã đặt hàng, bạn vui lòng kiểm tra tin nhắn của shop và xác nhận đơn hàng nhé.</textarea><button type="button" class="noti_quick font-size-14">887/1000</button></div>
                                           <div class="div_after_textarea">
                                              <div class="personalized_button" id="personalized_button_txt_comment">
                                                 <span class="item_button" data-tip="true" data-for="user_icon" currentitem="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg_button feather feather-user">
                                                       <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                       <circle cx="12" cy="7" r="4"></circle>
                                                    </svg>
                                                 </span>
                                                 <span class="item_button" data-tip="true" data-for="phone_icon" currentitem="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg_button feather feather-phone">
                                                       <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                    </svg>
                                                 </span>
                                                 <span class="item_button" data-tip="true" data-for="address_icon" currentitem="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg_button feather feather-map-pin">
                                                       <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                       <circle cx="12" cy="10" r="3"></circle>
                                                    </svg>
                                                 </span>
                                                 <input type="file" accept="image/*" multiple="" style="display: none;">
                                                 <span class="item_button" data-tip="true" data-for="spin_icon" currentitem="false">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="svg_button">
                                                       <path d="M1 4V10H7" stroke="#525252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                       <path d="M3.51 15C4.15839 16.8404 5.38734 18.4202 7.01166 19.5014C8.63598 20.5826 10.5677 21.1066 12.5157 20.9945C14.4637 20.8824 16.3226 20.1402 17.8121 18.8798C19.3017 17.6194 20.3413 15.909 20.7742 14.0064C21.2072 12.1038 21.0101 10.112 20.2126 8.33111C19.4152 6.55025 18.0605 5.0768 16.3528 4.13277C14.6451 3.18874 12.6769 2.82527 10.7447 3.09713C8.81245 3.36898 7.02091 4.26143 5.64 5.64001L1 10" stroke="#525252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                 </span>
                                                 <span class="item_button item_button_emoji">
                                                    <div class="div_emoji_picker">
                                                       <div class="emoji_popup">
                                                          <button type="button" id="btn_open_emoji" class="" data-toggle="tooltip" data-placement="top" data-tip="true" data-for="emoji_icon" currentitem="false">
                                                             <div class="form_tooltip place-top type-dark" id="emoji_icon" data-id="tooltip">Chọn biểu tượng cảm xúc</div>
                                                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-smile">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                                                                <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                                                <line x1="15" y1="9" x2="15.01" y2="9"></line>
                                                             </svg>
                                                          </button>
                                                       </div>
                                                    </div>
                                                 </span>
                                                 <span class="item_button item_buttom_quick_reply">
                                                    <div class="div_quick_mes_template">
                                                       <div class="reply-button-action quick-message-button-new dropdown is-ver1">
                                                          <div class="abbbb">
                                                             <span type="button" id="btn-template-message" class="btn-template-message" data-toggle="tooltip dropdown" data-placement="top" data-tip="true" data-for="_quickmes_icon" data-delay="{&quot;show&quot;:&quot;200&quot;, &quot;hide&quot;:&quot;0&quot;}" currentitem="false" style="height: unset;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg_template_mesage feather feather-message-square">
                                                                   <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                                                </svg>
                                                             </span>
                                                             <div class="form_tooltip place-top type-dark" id="_quickmes_icon" data-id="tooltip">Gửi câu trả lời mẫu</div>
                                                          </div>
                                                       </div>
                                                    </div>
                                                 </span>
                                                 <span class="item_button" data-tip="true" data-for="fb_livestreamIcon" currentitem="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle svg_button">
                                                       <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                                                    </svg>
                                                 </span>
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                     <div class="list-setting" style="display: none;">
                                        <div class="all-item">
                                           <label style="color: rgb(79, 79, 79);">Soạn nội dung tin nhắn gửi cho khách</label>
                                           <div class="gallery_reply_template">
                                              <div>Gợi ý từ thư viện nội dung:</div>
                                              <div class="dropdown">
                                                 <button class="dropdown-toggle" type="button" data-toggle="dropdown">
                                                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                       <path d="M12.5 3.75L5.625 10.625L2.5 7.5" stroke="#0084FF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    Mẫu 1<span class="caret"></span>
                                                 </button>
                                                 <ul class="dropdown-menu">
                                                    <li class="li_even">
                                                       <span>Cảm ơn quý khách  đã đặt hàng, bạn vui lòng xác nhận đồng ý nhận hàng và gửi lại giúp shop địa chỉ nhận hàng để shop hoàn thiện thông tin gửi hàng cho bạn nhé.</span>
                                                       <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                          <path d="M12.5 3.75L5.625 10.625L2.5 7.5" stroke="#0084FF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                       </svg>
                                                    </li>
                                                    <li class="li_odd"><span>Cảm ơn quý khách  đã đặt hàng, đơn hàng của quý khách đã được tạo thành công, quý khách vui lòng xác nhận đồng ý nhận hàng để shop gửi về ạ.</span></li>
                                                    <li class="li_even"><span>Chào bạn, đơn hàng của bạn đã được tạo thành công. Nếu đồng ý nhận hàng, bạn vui lòng gửi tin nhắn xác nhận giúp shop nhé.</span></li>
                                                 </ul>
                                              </div>
                                           </div>
                                           <div class="div_text_content"><textarea class="textarea_content txt-content" name="txt_message" maxlength="1000" placeholder="Nhập nội dung tin nhắn phản hồi" id="txt_message" style="height: 180px;">Cảm ơn quý khách  đã đặt hàng, bạn vui lòng xác nhận đồng ý nhận hàng và gửi lại giúp shop địa chỉ nhận hàng để shop hoàn thiện thông tin gửi hàng cho bạn nhé.</textarea><button type="button" class="noti_quick font-size-14">433/600</button></div>
                                           <div class="div_after_textarea">
                                              <div class="personalized_button" id="personalized_button_txt_message">
                                                 <span class="item_button" data-tip="true" data-for="user_icon" currentitem="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg_button feather feather-user">
                                                       <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                       <circle cx="12" cy="7" r="4"></circle>
                                                    </svg>
                                                    <div class="form_tooltip place-top type-dark" id="user_icon" data-id="tooltip">Tên khách hàng</div>
                                                 </span>
                                                 <span class="item_button" data-tip="true" data-for="phone_icon" currentitem="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg_button feather feather-phone">
                                                       <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                    </svg>
                                                    <div class="form_tooltip place-top type-dark" id="phone_icon" data-id="tooltip">Số điện thoại</div>
                                                 </span>
                                                 <span class="item_button" data-tip="true" data-for="address_icon" currentitem="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg_button feather feather-map-pin">
                                                       <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                       <circle cx="12" cy="10" r="3"></circle>
                                                    </svg>
                                                    <div class="form_tooltip place-top type-dark" id="address_icon" data-id="tooltip">Địa chỉ</div>
                                                 </span>
                                                 <span class="item_button" data-tip="true" data-for="img_icon_txt_message" currentitem="false">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="svg_button">
                                                       <path d="M19 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3Z" stroke="#525252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                       <path d="M8.5 10C9.32843 10 10 9.32843 10 8.5C10 7.67157 9.32843 7 8.5 7C7.67157 7 7 7.67157 7 8.5C7 9.32843 7.67157 10 8.5 10Z" stroke="#525252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                       <path d="M21 15L16 10L5 21" stroke="#525252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <div class="form_tooltip place-top type-dark" id="img_icon_txt_message" data-id="tooltip">Thêm ảnh</div>
                                                 </span>
                                                 <input type="file" accept="image/*" multiple="" style="display: none;">
                                                 <span class="item_button" data-tip="true" data-for="spin_icon" currentitem="false">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="svg_button">
                                                       <path d="M1 4V10H7" stroke="#525252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                       <path d="M3.51 15C4.15839 16.8404 5.38734 18.4202 7.01166 19.5014C8.63598 20.5826 10.5677 21.1066 12.5157 20.9945C14.4637 20.8824 16.3226 20.1402 17.8121 18.8798C19.3017 17.6194 20.3413 15.909 20.7742 14.0064C21.2072 12.1038 21.0101 10.112 20.2126 8.33111C19.4152 6.55025 18.0605 5.0768 16.3528 4.13277C14.6451 3.18874 12.6769 2.82527 10.7447 3.09713C8.81245 3.36898 7.02091 4.26143 5.64 5.64001L1 10" stroke="#525252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <div class="form_tooltip place-top type-dark" id="spin_icon" data-id="tooltip">Lựa chọn ngẫu nhiên từ khóa</div>
                                                 </span>
                                                 <span class="item_button item_button_emoji">
                                                    <div class="div_emoji_picker">
                                                       <div class="emoji_popup">
                                                          <button type="button" id="btn_open_emoji" class="" data-toggle="tooltip" data-placement="top" data-tip="true" data-for="emoji_icon" currentitem="false">
                                                             <div class="form_tooltip place-top type-dark" id="emoji_icon" data-id="tooltip">Chọn biểu tượng cảm xúc</div>
                                                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-smile">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                                                                <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                                                <line x1="15" y1="9" x2="15.01" y2="9"></line>
                                                             </svg>
                                                          </button>
                                                       </div>
                                                    </div>
                                                 </span>
                                                 <span class="item_button item_buttom_quick_reply">
                                                    <div class="div_quick_mes_template">
                                                       <div class="reply-button-action quick-message-button-new dropdown is-ver1">
                                                          <div class="abbbb">
                                                             <span type="button" id="btn-template-message" class="btn-template-message" data-toggle="tooltip dropdown" data-placement="top" data-tip="true" data-for="_quickmes_icon" data-delay="{&quot;show&quot;:&quot;200&quot;, &quot;hide&quot;:&quot;0&quot;}" currentitem="false" style="height: unset;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg_template_mesage feather feather-message-square">
                                                                   <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                                                </svg>
                                                             </span>
                                                             <div class="form_tooltip place-top type-dark" id="_quickmes_icon" data-id="tooltip">Gửi câu trả lời mẫu</div>
                                                          </div>
                                                       </div>
                                                    </div>
                                                 </span>
                                                 <span class="item_button" data-tip="true" data-for="fb_livestreamIcon" currentitem="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle svg_button">
                                                       <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                                                    </svg>
                                                    <div class="form_tooltip place-top type-dark" id="fb_livestreamIcon" data-id="tooltip">Comment livestream</div>
                                                 </span>
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                     <div class="d-flex list-setting invalid-reply-status">
                                        <span data-tip="" data-for="tip-reply-1" style="font-weight: 500; color: rgb(33, 43, 53); width: calc(100% - 40px);">Gửi trả lời tự động khi khách hàng bình luận chưa đúng cú pháp đặt hàng</span>
                                        <span class="action-btn">
                                           <button type="button" class="btn btn-toggle " disabled="" style="cursor: not-allowed;">
                                              <div class="handle"></div>
                                           </button>
                                        </span>
                                     </div>
                                     <div class="list-setting" style="padding-left: 43px; color: rgb(33, 43, 53);"><span>Chức năng này chỉ khả dụng cho trường hợp cú pháp đặt hàng bao gồm Từ khóa đặt hàng và Số điện thoại</span></div>
                                     <div class="list-setting" style="display: none;">
                                        <div class="all-item">
                                           <label style="color: rgb(79, 79, 79);">Soạn nội dung tin nhắn gửi khách hàng khi bình luận không đúng cú pháp đặt hàng</label>
                                           <div class="gallery_reply_template">
                                              <div>Gợi ý từ thư viện nội dung:</div>
                                              <div class="dropdown">
                                                 <button class="dropdown-toggle" type="button" data-toggle="dropdown">
                                                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                       <path d="M12.5 3.75L5.625 10.625L2.5 7.5" stroke="#0084FF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    Mẫu 1<span class="caret"></span>
                                                 </button>
                                                 <ul class="dropdown-menu">
                                                    <li class="li_even">
                                                       <span>Xin chào , Những bình luận của bạn: {{comment livestream}} đang chưa đúng cú pháp đặt hàng. Vui lòng chat cho shop nhé!</span>
                                                       <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                          <path d="M12.5 3.75L5.625 10.625L2.5 7.5" stroke="#0084FF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                       </svg>
                                                    </li>
                                                    <li class="li_odd"><span>Chào , nội dung những bình luận của bạn: {{comment livestream}} chưa đúng cú pháp. Để đặt hàng bạn vui lòng chat cho shop tên của sản phẩm hoặc số điện thoại nhé, Cảm ơn bạn!</span></li>
                                                    <li class="li_even"><span> ơi, nội dung những bình luận của bạn: {{comment livestream}} chưa đúng cú pháp nhé, bạn vui lòng gửi lại số điện thoại hoặc tên mã sản phẩm bạn muốn đặt mua qua inbox cho shop nha. Cảm ơn bạn!</span></li>
                                                 </ul>
                                              </div>
                                           </div>
                                           <div class="div_text_content"><textarea class="textarea_content txt-content" name="reply_message_no_syntax" maxlength="1000" placeholder="Nhập nội dung tin nhắn phản hồi" id="reply_message_no_syntax" style="height: 180px;">Xin chào , Những bình luận của bạn: {{comment livestream}} đang chưa đúng cú pháp đặt hàng. Vui lòng chat cho shop nhé!</textarea><button type="button" class="noti_quick font-size-14">473/600</button></div>
                                           <div class="div_after_textarea">
                                              <div class="personalized_button" id="personalized_button_reply_message_no_syntax">
                                                 <span class="item_button" data-tip="true" data-for="user_icon" currentitem="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg_button feather feather-user">
                                                       <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                       <circle cx="12" cy="7" r="4"></circle>
                                                    </svg>
                                                    <div class="form_tooltip place-top type-dark" id="user_icon" data-id="tooltip">Tên khách hàng</div>
                                                 </span>
                                                 <span class="item_button" data-tip="true" data-for="phone_icon" currentitem="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg_button feather feather-phone">
                                                       <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                    </svg>
                                                    <div class="form_tooltip place-top type-dark" id="phone_icon" data-id="tooltip">Số điện thoại</div>
                                                 </span>
                                                 <span class="item_button" data-tip="true" data-for="address_icon" currentitem="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg_button feather feather-map-pin">
                                                       <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                       <circle cx="12" cy="10" r="3"></circle>
                                                    </svg>
                                                    <div class="form_tooltip place-top type-dark" id="address_icon" data-id="tooltip">Địa chỉ</div>
                                                 </span>
                                                 <span class="item_button" data-tip="true" data-for="img_icon_reply_message_no_syntax" currentitem="false">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="svg_button">
                                                       <path d="M19 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3Z" stroke="#525252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                       <path d="M8.5 10C9.32843 10 10 9.32843 10 8.5C10 7.67157 9.32843 7 8.5 7C7.67157 7 7 7.67157 7 8.5C7 9.32843 7.67157 10 8.5 10Z" stroke="#525252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                       <path d="M21 15L16 10L5 21" stroke="#525252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <div class="form_tooltip place-top type-dark" id="img_icon_reply_message_no_syntax" data-id="tooltip">Thêm ảnh</div>
                                                 </span>
                                                 <input type="file" accept="image/*" multiple="" style="display: none;">
                                                 <span class="item_button" data-tip="true" data-for="spin_icon" currentitem="false">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="svg_button">
                                                       <path d="M1 4V10H7" stroke="#525252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                       <path d="M3.51 15C4.15839 16.8404 5.38734 18.4202 7.01166 19.5014C8.63598 20.5826 10.5677 21.1066 12.5157 20.9945C14.4637 20.8824 16.3226 20.1402 17.8121 18.8798C19.3017 17.6194 20.3413 15.909 20.7742 14.0064C21.2072 12.1038 21.0101 10.112 20.2126 8.33111C19.4152 6.55025 18.0605 5.0768 16.3528 4.13277C14.6451 3.18874 12.6769 2.82527 10.7447 3.09713C8.81245 3.36898 7.02091 4.26143 5.64 5.64001L1 10" stroke="#525252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <div class="form_tooltip place-top type-dark" id="spin_icon" data-id="tooltip">Lựa chọn ngẫu nhiên từ khóa</div>
                                                 </span>
                                                 <span class="item_button item_button_emoji">
                                                    <div class="div_emoji_picker">
                                                       <div class="emoji_popup">
                                                          <button type="button" id="btn_open_emoji" class="" data-toggle="tooltip" data-placement="top" data-tip="true" data-for="emoji_icon" currentitem="false">
                                                             <div class="form_tooltip place-top type-dark" id="emoji_icon" data-id="tooltip">Chọn biểu tượng cảm xúc</div>
                                                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-smile">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                                                                <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                                                <line x1="15" y1="9" x2="15.01" y2="9"></line>
                                                             </svg>
                                                          </button>
                                                       </div>
                                                    </div>
                                                 </span>
                                                 <span class="item_button item_buttom_quick_reply">
                                                    <div class="div_quick_mes_template">
                                                       <div class="reply-button-action quick-message-button-new dropdown is-ver1">
                                                          <div class="abbbb">
                                                             <span type="button" id="btn-template-message" class="btn-template-message" data-toggle="tooltip dropdown" data-placement="top" data-tip="true" data-for="_quickmes_icon" data-delay="{&quot;show&quot;:&quot;200&quot;, &quot;hide&quot;:&quot;0&quot;}" currentitem="false" style="height: unset;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg_template_mesage feather feather-message-square">
                                                                   <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                                                </svg>
                                                             </span>
                                                             <div class="form_tooltip place-top type-dark" id="_quickmes_icon" data-id="tooltip">Gửi câu trả lời mẫu</div>
                                                          </div>
                                                       </div>
                                                    </div>
                                                 </span>
                                                 <span class="item_button" data-tip="true" data-for="fb_livestreamIcon" currentitem="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle svg_button">
                                                       <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                                                    </svg>
                                                    <div class="form_tooltip place-top type-dark" id="fb_livestreamIcon" data-id="tooltip">Comment livestream</div>
                                                 </span>
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                                  <div id="general_tip4" class="tab-tip" style="opacity: 0;">
                                     <div>
                                        <span>
                                           <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                              <path d="M11 15.5455C13.5104 15.5455 15.5455 13.5104 15.5455 11C15.5455 8.48966 13.5104 6.45459 11 6.45459C8.48966 6.45459 6.45459 8.48966 6.45459 11C6.45459 13.5104 8.48966 15.5455 11 15.5455Z" stroke="#0088FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M11 1V2.81818" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M11 19.1818V20.9999" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M3.92749 3.92725L5.2184 5.21816" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M16.7817 16.7819L18.0726 18.0728" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M1 11H2.81818" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M19.182 11H21.0002" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M3.92749 18.0728L5.2184 16.7819" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M16.7817 5.21816L18.0726 3.92725" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                           </svg>
                                        </span>
                                        <span class="title">Trả lời tự động</span>
                                        <div class="wrapper-1 tip-content"><span class="text">Sau 1 phút từ khi khách hàng để lại bình luận, hệ thống sẽ trả lời bình luận của khách và gửi tin nhắn cho khách hàng theo nội dung bạn thiết lập.</span></div>
                                     </div>
                                     <div class="d-flex tip-content">
                                        <div class="left-side" style="margin: 10px 0 0 17px;">&nbsp;</div>
                                        <div class="wrapper-2"><span class="content">Bạn có thể thiết lập 2 mẫu nội dung trả lời tự động riêng biệt cho từng trường hợp khách hàng bình luận đúng cú pháp hoặc sai cú pháp đặt hàng</span></div>
                                     </div>
                                     <div class="d-flex">
                                        <div class="wrapper-2 note"><span class="content">Lưu ý: Nếu bạn không nhập vào nội dung, hệ thống sẽ không thực hiện việc trả lời tự động</span></div>
                                     </div>
                                  </div>
                               </div> --}}
                            </div>
                            <div id="auto_order_scroll_noti_reply" class="div-auto-reply ">
                               <div class="tab-content d-flex auto_order_margin">
                                  <div class="tab condition-setting">
                                     <div class="order_title">
                                        <h2>5. Thông báo khi trang của bạn có video livestream</h2>
                                     </div>
                                     <div class="d-flex list-setting valid-reply-status">
                                        <span style="font-weight: 500; color: rgb(33, 43, 53); width: calc(100% - 40px);">Gửi thông báo tự động khi trang của bạn có video livestream</span>
                                        <span class="action-btn">
                                           <button type="button" class="btn btn-toggle ">
                                              <div class="handle"></div>
                                           </button>
                                        </span>
                                     </div>
                                     <div class="list-setting" style="display: none;">
                                        <div class="all-item">
                                           <div class="gallery_reply_template">
                                              <div>Gợi ý từ thư viện nội dung:</div>
                                              <div class="dropdown">
                                                 <button class="dropdown-toggle" type="button" data-toggle="dropdown">
                                                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                       <path d="M12.5 3.75L5.625 10.625L2.5 7.5" stroke="#0084FF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    Mẫu 1<span class="caret"></span>
                                                 </button>
                                                 <ul class="dropdown-menu">
                                                    <li class="li_even">
                                                       <span>Xin chào , Shop đang livestream giới thiệu sản phẩm mới. Bạn có thể theo dõi để biết thêm thông tin của sản phẩm nhé!</span>
                                                       <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                          <path d="M12.5 3.75L5.625 10.625L2.5 7.5" stroke="#0084FF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                       </svg>
                                                    </li>
                                                    <li class="li_odd"><span> ơi, Shop đang livestream xả kho hàng, mình cùng theo dõi để lựa chọn được những sản phẩm phù hợp nhé!</span></li>
                                                    <li class="li_even"><span>Hi , bạn có đang quan tâm đến sản phẩm nào của chúng tôi, hãy cùng xem livestream để được tư vấn về sản phẩm nhé!</span></li>
                                                    <li class="li_odd"><span>Xin chào , bạn cùng xem livestream để lựa chọn cho mình những mẫu sản phẩm ưng ý mới ra mắt của shop nhé!</span></li>
                                                 </ul>
                                              </div>
                                           </div>
                                           <div class="div_text_content"><textarea class="textarea_content txt-content" name="noti_message" maxlength="600" id="noti_message" style="height: 180px;">Xin chào , Shop đang livestream giới thiệu sản phẩm mới. Bạn có thể theo dõi để biết thêm thông tin của sản phẩm nhé!</textarea><button type="button" class="noti_quick font-size-14">475/600</button></div>
                                           <div class="div_after_textarea">
                                              <div class="personalized_button" id="personalized_button_noti_message">
                                                 <span class="item_button" data-tip="true" data-for="user_icon" currentitem="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg_button feather feather-user">
                                                       <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                       <circle cx="12" cy="7" r="4"></circle>
                                                    </svg>
                                                    <div class="form_tooltip place-top type-dark" id="user_icon" data-id="tooltip">Tên khách hàng</div>
                                                 </span>
                                                 <span class="item_button" data-tip="true" data-for="phone_icon" currentitem="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg_button feather feather-phone">
                                                       <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                    </svg>
                                                    <div class="form_tooltip place-top type-dark" id="phone_icon" data-id="tooltip">Số điện thoại</div>
                                                 </span>
                                                 <span class="item_button" data-tip="true" data-for="address_icon" currentitem="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg_button feather feather-map-pin">
                                                       <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                       <circle cx="12" cy="10" r="3"></circle>
                                                    </svg>
                                                    <div class="form_tooltip place-top type-dark" id="address_icon" data-id="tooltip">Địa chỉ</div>
                                                 </span>
                                                 <span class="item_button" data-tip="true" data-for="img_icon_add_image" currentitem="false">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="svg_button">
                                                       <path d="M19 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3Z" stroke="#525252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                       <path d="M8.5 10C9.32843 10 10 9.32843 10 8.5C10 7.67157 9.32843 7 8.5 7C7.67157 7 7 7.67157 7 8.5C7 9.32843 7.67157 10 8.5 10Z" stroke="#525252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                       <path d="M21 15L16 10L5 21" stroke="#525252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <div class="form_tooltip place-top type-dark" id="img_icon_add_image" data-id="tooltip">Thêm ảnh</div>
                                                 </span>
                                                 <input type="file" accept="image/*" multiple="" style="display: none;">
                                                 <span class="item_button" data-tip="true" data-for="spin_icon" currentitem="false">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="svg_button">
                                                       <path d="M1 4V10H7" stroke="#525252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                       <path d="M3.51 15C4.15839 16.8404 5.38734 18.4202 7.01166 19.5014C8.63598 20.5826 10.5677 21.1066 12.5157 20.9945C14.4637 20.8824 16.3226 20.1402 17.8121 18.8798C19.3017 17.6194 20.3413 15.909 20.7742 14.0064C21.2072 12.1038 21.0101 10.112 20.2126 8.33111C19.4152 6.55025 18.0605 5.0768 16.3528 4.13277C14.6451 3.18874 12.6769 2.82527 10.7447 3.09713C8.81245 3.36898 7.02091 4.26143 5.64 5.64001L1 10" stroke="#525252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <div class="form_tooltip place-top type-dark" id="spin_icon" data-id="tooltip">Lựa chọn ngẫu nhiên từ khóa</div>
                                                 </span>
                                                 <span class="item_button item_button_emoji">
                                                    <div class="div_emoji_picker">
                                                       <div class="emoji_popup">
                                                          <button type="button" id="btn_open_emoji" class="" data-toggle="tooltip" data-placement="top" data-tip="true" data-for="emoji_icon" currentitem="false">
                                                             <div class="form_tooltip place-top type-dark" id="emoji_icon" data-id="tooltip">Chọn biểu tượng cảm xúc</div>
                                                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-smile">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                                                                <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                                                <line x1="15" y1="9" x2="15.01" y2="9"></line>
                                                             </svg>
                                                          </button>
                                                       </div>
                                                    </div>
                                                 </span>
                                                 <span class="item_button item_buttom_quick_reply">
                                                    <div class="div_quick_mes_template">
                                                       <div class="reply-button-action quick-message-button-new dropdown is-ver1">
                                                          <div class="abbbb">
                                                             <span type="button" id="btn-template-message" class="btn-template-message" data-toggle="tooltip dropdown" data-placement="top" data-tip="true" data-for="_quickmes_icon" data-delay="{&quot;show&quot;:&quot;200&quot;, &quot;hide&quot;:&quot;0&quot;}" currentitem="false" style="height: unset;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg_template_mesage feather feather-message-square">
                                                                   <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                                                </svg>
                                                             </span>
                                                             <div class="form_tooltip place-top type-dark" id="_quickmes_icon" data-id="tooltip">Gửi câu trả lời mẫu</div>
                                                          </div>
                                                       </div>
                                                    </div>
                                                 </span>
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                     <div class="list-setting" style="padding-left: 43px; margin-top: -12px; margin-bottom: 22px;"><span>Chức năng này áp dụng cho trường hợp kịch bản livestream bắt đầu chuyển thành trạng thái đang sử dụng</span></div>
                                     <div class="setting-noti-note"><span class="note">Lưu ý :</span><span class="text-note">Hệ thống chỉ gửi thông báo đến những khách hàng đã từng có tương tác với trang và thời điểm cuối khách hàng nhắn tin với trang không quá 24h.</span></div>
                                  </div>
                                  <div id="general_tip5" class="tab-tip" style="opacity: 0;">
                                     <div>
                                        <span>
                                           <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                              <path d="M11 15.5455C13.5104 15.5455 15.5455 13.5104 15.5455 11C15.5455 8.48966 13.5104 6.45459 11 6.45459C8.48966 6.45459 6.45459 8.48966 6.45459 11C6.45459 13.5104 8.48966 15.5455 11 15.5455Z" stroke="#0088FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M11 1V2.81818" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M11 19.1818V20.9999" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M3.92749 3.92725L5.2184 5.21816" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M16.7817 16.7819L18.0726 18.0728" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M1 11H2.81818" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M19.182 11H21.0002" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M3.92749 18.0728L5.2184 16.7819" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M16.7817 5.21816L18.0726 3.92725" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                           </svg>
                                        </span>
                                        <span class="title">Thông báo khi có video livestream</span>
                                     </div>
                                     <div class="d-flex tip-content">
                                        <div class="left-side" style="width: 23px;">&nbsp;&nbsp;&nbsp;</div>
                                        <div class="wrapper-2">
                                           <span class="content">Tùy vào lựa chọn thời gian gửi mẫu tin nhắn, hệ thống sẽ gửi thông báo khi trang của bạn có kịch bản livestream ở trạng thái đang sử dụng<br></span>
                                           <p style="margin: 10px 0;"><span>Bạn có thể thiết lập các mẫu nội dung phù hợp với video livestream tương ứng với các trang</span><br></p>
                                           <p style="margin: 10px 0; font-style: italic;"><span>Lưu ý: Nếu bạn không nhập nội dung thông báo, hệ thống sẽ không thực hiện gửi tin tự động. </span><br></p>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                            <div class="div-auto-reply">
                               <div class="tab-content auto_order_margin" style="height: 65px;">
                                  <div class="div-action div-edit-auto-reply">
                                     <div class="btn-flt-right">
                                        <span data-tip="true" data-for="btn-demo" currentitem="false"><button type="button" class="btn btn-primary" disabled="" style="cursor: not-allowed; opacity: 0.8;">Xem Demo</button></span>
                                        <div class="form_tooltip place-top type-dark" id="btn-demo" data-id="tooltip">Chưa thể thực hiện chức năng này. Bạn vui lòng tạo ít nhất một mẫu nội dung đặt hàng để xem demo</div>
                                        <button type="button" class="btn btn-primary" style="background: unset; color: rgb(0, 132, 255); box-shadow: none;">Lưu</button><button type="button" class="btn btn-primary">Lưu và kích hoạt</button>
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                      <div id="wrapper-progress-bar" class=""></div>
                   </div>
                   <div class="flash-container"></div>
                </div>
             </div>
            <div id="app" class="d-none" style="height: 100%;">
                <div style="height: 100%; position: relative; overflow: hidden;">
                   <div class="top-bar d-flex justify-content-between align-items-center top-bar-body">
                      <div class="top-bar_list d-flex align-items-center" style="height: 72px;">
                         <div class="d-flex justify-content-between align-items-center top-bar-setting" style="width: 100%;">
                            <div class="align-items-center top_bar_auto_order_redirect pad-left">
                               <div class="current" style="margin-bottom: 5px;">
                                  <h3>Danh sách kịch bản livestream</h3>
                                  <div class="btn_add_new_order"><a href="/facebook/autoOrder-new"><button class="btn btn-primary" style="padding: 5px 20px;">Thêm mới</button></a></div>
                               </div>
                            </div>
                         </div>
                      </div>
                      <div class="user"><a class="button-support" href="#" style="color: black;"><i class="fa fa-2x fa-question-circle-o" aria-hidden="true"></i><span>Trợ giúp</span></a></div>
                      <div class="user user-avatar-for-tooltip" style="cursor: pointer;"><a><img src="https://graph.facebook.com/520662328341312/picture" alt=""><span class="status active"></span></a></div>
                   </div>
                   <div class="modal_version2_container">
                      <iframe id="print-order-iframe" title="title-print-order-iframe" class="d-none"></iframe><iframe id="print-comment-livestream-iframe" title="title-print-comment-livestream-iframe" class="d-none"></iframe>
                      <div></div>
                   </div>
                   <div class="wrapper">
                      <div class="page-content ">
                         <div class="d-flex order_empty_container">
                            <div class="left">
                               <div class="left_title">Bạn chưa có kịch bản livestream nào!</div>
                               <div class="left_content">
                                  <div class="sub_content">Tìm hiểu 3 bước dưới đây để bắt đầu tạo và sử dụng kịch bản bán hàng livestream trên Facebook đầu tiên bạn nhé</div>
                                  <div class="step_1_2_3">
                                     <div class="div_step_content">
                                        <div class="step_by_step">
                                           <div class="step_number"><span>1</span></div>
                                           <div class="step_name">Tạo kịch bản livestream và kích hoạt</div>
                                        </div>
                                        <div class="arrow_down">
                                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                              <polyline points="6 9 12 15 18 9"></polyline>
                                           </svg>
                                        </div>
                                     </div>
                                     <div class="div_step_content">
                                        <div class="step_by_step">
                                           <div class="step_number"><span>2</span></div>
                                           <div class="step_name">Tiến hành phát livestream trên trang Facebook của bạn</div>
                                        </div>
                                        <div class="arrow_down">
                                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                              <polyline points="6 9 12 15 18 9"></polyline>
                                           </svg>
                                        </div>
                                     </div>
                                     <div class="div_step_content">
                                        <div class="step_by_step">
                                           <div class="step_number"><span>3</span></div>
                                           <div class="step_name">Xem thống kê bình luận, đơn hàng theo từng video livestream</div>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="left_button"><button class="btn btn-primary" type="button">Tạo kịch bản bán hàng livestream</button></div>
                                  <div class="left_docs">Xem hướng dẫn chi tiết về tính năng này <span>tại đây</span></div>
                               </div>
                            </div>
                            <div class="right">
                               <div class="image"><img src="https://image.flaticon.com/icons/png/512/2040/2040676.png" alt="order-empty"></div>
                            </div>
                         </div>
                      </div>
                      <div id="wrapper-progress-bar" class=""></div>
                   </div>
                   <div class="flash-container"></div>
                </div>
             </div>
        </div>
    </div>
@endsection
@push('scripts')
   <script src="{{ asset('js\sell_online\facebook\livestream.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

