@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card card-block">
                <div class="table-responsive new-table">
                    <table id="table-material-unit-food-data" class="table">
                        <thead>
                        <tr>
                            <th>@lang('app.material-unit-food.stt')</th>
                            <th>@lang('app.material-unit-food.name')</th>
                            <th>@lang('app.material-unit-food.unit')</th>
                            <th>@lang('app.material-unit-food.value')</th>
                            <th>@lang('app.material-unit-food.value-name')</th>
                            <th></th>
                            <th class="d-none"></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('build_data.kitchen.material_unit_food.create')
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\kitchen\material_unit_food\index.js?version=4', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
