@extends('layouts.layout')
@section('content')
    @include('help.header')
    <link rel="stylesheet" href="/css/support/support.css">
    <div class="container" id="support-body">
        <div class="option_wrap mt-5">
            <div class="name-option">@lang('app.help.detail-level1.option1')</div>
            <div class="image-option col-lg-12 m-auto px-0">
                <img src="https://techres.vn/wp-content/uploads/2021/06/LEV1-OPT1.png" alt="">
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
                        <li>1. Quán từ 20 bàn trở xuống hoặc là quán mà người chủ tự nấu, tự order, tự phục vụ, tự thu tiền, quán khoản 2 - 4 người làm việc, chủ yếu là người nhà trong gia đình.</li>
                        <li>2. Quán nhỏ nên cần sự quản lí đơn giản nhất.</li>
                    </div>

                </div>
                <div class="col-lg-4 option-info">
                    <p class="option-info-title">
                        @lang('app.help.device-condition')
                    </p>

                    <div class="option-info-content">
                        <li>1. Cần trang bị 1 máy pos cầm tay Techres.</li>
                        <li>2. Kết nối máy pos Techres với internet qua sóng wifi hoặc sim 3G.</li>
                        <li>3. Trang bị giấy in bill 58mm.</li>
                    </div>

                </div>
                <div class="col-lg-4 option-info">
                    <p class="option-info-title">
                        @lang('app.help.use-condition')
                    </p>

                    <div class="option-info-content">
                        <li>1. Mua máy pos cầm tay Techres..</li>
                        <li>2. Ðăng kí sử dụng phần mềm Techres.</li>
                        <li>3. Chỉ được sử dụng 1 tài khoản duy nhất trên 2 thiết bị di động cùng 1 thời điểm (1 máy pos Techres + 1 điện thoại để quản lí và nhập chi phí).</li>
                    </div>

                </div>
                <div class="col-lg-12 option-info mt-5">
                    <p class="option-info-title">
                        @lang('app.help.user-manual')
                    </p>

                    <div class="option-info-content mx-1">
                        <li>1. Tạo dựng menu quán của bạn.</li>
                        <li>2. Order món theo bàn rồi ra bill và thu tiền.</li>
                        <li>3. Có thể nhập chi phí đi chợ và các chi phí khác qua điện thoại để lưu lại các khoản chi cần thiết hàng ngày.</li>
                        <li>4. Mở tab tổng quan trong app Techres Order để xem báo cáo doanh thu – chi phí – lợi nhuận mỗi ngày, các hóa đơn hàng ngày và số lượng món bán ra trong ngày, tháng, năm.</li>
                    </div>

                </div>
            </div>
        </div>
        <div class="option_wrap">
            <div class="name-option mt-5">@lang('app.help.detail-level1.option2')</div>
            <div class="image-option col-lg-12 m-auto px-0">
                <img src="https://techres.vn/wp-content/uploads/2021/06/LEV1-OPT2.png" alt="">
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
                        <li>1. Quán từ 20 bàn trở xuống hoặc là quán mà người chủ tự nấu, tự order, tự phục vụ, tự thu tiền, quán khoảng 3 7 người làm việc, chủ yếu là người nhà trong gia đình.</li>
                        <li>2. Giành cho các quán có bếp ở xa hoặc muốn in phiếu vào bếp cho đầu bếp nhận phiếu và làm.</li>
                    </div>

                </div>
                <div class="col-lg-4 option-info">
                    <p class="option-info-title">
                        @lang('app.help.device-condition')
                    </p>

                    <div class="option-info-content">
                        <li>1. Cần trang bị 1 máy pos cầm tay Techres.</li>
                        <li>2. Cần trang bị 1 máy in bill bếp Techres.</li>
                        <li>3. Kết nối máy pos cầm tay Techres với wifi , máy in bếp với internet qua dây mạng LAN (mạng internet nội bộ).</li>
                        <li>4. Trang bị giấy in bill 58mm và giấy in 80mm.</li>
                    </div>

                </div>
                <div class="col-lg-4 option-info">
                    <p class="option-info-title">
                        @lang('app.help.use-condition')
                    </p>

                    <div class="option-info-content">
                        <li>1. Mua máy pos cầm tay Techres.</li>
                        <li>2. Ðăng kí sử dụng phần mềm Techres.</li>
                        <li>3. Chỉ được sử dụng 1 tài khoản duy nhất trên 2 thiết bị di động cùng 1 thời điểm ( 1 máy pos Techres + 1 điện thoại để quản lí và nhập chi phí).</li>
                    </div>

                </div>
                <div class="col-lg-12 option-info my-5 mx-1">
                    <p class="option-info-title">
                        @lang('app.help.user-manual')
                    </p>

                    <div class="option-info-content">
                        <li>1. Tạo dựng menu quán của bạn.</li>
                        <li>2. Bật chế độ in món bếp, rồi dò tìm kiếm máy in tìm thấy được và kết nối.</li>
                        <li>3. Tải app Techres Order về điện thoại và đăng nhập.</li>
                        <li>4. Có thể nhập chi phí đi chợ và các chi phí khác qua điện thoại để lưu lại các khoản chi cần thiết hàng ngày.</li>
                        <li>5. Mở tab tổng quan trong app Techres Order để xem báo cáo doanh thu – chi phí – lợi nhuận mỗi ngày, các hóa đơn hàng ngày và số lượng món bán ra trong ngày, tháng, năm.</li>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('help.footer')
@endsection
