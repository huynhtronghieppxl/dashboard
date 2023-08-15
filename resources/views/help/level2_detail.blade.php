@extends('layouts.layout')
@section('content')
    @include('help.header')
    <link rel="stylesheet" href="/css/support/support.css">
    <div class="container" id="support-body">
        <div class="option_wrap">
            <div class="name-option mt-5">@lang('app.help.detail-level2.option1')</div>
            <div class="image-option col-lg-12 m-auto px-0">
                <img src="http://techres.vn/wp-content/uploads/2021/06/LEV2-OPT1.png" alt="">
            </div>
            <div class="video-option col-lg-12 mx-auto mt-5">
                <iframe src="https://www.youtube.com/embed/QQkzmjG5WC4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-4 option-info">
                    <p class="option-info-title">
                        @lang('app.help.subject-use')
                    </p>

                    <div class="option-info-content">
                        <li>1. Quán từ 20 bàn trở lên hoặc là quán mà người chủ hoặc người nhà trực tiếp quản lý, tự in bill, tự thu tiền, quán khoảng 5 - 10 nhân viên.</li>
                        <li>2. Nhân viên sử dụng điện thoại cài app Techres Order để order trực tiếp vào bếp.</li>
                        <li>3. Chủ quán hoặc thu ngân sử dụng máy pos cầm tay Techres để in bill và thanh toán.</li>
                        <li>4. Chủ quán tải app Techres order trên điện thoại hoặc truy cập web techres.vn để quản lí từ xa</li>
                    </div>

                </div>
                <div class="col-lg-4 option-info">
                    <p class="option-info-title">
                        @lang('app.help.device-condition')
                    </p>

                    <div class="option-info-content">
                        <li>1. Cần trang bị 1 máy pos cầm tay và máy in bill Techres.</li>
                        <li>2. Kết nối máy pos cầm tay Techres với wifi hoặc 3G, máy in bếp với internet qua dây mạng LAN ( mạng internet nội bộ).</li>
                        <li>3. Trang bị giấy in bill 58mm và giấy in 80mm.</li>
                        <li>4. Nhân viên phải có điện thoại smartphone sử dụng Android version 7, (ở option 1 này chưa sử dụng được iphone).</li>
                        <li>5. Trang bị modem wifi hoặc sim 3G đảm bảo luôn có mạng internet để làm việc</li>
                        <li>6. Các điện thoại của nhân viên order phải được thiết lập kết nối với máy in bếp.</li>
                    </div>

                </div>
                <div class="col-lg-4 option-info">
                    <p class="option-info-title">
                        @lang('app.help.use-condition')
                    </p>

                    <div class="option-info-content">
                        <li>1. Mua máy pos cầm tay Techres</li>
                        <li>2. Ðăng kí sử dụng phần mềm Techres.</li>
                    </div>

                </div>
                <div class="col-lg-12 option-info mt-5 mx-1">
                    <p class="option-info-title">
                        @lang('app.help.user-manual')
                    </p>

                    <div class="option-info-content row">
                        <div class="col-lg-6">
                            <li>1. Truy cập web Techres.vn.</li>
                            <li>2. Tạo dựng menu quán của bạn.</li>
                            <li>3. Bật chế độ in món bếp, rồi dò tìm kiếm máy in tìm thấy được và kết nối.</li>
                            <li>4. Tạo bộ phận, tạo bậc lương, tạo ca làm việc, tạo nhân viên rồi phân quyền cho nhân viên theo đúng quyền cho phép.</li>
                            <li>5. Tạo khu vực, tạo bàn.</li>
                            <li>6. Tạo nhà cung cấp</li>
                            <li>7. Tạo định lượng món ăn</li>
                        </div>
                        <div class="col-lg-6">
                            <li>8. Order món ăn theo bàn, rồi ra bill và thu tiền.</li>
                            <li>9. Nhập kho, nhập chi phí qua web Techres.vn hoặc app windows mỗi ngày.</li>
                            <li>10. Tải app Techres Order về điện thoại và đăng nhập tài khoản chủ quán.</li>
                            <li>11. Mở tab tổng quan trong app Techres Order để xem báo cáo doanh thu – chi phí – lợi nhuận mỗi ngày, các hóa đơn hàng ngày và số lượng món bán ra trong ngày, tháng, năm.</li>
                            <li>12. Mở tab tổng quan trong app Techres Order để xem báo cáo doanh thu – chi phí – lợi nhuận mỗi ngày, các hóa đơn hàng ngày và số lượng món bán ra trong ngày, tháng, năm.</li>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="option_wrap">
            <div class="name-option">@lang('app.help.detail-level2.option2')</div>
            <div class="image-option col-lg-12 m-auto px-0">
                <img src="http://techres.vn/wp-content/uploads/2021/06/LEV2-OPT2.png" alt="">
            </div>
            <div class="video-option col-lg-12 mx-auto mt-5">
                <iframe src="https://www.youtube.com/embed/QQkzmjG5WC4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-4 option-info">
                    <p class="option-info-title">
                        @lang('app.help.subject-use')
                    </p>

                    <div class="option-info-content">
                        <li>1. Quán từ 20 bàn trở lên,quán khoảng 10 - 20 nhân viên.</li>
                        <li>2. Quán có quầy thu ngân riêng, có quản lí, có bếp (tả hổ), có nhân viên phục vụ, nhân viên quầy bar (kho bia có thể có).</li>
                    </div>

                </div>
                <div class="col-lg-4 option-info">
                    <p class="option-info-title">
                        @lang('app.help.device-condition')
                    </p>

                    <div class="option-info-content">
                        <li>1. Cần trang bị 1 máy tính, 1 máy in bill, 1 máy in kho bia, 1 máy in bếp.</li>
                        <li>2. Kết nối máy tính, máy in bill, máy in bếp, máy in kho bia với internet qua dây mạng LAN (mạng internet nội bộ ).</li>
                        <li>3.Trang bị giấy in bill 80mm.</li>
                        <li>4. Nhân viên phải có điện thoại smartphone sử dụng Android version 7 hoặc Iphone version 12 trở lên.</li>
                        <li>5. Trang bị modem wifi hoặc sim 3G đảm bảo luôn có mạng internet để làm việc.</li>
                    </div>

                </div>
                <div class="col-lg-4 option-info">
                    <p class="option-info-title">
                        @lang('app.help.use-condition')
                    </p>

                    <div class="option-info-content">
                        <label>1. Ðăng kí sử dụng phần mềm Techres.</label>
                    </div>

                </div>
                <div class="col-lg-12 option-info mt-5 mx-1">
                    <p class="option-info-title">
                        @lang('app.help.user-manual')
                    </p>

                    <div class="option-info-content row">
                        <div class="col-lg-6">
                            <li>1. Truy cập web Techres.vn.</li>
                            <li>2. Tạo dựng menu quán của bạn.</li>
                            <li>3. Tạo bộ phận, tạo bậc lương, tạo ca làm việc, tạo nhân viên rồi phân quyền cho nhân viên theo đúng quyền cho phép.</li>
                            <li>4. Tạo khu vực, tạo bàn.</li>
                            <li>5. Tạo nhà cung cấp</li>
                            <li>6. Tạo định lượng món ăn</li>
                        </div>
                        <div class="col-lg-6">
                            <li>7. Order món ăn theo bàn, rồi ra bill và thu tiền.</li>
                            <li>8. Nhập kho, nhập chi phí qua web Techres.vn hoặc app windows mỗi ngày.</li>
                            <li>9. Tải app Techres Order về điện thoại và đăng nhập tài khoản chủ quán hoặc giám đốc để quản lí từ xa.</li>
                            <li>10. Mở tab tổng quan trong app Techres Order để xem báo cáo doanh thu – chi phí – lợi nhuận mỗi ngày, các hóa đơn hàng ngày và số lượng món bán ra trong ngày, tháng, năm.</li>
                            <li>11.Xem báo cáo nhập kho, xuất kho, tồn kho trên web Techres.vn..</li>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="option_wrap">
            <div class="name-option">@lang('app.help.detail-level2.option3')</div>
            <div class="image-option col-lg-12 m-auto px-0">
                <img src="http://techres.vn/wp-content/uploads/2021/06/LEV2-OPT3.png" alt="">
            </div>
            <div class="video-option col-lg-12 mx-auto mt-5">
                <iframe src="https://www.youtube.com/embed/QQkzmjG5WC4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-4 option-info">
                    <p class="option-info-title">
                        @lang('app.help.subject-use')
                    </p>

                    <div class="option-info-content">
                        <label>1. Quán từ 20 bàn trở lên,quán khoảng 10 - 20 nhân viên.</label>
                        <label>2. Quán có quầy thu ngân riêng, có quản lí, có bếp ( tả hổ ), có nhân viên phục vụ, nhân viên quầy bar (kho bia có thể có).</label>
                        <label>3. Phù hợp cho các quán trà sữa, coffee, quán ăn order và thanh toán tại quầy và các quán nhậu vừa và nhỏ..</label>
                        <label>4. Có khu vực mua mang về riêng.</label>
                    </div>

                </div>
                <div class="col-lg-4 option-info">
                    <p class="option-info-title">
                        @lang('app.help.device-condition')
                    </p>

                    <div class="option-info-content">
                        <label>1. Cần trang bị 1 máy pos để bàn, 1 máy in bill, 1 máy in kho bia, 1 máy in bếp, 1 máy in mã vạch (nếu cần).</label>
                        <label>2. Kết nối máy pos, máy in bill, máy in bếp, máy in quầy bar, máy in mã vạch với internet qua dây mạng LAN (mạng nội bộ).</label>
                        <label>3. Trang bị giấy in bill 80mm, giấy in tem (nếu có sử dụng máy in mã vạch).</label>
                        <label>4. Trang bị modem wifi hoặc sim 3G đảm bảo luôn có mạng internet để làm việc.</label>

                    </div>

                </div>
                <div class="col-lg-4 option-info">
                    <p class="option-info-title">
                        @lang('app.help.use-condition')
                    </p>

                    <div class="option-info-content">
                        <label>1. Ðăng kí sử dụng phần mềm Techres..</label>
                    </div>

                </div>
                <div class="col-lg-12 option-info my-5 mx-1">
                    <p class="option-info-title">
                        @lang('app.help.user-manual')
                    </p>

                    <div class="option-info-content row">
                        <div class="col-lg-6">
                            <li>1. Truy cập web Techres.vn.</li>
                            <li>2. Tạo dựng menu quán của bạn.</li>
                            <li>3. Tạo bộ phận, tạo bậc lương, tạo ca làm việc, tạo nhân viên rồi phân quyền cho nhân viên theo đúng quyền cho phép.</li>
                            <li>4. Tạo khu vực, tạo bàn.</li>
                            <li>5. Tạo nhà cung cấp</li>
                            <li>6. Tạo định lượng món ăn</li>
                        </div>
                        <div class="col-lg-6">
                            <li>7. Order món ăn theo bàn, rồi ra bill và thu tiền.</li>
                            <li>8. Nhập kho, nhập chi phí qua web Techres.vn hoặc app windows mỗi ngày.</li>
                            <li>9. Tải app Techres Order về điện thoại và đăng nhập tài khoản chủ quán hoặc giám đốc để quản lí từ xa.</li>
                            <li>10. Mở tab tổng quan trong app Techres Order để xem báo cáo doanh thu – chi phí – lợi nhuận mỗi ngày, các hóa đơn hàng ngày và số lượng món bán ra trong ngày, tháng, năm.</li>
                            <li>11. Xem báo cáo nhập kho, xuất kho, tồn kho trên web Techres.vn.</li>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('help.footer')
@endsection
