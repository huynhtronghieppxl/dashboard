@extends('layouts.layout')
<style>
    .nav-list {
        display: none !important;
    }

    .pcoded-main-container {
        overflow: hidden !important;
    }

    #content-body-techres {
        padding-top: 0 !important;
    }

    .pcoded-inner-content {
        padding: 0 !important;
    }

    .seemt-container .seemt-main {
        max-height: calc(100vh - 80px) !important;
    }
</style>
@section('content')
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.8.0-alpha.1/introjs.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/emoji-mart@latest/css/emoji-mart.css"> -->
<style>
    #main-visible-message {
        font-family: Segoe UI, SegoeuiPc, San Francisco, Helvetica Neue, Helvetica, Lucida Grande, Roboto, Ubuntu, Tahoma, Microsoft Sans Serif, Arial, sans-serif !important;
        overflow: hidden;
    }

    .layout-right-visible-message-container {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .users-thumb-list {
        float: right;
        text-align: center;
    }

    .users-thumb-list>a:first-child {
        margin-left: 0;
    }

    .users-thumb-list>a {
        display: inline-block;
        margin-left: -10px;
        position: relative;
    }

    .users-thumb-list>a img {
        border: 1px solid #fff;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        object-fit: cover;
    }
</style>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css"> -->
<div class="page-wrapper content-message-fixed">
    <div class="page-body">
        <div id="main-visible-message" class="d-flex">
            <div id="layout-left-visible-message" style="">
                @include('message.visible_ver2.left.index')
            </div>
            <div id="layout-right-visible-message" class="d-flex " style="">
                @include('message.visible_ver2.right.index')
            </div>
        </div>
        <div id="check-tag-input-visible-message" contenteditable="true" class="d-none">&nbsp;@</div>
    </div>
</div>
@include('manage.employee.detail')
@include('message.visible_ver2.right.slider')
@include('message.visible_ver2.right.info')

@endsection


@push('scripts')
<script src="{{asset('js/message/visible_v2/filter.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script src="{{asset('js/message/visible_v2/create.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script src="{{asset('js/message/visible_v3/conversation.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script src="{{asset('js/message/visible_v3/detail.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
{{-- NEW--}}
<!-- {{-- <script src="{{asset('js/message/visible_v2/audio.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>--}}
{{-- <script src="{{asset('js/message/visible_v2/scroll.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>--}} -->

<script src="{{asset('js/message/visible_v2/audio.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script src="{{asset('js/message/visible_v2/scroll.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script src="{{asset('js/message/visible_v2/index.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script src="{{asset('js/message/visible_v2/emoji.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script src="{{asset('js/message/visible_v2/about.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script src="{{asset('js/message/visible_v2/body.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script src="{{asset('js/message/visible_v2/input.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
<!-- <script src="{{asset('js/message/visible_v2/listen_socket.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script> -->
<!-- <script src="{{asset('js/message/visible_v2/send_message.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script> -->

<script src="{{asset('js/message/visible_v2/render.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script src="{{asset('js/message/visible_v2/detail.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script src="{{asset('js/message/visible_v2/add.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script src="{{asset('js/message/visible_v2/position.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script src="{{asset('js/message/visible_v2/vote.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script src="{{asset('js/message/visible_v2/profile.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script src="{{asset('js/message/visible_v2/tag_name.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script src="{{asset('js/message/visible_v2/change_name.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
{{-- <script src="{{asset('js/message/visible_v2/config.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>--}}

<!-- <script type="text/javascript" src="{{ asset('js/template_custom/cdn/socket.js', env('IS_DEPLOY_ON_SERVER')) }}"></script> -->


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/kineticjs/5.2.0/kinetic.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.8.0-alpha.1/intro.js"></script> -->

<!-- <script src="{{asset('js/message/visible_v2/tour.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script> -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/devextreme-quill@1.5.14/dist/dx-quill.min.js"></script>
<script src="https://cdn3.devexpress.com/jslib/21.2.7/js/dx.all.js"></script>

{{-- <script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>--}}
<script src="{{asset('js/message/visible_v2/slider.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/emoji-mart@latest/dist/browser.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/emoji-mart@latest/dist/locale/vi.js"></script>--}} -->
@endpush