@extends('layouts.layout')
@section('content')
    {{--<div class="row">--}}
    {{--<div class="col-lg-11 m-auto">--}}
    {{--<div class="row">--}}
    {{--<div class="col-lg-12">--}}
    {{--<div class="cover-profile">--}}
    {{--<div class="profile-bg-img">--}}
    {{--<img class="profile-bg-img" src="..\files\assets\images\user-profile\bg-img1.jpg"--}}
    {{--alt="Ảnh bìa">--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-lg-2 col-sm-4 w-100 mx-auto" id="avatar-page">--}}
    {{--<a href="#" class="profile-image">--}}
    {{--<img class="img-circle w-100" src="" alt="Ảnh đại diện">--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--<div class="col-lg-6 mx-auto">--}}
    {{--<div class="text-center" id="name-page">--}}
    {{--<h2 class="font-weight-bold"></h2>--}}
    {{--<span class="text-muted"></span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="col-lg-11 m-auto pt-4">--}}
    {{--<div class="col-lg-12 col-sm-12 float-left p-2 bg-white rounded">--}}
    {{--<div class="row card-block p-2">--}}
    {{--<div class="col-lg-1 col-sm-1 w-100" id="avatar-feed-write">--}}
    {{--<img src="" class="img-circle w-100" alt="">--}}
    {{--</div>--}}
    {{--<form class="col-lg-11 col-sm-11">--}}
    {{--<div class="border rounded">--}}
    {{--<textarea id="post-message" class="form-control post-input" rows="3" cols="10"--}}
    {{--required="" placeholder="Bạn đang nghĩ gì?"></textarea>--}}
    {{--</div>--}}
    {{--</form>--}}
    {{--</div>--}}
    {{--<div class="post-new-footer b-t-muted p-2">--}}
    {{--<span class="image-upload m-r-15" data-toggle="tooltip" data-placement="top" title=""--}}
    {{--data-original-title="Thêm hình ảnh">--}}
    {{--<label for="file-input" class="file-upload-lbl">--}}
    {{--<i class="typcn typcn-image-outline"></i>--}}
    {{--</label>--}}
    {{--<input id="file-input" type="file" accept="image/x-png,image/gif,image/jpeg">--}}
    {{--</span>--}}
    {{--<i class="typcn typcn-user-add"></i>--}}
    {{--<i class="typcn typcn-location"></i>--}}
    {{--<button type="submit" class="btn btn-primary f-right">Post</button>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-lg-11 col-sm-11 m-auto pt-4">--}}
    {{--<div class="col-lg-12 p-0" id="data-feed"></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--</div>--}}
    <div class="page-wrapper">
        {{--<div class="page-header">--}}
            {{--<div class="row align-items-end">--}}
                {{--<div class="col-lg-8">--}}
                    {{--<div class="page-header-title">--}}
                        {{--<div class="d-inline">--}}
                            {{--<h4 id="title">@lang('app.area-report.title')</h4>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-lg-4">--}}
                    {{--<div class="page-header-breadcrumb">--}}
                        {{--<ul class="breadcrumb-title">--}}
                            {{--<li class="breadcrumb-item">--}}
                                {{--<a href="/"> <i class="feather icon-home"></i> </a>--}}
                            {{--</li>--}}
                            {{--<li class="breadcrumb-item"><a--}}
                                        {{--href="{{route('report.area-report.index')}}">@lang('app.area-report.breadcrumb')</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="page-body mb-3" style="background-color: #f1f2f5">
            <div class="container-fluid">
                <div class="container">
                    <div class="banner-image ">
                        <img src="http://beta.api.upload.techres.vn/public/resource/TMS/KAIZEN/1/29/1/2021/6/9-6-2021/image/original/1623224718858582.jpg" class="img-fluid w-100" alt="">
                    </div>
                    <div class="col-lg-12 container ml-5 p-3">
                        <div class="d-flex bd-highlight">
                            <div class="img_cont">
                                <img src="http://beta.api.upload.techres.vn/public/resource/TMS/KAIZEN/1/29/1/2021/6/9-6-2021/image/original/1623224718858582.jpg" class="avatar avatar-xl rounded-circle">
                            </div>
                            <div class="name-avatar">
                                <span>Khalid</span>
                                <p>Kalid is online</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12" style="border-top: 1px solid #c9cec9">
                        <nav class="navbar navbar-expand-lg">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                              <ul class="navbar-nav mr-auto">
                                <li class="nav-item mr-5 ml-5">
                                  <a class="nav-link" href="#">Link</a>
                                </li>
                                <li class="nav-item mr-5 ml-5">
                                    <a class="nav-link" href="#">Link</a>
                                </li>
                                <li class="nav-item mr-5 ml-5">
                                    <a class="nav-link" href="#">Link</a>
                                </li>
                                <li class="nav-item mr-5 ml-5 dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Dropdown
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </li>
                              </ul>
                              <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle img_cont" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="http://beta.api.upload.techres.vn/public/resource/TMS/KAIZEN/1/29/1/2021/6/11-6-2021/image/original/1623389809419631.jpeg" alt="Avatar" class="avatar">
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                              </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="container" id="main-content" >
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        Thông tin chi tiết
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="col-lg-12">
                                            <nav class="navbar navbar-expand-lg">
                                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                                    <ul class="navbar-nav mr-auto">
                                                        <li class="nav-item">
                                                        <a class="nav-link" href="#">Link</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="#">Link</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="#">Link</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </nav>
                                        </div>
                                        <div class="col-lg-12 row mb-3" style="display: flex;align-items: center;">
                                            <div class="col-lg-1 img_cont">
                                                <img src="http://beta.api.upload.techres.vn/public/resource/TMS/KAIZEN/1/29/1/2021/6/11-6-2021/image/original/1623389809419631.jpeg" alt="Avatar" class="avatar">
                                            </div>
                                            <div class="col-lg-11">
                                                <input type="text" placeholder="Bạn đang nghĩ gì??" style="width: 100%;font-size: 25px !important;border: 0;">
                                            </div>
                                            <div class="col-lg-12">
                                                <i class="fa fa-meh-o p-2 f-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12" id="list-new-feed">
                                    <div class="card">
                                        <div class="col-lg-12 ">
                                            <div class="d-flex mt-3 bd-highlight">
                                                <div class="img-user">
                                                    <img src="http://beta.api.upload.techres.vn/public/resource/TMS/KAIZEN/1/29/1/2021/6/9-6-2021/image/original/1623224718858582.jpg" class="avatar avatar-xs rounded-circle">
                                                </div>
                                                <div class="image-avatar-news ml-3 mt-1">
                                                    <span class="h4">Khalid</span>
                                                    <p>Kalid is online</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 pb-3" style="font-size:17px !important">
                                            <p class="mt-2"> Lorem ipsum dolor sit amet, consectetur adipisicing Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, nam? Eaque ex harum mollitia aperiam inventore sed laudantium iusto animi. Quasi, necessitatibus? Maiores iure ipsam fugit corrupti reprehenderit veniam autem. Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur ab enim tempore aliquid ad odit? Eligendi omnis expedita mollitia libero id dolore molestiae soluta amet eaque, suscipit pariatur distinctio aliquam. elit. Dolorem dolor, perspiciatis sunt quia quis maiores ea, tempora id voluptates doloribus autem tempore velit, asperiores nesciunt nihil? Suscipit laborum maxime dolor.</p>
                                        </div>
                                        <div class="col-lg-12 pb-3" style="font-size:17px !important">
                                            <img src="http://beta.api.upload.techres.vn/public/resource/TMS/KAIZEN/1/29/1/2021/6/11-6-2021/image/original/1623389809419631.jpeg" class="img-fluid w-100" alt="Responsive image">
                                        </div>
                                        <div class="col-lg-12 pb-3" style="font-size:17px !important">
                                            <div class="d-flex">
                                                <div class="col-lg-4 ">
                                                    <div class="h3">4.99302</div>
                                                    <div>So nguoi tiep can duojc </div>
                                                </div>
                                                <div class="col-lg-4 ">
                                                    <div class="h3">4.99302</div>
                                                    <div>So nguoi tiep can duojc </div>
                                                </div>
                                                <div class="col-lg-4 ">
                                                    <div class="h3">4.99302</div>
                                                    <div>So nguoi tiep can duojc </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 border-bottom pb-3 pt-3" style="font-size:17px !important">
                                            <div class="d-flex">
                                                <div class="col-lg-6">
                                                    <div>
                                                        <i class="text-primary fa fa-american-sign-language-interpreting"></i>
                                                        Ban va 20 nguoi khac
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 row">
                                                    <div class="col-lg-6 ">
                                                        <a href="">111 nguoi binh luan</a>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <a href="">88 luot chia se</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 border-bottom pb-3 pt-3" style="font-size:17px !important">
                                            <div class="d-flex text-center">
                                                <div class="col-lg-4">
                                                    <button type="button" class="btn btn-secondary w-100">Thich</button>
                                                </div>
                                                <div class="col-lg-4">
                                                    <button type="button" class="btn btn-secondary w-100">Binh luan</button>
                                                </div>
                                                <div class="col-lg-4">
                                                    <button type="button" class="btn btn-secondary w-100">Chia se</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 border-bottom pb-3 pt-3" style="font-size:17px !important">
                                            <div class="f-right text-center">
                                                <div class="col-lg-12">
                                                    <a href="">asdsadsad</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 border-bottom pb-3 pt-3" style="font-size:17px !important">
                                            <div class="d-flex align-items-center">
                                                <div class="col-lg-1 mr-4 img_cont">
                                                    <img src="http://beta.api.upload.techres.vn/public/resource/TMS/KAIZEN/1/29/1/2021/6/11-6-2021/image/original/1623389809419631.jpeg" alt="Avatar" class="avatar">
                                                </div>
                                                <div class="col-lg-10 border border-dark" style="border-radius: 18px;">
                                                    <input type="text" class="border-0 w-100 bg-transparent" style="font-size: 30px !important">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 border-bottom pb-3 pt-3" id="box-list-comment">
                                            <div class="col-lg-12" style="font-size:17px !important">
                                                <div class="d-flex align-items-center">
                                                    <div class="col-lg-1 p-0">
                                                        <img src="http://beta.api.upload.techres.vn/public/resource/TMS/KAIZEN/1/29/1/2021/6/11-6-2021/image/original/1623389809419631.jpeg" alt="Avatar" class="avatar">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="chat-msg-text">hfdsjkhfjshfjkshjkshdjkhfjkdhshfdshjkfhjdshjfhkdhjk</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 sub-box-comment">
                                                    <div class="col-lg-12 pb-3 pt-3 pl-5" style="font-size:17px !important">
                                                        <div class="d-flex align-items-center">
                                                            <div class="col-lg-1 p-0">
                                                                <img src="http://beta.api.upload.techres.vn/public/resource/TMS/KAIZEN/1/29/1/2021/6/11-6-2021/image/original/1623389809419631.jpeg" alt="Avatar" class="avatar">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="chat-msg-text">hfdsjkhfjshfjkshjkshdjkhfjkdhshfdshjkfhjdshjfhkdhjk</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 pb-3 pt-3 pl-5" style="font-size:17px !important">
                                                        <div class="d-flex align-items-center">
                                                            <div class="col-lg-1 p-0">
                                                                <img src="http://beta.api.upload.techres.vn/public/resource/TMS/KAIZEN/1/29/1/2021/6/11-6-2021/image/original/1623389809419631.jpeg" alt="Avatar" class="avatar">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="chat-msg-text">hfdsjkhfjshfjkshjkshdjkhfjkdhshfdshjkfhjdshjfhkdhjk</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 pb-3 pt-3 pl-5" style="font-size:17px !important">
                                                        <div class="d-flex align-items-center">
                                                            <div class="col-lg-1 p-0">
                                                                <img src="http://beta.api.upload.techres.vn/public/resource/TMS/KAIZEN/1/29/1/2021/6/11-6-2021/image/original/1623389809419631.jpeg" alt="Avatar" class="avatar">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="chat-msg-text">hfdsjkhfjshfjkshjkshdjkhfjkdhshfdshjkfhjdshjfhkdhjk</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 pb-3 pt-3 pl-5" style="font-size:17px !important">
                                                        <div class="d-flex align-items-center">
                                                            <div class="col-lg-1 mr-4 p-0 img_cont">
                                                                <img src="http://beta.api.upload.techres.vn/public/resource/TMS/KAIZEN/1/29/1/2021/6/11-6-2021/image/original/1623389809419631.jpeg" alt="Avatar" class="avatar">
                                                            </div>
                                                            <div class="col-lg-11 border border-dark" style="border-radius: 18px;">
                                                                <input type="text" class="border-0 w-100 bg-transparent" style="font-size: 30px !important">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="chat-box" id="chat-box-new-feed-facebook" style="margin-right: 100px">
        <ul class="text-right boxs">
            <li class="chat-single-box card-shadow bg-white d-none" data-id="1" style="border-radius: 0;">
                <div class="had-container">
                    <div class="chat-header p-10 bg-gray" style="background-color: #92cc8e;">
                        <div class="user-info d-inline-block f-left">
                            <div class="box-live-status bg-success d-inline-block m-r-10"></div>
                            <a href="#" class="name-sender-new-feed-facebook"></a>
                        </div>
                        <div class="box-tools d-inline-block">
                            <a href="#!" class="mini">
                                <i class="icofont icofont-minus f-20 m-r-10"></i>
                            </a>
                            <a class="close" href="#!">
                                <i class="icofont icofont-close f-20"></i>
                            </a>
                        </div>
                    </div>
                    <div class="chat-body p-10">
                        {{--Data chat--}}
                    </div>
                    <div class="chat-footer b-t-muted">
                        <div class="input-group write-msg" style="bottom: 0;">
                            <input type="text" class="form-control input-value" placeholder="Type a Message">
                            <span class="input-group-btn"><button id="paper-btn" class="btn btn-primary"
                                                                  type="button"><i
                                            class="icofont icofont-paper-plane"></i></button></span>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('..\js\sell_online\facebook\new_feed.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
