@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="col-lg-12 row mx-auto">
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs md-tabs md-5-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab"
                                   href="#tab1-game-marketing" role="tab"
                                   aria-expanded="true">@lang('app.game-marketing.tab1')
                                    <span class="label label-success"
                                          id="total-tab1-game-marketing">0</span></a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab"
                                   href="#tab2-game-marketing" role="tab"
                                   aria-expanded="false">@lang('app.game-marketing.tab2') <span
                                        class="label label-inverse"
                                        id="total-tab2-game-marketing">0</span></a>
                                <div class="slide"></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="tab-content card p-2 mb-0">
                        <div class="tab-pane active" id="tab1-game-marketing" role="tabpanel">
                            <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table1-game-marketing">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.game-marketing.stt')</th>
                                            <th>@lang('app.game-marketing.avatar')</th>
                                            <th>@lang('app.game-marketing.name')</th>
                                            <th>@lang('app.game-marketing.description')</th>
                                            <th>@lang('app.game-marketing.action')</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2-game-marketing" role="tabpanel">
                            <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table2-game-marketing">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.game-marketing.stt')</th>
                                            <th>@lang('app.game-marketing.avatar')</th>
                                            <th>@lang('app.game-marketing.name')</th>
                                            <th>@lang('app.game-marketing.description')</th>
                                            <th>@lang('app.game-marketing.action')</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('marketing.game.create')
    <div id="mySidenav-321" class="sidenav">
        <a href="javascript:void(0)" id="button-service-1" class="bg-primary" onclick="openModalCreateGameMarketing()" style="width: max-content"><i
                class="fa fa-plus-square"></i>&emsp; @lang('app.component.button.create')</a> <br>
    </div>

@endsection
@push('scripts')
    @include('layouts.oldDatatable')
    <script type="text/javascript"
            src="{{asset('/js/marketing/game/index.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
