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
                   {{-- <div class="top-bar d-flex justify-content-between align-items-center top-bar-body">
                      <div class="top-bar_list d-flex align-items-center" style="height: 72px;">
                         <div class="d-flex justify-content-between align-items-center top-bar-setting" style="width: 100%;">
                            <div class="d-flex align-items-center">
                               <h1 style="font-size: 22px;">Cấu hình hệ thống</h1>
                            </div>
                         </div>
                      </div>
                      <div class="user"><a class="button-support" href="#" style="color: black;"><i class="fa fa-2x fa-question-circle-o" aria-hidden="true"></i><span>Trợ giúp</span></a></div>
                      <div class="user user-avatar-for-tooltip" style="cursor: pointer;">
                           <a>
                              <img src="" alt=""><span class="status active"></span></a></div>
                   </div> --}}
                   <div class="top-bar d-flex justify-content-between align-items-center top-bar-body">
                     <div class="top-bar_list d-flex align-items-center" style="height: 72px;">
                        <div class="d-flex justify-content-between align-items-center top-bar-setting" style="width: 100%;">
                           <div class="d-flex align-items-center">
                              <h1 style="font-size: 22px;">Cấu hình hệ thống</h1>
                           </div>
                        </div>
                     </div>
                     <div class="user user-avatar-for-tooltip" style="cursor: pointer;">
                        <div class="dropdown-primary dropdown">
                           <div class="dropdown-toggle" data-toggle="dropdown">
                              <img src="https://graph.facebook.com/520662328341312/picture" alt="">
                              <span class="status active"></span>
                           </div>
                           <ul class="dropdown-menu dropdown-menu-more " data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                              <div class="d-flex align-items-center justify-content-between info">
                                 <div class="d-flex align-items-center">
                                    <div class="avatar"><img src="https://graph.facebook.com/520662328341312/picture" alt=""><span class="status active"></span></div>
                                    <div>
                                       <p>Nguyễn Huy Dũng</p>
                                       <div class="toggle-status-online">
                                          <span class="status active">Trực tuyến</span>
                                          <div class="ml-4">
                                             <input type="checkbox" class="button-toggle js-success" checked="">
                                         </div>
                                       </div>
                                    </div>
                                 </div>
                                 <span class="logout-action" title="Đăng xuất">
                                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <circle cx="18" cy="18" r="18" fill="#F2F2F2"></circle>
                                       <path d="M15 27H11C10.4696 27 9.96086 26.7893 9.58579 26.4142C9.21071 26.0391 9 25.5304 9 25V11C9 10.4696 9.21071 9.96086 9.58579 9.58579C9.96086 9.21071 10.4696 9 11 9H15" stroke="#65676B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                       <path d="M22 23L27 18L22 13" stroke="#65676B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                       <path d="M27 18H15" stroke="#65676B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                 </span>
                              </div>
                              <div class="d-flex align-items-center justify-content-between authorization good">
                                 <div class="d-flex align-items-center">
                                    <svg width="21" height="26" viewBox="0 0 21 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M10.5 25C10.5 25 20 20.2 20 13V4.6L10.5 1L1 4.6V13C1 20.2 10.5 25 10.5 25Z" fill="white" stroke="#55C54D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                       <path d="M15 10L9.5 16L7 13.2727" stroke="#55C54D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <div class="status-content">
                                       <p class="auth-status">Tình trạng cấp quyền</p>
                                       <span class="status">Hoạt động ổn định</span><span class="arrow-right"></span>
                                    </div>
                                 </div>
                                 <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 13L7 7L0.999999 1" stroke="#65676B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                 </svg>
                              </div>
                              <div class="d-flex align-items-center feedback">
                                 <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.22222 2C2.89807 2 2.58719 2.12877 2.35798 2.35798C2.12877 2.58719 2 2.89807 2 3.22222V18.5858L4.73734 15.8484C4.92487 15.6609 5.17923 15.5556 5.44444 15.5556H18.7778C19.1019 15.5556 19.4128 15.4268 19.642 15.1976C19.8712 14.9684 20 14.6575 20 14.3333V3.22222C20 2.89807 19.8712 2.58719 19.642 2.35798C19.4128 2.12877 19.1019 2 18.7778 2H3.22222ZM0.943767 0.943767C1.54805 0.339483 2.36764 0 3.22222 0H18.7778C19.6324 0 20.452 0.339483 21.0562 0.943767C21.6605 1.54805 22 2.36764 22 3.22222V14.3333C22 15.1879 21.6605 16.0075 21.0562 16.6118C20.452 17.2161 19.6324 17.5556 18.7778 17.5556H5.85866L1.70711 21.7071C1.42111 21.9931 0.990991 22.0787 0.617317 21.9239C0.243642 21.7691 0 21.4045 0 21V3.22222C0 2.36764 0.339483 1.54805 0.943767 0.943767ZM11 10C10.4477 10 10 9.55228 10 9V5C10 4.44772 10.4477 4 11 4C11.5523 4 12 4.44772 12 5V9C12 9.55229 11.5523 10 11 10ZM11 13C11.5523 13 12 12.5523 12 12C12 11.4477 11.5523 11 11 11H10.99C10.4377 11 9.99 11.4477 9.99 12C9.99 12.5523 10.4377 13 10.99 13H11Z" fill="#65676B"></path>
                                 </svg>
                                 <div class="feedback-content">
                                    <p class="title-feedback">Đóng góp ý kiến</p>
                                    <span class="content">Góp phần cải thiện phiên bản mới</span>
                                 </div>
                              </div>
                              <div class="action-control">
                                 <div class="d-flex align-items-center justify-content-between item">
                                    <div class="d-flex align-items-center">
                                       <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <circle cx="18" cy="18" r="18" fill="#F2F2F2"></circle>
                                          <path d="M24 14C24 12.4087 23.3679 10.8826 22.2426 9.75736C21.1174 8.63214 19.5913 8 18 8C16.4087 8 14.8826 8.63214 13.7574 9.75736C12.6321 10.8826 12 12.4087 12 14C12 21 9 23 9 23H27C27 23 24 21 24 14Z" stroke="#65676B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                          <path d="M19.73 27C19.5542 27.3031 19.3019 27.5547 18.9982 27.7295C18.6946 27.9044 18.3504 27.9965 18 27.9965C17.6496 27.9965 17.3054 27.9044 17.0018 27.7295C16.6982 27.5547 16.4458 27.3031 16.27 27" stroke="#65676B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                       </svg>
                                       <div class="d-flex new-features" style="cursor: pointer;">
                                          Cập nhật mới
                                          <div class="count-new">2</div>
                                          <div class="btn-pin">
                                             <div class="pin-button-wrapper">
                                                <div class="pin-button" data-tip="true" data-for="tooltip-pin-btn" currentitem="false">
                                                   <span>
                                                      <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                         <path d="M10.3014 0.517212L9.99524 0.82335C9.27618 1.54242 9.17022 2.64546 9.6764 3.47827L6.57938 5.57087L6.52581 5.51731C5.34423 4.33573 3.42163 4.3357 2.24005 5.51731L1.93391 5.82342L5.78088 9.67039L0.769043 14.6823L1.38129 15.2945L6.39313 10.2826L10.2401 14.1296L10.5463 13.8235C11.7279 12.6419 11.7279 10.7193 10.5463 9.53774L10.4927 9.48417L12.5853 6.38715C13.4181 6.89335 14.5212 6.7874 15.2402 6.06831L15.5463 5.7622L10.3014 0.517212ZM10.2094 12.8744L3.18917 5.85415C4.02917 5.29862 5.17438 5.39037 5.91356 6.12952L9.93402 10.15C10.6732 10.8892 10.7649 12.0344 10.2094 12.8744ZM9.86909 8.86055L7.203 6.19446L10.2478 4.13716L11.9264 5.81574L9.86909 8.86055ZM12.7912 5.45606L10.6075 3.27237C10.2084 2.87327 10.1239 2.27689 10.3539 1.79418L14.2694 5.70973C13.7867 5.93973 13.1903 5.85516 12.7912 5.45606Z" fill="#65676B"></path>
                                                      </svg>
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M1 13L7 7L0.999999 1" stroke="#65676B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                 </div>
                                 <div class="d-flex align-items-center justify-content-between item">
                                    <div class="d-flex align-items-center ">
                                       <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <circle cx="18" cy="18" r="18" fill="#F2F2F2"></circle>
                                          <path d="M11 24.75C11 24.1533 11.2371 23.581 11.659 23.159C12.081 22.7371 12.6533 22.5 13.25 22.5H25.4" stroke="#65676B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                          <path d="M13.25 9H25.4V27H13.25C12.6533 27 12.081 26.7629 11.659 26.341C11.2371 25.919 11 25.3467 11 24.75V11.25C11 10.6533 11.2371 10.081 11.659 9.65901C12.081 9.23705 12.6533 9 13.25 9V9Z" stroke="#65676B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                       </svg>
                                       <span>Hướng dẫn sử dụng</span>
                                    </div>
                                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M1 13L7 7L0.999999 1" stroke="#65676B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                 </div>
                                 <div class="d-flex align-items-center justify-content-between item">
                                    <div class="d-flex align-items-center ">
                                       <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <circle cx="18" cy="18" r="18" fill="#F2F2F2"></circle>
                                          <path d="M17.9681 28V24.8127C13.5325 24.5826 10 20.8995 10 16.4108C10 11.7716 13.7716 8 18.4108 8C23.05 8 26.8216 11.7716 26.8216 16.4108C26.8216 20.7933 23.776 25.2023 19.2342 27.3891L17.9681 28ZM18.4108 9.77069C14.7455 9.77069 11.7707 12.7455 11.7707 16.4108C11.7707 20.0761 14.7455 23.0509 18.4108 23.0509H19.7388V25.0872C22.9615 23.0509 25.0509 19.7043 25.0509 16.4108C25.0509 12.7455 22.0761 9.77069 18.4108 9.77069ZM17.5255 19.9522H19.2961V21.7229H17.5255V19.9522ZM19.2961 18.6242H17.5255C17.5255 15.7468 20.1815 15.9681 20.1815 14.1974C20.1815 13.2236 19.3847 12.4267 18.4108 12.4267C17.4369 12.4267 16.6401 13.2236 16.6401 14.1974H14.8694C14.8694 12.2408 16.4542 10.656 18.4108 10.656C20.3674 10.656 21.9522 12.2408 21.9522 14.1974C21.9522 16.4108 19.2961 16.6321 19.2961 18.6242Z" fill="#65676B"></path>
                                       </svg>
                                       <span>Trung tâm trợ giúp</span>
                                    </div>
                                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M1 13L7 7L0.999999 1" stroke="#65676B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                 </div>
                                 <div class="d-flex align-items-center justify-content-between item">
                                    <div class="d-flex align-items-center ">
                                       <svg width="36" height="36" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M32 16C32 24.8366 24.8366 32 16 32C7.16344 32 0 24.8366 0 16C0 7.16344 7.16344 0 16 0C24.8366 0 32 7.16344 32 16Z" fill="#F2F2F2"></path>
                                          <path d="M25.25 9H7.75C6.78349 9 6 9.78349 6 10.75V21.25C6 22.2165 6.78349 23 7.75 23H25.25C26.2165 23 27 22.2165 27 21.25V10.75C27 9.78349 26.2165 9 25.25 9ZM25.5417 21.25C25.5417 21.4108 25.4108 21.5417 25.25 21.5417H7.75C7.58918 21.5417 7.45833 21.4108 7.45833 21.25V10.75C7.45833 10.5892 7.58918 10.4583 7.75 10.4583H25.25C25.4108 10.4583 25.5417 10.5892 25.5417 10.75V21.25ZM12.1979 16.5104V15.4896C12.1979 15.248 12.002 15.0521 11.7604 15.0521H10.7396C10.498 15.0521 10.3021 15.248 10.3021 15.4896V16.5104C10.3021 16.752 10.498 16.9479 10.7396 16.9479H11.7604C12.002 16.9479 12.1979 16.752 12.1979 16.5104ZM15.6979 16.5104V15.4896C15.6979 15.248 15.502 15.0521 15.2604 15.0521H14.2396C13.998 15.0521 13.8021 15.248 13.8021 15.4896V16.5104C13.8021 16.752 13.998 16.9479 14.2396 16.9479H15.2604C15.502 16.9479 15.6979 16.752 15.6979 16.5104ZM19.1979 16.5104V15.4896C19.1979 15.248 19.002 15.0521 18.7604 15.0521H17.7396C17.498 15.0521 17.3021 15.248 17.3021 15.4896V16.5104C17.3021 16.752 17.498 16.9479 17.7396 16.9479H18.7604C19.002 16.9479 19.1979 16.752 19.1979 16.5104ZM22.6979 16.5104V15.4896C22.6979 15.248 22.502 15.0521 22.2604 15.0521H21.2396C20.998 15.0521 20.8021 15.248 20.8021 15.4896V16.5104C20.8021 16.752 20.998 16.9479 21.2396 16.9479H22.2604C22.502 16.9479 22.6979 16.752 22.6979 16.5104ZM10.4479 19.5V18.4792C10.4479 18.2376 10.252 18.0417 10.0104 18.0417H8.98958C8.74797 18.0417 8.55208 18.2376 8.55208 18.4792V19.5C8.55208 19.7416 8.74797 19.9375 8.98958 19.9375H10.0104C10.252 19.9375 10.4479 19.7416 10.4479 19.5ZM24.4479 19.5V18.4792C24.4479 18.2376 24.252 18.0417 24.0104 18.0417H22.9896C22.748 18.0417 22.5521 18.2376 22.5521 18.4792V19.5C22.5521 19.7416 22.748 19.9375 22.9896 19.9375H24.0104C24.252 19.9375 24.4479 19.7416 24.4479 19.5ZM10.4479 13.5208V12.5C10.4479 12.2584 10.252 12.0625 10.0104 12.0625H8.98958C8.74797 12.0625 8.55208 12.2584 8.55208 12.5V13.5208C8.55208 13.7624 8.74797 13.9583 8.98958 13.9583H10.0104C10.252 13.9583 10.4479 13.7624 10.4479 13.5208ZM13.9479 13.5208V12.5C13.9479 12.2584 13.752 12.0625 13.5104 12.0625H12.4896C12.248 12.0625 12.0521 12.2584 12.0521 12.5V13.5208C12.0521 13.7624 12.248 13.9583 12.4896 13.9583H13.5104C13.752 13.9583 13.9479 13.7624 13.9479 13.5208ZM17.4479 13.5208V12.5C17.4479 12.2584 17.252 12.0625 17.0104 12.0625H15.9896C15.748 12.0625 15.5521 12.2584 15.5521 12.5V13.5208C15.5521 13.7624 15.748 13.9583 15.9896 13.9583H17.0104C17.252 13.9583 17.4479 13.7624 17.4479 13.5208ZM20.9479 13.5208V12.5C20.9479 12.2584 20.752 12.0625 20.5104 12.0625H19.4896C19.248 12.0625 19.0521 12.2584 19.0521 12.5V13.5208C19.0521 13.7624 19.248 13.9583 19.4896 13.9583H20.5104C20.752 13.9583 20.9479 13.7624 20.9479 13.5208ZM24.4479 13.5208V12.5C24.4479 12.2584 24.252 12.0625 24.0104 12.0625H22.9896C22.748 12.0625 22.5521 12.2584 22.5521 12.5V13.5208C22.5521 13.7624 22.748 13.9583 22.9896 13.9583H24.0104C24.252 13.9583 24.4479 13.7624 24.4479 13.5208ZM20.875 19.2812V18.6979C20.875 18.4563 20.6791 18.2604 20.4375 18.2604H12.5625C12.3209 18.2604 12.125 18.4563 12.125 18.6979V19.2812C12.125 19.5229 12.3209 19.7188 12.5625 19.7188H20.4375C20.6791 19.7188 20.875 19.5229 20.875 19.2812Z" fill="#4F4F4F"></path>
                                       </svg>
                                       <span>Phím tắt &amp; mẹo (Alt+?)</span>
                                    </div>
                                 </div>
                                 <div class="d-flex align-items-center justify-content-between item">
                                    <div class="d-flex align-items-center ">
                                       <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <circle cx="18" cy="18" r="18" fill="#F2F2F2"></circle>
                                          <path d="M22 10H24C24.5304 10 25.0391 10.2107 25.4142 10.5858C25.7893 10.9609 26 11.4696 26 12V26C26 26.5304 25.7893 27.0391 25.4142 27.4142C25.0391 27.7893 24.5304 28 24 28H12C11.4696 28 10.9609 27.7893 10.5858 27.4142C10.2107 27.0391 10 26.5304 10 26V12C10 11.4696 10.2107 10.9609 10.5858 10.5858C10.9609 10.2107 11.4696 10 12 10H14" stroke="#65676B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                          <path d="M21 8H15C14.4477 8 14 8.44772 14 9V11C14 11.5523 14.4477 12 15 12H21C21.5523 12 22 11.5523 22 11V9C22 8.44772 21.5523 8 21 8Z" stroke="#65676B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                          <path d="M21.5 16.5L16.6875 21.5L14.5 19.2273" stroke="#65676B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                       </svg>
                                       <span>Xem hướng dẫn</span>
                                    </div>
                                 </div>
                              </div>
                           </ul>
                       </div>
                     </div>
                  </div>
                   <div class="modal_version2_container">
                      <iframe id="print-order-iframe" title="title-print-order-iframe" class="d-none"></iframe><iframe id="print-comment-livestream-iframe" title="title-print-comment-livestream-iframe" class="d-none"></iframe>
                      <div></div>
                   </div>
                   <div class="settings_component">
                      <ul class="nav nav_tabs_scroll">
                         <li class="active" data-scroll="#menu_setting">Quản lý trang</li>
                      </ul>
                      <div class="setting_dashboard_container">
                         <div class="guard-wrapper menu-guard" style="height: 100%;">
                            <div class="wrapper" style="">
                               <div class="select-page-menu">
                                  <div class="actions-return"></div>
                                  <div class="wrapper-text-header text-center p-3">
                                     <h4 style="color: rgb(0, 123, 255);">Kết nối trang Facebook của bạn</h4>
                                     <h6>Bạn vui lòng lựa chọn trang và xác nhận kết nối để sử dụng kênh Facebook!</h6>
                                  </div>
                                  <div class="content col-12 text-center">
                                     <div class="d-flex align-items-start justify-content-between">
                                        <div class="wrapper-list-page">
                                           <div class="header-list-page d-flex justify-content-between align-items-center">
                                              <div class="text">Kết nối thêm trang</div>
                                           </div>
                                           {{-- List Page --}}
                                           <div class="list-page list-overflow-auto">

                                           </div>
                                           <div class="footer-list-page d-flex justify-content-between align-items-center">
                                              <div class="wrapper-text">
                                                <span class="quantity">Đã chọn 0 trang</span>
                                                <span class="text-link" onclick="checkAllPage()">Chọn tất cả</span>
                                                <span class="text-link" onclick="removeCheckAllPage()" >Bỏ chọn tất cả</span></div>
                                              <div class="wrapper-button d-flex"><button class="btn btn-primary btn-connect btn-disable d-none" onclick="connectPage()">Xác nhận kết nối</button></div>
                                           </div>
                                        </div>
                                       <div class="user text-center">
                                          <div class="avatar-user-page avatar-ower">
                                              <img src="" alt="avatar">
                                          </div>
                                           Xin chào<span class="name text-ellipsis name-ower"></span><button type="button" class="btn-logout">Đăng xuất khỏi hệ thống</button>
                                        </div>
                                     </div>
                                     <div class="div-notice">
                                        <div class="line1">Bạn có thể kết nối thêm tối đa 3 trang. Để tăng giới hạn kết nối, bạn cần mua thêm trang&nbsp;<span class="clickable">tại đây</span></div>
                                        <div class="line2 clickable">
                                           <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tool">
                                              <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                                           </svg>
                                           &nbsp;Không hiển thị trang mong muốn?
                                        </div>
                                     </div>
                                  </div>
                               </div>
                               <div id="wrapper-progress-bar" class=""></div>
                            </div>
                         </div>
                      </div>
                   </div>
                   <div class="flash-container"></div>
                </div>
             </div>
        </div>
    </div>
@endsection
@push('scripts')
   <script type="text/javascript" src="{{asset('js/sell_online/facebook/config.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

