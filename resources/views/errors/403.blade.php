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
    <link href="{{ asset("bootstrap/dist/css/bootstrap.min.css", env('IS_DEPLOY_ON_SERVER')) }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="{{ asset("css/icon/regular/all.css", env('IS_DEPLOY_ON_SERVER')) }}" rel="stylesheet">
    <link href="{{asset('files/assets/icon/font-awesome/css/font-awesome.min.css', env('IS_DEPLOY_ON_SERVER'))}}"
          rel="stylesheet"/>
    <link href="{{ asset("css/error.css", env('IS_DEPLOY_ON_SERVER')) }}" rel="stylesheet">
</head>
<body>
<section id="wrapper" class="error-page row">
    <div class="error-box">
        <button type="button" class="btn btn-back top"
                onclick="window.history.back()">
            <i class="fa fa-chevron-left"></i> Quay lại
        </button>
        <img width="558" height="280" src="{{asset('images/permission-denied.png', env('IS_DEPLOY_ON_SERVER'))}}" alt="no-permission">
        <table class="" id="table-list-valid-permission">
            <thead>
            <tr>
                <th class="text-center heading-table">Tên quyền</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach($notify_permission as $key => $value)
                    <tr>
                        <td>{{$value}}</td>
                        <td class="text-right copy-btn" onclick="handleCopyPermission($(this))"><i class="fi-rr-copy-alt" data-toggle="tooltip" data-placement="top" data-original-title="Copy"></i></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })
    function handleCopyPermission (r) {
        if(r.find('i').attr('data-original-title') === 'Copied!') return false;
        $('#table-list-valid-permission').find('.copy-btn i').attr("data-original-title", "Copy");
        r.find('i').tooltip('hide').attr("data-original-title", "Copied!").tooltip('show');
        copyToClipboard (r);
    }
    function copyToClipboard(element) {
        let temp = $("<input>");
        $("body").append(temp);
        temp.val(element.prev().text()).select();
        document.execCommand("copy");
        temp.remove();
    }
</script>
</body>
</html>
