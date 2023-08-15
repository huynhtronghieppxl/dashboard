


<!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
<!--[if lt IE 10]> -->
{{--<script type="text/javascript"--}}
{{--        src="{{asset('js/template_custom/cdn/html5shiv.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>--}}
{{--<script type="text/javascript"--}}
{{--        src="{{asset('js/template_custom/cdn/respond.min.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>--}}
<!-- Meta -->
<meta charset="utf-8"/>
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="description" content="@lang('modules.head.description')"/>
<meta name="keywords" content="@lang('modules.head.keyword')"/>
<meta name="author" content="Leadgle"/>
<meta name="turbolinks-cache-control" content="no-cache"/>
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

<!-- =============================== FAVICON ICON / FONT-FAMILY =============================== -->
<link rel="icon" href="{{asset('images/tms/img.png', env('IS_DEPLOY_ON_SERVER'))}}" type="image/x-icon"/>
<link href="{{asset('css/cdn/fontQuicksand.css', env('IS_DEPLOY_ON_SERVER'))}}">

{{--     ===============================    CDN / FILE PATH HEADER  ===============================--}}
<link rel="stylesheet" type="text/css" href="{{asset('css/header.css', env('IS_DEPLOY_ON_SERVER'))}}"/>

{{--     ===============================    CDN / FILE PATH DATATABLE  ===============================--}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css">
<link rel="stylesheet" href="{{asset('css/dataTable.css'), env('IS_DEPLOY_ON_SERVER')}}"/>
<link rel="stylesheet" type="text/css"
      href="{{asset('files/bower_components/select2/css/select2.min.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" type="text/css"
      href="{{asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.2.0/css/rowGroup.dataTables.min.css"/>

{{--     ===============================    CDN / FILE PATH SCROLLBAR  ===============================--}}
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.5.2/perfect-scrollbar.min.css"/>
<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.mCustomScrollbar.css', env('IS_DEPLOY_ON_SERVER'))}}"/>

{{--     ===============================    CDN / FILE PATH RESPONSIVE  ===============================--}}
<link rel="stylesheet" type="text/css"
      href="{{asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" type="text/css"
      href="{{asset('files/assets/pages/data-table/extensions/responsive/css/responsive.dataTables.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" type="text/css"
      href="{{asset('files/bower_components/datatable-fixedcolumns/css/fixedColumns.bootstrap.min.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet"
      href="{{asset('files/bower_components/bootstrap/css/bootstrap.min.css', env('IS_DEPLOY_ON_SERVER'))}}"/>

{{--     ===============================    CDN / FILE PATH PAGINATION  ===============================--}}
<link rel="stylesheet" type="text/css"
      href="{{asset('files/assets/pages/jqpagination/jqpagination.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('css/css_custom/pagination.css', env('IS_DEPLOY_ON_SERVER'))}}"/>

{{--     ===============================    CDN / FILE PATH SWITCHERY  ===============================--}}
<link rel="stylesheet" type="text/css"
      href="{{asset('files/bower_components/switchery/css/switchery.min.css', env('IS_DEPLOY_ON_SERVER'))}}"/>

{{--     ===============================    CDN / FILE PATH TOOLBAR  ===============================--}}
<link rel="stylesheet" type="text/css"
      href="{{asset('files/assets/pages/toolbar/jquery.toolbar.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" type="text/css"
      href="{{asset('files/assets/pages/toolbar/custom-toolbar.css', env('IS_DEPLOY_ON_SERVER'))}}"/>

{{--     ===============================    CDN / FILE PATH ALERTIFY  ===============================--}}
{{--<link rel="stylesheet" type="text/css"--}}
{{--      href="{{asset('files/AlertifyJS/build/css/alertify.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}

{{--     ===============================    CDN / FILE PATH SELECT  ===============================--}}
{{--<link rel="stylesheet" type="text/css"--}}
{{--      href="{{asset('files/AlertifyJS/build/css/alertify.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}
<link rel="stylesheet" type="text/css"
      href="{{asset('files/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" type="text/css"
      href="{{asset('files/bower_components/multiselect/css/multi-select.css', env('IS_DEPLOY_ON_SERVER'))}}"/>

{{--     ===============================    CDN / FILE PATH CROPPIE  ===============================--}}
<link rel="stylesheet" href="{{asset('css/cdn/croppie.css', env('IS_DEPLOY_ON_SERVER'))}}"/>


<link rel="stylesheet" type="text/css" href="{{asset('css/style.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('css/newStyle.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('css/css_custom/swal2.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" type="text/css"
      href="{{asset('css/css_custom/loading/style.css', env('IS_DEPLOY_ON_SERVER'))}}"/>

{{--     ===============================    CDN / FILE PATH ELEMENT  ===============================--}}
<link rel="stylesheet" href="{{asset('css/css_custom/validate/form_select.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" href="{{asset('css/css_custom/validate/form_checkbox.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" href="{{asset('css/css_custom/validate/form_input.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" href="{{asset('css/css_custom/validate/form_lable.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" href="{{asset('css/css_custom/validate/form_radio.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" href="{{asset('css/css_custom/validate/form_textarea.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
{{--<link rel="stylesheet" href="{{asset('css/css_custom/social/social.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}

{{--     ===============================    CDN / FILE PATH ICONS  ===============================--}}
<link
    href="{{asset('files/assets/icon/material-design/css/material-design-iconic-font.min.css', env('IS_DEPLOY_ON_SERVER'))}}"
    rel="stylesheet"/>
<link
    href="{{asset('files/assets/icon/typicons-icons/css/typicons.min.css" rel="stylesheet', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link
    href="{{asset('files/assets/icon/themify-icons/themify-icons.css" rel="stylesheet', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link href="{{asset('files/assets/icon/font-awesome/css/font-awesome.min.css', env('IS_DEPLOY_ON_SERVER'))}}"
      rel="stylesheet"/>
<link href="{{asset('files/assets/icon/icofont/css/icofont.css', env('IS_DEPLOY_ON_SERVER'))}}" rel="stylesheet"/>
<link href="{{asset('files/assets/icon/ion-icon/css/ionicons.min.css', env('IS_DEPLOY_ON_SERVER'))}}" rel="stylesheet"/>
<link rel="stylesheet" type="text/css"
      href="{{asset('files/assets/pages/flag-icon/flag-icon.min.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
{{--<link rel="stylesheet" type="text/css"--}}
{{--      href="{{asset('files/assets/icon/feather/css/feather.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}

{{--     ===============================    CDN / FILE PATH PNOTIFY  ===============================--}}
{{--<link rel="stylesheet" type="text/css"--}}
{{--      href="{{asset('files/bower_components/pnotify/css/pnotify.mobile.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}
{{--<link rel="stylesheet" type="text/css"--}}
{{--      href="{{asset('files/assets/pages/pnotify/notify.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}
{{--<link rel="stylesheet" type="text/css"--}}
{{--      href="{{asset('files/bower_components/pnotify/css/pnotify.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}

{{--     ===============================    CDN / FILE PATH SWEETALERT  ===============================--}}
<link rel="stylesheet" type="text/css"
      href="{{asset('files/bower_components/sweetalert/css/sweetalert.min.css', env('IS_DEPLOY_ON_SERVER'))}}"/>

{{--     ===============================    CDN / FILE PATH DATEPICKER  ===============================--}}
<link rel="stylesheet" type="text/css"
      href="{{asset('files/bower_components/bootstrap-daterangepicker/css/daterangepicker.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" type="text/css"
      href="{{asset('files/assets/pages/advance-elements/css/bootstrap-datetimepicker.css', env('IS_DEPLOY_ON_SERVER'))}}"/>

{{--     ===============================    CDN / FILE PATH PNOTIFY  ===============================--}}
{{--<link rel="stylesheet" type="text/css"--}}
{{--      href="{{asset('files/bower_components/pnotify/css/pnotify.buttons.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}
{{--<link rel="stylesheet" type="text/css"--}}
{{--      href="{{asset('files/bower_components/pnotify/css/pnotify.history.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}


{{--     ===============================    CDN / FILE PATH LIBRARY ít sử dụng, * bật lại khi cần ===============================--}}
<link rel="stylesheet" type="text/css"
      href="{{asset('css\css_custom\custom_header.css?version=', env('IS_DEPLOY_ON_SERVER'))}}"/>

<link rel="stylesheet" type="text/css"
      href="{{asset('files\bower_components\jquery.steps\css\jquery.steps.css', env('IS_DEPLOY_ON_SERVER'))}}"/>

<!-- Dropzone ( thư viện kéo thả tệp tin vào ) đang sử dụng ở folder notify  -->
<link rel="stylesheet" href="{{asset('css\dropzone.css', env('IS_DEPLOY_ON_SERVER'))}}" type="text/css"/>

{{--        jforms tạo các biểu mẫu đăng ký, đăng nhập, liên hệ và nhiều loại biểu mẫu--}}
<link rel="stylesheet" type="text/css"
      href="{{asset('files\assets\pages\j-pro\css\j-forms.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<!-- toolbar css -->

<!-- Date-range picker css  -->

<!-- Date-Dropper css chọn ngày tháng từ một giao diện đơn giản và trực quan, với nhiều tùy chọn tùy chỉnh để thay đổi giao diện và tính năng của giao diện -->
<link rel="stylesheet" type="text/css"
      href="{{asset('files\bower_components\datedropper\css\datedropper.min.css', env('IS_DEPLOY_ON_SERVER'))}}"/>


<!-- spectrum css tương tự như minocolors nhưng chưa tìm thấy menu sử dụng -->
<link rel="stylesheet" type="text/css"
      href="{{asset('files\bower_components\spectrum\css\spectrum.css', env('IS_DEPLOY_ON_SERVER'))}}"/>

<!-- Font awesome star css ? kh thấy menu sử dụng-->
<link rel="stylesheet" type="text/css"
      href="{{ asset('files\bower_components\font-awesome\css\font-awesome.min.css', env('IS_DEPLOY_ON_SERVER')) }}"/>
<!-- Font awesome star css -->
<link rel="stylesheet" type="text/css"
      href="{{ asset('files\bower_components\jquery-bar-rating\css\fontawesome-stars.css', env('IS_DEPLOY_ON_SERVER')) }}"/>
<!-- notify js Fremwork -->

{{--        brighttheme css: các mẫu thiết kế, phông chữ, biểu tượng và các thành phần giao diện--}}
<link rel="stylesheet" type="text/css"
      href="{{ asset('files\bower_components\pnotify\css\pnotify.brighttheme.css', env('IS_DEPLOY_ON_SERVER')) }}"/>

<!-- Sweetalert.css -->
<link rel="stylesheet" type="text/css"
      href="{{asset('files\bower_components\sweetalert\css\sweetalert.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<!-- lightgallery framework: tạo ra các bộ sưu tập hình ảnh và video -->
{{--<link rel="stylesheet" href="{{ asset('css/cdn/lg-zoom.css', env('IS_DEPLOY_ON_SERVER')) }}"/>--}}
{{--<link rel="stylesheet" href="{{ asset('css/cdn/justifiedGallery.css', env('IS_DEPLOY_ON_SERVER')) }}"/>--}}
{{--<link rel="stylesheet" href="{{ asset('css/cdn/justifiedGallery.css', env('IS_DEPLOY_ON_SERVER')) }}"/>--}}
{{--<link rel="stylesheet" href="{{ asset('css/cdn/lg-thumbnail.css', env('IS_DEPLOY_ON_SERVER')) }}"/>--}}
{{--<link rel="stylesheet" href="{{ asset('css/cdn/lightgallery.css', env('IS_DEPLOY_ON_SERVER')) }}"/>--}}
{{--<link rel="stylesheet" href="{{ asset('files/bower_components/swiper/css/swiper.min.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css\newStyle2.css', env('IS_DEPLOY_ON_SERVER'))}}" />--}}
{{--<link rel="stylesheet" type="text/css" href="{{asset('css\css_custom\introjs.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}

<link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/head.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/dataTable.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/header.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/menu_left.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/menu_sub.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/modal.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/input.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/validate.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
<link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/element.css', env('IS_DEPLOY_ON_SERVER'))}}"/>

<link rel='stylesheet' type="text/css" href='{{asset('css/icon/regular/all.css', env('IS_DEPLOY_ON_SERVER'))}}'>
