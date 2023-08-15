<html>
<head>
    <title>Trang không tồn tại</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap core CSS     -->
    <link href="{{asset('..\files\assets\auth\css\bootstrap.min.css', env('IS_DEPLOY_ON_SERVER'))}}" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="{{asset('..\files\assets\auth\css\material-dashboard.css', env('IS_DEPLOY_ON_SERVER'))}}" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{asset('..\files\assets\auth\css\demo.css', env('IS_DEPLOY_ON_SERVER'))}}" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="{{asset('..\files\assets\auth\css\font-awesome.css', env('IS_DEPLOY_ON_SERVER'))}}" rel="stylesheet" />
    <link href="{{asset('..\files\assets\auth\css\google-roboto-300-700.css', env('IS_DEPLOY_ON_SERVER'))}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('..\css\newStyle.css', env('IS_DEPLOY_ON_SERVER'))}}">
</head>

<body>
<!-- Pre-loader start -->
<div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
        </div>
    </div>
</div>
<!-- Pre-loader end -->
<div class="wrapper wrapper-full-page">
    <div class="full-page login-page" filter-color="black">
        <div class="content" style="width: 100%;">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 row">
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                            <form method="post" action="/login" id="login-form">
                                {{ csrf_field() }}
                                <div class="card card-login card-hidden">
                                    <div class="card-header text-center" data-background-color="yellow">
                                        <h4 class="card-title">TECHRES</h4>
                                        <div class="social-line">
                                            <a href="#!" class="btn btn-just-icon btn-simple">
                                                <i class="fa fa-facebook-square"></i>
                                            </a>
                                            <a href="#!" class="btn btn-just-icon btn-simple">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                            <a href="#!" class="btn btn-just-icon btn-simple">
                                                <i class="fa fa-google-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="footer text-center">
                                        <button type="button" class="btn btn-rose btn-simple btn-wd btn-lg font-weight-bold btn_login" onclick="goBack()">Quay lại</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Warning Section Starts -->
<!-- Older IE warning message -->
<!--[if lt IE 10]>
<![endif]-->
<script src="{{asset('..\files\assets\auth\js\jquery-3.1.1.min.js', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
<script src="{{asset('..\files\assets\auth\js\jquery-ui.min.js', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
<script src="{{asset('..\files\assets\auth\js\bootstrap.min.js', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
<script src="{{asset('..\files\assets\auth\js\material.min.js', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
<script src="{{asset('..\files\assets\auth\js\perfect-scrollbar.jquery.min.js', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
<!--   Sharrre Library    -->
<script src="{{asset('..\files\assets\auth\js\jquery.sharrre.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset('..\files\assets\auth\js\demo.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script src="{{asset('/vendor/axios/axios.min.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script type="text/javascript">
    $().ready(function() {
        demo.checkFullPageBackgroundImage();

        setTimeout(function() {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
    });
    function goBack() {
        window.history.back()
    }
</script>

@yield("scripts")

</body>

</html>
