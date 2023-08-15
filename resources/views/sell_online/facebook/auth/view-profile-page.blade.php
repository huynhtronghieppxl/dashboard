@extends('layouts.layout')
@section('content')

    <div class="page-wrapper">
        <div class="row">
            <div class="col-md-12 mb-5">
                <div class="cover-profile">
                    <div class="profile-bg-img">
                        <div id="bg-cover-page">
                            <img  class="profile-bg-img img-fluid"
                                 src=""
                                 alt="bg-img">
                        </div>
                        <div class="card-block user-info">
                            <div class="col-md-12">
                                <div id="avatar-page-choose" class="media-left">
                                    <a href="#" class="profile-image">
                                        <img class="rounded-circle" alt="user-img"
                                             src="{{--$page_selected['avatar']--}}">
                                    </a>
                                </div>
                                <div class="media-body row">
                                    <div class="col-lg-12">
                                        <div id class="user-title">
                                            <h1 id="page-name-selected" class="font-weight-bold text-white"
                                                data-page="{{--$page_selected['name']--}}">{{--$page_selected['name']--}}</h1>
                                            <span id="page-category-selected"
                                                  class="font-weight-bold text-muted">{{--$page_selected['category']--}}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="pull-right cover-btn">
                                            <a type="button" class="btn btn-primary m-b-10 m-r-10"
                                               href="{{--route('sell_online.facebook.facebook.auth.message-page')--}}">
                                                <i class="ion-chatbubble-working"></i>@lang('app.facebook_auth.message')
                                            </a>
                                            <button type="button" class="btn btn-primary m-b-10 m-r-10"
                                                    data-toggle="modal" data-target="#default-Modal">
                                                <i class="fa fa-list-alt"></i>@lang('app.facebook_auth.listpages')
                                            </button>
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
    <div class="col-md-12">
        <div class="card bg-white">
            <div class="post-new-contain row card-block">
                <div id="avatar-page-2" class="col-md-1 col-xs-3 post-profile">
                    <img src="{{--$page_selected['avatar']--}}" class="img-70 img-circle">
                </div>
                <form class="col-md-11 col-xs-9">
                    <div class="border rounded p-2">
                        <textarea id="post-message" class="form-control post-input" rows="3" cols="10" required=""
                                  placeholder="Hôm nay bạn cảm thấy thế nào?"></textarea>
                    </div>
                </form>
            </div>
            <div class="post-new-footer b-t-muted p-15">
                <span class="image-upload m-r-15" data-toggle="tooltip" data-placement="top" title=""
                      data-original-title="Add Photos">
                     <label for="file-input" class="file-upload-lbl">
                         <i class="typcn typcn-image text-muted"></i>
                     </label>
                     <input id="file-input" type="file" accept="image/*">
                </span>
                <i class="typcn typcn-user-add text-muted"></i>
                <i class="typcn typcn-location text-muted"></i>
                <span><a href="#" id="post-new" class="btn btn-primary waves-effect waves-light f-right"
                         style="display: none;">Post</a></span>
                <button type="submit" class="btn btn-primary f-right">Post</button>
            </div>
        </div>
        {{--        @foreach($all_feed as $feed)--}}
        <div id="feed-pages">
            <div class="bg-white p-relative">
                <div class="card-block border">
                    <div class="media">
                        <div id="avatar-page-3" class="media-left">
                            <a href="#">
                                <img class="img-50 img-circle" src="{{--$page_selected['avatar']--}}" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <div id="name-page-2" class="chat-header font-weight-bold">{{--$page_selected['name']--}}</div>
                            <div class="f-13 text-muted">{{--$feed['created_time']--}}</div>
                        </div>
                    </div>
                </div>
                <div class="card-block">
                    {{--                        @if(isset($feed['message']))--}}
                    <div class="timeline-details">
                        <div class="chat-header">{{--$feed['message']--}}</div>

                    </div>
                    {{--                        @endif--}}
                </div>
                <div id="lightgallery" class="lightgallery-popup mb-5">
                    {{--                        @if($feed['video'] !== null)--}}
                    <iframe class="img-fluid mx-auto d-block" width="40%" src="{{--$feed['video']--}}"
                            style="border:none;overflow:hidden" scrolling="no"
                            frameborder="0" allowTransparency="true" allowFullScreen="true"></iframe>

                    {{--                        @elseif(isset($feed['full_picture']))--}}
                    <div class="px-3 img-fluid"
                         data-responsive="../files/assets/images/timeline/img1.jpg 375, img/1-480.jpg 480, img/1.jpg 800"
                         data-src="../files/assets/images/timeline/img1.jpg">
                        <img src="{{--$feed['full_picture']--}}" class="img-fluid mx-auto d-block" width="40%">
                    </div>
                    {{--                        @endif--}}
                </div>
                <div class="card-block b-b-theme b-t-theme social-msg">
                    <a href="#">
                        <i class="icofont icofont-heart-alt text-muted"></i>
                        <span class="b-r-theme">Like (20)</span>
                    </a>
                    <a href="#">
                        <i class="icofont icofont-comment text-muted"></i>
{{--                        <span class="b-r-theme">Comments--}}
{{--                                                   @if(isset($feed['comments']))--}}
{{--                                                     ({{$feed['comments']['count_comment']}})--}}
{{--                                               @else--}}
{{--                                                  (0)--}}
{{--                                             @endif--}}
{{--                        </span>--}}
                    </a>
                    <a href="#">
                        <i class="icofont icofont-share text-muted"></i>
                        <span>Share (10)</span>
                    </a>

                </div>
                <div class="card-block user-box">
                    <div class="p-b-20">
                        <span class="f-14"><a href="#">Comments </a></span>
                        <span class="f-right">see all comments</span>
                    </div>
                    {{--                        @if(isset($feed['comments']))--}}
                    {{--                            @foreach($feed['comments']['data'] as $comment )--}}
                    <div class="media">
                        <a class="media-left" href="#">
                            <img class="media-object img-radius m-r-20" src="..\files\assets\images\avatar-2.jpg"
                                 alt="Generic placeholder image">
                        </a>

                        <div class="media-body b-b-theme social-client-description">
                            <div class="chat-header">{{--$comment['id']--}}<span
                                    class="text-muted">{{--$comment['created_time']--}}</span></div>
                            <p class="text-muted">{{--$comment['message']--}}</p>
                        </div>
                    </div>
                    {{--                            @endforeach--}}
                    {{--                        @endif--}}
                </div>
            </div>
        </div>


    <div class="f-30 text-muted text-center p-30"></div>
    {{--    @endforeach--}}
    </div>
    <!-- Modal list-page-->
    <div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mx-auto font-weight-bold text-uppercase">Danh sách pages của bạn</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="typcn typcn-delete font-18 text-danger"></i></span>
                    </button>
                </div>
                <div id="list-pages" class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-grd-disabled waves-effect " data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script src="{{ asset('js\sell_online\facebook\index.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

