<link rel="stylesheet" href="{{asset('css/css_custom/message/visible_ver2/body.css')}}">
<link rel="stylesheet" href="{{asset('css/css_custom/message/visible_ver2/about.css')}}">
<link rel="stylesheet" href="{{asset('css/css_custom/message/visible_ver2/input.css')}}">
<link rel="stylesheet" href="{{asset('css/css_custom/message/visible_ver2/call.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.1.3/css/dx.carmine.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.1.3/css/dx.light.compact.min.css" />

{{--<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">--}}
<div id="layout-body-visible-message" style="" class="d-none about-active">
    @include('message.visible_ver2.right.body.header')
    @include('message.visible_ver2.right.body.pinned')
    @include('message.visible_ver2.right.body.body')
    @include('message.visible_ver2.right.body.input')
    @include('message.visible_ver2.right.body.remind')
</div>
<div id="layout-about-visible-message" class="d-none" data-log="0">
    @include('message.visible_ver2.right.about.about')
    @include('message.visible_ver2.right.about.detail')
    @include('message.visible_ver2.right.about.add')
    @include('message.visible_ver2.right.about.change_name')
</div>
@include('message.visible_ver2.right.body.vote')
@include('message.visible_ver2.right.body.profile')


