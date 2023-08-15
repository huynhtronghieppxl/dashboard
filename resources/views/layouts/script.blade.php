<!-- Facebook -->
{{-- <script async defer crossorigin="anonymous" --}}
{{--        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0&appId=735548903901348&autoLogAppEvents=1" --}}
{{--        nonce="LItamDpA"></script> --}}
<!-- Required Jquery -->

{{-- ===============================    CDN / FILE PATH JQUERY  =============================== --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/jquery-ui/js/jquery-ui.min.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/popper.js/js/popper.min.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/bootstrap/js/bootstrap.min.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.5.2/perfect-scrollbar.jquery.min.js"></script>
{{--<script type="text/javascript" src="{{ asset('files/assets/pages/jqpagination/jquery.jqpagination.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>--}}
<script type="text/javascript" src="{{ asset('files/bower_components/jquery-bar-rating/js/jquery.barrating.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script src="{{ asset('files/assets/pages/isotope/jquery.isotope.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>

{{-- ===============================    CDN / FILE PATH LAYOUT  =============================== --}}
<script type="text/javascript" src="{{ asset('files/assets/js/script.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('files/assets/js/pcoded.min.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>

{{-- ===============================    CDN / FILE PATH SELECT  =============================== --}}
<script type="text/javascript" src="{{ asset('files/bower_components/select2/js/select2.full.min.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('files/assets/pages/advance-elements/select2-custom.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/js/bootstrap-multiselect.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js"></script>

{{-- ===============================    CDN / FILE PATH MOMENT  =============================== --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script type="text/javascript" src="{{ asset('files/assets/pages/advance-elements/moment-with-locales.min.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>

{{-- ===============================    CDN / FILE PATH SEARCH  =============================== --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.4.0/jquery.quicksearch.min.js"></script>

{{-- ===============================    CDN / FILE PATH SWITCHERY  =============================== --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/switchery/js/switchery.min.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>

{{-- ===============================    CDN / FILE PATH SWEETALERT  =============================== --}}
{{--<script src="{{ asset('files/AlertifyJS/build/alertify.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>--}}
<script type="text/javascript" src="{{ asset('files/bower_components/sweetalert/js/sweetalert2@9.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/sweetalert/js/sweetalert.min.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>


{{-- ===============================    CDN / FILE PATH DATEPICKER  =============================== --}}
<script type="text/javascript" src="{{ asset('files/assets/pages/advance-elements/bootstrap-datetimepicker.min.js', env('IS_DEPLOY_ON_SERVER')) }}"> </script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/datedropper/js/datedropper.min.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>

{{-- ===============================    CDN / FILE PATH SHORTCUT  =============================== --}}
<script src="{{ asset('files/assets/js/shortcuts.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>

{{-- ===============================    CDN / FILE PATH MINOCOLOR  =============================== --}}
<script type="text/javascript" src="{{ asset('files/bower_components/jquery-minicolors/js/jquery.minicolors.min.js', env('IS_DEPLOY_ON_SERVER')) }}"> </script>

{{-- ===============================    CDN / FILE PATH TOOLBAR  =============================== --}}
<script type="text/javascript" src="{{ asset('files/assets/pages/toolbar/jquery.toolbar.min.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('files/assets/pages/toolbar/custom-toolbar.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>

{{-- ===============================    CDN / FILE PATH FIREBASE  =============================== --}}
<script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
{{--<script type="text/javascript" src="{{ asset('js/notification/config.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>--}}

{{-- ===============================    CDN / FILE PATH CKEDITOR  =============================== --}}
<script type="text/javascript" src="{{ asset('files/assets/js/ckeditor/ckeditor.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('js/template_custom/ckeditor.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>

{{-- ===============================    CDN / FILE PATH ECHART  =============================== --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.3.3/echarts.min.js"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/chart.js/js/Chart.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>

{{-- ===============================    CDN / FILE PATH CROPPIE  =============================== --}}
<script type="text/javascript" src="{{ asset('js/template_custom/cdn/croppie.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>


{{-- ===============================    CDN / FILE PATH PNOTIFY  =============================== --}}
{{--<script type="text/javascript" src="{{ asset('files/bower_components/pnotify/js/pnotify.js', env('IS_DEPLOY_ON_SERVER')) }}">--}}
{{--</script>--}}
{{--<script type="text/javascript"--}}
{{--    src="{{ asset('files/bower_components/pnotify/js/pnotify.desktop.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>--}}
{{--<script type="text/javascript"--}}
{{--    src="{{ asset('files/bower_components/pnotify/js/pnotify.buttons.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>--}}
{{--<script type="text/javascript"--}}
{{--    src="{{ asset('files/bower_components/pnotify/js/pnotify.confirm.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>--}}
{{--<script type="text/javascript"--}}
{{--    src="{{ asset('files/bower_components/pnotify/js/pnotify.callbacks.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>--}}
{{--<script type="text/javascript"--}}
{{--    src="{{ asset('files/bower_components/pnotify/js/pnotify.animate.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>--}}
{{--<script type="text/javascript"--}}
{{--    src="{{ asset('files/bower_components/pnotify/js/pnotify.history.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>--}}
{{--<script type="text/javascript"--}}
{{--    src="{{ asset('files/bower_components/pnotify/js/pnotify.mobile.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>--}}
{{--<script type="text/javascript"--}}
{{--    src="{{ asset('files/bower_components/pnotify/js/pnotify.nonblock.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('files/assets/pages/pnotify/notify.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>--}}

{{-- ===============================    CDN / FILE PATH TEAMPLATE CUSTOM  =============================== --}}
<script type="text/javascript" src="{{ asset('js/template_custom/number_format.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('js/template_custom/setting.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('js/template_custom/cookie.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('js/template_custom/validate.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('js/template_custom/index.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('js/template_custom/upload.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('js/template_custom/rating.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('js/template_custom/version.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('js/template_custom/chart.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('js/template_custom/table.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('js/template_custom/calendar.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('js/template_custom/excel.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('js/template_custom/changeTheme.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('js/template_custom/calculator.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
{{--<script type="text/javascript" src="{{ asset('js/template_custom/cdn/lightgallery.umd.js', env('IS_DEPLOY_ON_SERVER')) }}">--}}
{{--</script>--}}
{{--<script type="text/javascript" src="{{ asset('js/template_custom/cdn/lg-zoom.umd.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>--}}
{{--<script type="text/javascript"--}}
{{--    src="{{ asset('js/template_custom/cdn/jquery.justifiedGallery.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('js/template_custom/cdn/lg-thumbnail.umd.js', env('IS_DEPLOY_ON_SERVER')) }}">--}}
{{--</script>--}}
<script type="text/javascript" src="{{ asset('js/template_custom/dataTable.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('js/template_custom/favicon.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
{{--<script type="text/javascript" src="{{ asset('js/template_custom/set_interval.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>--}}
<script type="text/javascript" src="{{ asset('js/template_custom/form_validate.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('js/template_custom/count_character.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>


{{-- ===============================    CDN / FILE PATH SỬ DỤNG KHÔNG THƯỜNG XUYÊN  =============================== --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/spectrum/js/spectrum.js', env('IS_DEPLOY_ON_SERVER')) }}"> </script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>
{{--<script src="{{ asset('files/assets/pages/isotope/isotope.pkgd.min.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>--}}
<script type="text/javascript" src="{{ asset('files/assets/pages/advance-elements/swithces.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script type="text/javascript" src="{{ asset('files/assets/pages/advance-elements/custom-picker.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script src="{{ asset('files/assets/pages/form-masking/inputmask.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script src="{{ asset('files/assets/pages/form-masking/jquery.inputmask.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script src="{{ asset('files/assets/pages/form-masking/autoNumeric.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
<script src="{{ asset('files/assets/pages/form-masking/form-mask.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>
{{--<script type="text/javascript" src="{{ asset('files/bower_components/Sortable/js/Sortable.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>--}}
{{--<script src="{{ asset('js/message/visible_v2/emoji.js?version=1', env('IS_DEPLOY_ON_SERVER')) }}"></script>--}}
{{--<script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>--}}







{{-- ===============================    CDN / FILE PATH bị trùng hoặc chưa tìm thấy nơi sử dụng  =============================== --}}
{{-- <script type="text/javascript" src="{{asset('files\bower_components\jquery-slimscroll\js\jquery.slimscroll.js')}}"></script> --}}
{{-- <script type="text/javascript" src="{{asset('files\bower_components\modernizr\js\modernizr.js')}}"></script> --}}
{{-- <script type="text/javascript" src="{{asset('files\bower_components\modernizr\js\css-scrollbars.js')}}"></script> --}}
{{-- <script type="text/javascript" src="{{asset('files\bower_components\intro.js\js\intro.js')}}"></script> --}}
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/intro.min.js"></script> --}}
{{-- <script type="text/javascript" src="{{asset('files\bower_components\i18next\js\i18next.min.js')}}"></script> --}}
{{-- <script type="text/javascript" --}}
{{--        src="{{asset('files\bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js')}}"></script> --}}
{{-- <script type="text/javascript" --}}
{{--        src="{{asset('files\bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js')}}"></script> --}}
{{-- <script type="text/javascript" --}}
{{--        src="{{asset('files\bower_components\jquery-i18next\js\jquery-i18next.min.js')}}"></script> --}}
{{-- <script type="text/javascript" src="{{asset('files\assets\js\vartical-layout.min.js')}}"></script> --}}
{{-- <script type="text/javascript" src="{{asset('files\assets\js\vartical-layout.min.js')}}"></script> --}}
{{-- <script src="{{asset('files\assets\pages\foo-table\js\footable.min.js')}}"></script> --}}
{{-- <script type="text/javascript" src="{{asset('files\bower_components\i18next\js\i18next.min.js')}}"></script> --}}
{{-- <script type="text/javascript" --}}
{{--        src="{{asset('files\bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js')}}"></script> --}}
{{-- <script type="text/javascript" --}}
{{--        src="{{asset('files\bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js')}}"></script> --}}
{{-- <script type="text/javascript" --}}
{{--        src="{{asset('files\bower_components\jquery-i18next\js\jquery-i18next.min.js')}}"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"></script> --}}
{{-- <script type="text/javascript" src="{{asset('js/template_custom/cdn/goolgetagmanager.js')}}"></script> --}}
{{-- <script type="text/javascript" src="{{asset('files\bower_components\bootstrap-multiselect\js\bootstrap-multiselect.js')}}"></script> --}}
{{-- <script type="text/javascript" src="{{asset('files\assets\js\jquery.quicksearch.js')}}"></script> --}}
{{-- <script src="{{asset('files\assets\js\moment\moment.js')}}"></script> --}}
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js"></script> --}}
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script> --}}
{{-- <script type="text/javascript" src="{{asset('files\bower_components\bootstrap-daterangepicker\js\daterangepicker.js')}}"></script> --}}
{{-- <script type="text/javascript" src="{{asset('files\bower_components\jquery.cookie\js\jquery.cookie.js')}}"></script> --}}
{{-- <script src="{{asset('files\assets\js\jquery-qrcode-0.17.0.js')}}"></script> --}}
{{-- <script src="{{asset('files\assets\js\moment\moment.js')}}"></script> --}}
{{-- <script type="text/javascript" src="{{asset('files\assets\js\dropzone\dropzone.js')}}"></script> --}}
{{-- <script src="{{asset('js\template_custom/tableHeadFixer.js?version=')}}"></script> --}}
{{-- <script src="{{asset('files\bower_components\d3\js\d3.js')}}"></script> --}}
{{-- <script src="{{asset('files\bower_components\nvd3\js\nv.d3.js')}}"></script> --}}
{{-- <script src="{{asset('files\assets\pages\chart\nv-chart\js\stream_layers.js')}}"></script> --}}
{{-- <script type="text/javascript" src="{{asset('files\bower_components\jscolor\js\jscolor.js')}}"></script> --}}

<script>
    let domainSocket = "{{ Session::get(SESSION_NODE_DOMAIN) }}",
        domainSession = "{{ Session::get(SESSION_NODE_KEY_BASE_URL_ADS) }}",
        branchIdSession = parseInt("{{ Session::get(SESSION_KEY_BRANCH_ID) }}"),
        restaurantIdSession = parseInt("{{ Session::get(SESSION_RESTAURANT) }}"),
        idSession = parseInt("{{ Session::get(SESSION_JAVA_ACCOUNT)['id'] }}"),
        usernameSession = "{{ Session::get(SESSION_JAVA_ACCOUNT)['username'] }}",
        nameSession = "{{ Session::get(SESSION_JAVA_ACCOUNT)['name'] }}",
        avatarSession = "{{ Session::get(SESSION_JAVA_ACCOUNT)['avatar'] }}",
        roleSession = "{{ Session::get(SESSION_JAVA_ACCOUNT)['employee_role_id'] }}",
        roleNameSession = "{{ Session::get(SESSION_JAVA_ACCOUNT)['employee_role_name'] }}",
        tokenSession = "{{ Session::get(SESSION_NODE_KEY_TOKEN_NOTIFICATION) }}";
</script>
@include('layouts.datatable')
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());
    gtag('config', 'UA-23581568-13');
    gtag('js', new Date());
    gtag('config', 'UA-23581568-13');
    $(function() {
        $('#mCSB_1_container').css('top', localStorage.getItem("myNavPosition"));
        $("#mCSB_1_container ul li, #mCSB_1_container ul li ul li").on('click', async function() {
            localStorage.myNavPosition = await $('#mCSB_1_container').css("top");
        });
    })
</script>
