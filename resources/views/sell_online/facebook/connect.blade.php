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
                  <div class="toggle-full-screen">
                     <div class="chevron-icon chevron-up-icon">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path class="path-1" d="M36 30C36 33.3137 33.3137 36 30 36L10 36L10 -2.27299e-06L30 -5.24537e-07C33.3137 -2.34843e-07 36 2.68629 36 6L36 30Z" fill="#F2F2F2"></path>
                           <path class="path-2" d="M-1.04907e-06 6C-4.69686e-07 2.68629 2.68629 4.69686e-07 6 1.04907e-06L7 1.22392e-06L6.99999 36L5.99999 36C2.68629 36 -5.82475e-06 33.3137 -5.24537e-06 30L-1.04907e-06 6Z" fill="#F2F2F2"></path>
                           <path class="path-3" fill-rule="evenodd" clip-rule="evenodd" d="M21 15V13.475C21 13.0534 20.4404 12.8406 20.1108 13.1401L15.1529 17.6671C14.949 17.8523 14.949 18.1477 15.1529 18.3329L20.1108 22.8599C20.4361 23.1594 21 22.9466 21 22.525V21H29C29.5523 21 30 20.5523 30 20V16C30 15.4477 29.5523 15 29 15H21Z" fill="#65676B"></path>
                        </svg>
                     </div>
                  </div>
                  <div class="top-bar_list d-flex align-items-center" style="height: 72px;">
                     <div class="d-flex justify-content-between align-items-center top-bar-setting" style="width: 100%;">
                        <div class="d-flex align-items-center">
                           <h1 style="font-size: 22px;">Cấu hình hệ thống</h1>
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
               <div class="settings_component">
                  <ul class="nav nav_tabs_scroll">
                     <li class="active" data-scroll="#menu_setting">Quản lý trang</li>
                     <li class="" data-scroll="#general_setting">Cấu hình chung</li>
                     <li class="" data-scroll="#auto_setting_page">Cấu hình riêng cho từng trang<span class="dot-red"></span></li>
                  </ul>
                  <div class="setting_dashboard_container">
                     <div class="guard-wrapper menu-guard" style="height: 100%;">

                        <div class="wrapper" style="display: none;">
                           <div class="select-page-menu">
                              <div class="actions-return"></div>
                              <div class="wrapper-text-header one-line"></div>
                              <div class="content col-12 text-center">
                                 <div class="d-flex align-items-start justify-content-between">
                                    <div class="wrapper-list-page">
                                       <div class="header-list-page d-flex justify-content-between align-items-center">
                                          <div class="text">Quản lý trang đã kết nối (2/3)</div>
                                          <span data-tip="true" data-for="button-connect-more" class="button-connect-more d-flex align-items-center ">
                                             <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="7.5" cy="7.5" r="6.9" fill="white" stroke="#0084FF" stroke-width="1.2"></circle>
                                                <path d="M7.5 3.75V11.25" stroke="#0084FF" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M3.75 7.5H11.25" stroke="#0084FF" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                                             </svg>
                                             Kết nối trang khác
                                          </span>
                                       </div>
                                       <div class="list-page list-overflow-auto">
                                          <div class="item d-flex align-items-center  ">
                                             <div class="avatar"><img src="https://graph.facebook.com/104163647950733/picture?type=large" alt="not found"></div>
                                             <div class="info">
                                                <h3 class="text-ellipsis">Sim Số Đây</h3>
                                                <div class="d-flex">
                                                   <span class="status">
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                                         <polyline points="20 6 9 17 4 12"></polyline>
                                                      </svg>
                                                      Đã kết nối
                                                   </span>
                                                </div>
                                             </div>
                                             <div class="wrapper-checkbox">
                                                <div class="checkbox-circle-component">
                                                   <div class="checkbox-circle-content ">
                                                      <span>
                                                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check" style="position: absolute;">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                         </svg>
                                                      </span>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="item d-flex align-items-center  " style="border-width: 0;">
                                             <div class="avatar"><img src="https://graph.facebook.com/563066984185906/picture?type=large" alt="not found"></div>
                                             <div class="info">
                                                <h3 class="text-ellipsis">Tiền Seri Ngày Tháng Năm Sinh</h3>
                                                <div class="d-flex">
                                                   <span class="status">
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                                         <polyline points="20 6 9 17 4 12"></polyline>
                                                      </svg>
                                                      Đã kết nối
                                                   </span>
                                                </div>
                                             </div>
                                             <div class="wrapper-checkbox">
                                                <div class="checkbox-circle-component">
                                                   <div class="checkbox-circle-content ">
                                                      <span>
                                                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check" style="position: absolute;">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                         </svg>
                                                      </span>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="footer-list-page d-flex justify-content-between align-items-center">
                                          <div class="wrapper-text"><span class="quantity">Đã chọn 0 trang</span><span class="text-link">Chọn tất cả</span><span class="text-link">Bỏ chọn tất cả</span></div>
                                          <div class="wrapper-button d-flex"><button class="btn btn-outline-danger btn-remove btn-disable">Gỡ kết nối</button><button class="btn btn-primary btn-connect btn-disable">Truy cập</button></div>
                                       </div>
                                    </div>
                                    <div class="user text-center">
                                       <div class="avatar"><img src="https://graph.facebook.com/520662328341312/picture?width=200&amp;height=200" alt="avatar"></div>
                                       Xin chào<span class="name text-ellipsis">Nguyễn Huy Dũng</span><button type="button" class="btn-logout">Đăng xuất khỏi hệ thống</button>
                                    </div>
                                 </div>
                                 <div class="div-notice">
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
   <script src="{{ asset('..\js\sell_online\facebook\config.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

