<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('../plugins/images/favicon.png', env('IS_DEPLOY_ON_SERVER'))}}">
    <title>500 - Internal Server Error</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset("bootstrap/dist/css/bootstrap.min.css", env('IS_DEPLOY_ON_SERVER')) }}" rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{ asset("css/animate.css", env('IS_DEPLOY_ON_SERVER')) }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset("css/style.css", env('IS_DEPLOY_ON_SERVER')) }}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{ asset("css/colors/default-dark.css", env('IS_DEPLOY_ON_SERVER')) }}" id="theme"  rel="stylesheet">
    <link href="{{ asset("css/custom.css", env('IS_DEPLOY_ON_SERVER')) }}"  rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="error-page">
    <div class="error-box">
        <div class="error-body text-center">
            <h1>500</h1>
            <h3 class="text-uppercase">Internal Server Error.</h3>
            <p class="text-muted m-t-30 m-b-30">Please try after some time</p>
            <a href="{{ url('/login') }}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Back to home</a> </div>
        <footer class="footer text-center">{{ \Carbon\Carbon::today()->year }}</footer>
    </div>
</section>
<!-- jQuery -->
<script src="{{asset('/plugins/bower_components/jquery/dist/jquery.min.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{asset('/bootstrap/dist/js/bootstrap.min.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{asset('/js/custom.min.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>

</body>
</html>
