@extends('layouts.layout')
@section('content')
    <div class="page-wrapper message-pages-choose">
        {{--        <div class="page-header">--}}
        {{--            <div class="row align-items-end">--}}
        {{--                <div class="col-lg-8">--}}
        {{--                    <div class="page-header-title">--}}
        {{--                        <div class="d-inline">--}}
        {{--                            <h4>@lang('app.facebook_auth.title')</h4>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="col-lg-4">--}}
        {{--                    <div class="page-header-breadcrumb">--}}
        {{--                        <ul class="breadcrumb-title">--}}
        {{--                            <li class="breadcrumb-item">--}}
        {{--                                <a href="/"> <i class="feather icon-home"></i> </a>--}}
        {{--                            </li>--}}
        {{--                            <li class="breadcrumb-item"><a--}}
        {{--                                    href="">@lang('app.facebook_auth.breadcrumb')</a>--}}
        {{--                            </li>--}}
        {{--                        </ul>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <div class="page-body">
            <div class="card">
                <div id="app" style="height: 100%;">
                    <div style="height: 100%; position: relative; overflow: hidden;">
                        <div class="top-bar d-flex justify-content-between align-items-center top-bar-body">
                            <div class="top-bar_list d-flex align-items-center" style="width: calc(100% - 120px);">
                                <div class="conversation-topbar d-flex align-items-center ">
                                    <div class="topbar-title mr-2">@lang('app.facebook_auth.messenger-facebook.title')</div>
                                    <div class="topbar-filter-pages">
                                        <div class="conversation-filter-pages">
                                            <div class="div-filter-pages">
                                                <div class="count-page-selected-component" id="count-page-selected">
                                                    <div class="dropdown-primary dropdown w-100">
                                                        <div class="dropdown-toggle dropdown-list-page row"
                                                             data-toggle="dropdown" id="page-selected-message-facebook">

                                                        </div>
                                                        <ul class="show-list-page profile-page dropdown-menu"
                                                            data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                            <div class="form-content">
                                                                <div class="form-top">
                                                                    <span class="">Chọn trang bạn muốn xem</span>
                                                                </div>
                                                                <div class="form-search-page">
                                                                    <input id="search-page-name" class="form-control"
                                                                           type="text" placeholder="Tìm kiếm" value="">
                                                                    <span id="svg-search-page"></span>
                                                                </div>
                                                                <div class="form-list-pages">
                                                                    <div class="list-pages-connected"
                                                                         id="list-page-message-facebook">
                                                                        {{--Data--}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="user user-avatar-for-tooltip" style="cursor: pointer;">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="https://graph.facebook.com/520662328341312/picture" alt="">
                                        <span class="status active"></span>
                                    </div>
                                    <ul class="dropdown-menu dropdown-menu-more " data-dropdown-in="fadeIn"
                                        data-dropdown-out="fadeOut">
                                        <div class="d-flex align-items-center justify-content-between info">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar"><img
                                                            src="https://graph.facebook.com/520662328341312/picture"
                                                            alt=""><span class="status active"></span></div>
                                                <div>
                                                    <p>Nguyễn Huy Dũng</p>
                                                    <div class="toggle-status-online">
                                                        <span class="status active">@lang('app.facebook_auth.messenger-facebook.profile-user.status.online')</span>
                                                        <div class="ml-4">
                                                            <input type="checkbox" class="button-toggle js-success"
                                                                   checked="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="logout-action" title="Đăng xuất">
                                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                       <circle cx="18" cy="18" r="18" fill="#F2F2F2"></circle>
                                       <path d="M15 27H11C10.4696 27 9.96086 26.7893 9.58579 26.4142C9.21071 26.0391 9 25.5304 9 25V11C9 10.4696 9.21071 9.96086 9.58579 9.58579C9.96086 9.21071 10.4696 9 11 9H15"
                                             stroke="#65676B" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round"></path>
                                       <path d="M22 23L27 18L22 13" stroke="#65676B" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"></path>
                                       <path d="M27 18H15" stroke="#65676B" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round"></path>
                                    </svg>
                                 </span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between authorization good">
                                            <div class="d-flex align-items-center">
                                                <svg width="21" height="26" viewBox="0 0 21 26" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.5 25C10.5 25 20 20.2 20 13V4.6L10.5 1L1 4.6V13C1 20.2 10.5 25 10.5 25Z"
                                                          fill="white" stroke="#55C54D" stroke-width="2"
                                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M15 10L9.5 16L7 13.2727" stroke="#55C54D" stroke-width="2"
                                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                <div class="status-content">
                                                    <p class="auth-status">Tình trạng cấp quyền</p>
                                                    <span class="status">Hoạt động ổn định</span>
                                                    <span class="arrow-right"></span>
                                                </div>
                                            </div>
                                            <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 13L7 7L0.999999 1" stroke="#65676B" stroke-width="2"
                                                      stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </div>
                                        <div class="d-flex align-items-center feedback">
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M3.22222 2C2.89807 2 2.58719 2.12877 2.35798 2.35798C2.12877 2.58719 2 2.89807 2 3.22222V18.5858L4.73734 15.8484C4.92487 15.6609 5.17923 15.5556 5.44444 15.5556H18.7778C19.1019 15.5556 19.4128 15.4268 19.642 15.1976C19.8712 14.9684 20 14.6575 20 14.3333V3.22222C20 2.89807 19.8712 2.58719 19.642 2.35798C19.4128 2.12877 19.1019 2 18.7778 2H3.22222ZM0.943767 0.943767C1.54805 0.339483 2.36764 0 3.22222 0H18.7778C19.6324 0 20.452 0.339483 21.0562 0.943767C21.6605 1.54805 22 2.36764 22 3.22222V14.3333C22 15.1879 21.6605 16.0075 21.0562 16.6118C20.452 17.2161 19.6324 17.5556 18.7778 17.5556H5.85866L1.70711 21.7071C1.42111 21.9931 0.990991 22.0787 0.617317 21.9239C0.243642 21.7691 0 21.4045 0 21V3.22222C0 2.36764 0.339483 1.54805 0.943767 0.943767ZM11 10C10.4477 10 10 9.55228 10 9V5C10 4.44772 10.4477 4 11 4C11.5523 4 12 4.44772 12 5V9C12 9.55229 11.5523 10 11 10ZM11 13C11.5523 13 12 12.5523 12 12C12 11.4477 11.5523 11 11 11H10.99C10.4377 11 9.99 11.4477 9.99 12C9.99 12.5523 10.4377 13 10.99 13H11Z"
                                                      fill="#65676B"></path>
                                            </svg>
                                            <div class="feedback-content">
                                                <p class="title-feedback">
                                                    >@lang('app.facebook_auth.messenger-facebook.profile-user.feed-back')</p>
                                                <span class="content">Góp phần cải thiện phiên bản mới</span>
                                            </div>
                                        </div>
                                        <div class="action-control">
                                            <div class="d-flex align-items-center justify-content-between item">
                                                <div class="d-flex align-items-center">
                                                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="18" cy="18" r="18" fill="#F2F2F2"></circle>
                                                        <path d="M24 14C24 12.4087 23.3679 10.8826 22.2426 9.75736C21.1174 8.63214 19.5913 8 18 8C16.4087 8 14.8826 8.63214 13.7574 9.75736C12.6321 10.8826 12 12.4087 12 14C12 21 9 23 9 23H27C27 23 24 21 24 14Z"
                                                              stroke="#65676B" stroke-width="2" stroke-linecap="round"
                                                              stroke-linejoin="round"></path>
                                                        <path d="M19.73 27C19.5542 27.3031 19.3019 27.5547 18.9982 27.7295C18.6946 27.9044 18.3504 27.9965 18 27.9965C17.6496 27.9965 17.3054 27.9044 17.0018 27.7295C16.6982 27.5547 16.4458 27.3031 16.27 27"
                                                              stroke="#65676B" stroke-width="2" stroke-linecap="round"
                                                              stroke-linejoin="round"></path>
                                                    </svg>
                                                    <div class="d-flex new-features" style="cursor: pointer;">
                                                        @lang('app.facebook_auth.messenger-facebook.profile-user.update-version')
                                                        <div class="count-new">2</div>
                                                        <div class="btn-pin">
                                                            <div class="pin-button-wrapper">
                                                                <div class="pin-button" data-tip="true"
                                                                     data-for="tooltip-pin-btn" currentitem="false">
                                                   <span>
                                                      <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                           xmlns="http://www.w3.org/2000/svg">
                                                         <path d="M10.3014 0.517212L9.99524 0.82335C9.27618 1.54242 9.17022 2.64546 9.6764 3.47827L6.57938 5.57087L6.52581 5.51731C5.34423 4.33573 3.42163 4.3357 2.24005 5.51731L1.93391 5.82342L5.78088 9.67039L0.769043 14.6823L1.38129 15.2945L6.39313 10.2826L10.2401 14.1296L10.5463 13.8235C11.7279 12.6419 11.7279 10.7193 10.5463 9.53774L10.4927 9.48417L12.5853 6.38715C13.4181 6.89335 14.5212 6.7874 15.2402 6.06831L15.5463 5.7622L10.3014 0.517212ZM10.2094 12.8744L3.18917 5.85415C4.02917 5.29862 5.17438 5.39037 5.91356 6.12952L9.93402 10.15C10.6732 10.8892 10.7649 12.0344 10.2094 12.8744ZM9.86909 8.86055L7.203 6.19446L10.2478 4.13716L11.9264 5.81574L9.86909 8.86055ZM12.7912 5.45606L10.6075 3.27237C10.2084 2.87327 10.1239 2.27689 10.3539 1.79418L14.2694 5.70973C13.7867 5.93973 13.1903 5.85516 12.7912 5.45606Z"
                                                               fill="#65676B"></path>
                                                      </svg>
                                                   </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 13L7 7L0.999999 1" stroke="#65676B" stroke-width="2"
                                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between item">
                                                <div class="d-flex align-items-center ">
                                                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="18" cy="18" r="18" fill="#F2F2F2"></circle>
                                                        <path d="M11 24.75C11 24.1533 11.2371 23.581 11.659 23.159C12.081 22.7371 12.6533 22.5 13.25 22.5H25.4"
                                                              stroke="#65676B" stroke-width="2" stroke-linecap="round"
                                                              stroke-linejoin="round"></path>
                                                        <path d="M13.25 9H25.4V27H13.25C12.6533 27 12.081 26.7629 11.659 26.341C11.2371 25.919 11 25.3467 11 24.75V11.25C11 10.6533 11.2371 10.081 11.659 9.65901C12.081 9.23705 12.6533 9 13.25 9V9Z"
                                                              stroke="#65676B" stroke-width="2" stroke-linecap="round"
                                                              stroke-linejoin="round"></path>
                                                    </svg>
                                                    <span>@lang('app.facebook_auth.messenger-facebook.profile-user.instructions')</span>
                                                </div>
                                                <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 13L7 7L0.999999 1" stroke="#65676B" stroke-width="2"
                                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between item">
                                                <div class="d-flex align-items-center ">
                                                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="18" cy="18" r="18" fill="#F2F2F2"></circle>
                                                        <path d="M17.9681 28V24.8127C13.5325 24.5826 10 20.8995 10 16.4108C10 11.7716 13.7716 8 18.4108 8C23.05 8 26.8216 11.7716 26.8216 16.4108C26.8216 20.7933 23.776 25.2023 19.2342 27.3891L17.9681 28ZM18.4108 9.77069C14.7455 9.77069 11.7707 12.7455 11.7707 16.4108C11.7707 20.0761 14.7455 23.0509 18.4108 23.0509H19.7388V25.0872C22.9615 23.0509 25.0509 19.7043 25.0509 16.4108C25.0509 12.7455 22.0761 9.77069 18.4108 9.77069ZM17.5255 19.9522H19.2961V21.7229H17.5255V19.9522ZM19.2961 18.6242H17.5255C17.5255 15.7468 20.1815 15.9681 20.1815 14.1974C20.1815 13.2236 19.3847 12.4267 18.4108 12.4267C17.4369 12.4267 16.6401 13.2236 16.6401 14.1974H14.8694C14.8694 12.2408 16.4542 10.656 18.4108 10.656C20.3674 10.656 21.9522 12.2408 21.9522 14.1974C21.9522 16.4108 19.2961 16.6321 19.2961 18.6242Z"
                                                              fill="#65676B"></path>
                                                    </svg>
                                                    <span>@lang('app.facebook_auth.messenger-facebook.profile-user.support-center')</span>
                                                </div>
                                                <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 13L7 7L0.999999 1" stroke="#65676B" stroke-width="2"
                                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between item">
                                                <div class="d-flex align-items-center ">
                                                    <svg width="36" height="36" viewBox="0 0 32 32" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M32 16C32 24.8366 24.8366 32 16 32C7.16344 32 0 24.8366 0 16C0 7.16344 7.16344 0 16 0C24.8366 0 32 7.16344 32 16Z"
                                                              fill="#F2F2F2"></path>
                                                        <path d="M25.25 9H7.75C6.78349 9 6 9.78349 6 10.75V21.25C6 22.2165 6.78349 23 7.75 23H25.25C26.2165 23 27 22.2165 27 21.25V10.75C27 9.78349 26.2165 9 25.25 9ZM25.5417 21.25C25.5417 21.4108 25.4108 21.5417 25.25 21.5417H7.75C7.58918 21.5417 7.45833 21.4108 7.45833 21.25V10.75C7.45833 10.5892 7.58918 10.4583 7.75 10.4583H25.25C25.4108 10.4583 25.5417 10.5892 25.5417 10.75V21.25ZM12.1979 16.5104V15.4896C12.1979 15.248 12.002 15.0521 11.7604 15.0521H10.7396C10.498 15.0521 10.3021 15.248 10.3021 15.4896V16.5104C10.3021 16.752 10.498 16.9479 10.7396 16.9479H11.7604C12.002 16.9479 12.1979 16.752 12.1979 16.5104ZM15.6979 16.5104V15.4896C15.6979 15.248 15.502 15.0521 15.2604 15.0521H14.2396C13.998 15.0521 13.8021 15.248 13.8021 15.4896V16.5104C13.8021 16.752 13.998 16.9479 14.2396 16.9479H15.2604C15.502 16.9479 15.6979 16.752 15.6979 16.5104ZM19.1979 16.5104V15.4896C19.1979 15.248 19.002 15.0521 18.7604 15.0521H17.7396C17.498 15.0521 17.3021 15.248 17.3021 15.4896V16.5104C17.3021 16.752 17.498 16.9479 17.7396 16.9479H18.7604C19.002 16.9479 19.1979 16.752 19.1979 16.5104ZM22.6979 16.5104V15.4896C22.6979 15.248 22.502 15.0521 22.2604 15.0521H21.2396C20.998 15.0521 20.8021 15.248 20.8021 15.4896V16.5104C20.8021 16.752 20.998 16.9479 21.2396 16.9479H22.2604C22.502 16.9479 22.6979 16.752 22.6979 16.5104ZM10.4479 19.5V18.4792C10.4479 18.2376 10.252 18.0417 10.0104 18.0417H8.98958C8.74797 18.0417 8.55208 18.2376 8.55208 18.4792V19.5C8.55208 19.7416 8.74797 19.9375 8.98958 19.9375H10.0104C10.252 19.9375 10.4479 19.7416 10.4479 19.5ZM24.4479 19.5V18.4792C24.4479 18.2376 24.252 18.0417 24.0104 18.0417H22.9896C22.748 18.0417 22.5521 18.2376 22.5521 18.4792V19.5C22.5521 19.7416 22.748 19.9375 22.9896 19.9375H24.0104C24.252 19.9375 24.4479 19.7416 24.4479 19.5ZM10.4479 13.5208V12.5C10.4479 12.2584 10.252 12.0625 10.0104 12.0625H8.98958C8.74797 12.0625 8.55208 12.2584 8.55208 12.5V13.5208C8.55208 13.7624 8.74797 13.9583 8.98958 13.9583H10.0104C10.252 13.9583 10.4479 13.7624 10.4479 13.5208ZM13.9479 13.5208V12.5C13.9479 12.2584 13.752 12.0625 13.5104 12.0625H12.4896C12.248 12.0625 12.0521 12.2584 12.0521 12.5V13.5208C12.0521 13.7624 12.248 13.9583 12.4896 13.9583H13.5104C13.752 13.9583 13.9479 13.7624 13.9479 13.5208ZM17.4479 13.5208V12.5C17.4479 12.2584 17.252 12.0625 17.0104 12.0625H15.9896C15.748 12.0625 15.5521 12.2584 15.5521 12.5V13.5208C15.5521 13.7624 15.748 13.9583 15.9896 13.9583H17.0104C17.252 13.9583 17.4479 13.7624 17.4479 13.5208ZM20.9479 13.5208V12.5C20.9479 12.2584 20.752 12.0625 20.5104 12.0625H19.4896C19.248 12.0625 19.0521 12.2584 19.0521 12.5V13.5208C19.0521 13.7624 19.248 13.9583 19.4896 13.9583H20.5104C20.752 13.9583 20.9479 13.7624 20.9479 13.5208ZM24.4479 13.5208V12.5C24.4479 12.2584 24.252 12.0625 24.0104 12.0625H22.9896C22.748 12.0625 22.5521 12.2584 22.5521 12.5V13.5208C22.5521 13.7624 22.748 13.9583 22.9896 13.9583H24.0104C24.252 13.9583 24.4479 13.7624 24.4479 13.5208ZM20.875 19.2812V18.6979C20.875 18.4563 20.6791 18.2604 20.4375 18.2604H12.5625C12.3209 18.2604 12.125 18.4563 12.125 18.6979V19.2812C12.125 19.5229 12.3209 19.7188 12.5625 19.7188H20.4375C20.6791 19.7188 20.875 19.5229 20.875 19.2812Z"
                                                              fill="#4F4F4F"></path>
                                                    </svg>
                                                    <span>@lang('app.facebook_auth.messenger-facebook.profile-user.shortcuts-and-tip')<</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between item">
                                                <div class="d-flex align-items-center ">
                                                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="18" cy="18" r="18" fill="#F2F2F2"></circle>
                                                        <path d="M22 10H24C24.5304 10 25.0391 10.2107 25.4142 10.5858C25.7893 10.9609 26 11.4696 26 12V26C26 26.5304 25.7893 27.0391 25.4142 27.4142C25.0391 27.7893 24.5304 28 24 28H12C11.4696 28 10.9609 27.7893 10.5858 27.4142C10.2107 27.0391 10 26.5304 10 26V12C10 11.4696 10.2107 10.9609 10.5858 10.5858C10.9609 10.2107 11.4696 10 12 10H14"
                                                              stroke="#65676B" stroke-width="2" stroke-linecap="round"
                                                              stroke-linejoin="round"></path>
                                                        <path d="M21 8H15C14.4477 8 14 8.44772 14 9V11C14 11.5523 14.4477 12 15 12H21C21.5523 12 22 11.5523 22 11V9C22 8.44772 21.5523 8 21 8Z"
                                                              stroke="#65676B" stroke-width="2" stroke-linecap="round"
                                                              stroke-linejoin="round"></path>
                                                        <path d="M21.5 16.5L16.6875 21.5L14.5 19.2273" stroke="#65676B"
                                                              stroke-width="2" stroke-linecap="round"
                                                              stroke-linejoin="round"></path>
                                                    </svg>
                                                    <span>@lang('app.facebook_auth.messenger-facebook.profile-user.instructions')</span>
                                                </div>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="wrapper">
                            <div class="page-content ">
                                <div class="d-flex conversation height-defauld">
                                    <div class="col-left react-draggable"
                                         style="position: relative; user-select: auto; height: 100%; display: inline-block; top: 0; left: 0; cursor: auto; transform: translate(0px, 0); max-width: 629.6px; max-height: 9.0072e+15px; min-width: 314.8px; box-sizing: border-box; flex-shrink: 0;">
                                        <div class="d-flex flex-wrap align-items-center conversation-filter-header horizontal justify-content-space"
                                             style="box-shadow: none; padding-top: 11px;">
                                            <div class="input-base-wrapper ">
                                                <input class="input-base " placeholder="Tìm kiếm (F3)" type="text"
                                                       autocomplete="off" value="">
                                            </div>
                                        </div>
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                                 aria-labelledby="pills-home-tab">
                                            </div>
                                        </div>
                                        {{-- </div> --}}
                                        <div class="conversation-list" style="height:100vh">
                                            <div class="people scrollable conv-list" style="height: 100%;">
                                                <div id="conv-scrollbar"
                                                     style="position: relative; overflow: hidden; width: 100%; height: 100%;">
                                                    {{-- Danh sách các tin nhắn --}}
                                                    <div id="list-user-message-facebook"
                                                         style="position: absolute; inset: 0; overflow: scroll; margin-right: -10px; margin-bottom: -10px;">
                                                        <div style="position: absolute; left: 0; top: 0; height: 98px; width: 100%;">
                                                            <div class="d-flex conversation-item conversation-active ">
                                                                <div class="position-relative conversation-item-avatar">
                                                                    <img src="https://social.dktcdn.net/facebook/447193739379428/4078607595507060.jpg"
                                                                         class="img-uploaded"
                                                                         style="animation: 0s ease-in-out 0s 0 normal none running bounceIn;">
                                                                </div>
                                                                <div class="d-flex item-wrapper">
                                                                    <div class="conversation-item-content">
                                                                        <div class="d-flex"><span
                                                                                    class="sender">Yến Nhi</span></div>
                                                                        <div class="conversation-content"><span><span>???</span></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="conversation-item-meta">
                                                                        <div class="d-flex conversation-meta-first-row">
                                                                            <span class="conversation-time-stamp">17:30</span><span></span>
                                                                        </div>
                                                                        <div class="d-flex justify-content-end conversation-item-second-row"></div>
                                                                    </div>
                                                                    <div class="flex-wrap item-info"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- DANH SÁCH TIN NHẮN PAGE --}}
                                    <div class="dialogue-conversation" style="width: calc(100% - 764px);">
                                        <div class="header-detail  d-flex justify-content-between align-items-center">
                                            <div class="d-flex header-detail-left">
                                                <div class="user d-flex align-items-center">
                                                    <img src="https://graph.facebook.com/5201141863236625/picture?access_token=EAAZAZALTbNShQBAAZBdO6gBWge4h7ZAZC4qCtwEM7RjgBLKxzWZCbWs1bE80le3mqLN4PuFauKvYXsRwo19Qgd7waE0EnGr6hYuIvClHS1bCHYKZCKHnKCJo1nDl8x67mkwv8IhpkNIQcRtbQtMwrPorZCjQLYfbmd2571CthZCMVbkZArEIHYGbbmjwXLOexUoggYecAYsOVZC3QZDZD"
                                                         alt="avatar">
                                                    <div class="user-name-meta-data">
                                                        <span class="user-name">Yến Nhi</span>
                                                        <div><span class="meta-data" data-tip="true"
                                                                   data-for="_seen_conversation"
                                                                   currentitem="false">Đã xem</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="assign-from-header-a-conversation d-flex align-items-center">
                                                    <div class="assign d-flex align-items-center">
                                                        <div class="d-flex assign-detail assign-icon">
                                                            <div class="div-assign-select div-assign-unselected">
                                                                <div class="btn-select-admin">
                                                  <span data-tip="true" data-for="user_icon" currentitem="false">
                                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                          viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                          stroke-width="2" stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          class="feather feather-user-plus assign_svg">
                                                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                        <circle cx="8.5" cy="7" r="4"></circle>
                                                        <line x1="20" y1="8" x2="20" y2="14"></line>
                                                        <line x1="23" y1="11" x2="17" y2="11"></line>
                                                     </svg>
                                                  </span>
                                                                    <div class="form_tooltip place-right type-dark"
                                                                         id="user_icon" data-id="tooltip">Phân chia
                                                                        người hỗ trợ
                                                                    </div>
                                                                </div>
                                                                <div class="circle-ripple-mini"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end header-detail-right">
                                                <div class="d-flex align-items-center">
                                      <span class="action-button-hover messenger-icon">
                                         <svg width="18" height="15" viewBox="0 0 18 15" fill="none"
                                              xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.8 0.75H16.2C16.7472 0.75 17.25 1.22881 17.25 1.875V13.125C17.25 13.7712 16.7472 14.25 16.2 14.25H1.8C1.25277 14.25 0.75 13.7712 0.75 13.125V1.875C0.75 1.22881 1.25277 0.75 1.8 0.75Z"
                                                  stroke="#65676B" stroke-width="1.5" stroke-linecap="round"
                                                  stroke-linejoin="round"></path>
                                            <path d="M17 4L9 9L1 4" stroke="#65676B" stroke-width="1.5"
                                                  stroke-linecap="round" stroke-linejoin="round"></path>
                                         </svg>
                                      </span>
                                                    <div class="form_tooltip place-right type-dark"
                                                         id="mark-not-done"
                                                         data-id="tooltip">Đánh dấu là chưa đọc
                                                    </div>
                                                    <span class="d-flex align-items-center justify-content-between box-icon-display"
                                                          data-tip="true" data-for="_fill_reaction"
                                                          currentitem="false">
                                         <svg width="18" height="15" viewBox="0 0 18 15" fill="none"
                                              xmlns="http://www.w3.org/2000/svg" class="box-icon">
                                            <path d="M17 7.40002H12.2L10.6 9.80002H7.4L5.8 7.40002H1" stroke="#90949C"
                                                  stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M3.76 1.888L1 7.4V12.2C1 12.6243 1.16857 13.0313 1.46863 13.3314C1.76869 13.6314 2.17565 13.8 2.6 13.8H15.4C15.8243 13.8 16.2313 13.6314 16.5314 13.3314C16.8314 13.0313 17 12.6243 17 12.2V7.4L14.24 1.888C14.1075 1.62143 13.9033 1.3971 13.6504 1.24022C13.3974 1.08335 13.1057 1.00016 12.808 1H5.192C4.89433 1.00016 4.60261 1.08335 4.34964 1.24022C4.09666 1.3971 3.89246 1.62143 3.76 1.888V1.888Z"
                                                  stroke="#90949C" stroke-linecap="round"
                                                  stroke-linejoin="round"></path>
                                         </svg>
                                         <span class="conversation-count">1</span>
                                      </span>
                                                    <div class="form_tooltip place-right type-dark"
                                                         id="_fill_reaction"
                                                         data-id="tooltip" style="left: 1122px; top: 72px;">Lọc
                                                        tương
                                                        tác
                                                    </div>
                                                    <a class="action-button-hover"
                                                       href="//facebook.com/563066984185906/inbox/1135404613618804/"
                                                       target="_blank" data-tip="true"
                                                       data-for="_direct_messenger_fb"
                                                       currentitem="false" style="margin-right: 5px;">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M3.32887 14.6306L3.32679 14.6287C1.73467 13.2046 0.75 11.1406 0.75 8.73018C0.75 4.15508 4.31649 0.75 9 0.75C13.6835 0.75 17.25 4.15508 17.25 8.73018C17.25 13.3053 13.6835 16.7104 9 16.7104C8.15483 16.7104 7.34737 16.5995 6.59366 16.3915L6.5915 16.3909C6.26529 16.3019 5.92052 16.3284 5.61195 16.4643L5.61156 16.4645L3.86662 17.2343L3.81908 15.6773L3.81891 15.6727C3.80392 15.2643 3.61995 14.8929 3.32887 14.6306Z"
                                                                  stroke="rgb(144, 148, 156)"
                                                                  stroke-width="1"></path>
                                                            <path class="path-fill" fill-rule="evenodd"
                                                                  clip-rule="evenodd"
                                                                  d="M3.59636 11.2836L6.24022 7.08961C6.66034 6.42322 7.56215 6.25662 8.19234 6.72925L10.2947 8.30652C10.4885 8.45138 10.7529 8.44957 10.9449 8.3047L13.7843 6.14977C14.1628 5.86185 14.6589 6.31637 14.4036 6.71839L11.7615 10.9105C11.3414 11.5769 10.4396 11.7435 9.80944 11.2709L7.70702 9.69364C7.51326 9.54877 7.24887 9.55058 7.05692 9.69545L4.21568 11.8522C3.8372 12.1401 3.34103 11.6856 3.59636 11.2836Z"
                                                                  fill="rgb(144, 148, 156)" stroke-width="1"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="form_tooltip place-right type-dark"
                                                         id="_direct_messenger_fb" data-id="tooltip">Chuyển đến
                                                        trang
                                                        tin nhắn
                                                    </div>
                                                    <a class="d-flex align-items-center action-button-hover"
                                                       data-tip="true" data-for="_report_customer"
                                                       currentitem="false"
                                                       style="margin-right: 5px;">
                                                        <svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9 4V8" stroke="#90949C" stroke-width="2"
                                                                  stroke-linecap="round"
                                                                  stroke-linejoin="round"></path>
                                                            <path d="M9 12H9.01" stroke="#90949C" stroke-width="2"
                                                                  stroke-linecap="round"
                                                                  stroke-linejoin="round"></path>
                                                            <rect x="0.5" y="0.5" width="17" height="15" rx="2.5"
                                                                  stroke="#90949C"></rect>
                                                        </svg>
                                                    </a>
                                                    <div class="form_tooltip place-right type-dark"
                                                         id="_report_customer" data-id="tooltip"
                                                         style="left: 1188px; top: 72px;">Báo xấu khách hàng
                                                    </div>
                                                    <a class="d-flex align-items-center action-button-hover"
                                                       data-tip="true" data-for="_block_user_fb" currentitem="false"
                                                       style="margin-right: 7px;">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9 16.5C13.1421 16.5 16.5 13.1421 16.5 9C16.5 4.85786 13.1421 1.5 9 1.5C4.85786 1.5 1.5 4.85786 1.5 9C1.5 13.1421 4.85786 16.5 9 16.5Z"
                                                                  stroke="#90949C" stroke-width="1.25"
                                                                  stroke-linecap="round"
                                                                  stroke-linejoin="round"></path>
                                                            <path d="M13.5 4.04999L4.5 13.95" stroke="#90949C"
                                                                  stroke-width="1.25" stroke-linecap="round"
                                                                  stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="form_tooltip place-right type-dark"
                                                         id="_block_user_fb"
                                                         data-id="tooltip">Chặn khách hàng
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dialogue-list-metadata-wrapper">
                                            <div class="dialogue-content-wrapper">
                                                <div class="dialogue-content-view">
                                                    <div class="messenger-scroll" data-selector="scrollbar"
                                                         style="position: relative; overflow: hidden; width: 100%; height: 100%;">
                                                        <div style="position: absolute; inset: 0; overflow: scroll; margin-right: -10px; margin-bottom: -10px;">
                                                            <div class="dialogue-content">
                                                                <div class="message-list-viewer">
                                                                </div>
                                                            </div>
                                                            <div class="blank-space"></div>
                                                        </div>
                                                        <div class="track-horizontal"
                                                             style="display: none; opacity: 0;">
                                                            <div class="thumb-horizontal"
                                                                 style="display: none; width: 0;"></div>
                                                        </div>
                                                        <div style="position: absolute; width: 6px; transition: opacity 200ms ease 0s; opacity: 0; right: 2px; bottom: 2px; top: 2px; border-radius: 3px;">
                                                            <div style="position: relative; display: block; width: 100%; cursor: pointer; border-radius: inherit; background-color: rgba(0, 0, 0, 0.2); height: 87px; transform: translateY(0px);"></div>
                                                        </div>
                                                    </div>
                                                    <div class="d-block reply-box-wrapper" id="reply-box-wrapper">
                                                        <div class="clear-fix reply-box" id="reply-box">
                                                            <div class="position-relative d-table content">
                                                                <div class="d-table-cell align-middle">
                                                                    <div class="emoji_popup">
                                                                        <div class="dropdown-primary dropdown show pointer">
                                                                            <div class="dropdown-toggle"
                                                                                 data-toggle="dropdown"
                                                                                 aria-expanded="true">
                                                                                <i class="fa fa-meh-o"></i>
                                                                            </div>
                                                                            <aside class="emoji-picker people show-notification profile-notification dropdown-menu"
                                                                                   data-dropdown-in="fadeIn"
                                                                                   data-dropdown-out="fadeOut">
                                                                                <nav>
                                                                                    <a class="people"><i></i><span
                                                                                                class="hidden">people</span></a><a
                                                                                            class="foods"><i></i><span
                                                                                                class="hidden">foods</span></a><a
                                                                                            class="nature"><i></i><span
                                                                                                class="hidden">nature</span></a><a
                                                                                            class="activity"><i></i><span
                                                                                                class="hidden">activity</span></a><a
                                                                                            class="objects"><i></i><span
                                                                                                class="hidden">objects</span></a><a
                                                                                            class="places"><i></i><span
                                                                                                class="hidden">places</span></a><a
                                                                                            class="flags"><i></i><span
                                                                                                class="hidden">flags</span></a><a
                                                                                            class="symbols"><i></i><span
                                                                                                class="hidden">symbols</span></a>
                                                                                </nav>
                                                                                <div class="bar-wrapper">
                                                                                    <ul class="skin-tones">
                                                                                        <li class="neutral selected">
                                                                                            <a
                                                                                                    class="st"></a>
                                                                                        </li>
                                                                                        <li class="m1f3fb"><a
                                                                                                    class="st"></a>
                                                                                        </li>
                                                                                        <li class="m1f3fc"><a
                                                                                                    class="st"></a>
                                                                                        </li>
                                                                                        <li class="m1f3fd"><a
                                                                                                    class="st"></a>
                                                                                        </li>
                                                                                        <li class="m1f3fe"><a
                                                                                                    class="st"></a>
                                                                                        </li>
                                                                                        <li class="m1f3ff"><a
                                                                                                    class="st"></a>
                                                                                        </li>
                                                                                    </ul>
                                                                                    <div class="search-bar"><input
                                                                                                type="text"
                                                                                                placeholder="Emoji Search"><i
                                                                                                class="icn-magnifier"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <section class="wrapper">
                                                                                    <div class="scroller"
                                                                                         style="transform: translateY(0px)">
                                                                                        <div style="height: 9px"></div>
                                                                                    </div>
                                                                                    <span class="emoji-name"></span>
                                                                                </section>
                                                                            </aside>

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="d-table-cell align-middle reply-editor-wrapper"
                                                                     id="reply-editor-wrapper">
                                                                    <p  class="reply-editor" id="reply-messager" contenteditable="true">
                                                                        Nhập nội dung tin nhắn, #trả lời nhanh, @gửi ảnh nhanh...
                                                                    </p>
{{--                                                                    <textarea type="text" class="reply-editor" id="reply-messager"--}}
{{--                                                          placeholder="Nhập nội dung tin nhắn, #trả lời nhanh, @gửi ảnh nhanh..."--}}
{{--                                                          style="overflow: hidden; height: 16px;">--}}
{{--                                                </textarea>--}}
                                                                </div>
                                                                <div class="d-table-cell align-middle text-nowrap buttons-control">
                                                                    <div class="reply-button-action">
                                                                        <div class="dropdown dropup">
                                                      <span class="plus-icon" type="button" id="dropdownMenuButton"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                         <svg class="reply-box-outside-icon" width="20" height="20"
                                                              viewBox="0 0 20 20" fill="none"
                                                              xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M19.25 10C19.25 15.1086 15.1086 19.25 10 19.25C4.89137 19.25 0.75 15.1086 0.75 10C0.75 4.89137 4.89137 0.75 10 0.75C15.1086 0.75 19.25 4.89137 19.25 10Z"
                                                                  stroke="#90949C" stroke-width="1.5"
                                                                  stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M9.99992 5V15" stroke="#90949C" stroke-width="1.5"
                                                                  stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M5 9.99994H15" stroke="#90949C" stroke-width="1.5"
                                                                  stroke-linecap="round" stroke-linejoin="round"></path>
                                                         </svg>
                                                      </span>
                                                                            <div class="dropdown-menu"
                                                                                 aria-labelledby="dropdownMenuButton">
                                                                                <a class="d-flex align-items-center dropdown-item">
                                                                                    <svg width="20" height="16"
                                                                                         viewBox="0 0 20 16"
                                                                                         fill="none"
                                                                                         xmlns="http://www.w3.org/2000/svg">
                                                                                        <mask id="path-1-inside-1"
                                                                                              fill="white">
                                                                                            <path d="M18 4V15C18 15.5523 17.5523 16 17 16H3C2.44772 16 2 15.5523 2 15V4"></path>
                                                                                        </mask>
                                                                                        <path d="M19 4C19 3.44772 18.5523 3 18 3C17.4477 3 17 3.44772 17 4H19ZM3 4C3 3.44772 2.55228 3 2 3C1.44772 3 1 3.44772 1 4H3ZM17 4V15H19V4H17ZM17 15H3V17H17V15ZM3 15V4H1V15H3ZM3 15H1C1 16.1046 1.89543 17 3 17V15ZM17 15V17C18.1046 17 19 16.1046 19 15H17Z"
                                                                                              fill="#F34F0F"
                                                                                              mask="url(#path-1-inside-1)"></path>
                                                                                        <path d="M1 0.5H19C19.2761 0.5 19.5 0.723858 19.5 1V3.54545C19.5 3.8216 19.2761 4.04545 19 4.04545H1C0.723858 4.04545 0.5 3.8216 0.5 3.54545V1C0.5 0.723858 0.723857 0.5 1 0.5Z"
                                                                                              stroke="#F34F0F"
                                                                                              stroke-linecap="round"
                                                                                              stroke-linejoin="round"></path>
                                                                                        <path d="M8 10H12"
                                                                                              stroke="#F34F0F"
                                                                                              stroke-linecap="round"
                                                                                              stroke-linejoin="round"></path>
                                                                                    </svg>
                                                                                    <span>Gửi sản phẩm (Alt+S)</span>
                                                                                </a>
                                                                                <a class="d-flex align-items-center dropdown-item">
                                                                                    <svg width="20" height="20"
                                                                                         viewBox="0 0 20 20"
                                                                                         fill="none"
                                                                                         xmlns="http://www.w3.org/2000/svg">
                                                                                        <rect x="0.5" y="0.5"
                                                                                              width="19"
                                                                                              height="19" rx="3.5"
                                                                                              fill="white"
                                                                                              stroke="#FF9224"></rect>
                                                                                        <circle cx="5.5" cy="7.5"
                                                                                                r="1.5"
                                                                                                fill="#FF9224"></circle>
                                                                                        <circle cx="14.5" cy="7.5"
                                                                                                r="1.5"
                                                                                                fill="#FF9224"></circle>
                                                                                        <path d="M15.4704 13.1732C15.7419 13.3121 15.8144 13.6675 15.5968 13.881C15.0013 14.4654 14.2618 14.9525 13.42 15.3122C12.3762 15.7582 11.2076 15.9945 10.0187 15.9999C8.82984 16.0053 7.65781 15.7796 6.60748 15.3431C5.75968 14.9908 5.01251 14.51 4.40813 13.9304C4.18837 13.7197 4.25679 13.3639 4.52642 13.2225C4.72251 13.1196 4.9621 13.1678 5.11808 13.3249C5.65086 13.8618 6.3236 14.3054 7.09323 14.6253C7.99215 14.9989 8.99521 15.192 10.0127 15.1873C11.0302 15.1827 12.0303 14.9805 12.9236 14.5988C13.6875 14.2724 14.3529 13.8235 14.8774 13.2827C15.0322 13.1231 15.2724 13.0719 15.4704 13.1732Z"
                                                                                              fill="#FF9224"></path>
                                                                                    </svg>
                                                                                    <span>Nhãn dán</span>
                                                                                </a>
                                                                                <a class="d-flex align-items-center dropdown-item">
                                                                                    <svg width="18" height="22"
                                                                                         viewBox="0 0 18 22"
                                                                                         fill="none"
                                                                                         xmlns="http://www.w3.org/2000/svg">
                                                                                        <path d="M17 9.18182C17 15.5455 9 21 9 21C9 21 1 15.5455 1 9.18182C1 7.01187 1.84285 4.93079 3.34315 3.3964C4.84344 1.86201 6.87827 1 9 1C11.1217 1 13.1566 1.86201 14.6569 3.3964C16.1571 4.93079 17 7.01187 17 9.18182Z"
                                                                                              stroke="#0084FF"
                                                                                              stroke-linecap="round"
                                                                                              stroke-linejoin="round"></path>
                                                                                        <path d="M9 12.5C10.933 12.5 12.5 10.933 12.5 9C12.5 7.067 10.933 5.5 9 5.5C7.067 5.5 5.5 7.067 5.5 9C5.5 10.933 7.067 12.5 9 12.5Z"
                                                                                              stroke="#0084FF"
                                                                                              stroke-linecap="round"
                                                                                              stroke-linejoin="round"></path>
                                                                                    </svg>
                                                                                    <span style="margin-left: 12px;">Xin địa chỉ khách hàng</span>
                                                                                </a>
                                                                                <a class="d-flex align-items-center dropdown-item">
                                                                                    <svg width="21" height="21"
                                                                                         viewBox="0 0 21 21"
                                                                                         fill="none"
                                                                                         xmlns="http://www.w3.org/2000/svg"
                                                                                         xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                                        <rect width="21" height="21"
                                                                                              fill="url(#pattern0)"></rect>
                                                                                        <defs>
                                                                                            <pattern id="pattern0"
                                                                                                     patternContentUnits="objectBoundingBox"
                                                                                                     width="1"
                                                                                                     height="1">
                                                                                                <use xlink:href="#image0"
                                                                                                     transform="scale(0.03125)"></use>
                                                                                            </pattern>
                                                                                            <image id="image0"
                                                                                                   width="32"
                                                                                                   height="32"
                                                                                                   xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAEG0lEQVRYCdWW/U9TVxjHyZZs+9H9uD9gyX5ZbGWiZjPhh4F1fb/lKnTl3lveGa0MqxO1KhJBtjlBo/5EMpOFuZDNl6AZOgMY5sucpshA6XgtS+k7bWnoC7Q8y9NxsNi63BpotpM8Pben5z7fz3nOOc/TrKz/c9u5U/+mRMkyEhW3X0JpN2V8LVIl+33zV2cf/3jlhklbXjcsodgvMwoho7huj8cbAQBYWlqCPQajSUpx6oxBYAQmJqedCIDN5fYEC4oqRjIGIFOx5x6ZBieW9WFxcRH21TfaMnYeJBTTeLunf4gABINB6Lj0U0CmYqszEgWMwL37j0YJgNfrha7rN8NSijm07gAUpXlHVVQ+hmHHFovFwGazQfu3HX6Jkv103QGkFNt+o/v2U7L6ubk5mJmZAcOB4w6pintvXQHkcu59Nacz49Ujzel0gtVqhd2aKrtCwW1IZTRNv7EmYLIC7mfTkyELEcd+YWEBXC43cGW1zxitfiiVFTKfjSp3lU5i9HALV2A2yVrahNKWCaGk2bJsU0Jx8+RzO3lVkNuwAV+QU8zH1fr6gUTxdJ6j0Sh03+ozK+iSp7kc91aWQHRkc472YkBybR6kXaG4iS6FYeuJ2LJF4YOqXqdAZDzY0NDwmoIuGZj+y+pORzTV3GONpx7KKFacJRAZc7fprviIOParAWKQY/jTni06fFFVWNaFuT+VQ75jeG4wX3x9+sIUb4Ate5958grqwz29/V6+QqnmYfjtdjuMj09AUXG1SyxWv80rAlv2DvtZfWvQ7/en8st7LBQKxa/qyIgZ6g83BeQ0p84oAMkVmC8GB4egtKLOlBbA7Ows79W+OJGEH8XRMAollYaRtABcLteLfnl9DwQC8TRNxDFhnT3fHt2lrjiWFgAeoHQb1goiTPqmljNLBYXl12mafj0tAHRAig9fkEgkkgTQd+cusGW1l+OZkE8eILcAAfAgpdPm5+eTAO703wMNW9P5SgBYcrH08mnhcHjV3uMCBp78AVW6Az4ZxX74SgDoxO12x/+E/hsEZjw8Mzif2K1fekFBa+0yJZcXF8cPvlugqfkmRBxh73A44ik1sSQTIIyQz+dbESbvTU1ZoFirn14RJwBbay57EmtB/neRhGKEtcDsylXsn/2h82qUOEvsEQavKBr+L0j8LfH54e+PoaxynykJILu4c3x7axS2ty0C9tuaSSX8p8diJNhhPFdUXP3bqdYL4V/vPgCLxfJSoURRfB4dG4Oevn6o1H0RVtIVHyUDaDrHn5ff1eI4nmMw2wU7jrZhOZZQzG6mtPYao91j0XA6Kx9jyz8fxWsnVrDZq8TjW5BnfFcoP23bXDcML7NsdYdjY/6RkqSX12pAkH80b+MnJ04KxU0tKU10vDSetdZK8L/k52/FhZPmis5B+AAAAABJRU5ErkJggg=="></image>
                                                                                        </defs>
                                                                                    </svg>
                                                                                    <span>Gửi icon “Thích”</span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="reply-button-action">
                                                                        <div class="dropdown"
                                                                             onclick="openModalAlbumPhoto()">
                                                      <span class="plus-icon" type="button">
                                                         <span data-tip="true" data-for="library_image_icon"
                                                               currentitem="false">
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg"
                                                                 style="margin-top: 4px; margin-left: 5px;">
                                                               <path d="M19 17C19 17.5304 18.8104 18.0391 18.4728 18.4142C18.1352 18.7893 17.6774 19 17.2 19H2.8C2.32261 19 1.86477 18.7893 1.52721 18.4142C1.18964 18.0391 1 17.5304 1 17V3C1 2.46957 1.18964 1.96086 1.52721 1.58579C1.86477 1.21071 2.32261 1 2.8 1H7.3L9.1 4H17.2C17.6774 4 18.1352 4.21071 18.4728 4.58579C18.8104 4.96086 19 5.46957 19 6V17Z"
                                                                     stroke="#90949C" stroke-width="1.5"
                                                                     stroke-linecap="round"
                                                                     stroke-linejoin="round"></path>
                                                               <path d="M10 7.66667V14.3333" stroke="#90949C"
                                                                     stroke-width="1.5" stroke-linecap="round"
                                                                     stroke-linejoin="round"></path>
                                                               <path d="M7 11H13" stroke="#90949C" stroke-width="1.5"
                                                                     stroke-linecap="round"
                                                                     stroke-linejoin="round"></path>
                                                            </svg>
                                                         </span>
                                                         <div class="form_tooltip place-top type-dark"
                                                              id="library_image_icon" data-id="tooltip">Gửi ảnh từ thư viện</div>
                                                      </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="reply-button-action">
                                                                        <div class="dropdown">
                                                      <span class="plus-icon" type="button">
                                                         <span data-tip="true" data-for="image_icon"
                                                               currentitem="false">
                                                            <svg class="reply-box-outside-icon" width="20" height="20"
                                                                 viewBox="0 0 20 20" fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                               <path d="M2.22222 0.75H17.7778C18.5909 0.75 19.25 1.40914 19.25 2.22222V17.7778C19.25 18.5909 18.5909 19.25 17.7778 19.25H2.22222C1.40914 19.25 0.75 18.5909 0.75 17.7778V2.22222C0.75 1.40914 1.40914 0.75 2.22222 0.75Z"
                                                                     stroke="#90949C" stroke-width="1.5"
                                                                     stroke-linecap="round"
                                                                     stroke-linejoin="round"></path>
                                                               <path d="M5.9875 8.42188C7.23014 8.42188 8.2375 7.41452 8.2375 6.17188C8.2375 4.92923 7.23014 3.92188 5.9875 3.92188C4.74486 3.92188 3.7375 4.92923 3.7375 6.17188C3.7375 7.41452 4.74486 8.42188 5.9875 8.42188Z"
                                                                     stroke="#90949C" stroke-width="1.5"
                                                                     stroke-linecap="round"
                                                                     stroke-linejoin="round"></path>
                                                               <path d="M19.0625 15.6972L13.0778 9.4375L1.8 19.2"
                                                                     stroke="#90949C" stroke-width="1.5"
                                                                     stroke-linecap="round"
                                                                     stroke-linejoin="round"></path>
                                                            </svg>
                                                         </span>
                                                         <div class="form_tooltip place-top type-dark" id="image_icon"
                                                              data-id="tooltip" style="left: 974px; top: 863px;">Tải ảnh hoặc file đính kèm</div>
                                                      </span>
                                                                        </div>
                                                                        <input type="file" class="display-none"
                                                                               accept="*" multiple="">
                                                                    </div>
                                                                    <div class="reply-button-action quick-message-button-new dropdown">
                                                                        <div class="abbbb">
                                                      <span type="button" id="btn-template-message"
                                                            class="btn-template-message" data-toggle="tooltip dropdown"
                                                            data-placement="top" data-tip="true"
                                                            data-for="_quickmes_icon"
                                                            data-delay="{&quot;show&quot;:&quot;200&quot;, &quot;hide&quot;:&quot;0&quot;}"
                                                            currentitem="false" style="height: unset;">
                                                         <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                              xmlns="http://www.w3.org/2000/svg"
                                                              class="reply-box-outside-icon">
                                                            <path d="M4.44444 14.8056C4.24553 14.8056 4.05477 14.8846 3.91411 15.0252L0.75 18.1893V2.22222C0.75 1.83176 0.905109 1.4573 1.1812 1.1812C1.4573 0.905109 1.83176 0.75 2.22222 0.75H17.7778C18.1682 0.75 18.5427 0.905108 18.8188 1.1812C19.0949 1.4573 19.25 1.83176 19.25 2.22222V13.3333C19.25 13.7238 19.0949 14.0983 18.8188 14.3744C18.5427 14.6504 18.1682 14.8056 17.7778 14.8056H4.44444Z"
                                                                  stroke="#90949C" stroke-width="1.5"
                                                                  stroke-linecap="round" stroke-linejoin="round"></path>
                                                         </svg>
                                                      </span>
                                                                            <div class="form_tooltip place-top type-dark tooltip_title"
                                                                                 id="_quickmes_icon"
                                                                                 data-id="tooltip"
                                                                                 style="left: 1040px; top: 861px;">
                                                                                Gửi
                                                                                câu trả lời mẫu
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="position-absolute message-template-instance-popup d-none">
                                                                    <div id="quickMesTemplate"
                                                                         class="popup popup-template">
                                                                        <div class="keybinding-header"
                                                                             style="padding-right: 12px;">
                                                                            <div class="select-type-quick-mes d-flex align-items-center undefined"
                                                                                 style="border-bottom: 1px solid rgb(196, 196, 196);">
                                                                                <span class="stqm-title">Chọn điều kiện tìm kiếm:</span><span
                                                                                        class="active stqm-type-btn">Từ khóa và nội dung</span><span
                                                                                        class=" stqm-type-btn">Từ khóa</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex justify-content-between tooltip-content">
                                                                            <div class="d-flex">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                     width="24" height="24"
                                                                                     viewBox="0 0 24 24" fill="none"
                                                                                     stroke="currentColor"
                                                                                     stroke-width="2"
                                                                                     stroke-linecap="round"
                                                                                     stroke-linejoin="round"
                                                                                     class="feather feather-sun">
                                                                                    <circle cx="12" cy="12"
                                                                                            r="5"></circle>
                                                                                    <line x1="12" y1="1" x2="12"
                                                                                          y2="3"></line>
                                                                                    <line x1="12" y1="21" x2="12"
                                                                                          y2="23"></line>
                                                                                    <line x1="4.22" y1="4.22"
                                                                                          x2="5.64"
                                                                                          y2="5.64"></line>
                                                                                    <line x1="18.36" y1="18.36"
                                                                                          x2="19.78"
                                                                                          y2="19.78"></line>
                                                                                    <line x1="1" y1="12" x2="3"
                                                                                          y2="12"></line>
                                                                                    <line x1="21" y1="12" x2="23"
                                                                                          y2="12"></line>
                                                                                    <line x1="4.22" y1="19.78"
                                                                                          x2="5.64"
                                                                                          y2="18.36"></line>
                                                                                    <line x1="18.36" y1="5.64"
                                                                                          x2="19.78"
                                                                                          y2="4.22"></line>
                                                                                </svg>
                                                                                <div class="text">
                                                                                    Sử dụng phím điều hướng
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                         width="24" height="24"
                                                                                         viewBox="0 0 24 24"
                                                                                         fill="none"
                                                                                         stroke="currentColor"
                                                                                         stroke-width="2"
                                                                                         stroke-linecap="round"
                                                                                         stroke-linejoin="round"
                                                                                         class="feather feather-arrow-up">
                                                                                        <line x1="12" y1="19"
                                                                                              x2="12"
                                                                                              y2="5"></line>
                                                                                        <polyline
                                                                                                points="5 12 12 5 19 12"></polyline>
                                                                                    </svg>
                                                                                    hoặc
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                         width="24" height="24"
                                                                                         viewBox="0 0 24 24"
                                                                                         fill="none"
                                                                                         stroke="currentColor"
                                                                                         stroke-width="2"
                                                                                         stroke-linecap="round"
                                                                                         stroke-linejoin="round"
                                                                                         class="feather feather-arrow-down">
                                                                                        <line x1="12" y1="5" x2="12"
                                                                                              y2="19"></line>
                                                                                        <polyline
                                                                                                points="19 12 12 19 5 12"></polyline>
                                                                                    </svg>
                                                                                    để chọn và nhấn Enter để sử dụng
                                                                                </div>
                                                                            </div>
                                                                            <svg class="close-svg" width="17"
                                                                                 height="17" viewBox="0 0 17 17"
                                                                                 fill="none"
                                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.7279 4.24255L4.24262 12.7278"
                                                                                      stroke="#F6C037"
                                                                                      stroke-width="1.5"
                                                                                      stroke-linecap="round"
                                                                                      stroke-linejoin="round"></path>
                                                                                <path d="M4.24268 4.24255L12.728 12.7278"
                                                                                      stroke="#F6C037"
                                                                                      stroke-width="1.5"
                                                                                      stroke-linecap="round"
                                                                                      stroke-linejoin="round"></path>
                                                                            </svg>
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

                                    {{-- End --}}

                                    {{-- Menu chi tiết user , địa chỉ , đơn hàng, ghi chú --}}
                                    <div class="detail-right react-draggable">
                                        <div id="customer-column-component-v3">
                                            <div id="customer-column-content" data-selector="scrollbar"
                                                 style="position: relative; overflow: hidden; width: 100%; height: 100%;">
                                                <div style="position: absolute; inset: 0; overflow: scroll; margin-right: -10px; margin-bottom: -10px;">
                                                    <div id="wrapper-customer-information"
                                                         class="block-customer-info">
                                                        <div id="customer-information-content-component-v3">
                                                            <div id="customer-information-content-component-v3"
                                                                 class="customer-information">
                                                                <div id="wrapper-customer-info-v3"
                                                                     style="opacity: 1;">
                                                                    <div id="customer-avatar" data-tip="true"
                                                                         data-for="_customer_avatar"
                                                                         currentitem="false"
                                                                         style="cursor: pointer;">
                                                                        <img src="https://graph.facebook.com/5201141863236625/picture?access_token=EAAZAZALTbNShQBAAZBdO6gBWge4h7ZAZC4qCtwEM7RjgBLKxzWZCbWs1bE80le3mqLN4PuFauKvYXsRwo19Qgd7waE0EnGr6hYuIvClHS1bCHYKZCKHnKCJo1nDl8x67mkwv8IhpkNIQcRtbQtMwrPorZCjQLYfbmd2571CthZCMVbkZArEIHYGbbmjwXLOexUoggYecAYsOVZC3QZDZD"
                                                                             alt="avatar">
                                                                        <div class="form_tooltip place-top type-dark"
                                                                             id="_customer_avatar"
                                                                             data-id="tooltip">Xem
                                                                            thông tin khách hàng
                                                                        </div>
                                                                    </div>
                                                                    <div id="customer-information-main">
                                                                        <div id="customer-name"
                                                                             style="padding: 7px 0 0 6px; font-weight: 500;">
                                                                            <span id="edit-customer-name-ip"
                                                                                  class="edit-customer-name-ip"
                                                                                  style="line-height: 24px;">Yến Nhi</span>
                                                                            <span id="edit-customer-name-icon"
                                                                                  style="margin-top: -26px;">
                                                           <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                              <path d="M8.5 14.1667H14.875" stroke="#7B7B7B"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                              <path d="M11.6875 2.47916C11.9693 2.19737 12.3515 2.03906 12.75 2.03906C12.9473 2.03906 13.1427 2.07793 13.325 2.15344C13.5073 2.22895 13.673 2.33963 13.8125 2.47916C13.952 2.61869 14.0627 2.78434 14.1382 2.96664C14.2137 3.14895 14.2526 3.34434 14.2526 3.54166C14.2526 3.73899 14.2137 3.93438 14.1382 4.11669C14.0627 4.29899 13.952 4.46463 13.8125 4.60416L4.95833 13.4583L2.125 14.1667L2.83333 11.3333L11.6875 2.47916Z"
                                                                    stroke="#7B7B7B" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                           </svg>
                                                        </span>
                                                                        </div>
                                                                        <div id="customer-phone"
                                                                             style="display: block;">
                                                                            <div class="wrapper-input-phone"><span
                                                                                        id="edit-customer-phone-sp"><input
                                                                                            id="edit-customer-phone-ip"
                                                                                            class="edit-customer-phone-ip"
                                                                                            placeholder="Số điện thoại"
                                                                                            autocomplete="off"
                                                                                            value=""></span>
                                                                            </div>
                                                                            <span id="edit-customer-phone-icon">
                                                           <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                              <path d="M8.5 14.1667H14.875" stroke="#7B7B7B"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                              <path d="M11.6875 2.47916C11.9693 2.19737 12.3515 2.03906 12.75 2.03906C12.9473 2.03906 13.1427 2.07793 13.325 2.15344C13.5073 2.22895 13.673 2.33963 13.8125 2.47916C13.952 2.61869 14.0627 2.78434 14.1382 2.96664C14.2137 3.14895 14.2526 3.34434 14.2526 3.54166C14.2526 3.73899 14.2137 3.93438 14.1382 4.11669C14.0627 4.29899 13.952 4.46463 13.8125 4.60416L4.95833 13.4583L2.125 14.1667L2.83333 11.3333L11.6875 2.47916Z"
                                                                    stroke="#7B7B7B" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                           </svg>
                                                        </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="customer-list-phone-component-v3"></div>
                                                            <div class="customer-address-wrapper-v3"
                                                                 id="customer-address-wrapper">
                                                                <div id="wrapper-customer-address-component-v3">
                                                                    <div class="empty-customer-address-v3 ">
                                                                        <div class="d-flex empty-location">
                                                                            <div class="location-icon">
                                                                                <svg width="14" height="17"
                                                                                     viewBox="0 0 14 17" fill="none"
                                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                                    <path d="M6.81867 8.99987C5.61369 8.99987 4.63685 8.02303 4.63685 6.81805C4.63685 5.61306 5.61369 4.63623 6.81867 4.63623C8.02366 4.63623 9.00049 5.61306 9.00049 6.81805C9.00049 8.02303 8.02366 8.99987 6.81867 8.99987Z"
                                                                                          stroke="#90949C"
                                                                                          stroke-width="1.3"
                                                                                          stroke-linecap="round"
                                                                                          stroke-linejoin="round"></path>
                                                                                    <path d="M6.81854 1C8.36161 1 9.84149 1.61299 10.9326 2.70411C12.0237 3.79523 12.6367 5.2751 12.6367 6.81818C12.6367 8.19418 12.3444 9.09455 11.5458 10.0909L6.81854 15.5455L2.09126 10.0909C1.29272 9.09455 1.00036 8.19418 1.00036 6.81818C1.00036 5.2751 1.61334 3.79523 2.70446 2.70411C3.79558 1.61299 5.27546 1 6.81854 1V1Z"
                                                                                          stroke="#90949C"
                                                                                          stroke-width="1.3"
                                                                                          stroke-linecap="round"
                                                                                          stroke-linejoin="round"></path>
                                                                                </svg>
                                                                            </div>
                                                                            <div class="location-text">Địa chỉ (F2)
                                                                            </div>
                                                                            <div class="add-location">
                                                                                <svg width="18" height="18"
                                                                                     viewBox="0 0 18 18" fill="none"
                                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                                    <circle cx="9" cy="9" r="9"
                                                                                            fill="#D4D7DC"></circle>
                                                                                    <path d="M14 10.0513H10.0472V14H7.97331V10.0513H4V7.96923H7.97331V4H10.0472V7.96923H14V10.0513Z"
                                                                                          fill="white"></path>
                                                                                </svg>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="default-customer-address-component"
                                                                         class="editting-customer d-none">
                                                                        <div id="editting-customer-address-info">
                                                                            <div id="editting-customer-address-header">
                                                                                <div class="location-icon">
                                                                                    <svg width="14" height="17"
                                                                                         viewBox="0 0 14 17"
                                                                                         fill="none"
                                                                                         xmlns="http://www.w3.org/2000/svg">
                                                                                        <path d="M6.81867 8.99987C5.61369 8.99987 4.63685 8.02303 4.63685 6.81805C4.63685 5.61306 5.61369 4.63623 6.81867 4.63623C8.02366 4.63623 9.00049 5.61306 9.00049 6.81805C9.00049 8.02303 8.02366 8.99987 6.81867 8.99987Z"
                                                                                              stroke="#90949C"
                                                                                              stroke-width="1.3"
                                                                                              stroke-linecap="round"
                                                                                              stroke-linejoin="round"></path>
                                                                                        <path d="M6.81854 1C8.36161 1 9.84149 1.61299 10.9326 2.70411C12.0237 3.79523 12.6367 5.2751 12.6367 6.81818C12.6367 8.19418 12.3444 9.09455 11.5458 10.0909L6.81854 15.5455L2.09126 10.0909C1.29272 9.09455 1.00036 8.19418 1.00036 6.81818C1.00036 5.2751 1.61334 3.79523 2.70446 2.70411C3.79558 1.61299 5.27546 1 6.81854 1V1Z"
                                                                                              stroke="#90949C"
                                                                                              stroke-width="1.3"
                                                                                              stroke-linecap="round"
                                                                                              stroke-linejoin="round"></path>
                                                                                    </svg>
                                                                                </div>
                                                                                <div class="header-text"><span
                                                                                            id="editting-customer-address-header-text">Tạo địa chỉ</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="wrapper-editing"
                                                                                 style="padding: 0 10px;">
                                                                                <div class="wrapper-name-n-phone">
                                                                                    <div id="editting-customer-address-name"
                                                                                         class=""><input
                                                                                                id="customer-address-name-ip"
                                                                                                placeholder="Nhập tên người nhận"
                                                                                                class="editting-customer"
                                                                                                autocomplete="off"
                                                                                                value="Bin Nguyễn">
                                                                                    </div>
                                                                                    <div id="editting-customer-address-phone"
                                                                                         class="default"><input
                                                                                                id="customer-address-phone-ip"
                                                                                                placeholder="Nhập số điện thoại"
                                                                                                class="editting-customer"
                                                                                                autocomplete="off"
                                                                                                value=""></div>
                                                                                </div>
                                                                                <div id="editting-customer-address-content"
                                                                                     class="default"><input
                                                                                            id="customer-address-content-ip"
                                                                                            class="editting-customer"
                                                                                            placeholder="Nhập địa chỉ"
                                                                                            autocomplete="off"
                                                                                            value="">
                                                                                </div>
                                                                                <div id="noti-invalid-address"
                                                                                     class="editting-customer text-ellipsis noti-invalid">
                                                                                    * Địa chỉ không được để trống
                                                                                </div>
                                                                                <div id="editting-customer-address-district"
                                                                                     class="default">
                                                                                    <span class="select2 select2-container select2-container--default"
                                                                                          dir="ltr"
                                                                                          data-select2-id="8678"
                                                                                          style="width: 342px;"><span
                                                                                                class="selection"><span
                                                                                                    class="select2-selection select2-selection--single"
                                                                                                    role="combobox"
                                                                                                    aria-haspopup="true"
                                                                                                    aria-expanded="false"
                                                                                                    tabindex="0"
                                                                                                    aria-labelledby="select2-ys4e-container"><span
                                                                                                        class="select2-selection__rendered"
                                                                                                        id="select2-ys4e-container"
                                                                                                        role="textbox"
                                                                                                        aria-readonly="true"><span
                                                                                                            class="select2-selection__placeholder">Tỉnh/Thành phố - Quận/Huyện</span></span><span
                                                                                                        class="select2-selection__arrow"
                                                                                                        role="presentation"><b
                                                                                                            role="presentation"></b></span></span></span><span
                                                                                                class="dropdown-wrapper"
                                                                                                aria-hidden="true"></span></span>
                                                                                </div>
                                                                                <div id="editting-customer-address-ward"
                                                                                     class="default">
                                                                                    <select data-select2-id="8680"
                                                                                            tabindex="-1"
                                                                                            class="select2-hidden-accessible"
                                                                                            aria-hidden="true">
                                                                                        <option value="0"
                                                                                                data-select2-id="8682">
                                                                                            Phường/Xã
                                                                                        </option>
                                                                                    </select>
                                                                                    <span class="select2 select2-container select2-container--default"
                                                                                          dir="ltr"
                                                                                          data-select2-id="8681"
                                                                                          style="width: 93px;"><span
                                                                                                class="selection"><span
                                                                                                    class="select2-selection select2-selection--single"
                                                                                                    role="combobox"
                                                                                                    aria-haspopup="true"
                                                                                                    aria-expanded="false"
                                                                                                    tabindex="0"
                                                                                                    aria-labelledby="select2-3h46-container"><span
                                                                                                        class="select2-selection__rendered"
                                                                                                        id="select2-3h46-container"
                                                                                                        role="textbox"
                                                                                                        aria-readonly="true"><span
                                                                                                            class="select2-selection__placeholder">Phường/Xã</span></span><span
                                                                                                        class="select2-selection__arrow"
                                                                                                        role="presentation"><b
                                                                                                            role="presentation"></b></span></span></span><span
                                                                                                class="dropdown-wrapper"
                                                                                                aria-hidden="true"></span></span>
                                                                                </div>
                                                                                <div id="editting-customer-address-footer">
                                                                                    <span id="editting-customer-address-header-save"><button
                                                                                                type="button"
                                                                                                id="save-customer-address-btn"
                                                                                                class="editting-customer btn btn-primary">Lưu</button></span><span
                                                                                            id="editting-customer-address-header-exit"><button
                                                                                                type="button"
                                                                                                id="unedit-customer-address-btn"
                                                                                                class="editting-customer btn btn-text-black">Hủy</button></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="order-customer-info-component-v3 no-orders">
                                                        <div class="d-flex order-customer-overview no-orders"
                                                             data-tip="true" data-for="_createOrder"
                                                             style="cursor: pointer;" currentitem="false">
                                                            <div class="order-icon">
                                                                <svg width="18" height="18" viewBox="0 0 18 18"
                                                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M11.1819 16.8178C10.7802 16.8178 10.4546 16.4922 10.4546 16.0906C10.4546 15.6889 10.7802 15.3633 11.1819 15.3633C11.5836 15.3633 11.9092 15.6889 11.9092 16.0906C11.9092 16.4922 11.5836 16.8178 11.1819 16.8178Z"
                                                                          stroke="#90949C" stroke-width="1.3"
                                                                          stroke-linecap="round"
                                                                          stroke-linejoin="round"></path>
                                                                    <path d="M3.18191 16.8178C2.78025 16.8178 2.45463 16.4922 2.45463 16.0906C2.45463 15.6889 2.78025 15.3633 3.18191 15.3633C3.58357 15.3633 3.90918 15.6889 3.90918 16.0906C3.90918 16.4922 3.58357 16.8178 3.18191 16.8178Z"
                                                                          stroke="#90949C" stroke-width="1.3"
                                                                          stroke-linecap="round"
                                                                          stroke-linejoin="round"></path>
                                                                    <path d="M17 1.54492H14.0909L12.1418 11.2831C12.0753 11.6179 11.8932 11.9187 11.6272 12.1328C11.3613 12.3468 11.0286 12.4606 10.6873 12.454H3.61818C3.27687 12.4606 2.94413 12.3468 2.67821 12.1328C2.4123 11.9187 2.23014 11.6179 2.16364 11.2831L1 5.18129H13.3636"
                                                                          stroke="#90949C" stroke-width="1.3"
                                                                          stroke-linecap="round"
                                                                          stroke-linejoin="round"></path>
                                                                </svg>
                                                            </div>
                                                            <div class="order-info"><span class="order-info-count">Đơn hàng (F1)</span>&nbsp;
                                                            </div>
                                                            <div class="add-icon">
                                                                <svg width="18" height="18" viewBox="0 0 18 18"
                                                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <circle cx="9" cy="9" r="9"
                                                                            fill="#D4D7DC"></circle>
                                                                    <path d="M14 10.0513H10.0472V14H7.97331V10.0513H4V7.96923H7.97331V4H10.0472V7.96923H14V10.0513Z"
                                                                          fill="white"></path>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="customer-note-component"
                                                         class="customer-note-component-v3 no-notes">
                                                        <div class="d-flex customer-note">
                                                            <div class="note-icon">
                                                                <svg width="14" height="17" viewBox="0 0 14 17"
                                                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5.36399 0.818359H11.1822C11.5679 0.818359 11.9379 0.971606 12.2107 1.24439C12.4835 1.51717 12.6367 1.88714 12.6367 2.2729V13.9093C12.6367 14.295 12.4835 14.665 12.2107 14.9378C11.9379 15.2106 11.5679 15.3638 11.1822 15.3638H2.4549C2.06913 15.3638 1.69916 15.2106 1.42638 14.9378C1.1536 14.665 1.00036 14.295 1.00036 13.9093V5.182L5.36399 0.818359Z"
                                                                          stroke="#90949C" stroke-width="1.3"
                                                                          stroke-linecap="round"
                                                                          stroke-linejoin="round"></path>
                                                                    <path d="M5.36377 0.818359V5.182H1.00013"
                                                                          stroke="#90949C" stroke-width="1.3"
                                                                          stroke-linecap="round"
                                                                          stroke-linejoin="round"></path>
                                                                    <path d="M3.90936 8.81836H9.72754"
                                                                          stroke="#90949C"
                                                                          stroke-width="1.3" stroke-linecap="round"
                                                                          stroke-linejoin="round"></path>
                                                                    <path d="M3.90936 11.7275H9.72754"
                                                                          stroke="#90949C"
                                                                          stroke-width="1.3" stroke-linecap="round"
                                                                          stroke-linejoin="round"></path>
                                                                    <path d="M8.27299 5.90918H9.00027H9.72754"
                                                                          stroke="#90949C" stroke-width="1.3"
                                                                          stroke-linecap="round"
                                                                          stroke-linejoin="round"></path>
                                                                </svg>
                                                            </div>
                                                            <div class="note-txt">Ghi chú (F6)</div>
                                                            <div class="add-icon">
                                                                <svg width="18" height="18" viewBox="0 0 18 18"
                                                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <circle cx="9" cy="9" r="9"
                                                                            fill="#D4D7DC"></circle>
                                                                    <path d="M14 10.0513H10.0472V14H7.97331V10.0513H4V7.96923H7.97331V4H10.0472V7.96923H14V10.0513Z"
                                                                          fill="white"></path>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <div class="body-create-or-edit-note-v3 d-none">
                                                            <textarea class="txt-content-note"
                                                                      placeholder="Nhập nội dung ghi chú">sss</textarea>
                                                            <div class="btn-action-note">
                                                                <button class="btn btn-cancel" type="button"
                                                                        id="btn-cancel-note">Hủy
                                                                </button>
                                                                <button class="btn btn-primary" type="button"
                                                                        id="btn-add-note">Thêm
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="conversation-file-wrapper">
                                                        <div class="conversation-file-menu">
                                                            <div class="d-flex menu-content">
                                                                <div class="menu-icon">
                                                                    <svg width="17" height="17" viewBox="0 0 17 17"
                                                                         fill="none"
                                                                         xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M12.5556 1H2.44444C1.6467 1 1 1.6467 1 2.44444V12.5556C1 13.3533 1.6467 14 2.44444 14H12.5556C13.3533 14 14 13.3533 14 12.5556V2.44444C14 1.6467 13.3533 1 12.5556 1Z"
                                                                              stroke="#BFBFBF" stroke-width="2"
                                                                              stroke-linecap="round"
                                                                              stroke-linejoin="round"></path>
                                                                        <path d="M4.89998 6.20001C5.61795 6.20001 6.19998 5.61798 6.19998 4.90001C6.19998 4.18204 5.61795 3.60001 4.89998 3.60001C4.18201 3.60001 3.59998 4.18204 3.59998 4.90001C3.59998 5.61798 4.18201 6.20001 4.89998 6.20001Z"
                                                                              stroke="#BFBFBF" stroke-width="2"
                                                                              stroke-linecap="round"
                                                                              stroke-linejoin="round"></path>
                                                                        <path d="M13.9999 9.74547L10.4791 6.20001L2.73328 14"
                                                                              stroke="#BFBFBF" stroke-width="2"
                                                                              stroke-linecap="round"
                                                                              stroke-linejoin="round"></path>
                                                                    </svg>
                                                                </div>
                                                                <div class="menu-txt">Ảnh/Video</div>
                                                                <div class="greater add-icon">
                                                                    <svg width="6" height="10" viewBox="0 0 6 10"
                                                                         fill="none"
                                                                         xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M1 9L5 5L1 1" stroke="#7B7B7B"
                                                                              stroke-width="1.33333"
                                                                              stroke-linecap="round"
                                                                              stroke-linejoin="round"></path>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-file-content d-none">
                                                            <div class="image-list-wrapper">
                                                                <div class="image-item-wrapper">
                                                                    <span class="spinner"></span>
                                                                    <div class="image-item-mask">
                                                                        <div class="image-item">
                                                                            <a rel="image" data-fancybox="true"
                                                                               href="https://social.dktcdn.net/facebook/cafe-hd/mukbang_1626943419387.jpg"
                                                                               id="fancybox_item_60f92fcde1159200014e5a8d">
                                                                                <img src="https://social.dktcdn.net/facebook/cafe-hd/mukbang_1626943419387.jpg"
                                                                                     alt="..."
                                                                                     id="file_image_60f92fcde1159200014e5a8d"
                                                                                     class="file_image_60f92fcde1159200014e5a8d"></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button type="button" class="btn btn-view-all">Xem
                                                                    thêm
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="box-order"></div>
                                                </div>
                                                <div style="position: absolute; height: 6px; transition: opacity 200ms ease 0s; opacity: 0; right: 2px; bottom: 2px; left: 2px; border-radius: 3px;">
                                                    <div style="position: relative; display: block; height: 100%; cursor: pointer; border-radius: inherit; background-color: rgba(0, 0, 0, 0.2); width: 0;"></div>
                                                </div>
                                                <div style="position: absolute; width: 6px; transition: opacity 200ms ease 0s; opacity: 0; right: 2px; bottom: 2px; top: 2px; border-radius: 3px;">
                                                    <div style="position: relative; display: block; width: 100%; cursor: pointer; border-radius: inherit; background-color: rgba(0, 0, 0, 0.2); height: 369px; transform: translateY(0px);"></div>
                                                </div>
                                            </div>
                                            <div id="customer-colum-sub-content" class=""></div>
                                            <div id="customer-order-component" class=""></div>
                                        </div>
                                        <div>
                                            <div class=""
                                                 style="position: absolute; user-select: none; width: 10px; height: 100%; top: 0; left: -5px; cursor: col-resize;"></div>
                                        </div>
                                    </div>
                                    {{-- End --}}

                                    {{-- Nút tạo đơn hàng --}}
                                    <div class="list-feature-fixed" style="bottom: 10px;">
                                        <div class="btn-create-new-order-component">
                                            <div class="btn-create-new-order " id="btn-create-new-order">
                                   <span class="sp_svg">
                                      <svg width="36" height="30" viewBox="0 0 36 30" fill="none"
                                           xmlns="http://www.w3.org/2000/svg">
                                         <path fill-rule="evenodd" clip-rule="evenodd"
                                               d="M29.9799 0C30.5322 0 30.9799 0.447715 30.9799 1V4.09967H34.0798C34.632 4.09967 35.0798 4.54739 35.0798 5.09967C35.0798 5.65196 34.632 6.09967 34.0798 6.09967H30.9799V9.19924C30.9799 9.75152 30.5322 10.1992 29.9799 10.1992C29.4277 10.1992 28.9799 9.75152 28.9799 9.19924V6.09967H25.8805C25.3282 6.09967 24.8805 5.65196 24.8805 5.09967C24.8805 4.54739 25.3282 4.09967 25.8805 4.09967H28.9799V1C28.9799 0.447715 29.4277 0 29.9799 0ZM1 4.09967C0.447715 4.09967 0 4.54739 0 5.09967C0 5.65196 0.447715 6.09967 1 6.09967H4.70403L5.66627 10.9072C5.67086 10.9372 5.67677 10.9666 5.68395 10.9956L7.57377 20.4376L7.57396 20.4386C7.72327 21.1891 8.13166 21.8632 8.72772 22.343C9.32135 22.8209 10.0635 23.0758 10.8252 23.0636H21.8004C22.5621 23.0758 23.3042 22.8209 23.8978 22.343C24.4942 21.863 24.9027 21.1885 25.0518 20.4376L25.0518 20.4376L25.0533 20.4301L26.8627 10.9416C26.9186 10.6489 26.8409 10.3465 26.6509 10.1169C26.461 9.88724 26.1785 9.75432 25.8804 9.75432H7.47517L6.50427 4.90341C6.41073 4.43606 6.00034 4.09967 5.52372 4.09967H1ZM9.53516 20.0466L7.87547 11.7543H24.6717L23.0894 20.0513C23.0312 20.3405 22.8735 20.6001 22.6437 20.7851C22.413 20.9708 22.1244 21.0695 21.8283 21.0638L21.8091 21.0636H10.8165L10.7973 21.0638C10.5012 21.0695 10.2125 20.9708 9.98186 20.7851C9.75117 20.5994 9.59314 20.3385 9.53545 20.048L9.53516 20.0466ZM10.0472 27.5873C9.97489 27.5873 9.91627 27.6459 9.91627 27.7182C9.91627 27.7906 9.97489 27.8492 10.0472 27.8492C10.1195 27.8492 10.1781 27.7906 10.1781 27.7182C10.1781 27.6459 10.1195 27.5873 10.0472 27.5873ZM7.91627 27.7182C7.91627 26.5414 8.87032 25.5873 10.0472 25.5873C11.2241 25.5873 12.1781 26.5414 12.1781 27.7182C12.1781 28.8951 11.2241 29.8492 10.0472 29.8492C8.87032 29.8492 7.91627 28.8951 7.91627 27.7182ZM22.4875 27.5873C22.4152 27.5873 22.3565 27.6459 22.3565 27.7182C22.3565 27.7906 22.4152 27.8492 22.4875 27.8492C22.5598 27.8492 22.6184 27.7906 22.6184 27.7182C22.6184 27.6459 22.5598 27.5873 22.4875 27.5873ZM20.3565 27.7182C20.3565 26.5414 21.3106 25.5873 22.4875 25.5873C23.6643 25.5873 24.6184 26.5414 24.6184 27.7182C24.6184 28.8951 23.6643 29.8492 22.4875 29.8492C21.3106 29.8492 20.3565 28.8951 20.3565 27.7182Z"
                                               fill="white"></path>
                                      </svg>
                                   </span>
                                                <span class="sp_txt">Tạo đơn hàng (F1)</span>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End --}}
                                </div>
                            </div>
                        </div>
                        <div class="flash-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sell_online.facebook.album-photo')
@endsection
@push('scripts')
    <script src="{{ asset('js\sell_online\facebook\messenger.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
