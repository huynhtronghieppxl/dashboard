@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card card-block">
                <div class="table-responsive new-table">
                    <table id="table-not-update-vat-setting" class="table">
                        <thead>
                        <tr>
                            <th>@lang('app.vat-setting.stt')</th>
                            <th>@lang('app.vat-setting.name')</th>
                            <th>@lang('app.vat-setting.value')</th>
                            {{--                            <th>@lang('app.vat-setting.notify')</th>--}}
                            <th></th>
                            <th class="d-none"></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('setting.vat_manage.vat_config.update')
    @include('setting.vat_manage.vat_config.detail')
    {{--    @include('manage.food.brand.setup_vat')--}}
    {{--    @include('manage.food.brand.create')--}}
    @include('manage.food.brand.detail')
    {{--    @include('manage.food.brand.update')--}}
    {{--    @include('manage.food.brand.upload_image')--}}
    {{--    @include('manage.food.brand.assign_branch')--}}
    {{--    @include('manage.food.brand.combo')--}}
    {{--    @include('manage.food.brand.import_excel')--}}
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\setting\vat_manage\vat_config\index.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
