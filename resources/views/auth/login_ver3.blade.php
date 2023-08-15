@extends('auth.layout')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12 col-lg-7">
                <img class="img-fluid" src="images/img_pos.png">
            </div>
            <div class="col-12 col-lg-5 ">
                <form method="post" action="/login" id="login-form" class="form-group text-center">
                    {{ csrf_field() }}
                    <img class=" img-fluid mx-auto d-block  my-4" src="images/logo.png" style="max-width: 70%">
                    <img class=" img-fluid mx-auto d-block  my-4" src="images/login_icon.png">
                    <input type="username" name="username" placeholder="Username">
                    <input type="password" name="password" placeholder="Password">
                    <button class="align-item-center my-3" type="submit">Đăng Nhập</button>
                    <small class="d-block"><a href="#">Quên mật khẩu?</a></small>
                </form>
            </div>
        </div><!--ROW-->
    </div><!-- container -->
    <footer class="footer-login-v3">
        <ul class="list-inline container text-center">
            <li class="list-inline-item"><a href="#">Tổng đài tư vấn</a></li>
            <li class="list-inline-item"><a href="#">support@techres.vn</a></li>
            <li class="list-inline-item"><a href="#">Hướng dẫn sử dụng</a></li>
        </ul>
    </footer>
@endsection

@section("scripts")
    <script>
        $(function () {
            axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
            let isProcessing = 1;

            const resetAlert = () => {
                $(".txt_alert").html("");
                $(".txt_alert").hide();
            };

            $(".btn_login").click(async function (e) {
                await getLogin(e)
            });

            $("#login-form").keypress(async function (e) {
                if (e.keyCode == 13) {
                    await getLogin(e)
                }
            });

            async function getLogin(e) {
                e.preventDefault();
                if (isProcessing === 1) {
                    isProcessing = 2;
                    resetAlert();
                    const restaurant_name = $(".restaurant_name").val();
                    const username = $(".username").val();
                    const password = $(".password").val();

                    if (!restaurant_name || !username || !password) {
                        isProcessing = 1;
                        $(".txt_alert").html("Vui lòng nhập đầy đủ thông tin đăng nhập !");
                        $(".txt_alert").show();
                        return false;
                    }

                    let loginSuccess = true;
                    await axios.post("/login", {
                        restaurant_name: restaurant_name,
                        username: username,
                        password: password
                    }).then(res => {
                        let textFail = "";
                        if (res.status !== 200) {
                            loginSuccess = false;
                            textFail = "Lỗi hệ thống, vui lòng thử lại !";
                        } else if (res.data.code !== 200) {
                            textFail = res.data.msg;
                        } else if (res.data.data !== true) {
                            textFail = "Tài khoản không có quyền truy cập !";
                        }
                        if (textFail) {
                            loginSuccess = false;
                            isProcessing = 1;
                            $(".txt_alert").html(textFail);
                            $(".txt_alert").show();
                            return false;
                        }
                    });
                    if (loginSuccess) {
                        // window.location.href = "/";
                        axios.post('/login-chat', {
                            username:username,
                            password:password
                        }).then(res => {
                            if (res.status !== 200) {
                                console.log('login chat lỗi.');
                                window.location.href = "/";
                            }
                            console.log('login chat '+res.data);
                            window.location.href = "/";
                        }).catch(error => {
                            console.log('login chat lỗi.');
                            window.location.href = "/";
                        });
                    }

                }
            }
        })
    </script>
@endsection