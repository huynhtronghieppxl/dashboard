@extends('layouts.layout')
@section('content')
    <div class="page-body">
        <div class="row">
            <div class="col-7 edit-flex-auto-fill flex-column">
                <ul class="nav nav-tabs md-tabs" role="tablist" id="nav-tab-note-food-data">
                    <li class="nav-item" style="width: auto !important;">
                        <a class="nav-link" data-toggle="tab"
                           href="#cards-tab1" role="tab" data-tab="1"
                           aria-expanded="true">@lang('app.note-food-data.tab1') <span
                                    class="label label-success" id="total-record-enable">0</span></a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item" style="width: auto !important;">
                        <a class="nav-link" data-toggle="tab" data-tab="2"
                           href="#cards-tab2"
                           role="tab"
                           aria-expanded="false">@lang('app.note-food-data.tab2') <span
                                    class="label label-inverse" id="total-record-disable">0</span></a>
                        <div class="slide"></div>
                    </li>
                </ul>
                <div class="card card-block flex-sub">
                    <div class="tab-content m-t-10px">
                        <div class="tab-pane active" id="cards-tab1" role="tabpanel">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand select-brand-note-food">
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                @if($db['is_office'] === 0)
                                                    @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                        <option value="{{$db['id']}}"
                                                                selected>{{$db['name']}}</option>
                                                    @else
                                                        <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <table id="table-enable-note-food-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.note-food-data.stt')</th>
                                        <th>@lang('app.note-food-data.note')</th>
                                        <th>@lang('app.note-food-data.count')</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="cards-tab2" role="tabpanel">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand select-brand-note-food">
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                @if($db['is_office'] === 0)
                                                    @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                        <option value="{{$db['id']}}"
                                                                selected>{{$db['name']}}</option>
                                                    @else
                                                        <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <table id="table-disable-note-food-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.note-food-data.stt')</th>
                                        <th>@lang('app.note-food-data.note')</th>
                                        <th>@lang('app.note-food-data.count')</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5 edit-flex-auto-fill pl-0">
                <div class="card card-block flex-sub">
                    <div class="card-block p-b-0 pl-0">
                        <h5 class="sub-title mb-2 mx-0"
                            style="padding-bottom: 12px; margin-bottom: 10px">@lang('app.note-food-data.title-right')</h5>
                    </div>
                    <div class="table-responsive new-table">
                        <table id="table-detail-note-food-data" class="table">
                            <thead>
                            <tr>
                                <th>@lang('app.note-food-data.stt')</th>
                                <th>@lang('app.note-food-data.name')</th>
                                <th>@lang('app.note-food-data.category')</th>
                                <th></th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('build_data.food.note.create')
    @include('build_data.food.note.update')
    @include('manage.food.brand.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/food/note/index.js?version=5', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
