@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>@lang('app.facebook_auth.title')</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="/"> <i class="feather icon-home"></i> </a>
                            </li>
                            <li class="breadcrumb-item"><a
                                        href="">@lang('app.facebook_auth.breadcrumb')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12 py-5" id="facebook">
                            <div class="mx-auto text-center">
                                <img src="http://themes.techres.vn/images/web/logos/techres_sologan_main_blue_color.png"
                                     width="20%"><br>
                                <h4 class="py-3" id="fb-title">Kết nối với Fanpage Facebook của bạn</h4>
                            </div>
                            <div class="col-lg-10 mx-auto text-center p-3">
                                <div class="col-sm-3 float-left">
                                    <div class="card rounded-card user-card">
                                        <div class="card-block">
                                            <div class="img-hover">
                                                <img class="img-fluid img-radius"
                                                     src="{{$user_data->avatar_original}}">
                                            </div>
                                            <div class="user-content">
                                                <h4 class="">{{$user_data->name}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9 float-right">
                                    @foreach($page_data as $page)
                                        <div class="card">
                                            <div class="row p-3">
                                                <div class="col-sm-2">
                                                    <img class="media-object img-radius img-60"
                                                         src="{{$page['avatar']}}">
                                                </div>
                                                <div class="col-sm-7">
                                                    <div class="row">
                                                        <a class="float-left font-weight-bold font-18">{{$page['name']}}</a>
                                                    </div>
                                                    <div class="row">
                                                        <span class="float-left">{{$page['category']}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 m-auto">
                                                    <button class="btn btn-primary m-auto"
                                                            onclick="getPageByID({{$page['id']}})">Kết
                                                        nối
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\js\sell_online\facebook\index.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

