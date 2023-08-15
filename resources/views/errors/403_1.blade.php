<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('plugins/images/favicon.png', env('IS_DEPLOY_ON_SERVER'))}}">
    <title>403 - KHÔNG CÓ QUYỀN</title>
    <link href="{{ asset("css/icon/regular/all.css", env('IS_DEPLOY_ON_SERVER')) }}" rel="stylesheet">
    <link href="{{asset('files/assets/icon/font-awesome/css/font-awesome.min.css', env('IS_DEPLOY_ON_SERVER'))}}"
          rel="stylesheet"/>
    <link href="{{ asset("css/error.css", env('IS_DEPLOY_ON_SERVER')) }}" rel="stylesheet">
</head>
<body>
<section id="wrapper" class="error-page no-branch row">
    <div class="error-box">
        <img width="236" height="157" src="{{asset('images/not-allowed.png', env('IS_DEPLOY_ON_SERVER'))}}" alt="no-branch">
        <div class="error-message-content">{{$notify_permission}}</div>
        <button type="button" class="btn btn-back"
                onclick="window.history.back()">
            <i class="fa fa-chevron-left"></i> Quay lại
        </button>
    </div>
</section>
</body>
</html>
