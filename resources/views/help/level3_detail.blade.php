@extends('layouts.layout')
@section('content')
    @include('help.header')
    <link rel="stylesheet" href="/css/support/support.css">
    <div class="container" id="support-body">
        <div class="option_wrap">
            <div class="name-option">@lang('app.help.detail-level3.option1')</div>
            <div class="image-option col-lg-12 m-auto px-0">
                <img src="http://techres.vn/wp-content/uploads/2021/06/LEV3-OPT1.png" alt="">
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
                        <label>1. Quán từ 20 bàn trở lên, quán khoảng 20 - 100 nhân viên.</label>
                        <label>2. Quán có quầy thu ngân, quầy bar (kho bia),khu bếp nấu, khu bếp nướng, bếp sashimi, hồ hải sản, phòng kế toán.</label>
                        <label>3. Quán có nhân viên thu ngân riêng, quản lí, nhân viên bếp (tả hổ), nhân viên phục vụ, nhân viên quầy bar (kho bia), nhân viên hồ cá, nhân viên kế toán.</label>
                        <label>4. Chủ quán tải app Techres order trên điện thoại hoặc truy cập web techres.vn để quản lí từ xa.</label>
                        <label>5. Có khu vực mua mang về riêng.</label>
                        <label>6. Quán muốn quản lí theo quy trình chặt chẽ, có nguyên tắc, không muốn thất thoát cho dù 1 cái khăn.</label>
                        <label>7. Quán có đầy đủ các bộ phận, đều làm việc theo 1 quy trình đã thống nhất.</label>

                    </div>

                </div>
                <div class="col-lg-4 option-info">
                    <p class="option-info-title">
                        @lang('app.help.device-condition')

                    </p>

                    <div class="option-info-content">
                        <label>1. Cần trang bị 1 máy tính thu ngân, 1 máy tính bếp nấu, 1 máy tính bếp nướng, 1 máy tính quầy bar (kho bia), 1 máy tính kế toán.</label>
                        <label>2. Cần trang bị 1 máy in bill, 1 máy in bếp nấu, 1 máy in bếp nướng.</label>
                        <label>3. Kết nối tất cả máy tính, tất cả máy in với internet qua dây mạng LAN (mạng nội bộ).</label>
                        <label>4. Trang bị giấy in bill 80mm.</label>
                        <label>5. Trang bị modem wifi hoặc sim 3G đảm bảo luôn có mạng internet để làm việc</label>
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
                <div class="col-lg-12 option-info my-5 mx-1">
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
                            <li>10. Tải app Techres Order về điện thoại và đăng nhập tài khoản chủ quán hoặc giám đốc để quản lí từ xa.</li>
                            <li>11. Mở tab tổng quan trong app Techres Order để xem báo cáo doanh thu – chi phí – lợi nhuận mỗi ngày, các hóa đơn hàng ngày và số lượng món bán ra trong ngày, tháng, năm.</li>
                            <li>12. Xem báo cáo nhập kho, xuất kho, tồn kho trên web Techres.vn..</li>
                            <li>13. Nhân viên tư vấn kĩ thuật Techres sẽ hướng dẫn cách sử dụng từng quy trình làm việc.</li>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('help.footer')
@endsection
