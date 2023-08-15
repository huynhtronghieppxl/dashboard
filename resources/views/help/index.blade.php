@extends('layouts.layout')
@section('content')
    <link rel="stylesheet" href="/css/support/support.css">
    @include('help.header')
    {{--        lựa chọn mô hình--}}
    <section id="section1">
        <div class="container">
            <h2>@lang('app.help.model-selection')</h2>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="comon-help">
                        <span class=""><i class="fa fa-home"
                                          style="width: 50px !important; font-size: 50px; vertical-align: sub;"></i></span>
                        <h4>@lang('app.help.level1-name')</h4>
                        <p>@lang('app.help.level1-title')</p>
                        <a class="main-btn2" href="level1-detail" data-ripple="">@lang('app.help.view-more')</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="comon-help">
                        <span class=""><i class="fa fa-bank"
                                          style="width: 50px !important; font-size: 50px; vertical-align: sub;"></i></span>
                        <h4>@lang('app.help.level2-name')</h4>
                        <p>@lang('app.help.level2-title')</p>
                        <a class="main-btn2" href="level2-detail" title=""
                           data-ripple="">@lang('app.help.view-more')</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="comon-help">
                        <span class=""><i class="fa fa-building"
                                          style="width: 50px !important; font-size: 50px; vertical-align: sub;"></i></span>
                        <h4>@lang('app.help.level3-name')</h4>
                        <p>@lang('app.help.level3-title')</p>
                        <a class="main-btn2" href="level3-detail" title=""
                           data-ripple="">@lang('app.help.view-more')</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--        câu hỏi thường gặp--}}
    <section id="section2">
        <div class="container">
            <h2>@lang('app.help.frequently-question')</h2>
            <div class="question">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <div type="button" class="btn btn-question d-flex justify-content-between align-items-center"
                             data-toggle="collapse" data-target="#question2" aria-expanded="false">
                            <button>
                                Tôi muốn đăng ký dùng thử phần mềm TECHRES thì làm thế nào?
                            </button>
                            <i class="fa fa-sort-down"></i>
                        </div>
                    </div>

                    <div id="question2" class="collapse">
                        <div class="card-body">
                            <a href="#" title="">Truy cập vào trang chủ <span
                                        style="text-decoration: underline #fa6342">Techres.vn</span></a>
                            <ol>
                                <li>Chọn "Tư vấn"</li>
                                <li>Chọn "DÙNG THỬ MIỄN PHÍ"</li>
                                <li>Nhập thông tin cá nhân và Techres sẽ phản hồi với bạn</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="question">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <div type="button" class="btn btn-question d-flex justify-content-between align-items-center"
                             data-toggle="collapse" data-target="#question3" aria-expanded="false">
                            <button>
                                Tôi muốn đăng ký dùng thử phần mềm TECHRES thì làm thế nào?
                            </button>
                            <i class="fa fa-sort-down"></i>
                        </div>
                    </div>

                    <div id="question3" class="collapse">
                        <div class="card-body">
                            <a href="#" title="">Truy cập vào trang chủ <span
                                        style="text-decoration: underline #fa6342">Techres.vn</span></a>
                            <ol>
                                <li>Chọn "Tư vấn"</li>
                                <li>Chọn "DÙNG THỬ MIỄN PHÍ"</li>
                                <li>Nhập thông tin cá nhân và Techres sẽ phản hồi với bạn</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="question">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <div type="button" class="btn btn-question d-flex justify-content-between align-items-center"
                             data-toggle="collapse" data-target="#question4" aria-expanded="false">
                            <button>
                                Tôi muốn đăng ký dùng thử phần mềm TECHRES thì làm thế nào?
                            </button>
                            <i class="fa fa-sort-down"></i>
                        </div>
                    </div>

                    <div id="question4" class="collapse">
                        <div class="card-body">
                            <a href="#" title="">Truy cập vào trang chủ <span
                                        style="text-decoration: underline #fa6342">Techres.vn</span></a>
                            <ol>
                                <li>Chọn "Tư vấn"</li>
                                <li>Chọn "DÙNG THỬ MIỄN PHÍ"</li>
                                <li>Nhập thông tin cá nhân và Techres sẽ phản hồi với bạn</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="question">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <div type="button" class="btn btn-question d-flex justify-content-between align-items-center"
                             data-toggle="collapse" data-target="#question5" aria-expanded="false">
                            <button>
                                Tôi muốn đăng ký dùng thử phần mềm TECHRES thì làm thế nào?
                            </button>
                            <i class="fa fa-sort-down"></i>
                        </div>
                    </div>

                    <div id="question5" class="collapse">
                        <div class="card-body">
                            <a href="#" title="">Truy cập vào trang chủ <span
                                        style="text-decoration: underline #fa6342">Techres.vn</span></a>
                            <ol>
                                <li>Chọn "Tư vấn"</li>
                                <li>Chọn "DÙNG THỬ MIỄN PHÍ"</li>
                                <li>Nhập thông tin cá nhân và Techres sẽ phản hồi với bạn</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="question">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <div type="button" class="btn btn-question d-flex justify-content-between align-items-center"
                             data-toggle="collapse" data-target="#question6" aria-expanded="false">
                            <button>
                                Tôi muốn đăng ký dùng thử phần mềm TECHRES thì làm thế nào?
                            </button>
                            <i class="fa fa-sort-down"></i>
                        </div>
                    </div>

                    <div id="question6" class="collapse">
                        <div class="card-body">
                            <a href="#" title="">Truy cập vào trang chủ <span
                                        style="text-decoration: underline #fa6342">Techres.vn</span></a>
                            <ol>
                                <li>Chọn "Tư vấn"</li>
                                <li>Chọn "DÙNG THỬ MIỄN PHÍ"</li>
                                <li>Nhập thông tin cá nhân và Techres sẽ phản hồi với bạn</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-view-more">
                <a class="main-btn2" href="#" data-ripple="">@lang('app.help.view-more')</a>
            </div>
        </div>
    </section>
    {{--        liên hệ ngay--}}
    <section id="section3">
        <div class="gap no-top">
            <div class="container">
                <h2>@lang('app.help.quick-support')</h2>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="help-box">
                            <img src="{{ asset('images/piknik/help-contact.png', env('IS_DEPLOY_ON_SERVER'))}}" alt="">
                            <span>@lang('app.help.need-more-help')</span>
                            <h6>@lang('app.help.contact-us')</h6>
                            <a href="#" title="" class="main-btn2">@lang('app.help.get-help')</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="help-box">
                            <img src="{{ asset('images/piknik/help-chat.png', env('IS_DEPLOY_ON_SERVER'))}}" alt="">
                            <span>@lang('app.help.get-instant-answer')</span>
                            <h6>@lang('app.help.ask-data')</h6>
                            <a href="#" title="" class="main-btn2">@lang('app.help.chat-now')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--        Hướng dẫn sử dụng--}}
    <section id="section4">
        <div class="container">
            <h2>@lang('app.help.user-manual')</h2>
            <div class="manipulation">
                <div class="card">
                    <div class="card-header p-0" id="headingOne">
                        <div type="button"
                             class="btn btn-manipulation d-flex justify-content-between align-items-center p-0"
                             data-toggle="collapse" data-target="#manipulation1" aria-expanded="false">
                            <button>
                                Các chức năng cơ bản của hệ thống
                            </button>
                            <i class="fa fa-angle-down"></i>
                        </div>
                    </div>

                    <div id="manipulation1" class="collapse">
                        <div class="card-body col-lg-10 mx-auto">
                            <div class="manipulation-image">
                                <img src="{{asset('/images/support/action.png', env('IS_DEPLOY_ON_SERVER'))}}" alt="">
                            </div>
                            <h5 class="text-center">Các thao tác cơ bản với hệ thống</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="manipulation">
                <div class="card">
                    <div class="card-header p-0">
                        <div type="button"
                             class="btn btn-manipulation d-flex justify-content-between align-items-center p-0"
                             data-toggle="collapse" data-target="#manipulation2" aria-expanded="false">
                            <button>
                                Thông tin trang món ăn
                            </button>
                            <i class="fa fa-angle-down"></i>
                        </div>
                    </div>

                    <div id="manipulation2" class="collapse">
                        <div class="card-body col-lg-10 mx-auto">
                            <div class="manipulation-image">
                                <img src="{{asset('/images/support/food.png', env('IS_DEPLOY_ON_SERVER'))}}" alt="">
                            </div>
                            <h5 class="text-center">Thông tin trang món ăn</h5>
                            <ol>
                                Lưu ý
                                <li>
                                    Các thao tác cho người dùng (phần đánh dấu xanh lá)
                                    <ul>
                                        <li>Nhấn vào <span class="text-primary">dấu cộng xanh đậm</span> để tạo thêm món
                                            thường
                                        </li>
                                        <li>Nhấn vào <span class="text-warning">dấu cộng cam</span> để tạo thêm món
                                            thường
                                        </li>
                                        <li>Nhấn vào <span class="text-info">dấu cộng xanh nhạt</span> để tạo thêm món
                                            bán kèm
                                        </li>
                                        <li>Nhấn vào <span class="text-success">icon khung ảnh màu xanh lá</span> để
                                            thêm ảnh cho món ăn
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    Tên món ăn (phần đánh dấu đỏ)
                                    <ul>
                                        <li>Phần hình tròn bên trái hiển thị cho hình ảnh món ăn</li>
                                        <li>Phần tên viết in hoa bên dưới hiển thị cho tên danh mục</li>
                                    </ul>
                                </li>
                                <li>
                                    Giá bán (phần đánh dấu cam)
                                    <ul>
                                        <li>Giá tiền phía trên hiển thị cho giá bán</li>
                                        <li>Giá tiền phía dưới hiển thị cho giá gốc</li>
                                    </ul>
                                </li>
                                <li>
                                    Lợi nhuận (phần đánh dấu xanh dương)
                                    <ul>
                                        <li>Số phía trên hiển thị cho phần trăm lợi nhuận</li>
                                        <li>Số phía dưới hiển thị cho tiền lợi nhuận</li>
                                    </ul>
                                </li>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="manipulation">
                <div class="card">
                    <div class="card-header p-0">
                        <div type="button"
                             class="btn btn-manipulation d-flex justify-content-between align-items-center p-0"
                             data-toggle="collapse" data-target="#manipulation3" aria-expanded="false">
                            <button>
                                Cách thêm mới nhân viên
                            </button>
                            <i class="fa fa-angle-down"></i>
                        </div>
                    </div>

                    <div id="manipulation3" class="collapse">
                        <div class="card-body col-lg-10 mx-auto">
                            <ol style="list-style: none">
                                <li>
                                    <h4><b>Bước 1:</b> Tại thanh Menu chọn mục <b>Dữ liệu</b> - <b>Nhân sự</b> - <b>Nhân
                                            viên</b></h4>
                                    <div class="question-img">
                                        <img src="{{asset('/images/support/create_employee1.png', env('IS_DEPLOY_ON_SERVER'))}}"
                                             alt="">
                                    </div>
                                </li>
                                <li>
                                    <h4><b>Bước 2:</b> Giao diện trang Nhân viên xuất hiện</h4>
                                    <div class="question-img">
                                        <img src="{{asset('/images/support/create_employee2.png', env('IS_DEPLOY_ON_SERVER'))}}"
                                             alt="">
                                    </div>
                                </li>
                                <li>
                                    <h4><b>Bước 3:</b> Chọn biểu tượng dấu cộng phía trên bên trái để thêm nhân viên
                                    </h4>
                                    <div class="question-img">
                                        <img src="{{asset('/images/support/create_employee3.png', env('IS_DEPLOY_ON_SERVER'))}}"
                                             alt="">
                                    </div>
                                </li>
                                <li>
                                    <h4><b>Bước 4:</b> Giao diện nhập thông tin nhân viên xuất hiện. Người dùng nhập
                                        thông tin và nhấn nút Lưu lại</h4>
                                    <div class="question-img">
                                        <img src="{{asset('/images/support/create_employee4.png', env('IS_DEPLOY_ON_SERVER'))}}"
                                             alt="">
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="manipulation">
                <div class="card">
                    <div class="card-header p-0">
                        <div type="button"
                             class="btn btn-manipulation d-flex justify-content-between align-items-center p-0"
                             data-toggle="collapse" data-target="#manipulation4" aria-expanded="false">
                            <button>
                                Cách thêm mới nguyên liệu
                            </button>
                            <i class="fa fa-angle-down"></i>
                        </div>
                    </div>

                    <div id="manipulation4" class="collapse">
                        <div class="card-body col-lg-10 mx-auto">
                            <ol style="list-style: none">
                                <li>
                                    <h4><b>Bước 1:</b> Tại thanh Menu chọn mục <b>Dữ liệu</b> - <b>Nguyên liệu</b> - <b>Nguyên
                                            liệu</b></h4>
                                    <div class="question-img">
                                        <img src="{{asset('/images/support/create_material1.png', env('IS_DEPLOY_ON_SERVER'))}}"
                                             alt="">
                                    </div>
                                </li>
                                <li>
                                    <h4><b>Bước 2:</b> Giao diện Nguyên liệu xuất hiện</h4>
                                    <div class="question-img">
                                        <img src="{{asset('/images/support/create_material2.png', env('IS_DEPLOY_ON_SERVER'))}}"
                                             alt="">
                                    </div>
                                </li>
                                <li>
                                    <h4><b>Bước 3:</b> Chọn biểu tượng dấu cộng phía trên bên trái để thêm nguyên liệu
                                    </h4>
                                    <div class="question-img">
                                        <img src="{{asset('/images/support/create_material4.png', env('IS_DEPLOY_ON_SERVER'))}}"
                                             alt="">
                                    </div>
                                </li>
                                <li>
                                    <h4><b>Bước 4:</b> Giao diện nhập thông tin nguyên liệu xuất hiện. Người dùng nhập
                                        thông tin và nhấn nút Lưu lại</h4>
                                    <div class="question-img">
                                        <img src="{{asset('/images/support/create_material3.png', env('IS_DEPLOY_ON_SERVER'))}}"
                                             alt="">
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="manipulation">
                <div class="card">
                    <div class="card-header p-0">
                        <div type="button"
                             class="btn btn-manipulation d-flex justify-content-between align-items-center p-0"
                             data-toggle="collapse" data-target="#manipulation5" aria-expanded="false">
                            <button>
                                Cách thêm mới món ăn
                            </button>
                            <i class="fa fa-angle-down"></i>
                        </div>
                    </div>

                    <div id="manipulation5" class="collapse">
                        <div class="card-body col-lg-10 mx-auto">
                            <ol style="list-style: none">
                                <li>
                                    <h4><b>Bước 1:</b> Tại thanh Menu chọn mục <b>Dữ liệu</b> - <b>Món ăn</b> - <b>Món
                                            ăn</b></h4>
                                    <div class="question-img">
                                        <img src="{{asset('/images/support/create_food1.png', env('IS_DEPLOY_ON_SERVER'))}}"
                                             alt="">
                                    </div>
                                </li>
                                <li>
                                    <h4><b>Bước 2:</b> Giao diện trang Món ăn xuất hiện</h4>
                                    <div class="question-img">
                                        <img src="{{asset('/images/support/create_food2.png', env('IS_DEPLOY_ON_SERVER'))}}"
                                             alt="">
                                    </div>
                                </li>
                                <li>
                                    <h4><b>Bước 3:</b> Chọn biểu tượng dấu cộng phía trên bên trái để thêm món ăn</h4>
                                    <div class="question-img">
                                        <img src="{{asset('/images/support/create_food3.png', env('IS_DEPLOY_ON_SERVER'))}}"
                                             alt="">
                                    </div>
                                </li>
                                <li>
                                    <h4><b>Bước 4:</b> Giao diện nhập thông tin món ăn xuất hiện. Người dùng nhập thông
                                        tin và nhấn nút Lưu lại</h4>
                                    <div class="question-img">
                                        <img src="{{asset('/images/support/create_food4.png', env('IS_DEPLOY_ON_SERVER'))}}"
                                             alt="">
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-view-more">
                <a class="main-btn2 mb-5" href="#" data-ripple="">@lang('app.help.view-more')</a>
            </div>
        </div>

    </section>
    @include('help.footer')

    <script src=https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
            integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
