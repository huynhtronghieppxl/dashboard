<html>
<head>
    <title>@lang('modules.head.title-auth')</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
{{--    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">--}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="@lang('modules.head.description')">
    <meta name="keywords" content="@lang('modules.head.keyword-auth')">
    <meta name="author" content="#">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('images/tms/img.png', env('IS_DEPLOY_ON_SERVER'))}}" type="image/x-icon"/>
    <!-- Bootstrap core CSS -->
    <link href="{{asset('files/assets/auth/css/bootstrap.min.css', env('IS_DEPLOY_ON_SERVER'))}}" rel="stylesheet"/>
    <!--  Material Dashboard CSS    -->
    <link href="{{asset('files/assets/auth/css/material-dashboard.css', env('IS_DEPLOY_ON_SERVER'))}}" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project -->
    <link href="{{asset('files/assets/auth/css/demo.css', env('IS_DEPLOY_ON_SERVER'))}}" rel="stylesheet"/>
    <!-- ico font -->
    <link href="{{asset('files/assets/icon/icofont/css/icofont.css', env('IS_DEPLOY_ON_SERVER'))}}" rel="stylesheet">
    <!--alertify css-->
    <link rel="stylesheet" type="text/css" href="{{asset('files/AlertifyJS/build/css/alertify.css', env('IS_DEPLOY_ON_SERVER'))}}">
    <!--  Fonts and icons  -->
    <link href="{{asset('files/assets/auth/css/font-awesome.css', env('IS_DEPLOY_ON_SERVER'))}}" rel="stylesheet"/>
    <link href="{{asset('files/assets/auth/css/google-roboto-300-700.css', env('IS_DEPLOY_ON_SERVER'))}}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/newStyle.css', env('IS_DEPLOY_ON_SERVER'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/css_custom/loading/style.css', env('IS_DEPLOY_ON_SERVER'))}}">
</head>

<body>
@yield('content')

<!-- Warning Section Starts -->
<!-- Older IE warning message -->
<!--[if lt IE 10]>
<![endif]-->
{{--<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>--}}
{{--<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>--}}
<script src="{{asset('files/assets/auth/js/jquery-3.1.1.min.js', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
<script src="{{asset('files/assets/auth/js/jquery-ui.min.js', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
<script src="{{asset('files/assets/auth/js/bootstrap.min.js', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
<script src="{{asset('files/assets/auth/js/material.min.js', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
<script src="{{asset('files/assets/auth/js/perfect-scrollbar.jquery.min.js', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
<!--   Sharrre Library    -->
<script src="{{asset('files/assets/auth/js/jquery.sharrre.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
<!-- alertify js -->
<script src="{{asset('files/AlertifyJS/build/alertify.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script src="{{asset('files/assets/auth/js/demo.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script src="{{asset('files/assets/auth/js/index.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script type="text/javascript" src="{{asset('files/assets/pages/advance-elements/moment-with-locales.min.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script src="{{asset('js/template_custom/validate.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script type="text/javascript" src="{{asset('js/template_custom/index.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        demo.checkFullPageBackgroundImage();

        setTimeout(function () {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
    });
</script>
@yield("scripts")

</body>

</html>
