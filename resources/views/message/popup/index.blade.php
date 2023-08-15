{{--<link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet"/>--}}
<link rel="stylesheet" href="{{asset('css/css_custom/message/popup.css')}}"/>
<link rel="stylesheet" href="{{asset('css/css_custom/message/visible_ver2/body.css')}}">
<div class="container-chat" id="chat-popup-tms">
{{--    @include('message.popup.sidebar')--}}
    @include('message.popup.chat_form')
    @include('message.visible_ver2.right.body.vote')
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
    <script src="{{asset('js/message/popup/index.js',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('js/message/popup/handle.js',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('js/message/popup/chat_form.js',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('js/message/popup/header.js',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('js/message/popup/sticker.js',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('js/message/popup/body.js',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('js/message/popup/send_message_popup.js',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('js/message/popup/render.js',env('IS_DEPLOY_ON_SERVER'))}}"></script>
{{--    <script src="{{asset('js/message/popup/listen_socket.js',env('IS_DEPLOY_ON_SERVER'))}}"></script>--}}
    <script src="{{asset('js/message/popup/input.js',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('js/message/popup/position.js',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('js/message/popup/order.js',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript" src="{{ asset('js/template_custom/cdn/socket.js', env('IS_DEPLOY_ON_SERVER')) }}"></script>

{{--    <script src="{{asset('js/message/visible_v2/vote.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>--}}
    {{--  NEW --}}
@endpush
