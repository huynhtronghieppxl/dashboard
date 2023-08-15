@extends('layouts.layout')
@section('content')
    <style>
        .select-reason-cancel {
            transform: translateX(-16px);
        }
    </style>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="card-block">
                    <div class="table-responsive new-table">
                        <div class="select-filter-dataTable select-reason-cancel">
                            <div class="form-validate-select">
                                <div class="pr-0 select-material-box">
                                    <select class="js-example-basic-single select-brand"
                                            id="select-brand-reasons-cancel-food-data">
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
                        </div>
                        <table class="table" id="table-reasons-cancel-food">
                            <thead>
                            <tr>
                                <th>@lang('app.reasons-cancel-food.stt')</th>
                                <th>@lang('app.reasons-cancel-food.breadcrumb')</th>
                                <th style="width: 24px;">@lang('app.reasons-cancel-food.action')</th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('build_data.business.reasons_cancel_food.create')
    @include('build_data.business.reasons_cancel_food.update')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\build_data\business\reasons_cancel_food\index.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
